<?php
// Core
require_once "C://xampp/htdocs/Employee-Management-System/app/functions.php";

if (isset($_GET['logout'])) {
    session_unset();
    path("index.php");
}
?>

<header>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= url("index.php") ?>">Company</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link active d-flex align-items-center" aria-current="page" href="<?= url("index.php") ?>">Home</a>
                    </li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item dropdown d-flex align-items-center">
                            <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Departments
                            </a>
                            <ul class="dropdown-menu">
                                <?php if ($_SESSION['user']['role'] == 1): ?>
                                    <li><a class="dropdown-item" href="<?= url("department/add.php") ?>">Add Department</a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="<?= url("department/index.php") ?>">List All Departments</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown d-flex align-items-center">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Employees
                            </a>
                            <ul class="dropdown-menu">
                                <?php if ($_SESSION['user']['role'] == 1): ?>
                                    <li><a class="dropdown-item" href="<?= url("employees/add.php") ?>">Add Employee</a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="<?= url("employees/index.php") ?>">List All Employees</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown d-flex align-items-center">
                            <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="rounded-circle border border-light me-2" width="40" height="40" src=" <?= url("employees/uploads/") . $_SESSION['user']['image'] ?>" alt="">
                                <span class="fw-bold"> <?= $_SESSION['user']['name'] ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="text-center"><a class="btn btn-danger" href="?logout=x`">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown d-flex align-items-center">
                            <a class="btn btn-success" href="<?= url("login.php") ?>" role="button">
                                Login
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>