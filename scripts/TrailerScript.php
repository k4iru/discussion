<?php
use PhPKnights\Model\Database;



//function validateForm()
//{
//  if (isset($_POST['searchTrailer'])) {
//    $rank = $_POST['movieRank'];
//    $db = Database::getDb();

//    $query = "SELECT * FROM top250Movies WHERE rank_ = $rank";
//    $pdoStm = $db->prepare($query);
//    $pdoStm->execute();
//    return $pdoStm->fetchAll();
//  }else {
//    echo "error";
//  }
//}




//Redirect back to the header page
//header("Location: ../views/trailer-views/trailers.php");

////URL to IMDb Trailer API
//$trailerURL = 'https://imdb-api.com/en/API/Title/k_tlju98cy/tt1375666/FullActor,Posters,Trailer';
//$response = file_get_contents($trailerURL);
//$decodedResponse = json_decode($response);
////var_dump($decodedResponse);

//foreach ($decodedResponse as $key => $value) {

//  //var_dump($key, $value);
//}

?>