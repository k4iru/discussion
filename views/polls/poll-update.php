<?php
use PhPKnights\Model\{Database, Polls};
require_once '../../vendor/autoload.php';



session_start();
if (isset($_SESSION['username'])) {

    $id = $_GET['id'];
    $db = Database::getDb();
    $p = new Polls();
    $poll_id = $id;
    
    $title = $option = "";
    
    $optionsall = $p->getOptionsforPoll($db, $poll_id);

    $poll = $p->getPollById($id, $db);    
    var_dump($poll);
    var_dump($optionsall);

     $title =  $poll->title;
//     $option = $poll->options;
//    $optiona = array($option);
//    // $options = implode("", $optiona);

  

if(isset($_POST['update'])){

    $id = $_POST['sid'];
    $title = $_POST['title'];
    $options = $_POST[$o->options];

    $db = Database::getDb();
    $p = new Polls();
    $count = $p->updatePoll($db, $id, $title);
    foreach ($optionsall as $o) {
    $countoptions = $p->updateOptions($db, $id, $options);
    }
    if($count && $countoptions){
       header('Location:  poll-list.php');
    } else {
        echo "Error Updating Records";
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
        <label for="options">Options </label>
       <?php 
        foreach ($optionsall as $o) { ?>
            <input type="text" name="<?= $o->options; ?>" id="options" value="<?= $o->options; ?>">
        <?php   }       ?>
        <input type="submit" name="update"value="Update">
    </form>


           
           <a href="poll-list.php" class="view-poll">Back to List</a>
       </div>
       <?php } else {header('Location: ./poll-list.php');
    die();} ?>
       </main>
<?php include_once "../footer.php";
} else {
    header('Location: ../login.php');
    die();
}

?>
</body>
</html>