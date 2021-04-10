<?php
// namespace PhPKnights\Model;
use PhPKnights\Model\{Database, Lists};
// require_once '../vendor/autoload.php';  <---- Not working for some reason, to figure out later

require_once '../Model/list.php';
require_once '../Model/database.php';

$dbcon = Database::getDb();
$listClass = new Lists();
$lists =  $listClass->getAllLists(Database::getDb());

?>
<html lang="en">
<head>
    <title> User Created Movie Lists</title>
    <meta name="description" content="User Created Movie Lists">
    <meta name="keywords" content="Movie Lists">
    <link rel="stylesheet" href="../styles/style.css" type="text/css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
</head>

    <body>
        <!--Header-->
        <?php require_once './header.php' ?>

        <p class="h1 text-center">List Of All User Created Lists</p>
        <div class="m-1">
            <!--    Displaying Data in Table-->
            <table class="table table-bordered tbl">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Creation Date</th>
                    <th scope="col">List Title</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($lists as $list) { ?>
                    <tr>
                        <th><?= $list->id; ?></th>
                        <td><?= $list->creation_date; ?></td>
                        <td><?= $list->list_name; ?></td>
                        <td><?= $list->user_id; ?></td>
                        <td>
                            <form action="./update-list.php" method="post">
                                <input type="hidden" name="id" value="<?= $list->id; ?>"/>
                                <input type="submit" class="button btn btn-primary" name="updateList" value="Update"/>
                                <!-- <a href="./update-car.php" id="btn_addCar" class="btn btn-success btn-lg float-right">Add Car</a> -->
                            </form>
                        </td>
                        <td>
                            <form action="./delete-list.php" method="post">
                                <input type="hidden" name="id" value="<?=  $list->id; ?>"/>
                                <input type="submit" class="button btn btn-danger" name="deleteList" value="Delete"/>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <a href="./add-list.php" id="btn_addList" class="btn btn-success btn-lg float-right">Add List</a>

        </div>

        <!--Footer-->
        <?php require_once './footer.php' ?>
    </body>
</html>