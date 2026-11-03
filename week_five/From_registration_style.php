
<?php
session_start();

$errMsg = "";
$nameErr = "";
$emailErr = "";
$cvErr = "";
$certificateErr = "";
$uploadErr = "";

$fullname = "";
$email = "";
$pob = "";
$gender = "";
$position = "";
$languages = [];
$experience = "";

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function validateUpload($file, $allowedTypes, $label) {
    if (!isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        return "$label is required.";
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return "$label upload failed. Please try again.";
    }

    if ($file['size'] > 5 * 1024 * 1024) {
        return "$label must not exceed 5MB.";
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);

    if (!isset($allowedTypes[$mime])) {
        return "Invalid file type for $label.";
    }

    if (!is_uploaded_file($file['tmp_name'])) {
        return "Invalid upload for $label.";
    }

    return "";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pob = trim($_POST['pob'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $position = $_POST['faculty'] ?? '';
    $languages = $_POST['languages'] ?? [];
    $experience = trim($_POST['comment'] ?? '');

    if ($fullname === '') {
        $nameErr = "Please enter your full name.";
    } elseif (!preg_match("/^[\p{L}\s'-]+$/u", $fullname)) {
        $nameErr = "Name must contain letters only.";
    }

    if ($email === '') {
        $emailErr = "Please enter your email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Please enter a valid email address.";
    }

    // CV: PDF only
    $cvErr = validateUpload(
        $_FILES['cv'] ?? null,
        ['application/pdf' => 'pdf'],
        'CV'
    );

    // Certificate: PDF or PNG only
    $certificateErr = validateUpload(
        $_FILES['certificate'] ?? null,
        [
            'application/pdf' => 'pdf',
            'image/png' => 'png'
        ],
        'Certificate'
    );

    if (
        $nameErr !== '' ||
        $emailErr !== '' ||
        $cvErr !== '' ||
        $certificateErr !== ''
    ) {
        $errMsg = "Please correct the errors below.";
    } else {

        $uploadDir = __DIR__ . '/uploads/';

        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                $uploadErr = "Unable to create the uploads folder.";
            }
        }

        if ($uploadErr === '') {

            $cvMime = (new finfo(FILEINFO_MIME_TYPE))
                ->file($_FILES['cv']['tmp_name']);

            $certMime = (new finfo(FILEINFO_MIME_TYPE))
                ->file($_FILES['certificate']['tmp_name']);

            $cvName = bin2hex(random_bytes(16)) . '.pdf';

            $certificateExtension = $certMime === 'image/png'
                ? 'png'
                : 'pdf';

            $certificateName =
                bin2hex(random_bytes(16)) . '.' . $certificateExtension;

            $cvPath = $uploadDir . $cvName;
            $certificatePath = $uploadDir . $certificateName;

            $cvSaved = move_uploaded_file(
                $_FILES['cv']['tmp_name'],
                $cvPath
            );

            if (!$cvSaved) {
                $uploadErr = "Unable to save the CV.";
            } else {
                $certificateSaved = move_uploaded_file(
                    $_FILES['certificate']['tmp_name'],
                    $certificatePath
                );

                if (!$certificateSaved) {
                    @unlink($cvPath);
                    $uploadErr = "Unable to save the certificate.";
                }
            }

            if ($uploadErr === '') {

                $_SESSION['student_registration'] = [
                    'fullname' => $fullname,
                    'email' => $email,
                    'pob' => $pob,
                    'gender' => $gender,
                    'faculty' => $position,
                    'languages' => $languages,
                    'comment' => $experience,
                    'cv' => 'uploads/' . $cvName,
                    'certificate' => 'uploads/' . $certificateName
                ];

                header('Location: result.php');
                exit;
            }
        }

        if ($uploadErr !== '') {
            $errMsg = $uploadErr;
        }
    }
}

$positions = [
    'computer' => 'Computer and IT',
    'medicine' => 'Medicine and Health Science',
    'engineering' => 'Engineering',
    'ecom' => 'Business'
];

$skills = [
    'graphic_design' => 'Graphic Design',
    'Video_editing' => 'Video Editing',
    'translater' => 'Translation',
    'photogr' => 'Photography'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Job Application</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center py-3">
                    <h2 class="mb-0">Job Application</h2>
                </div>

                <div class="card-body">

                    <?php if ($errMsg !== ''): ?>
                        <div class="alert alert-danger">
                            <?= e($errMsg) ?>
                        </div>
                    <?php endif; ?>

                    <form
                        method="post"
                        action=""
                        enctype="multipart/form-data"
                    >

                        <fieldset>
                            <legend class="text-primary mb-3">
                                Position Application Form
                            </legend>

                            <!-- Full Name -->
                            <div class="mb-3">
                                <label for="fullname" class="form-label">
                                    Full Name <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="fullname"
                                    name="fullname"
                                    placeholder="Enter your full name"
                                    value="<?= e($fullname) ?>"
                                    required
                                >

                                <?php if ($nameErr !== ''): ?>
                                    <div class="text-danger small">
                                        <?= e($nameErr) ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    Email <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="Enter your email"
                                    value="<?= e($email) ?>"
                                    required
                                >

                                <?php if ($emailErr !== ''): ?>
                                    <div class="text-danger small">
                                        <?= e($emailErr) ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Place of Birth -->
                            <div class="mb-3">
                                <label for="pob" class="form-label">
                                    Place of Birth
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="pob"
                                    name="pob"
                                    placeholder="Enter your place of birth"
                                    value="<?= e($pob) ?>"
                                >
                            </div>

                            <!-- Gender -->
                            <div class="mb-3">
                                <label class="form-label d-block">
                                    Gender
                                </label>

                                <?php foreach (['male' => 'Male', 'female' => 'Female'] as $value => $label): ?>
                                    <div class="form-check form-check-inline">
                                        <input
                                            type="radio"
                                            class="form-check-input"
                                            id="<?= e($value) ?>"
                                            name="gender"
                                            value="<?= e($value) ?>"
                                            <?= $gender === $value ? 'checked' : '' ?>
                                        >

                                        <label
                                            for="<?= e($value) ?>"
                                            class="form-check-label"
                                        >
                                            <?= e($label) ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Position -->
                            <div class="mb-3">
                                <label for="faculty" class="form-label">
                                    Position
                                </label>

                                <select
                                    class="form-select"
                                    name="faculty"
                                    id="faculty"
                                >
                                    <option value="">Select a position</option>

                                    <?php foreach ($positions as $value => $label): ?>
                                        <option
                                            value="<?= e($value) ?>"
                                            <?= $position === $value ? 'selected' : '' ?>
                                        >
                                            <?= e($label) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Skills -->
                            <div class="mb-3">
                                <label class="form-label d-block">
                                    Skills
                                </label>

                                <?php foreach ($skills as $value => $label): ?>
                                    <div class="form-check form-check-inline">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            id="<?= e($value) ?>"
                                            name="languages[]"
                                            value="<?= e($value) ?>"
                                            <?= in_array($value, $languages, true) ? 'checked' : '' ?>
                                        >

                                        <label
                                            class="form-check-label"
                                            for="<?= e($value) ?>"
                                        >
                                            <?= e($label) ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Experience -->
                            <div class="mb-3">
                                <label for="comment" class="form-label">
                                    Years of Experience
                                </label>

                                <textarea
                                    class="form-control"
                                    name="comment"
                                    id="comment"
                                    rows="3"
                                    placeholder="Describe your experience"
                                ><?= e($experience) ?></textarea>
                            </div>

                            <!-- CV: PDF only -->
                            <div class="mb-3">
                                <label for="cv" class="form-label">
                                    Upload CV
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="file"
                                    class="form-control"
                                    id="cv"
                                    name="cv"
                                    accept=".pdf,application/pdf"
                                    required
                                >

                                <small class="text-muted">
                                    PDF only. Maximum size: 5MB.
                                </small>

                                <?php if ($cvErr !== ''): ?>
                                    <div class="text-danger small mt-1">
                                        <?= e($cvErr) ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Certificate: PDF or PNG only -->
                            <div class="mb-4">
                                <label for="certificate" class="form-label">
                                    Upload Certificate
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="file"
                                    class="form-control"
                                    id="certificate"
                                    name="certificate"
                                    accept=".pdf,.png,application/pdf,image/png"
                                    required
                                >

                                <small class="text-muted">
                                    PDF or PNG only. Maximum size: 5MB.
                                </small>

                                <?php if ($certificateErr !== ''): ?>
                                    <div class="text-danger small mt-1">
                                        <?= e($certificateErr) ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-2">
                                <button
                                    type="submit"
                                    name="submit"
                                    class="btn btn-primary"
                                >
                                    Register
                                </button>

                                <button
                                    type="reset"
                                    class="btn btn-outline-secondary"
                                >
                                    Clear
                                </button>
                            </div>

                        </fieldset>
                    </form>
                </div>

                <div class="card-footer text-center text-muted">
                    Job Application Form
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>
