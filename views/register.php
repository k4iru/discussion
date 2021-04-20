<?php

session_start();

require_once '../Model/Database.php';
require_once '../Model/User.php';

use PhPKnights\Model\Database;
use PhPKnights\Model\User;

// variables
$username = $email = $emailConfirm = $first = $last = $password = $passwordConfirm = "";
// Error messages
$passwordError = $lastNameError = $firstNameError = $userNameError = $emailError = "";
$err = false;


if (isset($_POST['submit'])) {
    // set up User and Database objects
    $user = new User();
    $db = Database::getDB();

    // get form values
    $username = $_POST['username'];
    $email = $_POST['email'];
    $emailConfirm = $_POST['emailConfirm'];
    $first = $_POST['first'];
    $last = $_POST['last'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

    // first name 
    if (empty($_POST['first'])) {
        $firstNameError = "*";
        $err = true;
    } else {
        $first = filter_var($_POST['first'], FILTER_SANITIZE_STRING);
    }

    // last name 
    if (empty($_POST['last'])) {
        $lastNameError = "*";
        $err = true;
    } else {
        $last = filter_var($_POST['last'], FILTER_SANITIZE_STRING);
    }

    // username 
    if (empty($_POST['username'])) {
        $userNameError = "*";
        $err = true;
    } else {
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    }

    // password
    if (empty($_POST['password'])) {
        $passwordError = "*";
        $err = true;
    } else {
        if ($_POST['password'] != $_POST['passwordConfirm']) {
            $passwordError = "Password does not match";
            $err = true;
        } else {
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        }
    }

    // email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid Email Address";
        $err = true;
    } else {

        if ($_POST['email'] != $_POST['emailConfirm']) {
            $emailError = "Email does not match";
            $err = true;
        } else {
            // sanitize string
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        }
    }


    // check if email or username exists
    $usernameTest = $user->userNameExists($db, $_POST['username']);
    // username exists, set error
    if ($usernameTest !== false) {
        $userNameError = "Username Exists";
        $err = true;
    }

    $emailTest = $user->emailExists($db, $_POST['email']);
    // email exists, set error
    if ($emailTest !== false) {
        $emailError = "Email already in use";
        $err = true;
    }

    // no errors, add user to table
    if ($err == false) {
        $lastUserId = $user->addUser($db, $first, $last, $username, $password, $email);
        // success!
        if ($lastUserId) {
            // set up session
            $authenticatedUser = $user->getUser($db, $lastUserId);
            $_SESSION['username'] = $username;
            $_SESSION['valid'] = true;
            $_SESSION['userGroup'] = $authenticatedUser->user_group;
            $_SESSION['userId'] = $authenticatedUser->id;
            header ('Location: ../index.php');
            exit;
        }
    }
}

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="scripts/script.js"></script>
</head>

<body>
    <?php require_once 'header.php'; ?>
    <main id="main">
    <h1>Register</h1>
        <form action="" method="POST">
            <div>
            </div>
            <div>
                <label for="first">First Name</label>
                <input type="text" name="first" value=<?= $first; ?>> <span class="error"> <?= $firstNameError; ?></span>
            </div>
            <div>
                <label for="last">Last Name</label>
                <input type="text" name="last" value=<?= $last; ?>> <span class="error"> <?= $lastNameError; ?></span>
            </div>
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" value=<?= $username; ?>> <span class="error"> <?= $userNameError; ?></span>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="text" name="email" value=<?= $email; ?>> <span class="error"> <?= $emailError; ?></span>
            </div>
            <div>
                <label for="emailConfirm">Confirm Email</label>
                <input type="text" name="emailConfirm" >
            </div>

            <div>
                <label for="password">Password</label> <span class="error"> <?= $passwordError; ?></span>
                <input type="password" name="password" >
            </div>

            <div>
                <label for="passwordConfirm">Confirm Password</label>
                <input type="password" name="passwordConfirm">
            </div>

            <input type="submit" name="submit" value="Register">
        </form>
    </main>
    <?php require_once 'footer.php'; ?>
</body>

</html>