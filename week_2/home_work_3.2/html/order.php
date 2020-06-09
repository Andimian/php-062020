<?php
include '../src/config.php';
include '../src/class.db.php';
include '../src/class.burger.php';

ini_set('display_errors', 'on');
ini_set('error_reporting', E_NOTICE | E_ALL);

//создаём объект класса
$burger = new Burger();

//получаем имейл из данных запроса
$email = $_POST['email'];

$name = $_POST['name'];

//данные заказа
$addressFields = ['phone', 'street', 'home', 'part', 'appt', 'floor'];
$address = '';
foreach ($_POST as $field => $value) {
    if ($value && in_array($field, $addressFields)) {
        $address .= $value . ',';
    }
}
$data = ['address' => $address];

//проверить есть ли пользователь
$user = $burger->getUserByEmail($email);

if ($user) {
//    если пользователь есть, то увеличиваем кол-во заказов, если пользователь есть то id берётся
// из данных пользователя - передаём идентификатор
    $userId = $user['id'];
    $burger->incOrders($user['id']);
    $orderNumber = $user['orders_count'] + 1;
} else {
//    если пользователя нет, то создаём его и передаём имейл,
    $orderNumber = 1;
    $userId = $burger->createUser($email, $name);
}

//создать заказ, дата - данные заказа
$orderId = $burger->addOrder($userId, $data);

echo "Спасибо, ваш заказ будет доставлен по адресу: $address<br>
Номер вашего заказа: #$orderId <br>
Это ваш $orderNumber-й заказ!";



//Проверить, существует ли уже пользователь с таким email, если нет - создать его, если да - увеличить
//число заказов по этому email. Двух пользователей с одинаковым email быть не может.
//
//Сохранить данные заказа - id пользователя, сделавшего заказ, дату заказа, полный адрес клиента.
//Скрипт должен вывести пользователю:

