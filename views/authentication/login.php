<?php
session_start();
require_once '../../vendor/autoload.php';

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
        header('Location: ../../index.php');
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
    <link rel="stylesheet" href="../../styles/style.css">
    <link rel="stylesheet" href="../../styles/authentication.css">
    <script src="scripts/script.js"></script>
</head>

<body>
    <?php require_once '../header.php'; ?>
    <main id="main">
        <form id="registration-form" action="" method="POST">
            <div class="form-inputs">
                <h1>Login Now!</h1>

                <input type="text" name="username" placeholder="Username" value=<?= $username; ?>> <span class="error"> <?= $userNameError; ?></span>
                <input type="password" name="password" placeholder="Password"> <span class="error"> <?= $passwordError; ?></span>

                <span class="error"><?= $err; ?></span>
                <input type="submit" name="submit" value="Login">
                <a href="register.php">Register Now</a>
            </div>
        </form>
    </main>
    <?php require_once '../footer.php'; ?>
</body>

</html>