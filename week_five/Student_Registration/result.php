
<?php
session_start();

// Check if student data exists
if (!isset($_SESSION['student_data']) || !is_array($_SESSION['student_data'])) {
    header("Location: register.php");
    exit;
}

// Get student data
$student = $_SESSION['student_data'];

// Escape output for security
function h($value) {
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
}

// Student information sections
$sections = [
    "Personal Information" => [
        "fullname" => "Full Name",
        "pob" => "Place of Birth",
        "dob" => "Date of Birth",
        "address" => "Address",
        "gender" => "Gender",
        "telephone" => "Telephone",
        "email" => "Email"
    ],

    "Parent Information" => [
        "parent_name" => "Parent Name",
        "parent_telephone" => "Parent Telephone",
        "relationship" => "Relationship"
    ],

    "Academic Information" => [
        "student_id" => "Student ID",
        "faculty" => "Faculty",
        "department" => "Department",
        "class" => "Class",
        "registration_date" => "Registration Date"
    ]
];

// Check student image
$imagePath = '';

if (!empty($student['image'])) {
    $imageFile = __DIR__ . '/' . $student['image'];

    if (is_file($imageFile)) {
        $imagePath = $student['image'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Registration Result</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body {
            background: #f5f3ff;
            font-family: Arial, sans-serif;
        }

        .page-header {
            background: linear-gradient(
                135deg,
                #312e81,
                #7c3aed
            );
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 25px;
        }

        .result-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
        }

        .section-heading {
            color: #4338ca;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 15px;
        }

        .student-photo {
            width: 145px;
            height: 145px;
            object-fit: cover;
            border-radius: 14px;
            border: 4px solid #ede9fe;
        }

        .table th {
            width: 38%;
            background: #ede9fe;
            color: #312e81;
        }

        .table td,
        .table th {
            padding: 12px;
            vertical-align: middle;
        }

        .btn-primary {
            background: #4338ca;
            border-color: #4338ca;
        }

        .btn-primary:hover {
            background: #7c3aed;
            border-color: #7c3aed;
        }

        @media print {

            body {
                background: white;
            }

            .no-print {
                display: none !important;
            }

            .result-card {
                box-shadow: none !important;
                break-inside: avoid;
            }

            .page-header {
                background: white !important;
                color: black !important;
                box-shadow: none !important;
            }

        }

    </style>

</head>

<body>

<div class="container py-4">

    <!-- Page Header -->
    <div class="page-header text-center shadow">

        <h2>Student Registration Result</h2>

        <p class="mb-0">
            Your registration information has been submitted successfully.
        </p>

    </div>


    <!-- Result Card -->
    <div class="card result-card shadow">

        <div class="card-body p-4">


            <!-- Student Summary: Image and Name -->
            <div class="d-flex align-items-center justify-content-center gap-4 flex-wrap mb-4">

                <!-- Student Image at Top -->
                <?php if ($imagePath !== ''): ?>

                    <img
                        src="<?= h($imagePath) ?>"
                        alt="Student Image"
                        class="student-photo"
                    >

                <?php endif; ?>


                <!-- Student Name and Details -->
                <div class="text-center">

                    <span class="badge bg-success mb-3">
                        Registration Successful
                    </span>

                    <h3 class="fw-bold">
                        <?= h($student['fullname'] ?? '') ?>
                    </h3>

                    <p class="text-muted mb-1">

                        Student ID:

                        <?= h($student['student_id'] ?? '') ?>

                    </p>

                    <p class="text-muted">

                        <?= h($student['faculty'] ?? '') ?>

                        -

                        <?= h($student['department'] ?? '') ?>

                    </p>

                </div>

            </div>


            <hr>


            <!-- Student Information Sections -->
            <?php foreach ($sections as $sectionTitle => $fields): ?>

                <h5 class="section-heading">

                    <?= h($sectionTitle) ?>

                </h5>


                <div class="table-responsive">

                    <table class="table table-bordered">

                        <tbody>

                            <?php foreach ($fields as $key => $label): ?>

                                <tr>

                                    <th>
                                        <?= h($label) ?>
                                    </th>

                                    <td>
                                        <?= h($student[$key] ?? '') ?>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php endforeach; ?>


            <!-- Student Image at Bottom -->
            <h5 class="section-heading">
                Student Image
            </h5>

            <div class="text-center mb-4">

                <?php if ($imagePath !== ''): ?>

                    <img
                        src="<?= h($imagePath) ?>"
                        alt="Student Image"
                        class="student-photo"
                    >

                <?php else: ?>

                    <p class="text-danger">
                        Student image is not available.
                    </p>

                <?php endif; ?>

            </div>


            <!-- Action Buttons -->
            <div class="text-center mt-4 no-print">

                <a href="register.php" class="btn btn-primary px-4">

                    Back to Registration

                </a>


                <button
                    type="button"
                    onclick="window.print()"
                    class="btn btn-success px-4 ms-2"
                >

                    Print Result

                </button>

            </div>


        </div>

    </div>

</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
