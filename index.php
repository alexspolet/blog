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

/*$admin = \Models\RoleModel::getInstance()->getPermissions(['role' =>
    'admin']);

var_dump($admin->permissions);*/


/*$somePrivUser = \Models\PrivilegedUserModel::getInstance();
$somePrivUser->getById(['id' => 2]);
var_dump($somePrivUser->roles);*/

$somePrivUser = \Models\PrivilegedUserModel::getInstance()->getById(['id' =>
    2]);

/*var_dump($somePrivUser->roles);
var_dump($somePrivUser->hasRole('moderator'));*/

/*$somePrivUser->addRole('moderator');
var_dump($somePrivUser->roles);*/

//$somePrivUser->deleteRole('moderator');
var_dump($somePrivUser->roles);
var_dump($somePrivUser->permissions);
