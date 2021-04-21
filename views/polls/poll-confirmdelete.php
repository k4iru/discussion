<?php
use PhPKnights\Model\{Database, Polls};
require_once '../../vendor/autoload.php';

session_start();
if (isset($_SESSION['username'])) {
    $db = Database::getDb();
    $id = $_GET['id'];
    ?>

<html lang="en">
<head>
    <title>Delete Poll: Movie Tracker</title>
    <meta name="description" content="Movie Tracker Polls">
    <meta name="keywords" content="Movies, polls">
    <link rel="stylesheet" href="../../styles/poll_style.css">
    <link rel="stylesheet" href="../../styles/style.css">
    <script src="../scripts/script.js"></script>
</head>

<body>
<?php include_once "../header.php"; ?>
<main id="main">
<?php if ($_SESSION['userGroup'] == 0) { ?>
<div class="content delete">
	<h2>Delete Poll</h2>
	<p>Are you sure you want to delete the poll?</p>
    <div class="yesno">
    <a href="poll-delete.php?id=<?= $id ?>" class="delete-poll" >Yes</a>
    <a href="poll-list.php" class="view-poll">No</a>
    </div>
</div>
<?php } else {header('Location: ./poll-list.php');
    die();} ?>
</main>
<?php include_once "../footer.php";
} else {
    header('Location: ../../index.php');
    die();
}
?>
</body>
</html>