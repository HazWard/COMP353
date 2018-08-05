<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Container;


class ContractController
{
    // Identify relevant db table names
    private static $contract_table_name = "contracts";
    private static $category_table_name = "categories";
    private static $assigned_table_name = "assigned_contracts";
    private static $desired_table_name = "desired_contracts";

    private static $deliverables = array(
        "first" => "first_deliv",
        "second" => "second_deliv",
        "third" => "third_deliv",
        "fourth" => "fourth_deliv",
    );

    protected $container;

    // constructor receives container instance
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /*
     * POST
     * createNewContract()
     * reserved for Sales
     * used to create a new contract based on information given in a form (not made)
     */
    public function createNewContract(Request $request, Response $response, array $args)
    {
        // connect to db and parse
        $results = array();
        $connection = $this->container->get("db");
        $request_body = $request->getParsedBody();

        // query: INSERT INTO client table
        $stmt = $connection->prepare(
            "INSERT INTO ".ContractController::$contract_table_name."(contract_category, type_of_service, acv, initial_amount, manager_id, company_name) VALUES (:cat, :contractType, :acv, :initAmt, :mid, :companyName)"
        );
        $stmt->bindValue(':cat', $request_body['category'], PDO::PARAM_STR);
        $stmt->bindValue(':contractType', $request_body['serviceType'], PDO::PARAM_STR);
        $stmt->bindValue(':acv', $request_body['acv'], PDO::PARAM_STR);
        $stmt->bindValue(':initAmt', $request_body['initialAmount'], PDO::PARAM_STR);
        $stmt->bindValue(':mid', $request_body['manager'], PDO::PARAM_INT);
        $stmt->bindValue(':companyName', $request_body['company'], PDO::PARAM_STR);
        $stmt->execute(); // $result = success/fail of execution
        $contract_id_param = $connection->lastInsertId();

        // query database to to present successful input
        $queryTxt2 = "SELECT * FROM ".ContractController::$contract_table_name." WHERE contract_id =:contract_id";
        $stmt2 = $connection->prepare($queryTxt2);
        $stmt2->bindValue(':contract_id', $contract_id_param, PDO::PARAM_STR);
        $stmt2->execute();
        $result2 = array();
        // put result of query in array
        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            array_push($result2, $row);
        }
        array_push($results, $result2);

        // Check for errors
        if (count($results) != 2 || count($result2) != 1)
        {
            $response = $response->withStatus(404);
            $response = $response->withHeader("Content-Type", "application/json");
            $results = array(
                "error" => "Something went wrong"
            );
            $response->getBody()->write(json_encode($results));
            return $response;
        }

        // Return response
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results[1][0]));
        return $response;

        return $results;
    }

    /*
     * updateDeliv()
     * reserved for managers & admin
     * updates the number of days it took to complete the xth deliverable for the contract
     * should receive as param cid and numDays
     */
    public function updateDeliv(Request $request, Response $response, array $args)
    {
        // connect to db and parse
        $connection = $this->container->get("db");
        $contract_id_param = $args['cid'];
        $deliv_name_param = trim($args['deliv']);
        $body = $request->getParsedBody();
        $numDays_param = $body['numDays'];

        if(!isset(ContractController::$deliverables[$deliv_name_param])){
            $response = $response->withStatus(500);
            $response = $response->withHeader("Content-Type", "application/json");
            $results = array(
                "error" => "'".$deliv_name_param."' is not a valid deliverable."
            );
            $response->getBody()->write(json_encode($results));
            return $response;
        }

        $deliv_name_param = ContractController::$deliverables[$deliv_name_param];

        $results = array();

        // query: UPDATE contract table name SET first_deliv = args
        $stmt = $connection->prepare(
            "UPDATE ".ContractController::$contract_table_name." SET ".$deliv_name_param." = :numDays WHERE contract_id = :cid"
        );
        $stmt->bindValue(':numDays', $numDays_param, PDO::PARAM_INT);
        $stmt->bindValue(':cid', $contract_id_param, PDO::PARAM_INT);
        $stmt->execute(); // result = success/fail of execution

        $stmt2 = $connection->prepare(
            "SELECT * FROM ".ContractController::$contract_table_name." WHERE contract_id = :cid"
        );
        $stmt2->bindValue(':cid', $contract_id_param, PDO::PARAM_INT);
        $stmt2->execute();

        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
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
                "manager_id" => $manager_id
            );
            array_push($results, $contract_tuple);
        }

        // Check existence
        if (count($results) != 1) {
            $response = $response->withStatus(404);
            $response = $response->withHeader("Content-Type", "application/json");
            $results = array(
                "error" => "Contract with ID '".$contract_id_param."' was not found"
            );
            $response->getBody()->write(json_encode($results));
            return $response;
        }

        // If exist, return contract info
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results[0]));
        return $response;
    }

    /*
     * updateContract()
     * reserved for Sales
     * used to create a new contract based on information given in a form (not made)
     */
    public function updateContract(Request $request, Response $response, array $args)
    {
        // connect to db and parse
        $connection = $this->container->get("db");
        $request_body = $request->getParsedBody();
        $results = array();

        // query: INSERT INTO client table
        $stmt = $connection->prepare(
            //uncomment to allow changing contract_id
            //"UPDATE ".ContractController::$contract_table_name." SET contract_id=:newID, contract_category=:cat, type_of_service=:contractType, acv=:acv, initial_amount=:initAmt, manager_id=:mid, company_name=:name WHERE contract_id=:cid"
            "UPDATE ".ContractController::$contract_table_name." SET contract_category=:category, type_of_service=:serviceType, acv=:acv, initial_amount=:initialAmount, manager_id=:mid, company_name=:name WHERE contract_id=:cid"
        );
        //$stmt->bindValue(':newID', $request_body['newID'], PDO::PARAM_INT); //uncomment to allow changing contract_id
        $stmt->bindValue(':category', $request_body['category'], PDO::PARAM_STR);
        $stmt->bindValue(':serviceType', $request_body['serviceType'], PDO::PARAM_STR);
        $stmt->bindValue(':acv', $request_body['acv'], PDO::PARAM_STR);
        $stmt->bindValue(':initialAmount', $request_body['initialAmount'], PDO::PARAM_INT);
        $stmt->bindValue(':mid', $request_body['manager'], PDO::PARAM_INT);
        $stmt->bindValue(':name', $request_body['company'], PDO::PARAM_STR);
        $stmt->bindValue(':cid', $request_body['id'], PDO::PARAM_INT);
        $stmt->execute(); // $result = success/fail of execution

        $stmt = $connection->prepare(
            "SELECT * FROM ".ContractController::$contract_table_name." WHERE contract_id = :cid"
        );
        $stmt->bindValue(':cid', $request_body['id'], PDO::PARAM_INT);
        $stmt->execute();
        // push query results into array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $contract_tuple = array(
                "id" => $contract_id,
                "company" => $company_name,
                "category" => $contract_category,
                "serviceType" => $type_of_service,
                "acv" => $acv,
                "initialAmount" => $initial_amount,
                "startDate" => $service_start_date,
                "firstDeliverable" => $first_deliv,
                "secondDeliverable" => $second_deliv,
                "thirdDeliverable" => $third_deliv,
                "fourthDeliverable" => $fourth_deliv,
                "score" => $score,
                "manager" => $manager_id
            );
            array_push($results, $contract_tuple);
        }

        // Check existence
        if (count($results) != 1) {
            $response = $response->withStatus(404);
            $response = $response->withHeader("Content-Type", "application/json");
            $results = array(
                "error" => "Contract with ID '".$contract_id_param."' was not found"
            );
            $response->getBody()->write(json_encode($results));
            return $response;
        }

        // If exist, return contract info
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results[0]));
        return $response;
    }

    /*
     * updateScore()
     * reserved for Clients
     * used to give/update satisfaction score for a contract
     */
    public function updateScore(Request $request, Response $response, array $args)
    {
        // connect to db and parse
        $connection = $this->container->get("db");
        $contract_id_param = $args['cid'];
        $body = $request->getParsedBody();
        $score_param = $body['score'];
        $results = array();

        // query: Update score
        $stmt = $connection->prepare(
            "UPDATE ".ContractController::$contract_table_name." SET score=:score WHERE contract_id=:cid"
        );
        $stmt->bindValue(':score',$score_param, PDO::PARAM_INT);
        $stmt->bindValue(':cid', $contract_id_param, PDO::PARAM_INT);
        $stmt->execute(); // $result = success/fail of execution

        // query2: select score wrt cid
        $queryText = "SELECT * FROM " . ContractController::$contract_table_name . " WHERE contract_id =:cid ";
        $stmt2 = $connection->prepare($queryText);
        $stmt2->bindValue(':cid', $contract_id_param, PDO::PARAM_INT);
        $stmt2->execute();

        // push result of query2
        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $contract_tuple = array(
                "id" => $contract_id,
                "company" => $company_name,
                "category" => $contract_category,
                "serviceType" => $type_of_service,
                "acv" => $acv,
                "initialAmount" => $initial_amount,
                "startDate" => $service_start_date,
                "firstDeliverable" => $first_deliv,
                "secondDeliverable" => $second_deliv,
                "thirdDeliverable" => $third_deliv,
                "fourthDeliverable" => $fourth_deliv,
                "score" => $score,
                "manager" => $manager_id
            );
            array_push($results, $contract_tuple);
        }

        // format and return response
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results[0]));
        return $response;
    }

    /*
     * getScore()
     * reserved for Clients
     * used to show score for all
     */
    public function getScore(Request $request, Response $response, array $args)
    {
        $results = array();
        $connection = $this->container->get("db");
        $manager_id_param = $args['mid'];

        // query : select contract_id, score from contracts where manager_id = @param
        $queryText = "SELECT contract_id, score FROM " . ContractController::$contract_table_name . " WHERE manager_id =:mid ";
        $stmt = $connection->prepare($queryText);
        $stmt->bindValue(':mid', $manager_id_param, PDO::PARAM_INT);
        $stmt->execute();

        $results['contracts'] = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $score_tuple = array(
                "id" => $contract_id,
                "score" => $score,
            );
            array_push($results['contracts'], $score_tuple);
        }

        $queryText2 = "SELECT AVG(score) as average_value FROM " . ContractController::$contract_table_name . " WHERE manager_id =:mid";
        $stmt2 = $connection->prepare($queryText2);
        $stmt2->bindValue(':mid', $manager_id_param, PDO::PARAM_INT);
        $stmt2->execute();
        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $results["average"] = $average_value;
        }

        if (count($results['contracts']) == 0) {
            $response = $results->withStatus(404);
            $results = array(
                "error" => "The manager with ID '".$manager_id_param."' has not been given a score yet."
            );
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }

    /*
     * viewContract()
     * used to show info about a particular contract
     */
    public function viewContract(Request $request, Response $response, array $args)
    {
        $results = array();
        $connection = $this->container->get("db");
        $contract_id_param = $args['cid'];

        // query : select contract from contracts table that matches the id
        $stmt = $connection->prepare(
            "SELECT * FROM ".ContractController::$contract_table_name." WHERE contract_id = :cid"
        );
        $stmt->bindValue(':cid', $contract_id_param, PDO::PARAM_INT);
        $stmt->execute();
        // push query results into array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $contract_tuple = array(
                "id" => $contract_id,
                "company" => $company_name,
                "category" => $contract_category,
                "serviceType" => $type_of_service,
                "acv" => $acv,
                "initialAmount" => $initial_amount,
                "startDate" => $service_start_date,
                "firstDeliverable" => $first_deliv,
                "secondDeliverable" => $second_deliv,
                "thirdDeliverable" => $third_deliv,
                "fourthDeliverable" => $fourth_deliv,
                "score" => $score,
                "manager" => $manager_id
            );
            array_push($results, $contract_tuple);
        }

        // Check existence
        if (count($results) != 1) {
            $response = $response->withStatus(404);
            $response = $response->withHeader("Content-Type", "application/json");
            $results = array(
                "error" => "Contract with ID '".$contract_id_param."' was not found"
            );
            $response->getBody()->write(json_encode($results));
            return $response;
        }

        // If exist, return contract info
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results[0]));
        return $response;
    }

    /*
     * getMyContracts()
     * reserved for Clients
     * used to display all the contracts to which the client is a signatory
     */
    public function getMyContracts(Request $request, Response $response, array $args)
    {
        // results = result of query; connection = connection to db
        $results = array();
        $connection = $this->container->get("db");
        $company_name_param = $args['cName'];

        //
        $queryText = "SELECT * FROM " . ContractController::$contract_table_name . " WHERE company_name =:companyName ";
        $stmt = $connection->prepare($queryText);
        $stmt->bindValue(':companyName', $company_name_param, PDO::PARAM_STR);
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
                "score" => $score,
                "manager" => $manager_id
            );
            array_push($results, $contract_tuple);
        }

        if (count($results) == 0) {
            $response = $results->withStatus(404);
            $results = array(
                "error" => $company_name_param."does not have any contracts yet."
            );
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }

    /*
     * contractCategories()
     * outputs list of categories (ie. Premium, Diamond, etc.)
     */
    public function contractCategories(Request $request, Response $response, array $args)
    {
        // results = result of query; connection = connection to db
        $results = array();
        $connection = $this->container->get("db");

        // query : get all contract_categories
        $queryText = "SELECT contract_category FROM " . ContractController::$category_table_name . ' ';
        $stmt = $connection->prepare($queryText);
        $stmt->execute();

        // push result of query
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            array_push($results, $contract_category);
        }

        // format and return response
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }
}
