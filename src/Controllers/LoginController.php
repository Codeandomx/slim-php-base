<?php
/**
 * Controlador para login
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 14/04/2019
 */

namespace App\Controllers;

// Solicitus
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
// JWT
use App\Utilities\JWTAuth;

class LoginController
{
    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $user = $request->getParsedBody()['user'];
        $pass = $request->getParsedBody()['pass'];

        // Validamos el usuario y contraseña
        if($user == 'paulo866' && $pass == 'Romina866'){
            // Datos (PayLoad)
            $data = [
                'user'=>'Paulo',
                'email'=>'paulo@arantxasdesign.com',
                // "scope" => ["read", "write", "delete"]
                "scope" => ["read"]
            ];
            // Creamos el token
            $token = JWTAuth::getToken($data);
            // Generamos la respuesta
            $res = [
                'errorCode'=>'',
                'msg'=>'',
                'data'=>[
                    'token'=>$token
                ]
            ];
        } else {
            // Generamos la respuesta
            $res = [
                'errorCode'=>'500001',
                'msg'=>'Usuario y/o contraseña no validos.',
                'data'=>[]
            ];
        }

        return $response->withJson($res);
    }
}