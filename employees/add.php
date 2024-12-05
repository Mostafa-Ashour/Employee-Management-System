<?php
// Core
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/app/dbconfig.php";

// UI
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/head.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/navbar.php";

// Add Employee

$all_departments = "SELECT * FROM `departments`;";
$departments = mysqli_query($con, $all_departments);

$success_message = '';
$error_message = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];
    $department_id = $_POST['department'];
    $insert_query = "INSERT INTO `employees` VALUES (NULL, '$name', '$email', '$phone', $salary, $department_id)";
    try {
        $insert = mysqli_query($con, $insert_query);
        $success_message = "$name Added Successfully.";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        if (str_contains($error_message, "employees_email_uq")) {
            $error_message = "The Email Address $email Already In Use.";
        } elseif (str_contains($error_message, "employees_phone_uq")) {
            $error_message = "The Phone Number $phone Already In Use.";
        }
    }
}

?>

<div class="container col-6 mt-5">
    <h1 class="text-center text-light">Add New Employee</h1>
    <!-- PHP Conditions After Submiting The Form To Output The Message Either Success Or Failing -->
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
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" placeholder="Name" name="name" id="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" placeholder="Email" name="email" id="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="phone" placeholder="Phone" name="phone" id="phone" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Salary:</label>
                    <input type="number" placeholder="Salary" name="salary" id="salary" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">Department:</label>
                    <select name="department" id="department" class="form-select">
                        <?php foreach ($departments as $dep): ?>
                            <option value="<?= $dep['id'] ?>"><?= $dep['department'] ?></option>
                        <?php endforeach; ?>
                    </select>
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