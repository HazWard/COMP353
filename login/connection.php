<?php
session_start();

if (isset($_POST['login_button'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $errors = array();
  if (empty($username)) {
    array_push($errors, "You must enter a username");
  }
  if (empty($password)) {
    array_push($errors, "You must enter a password");
  }

  if (count($errors) == 0) {
    //encrypt password
    $encryped_password = md5($password);
    $service_url = '/api/index.php/auth/login';
    $curl = curl_init($service_url);
    $curl_post_data = array(
        'username' => $username,
        'password' => $encryped_password,
    );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
    $curl_response = curl_exec($curl);
    if ($curl_response === false) {
        $info = curl_getinfo($curl);
        curl_close($curl);
        die('error occured during curl exec. Additional info: ' . var_export($info));
    }
    $info = curl_getinfo($curl);
    if ($info['http_code'] != 200) {
        array_push($errors, "Wrong username/password combination");
        curl_close($curl);
    } else {
        $_SESSION['username'] = $username;
        header('location: /login/index.php');
    }
  }
}

?>
