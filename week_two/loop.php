<?php

$count = 0;

while ($count <= 10) {

    echo "$count, ";
    $count++;

}

echo "<br>";
echo "<br>";

$i = 1;

while ($i <= 8) {
    echo "12 * $i = " . 8 * $i . "<br>";
    $i++;
}

echo "<br>";


$week = 3;
$day = 7;

for ($i = 1; $i <= $week; $i++) {

    echo "Week $i: <br>";

    for ($j = 1; $j <= $day; $j++) {
        echo "&nbsp; &nbsp;Day $j <br>";
        
    }

}



?>