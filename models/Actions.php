<?php 
	class Actions {
		
		/**
		 * Returns array of actives by Chl_id
		 * @param  integer $chl_id
		 */
		public static function getActives($chl_id) {
			$result = R::find('active', 'chl_id = ? GROUP BY datebrth', array($chl_id));

			if( isset($result) ) {
				return $result;
			} else {
				echo "Запрос не дал результатов";
			}
		}

		/**
		 * Returns Act by id
		 * @param  integer $id
		 */
		public static function getActbyId($id) {
			$result = R::getAll("
				SELECT *
				FROM active
				WHERE active.id = ?
				LIMIT 1;",
				array($id)
			);

			return array_shift($result);
		}

		public static function startStChl($chl_id) {
			$result = R::find('active', 'chl_id = ? and name = ? GROUP BY datebrth', array($chl_id, 'first'));

			if( isset($result) ) {
				return array_shift($result);
			} else {
				echo "Запрос не дал результатов";
			}	
		}

		/**
		 * Create active
		 * @param  integer [$name, $chl_id]
		 */
		public static function createAct($name, $chl_id) {
			//проверка на повтор имени
			$prov = R::getAll("
				SELECT count(*) as c
				FROM active as a
				WHERE a.name = ? and a.chl_id = ?
				", array($name, $chl_id)
			);

			$prov = array_shift($prov);
			if ( $prov['c'] > 0 ) {
				echo "уже есть";
			} else {
				//как автор активности + //выбранный chl
				$users = $_SESSION['logged_user'];
				$chl = R::findOne('chl', 'id = ?', array($chl_id));

				// создаем act и к ней chat, 
				// чат идентифицируется привязкой к act
				// act привязкой к челенджу по N:1
				$active = R::dispense('active');
				$active -> name = $name;
				$active -> authorid = $users -> id;
				$active -> datebrth = time();

				$act_id = R::store($active);

				$chat = R::dispense( 'chat' );
				$chat -> msg_id_author = $_SESSION['logged_user'] -> id;
				$chat -> msg_text = 'привет'; 
				$chat -> msg_date = time();

				//создаем зависимости / отношения
				$active -> ownChatList[] = $chat;
				$active -> sharedUsersList[] = $users;
				//$chl -> sharedUsersList[] = $users; уже состоит в этом chl 
				$chl -> ownActiveList[] = $active;
				R::store($chl);

				// echo "prov act";
				return $act_id;
			}
		}

		public static function holdAct() {
		}

		public static function delAct() {	
		}

		public static function chngParamsAct() {	
		}

		public static function g() {
			
		}
	}

 ?>


