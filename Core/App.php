<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 28.11.18
 * Time: 0:29
 */

namespace Core;


use Controllers\ArticleController;

class App
{

  private $request;

  /**
   * App constructor.
   */
  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  public function goApp(){
    if (!$this->getRouteByRequest()){
      $ctrl = new ''
    }
  }

  private function getRouteByRequest(){
    return isset($this->getRoutes()[$this->request->getRoute()]) ? $this->getRoutes()[$this->request->getRoute()] : false;
  }

  private function getRoutes()
  {
    return
        ['/' =>
            [
                'controller' => 'Controllers\ArticleController',
                'action' => 'indexAction'
            ],
            '/article' =>
                [
                    'controller' => 'Controllers\ArticleController',
                    'action' => 'indexAction'
                ],
            '/add' =>
                [
                    'controller' => 'Controllers\ArticleController',
                    'action' => 'addAction'
                ],
            '/edit' =>
                [
                    'controller' => 'Controllers\ArticleController',
                    'action' => 'editAction'
                ],
            '/delete' =>
                [
                    'controller' => 'Controllers\ArticleController',
                    'action' => 'deleteAction'
                ],

        ];
  }
}