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

  protected function getAuth()
  {
    return $this->auth;

  }
  public function renderHtml()
  {
    echo self::generateInnerTemplate('Views/main_v.php', [
        'title' => $this->title,
        'auth' => $this->auth,
        'content' => $this->content
    ]);
  }

  protected function page404Action()
  {
    $this->title = '404. Page not found';
    $path = 'Views/404Page_v.php';
    header('HTTP/1.1 404 page not found');
    $this->content = self::generateInnerTemplate($path);
    $this->renderHtml();
  }

  protected static function generateInnerTemplate($path , $vars = []){
    ob_start();
    extract($vars);
    include_once $path;
    $res = ob_get_clean();
    return $res;
  }

  protected function getRedirect(){

  }

}