<?php
use PhPKnights\Model\{Database, Polls};
//require_once '../vendor/autoload.php';
require_once '../../Model/Database.php';
require_once '../../Model/Polls.php';
require_once '../../Model/User.php';

session_start();
if (isset($_SESSION['username'])) {

    $db = Database::getDb();
    $p = new Polls();
    $polls = $p->getAllPolls($db);

?>

<html lang="en">
<head>
    <title>PHP Project: Movie Tracker</title>
    <meta name="description" content="Movie Tracker Polls">
    <meta name="keywords" content="movies, polls">
    <link rel="stylesheet" href="../../styles/style.css" type="text/css">
    <link rel="stylesheet" href="../../styles/poll_style.css">   
    <script src="../scripts/script.js"></script>
    
</head>
<body>
<?php include_once "../header.php"; ?>
<main id="main">
<h1 class="h1 text-center">Movie Tracker Polls</h1>
<p>Below is the list of all the active polls.</p>

<div class="content home">

<div>
<?php if ($_SESSION['userGroup'] == 0) { ?>
<a href="./poll-create.php" id="btn_addPoll" class="create-poll" name="createpoll">Create Poll</a>
<?php } ?>
</div>
    <!--    Displaying Data in Table-->
    <table class="table table-bordered tbl">
        <thead>
        <tr>
            <th>S.N.</th>
            <th>Poll Title</th>            
            <th></th>
            <?php if ($_SESSION['userGroup'] == 0) { ?>
            <th> </th> 
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $serial_no = 1;
        foreach ($polls as $poll) { ?>
            <tr>
               <th><?php echo $serial_no++; ?></th>
                <td><?= $poll->title ?></td>
                <td>
                <a href="poll-voting.php?id=<?= $poll->id ?>" class="view-poll" title="View Poll" name="">Vote Now</a>
                </td>
                <?php if ($_SESSION['userGroup'] == 0) { ?>
                <td>
                <a href="poll-confirmdelete.php?id=<?= $poll->id ?>" class="delete-poll" title="Delete Poll" name="delete">Delete</a>
                </td>
                <?php } ?>
            </tr>
        <?php }
        ?>
        </tbody>
    </table>
    
</div>
</main>
<?php include_once "../footer.php";
} else {
    header('Location: ../../index.php');
    die();
}
?>

</body>
</html>