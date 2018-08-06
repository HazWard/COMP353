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
        $queryText = "SELECT con.company_name as name, COUNT(con.contract_id) as count, c.line_of_business as lob FROM contracts con, clients c WHERE con.company_name = c.company_name GROUP BY con.company_name ORDER BY COUNT(con.contract_id) DESC";
        $stmt = $connection->prepare($queryText);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $company = array(
                "name" => $name,
                "contracts" => $count
            );
            $lob = strtolower($lob);
            if(!isset($results[$lob])) {
                $results[$lob] = $company;
            }
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }
}
