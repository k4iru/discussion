<?php

use PhPKnights\Model\Database;
use PhPKnights\Model\Review;

require_once '../../Model/Database.php';
require_once '../../Model/Review.php';
require_once '../../Model/User.php';
require_once '../../scripts/review-fill.php';

session_start();

//initalizing variables as empty string

$review_movie = $review_rating = $review_content = "";

$r2 = new Review();
$titles = $r2->getMovieTitles(Database::getDb());

if (isset($_POST['updateReview'])) {
    $id = $_POST['id'];
    $dbcon = Database::getDb();

    $r = new Review();
    $review = $r->getReviewById($id, $dbcon);

    //putting value of reviews into the form field
    $review_movie = $review->review_movie;
    $review_rating = $review->review_rating;
    $review_content = $review->review_content;
}

if (isset($_POST['updateReviewFinal'])) {
    $id = $_POST['id'];
    $review_movie = $_POST['review_movie'];
    $review_rating = $_POST['review_rating'];
    $review_content = $_POST['review_content'];

    $dbcon = Database::getDb();
    $r = new Review();
    $count = $r->updateReview($dbcon, $id, $review_movie, $review_rating, $review_content);

    if ($count) {
        header('Location: ../../views/reviews/review.php');
    } else {
        echo "Problem updating review";
    }
}

?>

<html lang="en">

<head>
    <title>Update Review</title>
    <meta name="description" content="update a review">
    <link rel="stylesheet" href="../../styles/style.css" type="text/css">
    <link rel="stylesheet" href="../../styles/review_style.css" type="text/css">


</head>

<body>
    <?php include_once "../header.php";?>
    <main id="main">

        <!-- FORM TO ADD A REVIEW -->
        <form action="" method="post">

            <div>
                <label for="review_movie">Movie: </label>
                <select name="review_movie" id="review_movie">
                    <option value="<?=$review_movie;?>"><?=$review_movie;?></option>
                </select>
            </div>

            <div>
                <label for="review_rating">Rating: </label>
                <input type="number" name="review_rating" id="review_rating" value="<?=$review_rating;?>" placeholder="
                    Rating" min="1" max="5">
            </div>

            <div>
                <label for="review_content">How did you like this movie? </label>
                <input type="text" name="review_content" id="review_content" value="<?=$review_content;?>" placeholder="
                    Review Here">
            </div>


            <a href="../../views/reviews/review.php">Back</a>
            <button type="submit" name="updateReviewFinal">Update Review</button>

        </form>

    </main>
    <?php include_once "../footer.php";?>

</body>

</html>