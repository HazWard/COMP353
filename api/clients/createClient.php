<?php

$clientArray = $_POST;

//next example will insert new conversation
$service_url = 'https://tcc353.encs.concordia.ca/api/index.php/clients';
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
$headers = array(
    'Authorization: Basic '.base64_encode($_SERVER['PHP_AUTH_USER'].':'.$_SERVER['PHP_AUTH_PW'])
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
curl_exec($curl);
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);


if ($httpcode == 200) {
    header("Location: ../site/SAhome.php");
}
else{
    echo 'Error';
}

function getProvinceAbbrev($province){

    switch($province) {
        case 'Ontario':
            return 'ON';
        case 'Quebec':
            return 'QC';
        case 'British Columbia':
            return 'BC';
        case 'Alberta':
            return 'AB';
        case 'Nova Scotia':
            return 'NS';
        case 'Saskatchewan':
            return 'SK';
        case 'Manitoba':
            return 'MB';
        case 'New Brunswick':
            return 'NB';
        case 'Newfoundland and Labrador':
            return 'NL';
        case 'Prince Edward Island':
            return 'PE';
        case 'Nunavut':
            return 'NU';
        case 'Yukon':
            return 'YT';
        case 'Northwest Territories':
            return 'NT';
    }
}