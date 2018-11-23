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

  public function wrapAllInBox($class = ''){
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

  public function addTo($html , $tag , $pos , $flag = 0){
    $tag = $this->findByTag($tag, $pos);

    if (!$flag){
      $strlen = strlen($tag[0]);
      $startpos = strpos($this->beautyText , $tag[0]);
      $endpos = $startpos + $strlen;
      $this->beautyText = substr($this->beautyText , 0 , $startpos) . $html . substr($this->beautyText , $endpos);
    }

    /*var_dump($strlen);
    var_dump($startpos);
    var_dump($endpos);*/

    var_dump($this->beautyText);

  }
}