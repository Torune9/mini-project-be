<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'TaskController::index');

$routes->get('/taskcontroller/gettasks', 'TaskController::getTasks');

$routes->post('/taskcontroller/create', 'TaskController::create');

$routes->post('/taskcontroller/update/(:num)', 'TaskController::update/$1');

$routes->post('/taskcontroller/delete/(:num)', 'TaskController::delete/$1');

