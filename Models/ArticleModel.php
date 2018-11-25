<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19.11.18
 * Time: 9:32
 */

namespace Models;

Class ArticleModel extends BaseModel
{
  /**
   * Article constructor.
   */
  public function __construct()
  {
    parent::__construct();
    $this->table = 'articles';
    $this->pk = 'id';
  }

  /**
   * Article constructor.
   */

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