<?php

require '../../vendor/autoload.php';
include 'controllers/locations/location.php';
include 'controllers/authentication/auth.php';

$config = require 'config.php'; // The path will change for deployement
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

$app->group('/api', function () {

    // Location Endpoints
    $this->get('/locations/provinces', \LocationController::class . ':provinces');
    $this->get('/locations/cities', \LocationController::class . ':cities');

    // Authentication Endpoints
    $this->post('/auth/login', \AuthController::class .  ':login');
    $this->post('/auth/register', \AuthController::class .  ':register');
});
$app->run();
