<!--TODO do this file in OOP

<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 18.11.18
 * Time: 12:19
 */

session_start();
function __autoload($name){
  require_once str_replace('\\' , DIRECTORY_SEPARATOR , $name). '.php';
}


$auth = \Controllers\UserController::isAuth();
if (!$auth) {
  header('location: /auth');
  exit();
}

if (!empty($_POST) AND isset($_POST['exit'])) {
  $_SESSION['auth'] = false;

  setcookie('login', 'admin', time() - 1);
  setcookie('pass', md5('123456'), time() - 1);

  header('location: /');
  exit();
}

 $content = \Core\Tmp::renderHtml('Views/account_v.php');

$html = \Core\Tmp::renderHtml('Views/main_v.php', [
     'content' => $content,
   'title' => 'account'
 ]);

echo $html;
