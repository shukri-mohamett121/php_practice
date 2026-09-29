
<?php

  ////QUESTION_ONE

  
echo "<h3 style = 'color : blue;'>QUESTION_ONE</h3>";

$num1 = 25;
$num2 = 10;
$num3 = 40;

if ($num1 >= $num2 && $num1 >= $num3) {
    $greatest = $num1;
} elseif ($num2 >= $num1 && $num2 >= $num3) {
    $greatest = $num2;
} else {
    $greatest = $num3;
}

if ($num1 <= $num2 && $num1 <= $num3) {
    $smallest = $num1;
} elseif ($num2 <= $num1 && $num2 <= $num3) {
    $smallest = $num2;
} else {
    $smallest = $num3;
}

echo "Greatest number is : " . $greatest . "<br>";
echo "Smallest number is : " . $smallest . "<br>";



///////QUESTION_TWO

 echo "<h3 style = 'color : blue;'>QUESTION_TWO</h3>";

$num = 6;

if ($num % 3 == 0 && $num % 5 == 0) {
    echo "The number is divisible by both 3 and 5.<br>";  
} elseif ($num % 3 == 0) {
    echo "The number is divisible by 3. <br>"; 
} elseif ($num % 5 == 0) {
    echo "The number is divisible by 5. <br>";  
} else {
    echo "The number is divisible by none of them.<br>"; 
    
}


    ///////QUESTION_Three

 echo "<h3 style = 'color : blue;'>QUESTION_THREE</h3>";
 
 echo"odd numbers from 2     to 20 :"; 
 echo "<br>";
 echo "<br>";
    for ($i = 2; $i <= 20; $i++) {
    if ($i % 2 != 0) {
        echo $i . "," ;
    } 
}

echo "<br>";
 echo "<br>";

echo"odd numbers from 35 to 7 :";
echo "<br>";
 echo "<br>";

for ($i = 35; $i >= 7; $i--) {
    if ($i % 2 == 0) {
        echo $i . ", ";
    }
}


echo "<br>";


 ///////QUESTION_Four

 echo "<h3 style = 'color : blue;'>QUESTION_FOUR</h3>";

 echo "<br>";
 echo "prints numbers divisible by 2 and 5 at the same time from 50 to 2.";
echo "<br>";
echo "<br>";

for ($i = 50; $i >= 2; $i--) {
    if ($i % 2 == 0 && $i % 5 == 0) {
        echo $i . ", ";
    }
}
 
 ///////QUESTION_Five

  echo "<h3 style = 'color : blue;'>QUESTION_FIVE</h3>";

$num = 12345;
$reverse = 0;

while ($num > 0) {
    $digit = $num % 10;
    $reverse = ($reverse * 10) + $digit;
    $num = (int)($num / 10);
}

echo "Reverse: " . $reverse;
echo "<br>";


 ///////QUESTION_Six

  echo "<h3 style = 'color : blue;'>QUESTION_SIX</h3>";
 $num1 = 10;
$num2 = 14;

$lcm = ($num1 > $num2) ? $num1 : $num2;

while (true) {
    if ($lcm % $num1 == 0 && $lcm % $num2 == 0) {
        break;
    }
    
    $lcm++;
}

echo " the LCM of $num1 and $num2 =" . $lcm;

echo "<br>";



 ///////QUESTION_Seven

  echo "<h3 style = 'color : blue;'>QUESTION_SEVEN</h3>";

 $num1 = 18;
$num2 = 24;

$hcf = 1;

for ($i = 1; $i <= $num1 && $i <= $num2; $i++) {
    if ($num1 % $i == 0 && $num2 % $i == 0) {
        $hcf = $i;
    }
}

echo " the HCF of $num1 and $num2 = " . $hcf;
echo "<br>";

///////QUESTION_Eighth
echo "<br><h3 style='color: blue;'>QUESTION_EIGHT</h3>";

 echo "<h1>Multiplication Table</h1>";

echo "<table border='10' cellpadding='10' cellspacing='0'>";

for ($i = 1; $i <= 12; $i++) {
    echo "<tr>";

    for ($j = 1; $j <= 12; $j++) {
        echo "<td>" . ($i * $j) . "</td>";
    }

    echo "</tr>";
}

echo "</table>";



echo "<br>";


 ///////QUESTION_Nine

  echo "<h3 style = 'color : blue;'>QUESTION_NINE</h3>";

 $num = 10;
$count = 0;

for ($i = 1; $i <= $num; $i++) {
    if ($num % $i == 0) {
        $count++;
    }
}

if ($count == 2) {
    echo "$num is a prime number.";
} else {
    echo "$num is a non-prime number.";
}
echo "<br>";


 ///////QUESTION_Ten
 echo "<h3 style = 'color : blue;'>QUESTION_TEN</h3>";

 echo "<br>";
 echo "prints prime numbers from 10 to 50. ";
 echo "<br>";
 echo "<br>";

for ($num = 10; $num <= 50; $num++) {
    $count = 0;

    for ($i = 1; $i <= $num; $i++) {
        if ($num % $i == 0) {
            $count++;
        }
    }

    if ($count == 2) {
        echo $num . ", ";
    }
}





?>
    