<?php
/**
 * Controlador para ruta /hello
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 02/04/2019
 */

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class HelloController
{
    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $name = $request->getAttribute('name');
        $response->getBody()->write("Hello, $name");

        return $response;
    }
}