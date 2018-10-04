<?php 
	return array(
		'api/getmessage/([0-9]+)/([0-9]+)/([0-9]+)' => 'API/getmessage/$1/$2/$3',
		'api/getactive/([0-9]+)' => 'API/getAct/$1',
		'api/reguser' => 'API/registration',
		'api/authuser' => 'API/authorization',
		'api/sendmsg' => 'API/sendMsg',
		'api/getupdchat' => 'API/getUpdChat',

		'chat/sendmsg' => 'chat/sendmsg',
		'chat/getmsg' => 'chat/getmsg',
		'chat/getupdchat' => 'chat/getUpdChat',
		'chat/getallchat' => 'chat/getallchat',

		'socket' => 'socket/create',

		'main/([0-9]+)' => 'main/view/$1',
		'main/view' => 'main/view',
		'main/dz' => 'main/dz',		//	_ dz PHP
		'main' => 'main/index',		//	actionIndex в MainController
		

		// Выбор челенджа, активности
		'chalenge/choose/([0-9]+)' => 'chalenge_act_/choose_chl/$1',
		'action/choose/([0-9]+)-([0-9]+)' => 'chalenge_act_/choose_act/$1/$2',
		'chalenge/users/([0-9]+)' => 'chalenge_act_/users/$1',
		'chalenge/invite_friends/([0-9]+)' => 'chalenge_act_/invite_friends/$1',
		'chalenge/sendInvite/([0-9]+)' => 'chalenge_act_/sendInvite/$1',
		'chalenge/takeInvite' => 'chalenge_act_/takeInvite',
		'chalenge/answerInvite' => 'chalenge_act_/answerInvite',
		'chalenge/find' => 'chalenge_act_/find_chl',
		'chalenge/coming/([0-9]+)' => 'chalenge_act_/chl_coming/$1',
		'chalenge/create_chl' => 'chalenge_act_/create_chl',
		'action/create_act' => 'chalenge_act_/create_act',

		// Действия пользователя
		'user/login' => 'user/login',
		'user/logout' => 'user/logout',
		'user/registration' => 'user/registration',
		'user/ownroom' => 'user/ownroom',
		'user/friends' => 'user/friends',
		'user/takefriend' => 'user/takefriend',
		'user/removefriend' => 'user/removefriend',
		
		'' => 'user/login'
	);
?>