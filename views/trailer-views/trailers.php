<?php
//Start a new server session
session_start();
//Include the Database and the Movie models
use PhPKnights\Model\{Database, Trailer};
//Autoload Documents
require_once '../../vendor/autoload.php';

$id = $title = $fullTitle = "";
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
    <script src="../scripts/script.js"></script>
  </head>
  <body>
    <header>
      <?php require_once '../header.php' ?>
    </header>
    <!--Master Container-->
    <main class="master-container">

      <div class="form-container">
        <h1>Search a Trailer</h1>
        <form action="../../scripts/TrailerScript.php" method="POST">
          <fieldset>
            <input name="trailerSearch" type="text" class="input" required>
          </fieldset>
        </form>
      </div>


      <div class="trailer-container">
        <?php
        //URL to IMDb Trailer API
        $trailerURL = 'https://imdb-api.com/en/API/Title/k_tlju98cy/tt1375666/FullActor,Posters,Trailer,';
        $response = file_get_contents($trailerURL);
        $decodedResponse = json_decode($response);
        //var_dump($decodedResponse);

        foreach ($decodedResponse as $key => $value) {

          //var_dump($key, $value);
        }
        ?>
      </div>


    </main>

    <div class="footer-container">
      <!--Footer-->
      <?php require_once '../footer.php' ?>
    </div>
  </body>
</html>