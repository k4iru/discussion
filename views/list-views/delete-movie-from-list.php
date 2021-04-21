<?php

// namespace PhPKnights\Model;

use PhPKnights\Model\{Database, Lists};
// require_once '../vendor/autoload.php';  <---- Not working for some reason, to figure out later

require_once '../../Model/Database.php';
require_once '../../Model/List.php';

session_start();

// $_SESSION['userListId']

if(isset($_POST['id'])){
    $movieId = $_POST['id'];
    $db = Database::getDb();

    $listClass = new Lists();
    $count = $listClass->deleteMovieFromList($_SESSION['userListId'], $movieId ,$db);
    if($count){
        header("Location: user-lists.php");
    }
    else {
        echo " problem deleting";
    }


}