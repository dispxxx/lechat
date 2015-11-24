<?php 

if (isset($_POST['action']))
{


	// Send action
	if ($_POST['action'] == 'send')
	{
		if (isset($_POST['message_id_sender'], $_POST['message_content']))
		{
			$message_content = mysqli_real_escape_string($db, $_POST['message_content']);

			$query = "	INSERT INTO public(id_sender, content)
						VALUES(".$_POST['message_id_sender'].", '".$message_content."')";
			
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
		$datas = mysqli_query($db, $query);

		while ($data = mysqli_fetch_assoc($datas)){
			echo '<p>';
			echo '<em>'. date('G:i', strtotime($data['date_sent']))."</em> ";
			echo "<strong>@".$data['user_name']."</strong>";
			echo ': '.$data['content'];
			echo '</p>';
		}
		exit;
	}

}
