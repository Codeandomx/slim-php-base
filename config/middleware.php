<?php
/**
 * Middlware
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 14/04/2019
 */

// use Tuupola\Middleware\JwtAuthentication;
use Slim\Middleware\JwtAuthentication;
// Rutas
use Slim\Http\Request;
use Slim\Http\Response;

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
    "regexp" => "/(.*)/",
    "attribute" => "jwt", // Nombre del atributo donde se almacena el payload
    "secret" => $settings['jwt']['secret'], // Clave secreta
    "algorithm" => ["HS256"],  // Algoritmo de encriptacion
    "error" => function (Request $request, Response $response, $arguments) {
        $data["status"] = "error";
        $data["message"] = $arguments["message"];
        return $response
            ->withHeader("Content-Type", "application/json")
            ->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
]));