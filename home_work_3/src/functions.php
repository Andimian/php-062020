<?php

$names = ['Anton', 'Anna', 'Diana', 'Galina', 'Ilya'];
$arr = [];
for ($i = 1; $i <= 50; $i++) {
    $arr[$i] = ['id' => $i, 'name' => $names[rand(0, 4)], 'age' => rand(18,45)];
}

$json = json_encode($arr);
file_put_contents('users.json', $json);

$data = file_get_contents('users.json');
$arrFromJson = json_decode($data, true);

$dataNames = [];
foreach ($arrFromJson as $key => $val) {
    $name = $val['name'];
    $dataNames[$name] = 0;
}
foreach ($arrFromJson as $key => $val) {
    $name = $val['name'];
    foreach ($dataNames as $key => $val) {
        if ($key == $name) {
            $dataNames[$key] += 1;
        }
    }
}

echo '<pre>';
print_r($arrFromJson);
print_r($dataNames);
