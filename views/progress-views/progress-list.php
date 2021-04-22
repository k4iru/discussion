<?php
// namespace PhPKnights\Model;
use PhPKnights\Model\{Database, Progress};

// require_once '../vendor/autoload.php';  <---- Not working for some reason, to figure out later

require_once '../../Model/Database.php';
require_once '../../Model/Progress.php';

$dbcon = Database::getDb();
$progressClass = new Progress();
$progress =  $progressClass->getMovieProgress(Database::getDb(), 2, 1);

?>
<html lang="en">
<head>
    <title> User Created Movie Lists</title>
    <meta name="description" content="User Created Movie Lists">
    <meta name="keywords" content="Movie Lists">
    <link rel="stylesheet" href="../../styles/style.css" type="text/css">
    <link rel="stylesheet" href="../../styles/list_style.css" type="text/css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
</head>

    <body>
        <!--Header-->
        <?php require_once '../header.php' ?>

        <main id="main">
            <p class="h1 text-center">Movie Progress</p>
            <div class="m-1">
                <!--    Displaying Data in Table-->
                <table class="table table-bordered tbl">
                    <thead>
                    <tr>
                        <th scope="col">Progress</th>
                    </tr>
                    </thead>
                    <tbody>
                            <td><?= $progress->movie_progress; ?></td>
                            <td>
                                <form action="update-list.php" method="post">
                                    <input type="hidden" name="id" value="<?= $progress->id; ?>"/>
                                    <input type="submit" class="button btn btn-primary" name="updateList" value="Update"/>
                                </form>
                            </td>
                            <td>
                                <form action="delete-list.php" method="post">
                                    <input type="hidden" name="id" value="<?=  $progress->id; ?>"/>
                                    <input type="submit" class="button btn btn-danger" name="deleteList" value="Delete"/>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="./add-list.php" id="btn_addList" class="btn btn-success btn-lg float-right">Add List</a>
            </div>
        </main>

        <!--Footer-->
        <?php require_once '../footer.php' ?>
    </body>
</html>