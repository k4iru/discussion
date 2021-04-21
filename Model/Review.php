<?php

namespace PhPKnights\Model;

class Review
{

    //get all reviews
    public function getAllReviews($dbcon)
    {

        $query = "SELECT * FROM review";
        $pdostm = $dbcon->prepare($query);
        $pdostm->execute();

        $reviews = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $reviews;
    }

    //get reviews based on user id
    public function getReviewById($id, $dbcon)
    {
        $query = "SELECT * FROM review WHERE id = :id";
        $pdostm = $dbcon->prepare($query);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();
        return $pdostm->fetch(\PDO::FETCH_OBJ);
    }

    //get movie titles for create review
    public function getMovieTitles($db)
    {
        $sql = "SELECT * FROM top250Movies";
        $pdostm = $db->prepare($sql);
        $pdostm->execute();

        //getting results
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }

    //get movie posters for each review
    public function getMoviePoster($db, $review_movie)
    {
        $sql = "SELECT image FROM `top250Movies` WHERE title = :review_movie";

        $pdostm = $db->prepare($sql);
        $pdostm->bindParam(':review_movie', $review_movie);
        $pdostm->execute();

        //getting results
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }

    //create a review
    public function addReview($dbcon, $review_movie, $review_rating, $review_content)
    {
        $query = "INSERT INTO review (review_movie, review_content, review_rating) VALUES (:review_movie, :review_content, :review_rating)";

        $pdostm = $dbcon->prepare($query);
        $pdostm->bindParam(':review_movie', $review_movie);
        $pdostm->bindParam(':review_rating', $review_rating);
        $pdostm->bindParam(':review_content', $review_content);

        return $pdostm->execute();

    }

    //update a review
    public function updateReview($dbcon, $id, $review_movie, $review_rating, $review_content)
    {
        $query = "UPDATE review SET
        review_movie = :review_movie,
        review_content = :review_content,
        review_rating = :review_rating WHERE
        id = :id";

        $pdostm = $dbcon->prepare($query);
        $pdostm->bindParam(':review_movie', $review_movie);
        $pdostm->bindParam(':review_content', $review_content);
        $pdostm->bindParam(':review_rating', $review_rating);
        $pdostm->bindParam(':id', $id);

        $count = $pdostm->execute();

        return $count;
    }

    //delete a review
    public function deleteReview($id, $dbcon)
    {
        $sql = "DELETE FROM review WHERE id = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $delete = $pdostm->execute();
        return $delete;
    }

}