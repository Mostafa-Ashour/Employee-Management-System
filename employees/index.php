<?php
// Core
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/app/dbconfig.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/app/functions.php";

// UI
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/head.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/navbar.php";

auth(2);

// Deleting A Employee
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // Get Image Name For Deletion Process.
    $select_query = "SELECT `image` FROM `employees` WHERE `id`=$id;";
    $select = mysqli_query($con, $select_query);
    $row = mysqli_fetch_assoc($select);

    // Process Deletion Process
    // If Deletion Query Is A Success ==> Remove Employee's Related Image From uploads DIR And Change Path To employees/index.php
    $delete_query = "DELETE FROM `employees` WHERE `id` = $id;";
    $delete = mysqli_query($con, $delete_query);
    if ($delete) {
        unlink("./uploads/" . $row['image']);
        path("employees/index.php");
    }
}

// Fetch Data From employees_departments View
$select_query = "SELECT * FROM `employees_departments`";
$select = mysqli_query($con, $select_query);

?>

<div class="container col-10 mt-5">
    <h1 class="text-center text-light">All Departments</h1>
    <!-- Display Success Message If Exist -->
    <?php if (!empty($success_message)): ?>
        <div class="alert alert-success"><?= $success_message ?></div>
    <?php endif; ?>
    <!-- Display Existing Employees Form -->
    <div class="card bg-dark text-light">
        <div class="card-body table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <?php if ($_SESSION['user']['role'] == 1): ?>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Salary</th>
                        <?php endif; ?>
                        <th>Department</th>
                        <?php if ($_SESSION['user']['role'] == 1):
                        ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($select as $index => $emp): ?>
                        <tr>
                            <td><?= ($index + 1) ?></td>
                            <td><img width="80" src="./uploads/<?= $emp['image'] ?>" alt=""></td>
                            <td><?= $emp['name'] ?></td>
                            <?php if ($_SESSION['user']['role'] == 1): ?>
                                <td><?= $emp['email'] ?></td>
                                <td><?= $emp['phone'] ?></td>
                                <td><?= $emp['salary'] ?></td>
                            <?php endif; ?>
                            <td><?= $emp['department'] ?></td>
                            <?php if ($_SESSION['user']['role'] == 1): ?>
                                <td>
                                    <a href="edit.php?edit=<?= $emp['id'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="?delete=<?= $emp['id'] ?>" class="btn btn-danger">Delete</a>
                                </td>
                            <?php endif; ?>
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