	function validateEmail(email) {
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email.toLowerCase());
	}
	function phonenumber(inputtxt)  
	{  
		var phoneno = /^\d{10}$/;  
		if(inputtxt.match(phoneno)){  
			return true;  
		}  
		else  
		{  
			return false;  
		}  
	}  
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var value =document.getElementById("phone").value;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if((value.length)<10){
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;	
		}else{
			return false;
		}
		
	}
	//Age
	function isNumber_Age(evt) {
		evt = (evt) ? evt : window.event;
		var value =document.getElementById("age").value;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if((18<value)&&(value>101)){
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;	
		}else{
			return false;
		}
		
	}
	//Pin Code
	function isNumberPincode(evt) {
		evt = (evt) ? evt : window.event;
		var value =document.getElementById("pincode").value;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;	
	}
	function TogglePasswordVisibility() {
		var cpass = document.getElementById("cpass");
		var pass = document.getElementById("pass");
		if (cpass.type === "password" || pass.type === "password"  ) {
			cpass.type = "text";
			 pass.type = "text";
		} else {
			cpass.type = "password";
			pass.type = "password";
		}
	}
	function TogglePasswordVisibility_cp() {
		
		var oldpass = document.getElementById("oldpass");
		var cpass = document.getElementById("cpass");
		var pass = document.getElementById("pass");
		if (cpass.type === "password" || pass.type === "password" || oldpass.type === "password"  ) {
			cpass.type = "text";
			 pass.type = "text";
			  oldpass.type = "text";
		} else {
			cpass.type = "password";
			pass.type = "password";
			oldpass.type = "password";
		}
	}