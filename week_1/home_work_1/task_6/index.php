<?php

echo '<style>
body{background-color: rgba(171,184,186,0.72);}
table{margin: 0 auto;}
td{background: rgba(255,233,117,0.4); height: 50px; width: 50px; border: 1px solid #5679ff; text-align: center;}
</style>';

echo "<table>";
for ($i = 1; $i <= 10; $i++) {
    echo "<tr>";
    echo "<td>$i</td>";
    for ($a = 2; $a <= 10; $a++) {
        $res = $i * $a;
        if ($i == 1) {
            echo "<td>$a</td>";
        } elseif ($i % 2 == 0 && $a % 2 == 0) {
            echo '<td>(' . $res . ')</td>';
        } elseif ($i % 2 != 0 && $a % 2 != 0) {
            echo '<td>[' . $res . ']</td>';
        } else {
            echo "<td>$res</td>";
        }

    }
    echo "</tr>";
}
echo "</table>";