<?php 
	include ROOT . '/views/layouts/header.php';
 ?>


<section class="reg-block">
	<p class="text-notice">Вы не авторизованы</p>
	<?php if(isset($errors) && is_array($errors)): ?>
		<div class="errors">
			<?php echo array_shift($errors); ?>
		</div>
	<?php endif; ?>
	<form action="#" class="reg-form" method="POST">
		<p class="login-text">email</p>
		<input name="email" type="email" class="input-reg" value="<?php echo $email; ?>">
		<p class="login-text">Пароль</p>
		<input name="password" type="password" class="input-reg" value="<?php echo $password; ?>">
		<br>
		<button type="submit" name="submit" class="but-regin">Войти</button>
	</form>
	<a href="../user/registration" class="reg_a">Регистрация</a>
</section>

<footer>
</footer>
	
</body>
</html>
