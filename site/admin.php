<?php

$id = $_POST['id'];
$company = $_POST['company'];
$category = $_POST['category'];
$serviceType = $_POST['serviceType'];
$acv = $_POST['acv'];
$initialAmount = $_POST['initialAmount'];
$startDate = $_POST['startDate'];
$dev1 = $_POST['firstDeliverable'];
$dev2 = $_POST['secondDeliverable'];
$dev3 = $_POST['thirdDeliverable'];
$dev4 = $_POST['fourthDeliverable'];
$score= $_POST['score'];
$manager = $_POST['manager'];

//next example will insert new conversation
$service_url = "https://tcc353.encs.concordia.ca/api/index.php/contracts/{$id}";
$curl = curl_init($service_url);
$curl_post_data = array(
    'id' => $id,
    'company' => $company,
    'category' => $category,
    'serviceType' => $serviceType,
    'acv' => $acv,
    'initialAmount' => $initialAmount,
    'startDate' => $startDate,
    'firstDeliverable' => $dev1,
    'secondDeliverable' => $dev2,
    'thirdDeliverable' => $dev3,
    'fourthDeliverable' => $dev4,
    'score' => $score,
    'manager' => $manager
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
    header("Location: ../site/adminHome.php");
}

?>

