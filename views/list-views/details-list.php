<?php

session_start();

// namespace PhPKnights\Model;

use PhPKnights\Model\{Database, Lists, User};
// require_once '../vendor/autoload.php';  <---- Not working for some reason, to figure out later

require_once '../../Model/Database.php';
require_once '../../Model/List.php';
require_once '../../Model/User.php';

$dbcon = Database::getDb();
$userClass = new User();

// Checkign to see if the detailsList button is set? From list???? 
if(isset($_POST['detailsList'])){
    // retrieving the id of the list to be updated
    $userListId= $_POST['id'];
    $_SESSION['userListId'] = $userListId;
    $db = Database::getDb();

    $listClass = new Lists();

    // getting the info for the list based on the id
    $lists = $listClass->getListDetails($userListId, $db);
    $specificList = $listClass->getListById($userListId,$db);

    // foreach ($lists as $list) {
    //     $movies = $movie->getMovie($list->movie_id, $db);
    //     var_dump($movies);
    // }
    $title = $specificList->list_name;
    // var_dump($title);
} else {

    $userListId = $_SESSION['userListId'] ;

    $db = Database::getDb();

    $listClass = new Lists();

    // getting the info for the list based on the id
    $lists = $listClass->getListDetails($userListId, $db);
    $specificList = $listClass->getListById($userListId,$db);

    $title = $specificList->list_name;

}

if (isset($_SESSION['username'])) {

?>

<html lang="en">
<head>
    <title> User Created Movie Lists</title>
    <meta name="description" content="User Created Movie Lists">
    <meta name="keywords" content="Movie Lists">
    <link rel="stylesheet" href="../../styles/style.css" type="text/css">
    <link rel="stylesheet" href="../../styles/list_style.css" type="text/css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
</head>

    <body>
        <!--Header-->
        <?php require_once '../header.php' ?>

        <main id="main">
            <div class="container">
                <a href="./user-lists.php" id="btn_back" class="button back">Back</a>
                <h1 class="main-header"> <?= $title; ?></h1>
                <!--    Displaying Data in Table-->
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Movie Id</th>
                        <th scope="col">Movie Name</th>
                        <th scope="col">Movie Description</th>
                        <?php 
                                $user =  $userClass->getUser(Database::getDb(), $specificList->user_id);
                                if($user->username == $_SESSION['username'] || $_SESSION['userGroup'] == 0) { ?>
                                <th scope="col">Delete Movie From List</th>
                        <?php
                            }
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($lists as $list) { 
                        $movies = $listClass->getMovie($list->movie_id, $db);
                        ?>
                        <tr>
                            <td class="table-td"><?= $list->movie_id; ?></td>
                            <td class="table-td"><?= $movies->name; ?></td>
                            <td class="table-td"><?= $movies->description; ?></td>
                            <?php 
                                $user =  $userClass->getUser(Database::getDb(), $specificList->user_id);
                                if($user->username == $_SESSION['username'] || $_SESSION['userGroup'] == 0) { ?>
                            <td class="table-td">
                                <form action="../../views/list-views/delete-movie-from-list.php" method="post">
                                    <input type="hidden" name="id" value="<?=  $list->movie_id; ?>"/>
                                    <input type="submit" class="button" name="deleteList" value="Delete"/>
                                </form>
                            </td>
                            <?php
                                }
                            ?>
                        </tr>
                            <?php } ?>
                    </tbody>
                </table>
                <?php 
                        $user =  $userClass->getUser(Database::getDb(), $specificList->user_id);
                        if($user->username == $_SESSION['username'] || $_SESSION['userGroup'] == 0) { ?>
                        <a href="../../views/list-views/add-movie-to-list.php" id="btn_addList" class="button navigation-button">Add Movie To List</a>
                    <?php
                        }
                ?>
            </div>
        </main>

        <!--Footer-->
        <?php require_once '../footer.php';
        }
        ?>
    </body>
</html>