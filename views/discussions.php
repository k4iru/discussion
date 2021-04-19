<?php
session_start();

require_once '../Model/Database.php';
require_once '../Model/Discussion.php';

use PhPKnights\Model\Database;
use PhPKnights\Model\Discussion;

$db = Database::getDB();
$thread = new Discussion();

$threads = $thread->listThreads($db);
?>


<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Discussion Board</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="scripts/script.js"></script>
</head>

<body>
    <?php require_once 'header.php'; ?>
    <h1>Discussion Board</h1>

    <a href="/http-5202-group/views/create_discussion.php"><button>New Thread</button></a>

    <!-- have a php loop that lists threads by last updated date -->
    <?php
    foreach ($threads as $t) {
        $id = $t->id;
        $title = $t->title;
        $last_post = $t->last_post;
        $last_post_user_id = $t->last_post_user_id;
        $user_id = $t->user_id;
    ?>
    <ul>
    <li><?= $id?></li>
    </ul>

    <?php
    }
    ?>

    <?php require_once 'footer.php'; ?>
</body>

</html>