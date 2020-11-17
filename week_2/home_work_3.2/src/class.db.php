<?php
//namespace Base;

//класс для рабоы с базой данных - реализован в формате синглтона
class Db
{

/*Таким phpDoc-ом вы сообщаете PhpStorm, что следующая переменная (свойство) имеет тип PDO.
Обратный слеш - Потому что PDO находиться в глобальном пространстве имен, а не здесь. Соответственно нужно либо
импортировать в текущее пространство use PDO; либо обращаться с указанием пространства имен \PDO; Первый вариант предпочтительней.
Другими словами для доступа к глобальным классам нужно использовать конструкцию \ClassName.*/
    /**  @var \PDO */
    private $pdo;


    private $log = [];
    private static $instance;

//    закрытый конструктор
    private function __construct()
    {
    }

//    закрытый метод клонирования
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }



//    создаёт объект класса
//:self - означает что должен вренуться объект того же типа или класса
    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

//    создаёт объект PDO по принципу лэйзи лоад (метод гетКонекшн вызывается тогда когда нужен,
//чтобы не создавать ПДО тогда, когда мы не собираемся делать запросы в БД)
    private function getConnection()
    {
        $host = DB_HOST;
        $dbName = DB_NAME;
        $dbUser = DB_USER;
        $dbPassword = DB_PASSWORD;

        if (!$this->pdo) {
//            соединение. В результате мы получаем переменную $this->pdo, с которым и работаем далее на протяжении всего скрипта.
            $this->pdo = new \PDO("mysql:host=$host;dbname=$dbName", $dbUser, $dbPassword);
        }

        return $this->pdo;

    }

//    получает все записи по запросу
    public function fetchAll(string $query, $_method, array $params = [])
    {
        $t = microtime(true);
        $prepared = $this->getConnection()->prepare($query);

        $ret = $prepared->execute($params);

        if (!$ret) {
            $errorInfo = $prepared->errorInfo();
            trigger_error("{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2]);
            return [];
        }

        $data = $prepared->fetchAll(\PDO::FETCH_ASSOC);
        $affectedRows = $prepared->rowCount();
        $this->log[] = [$query, microtime(true) - $t, $_method, $affectedRows];


        return $data;
    }

//    получает одну запись (например по primary key)
    public function fetchOne(string $query, $_method, array $params = [])
    {
//        метка времени
        $t = microtime(true);

//      Если в запрос передаётся хотя бы одна переменная, то этот
//      запрос в обязательном порядке должен выполняться только через подготовленные
//      выражения (используется prepare). Чтобы выполнить такой запрос, сначала его надо подготовить с
//      помощью функции prepare(). Она также возвращает PDO statement, но ещё без данных.
        $prepared = $this->getConnection()->prepare($query);

//      в случае именованных плейсхолдеров (типа :name) в execute() должен передаваться массив, в котором ключи
//      должны совпадать с именами плейсхолдеров. После этого можно использовать PDO statement Например, через foreach
        $ret = $prepared->execute($params);

        if (!$ret) {
            $errorInfo = $prepared->errorInfo();
            trigger_error("{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2]);
            return [];
        }

        $data = $prepared->fetchAll(\PDO::FETCH_ASSOC);
        $affectedRows = $prepared->rowCount();

//        внетруннее логирование запросов
        $this->log[] = [$query, microtime(true) - $t, $_method, $affectedRows];
        if (!$data) {
            return false;
        }
        return reset($data);
    }

//    выполняет запрос и возвращает кол-во затронутых запросом столбцов
    public function exec(string $query, $_method, array $params = []): int
    {
        $t = microtime(1);
        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);

        $ret = $prepared->execute($params);

        if (!$ret) {
            $errorInfo = $prepared->errorInfo();
            trigger_error("{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2]);
            return -1;
        }

        $affectedRows = $prepared->rowCount();

        $this->log[] = [$query, microtime(1) - $t, $_method, $affectedRows];
        return $affectedRows;
    }

//    возвращает ID последней вставленной записи
    public function lastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }

//    выдаст в виде HTML какие запросы были сделаны в ходе выполнения скрипта
    public function getLogHTML()
    {
        if (!$this->log) {
            return '';
        }
        $res = '';
        foreach ($this->log as $elem) {
            $res = $elem[1] . ': ' . $elem[0] . ' (' . $elem[2] . ') [' . $elem[3] . ']' . "\n";
        }
        return '<pre>' . $res . '</pre>';
    }


}
