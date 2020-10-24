<?php
use Phppot\Member;
if (! empty($_POST["signup-btn"])) {
    require_once './Model/Member.php';
    $member = new Member();
    $registrationResponse = $member->registerMember();
}
?>
<HTML>
<HEAD>
<TITLE>User Registration</TITLE>
<link href="assets/css/phppot-style.css" type="text/css"
	rel="stylesheet" />
<link href="assets/css/user-registration.css" type="text/css"
	rel="stylesheet" />
<script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</HEAD>
<BODY>
	<div class="phppot-container">
		<div class="sign-up-container">
			
			<div class="">
				<form name="sign-up" action="" method="post"
					onsubmit="return signupValidation()">
					<div class="signup-heading">Registration</div>
						<div class="error-msg" id="error-msg"></div>
							<div class="row">
								<div class="inline-block">
									<div class="form-label">
										Username<span class="required error" id="username-info"></span>
									</div>
									<input class="input-box-330" type="text" name="username"
										id="username">
								</div>
							</div>
							<div class="row">
								<div class="inline-block">
									<div class="form-label">
										Mobile Number<span class="required error" id="mobile-info"></span>
									</div>
									<input class="input-box-330" type="text" name="mobile" id="mobile">
								</div>
							</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								State<span class="required error" id="state-info"></span>
							</div>
							<select name="state" id="state" onChange="changecat(this.value);">
								<option value="" disabled selected>Select</option>
								<option value="mh">Maharashtra</option>
								<option value="ga">Goa</option>
								<option value="kr">Karnataka</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								City<span class="required error" id="city-info"></span>
							</div>
							<select name="city" id="city">
								<option value="" disabled selected>Select</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Email<span class="required error" id="email-info"></span>
							</div>
							<input class="input-box-330" type="email" name="email" id="email">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Password<span class="required error" id="signup-password-info"></span>
							</div>
							<input class="input-box-330" type="password"
								name="signup-password" id="signup-password">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Confirm Password<span class="required error"
									id="confirm-password-info"></span>
							</div>
							<input class="input-box-330" type="password"
								name="confirm-password" id="confirm-password">
						</div>
					</div>
					<div class="row">
						<input class="btn" type="submit" name="signup-btn"
							id="signup-btn" value="Sign up">
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
	
	var citiesByCategory = {
    mh: ["Pune", "Mumbai", "Satara", "Sangli"],
    ga: ["A", "B", "C", "Others"],
    kr: ["X", "Y", "Z", "Others"]
}

    function changecat(value) {
        if (value.length == 0) document.getElementById("city").innerHTML = "<option></option>";
        else {
            var catOptions = "";
            for (categoryId in citiesByCategory[value]) {
                catOptions += "<option>" + citiesByCategory[value][categoryId] + "</option>";
            }
            document.getElementById("city").innerHTML = catOptions;
        }
    }
	
function signupValidation() {
	var valid = true;

	$("#username").removeClass("error-field");
	$("#email").removeClass("error-field");
	$("#password").removeClass("error-field");
	$("#confirm-password").removeClass("error-field");
	$("#mobile").removeClass("error-field");
	$("#state").removeClass("error-field");
	$("#city").removeClass("error-field");

	var UserName = $("#username").val();
	var Mobile = $('#mobile').val();
    
	var email = $("#email").val();
	var Password = $('#signup-password').val();
    var ConfirmPassword = $('#confirm-password').val();
	var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

	var State =  document.getElementById('state').value;
	var City =  document.getElementById('city');

	$("#username-info").html("").hide();

	var phoneno = /^\d{10}$/;

	if(!Mobile.match(phoneno)){
		$("#mobile-info").html("Invalid Mobile Number. It should be 10 Digits.").css("color", "#ee0000")
		.show();
		$("#mobile").addClass("error-field");
		valid = false;
		}
	
	$("#email-info").html("").hide();

	if (UserName.trim() == "") {
		$("#username-info").html("required.").css("color", "#ee0000").show();
		$("#username").addClass("error-field");
		valid = false;
	}

	/*    if (City.options[City.selectedIndex].text == "Select") {
		$("#state-info").html("required.").css("color", "#ee0000").show();
		$("#state").addClass("error-field");
		valid = false;
	}*/

	if (City.options[City.selectedIndex].text == "Select") {
		$("#city-info").html("required.").css("color", "#ee0000").show();
		$("#city").addClass("error-field");
		valid = false;
	}
	
	if (email == "") {
		$("#email-info").html("required").css("color", "#ee0000").show();
		$("#email").addClass("error-field");
		valid = false;
	} else if (email.trim() == "") {
		$("#email-info").html("Invalid email address.").css("color", "#ee0000").show();
		$("#email").addClass("error-field");
		valid = false;
	} else if (!emailRegex.test(email)) {
		$("#email-info").html("Invalid email address.").css("color", "#ee0000")
				.show();
		$("#email").addClass("error-field");
		valid = false;
	}
	if (Password.trim() == "") {
		$("#signup-password-info").html("required.").css("color", "#ee0000").show();
		$("#signup-password").addClass("error-field");
		valid = false;
	}
	if (ConfirmPassword.trim() == "") {
		$("#confirm-password-info").html("required.").css("color", "#ee0000").show();
		$("#confirm-password").addClass("error-field");
		valid = false;
	}
	if(Password != ConfirmPassword){
        $("#error-msg").html("Both passwords must be same.").show();
        valid=false;
    }
	if (valid == false) {
		$('.error-field').first().focus();
		valid = false;
	}
	return valid;
}
</script>
</BODY>
</HTML>