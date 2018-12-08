<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 08.12.18
 * Time: 11:04
 */

namespace Models;


class PrivilegedUserModel extends UserModel
{
    private $roles;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'user_role';
        $this->roles = [];
    }



}