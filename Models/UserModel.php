<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 25.11.18
 * Time: 21:03
 */

namespace Models;

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
    $this->table = 'user';
    $this->pk = 'id';
  }

  public function logIn(){

  }

  public function logOut(){
    
  }

}