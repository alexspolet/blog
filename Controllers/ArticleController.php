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
    $request = new \Core\Request($_POST, $_SERVER);
    $id = $request->getGet()['id'];
    $article = ArticleModel::getInstance()->get($id);

    //@TODO we need to redirect user to the 404page
    if (!$article) {
      header("location:/");
    }
    $path = Tmp::getPath($request);
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
      }
    }

    $path = Tmp::getPath(new Request($_GET , $_POST));
    $this->content = Tmp::renderHtml($path, [
        'title' => $title,
        'text' => $text,
        'errors' => $errors
    ]);
  }

  public function editAction(){

  }
}