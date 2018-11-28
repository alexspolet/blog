<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.11.18
 * Time: 18:51
 */

namespace Controllers;

use Core\App;
use Core\Request;
use Models\ArticleModel;
use Core\Tmp;
use Controllers\PageController;

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
      $page = new PageController($this->request);
      $page->page404Action();
      $page->renderHtml();
    }
    $id = $get['id'];
    $article = ArticleModel::getInstance()->get($id);

    //@TODO we need to redirect user to the 404page
    if (!$article) {
      //header("location:/");
      $page = new PageController($this->request);
      $page->page404Action();
      $page->renderHtml();
    }
    $path = Tmp::getPath($this->request);
    $this->content = Tmp::renderHtml($path, [
        'article' => $article,
        'auth' => $this->auth,
    ]);

  }

  public function addAction(){

    if (!$this->auth) {
      header('location: auth.php');
      exit();
    }


    $title = '';
    $text = '';
    $errors = [];

    if (!empty($_POST)) {
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

        $res = $mArticle->add( $title, $text);
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
      header('location: auth.php');
      exit();
    }

    $errors = [];

    $get = $this->request->getGet();
    if(!isset($get['id'])){
      $page = new PageController($this->request);
      $page->page404Action();
      $page->renderHtml();
    }
    $id = $get['id'];

    $mArticle = ArticleModel::getInstance();
    $article = $mArticle->get($id);

    if (!$article){
      //@TODO We need to do redirect to the 404 page
      $page = new PageController($this->request);
      $page->page404Action();
      $page->renderHtml();
    }else{
      $title = $article['title'];
      $text = $article['text'];

      if (!empty($_POST)) {
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $text = trim(filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        if ($title === '' OR $text === '') {
          $errors[] = 'All fields must be full';
        }

        if (!$errors) {
          $res = $mArticle->edit($id, $title, $text);
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
      $page = new PageController($this->request);
      $page->page404Action();
      $page->renderHtml();
    }
    $id = $get['id'];

    $errors = [];
    $mArticle = ArticleModel::getInstance();
    $article = $mArticle->get($id);

    if (!$article) {
      $page = new PageController($this->request);
      $page->page404Action();
      $page->renderHtml();
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