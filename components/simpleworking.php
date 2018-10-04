<?php
function go(){
	$starttime = round(microtime(true),2);
	echo "GO() ... <br />\r\n";

	echo "socket_create ...";
	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

	if($socket < 0){
		echo "Error: ".socket_strerror(socket_last_error())."<br />\r\n";
		exit();
	} else {
	    echo "OK <br />\r\n";
	}
	

	echo "socket_bind ...";
	$bind = socket_bind($socket, '127.0.0.1', 8008 );//привязываем его к указанным ip и порту //889
	// By default, SELinux only allowed apache/httpd to bind to the following ports:
	// 80, 81, 443, 488, 8008, 8009, 8443, 9000
	if($bind < 0){
	    echo "Error: ".socket_strerror(socket_last_error())."<br />\r\n";
		exit();
	}else{
	    echo "OK <br />\r\n";
	}	
	
	socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);//разрешаем использовать один порт для нескольких соединений

	echo "Listening socket... ";
	$listen = socket_listen($socket, 5);//слушаем сокет

	if($listen < 0){
	    echo "Error: ".socket_strerror(socket_last_error())."<br />\r\n";
		exit();
	}else{
	    echo "OK <br />\r\n";
	}

	while(true){ //Бесконечный цикл ожидания подключений
		echo "Waiting... ";
	   $accept = @socket_accept($socket); //Зависаем пока не получим ответа
	   if($accept === false){
	      echo "Error: ".socket_strerror(socket_last_error())."<br />\r\n";
		   usleep(100);
	   } else {
	      echo "OK <br />\r\n";
	      echo "Client \"".$accept."\" has connected<br />\r\n";
		}

		$msg = "Hello, Client!";
		echo "Send to client \"".$msg."\"... ";
		socket_write($accept, $msg);
		echo "OK <br />\r\n";
		
		if( ( round(microtime(true),2) - $starttime) > 100) { 
			echo "time = ".(round(microtime(true),2) - $starttime); 
			echo "return <br />\r\n"; 
			return $socket;
		}
	}
}


error_reporting(E_ALL); //Выводим все ошибки и предупреждения
set_time_limit(0);		//Время выполнения скрипта не ограничено
ob_implicit_flush();	   //Включаем вывод без буферизации 

$socket = go();			//Функция с бесконечным циклом, возвращает $socket по запросу выполненному по прошествии 100 секнуд. 

echo "go() ended<br />\r\n";

if (isset($socket)){
   echo "Closing connection... ";
	@socket_shutdown($socket);
   socket_close($socket);
   echo "OK <br />\r\n";
}



//*
// //
// 				<script src="../../template/js/socket.js" type="text/javascript"></script>

// 				Server address:
// 				<input id="sock-addr" type="text" value="ws://echo.websocket.org"><br />
// 				Message:
// 				<input id="sock-msg" type="text">

// 				<input id="sock-send-butt" type="button" value="send">
// 				<br />
// 				<br />
// 				<input id="sock-recon-butt" type="button" value="reconnect"><input id="sock-disc-butt" type="button" value="disconnect">
// 				<br />
// 				<br />

// 				Полученные сообщения от веб-сокета: 
// 				<div id="sock-info" style="border: 1px solid"> </div>
