<?php 

// Creating Associative Array using array() function

$student_info = array (
    "id" => 201,
    "name" => "Ahmed Hassan",
    "age" => 22,
    "address" => "Waberi District",
    "status" => "single",
    "weight" => 65.5
);

print_r ($student_info);

echo "<br>";

echo $student_info['address'];

echo "<br>";

// Creating Associative Array using manual indexing
$student_info["id"] = 201;
$student_info["name"] = "Abdi Hassan";
$student_info["age"] = 22;
$student_info["address"] = "Waberi District";
$student_info["status"] = "single";
$student_info["weight"] = 65.5;

print_r ($student_info);

echo "<br>";

foreach($student_info as $value) {
    echo "$value, ";
}

echo "<br>";

foreach($student_info as $key => $value) {
    echo "$key: $value <br>";
}

// Two Dimensional Array

$students = array (
    array (201, "Ahmed", 22, "single"),
    array (202, "Hassan", 25, "single"),
    array (203, "Abdi", 28, "married"),
    array (204, "Asha", 30, "single"),
    array (205, "Yusuf", 35, "married")
);

print_r($students);

echo "<br>";

echo $students[2][1]; // Display Abdi

echo "<br>";

echo $students[3][2]; // Display 30

echo "<br>";

foreach ($students as $info) {
    foreach ($info as $value) {
        echo "$value, ";
    }
    echo "<br>";
}

$students = array (
    array ("id"=>201, "name"=>"Ahmed", "age"=>22, "status"=>"single"),
    array ("id"=>202, "name"=>"Hassan", "age"=>25, "status"=>"single"),
    array ("id"=>203, "name"=>"Abdi", "age"=>28, "status"=>"married"),
    array ("id"=>204, "name"=>"Asha", "age"=>30, "status"=>"single"),
    array ("id"=>205, "name"=>"Yusuf", "age"=>35, "status"=>"married")
);

echo "<br>";

echo $students[2]["name"]; // Display Abdi

echo "<br>";

echo $students[3]["age"]; // Display 30

echo "<br>";

foreach ($students as $info) {
    foreach ($info as $key => $value) {
        echo "$key : $value ";
    }
    echo "<br>";
}



?>