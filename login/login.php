<?php include('connection.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="loginbox">
<div class="header">
    <h2>Login</h2>
</div>

<form method="post" action="login.php">
    <?php include('errors.php'); ?>

    <label>Username</label>
    <input type="text" name="username" placeholder="EmployeeID/Company Email"><br/>
    <label>Password</label>
    <input type="password" name="password" placeholder="Password">
    <br/>
    <button type="submit" class="button" name="login_button">Login</button>
</form>
</div>
</body>
</html>