<?php

include_once 'Controllers/ArticleController.php';
include_once 'Models/ArticleModel.php';

$ctrl = new ArticleController();
$ctrl->indexAction();