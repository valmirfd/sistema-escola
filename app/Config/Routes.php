<?php

use App\Controllers\Api\ApiParentsController;
use App\Controllers\HomeController;
use App\Controllers\ParentsController;
use App\Controllers\StudentsController;
use App\Controllers\TeachersController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [HomeController::class, 'index'], ['as' => 'home']);

//Responsáveis
$routes->group('parents', static function ($routes) {
    $routes->get('/', [ParentsController::class, 'index'], ['as' => 'parents.web']);
    $routes->get('show/(:alphanum)', [ParentsController::class, 'show'], ['as' => 'parents.show']);
    $routes->get('new', [ParentsController::class, 'new'], ['as' => 'parents.new']);
    $routes->post('create', [ParentsController::class, 'create'], ['as' => 'parents.create']);
    $routes->get('edit/(:alphanum)', [ParentsController::class, 'edit'], ['as' => 'parents.edit']);
    $routes->put('update/(:alphanum)', [ParentsController::class, 'update'], ['as' => 'parents.update']);
    $routes->delete('destroy/(:alphanum)', [ParentsController::class, 'destroy'], ['as' => 'parents.destroy']);
});

//Estudantes - alunos
$routes->group('students', static function ($routes) {
    $routes->get('/', [StudentsController::class, 'index'], ['as' => 'students.web']);
    $routes->get('show/(:alphanum)', [StudentsController::class, 'show'], ['as' => 'students.show']);
    $routes->get('new', [StudentsController::class, 'new'], ['as' => 'students.new']);
    $routes->post('create', [StudentsController::class, 'create'], ['as' => 'students.create']);
    $routes->get('edit/(:alphanum)', [StudentsController::class, 'edit'], ['as' => 'students.edit']);
    $routes->put('update/(:alphanum)', [StudentsController::class, 'update'], ['as' => 'students.update']);
    $routes->delete('destroy/(:alphanum)', [StudentsController::class, 'destroy'], ['as' => 'students.destroy']);
});

//Api Parents
$routes->group('api', static function ($routes) {
    $routes->get('get-by-cpf', [ApiParentsController::class, 'getByCpf'], ['as' => 'api.fetch.parent.by.cpf']);
});


// Professores
$routes->group('teachers', static function ($routes) {
    $routes->get('/', [TeachersController::class, 'index'], ['as' => 'teachers.web']);
    $routes->get('show/(:alphanum)', [TeachersController::class, 'show'], ['as' => 'teachers.show']);
    $routes->get('new', [TeachersController::class, 'new'], ['as' => 'teachers.new']);
    $routes->post('create', [TeachersController::class, 'create'], ['as' => 'teachers.create']);
    $routes->get('edit/(:alphanum)', [TeachersController::class, 'edit'], ['as' => 'teachers.edit']);
    $routes->put('update/(:alphanum)', [TeachersController::class, 'update'], ['as' => 'teachers.update']);
    $routes->delete('destroy/(:alphanum)', [TeachersController::class, 'destroy'], ['as' => 'teachers.destroy']);
});
