<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 23.11.18
 * Time: 10:05
 */


function __autoload($name)
{
  include_once "classes/$name.php";
}

$genHTML = new HTMLGenerator('./articles/article1');

$genHTML->wrapEachInP()
    ->addTextToTop($genHTML::addImg('./img/picture.jpg'  , 400 , 200))
    ->addTextToTop($genHTML::addTitle('Homework'))
    -> wrapAllInBox('wrapper')
    -> wrapAllInBox();
;
$genHTML->addTo('<a href="index.php">To the main</a>' , 'p' , null ,  1);

$genHTML->addTo($genHTML::addImg('img/elephant.png' , 50 , 50) , 'p' , 1 , 1);