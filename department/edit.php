<?php
// Core
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/app/dbconfig.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/app/functions.php";

// UI
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/head.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/navbar.php";

// Update Department
if (isset($_GET['edit'])) {
    // Get Requested Department Data
    $id = $_GET['edit'];
    $select_query = "SELECT * FROM `departments` WHERE `id`=$id;";
    $select = mysqli_query($con, $select_query);
    $department_name = mysqli_fetch_assoc($select)['department'];
    // Update Department Data
    if (isset($_POST['update'])) {
        $department_name = $_POST['department'];
        $update_query = "UPDATE `departments` SET `department`='$department_name' WHERE `id`=$id;";
        $update = mysqli_query($con, $update_query);
        if ($update) {
            path("department/index.php");
        }
    }
}

?>

<div class="container col-6 mt-5">
    <h1 class="text-center text-light">Update Department</h1>
    <!-- Form To Update Department -->
    <div class="card bg-dark text-light">
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="department" class="form-label">Update Department</label>
                    <input type="text" name="department" id="department" class="form-control" value="<?= $department_name ?>">
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