<?php
require('card.php');
class Card_xml extends Card {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	  *@description get the information of a single article
	  *@param none
	  *@output an XML document
	*/
	public function get_article_XML()
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
		$result=$this->get_article();

		//error handling
		if($result===1){
			$errors->appendChild($xmlDoc->createElement('error','POST error'));
			echo $xmlDoc->saveXML();
			return;
		}elseif($result===2){
			$errors->appendChild($xmlDoc->createElement('error','access error'));
			echo $xmlDoc->saveXML();
			return;
		}

		//All the fields of an article will be outputed. Whatever one element is empty or not, it will be always outputed
		if(count($result)>0){
			$content->appendChild(
				$xmlDoc->createElement('id',$result['id'])
				);
			$content->appendChild(
				$xmlDoc->createElement('title',$result['title'])
				);
			$content->appendChild(
				$xmlDoc->createElement('content',$result['content'])
				);
			$content->appendChild(
				$xmlDoc->createElement('add_user_id',$result['add_user_id'])
				);
			$content->appendChild(
				$xmlDoc->createElement('add_time',$result['add_time'])
				);
			$content->appendChild(
				$xmlDoc->createElement('last_edit_time',$result['last_edit_time'])
				);
			$content->appendChild(
				$xmlDoc->createElement('format',$result['format'])
				);
			$content->appendChild(
				$xmlDoc->createElement('size',$result['size'])
				);
			$content->appendChild(
				$xmlDoc->createElement('number_of_words',$result['num_of_words'])
				);
			$content->appendChild(
				$xmlDoc->createElement('original_url',$result['original_url'])
				);
			$content->appendChild(
				$xmlDoc->createElement('is_url_valid',$result['is_url_valid'])
				);
			$content->appendChild(
				$xmlDoc->createElement('not_valid_time',$result['not_valid_time'])
				);
			$content->appendChild(
				$xmlDoc->createElement('rank',$result['rank'])
				);
			$content->appendChild(
				$xmlDoc->createElement('assessment',$result['assessment'])
				);
			$content->appendChild(
				$xmlDoc->createElement('num_of_read',$result['num_of_read'])
				);
			$content->appendChild(
				$xmlDoc->createElement('num_of_like',$result['num_of_like'])
				);
			$content->appendChild(
				$xmlDoc->createElement('num_of_favorite',$result['num_of_favorite'])
				);
			$content->appendChild(
				$xmlDoc->createElement('num_of_share',$result['num_of_share'])
				);
			$content->appendChild(
				$xmlDoc->createElement('major_tag_id',$result['major_tag_id'])
				);
		}

		//output xml document
		echo $xmlDoc->saveXML();
	}

	/**
	  *@description get information of an article except the content
	  *@param none
	  *@output an XML document
	*/
	public function get_article_brief_XML()
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

		$result=$this->get_article_brief();
		
		//error handling
		if($result===1){
			$errors->appendChild($xmlDoc->createElement('error','POST error'));
			echo $xmlDoc->saveXML();
			return;
		}elseif($result===2){
			$errors->appendChild($xmlDoc->createElement('error','access error'));
			echo $xmlDoc->saveXML();
			return;
		}

		//All the fields of an article will be outputed except content. Whatever one element is empty or not, it will be always outputed
		if(count($result)>0){
			$content->appendChild(
				$xmlDoc->createElement('id',$result['id'])
				);
			$content->appendChild(
				$xmlDoc->createElement('title',$result['title'])
				);
			$content->appendChild(
				$xmlDoc->createElement('add_user_id',$result['add_user_id'])
				);
			$content->appendChild(
				$xmlDoc->createElement('add_time',$result['add_time'])
				);
			$content->appendChild(
				$xmlDoc->createElement('last_edit_time',$result['last_edit_time'])
				);
			$content->appendChild(
				$xmlDoc->createElement('format',$result['format'])
				);
			$content->appendChild(
				$xmlDoc->createElement('size',$result['size'])
				);
			$content->appendChild(
				$xmlDoc->createElement('number_of_words',$result['num_of_words'])
				);
			$content->appendChild(
				$xmlDoc->createElement('original_url',$result['original_url'])
				);
			$content->appendChild(
				$xmlDoc->createElement('is_url_valid',$result['is_url_valid'])
				);
			$content->appendChild(
				$xmlDoc->createElement('not_valid_time',$result['not_valid_time'])
				);
			$content->appendChild(
				$xmlDoc->createElement('rank',$result['rank'])
				);
			$content->appendChild(
				$xmlDoc->createElement('assessment',$result['assessment'])
				);
			$content->appendChild(
				$xmlDoc->createElement('num_of_read',$result['num_of_read'])
				);
			$content->appendChild(
				$xmlDoc->createElement('num_of_like',$result['num_of_like'])
				);
			$content->appendChild(
				$xmlDoc->createElement('num_of_favorite',$result['num_of_favorite'])
				);
			$content->appendChild(
				$xmlDoc->createElement('num_of_share',$result['num_of_share'])
				);
			$content->appendChild(
				$xmlDoc->createElement('major_tag_id',$result['major_tag_id'])
				);
		}

		echo $xmlDoc->saveXML();
	}

	/**
	  *@description add a new article
	  *@param none
	  *@output an XML document
	*/
	public function add_article_XML()
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

		$result=$this->add_article();
		
		//error handling
		if($result===1){
			$errors->appendChild($xmlDoc->createElement('error','POST error'));
			echo $xmlDoc->saveXML();
			return;
		}elseif($result===2){
			$errors->appendChild($xmlDoc->createElement('error','access error'));
			echo $xmlDoc->saveXML();
			return;
		}

		echo $xmlDoc->saveXML();
	}

}
?>