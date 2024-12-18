<?php
// Core
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/app/dbconfig.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/app/functions.php";

// UI
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/head.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/navbar.php";

// Deleting A Department
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_query = "DELETE FROM `departments` WHERE `id` = $id;";
    $delete = mysqli_query($con, $delete_query);
    if ($delete) {
        path("department/index.php");
    }
}


$select = fetch_departments($con);
?>

<div class="container col-6 mt-5">
    <h1 class="text-center text-light">All Departments</h1>
    <!-- Display Success Message If Exist -->
    <?php if (!empty($success_message)): ?>
        <div class="alert alert-success"><?= $success_message ?></div>
    <?php endif; ?>
    <!-- Form For Listing Existing Departments -->
    <div class="card bg-dark text-light">
        <div class="card-body table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($select as $index => $department): ?>
                        <tr>
                            <td><?= ($index + 1) ?></td>
                            <td><?= $department['department'] ?></td>
                            <td>
                                <a href="edit.php?edit=<?= $department['id'] ?>" class="btn btn-warning">Edit</a>
                                <a href="?delete=<?= $department['id'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php

require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/scripts.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/footer.php";

?>