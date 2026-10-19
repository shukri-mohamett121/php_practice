<?php

echo("<h1 style='color:green'> NAME: Shukri Mohamett Omar</h1>");
echo("<h1 style='color:green '> ID: c1230238</h1>");

/* =========================================================
   QUESTION 1
========================================================= */

$numbers = array(5, -7, 12, 10, -7, 11, -6, 12, 1, -7, 2, 9);

$totalQ1 = 0;
$evenTotal = 0;
$oddTotal = 0;

foreach ($numbers as $number) {

    $totalQ1 += $number;

    if ($number % 2 == 0) {
        $evenTotal += $number;
    }

    if ($number % 2 != 0) {
        $oddTotal += $number;
    }
}

$min = min($numbers);
$max = max($numbers);


/* =========================================================
   QUESTION 2
========================================================= */

$colors = [

    "Light" => [
        "Red" => "Light Red",
        "Green" => "Light Green",
        "Blue" => "Light Blue"
    ],

    "Normal" => [
        "Red" => "Normal Red",
        "Green" => "Normal Green",
        "Blue" => "Normal Blue"
    ],

    "Dark" => [
        "Red" => "Dark Red",
        "Green" => "Dark Green",
        "Blue" => "Dark Blue"
    ]

];


/* =========================================================
   QUESTION 3
========================================================= */

$array = [

    [2, -6, 8],
    [-6, 1, 6],
    [7, 8, -6]

];

$rows = count($array);
$cols = count($array[0]);

$odd = 0;
$even = 0;
$totalQ3 = 0;

foreach ($array as $row) {

    foreach ($row as $value) {

        $totalQ3 += $value;

        if ($value % 2 == 0) {
            $even++;
        } else {
            $odd++;
        }
    }
}


/* Row totals */

$rowTotal = [];

for ($i = 0; $i < $rows; $i++) {

    $rowTotal[$i] = 0;

    for ($j = 0; $j < $cols; $j++) {

        $rowTotal[$i] += $array[$i][$j];

    }
}


/* Column totals */

$columnTotal = [];

for ($j = 0; $j < $cols; $j++) {

    $columnTotal[$j] = 0;

    for ($i = 0; $i < $rows; $i++) {

        $columnTotal[$j] += $array[$i][$j];

    }
}


/* Diagonals */

$mainDiagonal = 0;
$secondDiagonal = 0;

for ($i = 0; $i < $rows; $i++) {

    $mainDiagonal += $array[$i][$i];

    $secondDiagonal += $array[$i][$cols - 1 - $i];

}


/* Minimum */

$min3 = $array[0][0];
$minPositions = [];

for ($i = 0; $i < $rows; $i++) {

    for ($j = 0; $j < $cols; $j++) {

        if ($array[$i][$j] < $min3) {

            $min3 = $array[$i][$j];

            $minPositions = [[$i, $j]];

        } elseif ($array[$i][$j] == $min3) {

            $minPositions[] = [$i, $j];

        }
    }
}


/* Maximum */

$max3 = $array[0][0];
$maxPositions = [];

for ($i = 0; $i < $rows; $i++) {

    for ($j = 0; $j < $cols; $j++) {

        if ($array[$i][$j] > $max3) {

            $max3 = $array[$i][$j];

            $maxPositions = [[$i, $j]];

        } elseif ($array[$i][$j] == $max3) {

            $maxPositions[] = [$i, $j];

        }
    }
}


/* =========================================================
   STUDENTS
========================================================= */

$students = [

    "CA202" => [
        "Name" => "Mohamed Ahmed Ali",
        "Phone" => "0648440403",
        "Address" => "Laba Dhagax, Wardhiigley"
    ],

    "CA207" => [
        "Name" => "Ahmed Abdi Jama",
        "Phone" => "0647223201",
        "Address" => "Taleex, Hodan"
    ],

    "CA202_2" => [
        "Name" => "Amina Nur Adan",
        "Phone" => "0646990276",
        "Address" => "Macmacaanka, Dharkenley"
    ]

];


/* =========================================================
   TRANSCRIPT - 8 SEMESTERS
========================================================= */

$transcript = [

    "Semester 1" => [

        "subject1" => [
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 40
        ],

        "subject2" => [
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 40
        ],

        "subject3" => [
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 40
        ]

    ],


    "Semester 2" => [

        "subject1" => [
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 0
        ],

        "subject2" => [
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 40
        ],

        "subject3" => [
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 40
        ]

    ],
 
    

];

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>PHP Assignment 2</title>


<style>

/* =========================================================
   GENERAL
========================================================= */

* {
    box-sizing: border-box;
}

body {

    margin: 0;

    padding: 40px 15px;

    font-family: Arial, Helvetica, sans-serif;

    background:
        linear-gradient(135deg, #eef2ff, #f8fafc);

    color: #1e293b;

}

.container {

    width: 100%;

    max-width: 1050px;

    margin: auto;

}


/* =========================================================
   MAIN TITLE
========================================================= */

.main-title {

    text-align: center;

    margin-bottom: 40px;

}

.main-title h1 {

    font-size: 38px;

    margin: 0;

    font-weight: 800;

    background:
        linear-gradient(90deg, #2563eb, #7c3aed, #db2777);

    -webkit-background-clip: text;

    -webkit-text-fill-color: transparent;

}

.main-title p {

    color: #64748b;

    font-size: 16px;

    margin-top: 10px;

}


/* =========================================================
   GENERAL SECTION
========================================================= */

.section {

    margin-bottom: 35px;

    padding: 30px;

    border-radius: 20px;

    box-shadow:
        0 10px 30px rgba(0, 0, 0, 0.08);

}

.section-title {

    text-align: center;

    font-size: 27px;

    margin-top: 0;

    margin-bottom: 28px;

}


/* =========================================================
   QUESTION 1 - BLUE
========================================================= */

.question-one {

    background:
        linear-gradient(135deg, #eff6ff, #dbeafe);

    border: 2px solid #bfdbfe;

}

.question-one .section-title {

    color: #1d4ed8;

}


.all-elements {

    background: white;

    border: 1px solid #93c5fd;

    border-radius: 13px;

    padding: 20px;

    margin-bottom: 20px;

    text-align: center;

    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.08);

}

.all-elements-title {

    display: block;

    color: #1e40af;

    font-size: 16px;

    font-weight: bold;

    margin-bottom: 15px;

}

.number-list {

    display: flex;

    flex-wrap: wrap;

    justify-content: center;

    gap: 10px;

}

.number {

    min-width: 52px;

    padding: 12px 10px;

    border-radius: 10px;

    background: #eff6ff;

    border: 1px solid #93c5fd;

    color: #1e40af;

    font-weight: bold;

    transition: 0.2s;

}

.number:hover {

    transform: translateY(-3px);

    background: #2563eb;

    color: white;

}


.result-grid {

    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: 15px;

}

.result-box {

    background: white;

    padding: 20px;

    border-radius: 13px;

    text-align: center;

    border: 1px solid #bfdbfe;

    box-shadow: 0 4px 10px rgba(37, 99, 235, 0.06);

}

.result-box span {

    display: block;

    color: #64748b;

    font-size: 14px;

    margin-bottom: 8px;

}

.result-box strong {

    font-size: 25px;

    color: #1d4ed8;

}


.position-grid {

    display: grid;

    grid-template-columns: repeat(2, 1fr);

    gap: 15px;

    margin-top: 15px;

}

.position-box {

    background: white;

    padding: 20px;

    border-radius: 13px;

    text-align: center;

    border: 1px solid #bfdbfe;

    box-shadow: 0 4px 10px rgba(37, 99, 235, 0.06);

}

.position-box .label {

    display: block;

    color: #64748b;

    font-size: 14px;

    margin-bottom: 8px;

}

.position-box strong {

    display: block;

    font-size: 25px;

    color: #1d4ed8;

    margin-bottom: 8px;

}

.position-box small {

    color: #475569;

    font-size: 14px;

}


/* =========================================================
   QUESTION 2
========================================================= */

.question-two {

    background:
        linear-gradient(135deg, #f0fdf4, #dcfce7);

    border: 2px solid #bbf7d0;

}

.question-two .section-title {

    color: #15803d;

}


/* =========================================================
   QUESTION 3
========================================================= */

.question-three {

    background:
        linear-gradient(135deg, #faf5ff, #f3e8ff);

    border: 2px solid #e9d5ff;

}

.question-three .section-title {

    color: #7e22ce;

}

.q3-summary {

    display: flex;

    justify-content: center;

    gap: 20px;

    margin-bottom: 25px;

}

.q3-box {

    width: 190px;

    padding: 18px;

    text-align: center;

    background: white;

    border-radius: 13px;

    border: 1px solid #d8b4fe;

}

.q3-box strong {

    display: block;

    font-size: 27px;

    color: #7e22ce;

    margin-top: 6px;

}

.q3-results {

    margin-top: 25px;

    display: grid;

    grid-template-columns: repeat(2, 1fr);

    gap: 15px;

}

.q3-result {

    padding: 18px;

    text-align: center;

    background: white;

    border-radius: 12px;

    border: 1px solid #ddd6fe;

}

.q3-result strong {

    color: #7e22ce;

}


/* =========================================================
   TABLE
========================================================= */

.table-wrapper {

    width: 100%;

    overflow-x: auto;

}

table {

    width: 100%;

    border-collapse: separate;

    border-spacing: 0;

    overflow: hidden;

    border-radius: 12px;

}

th {

    padding: 15px;

    color: white;

    font-size: 15px;

    text-align: center;

}

td {

    padding: 14px;

    text-align: center;

    font-size: 15px;

    background: white;

    border-bottom: 1px solid #e5e7eb;

}

tr:last-child td {

    border-bottom: none;

}


.question-two th {

    background: #16a34a;

}

.question-two tr:hover td {

    background: #f0fdf4;

}


.question-three th {

    background: #7e22ce;

}

.question-three tr:hover td {

    background: #faf5ff;

}

.matrix td {

    font-size: 19px;

    font-weight: bold;

}

.total-cell {

    background: #ede9fe !important;

    color: #6b21a8;

    font-weight: bold;

}


/* =========================================================
   STUDENTS
========================================================= */

.students-section {

    background:
        linear-gradient(135deg, #fff7ed, #ffedd5);

    border: 2px solid #fed7aa;

}

.students-section .section-title {

    color: #c2410c;

}

.students-section th {

    background: #ea580c;

}

.students-section tr:hover td {

    background: #fff7ed;

}


/* =========================================================
   TRANSCRIPT
========================================================= */

.transcript-section {

    background:
        linear-gradient(135deg, #fff1f2, #fce7f3);

    border: 2px solid #fecdd3;

}

.transcript-section .section-title {

    color: #be123c;

}

.transcript-section th {

    background: #be123c;

}

.transcript-section tr:hover td {

    background: #fff1f2;

}

.pass {

    color: #15803d;

    font-weight: bold;

    background: #dcfce7 !important;

}

.fail {

    color: #dc2626;

    font-weight: bold;

    background: #fee2e2 !important;

}


/* =========================================================
   FOOTER
========================================================= */

.footer {

    text-align: center;

    padding: 15px;

    color: #64748b;

    font-size: 14px;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 700px) {

    body {

        padding: 20px 10px;

    }

    .section {

        padding: 20px;

    }

    .main-title h1 {

        font-size: 30px;

    }

    .result-grid {

        grid-template-columns: 1fr;

    }

    .position-grid {

        grid-template-columns: 1fr;

    }

    .q3-summary {

        flex-direction: column;

        align-items: center;

    }

    .q3-box {

        width: 100%;

    }

    .q3-results {

        grid-template-columns: 1fr;

    }

}

</style>

</head>


<body>


<div class="container">


<!-- =====================================================
     MAIN TITLE
===================================================== -->

<div class="main-title">

    <h1>PHP Assignment 2</h1>

</div>


<!-- =====================================================
     QUESTION 1
===================================================== -->

<div class="section question-one">

    <h2 class="section-title">
        Question 1
    </h2>


    <div class="all-elements">

        <span class="all-elements-title">
            All array elements:
        </span>

        <div class="number-list">

            <?php

            foreach ($numbers as $number) {

                echo "<div class='number'>$number</div>";

            }

            ?>

        </div>

    </div>


    <div class="result-grid">


        <div class="result-box">

            <span>
                Total of all elements
            </span>

            <strong>
                <?php echo $totalQ1; ?>
            </strong>

        </div>


        <div class="result-box">

            <span>
                Total of even elements
            </span>

            <strong>
                <?php echo $evenTotal; ?>
            </strong>

        </div>


        <div class="result-box">

            <span>
                Total of odd elements
            </span>

            <strong>
                <?php echo $oddTotal; ?>
            </strong>

        </div>


    </div>


    <div class="position-grid">


        <div class="position-box">

            <span class="label">
                Minimum element
            </span>

            <strong>
                <?php echo $min; ?>
            </strong>

            <small>

                Minimum positions:

                <?php

                foreach ($numbers as $index => $number) {

                    if ($number == $min) {

                        echo ($index + 1) . " ";

                    }

                }

                ?>

            </small>

        </div>


        <div class="position-box">

            <span class="label">
                Maximum element
            </span>

            <strong>
                <?php echo $max; ?>
            </strong>

            <small>

                Maximum positions:

                <?php

                foreach ($numbers as $index => $number) {

                    if ($number == $max) {

                        echo ($index + 1) . " ";

                    }

                }

                ?>

            </small>

        </div>


    </div>

</div>


<!-- =====================================================
     QUESTION 2
===================================================== -->

<div class="section question-two">

    <h2 class="section-title">
        Question 2
    </h2>


    <div class="table-wrapper">

        <table>

            <tr>

                <th></th>

                <th>Red</th>

                <th>Green</th>

                <th>Blue</th>

            </tr>


            <?php

            foreach ($colors as $rowName => $row) {

                echo "<tr>";

                echo "<th>$rowName</th>";

                foreach ($row as $value) {

                    echo "<td>$value</td>";

                }

                echo "</tr>";

            }

            ?>

        </table>

    </div>

</div>


<!-- =====================================================
     QUESTION 3
===================================================== -->

<div class="section question-three">

    <h2 class="section-title">
        Question 3
    </h2>


    <div class="q3-summary">


        <div class="q3-box">

            Odd Elements

            <strong>
                <?php echo $odd; ?>
            </strong>

        </div>


        <div class="q3-box">

            Even Elements

            <strong>
                <?php echo $even; ?>
            </strong>

        </div>


    </div>


    <div class="table-wrapper">

        <table class="matrix">


            <tr>

                <th>Matrix</th>

                <th>Column 1</th>

                <th>Column 2</th>

                <th>Column 3</th>

                <th>Row Total</th>

            </tr>


            <tr>

                <th>Row 1</th>

                <td>
                    <?php echo $array[0][0]; ?>
                </td>

                <td>
                    <?php echo $array[0][1]; ?>
                </td>

                <td>
                    <?php echo $array[0][2]; ?>
                </td>

                <td class="total-cell">
                    <?php echo $rowTotal[0]; ?>
                </td>

            </tr>


            <tr>

                <th>Row 2</th>

                <td>
                    <?php echo $array[1][0]; ?>
                </td>

                <td>
                    <?php echo $array[1][1]; ?>
                </td>

                <td>
                    <?php echo $array[1][2]; ?>
                </td>

                <td class="total-cell">
                    <?php echo $rowTotal[1]; ?>
                </td>

            </tr>


            <tr>

                <th>Row 3</th>

                <td>
                    <?php echo $array[2][0]; ?>
                </td>

                <td>
                    <?php echo $array[2][1]; ?>
                </td>

                <td>
                    <?php echo $array[2][2]; ?>
                </td>

                <td class="total-cell">
                    <?php echo $rowTotal[2]; ?>
                </td>

            </tr>


            <tr>

                <th>Column Total</th>

                <td class="total-cell">
                    <?php echo $columnTotal[0]; ?>
                </td>

                <td class="total-cell">
                    <?php echo $columnTotal[1]; ?>
                </td>

                <td class="total-cell">
                    <?php echo $columnTotal[2]; ?>
                </td>

                <td class="total-cell">
                    <?php echo $totalQ3; ?>
                </td>

            </tr>


        </table>

    </div>


    <div class="q3-results">


        <div class="q3-result">

            <strong>Main Diagonal</strong>

            <br><br>

            <?php echo $mainDiagonal; ?>

        </div>


        <div class="q3-result">

            <strong>Second Diagonal</strong>

            <br><br>

            <?php echo $secondDiagonal; ?>

        </div>


        <div class="q3-result">

            <strong>Total All Elements</strong>

            <br><br>

            <?php echo $totalQ3; ?>

        </div>


        <div class="q3-result">

            <strong>Minimum Element</strong>

            <br><br>

            <?php echo $min3; ?>

            <br>

            Positions:

            <?php

            foreach ($minPositions as $position) {

                echo "[" .
                    $position[0] .
                    "," .
                    $position[1] .
                    "] ";

            }

            ?>

        </div>


        <div class="q3-result">

            <strong>Maximum Element</strong>

            <br><br>

            <?php echo $max3; ?>

            <br>

            Positions:

            <?php

            foreach ($maxPositions as $position) {

                echo "[" .
                    $position[0] .
                    "," .
                    $position[1] .
                    "] ";

            }

            ?>

        </div>


    </div>

</div>


<!-- =====================================================
     QUESTION 4
===================================================== -->

<div class="section students-section">

    <h2 class="section-title">
        Question 4
    </h2>


    <h2 class="section-title">
        Student Information
    </h2>


    <div class="table-wrapper">

        <table>


            <tr>

                <th>Student ID</th>

                <th>Name</th>

                <th>Phone</th>

                <th>Address</th>

            </tr>


            <?php

            foreach ($students as $id => $student) {

                echo "<tr>";

                echo "<td><strong>$id</strong></td>";

                echo "<td>" .
                    $student["Name"] .
                    "</td>";

                echo "<td>" .
                    $student["Phone"] .
                    "</td>";

                echo "<td>" .
                    $student["Address"] .
                    "</td>";

                echo "</tr>";

            }

            ?>


        </table>

    </div>

</div>


<!-- =====================================================
     QUESTION 5
===================================================== -->

<div class="section transcript-section">

    <h2 class="section-title">
        Question 5
    </h2>


    <h2 class="section-title">
        Student Transcript
    </h2>


    <div class="table-wrapper">

        <table>


            <tr>

                <th>Semester</th>

                <th>Course</th>

                <th>CW1</th>

                <th>MidTerm</th>

                <th>CW2</th>

                <th>Final</th>

                <th>Total</th>

                <th>Status</th>

            </tr>


            <?php

            foreach ($transcript as $semester => $courses) {

                $firstCourse = true;

                $courseCount = count($courses);

                foreach ($courses as $course => $marks) {

                    $courseTotal =
                        $marks["CW1"] +
                        $marks["MidTerm"] +
                        $marks["CW2"] +
                        $marks["Final"];


                    if ($courseTotal >= 50) {

                        $status = "Pass";

                        $statusClass = "pass";

                    } else {

                        $status = "Fail";

                        $statusClass = "fail";

                    }


                    echo "<tr>";


                    if ($firstCourse) {

                        echo "<td rowspan='$courseCount'><strong>$semester</strong></td>";

                        $firstCourse = false;

                    }


                    echo "<td>$course</td>";

                    echo "<td>" .
                        $marks["CW1"] .
                        "</td>";

                    echo "<td>" .
                        $marks["MidTerm"] .
                        "</td>";

                    echo "<td>" .
                        $marks["CW2"] .
                        "</td>";

                    echo "<td>" .
                        $marks["Final"] .
                        "</td>";

                    echo "<td><strong>" .
                        $courseTotal .
                        "</strong></td>";

                    echo "<td class='$statusClass'>" .
                        $status .
                        "</td>";


                    echo "</tr>";

                }

            }

            ?>


        </table>

    </div>

</div>


<div class="footer">

    <h1 style="color:green">
        Shukri mohamett
    </h1>

</div>


</div>

</body>

</html>