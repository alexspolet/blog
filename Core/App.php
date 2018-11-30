<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 28.11.18
 * Time: 0:29
 */

namespace Core;

use \Controllers\PageController;

class App
{

  private $request;
  private $routes;
  /**
   * App constructor.
   * @param $request
   */
  public function __construct(Request $request)
  {
    $this->request = $request;
    $this->routes = include_once ROOT . '/Core/configs/RoutingMaps.php';
  }

  public function goApp()
  {
    $params = $this->getRouteByRequest();
    if (!$params) {
      $ctrl = new PageController($this->request);
      $action = 'page404Action';

    } else {
      $ctrl = new $params['controller']($this->request);
      $action = $params['action'];
    }

    $ctrl->$action();
    $ctrl->renderHTML();
  }


  private function getRouteByRequest()
  {


    return isset($this->routes[$this->request->getRoute()]) ? $this->routes[$this->request->getRoute()] : false;
  }
}