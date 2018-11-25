<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 18.11.18
 * Time: 12:19
 */

session_start();
require_once 'model/system_m.php';
require_once 'model/articles_m.php';
require_once 'model/global_vars.php';


$auth = isAuth();
if (!$auth) {
  header('location: auth.php');
  exit();
}

if (!empty($_POST) AND isset($_POST['exit'])) {
  $_SESSION['auth'] = false;

  setcookie('login', 'admin', time() - 1); /*unset ($_COOKIE['login']);*/
  setcookie('pass', md5('123456'), time() - 1); /*unset ($_COOKIE['pass']);*/

  header('location: index.php');
  exit();
}
$path = getPath();
 $content = renderHtml($path);

$html = renderHtml($main_vPath, [
     'content' => $content,
   'title' => 'account'
 ]);

echo $html;
