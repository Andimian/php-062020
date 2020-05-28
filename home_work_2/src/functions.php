<?php

//не готова..

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
    $res = 0;

    if ($operator == "+") {
        foreach ($args as $key) {
            $res += $key;
            return $res;
            break;
        }
        return $res;
    }
}

task2('+', 5, 5);