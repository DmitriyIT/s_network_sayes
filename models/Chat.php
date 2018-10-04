<?php 
	class Chat {

		/**
		 * @param  integer $data
		 */
		public static function takeMsg($data) {
			if( isset($data['text']) ) {
				$msgtable = R::dispense( 'chat' );

				$msgtable -> msg_id_author = $data['author'];
				$msgtable -> active_id = $data['active_id'];
				$msgtable -> msg_text = $data['text']; 
				$msgtable -> msg_date = $data['time'];

				R::store($msgtable);
			}
		}

		/**
		 * @param  integer $active_id
		 * @return array of msgs (beans)
		 */
		public static function getChat($active_id) {//Вывод чата
			$result = R::find('chat', 'id > 0 and active_id = ?', array($active_id));

			if( isset($result) ) {
				return $result;
			} else {
				echo "Запрос не дал результатов";
				echo var_dump($result);
			}
		}

		/**
		 * Send last msgs after msg_last_id
		 * @param  [type] $active_id   [description]
		 * @param  [type] $msg_last_id [description]
		 * @return [type]              [description]
		 */
		public static function getChatUpd($active_id, $msg_last_id) {
			$result = R::find('chat', 'active_id = ? and id > ?', array($active_id, $msg_last_id));

			if( isset($result) ) {
				return $result;
			} else {
				echo "Запрос не дал результатов";
				echo var_dump($result);
			}
		}

		/**
		 * return array of users of msg_authors
		 * @param  array()
		 */
		public static function getAuthorMsg($arrayOfChat) {
			$arrayAuthor = array();
			$r1 = $arrayOfChat;
			while ($r1) {
				$msg = array_shift($r1);
				$author = R::findOne('users', 'id = ?', array($msg['msg_id_author']));
				$arrayAuthor[] = $author;
			}
			return $arrayAuthor;
		}

		public static function APIgetChat($idAct, $howMatch, $offset) {
			$result = R::getAll("
				SELECT *
				FROM chat
				WHERE chat.active_id = :id",
				array(':id' => $idAct)
			);

			if( isset($result) ) {
				return $result;
			} else {
				echo "Запрос не дал результатов";
				echo var_dump($result);
			}
		}

	}
 ?>