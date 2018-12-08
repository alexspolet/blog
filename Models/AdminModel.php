<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 08.12.18
 * Time: 15:28
 */

namespace Models;


class AdminModel extends PrivilegedUserModel
{
     private $admin;
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
        $this->admin = false;

    }


    public function isAdmin()
    {
        if ($this->hasRole('admin')){
            $this->admin = true;
        }
        return $this->admin;
    }


    public function addRole(){
        if ($this->isAdmin()){

        }
    }



}