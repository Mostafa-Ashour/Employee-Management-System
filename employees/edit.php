<?php
// Core
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/app/dbconfig.php";

// UI
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/head.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/navbar.php";


$departments = fetch_departments($con);

$error_message = '';
$no_change_message = '';
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    // Get Employee Data To Output It, To Be Edited.
    $row = fetch_employee_data($id, $con);

    // Update Employee Data
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $salary = $_POST['salary'];
        $department_id = $_POST['department'];

        // Check Changed Data
        $update_fields = [];
        if ($row['name'] !== $name) {
            $update_fields[] = "`name`='$name'";
        }
        if ($row['email'] !== $email) {
            $update_fields[] = "`email`='$email'";
        }
        if ($row['phone'] !== $phone) {
            $update_fields[] = "`phone`='$phone'";
        }
        if ($row['salary'] != $salary) {
            $update_fields[] = "`salary`=$salary";
        }
        if (!empty($_FILES['image']['name'])) {
            // print_r($_FILES['image']) . "<br>";
            $img_name = rand(1, 10000) . "_" . time() . "_" . $_FILES['image']['name'];
            $img_tmp_name = $_FILES['image']['tmp_name'];
            $location = "./uploads/" . $img_name;
            $update_fields[] = "`image`='$img_name'";
        }
        if ($row['department_id'] != $department_id) {
            $update_fields[] = "`department_id`=$department_id";
        }

        if (!empty($update_fields)) {
            $update_query = "UPDATE `employees` SET " . implode(", ", $update_fields) . " WHERE `id`=$id;";
            try {
                $update = mysqli_query($con, $update_query);
                unlink("./uploads/" . $row['image']);
                move_uploaded_file($img_tmp_name, $location);
                path("employees/index.php");
            } catch (Exception $e) {
                if (str_contains($e->getMessage(), "employees_email_uq")) {
                    $error_message = "The Email Address $email Already In Use.";
                } elseif (str_contains($e->getMessage(), "employees_phone_uq")) {
                    $error_message = "The Phone Number $phone Already In Use.";
                }
                // Re-Fetch Employee Data In Case Of Error. 
                $row = fetch_employee_data($id, $con);
            }
        } else {
            $no_change_message = "No Changes Where Made.";
        }
    }
}

?>

<div class="container col-6 mt-5">
    <h1 class="text-center text-light">Edit Employee</h1>
    <!-- Show No Change Message or Error Message, If There is any -->
    <?php if (!empty($no_change_message)): ?>
        <div class="alert alert-success pt-3 pb-3"><?= $no_change_message ?></div>
    <?php elseif (!empty($error_message)): ?>
        <div class="alert alert-danger pt-3 pb-3"><?= $error_message ?></div>
    <?php endif; ?>
    <!-- Form To Edit Employee Data -->
    <div class="card bg-dark text-light">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= $row['name'] ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" name="email" id="email" class="form-control" value="<?= $row['email'] ?>">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="<?= $row['phone'] ?>">
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Salary:</label>
                    <input type="text" name="salary" id="salary" class="form-control" value="<?= $row['salary'] ?>">
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">Departments:</label>
                    <select name="department" id="department" class="form-select">
                        <?php foreach ($departments as $idx => $dep): ?>
                            <?php if ($row['department_id'] == $dep['id']): ?>
                                <option selected value="<?= $dep['id'] ?>"><?= $dep['department'] ?></option>
                            <?php else: ?>
                                <option value="<?= $dep['id'] ?>"><?= $dep['department'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" id="image" name="image" class="form-control mb-2">
                    <img width="200" src="./uploads/<?= $row['image'] ?>" alt="">
                </div>
                <div class="text-center">
                    <button class="btn btn-warning" name="update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/scripts.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/footer.php";

?>