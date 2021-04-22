<?php

// namespace PhPKnights\Model;

use PhPKnights\Model\{Database, Lists};
// require_once '../vendor/autoload.php';  <---- Not working for some reason, to figure out later

require_once '../../Model/Database.php';
require_once '../../Model/List.php';

$title = $creationDate = $userId = "";

// Checkign to see if the updateList button is set? From list???? 
if(isset($_POST['updateList'])){
    // retrieving the id of the list to be updated
    $id= $_POST['id'];
    $db = Database::getDb();

    $listClass = new Lists();

    // getting the info for the list based on the id
    $list = $listClass->getListById($id, $db);
    
    // setting the values in the form to be populated with the values of the list.
    $title = $list->list_name;
    $creationDate = $list->creation_date;
    $userId = $list->user_id;

}

// Checking to see if the updList button is set
if(isset($_POST['updList'])){
    // Selecting the values of the form
    $id= $_POST['list-id'];
    $title = $_POST['title'];
    $model = $_POST['creationDate'];
    $userId = $_POST['userId'];

    $db = Database::getDb();
    $listClass = new Lists();
    
    // setting the values of a list to be held in count
    $count = $listClass->updateList($id, $title, $creationDate, $userId, $db);

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
                <h1 class="main-header">Update Your List Title!</h1>
                <form action="" method="post" class="form">
                    <input type="hidden" name="list-id" value="<?= $id; ?>" />
                    <div class="form-group">
                        <label for="title">Title :</label>
                        <input type="text" value="<?= $title; ?>" class="form-control" name="title" id="title">
                            
                        
                        <span style="color: red">

                        </span>
                    </div>
                    <div class="form-group">
                        <!-- <label for="creationDate">Creation Date :</label> -->
                        <input type="hidden" class="form-control" id="creationDate" name="creationDate"
                            value="<?= $creationDate; ?>" placeholder="Enter creationDate">
                        <span style="color: red">

                        </span>

                    </div>
                    <div class="form-group">
                        <!-- <label for="userId">userId :</label> -->
                        <input type="hidden" name="userId" value="<?= $userId; ?>" class="form-control"
                            id="userId" placeholder="Enter userId">
                        <span style="color: red">

                        </span>
                    </div>
                    <button type="submit" name="updList"
                            class="button" id="btn-submit">
                        Update List
                    </button>
                </form>
            </div>
        </main>

        <!--Footer-->
        <?php require_once '../footer.php' ?>
</body>
</html