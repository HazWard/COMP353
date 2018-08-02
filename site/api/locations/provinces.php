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

$request_method = $_SERVER['REQUEST_METHOD'];
$results = array();
switch ($request_method) {
    case 'GET':
        $stmt = $location->getProvinces();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $province_item = $prov_name." (".$prov_abbrev.")";
            array_push($results, $province_item);
        }
        break;
    default:
        header("Method Not Allowed", true, 405);
        $results["error"] = "'".$request_method."' is not allowed on this endpoint";
}

print_r(json_encode($results));
