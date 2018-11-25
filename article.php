<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 17:49
 */
session_start();
require_once 'model/system_m.php';
require_once 'model/articles_m.php';
require_once 'model/global_vars.php';

$auth = isAuth();
$id = $_GET['aid'];
$db = connectDb();
$article = getArticle($db, $id);

if (!$article) {
  header("location:$mainfile");
}

$path = getPath();
$content = renderHtml($path, [
    'article' => $article,
    'auth' => $auth,
  'mainfile' => $mainfile
]);

$html = renderHtml($main_vPath , [
   'content' => $content,
  'title' => 'Article'
]);

echo $html;