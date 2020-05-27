<?php

echo '<style>
body{background-color: rgba(171,184,186,0.72);}
table{margin: 0 auto;}
td{background: rgba(255,233,117,0.4); height: 50px; width: 50px; border: 1px solid #5679ff; text-align: center;}
</style>';

echo "<table>";
for ($i = 0; $i <= 10; $i++) {
    echo "<tr>";
    for ($i2 = 0; $i2 <= 10; $i2++) {
        $res = $i * $i2;
        echo "<td>";
        if ($i == 0 & $i2 == 0) {
            echo 'X';
            continue;
        } elseif ($i == 0) {
            echo $i2;
            continue;
        } elseif ($i2 == 0) {
            echo $i;
            continue;
        } elseif ($res % 2 == 0) {
            echo '<td>(' . $res . ')</td>';
        } elseif ($res % 2 != 0) {
            echo '<td>[' . $res . ']</td>';
        } else {
            echo $res;
        }
        echo "</td>";
    }
    echo "</tr>";
}



echo "</table>";