	function login_exist(elem, login){
		$.ajax({
			type: 'POST',
			url: 'call_method.php',
			data: {
				action: 'check_login',
				login: login,
			}
		}).success(function (data){
			if(data == 'EXIST'){
				if($('.message .err_login2').length == 0){
					$('.message').append('<div class="err_login2">Такий логін вже зайнятий</div>');
					elem.css('border-color', 'red');
				}
			}else{
				elem.css('border-color', '#888888');
				$('.message .err_login2').remove();
			}
		}).error(function (){
			console.log('Ошибка при получении данных');
		});
	}
	
	function check_login(elem){
		login = elem.val();
		filter = /^[A-Z][a-zA-Zа-яА-Я0-9_\-]{5,}$/;
		if(filter.test(login)){
			$('.message .err_login1').remove();
			elem.css('border-color', '#888888');
			
			if(elem.attr('id') == 'reg_login')
				login_exist(elem, login);
			
			return true;
		}else{
			if($('.message .err_login1').length == 0){
				$('.message').append('<div class="err_login1">Логін повинен починатися з великої літери і має містити не менше шести літер</div>');
				elem.css('border-color', 'red');
			}
			return false;
		}
	}
	
	function check_email(elem){
		email = elem.val();
		filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(filter.test(email)){
			elem.css('border-color', '#888888');
			$('.message .err_email').remove();
			return true;
		}else{
			if($('.message .err_email').length == 0){
				$('.message').append('<div class="err_email">Введіть email правильно</div>');
				elem.css('border-color', 'red');
			}
			return false;
		}
	}
	
	function check_pass(elem){
		pass = elem.val() ? elem.val() : '';
		var rez = false;
		filter1 = /^[a-zA-Zа-яА-Я0-9]+$/;
		if(filter1.test(pass) && pass.length > 0){
			filter2 = /[a-zA-Zа-яА-Я]/;
			filter3 = /[0-9]/;
			if(filter2.test(pass) && filter3.test(pass)){
				rez = true;
			}
		}
		
		if(rez){
			elem.css('border-color', '#888888');
			$('.message .err_pass').remove();
			return true;
		}else{
			if($('.message .err_pass').length == 0){
				var p_text = '<div class="err_pass">Пароль повинен складатися тільки з букв і цифр, мінімальна довжина 8 символів, повинен містити мінімум по 1 цифрі і 1 букві</div>';
				$('.message').append(p_text);
				elem.css('border-color', 'red');
			}
			return false;
		}
	}
	
	$(document).ready(function(){
		$('#register_form').click(function(){
			$('.message').html('');
			$('.some_window.auth').hide();
			$('.some_window.reg').fadeIn();
		});
		
		$('#back_to_auth').click(function(){
			$('.message').html('');
			$('.some_window.auth').fadeIn();
			$('.some_window.reg').hide();
		});
		
		$('input.login').blur(function(){
			check_login($(this));
		});
		$('input.email').blur(function(){
			check_email($(this));
		});
		$('input.password').blur(function(){
			check_pass($(this));
		});
		
		$('input.password').blur(function(){
			check_pass($(this));
		});
		
		$('.auth_form').submit(function(){
			var l = check_login($('.auth_form .login'));
			var p = check_pass($('.auth_form .password'));
			if(l && p){
				return true;
			}else{
				return false;
			}
		});
		
		$('.reg_form').submit(function(){
			var l = check_login($('.reg_form .login'));
			var e = check_email($('.reg_form .email'));
			var p = check_pass($('.reg_form .password'));
			if(l && e && p){
				return true;
			}else{
				return false;
			}
		});
	});