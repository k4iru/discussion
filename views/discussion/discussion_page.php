<?php
session_start();
require_once '../../vendor/autoload.php';
require_once '../../functions/date_format.php';

use PhPKnights\Model\Database;
use PhPKnights\Model\Discussion;
use PhPKnights\Model\Post;
use PhPKnights\Model\User;


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
            header("Location: /http-5202-group/views/discussion/discussion_page.php?thread_id=$thread_id");
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
    <link rel="stylesheet" href="../../styles/style.css">
    <link rel="stylesheet" href="../../styles/discussion.css">
    <script src="scripts/script.js"></script>
</head>

<body>
    <?php require_once '../header.php'; ?>
    <main id="main">
        <div class="page-container discussion-post">
            <h1><?= $title ?></h1>
            <p class="date"><?= format_date($date); ?> </p>
        </div>
        <?php foreach ($posts as $p) {
            $post_id = $p->id;
            $post_date = $p->creation_date;
            $comment = $p->comment;
            $user_id = $p->user_id;
            $poster = $user->getUser($db, $user_id);
            $join_date = $user->formatJoinDate($poster->date_added);
            $user_post_count = $post->getUserPostCount($db, $user_id)->count;
        ?>
            <div class="post">
                <div class="user-information">
                    <!-- placeholder for user profile picture-->
                    <span class="profile-pic"></span>
                    <p><a class="user" href="/http-5202-group/views/authentication/profile.php?user_id=<?= $user_id; ?>"><?= $poster->username ?></a></p>
                    <p class="small-text">Joined: <?= $join_date ?></p>
                    <p class="small-text">Total Posts: <?= $user_post_count ?></p>
                </div>
                <div class="post-comment">
                    <p class="small-text"><?= $post_date ?></p>
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
        <span class="page-spacer"></span>
    </main>
    <?php require_once '../footer.php'; ?>
</body>

</html>