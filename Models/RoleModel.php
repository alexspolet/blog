<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 07.12.18
 * Time: 15:50
 */

namespace Models;


use Core\SQL;

class RoleModel extends BaseModel
{
    private static $instance;
    public $permissions;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'role_permission';
        $this->permissions = [];
    }


    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new RoleModel();
        }
        return self::$instance;
    }

    public function getPermissions($params)
    {
        $permissions = SQL::getInstance()->query("SELECT permission FROM {$this->table} WHERE role = :role", $params);
        foreach ($permissions as $permission){
            $this->permissions[] = $permission['permission'];
        }
        return $this;
    }


}