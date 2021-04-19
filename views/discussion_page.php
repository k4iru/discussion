<?php
session_start();
require_once '../Model/Database.php';
require_once '../Model/Discussion.php';
require_once '../Model/Post.php';

use PhPKnights\Model\Database;
use PhPKnights\Model\Discussion;
use PhPKnights\Model\Post;

// get page details
$thread_id = "";
if (isset($_GET['thread_id'])) {
    $thread_id = $_GET['thread_id'];

}
?>