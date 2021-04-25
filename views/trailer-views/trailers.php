<?php
session_start();

use PhPKnights\Model\{Database, Trailer};
require_once '../../vendor/autoload.php';

//Connect to the Database
$db = Database::getDb();
//Store a new trailer object
$trailer = new Trailer();
//Set the $movieObj to the #1 rank so there's a trailer on load
$movieObj = $trailer->validateForm(1, $db);


if (isset($_POST['searchTrailer'])) {
  //Capture user inputted rank
  $rank = $_POST['movieRank'];
  //User input must be between 1 and 250
  if ($rank < 1 || $rank > 250) {
    echo "Please enter a valid number";
  } else {
    //Capture the queryResult of the validateForm function
    $movieObj = $trailer->validateForm($rank, $db);
  }
}

?>
<!DOCTYPE html>
<html lang="EN">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Movie App 'Trailers' Page">
  <meta name="author" content="Bryan Hughes">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="Movie, Trailers, Movie Trailers">
  <link rel="stylesheet" href="../../styles/style.css" type="text/css">
  <link rel="stylesheet" href="../../styles/trailer_style.css">
  <script src="../../scripts/script.js"></script>
</head>

<body>
  <!--Master Container-->
  <main class="master-container">
    <?php require_once '../header.php' ?>

    <div class="form-container">
      <form method="POST">
        <h1 class="title">Enter a Number Between 1 & 250</h1>
        <fieldset>
          <input name="movieRank" type="number" class="input" required>
          <input name="searchTrailer" type="submit" value="Search Trailers" class="submitBtn">
        </fieldset>
      </form>
    </div>


    <div class="trailer-container">
      <?php

      //URL to IMDb Trailer API
      $trailerURL = "https://imdb-api.com/en/API/Trailer/k_tlju98cy/$movieObj->id";

      $response = file_get_contents($trailerURL);

      $decodedResponse = json_decode($response);
      //var_dump($decodedResponse);


      //Open an iframe element tag
      $ModifiedLink = '<iframe class="trailer-frame" src="';
      //Append the Embeddable Link
      $ModifiedLink .=  $decodedResponse->linkEmbed;
      //Append the remaining iframe data and the closing iframe tag
      $ModifiedLink .= '" title="Trailer Player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

      echo $ModifiedLink;
      ?>

    </div>
    <?php require_once '../footer.php' ?>
  </main>
  <!--Footer-->
</body>

</html>