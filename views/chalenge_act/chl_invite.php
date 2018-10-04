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
				<a href="/chalenge/users/<?php echo $chl_active['id']; ?>"></a>
				<!-- <div class="participants"><p>Участники</p></div> -->
				<a href=<?php echo "/chalenge/users/" . $chl_active['id']; ?>>
					<div class="participants"><p>Участники</p></div>
				</a>
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
					<!-- <p class="chat-button">Чат</p>
					<p class="inf-button">Важная инф.</p> -->
					<p class="chl_users_insert">Пригласить в <?php echo $chl_active['name']; ?></p>
				</div>
				<div class="chat" id="chatForApd">
					<?php 
						if (!$friends) {
							echo "<p class=\"chl_users_insert_no\">для приглашения друзей нет</p>";
						}
						while($friends) {
							$user = array_shift($friends);
							if ($user['id'] == $_SESSION['logged_user'] -> id) {
								continue;
							}
							echo "
								<div class=\"massage-box\">
									<div class=\"ava_img\"> <img src=\"../../../upload/img/ava/" . $user['id'] . ".jpg\" alt=\"\"></div>
									<div class=\"massage_author_text\">
										<p class=\"msg_autor\">"  . $user['fname'] . ' ' . $user['sname'] . "</p> <p class=\"msg_time\">" . $user['town'] . "</p>
										<p class=\"msg_text\">" . $user['email_connect'] . "</p>
									</div>
									<a href=\"#\">
									 	<div class=\"add_to_friend\" onclick=\"
									 		sendInvite(" . $user['id'] . "," . $chl_active['id'] . " );
									 	\" id=\"friend" . $user['id'] . "\">пригласить</div>	
									 </a>
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
			function sendajax(data, url, fun) {
				var ajmsg = new XMLHttpRequest();
				var params = "json_data=" + JSON.stringify(data);

				ajmsg.open("POST", url, true);
				ajmsg.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				ajmsg.send(params);

				ajmsg.onreadystatechange = function() { 
					if ( ajmsg.readyState == 4 && ajmsg.status == 200 ) {
						fun(ajmsg.responseText);
				   }
				};
			};
			function sendInvite(id_friend, id_chl) {
				var data = {
					id_friend: id_friend
				};
				route = '/chalenge/sendInvite/' + id_chl;
				sendajax(data, route,
					function(data) {
						id = 'friend' + id_friend;
						document.getElementById(id).innerHTML = 'приглашен';
					}
				);
			};
			window.sendInvite = sendInvite;
		});
	</script>
</body>
</html>
