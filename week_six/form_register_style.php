
<?php

$success = false;

$errors = [];

$fullname = "";
$email = "";
$pob = "";
$gender = "";
$faculty = "";
$comment = "";

$selectedLanguages = [];

$facultyOptions = [
    "computer" => "Computer and IT",
    "medicine" => "Medicine and Health Science",
    "engineering" => "Engineering",
    "ecom" => "Business"
];

$languageOptions = ["Somali", "English", "Arabic", "Chinese"];

// Function to protect output
function clean($data) {
    return htmlspecialchars((string)$data, ENT_QUOTES, "UTF-8");
}

// Server-Side Validation
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect form data
    $fullname = trim($_POST["fullname"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $pob = trim($_POST["pob"] ?? "");
    $gender = $_POST["gender"] ?? "";
    $faculty = $_POST["faculty"] ?? "";
    $comment = trim($_POST["comment"] ?? "");

    $submittedLanguages = $_POST["languages"] ?? [];

    // Check fullname
    if (empty($fullname)) {
        $errors["fullname"] = "* Please fill fullname field!";
    }

    // Check email
    if (empty($email)) {
        $errors["email"] = "* Please fill email field!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "* Please enter a valid email!";
    }

    // Check gender
    if (!in_array($gender, ["male", "female"], true)) {
        $errors["gender"] = "* Please select gender!";
    }

    // Check faculty
    if (!array_key_exists($faculty, $facultyOptions)) {
        $errors["faculty"] = "* Please select a valid faculty!";
    }

 // Check languages
if (!is_array($submittedLanguages)) {
    $submittedLanguages = [];
}

$selectedLanguages = array_values(
    array_intersect($languageOptions, $submittedLanguages)
);

if (empty($selectedLanguages)) {
    $errors["languages"] = "* Please select at least one language!";
}
    // Check validation result
    if (empty($errors)) {
        $success = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<?php if ($success) { ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="alert alert-success">

                <h4>Student Information</h4>
                <hr>

                <table class="table table-bordered table-striped">

                    <tr>
                        <th>Fullname</th>
                        <td><?php echo clean($fullname); ?></td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td><?php echo clean($email); ?></td>
                    </tr>

                    <tr>
                        <th>Place of Birth</th>
                        <td><?php echo clean($pob); ?></td>
                    </tr>

                    <tr>
                        <th>Gender</th>
                        <td><?php echo clean($gender); ?></td>
                    </tr>

                    <tr>
                        <th>Faculty</th>
                        <td><?php echo clean($facultyOptions[$faculty]); ?></td>
                    </tr>

                    <tr>
                        <th>Languages</th>
                        <td>
                            <?php echo clean(implode(", ", $selectedLanguages)); ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Comment</th>
                        <td><?php echo clean($comment); ?></td>
                    </tr>

                </table>

            </div>

        </div>
    </div>
</div>

<?php } ?>

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center py-3">
                    <h2 class="mb-0">Student Registration Form</h2>
                </div>

                <div class="card-body">

                    <?php if (!empty($errors)) { ?>

                        <div class="alert alert-danger">
                            Please correct the errors below.
                        </div>

                    <?php } ?>

                    <form method="post" action="">

                        <fieldset>

                            <legend class="text-primary mb-3">
                                Personal Information
                            </legend>

                            <!-- Fullname -->
                            <div class="mb-3">

                                <label for="fullname" class="form-label">
                                    Fullname <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="fullname"
                                    name="fullname"
                                    placeholder="Enter your fullname"
                                    value="<?php echo clean($fullname); ?>"
                                >

                                <div class="text-danger small">
                                    <?php echo $errors["fullname"] ?? ""; ?>
                                </div>

                            </div>

                            <!-- Email -->
                            <div class="mb-3">

                                <label for="email" class="form-label">
                                    Email <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="Enter your email"
                                    value="<?php echo clean($email); ?>"
                                >

                                <div class="text-danger small">
                                    <?php echo $errors["email"] ?? ""; ?>
                                </div>

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
                                    value="<?php echo clean($pob); ?>"
                                >

                            </div>

                            <!-- Gender -->
                            <div class="mb-3">

                                <label class="form-label d-block">
                                    Gender
                                </label>

                                <div class="form-check form-check-inline">

                                    <input
                                        type="radio"
                                        class="form-check-input"
                                        id="male"
                                        name="gender"
                                        value="male"
                                        <?php if ($gender == "male") echo "checked"; ?>
                                    >

                                    <label for="male" class="form-check-label">
                                        Male
                                    </label>

                                </div>

                                <div class="form-check form-check-inline">

                                    <input
                                        type="radio"
                                        class="form-check-input"
                                        id="female"
                                        name="gender"
                                        value="female"
                                        <?php if ($gender == "female") echo "checked"; ?>
                                    >

                                    <label for="female" class="form-check-label">
                                        Female
                                    </label>

                                </div>

                                <div class="text-danger small">
                                    <?php echo $errors["gender"] ?? ""; ?>
                                </div>

                            </div>

                            <!-- Faculty -->
                            <div class="mb-3">

                                <label for="faculty" class="form-label">
                                    Faculty <span class="text-danger">*</span>
                                </label>

                                <select class="form-select" name="faculty" id="faculty">

                                    <option value="">Select Faculty</option>

                                    <?php foreach ($facultyOptions as $value => $label) { ?>

                                        <option
                                            value="<?php echo clean($value); ?>"
                                            <?php if ($faculty == $value) echo "selected"; ?>
                                        >
                                            <?php echo clean($label); ?>
                                        </option>

                                    <?php } ?>

                                </select>

                                <div class="text-danger small">
                                    <?php echo $errors["faculty"] ?? ""; ?>
                                </div>

                            </div>

                        <!-- Languages -->
<div class="mb-3">

    <label class="form-label d-block">
        Languages <span class="text-danger">*</span>
    </label>

    <?php foreach ($languageOptions as $language) { ?>

        <div class="form-check form-check-inline">

            <input
                type="checkbox"
                class="form-check-input"
                name="languages[]"
                id="<?php echo strtolower($language); ?>"
                value="<?php echo clean($language); ?>"
                <?php if (in_array($language, $selectedLanguages)) echo "checked"; ?>
            >

            <label
                class="form-check-label"
                for="<?php echo strtolower($language); ?>"
            >
                <?php echo clean($language); ?>
            </label>

        </div>

    <?php } ?>

    <div class="text-danger small">
        <?php echo $errors["languages"] ?? ""; ?>
    </div>

</div>

                            <!-- Comment -->
                            <div class="mb-4">

                                <label for="comment" class="form-label">
                                    Comment
                                </label>

                                <textarea
                                    class="form-control"
                                    name="comment"
                                    id="comment"
                                    rows="4"
                                    placeholder="Write your comment here..."
                                ><?php echo clean($comment); ?></textarea>

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
                    Student Registration System
                </div>

            </div>

        </div>
    </div>

</div>

</body>
</html>
