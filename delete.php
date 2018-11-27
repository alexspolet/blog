<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19.11.18
 * Time: 12:03
 */

session_start();
function __autoload($name){
  require_once str_replace('\\' , DIRECTORY_SEPARATOR , $name). '.php';
}

$auth = isAuth();
if (!$auth) {
  header('location: index.php');
  exit();
}

$id = $_GET['aid'];
$error = '';
$mArticle = \Models\ArticleModel::getInstance();
$article = $mArticle->get($id);

if (!$article) {
  $error = 'Article not found';
} else {
  $res = $mArticle->delete( $article['id']);
  if (!$res) {
    $error = 'Cannot delete this article';
  }
}

$path = getPath();
$content = renderHtml($path, [
    'mainfile' => 'index.php',
    'error' => $error
]);

$html = renderHtml('view/main_v.php' , [
    'title' => 'delete',
    'content' => $content
]);

echo $html;

