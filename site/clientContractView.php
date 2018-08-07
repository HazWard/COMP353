<?php

session_start();
$test = $_SESSION['user_type'];
echo "<h1>" . $test . "</h1>" ;
die;
$service_url = 'http://localhost/COMP353/api/index.php/clients';
$curl = curl_init($service_url);
$curl_post_data = array(
    'name' => $clientArray['companyName'],
    'number' => $clientArray['companyNumber'],
    'email' => $clientArray['email'],
    'firstName' => $clientArray['firstName'],
    'lastName' => $clientArray['lastName'],
    'middleInitial' => $clientArray['middleInitial'],
    'city' => $clientArray['city'],
    'province' => getProvinceAbbrev($clientArray['province']),
    'lob' => $clientArray['LOB'],
    'password' => $clientArray['password'],
);