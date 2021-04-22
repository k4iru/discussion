<?php
session_start();

define('PAYPAL_API_URL', 'https://api-m.sandbox.paypal.com');

$PAYPAL = array(
  'client_id' => 'ATliACNc2QJoomxHliH05W7lta1iV932HZsXVpTapHvh8AbfwvpGvl_ZqpwwhR75w7LTlxuWNTiluu3T',
  'client_secret' => 'EBODAiQSmknWyZNNoPn33mjud_RQ_dHnJoBDkSnX-C8xAEcXraAV7tgr95MusZL1XT8G9UcaI-qkkE3G',
  'redirect_uri' => 'http://localhost/HTTP-5202-Group/views/subscribe/subscribe.php'
);

$href = '';
$rel = '';

function get_token($config) {
  $url = PAYPAL_API_URL . '/v1/oauth2/token';
  $headers = array(
    'Accept: application/json',
    'Accept-Language: en_US'
  );
  //-H corresponds to HTTPHEADER
  //-u corresponds to USERPWD
  //-d corresponds to POSTFIELDS
  $options = array(
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_USERPWD => $config['client_id'] . ':' . $config['client_secret'],
    CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
    CURLOPT_RETURNTRANSFER => true
  );
  $curl = curl_init();
  curl_setopt_array($curl, $options);
  $result = json_decode(curl_exec($curl));
  // var_dump($result);
  $_SESSION['paypal']['token'] = $result->access_token;
  curl_close($curl);
}

function create_order($config) {
  $url = PAYPAL_API_URL . '/v2/checkout/orders';
  $headers = array(
    "Content-Type: application/json",
    "Authorization: Bearer " . $_SESSION['paypal']['token']
  );
  $data = array(
    "intent" => "CAPTURE",
    "purchase_units" => array(
      array(
        "amount" => array(
          "currency_code" => "CAD",
          "value" => "10.00"
        )
      )
    ),
    'application_context' => array(
      'brand_name' => 'PHP Knights Movie App',
      'user_action' => 'PAY_NOW',
      'return_url' => 'http://localhost/HTTP-5202-Group/views/subscribe/confirmation.php'
    ) 
  );

  // print json_encode($data);

  $opts = array(
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_RETURNTRANSFER => true
  );

  $curl = curl_init(); //initialize curl session
  curl_setopt_array($curl, $opts); //set curl options
  $result = json_decode(curl_exec($curl));
//   var_dump($result->id);

  $_SESSION['paypal']['phpknights']['id'] = $result->id;
//   var_dump($test);

  global $href;
  global $rel;
  $href = $result->links[1]->href;
  $rel = $result->links[1]->rel;

//   echo($href . $rel);

  curl_close($curl);
  // print '<p> Hello </p>';
//   print '<a rel="' . $result->links[1]->rel . '" href="' . $result->links[1]->href . '">Pay with Paypal</a>';
//   return $result->status;
}

get_token($PAYPAL);
create_order($PAYPAL);

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
            <a href="../../index.php" id="btn_back" class="button back">Return Home</a>
            <h1 class="main-header"> Subscribe Now To Get More Access to the Site</h1>
            <p> For a One-Time Fee of 9.99 CAD, you can have full access to all Member Features such as Forums and Custom Movie Lists!</p>
            <a rel="<?= $rel; ?>" href="<?= $href; ?>" class="button navigation-button">Pay with Paypal</a>
          </div>
        </main>

        <!--Footer-->
        <?php require_once '../footer.php' ?>
    </body>
</html>