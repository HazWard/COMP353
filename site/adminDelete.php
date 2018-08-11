<?php
$_SESSION['user_type'] = 'admin';

$cid = $_POST['cid'];

//next example will insert new conversation
$service_url = "http://localhost:8888/api/index.php/contracts/{$cid}";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $service_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

header("Location: /site/adminHome.php");


?>


