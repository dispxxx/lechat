<?php 
require('models/User.class.php');
class UserManager
{
	private $db; 

	public function create($email, $name, $password)
	{
		$user = new User();
		$valide = $email->setEmail($email);
		if($valide === true)
		{
			$valide = $name->setName($name);
			if ($valide === true) 
			{
				$valide = $password->setPassword($password);
				if ($valide === true) 
				{
					$email = mysqli_real_escape_string($this->db, $user->getEmail());
					$name = mysqli_real_escape_string($this->db, $user->getName());
					$password = mysqli_real_escape_string($this->db, $user->getPassword());
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
	public function delete()
	{

	}
	public function update()
	{

	}
	public function find()
	{

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
