<?
	date_default_timezone_set("Europe/Kiev");
	define('ROOTDIR', getcwd());
	
	session_start();
	require(ROOTDIR."/conf/bdconnect.php");
	require(ROOTDIR."/functions.php");

	if(!isset($_POST['action'])) $_POST['action'] = NULL;
	if(!isset($_POST['authorization'])) $_POST['authorization'] = NULL;
	if(!isset($_POST['registration'])) $_POST['registration'] = NULL;
	if(!isset($_POST['password'])) $_POST['password'] = NULL;
	if(!isset($_POST['pass_confirm'])) $_POST['pass_confirm'] = NULL;
	if(!isset($_POST['login'])) $_POST['login'] = NULL;
	if(!isset($_POST['email'])) $_POST['email'] = NULL;
	if(!isset($_POST['logout'])) $_POST['logout'] = NULL;
	if(!isset($_POST['adding_duty'])) $_POST['adding_duty'] = NULL;
	
	if($_POST['authorization']){ #------------------------ LOGIN ----------------------------------------------
		authorization($_POST);
	}	
	elseif($_POST['registration']){ #--------------------- REGISTRATION ---------------------------------------
		registration($_POST);
	}
	elseif($_POST['action'] == 'check_login'){ #---------- CHECK LOGIN EXIST ----------------------------------
		if(user_exist($_POST['login'])){
			die('EXIST');
		}else{
			die('0');
		}
	}
	elseif($_POST['adding_duty']){ #---------------------- ADDING_DUTY ----------------------------------------
		add_new_duty($_SESSION['login'], $_POST);
	}
	elseif($_POST['action'] == 'check_done_duty'){ #------ ADDING_DUTY ----------------------------------------
		check_done_duty($_SESSION['login'], $_SESSION['uid'], $_POST);
	}
	elseif($_POST['action'] == 'delete_duty'){ #---------- DELETE_DUTY ----------------------------------------
		delete_duty($_SESSION['login'], $_SESSION['uid'], $_POST['id_duty']);
	}
	
	
	elseif($_POST['logout']){ #---------- DELETE_DUTY ----------------------------------------
		logout();
	}
	
	header("Location: index.php");
?>