<?php

define('base_url', 'http://localhost/BackEnd_Projects/Demo%20Project/');

function url($_path = null)
{
    return base_url . $_path;
}

function path($_path = null)
{
    $location = base_url . $_path;
    echo "<script>window.location.replace('$location')</script>";
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
