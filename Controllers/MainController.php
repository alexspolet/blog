<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 24.11.18
 * Time: 13:07
 */

abstract class MainController
{
  public $get;
  public $post;

  public function __construct($get = [] , $post = [])
  {
    $this->get = $get;
    $this->post = $post;
  }

  protected function render($path , $vars){
    extract($vars);
    ob_start();
    include_once $path;
    return ob_get_clean();
  }
}