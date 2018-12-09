<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 08.12.18
 * Time: 21:23
 */

namespace Controllers;


use Core\SQL;
use Models\PrivilegedUserModel;
use Models\RoleModel;
use Models\SessionModel;
use Models\UserModel;

class AdminController extends UserController
{
    public function adminAction(){
        if (!SessionModel::read('admin')){
            $this->getRedirect('/account');
        }

        $users = [];
        if ($this->request->isPost()){
            $post = $this->request->getPost();
            $login = $post['user_login'];
            $users = UserModel::getInstance()->getByText('login' , ['word' =>
                "%$login%"]);

            foreach ($users as $user){
                $roles = [];
                $roles = PrivilegedUserModel::getInstance()->get
                (['id_user' =>$user['id']]);

                $user['roles'] = $roles;
            }


            //$roles = RoleModel::getInstance()->getAll();

        }
        $this->content = self::generateInnerTemplate('Views/admin_v.php' , ['users' => $users]);
    }

    public function addRoleAction()
    {
//TODO Допилить класс
        if (!SessionModel::read('admin')){
            $this->getRedirect('/account');
        }
        $users = UserModel::getInstance()->getAll();
        $roles = RoleModel::getInstance()->getAll();


        if ($this->request->isPost()){
        }
        $this->content = self::generateInnerTemplate('Views/admin_v.php', ['users' => $users, 'roles' => $roles]);
    }

        /*if (!$this->auth) {
            $this->getRedirect('/auth');
        }
        $user_id = SessionModel::read('user_id');
        $user = UserModel::getInstance()->getOne(['id' => $user_id])['login'];
        if ($this->request->isPost() AND isset($this->request->getPost()['exit'])) {
            $this->logoutAction();
        }

        $this->content = self::generateInnerTemplate('Views/account_v.php', ['user' => $user]);
    }*/
}