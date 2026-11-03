<?php
session_start();

header("Content-Type: application/json; charset=UTF-8");

// Helper function to return JSON response
function sendResponse($response, $statusCode = 200) {
    http_response_code($statusCode);
    echo json_encode($response);
    exit;
}

// Accept POST requests only
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    sendResponse([
        "success" => false,
        "message" => "Only POST requests are allowed."
    ], 405);
}

// CSRF protection
$sessionToken = $_SESSION["csrf_token"] ?? "";
$submittedToken = $_POST["csrf_token"] ?? "";

if (
    empty($sessionToken) ||
    empty($submittedToken) ||
    !hash_equals($sessionToken, $submittedToken)
) {
    sendResponse([
        "success" => false,
        "message" => "Invalid security token. Please refresh the page and try again."
    ], 403);
}

// Allowed form options
$facultyOptions = [
    "computer" => "Computer and IT",
    "medicine" => "Medicine and Health Science",
    "engineering" => "Engineering",
    "ecom" => "Business"
];

$languageOptions = ["Somali", "English", "Arabic", "Chinese"];

// Collect submitted data
$fullname = trim($_POST["fullname"] ?? "");
$email = trim($_POST["email"] ?? "");
$pob = trim($_POST["pob"] ?? "");
$gender = $_POST["gender"] ?? "";
$faculty = $_POST["faculty"] ?? "";
$comment = trim($_POST["comment"] ?? "");

$submittedLanguages = $_POST["languages"] ?? [];

$errors = [];

// Server-side validation: fullname
if ($fullname === "") {
    $errors["fullname"] = "* Please fill fullname field!";
}

// Server-side validation: email
if ($email === "") {
    $errors["email"] = "* Please fill email field!";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "* Please enter a valid email!";
}

// Server-side validation: gender
if (!in_array($gender, ["male", "female"], true)) {
    $errors["gender"] = "* Please select gender!";
}

// Server-side validation: faculty
if (!array_key_exists($faculty, $facultyOptions)) {
    $errors["faculty"] = "* Please select a valid faculty!";
}

// Server-side validation: languages
if (!is_array($submittedLanguages)) {
    $submittedLanguages = [];
}

$selectedLanguages = array_values(
    array_intersect($languageOptions, $submittedLanguages)
);

if (empty($selectedLanguages)) {
    $errors["languages"] = "* Please select at least one language!";
}

// Return validation errors as JSON
if (!empty($errors)) {
    sendResponse([
        "success" => false,
        "message" => "Please correct the errors and try again.",
        "errors" => $errors
    ]);
}

// Prepare student data
$student = [
    "fullname" => $fullname,
    "email" => $email,
    "pob" => $pob,
    "gender" => $gender,
    "faculty" => $facultyOptions[$faculty],
    "languages" => implode(", ", $selectedLanguages),
    "comment" => $comment
];

// Return successful JSON response
sendResponse([
    "success" => true,
    "message" => "Student registered successfully!",
    "data" => $student
]);
?>
