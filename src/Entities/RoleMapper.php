<?php
/**
 * Mappeador para la tabla Tb_Roles
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 30/03/2019
 */

namespace App\Entities;

use App\Entities\Mapper;
use App\Models\RoleModel;

class RoleMapper extends Mapper
{
    // Obtenemos todos los roles
    public function getRoles()
    {
        $results = [];

        // Iniciamos transaccion
        $this->_db->begin();

        // Generamos la consulta
        $sql = "SELECT t0.id_role,t0.name,t0.date_register,t0.date_update
                FROM tb_roles t0
                ORDER BY t0.id_role ASC";

        $stmt = $this->_db->query($sql);

        while($row = $stmt->fetch('assoc')){
            $results[] = $row;
        }

        // Terminamos transaccion
        $this->_db->commit();

        return $results;
    }

    // Trae un role en concreto
    public function getRole($id_role)
    {
        $result;

        // Iniciamos transaccion
        $this->_db->begin();

        $sql = "SELECT t0.id_role,t0.name,t0.date_register,t0.date_update
                FROM tb_roles t0
                WHERE t0.id_role = :id_role";

        $stmt = $this->_db->prepare($sql);
        $stmt->bind(
            ['id_role'=>$id_role], ['id_role'=>'integer']
        );
        $stmt->execute();

        $result = $stmt->fetch('assoc');
        // echo var_dump($stmt->errorCode());
        // echo var_dump($stmt->errorInfo());
        
        // Terminamos transaccion
        $this->_db->commit();

        return $result;
    }

    // Creamos un role
    public function insertRole($name)
    {
        $id = -1;

        // Iniciamos transaccion
        $this->_db->begin();

        $sql = "INSERT INTO tb_roles (name)
                VALUES (:name)";

        $stmt = $this->_db->prepare($sql);
        $stmt->bind(['name'=>$name]);
        $id = (int)$stmt->execute()->lastInsertId();

        // Terminamos transaccion
        $this->_db->commit();

        return $id;
    }

    // Creamos un role
    public function updateRole($name)
    {
        $result = false;

        // Iniciamos transaccion
        $this->_db->begin();

        $sql = "UPDATE tb_roles
                SET name=:name,date_update=NOW()
                WHERE id_role=:id_role";

        $stmt = $this->_db->prepare($sql);
        $stmt->bind(['name'=>$name]);
        $result = (bool)$stmt->execute();

        // Terminamos transaccion
        $this->_db->commit();

        return $result;
    }

    // Eliminamos un role
    public function deleteUser($id_role)
    {
        $result = false;

        // Iniciamos transaccion
        $this->_db->begin();

        $sql = "DELETE FROM tb_roles
                WHERE id_role=:id_role";

        $stmt = $this->_db->prepare($sql);
        $stmt->bind(['id_role'=>$id_role], ['id_role'=>'integer']);
        $result = (bool)$stmt->execute();

        // Terminamos transaccion
        $this->_db->commit();

        return $result;
    }
}