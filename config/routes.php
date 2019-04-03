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
// Plantillas
use Slim\Views\Twig;
// Controladores
use App\Controllers\DataBaseController;

// Rutas
$app->any('/api/databases', \App\Controllers\DataBaseController::class);

// Ruta principal
$app->get('/', \App\Controllers\HomeController::class)->setName('root');

// ruta de prueba para parametros
$app->get('/hello/{name}', \App\Controllers\HelloController::class);

// Ruta de pruebas para plantilla
$app->get('/time', function (Request $request, Response $response) {
    $viewData = [
        'now' => date('Y-m-d H:i:s')
    ];

    return $this->get(Twig::class)->render($response, 'time.twig', $viewData);
});