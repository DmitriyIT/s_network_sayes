<?php 
	class User {
	
		/**
		 * Reg user and return his id
		 * @param  string $email    
		 * @param  string $password 
		 * @return int    $id
		 */
		public static function registration($email, $password) {
			$user = R::dispense( 'users' );
			$user -> email = $email;
			$user -> password = password_hash( $password, PASSWORD_DEFAULT);

			$user -> fname = 'newUser';
			$user -> sname = 'newUser';
			$user -> town = 'город';
			$user -> email_connect = 'email';

			$id = R::store($user);
			return $id;
		}

		public static function logIn() {
			$data = $_POST;
			if( isset($data['login'])) {
				$errors = array();
				$user = R::findOne('users', 'login = ?', array($data['login']));

				if( $user) {
					if( password_verify($data['password'], $user['password'])) {
						$_SESSION['logged_user'] = $user;
					} else {
						$errors[] = 'Пароль неверно введен';
					}
				} else {
					$errors[] = 'Пользователь с таким login не найден';
				}
			}
		}

		public static function checkEmail($login) {
			if(strlen($login) >= 1) {
				return true;
			}
			return false;
		}

		public static function checkPassword($password) {
			if(strlen($password) >= 6) {
				return true;
			}
			return false;
		}

		public static function checkUserData($email, $password) {
			$user = R::findOne('users', 'email = ?', array($email));
			if( $user) {
				if( password_verify($password, $user['password'])) {
					return $user;
				}
			}
			return false;
		}

		/**
		 * @param  $user
		 * Запоминаем пользователя
		 */
		public static function auth($user) {
			$_SESSION['logged_user'] = $user;
		}

		public static function checkLogged() {
			// Если сессия есть то вернем данные о пользователе
			if(isset($_SESSION['logged_user'])) {
				return $_SESSION['logged_user'];
			}

			header("Location: /user/login");
		}

		/**
		 * Return frends of user (not bean)
		 * @return array() 
		 */
		public static function getFriends() {
			$result = R::getAll("
				SELECT u.*
				FROM friend as f, users as u
				WHERE f.first = ? and f.second = u.id",
				array($_SESSION['logged_user'] -> id)
			);

			if( isset($result) ) {
				return $result;
			}
		}

		/**
		 * Friend or not 
		 * @param  integer  $id_user
		 * @return true/false
		 */
		public static function isFriend($id_user) {
			$user = R::findOne('friend', 'first = ? and second = ?', array($_SESSION['logged_user'] -> id, $id_user));
			if ($user) {
				return true;
			}
			return false;
		}

		/**
		 * Return array of bool of kind of users
		 * @param  array()  $array_users (not bean ?)
		 * @return array of boolean
		 */
		public static function isFriendArray($array_users) {
			$result = array();
			while ($array_users) {
				$user = array_shift($array_users);
				$result[] = User::isFriend($user['id']);
			}
			return $result;
		}

		public static function takeFriend($id_friend) {
			$friend = R::dispense( 'friend' );
			$friend -> first = $_SESSION['logged_user'] -> id;
			$friend -> second = $id_friend;

			$id = R::store($friend);
			// return $id;
		}

		public static function removeFriend($id_friend) {
			$user = R::findOne('friend', 'first = ? and second = ?', array($_SESSION['logged_user'] -> id, $id_friend));
			R::trash($user);
		}
		

		public static function updateInfoAbout($about) {
			$user = $_SESSION['logged_user'];

			$user -> fname = $about['fname'];
			$user -> sname = $about['sname'];
			$user -> sex = $about['ownRoom_sex'];
			$user -> age = $about['ownRoom_age'];
			$user -> town = $about['town'];
			$user -> email_connect = $about['email_connect'];

			R::store($user);
		}

		public static function APIAuthorization($login, $password) {
			
		}

		public static function getUsersByArr($arr) {
			$users = array();
			foreach ($arr as $key => $value) {
				$users[] = R::getAll(
					"SELECT *
					FROM users as u
					WHERE u.id = ? ", array($value)
				);
			}

			return $users;
		}
	}
 ?>