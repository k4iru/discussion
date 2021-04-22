<?php
use PhPKnights\Model\{Database, Polls};
require_once '../../vendor/autoload.php';

session_start();
$db = Database::getDb();
$p = new Polls();

if (isset($_SESSION['username'])) {

    $id = $_GET['id'];
    $poll_id = $id;

    $title = $option = "";

    $optionsall = $p->getOptionsforPoll($db, $poll_id);
    $poll = $p->getPollById($id, $db);
    //var_dump($poll);
    // var_dump($optionsall);

    $title = $poll->title;

    if (isset($_POST['update-option'])) {
        $optionid = $_POST['optionid'];
        $options = $_POST['option'];
        $countoptions = $p->updateOptions($db, $optionid, $options);
        if ($countoptions) {
            header('Location:  poll-list.php?');
        } else {
            echo "Error Updating Records";
        }
    }

    if (isset($_POST['update'])) {
        $id = $_POST['sid'];
        $title = $_POST['title'];
        //$options = $_POST['options'];AAA
        var_dump($options);
        $count = $p->updatePoll($db, $id, $title);

        if ($count) {
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
    <input type="hidden" name="sid" value="<?= $id ?>" />
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?= $title ?>">
        <input type="submit" name="update"value="Update Title">
    </form>
       <?php
       $optionno = 1;
       $optionb = 1;
       foreach ($optionsall as $o) { ?>
        <form action="" method="post" >
        <label for="option">Option <?php echo $optionno++; ?> </label>
        <input type="hidden" name="optionid" value="<?= $o->id ?>" />
        <input type="text"  name="option" id="option" value="<?= $o->options ?>">
        <input type="submit" name="update-option" value="Update Option <?php echo $optionb++; ?>">
        </form>
        <?php }
       ?>

           
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