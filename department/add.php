<?php
// Core
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/app/dbconfig.php";

// UI
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/head.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/navbar.php";

// Add Department
$success_message = '';
$error_message = '';
if (isset($_POST['submit'])) {
    $department = $_POST['department'];
    $insert_query = "INSERT INTO `departments` VALUES (NULL, '$department')";
    try {
        $insert = mysqli_query($con, $insert_query);
        $success_message = "$department Department Added Successfully.";
    } catch (Exception $e) {
        $error_message = "$department Department Already Added.";
    }
}

?>

<div class="container col-6 mt-5">
    <h1 class="text-center text-light">Add New Department</h1>
    <!-- PHP Conditions After Submiting The Form To Output The Message Either Success Or Failing -->
    <?php if (!empty($success_message) && empty($error_message)): ?>
        <div class="alert alert-success pt-3 pb-3"><?= $success_message ?></div>
    <?php elseif (!empty($error_message)  && empty($success_message)): ?>
        <div class="alert alert-danger pt-3 pb-3"><?= $error_message ?></div>
    <?php endif; ?>
    <!-- Form To Add New Department -->
    <div class="card bg-dark text-light">
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="department" class="form-label">Department Name:</label>
                    <input type="text" name="department" id="department" class="form-control">
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/scripts.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/footer.php";

?>