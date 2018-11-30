<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26.11.18
 * Time: 16:17
 */

namespace Controllers;

use Core\Tmp;
use Core\Request;

class BaseController
{
  protected $title;
  protected $content;
  protected $auth;
  protected $request;

  public function __construct(Request $request)
  {
    $this->title = 'My blog';
    $this->auth = UserController::isAuth();
    $this->request = $request;
  }

  public function getAuth()
  {
    return $this->auth;

  }
  public function renderHtml()
  {
    echo Tmp::renderHtml('Views/main_v.php', [
        'title' => $this->title,
        'auth' => $this->auth,
        'content' => $this->content
    ]);
  }

  public function page404Action()
  {
    $this->title = '404. Page not found';
    $path = 'Views/404Page_v.php';
    header('HTTP/1.1 404 page not found');
    $this->content = Tmp::renderHtml($path);
    $this->renderHtml();
  }

}