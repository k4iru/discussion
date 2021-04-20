
<?php
use PhPKnights\Model\{Database, Polls};
//require_once '../vendor/autoload.php';
require_once '../../Model/Database.php';
require_once '../../Model/Polls.php';
require_once '../../Model/User.php';

$db = Database::getDb();
$p = new Polls();
$polls =  $p->getAllPolls($db);
?>

<html lang="en">
<head>
    <title>PHP Project: Movie Tracker</title>
    <meta name="description" content="Movie Tracker Polls">
    <meta name="keywords" content="movies, polls">
    <link rel="stylesheet" href="../../styles/style.css" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="../scripts/script.js"></script>
</head>
<body>
<?php                
include_once "../header.php";  
?>
<h1 class="h1 text-center">Movie Tracker Polls</h1>
<p>Below is the list of all the active polls.</p>
<div class="m-1">
    <!--    Displaying Data in Table-->
    <table class="table table-bordered tbl">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Options</th>
            <th scope="col">Voting</th>
            <th scope="col">Delete Poll</th> 
        </tr>
        </thead>
        <tbody>
        <?php foreach ($polls as $poll) { ?>
            <tr>
                <th><?= $poll->id; ?></th>
                <td><?= $poll->title; ?></td>
                <td><?= $poll->options; ?></td>
                <td>
                <a href="poll-voting.php?id=<?=$poll->id?>" class="view" title="View Poll">Vote Now</i></a>
                </td>
                <td>
                    <form action="./poll-delete.php" method="post">
                        <input type="hidden" name="id" value="<?= $poll->id ?>"/>
                        <input type="submit" class="button btn btn-danger" name="deletePoll" value="Delete"/>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <a href="./poll-create.php" id="btn_addPoll" class="btn btn-success btn-lg float-right">Create Poll</a>

</div>
<?php
include_once "../footer.php";                
?>
</body>
</html>