<?
	session_start();
	define('ROOTDIR', getcwd());
	require(ROOTDIR."/functions.php");

	if(!isset($_GET['err'])) $_GET['err'] = NULL;
	
	if(USER::check_session() && !$_GET['err']){
		header("Location: index.php");
	}
	
	$error = $_SESSION['err'];
	unset($_SESSION['err']);
	
	if(date('U') > $_SESSION['time']+(60*5)){
		$_SESSION['try_left'] = 3;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="Author" CONTENT="Lesyuk Sergiy">
		<link type="text/css" href="stylesheet.css" rel="stylesheet">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script type="text/javascript" src="js/forlogin.js"></script> 
		<script type="text/javascript" src="task4.js"></script> 
		<title>Авторизація</title>
		<body>
<?
		if($_SESSION['try_left'] > 0){
?>
			<div class="some_window auth">
				<div class="window_padding">
					<h3 class="window_title">Авторизація</h3>
					<form class="auth_form" action="call_method.php" method="POST" >
						<div class="message"><?=$error?></div>
						<div class="form_row">
							<label for="auth_login">Логін:</label>
							<input id="auth_login" class="login right" name="login" type="text" value="" />
						</div>					
						<div class="form_row">
							<label for="auth_pass">Пароль:</label>
							<input id="auth_pass" class="password right" name="password" type="password" value="" />
						</div>
						<div class="form_row buttons">
							<input id="register_form" class="button left" type="button" value="Реєстрація" />
							<input id="auth_enter" class="button right" name="authorization" type="submit" value="Вхід" />
						</div>
						<div class="clear"></div>
					</form>
				</div>
			</div>
			<div class="some_window reg" style="display:none">
				<div class="window_padding">
					<h3 class="window_title">Зареєструватися</h3>
					<form class="reg_form" action="call_method.php" method="POST">
						<div class="message"><?=$error?></div>
						<div class="form_row">
							<label for="reg_login">Логін:</label>
							<input id="reg_login" class="login right" name="login" type="text" value="" />
						</div>
						<div class="form_row">
							<label for="reg_email">Email:</label>
							<input id="reg_email" class="email right" name="email" type="email" value="" />
						</div>
						<div class="form_row">
							<label for="reg_pass">Пароль:</label>
							<input id="reg_pass" class="password right" name="password" type="password" value="" />
						</div>
						<div class="form_row">
							<label for="reg_pass_conf">Підтвердження пароля:</label>
							<input id="reg_pass_conf" class="right" name="pass_confirm" type="password" value="" />
						</div>
						<div class="form_row buttons">
							<input id="back_to_auth" class="button left" type="button" value="Скасувати" />
							<input id="reg_enter" class="button right" name="registration" type="submit" value="Зареєструватися" />
						</div>
						<div class="clear"></div>
					</form>
				</div>
			</div>
<?
		}else{
			echo '<div class="some_window auth"><div class="only message">Спробуйте ще раз через '.($_SESSION['time']+(60*5)-date('U')).' секунд</div></div>';
		}
?>
	</body>
</html>