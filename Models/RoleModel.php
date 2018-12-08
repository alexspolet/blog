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
        $this->pk = 'id';
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
        $patch = '';
        foreach ($params as $key => $param){
            $patch .= "$key = :$key";
        }
        $permissions = SQL::getInstance()->query("SELECT * FROM {$this->table} WHERE {$patch}", $params);
        foreach ($permissions as $key => $permission){
            $this->permissions[$permission['permission']] = true;
        }
        return $this;
    }


}