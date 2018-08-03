<?php
include("connectDB.php");
$clientArray = $_POST;


insertClient($clientArray['companyName'],$clientArray['companyNumber'],$clientArray['email'],$clientArray['firstName'],
            $clientArray['lastName'],$clientArray['middleInitial'],$clientArray['LOB'],getProvinceAbbrev($clientArray['province']),$clientArray['city']);
insertClientCredential($clientArray['email'],$clientArray['password']);

header("Location: /COMP353/site/SAhome.php");


function insertClient($companyName,$companyNumber,$companyEmail,$repFN,$repLN,$repMI,$lob,$province,$city){
    global $conn;

    $sql = "INSERT INTO clients (company_name,contact_number,company_email,rep_first_name,rep_last_name,rep_middle_initial,city,province,line_of_business) VALUES (
            "."'$companyName'".","."'$companyNumber'".","."'$companyEmail'".","."'$repFN'".","."'$repLN'".","."'$repMI'".","."'$city'".","."'$province'".","."'$lob'".");";


    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function insertClientCredential($username,$password){
    global $conn;

    $sql = "INSERT INTO user_credentials (username, user_type, password) VALUES (
            "."'$username'".","."'client'".","."'$password'".");";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}

function getProvinceAbbrev($province){

    switch($province) {
        case 'Ontario':
            return 'ON';
        case 'Quebec':
            return 'QC';
        case 'British Columbia':
            return 'BC';
        case 'Alberta':
            return 'AB';
        case 'Nova Scotia':
            return 'NS';
        case 'Saskatchewan':
            return 'SK';
        case 'Manitoba':
            return 'MB';
        case 'New Brunswick':
            return 'NB';
        case 'Newfoundland and Labrador':
            return 'NL';
        case 'Prince Edward Island':
            return 'PE';
        case 'Nunavut':
            return 'NU';
        case 'Yukon':
            return 'YT';
        case 'Northwest Territories':
            return 'NT';
    }
}