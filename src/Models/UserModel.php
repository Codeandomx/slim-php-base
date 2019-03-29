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
    protected $_name;
    protected $_last_name;
    protected $_username;
    protected $_email;
    protected $_last_activity;
    protected $_sessions;
    protected $_id_role;
    protected $_name_role;

    public function __construct($data)
    {
        $this->_name = $data['name'];
        $this->_last_name = $data['last_name'];
        $this->_username = $data['username'];
        $this->_email = $data['email'];
        $this->_last_activity = $data['last_activity'];
        $this->_sessions = $data['sessions'];
        $this->_id_role = $data['id_role'];
        $this->_name_role = $data['name_role'];
    }

    

    /**
     * Get the value of _name
     */ 
    public function get_name()
    {
        return $this->_name;
    }

    public function set_name($_name)
    {
        $this->_name = $_name;
    }

    public function get_last_name()
    {
        return $this->_last_name;
    }

    public function set_last_name($_last_name)
    {
        $this->_last_name = $_last_name;
    }

    public function get_username()
    {
        return $this->_username;
    }

    public function set_username($_username)
    {
        $this->_username = $_username;
    }

    public function get_email()
    {
        return $this->_email;
    }

    public function set_email($_email)
    {
        $this->_email = $_email;
    }

    public function get_last_activity()
    {
        return $this->_last_activity;
    }

    public function set_last_activity($_last_activity)
    {
        $this->_last_activity = $_last_activity;
    }
    
    public function get_sessions()
    {
        return $this->_sessions;
    }

    public function set_sessions($_sessions)
    {
        $this->_sessions = $_sessions;
    }

    public function get_id_role()
    {
        return $this->_id_role;
    }

    public function set_id_role($_id_role)
    {
        $this->_id_role = $_id_role;
    }

    public function get_name_role()
    {
        return $this->_name_role;
    }

    public function set_name_role($_name_role)
    {
        $this->_name_role = $_name_role;
    }
}