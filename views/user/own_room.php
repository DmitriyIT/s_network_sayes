<?php 
	include ROOT . '/views/layouts/header.php';
 ?>

	<section class="main">
		<div class="main-left">
			<div class="left-image-block">
				<div class="left-image-wrap">
					<img src="../../upload/img/ava/<?php echo $_SESSION['logged_user']-> id . ".jpg";?>" alt="">
				</div>
			</div>
			<div class="left-about-block">
				<p class="name"><?php echo $_SESSION['logged_user']-> fname . " " .$_SESSION['logged_user']-> sname; ?></p>
				<p class="about"><?php echo $_SESSION['logged_user']-> town; ?> <br> <?php echo $_SESSION['logged_user']-> email_connect; ?></p>
				<a href="/user/friends">
					<div class="button-friends"> <p>Друзья</p> </div>
				</a>
				<div class="button-own_room">
					<p>Л.К.</p>
				</div>
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
				<p class="chalenge-titel">Личный кабинет</p>
			</div>
			<div class="orange-line"></div>
			<!-- /.main-header-chalenge -->

			<div class="left-image-block-or">
				<div class="left-image-wrap">
					<img src="../../upload/img/ava/<?php echo $_SESSION['logged_user']-> id . ".jpg";?>" alt="">
				</div>
			</div>

			<section class="own_room-block">
				<form enctype="multipart/form-data" action="#" method="post">
					<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
					<input name="imagefile" type="file" class="inp_file_or" />

					<br>
					<div class="block_inp_or">
						<p class="inp_left_cont">Имя</p>
						<input name="fname" type="text" value="<?php echo $_SESSION['logged_user']->fname; ?>"></input> <br> 
					</div>
					<div class="block_inp_or">
						<p class="inp_left_cont">Фамилия</p>
						<input name="sname" type="text" value="<?php echo $_SESSION['logged_user']->sname; ?>"></input> <br>
					</div>
					<div class="block_inp_or">
						<p class="inp_left_cont">Пол</p>
						<input name="ownRoom_sex" value="<?php echo @$_SESSION['logged_user']->sex; ?>"></input> <br>
					</div>
					<div class="block_inp_or">
						<p class="inp_left_cont">Возраст</p>
						<input name="ownRoom_age" value="<?php echo @$_SESSION['logged_user']->age; ?>"></input> <br>
					</div>
					<div class="block_inp_or">
						<p class="inp_left_cont">Город</p>
						<input name="town" value="<?php echo @$_SESSION['logged_user']->town; ?>"></input> <br>
					</div>
					<div class="block_inp_or">
						<p class="inp_left_cont">Email</p>
						<input name="email_connect" value="<?php echo @$_SESSION['logged_user']->email_connect ?>"></input> <br>
					</div>

					<input name="submit" type="submit" value="Сохранить" class="but-save_or">	
				</form>
			</section>

			<!-- <section class="reg-block">
				<form action="" class="reg-form">
					<p class="login-text-r">Логин</p>
					<input name="login" type="text" class="input-reg">
					<p class="login-text-r">Пароль</p>
					<input name="password" type="text" class="input-reg">
					<p class="login-text-r">Пароль еще раз</p>
					<input name="password" type="text" class="input-reg">
					<p class="login-text-r">email</p>
					<input name="login" type="text" class="input-reg">
					<br>
					<div type="submit" class="but-regin">Зарегистрироваться</div>
				</form>
				<a href="../user/login" class="reg_a">Назад</a>
			</section> -->
			
			
		</div>
		<!-- /.main-right -->
	</section>
	<!-- /.main -->
		
	<footer>
		
	</footer>
</body>
</html>
