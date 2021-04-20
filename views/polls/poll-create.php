<?php
use PhPKnights\Model\{Database, Polls};
//require_once '../vendor/autoload.php';
require_once '../../Model/Database.php';
require_once '../../Model/Polls.php';
require_once '../../Model/User.php';

$db = Database::getDb();
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
        if (empty($option)) continue;
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/style.css">
    <script src="../scripts/script.js"></script>
</head>

<body>
<?php                
include_once "../header.php";  
?>
<div>
    <!--    Form to Add  Poll -->
    <div class="content update">
	<h2>Create Poll</h2>
    <form action="add-poll.php" method="post">
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
        <label for="options">Options (1 per line)</label>
        <textarea name="options" id="options"></textarea>
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?php
include_once "../footer.php";                
?>
</body>
</html