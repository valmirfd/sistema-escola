<?php

use App\Controllers\HomeController;
use App\Controllers\ParentsController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [HomeController::class, 'index'], ['as' => 'home']);

$routes->group('parents', static function ($routes) {
    $routes->get('/', [ParentsController::class, 'index'], ['as' => 'parents.web']);
    $routes->get('show/(:alphanum)', [ParentsController::class, 'show'], ['as' => 'parents.show']);
    $routes->get('new', [ParentsController::class, 'new'], ['as' => 'parents.new']);
    $routes->post('create', [ParentsController::class, 'create'], ['as' => 'parents.create']);
    $routes->get('edit/(:alphanum)', [ParentsController::class, 'edit'], ['as' => 'parents.edit']);
    $routes->put('update/(:alphanum)', [ParentsController::class, 'update'], ['as' => 'parents.update']);
    $routes->delete('destroy/(:alphanum)', [ParentsController::class, 'destroy'], ['as' => 'parents.destroy']);
});
