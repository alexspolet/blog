<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 17:36
 */
session_start();

function __autoload($name){
  require_once str_replace('\\' , DIRECTORY_SEPARATOR , $name). '.php';
}


var_dump(new \Core\Request($_POST , $_SERVER));



/*$ctrl = new \Controllers\ArticleController(new \Core\Request($_GET , $_POST , $_SERVER));
echo $ctrl->getAuth();
$ctrl->indexAction();
$ctrl->renderHtml();*/
