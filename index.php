<?php

function __autoload($name){
    include_once str_replace('\\' , DIRECTORY_SEPARATOR , $name). '.php';
}

/*$c = isset($_GET['c']) ? $_GET['c'] : 'article';

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


$act = isset($_GET['act']) ? $_GET['act'] . 'Action' : $defaultAction;*/


/*$ctrl = new $ctrlName(new \Core\Request($_GET , $_POST , $_SERVER));
$ctrl->$act();*/


$request = new \Core\Request($_GET , $_POST , $_SERVER);
$route = new \Core\Router($request);
$ctrl = $route->getCtrl();
$act = $route->getAct();

$obj = new $ctrl($request);
$obj->$act();