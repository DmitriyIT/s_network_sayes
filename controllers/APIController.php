<?php 

	class APIController {

		/**
		 * Return (echo)
		 * 	error || array of chalenges
		 * @param  $_POST string  $email
		 * @param  $_POST integer $passowrd
		 * @return bool || array
		 */
		public function actionAuthorization() {
			if ((isset($_POST['email'])) && (isset($_POST['password']))) {
				// Take post value and reg
				$email = $_POST['email'];
				$password = $_POST['password'];

				// Return user(been) || false
				$user = User::checkUserData($email, $password);

				if ($user) {
					// Take list of chls (not bean)
					$chls = Challenges::getUserChls($user -> id);	
				} else {
					$chls = array();
				}

				$arrayOut = array(
					'user' => $user,
					'chls' => $chls
				);

				echo json_encode($arrayOut);
			} else {
				echo "ошибка запроса (email или password введены неверно)";
			}
			return true;
		}

		/**
		 * Reg and echo id of new User
		 * @param  integer   $email    
		 * @param  integer   $passowrd
		 * @return json(int) $idUser
		 */
		public function actionRegistration() {
			if ((isset($_POST['email'])) && (isset($_POST['password']))) {
				// Take post value and reg
				$email = $_POST['email'];
				$password = $_POST['password'];
				$idUser = User::registration($email, $password);

				// Reg and echo id of new User
				echo json_encode($idUser);
			} else {
				echo "ошибка запроса (email или password введены неверно)";
			}
			return true;
		}

		public function actionGetAct($idChl) {
			if ((isset($_POST['email'])) && (isset($_POST['password']))) {
				// Take post value and reg
				$email = $_POST['email'];
				$password = $_POST['password'];

				// Return user(been) || false
				$user = User::checkUserData($email, $password);

				if ($user) {
					$arrayOut = array(
						'action' => array(
							
						),
						'chat' => array(
							'chat' => array(),
							'author' => array()
						)
					);
					$actions = Actions::getActives($idChl);
					while ($actions) {
						$act = array_shift($actions);
						$chat = Chat::getChat($act['id']);
						$author_msgs = Chat::getAuthorMsg($chat);

						$arrayOut['action'][] = $act;
						$arrayOut['chat']['chat'][] = $chat;
						$arrayOut['chat']['author'][] = $author_msgs;
					}
				} else {
					$arrayOut = array();
				}

				echo json_encode($arrayOut);
			} else {
				echo "ошибка запроса (email или password введены неверно)";
			}
			return true;
		}

		/**
		 * Send msg from user to active chat
		 * @param  string  POST[email] 
		 * @param  string  POST[password] 
		 * @param  integer POST[active_id]
		 * @param  string  POST[text]
		 * @param  integer POST[time]
		 * @return integer //id of this msg in db
		 */
		public function actionSendMsg() {
			if ((isset($_POST['email'])) && (isset($_POST['password']))) {
				// Take post value and reg
				$email = $_POST['email'];
				$password = $_POST['password'];

				// Return user(been) || false
				$user = User::checkUserData($email, $password);

				if( isset($_POST['text']) && $user ) {
					$msgtable = R::dispense( 'chat' );

					$msgtable -> msg_id_author = $user -> id;
					$msgtable -> active_id = $_POST['active_id'];
					$msgtable -> msg_text = $_POST['text']; 
					$msgtable -> msg_date = $_POST['time'];

					$msg_last_id = R::store($msgtable);

					// $result = array(
					// 	'msg_last_id' => $msg_last_id,
					// 	'msgs' => array()
					// );
					// echo json_encode($result);
					echo $msg_last_id;
				}
			}
			return true;
		}

		/**
		 *	Get upd msgs in active by last msg id
		 * @param  string  POST[email] 
		 * @param  string  POST[password] 
		 * @param  integer POST[active_id]
		 * @param  integer  POST[msg_last_id]
		 * @return array()
		 */
		public function actionGetUpdChat() {
			if ((isset($_POST['email'])) && (isset($_POST['password']))) {
				// Take post value and reg
				$email = $_POST['email'];
				$password = $_POST['password'];

				// Return user(been) || false
				$user = User::checkUserData($email, $password);
				if( isset($_POST['active_id']) && $user ) {
					$active_id = $_POST['active_id'];
					$msg_last_id = $_POST['msg_last_id'];

					$chat = Chat::getChatUpd($active_id, $msg_last_id);
					$author_msgs = Chat::getAuthorMsg($chat);
					
					$result = array(
						'msg_last_id' => $msg_last_id,
						'msgs' => array(
							'msgs' => array(),
							'author' => array()
						)
					);
					while($chat && $author_msgs) {
						$msg = array_shift($chat);
						$author = array_shift($author_msgs);

						$result['msg_last_id'] = $msg['id'];
						$result['msgs']['msgs'][] = $msg;
						$result['msgs']['author'][] = $author;
					}

					echo json_encode($result);
				}
			}

			return true;
		}
		
		public function actionGetmessage($idAct, $howMatch = -1, $offset = 0) {
			$chat = Chat::APIgetChat($idAct, $howMatch, $offset);

			echo json_encode($chat);
			return true;
		}

		public function actionRegapi() {
			if (( isset($_POST['email']) )&&( isset($_POST['passowrd']) )) {

			}
		}

	}
?>
