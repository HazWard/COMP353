<?php
session_start();

// initialize variables to your needs
$username = "";
$errors = array(); 
$host = 'localhost';
$user = 'root';
$password = 'root';
$dbname = 'register';

$db = mysqli_connect($host, $user, $password, $dbname);

if (isset($_POST['login_button'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "You must enter a username");
  }
  if (empty($password)) {
    array_push($errors, "You must enter a password");
  }

  if (count($errors) == 0) {
    //encrypt password
    $password = md5($password);

    $query = "SELECT * FROM user_credentials WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) != 0) {
      $_SESSION['username'] = $username;
      header('location: index.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

?>
