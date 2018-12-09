<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 09.12.18
 * Time: 1:36
 */

namespace Models;


class RoleModel extends RolePermissionModel
{
    private static $instance;


    public function __construct()
    {
        parent::__construct();
        $this->table = 'roles';
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new RoleModel();
        }
        return self::$instance;
    }
}