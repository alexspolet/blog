<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 25.11.18
 * Time: 20:21
 */

namespace Models;

use Core\SQL;

abstract class BaseModel
{
  protected $db;
  protected $table;
  protected $pk;

  public function __construct()
  {
    $this->db = SQL::getInstance();
  }

  public function getAll()
  {
    return SQL::getInstance()->query("SELECT * FROM {$this->table}");
  }

    public function get(array $params)
    {
        $patch = '';
        foreach ($params as $key => $param){
            $patch .= " $key = :$key";
        }
        return SQL::getInstance()->query("SELECT * FROM {$this->table} WHERE {$patch}" , $params);
    }

  public function getOne(array $params)
  {
      if (!empty($this->get($params))){
         return $this->get($params)[0];
      }
      return false;
  }

  public function add(array $object)
  {
    return SQL::getInstance()->insert($this->table , $object);
  }

  public function edit(array $object , $where){
    return SQL::getInstance()->update($this->table , $object , $where);
  }

  public function delete(array $params )
  {
    return SQL::getInstance()->delete($this->table , $params);
  }

}