<?php
session_start();

if(isset($_SESSION['username'])) {
    $eid = $_SESSION['username'];
}

$cid = $_POST["contractid"];

$logHourArray = $_POST;


$service_url = 'http://localhost/COMP353/api/index.php/employees/'.$eid.'/contracts/'.$cid;
$curl = curl_init($service_url);
$curl_post_data = array(
    "employee_id"=> $eid,
    "contract_id"=> $cid,
    "hours_worked"=> $logHourArray['hours']
       );


curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
curl_exec($curl);
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ($httpcode == 200) {
    header("Location: /COMP353/site/employeeHome.php");
} else{
    echo 'Error';
}
?>
