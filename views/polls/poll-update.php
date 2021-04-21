<?php
use PhPKnights\Model\{Database, Polls};
require_once '../../vendor/autoload.php';



session_start();
if (isset($_SESSION['username'])) {

    $id = $_GET['id'];
    $db = Database::getDb();
    $poll_id = $id;
    
    $title = $option = "";
    $op = new Polls();
    $optionsall = $op->getOptions(Database::getDb());

    $p = new Polls();
    $poll = $p->getPollById($id, $db);    
    var_dump($poll);

     $title =  $poll->title;
//     $option = $poll->options;
//    $optiona = array($option);
//    // $options = implode("", $optiona);

  

if(isset($_POST['update'])){

    $id = $_POST['sid'];
    $title = $_POST['title'];
    $options = $_POST['options'];

    $db = Database::getDb();
    $p = new Polls();
    $count = $p->updatePoll($db, $id, $title, $options);

    if($count){
       header('Location:  poll-list.php');
    } else {
        echo "problem";
    } 
}

    ?>

<html lang="en">

<head>
    <title>Update Poll: Movie Tracker</title>
    <meta name="description" content="Movie Tracker Polls">
    <meta name="keywords" content="Movies, polls">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/style.css">
    <link rel="stylesheet" href="../../styles/poll_style.css">
    <script src="../scripts/script.js"></script>
</head>

<body>
<?php include_once "../header.php"; ?>
<main id="main">
<?php if ($_SESSION['userGroup'] == 0) { ?>
    <!--    Form to Add  Poll -->
    <div class="content update">
	<h2>Update Poll</h2>
    <form action="" method="post">
    <input type="hidden" name="sid" value="<?= $id; ?>" />
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?= $title; ?>">
        <label for="options">Options (1 per line)</label>
        <textarea name="options" id="options" ><?php 
        //foreach ($poll as $poll) { 
         $options; 
        //}
        ?></textarea>
        <input type="submit" name="update"value="Update">
    </form>


           
           <a href="poll-list.php" class="view-poll">Back to List</a>
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