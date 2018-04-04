<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 02.04.18
 * Time: 12:22
 */

class ShopProductWriter {
	private $products = [];

	public function addProduct(ShopProduct $shop_product){
		$this->products[] = $shop_product;
	}

	public function write(){
		$str = '';
		foreach ($this->products as $shopProduct){
			$str = "{$shopProduct->title}: {$shopProduct->getProducer()} ({$shopProduct->price})\n";
			print $str .'<br>';
		}

	}
}

