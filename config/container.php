<?php
/**
 * Contenedor de dependencias para preparar, administrar e inyectar dependencias de aplicaciones
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 27/03/2019
 */

use Slim\Container;
// Twing
use Slim\Views\Twig;
// Logger
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use App\Handlers\Error;

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

// Registramos Twig View helper
$container[Twig::class] = function (Container $container) {
    $settings = $container->get('settings');
    $viewPath = $settings['twig']['path'];

    $twig = new Twig($viewPath, [
        'cache' => $settings['twig']['cache_enabled'] ? $settings['twig']['cache_path'] : false
    ]);

    /**
     * @var Twig_Loader_Filesystem $loader
     * */
    $loader = $twig->getLoader();
    $loader->addPath($settings['public'], 'public');

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment($container->get('environment'));
    $twig->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $twig;
};

// Logger
$container['Logger'] = function($container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Monolog\Logger('logger');
    $stream = new Monolog\Handler\StreamHandler($settings['file'], Monolog\Logger::DEBUG);
    $fingersCrossed = new Monolog\Handler\FingersCrossedHandler(
        $stream, Monolog\Logger::ERROR);
    $logger->pushHandler($fingersCrossed);
 
    return $logger;
};

$container['errorHandler'] = function ($container) {
    return new App\Handlers\Error($container['Logger']);
};