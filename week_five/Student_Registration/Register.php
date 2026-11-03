
<?php
session_start();

$errors = [];
$values = [
    'fullname' => '',
    'pob' => '',
    'dob' => '',
    'address' => '',
    'gender' => '',
    'telephone' => '',
    'email' => '',
    'parent_name' => '',
    'parent_telephone' => '',
    'relationship' => '',
    'student_id' => '',
    'faculty' => '',
    'department' => '',
    'class' => '',
    'registration_date' => ''
];

$faculties = [
    'Faculty of Computer Science' => [
        'Computer Application',
        'Software Engineering',
        'Information Technology',
        'Computer Science',
        'Artificial Intelligence'
    ],
    'Faculty of Medicine' => [
        'General Medicine',
        'Nursing',
        'Public Health',
        'Medical Laboratory'
    ],
    'Faculty of Engineering' => [
        'Civil Engineering',
        'Electrical Engineering',
        'Mechanical Engineering'
    ],
    'Faculty of Business' => [
        'Business Administration',
        'Accounting',
        'Banking and Finance',
        'Marketing'
    ],
    'Faculty of Education' => [
        'English',
        'Mathematics',
        'Science Education'
    ],
    'Faculty of Sharia and Law' => [
        'Sharia',
        'Law',
        'Islamic Studies'
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($values as $key => $value) {
        if (isset($_POST[$key])) {
            $values[$key] = trim($_POST[$key]);
        }
    }

    // Personal Information validation
    if ($values['fullname'] === '') {
        $errors['fullname'] = 'Full name is required.';
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $values['fullname'])) {
        $errors['fullname'] = 'Name must contain letters and spaces only.';
    }

    if ($values['pob'] === '') {
        $errors['pob'] = 'Place of birth is required.';
    }

    if ($values['dob'] === '') {
        $errors['dob'] = 'Date of birth is required.';
    }

    if ($values['address'] === '') {
        $errors['address'] = 'Address is required.';
    }

    if ($values['gender'] === '') {
        $errors['gender'] = 'Please select your gender.';
    } elseif (!in_array($values['gender'], ['Male', 'Female'], true)) {
        $errors['gender'] = 'Please select a valid gender.';
    }

    if ($values['telephone'] === '') {
        $errors['telephone'] = 'Telephone is required.';
    }

    if ($values['email'] === '') {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    // Parent Information validation
    if ($values['parent_name'] === '') {
        $errors['parent_name'] = 'Parent name is required.';
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $values['parent_name'])) {
        $errors['parent_name'] = 'Parent name must contain letters and spaces only.';
    }

    if ($values['parent_telephone'] === '') {
        $errors['parent_telephone'] = 'Parent telephone is required.';
    }

    if ($values['relationship'] === '') {
        $errors['relationship'] = 'Relationship is required.';
    }

    // Academic Information validation
    if ($values['student_id'] === '') {
        $errors['student_id'] = 'Student ID is required.';
    }

    if ($values['faculty'] === '') {
        $errors['faculty'] = 'Please select a faculty.';
    } elseif (!array_key_exists($values['faculty'], $faculties)) {
        $errors['faculty'] = 'Please select a valid faculty.';
    }

    if ($values['department'] === '') {
        $errors['department'] = 'Please select a department.';
    } elseif (
        isset($faculties[$values['faculty']]) &&
        !in_array($values['department'], $faculties[$values['faculty']], true)
    ) {
        $errors['department'] = 'Please select a valid department.';
    }

    if ($values['class'] === '') {
        $errors['class'] = 'Class is required.';
    }

    if ($values['registration_date'] === '') {
        $errors['registration_date'] = 'Registration date is required.';
    }

    // Image validation
    $imageName = '';
    $mimeType = null;

    if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
        $errors['image'] = 'Student image is required.';
    } elseif ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errors['image'] = 'Image upload failed. Please try again.';
    } else {
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];

        $allowedMimeTypes = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp'
        ];

        $mimeType = mime_content_type($imageTmp);

        if (!isset($allowedMimeTypes[$mimeType]) || getimagesize($imageTmp) === false) {
            $errors['image'] = 'Only JPG, JPEG, PNG, GIF, and WEBP images are allowed.';
        } elseif ($imageSize > 2 * 1024 * 1024) {
            $errors['image'] = 'Image size must not exceed 2MB.';
        } else {
            $imageName = uniqid('student_', true) . '.' . $allowedMimeTypes[$mimeType];
        }
    }

    // Save image and continue if there are no validation errors
    if (empty($errors)) {
        $uploadDir = __DIR__ . '/upload_images/';

        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                $errors['image'] = 'Could not create the image upload folder.';
            }
        }

        if (empty($errors)) {
            $destination = $uploadDir . $imageName;

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                $errors['image'] = 'Unable to save the uploaded image.';
            } else {
                $values['image'] = 'upload_images/' . $imageName;
                $_SESSION['student_data'] = $values;

                header('Location: result.php');
                exit;
            }
        }
    }
}

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

$firstError = !empty($errors) ? array_key_first($errors) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #ede9fe, #f5f3ff);
            font-family: Arial, sans-serif;
            padding: 30px 0;
        }

        .registration-card {
            max-width: 950px;
            margin: auto;
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 8px 28px rgba(49, 46, 129, 0.12);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #312e81, #7c3aed);
            color: white;
            text-align: center;
            padding: 25px 15px;
        }

        .header h2 {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-content {
            padding: 30px;
        }

        .section-title {
            background: #ede9fe;
            color: #312e81;
            font-size: 18px;
            font-weight: bold;
            padding: 12px 15px;
            border-left: 5px solid #7c3aed;
            border-radius: 6px;
            margin: 25px 0 18px;
        }

        .form-label {
            font-weight: 600;
            color: #3730a3;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 10px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 0.2rem rgba(124, 58, 237, 0.15);
        }

        .btn-register {
            background: #4338ca;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: bold;
        }

        .btn-register:hover {
            background: #7c3aed;
            color: #ffffff;
        }

        .required {
            color: #dc3545;
        }

        .gender-box {
            padding: 10px 12px;
            border: 1px solid #ddd6fe;
            border-radius: 8px;
        }

        @media (max-width: 576px) {
            .form-content {
                padding: 18px;
            }

            body {
                padding: 12px;
            }
        }
    </style>
</head>

<body>

<div class="container">
    <div class="registration-card">

        <div class="header">
            <h2>Student Registration Form</h2>
            <p class="mb-0">Please complete all required fields</p>
        </div>

        <div class="form-content">

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <strong>Please correct the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach ($errors as $error): ?>
                            <li><?= e($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="register.php" method="POST" enctype="multipart/form-data" id="registrationForm" novalidate>

                <!-- Personal Information -->
                <div class="section-title">1. Personal Information</div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="fullname" class="form-label">Full Name <span class="required">*</span></label>
                        <input type="text" name="fullname" id="fullname"
                               class="form-control <?= isset($errors['fullname']) ? 'is-invalid' : '' ?>"
                               value="<?= e($values['fullname']) ?>" required>
                        <?php if (isset($errors['fullname'])): ?>
                            <div class="invalid-feedback"><?= e($errors['fullname']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="pob" class="form-label">Place of Birth <span class="required">*</span></label>
                        <input type="text" name="pob" id="pob"
                               class="form-control <?= isset($errors['pob']) ? 'is-invalid' : '' ?>"
                               value="<?= e($values['pob']) ?>" required>
                        <?php if (isset($errors['pob'])): ?>
                            <div class="invalid-feedback"><?= e($errors['pob']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="dob" class="form-label">Date of Birth <span class="required">*</span></label>
                        <input type="date" name="dob" id="dob"
                               class="form-control <?= isset($errors['dob']) ? 'is-invalid' : '' ?>"
                               value="<?= e($values['dob']) ?>" required>
                        <?php if (isset($errors['dob'])): ?>
                            <div class="invalid-feedback"><?= e($errors['dob']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="address" class="form-label">Address <span class="required">*</span></label>
                        <input type="text" name="address" id="address"
                               class="form-control <?= isset($errors['address']) ? 'is-invalid' : '' ?>"
                               value="<?= e($values['address']) ?>" required>
                        <?php if (isset($errors['address'])): ?>
                            <div class="invalid-feedback"><?= e($errors['address']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label d-block">Gender <span class="required">*</span></label>

                        <div class="gender-box <?= isset($errors['gender']) ? 'border-danger' : '' ?>">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"
                                       name="gender" id="gender_male" value="Male"
                                       <?= $values['gender'] === 'Male' ? 'checked' : '' ?> required>
                                <label class="form-check-label" for="gender_male">Male</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"
                                       name="gender" id="gender_female" value="Female"
                                       <?= $values['gender'] === 'Female' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="gender_female">Female</label>
                            </div>
                        </div>

                        <?php if (isset($errors['gender'])): ?>
                            <div class="text-danger small mt-1"><?= e($errors['gender']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="telephone" class="form-label">Telephone <span class="required">*</span></label>
                        <input type="tel" name="telephone" id="telephone"
                               class="form-control <?= isset($errors['telephone']) ? 'is-invalid' : '' ?>"
                               value="<?= e($values['telephone']) ?>" required>
                        <?php if (isset($errors['telephone'])): ?>
                            <div class="invalid-feedback"><?= e($errors['telephone']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email <span class="required">*</span></label>
                        <input type="email" name="email" id="email"
                               class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                               value="<?= e($values['email']) ?>" required>
                        <?php if (isset($errors['email'])): ?>
                            <div class="invalid-feedback"><?= e($errors['email']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label">Student Image <span class="required">*</span></label>
                        <input type="file" name="image" id="image"
                               class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>"
                               accept=".jpg,.jpeg,.png,.gif,.webp,image/jpeg,image/png,image/gif,image/webp" required>
                        <small class="text-muted">Allowed: JPG, JPEG, PNG, GIF, WEBP. Maximum size: 2MB.</small>
                        <?php if (isset($errors['image'])): ?>
                            <div class="text-danger small mt-1"><?= e($errors['image']) ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Parent Information -->
                <div class="section-title">2. Parent Information</div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="parent_name" class="form-label">Parent Name <span class="required">*</span></label>
                        <input type="text" name="parent_name" id="parent_name"
                               class="form-control <?= isset($errors['parent_name']) ? 'is-invalid' : '' ?>"
                               value="<?= e($values['parent_name']) ?>" required>
                        <?php if (isset($errors['parent_name'])): ?>
                            <div class="invalid-feedback"><?= e($errors['parent_name']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="parent_telephone" class="form-label">Parent Telephone <span class="required">*</span></label>
                        <input type="tel" name="parent_telephone" id="parent_telephone"
                               class="form-control <?= isset($errors['parent_telephone']) ? 'is-invalid' : '' ?>"
                               value="<?= e($values['parent_telephone']) ?>" required>
                        <?php if (isset($errors['parent_telephone'])): ?>
                            <div class="invalid-feedback"><?= e($errors['parent_telephone']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="relationship" class="form-label">Relationship <span class="required">*</span></label>
                        <select name="relationship" id="relationship"
                                class="form-select <?= isset($errors['relationship']) ? 'is-invalid' : '' ?>" required>
                            <option value="">-- Select Relationship --</option>
                            <?php foreach (['Father', 'Mother', 'Brother', 'Sister', 'Guardian', 'Other'] as $relationship): ?>
                                <option value="<?= e($relationship) ?>"
                                    <?= $values['relationship'] === $relationship ? 'selected' : '' ?>>
                                    <?= e($relationship) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($errors['relationship'])): ?>
                            <div class="invalid-feedback"><?= e($errors['relationship']) ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Academic Information -->
                <div class="section-title">3. Academic Information</div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="student_id" class="form-label">Student ID <span class="required">*</span></label>
                        <input type="text" name="student_id" id="student_id"
                               class="form-control <?= isset($errors['student_id']) ? 'is-invalid' : '' ?>"
                               value="<?= e($values['student_id']) ?>" required>
                        <?php if (isset($errors['student_id'])): ?>
                            <div class="invalid-feedback"><?= e($errors['student_id']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="faculty" class="form-label">Faculty <span class="required">*</span></label>
                        <select name="faculty" id="faculty"
                                class="form-select <?= isset($errors['faculty']) ? 'is-invalid' : '' ?>" required>
                            <option value="">-- Select Faculty --</option>
                            <?php foreach (array_keys($faculties) as $faculty): ?>
                                <option value="<?= e($faculty) ?>"
                                    <?= $values['faculty'] === $faculty ? 'selected' : '' ?>>
                                    <?= e($faculty) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($errors['faculty'])): ?>
                            <div class="invalid-feedback"><?= e($errors['faculty']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="department" class="form-label">Department <span class="required">*</span></label>
                        <select name="department" id="department"
                                class="form-select <?= isset($errors['department']) ? 'is-invalid' : '' ?>" required>
                            <option value="">-- Select Department --</option>
                            <?php
                            if (isset($faculties[$values['faculty']])) {
                                foreach ($faculties[$values['faculty']] as $department):
                            ?>
                                <option value="<?= e($department) ?>"
                                    <?= $values['department'] === $department ? 'selected' : '' ?>>
                                    <?= e($department) ?>
                                </option>
                            <?php
                                endforeach;
                            }
                            ?>
                        </select>
                        <?php if (isset($errors['department'])): ?>
                            <div class="invalid-feedback"><?= e($errors['department']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="class" class="form-label">Class <span class="required">*</span></label>
                        <input type="text" name="class" id="class"
                               class="form-control <?= isset($errors['class']) ? 'is-invalid' : '' ?>"
                               value="<?= e($values['class']) ?>" required>
                        <?php if (isset($errors['class'])): ?>
                            <div class="invalid-feedback"><?= e($errors['class']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="registration_date" class="form-label">Registration Date <span class="required">*</span></label>
                        <input type="date" name="registration_date" id="registration_date"
                               class="form-control <?= isset($errors['registration_date']) ? 'is-invalid' : '' ?>"
                               value="<?= e($values['registration_date']) ?>" required>
                        <?php if (isset($errors['registration_date'])): ?>
                            <div class="invalid-feedback"><?= e($errors['registration_date']) ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-register">
                        Register Student
                    </button>

                    <button type="reset" class="btn btn-outline-secondary ms-2">
                        Clear Form
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
const facultySelect = document.getElementById('faculty');
const departmentSelect = document.getElementById('department');

const departments = <?= json_encode($faculties, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;

facultySelect.addEventListener('change', function () {
    const selectedFaculty = this.value;
    const currentDepartment = departmentSelect.value;

    departmentSelect.innerHTML = '<option value="">-- Select Department --</option>';

    if (departments[selectedFaculty]) {
        departments[selectedFaculty].forEach(function (department) {
            const option = document.createElement('option');
            option.value = department;
            option.textContent = department;
            departmentSelect.appendChild(option);
        });
    }

    departmentSelect.value = currentDepartment;
});

<?php if (!empty($firstError)): ?>
document.addEventListener('DOMContentLoaded', function () {
    const errorFieldMap = {
        gender: 'gender_male'
    };

    const fieldId = errorFieldMap[<?= json_encode($firstError) ?>] || <?= json_encode($firstError) ?>;
    const field = document.getElementById(fieldId);

    if (field) {
        field.focus();
        field.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});
<?php endif; ?>
</script>

</body>
</html>
