	function number_to_text(num){
		var lang_d1 = {
			1:  "один",
			2:  "два",
			3:  "три",
			4:  "чотири",
			5:  "п'ять",
			6:  "шість",
			7:  "сім",
			8:  "вісім",
			9:  "дев'ять",
			10: "десять",
			11: "одинадцять",
			12: "дванадцять",
			13: "тринадцять",
			14: "чотирнадцять",
			15: "п'ятнадцять",
			16: "шістнадцять",
			17: "сімнадцять",
			18: "вісімнадцять",
			19: "дев'ятнадцять",
		};
		
		var lang_d2 = {
			2: "двадцять",
			3: "тридцять",
			4: "сорок",
			5: "п'ятдесят",
			6: "шістдесят",
			7: "сімдесят",
			8: "вісімдесят",
			9: "дев'яносто"
		};
		
		var lang_h = {
			1: "сто",
			2: "двісті",
			3: "триста",
			4: "чотириста",
			5: "п'ятсот",
			6: "шістсот",
			7: "сімсот",
			8: "вісімсот",
			9: "дев'ятсот"
		};
		
		var lang_th = {
			1: "одна тисяча",
			2: "дві тисячі",
			3: "три тисячі",
			4: "чотири тисячі",
			5: "тисяч"
		};

		var rezult = "";
		if(parseInt(num)){
			
			var thousands = Math.floor(num/1000);
			var num = num % 1000;
			if(thousands > 0){
				if(thousands == 1){
					rezult = rezult+lang_th[1];
				}
				else if(thousands >= 2 && thousands <= 4){
					rezult = rezult+lang_th[thousands]+' ';
				}
				else if(thousands > 4){
					rezult = rezult+lang_d1[thousands]+' '+lang_th[5]+' ';
				}
			}
			
			
			var hundreds = Math.floor(num/100);
			var num = num % 100;
			if(hundreds > 0){
				rezult = rezult+lang_h[hundreds]+' ';
			}
		
			
			var dec = Math.floor(num/10);
			var num = num % 10;
			if(dec > 0){
				if(dec > 1){
					rezult = rezult+lang_d2[dec]+' ';
				} else{
					num = num+10;
					rezult = rezult+lang_d1[num]+' ';
				}
			}
			
			
			if(num > 0 && dec != 1){
				rezult = rezult+lang_d1[num];
			}
		
		
			return rezult;
		}
	}