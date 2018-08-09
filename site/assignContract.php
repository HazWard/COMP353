<?php

$contractID = $_POST['contract_id'];
$employeeID = $_POST['hiddenID'];

$service_url = 'http://localhost/COMP353/api/index.php//employees/'.$employeeID.'/contracts';
$curl = curl_init($service_url);
$curl_post_data = array(
    'cid' => $contractID
);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
curl_exec($curl);
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);



header("Location: /COMP353/site/managerHome.php");