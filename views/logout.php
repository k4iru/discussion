<?php
session_start();

function logout()
{
    unset($_SESSION["username"]);
    unset($_SESSION["userId"]);
    unset($_SESSION["valid"]);
    header('Location: /http-5202-group/index.php');
    exit;
}

if (isset($_POST['logout'])) {
    logout();
}