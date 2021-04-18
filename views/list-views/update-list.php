<?php

// namespace PhPKnights\Model;

use PhPKnights\Model\{Database, Lists};
// require_once '../vendor/autoload.php';  <---- Not working for some reason, to figure out later

require_once '../../Model/Database.php';
require_once '../../Model/List.php';

// $s = new Make();
// $makes = $s->getAllMakes(Database::getDb());

$title = $creationDate = $userId = "";

// Checkign to see if the updateCar button is set? From list???? 
if(isset($_POST['updateList'])){
    // retrieving the id of the car to be updated
    $id= $_POST['id'];
    $db = Database::getDb();

    $listClass = new Lists();

    // getting the info for the car based on the id
    $list = $listClass->getListById($id, $db);
    
    // $makes = $carClass->getAllMakes($db);
    // Creating a new instance of the "Make" class"
    // $makeClass = new Make();
    // $carMake = getMakeById()

    // setting the values in the form to be populated with the values of the car.
    $title = $list->list_name;
    $creationDate = $list->creation_date;
    $userId = $list->user_id;

}

// Checking to see if the updCar button is set
if(isset($_POST['updList'])){
    // Selecting the values of the form
    $id= $_POST['list-id'];
    $title = $_POST['title'];
    $model = $_POST['creationDate'];
    $userId = $_POST['userId'];

    $db = Database::getDb();
    $carClass = new Lists();
    
    // setting the values of a car to be held in count
    $count = $carClass->updateCar($id, $title, $creationDate, $userId, $db);

    // checking if count is set
    if($count){
       header('Location: user-lists.php');
    } else {
        echo "problem";
    }
}


?>

<html lang="en">

<head>
    <title>Update A List</title>
    <meta name="description" content="User Created Movie Lists">
    <meta name="keywords" content="Movie Lists">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
</head>

<body>

<div>
    <!--    Form to Update Car -->
    <form action="" method="post">
        <input type="hidden" name="list-id" value="<?= $id; ?>" />
        <div class="form-group">
            <label for="title">Title :</label>
            <input type="text" value="<?= $title; ?>" class="form-control" name="title" id="title">
                
            
            <span style="color: red">

            </span>
        </div>
        <div class="form-group">
            <label for="creationDate">Creation Date :</label>
            <input type="text" class="form-control" id="creationDate" name="creationDate"
                   value="<?= $creationDate; ?>" placeholder="Enter creationDate">
            <span style="color: red">

            </span>

            <!-- <label for="creationDate">Date :</label>
            <input type="date" class="form-control" id="creationDate" name="creationDate" value="<?= $creationDate; ?>" >
            <span style="color: red">

            </span> -->
        </div>
        <div class="form-group">
            <label for="userId">userId :</label>
            <input type="text" name="userId" value="<?= $userId; ?>" class="form-control"
                   id="userId" placeholder="Enter userId">
            <span style="color: red">

            </span>
        </div>
        <a href="./user-lists.php" id="btn_back" class="btn btn-success float-left">Back</a>
        <button type="submit" name="updList"
                class="btn btn-primary float-right" id="btn-submit">
            Update List
        </button>
    </form>
</div>


</body>
</html