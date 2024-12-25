<?php
// Core
require_once "C:/xampp/htdocs/BackEnd_Projects/Employee-Management-System/app/dbconfig.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Employee-Management-System/app/functions.php";

// UI
require_once "C:/xampp/htdocs/BackEnd_Projects/Employee-Management-System/shared/head.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Employee-Management-System/shared/navbar.php";

auth();

// Add Department
$success_message = '';
$error_message = '';
$errors = [];

if (isset($_POST['submit'])) {
    // Filter And Validate New Department Data. 
    $department = filter_string($_POST['department']);

    if (string_validation($department, 2)) {
        $errors[] = "Department Name Is Required and It Must Be At Least 2 Characters.";
    }

    // Check If Errors Array Is Empty.
    // If True ==> Continue The Insertion Process.
    // Else ==> Skip The Insertion Process And Display The Contents Of Errors Array.
    if (empty($errors)) {
        $insert_query = "INSERT INTO `departments` VALUES (NULL, '$department')";
        try {
            $insert = mysqli_query($con, $insert_query);
            $success_message = "$department Department Added Successfully.";
        } catch (Exception $e) {
            $error_message = "$department Department Already Added.";
        }
    }
}

?>

<div class="container col-6 mt-5">
    <h1 class="text-center text-light">Add New Department</h1>
    <!-- Displaying Errors In Errors Array If Exist -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= $err ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <!-- Display No Change Message or Error Message If Exist -->
    <?php if (!empty($success_message)): ?>
        <div class="alert alert-success pt-3 pb-3"><?= $success_message ?></div>
    <?php elseif (!empty($error_message)): ?>
        <div class="alert alert-danger pt-3 pb-3"><?= $error_message ?></div>
    <?php endif; ?>
    <!-- Form To Add New Department -->
    <div class="card bg-dark text-light">
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="department" class="form-label">Department Name:</label>
                    <input type="text" placeholder="Department Name" name="department" id="department" class="form-control">
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

require_once "C:/xampp/htdocs/BackEnd_Projects/Employee-Management-System/shared/scripts.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Employee-Management-System/shared/footer.php";

?>