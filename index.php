<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 23.11.18
 * Time: 10:05
 */


function __autoload($name){

include_once "classes/$name.php";
}

$genHTML = new HTMLGenerator('./articles/article1');

$genHTML->wrapEachInP();

echo $genHTML->beautyText;
