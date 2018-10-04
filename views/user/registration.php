<?php 
	include ROOT . '/views/layouts/header.php';
 ?>


<section class="reg-block">
	<p class="reg-notice">Регистрация</p>
	<form action="#" class="reg-form" method="POST">
		<p class="login-text-r">email</p>
		<input name="email" type="email" type="text" class="input-reg">
		<p class="login-text-r">Пароль</p>
		<input type="password" name="password1" class="input-reg">
		<p class="login-text-r">Пароль еще раз</p>
		<input  type="password" name="password2" class="input-reg">
		<!-- <p class="login-text-r">email</p>
		<input name="login" type="text" class="input-reg">
		<br> -->
		<button type="submit" name="submit" class="but-regin">Зарегистрироваться</button>
	</form>
	<a href="../user/login" class="reg_a">Назад</a>
</section>

<footer>
	</footer>
	
</body>
</html>
