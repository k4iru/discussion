<?php
use PhPKnights\Model\{Database, TrailerData, polls};
require_once '../../vendor/autoload.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = Database::getDb();
    $dsn ="mysql:host=167.114.195.192;dbname=hughesbu_PHPKNIGHTS_ASSIGNMENT";

    $p = new Polls();
    $class = $p->deletePoll($id, $db);
    if($class){
        header("Location: poll-list.php");
    }
    else {
        echo "Unable to delete this poll";
    }


}