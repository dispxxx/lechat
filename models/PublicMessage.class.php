<?php 

class PublicMessage
{

	// Properties
	private $id;
	private $id_sender;
	private $content;
	private $date_sent;


	// Getters
	public function getId ()
	{
		return $this -> id;
	}
	public function getSender ()
	{
		return $this -> id_sender;
	}
	public function getContent () 
	{
		return $this -> content;
	}
	public function getDate ()
	{
		return $this -> date_sent;
	}


	// Setters
	public function setContent ($content)
	{
	
		// Check content
		if ($content == '') {
			return "You can't send empty messages";
		}
		if (strlen($content) > 1022) {
			return "Your message is too long";
		}
		
		$this -> content = mysqli_escape_string($db, $content);
		return true;
	}
	public function setSender (User $sender)
	{
		$this -> id_sender = $sender -> $getId();
		return true;
	}
}