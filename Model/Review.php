<?php

namespace PhPKnights\Model;

class Review {

   //get all reviews
   public function getAllReviews($dbcon) {

    $query = "SELECT * FROM review";
    $pdostm = $dbcon->prepare($query);
    $pdostm->execute();

    $reviews = $pdostm->fetchAll(\PDO::FETCH_OBJ);
    return $reviews;
   }

   //get reviews based on user id

   //get reviews based on movie title

   //create a review

   //update a review

   //delete a review








}