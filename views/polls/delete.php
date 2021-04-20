<?php
use PhPKnights\Model\{Database, Polls};
require_once '../../Model/Database.php';
require_once '../../Model/Polls.php';

$db = Database::getDb();
$msg = '';
// Check that the poll ID exists
if (isset($_GET['$poll->id'])) {
    // Select the record that is going to be deleted
    $stmt = $db->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$poll) {
        die ('Poll doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $db->prepare('DELETE FROM polls WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            // We also need to delete the answers for that poll
            $stmt = $pdo->prepare('DELETE FROM poll_answers WHERE poll_id = ?');
            $stmt->execute([$_GET['id']]);
            // Output msg
            $msg = 'You have deleted the poll!';
        } else {
            // User clicked the "No" button, redirect them back to the home/index page
            header('Location: index.php');
            exit;
        }
    }
} else {
    die ('No ID specified!');
}
?>

<?=include_once "../header.php";  ?>

<div class="content delete">
	<h2>Delete Poll #<?=$d?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete poll #<?=$id?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$id?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$id?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=include_once "../footer.php";  ?>