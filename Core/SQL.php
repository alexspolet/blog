<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 29.11.18
 * Time: 12:19
 */

namespace Core;


class SQL
{
  private $db;
  private static $instance;

  public function getInstance(){
    if (self::$instance == null){
      self::$instance = new SQL();
    }
    return self::$instance;
  }

  private function __construct()
  {
    setlocale(LC_ALL, 'ru_Ru.UTF8');
    $this->db = new \PDO('mysql:host=localhost;dbname=blog', 'admin', '123456');
    $this->db->exec('SET NAMES UTF8');
    $this->db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE , \PDO::FETCH_ASSOC);
  }

  public function query($query){
    $stmt = $this->db->prepare($query);
    $stmt->execute();

    if ($stmt->errorCode() !== \PDO::ERR_NONE){
      die($stmt->errorInfo()[2]);
    }
    return $stmt->fetchAll();

  }

  /**
   * @param $table //Name of table
   * @param array $object //Ассоциативный массив, где ключ - название столбца , значение - вводимый текст
   * @return string
   */
  public function insert($table , array $object){

    $columns = [];
    $masks = [];
    foreach ($object as $key => $value){
      $columns[] = $key;
      $masks[] = ":$key";
      if ($value == null){
        $object[$key] = 'NULL';
      }
    }

    $columns_all = implode(', ' , $columns);
    $masks_all = implode(', ' , $masks);

    $query = "INSERT INTO {$table} ({$columns_all}) VALUES ({$masks_all})";

    $stmt = $this->db->prepare($query);
    $stmt->execute($object);

    if ($stmt->errorCode() !== \PDO::ERR_NONE){
      die($stmt->errorInfo()[2]);

    }
    return $this->db->lastInsertId();
  }

}
