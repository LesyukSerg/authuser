<?
	date_default_timezone_set("Europe/Kiev");
	define('ROOTDIR', getcwd());
	
	session_start();
	require(ROOTDIR."/functions.php");

	if(!isset($_POST['action'])) $_POST['action'] = NULL;
	if(!isset($_POST['authorization'])) $_POST['authorization'] = NULL;
	if(!isset($_POST['registration'])) $_POST['registration'] = NULL;
	if(!isset($_POST['password'])) $_POST['password'] = NULL;
	if(!isset($_POST['pass_confirm'])) $_POST['pass_confirm'] = NULL;
	if(!isset($_POST['login'])) $_POST['login'] = NULL;
	if(!isset($_POST['email'])) $_POST['email'] = NULL;
	if(!isset($_POST['logout'])) $_POST['logout'] = NULL;
	
	if($_POST['authorization']){ #------------------------ LOGIN ----------------------------------------------
		USER::authorization($_POST);
	}	
	elseif($_POST['registration']){ #--------------------- REGISTRATION ---------------------------------------
		USER::registration($_POST);
	}
	elseif($_POST['action'] == 'check_login'){ #---------- CHECK LOGIN EXIST ----------------------------------
		if(FILE::user_exist($_POST['login'])){
			die('EXIST');
		}else{
			die('0');
		}
	}
	
	header("Location: index.php");
?>