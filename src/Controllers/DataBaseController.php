<?php
/**
 * Controlador para ruta api/databases
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 02/04/2019
 */

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

// Conexion base de datos
use Cake\Database\Connection;

// Entitites
use App\Entities\UserMapper;
use App\Entities\RoleMapper;

class DataBaseController
{
    /**
     * @var UserMapper
     * @var RoleMapper
     * @var Connection
     */
    protected $_user;
    protected $_role;
    protected $_conn;

    /**
     * Constructor.
     *
     * @param UserMapper $user
     * @param RoleMapper $role
     * @param Connection $conn
     */
    public function __construct(UserMapper $user, RoleMapper $role, Connection $conn)
    {
        $this->_user = $user;
        $this->_role = $role;
        $this->_conn = $conn;
    }

    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        /** @var Container $this */

        $query = $this->_conn->newQuery();

        // fetch all rows as array
        $query = $query->select('*')->from('information_schema.schemata');
        
        $rows = $query->execute()->fetchAll('assoc') ?: [];

        // return a json response
        // return $response->withJson(['data'=>$user->getUsers()]);
        return $response->withJson(['data'=>$this->_role->getRoles()]);
    }
}