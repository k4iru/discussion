<?php
session_start();
require_once '../../vendor/autoload.php';

use PhPKnights\Model\Database;
use PhPKnights\Model\Discussion;
use PhPKnights\Model\Post;

$title = $titleError = $content = $contentError = "";
$err = false;

if (isset($_POST['submit'])) {
    $db = Database::getDB();
    $thread = new Discussion();
    $post = new Post();

    if (!isset($_SESSION['valid'])) {
        header ("Location: /views/authentication/login.php");
    }

    // check if title is empty then sanitize
    if (empty($_POST['title'])) {
        $titleError = "*";
        $err = true;
    } else {
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    }

    // check if content is empty then sanitize
    if (empty($_POST['content'])) {
        $contentError = "*";
        $err = true;
    } else {
        $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    }

    // no errors post thread
    if ($err == false) {
        $lastInsertId = $thread->addThread($db, $title, $_SESSION['userId']);
        echo $lastInsertId;

        $count = $post->addPost($db, $content, $lastInsertId, $_SESSION['userId']);
        echo $count;
        // $count true means successully posted
        if ($count) {
            header('Location: /views/discussion/discussions.php');
            exit;
        } else {
            // add custom error later
            echo "error";
        }
    }
}
?>


<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Create Thread</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/style.css">
    <script src="scripts/script.js"></script>
</head>

<body>
    <?php require_once '../header.php'; ?>
    <main id="main">
        <h1>Create Thread</h1>

        <form action="" method="POST">
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" value=<?= $title; ?>> <span class="error"> <?= $titleError; ?></span>
            </div>

            <div>
                <label for="content">Message</label>
                <textarea name="content" rows="10" cols="80" value=<?= $content; ?>></textarea> <span class="error"> <?= $contentError; ?></span>
            </div>

            <input type="submit" name="submit" value="post">
        </form>
    </main>
    <?php require_once '../footer.php'; ?>
</body>

</html>