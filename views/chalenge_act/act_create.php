<?php 
	include ROOT . '/views/layouts/header.php';
 ?>
<section class="main">
		<div class="main-left">
			<div class="left-image-block">
				<div class="left-image-wrap">
					<img src="../../../upload/img/ava/<?php echo $_SESSION['logged_user']-> id; ?>.jpg" alt="">
				</div>
			</div>
			<div class="left-about-block">
				<p class="name"><?php echo $_SESSION['logged_user']-> fname . " " . $_SESSION['logged_user']-> sname; ?></p>
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
					<!-- <i class="fas fa-plus chl_icon_add"></i> -->
					<a href="/chalenge/create_chl"><i class="fas fa-plus chl_icon_add"></i></a>
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
								echo "<a href=\"/chalenge/choose/" . $chl['id'] . "\"><li class=\"chl_active\">" . $chl['name'] . "</li></a>";
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
				<div class="invite"><p>Пригласить</p></div>
				<div class="participants"><p>Участники</p></div>
			</div>
			<div class="orange-line"></div>
			<!-- /.main-header-chalenge -->

			<div class="actions">
				<div class="actions_titel">
					<p>Акстивности <i class="fas fa-plus act_icon_add"></i></p>
				</div>
				<ul class="act_result">
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
					<?php 
						while($chat && $author_msgs) {
							$msg = array_shift($chat);
							$author = array_shift($author_msgs);
							echo "
								<div class=\"massage-box\">
									<div class=\"ava_img\"> <img src=\"../../../upload/img/ava/" . $author -> id . ".jpg\" alt=\"\"></div>
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
				<div class="chat-bottom">
					<input type="text" class="chat_text" id="msg_text">
					<i class="fas fa-long-arrow-alt-up chat_send" id="msg_text" onclick="
						router(
							'sendMsg', 
							<?php echo $act_active['id']; ?>,
							$('#msg_text').val(),
							<?php echo time() ?>
						);
					"></i>
				</div>
			</div>
			<!-- /.chat-block -->
		</div>
		<!-- /.main-right -->
	</section>
	<!-- /.main -->
		
	<footer>
		
	</footer>
	
	<script src="../../template/js/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="/template/js/chat.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			router('start', <?php echo $_SESSION['logged_user']-> id; ?>,'#chatForApd');
			var block = document.getElementById('chatForApd');
			block.scrollTop = block.scrollHeight;

			var interval = 10000; // количество миллисекунд для авто-обновления сообщений (1 секунда = 1000 миллисекунд)
		   setInterval(function() {
		   	router('showChat', <?php echo $act_active['id']; ?>, false); // false для картинок ../
		   }, interval); //обновление чата 
		});
	</script>
</body>
</html>
