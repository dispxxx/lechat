<?php
require('models/PublicMessage.class.php');
class PublicMessageManager
{
	private $db;

	public function __construct($db)
	{
		$this -> db = $db;
	}

	public function create ($content, User $sender)
	{
		$publicMessage = new PublicMessage();
		$result = $publicMessage -> setContent($content);

		if ($result === true)
		{
			$result = $publicMessage -> setSender($sender);

			if ($result === true)
			{
				$content 	= mysqli_escape_string($this -> db, $publicMessage -> getContent());
				$id_sender 	= $publicMessage -> getSender() -> getId();
				$query 		= "	INSERT INTO message (content, id_sender)
								VALUES('".$content."', '".$id_sender."')";
				$result 	= mysqli_query($this -> db, $query);

				if ($result)
				{
					$id = mysqli_insert_id($this -> db);

					if ($id)
					{
						return $this -> readById($id);
					}
					else
					{
						return "Internal server error";
					}
				}
				else
				{
					return mysqli_error($this -> db);
				}
			}
			else
			{
				return $result;
			}
		}
		else
		{
			return $result;
		}
	}

	public function read ()
	{
		$query = 'SELECT * FROM publicMessage ORDER BY date_sent DESC LIMIT 30';
		$result = mysqli_query($this -> db, $query);
		$messages = array();

		if ($result)
		{
			while ($message = mysqli_fetch_object($result, 'publicMessage'))
			{
				$messages[] = $message -> getArray();
			}
			return $messages;
		}
		else
		{
			return 'Database error';
		}
	}

	public function readById ($id)
	{
		$id 	= intval($id);
		$query 	= '	SELECT *
					FROM message
					WHERE id = "'. $id .'"';
		$result	= mysqli_query($this -> db, $query);

		if ($result)
		{
			$publicMessage = mysqli_fetch_object($result, "Message");

			if ($publicMessage)
			{
				return $publicMessage;
			}
			else
			{
				return "Message not found";
			}
		}
		else
		{
			return "Internal server error";
		}
	}

	public function readByContent ($content)
	{
		
	}

	public function readByAuthor ($author)
	{
		
	}

	public function update (PublicMessage $message)
	{

	}

	public function delete (PublicMessage $message)
	{

	}
}
