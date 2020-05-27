<?php

$bmw = [
    'model' => 'X5',
    'speed' => '120',
    'doors' => '5',
    'year' => '2015'
];
$toyota = [
    'model' => 'Avensis',
    'speed' => '180',
    'doors' => '4',
    'year' => '2012'
];
$opel = [
    'model' => 'Corsa',
    'speed' => '200',
    'doors' => '5',
    'year' => '2016'
];

$car['bmw'] = $bmw;
$car['toyota'] = $toyota;
$car['opel'] = $opel;

foreach ($car as $key => $value) {
    echo 'CAR ' . $key . '<br>';
    foreach ($value as $key2 ) {
        echo "$key2 ";
    }
    echo '<br>';
}