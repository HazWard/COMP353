<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
include 'controllers/locations/location.php';
include 'controllers/authentication/auth.php';
include 'controllers/employees/employee.php';
include 'controllers/clients/client.php';

$config = require('config.php'); // The path will change for deployement
$app = new \Slim\App($config);

$container = $app->getContainer();
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$app->get('/',function (Request $request, Response $response, array $args) {
    echo "Welcome the backend API";
});

// Location Endpoints
$app->get('/locations/provinces', \LocationController::class . ':provinces');
$app->get('/locations/cities', \LocationController::class . ':cities');

// Authentication Endpoints
$app->post('/auth/login', \AuthController::class .  ':login');
$app->post('/auth/register', \AuthController::class .  ':register');

// Employee Endpoints
$app->get('/employees', \EmployeeController::class .  ':employees');
$app->map(['GET', 'POST'],'/employees/{id}', \EmployeeController::class .  ':employee');
$app->map(['GET', 'POST'],'/employees/{id}/preferences', \EmployeeController::class .  ':preferences');

// Client Endpoints
$app->post('/clients', \ClientController::class . ':createNewClient');
$app->get('/clients/{cName}', \ClientController::class . ':loadClient');
$app->get('/clients', \ClientController::class . ':getClientNames');
$app->post('/clients/{cName}', \ClientController::class. ':updateClient');

$app->run();
