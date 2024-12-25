<?php
// Core
require_once "C:/xampp/htdocs/BackEnd_Projects/Employee-Management-System/app/dbconfig.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Employee-Management-System/app/functions.php";

// UI
require_once "C:/xampp/htdocs/BackEnd_Projects/Employee-Management-System/shared/head.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Employee-Management-System/shared/navbar.php";

auth();
// Add Employee

$departments = fetch_departments($con);

$success_message = '';
$error_message = '';
$errors = [];

if (isset($_POST['submit'])) {
    // Get Data From Add Post Request, Then Filter Them.
    $name = filter_string($_POST['name']);
    $email = filter_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];
    $phone = filter_string($_POST['phone']);
    $salary = filter_string($_POST['salary']);
    $department_id = filter_string($_POST['department']);

    // Setting Image Name, And Be Ready For Moving To Uploads DIR 
    $img_name = rand(1, 10000) . "_" . time() . "_" . $_FILES['image']['name'];
    $img_tmp_name = $_FILES['image']['tmp_name'];
    $location = "./uploads/" . $img_name;

    // Validate Empty and Minimum Size Conditions On Data
    if (string_validation($name, 8)) {
        $errors[] = "Employee Name Is Required And It Must Be At Least 8 Characters.";
    }
    if (string_validation($_POST['password'], 8)) {
        $errors[] = "Employee Password Is Required And It Must Be At Least 8 Characters.";
    }
    if (string_validation($email, 2)) {
        $errors[] = "Employee Email Is Required.";
    }
    if (string_validation($phone, 11)) {
        $errors[] = "Employee Phone Is Required.";
    }
    if (string_validation($salary, 1)) {
        $errors[] = "Employee Salary Is Required.";
    }
    if (image_validation($_FILES['image']['name'], $_FILES['image']['size'], 3)) {
        $errors[] = "Image Is Required And Must Be Less Than 3MB.";
    }

    // Check Size Of Errors Array, 
    // If Empty ==> Continue To Insert New Employee Data, Then If Insert Query Is A Success Move Uploaded Image [If Exist] To Uploads DIR.
    // Else ==> Display Errors Array For Data Modification. 
    if (empty($errors)) {
        // New Employee Data Insertion
        $insert_query = "INSERT INTO `employees` VALUES (NULL, '$name', '$email', '$password', $role,  '$phone', $salary, '$img_name' , $department_id)";
        try {
            $insert = mysqli_query($con, $insert_query);
            $success_message = "$name Added Successfully.";
            // Check If There Is An Image Uploaded Before Moving To Uploads DIR.
            move_uploaded_file($img_tmp_name, $location);
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            if (str_contains($error_message, "employees_email_uq")) {
                $error_message = "The Email Address $email Already In Use.";
            } elseif (str_contains($error_message, "employees_phone_uq")) {
                $error_message = "The Phone Number $phone Already In Use.";
            }
            // Re-Fetch Employee Data In Case Of Error. 
            $departments = fetch_departments($con);
        }
    }
}

?>

<div class="container col-6 mt-5">
    <h1 class="text-center text-light">Add New Employee</h1>
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
    <!-- PHP Conditions After Submiting The Form To Output The Message Either Success Or Failing -->
    <?php if (!empty($success_message)): ?>
        <div class="alert alert-success pt-3 pb-3"><?= $success_message ?></div>
    <?php elseif (!empty($error_message)): ?>
        <div class="alert alert-danger pt-3 pb-3"><?= $error_message ?></div>
    <?php endif; ?>
    <!-- Form To Add New Department -->
    <div class="card bg-dark text-light">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" placeholder="Name" name="name" id="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" placeholder="Email" name="email" id="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" placeholder="Password" name="password" id="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role:</label>
                    <select name="role" id="role" class="form-select">
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
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
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" id="image" name="image" class="form-control">
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