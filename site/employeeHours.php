<?php
session_start();


$eid = $_POST["eid"];
$cid = $_POST["cid"];
$hours = $_POST["hours"];

$logHourArray = $_POST;


$service_url = 'https://tcc353.encs.concordia.ca/api/index.php/employees/'.$eid.'/contracts/'.$cid;
$curl = curl_init($service_url);
$curl_post_data = array(
    "eid" => $eid,
    "cid" => $cid,
    "numHours"=> $hours
       );


curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
curl_exec($curl);
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ($httpcode == 200) {
    header("Location: ../site/employeeHome.php");
} else{
    echo 'Error';
}
?>
