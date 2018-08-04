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

    protected $container;

    // constructor receives container instance
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /*
     * createNewContract()
     * reserved for Sales
     * used to create a new contract based on information given in a form (not made)
     */
    public function createNewContract(Request $request, Response $response, array $args)
    {
        // connect to db and parse
        $connection = $this->container->get("db");
        $request_body = $request->getParsedBody();

        // query: INSERT INTO client table
        $stmt = $connection->prepare(
            "INSERT INTO ".ContractController::$contract_table_name."(contract_id, contract_category, type_of_service, acv, initial_amount, manager_id, company_name) VALUES (:id, :cat, :contractType, :acv, :initAmt, :mid, :companyName)"
        );
        $stmt->bindValue(':id', $request_body['cid'], PDO::PARAM_INT);
        $stmt->bindValue(':cat', $request_body['cat'], PDO::PARAM_STR);
        $stmt->bindValue(':contractType', $request_body['type'], PDO::PARAM_STR);
        $stmt->bindValue(':acv', $request_body['acv'], PDO::PARAM_STR);
        $stmt->bindValue(':initAmt', $request_body['initAmt'], PDO::PARAM_STR);
        $stmt->bindValue(':mid', $request_body['mid'], PDO::PARAM_INT);
        $stmt->bindValue(':companyName', $request_body['name'], PDO::PARAM_STR);
        $result = $stmt->execute(); // $result = success/fail of execution

        return $result; // returns boolean t = if success, f = if fail.
    }

    /*
     * update[Xth]Deliv()
     * reserved for managers & admin
     * updates the number of days it took to complete the xth deliverable for the contract
     * should receive as param cid and numDays
     */
    public function updateFirstDeliv(Request $request, Response $response, array $args)
    {
        // connect to db and parse
        $connection = $this->container->get("db");
        $request_body = $request->getParsedBody();

        // query: UPDATE contract table name SET 1_delivered = args
        $stmt = $connection->prepare(
            "UPDATE ".ContractController::$contract_table_name." SET 1_delivered = :numDays WHERE contract_id = :cid"
        );
        $stmt->$stmt->bindValue(':numDays', $request_body['numDays'], PDO::PARAM_INT);
        $stmt->$stmt->bindValue(':cid', $request_body['id'], PDO::PARAM_INT);
        $result = $stmt->execute(); // result = success/fail of execution

        return $result; // returns boolean t = if success, f = if fail.
    }
    public function updateSecondDeliv(Request $request, Response $response, array $args)
    {
        // connect to db and parse
        $connection = $this->container->get("db");
        $request_body = $request->getParsedBody();

        // query: UPDATE contract table name SET 2_delivered = args
        $stmt = $connection->prepare(
            "UPDATE ".ContractController::$contract_table_name." SET 2_delivered = :numDays"
        );
        $stmt->$stmt->bindValue(':numDays', $request_body['numDays'], PDO::PARAM_INT);
        $stmt->$stmt->bindValue(':cid', $request_body['id'], PDO::PARAM_INT);
        $result = $stmt->execute(); // result = success/fail of execution

        return $result; // returns boolean t = if success, f = if fail.
    }
    public function updateThirdDeliv(Request $request, Response $response, array $args)
    {
        // connect to db and parse
        $connection = $this->container->get("db");
        $request_body = $request->getParsedBody();

        // query: UPDATE contract table name SET 3_delivered = args
        $stmt = $connection->prepare(
            "UPDATE ".ContractController::$contract_table_name." SET 3_delivered = :numDays"
        );
        $stmt->$stmt->bindValue(':numDays', $request_body['numDays'], PDO::PARAM_INT);
        $stmt->$stmt->bindValue(':cid', $request_body['id'], PDO::PARAM_INT);
        $result = $stmt->execute(); // result = success/fail of execution

        return $result; // returns boolean t = if success, f = if fail.
    }
    public function updateFourthDeliv(Request $request, Response $response, array $args)
    {
        // connect to db and parse
        $connection = $this->container->get("db");
        $request_body = $request->getParsedBody();

        // query: UPDATE contract table name SET 4_delivered = args
        $stmt = $connection->prepare(
            "UPDATE ".ContractController::$contract_table_name." SET 4_delivered = :numDays"
        );
        $stmt->$stmt->bindValue(':numDays', $request_body['numDays'], PDO::PARAM_INT);
        $stmt->$stmt->bindValue(':cid', $request_body['id'], PDO::PARAM_INT);
        $result = $stmt->execute(); // result = success/fail of execution

        return $result; // returns boolean t = if success, f = if fail.
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

        // query: INSERT INTO client table
        $stmt = $connection->prepare(
            //uncomment to allow changing contract_id
            //"UPDATE ".ContractController::$contract_table_name." SET contract_id=:newID, contract_category=:cat, type_of_service=:contractType, acv=:acv, initial_amount=:initAmt, manager_id=:mid, company_name=:name WHERE contract_id=:cid"
            "UPDATE ".ContractController::$contract_table_name." SET contract_category=:cat, type_of_service=:contractType, acv=:acv, initial_amount=:initAmt, manager_id=:mid, company_name=:name WHERE contract_id=:cid"
        );
        //$stmt->bindValue(':newID', $request_body['newID'], PDO::PARAM_INT); //uncomment to allow changing contract_id
        $stmt->bindValue(':cat', $request_body['cat'], PDO::PARAM_STR);
        $stmt->bindValue(':contractType', $request_body['type'], PDO::PARAM_STR);
        $stmt->bindValue(':acv', $request_body['acv'], PDO::PARAM_STR);
        $stmt->bindValue(':initAmt', $request_body['initAmt'], PDO::PARAM_STR);
        $stmt->bindValue(':mid', $request_body['mid'], PDO::PARAM_INT);
        $stmt->bindValue(':companyName', $request_body['name'], PDO::PARAM_STR);
        $stmt->bindValue(':cid', $request_body['cid'], PDO::PARAM_INT);
        $result = $stmt->execute(); // $result = success/fail of execution

        return $result; // returns boolean t = if success, f = if fail.
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
        $request_body = $request->getParsedBody();

        // query: INSERT INTO client table
        $stmt = $connection->prepare(
        //uncomment to allow changing contract_id
        //"UPDATE ".ContractController::$contract_table_name." SET contract_id=:newID, contract_category=:cat, type_of_service=:contractType, acv=:acv, initial_amount=:initAmt, manager_id=:mid, company_name=:name WHERE contract_id=:cid"
            "UPDATE ".ContractController::$contract_table_name." SET score=:score WHERE contract_id=:cid"
        );
        //$stmt->bindValue(':newID', $request_body['newID'], PDO::PARAM_INT); //uncomment to allow changing contract_id
        $stmt->bindValue(':score', $request_body['score'], PDO::PARAM_INT);
        $stmt->bindValue(':cid', $request_body['cid'], PDO::PARAM_INT);
        $result = $stmt->execute(); // $result = success/fail of execution

        return $result; // returns boolean t = if success, f = if fail.
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
        $request_body = $request-getParsedBody();

        // query : select contract_id, score from contracts where manager_id = @param
        $queryText = "SELECT contract_id, score FROM " . ContractController::$contract_table_name . " WHERE manager_id =:mid ";
        $stmt = $connection->prepare($queryText);
        $stmt->bindValue(':mid', $request_body['managerID'], PDO::PARAM_INT);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $score_tuple = array(
                "contractID" => $contract_id,
                "satisfactionScore" => $score,
            );
            array_push($results, $score_tuple);
        }

        $queryText2 = "SELECT AVG(score) FROM " . ContractController::$contract_table_name . " WHERE manager_id =:mid";
        $stmt2 = $connection->prepare($queryText2);
        $stmt2->bindValue(':mid', $request_body['managerID'], PDO::PARAM_INT);
        $stmt2->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($results, $row);
        }

        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
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
        $request_body = $request->getParsedBody();

        //
        $queryText = "SELECT * FROM " . ContractController::$contract_table_name . " WHERE company_name =:companyName ";
        $stmt = $connection->prepare($queryText);
        $stmt->bindValue(':companyName', $request_body['name'], PDO::PARAM_STR);
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
                "manager_id" => $manager_id
            );
            array_push($results, $contract_tuple);
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

        //
        $queryText = "SELECT contract_category FROM " . ContractController::$category_table_name . ' ';
        $stmt = $connection->prepare($queryText);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            array_push($results, $contract_category);
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }
}
