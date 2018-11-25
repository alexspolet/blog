<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 24.11.18
 * Time: 13:07
 */

namespace Controllers;

use Core\Request;

abstract class BaseController
{
  protected $request;


  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  public function __call($name, $arguments)
  {
    $ctrl = new PageController($this->request);
    $ctrl->pageNotFoundAction();

    /*header('HTTP/1.1 404 Page not found');
  echo $this->render('Views/404_page.html.php');*/
  }

  protected function render($path , $vars = []){
    extract($vars);
    ob_start();
    include_once $path;
    return ob_get_clean();
  }
}