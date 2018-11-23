<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 23.11.18
 * Time: 10:05
 */

class HTMLGenerator
{
  private $path;
  private $text;
  public $beautyText;

  public function __construct($path)
  {
    $this->path = $path;
    $this->loadText();
  }

  public function wrapEachInP(){
    $arr = $this->explodeText($this->text);
    $str = '';
    foreach ($arr as $p){
      $str .= "<p>$p</p>";
    }
    $this->beautyText = $str;

    return $this;
  }

  private function explodeText($text){
    $arr = explode("\n" , $text);
    $res = [];
    foreach ($arr as $p){
      if ($p !== '')
        $res[] = $p;
    }

    return $res;
  }

  private function loadText(){
    $this->text = file_get_contents($this->path);
  }
}