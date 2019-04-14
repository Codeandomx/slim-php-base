<?php
/**
 * Middlware
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 14/04/2019
 */

// use Tuupola\Middleware\JwtAuthentication;
use Slim\Middleware\JwtAuthentication;

/**
 * Obtenemos la aplicacion
 * 
 * @var \Slim\App $app
 * */

/**
 * Middleware par JWT
 * 
 * Nota: $decoded = $request->getAttribute("jwt");
 */
// $app->add(new Tuupola\Middleware\JwtAuthentication([
$app->add(new Slim\Middleware\JwtAuthentication([
    "path" => ["/api", "/admin"], // Rutas admitidas
    "ignore" => ["/api/token", "/admin/ping"], // Rutas ignoradas
    "header" => "X-Token", // Cabecera
    "attribute" => "jwt", // Nombre del atributo donde se almacena el payload
    "secret" => $settings['jwt']['secret'], // Clave secreta
    "algorithm" => ["HS256"],  // Algoritmo de encriptacion
]));