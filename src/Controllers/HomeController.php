<?php
/**
 * Controlador para ruta principal /
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 02/04/2019
 */

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController
{
    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $response->getBody()->write("It works! This is the default welcome page.");

        return $response;
    }
}