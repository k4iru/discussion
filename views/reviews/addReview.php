<?php

use PhPKnights\Model\Database;
use PhPKnights\Model\Review;

require_once '../../Model/Database.php';
require_once '../../Model/Review.php';
require_once '../../Model/User.php';
require_once '../../scripts/review-fill.php';

session_start();
$r = new Review();
$titles = $r->getMovieTitles(Database::getDb());

if (isset($_POST["addReview"])) {
//Getting form values
    $review_movie = $_POST['review_movie'];
    $review_rating = $_POST['review_rating'];
    $review_content = $_POST['review_content'];

//connect to DB
    $dbcon = Database::getDb();
    $r = new Review();
    $x = $r->addReview($dbcon, $review_movie, $review_rating, $review_content);

    if ($x) {
        echo "Review added";
    } else {
        echo "Error in adding the review";
    }

}

// if (isset($_SESSION['username'])) {}

?>

<html lang="en">

<head>
    <title>Create a Review</title>
    <meta name="description" content="create a review">
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
                    <?php echo fillSelect($titles) ?>
                </select>
            </div>

            <div>
                <label for="review_rating">Rating: </label>
                <input type="number" name="review_rating" id="review_rating" placeholder="Rating" min="1" max="5">
            </div>

            <div>
                <label for="review_content">How did you like this movie? </label>
                <input type="text" name="review_content" id="review_content" placeholder="Review Here">
            </div>


            <a href="../../views/reviews/review.php">Back</a>
            <button type="submit" name="addReview">Add Review</button>

        </form>

    </main>
    <?php include_once "../footer.php";?>

</body>

</html>