<?php

session_start();

function logout()
{
    $root = getenv('ROOT');
    unset($_SESSION["username"]);
    unset($_SESSION["userId"]);
    unset($_SESSION["userGroup"]);
    unset($_SESSION["valid"]);
    header('Location:' . $root . '/index.php');
    exit;
}

if (isset($_POST['logout'])) {
    logout();
}