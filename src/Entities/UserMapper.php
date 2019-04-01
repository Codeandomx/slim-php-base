<?php
/**
 * Mappeador para la tabla Tb_Users
 * 
 * Author: Paulo Andrade
 * Fecha actualización: 30/03/2019
 */

namespace App\Entities;

use App\Entities\Mapper;
use App\Models\UserModel;

class UserMapper extends Mapper
{
    // Obtenemos todos los usuarios
    public function getUsers()
    {
        $results = [];

        // Iniciamos transaccion
        $this->_db->begin();

        // Generamos la consulta
        $sql = "SELECT t0.id_user,t0.name,t0.last_name,t0.email,t0.username,t0.last_activity,t0.sessions,t0.date_register,t0.date_update,t1.id_role,t1.name as name_role
                FROM tb_users t0 INNER JOIN tb_roles t1 ON t0.id_role = t1.id_role
                GROUP BY t0.name
                ORDER BY t0.name ASC";

        $stmt = $this->_db->query($sql);

        while($row = $stmt->fetch('assoc')){
            $results[] = $row;
        }

        // Terminamos transaccion
        $this->_db->commit();

        return $results;
    }

    // Trae un usuario en concreto
    public function getUser($id_user)
    {
        $result = null;

        // Iniciamos transaccion
        $this->_db->begin();

        $sql = "SELECT t0.id_user,t0.name,t0.last_name,t0.email,t0.username,t0.last_activity,t0.sessions,t0.date_register,t0.date_update,t1.id_role,t1.name as name_role
                FROM tb_users t0 INNER JOIN tb_roles t1 ON t0.id_role = t1.id_role
                WHERE t0.id_user = :id_user
                GROUP BY t0.name
                ORDER BY t0.name ASC";

        $stmt = $this->_db->prepare($sql);
        $stmt->bind(
            ['id_user'=>$id_user], ['id_user'=>'integer']
        );
        $stmt->execute();

        $result = $stmt->fetch('assoc');
        
        // echo var_dump($stmt->errorCode());
        // echo var_dump($stmt->errorInfo());

        // Terminamos transaccion
        $this->_db->commit();

        return $result;
    }

    // Creamos un usuario
    public function insertUser(UserModel $model)
    {
        // Iniciamos transaccion
        $this->_db->begin();

        $sql = "INSERT INTO tb_users (name,last_name,email,username,id_role,pass)
                VALUES (:name,:last_name,:email,:username,:id_role,:pass)";

        $stmt = $this->_db->prepare($sql);
        $stmt->bind(['name'=>$model->getName()]);
        $stmt->bind(['last_name'=>$model->getLastName()]);
        $stmt->bind(['email'=>$model->getEmail()]);
        $stmt->bind(['username'=>$model->getUsername()]);
        $stmt->bind(['id_role'=>$model->getIdRole()], ['id_role'=>'integer']);
        $stmt->bind(['pass'=>md5($model->getPass())]);
        $id = (int)$stmt->execute()->lastInsertId();

        // Terminamos transaccion
        $this->_db->commit();

        return $id;
    }

    // Creamos un usuario
    public function updateUser(UserModel $model)
    {
        // Iniciamos transaccion
        $this->_db->begin();

        $sql = "UPDATE tb_users
                SET name=:name,last_name=:last_name,email=:email,username=:username,
                    id_role=id_role,pass=:pass,date_update=NOW()
                WHERE id_user=:id_user";

        $stmt = $this->_db->prepare($sql);
        $stmt->bind(['name'=>$model->getName()]);
        $stmt->bind(['last_name'=>$model->getLastName()]);
        $stmt->bind(['email'=>$model->getEmail()]);
        $stmt->bind(['username'=>$model->getUsername()]);
        $stmt->bind(['id_role'=>$model->getIdRole()], ['id_role'=>'integer']);
        $stmt->bind(['pass'=>md5($model->getPass())]);
        $stmt->bind(['id_user'=>$model->getIdUser()], ['id_user'=>'integer']);
        $result = (bool)$stmt->execute();

        // Terminamos transaccion
        $this->_db->commit();

        return $result;
    }

    // Eliminamos un usuario
    public function deleteUser($id_user)
    {
        // Iniciamos transaccion
        $this->_db->begin();

        $sql = "DELETE FROM tb_users
                WHERE id_user=:id_user";

        $stmt = $this->_db->prepare($sql);
        $stmt->bind(['id_user'=>$id_user], ['id_user'=>'integer']);
        $result = (bool)$stmt->execute();

        // Terminamos transaccion
        $this->_db->commit();

        return $result;
    }
}