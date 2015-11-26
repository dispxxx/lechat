<?php 

class user 
{
	private $id;
	private $email;
	private $name;
	private $password;
	private $status;
	private $date_ban;
	private $date_register;
	private $date_last_connect;

	public function getId() {
		return $this->id;
	}
	public function getEmail(){
		return $this->email;
	}
	public function getName(){
		return $this->name;
	}
	public function getStatus(){
		return $this->status;
	}
	public function getDate_ban() {
		return $this->date_ban;
	}
	public function getDate_register(){
		return $this->date_register;
	}
	public function getDate_last_connect(){
		return $this->date_last_connect;
	}
	public function setEmail($email){
		if ( filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$this->email = $email;
			return;
		}
		else {
			return 'Email not valid';
		}
	}
	public function setName($name){
		if (strlen($name) >= 2 && strlen($name) <= 30)
		{
			if (preg_match("#[a-zA-Z0-9]+[ -_']*$#", $name))
			{
				$this->name = $name;
				return true;
			}
			else 
			{
				return "Username not valid";
			}
		}
		else
		{
			return "Username must be between 2 and 8 characters";
		}
	}
	public function setPassword($password, $passordRepeat){
		if (strlen($password) < 8 || strlen($password) > 30)
		{
			return "Password must be between 8 and 30 characters long";
		}
		else
		{
			if ($password == $passordRepeat) {
				$this->password = password_hash($password, PASSWORD_DEFAULT);
				return true;
			}else {
				return "Password fields don't match";
			}
		}
	}
	public function setStatus($status){
		$this->status = $status;
		return true;
	}
	public function setDate_ban ($date_ban){
		if($date_ban > time()){
			$this->date_ban = $date_ban;
			return true;
		}else {
			return "Date not valid";
		}
	}
	public function setDate_last_connect($date_last_connect){
		$this->date_last_connect = $date_last_connect;
		return true;
	}


}