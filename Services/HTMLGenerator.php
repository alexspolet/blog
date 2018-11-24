<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 23.11.18
 * Time: 10:05
 */

class HTMLGenerator
{
  //private $path;
  private $text;
  public $beautyText = '';

  public function __construct($text)
  {
    //$this->path = $path;
    //$this->loadText();
    $this->text = $text;
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

  /*private function loadText(){
    $this->text = file_get_contents($this->path);
  }*/

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

  public static function addImg($path , $width = null, $height = null){
    if (!($width === null OR $height === null)){
      return '<img src="' . $path . '" alt="picture" width="' . $width . '" height="' . $height . '">';
    }
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

    if (!$flag OR ($flag !== 1 AND $flag !==2)){
      $startpos = strpos($this->beautyText , $tag[0]);
    }elseif ($flag === 1){
      $startpos = strpos($this->beautyText , $tag[1]);
    }elseif ($flag === 2){
      $startpos = strpos($this->beautyText , $tag[0]) + strlen($tag[0]);
    }

    $this->beautyText = substr($this->beautyText , 0 , $startpos) . $html . substr($this->beautyText , $startpos);
    return $this;

  }
}