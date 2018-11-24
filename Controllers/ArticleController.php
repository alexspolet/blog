<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 23.11.18
 * Time: 20:08
 */

class ArticleController extends MainController
{


  public function indexAction(){
    $mArticle = new ArticleModel();
    $articles = $mArticle->getAll();

    echo $this->render('Views/index.html.php',
        ['articles' => $articles]);
  }

  public function oneAction(){
    $mArticle = new ArticleModel();
    $id = $this->get['id'];
    $title = 'article_' . $id;
    $article = $mArticle->getById($id);

    $htmlGen = new HTMLGenerator($article);
    $htmlGen
        ->wrapEachInP()
        ->addTextToTop(HTMLGenerator::addTitle($title))
        ->addTo(HTMLGenerator::addImg('img/elephant.png' , '50' , '50') , 'p' , '1' , 1)
        ->wrapAllInBox('wrapper');
    $article = $htmlGen->beautyText;

    echo $this->render('Views/article.html.php' , ['article' => $article ,'title' => $title]);
  }


}