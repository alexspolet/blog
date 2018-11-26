<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 17:36
 */
session_start();

function __autoload($name){
  require_once str_replace('\\' , DIRECTORY_SEPARATOR , $name). '.php';
}

require_once 'Models/system_m.php';

$auth = isAuth();

$mArticle = \Models\ArticleModel::getInstance();
$articles = $mArticle->getAll();

$path = getPath();
$content = renderHtml($path, [
    'auth' => $auth,
    'articles' => $articles,
]);

$html = renderHtml('view/main_v.php', [
    'content' => $content,
    'title' => 'Main page'
]);

echo $html;
