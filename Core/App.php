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
    $this->routes = include_once ROOT . '/Core/configs/routingMaps.php';
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
    $routesStart = substr($this->request->getRoute(), 1);
   $routeArr = explode('/' , $routesStart);
    $id = false;

    foreach ($routeArr as $key => $item){
      if (is_numeric($item)){
        $id = $item;
        $item = 'int';

      }
      $routeArr[$key] = $item;
    }



    if (!$id){
      return isset($this->routes[$this->request->getRoute()]) ? $this->routes[$this->request->getRoute()] : false;
    }

    $routePattern = '/' . implode('/' , $routeArr);
    $routePatterns = [];
    foreach ($this->routes as $key => $route) {
      if (stripos($key , 'int')){
        $routePatterns[] = $key;
      }
    }

    if (!in_array($routePattern , $routePatterns)){
      return false;
    }

    $params = $this->routes[$routePattern];
    $this->request->setGet($params['params']['int'] , $id) ;

return $params;
  }
}