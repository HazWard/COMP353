<?php
include ("connectDB.php");
$clientArray = $_POST;

$cityID = findCityID($clientArray['province'],$clientArray['city']);

insertClient($clientArray['companyName'],$clientArray['companyNumber'],$clientArray['email'],$clientArray['firstName'],
            $clientArray['lastName'],$clientArray['middleInitial'],$cityID);
insertClientCredential($clientArray['email'],$clientArray['password']);

header("Location: ../SAhome.php");

function findCityID($province, $city){
    global $conn;

    $sql = "SELECT * 
            FROM provinces,cities
            WHERE cities.province = provinces.prov_abbrev
            AND city_name = "."'$city'"." AND prov_name = "."'$province'".";";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $cityID =  $row['city_id'];
        }
    }

     return $cityID;
}
function insertClient($companyName,$companyNumber,$companyEmail,$repFN,$repLN,$repMI,$city){
    global $conn;

    $sql = "INSERT INTO clients (company_name,contact_number,company_email,rep_first_name,rep_last_name,rep_middle_initial,city) VALUES (
            "."'$companyName'".","."'$companyNumber'".","."'$companyEmail'".","."'$repFN'".","."'$repLN'".","."'$repMI'".","."'$city'".");";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function insertClientCredential($username,$password){
    global $conn;

    $sql = "INSERT INTO user_credentials (username, user_type, password) VALUES (
            "."'$username'".","."'client'".","."'$password'".");";

    $conn->close();
}