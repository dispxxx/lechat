<?php 
class UserManager
{
	private $db; 

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function create($email, $name, $password, $passwordRepeat)
	{
		$user = new User();
		$valide = $user->setEmail($email);
		if($valide === true)
		{
			$valide = $user->setName($name);
			if ($valide === true) 
			{
				$valide = $user->setPassword($password, $passwordRepeat);
				if ($valide === true) 
				{
					$email = mysqli_real_escape_string($this->db, $user->getEmail());
					$name = mysqli_real_escape_string($this->db, $user->getName());
					$password = $user->getHash();
					$query = "INSERT INTO user (email, name, password) VALUES('".$email."', '".$name."', '".$password."')";
					$res = mysqli_query($this->db, $query);
					if ($res) 
					{
						$id = mysqli_insert_id($this->db);
						if ($id) 
						{
							return $this->findById($id);
						}
						else
						{
							return "Internal server error";
						}
					}
					else
					{
						return "errors";
					}
				}	
				else
				{
					return $valide;
				}
			}
			else
			{
				return $valide;
			}
		}
		else
		{
			return $valide;
		}


	}
	public function delete(User $user)
	{
		$id = $user->getId();
		$query = "DELETE FROM user WHERE id='".$user."'";
	}
	public function update()
	{

	}
	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM user WHERE id = '".$id."'";
		$res = mysqli_query($this->db, $query);
		if ($res) 
		{
			$user = mysqli_fetch_object($res, "User");
			if ($user) {
				return $user;
			}
			else
			{
				return "User not found";
			}
		}
		else
		{
			return "Internal server error";
		}
	}
	public function findByName()
	{

	}
	public function findByDate_register()
	{

	}
	public function findByDate_last_connect()
	{

	}
}
