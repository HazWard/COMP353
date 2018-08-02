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
        $connection = $this->container->get("db");
        $request_body = $request->getParsedBody();
        return $response;
    }

    public function register(Request $request, Response $response, array $args) {
        $connection = $this->container->get("db");
        $request_body = $request->getParsedBody();
        return $response;
    }
}
