<?php

session_start();
require_once '../vendor/autoload.php';

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
    $first = $_POST['first'];
    $last = $_POST['last'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

    // first name 
    if (empty($_POST['first'])) {
        $firstNameError = "Empty First Name";
        $err = true;
    } else {
        $first = filter_var($_POST['first'], FILTER_SANITIZE_STRING);
    }

    // last name 
    if (empty($_POST['last'])) {
        $lastNameError = "Empty Last Name";
        $err = true;
    } else {
        $last = filter_var($_POST['last'], FILTER_SANITIZE_STRING);
    }

    // username 
    if (empty($_POST['username'])) {
        $userNameError = "Empty Username";
        $err = true;
    } else {
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    }

    // password
    if (empty($_POST['password'])) {
        $passwordError = "Empty Password";
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
        // sanitize string
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
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
            header('Location: ../index.php');
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
    <link rel="Stylesheet" href="../styles/authentication.css">
    <script src="scripts/script.js"></script>
</head>

<body>
    <?php require_once 'header.php'; ?>
    <main id="main">

        <form id="registration-form" action="" method="POST">
            <div class="form-inputs">
                <div class="blurb">
                    <h1>Sign Up</h1>
                    <p>It's quick and easy.</p>
                </div>

                <div>
                    <input class="col-2" type="text" name="first" placeholder="First Name" value=<?= $first; ?>>
                    <input class="col-2" type="text" name="last" placeholder="Last Name" value=<?= $last; ?>>
                </div>

                <input class="col-1" type="text" name="username" placeholder="Username" value=<?= $username; ?>>


                <input class="col-1" type="text" name="email" placeholder="Email" value=<?= $email; ?>>

                <input class="col-1" type="password" placeholder="Password" name="password">


                <input class="col-1" type="password" name="passwordConfirm" placeholder="Password">

                <input type="submit" name="submit" value="Register">
                <a href="/http-5202-group/views/login.php">Already have an account?</a>


                <span class="error"> <?= $firstNameError; ?></span>
                <span class="error"> <?= $lastNameError; ?></span>
                <span class="error"> <?= $userNameError; ?></span>
                <span class="error"> <?= $emailError; ?></span>
                <span class="error"> <?= $passwordError; ?></span>
            </div>
        </form>
    </main>
    <?php require_once 'footer.php'; ?>
</body>

</html>