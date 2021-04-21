<?php
use PhPKnights\Model\{Database, Polls};
require_once '../../vendor/autoload.php';

session_start();
if (isset($_SESSION['username'])) {

    $db = Database::getDb();

    // If the GET request "id" exists (poll id)...
    if (isset($_GET['id'])) {
        // MySQL query that selects the poll records by the GET request "id"
        $stmt = $db->prepare('SELECT * FROM polls WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        // Fetch the record
        $poll = $stmt->fetch(PDO::FETCH_ASSOC);
        // Check if the poll record exists with the id specified
        if ($poll) {
            // MySQL query that selects all the poll answers
            $stmt = $db->prepare('SELECT * FROM poll_answers WHERE poll_id = ?');
            $stmt->execute([$_GET['id']]);
            // Fetch all the poll anwsers
            $poll_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // If the user clicked the "Vote" button...
            if (isset($_POST['poll_answer'])) {
                // Update and increase the vote for the answer the user voted for
                $stmt = $db->prepare('UPDATE poll_answers SET votes = votes + 1 WHERE id = ?');
                $stmt->execute([$_POST['poll_answer']]);
                // Redirect user to the result page
                header('Location: poll-result.php?id=' . $_GET['id']);
                exit();
            }
        } else {
            die('Poll with that ID does not exist.');
        }
    } else {
        die('No poll ID specified.');
    }
    ?>

<html lang="en">

<head>
    <title>Poll Voting: Movie Tracker</title>
    <meta name="description" content="Movie Tracker Polls">
    <meta name="keywords" content="Movies, polls, voting">
    <link rel="stylesheet" href="../../styles/poll_style.css">
    <link rel="stylesheet" href="../../styles/style.css">
    <script src="../scripts/script.js"></script>
</head>

<body>
<?php include_once "../header.php"; ?>
<main id="main">
<div class="content poll-vote">
	<h2><?= $poll['title'] ?></h2>
    <form action="poll-voting.php?id=<?= $_GET['id'] ?>" method="post">
        <?php for ($i = 0; $i < count($poll_answers); $i++): ?>
        <label>
            <input type="radio" name="poll_answer" value="<?= $poll_answers[$i]['id'] ?>"<?= $i == 0 ? ' checked' : '' ?>>
            <?= $poll_answers[$i]['options'] ?>
        </label>
        <?php endfor; ?>
        <div>
            <input type="submit" value="Vote">
            <a href="poll-result.php?id=<?= $poll['id'] ?>">View Result</a>
        </div>
    </form>
</div>
<div>           
    <a href="poll-list.php" class="view-poll">Back to List</a>
</div>
       </main>
<?php include_once "../footer.php";
} else {
    header('Location: ../login.php');
    die();
}
?>
</body>
</html>