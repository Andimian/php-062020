<?php

define('TOTAL_DRAWINGS', 80);
define('PENSILS', 40);
define('CRAYONS', 23);

echo "На школьной выставке " . TOTAL_DRAWINGS . " рисунков. " . CRAYONS ." из них выполнены
фломастерами, " . PENSILS . " карандашами, а остальные — красками. Сколько рисунков, выполненные
красками, на школьной выставке ?" . '<br>';
$paints = TOTAL_DRAWINGS - PENSILS - CRAYONS;
echo "Ответ: красками выполнено $paints рисунокв";