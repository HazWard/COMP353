<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
include 'controllers/locations/location.php';
include 'controllers/authentication/auth.php';
include 'controllers/employees/employee.php';
include 'controllers/clients/client.php';
include 'controllers/contracts/contract.php';
include 'controllers/assignment/assignment.php';
include 'controllers/reports/report.php';

$config = require('config.php'); // The path will change for deployement
$app = new \Slim\App($config);

$container = $app->getContainer();
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host'].";port=". $db['port'] . ';dbname=' . $db['dbname'],
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
$app->get('/managers', \EmployeeController::class .  ':managers');
$app->map(['GET', 'POST'],'/employees/{id}', \EmployeeController::class .  ':employee');
$app->post('/employees/{id}/preferences', \EmployeeController::class .  ':setPreferences');

// Client Endpoints
$app->post('/clients', \ClientController::class . ':createNewClient');
$app->get('/clients/{cName}', \ClientController::class . ':loadClient');
$app->get('/clients', \ClientController::class . ':getClientNames');
$app->post('/clients/{cName}', \ClientController::class. ':updateClient');

// Contract Endpoints
$app->post('/contracts', \ContractController::class . ':createNewContract');
$app->post('/contracts/{cid}/deliverables/{deliv}', \ContractController::class . ':updateDeliv');
$app->post('/contracts/{cid}', \ContractController::class . ':updateContract');
$app->delete('/contracts/{cid}', \ContractController::class . ':deleteContract');
$app->post('/contracts/{cid}/score', \ContractController::class . ':updateScore');
$app->get('/managers/{mid}/scores', \ContractController::class . ':getScore');
$app->get('/contracts/{cid}', \ContractController::class . ':viewContract');
$app->get('/clients/{cName}/contracts', \ContractController::class . ':getMyContracts');

// Assignment Endpoints
$app->get('/employees/{eid}/preferences', \AssignmentController::class . ':loadAssignables');
$app->post('/employees/{eid}/contracts', \AssignmentController::class . ':assignContract');
$app->post('/employees/{eid}/contracts/{cid}', \AssignmentController::class . ':updateHours');
$app->delete('/employees/{eid}/contracts/{cid}', \AssignmentController::class . ':removeEmployee');
$app->get('/employees/{eid}/contracts', \AssignmentController::class . ':loadAssignedContracts');

// Report Endpoints
$app->get('/reports/highest', \ReportController::class . ':getHighestNumContracts');
$app->get('/reports/employees/{prov}', \ReportController::class . ':getEmployeesWorkingInProvince');
$app->get('/reports/contracts', \ReportController::class . ':getLastContractsFromTenDays');
$app->get('/reports/contracts/{category}', \ReportController::class . ':getContractsWithCategory');
$app->get('/reports/generate/{category}', \ReportController::class . ':generateReport');

$app->run();
