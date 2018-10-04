<?php 

	class SocketController {

		public function actionCreate() {
			echo "string1";
			include_once(ROOT . '/components/simpleworking.php');
			if(extension_loaded('sockets')) echo "WebSockets OK";
			else echo "WebSockets UNAVAILABLE";
			
			echo "string2";
			return true;
		}

	}
?>