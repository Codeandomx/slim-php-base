<?php
/**
 * Mappeador para la tabla Tb_Users
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 28/03/2019
 */

namespace App\Entities;

use App\Entities\Mapper;
use App\Models\UserModel;

class UserMapper extends Mapper
{
    public function getUsers()
    {
        // Generamos la consulta
        $sql = "SELECT t0.name,t0.last_name,t0.email,t0.username,t0.last_activity,t0.sessions,t1.id_role,t1.name as name_role
                FROM tb_users t0 INNER JOIN tb_roles t1 ON t0.id_role = t1.id_role
                GROUP BY t0.name
                ORDER BY t0.name ASC";

        $stmt = $this->_db->query($sql);

        $results = [];

        while($row = $stmt->fetch('assoc')){
            $results[] = new UserModel($row);
        }

        return $results;
    }
}