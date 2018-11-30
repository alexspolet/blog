<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.11.18
 * Time: 18:43
 */

namespace Core;

class Tmp
{


  public static function getPath(Request $request){
    $file = $request->getRoute();
    if ($file !== '/'){
    $path = 'Views' . $file . '_v.php';
      }else{
      $path = 'Views/index_v.php';
    }
    return $path;
  }

  public static function validateParams($title , $text){
    $errors = [];
    if ($title === '' OR $text === '') {
      $errors[] = 'All fields must be full';
    }

    return $errors;
  }
}