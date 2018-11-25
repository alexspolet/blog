<?php


function connectDb(){
  $db = new PDO('mysql:host=localhost;dbname=blog', 'admin', '123456');

  return $db;

}

function isAuth(){
  if (!(isset($_SESSION['auth']) AND $_SESSION['auth'])){
    if (!(isset($_COOKIE['login']) AND isset($_COOKIE['pass']) AND $_COOKIE['login'] === 'admin' AND $_COOKIE['pass'] === md5('123456'))){
      return false;
    }
    $_SESSION['auth'] = true;
  }
  return true;
}

function renderHtml($path , $vars = []){
  ob_start();
  extract($vars);
  include_once $path;
  $res = ob_get_clean();
  return $res;
}

function getPath(){
  $file = $_SERVER['PHP_SELF'];
  $file = substr($file , 0 , -4);
  $path = 'view' . $file . '_v.php';
  return $path;
}

function validateParams($title , $text){
  $errors = [];
  if ($title === '' OR $text === '') {
    $errors = 'All fields must be full';
  }

  return $errors;
}