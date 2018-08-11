<?php
session_start();
$managerID = $_SESSION['company_name'];

?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/viewManagerScores.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="header">
    <h2>Enter a manager ID to view his or her satisfaction scores</h2>
    <input type="text" id="mid" name="mid" placeholder="Enter Manager ID">
    <button value="submit1" id="submit1">View Satisfaction Scores</button>
    <button><a href="ClientHome.php" style="text-decoration: none; color: black"> Back to client homepage</a></button>
</div>


<div class="header">
    <p id = "managerScores"></p>
</div>