<?php
$_SESSION['user_type'] = 'admin';

$cid = $_POST['cid'];

//next example will insert new conversation
$service_url = "https://tcc353.encs.concordia.ca/api/index.php/contracts/{$cid}/delete";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $service_url);
$headers = array(
    'Authorization: Basic '.base64_encode($_SERVER['PHP_AUTH_USER'].':'.$_SERVER['PHP_AUTH_PW'])
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

header("Location: ../site/adminHome.php");


?>


