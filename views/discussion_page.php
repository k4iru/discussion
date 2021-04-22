<?php
session_start();
require_once '../vendor/autoload.php';

use PhPKnights\Model\Database;
use PhPKnights\Model\Discussion;
use PhPKnights\Model\Post;
use PhPKnights\Model\User;

function format_date($date)
{
    $today = new DateTime();
    $diff = $today->diff($date);
    if ($diff->days == 0) {
        return "Today at " . date_format($date, 'g:iA');
    } else if ($diff->days < 6 && $diff->y == 0) {
        return date_format($date, 'D \a\t g:iA');
    } else {
        return date_format($date, 'M m,Y');
    }
}

$db = Database::getDB();
$thread = new Discussion();
$post = new Post();
$user = new User();
$thread_id = $postErr = "";

$err = false;

// get page details
if (isset($_GET['thread_id'])) {

    // get thread 
    $thread_id = $_GET['thread_id'];
    $discussion = $thread->getThread($db, $thread_id);

    $title = $discussion->title;
    $date = new DateTime($discussion->creation_date);

    // get posts 
    $posts = $post->getPosts($db, $thread_id);
}

if (isset($_POST['submit'])) {

    if (empty($_POST['content'])) {
        $err = true;
        $postErr = "Empty Post";
    } else {
        $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    }

    // add post
    if ($err == false) {
        $postCount = $post->addPost($db, $content, $thread_id, $_SESSION['userId']);
        $threadCount = $thread->updateThread($db, $thread_id, $_SESSION['userId']);

        if ($postCount && $threadCount) {
            header("Location: /http-5202-group/views/discussion_page.php?thread_id=$thread_id");
        } else {
            echo "Error";
        }
    }
}

?>



<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/discussion.css">
    <script src="scripts/script.js"></script>
</head>

<body>
    <?php require_once 'header.php'; ?>
    <main id="main">
        <h1><?= $title ?></h1>
        <p class="date"><?= format_date($date); ?> </p>

        <?php foreach ($posts as $p) {
            $post_id = $p->id;
            $post_date = $p->creation_date;
            $comment = $p->comment;
            $user_id = $p->user_id;
            $post_user = $user->getUser($db, $user_id);
            $user_post_count = $post->getUserPostCount($db, $user_id)->count;
        ?>
            <div class="post">
                <div class="user-information">
                    <p><?= $post_user->username ?></p>
                    <p><?= $post_user->date_added ?></p>
                    <p><?= $user_post_count ?></p>
                </div>
                <div class="post-comment">
                    <p><?= $post_date ?></p>
                    <p><?= $comment ?></p>
                </div>
            </div>

        <?php }
        if (isset($_SESSION['valid'])) { ?>
            <form action="" method="POST">
                <textarea name="content"></textarea>
                <input type="submit" name="submit" value="Post">
            </form>
        <?php } ?>
    </main>
    <?php require_once 'footer.php'; ?>
</body>

</html>