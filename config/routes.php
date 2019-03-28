<?php
/**
 * Configuración de rutas de la APP
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 27/03/2019
 */

use Slim\Http\Request;
use Slim\Http\Response;

// Ruta principal
$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("It works! This is the default welcome page.");

    return $response;
})->setName('root');

// ruta de prueba para parametros
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});