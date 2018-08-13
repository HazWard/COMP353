<?php

$contractID = $_POST['contractID'];
$employeeID = $_POST['employeeID'];

$service_url = 'https://tcc353.encs.concordia.ca/api/index.php/employees/'.$employeeID.'/contracts/'.$contractID.'/delete';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $service_url);
$headers = array(
    'Authorization: Basic '.base64_encode($_SERVER['PHP_AUTH_USER'].':'.$_SERVER['PHP_AUTH_PW'])
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

header("Location: ./managerHome.php");