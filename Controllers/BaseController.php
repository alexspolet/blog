<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26.11.18
 * Time: 16:17
 */

namespace Controllers;
use Core\Request;

class BaseController
{
  private $title;
  private $content;
  private $auth;
  private $request;

  public function __construct($title, $auth , $request)
  {
    $this->title = $title;
    $this->auth = $auth;
    $this->request = $request;
    $this->content = $content;
  }

}