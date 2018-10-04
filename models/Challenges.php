<?php 
	class Challenges {

		/**
		 * Returns id of firstChoose Chl
		 * @return integer id_chl
		 */
		public static function startStChl() {
			$result = R::getAll("
				SELECT chl.*
				FROM chl, active as a, active_users as au
				WHERE 
					a.chl_id = chl.id and
					a.name = 'first' and
					au.active_id = a.id and
					au.users_id = ?
				ORDER BY a.datebrth
				LIMIT 1;",
				array($_SESSION['logged_user'] -> id)
			);

			if( isset($result) ) {
				$r1 = array_shift($result);
				return $r1;
			}
		}

		/**
		 * Return array of people in chl
		 * @param  integer $chl_id
		 * @return array (not bean)
		 */
		public static function getInsPeople($chl_id) {
			$result = R::getAll(
				"SELECT u.*
				FROM active as a, active_users as au, users as u 
				WHERE 
					a.name = 'first' and 
					a.chl_id = ? and
					au.active_id = a.id and
					au.users_id = u.id",
				array($chl_id)
			);

			return $result;
		}

		/**
		 * Returns array of user Chls
		 */
		public static function getUserChls($idUser = -1) {
			if ($idUser == -1) {
				$idUser = $_SESSION['logged_user'] -> id;
			}
			$result = R::getAll("
				SELECT chl.*
				FROM chl, active as a, active_users as au
				WHERE 
					chl.id = a.chl_id and
					a.name = 'first' and
					au.active_id = a.id and
					au.users_id = ?
				ORDER BY a.datebrth",
				array($idUser)
			);

			if( isset($result) ) {
				return $result;
			} else {
				echo "Запрос не дал результатов";
			}
		}

		/**
		 * Returns array of All Chls 
		 * whith theare count for page chl_find
		 * @return string HTML 
		 */
		public static function getAllChl() {
			$result = R::getAll(
				"SELECT c.*, (
					SELECT count(*)
					FROM active as a, active_users as au
					WHERE 
						a.name = 'first' and 
						a.chl_id = c.id and
						au.active_id = a.id
				) as countUsers 
				FROM chl as c 
				ORDER BY countUsers DESC"
			);

			if( isset($result) ) {
				return $result;
				$r1 = array_shift($result);
				while (($r1)) {
					echo "<p class=\"chlFind\" chlid=\"" . $r1['id'] . "\">" . $r1['name'] . "  (" . $r1['countUsers'] . ")" ."</p>";
					echo "<br>";
					$r1 = array_shift($result);
				}
			} else {
				echo "Запрос не дал результатов";
				echo var_dump($result);
			}
		}

		/**
		 * Returns Chl by id
		 * @param  integer $id
		 * @return array(not bean)
		 */
		public static function getChlbyId($id) {
			$result = R::getAll("
				SELECT *
				FROM chl
				WHERE chl.id = ?",
				array($id)
			);

			return array_shift($result);
		}		

		/**
		 * Coming user into chl
		 * @param integer $chl_id
		 */
		public static function chl_coming($chl_id) {
			$users = $_SESSION['logged_user'];
			$active = array_shift( R::getAll(
				"SELECT * 
				FROM active as a 
				WHERE a.name = 'first' and a.chl_id = ? 
				LIMIT 1",
				array($chl_id)
			));

			$id = $active['id'];
			$active = R::load('active', $id);
			$active -> sharedUsersList[] = $users;
			R::store($active);
		}

		/**
		 * Out user from chl
		 * @param integer $chl_id
		 */
		public static function outFromChl($chl_id) {
			$users = $_SESSION['logged_user'];
			$active = array_shift( R::getAll(
				"SELECT * 
				FROM active as a 
				WHERE a.name = 'first' and a.chl_id = ? 
				LIMIT 1",
				array($chl_id)
			));

			$id = $active['id'];
			$active = R::load('active', $id);
			unset($active -> sharedUsersList[$users -> id]);
			R::store($active);
		} 

		/**
		 * Create chl
		 * @param  integer [$name, $img_Url, $discr]
		 */
		public static function createChl($name, $img_Url, $discr) {
			$prov = R::getAll("
				SELECT count(*) as c
				FROM chl
				WHERE chl.name = ?
				", array($name)
			);

			$prov = array_shift($prov);
			if ( $prov['c'] > 0 ) {
				echo "уже есть";
			} else {
				//над создать нулевой act + chat к нему

				//как автор chl
				$users = $_SESSION['logged_user'];

				$chl = R::dispense('chl');
				$chl -> name = $name;
				$chl -> imgurl = $img_Url;
				$chl -> discription = $discr;

				// создаем act и к ней chat, 
				// чат идентифицируется привязкой к act
				// act привязкой к челенджу по M:1
				$active = R::dispense('active');
				$active -> name = 'first';
				$active -> authorid = $users -> id;
				$active -> datebrth = time();

				$chat = R::dispense( 'chat' );
				$chat -> msg_id_author = $users -> id;
				$chat -> msg_text = 'start chat';
				$chat -> msg_date = time();

				//создаем зависимости / отношения
				$active -> ownChatList[] = $chat;
				$active -> sharedUsersList[] = $users;
				$chl -> ownActiveList[] = $active;
				R::store($chl);
			}
		}


		public static function deleteChl($name, $img_Url, $discr) {
		}

		/**
		 * Send to user invite to chl
		 * @param  integer $id_user
		 * @param  integer $chl_id
		 */
		public static function sendInvite($id_user, $chl_id) {
			$chlinvite = R::dispense('chlinvite');
			$chlinvite -> from = $_SESSION['logged_user'] -> id;
			$chlinvite -> to = $id_user;
			$chlinvite -> chlid = $chl_id;
			$chlinvite -> isanswer = false;
			R::store($chlinvite);
		}

		/**
		 * Return invites which are not answered
		 * @return array(not bean) of invites
		 */
		public static function getInvites() {
			$invites = R::getAll(
				"SELECT * 
				FROM chlinvite as c
				WHERE c.isanswer = false and c.to = ?
				",
				array($_SESSION['logged_user'] -> id)
			);

			return $invites;
		}

		/**
		 * Chek user - in chl or not
		 * @param  integer $chl_id
		 * @return bool
		 */
		public static function inChl($chl_id) {
			$result = R::getAll("
				SELECT *
				FROM chl, active as a, active_users as au
				WHERE 
					a.chl_id = ? and
					a.name = 'first' and
					au.active_id = a.id and
					au.users_id = ?",
				array($chl_id, $_SESSION['logged_user'] -> id)
			);

			if ($result) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Write ti invite that it answered
		 * @param  $id_invite 
		 */
		public static function chl_invite_coming($id_invite) {
			// Challenges::chl_coming($chl_id);
			$chlinvite = R::load('chlinvite', $id_invite);
			$chlinvite -> isanswer = true;
			R::store($chlinvite);
		}

		/**
		 * Return chls by array of id_chls
		 * @param  array() $arr 
		 * @return array(not bean)
		 */
		public static function getChlsByArr($arr) {
			$chls = R::getAll(
				"SELECT c.*, (
					SELECT count(*)
					FROM active as a, active_users as au
					WHERE 
						a.name = 'first' and 
						a.chl_id = c.id and
						au.active_id = a.id
				) as countUsers 
				FROM chl as c
				WHERE c.id IN (" . R::genSlots($arr) .")", $arr
			);
			return $chls;
		}

	}
 ?>