<?php include('connection.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
 </head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  		<label>Username</label>
  		<input type="text" name="username" placeholder="EmployeeID/Comapny Email">
  		<label>Password</label>
  		<input type="password" name="password" placeholder="Password">
  		<button type="submit" class="button" name="login_button">Login</button>
  	<p>
  		Not yet registered? <a href="register.php">Register</a>
  	</p>
  </form>
</body>
</html>