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
    return $this->extractData(scandir(self::DB));
  }

  protected function extractData(array $arr){
    $res = [];
    foreach ($arr as $value){
      $buffer = [];

      if (!($value === '.' OR $value === '..')){
        $buffer['name'] = explode('.' , $value)[0];
        $buffer['id'] = explode('_' , $buffer['name'])[1];
        $res[$buffer['id']]['name'] = $buffer['name'];
        $res[$buffer['id']]['id'] = $buffer['id'];
      }
    }
    return $res;
  }
}