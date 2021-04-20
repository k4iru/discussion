<?php
use PhPKnights\Model\{Database, TrailerData, polls};
//require_once '../vendor/autoload.php';

require_once '../../Model/Database.php';
require_once '../../Model/Polls.php';
require_once '../../Model/User.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];
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