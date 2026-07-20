<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->get('/auth/login-operateur', 'AuthController::loginOperateur');
$routes->post('/auth/login-operateur', 'OperateurControlleur::loginOperateur');
$routes->get('/operateur/dashboard', 'OperateurControlleur::dashboard');
$routes->get('/auth/login-client', 'AuthController::loginClient');
$routes->get('/auth/inscription-client', 'AuthController::inscriptionClient');
$routes->post('/auth/login-client', 'ClientControlleur::loginClient');
$routes->post('/client/inscription', 'ClientControlleur::inscription');
$routes->get('/client/dashboard', 'ClientControlleur::dashboard');

$routes->get('/prefixe', 'PrefixeController::index');
$routes->get('/prefixe/create', 'PrefixeController::create');
$routes->post('/prefixe/store', 'PrefixeController::store');
$routes->get('/prefixe/edit/(:num)', 'PrefixeController::edit/$1');
$routes->post('/prefixe/update/(:num)', 'PrefixeController::update/$1');
$routes->get('/prefixe/delete/(:num)', 'PrefixeController::delete/$1');

$routes->get('/type-operation', 'TypeOperationController::index');
$routes->get('/type-operation/create', 'TypeOperationController::create');
$routes->post('/type-operation/store', 'TypeOperationController::store');
$routes->get('/type-operation/edit/(:num)', 'TypeOperationController::edit/$1');
$routes->post('/type-operation/update/(:num)', 'TypeOperationController::update/$1');
$routes->get('/type-operation/delete/(:num)', 'TypeOperationController::delete/$1');

$routes->get('/bareme-frais', 'BaremeFraisController::index');
$routes->get('/bareme-frais/create', 'BaremeFraisController::create');
$routes->post('/bareme-frais/store', 'BaremeFraisController::store');
$routes->get('/bareme-frais/edit/(:num)', 'BaremeFraisController::edit/$1');
$routes->post('/bareme-frais/update/(:num)', 'BaremeFraisController::update/$1');
$routes->get('/bareme-frais/delete/(:num)', 'BaremeFraisController::delete/$1');

