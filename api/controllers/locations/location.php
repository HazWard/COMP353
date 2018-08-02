<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Container;

class LocationController
{
    private static $prov_table_name = "provinces";
    private static $city_table_name = "cities";

    protected $container;

    // constructor receives container instance
    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function provinces(Request $request, Response $response, array $args) {
        $connection = $this->container->get("db");
        $queryText = "SELECT * FROM " . LocationController::$prov_table_name . ' ';

        $stmt = $connection->prepare($queryText);
        $stmt->execute();


        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $province_item = $prov_name." (".$prov_abbrev.")";
            array_push($results, $province_item);
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }

    public function cities(Request $request, Response $response, array $args) {
        $results = array();

        if (count($request->getQueryParams()) < 1) {
            $response = $response->withStatus(500);
            $response = $response->withHeader("Content-Type", "application/json");
            $results["error"] = "Missing value for 'province' query parameter";
            $response->getBody()->write(json_encode($results));
            return $response;
        } else {
            if (is_null($request->getQueryParam("province", $default = null))) {
                $response = $response->withStatus(500);
                $response = $response->withHeader("Content-Type", "application/json");
                $results["error"] = "Missing value for province query parameter";
                $response->getBody()->write(json_encode($results));
                return $response;
            }
        }
        $connection = $this->container->get("db");
        $province = $request->getQueryParam("province", $default = null);
        $stmt = $connection->prepare("SELECT city_name FROM " . LocationController::$city_table_name. " WHERE province=:name");
        $stmt->bindValue(':name', $province, PDO::PARAM_STR);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            array_push($results, $city_name);
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }
}
