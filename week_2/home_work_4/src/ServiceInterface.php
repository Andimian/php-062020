<?php

interface ServiceInterface
{
//    принимает на вход интерфейс тарифа, передаём цену, которую расссчитываем по ссылке
    public function apply(TariffInterface $tariff, &$price);
}