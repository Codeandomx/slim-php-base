<?php
/**
 * Archivo de Configuración de la APP
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 27/03/2019
 */

// Almacenamos la configuración
$settings = [];

// Configuración de Slim
$settings['displayErrorDetails'] = true; // Mostramos los errores
/**
 * la ruta se calcula antes de ejecutar cualquier middleware. Esto significa que puede inspeccionar los
 * parámetros de ruta en middleware si lo necesita.
 */
$settings['determineRouteBeforeAppMiddleware'] = true;

// Configuración de rutas
$settings['root'] = dirname(__DIR__); // Ruta principal
$settings['temp'] = $settings['root'] . '/tmp'; // Ruta para archivos temporales
$settings['public'] = $settings['root'] . '/public'; // Datos publicos

// Configuración de vistas
$settings['twig'] = [
    'path' => $settings['root'] . '/templates',
    'cache_enabled' => false,
    'cache_path' =>  $settings['temp'] . '/twig-cache'
];

// Configuración Logger
$settings['logger'] = [
    'name' => 'app',
    'file' => $settings['temp'] . '/logs/app-'.date("d").'-'.date("m").'-'.date("Y").'.log',
    'level' => \Monolog\Logger::ERROR,
];

// Configuración de Base de datos
$settings['db'] = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'username' => 'root',
    'database' => 'crm',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'flags' => [
        // Activamos persistencia
        PDO::ATTR_PERSISTENT => false,
        // Activamos excepciones
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Set default fetch mode
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];

return $settings;