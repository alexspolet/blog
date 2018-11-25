<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 17:51
 */
session_start();
require_once 'model/system_m.php';
require_once 'model/articles_m.php';
require_once 'model/global_vars.php';

$auth = isAuth();
if (!$auth) {
  header('location: auth.php');
  exit();
}


$title = '';
$text = '';
$errors = [];

if (!empty($_POST)) {

  $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $text = trim(filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

  $errors = validateParams($title, $text);
  $db = connectDb();
  $articles = getAllArticles($db);

  foreach ($articles as $article) {
    if ($title === $article['title']) {

      $errors[] = 'An article with such name already exists';
    }
  }

  if (!$errors) {
    $res = addArticle($db, $title, $text);
    if (!$res) {
      $errors[] = '<p>Error. We cannot add article to the db</p>';

    }
  }
}

$path = getPath();
$content = renderHtml($path, [
    'title' => $title,
    'text' => $text,
    'errors' => $errors
]);

$html = renderHtml($main_vPath, [
    'content' => $content,
    'title' => $title
]);

echo $html;

