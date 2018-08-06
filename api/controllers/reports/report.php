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
}
