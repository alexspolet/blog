<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 17:49
 */
session_start();
function __autoload($name){
  require_once str_replace('\\' , DIRECTORY_SEPARATOR , $name). '.php';
}


//$id = $_GET['aid'];
$request = new \Core\Request($_POST , $_SERVER);
$id = $request->getGet();
$mArticle = \Models\ArticleModel::getInstance();
$article = $mArticle->get($id);

if (!$article) {
  header("location:'index.php'");
}

$content = renderHtml($path, [
    'article' => $article,
    'auth' => $auth,
  'mainfile' => 'index.php'
]);

/*$html = renderHtml('view/main_v.php' , [
   'content' => $content,
  'title' => 'Article'
]);

echo $html;*/