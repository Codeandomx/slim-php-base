<?php
/**
 * Generador de token JWT
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 14/04/2019
 */

namespace App\Utilities;

// JWT para generar token
use Firebase\JWT\JWT;

class JWTAuth
{
    // Llave secreta
    protected static $secret_key = 'Sdw1s9x8@!arantasdesign!Q8x9s1wdS';
    // Algoritmo de encriptación
    protected static $encrypt = ['HS256'];
    // Audiencia
    protected static $aud = null;

    /**
     * Creamos el token
     */
    public static function getToken($data)
    {
        $time = time();

        $token = array(
            'typ' => 'JWT',
            'alg' => 'HS256',
            'iat' => $time, // Creación del token
            'exp' => $time + (60*60), // Tiempo de expiración
            'aud' => self::Aud(), // Audiencia
            'iss' => self::Iss(), // Obtenemos el emisor
            'data' => $data // Payload (Información del usuario)
        );

        return JWT::encode($token, self::$secret_key);
    }

    public static function validate($token)
    {
        if(empty($token))
        {
            throw new Exception("Invalid token supplied.");
        }

        $decode = JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        );

        if($decode->aud !== self::Aud())
        {
            throw new Exception("Invalid user logged in.");
        }
    }

    /**
     * Obtenemos los datos
     */
    public static function GetData($token)
    {
        return JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        )->data;
    }

    /**
     * Generamos la audiencia
     */
    private static function Aud()
    {
        $aud = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }

        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return sha1($aud);
    }

    /**
     * Obtenemos el emisor
     */
    private static function Iss($forwarded_host = false)
    {
        $iss = '';

        $ssl   = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on';
        $proto = strtolower($_SERVER['SERVER_PROTOCOL']);
        $proto = substr($proto, 0, strpos($proto, '/')) . ($ssl ? 's' : '' );
        if ($forwarded_host && isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
            $host = $_SERVER['HTTP_X_FORWARDED_HOST'];
        } else {
            if (isset($_SERVER['HTTP_HOST'])) {
                $host = $_SERVER['HTTP_HOST'];
            } else {
                $port = $_SERVER['SERVER_PORT'];
                $port = ((!$ssl && $port=='80') || ($ssl && $port=='443' )) ? '' : ':' . $port;
                $host = $_SERVER['SERVER_NAME'] . $port;
            }
        }
        $request = $_SERVER['REQUEST_URI'];
        $iss = $proto . '://' . $host . $request;

        return sha1($iss);
    }
}