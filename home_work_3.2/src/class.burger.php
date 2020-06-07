<?php
class Burger
{

    public function getUserByEmail(string $email)
    {
//        объект подключения к базе данных
        $db = Db::getInstance();

//        запрос через подготовленное выражение (:email это плейсхолдер)
        $query = "SELECT * FROM users WHERE email = :email";

//        получаем имейл с помощью подготовленной (в Db) функции
//        вторым аргументом принимается метод которым вызывается, чтобы логировать
//        запросы (чтобы видеть откуда вызывались запросы в БД)
        return $db->fetchOne($query, __METHOD__, [':email' => $email]);
    }

    public function createUser(string $email, string $name)
    {
        $db = Db::getInstance();
        $query = "INSERT INTO users(email, `name`) VALUES (:email, :name)";
        $result = $db->exec($query, __METHOD__, [
            ':email' => $email,
            ':name' => $name
        ]);
        if (!$result) {
            return false;
        }

        return $db->lastInsertId();
    }

    //    метод создания заказа
    public function addOrder(int $userId, array $data)
    {
        $db = Db::getInstance();
        $query = "INSERT INTO orders(user_id, address, created_at) VALUES (:user_id, :address, :created_at)";
        $result = $db->exec(
            $query,
            __METHOD__,
            [
                ':user_id' => $userId,
                ':address' => $data['address'],
                ':created_at' => date("Y-m-d H:i:s")
            ]
        );
        if (!$result) {
            return false;
        }

        return $db->lastInsertId();
    }

//    метод изменить кол-во заказов
    public function incOrders(int $userId)
    {
        $db = Db::getInstance();
        $query = "UPDATE users SET orders_count = orders_count +1 WHERE id = $userId";
        return $db->exec($query, __METHOD__);
    }
}