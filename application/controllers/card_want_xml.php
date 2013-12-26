<?php
require('card_want.php');
class Card_want_xml extends Card_want {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	  *@description want a card
	  *@param none
	  *@output an XML document
	*/
	public function want_XML()
	{
		//prepare the XML document
		header("Content-Type: text/xml");
		$xmlDoc=new DOMDocument('1.0','UTF-8');
		$root=$xmlDoc->appendChild(
			$xmlDoc->createElement('response'));
		//error message
		$errors=$root->appendChild(
			$xmlDoc->createElement('errors'));
		//content
		$content=$root->appendChild(
			$xmlDoc->createElement('content'));

		//get the article
		$result=$this->want();

		//error handling
		if($result===1){
			$errors->appendChild($xmlDoc->createElement('error','POST error'));
			echo $xmlDoc->saveXML();
			return;
		}elseif($result===2){
			$errors->appendChild($xmlDoc->createElement('error','access error'));
			echo $xmlDoc->saveXML();
			return;
		}elseif($result===3){
			$errors->appendChild($xmlDoc->createElement('error','already wanted'));
			echo $xmlDoc->saveXML();
			return;
		}

		//output xml document
		echo $xmlDoc->saveXML();
	}

}
?>