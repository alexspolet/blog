<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 18.11.18
 * Time: 11:30
 */
session_start();
function __autoload($name){
  require_once str_replace('\\' , DIRECTORY_SEPARATOR , $name). '.php';
}

$accountFile = './account.php';
$error = '';
$auth = isAuth();
if ($auth) {
  header("location: $accountFile");
  exit();
}
$login = '';
$pass = '';
$setCookie = '';

if (!empty($_POST)) {
  $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if (isset ($_POST['setCookie']) ) {
    $setCookie = 'checked="checked"';
  }

  if ($login === 'admin' AND md5($pass) === md5('123456')) {
    $_SESSION['auth'] = true;
    $_SESSION['pass'] = md5($pass);
    if ($setCookie) {
      setcookie('login', $login, time() + 3600 * 24);
      setcookie('pass', md5($pass), time() + 3600 * 24);
    }
    header("location: $accountFile");
    exit();
  } else {
    $error = 'Invalid error or password';
  }
}

$path = getPath();
$content = renderHtml($path, [
 'login' => $login,
 'pass' => $pass,
 'setCookie' => $setCookie,
 'error' => $error
]);

$html = renderHtml('view/main_v.php' , [
    'title' => 'authorization',
    'content' => $content
    ]);

echo $html;
