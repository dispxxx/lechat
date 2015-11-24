<?php 
	$db = mysqli_connect('192.168.1.51', 'lechat', 'gochat', 'lechat');
	if (isset($_POST['action'])) {
		if ($_POST['action'] == 'send') {
			if (isset($_POST['message_id_sender'], $_POST['message_content'])) {

				$message_content = mysqli_real_escape_string($db, $_POST['message_content']);
				$query = "INSERT INTO public(id_sender, content) VALUES(".$_POST['message_id_sender'].", '".$message_content."')";
				if($data = mysqli_query($db, $query)){
					echo 'success';
				}else {
					echo "errors";
				}

			}
		}


	}

