<?php 
if (count($errors) != 0)
{
	for ($i = 0, $c = count($errors); $i < $c; $i++)
	{
		$error = $errors[$i];
		require('views/skel_errors.phtml');
	}
}