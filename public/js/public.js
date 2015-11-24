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

    /*
    Can use $_Get with js
     */
    function $_GET(param) {
        var vars = {};
        window.location.href.replace(
            /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
            function( m, key, value ) { // callback
                vars[key] = value !== undefined ? value : '';
            }
        );

        if ( param ) {
            return vars[param] ? vars[param] : null;
        }
        return vars;
    }

	if( $_GET('page') == 'chat') {
		getMessage()
		setInterval(getMessage, 1000)
		setInterval(userUpdate, 1000)
	}





    // Get discussion
    function getMessagePrivate()
    {
        console.log($('li.active a').attr('aria-controls'))
        $.post(
            "index.php?page=private",
            {
                handler: "private",
                action: "recept",
                other_id : $('li.active a').attr('aria-controls')
            },
            function(data)
            {
                $('.chatbox').html(data);
            }
        )
    }
    // Send message
    $('.form_chat_private').submit(
        function ()
        {
            var content = $('.message_chat').val()

            $.post(
                'index.php?page=private',
                {
                    handler: "private",
                    message_content: content,
                    action: 'send',
                    other_id: $('li.active a').attr('aria-controls')
                },
                function(status)
                {
                    $('.chatbox').append(status)
                    $('.message_chat').val('')
                }
            )

            getMessagePrivate()
            return false
        }
    )
    if($_GET('page')== 'private'){
        getMessagePrivate();
        setInterval(getMessagePrivate, 1000);
        $('li a').click(function(){
            getMessagePrivate()
        });
    }



})