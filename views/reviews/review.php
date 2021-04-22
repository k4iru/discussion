<?php

session_start();

use PhPKnights\Model\Database;
use PhPKnights\Model\Review;
use PhPKnights\Model\User;

require_once '../../Model/Review.php';
require_once '../../Model/Database.php';
require_once '../../Model/User.php';

//if user is logged in, gets information from database and puts it into object
//if user is NOT logged in, sends user to a page telling them to login.
if (isset($_SESSION['username'])) {
    $dbcon = Database::getDb();
    $reviewModel = new Review();
    $reviews = $reviewModel->getAllReviews(Database::getDb());
} else if (!isset($_SESSION['username'])) {
    header('Location: ../../views/reviews/notUser.php');
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
        <h1>All Reviews</h1>
        <!-- Displaying Reviews in a Table -->
        <table class="review-table">
            <thead>
                <tr>
                    <th>Reviewed Movie</th>
                    <th>Review</th>
                    <th>Rating</th>
                    <?php if ($_SESSION['userGroup'] == 0) {?>
                    <th>Update Review</th>
                    <th>Delete Review</th>
                    <?php }?>
                </tr>
            </thead>
            <tbody>
                <!-- Looping table through PHP to get each occurance -->
                <?php foreach ($reviews as $review) {?>
                <tr>
                    <td><?=$review->review_movie;?></td>
                    <td><?=$review->review_content;?></td>
                    <td><?=$review->review_rating;?></td>

                    <!-- ONLY ADMIN CAN SEE UPDATE AND DELETE FUNCTION -->
                    <?php if ($_SESSION['userGroup'] == 0) {?>
                    <td>
                        <form action="./updateReview.php" method="post">
                            <input type="hidden" name="id" value="<?=$review->id;?>" />
                            <input type="submit" class="button" name="updateReview" value="Update" />
                        </form>
                    </td>
                    <?php }?>
                    <?php if ($_SESSION['userGroup'] == 0) {?>
                    <td>
                        <form action="./deleteReview.php" method="post">
                            <input type="hidden" name="id" value="<?=$review->id;?>" />
                            <input type="submit" class="button" name="deleteReview" value="Delete" />
                        </form>
                    </td>
                    <?php }?>

                </tr>
                <?php }?>
            </tbody>
        </table>
        <!-- USER & ADMIN CAN SEE ADD REVIEW -->
        <?php if ($_SESSION['username']) {?>
        <!-- Add a Review Button -->
        <a href="./addReview.php" class="button">Add a Review</a>
        <?php }?>
    </main>
    <!-- Footer -->
    <?php require_once '../footer.php'?>
</body>



</html>