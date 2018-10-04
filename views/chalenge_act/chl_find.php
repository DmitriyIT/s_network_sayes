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
				<p class="chalenge-titel">Челенджи</p>
			</div>
			<div class="orange-line"></div>
			<!-- /.main-header-chalenge -->
			<section class="section_chls_find_block">
				<?php 
					while ($allChl) {
						$chl = array_shift($allChl);
						echo "
							<div class=\"chl_show_block\">
								<div class=\"chl_find_color_block\">
									<div class=\"chl_find_titel\">" . $chl['name'] . "</div>
									<div class=\"chl_find_team\">Участников: " . $chl['countUsers'] . "</div>
									<p>" . $chl['discription'] . "</p>
									<a href=/chalenge/coming/" . $chl['id'] . "\">Вступить</a>
								</div>
								<div class=\"chl_find_bot_line\"></div>
							</div>
						";
					}
				 ?>	
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
</body>
</html>
