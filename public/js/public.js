$(document).ready(function() {
		

	// Get discussion
	function getMessage()
	{
		$.post(
			"index.php?page=chat",
			{
				handler: "public",
				action: "recept"
			},
			function(data)
			{
				$('.chatbox').html(data)
			}
		)
	}


	// Send message
	$('.form_chat').submit(
		function ()
		{
			var content = $('.message_chat').val()
			
			$.post(
				'index.php?page=chat',
				{
					handler: "public",
					message_content: content,
					action: 'send'
				},
				function(status)
				{
					$('.chatbox').append(status)
					$('.message_chat').val('')
				}
			)
			
			getMessage()
			return false
		}
	)


	// User list
	function userUpdate()
	{
		$.post(
			'index.php?page=chat',
			{
				handler: 'public',
				action: 'userUpdate'
			},
			function(list)
			{
				$('.user-list').append(list['name'])
			}
		)
	}


	getMessage();
	setInterval(getMessage, 1000);
	setInterval(userUpdate, 1000);
})