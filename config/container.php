<?php
/**
 * Contenedor de dependencias para preparar, administrar e inyectar dependencias de aplicaciones
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 27/03/2019
 */

use Slim\Container;

/**
 * Obtenemos el contenedor de depedencias
 * 
 * @var \Slim\App $app
 * */
$container = $app->getContainer();

// Activamos ritas en una subcarpeta
$container['environment'] = function () {
    // Obtenemos la ruta del script actual
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $_SERVER['SCRIPT_NAME'] = dirname(dirname($scriptName)) . '/' . basename($scriptName);
    return new Slim\Http\Environment($_SERVER);
};