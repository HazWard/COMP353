<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Container;

class EmployeeController
{
    private $table_name = "employees";

    protected $container;

    // constructor receives container instance
    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function employee(Request $request, Response $response, array $args) {
        $results = array();
        $connection = $this->container->get("db");
        $method = $request->getMethod();
        $employee_id_param = $args['id'];

        switch ($method) {
            case 'GET':
                $queryText = "SELECT * FROM " . $this->table_name . " WHERE employee_id=:id";
                $get_stmt = $connection->prepare($queryText);
                $get_stmt->bindValue(':id', $employee_id_param, PDO::PARAM_INT);
                $get_stmt->execute();
                while ($row = $get_stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $employee  = array(
                        "id" => $employee_id,
                        "firstName" => $first_name,
                        "lastName" => $last_name,
                        "department" => $department,
                        "managerId" => $manager_id,
                        "insurancePlan" => $insurance_plan
                    );
                    array_push($results, $employee);
                }
                break;
            case 'POST':
                // Processing for POST
                break;
        }
        return $response;
    }

    public function employees(Request $request, Response $response, array $args) {
        $results = array();
        $list = $request->getQueryParam("list", $default = null);
        $manager = $request->getQueryParam("manager", $default = null);

        if (count($request->getQueryParams()) < 1) {
            $response = $response->withStatus(500);
            $response = $response->withHeader("Content-Type", "application/json");
            $results["error"] = "Missing value for 'list' or 'manager' query parameters";
            $response->getBody()->write(json_encode($results));
            return $response;
        } else {
            if (is_null($list) && is_null($manager)) {
                $response = $response->withStatus(500);
                $response = $response->withHeader("Content-Type", "application/json");
                $invalid_list = implode (", ", $request->getQueryParams());
                $results["error"] = "Missing value for 'list' or 'manager' query parameters. ".$invalid_list." are not value query parameters.";
                $response->getBody()->write(json_encode($results));
                return $response;
            }
            if (!is_null($list) && !is_null($manager)) {
                $response = $response->withStatus(500);
                $response = $response->withHeader("Content-Type", "application/json");
                $results["error"] = "Both 'list' and 'manager' cannot be set at the same time.";
                $response->getBody()->write(json_encode($results));
                return $response;
            }
        }
        $connection = $this->container->get("db");
        if (!is_null($manager)) {
            $stmt = $connection->prepare("SELECT * FROM " . $this->table_name. " WHERE manager_id=:manager");
            $stmt->bindValue(':manager', $manager, PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $employee  = array(
                    "id" => $employee_id,
                    "firstName" => $first_name,
                    "lastName" => $last_name,
                    "department" => $department,
                    "managerId" => $manager_id,
                    "insurancePlan" => $insurance_plan
                );
                array_push($results, $employee);
            }
            $response = $response->withHeader("Content-Type", "application/json");
            $response->getBody()->write(json_encode($results));
        } else {
            $placeholders = str_repeat ('?, ',  count ($list) - 1) . '?';
            $stmt = $connection->prepare("SELECT * FROM " . $this->table_name. " WHERE employee_id IN ($placeholders)");
            $stmt->bindValue(':manager', $manager, PDO::PARAM_INT);
            $stmt->execute($list);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $employee  = array(
                    "id" => $employee_id,
                    "firstName" => $first_name,
                    "lastName" => $last_name,
                    "department" => $department,
                    "managerId" => $manager_id,
                    "insurancePlan" => $insurance_plan
                );
                array_push($results, $employee);
            }
            $response = $response->withHeader("Content-Type", "application/json");
            $response->getBody()->write(json_encode($results));
        }
        return $response;
    }
}
