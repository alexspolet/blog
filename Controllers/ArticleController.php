<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.11.18
 * Time: 18:51
 */

namespace Controllers;

use Core\Request;
use Models\ArticleModel;
use Core\Tmp;

class ArticleController extends BaseController
{
  public function indexAction()
  {
    $mArticle = ArticleModel::getInstance();
    $articles = $mArticle->getAll();

    $path = Tmp::getPath(new Request($_POST , $_SERVER));
    $this->content = Tmp::renderHtml($path, [
        'articles' => $articles,
        'auth' => $this->auth
    ]);
  }

  public function articleAction()
  {
    $get = $this->request->getGet();
    if(!isset($get['id'])){
      $this->page404Action();
    }
    $id = $get['id'];
    $article = ArticleModel::getInstance()->get($id);

    if (!$article) {
      $this->page404Action();
    }
    $path = Tmp::getPath($this->request);
    $this->content = Tmp::renderHtml($path, [
        'article' => $article,
        'auth' => $this->auth,
    ]);

  }

  public function addAction(){

    if (!$this->auth) {
      header('location: /auth');
      exit();
    }

    $title = '';
    $text = '';
    $errors = [];

    if ($this->request->isPost()) {
      $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $text = trim(filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

      $errors = Tmp::validateParams($title, $text);

      $mArticle = ArticleModel::getInstance();
      $articles = $mArticle->getAll();

      foreach ($articles as $article) {
        if ($title === $article['title']) {

          $errors[] = 'An article with such name already exists';
        }
      }

      if (!$errors) {

        $res = $mArticle->add( ['title' => $title, 'text' => $text]);
        if (!$res) {
          $errors[] = 'Error. We cannot add article to the db';
        }

        header("location: /article?id=$res");
      }
    }

    $path = Tmp::getPath($this->request);
    $this->content = Tmp::renderHtml($path, [
        'title' => $title,
        'text' => $text,
        'errors' => $errors
    ]);
  }

  public function editAction(){
    if (!$this->auth){
      header('location: /auth');
      exit();
    }

    $errors = [];

    $get = $this->request->getGet();
    if(!isset($get['id'])){
      $this->page404Action();
    }
    $id = $get['id'];

    $mArticle = ArticleModel::getInstance();
    $article = $mArticle->get($id);

    if (!$article){
      $this->page404Action();
    }else{
      $title = $article['title'];
      $text = $article['text'];

      if (!empty($this->request->isPost())) {
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $text = trim(filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        if ($title === '' OR $text === '') {
          $errors[] = 'All fields must be full';
        }

        if (!$errors) {
          $res = $mArticle->edit(['title' => $title, 'text' => $text] , "id = $id");
          if ($res){
            header("location: /article?id=$id");
            exit();
          }else{
            $errors[] = 'Error. Cannot edit the article';
          }
        }
      }
    }

    $path = Tmp::getPath($this->request);
    $this->content = Tmp::renderHtml($path, [
        'id' => $id,
        'title' => $title,
        'text' => $text,
        'errors' => $errors
    ]);
  }

  public function deleteAction(){
    if (!$this->auth) {
      header('location: /');
      exit();
    }

    $get = $this->request->getGet();
    if(!isset($get['id'])){
      $this->page404Action();
    }
    $id = $get['id'];

    $errors = [];
    $mArticle = ArticleModel::getInstance();
    $article = $mArticle->get($id);

    if (!$article) {
      $this->page404Action();

    }
      $res = $mArticle->delete( $article['id']);
      if (!$res) {
        $errors[] = 'Cannot delete this article';
    }

    $path = Tmp::getPath($this->request);
    $this->content = Tmp::renderHtml($path, [
        'errors' => $errors
    ]);


  }
}