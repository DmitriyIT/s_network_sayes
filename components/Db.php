<?php 
	class Db {

		public static function getConnection() {
			require ROOT . '/libs/rb.php';
			$paramsPath = ROOT . '/config/db_params.php';
			$params = include($paramsPath);

			R::setup("mysql:host={$params['host']}; dbname={$params['dbname']}", $params['user'], $params['password']);
			session_start();
		}
	}	
?>
