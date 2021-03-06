<?php 
	include ROOT . '/views/layouts/header.php';
	// echo phpinfo();
 ?>

<section class="main">
		<div class="main-left">
			<div class="left-image-block">
				<div class="left-image-wrap">
					<img src="../upload/img/ava/<?php echo $_SESSION['logged_user']-> id; ?>.jpg" alt="">
				</div>
			</div>
			<div class="left-about-block">
				<p class="name"><?php echo $_SESSION['logged_user']-> fname . " " .$_SESSION['logged_user']-> sname; ?></p>
				<p class="about"><?php echo $_SESSION['logged_user']-> town; ?> <br> <?php echo $_SESSION['logged_user']-> email_connect; ?></p>
				<a href="/user/friends">
					<div class="button-friends"> <p>Друзья</p> </div>
				</a>
				<a href="/user/ownroom" class="button-own_room"><p>Л.К.</p></a>

			</div>
			<!-- /.left-about-block -->

			<div class="chalenges">
				<div class="chl_titel">
					<p>Челенджи</p>
					<a href="/chalenge/create_chl"><i class="fas fa-plus chl_icon_add"></i></a>
					<!-- <i class="fas fa-edit chl_icon_add"></i> -->
					<a href="/chalenge/find"><i class="fas fa-search chl_icon_add"></i></a>
					<?php 
						if ($invites) {
							echo "<a href=\"/chalenge/takeInvite\"><i class=\"far fa-envelope-open chl_icon_invite\"></i></a>";
						}
					?>
				</div>
				<ul class="chl_result">
					<?php 
						while ($challenges) {
							$chl = array_shift($challenges);
							if($chl['id'] == $chl_active['id']) {
								echo "<a href=\"#\"><li class=\"chl_active\">" . $chl['name'] . "</li></a>";
							} else {
								echo "<a href=\"/chalenge/choose/" . $chl['id'] . "\"><li>" . $chl['name'] . "</li></a>";	
							}
						}
					 ?>
					<!-- <li><a href="#">Постройнеть</a></li> -->
					<!-- <li><a href="#">Сделать сайт</a></li> -->
				</ul>
			</div>

		</div>
		<!-- /.main-left -->

		<div class="main-right">
			<div class="main-header-chalenge">
				<p class="chalenge-titel"><?php echo $chl_active['name'] ?></p>
				<!-- <div class="invite"><p>Пригласить</p></div> -->
				<a href=<?php echo "/chalenge/invite_friends/" . $chl_active['id']; ?>>
					<div class="invite"><p>Пригласить</p></div>
				</a>
				<a href=<?php echo "/chalenge/users/" . $chl_active['id']; ?>>
					<div class="participants"><p>Участники</p></div>
				</a>
				<!-- <div class="participants"><p>Участники</p></div> -->
			</div>
			<div class="orange-line"></div>
			<!-- /.main-header-chalenge -->

			<div class="actions">
				<div class="actions_titel">
					<p>
						Акстивности 
						<a href="#">
							<i class="fas fa-plus act_icon_add" onclick="
								document.getElementById('li_create_act_form').style.display = 'block';
							"></i>
						</a>
					</p>
				</div>
				<ul class="act_result">
					<li class="li_create_act_form" id="li_create_act_form">
						<form action="/action/create_act" class="create_act_form" method="POST">
							<p class="inp_left_cont">Название активности</p>
							<input name="nameOfAct"></input> 
							<input name="chl_id" hidden="true" value="<?php echo $chl_active['id']; ?>"></input> 
							<input name="submit_act" type="submit" value="Создать" class="but-save_or">
						</form>
						<input value="Отмена" type="submit" class="but-save_or" onclick="
							document.getElementById('li_create_act_form').style.display = 'none';
						">
					</li>
					<?php 
						while ($actions) {
							$act = array_shift($actions);
							if($act['id'] == $act_active['id']) {
								echo "<a href=\"#\"><li class=\"act_active\">" . $act['name'] . "</li></a>";
							} else {
								echo "<a href=\"/action/choose/" . $chl_active['id'] . "-" . $act['id'] . "\"><li>" . $act['name'] . "</li></a>";	
							}
						}
					 ?>
					<!-- <li><a href="#">Основной чат</a></li> -->
					<!-- <li><a href="#">Тайм менеджмент</a></li> -->
				</ul>
			</div>
			<!-- /.actions -->
			
			<div class="chat-block">
				<div class="top-chat">
					<p class="chat-button">Чат</p>
					<p class="inf-button">Важная инф.</p>
				</div>

				<div class="chat" id="chatForApd">
					<div class="awd_msg_text"></div>
					<!-- <form action="http://sayes.mcdir.ru/api/authuser" method="POST"> -->
					<!-- <form action="http://sayes.mcdir.ru/api/getactive/2" method="POST"> -->
					<!-- <form action="http://sayes.mcdir.ru/api/reguser" method="POST"> -->
					<!-- <form action="http://sayes.mcdir.ru/api/sendmsg" method="POST"> -->
					<form action="http://sayes.mcdir.ru/api/getupdchat" method="POST">
						<p class="login-text-r">email</p>
						<input name="email" type="email" type="text" class="input-reg" value="mit1035@yandex.ru">
						<p class="login-text-r">Пароль</p>
						<input name="password" type="password" class="input-reg" value="22">
						<input name="active_id" type="password" class="input-reg" value="14">
						<input name="msg_last_id" type="password" class="input-reg" value="58">
						<input name="time" type="password" class="input-reg" value="1529675640">
						<button type="submit" name="submit" class="but-regin">отправить</button>
					</form>
					<?php 
						while($chat && $author_msgs) {
							$msg = array_shift($chat);
							$author = array_shift($author_msgs);
							$msg_last_id = $msg['id'];
							echo "
								<div class=\"massage-box\">
									<div class=\"ava_img\"> <img src=\"../upload/img/ava/" . $author -> id . ".jpg\" alt=\"\"></div>
									<div class=\"massage_author_text\">
										<p class=\"msg_autor\">"  . $author -> fname . ' ' . $author -> sname . "</p> <p class=\"msg_time\">" . date("G:i, d.Y", $msg['msg_date']) . "</p>
										<p class=\"msg_text\">" . $msg['msg_text'] . "</p>
									</div>
								</div>
							";
						}
					 ?>
					<!-- <div class="massage-box">
						<div class="ava_img"><img src="../template/images/1.jpg" alt=""></div>
						<div class="massage_author_text">
							<p class="msg_autor">Дмитрий Баранов</p> <p class="msg_time">16:28</p>
							<p class="msg_text">Тут будет текст</p>
						</div>
					</div> -->
				</div>
				<input id="msg_last_id" value='<?php echo $msg_last_id; ?>' hidden>
				<form action="#" id="chat_form" class="chat-bottom" method="POST">
					<input type="text" class="chat_text" id="msg_text">
					<i class="fas fa-long-arrow-alt-up chat_send" id="msg_text" onclick="
						router(
							'sendMsg',
							<?php echo $act_active['id']; ?>,
							$('#msg_text').val(),
							<?php echo time() ?>
						);
						$('#msg_text').val('');
					"></i>
				</form>
				<!-- <div class="chat-bottom">
					<input type="text" class="chat_text" id="msg_text">
					<i class="fas fa-long-arrow-alt-up chat_send" id="msg_text" onclick="
						router(
							'sendMsg', 
							<?php echo $act_active['id']; ?>,
							$('#msg_text').val(),
							<?php echo time() ?>
						);
						$('#msg_text').val('');
					"></i>
				</div> -->
			</div>
			<!-- /.chat-block -->
		</div>
		<!-- /.main-right -->
	</section>
	<!-- /.main -->
	<footer>
		
	</footer>

	<script src="/template/js/chat.js"></script>
	<script src="../../template/js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			router('start', <?php echo $_SESSION['logged_user']-> id; ?>,'#chatForApd');
			var block = document.getElementById('chatForApd');
			block.scrollTop = block.scrollHeight;

			var msg_last_id = document.getElementById('msg_last_id');
			var interval = 15000; // количество миллисекунд для авто-обновления сообщений (1 секунда = 1000 миллисекунд)
		   setInterval(function() {
		   	router('showChat', <?php echo $act_active['id']; ?>, msg_last_id.value, true);  // true для картинок /../../
		   }, interval); //обновление чата 

		   $('#chat_form').on('submit',(function(e) {
				e.preventDefault();

				router(
					'sendMsg',
					<?php echo $act_active['id']; ?>,
					$('#msg_text').val(),
					<?php echo time() ?>
				);
				$('#msg_text').val('');
			}));
		});
	</script>
	
</body>
</html>
