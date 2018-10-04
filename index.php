<?php 
	
	define("ROOT", $_SERVER['DOCUMENT_ROOT']);

	require_once(ROOT.'/components/autoload.php');
	require_once(ROOT.'/components/Router.php');
	require_once(ROOT.'/components/Db.php');
	require_once(ROOT.'/models/User.php');

	Db::getConnection();
	$router = new Router();
	$router->run();

?>



