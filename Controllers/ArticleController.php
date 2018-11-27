<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.11.18
 * Time: 18:51
 */

namespace Controllers;

use Models\ArticleModel;
use Core\Tmp;

class ArticleController extends BaseController
{
  public function indexAction(){
    $mArticle = ArticleModel::getInstance();
    $articles = $mArticle->getAll();

    //$path = Tmp::getPath();

    $this->content = Tmp::renderHtml('Views/index_v.php', [
        'articles' => $articles,
        'auth' => $this->auth
    ]);
  }

  public function articleAction(){

  }

}