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

// Ruta principal
$app->get('/', \App\Controllers\HomeController::class)->setName('root');

// ruta de prueba para parametros
$app->get('/hello/{name}', \App\Controllers\HelloController::class);

// Login
$app->post('/login', \App\Controllers\LoginController::class);