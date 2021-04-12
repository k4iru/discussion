<?php
namespace PhPKnights\Model;
use PhPKnights\Model\Database;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="description" content="User Information Form">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Bryan Hughes">
    <link rel="stylesheet" href="../styles/style.css" type="text/css">
    <link rel="stylesheet" href="../styles/user_style.css" type="text/css">
  </head>
  <body>
    <div class="form-container">
      <form action="" method="POST">
        <fieldset>
          <label for="movieName">Search A Movie Title:</label>
          <input type="text" name="movieName" class="input">

          <input type="submit" name="submit">
        </fieldset>
        <?php
          $submit = $_POST["submit"];
          if(isset($submit)) {
            $movieName = $_POST["movieName"];

          }
        ?>
      </form>
    </div>
  </body>
</html>