<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 25.11.18
 * Time: 20:21
 */

namespace Models;


abstract class BaseModel
{
  protected $db;
  protected $table;
  protected $pk;

  public function __construct($db)
  {
    $this->db = $db;
  }

  function getAll()
  {
    $query = "SELECT * FROM {$this->table}";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $res;
  }

  function get($id)
  {
    $query = "SELECT * FROM {$this->table} WHERE {$this->pk} = ?";
    $stmt = $this->db->prepare($query);
    $stmt->execute([$id]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    return $res;
  }

  function delete($id)
  {
    $query = "DELETE FROM {$this->table} WHERE {$this->pk} = ?";
    $stmt = $this->db->prepare($query);
    $res = $stmt->execute([$id]);
    return $res;
  }

}