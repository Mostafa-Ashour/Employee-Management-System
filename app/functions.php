<?php

define('base_url', 'http://localhost/Employee-Management-System/');

function url($_path = null)
{
    return base_url . $_path;
}

function path($_path = null)
{
    $location = base_url . $_path;
    echo "<script>window.location.replace('$location')</script>";
}

function auth($num1 = null)
{
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == $num1) {
            return true;
        } else {
            path("index.php");
        }
    } else {
        path("login.php");
    }
}

function fetch_departments($con)
{
    $all_departments = "SELECT * FROM `departments`;";
    $departments = mysqli_query($con, $all_departments);
    return $departments;
}

function fetch_department_data($id, $con)
{
    $select_query = "SELECT * FROM `departments` WHERE `id`=$id;";
    $select = mysqli_query($con, $select_query);
    $row = mysqli_fetch_assoc($select);
    return $row;
}

function fetch_employee_data($id, $con)
{
    $select_query = "SELECT * FROM `employees` WHERE `id`=$id;";
    $select = mysqli_query($con, $select_query);
    $row = mysqli_fetch_assoc($select);
    return $row;
}

function filter_string($input_value)
{
    $input_value = trim($input_value);
    $input_value = strip_tags($input_value);
    $input_value = htmlspecialchars($input_value);
    $input_value = stripslashes($input_value);

    return $input_value;
}

function string_validation($input_value, $min)
{
    $is_empty = empty($input_value);
    $is_less = (strlen($input_value) < $min);
    return ($is_empty || $is_less ? true : false);
}

function image_validation($image_name, $image_size, $limit_size)
{
    $is_empty = empty($image_name);
    $size = ((int)$image_size / 1024) / 1024;
    $is_bigger = ($size > $limit_size);
    return ($is_bigger || $is_empty ? true : false);
}
