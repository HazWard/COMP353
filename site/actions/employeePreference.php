<?php
session_start();
if(isset($_SESSION['username'])) {
    $id = $_SESSION['username'];
}

$employeeArray = $_POST;

$service_url = 'http://localhost/api/index.php/employees/'.$id.'/preferences';
$curl = curl_init($service_url);
$curl_post_data = array(
    'category' => $employeeArray['category'],
    'type' => $employeeArray['type']
    );
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
curl_exec($curl);

$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if ($httpcode == 200) {
	//redirects to next page: log hours (will be created soon)
    header("Location: /COMP353/site/logHours.html");
} else{
    echo 'Error';
}

?>
