<?php
// Core
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/app/dbconfig.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/app/functions.php";

// UI
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/head.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/navbar.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $select_query = "SELECT * FROM `employees` WHERE `email`='$email';";
    $select = mysqli_query($con, $select_query);

    if (mysqli_num_rows($select) == 1) {
        $row = mysqli_fetch_assoc($select);
        $password_verify = password_verify($password, $row['password']);

        if ($password_verify) {
            $_SESSION['user'] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'salary' => $row['salary'],
                'image' => $row['image'],
                'department_id' => $row['department_id'],
                'role' => $row["roles"],
            ];
            path("index.php");
        }
    }
}

?>

<div class="container mt-5 col-6">
    <h1 class="text-center text-light">Login</h1>
    <div class="card card-body bg-dark text-light mt-3">
        <form method="post">
            <div class="row">
                <div class="col-6 mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Email" class="form-control">
                </div>
                <div class="col-6 mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                </div>
                <div class="col-12 text-center">
                    <button class="btn btn-primary" name="login">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/scripts.php";
require_once "C:/xampp/htdocs/BackEnd_Projects/Demo Project/shared/footer.php";

?>