<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 17:36
 */
session_start();

require_once 'Models/system_m.php';
require_once 'Models/ArticleModel.php';
require_once 'Models/global_vars.php';

$auth = isAuth();
$db = connectDb();
$articles = getAllArticles($db);

$path = getPath();
$content = renderHtml($path, [
    'auth' => $auth,
    'articles' => $articles,
]);

$html = renderHtml($main_vPath, [
    'content' => $content,
    'title' => 'Main page'
]);

echo $html;
