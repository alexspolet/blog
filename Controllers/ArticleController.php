<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 23.11.18
 * Time: 20:08
 */

class ArticleController
{
  public function indexAction(){
    $mArticle = new ArticleModel();
    $articles = $mArticle->getAll();

    echo $this->render('Views/index.html.php',
        ['articles' => $articles]);
  }

  public function ArticleAction(){

  }

  public function render($path , $vars){
    extract($vars);
    ob_start();
    include_once $path;
    return ob_get_clean();
  }
}