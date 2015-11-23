<?php 

$getArray = array('login', 'register', 'chat', 'private', 'dashboard');
$headerArray = array('Log-in', 'Register', 'Public chatroom', 'Private discussion with', 'Dashboard');

$key = array_search($page, $getArray);

if (!is_nan($key))
{	
	$header = $headerArray[$key];
}

var_dump($header);
require('./views/skel_header.phtml');