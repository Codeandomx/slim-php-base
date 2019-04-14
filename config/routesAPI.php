<?php
/**
 * Configuración de rutas de la API
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 14/04/2019
 */

// Routes
use Slim\Http\Request;
use Slim\Http\Response;
// Plantillas
use Slim\Views\Twig;
// Controladores
use App\Controllers\DataBaseController;

// Rutas
$app->group('/api', function () use ($app){
    $app->group('/v1', function () use ($app){
        // Ruta de pruebas para plantilla
        $app->get('/time', function (Request $request, Response $response) {
            $viewData = [
                'now' => date('Y-m-d H:i:s')
            ];

            // Obtenemos el token
            $token = $request->getAttribute("jwt");

            if (in_array("write", $token->data->scope)) {
                /* Code for deleting item */
                return $this->get(Twig::class)->render($response, 'time.twig', $viewData);
            } else {
                /* No scope so respond with 401 Unauthorized */
                return $response->withStatus(401);
            }
        });

        $app->any('/api/databases', \App\Controllers\DataBaseController::class);
    });
});