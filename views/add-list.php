<?php

// namespace PhPKnights\Model;

use PhPKnights\Model\{Database, Lists};
// require_once '../vendor/autoload.php';  <---- Not working for some reason, to figure out later

require_once '../Model/list.php';
require_once '../Model/database.php';

$s = new Lists();
// $makes = $s->getAllMakes(Database::getDb());

    // Checking to see that the submit button is set
    if(isset($_POST['addList'])){
       // Retrieving the values from the form
       $creationDate = $_POST['creationDate'];
       $title = $_POST['title'];
       $userId = $_POST['userId'];

        // Accessing the Database
       $db = Database::getDb();

       // Creating a new Instance of Car
       $listClass = new Lists();

       // Creating a new car with the values retrieved from the form.
       $newList = $listClass->addList($title, $creationDate, $userId, $db);


       if($newList){
           echo "Added car sucessfully";
       } else {
           echo "problem adding a car";
       }

    }
?>


<html lang="en">

<head>
    <title>Add A List</title>
    <meta name="description" content="User Created Movie Lists">
    <meta name="keywords" content="Movie Lists">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
</head>

<body>

<div>
    <!--    Form to Add  Car -->
    <form action="" method="post">

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
            <label for="userId">User ID :</label>
            <input type="text" name="userId" value="" class="form-control"
                   id="userId" placeholder="Enter User ID">
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