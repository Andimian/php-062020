<?php
//подключаю тарифы
include_once "../src/rates/TariffBasic.php";
include_once "../src/rates/TariffAbstract.php";
include_once "../src/rates/TariffHour.php";
//подключаю дополнительные сервисы
include_once "../src/optional_service/ServiceGPS.php";
include_once "../src/optional_service/ServiceDriver.php";
//подключаю интерфейс
include_once "../src/TariffInterface.php";
include_once "../src/ServiceInterface.php";

/** @var TariffInterface $tariff */
$tariff = new TariffHour(5, 61);
//$tariff->addService(new ServiceGPS(15));
//$tariff->addService(new ServiceDriver(100));
echo $tariff->countPrice();