<?php
// Core
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/app/dbconfig.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/app/functions.php";

// UI
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/head.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/navbar.php";

// Deleting A Employee
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // Get Image Name For Deletion Process.
    $select_query = "SELECT `image` FROM `employees` WHERE `id`=$id;";
    $select = mysqli_query($con, $select_query);
    $row = mysqli_fetch_assoc($select);
    $delete_query = "DELETE FROM `employees` WHERE `id` = $id;";
    $delete = mysqli_query($con, $delete_query);
    if ($delete) {
        unlink("./uploads/" . $row['image']);
        path("employees/index.php");
    }
}


$select_query = "SELECT * FROM `employees_departments`";
$select = mysqli_query($con, $select_query);

?>

<div class="container col-10 mt-5">
    <h1 class="text-center text-light">All Departments</h1>
    <?php if (!empty($success_message)): ?>
        <div class="alert alert-success"><?= $success_message ?></div>
    <?php endif; ?>
    <div class="card bg-dark text-light">
        <div class="card-body table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Salary</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($select as $index => $emp): ?>
                        <tr>
                            <td><?= ($index + 1) ?></td>
                            <td><img width="80" src="./uploads/<?= $emp['image'] ?>" alt=""></td>
                            <td><?= $emp['name'] ?></td>
                            <td><?= $emp['email'] ?></td>
                            <td><?= $emp['phone'] ?></td>
                            <td><?= $emp['salary'] ?></td>
                            <td><?= $emp['department'] ?></td>
                            <td>
                                <a href="edit.php?edit=<?= $emp['id'] ?>" class="btn btn-warning">Edit</a>
                                <a href="?delete=<?= $emp['id'] ?>" class="btn btn-danger">Delete</a>
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