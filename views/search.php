<?php

use PhPKnights\Model\Database;
use PhPKnights\Model\Search;

// require_once '../vendor/autoload.php';
require_once '../Model/Database.php';
require_once '../Model/Search.php';

if (isset($_GET['search'])) {
    $dbcon = Database::getDb();
    $searchModel = new Search();

    $searchResults = $searchModel->SearchTop250Movies(Database::getDb());
}
?>

<html lang="en">

<head>
    <title>Search Results</title>
    <link rel="stylesheet" href="../styles/style.css" type="text/css">
    <link rel="stylesheet" href="../styles/search-style.css" type="text/css">
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
            <?php foreach ($searchResults as $results) {?>
            <tr>
                <!-- fetching associative array, will fill out when our database has info -->
                <td><?=$results->title;?></td>
                <td><?=$results->image;?></td>
                <td><?=$results->crew;?></td>
            </tr>
            <?php }?>
            <!-- end of associative array -->

        </tbody>
    </table>

    <!-- Footer -->
    <?php require_once './footer.php'?>

</body>

</html>