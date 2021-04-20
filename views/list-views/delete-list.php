<?php

// namespace PhPKnights\Model;

use PhPKnights\Model\{Database, Lists};
// require_once '../vendor/autoload.php';  <---- Not working for some reason, to figure out later

require_once '../../Model/Database.php';
require_once '../../Model/List.php';

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $db = Database::getDb();

    $listClass = new Lists();
    $count = $listClass->deleteList($id, $db);
    if($count){
        header("Location: user-lists.php");
    }
    else {
        echo " problem deleting";
    }


}