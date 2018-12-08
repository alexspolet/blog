<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 08.12.18
 * Time: 11:04
 */

namespace Models;


use Core\SQL;

class PrivilegedUserModel extends UserModel
{
    public $roles;
    public $permissions;

    private static $instance;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new PrivilegedUserModel();
        }
        return self::$instance;
    }


    public function __construct()
    {
        parent::__construct();
        $this->table = 'user_role';
        $this->roles = [];
    }

    public function getById($params)
    {
        parent::getById($params);
        $this->initRoles(['id_user' => $this->fields['id']]);

        return $this;
    }

    public function initRoles($params)
    {
        $roles = SQL::getInstance()->query("SELECT * FROM {$this->table} WHERE id_user = :id_user", $params);
        foreach ($roles as $key => $role) {
            $this->roles[] = $role['role'];
            $this->permissions = RoleModel::getInstance()->getPermissions(['role' => $role['role']]);
        }
        return $this;
    }

    public function hasRole($privilege)
    {
        return in_array($privilege, $this->roles);
    }

    public function addRole($role)
    {
        if (!$this->hasRole($role)) {
            SQL::getInstance()->insert($this->table, ['id_user' =>
                $this->fields['id'], 'role' => $role]);
        }

    }

    public function deleteRole($role)
    {
        if ($this->hasRole($role)) {
            $this->delete(['role' => $role]);
        }
    }



}