
<?php
session_start();

// Check whether student data exists
if (
    empty($_SESSION['student_data']) ||
    !is_array($_SESSION['student_data'])
) {
    header('Location: register.php');
    exit;
}

$student = $_SESSION['student_data'];

// Secure output to prevent HTML injection
function h($value) {
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES,
        'UTF-8'
    );
}

// Information sections
$sections = [
    'Personal Information' => [
        'Student Name' => 'fullname',
        'Place of Birth (POB)' => 'pob',
        'Date of Birth (DOB)' => 'dob',
        'Address' => 'address',
        'Gender' => 'gender',
        'Telephone' => 'telephone',
        'Email' => 'email'
    ],

    'Parent Information' => [
        'Parent Name' => 'parent_name',
        'Parent Telephone' => 'parent_telephone',
        'Relationship' => 'relationship'
    ],

    'Academic Information' => [
        'Student ID' => 'student_id',
        'Faculty' => 'faculty',
        'Department' => 'department',
        'Class' => 'class',
        'Registration Date' => 'registration_date'
    ]
];

// Check whether uploaded image exists
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

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Registration Result | JUST</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background: #f2f6fc;
            font-family: Arial, sans-serif;
        }

        .page-header {
            background: linear-gradient(
                135deg,
                #1e3a8a,
                #06b6d4
            );
            color: white;
        }

        .result-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
        }

        .section-heading {
            color: #1e3a8a;
            font-weight: bold;
        }

        .student-photo {
            width: 145px;
            height: 145px;
            object-fit: cover;
            border-radius: 14px;
            border: 4px solid #e9eef6;
        }

        .table th {
            width: 38%;
            background: #eaf2ff;
            color: #1e3a8a;
        }

        .btn-primary {
            background: #1e3a8a;
            border-color: #1e3a8a;
        }

        .btn-primary:hover {
            background: #06b6d4;
            border-color: #06b6d4;
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

<header class="page-header py-4 mb-4 shadow-sm">
    <div class="container">
       

        <h1 class="h3 mb-1">
            Student Registration Result
        </h1>

        <p class="mb-0">
            The submitted student information is shown below.
        </p>
    </div>
</header>

<main class="container pb-5">

    <!-- Student Summary -->
    <div class="card result-card shadow-sm mb-4">
        <div class="card-body p-4 d-flex flex-column flex-md-row align-items-center gap-4">

            <?php if ($imagePath !== ''): ?>
                <img
                    class="student-photo"
                    src="<?= h($imagePath) ?>"
                    alt="Student photo"
                >
            <?php endif; ?>

            <div class="text-center text-md-start">
                <span class="badge text-bg-success mb-2">
                    Registration Submitted
                </span>

                <h2 class="h4 mb-2">
                    <?= h($student['fullname'] ?? '') ?>
                </h2>

                <p class="text-secondary mb-1">
                    <strong>Student ID:</strong>
                    <?= h($student['student_id'] ?? '') ?>
                </p>

                <p class="text-secondary mb-0">
                    <?= h($student['faculty'] ?? '') ?>
                    &middot;
                    <?= h($student['department'] ?? '') ?>
                </p>
            </div>

        </div>
    </div>

    <!-- Display Information Sections -->
    <?php foreach ($sections as $sectionTitle => $fields): ?>

        <div class="card result-card shadow-sm mb-4">
            <div class="card-body p-4">

                <h2 class="h5 section-heading mb-3">
                    <?= h($sectionTitle) ?>
                </h2>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle mb-0">
                        <tbody>

                        <?php foreach ($fields as $label => $key): ?>
                            <tr>
                                <th scope="row">
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

            </div>
        </div>

    <?php endforeach; ?>

    <!-- Student Image -->
    <div class="card result-card shadow-sm mb-4">
        <div class="card-body p-4">

            <h2 class="h5 section-heading mb-3">
                Student Image
            </h2>

            <?php if ($imagePath !== ''): ?>

                <div class="mb-3">
                    <img
                        src="<?= h($imagePath) ?>"
                        alt="Uploaded student image"
                        class="student-photo"
                    >
                </div>

                <a
                    href="<?= h($imagePath) ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    View uploaded image in full size
                </a>

            <?php else: ?>

                <p class="text-secondary mb-0">
                    No image is available.
                </p>

            <?php endif; ?>

        </div>
    </div>

    <!-- Buttons -->
    <div class="no-print d-flex flex-column flex-sm-row gap-2 justify-content-between">

        <a
            href="register.php"
            class="btn btn-outline-primary"
        >
            Back to Registration Form
        </a>

        <button
            type="button"
            class="btn btn-primary"
            onclick="window.print()"
        >
            Print Result
        </button>

    </div>

    <p class="text-center text-secondary small mt-4">
        PHP &amp; MySQL &middot; Chapter 4 Forms Assignment
    </p>

</main>

</body>
</html>
