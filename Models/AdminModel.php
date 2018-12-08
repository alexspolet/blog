<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 08.12.18
 * Time: 15:28
 */

namespace Models;


/*class AdminModel extends PrivilegedUserModel
{
    private $admin = false;
    private static $instance;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new AdminModel();
        }
        return self::$instance;
    }


    public function __construct()
    {
        parent::__construct();
        if ($this->hasRole('admin')){
            var_dump($this->roles);
            $this->admin = true;
        }

    }



    public function isAdmin()
    {
        return $this->admin;
}

}*/