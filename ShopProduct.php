<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 01.04.18
 * Time: 11:30
 */

class ShopProduct {
	private $title;
	private $producerMainName;
	private $producerFirstName;
	protected $price;
	private $discount = 0;

	/**
	 * ShopProduct constructor.
	 *
	 * @param string $title
	 * @param string $producerMainName
	 * @param string $producerFirstName
	 * @param int $price
	 */
	public function __construct( $title, $producerMainName, $producerFirstName, $price ) {
		$this->title             = $title;
		$this->producerMainName  = $producerMainName;
		$this->producerFirstName = $producerFirstName;
		$this->price             = $price;
	}

	/**
	 * @return string
	 */
	public function getProducerMainName() {
		return $this->producerMainName;
	}

	/**
	 * @return string
	 */
	public function getProducerFirstName() {
		return $this->producerFirstName;
	}

	/**
	 * @param mixed $discount
	 */
	public function setDiscount( $discount ) {
		$this->discount = $discount;
	}

	/**
	 * @return mixed
	 */
	public function getDiscount() {
		return $this->discount;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return int
	 */
	public function getPrice() {
		return ($this->price - $this->discount);
	}



	public function getSummaryLine(){
		$base = $this->title . ' ' . $this->producerFirstName . ' ' .$this->producerMainName. ' (' . $this->price . '$)';
		return $base;
	}


	public function getProducer(){
		return $this->producerFirstName . ' ' . $this->producerMainName;
	}



}

class CDProduct extends ShopProduct {
	private $playLength = 0;

	/**
	 * CDProduct constructor.
	 * 
	 * @param string $title
	 * @param string $producerMainName
	 * @param string $producerFirstName
	 * @param int $price
	 * @param $playLength
	 */
	public function __construct($title , $producerMainName , $producerFirstName , $price ,$playLength ) {
		parent::__construct($title , $producerMainName , $producerFirstName , $price);
		$this->playLength = $playLength;
	}


	public function getPlayLength(){
		return $this->playLength;
	}

	public function getSummaryLine(){

		$base = parent::getSummaryLine();
		$base .= ' ' . $this->playLength . 'мин';
		return $base .'<br>';
	}

}

class BookProduct extends ShopProduct {
	private $numPages = 0;

	/**
	 * BookProduct constructor.
	 *
	 * @param string $title
	 * @param string $producerMainName
	 * @param string $producerFirstName
	 * @param int $price
	 * @param $numPages
	 */
	public function __construct( $title, $producerMainName, $producerFirstName, $price , $numPages ) {

		parent::__construct($title, $producerMainName, $producerFirstName, $price);
		$this->numPages = $numPages;
	}


	public function getNumberOfPages(){
		return $this->numPages;
	}

	public function getSummaryLine(){
		$base = parent::getSummaryLine();
		$base .= ' ' . $this->numPages . 'стр ';
		return $base .'<br>';
	}

	/**
	 * @return int
	 */
	public function getPrice() {
		return $this->price;
	}



}