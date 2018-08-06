<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Container;

class EmployeeController
{
    private $employee_table_name = "employees";
    private $prefs_table_name = "desired_contracts";

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
                $queryText = "SELECT * FROM " . $this->employee_table_name . " WHERE employee_id=:id LIMIT 1";
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
        if (count($results) != 1) {
            $response = $response->withStatus(404);
            $response = $response->withHeader("Content-Type", "application/json");
            $results = array(
              "error" => "Employee with ID '".$employee_id_param."' was not found"
            );
            $response->getBody()->write(json_encode($results));
            return $response;
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results[0]));
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
            $stmt = $connection->prepare("SELECT * FROM " . $this->employee_table_name. " WHERE manager_id=:manager");
            $stmt->bindValue(':manager', $manager, PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
            if (count($results) == 0) {
                $response = $response->withStatus(404);
                $response = $response->withHeader("Content-Type", "application/json");
                $results = array(
                    "error" => "No employees with manager with ID '".$manager."'"
                );
                $response->getBody()->write(json_encode($results));
            } else {
                $response = $response->withHeader("Content-Type", "application/json");
                $response->getBody()->write(json_encode($results));
            }
        } else {
            $employee_ids = explode(",", $list);
            $placeholders = str_repeat ('?, ',  count ($employee_ids) - 1) . '?';
            $stmt = $connection->prepare("SELECT * FROM " . $this->employee_table_name. " WHERE employee_id IN ($placeholders)");
            $stmt->bindValue(':manager', $manager, PDO::PARAM_INT);
            $stmt->execute($employee_ids);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
            if (count($results) == 0) {
                $response = $response->withStatus(404);
                $response = $response->withHeader("Content-Type", "application/json");
                $results = array(
                    "error" => "No employees with the following IDs: ".$list
                );
                $response->getBody()->write(json_encode($results));
            } else {
                $response = $response->withHeader("Content-Type", "application/json");
                $response->getBody()->write(json_encode($results));
            }
        }
        return $response;
    }

    public function setPreferences(Request $request, Response $response, array $args) {
        $results = array();
        $connection = $this->container->get("db");
        $employee_id_param = $args['id'];
        $request_body = $request->getParsedBody();
        $queryText = "INSERT INTO ".$this->prefs_table_name." (employee_id, desired_category, desired_type) VALUES(:id, :category, :type) ON DUPLICATE KEY UPDATE desired_category=:category, desired_type=:type";
        $post_stmt = $connection->prepare($queryText);
        $post_stmt->bindValue(':id', $employee_id_param, PDO::PARAM_INT);
        $post_stmt->bindValue(':category', $request_body['category'], PDO::PARAM_STR);
        $post_stmt->bindValue(':type', $request_body['type'], PDO::PARAM_STR);
        $post_stmt->execute();
        $queryText = "SELECT * FROM " . $this->prefs_table_name . " WHERE employee_id=:id LIMIT 1";
        $post_stmt = $connection->prepare($queryText);
        $post_stmt->bindValue(':id', $employee_id_param, PDO::PARAM_INT);
        $post_stmt->execute();
        while ($row = $post_stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $prefs  = array(
                "category" => $desired_category,
                "type" => $desired_type,
            );
            array_push($results, $prefs);
        }

        if (count($results) != 1) {
            $response = $response->withStatus(404);
            $response = $response->withHeader("Content-Type", "application/json");
            $results = array(
                "error" => "No preferences set for employee with ID '".$employee_id_param."'"
            );
            $response->getBody()->write(json_encode($results));
            return $response;
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results[0]));
        return $response;
    }
}
