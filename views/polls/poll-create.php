<?php
use PhPKnights\Model\{Database, Polls};
require_once '../../vendor/autoload.php';

session_start();
if (isset($_SESSION['username'])) {
    $msg = '';
    if (!empty($_POST)) {
        // Post data not empty insert a new record
        // Check if POST variable "title" exists, if not default the value to blank, basically the same for all variables
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        // Insert new record into the "polls" table
        $stmt = $db->prepare('INSERT INTO polls VALUES (NULL, ?)');
        $stmt->execute([$title]);
        // Below will get the last insert ID, this will be the poll id
        $poll_id = $db->lastInsertId();
        // Get the answers and convert the multiline string to an array, so we can add each answer to the "poll_answers" table
        $options = isset($_POST['options']) ? explode(PHP_EOL, $_POST['options']) : '';
        foreach ($options as $option) {
            // If the answer is empty there is no need to insert
            if (empty($option)) {
                continue;
            }
            // Add answer to the "poll_answers" table
            $stmt = $db->prepare('INSERT INTO poll_answers VALUES (NULL, ?, ?, 0)');
            $stmt->execute([$poll_id, $option]);
        }
        // Output message
        $msg = 'Created Successfully!';
    }
    ?>

<html lang="en">

<head>
    <title>Add Poll: Movie Tracker</title>
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
	<h2>Create Poll</h2>
    <form action="poll-create.php" method="post">
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
        <label for="options">Options (1 per line)</label>
        <textarea name="options" id="options" ></textarea>
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?= $msg ?></p>
    <?php endif; ?>

           
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