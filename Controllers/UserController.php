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
use Models\SessionModel;
use Models\UserModel;

class UserController extends BaseController
{

    public static function isAuth()
    {
        //TODO надо бы подумать как сделать класс более читабельным и
        // возможно разнести по подклассам
        if (!(SessionModel::has('user_id') AND SessionModel::has('token'))) {//If we haven't session
            if (!(isset($_COOKIE['login']) AND isset($_COOKIE['pass']) AND UserModel::getInstance()->getUserId(['login' => $_COOKIE['login'], 'pass' => $_COOKIE['pass']]))) {//we haven't cookie
                return false;
            }
            $token = SessionModel::generateToken();
            $user = UserModel::getInstance()->getUserId(['login' => $_COOKIE['login'], 'pass' => $_COOKIE['pass']]);
            if (SessionModel::getInstance()->getToken(['user_id' =>
                $user['id']])) {
                SessionModel::getInstance()->edit(['user_id' => $user['id'], 'token' => $token], "user_id = {$user['id']} ");
            } else {
                SessionModel::getInstance()->add(['user_id' => $user['id'], 'token' => $token]);
            }

            SessionModel::push('token', $token);
            SessionModel::push('user_id', $user['id']);
            return true;

        } else {// we have session
            if (!SessionModel::getInstance()->getToken(['user_id' =>
                SessionModel::read('user_id')])['user_id']) {//we haven't note
                // in db
                if (!(isset($_COOKIE['login']) AND isset($_COOKIE['pass']) AND UserModel::getInstance()->getUserId(['login' => $_COOKIE['login'], 'pass' => $_COOKIE['pass']]))) {// we haven't cookie
                    if (SessionModel::has('token'))
                        SessionModel::remove(['token']);
                    if (SessionModel::has('user_id')) {
                        SessionModel::remove('user_id');
                    }
                    return false;
                }

                $token = SessionModel::generateToken();
                $user = UserModel::getInstance()->getUserId(['login' => $_COOKIE['login'], 'pass' => $_COOKIE['pass']]);
                SessionModel::getInstance()->add(['user_id' => $user['id'], 'token' => $token]);
                SessionModel::push('token', $token);
                SessionModel::push('user_id', $user['id']);
                return true;

            } else {//we have note in db
                $token = SessionModel::generateToken();
                $user_id = SessionModel::read('user_id');
                SessionModel::getInstance()->edit(['user_id' => $user_id, 'token' =>
                    $token], "user_id = $user_id");
                SessionModel::push('token', $token);
                return true;
            }
        }
    }


    public function authAction()//loginAction
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
                $login = $this->request->getPost()['login'];
                $pass = $this->request->getPost()['pass'];

                if (isset ($this->request->getPost()['setCookie'])) {
                    $setCookie = 'checked="checked"';
                }

                $user = UserModel::getInstance()->getUserId(['login' => "$login", 'pass' => md5($pass)]);
                if ($user) {
                    $token = SessionModel::generateToken();
                    if (SessionModel::getInstance()->getToken(['user_id' =>
                        $user['id']])) {
                        SessionModel::getInstance()->edit(['user_id' => $user['id'], 'token' => $token], "user_id = {$user['id']} ");
                    } else {
                        SessionModel::getInstance()->add(['user_id' => $user['id'], 'token' => $token]);
                    }

                    SessionModel::push('token', $token);
                    SessionModel::push('user_id', $user['id']);

                    if ($setCookie) {
                        setcookie('login', $login, time() + 3600 * 24 * 7);
                        setcookie('pass', md5($pass), time() + 3600 * 24 * 7);
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
            'errors' => $validator->errors
        ]);
    }

    public function accountAction()
    {
        if (!$this->auth) {
            $this->getRedirect('/auth');
        }
        $user_id = SessionModel::read('user_id');
        $user = UserModel::getInstance()->getOne(['id' => $user_id])['login'];
        if ($this->request->isPost() AND isset($this->request->getPost()['exit'])) {
            $this->logoutAction();
        }

        $this->content = self::generateInnerTemplate('Views/account_v.php', ['user' => $user]);
    }

    private function logoutAction()
    {
        $user_id = SessionModel::read('user_id');
        SessionModel::getInstance()->delete($user_id);
        if (SessionModel::has('user_id')) {
            SessionModel::remove('user_id');
        }
        if (SessionModel::has('token')) {
            SessionModel::remove('token');
        }
        setcookie('login', 'admin', time() - 1);
        setcookie('pass', md5('123456'), time() - 1);

        $this->getRedirect('/');
    }

}