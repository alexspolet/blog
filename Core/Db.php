<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 25.11.18
 * Time: 21:11
 */

namespace Core;

use \PDO;
class Db
{
  private static $db;

  public static function getInstance(){
    if (self::$db == null){
      self::$db = self::getDb();
    }
    return self::$db;
  }
  private static function getDb()
  {
    $db = new PDO('mysql:host=localhost;dbname=blog', 'admin', '123456');
  return $db;
  }
}
