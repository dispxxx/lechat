<?php 
$query = "	SELECT private.id, id_recipient, id_sender, recipient.name AS name_recipient, sender.name AS name_sender
			FROM private 
			LEFT JOIN user recipient ON private.id_recipient = recipient.id
			LEFT JOIN user sender ON private.id_sender = sender.id
			WHERE id_recipient = ".$_SESSION['id']." OR id_sender = ".$_SESSION['id'];
var_dump($query);
if ($data = mysqli_query($db, $query)) {
	$count = mysqli_num_rows($data);
	var_dump($count);
	if($count == 0){
		require('views/content_private_empty.phtml');
	}else {
		require('views/content_private.phtml');
	}

}
else {
	$errors[] = "db connect pb";
}

