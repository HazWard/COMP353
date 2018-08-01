<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// include database and object files
include_once '../core.php';
include_once 'location.php';

$database = new Database();
$db = $database->getConnection();
$location = new Location($db);

$stmt = $location->getProvinces();

$results = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $province_item = $prov_name." (".$prov_abbrev.")";
    array_push($results, $province_item);
}

print_r(json_encode($results));
