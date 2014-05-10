<?
	if(!isset($_SESSION['login'])) $_SESSION['login'] = null;
	$file = "users.txt";
	
	
	class FILE {
		function insert_into_file($new_user){
			global $file;
			
			if(file_exists($file)){
				$fp = fopen($file, 'a');
				fwrite($fp, implode(';', $new_user)."\n");
			}else{
				$fp = fopen($file, 'w');
				fwrite($fp, implode(";",$new_user));
			}
			fclose($fp);
		}
		
		function user_exist($user){
			global $file;
			
			if(file_exists($file)){
				$data = file($file);
				$users = array();
				foreach($data as $line){
					$line_arr = explode(";",$line);
					$users[] = $line_arr[0];
				}
				if(in_array($user, $users)){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	
		function check_user_pass($user, $pass){
			global $file;
			
			if(file_exists($file)){
				$data = file($file);
				$users = array();
				foreach($data as $line){
					$line_arr = explode(";",$line);
					if($line_arr[0] == $user && $line_arr[2] == $pass){
						return $user;
					}
				}
				return false;
			}else{
				return false;
			}
		}
		
		function user_profile($user){
			global $file;
			
			if(file_exists($file)){
				$data = file($file);
				$users = array();
				foreach($data as $line){
					$line_arr = explode(";",$line);
					if($line_arr[0] == $user){
						return $line_arr;
					}
				}
				return false;
			}else{
				return false;
			}
		
		}
	}
	
	class USER {
		function authorization($p){
			if(!isset($p['remember'])) $p['remember'] = null;
			
			$login = mysql_real_escape_string($p['login']);
			$passmd5 = md5($p['password']);
			
			if($login && $p['password']){
				if($user = FILE::check_user_pass($login, $passmd5)){
					$_SESSION['login'] = $user;
					header("Location: index.php");
				}else{
					$_SESSION['time'] = date('U');
					$_SESSION['try_left']--;
					$_SESSION['err'] = 'Не правильно введений логін або пароль';
					header('Location: login.php');
				}
			}else{
				$_SESSION['err'] = 'Поля не заповнені';
				header('Location: login.php');
			}
		}
		
		function registration($p){
			$login = mysql_real_escape_string($p['login']);
			$email = mysql_real_escape_string($p['email']);
			$passmd5 = md5($p['password']);
			$pass_confirm = md5($p['pass_confirm']);
			if($login && $p['password'] && $p['pass_confirm']){
				if(!FILE::user_exist($login)){
					if($passmd5 == $pass_confirm){
						$data = array($login, $email, $passmd5);
						if(FILE::insert_into_file($data)){
							authorization($p);
						}
					}else{
						header('Location: login.php?err='.'Неправильно введено підтверждення пароля');
					}
				}else{
					header('Location: login.php?err='.'Користувач з таким логіном вже зареєстрований');
				}
			}else{
				header('Location: login.php?err='.'Поля не заповнені');
			}
		}
		
		function logout(){
			if($_SESSION['login']){
				session_destroy();
			}else{
				return false;
			}
		}
		
		function check_session(){
			if($_SESSION['login']){
				return true;
			}else{
				return false;
			}
		}
	}
?>