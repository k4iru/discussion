<?php
session_start();

require_once '../Model/Database.php';
require_once '../Model/User.php';

use PhPKnights\Model\Database;
use PhPKnights\Model\User;

$password = $username = "";
$userNameError = $passwordError = "";
$err = "";
if (isset($_POST['submit'])) {
    // set up User and Database objects
    $user = new User();
    $db = Database::getDB();

    // validate and sanitize username
    if (empty($_POST['username'])) {
        $userNameError = "*";
        $err = true;
    } else {
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    }

    // validate and sanitize password
    if (empty($_POST['password'])) {
        $passwordError = "*";
        $err = true;
    } else {
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    }

    // if username + password not empty check if user exists
    $authenticatedUser = $user->authenticateUser($db, $username, $password);

    if ($authenticatedUser) {
        $_SESSION['username'] = $username;
        $_SESSION['valid'] = true;
        $_SESSION['userGroup'] = $authenticatedUser->user_group;
        $_SESSION['userId'] = $authenticatedUser->id;
        header('Location: ../index.php');
        exit;
    } else {
        $err = "Invalid Username or Password";
    }
}
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="scripts/script.js"></script>
</head>

<body>
    <?php require_once 'header.php'; ?>
    <main id="main">
        <h1>Login Page</h1>
        <form action="" method="POST">
            <div>
                <label for="first">Username</label>
                <input type="text" name="username" value=<?= $username; ?>> <span class="error"> <?= $userNameError; ?></span>
            </div>
            <div>
                <label for="password">Password</label> <span class="error">
                    <input type="password" name="password"> <span class="error"> <?= $passwordError; ?></span>
            </div>
            <span class="error"><?= $err; ?></span>
            <input type="submit" name="submit" value="Login">
        </form>
    </main>
    <?php require_once 'footer.php'; ?>
</body>

</html>