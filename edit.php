<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 22:06
 */
session_start();
function __autoload($name){
  require_once str_replace('\\' , DIRECTORY_SEPARATOR , $name). '.php';
}

$auth = isAuth();
if (!$auth){
  header('location: auth.php');
  exit();
}


$errors = [];

if (!isset($_GET['aid']) OR $_GET['aid'] == ''){
  header("location: 'index.php'");
}

$id = $_GET['aid'];

$mArticle = \Models\ArticleModel::getInstance();
$article = $mArticle->get($id);

if (!$article){
  $errors = 'Article not found';
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
        header("location: article.php?aid=$id");
        exit();
      }else{
          $errors[] = 'Error. Cannot edit the article';
      }
    }
  }
}

$path = getPath();
$content = renderHtml($path, [
    'id' => $id,
    'title' => $title,
    'text' => $text,
    'errors' => $errors
]);

$html = renderHtml('view/main_v.php', [
    'content' => $content,
    'title' => 'Add article'
]);

echo $html;