<?php 

class PrivateMessage
{

	// Properties
	private $id;
	private $id_sender;
	private $id_recipient;
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
	public function setMessage ($content)
	{
	
		// Check content length
		if ($content == '')
		{
			return "You can't send empty messages";
		}
		if (strlen($content) > 1022)
		{
			return "Your message is too long";
		}
		
		$this -> content = mysqli_escape_string($db, $content);
		return true;
	}
	public function setSender ($id_sender)
	{
		$this -> id_sender = $id_sender;
		return true;
	}
	public function setRecipient ($id_recipient)
	{
		$this -> id_recipient = $id_recipient;
		return true;
	}
}