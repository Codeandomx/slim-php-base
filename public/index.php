<?php

/**
 * Incluimos la configuración inicial de la APP
 * 
 * @var Slim\App $app
 * */
$app = require __DIR__ . '/../config/bootstrap.php';

// Inicio de la APP
$app->run();