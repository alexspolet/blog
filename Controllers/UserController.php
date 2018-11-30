<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30.11.18
 * Time: 12:51
 */

namespace Controllers;


use Core\Tmp;

class UserController extends BaseController
{
  public static function isAuth(){
    if (!(isset($_SESSION['auth']) AND $_SESSION['auth'])){
      if (!(isset($_COOKIE['login']) AND isset($_COOKIE['pass']) AND $_COOKIE['login'] === 'admin' AND $_COOKIE['pass'] === md5('123456'))){
        return false;
      }
      $_SESSION['auth'] = true;
    }
    return true;
  }

  public function authAction(){
    $error = '';
    $auth = UserController::isAuth();
    if ($auth) {
      header('location: /account');
      exit();
    }
    $login = '';
    $pass = '';
    $setCookie = '';

    if ($this->request->isPost()) {
      $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      if (isset ($this->request->getPost()['setCookie']) ) {
        $setCookie = 'checked="checked"';
      }

      if ($login === 'admin' AND md5($pass) === md5('123456')) {
        $_SESSION['auth'] = true;
        $_SESSION['pass'] = md5($pass);
        if ($setCookie) {
          setcookie('login', $login, time() + 3600 * 24);
          setcookie('pass', md5($pass), time() + 3600 * 24);
        }
        header('location: /account');
        exit();
      } else {
        $error = 'Invalid error or password';
      }
    }

    $this->title = 'Authorization';
    $path = Tmp::getPath($this->request);
    $this->content = Tmp::renderHtml($path, [
        'login' => $login,
        'pass' => $pass,
        'setCookie' => $setCookie,
        'error' => $error
    ]);
  }

  public function accountAction(){
    if (!$this->auth) {
      header('location: /auth');
      exit();
    }

    if ($this->request->isPost() AND isset($this->request->getPost()['exit'])) {
      $_SESSION['auth'] = false;

      setcookie('login', 'admin', time() - 1);
      setcookie('pass', md5('123456'), time() - 1);

      header('location: /');
      exit();
    }

    $this->content = Tmp::renderHtml('Views/account_v.php');
  }
}