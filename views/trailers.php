<?php
require_once '../vendor/autoload.php';

?>
<!DOCTYPE html>
<html lang="EN">
  <head>
    <meta charset="UTF-8">
    <meta name="description" content="Movie App 'Trailers' Page">
    <meta name="author" content="Bryan Hughes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Movie, Trailers, Movie Trailers">
    <link rel="stylesheet" href="../styles/style.css" type="text/css">
    <link rel="stylesheet" href="../styles/trailer_style.css">
    <script src="../scripts/script.js"></script>
  </head>
  <body>
    <!--Header-->
    <?php require_once './header.php' ?>
    <!--Master Container-->
    <div class="master-container">
      <div class="trailer-container">
        <?php
        require_once "../Model/TrailerData.php";
        //use PhPKnights\Model\TrailerData;
        // $localTrailer = new TrailerData();

        //URL to IMDb Trailer API
        $url = 'http://www.omdbapi.com/?i=tt3896198&apikey=3f654760';
        $response = file_get_contents($url);
        $decodedResponse = json_decode($response);
        //var_dump($decodedResponse);

        foreach ($decodedResponse as $key => $value) {

          if ($key == "Poster")
          {
            //$trailerToDisplay = TrailerData::makePoster($value);
            //echo $trailerToDisplay;

          }
        }
        ?>
      </div>
    </div>
    <!--Footer-->
    <?php require_once './footer.php' ?>
  </body>
</html>