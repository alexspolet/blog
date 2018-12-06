<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 05.12.18
 * Time: 13:25
 */

namespace Models;


class SessionModel
{
  private static $instance;
  public static function getInstance(){
    if (self::$instance == null){
      self::$instance = new self();
    }
    return self::$instance;
  }

  public static function set($name, $value){
    $_SESSION[$name] = $value;
  }

  public static function get($name){
    return $_SESSION[$name];
  }

  public static function delete($name){
    unset($_SESSION[$name]);
  }

  public static function setAll(array $arr = []){
    foreach ($arr as $key => $value) {
      self::set($key , $value);
    }
  }

  public static function getAll(array $arr = []){
    foreach ($arr as $key => $value) {
      self::get($key);
    }
  }

  public static function deleteAll(array $arr = []){
    foreach ($arr as $key => $value){
      self::delete($key);
    }
  }
}