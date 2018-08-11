<?php
session_start();
$companyName = $_SESSION['company_name'];

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