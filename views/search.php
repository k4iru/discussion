<?php

//database connection here



if (isset($_GET['search']))
{
    $key = $_GET["search"]; //Key = getting search input

        //search query
    $query = "Select * from movies where `movie_name` like '%$key%'";

    $result = $db->prepare($query);
    $result->execute();

    return $result->fetch(\PDO::FETCH_OBJ);
}
?>

<html lang="en">

<head>
    <title>Search Results</title>
    <link rel="stylesheet" type="text/css" href="..." />
</head>

<body>
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
            <?php foreach ($movies as $movie) { ?>
            <tr>
                <!-- fetching associative array, will fill out when our database has info -->
                <th>
                <th>
            </tr>
            <?php } ?>
            <!-- end of associative array -->

        </tbody>
    </table>

</body>

</html>