<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Container;

class AuthController
{
    private static $table_name = "user_credentials";

    protected $container;

    // constructor receives container instance
    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function login(Request $request, Response $response, array $args) {
        $results = array();
        $connection = $this->container->get("db");
        $request_body = $request->getParsedBody();
        $stmt = $connection->prepare("SELECT * FROM ".AuthController::$table_name." WHERE username=:username AND password=:password");
        $stmt->bindValue(':username', $request_body['username'], PDO::PARAM_STR);
        $stmt->bindValue(':password', $request_body['password'], PDO::PARAM_STR);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            array_push($results, $username);
        }
        if (count($results) < 1) {
            $response = $response->withStatus(403);
            $response = $response->withHeader("Content-Type", "application/json");
            $results["error"] = "Invalid credentials";
            $response->getBody()->write(json_encode($results));
            return $response;
        }
        $response = $response->withStatus(200);
        $response = $response->withHeader("Content-Type", "application/json");
        return $response;
    }

    public function register(Request $request, Response $response, array $args) {
        $connection = $this->container->get("db");
        $request_body = $request->getParsedBody();
        return $response;
    }
}
