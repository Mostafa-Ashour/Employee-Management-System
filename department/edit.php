<?php
// Core
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/app/dbconfig.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/app/functions.php";

// UI
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/head.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/navbar.php";

// Update Department
$error_message = '';
$no_change_message = '';
if (isset($_GET['edit'])) {
    // Get Department Data To Output It, To Be Edited.
    $id = $_GET['edit'];
    $select_query = "SELECT * FROM `departments` WHERE `id`=$id;";
    $select = mysqli_query($con, $select_query);
    $row = mysqli_fetch_assoc($select);
    // Update Department Data
    if (isset($_POST['update'])) {
        $department_name = $_POST['department'];
        // $update_query = "UPDATE `departments` SET `department`='$department_name' WHERE `id`=$id;";

        $update_fields = [];
        if ($department_name !== $row['department']) {
            $update_fields[] = "`department`=$department_name";
        }

        if (!empty($update_fields)) {
            $update_query = "UPDATE `departments` SET " . implode(", ", $update_fields) . " WHERE `id`=$id";
            try {
                $update = mysqli_query($con, $update_query);
                path("department/index.php");
            } catch (Exception $e) {
                $error_message = "$department_name Department Already Added.";
                // Re-Fetch Department Data In Case Of Failure
                $select_query = "SELECT * FROM `departments` WHERE `id`=$id;";
                $select = mysqli_query($con, $select_query);
                $department_name = mysqli_fetch_assoc($select)['department'];
            }
        } else {
            $no_change_message = "No Changes Where Made.";
        }
    }
}

?>

<div class="container col-6 mt-5">
    <h1 class="text-center text-light">Update Department</h1>
    <?php if (!empty($no_change_message)): ?>
        <div class="alert alert-success pt-3 pb-3"><?= $no_change_message ?></div>
    <?php elseif (!empty($error_message)): ?>
        <div class="alert alert-danger pt-3 pb-3"><?= $error_message ?></div>
    <?php endif; ?>
    <!-- Form To Update Department -->
    <div class="card bg-dark text-light">
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="department" class="form-label">Update Department</label>
                    <input type="text" placeholder="Department Name" name="department" id="department" class="form-control" value="<?= $row['department'] ?>">
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