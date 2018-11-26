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

  private static $instance;

  public static function getInstance(){
    if (self::$instance == null){
      self::$instance = new UserModel();
    }
    return self::$instance;
  }

  public function __construct()
  {
    parent::__construct();
    $this->table = 'user';
    $this->pk = 'id';
  }

  public function add($login, $pass)
  {
    $query = "INSERT INTO {$this->table} (login, pass) VALUES (?, ?)";
    $stmt = $this->db->prepare($query);
    $stmt->execute([$login, $pass]);
    $res = $this->db->lastInsertId();
    return $res;
  }

  public function edit($id, $login, $pass)
  {
    $query = "UPDATE {$this->table} SET login=?, pass=? WHERE {$this->pk}=?";
    $stmt = $this->db->prepare($query);
    $res = $stmt->execute([$login, $pass, $id]);
    return $res;
  }

}