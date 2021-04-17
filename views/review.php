<?php

use PhPKnights\Model\Database;
use PhPKnights\Model\Review;

require_once '../Model/Review.php';
require_once '../Model/Database.php';

$dbcon = Database::getDb();
$reviewModel = new Review();

$reviews = $reviewModel->getAllReviews(Database::getDb());

?>

<html lang="en">

<head>
    <title>Reviews</title>
    <link rel="stylesheet" href="../styles/style.css" type="text/css">
    <link rel="stylesheet" href="../styles/review_style.css" type="text/css">
</head>

<body>
    <!-- Header -->
    <?php require_once './header.php'?>

    <!-- MAIN REVIEW SECTION -->
    <h1>Reviews in the Database</h1>
    <!-- Displaying Reviews in a Table -->
    <table class="review-table">
        <thead>
            <tr>
                <th>Reviewed Movie</th>
                <th>Review</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reviews as $review) {?>
            <tr>
                <td><?=$review->review_movie;?></td>
                <td><?=$review->review_content;?></td>
                <td><?=$review->review_rating;?></td>

            </tr>
            <?php }?>
        </tbody>
    </table>

    <!-- Footer -->
    <?php require_once './footer.php'?>
</body>



</html>