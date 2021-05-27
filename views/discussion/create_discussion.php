<?php
session_start();
$root = getenv('ROOT');
require_once '../../vendor/autoload.php';

$db = \PhPKnights\Model\Database::getDb();
$thread =  new \PhPKnights\Model\Discussion();
$post = new \PhPKnights\Model\Post();

$title = $titleError = $content = $contentError = "";
$err = false;

if (isset($_POST['submit'])) {

    if (!isset($_SESSION['valid'])) {
        header("Location: /views/authentication/login.php");
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
            header('Location: ' . $root . '/views/discussion/discussions.php');
            exit;
        } else {
            // add custom error later
            echo "error";
        }
    }
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Create Thread</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/style.css">
    <link rel="stylesheet" href="../../styles/discussion.css">
    <script src="https://cdn.tiny.cloud/1/hkjnfgn59n558lrgjdjdha68n1d3bhpctu8j4uwepgtc1984/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="<?= $root ?>/scripts/tinymce.js"></script>
</head>

<body>
    <?php require_once '../header.php'; ?>
    <main id="main">
        <h1>Create Thread</h1>

        <form action="" method="POST">
            <div class="title-container">
                <label for="title">Title</label>
                <input type="text" name="title" value=<?= $title; ?>> <span class="error"> <?= $titleError; ?></span>
            </div>

            <div class="container">
                <textarea class="text-area text-editor" name="content" rows="10" cols="80" value=<?= $content; ?>></textarea> <span class="error"> <?= $contentError; ?></span>
            </div>

            <input class="btn" type="submit" name="submit" value="post">
        </form>
    </main>
    <?php require_once '../footer.php'; ?>
</body>

</html>