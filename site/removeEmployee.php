<?php

$contractID = $_POST['contractID'];
$employeeID = $_POST['employeeID'];

$service_url = 'http://localhost/COMP353/api/index.php/employees/'.$employeeID.'/contracts/'.$contractID.'';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $service_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

header("Location: /COMP353/site/managerHome.php");