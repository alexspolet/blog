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
  /**
   * Article constructor.
   */
  public function __construct()
  {
    parent::__construct();
    $this->table = 'user';
    $this->pk = 'id';
  }

  function add($title, $text)
  {
    $query = "INSERT INTO {$this->table} (title, text) VALUES (?, ?)";
    $stmt = $this->db->prepare($query);
    $stmt->execute([$title, $text]);
    $res = $this->db->lastInsertId();
    return $res;
  }

  function edit($id, $title, $text)
  {
    $query = "UPDATE {$this->table} SET title=?, text=? WHERE id=?";
    $stmt = $this->db->prepare($query);
    $res = $stmt->execute([$title, $text, $id]);
    return $res;
  }

}