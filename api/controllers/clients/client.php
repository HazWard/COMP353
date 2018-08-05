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
     * POST (client side should capture all data about the client)
     * create_new_client()
     * reserved access for sales associates
     * should create a new client based on the information given in clientForm.php (?)
     */
    public function createNewClient(Request $request, Response $response, array $args) {
        // connect to db and parse the information from the clientForm.php
        $connection = $this->container->get("db");
        $connection->beginTransaction();
        $request_body = $request->getParsedBody();
        $queryTxt = "INSERT INTO ".ClientController::$client_table_name."(company_name, contact_number, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province, line_of_business) VALUES (:companyName, :contactNum, :email, :repFN, :repLN, :repMI, :city, :province, :lob)";
        $results = array();

        // query: INSERT INTO client table
        $stmt = $connection->prepare($queryTxt);
        $stmt->bindValue(':companyName', $request_body['name'], PDO::PARAM_STR);
        $stmt->bindValue(':contactNum', $request_body['number'], PDO::PARAM_INT);
        $stmt->bindValue(':email', $request_body['email'], PDO::PARAM_STR);
        $stmt->bindValue(':repFN', $request_body['firstName'], PDO::PARAM_STR);
        $stmt->bindValue(':repLN', $request_body['lastName'], PDO::PARAM_STR);
        $stmt->bindValue(':repMI', $request_body['middleInitial'], PDO::PARAM_STR);
        $stmt->bindValue(':city', $request_body['city'], PDO::PARAM_STR);
        $stmt->bindValue(':province', $request_body['province'], PDO::PARAM_STR);
        $stmt->bindValue(':lob', $request_body['lob'], PDO::PARAM_STR);
        $successful = $stmt->execute(); // $result1 = success/fail of execution
        if (!$successful) {
            $connection->rollBack();
            $response = $response->withStatus(500);
            $response = $response->withHeader("Content-Type", "application/json");
            $error = array(
                "error" => "Something went wrong when creating client"
            );
            $response->getBody()->write(json_encode($error));
            return $response;
        }

        // query: INSERT INTO credentials table
        $queryTxt2 = "INSERT INTO ".ClientController::$credentials_table_name."(username, user_type, password) VALUES (:username, :userType, :password)";
        $stmt2 = $connection->prepare($queryTxt2);
        $stmt2->bindValue(':username', $request_body['email'], PDO::PARAM_STR);
        $stmt2->bindValue(':userType', 'client', PDO::PARAM_STR);
        $stmt2->bindValue(':password', $request_body['password'], PDO::PARAM_STR);
        $successful = $stmt2->execute(); // $result2 = success/fail of execution
        if (!$successful) {
            $connection->rollBack();
            $response = $response->withStatus(500);
            $response = $response->withHeader("Content-Type", "application/json");
            $error = array(
                "error" => "Something went wrong when creating credentials for client"
            );
            $response->getBody()->write(json_encode($error));
            return $response;
        }


        /*
         * 	{
		"company_name": "WolframAlpha",
		"contact_number": "5143250692",
		"company_email": "wolframalpha@email.com",
		"rep_first_name": "James",
		"rep_last_name": "Carter",
		"rep_middle_initial": "M",
		"city": "Quebec",
		"province": "QC",
		"line_of_business": "Retail"
	}
         */
        // query database to present successful input (client)
        $queryTxt3 = "SELECT * FROM ".ClientController::$client_table_name." WHERE company_name =:companyName";
        $stmt3 = $connection->prepare($queryTxt3);
        $stmt3->bindValue(':companyName', $request_body['name'], PDO::PARAM_STR);
        $successful = $stmt3->execute();
        if ($successful) {
            while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $company = array(
                    "name" => $company_name,
                    "number" => $contact_number,
                    "email" => $company_email,
                    "firstName" => $rep_first_name,
                    "lastName" => $rep_last_name,
                    "middleInitial" => $rep_middle_initial,
                    "city" => $city,
                    "province" => $province,
                    "lob" => $line_of_business
                );
                array_push($results, $company);
            }
        } else {
            $connection->rollBack();
            $response = $response->withStatus(500);
            $response = $response->withHeader("Content-Type", "application/json");
            $error = array(
                "error" => "Something went wrong"
            );
            $response->getBody()->write(json_encode($error));
            return $response;
        }

        // Return response
        $connection->commit();
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results[0]));
        return $response;
    }

    /*
     * GET
     * load_client()
     * reserved access for admin/Sales
     * should load all information about a particular client
     * @param : companyName
     */
    public function loadClient(Request $request, Response $response, array $args) {
        // connect to db; prepare variables
        $connection = $this->container->get("db");
        $company_name_param = $args['cName'];
        $queryText = "SELECT * FROM ".ClientController::$client_table_name." WHERE company_name =:cName LIMIT 1";

        // prepare query and execute
        $stmt = $connection->prepare($queryText);
        $stmt->bindValue(':cName', $company_name_param, PDO::PARAM_STR);
        $stmt->execute();

        $results = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // pushes the fetched row into the results array
            array_push($results, $row);
        }
        if (count($results) < 1) {
            //if no result was found
            $response = $response->withStatus(404);
            $response = $response->withHeader("Content-Type", "application/json");
            $results["error"] = $company_name_param." was not found";
            $response->getBody()->write(json_encode($results));
            return $response;
        }
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results[0]));
        return $response;
    }

    /*
     * GET
     * getClientNames()
     * to populate a drop down list of clients of just their company names
     */
    public function getClientNames(Request $request, Response $response, array $args) {
        // connect to db
        $connection = $this->container->get("db");
        $queryText = "SELECT company_name FROM " . ClientController::$client_table_name . " ORDER BY company_name ASC";

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
     * POST
     * updateClient()
     * reserved access for admin
     * should update information about a client based on the information given in a certain form (unmade yet)
     */
    public function updateClient(Request $request, Response $response, array $args) {
        // connect to db and parse
        $connection = $this->container->get("db");
        $connection->beginTransaction();
        $request_body = $request->getParsedBody();
        $company_name_param = $args['cName'];

        // query: UPDATE client information
        $stmt = $connection->prepare(
            "INSERT INTO ".ClientController::$client_table_name."(company_name, contact_number, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province, line_of_business) VALUES(:name, :number, :email, :firstName, :lastName, :middleInitial, :city, :province, :lob) ON DUPLICATE KEY UPDATE contact_number=:number, company_email=:email, rep_first_name=:firstName, rep_last_name=:lastName, rep_middle_initial=:middleInitial, city=:city, province=:province, line_of_business=:lob"
        );
        $stmt->bindValue(':name', $company_name_param, PDO::PARAM_STR);
        $stmt->bindValue(':number', $request_body['number'], PDO::PARAM_INT);
        $stmt->bindValue(':email', $request_body['email'], PDO::PARAM_STR);
        $stmt->bindValue(':firstName', $request_body['firstName'], PDO::PARAM_STR);
        $stmt->bindValue(':lastName', $request_body['lastName'], PDO::PARAM_STR);
        $stmt->bindValue(':middleInitial', $request_body['middleInitial'], PDO::PARAM_STR);
        $stmt->bindValue(':city', $request_body['city'], PDO::PARAM_STR);
        $stmt->bindValue(':province', $request_body['province'], PDO::PARAM_STR);
        $stmt->bindValue(':lob', $request_body['lob'], PDO::PARAM_STR);
        $successful = $stmt->execute();
        if (!$successful) {
            $connection->rollBack();
            $response = $response->withStatus(500);
            $response = $response->withHeader("Content-Type", "application/json");
            $results["error"] =  "Something when wrong when updating '".$args['cName']."'";
            $response->getBody()->write(json_encode($results));
            return $response;
        }

        $queryText = "SELECT * FROM ".ClientController::$client_table_name." WHERE company_name =:cName LIMIT 1";

        // prepare query and execute
        $stmt = $connection->prepare($queryText);
        $stmt->bindValue(':cName', $company_name_param, PDO::PARAM_STR);
        $stmt->execute();

        $results = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // pushes the fetched row into the results array
            array_push($results, $row);
        }
        if (count($results) < 1) {
            //if no result was found
            $response = $response->withStatus(404);
            $response = $response->withHeader("Content-Type", "application/json");
            $results["error"] = $company_name_param." was not found";
            $response->getBody()->write(json_encode($results));
            return $response;
        }

        $connection->commit();
        $response = $response->withHeader("Content-Type", "application/json");
        $response->getBody()->write(json_encode($results[0]));
        return $response;
    }

}
