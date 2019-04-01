<?php
/**
 * Configuración de rutas de la APP
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 27/03/2019
 */

use Slim\Http\Request;
use Slim\Http\Response;
// Plantillas
use Slim\Views\Twig;
// Conexion base de datos
use Cake\Database\Connection;

use App\Entities\UserMapper;
use App\Entities\RoleMapper;

// Ruta principal
$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("It works! This is the default welcome page.");

    return $response;
})->setName('root');

// ruta de prueba para parametros
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

// Ruta de pruebas para plantilla
$app->get('/time', function (Request $request, Response $response) {
    $viewData = [
        'now' => date('Y-m-d H:i:s')
    ];

    return $this->get(Twig::class)->render($response, 'time.twig', $viewData);
});

// Pruebas base de datos
$app->get('/databases', function (Request $request, Response $response) {
    /** @var Container $this */

    $query = $this->get(Connection::class)->newQuery();

    // fetch all rows as array
    $query = $query->select('*')->from('information_schema.schemata');
    
    $rows = $query->execute()->fetchAll('assoc') ?: [];

    $user = new UserMapper($this->get(Connection::class));
    $role  = new RoleMapper($this->get(Connection::class));

    // return a json response
    // return $response->withJson(['data'=>$user->getUsers()]);
    return $response->withJson(['data'=>$role->getRoles()]);
});