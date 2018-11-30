<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 28.11.18
 * Time: 0:29
 */

namespace Core;


use Controllers\ArticleController;
use Controllers\UserController;

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

  public function goApp()
  {
    $params = $this->getRouteByRequest();
    if (!$params) {
      $ctrl = new \Controllers\PageController($this->request);
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
                    'action' => 'articleAction'
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
            '/auth' =>
                [
                'controller' =>'Controllers\UserController',
                  'action' => 'authAction'
                ],

            '/account' =>
                [
                    'controller' =>'Controllers\UserController',
                    'action' => 'accountAction'
                ]
        ];
  }
}