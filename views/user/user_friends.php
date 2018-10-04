<?php 
	include ROOT . '/views/layouts/header.php';
 ?>
<section class="main">
		<div class="main-left">
			<div class="left-image-block">
				<div class="left-image-wrap">
					<img src="../../upload/img/ava/<?php echo $_SESSION['logged_user']-> id; ?>.jpg" alt="">
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
				<p class="chalenge-titel">Друзья</p>
			</div>
			<div class="orange-line"></div>
			<!-- /.main-header-chalenge -->
			<section class="section_chls_find_block">
				<div class="chat-block">
					<div class="chat" id="chatForApd">
						<?php 
							while($friends) {
								$user = array_shift($friends);
								if ($user['id'] == $_SESSION['logged_user'] -> id) {
									continue;
								}
								echo "
									<div class=\"massage-box\" id=\"friend" . $user['id'] . "\">
										<div class=\"ava_img\"> <img src=\"../../../upload/img/ava/" . $user['id'] . ".jpg\" alt=\"\"></div>
										<div class=\"massage_author_text\">
											<p class=\"msg_autor\">"  . $user['fname'] . ' ' . $user['sname'] . "</p> <p class=\"msg_time\">" . $user['town'] . "</p>
											<p class=\"msg_text\">" . $user['email_connect'] . "</p>
										</div>
										<a href=\"#\">
										 	<div class=\"add_to_friend\" onclick=\"
										 		removeFriend(" . $user['id'] . ");
										 	\">Убрать из друзей</div>	
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
			</section>

			
			<!-- <section class="section_chls_find_block">
				<div class="chl_show_block">
					<div class="chl_find_color_block">
						<div class="chl_find_titel">Ввести тайм менеджмент</div>
						<div class="chl_find_team">Участников: 20</div>
						<p> Собираемся группами по 12 человек  и разбираем задачи, описание челенджа описание челенджаописание челенджаописание челенджаописание челенджаописание челенджаописаниеджаописание челенджаописаниеджаописание челенджаописаниеджаописание челенджаописание челенджа</p>
						<a href="#">Вступить</a>
					</div>
					<div class="chl_find_bot_line"></div>
				</div>
			</section> -->
			
		</div>
		<!-- /.main-right -->
	</section>
	<!-- /.main -->
		
	<footer>
		
	</footer>
	<script src="../../template/js/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
			function removeFriend(id_friend) {
				var data = {
					id_friend: id_friend
				};
				sendajax(data, '/user/removefriend',
					function(data) {
						id = 'friend' + id_friend;
						document.getElementById(id).style.display = 'none';
					}
				);
			};
			window.removeFriend = removeFriend;
		});
	</script>
</body>
</html>
