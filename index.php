<?php

// Start session
session_start();


// Initialize database
$db = mysqli_connect('192.168.1.51', 'lechat', 'gochat', 'lechat');

if ($db === false)
	die(mysqli_connect_error());


// Objects autoloader
spl_autoload_register(function($class)
{
    require('models/'.$class.'.class.php');
});
if (isset($_SESSION['id']))
{
	$userManager = new UserManager($db);
	$currentUser = $userManager->getCurrent();
}

// Constants
define('STATUS_USER', '0');
define('STATUS_ADMIN', '1');


// Errors
$errors = array();


// Pages
$access_public = array('login', 'register');
$access_user = array('logout', 'chat', 'private');
$access_admin = array('dashboard');


// Handlers
$handler_public = array('user');
$handler_user = array('public', 'private');
$handlers = array(
	'login' => 'user',
	'register' => 'user',
	'chat' => 'public',
	'private' => 'private',
	'dashboard' => 'user'
);


// Page access
if (isset($_GET['page']))
{
	if (in_array($_GET['page'], $access_public) && !isset($_SESSION['id']))
	{
		$page = $_GET['page'];
	}
	else if (in_array($_GET['page'], $access_user) && isset($_SESSION['id']))
	{
		$page = $_GET['page'];
	}
	else if (in_array($_GET['page'], $access_admin) && isset($_SESSION['id']) && $_SESSION['status'] == 1)
	{
		$page = $_GET['page'];
	}
	else
	{
		$page = '404';
	}

	if (isset($_POST['handler']))
	{
		if (in_array($_POST['handler'], $handler_public))
		{
			require('controllers/handler_'. $_POST['handler'] .'.php');
		}
		else if (in_array($_POST['handler'], $handler_user) && isset($_SESSION['id']))
		{
			require('controllers/handler_'. $_POST['handler'] .'.php');
		}
	}
}
else
{


	// Default pages
	if (isset($_SESSION['id'])) {
		header('location: ?page=chat');
		exit;
	}
	else
	{
		header('location: ?page=login');
		exit;
	}
}

require('controllers/skel.php');