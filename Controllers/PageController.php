<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 24.11.18
 * Time: 22:45
 */

namespace Controllers;


class PageController extends BaseController
{
  public function aboutAction(){

    echo $this->render('Views/about.html.php');
  }

  public function pageNotFoundAction(){
    header('HTTP/1.1 Page not found');
    echo $this->render('Views/404_page.html.php');
  }
}