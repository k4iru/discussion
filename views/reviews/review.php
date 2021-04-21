<?php

use PhPKnights\Model\Database;
use PhPKnights\Model\Review;

require_once '../../Model/Review.php';
require_once '../../Model/Database.php';
require_once '../../Model/User.php';

session_start();
$dbcon = Database::getDb();
$reviewModel = new Review();
$reviews = $reviewModel->getAllReviews(Database::getDb());

if (isset($_SESSION['username'])) {
    $dbcon = Database::getDb();
    $reviewModel = new Review();
    $reviews = $reviewModel->getAllReviews(Database::getDb());
}

?>

<html lang="en">

<head>
    <title>Reviews</title>
    <link rel="stylesheet" href="../../styles/style.css" type="text/css">
    <link rel="stylesheet" href="../../styles/review_style.css" type="text/css">
</head>

<body>
    <!-- Header -->
    <?php require_once '../header.php'?>

    <!-- MAIN REVIEW SECTION -->
    <main id="main">
        <h1>Reviews in the Database</h1>
        <!-- Displaying Reviews in a Table -->
        <table class="review-table">
            <thead>
                <tr>
                    <th>Reviewed Movie</th>
                    <th>Review</th>
                    <th>Rating</th>
                    <th>Update Review</th>
                    <th>Delete Review</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reviews as $review) {?>
                <tr>
                    <td><?=$review->review_movie;?></td>
                    <td><?=$review->review_content;?></td>
                    <td><?=$review->review_rating;?></td>

                    <td>
                        <form action="./updateReview.php" method="post">
                            <input type="hidden" name="id" value="<?=$review->id;?>" />
                            <input type="submit" class="button" name="updateReview" value="Update" />
                        </form>
                    </td>

                    <td>
                        <form action="./deleteReview.php" method="post">
                            <input type="hidden" name="id" value="<?=$review->id;?>" />
                            <input type="submit" class="button" name="deleteReview" value="Delete" />
                        </form>
                    </td>

                </tr>
                <?php }?>
            </tbody>
        </table>
        <?php // if ($_SESSION['userGroup'] == 0) {?>
        <!-- Add a Review -->
        <a href="./addReview.php" class="button">Add a Review</a>
        <?php // }?>
    </main>
    <!-- Footer -->
    <?php require_once '../footer.php'?>
</body>



</html>