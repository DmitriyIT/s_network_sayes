<?php 
	class Router {

		private $routes;

		public function __construct() {
			$routesPath = ROOT . '/config/routes.php';
			$this->routes = include($routesPath);
		}

		/*
		* Получаем строку запроса
		* @return string
		*/
		public function getURI() {
			if (!empty($_SERVER['REQUEST_URI'])) {
				return trim($_SERVER['REQUEST_URI'], '/');
			}
			echo $uri;
		}

		public function run() {
			// Получаем строку запроса
			$uri = $this->getURI();

			// Проверка на наличие такого запроса в routes.php
			foreach ($this->routes as $uriPattern => $path) {
				if (preg_match("~$uriPattern~", $uri)) {

					$internalRoute = preg_replace("~$uriPattern~", $path, $uri);

					$elems = explode('/', $internalRoute);
					// array_shift($elems);

					$controllerName = ucfirst( array_shift($elems) . 'Controller' );
					$actionName = 'action' . ucfirst(array_shift($elems));

					$parametrs = $elems;

					// echo 'класс = ' . $controllerName . '<br>';
					// echo 'метод = ' . $actionName . '<br>';

					// Подключить файл класса контроллера
					$controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
					if (file_exists($controllerFile)) {
						include_once($controllerFile);
					}
					
					// Создаем класс и запускаем action
					$ControllerObject = new $controllerName;
					$result = call_user_func_array(array($ControllerObject, $actionName), $parametrs);


					if ($result != null) {
						break;
					}
					// Создать объекс + вызвать метод 
				}
			} 
		}

	}
?>