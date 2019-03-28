<?php
/**
 * Controlador para errores de la APP
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 27/03/2019
 */

namespace App\Handlers;
 
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Monolog\Logger;
 
final class Error extends \Slim\Handlers\Error
{
    protected $logger;
 
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }
 
    public function __invoke(Request $request, Response $response, \Exception $exception)
    {
        // Log the message
        $this->logger->critical($exception->getMessage());
 
        return parent::__invoke($request, $response, $exception);
    }
}