<?php
/**
 * Mapeador para las clases de acceso a base de datos
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 28/03/2019
 */

namespace App\Entities;

abstract class Mapper
{
    protected $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }
}