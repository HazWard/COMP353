<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must login first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
    <h2>Home Page</h2>
</div>
<div>
    <?php  if (isset($_SESSION['username'])) : ?>
        <p align="center">
            <a href="index.php?logout='1'">logout</a>
        </p>
    <?php endif ?>
</div>

</body>
</html>