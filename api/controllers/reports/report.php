<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Container;

class ReportController
{
    protected $container;

    // constructor receives container instance
    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function getHighestNumContracts(Request $request, Response $response, array $args) {
        $results = array();
        $connection = $this->container->get('db');
        $queryText = "select count, company_name, line_of_business from (select count(contracts.contract_id) as count, clients.company_name, clients.line_of_business from contracts natural join clients group by company_name) AS temp group by line_of_business";
        $stmt = $connection->prepare($queryText);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $company = array(
                "companyName" => $company_name,
                "contracts" => $count,
                "lineOfBusiness" => $line_of_business
            );
            array_push($results, $company);
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }

    public function getEmployeesWorkingInProvince(Request $request, Response $response, array $args) {
        $results = array();
        $connection = $this->container->get('db');
        $province_param = $args['prov'];

        $queryText = "SELECT * FROM employees WHERE manager_id IN (SELECT manager_id FROM contracts con, clients c WHERE con.company_name = c.company_name AND province=:province)";
        $stmt = $connection->prepare($queryText);
        $stmt->bindValue(':province', $province_param, PDO::PARAM_STR);
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
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }

    public function getLastContractsFromTenDays(Request $request, Response $response, array $args) {
        $results = array();
        $connection = $this->container->get('db');

        $queryText = "SELECT * FROM contracts WHERE service_start_date > CURRENT_TIMESTAMP - 10000000";
        $stmt = $connection->prepare($queryText);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $contract_tuple = array(
                "id" => $contract_id,
                "category" => $contract_category,
                "serviceType" => $type_of_service,
                "acv" => $acv,
                "initialAmount" => $initial_amount,
                "startDate" => $service_start_date,
                "firstDeliverable" => $first_deliv,
                "secondDeliverable" => $second_deliv,
                "thirdDeliverable" => $third_deliv,
                "fourthDeliverable" => $fourth_deliv,
                "satisfactionScore" => $score,
                "manager" => $manager_id
            );
            array_push($results, $contract_tuple);
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }

    public function getContractsWithCategory(Request $request, Response $response, array $args) {
        $results = array();
        $connection = $this->container->get('db');
        $category_param = $args['category'];

        $queryText = "SELECT * FROM contracts WHERE contract_category=:category";
        $stmt = $connection->prepare($queryText);
        $stmt->bindValue(':category', $category_param, PDO::PARAM_STR);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $contract_tuple = array(
                "id" => $contract_id,
                "category" => $contract_category,
                "serviceType" => $type_of_service,
                "acv" => $acv,
                "initialAmount" => $initial_amount,
                "startDate" => $service_start_date,
                "firstDeliverable" => $first_deliv,
                "secondDeliverable" => $second_deliv,
                "thirdDeliverable" => $third_deliv,
                "fourthDeliverable" => $fourth_deliv,
                "satisfactionScore" => $score,
                "manager" => $manager_id
            );
            array_push($results, $contract_tuple);
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }

    public function generateReport(Request $request, Response $response, array $args) {
        $results = array();
        $connection = $this->container->get('db');
        $category_param = $args['category'];

        $queryText = "SELECT average_score, company_name, province, city FROM (SELECT AVG(score) AS average_score, company_name FROM contracts WHERE contract_category=:category GROUP BY company_name ORDER BY average_score DESC) AS category NATURAL JOIN clients GROUP BY city";
        $stmt = $connection->prepare($queryText);
        $stmt->bindValue(':category', $category_param, PDO::PARAM_STR);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $company_report = array(
                "companyName" => $company_name,
                "averageScore" => $average_score,
                "province" => $province,
                "city" => $city
            );
            array_push($results, $company_report);
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }

    public function getQueryOne(Request $request, Response $response, array $args) {
        $results = array();
        $connection = $this->container->get('db');

        $queryText = "SELECT * FROM (SELECT employees.*, SUM(hours_worked) AS total_hours FROM employees NATURAL LEFT JOIN assigned_contracts WHERE employees.insurance_plan = 'Premium Employee Plan' GROUP BY employee_id) AS premium_employee_hours WHERE total_hours < 60";
        $stmt = $connection->prepare($queryText);
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
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }

    public function getQueryTwo(Request $request, Response $response, array $args) {
        $results = array();
        $connection = $this->container->get('db');

        $queryText = "SELECT * FROM contracts WHERE contract_category = 'Premium' AND third_deliv > 3 AND contract_id IN (SELECT contract_id FROM (SELECT COUNT(*) AS num_silver_employees, contract_id FROM assigned_contracts NATURAL LEFT JOIN employees WHERE insurance_plan = 'Silver Employee Plan' GROUP BY contract_id) AS silver_on_contracts WHERE num_silver_employees > 35)";
        $stmt = $connection->prepare($queryText);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $contract_tuple = array(
                "id" => $contract_id,
                "category" => $contract_category,
                "serviceType" => $type_of_service,
                "acv" => $acv,
                "initialAmount" => $initial_amount,
                "startDate" => $service_start_date,
                "firstDeliverable" => $first_deliv,
                "secondDeliverable" => $second_deliv,
                "thirdDeliverable" => $third_deliv,
                "fourthDeliverable" => $fourth_deliv,
                "satisfactionScore" => $score,
                "manager" => $manager_id
            );
            array_push($results, $contract_tuple);
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }

    public function getQueryThree(Request $request, Response $response, array $args) {
        $results = array();
        $connection = $this->container->get('db');

        $queryText = "select contract_id, contract_category, first_deliv, MONTH(service_start_date) as month from contracts where YEAR(service_start_date) = 2017 ORDER BY contract_category, MONTH(service_start_date) DESC";
        $stmt = $connection->prepare($queryText);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $contract  = array(
                "id" => $contract_id,
                "category" => $contract_category,
                "firstDeliv" => $first_deliv,
                "month" => $month
            );
            array_push($results, $contract);
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }
}
