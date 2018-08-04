<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Container;


class ClientController
{
    // Identify relevant db table names
    private static $client_table_name = "clients";
    private static $credentials_table_name = "user_credentials";
    protected $container; // To receive container instance

    // constructor receives container instance
    public function __construct(Container $container) {
        $this->container = $container;
    }

    /*
     * create_new_client()
     * reserved access for sales associates
     * should create a new client based on the information given in clientForm.php (?)
     */
    public function createNewClient(Request $request, Response $response, array $args) {
        // connect to db and parse the information from the clientForm.php
        $connection = $this->container->get("db");
        $request_body = $request->getParsedBody();

        // query: INSERT INTO client table
        $stmt = $connection->prepare(
            "INSERT INTO ".ClientController::$client_table_name."(company_name, contact_number, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province, line_of_business) VALUES (:companyName, :contactNum, :email, :repFN, :repLN, :repMI, :city, :province, :LoB)"
        );
        $stmt->bindValue(':companyName', $request_body['name'], PDO::PARAM_STR);
        $stmt->bindValue(':contactNum', $request_body['number'], PDO::PARAM_INT);
        $stmt->bindValue(':email', $request_body['email'], PDO::PARAM_STR);
        $stmt->bindValue(':repFN', $request_body['firstName'], PDO::PARAM_STR);
        $stmt->bindValue(':repLN', $request_body['lastName'], PDO::PARAM_STR);
        $stmt->bindValue(':repMI', $request_body['middleInitial'], PDO::PARAM_STR);
        $stmt->bindValue(':city', $request_body['city'], PDO::PARAM_STR);
        $stmt->bindValue(':province', $request_body['province'], PDO::PARAM_STR);
        $stmt->bindValue(':LoB', $request_body['LOB'], PDO::PARAM_STR);
        $result1 = $stmt->execute(); // $result1 = success/fail of execution

        // query: INSERT INTO credentials table
        $stmt2 = $connection->prepare(
            "INSERT INTO ".ClientControler::$credentials_table_name."(username, user_type, password) VALUES (:username, :userType, :password)"
        );
        $stmt2->bindValue(':username', $request_body['email'], PDO::PARAM_STR);
        $stmt2->bindValue(':userType', 'client', PDO::PARAM_STR);
        $stmt2->bindValue(':password', $request_body['password'], PDO::PARAM_STR);
        $result2 = $stmt->execute(); // $result2 = success/fail of execution

        return $result1 && $result2; // returns boolean t = if success, f = if fail.
    }

    /*
     * load_client()
     * reserved access for admin/Sales
     * should load all information about a particular client
     */
    public function loadClient(Request $request, Response $response, array $args) {
        // connect to db
        $connection = $this->container->get("db");
        $queryText = "SELECT * FROM ".ClientController::$client_table_name.' ';
        $stmt = $connection->prepare($queryText);
        $stmt->execute();

        $results = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // pushes the fetched row into the results array
            array_push($results, $row);
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }

    /*
     * getClientNames()
     * to populate a drop down list of clients of just their company names
     */
    public function getClientNames(Request $request, Response $response, array $args) {
        // connect to db
        $connection = $this->container->get("db");
        $queryText = "SELECT company_name FROM " . ClientController::$client_table_name . ' ';

        $stmt = $connection->prepare($queryText);
        $stmt->execute();


        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            array_push($results, $company_name);
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results));
        return $response;
    }

    /*
     * update_client()
     * reserved access for admin
     * should update information about a client based on the information given in a certain form (unmade yet)
     */
    public function update_client(Request $request, Response $response, array $args) {
        // connect to db and parse
        $connection = $this->container->get("db");
        $request_body = $request->getParsedBody();

        // query: UPDATE client information
        $stmt = $connection->prepare(
            "UPDATE ".ClientController::$client_table_name." SET company_name = :name, contact_number = :number, company_email = :email, rep_first_name = :firstName, rep_last_name = :lastName, rep_middle_initial = :middleInitial, city = :city, province = :province, line_of_business = :LoB"
        );
        $stmt->bindValue(':companyName', $request_body['name'], PDO::PARAM_STR);
        $stmt->bindValue(':contactNum', $request_body['number'], PDO::PARAM_INT);
        $stmt->bindValue(':email', $request_body['email'], PDO::PARAM_STR);
        $stmt->bindValue(':repFN', $request_body['firstName'], PDO::PARAM_STR);
        $stmt->bindValue(':repLN', $request_body['lastName'], PDO::PARAM_STR);
        $stmt->bindValue(':repMI', $request_body['middleInitial'], PDO::PARAM_STR);
        $stmt->bindValue(':city', $request_body['city'], PDO::PARAM_STR);
        $stmt->bindValue(':province', $request_body['province'], PDO::PARAM_STR);
        $stmt->bindValue(':LoB', $request_body['LOB'], PDO::PARAM_STR);
        $result = $stmt->execute(); // result = success/fail of execution

        return $result; // returns boolean t = if success, f = if fail.
    }
    
}
