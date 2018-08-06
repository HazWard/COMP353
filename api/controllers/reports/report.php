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
        $queryText = "select count, company_name, line_of_busines from (selec count(contracts.contract_id) as count, clients.company_name, clients.line_of_business from contracts natural join clients group by company_name) AS temp group by line_of_business";
        $stmt = $connection->prepare($queryText);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $company = array(
                "companyName" => $name,
                "contracts" => $count
                "lineOfBusiness" => $line_of_business
            );
            array_push($results, $company);
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }
}
