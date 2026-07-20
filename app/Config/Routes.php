<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ========================================
// ROUTES PUBLIQUES (pas de filtre)
// ========================================
$routes->get('/', 'AuthController::index');
$routes->get('/auth/login-operateur', 'AuthController::loginOperateur');
$routes->post('/auth/login-operateur', 'OperateurControlleur::loginOperateur');
$routes->get('/auth/login-client', 'AuthController::loginClient');
$routes->post('/auth/login-client', 'ClientControlleur::loginClient');
$routes->get('/auth/inscription-client', 'AuthController::inscriptionClient');
$routes->post('/client/inscription', 'ClientControlleur::inscription');

// ========================================
// ROUTES OPERATEUR (filter: operateur)
// ========================================
$routes->group('', ['filter' => 'operateur'], function ($routes) {

    $routes->get('/operateur/dashboard', 'OperateurControlleur::dashboard');
    $routes->get('/operateur/logout', 'OperateurControlleur::logout');
    $routes->get('/operateur/montants-a-envoyer', 'OperateurControlleur::montantsAEnvoyer');

    // CRUD Client
    $routes->get('/client', 'ClientController::index');
    $routes->get('/client/detail/(:num)', 'ClientController::detail/$1');
    $routes->get('/client/create', 'ClientController::create');
    $routes->post('/client/store', 'ClientController::store');
    $routes->get('/client/edit/(:num)', 'ClientController::edit/$1');
    $routes->post('/client/update/(:num)', 'ClientController::update/$1');
    $routes->get('/client/delete/(:num)', 'ClientController::delete/$1');

    // CRUD Operateurs
    $routes->get('/operateur-crud', 'OperateurController::index');
    $routes->get('/operateur-crud/create', 'OperateurController::create');
    $routes->post('/operateur-crud/store', 'OperateurController::store');
    $routes->get('/operateur-crud/edit/(:num)', 'OperateurController::edit/$1');
    $routes->post('/operateur-crud/update/(:num)', 'OperateurController::update/$1');
    $routes->get('/operateur-crud/delete/(:num)', 'OperateurController::delete/$1');

    // CRUD Prefixe
    $routes->get('/prefixe', 'PrefixeController::index');
    $routes->get('/prefixe/create', 'PrefixeController::create');
    $routes->post('/prefixe/store', 'PrefixeController::store');
    $routes->get('/prefixe/edit/(:num)', 'PrefixeController::edit/$1');
    $routes->post('/prefixe/update/(:num)', 'PrefixeController::update/$1');
    $routes->get('/prefixe/delete/(:num)', 'PrefixeController::delete/$1');

    // CRUD Type d'operation
    $routes->get('/type-operation', 'TypeOperationController::index');
    $routes->get('/type-operation/create', 'TypeOperationController::create');
    $routes->post('/type-operation/store', 'TypeOperationController::store');
    $routes->get('/type-operation/edit/(:num)', 'TypeOperationController::edit/$1');
    $routes->post('/type-operation/update/(:num)', 'TypeOperationController::update/$1');
    $routes->get('/type-operation/delete/(:num)', 'TypeOperationController::delete/$1');

    // CRUD Bareme des frais
    $routes->get('/bareme-frais', 'BaremeFraisController::index');
    $routes->get('/bareme-frais/create', 'BaremeFraisController::create');
    $routes->post('/bareme-frais/store', 'BaremeFraisController::store');
    $routes->get('/bareme-frais/edit/(:num)', 'BaremeFraisController::edit/$1');
    $routes->post('/bareme-frais/update/(:num)', 'BaremeFraisController::update/$1');
    $routes->get('/bareme-frais/delete/(:num)', 'BaremeFraisController::delete/$1');
});

// ========================================
// ROUTES CLIENT (filter: client)
// ========================================
$routes->group('', ['filter' => 'client'], function ($routes) {

    $routes->get('/dashboard', 'DashboardClientController::index');
    $routes->get('/historique', 'DashboardClientController::historique');
    $routes->get('/depot', 'TransactionController::depot');
    $routes->post('/depot', 'TransactionController::depot');
    $routes->get('/retrait', 'TransactionController::retrait');
    $routes->post('/retrait', 'TransactionController::retrait');
    $routes->get('/transfert', 'TransactionController::transfert');
    $routes->post('/transfert', 'TransactionController::transfert');
    $routes->get('/client/logout', 'ClientControlleur::logout');
});
