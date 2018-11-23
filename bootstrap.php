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
    ->addTextToTop($genHTML::addTitle('Homework'))
    -> wrapAllInBox('wrapper')
    -> wrapAllInBox();

$genHTML->addTextToTop($genHTML::addImg('./img/picture.jpg'));

var_dump($genHTML->findByTag('p' , 7));

$genHTML->addTo('<hr>' , 'p' , 2 ,  0);

var_dump($genHTML->beautyText);
