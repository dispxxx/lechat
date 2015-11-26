<?php
$actions = array('login', 'register');
if (in_array($_POST['action'], $actions)) {
	$action = $_POST['action'];
}

if ($action == "register") {
	if (isset($_POST['register_email'], $_POST['register_name'], $_POST['register_password'], $_POST['register_password_repeat'])) {
		require('models/UserManager.class.php');
		$userManager = new UserManager($db);
		$user = $userManager->create($_POST['register_email'], $_POST['register_name'], $_POST['register_password'], $_POST['register_password_repeat']);
		if (is_string($user)) {
			$errors[] = $user;
		}
		else
		{
			var_dump($user);
		}
	}
}

// // Test post_action
// $actions = array('login', 'register');

// if (isset($_POST['action']) && in_array($_POST['action'], $actions))
// {

// 	$action = $_POST['action'];


// 	// Login
// 	if ($action == 'login')
// 	{
// 		if (isset($_POST['login_email']) && isset($_POST['login_password']))
// 		{
// 			$login_email = mysqli_escape_string($db, $_POST['login_email']);
// 			$login_password = $_POST['login_password'];

// 			if ($user = mysqli_fetch_assoc(mysqli_query($db,'SELECT *
// 															 FROM user
// 															 WHERE email = "'. $login_email .'"')))
// 			{
// 				if (password_verify($login_password, $user['password']))
// 				{
// 					if ($user['date_ban'] != null && strtotime($user['date_ban']) < time()) {
// 						$errors[] = "Votre compte est désactivé jusqu'au". strtotime($_SESSION['date_ban']);
// 					}
// 					else
// 					{
// 						$_SESSION['id'] = $user['id'];
// 						$_SESSION['email'] = $user['email'];
// 						$_SESSION['name'] = $user['name'];
// 						$_SESSION['status'] = $user['status'];
// 						header('location: ?page=chat');
// 						exit;
// 					}
// 				}
// 				else
// 				{
// 					$errors[] = "Wrong password";
// 				}
// 			}
// 			else
// 			{
// 				$errors[] = "User not found";
// 			}
// 		}
// 	}


// 	// Register
// 	if ($action == 'register')
// 	{

// 		// Check each registration field for error
// 		if (isset($_POST['register_name']) && $_POST['register_name'] != "")
// 		{
// 			$register_name = mysqli_escape_string($db, $_POST['register_name']);

// 			if (strlen($register_name) >= 2 && strlen($register_name) <= 30)
// 			{
// 				if (!preg_match("#[a-zA-Z0-9]+[ -_']*$#", $register_name))
// 				{
// 					$errors[] = "Username not valid";
// 				}
// 			}
// 			else
// 			{
// 				$errors[] = "Username must be between 2 and 8 characters";
// 			}
// 		}
// 		else
// 		{
// 			$errors[] = "Username not filled";
// 		}
// 		if (isset($_POST['register_email']) && $_POST['register_email'] != "")
// 		{
// 			$register_email = mysqli_escape_string($db, $_POST['register_email']);

// 			if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,5}$#", $register_email))
// 			{
// 				$errors[] = 'Email not valid';
// 			}
// 		}
// 		else
// 		{
// 			$errors[] = "Email not filled";
// 		}
// 		if (isset($_POST['register_password']) && $_POST['register_password'] != "")
// 		{
// 			if (strlen($_POST['register_password']) < 8 || strlen($_POST['register_password']) > 30)
// 			{
// 				$errors[] = "Password must be between 8 and 30 characters long";
// 			}
// 			else
// 			{
// 				if ($_POST['register_password'] != $_POST['register_password_repeat']) {
// 					$errors[] = "Password fields don't match";
// 				}
// 			}
// 		}
// 		else
// 		{
// 			$errors[] = "Password not filled";
// 		}


// 		// Check if user exists
// 		if (count($errors) == 0)
// 		{
// 			$query = mysqli_query($db, 'SELECT *
// 										FROM user
// 										WHERE name = "'. $register_name .'" OR email = "'. $register_email .'"');
// 			if (mysqli_fetch_assoc($query))
// 			{
// 				$errors[] = "Account already exists with this username and/or email";
// 			}
// 		}


// 		// Database registration
// 		if (count($errors) == 0)
// 		{
// 			$register_password = password_hash($_POST['register_password'], PASSWORD_DEFAULT);

// 			if(mysqli_query($db, '	INSERT INTO user(email, name, password)
// 									VALUES ("'. $register_email .'","'. $register_name .'","'. $register_password .'")'))
// 			{
// 				header('Location: ?page=register&success=true');
// 				exit;
// 			}
// 			else
// 			{
// 				$errors[] = "Cannot connect to database";
// 			}
// 		}
// 	}
// }