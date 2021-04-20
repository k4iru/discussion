<?php
session_start();

require_once '../Model/Database.php';
require_once '../Model/Discussion.php';

use PhPKnights\Model\Database;
use PhPKnights\Model\Discussion;

$db = Database::getDB();
$thread = new Discussion();

$threads = $thread->listThreads($db);

if (isset($_GET['submit'])) {
    echo "test";
}
?>


<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Discussion Board</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="/http-5202-group/styles/discussion.css">
    <script src="/http-5202-group/scripts/discussion.js"></script>
</head>

<body>
    <?php require_once 'header.php'; ?>
    <main id="main">
        <h1>Discussion Board</h1>

        <a href="/http-5202-group/views/create_discussion.php"><button>New Thread</button></a>

        <!-- have a php loop that lists threads by last updated date -->
        <?php
        foreach ($threads as $t) {
            $id = $t->id;
            $creation_date = new DateTime($t->creation_date);
            $creation_date = date_format($creation_date, "Y-m-d");
            $title = $t->title;
            $last_post = new DateTime($t->last_post);
            $last_post = date_format($last_post, "Y-m-d");
            $last_post_user_id = $t->last_post_user_id;
            $user_id = $t->user_id;
        ?>

            <div class="discussion" onclick="getPage(<?= $id; ?>)">
                <div>
                    <h3><?= $title ?></h3>
                    <p><?= $user_id ?></p>
                    <p><?= $creation_date ?></p>
                </div>
                <div>
                    <p><?= $last_post_user_id ?></p>
                    <p><?= $last_post ?></p>
                </div>
            </div>

        <?php
        }
        ?>
    </main>

    <?php require_once 'footer.php'; ?>
</body>

</html>