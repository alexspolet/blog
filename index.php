<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 17:36
 */
session_start();

include_once 'settings.php';

function __autoload($name){
  require_once str_replace('\\' , DIRECTORY_SEPARATOR , $name). '.php';
}


$app = new \Core\App(new \Core\Request($_POST , $_SERVER));
$app->goApp();


$somePrivUser = \Models\AdminModel::getInstance()->getById(['id' =>
   2]);





var_dump($somePrivUser->isAdmin());


var_dump($somePrivUser);


