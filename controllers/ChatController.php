<?php 

	/**
	 * All of actions is AJAX 
	 * must for all - POST['json_data']
	 */
	class ChatController {

		/**
		 * AJAX Send msg from user to active chat
		 * @param  integer POST[author] //idAuthor
		 * @param  integer POST[active_id]
		 * @param  string  POST[text]
		 * @param  integer POST[time]
		 * @return array() msg(HTML which send)
		 */
		public function actionSendmsg() {
			if( isset($_POST['json_data']) ) {
				$data = json_decode($_POST['json_data'], true);
				if( isset($data['text']) ) {
					$msgtable = R::dispense( 'chat' );

					$msgtable -> msg_id_author = $data['author'];
					$msgtable -> active_id = $data['active_id'];
					$msgtable -> msg_text = $data['text']; 
					$msgtable -> msg_date = $data['time'];

					$msg_last_id = R::store($msgtable);

					$result = array(
						'msg_last_id' => $msg_last_id,
						'msgs' => array()
					);
					$result['msgs'][] =  "
						<div class=\"massage-box\">
							<div class=\"ava_img\"> <img src=\"../../../upload/img/ava/" . $_SESSION['logged_user'] -> id . ".jpg\" alt=\"\"></div>
							<div class=\"massage_author_text\">
								<p class=\"msg_autor\">"  . $_SESSION['logged_user'] -> fname . ' ' . $_SESSION['logged_user'] -> sname . "</p> <p class=\"msg_time\">" . date("G:i, d.Y", $data['time']) . "</p>
								<p class=\"msg_text\">" . $data['text'] . "</p>
							</div>
						</div>
					";
					echo json_encode($result);
				}
			}
			return true;
		}

		/**
		 * [actionGetmsg description]
		 * @return [type] [description]
		 */
		public function actionGetmsg() {
			if( isset($_POST['json_data']) ) {
				$data = json_decode($_POST['json_data'], true);
				if( isset($data['text']) ) {
					$msgtable = R::dispense( 'chat' );

					$msgtable -> msg_id_author = $data['author'];
					$msgtable -> active_id = $data['active_id'];
					$msgtable -> msg_text = $data['text']; 
					$msgtable -> msg_date = $data['time'];

					R::store($msgtable);
				}
			}
			// header("Location: /main");
			return true;
		}

		public function actionGetallchat() {
			if( isset($_POST['json_data']) ) {
				$data = json_decode($_POST['json_data'], true);
				if( isset($data['active_id']) ) {

					if ($data['start_view']) {
						$img_pre = '../';
					} else {
						$img_pre = '../../../';
					}

					$chat = Chat::getChat($data['active_id']);
					$author_msgs = Chat::getAuthorMsg($chat);
					
					while($chat && $author_msgs) {
						$msg = array_shift($chat);
						$author = array_shift($author_msgs);
						echo "
							<div class=\"massage-box\">
								<div class=\"ava_img\"> <img src=\"" . $img_pre . "/upload/img/ava/" . $author -> id . ".jpg\" alt=\"\"></div>
								<div class=\"massage_author_text\">
									<p class=\"msg_autor\">"  . $author -> fname . ' ' . $author -> sname . "</p> <p class=\"msg_time\">" . date("G:i, d.Y", $msg['msg_date']) . "</p>
									<p class=\"msg_text\">" . $msg['msg_text'] . "</p>
								</div>
							</div>
						";
					}
				}
			}
			return true;
		}

		public function actionGetUpdChat() {
			if( isset($_POST['json_data']) ) {
				$data = json_decode($_POST['json_data'], true);
				if( isset($data['active_id']) ) {

					if ($data['start_view']) {
						$img_pre = '../';
					} else {
						$img_pre = '../../../';
					}

					$chat = Chat::getChatUpd($data['active_id'], $data['msg_last_id']);
					$author_msgs = Chat::getAuthorMsg($chat);
					
					$result = array(
						'msg_last_id' => $data['msg_last_id'],
						'msgs' => array()
					);
					while($chat && $author_msgs) {
						$msg = array_shift($chat);
						$author = array_shift($author_msgs);
						$result['msg_last_id'] = $msg['id'];
						$result['msgs'][] = "
							<div class=\"massage-box\">
								<div class=\"ava_img\"> <img src=\"" . $img_pre . "/upload/img/ava/" . $author -> id . ".jpg\" alt=\"\"></div>
								<div class=\"massage_author_text\">
									<p class=\"msg_autor\">"  . $author -> fname . ' ' . $author -> sname . "</p> <p class=\"msg_time\">" . date("G:i, d.Y", $msg['msg_date']) . "</p>
									<p class=\"msg_text\">" . $msg['msg_text'] . "</p>
								</div>
							</div>
						";
					}

					echo json_encode($result);
				}
			}
			return true;
		}


	}
?>