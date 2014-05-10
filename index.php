<?
	session_start();
	date_default_timezone_set("Europe/Kiev");
	
	define('ROOTDIR', getcwd());
	require(ROOTDIR."/functions.php");
	
	if(!check_session()){
		header("Location: login.php");
	}
	
	if(!isset($_GET['err'])) $_GET['err'] = NULL;
	$mess = $_GET['err'];

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="Author" CONTENT="Lesyuk Sergiy">
		<link type="text/css" href="stylesheet.css" rel="stylesheet">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> 
		<title>Юзер</title>
	</head>
	<body>
		<div class="user_menu right">
			<div class="user_name left"><?=$_SESSION['login']?></div>
			<form method="post" action="call_method.php" class="right">
				<input id="exit_button" class="button" name="logout" type="submit" value="Вийти" />
			</form>
			<div class="clear"></div>
		</div>
		
		<div class="wrapper">
			<div class="main_content">
				<div class="user_profile">
<?
					if($usrData = user_profile($_SESSION['login'])){
?>
						<div class="data">Login: <b><?=$usrData[0]?></b></div>
						<div class="data">E-mail: <b><?=$usrData[1]?></b></div>
<?				
					}else{
?>
						<div class="err">Данні юзера не знайені</div>
<?
					}
?>
				</div>
			</div>
		</div>
	</body>
</html>