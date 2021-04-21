<?php
// namespace PhPKnights\Model;
use PhPKnights\Model\{Database, Lists, User};
// require_once '../vendor/autoload.php';  <---- Not working for some reason, to figure out later

require_once '../../Model/Database.php';
require_once '../../Model/List.php';
require_once '../../Model/User.php';

session_start();

if (isset($_SESSION['username'])) {

    $dbcon = Database::getDb();
    $listClass = new Lists();
    $lists =  $listClass->getAllLists(Database::getDb());
    $userClass = new User();
?>

<html lang="en">
<head>
    <title> User Created Movie Lists</title>
    <meta name="description" content="User Created Movie Lists">
    <meta name="keywords" content="Movie Lists">
    <link rel="stylesheet" href="../../styles/style.css" type="text/css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
</head>

    <body>
        <!--Header-->
        <?php require_once '../header.php' ?>
        
        <main id="main">
            <p class="">List Of All User Created Lists</p>
            <div class="">
                <!--    Displaying Data in Table-->
                <table class="">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Creation Date</th>
                        <th scope="col">List Title</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Update</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($lists as $list) { 
                        $user =  $userClass->getUser(Database::getDb(), $list->user_id);
                        ?>
                    
                        <tr>
                            <th><?= $list->id; ?></th>
                            <td><?= $list->creation_date; ?></td>
                            <td><?= $list->list_name; ?></td>
                            <td><?= $user->username; ?></td>
                            <td>
                                <?php if($user->username == $_SESSION['username']) {
                                    ?>
                                        <form action="update-list.php" method="post">
                                            <input type="hidden" name="id" value="<?php $list->id; ?>"/>
                                            <input type="submit" class="" name="updateList" value="Update"/>
                                        </form>
                                    <?php
                                }
                                ?>
                            </td>
                            <td>
                                <?php if($user->username == $_SESSION['username']) {
                                        ?>
                                            <form action="delete-list.php" method="post">
                                                <input type="hidden" name="id" value="<?=  $list->id; ?>"/>
                                                <input type="submit" class="" name="deleteList" value="Delete"/>
                                            </form>
                                        <?php
                                    }
                                ?>
                            </td>
                            <td>
                                <form action="details-list.php" method="post">
                                    <input type="hidden" name="id" value="<?=  $list->id; ?>"/>
                                    <input type="submit" class="" name="detailsList" value="Details"/>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <a href="./add-list.php" id="btn_addList" class="">Add List</a>

            </div>
        </main>

        <!--Footer-->
        <?php include_once "../footer.php";
            } else {
                header('Location: ../../index.php');
            }
        ?>
    </body>
</html>