<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30.11.18
 * Time: 12:51
 */

namespace Controllers;


use Core\Tmp;
use Core\Validator;

class UserController extends BaseController
{
  public static function isAuth()
  {
    if (!(isset($_SESSION['auth']) AND $_SESSION['auth'])) {
      if (!(isset($_COOKIE['login']) AND isset($_COOKIE['pass']) AND $_COOKIE['login'] === 'admin' AND $_COOKIE['pass'] === md5('123456'))) {
        return false;
      }
      $_SESSION['auth'] = true;
    }
    return true;
  }

  public function authAction()
  {
    $auth = UserController::isAuth();
    if ($auth) {
      $this->getRedirect('location: /account');

    }
    $validator = new Validator();

    $setCookie = '';

    if ($this->request->isPost()) {


      $validator->loadFields('login_form')->runValidation($this->request->getPost());

      if ($validator->isValid) {
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (isset ($this->request->getPost()['setCookie'])) {
          $setCookie = 'checked="checked"';
        }

        if ($login === 'admin' AND md5($pass) === md5('123456')) {
          $_SESSION['auth'] = true;
          $_SESSION['pass'] = md5($pass);
          if ($setCookie) {
            setcookie('login', $login, time() + 3600 * 24);
            setcookie('pass', md5($pass), time() + 3600 * 24);
          }
          $this->getRedirect('/account');
        } else {
          $validator->errors[] = 'Invalid error or password';
        }
      }
    }

    $this->title = 'Authorization';
    $path = Tmp::getPath($this->request);
    $this->content = self::generateInnerTemplate($path, [
        'login' => $validator->fields['login'],
        'pass' => $validator->fields['pass'],
        'setCookie' => $setCookie,
        'errors' =>  $validator->errors
    ]);
  }

  public function accountAction()
  {
    if (!$this->auth) {
      $this->getRedirect('/auth');
    }

    if ($this->request->isPost() AND isset($this->request->getPost()['exit'])) {
      $this->logoutAction();
    }

    $this->content = self::generateInnerTemplate('Views/account_v.php');
  }

  private function logoutAction()
  {
    $_SESSION['auth'] = false;

    setcookie('login', 'admin', time() - 1);
    setcookie('pass', md5('123456'), time() - 1);

    $this->getRedirect('/');
  }
}