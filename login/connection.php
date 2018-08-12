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
        $pass = $password;
        //next example will insert new conversation
        
        $service_url = 'https://tcc353.encs.concordia.ca/api/index.php/auth/login';
        $curl = curl_init($service_url);
        $curl_post_data = array(
            'username' => $username,
            'password' => $pass,
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode(curl_exec($curl));
        if ($httpcode == 200) {
            $_SESSION['username'] = $username;
            $_SESSION['user_type'] = $result->type;
            if($result->type == 'sales'){
                header("Location: ../site/SAhome.php");
            }
            else if($result->type == 'admin'){
                header("Location: ../site/adminHome.php");
            }
            else if($result->type == 'client'){
                $_SESSION['company_name'] = $result->company;
                header("Location: ../site/ClientHome.php");
            }
            else if($result->type == 'manager'){
                header("Location: ../site/managerHome.php");
            }
            else {
                header("Location: ../site/employeeHome.php");
            }
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
?>
