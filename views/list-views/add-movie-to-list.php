<?php

session_start();

$listId = $_SESSION['userListId'];

// namespace PhPKnights\Model;

use PhPKnights\Model\{Database, Lists};
// require_once '../vendor/autoload.php';  <---- Not working for some reason, to figure out later

require_once '../../Model/Database.php';
require_once '../../Model/List.php';
require_once '../../library/functions.php';

    // Accessing the Database
    $db = Database::getDb();

    $listClass = new Lists();

    $listOfMovies = $listClass->getAllMovies($db); 

    // Checking to see that the submit button is set
    if(isset($_POST['addList'])){
       // Retrieving the values from the form
       $movieId = $_POST['movieId'];

       $newMovieInList = $listClass->addMovieToList($listId, $movieId, $db);
       

       if($newMovieInList){
            header('Location: details-list.php');
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
            <label for="movieId">Add a Movie to your List! :</label>
            <select name="movieId" id="movieId">
            <?php
            $html_dropdown = "";
            foreach ($listOfMovies as $movie) {
                $html_dropdown .= "<option value='$movie->id'>$movie->name</option>";
            }
            echo($html_dropdown);
            ?>
            </select>

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