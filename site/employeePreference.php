<?php
session_start();
if(isset($_SESSION['username'])) {
    $id = $_SESSION['username'];
}

$eid = $_POST['eid'];
$category = $_POST['category'];
$type = $_POST['type'];
$employeeArray = $_POST;

$service_url = 'https://tcc353.encs.concordia.ca/api/index.php/employees/'.$eid.'/preferences';
$curl = curl_init($service_url);
$curl_post_data = array(
    'category' => $category,
    'type' => $type
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
    header("Location: ../site/employeeHome.php");
} else{
    echo 'Error';
}
?>

