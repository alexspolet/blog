<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 25.11.18
 * Time: 21:03
 */

namespace Models;


use Core\SQL;

Class UserModel extends BaseModel
{

    public $fields;

    private static $instance;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new UserModel();
        }
        return self::$instance;
    }

    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
        $this->pk = 'id';
        $this->fields = [];
    }

    function getUserId($params)
    {
        return SQL::getInstance()->selectOne("SELECT {$this->pk} FROM {$this->table} WHERE  login = :login AND pass = :pass", $params);
    }

    public function getById($params)
    {
        $patch = '';
        foreach ($params as $key => $param){
            $patch .= "$key = :$key";
        }
        $fields =  SQL::getInstance()->selectOne("SELECT * FROM users WHERE {$patch}" , $params);
        foreach ($fields as $key => $field) {
            $this->fields[$key] = $field;
        }
        return $this;


    }
}