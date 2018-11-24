<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 23.11.18
 * Time: 20:08
 */

class ArticleController
{
  public $get;

  public function __construct($get)
  {
    $this->get = $get;
  }

  public function indexAction(){
    $mArticle = new ArticleModel();
    $articles = $mArticle->getAll();

    echo $this->render('Views/index.html.php',
        ['articles' => $articles]);
  }

  public function OneAction(){
    $mArticle = new ArticleModel();
    $article = $mArticle->getOne($this->get['id']);

    echo $this->render('Views/article.html.php' , ['article' => $article ,'title' => 'article_' . $this->get['id']]);
  }

  public function render($path , $vars){
    extract($vars);
    ob_start();
    include_once $path;
    return ob_get_clean();
  }
}