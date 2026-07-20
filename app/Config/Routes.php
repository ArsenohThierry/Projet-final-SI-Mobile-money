<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->get('/', 'DashboardClientController::index');

$routes->get('/dashboard', 'DashboardClientController::index');
$routes->get('/historique', 'DashboardClientController::historique');

$routes->get('/depot', 'TransactionController::depot');
$routes->post('/depot', 'TransactionController::depot');
$routes->get('/retrait', 'TransactionController::retrait');
$routes->post('/retrait', 'TransactionController::retrait');
$routes->get('/transfert', 'TransactionController::transfert');
$routes->post('/transfert', 'TransactionController::transfert');
