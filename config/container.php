<?php
/**
 * Contenedor de dependencias para preparar, administrar e inyectar dependencias de aplicaciones
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 27/03/2019
 */

use Slim\Container;
use Slim\Views\Twig;

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