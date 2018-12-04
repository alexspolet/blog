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

  private static $instance;

  public static function getInstance(){
    if (self::$instance == null){
      self::$instance = new UserModel();
    }
    return self::$instance;
  }

  public function __construct()
  {
    parent::__construct();
    $this->table = 'users';
    $this->pk = 'id';
  }

  function getUserId($login , $pass)
  {
    return SQL::getInstance()->selectOne("SELECT {$this->pk} FROM {$this->table} WHERE  login = '$login' AND pass = '$pass'");
  }
  public function logIn(){

  }

  public function logOut(){
    
  }


}