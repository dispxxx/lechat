<?php 

$query = '	SELECT id_sender, content, date_sent, user.name AS user_name
			FROM public
			LEFT JOIN user ON public.id_sender =  user.id
			LIMIT 30';

$data = mysqli_query($db, $query);

while ($result = mysqli_fetch_assoc($data))
{
	echo '<p>';
	echo '<em>'. date('G:i', strtotime($result['date_sent']))."</em> ";
	echo "<strong>@".$result['user_name']."</strong>";
	echo ': '.$result['content'];
	echo '</p>';
}