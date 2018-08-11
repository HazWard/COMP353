<?php
session_start();
$companyName = $_SESSION['company_name'];

/*$service_url = 'http://localhost/COMP353/api/index.php//clients/'.$companyName.'/contracts';
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
);*/
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/clientContract.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="header">
    <h2>Contracts for <?php echo $_SESSION['company_name']?></h2>
    <input type="hidden" id="companyName" value="<?php echo $_SESSION['company_name']?>">
    <button value="submit1" id="submit1">View Contracts</button>
    <button><a href="ClientHome.php" style="text-decoration: none; color: black"> Back to client homepage</a></button>
</div>


<div class="header">
    <p id = "clientContracts"></p>
    <p id = "manager"></p>
</div>