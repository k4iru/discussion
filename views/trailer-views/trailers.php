<?php
//Start a new server session
session_start();

use PhPKnights\Model\{Database, Trailer};
//use PhPKnights\Model\Database;
//Autoload Documents
require_once '../../vendor/autoload.php';

$db = Database::getDb();
$trailer = new Trailer();
if (isset($_POST['searchTrailer'])) {
  $rank = $_POST['movieRank'];
  if ($rank < 1 || $rank > 250) {
    echo "Please enter a valid number";
  } else {
    $movieObj = $trailer->validateForm($rank, $db);
  }
}
//$id = $title = $fullTitle = "";
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
  <header>
    <?php require_once '../header.php' ?>
  </header>
  <!--Master Container-->
  <main class="master-container">

    <div class="form-container">
      <h1>Enter a Number Between 1 & 250</h1>
      <form method="POST">
        <fieldset>
          <input name="movieRank" type="number" class="input" required>

          <input name="searchTrailer" type="submit" value="Search Trailers" class="submitBtn">
        </fieldset>
      </form>
    </div>


    <div class="trailer-container">
      <?php
      //var_dump($movieObj->id);
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


  </main>

  <div class="footer-container">
    <!--Footer-->
    <?php require_once '../footer.php' ?>
  </div>
</body>

</html>