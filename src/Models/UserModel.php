<?php
/**
 * Modelo para la tabla Tb_Users
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 28/03/2019
 */

namespace App\Models;

class UserModel
{
    protected $_id_user;
    protected $_name;
    protected $_last_name;
    protected $_username;
    protected $_email;
    protected $_last_activity;
    protected $_sessions;
    protected $_id_role;
    protected $_name_role;
    protected $_date_register;
    protected $_date_update;

    public function __construct($data)
    {
        $this->_id_user = $data['id_user'];
        $this->_name = $data['name'];
        $this->_last_name = $data['last_name'];
        $this->_username = $data['username'];
        $this->_email = $data['email'];
        $this->_last_activity = $data['last_activity'];
        $this->_sessions = $data['sessions'];
        $this->_id_role = $data['id_role'];
        $this->_name_role = $data['name_role'];
        $this->_date_register = $data['date_register'];
        $this->_date_update = is_null($data['date_update']) ? '' : $data['date_update'];
        $this->_sessions = $data['sessions'];
    }

    public function getIdUser() { return $this->_id_user; }
    public function setIdUser($_id_user) { $this->_id_user = $_id_user; }

    public function getName() { return $this->_name; }
    public function setName($_name) { $this->_name = $_name; }

    public function getLastName() { return $this->_last_name; }
    public function setLastName($_last_name) { $this->_last_name = $_last_name; }

    public function getUsername() { return $this->_username; }
    public function setUsername($_username) { $this->_username = $_username; }

    public function getEmail() { return $this->_email; }
    public function setEmail($_email) { $this->_email = $_email; }

    public function getLastActivity() { return $this->_last_activity; }
    public function setLastActivity($_last_activity) { $this->_last_activity = $_last_activity; }
    
    public function getSessions() { return $this->_sessions; }  
    public function setSessions($_sessions) { $this->_sessions = $_sessions; }

    public function getIdRole() { return $this->_id_role; }
    public function setIdRole($_id_role) { $this->_id_role = $_id_role; }

    public function getNameRole() { return $this->_name_role; }
    public function setNameRole($_name_role) { $this->_name_role = $_name_role; }

    public function getDateRegister() { return $this->_date_register; }
    public function setDateRegister($_date_register) { $this->_date_register = $_date_register; }

    public function getDateUpdate() { return $this->_date_update; }
    public function setDateUpdate($_date_update) { $this->_date_update = $_date_update; }
}