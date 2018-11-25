<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 25.11.18
 * Time: 10:20
 */

namespace Core;


class Router
{
private $get;
public $ctrl;
public $act;

  /**
   * Router constructor.
   * @param $request
   */
  public function __construct(Request $request)
  {
    $this->get = $request->get;
  }

  /*public function getCtrl(){
    $c = isset($this->get['c']) ? $this->get['c'] : 'article';

    switch ($c){
      case  'article':
        $ctrlName = 'Controllers\ArticleController';
        $defaultAction = 'indexAction';
        break;

      case 'page':
        $ctrlName = 'Controllers\PageController';
        $defaultAction = 'aboutAction';
        break;

      default:
        $ctrlName = 'Controllers\PageController';
        $defaultAction = 'pageNotFoundAction';
    }

    $res = [$ctrlName , $defaultAction];
  return $res;
  }



  public function getAct(){
    $act = isset($this->get['act']) ? $this->get['act'] . 'Action' : $this->getCtrl()[1];
    return $act;
  }*/

  public function getCtrl(){
    $c = isset($this->get['c']) ? $this->get['c'] : 'article';

    switch ($c){
      case  'article':
        $ctrlName = 'Controllers\ArticleController';
        break;

      case 'page':
        $ctrlName = 'Controllers\PageController';
        break;

      default:
        $ctrlName = 'Controllers\PageController';
    }

    return $ctrlName ;

  }

  private function getDefaultAction(){
    $c = isset($this->get['c']) ? $this->get['c'] : 'article';

    switch ($c){
      case  'article':
        $defaultAction = 'indexAction';
        break;

      case 'page':
        $defaultAction = 'aboutAction';
        break;

      default:
        $defaultAction = 'pageNotFoundAction';
    }
    return $defaultAction;
  }



  public function getAct(){

    $act = isset($this->get['act']) ? $this->get['act'] . 'Action' :  $this->getDefaultAction();

   /* if (isset($this->get['act'])){
      $act = $this->get['act'];
    }else{
      $act = $this->getDefaultAction();
    }*/
    return $act;
  }
}