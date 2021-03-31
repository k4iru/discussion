<?php

use HTTP_5202_GROUP\database\Database;
require_once '../database/database.php';
$dbcon = Database::getDb();

if (isset($_GET['search'])) {
    $key = $_GET["search"]; //getting search input

    //search query
    $query = "Select * from movies where `movie_name` like '%$key%'";

    $result = $dbcon->prepare($query);
    $result->execute();

    if ($result < 0) {
        echo "No results found";
    } else {
        return $result->fetchAll(\PDO::FETCH_OBJ);
    }

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