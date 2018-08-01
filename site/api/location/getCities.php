<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// include database and object files
include_once '../core.php';
include_once '../location/location.php';

$database = new Database();
$db = $database->getConnection();
$location = new Location($db);

$stmt = $location->getCities();


$results = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    array_push($results, $city_name);
}

print_r(json_encode($results));