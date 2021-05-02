<?php
session_start();

function logout()
{
    unset($_SESSION["username"]);
    unset($_SESSION["userId"]);
    unset($_SESSION["userGroup"]);
    unset($_SESSION["valid"]);
    header('Location: /index.php');
    exit;
}

if (isset($_POST['logout'])) {
    logout();
}