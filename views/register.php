<?php

session_start();

require_once '../Model/Database.php';
require_once '../Model/User.php';

use PhPKnights\Model\Database;
use PhPKnights\Model\User;

if (isset($_POST['submit'])) {
    $user = new User();
    $db = Database::getDB();

    // TODO 
    // validate form
    // check database for existing users
    // add to db
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
    <main>
        <form action="" method="POST">
            <div>
                <label for="first">First Name</label>
                <input type="text" name="first">
            </div>
            <div>
                <label for="last">Last Name</label>
                <input type="text" name="last">
            </div>
            <div>
                <label for="username">Username</label>
                <input type="text" name="username">
            </div>

            <div>
                <label for="postal">Postal Code</label>
                <input type="text" name="postal">
            </div>

            <div>
                <label for="credit">Credit Card</label>
                <input type="text" name="credit">
            </div>

            <div>
                <label for="email">Email</label>
                <input type="text" name="email">
            </div>
            <div>
                <label for="emailConfirm">Confirm Email</label>
                <input type="text" name="emailConfirm">
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password">
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