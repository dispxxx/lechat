<?php 
$db = mysqli_connect('192.168.1.51', 'lechat', 'gochat', 'lechat');
$query = "	SELECT id_sender, content, date_sent, user.name AS user_name
			FROM public
			LEFT JOIN user ON public.id_sender =  user.id
			LIMIT 30
		";
$data = mysqli_query($db, $query);
while ($result = mysqli_fetch_assoc($data)){
	echo "@".$result['user_name'];
	echo 'Message : '.$result['content'];
	echo 'Date : '.$result['date_sent'];
}
