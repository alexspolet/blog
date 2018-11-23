<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 23.11.18
 * Time: 21:25
 */

class ArticleModel
{
  const DB = 'articles';

  public function getAll(){
    return scandir(self::DB);
  }
}