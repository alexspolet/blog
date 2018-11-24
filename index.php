<?php
include_once 'Controllers/MainController.php';
include_once 'Controllers/ArticleController.php';
include_once 'Models/ArticleModel.php';

$act = isset($_GET['act']) ? $_GET['act'] . 'Action' : 'indexAction';

$ctrl = new ArticleController($_GET);
$ctrl->$act();