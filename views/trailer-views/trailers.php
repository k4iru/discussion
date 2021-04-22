<?php
//Start a new server session
session_start();
//use PhPKnights\Model\Database;
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
        <form action="../../scripts/TrailerScript.php/validateForm" method="POST">
          <fieldset>
            <input name="movieRank" type="number" class="input" required>

            <input name="searchTrailer" type="submit" value="Search Trailers" class="submitBtn">
          </fieldset>
        </form>
      </div>


      <div class="trailer-container">
        <?php

        ?>
      </div>


    </main>

    <div class="footer-container">
      <!--Footer-->
      <?php require_once '../footer.php' ?>
    </div>
  </body>
</html>