<?php 

$getArray = array('login', 'register', 'chat', 'private', 'dashboard', '404');
$headerArray = array('Log-in', 'Register', 'Public chatroom', 'Private discussion with', 'Dashboard', '404');

$key = array_search($page, $getArray);

if (!is_nan($key))
{	
	$header = $headerArray[$key];
}

require('./views/skel_header.phtml');