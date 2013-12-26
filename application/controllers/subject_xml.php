<?php
require('subject.php');
class Subject_xml extends Subject {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	  *@description get the information of a subject
	  *@param none
	  *@output an XML document
	*/
	public function get_subject_XML()
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
		$result=$this->get_subject();

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
				$xmlDoc->createElement('subject_word',$result['subject_word'])
				);
			$content->appendChild(
				$xmlDoc->createElement('add_time',$result['add_time'])
				);
			$content->appendChild(
				$xmlDoc->createElement('last_edit_time',$result['last_edit_time'])
				);
			$content->appendChild(
				$xmlDoc->createElement('description',$result['description'])
				);
			$content->appendChild(
				$xmlDoc->createElement('subject_tag_id',$result['subject_tag_id'])
				);
			$content->appendChild(
				$xmlDoc->createElement('num_of_card',$result['num_of_card'])
				);
			$content->appendChild(
				$xmlDoc->createElement('num_of_read',$result['num_of_read'])
				);
			$content->appendChild(
				$xmlDoc->createElement('num_of_subscription',$result['num_of_subscription'])
				);
			$content->appendChild(
				$xmlDoc->createElement('num_of_share',$result['num_of_share'])
				);
			$content->appendChild(
				$xmlDoc->createElement('direct_tag_id',$result['direct_tag_id'])
				);
		}

		//output xml document
		echo $xmlDoc->saveXML();
	}

}
?>