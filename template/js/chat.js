;(function() {
	var author_id = -1;
	var chatDiv = '';

	function router(route) {
		switch(route) {
			case 'start':
				author_id = arguments[1];
				chatDiv = arguments[2];
				break;
			case 'sendMsg': 
				// (active_id, text, time)
				sendMsg(arguments[1], arguments[2], arguments[3]);
				break;
			case 'showChat':
				showChat(arguments[1], arguments[2], arguments[3]);
				break;
		} 
	}


	function sendajax(data, url, fun) {
		var ajmsg = new XMLHttpRequest();
		var params = "json_data=" + JSON.stringify(data);

		ajmsg.open("POST", url, true);
		ajmsg.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		ajmsg.send(params);

		ajmsg.onreadystatechange = function() { 
			if ( ajmsg.readyState == 4 && ajmsg.status == 200 ) {
				fun(ajmsg.responseText);
		   }
		};
	};

	function showChat(active_id, msg_last_id, start_view) {
		var data = {
			active_id: active_id,
			msg_last_id: msg_last_id,
			start_view: start_view
		};
		sendajax(data, '/chat/getupdchat',
			function(data) {
				data = JSON.parse(data);

				// console.log(data['msg_last_id'] + " ");
				// console.log(data['msgs'] + " ");
				
				document.getElementById('msg_last_id').value = data['msg_last_id'];
				var d = document.getElementById('chatForApd');
				d.insertAdjacentHTML("beforeEnd", data['msgs']);
				d.scrollTop = d.scrollHeight;

			}
		);
	};

	function sendMsg(active_id, text, time) {
		var data = {
			author: author_id,
			active_id: active_id, // active_choose_id,
			text: text, // $("#msg_text").val(),
			time: time // <?php echo time() ?>
		};
		// console.log(text);
		sendajax(data, '/chat/sendmsg',
			function(data) {
				data = JSON.parse(data);

				// console.log(data['msg_last_id'] + " ");
				// console.log(data['msgs'] + " ");
				
				document.getElementById('msg_last_id').value = data['msg_last_id'];
				var d = document.getElementById('chatForApd');
				d.insertAdjacentHTML("beforeEnd", data['msgs']);
				d.scrollTop = d.scrollHeight;
			}
		);
	};

	window.router = router;
}());

	

	function showInsPeople(chl_choose_id) {
		var data = {
			action: 'showInsPeople',
			chl_id: chl_choose_id
		};
		sendajax(data, 'dbcreate.php', 
			function(data) {
				console.log(data);
				$('.resultsPeopleFind').html(data);
			}
		);
	};


// //надобы для юзера выводить его челенджы - синхронизировать
// var chl_choose_id = 1;
// var active_choose_id = 1;
// var interval = 80000; // количество миллисекунд для авто-обновления сообщений (1 секунда = 1000 миллисекунд)

// startStChl(); //установка начального состояния при входе
// setInterval('showChat(active_choose_id)', interval); //обновление чата 