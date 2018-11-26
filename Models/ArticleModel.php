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
  private static $instance;

  public static function getInstance(){
    if (self::$instance == null){
      self::$instance = new ArticleModel();
    }
    return self::$instance;
  }

  public function __construct()
  {
    parent::__construct();
    $this->table = 'articles';
    $this->pk = 'id';
  }

  public function add($title, $text)
  {
    $query = "INSERT INTO {$this->table} (title, text) VALUES (?, ?)";
    $stmt = $this->db->prepare($query);
    $stmt->execute([$title, $text]);
    $res = $this->db->lastInsertId();
    return $res;
  }

  public function edit($id, $title, $text)
  {
    $query = "UPDATE {$this->table} SET title=?, text=? WHERE {$this->pk}=?";
    $stmt = $this->db->prepare($query);
    $res = $stmt->execute([$title, $text, $id]);
    return $res;
  }



}