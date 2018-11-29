<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 25.11.18
 * Time: 20:21
 */

namespace Models;


use Core\Db;
use Core\SQL;

abstract class BaseModel
{
  protected $db;
  protected $table;
  protected $pk;

  public function __construct()
  {
    $this->db = Db::getInstance();
  }

  public function getAll()
  {
    return SQL::getInstance()->query("SELECT * FROM {$this->table}");
  }

  public function get($id)
  {
    return SQL::getInstance()->query("SELECT * FROM {$this->table} WHERE {$this->pk} = {$id}")[0];
  }

  public function add(array $object)
  {
    return SQL::getInstance()->insert($this->table , $object);
  }

  public function edit(array $object , $where){
    return SQL::getInstance()->update($this->table , $object , $where);
  }

  public function delete($id)
  {
    return SQL::getInstance()->delete($this->table , "$this->pk = $id");
  }

}