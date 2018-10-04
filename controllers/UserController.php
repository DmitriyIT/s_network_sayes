<?php 
	
	class UserController {
		
		public function actionRegistration() {
			$login = '';
			$password = '';
			$result = false;

			if (isset($_POST['submit'])) {
				$email = $_POST['email'];
				$password = $_POST['password1'];

				User::registration($email, $password);
				
				// Авторизуем для дальн действий
				$user = User::checkUserData($email, $password);
				User::auth($user);
				Challenges::chl_coming(2); //стартовый челендж

				header('Location: /main');
			}

			require_once(ROOT . '/views/user/registration.php');
			return true;
		}

		public function actionLogin() {
			$email = '';
			$password = '';
			$result = false;

			if (isset($_POST['submit'])) {
				$email = $_POST['email'];
				$password = $_POST['password'];
				$errors = false;
				// Валидация полей
				if(!User::checkEmail($email)) {
					$errors[] = 'email не введен';
				}
				if(!User::checkPassword($password)) {
					$errors[] = 'пароль должен быть не короче 6 символов';
				}

				//Проверяем существует ли пользователь
				$user = User::checkUserData($email, $password);
				if($user == false) {
					$errors[] = 'Неправильные данные для входа на сайт';
				} else {
					User::auth($user);
					//перенаправляем на основную страницу
					header("Location: /main");
				}
			}

			require_once(ROOT . '/views/user/login.php');
			return true;
		}

		public function actionLogout() {
			unset($_SESSION['logged_user']);
			header("location: /user/login");
			return true;
		}

		public function actionOwnroom() {
			User::checkLogged();
			$challenges = Challenges::getUserChls();
			$chl_active = Challenges::startStChl();
			$invites = Challenges::getInvites();

			if (isset($_POST['submit'])) {
				$about['fname'] = $_POST['fname'];
				$about['sname'] = $_POST['sname'];
				$about['ownRoom_sex'] = $_POST['ownRoom_sex'];
				$about['ownRoom_age'] = $_POST['ownRoom_age'];
				$about['town'] = $_POST['town'];
				$about['email_connect'] = $_POST['email_connect'];

				User::updateInfoAbout($about);

				$filename = $_FILES['imagefile']['tmp_name'];
				$destino = ROOT . '/upload/img/ava/' . $_SESSION['logged_user']-> id . ".jpg";
				if(is_uploaded_file($filename)) {
					move_uploaded_file($filename, $destino);
				}			

				$dw = ROOT . '/upload/img/ava/';
				if (is_writable($dw)) {
				} else {
				    echo $dw . "<br>";
				    echo 'Upload directory is not writable, or does not exist.';
				}
			}

			require_once(ROOT . '/views/user/own_room.php');
			return true;
		}

		public function actionFriends() {
			User::checkLogged();
			$challenges = Challenges::getUserChls();
			$chl_active = Challenges::startStChl();
			$invites = Challenges::getInvites();

			$allChl = Challenges::getAllChl();
			$friends = User::getFriends();

			include_once(ROOT . '/views/user/user_friends.php');
			return true;
		}

		public function actionTakefriend() {
			if( isset($_POST['json_data']) ) {
				$data = json_decode($_POST['json_data'], true);
				if( isset($data['id_friend']) ) {

					if ( !User::isFriend($data['id_friend']) ) {
						User::takefriend($data['id_friend']);	
					}
				}
			}
			return true;
		}

		public function actionRemovefriend() {
			if( isset($_POST['json_data']) ) {
				$data = json_decode($_POST['json_data'], true);
				if( isset($data['id_friend']) ) {

					if ( User::isFriend($data['id_friend']) ) {
						User::removeFriend($data['id_friend']);	
					}
				}
			}
			return true;
		}

	}
?>
