<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26.11.18
 * Time: 16:17
 */

namespace Controllers;

use Core\Tmp;
use Core\Users;
use Core\Request;

abstract class BaseController
{
  protected $title;
  protected $content;
  protected $auth;
  protected $request;

  public function __construct(Request $request)
  {
    $this->title = 'My blog';
    $this->auth = Users::isAuth();
    $this->request = $request;
  }

  public function getAuth()
  {
    $auth = isset($this->auth) ? 1 : 2;
    return $auth;
  }
  public function renderHtml()
  {
    echo Tmp::renderHtml('Views/main_v.php', [
        'title' => $this->title,
        'auth' => $this->auth,
        'content' => $this->content
    ]);
  }

}