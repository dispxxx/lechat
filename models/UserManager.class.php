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
		$res = mysqli_query($this->db, $query);
		if($res)
		{
			return true;
		}
		else
		{
			return "Internal Server Error";
		}
	}
	public function update(User $user)
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
	public function findByEmail($email)
	{
		if (strlen(trim($email)) > 0) {
			$email = mysqli_escape_string($this->db, $email);
			$query = "SELECT * FROM user WHERE email = '".$email."'";
			$res = mysqli_query($this->db, $query);
			if ($res) 
			{
				$user = mysqli_fetch_object($res, "User");
				return $user;
			}
			else
			{
				return "Server error";
			}
		}
		else
		{
			"Email not found";
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
	public function getCurrent()
	{
		if (isset($_SESSION['id'])) 
		{
			$query = "SELECT * FROM user WHERE id= '".$_SESSION['id']."'";
			$res = mysqli_query($this->db, $query);
			if ($res) 
			{
				$user = mysqli_fetch_object($res, "User");
				if ($user) {
					$query = "UPDATE user SET last=NOW() WHERE id'".$user->getId()."'";
					mysqli_query($this->db, $query);
					return $user;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}
