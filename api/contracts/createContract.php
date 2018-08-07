<?php
$contractArray = $_POST;


//next example will insert new conversation
$service_url = 'http://localhost/COMP353/api/index.php/contracts';
$curl = curl_init($service_url);
$curl_post_data = array(
    'company' => $contractArray['company'],
    'category' => $contractArray['category'],
    'serviceType' => $contractArray['serviceType'],
    'acv' => $contractArray['acv'],
    'initialAmount' => $contractArray['initialAmount'],
    'manager' => $contractArray['manager'],
);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
curl_exec($curl);
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);


if ($httpcode == 200) {
    header("Location: /COMP353/site/SAhome.php");
}
else{
    echo 'Error';
}