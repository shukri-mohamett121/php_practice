
<?php
session_start();

// Check whether form data exists
if (
    empty($_SESSION['student_registration']) ||
    !is_array($_SESSION['student_registration'])
) {
    header('Location: From_registration_style.php');
    exit;
}

$student = $_SESSION['student_registration'];

// Escape output to prevent HTML injection
function e($value)
{
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES,
        'UTF-8'
    );
}

// Display uploaded files safely
function displayFile($file, $label)
{
    if (empty($file)) {
        echo '<span class="text-muted">Not uploaded</span>';
        return;
    }

    // Uploaded file path stored in session
    $filePath = 'uploads/' . basename($file);

    if (!is_file(__DIR__ . '/' . $filePath)) {
        echo '<span class="text-danger">File not found</span>';
        return;
    }

    $extension = strtolower(
        pathinfo($filePath, PATHINFO_EXTENSION)
    );

    echo '<a class="btn btn-outline-primary btn-sm" 
             href="' . e($filePath) . '" 
             target="_blank" 
             rel="noopener noreferrer">';
    echo 'View ' . e($label);
    echo '</a> ';

    echo '<a class="btn btn-outline-success btn-sm" 
             href="' . e($filePath) . '" 
             download>';
    echo 'Download';
    echo '</a>';

    if ($label === 'Certificate' && $extension === 'png') {
        echo '<div class="mt-3">';
        echo '<img src="' . e($filePath) . '" 
                   alt="Certificate" 
                   class="img-fluid rounded border" 
                   style="max-width: 350px;">';
        echo '</div>';
    }
}

$fields = [
    'Full Name' => 'fullname',
    'Email Address' => 'email',
    'Place of Birth' => 'pob',
    'Gender' => 'gender',
    'Faculty / Position' => 'faculty',
    'Skills / Languages' => 'languages',
    'Experience / Comments' => 'comment'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Registration Result</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-9">

            <div class="card shadow border-0">

                <div class="card-header bg-primary text-white text-center py-4">
                    <h2 class="mb-1">Registration Successful</h2>
                    <p class="mb-0">
                        Your submitted information
                    </p>
                </div>

                <div class="card-body p-4">

                    <h4 class="mb-3">Personal Information</h4>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">

                            <tbody>
                            <?php foreach ($fields as $label => $key): ?>
                                <?php
                                $value = $student[$key] ?? '';

                                if (is_array($value)) {
                                    $value = implode(', ', $value);
                                }
                                ?>

                                <tr>
                                    <th style="width: 35%;">
                                        <?= e($label) ?>
                                    </th>

                                    <td>
                                        <?= $value !== ''
                                            ? nl2br(e($value))
                                            : '<span class="text-muted">Not provided</span>' ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>

                    <h4 class="mt-4 mb-3">Uploaded Documents</h4>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h5>CV (PDF only)</h5>

                            <?php
                            displayFile(
                                $student['cv'] ?? '',
                                'CV'
                            );
                            ?>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>Certificate (PDF or PNG)</h5>

                            <?php
                            displayFile(
                                $student['certificate'] ?? '',
                                'Certificate'
                            );
                            ?>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">

                        <a href="From_registration_style.php"
                           class="btn btn-primary">
                            Back to Registration
                        </a>

                        <button type="button"
                                onclick="window.print()"
                                class="btn btn-success">
                            Print Result
                        </button>

                    </div>

                </div>

                <div class="card-footer text-center text-muted">
                    Registration Form
                </div>

            </div>

        </div>
    </div>

</div>

</body>
</html>
