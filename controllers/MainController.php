<?php 

	class MainController {

		public function actionDz() {
			define("CONSTA", 21.4);
			define("AWD", 2);

			echo CONSTA + AWD;
			// echo $b;


			return true;
		}

		public function actionIndex() {
			User::checkLogged();
			$challenges = Challenges::getUserChls();
			$chl_active = Challenges::startStChl();
			$invites = Challenges::getInvites();

			$actions = Actions::getActives($chl_active['id']);
			$act_active = Actions::startStChl($chl_active['id']);

			// (beans)
			$chat = Chat::getChat($act_active['id']);
			$author_msgs = Chat::getAuthorMsg($chat);

			include_once(ROOT . '/views/site/index.php');
			// include_once(ROOT . '/demos/advanced.html');
			// include_once(ROOT . '/demos/awd.html');
			// include_once(ROOT . '/demos/basic.html');
			return true;
		}

		public function actionView() {
			// echo 'NewsController actionView <br>';			
			if(isset($_FILES) && isset($_FILES['image'])) {
 
			  //Переданный массив сохраняем в переменной
			  $image = $_FILES['image'];
			 
			  // Проверяем размер файла и если он превышает заданный размер
			  // завершаем выполнение скрипта и выводим ошибку
			  if ($image['size'] > 200000) {
			    die('error');
			  }
			 
			  // Достаем формат изображения
			  $imageFormat = explode('.', $image['name']);
			  $imageFormat = $imageFormat[1];
			 
			  // Генерируем новое имя для изображения. Можно сохранить и со старым
			  // но это не рекомендуется делать
			  $imageFullName = ROOT . '/upload/img/ava/' . hash('crc32',time()) . '.jpg';
			 //  $filename = $_FILES['imagefile']['tmp_name'];
				// $destino = ROOT . '/upload/img/ava/' . $_SESSION['logged_user']-> id . ".jpg";
			 
			  // Сохраняем тип изображения в переменную
			  $imageType = $image['type'];
			 
			  // Сверяем доступные форматы изображений, если изображение соответствует,
			  // копируем изображение в папку images
			  if ($imageType == 'image/jpeg' || $imageType == 'image/png') {
			    if (move_uploaded_file($image['tmp_name'],$imageFullName)) {
			      echo 'success';
			    } else {
			      echo 'error';
			    }
			  }
			}
			return true;
		}

		public function actionSendmsg() {
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
			return true;
		}

	}
?>