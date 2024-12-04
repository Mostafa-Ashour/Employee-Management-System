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
