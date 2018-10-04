<?php 
	
	class Chalenge_act_Controller {
		
		/**
		 * Page on show chls users
		 * @param  integer $chl_id 
		 */
		public function actionUsers($chl_id) {
			User::checkLogged();
			$challenges = Challenges::getUserChls();
			$chl_active = Challenges::getChlbyId($chl_id);
			$invites = Challenges::getInvites();

			$actions = Actions::getActives($chl_active['id']);
			$act_active = Actions::startStChl($chl_active['id']);

			$chl_users = Challenges::getInsPeople($chl_id);
			$isFriends = User::isFriendArray($chl_users);

			include_once(ROOT . '/views/chalenge_act/chl_users.php');
			return true;
		}

		/**
		 * Page on invite friends to this chl 
		 * @param  integer $chl_id 
		 */
		public function actionInvite_friends($chl_id) {
			User::checkLogged();
			$challenges = Challenges::getUserChls();
			$chl_active = Challenges::getChlbyId($chl_id);
			$invites = Challenges::getInvites();

			$actions = Actions::getActives($chl_active['id']);
			$act_active = Actions::startStChl($chl_active['id']);

			$chl_users = Challenges::getInsPeople($chl_id);
			$isFriends = User::isFriendArray($chl_users);

			$friends = User::getFriends();

			include_once(ROOT . '/views/chalenge_act/chl_invite.php');
			return true;
		}

		/**
		 * Page on chek invite by user
		 */
		public function actionTakeInvite() {
			User::checkLogged();
			$challenges = Challenges::getUserChls();
			$chl_active = Challenges::startStChl();
			$allChl = Challenges::getAllChl();

			$invites = Challenges::getInvites();
			if ($invites) {
				$arrForChls = array();
				$arrForInviters = array();
				foreach ($invites as $key => $value) {
					$arrForChls[] = $value['chlid'];
					$arrForInviters[] = $value['from'];
				}

				$chlsForInv = Challenges::getChlsByArr($arrForChls);			
				$inviters = User::getUsersByArr($arrForInviters);

				include_once(ROOT . '/views/chalenge_act/chl_takeInvite.php');
			} else {
				header("Location: /chalenge/find");
			}

			
			return true;
		}

		/**
		 * Page on choose chl
		 * @param  integer $chl_id 
		 */
		public function actionChoose_chl($chl_id) {
			User::checkLogged();
			$challenges = Challenges::getUserChls();
			$chl_active = Challenges::getChlbyId($chl_id);
			$invites = Challenges::getInvites();

			$actions = Actions::getActives($chl_active['id']);
			$act_active = Actions::startStChl($chl_active['id']);

			$chat = Chat::getChat($act_active['id']);
			$author_msgs = Chat::getAuthorMsg($chat);

			include_once(ROOT . '/views/chalenge_act/index.php');
			return true;
		}

		/**
		 * Page on choose act
		 * @param  integer $chl_id 
		 * @param  integer $act_id 
		 */
		public function actionChoose_act($chl_id, $act_id) {
			User::checkLogged();
			$challenges = Challenges::getUserChls();
			$chl_active = Challenges::getChlbyId($chl_id);
			$invites = Challenges::getInvites();

			$actions = Actions::getActives($chl_active['id']);
			$act_active = Actions::getActbyId($act_id);

			$chat = Chat::getChat($act_active['id']);
			$author_msgs = Chat::getAuthorMsg($chat);

			include_once(ROOT . '/views/chalenge_act/index.php');
			return true;
		}

		/**
		 * Page on find chls
		 */
		public function actionFind_chl() {
			User::checkLogged();
			$challenges = Challenges::getUserChls();
			$chl_active = Challenges::startStChl();
			$invites = Challenges::getInvites();

			$allChl = Challenges::getAllChl();

			include_once(ROOT . '/views/chalenge_act/chl_find.php');
			return true;
		}

		/**
		 * Page on create chl
		 */
		public function actionCreate_chl() {
			User::checkLogged();
			if( isset($_POST['submit']) ) {
				Challenges::createChl($_POST['nameOfChl'], '', $_POST['discrOfChl']);
			}

			$challenges = Challenges::getUserChls();
			$chl_active = Challenges::startStChl();
			$invites = Challenges::getInvites();

			include_once(ROOT . '/views/chalenge_act/chl_create.php');
			return true;
		}

		/**
		 * Form (action=post) Create act
		 * @param  POST[submit_act]
		 * @param  POST[nameOfAct]
		 * @param  POST[chl_id]
		 */
		public function actionCreate_act() {
			User::checkLogged();
			if( isset($_POST['submit_act']) ) {
				$act_id = Actions::createAct($_POST['nameOfAct'], $_POST['chl_id']);
			}

			header("Location: /action/choose/" . $_POST['chl_id'] . "-" . $act_id);
			return true;
		}

		/**
		 * Href on coming into chl
		 * @param  integer $chl_id
		 */
		public function actionChl_coming($chl_id) {
			User::checkLogged();
			Challenges::chl_coming($chl_id);
			header("Location: /chalenge/find");
			return true;
		}

		/**
		 * AJAX Send to user invite
		 * @param  integer $chl_id 
		 * @param  array() POST[json_data]
		 * @param  array() POST[id_friend]
		 */
		public function actionSendInvite($chl_id) {
			User::checkLogged();
			if( isset($_POST['json_data']) ) {
				$data = json_decode($_POST['json_data'], true);

				if( isset($data['id_friend']) ) {
					$id_friend = $data['id_friend'];
					if ( User::isFriend($id_friend) ) {
						Challenges::sendInvite($id_friend, $chl_id);
					}
				}
			}
			return true;
		}

		/**
		 * AJAX Answer from user on invite into chl
		 * @param  array() POST[json_data]
		 * @param  integer POST[answer]
		 * @param  integer POST[chl_id]
		 */
		public function actionAnswerInvite() {
			User::checkLogged();
			
			if( isset($_POST['json_data']) ) {
				$data = json_decode($_POST['json_data'], true);

				if( isset($data['answer']) ) {
					$answer = $data['answer'];
					$id_chl = $data['id_chl'];
					$id_invite = $data['id_invite'];

					if ($answer) {
						if (!Challenges::inChl($id_chl)) {
							Challenges::chl_coming($id_chl);
						}
					}
					Challenges::chl_invite_coming($id_invite);
				}
			}
			return true;
		}

	}
?>