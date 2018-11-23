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
  public $beautyText = '';

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

  public function wrapText($class = ''){
    $class = $class === '' ? '' : 'class="'. $class .'"';
    $this->beautyText = "<div $class>". $this->beautyText . '</div>';

    return $this;
  }

  public function addTextToTop($text){
    $this->beautyText = $text . $this->beautyText;
    return $this;
  }

  public static function addTitle($text , $level = 1){
    return "<h$level>$text</h$level>";
  }

  public static function addImg($path){
    return '<img src="' . $path . '" alt="picture">';
  }

  public function findByTag($tag , $pos = null){
    preg_match_all("#<$tag*>(.*?)</$tag>#" , $this->beautyText , $matches );

    if (isset($pos) AND $pos !== 0){
      $matches[0] = $matches[0][$pos - 1];
      $matches[1] = $matches[1][$pos - 1];
    }
    return $matches;
  }

}