<br>

<?php
// Echo and Print
echo ("Welcome to PHP Programming");
echo "<br>";
print ("This is a PHP print example <br>");
echo "This Echo works without Parentheses";
echo "<br>";

echo "This is an output ", " with Two Parameters using echo";
// print "This is an output ", "Two Parameters using print"; Error

echo "<br>";

$x = 5;
$y = 4;

($x < $y) ? print "$x is less than $y" : print "$x is greater than $y";
// ($x < $y) ? echo "$x is less than $y" : echo "$x is greater than $y";

echo "<br>";
$x = 5;
echo "The current value of $x is <br>";
echo 'The current value of $x';
echo "<br>";

$a = 4;
$b = 5;
$c = $a + $b;

echo "The sum of $a and $b = $c";
echo "<br>";
echo 'The sum of $a and $b = $c';

// echo `The sum of $a and $b = $c`;

$student_number = 200;
$name = "Omar Ali";
$single = true;
$salary = 10.5;

echo "<br>";
Echo "Student ID: $student_number <br>";
Echo "Student Full Name: $name <br>";
Echo "Student Status: $single <br>";
Echo "Student Income: $salary <br>";

// echo var_dump($student_number);

Echo "Student ID:", var_dump($student_number), "<br>";
Echo "Student Full Name:", var_dump($name), "<br>";
Echo "Student Status:", var_dump($single), "<br>";
Echo "Student Income:", var_dump($salary), "<br>";
?>