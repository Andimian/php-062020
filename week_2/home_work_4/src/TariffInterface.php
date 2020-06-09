<?php

interface TariffInterface
{
//    считает цену по определнному тарифу с заданными параметрами
    public function countPrice(): int;
//    подключает доп услугу, на вход принимает интерфейс сервиса
    public function addService(ServiceInterface $service): self;

    public function getMinutes(): int;
    public function getDistance(): int;
}