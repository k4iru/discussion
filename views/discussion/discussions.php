<?php
session_start();

require_once '../../vendor/autoload.php';
require_once '../../functions/date_format.php';

use PhPKnights\Model\Database;
use PhPKnights\Model\Discussion;
use PhPKnights\Model\User;
use PhPKnights\Model\Post;

$db = Database::getDB();
$thread = new Discussion();
$user = new User();
$post = new Post();

$threads = $thread->listThreads($db);

?>


<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Discussion Board</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/style.css">
    <link rel="stylesheet" href="../../styles/discussion.css">
    <script src="/http-5202-group/scripts/discussion.js"></script>
</head>

<body>
    <?php require_once '../header.php'; ?>
    <main id="main">
        <h1>Discussion Board</h1>

        <?php if (isset($_SESSION['valid']) == true) { ?>
            <a href="/http-5202-group/views/discussion/create_discussion.php"><button>New Thread</button></a>
        <?php } else { ?>
            <a href="/http-5202-group/views/authentication/login.php"><button>New Thread</button></a>


            <!-- have a php loop that lists threads by last updated date -->
        <?php

        }
        foreach ($threads as $t) {
            $id = $t->id;
            $test = new DateTime($t->creation_date);
            $creation_date = new DateTime($t->creation_date);
            $title = $t->title;
            $last_post = new DateTime($t->last_post);
            $last_post_user = $user->getUser($db, $t->last_post_user_id)->username;
            $username = $user->getUser($db, $t->user_id)->username;
            $post_count = $post->getThreadPostCount($db, $id)->count;
        ?>

            <div class="discussion" onclick="getPage(<?= $id; ?>)">
                <div class="discussion-title">
                    <p class="title"><?= $title ?></p>

                    <p><a class="user" href="/http-5202-group/views/authentication/profile.php?user_id=<?= $t->user_id; ?>"><?= $username ?></a> &#x2022; <span class="date"><?= format_date($creation_date) ?></span></p>
                </div>
                <div class="discussion-replies">
                    <p>Replies: <?= $post_count ?></p>
                </div>
                <div class="discussion-last">
                    <p>Last Post By: <a class="user" href="/http-5202-group/views/authentication/profile.php?user_id=<?= $t->last_post_user_id; ?>"><?= $last_post_user ?></a></p>
                    <p><span class="date"><?= format_date($last_post) ?></span></p>
                </div>
            </div>

        <?php
        }
        ?>

        <span class="page-spacer"></span>
    </main>

    <?php require_once '../footer.php'; ?>
</body>

</html>