<?php

function task1(array $arr, $bool = false)
{
    if ($bool) {
        return implode(', ', $arr);
    }
    else {
        return "<p>" . implode('<p></p>', $arr) . "</p>";
    }
}

function task2(... $args)
{
    $operator = array_shift($args);

    foreach ($args as $arg) {
        if (!is_int($arg) && !is_float($arg)) {
            trigger_error('функция может принимать только целые и/или вещественные числа.');
            return 'функция может принимать только целые и/или вещественные числа.';
        }
    }

    switch ($operator) {
        case '+':
            return array_sum($args);
        case "-":
            return array_shift($args) - array_sum($args);
        case "/":
            $res = array_shift($args);
            foreach ($args as $value) {
                if ($value == 0) {
                    trigger_error('На ноль делить нельзя.');
                }
                $res /= $value;
            }
            return $res;
        case "*":
            $res = 1;
            foreach ($args as $value) {
                $res *= $value;
            }
            return $res;
        default:
            return "Передан неверный оператор";
    }

}

function task3(int $number, int $number2)
{
    if ($number < 0 || $number2 < 0) {
        trigger_error('Числа должны быть положительными!');
    }

    $res = '<table>';
    for ($i = 1; $i <= $number; $i++) {
        $res .= '<tr>';
        for ($j = 1; $j <= $number2; $j++) {
            $tdRes = $i * $j;
            $res .= "<td>$tdRes</td>";
        }
        $res .= '</tr>';
    }
    return $res;
}

function task4()
{
    echo date('d.m.Y h:i');
}

function task5()
{
    echo strtotime('24.02.2016 00:00:00');
}

function task6()
{
    $str = 'Карл у Клары украл Кораллы';
    return str_replace('К', '', $str);
}

function task7()
{
    $str = 'Две бутылки лимонада';
    return str_replace('Две', 'Три', $str);
}

function task8()
{
   file_put_contents('test.txt', 'Hello again');
}

function task9($filename)
{
    $fp = fopen($filename, 'r');
    if(!$fp) {
        return false;
    }
    $str = '';
    while (!feof($fp)) {
        $str .= fgets($fp, 1024);
    }
    echo $str;
}