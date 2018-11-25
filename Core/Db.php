<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 25.11.18
 * Time: 21:11
 */

namespace Core;


class Db
{
  private static $db;

  function getDb()
  {
    $this->db = new PDO('mysql:host=localhost;dbname=blog', 'admin', '123456');
  }
}