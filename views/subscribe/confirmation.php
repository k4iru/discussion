<?php

session_start();

define('PAYPAL_API_URL', 'https://api-m.sandbox.paypal.com');

$PAYPAL = array(
  'client_id' => 'ATliACNc2QJoomxHliH05W7lta1iV932HZsXVpTapHvh8AbfwvpGvl_ZqpwwhR75w7LTlxuWNTiluu3T',
  'client_secret' => 'EBODAiQSmknWyZNNoPn33mjud_RQ_dHnJoBDkSnX-C8xAEcXraAV7tgr95MusZL1XT8G9UcaI-qkkE3G',
  'redirect_uri' => 'http://localhost/HTTP-5202-Group/views/subscribe/subscribe.php'
);

function capture_payment($id) {
    $url = PAYPAL_API_URL . '/v2/checkout/orders/' . $id . '/capture' ;
    
    $opts = array(
    'http' => array (
        'method'=>"POST",
        'header'=>
            "Content-Type: application/json" . "\r\n" .
            "Authorization: Bearer " . $_SESSION['paypal']['token']
    )
    );
    
    $context = stream_context_create($opts);

    $response = @file_get_contents($url, false, $context);
    $result = json_decode($response);
    // print_r($result->status);
    if (isset($result->status)) {
        $_SESSION['paypal']['phpknights']['status'] = $result->status;
    }


    //  
    // OLD STUFF
    //

    // $headers = array(
    //   "Content-Type: application/json",
    //   "Authorization: Bearer " . $_SESSION['paypal']['token']
    // );
  
    // $opts = array(
    //   CURLOPT_HTTPHEADER => $headers,
    //   CURLOPT_URL => $url,
    //   CURLOPT_POST => true,
    //   // CURLOPT_POSTFIELDS => json_encode($data),
    //   CURLOPT_RETURNTRANSFER => true
    // );
  
    // $curl = curl_init(); //initialize curl session
    // curl_setopt_array($curl, $opts); //set curl options
    // $result = json_decode(curl_exec($curl));
    // // var_dump($result->details[0]->issue);

    if ($result == NULL && isset($_SESSION['paypal']['phpknights']['status'])) {
        $status =  'CAPTURED';
    } else if ($result == NULL) {
        $status = "";
    } else {
        $status = $result->status;
    }

    global $test;
    if ($status == "COMPLETED" || $status == "CAPTURED") {
        $test = "true";
    } else {
        $test = "false";
    }

    // curl_close($curl);
}

capture_payment($_SESSION['paypal']['phpknights']['id']);

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
            <div class="container">
            <a href="../../index.php" id="btn_addList" class="button back">Return Home</a>  
            <?php 
                if ($test == 'true') { ?>
                    <h1 class="main-header">Confirmation</h1>
                    <div>
                        <p>Thank you, We have received your payment!</p>
                        <p>You now have full access of all site features</p>
                    </div>
                <?php 
                } else { ?>
                    <h1 class="main-header">Unconfirmed</h1>
                    <div>
                        <p>Something Went Wrong With your Payment!</p>
                    </div>
                <?php 
                }
            ?>
            </div>
        </main>

        <!--Footer-->
        <?php require_once '../footer.php' ?>
    </body>
</html>