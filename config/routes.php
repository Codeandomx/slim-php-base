<?php
/**
 * Configuración de rutas de la APP
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 27/03/2019
 */

// Routes
use Slim\Http\Request;
use Slim\Http\Response;
// Twing
use Slim\Views\Twig;

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

// Ruta de pruebas para plantilla
$app->get('/time', function (Request $request, Response $response) {
    $viewData = [
        'now' => date('Y-m-d H:i:s')
    ];

    return $this->get(Twig::class)->render($response, 'time.twig', $viewData);
});