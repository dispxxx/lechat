<?php 

if (isset($_POST['action']))
{


	// Send action
	if ($_POST['action'] == 'send')
	{
		if (isset($_POST['message_content']))
		{
			$message_content = mysqli_real_escape_string($db, $_POST['message_content']);
		
			$query = "	INSERT INTO public(id_sender, content)
						VALUES(".$_SESSION['id'].", '".$message_content."')";
		
			if($data = mysqli_query($db, $query))
			{
				$success = "Votre message a bien été envoyé!";
			}
			else
			{
				$errors[]= "Une erreur est survenu, merci de recommencer!";
			}
			exit;
		}
	}


	// Recept action
	if ($_POST['action'] == "recept") {
		$query = "	SELECT id_sender, content, date_sent, user.name AS user_name
					FROM public
					LEFT JOIN user ON public.id_sender =  user.id
					LIMIT 30
				";

		$data = mysqli_query($db, $query);

		while ($result = mysqli_fetch_assoc($data))
		{
			require('views/content_chat_list.phtml');
		}

		$query = "	UPDATE user 
					SET date_last_connect = '". date('Y-m-d H:i:s', time()) ."'
					WHERE id = ".$_SESSION['id'];

		if ($data = mysqli_query($db, $query))
		{
	
		}
		else
		{
			$errors[] = "Connection error";
		}
		exit;
	}
}