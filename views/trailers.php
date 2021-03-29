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
        $curl = curl_init();


        curl_setopt_array($curl, array(

          CURLOPT_URL => "https://imdb-api.com/en/API/Title/k_1234567/tt1832382",

          CURLOPT_RETURNTRANSFER => true,

          CURLOPT_ENCODING => "",

          CURLOPT_MAXREDIRS => 10,

          CURLOPT_TIMEOUT => 0,

          CURLOPT_FOLLOWLOCATION => true,

          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

          CURLOPT_CUSTOMREQUEST => "GET",

        ));


        $response = curl_exec($curl);


        curl_close($curl);

        echo $response;
        ?>
      </div>
    </div>

    <!--Footer-->
    <?php require_once './footer.php' ?>
  </body>
</html>