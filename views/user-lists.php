<?php

// include("models/list.php"); 

use HTTP_5202_GROUP\models\{Lists};
use HTTP_5202_GROUP\database\{Database};

require_once '../models/list.php';
require_once '../database/database.php';

$dbcon = Database::getDb();
$listClass = new Lists();
$lists =  $listClass->getAllLists(Database::getDb());

?>
<html lang="en">
<head>
    <title> User Created Lists</title>
    <meta name="description" content="Car Management System">
    <meta name="keywords" content="Cars">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
<p class="h1 text-center">List Of All User Created Lists</p>
<div class="m-1">
    <!--    Displaying Data in Table-->
    <table class="table table-bordered tbl">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Creation Date</th>
            <th scope="col">User ID</th>
            <th scope="col">Movie ID</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($lists as $list) { ?>
            <tr>
                <th><?= $list->id; ?></th>
                <td><?= $list->creation_date; ?></td>
                <td><?= $list->user_id; ?></td>
                <td><?= $list->movie_id; ?></td>
                <td>
                    <form action="./update-car.php" method="post">
                        <input type="hidden" name="id" value="<?= $list->id; ?>"/>
                        <input type="submit" class="button btn btn-primary" name="updateCar" value="Update"/>
                        <!-- <a href="./update-car.php" id="btn_addCar" class="btn btn-success btn-lg float-right">Add Car</a> -->
                    </form>
                </td>
                <td>
                    <form action="./delete-car.php" method="post">
                        <input type="hidden" name="id" value="<?=  $list->id; ?>"/>
                        <input type="submit" class="button btn btn-danger" name="deleteCar" value="Delete"/>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <a href="./add-car.php" id="btn_addCar" class="btn btn-success btn-lg float-right">Add Car</a>

</div>
</body>
</html>