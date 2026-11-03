<?php
session_start();

// Create CSRF token
if (empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Student Registration System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h2 class="mb-0"> Student Registration System</h2>
                    
                </div>

                <div class="card-body">

                    <div id="responseMessage" class="mb-3"></div>

                    <form id="studentForm">
                        <input type="hidden" name="csrf_token"
                               value="<?php echo htmlspecialchars($_SESSION["csrf_token"], ENT_QUOTES, "UTF-8"); ?>">

                        <fieldset>
                            <legend class="text-primary mb-3">PERSONAL INFORMATION🤷‍♂️</legend>

                            <!-- Fullname -->
                            <div class="mb-3">
                                <label for="fullname" class="form-label">
                                    Fullname <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="fullname"
                                       name="fullname" placeholder="Enter your fullname">
                                <div id="fullnameError" class="text-danger small"></div>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="email"
                                       name="email" placeholder="Enter your email">
                                <div id="emailError" class="text-danger small"></div>
                            </div>

                            <!-- Place of Birth -->
                            <div class="mb-3">
                                <label for="pob" class="form-label">Place of Birth</label>
                                <input type="text" class="form-control" id="pob"
                                       name="pob" placeholder="Enter your place of birth">
                            </div>

                            <!-- Gender -->
                            <div class="mb-3">
                                <label class="form-label d-block">
                                    Gender <span class="text-danger">*</span>
                                </label>

                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input"
                                           id="male" name="gender" value="male">
                                    <label for="male" class="form-check-label">Male</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input"
                                           id="female" name="gender" value="female">
                                    <label for="female" class="form-check-label">Female</label>
                                </div>

                                <div id="genderError" class="text-danger small"></div>
                            </div>

                            <!-- Faculty -->
                            <div class="mb-3">
                                <label for="faculty" class="form-label">
                                    Faculty <span class="text-danger">*</span>
                                </label>

                                <select class="form-select" name="faculty" id="faculty">
                                    <option value="">Select Faculty</option>
                                    <option value="computer">Computer and IT</option>
                                    <option value="medicine">Medicine and Health Science</option>
                                    <option value="engineering">Engineering</option>
                                    <option value="ecom">Business</option>
                                </select>

                                <div id="facultyError" class="text-danger small"></div>
                            </div>

                            <!-- Languages -->
                            <div class="mb-3">
                                <label class="form-label d-block">
                                    Languages <span class="text-danger">*</span>
                                </label>

                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input"
                                           name="languages[]" id="somali" value="Somali">
                                    <label for="somali" class="form-check-label">Somali</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input"
                                           name="languages[]" id="english" value="English">
                                    <label for="english" class="form-check-label">English</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input"
                                           name="languages[]" id="arabic" value="Arabic">
                                    <label for="arabic" class="form-check-label">Arabic</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input"
                                           name="languages[]" id="chinese" value="Chinese">
                                    <label for="chinese" class="form-check-label">Chinese</label>
                                </div>

                                <div id="languagesError" class="text-danger small"></div>
                            </div>

                            <!-- Comment -->
                            <div class="mb-4">
                                <label for="comment" class="form-label">Comment</label>
                                <textarea class="form-control" name="comment" id="comment"
                                          rows="4" placeholder="Write your comment here..."></textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" id="submitBtn" class="btn btn-primary">
                                    Register
                                </button>
                                <button type="reset" id="clearBtn"
                                        class="btn btn-outline-secondary">
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

            <!-- Student Results -->
            <div class="card shadow mt-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Registered Students</h5>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Faculty</th>
                                <th>Languages</th>
                            </tr>
                        </thead>
                        <tbody id="studentTable">
                            <tr id="emptyRow">
                                <td colspan="5" class="text-center text-muted">
                                    No students registered yet.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function () {

    // jQuery event: form submit
    $("#studentForm").submit(function (event) {

        // Stop normal form submission and page reload
        event.preventDefault();

        // Clear previous errors
        $(".text-danger.small").text("");
        $("#responseMessage").text("");

        let isValid = true;

        // Basic client-side validation
        if ($.trim($("#fullname").val()) === "") {
            $("#fullnameError").text("Please enter fullname!");
            isValid = false;
        }

        let email = $.trim($("#email").val());
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email === "") {
            $("#emailError").text("Please enter email!");
            isValid = false;
        } else if (!emailPattern.test(email)) {
            $("#emailError").text("Please enter a valid email!");
            isValid = false;
        }

        if (!$("input[name='gender']:checked").val()) {
            $("#genderError").text("Please select gender!");
            isValid = false;
        }

        if ($("#faculty").val() === "") {
            $("#facultyError").text("Please select faculty!");
            isValid = false;
        }

        if ($("input[name='languages[]']:checked").length === 0) {
            $("#languagesError").text("Please select at least one language!");
            isValid = false;
        }

        // Do not send AJAX if client-side validation fails
        if (!isValid) {
            return;
        }

        // Disable button while request is processing
        $("#submitBtn").prop("disabled", true).text("Submitting...");

        // AJAX request
        $.ajax({
            url: "form_handling.php",
            type: "POST",
            data: $("#studentForm").serialize(),
            dataType: "json",

            // PHP response is received here
            success: function (response) {

                if (response.success) {

                    $("#responseMessage")
                        .removeClass("alert alert-danger")
                        .addClass("alert alert-success")
                        .text(response.message);

                    // Remove empty table message
                    $("#emptyRow").remove();

                    // Create table cells safely with .text()
                    let row = $("<tr>");

                    $("<td>").text(response.data.fullname).appendTo(row);
                    $("<td>").text(response.data.email).appendTo(row);
                    $("<td>").text(response.data.gender).appendTo(row);
                    $("<td>").text(response.data.faculty).appendTo(row);
                    $("<td>").text(response.data.languages).appendTo(row);

                    // Add new student without reloading page
                    $("#studentTable").append(row);

                    // Reset form after successful registration
                    $("#studentForm")[0].reset();

                } else {

                    // Display server-side validation errors
                    $("#fullnameError").text(response.errors.fullname || "");
                    $("#emailError").text(response.errors.email || "");
                    $("#genderError").text(response.errors.gender || "");
                    $("#facultyError").text(response.errors.faculty || "");
                    $("#languagesError").text(response.errors.languages || "");

                    $("#responseMessage")
                        .removeClass("alert alert-success")
                        .addClass("alert alert-danger")
                        .text(response.message);
                }
            },

            error: function (xhr) {
                let message = "An unexpected server error occurred.";

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }

                $("#responseMessage")
                    .removeClass("alert alert-success")
                    .addClass("alert alert-danger")
                    .text(message);
            },

            complete: function () {
                // Enable button after success or error
                $("#submitBtn").prop("disabled", false).text("Register");
            }
        });
    });

    // Clear error messages when the form is reset
    $("#clearBtn").click(function () {
        $(".text-danger.small").text("");
        $("#responseMessage").text("").removeClass("alert alert-success alert-danger");
    });

});
</script>

</body>
</html>
