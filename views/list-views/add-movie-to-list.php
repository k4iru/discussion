<?php

session_start();

$listId = $_SESSION['userListId'];

// namespace PhPKnights\Model;

use PhPKnights\Model\{Database, Lists};
// require_once '../vendor/autoload.php';  <---- Not working for some reason, to figure out later

require_once '../../Model/Database.php';
require_once '../../Model/List.php';

    // Checking to see that the submit button is set
    if(isset($_POST['addList'])){
       // Retrieving the values from the form
       $movieId = $_POST['movieId'];

        // Accessing the Database
       $db = Database::getDb();

       // Creating a new Instance of Car
       $listClass = new Lists();

       // Creating a new car with the values retrieved from the form.
       $newMovieInList = $listClass->addMovieToList($listId, $movieId, $db);


       if($newMovieInList){
           echo "Added Movie To your List sucessfully";
       } else {
           echo "problem adding the movie to your list";
       }

    }
?>


<html lang="en">

<head>
    <title>Add A Movie</title>
    <meta name="description" content="User Created Movie Lists">
    <meta name="keywords" content="Movie Lists">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
</head>

<body>

<div>
    <!--    Form to Add Movie To a user created list -->
    <form action="" method="post">
        <input type="hidden" name="listId" value="<?= $listId; ?>"/>
        <div class="form-group">
            <label for="movieId">Movie ID :</label>
            <input type="text" name="movieId" value="" class="form-control"
                   id="movieId" placeholder="Enter Movie ID">
            <span style="color: red">

            </span>
        </div>
        <a href="./user-lists.php" id="btn_back" class="btn btn-success float-left">Back</a>
        <button type="submit" name="addList"
                class="btn btn-primary float-right" id="btn-submit">
            Add List
        </button>
    </form>
</div>


</body>
</html