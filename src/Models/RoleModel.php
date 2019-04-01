<?php
/**
 * Modelo para la tabla Tb_Roles
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 01/04/2019
 */

namespace App\Models;

class RoleModel
{
    protected $_id_role;
    protected $_name;
    protected $_date_register;
    protected $_date_update;

    public function __construct($data)
    {
        $this->_id_role = $data['id_role'];
        $this->_name = $data['name'];
        $this->_date_register = $data['date_register'];
        $this->_date_update = $data['date_update'];
    }

    public function getIdRole() { return $this->_id_role; }
    public function setIdRole($_id_role) { $this->_id_role = $_id_role; }

    public function getName() { return $this->_name; }
    public function setName($_name) { $this->_name = $_name; }

    public function getDateRegister() { return $this->_date_register; }
    public function setDateRegister($_date_register) { $this->_date_register = $_date_register; }

    public function getDateUpdate() { return $this->_date_update; }
    public function setDateUpdate($_date_update) { $this->_date_update = $_date_update; }
}