<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 05.12.18
 * Time: 13:25
 */

namespace Models;

use Core\SQL;


class SessionModel extends BaseModel
{
  private static $instance;
  public static function getInstance(){
    if (self::$instance == null){
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {
    parent::__construct();
    $this->table = 'sessions';
    $this->pk = 'token';
  }

  public static function push($name, $value){
    $_SESSION[$name] = $value;
  }

  public static function read($name){
    return $_SESSION[$name];
  }

  public static function remove($name){
    $value = $_SESSION[$name];
    unset($_SESSION[$name]);
    return $value;
  }

  public static function has($name){
    return isset($_SESSION[$name]);
  }

  /*public static function setAll(array $arr = []){
    foreach ($arr as $key => $value) {
      self::push($key , $value);
    }
  }

  public static function getAll(array $arr = []){
    foreach ($arr as $key => $value) {
      self::read($key);
    }
  }*/

  public static function deleteAll(array $arr = []){
    foreach ($arr as $key => $value){
      self::remove($key);
    }
  }

  public static function generateToken(){
    return $token = md5(time());
  }

  public function delete($user_id)
  {
    return SQL::getInstance()->delete($this->table , "user_id = $user_id");
  }

  public function getToken($params)
  {
      $arr = SQL::getInstance()->query("SELECT * FROM {$this->table} WHERE user_id = :user_id" , $params);
      if (!empty($arr)){
          return $arr[0];
      }
  }
}