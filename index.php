<?php

function __autoload($name){
    include_once str_replace('\\' , DIRECTORY_SEPARATOR , $name). '.php';
}

$c = isset($_GET['c']) ? $_GET['c'] . 'Controller' : 'ArticleController';

switch ($c){
  case  'ArticleController':
    $ctrlName = 'Controllers\ArticleController';
    $defaultMethod = 'indexAction';
    break;

  case 'PageController':
    $ctrlName = 'Controllers\PageController';
    $defaultMethod = 'aboutAction';
    break;

  default:
    $ctrlName = 'Controllers\PageController';
    $defaultMethod = 'pageNotFoundAction';
}


$act = isset($_GET['act']) ? $_GET['act'] . 'Action' : $defaultMethod;
$ctrl = new $ctrlName(new \Core\Request($_GET , $_POST , $_SERVER));
$ctrl->$act();