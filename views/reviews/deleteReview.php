<?php

use PhPKnights\Model\Database;
use PhPKnights\Model\Review;

require_once '../../Model/Database.php';
require_once '../../Model/Review.php';
require_once '../../Model/User.php';
require_once '../../scripts/review-fill.php';

session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $dbcon = Database::getDb();

    $r = new Review();
    $count = $r->deleteReview($id, $dbcon);
    if ($count) {
        header('Location: ../../views/reviews/review.php');
    } else {
        echo "Problem deleting review";
    }
}