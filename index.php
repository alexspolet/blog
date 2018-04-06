<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 01.04.18
 * Time: 11:31
 */

include_once 'ShopProduct.php';
include_once 'ShopProductWriter.php';

$product1 = new BookProduct('Мастер и Маргарита' , 'Булгаков'  , 'Михаил' , 5.99 , 311);


$product2 = new CDProduct( 'Химера', 'Ария', 'Группа' , 10.99 , 60);



$product3 = new ShopProduct('bucket' , 'JVC' , 'firm' , 234);
$product4 = new BookProduct('Some book' , 'Author' , 'Name' , 345);


$writer = new ShopProductWriter();
$writer->addProduct($product1);
$writer->addProduct($product2);

$writer->write();
echo 111 .'<br>';


echo 1;
