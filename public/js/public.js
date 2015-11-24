"use strict";
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
		var listCache
		$.post(
			'index.php?page=chat',
			{
				handler: 'public',
				action: 'userUpdate'
			},
			function(list)
			{
				console.log(list)
				if (list != listCache)
				{
					$('.user-list').empty()
					var jsoned = JSON.parse(list)
					for (var i = jsoned.length - 1; i >= 0; i--) {
						$('.user-list').append(
							'<a href="?page=private&id='
							+ jsoned[i].id
							+ '">'
							+ '<li class="user-cell">'
							+ jsoned[i].name
							+ '</li>'
							+ '</a>'
						)
					}
					listCache = list
				}
			}
		)
	}

	getMessage()
	setInterval(getMessage, 1000)
	setInterval(userUpdate, 1000)
})