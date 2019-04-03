<?php
/**
 * Inyector de dependencias
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 01/04/2019
 */

use Slim\Container;

// Conexion base de datos
use Cake\Database\Connection;

// Entitites
use App\Entities\UserMapper;
use App\Entities\RoleMapper;

/**
 * Obtenemos el contenedor de depedencias
 * 
 * @var \Slim\App $app
 * */
$container = $app->getContainer();

// api/databases
$container[App\Controllers\DataBaseController::class] = function (Container $container) {
    $conn = $container->get(Connection::class);
    $user = new UserMapper($conn);
    $role = new RoleMapper($conn);
    return new App\Controllers\DataBaseController($user, $role, $conn);
};