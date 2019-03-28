<?php
// Incluimos los archivos principales de SLIM
require_once __DIR__ . '/../vendor/autoload.php';

// Instanciamos la APP
$app = new \Slim\App(['settings' => require __DIR__ . '/../config/settings.php']);

// Configuramos las dependencias
require  __DIR__ . '/container.php';

// Registramos los middlware
require __DIR__ . '/middleware.php';

// Registramos las rutas
require __DIR__ . '/routes.php';

return $app;