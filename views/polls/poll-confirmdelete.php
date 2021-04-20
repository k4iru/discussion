<?php
use PhPKnights\Model\{Database, Polls};
//require_once '../vendor/autoload.php';
require_once '../../Model/Database.php';
require_once '../../Model/Polls.php';
require_once '../../Model/User.php';

$db = Database::getDb();

    $id = $_POST['id'];
?>

<html lang="en">

<head>
    <title>Delete Poll: Movie Tracker</title>
    <meta name="description" content="Movie Tracker Polls">
    <meta name="keywords" content="Movies, polls">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/style.css">
    <script src="../scripts/script.js"></script>
</head>

<body>
<?php                
include_once "../header.php";  
?>
<div class="content delete">
	<h2>Delete Poll</h2>

	<p>Are you sure you want to delete the poll?</p>
    <div class="yesno">
    
    <form action="./poll-delete.php" method="post">
                        <input type="hidden" name="id" value="<?= $id ?>"/>
                        <input type="submit" class="button btn btn-danger" name="deletePoll" value="Yes"/>
                    </form>
        <a href="poll-list.php">No</a>
    </div>

</div>

<?php
include_once "../footer.php";                
?>
</body>
</html>