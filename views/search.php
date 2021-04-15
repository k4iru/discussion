<?php

use PhPKnights\Model\Database;
// require_once '../vendor/autoload.php';
require_once '../Model/Database.php';

if (isset($_GET['search'])) {
    $db = Database::getDb(); //connecting to database
    $key = trim($_GET["search"]); //getting search input

    //search query
    $query = "SELECT * FROM top250Movies WHERE `title` LIKE '%$key%'";

    $result = $db->prepare($query);
    $result->execute();

}
?>

<html lang="en">

<head>
    <title>Search Results</title>
    <link rel="stylesheet" type="text/css" href="..." />
</head>

<body>

    <!-- HEADER -->
    <?php require_once 'header.php'?>


    <h1> Search Results </h1>


    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Actors</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movies as $movie) {?>
            <tr>
                <!-- fetching associative array, will fill out when our database has info -->
                <td></td>
                <td></td>
            </tr>
            <?php }?>
            <!-- end of associative array -->

        </tbody>
    </table>

    <!-- Footer -->
    <?php require_once './footer.php'?>

</body>

</html>