<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 28.11.18
 * Time: 9:43
 */

namespace Controllers;


use Core\Tmp;

class PageController extends BaseController
{
  public function page404Action()
  {
    $this->title = '404. Page not found';
    $path = 'Views/404Page_v.php';
    header('HTTP/1.1 404 page not found');
    $this->content = Tmp::renderHtml($path);
  }
}