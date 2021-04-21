<?php
session_start();
require_once '../vendor/autoload.php';

use PhPKnights\Model\Database;
use PhPKnights\Model\Discussion;
use PhPKnights\Model\Post;

// get page details
$thread_id = "";
if (isset($_GET['thread_id'])) {
    $db = Database::getDB();
    $thread = new Discussion();
    $post = new Post();

    // get thread 
    $thread_id = $_GET['thread_id'];
    $discussion = $thread->getThread($db, $thread_id);
    var_dump($discussion);

    // get posts 
    $posts = $post->getPosts($db, $thread_id);

    var_dump($posts);
}

?>



<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Thread</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="scripts/script.js"></script>
</head>

<body>
    <?php require_once 'header.php'; ?>
    <main id="main">
        <h1>Thread</h1>

    </main>
    <?php require_once 'footer.php'; ?>
</body>

</html>