<?php
session_start();

// initialize variables to your needs
$username = "root";
$password = "";
$errors = array();


if (isset($_POST['login_button'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        array_push($errors, "You must enter a username");
    }
    if (empty($password)) {
        array_push($errors, "You must enter a password");
    }

    if (count($errors) == 0) {
        //encrypt password
        $password = md5($password);


        //next example will insert new conversation
        $service_url = 'http://localhost/api/index.php/auth/login';
        $curl = curl_init($service_url);
        $curl_post_data = array(
            'username' => $username,
            'password' => $password,
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($httpcode == 200) {
            $_SESSION['username'] = $username;
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

?>
