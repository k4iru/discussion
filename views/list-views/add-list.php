<?php

// namespace PhPKnights\Model;

use PhPKnights\Model\{Database, Lists, User};
// require_once '../vendor/autoload.php';  <---- Not working for some reason, to figure out later

require_once '../../Model/Database.php';
require_once '../../Model/List.php';
require_once '../../Model/User.php';

session_start();

// Accessing the Database
$db = Database::getDb();
$userClass = new User();

    // Checking to see that the submit button is set
    if(isset($_POST['addList'])){
       // Retrieving the values from the form
       $creationDate = $_POST['creationDate'];
       $title = $_POST['title'];
       $userId = $_POST['userId'];

       // Creating a new Instance of List & User
       $listClass = new Lists();

       // Creating a new List with the values retrieved from the form.
       $newList = $listClass->addList($title, $creationDate, $userId, $db);


       if($newList){
           header('Location: ../../views/list-views/user-lists.php');
       } else {
           echo "problem adding a List";
       }

    }

    if (isset($_SESSION['username'])) {
?>


<html lang="en">
    <head>
        <title>Add A List</title>
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
                <a href="./user-lists.php" id="" class="button back">Back</a>
                <h1 class="main-header">Add Your Own List!</h1>
                <!--    Form to Add List -->
                <form action="" method="post" class="form">
                    <div class="form-group">
                        <label for="title">Title :</label>
                        <input type="text" class="form-control" name="title" id="title">
                          
                        <span style="color: red">

                        </span>
                    </div>
                    <div class="form-group">
                        <label for="creationDate">Date :</label>
                        <input type="date" class="form-control" id="creationDate" name="creationDate">
                        <span style="color: red">

                        </span>
                    </div>
                    <div class="form-group">
                        <!-- <label for="userId">User ID :</label> -->
                        <input type="hidden" name="userId" value="<?php $user =  $userClass->userNameExists($db, $_SESSION['username']); echo($user->id); ?>"
                        class="form-control"
                        id="userId">
                        <span style="color: red">

                        </span>
                    </div>
                    <button type="submit" name="addList"
                            class="button" id="">
                        Add List
                    </button>
                </form>
            </div>
        </main>
        <!--Footer-->
        <?php require_once '../footer.php';
        } else {
                    header('Location: ../../index.php');
                }
        ?>
    </body>
</html