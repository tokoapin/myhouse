
<!--
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><?=$title ?></title>

	<link type="text/css" href="assets/css/jquery-ui-themes/blitzer/jquery-ui-1.10.0.custom.css" rel="stylesheet" />

<script type="text/javascript" src="assets/js/jQuery/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="assets/js/jQuery/jquery-ui-1.10.0.js"></script>

	
</head>
<body>
-->	
<!--	<script type="text/javascript" src="assets/js/libs/jquery-validation-1.11/jquery.validate.js"></script>-->
	
	<h1 id="pageID"><?=$title ?></h1>

	<?php log_message("debug","TESTING TESTING"); ?>

	<?php echo validation_errors(); ?>
	<?php echo form_open('register/registerUser', array('id' => 'registerform')); ?>

	<input type="radio" name="role" value="REGULAR" checked="checked" id="role">一般會員 <br />
	<input type="radio" name="role" value="AGENT" id="role">經紀人 <br />
	<input type="radio" name="role" value="ORGANIZATION" id="role">公司會員 <br />	

	<br />
	<div>
		行動電話 : 
		<input type="text" name="phone" value="22" id="phone"><br/>
		密碼 : 
		<input type="text" name="password" value="22" id="password"><br/>
		密碼確認 : 
		<input type="text" name="cpassword" value="22" id="cpassword"><br/>
		姓名 : 
		<input type="text" name="username" value="22" id="username"><br/>
		<input type="radio" name="gender" value="male" id="gender" checked="checked" >先生 <br />
		<input type="radio" name="gender" value="female" id="gender">小姐 <br />
		Email : 
		<input type="text" name="email" value="22" id="email"><br/>
	</div>
	<br/>
	<div name="fill_agent" id="fill_agent">
		工作區域 : 
			<select id="work_area_city" name="work_area_city">
				<option></option>
			</select>
			<select id="work_area_region" name="work_area_city_region">
				<option></option>
			</select> <br/>
		所屬公司型態 : 
			<input type="radio" name="org_type" value="REGULAR" checked="checked">直營店 
			<input type="radio" name="org_type" value="CHAIN">加盟店 <br />
		經紀業名稱 : 
			<input type="text" name="agent_nick" id="agent_nick" value=""><br/>
		請上傳(或傳真03-5506118) 經紀營業人員證明文件以便驗證, <br/>
			<a href="test">證件上傳</a> <br/>
			<a href="test">個人照上傳</a> <br/>
	</div>
	<br/>
	<div name="fill_organization" id="fill_organization">
		公司名稱 : 
			<input type="text" name="org_name" value="" id="org_name"><br/>
		室內電話 : 
			<input type="text" name="org_phone" value="" id="org_phone"><br/>
		傳真 : 
			<input type="text" name="org_fax" value="" id="org_fax"><br/>
		公司地址 : 
			<input type="text" name="org_address" value="" id="org_address"><br/>
		公司類別 : 
			<select name="org_class" id="org_class">
				<option value="ELECTRIC_UTIL">水電空調</option>
				<option value="PAINTING_DECORATION">油漆粉刷</option>
				<option value="HOME_MOVERS">搬家服務</option>
				<option value="HOME_CLEANING">家事清潔</option>
				<option value="KEYLOCK_MAKING">配鎖刻印</option>
				<option value="FURNITURE_BATH">衛浴廚具</option>
				<option value="FURNITURE_FLOOR">地板地磚</option>
				<option value="FURNITURE_CURTAIN">窗簾燈飾</option>
				<option value="OTHER">其它</option>
			</select> <br/>
		公司營業項目/性質 : 
			<input type="text" name="org_services" value="" id="org_services"><br/>
		請上傳(或傳真03-5506118) 公司團体,行號營業證明文件 以便驗證 <br/>
			<a href="test">公司形象圖/照片上傳</a> <br/>
			<a href="test">證明文件上傳</a> <br/>
		可先登錄事後再至會員中心補傳 
	</div>

	<br/>

	我已仔細閱讀並明瞭 <a href="test">服務說明</a>, <a href="">免責聲明</a>, <a href="">隱私權聲明</a> 等所載內容及其意義,
	茲同意該等條款規定,並 願遵守網站現今,嗣後規範的各種規則. <br/> 

	<input type="submit" name="submit" value="確認送出">

	<?php echo form_close(); ?>
	<br/>
	<dialogs>
		<div id="dlg_sms_verification">
			<div id="div_verify_start" stage="1">
				每個帳號需要手幾認證否則帳號被取消. 請準備手幾然後按 "開始認證". <br />
				手幾號碼 : 
				<input id="ver_phone"  name="ver_phone" value="" type="text"> <br/>
				<input id="b_StartVerify" name="b_StartVerify" type="button" value="開始認證"/> 
				<input id="b_CancelVerify" name="b_CancelVerify" type="button" value="取消"/>
				<br />
			</div>
			<div id="div_verify_process" stage="2">
				已向您的手機發送 確認碼簡訊，請將簡訊內6位確認碼輸入至以下欄位中！ <br/>
				確認碼 : 
				<input id="ver_code"  name="ver_code" value="" type="text"> <br/>
				<div id="remain_time">
				倒數 <span>60</span> 秒 <br />
				</div>
				<input id="b_SendVerifyCode" name="b_SendVerifyCode" type="button" value="送確認碼"/> <br />
			</div>
			<div id="div_verify_result" stage="3">
				<div id="div_result_success" style="display:none;">
					您已完成註冊成為甜蜜屋會員. 請重新登入 <br/>
					<input id="b_login" name="b_login" type="button" value="登入"/> <br />
				</div>
				<div id="div_result_error" style="display:none;">
					<label id="ver_err_msg">確認嗎錯誤. 請從新填寫資料 !</label>
					<input id="b_retry" name="b_retry" type="button" value="關閉"/> <br />
				</div>
			</div>			
		</div>
	</dialogs>	
</body>

<script>
	function getRole() {
		return $("#registerform").find("input[name=role]:checked").val();
	}

	function attachValidation() {
		var jform = $("#registerform");
		var rule_options = 
		{
			"email": {
				required: true
				, email: true
			}
			,"phone": {
				required: true
				, number: true
				, remote: "index.php/register/checkPhoneDuplicate"
			}
			,"password": "required"
			,"cpassword": {
				required: true
				, equalTo : "#password"
			}
			,"username": "required"
			,"gender": "required"
			/*
			,"work_area_city": {
				required: function(element) {
					return (getRole() == 'AGENT');
				}
			}
			*/
			,"org_type": {
				required: function(element) {
					return (getRole() == 'AGENT');
				}
			}
			,"agent_nick": {
				required: function(element) {
					return (getRole() == 'AGENT');
				}
			}
			,"org_name": {
				required: function(element) {
					return (getRole() == 'ORGANIZATION');
				}
			}
			,"org_phone": {
				required: function(element) {
					return (getRole() == 'ORGANIZATION');
				}
				, number: true
			}
			,"org_fax": {
				required: function(element) {
					return (getRole() == 'ORGANIZATION');
				}
				, number: true
			}
			,"org_address": {
				required: function(element) {
					return (getRole() == 'ORGANIZATION');
				}
			}
			,"org_class": {
				required: function(element) {
					return (getRole() == 'ORGANIZATION');
				}
			}
			,"org_services": {
				required: function(element) {
					return (getRole() == 'ORGANIZATION');
				}
			}
		};

		var message_options = 
		{
			"phone": "Phone Number is already registered. Please use another."
		};

		jform.validate({
			rules: rule_options,
			messages: message_options, 
			ignore: "",
			submitHandler: function(form) {
				smsVerification();
				//let smsVerification do the submit duty
				return false;
			}
		});
	}

	function updateRoleDisplay() {
		var role = getRole();
		$("#fill_agent").hide();
		$("#fill_organization").hide();
		switch(role) {
			case "AGENT" : 
				$("#fill_agent").show();
			break;
			case "ORGANIZATION" : 
				$("#fill_organization").show();
			break;
		}
	}

	var g_verifyStatus = "unverified";
	//1. let user prepare cell phone, then "StartVerify" btn
	//2. let user enter verification code
	//3. if ok, show success message. 
	//		failed, show error message. 
	function smsVerification() {
		var jdialog = $("#dlg_sms_verification");
		jdialog.find("#ver_phone").val($("#phone").val());

		jdialog.find("[stage]").each( function(){
			$(this).hide();
		});
		jdialog.dialog("open");
		jdialog.find("#div_verify_start").show();
	}

	function initSmsVerification() {
		//initDialog
		$("#dlg_sms_verification").dialog({
			autoOpen: false,
			modal: true,
		});

		$("#b_StartVerify").click(function () {
			//initiate sms
			$.post("index.php/register/smsVerifySendSms",
				{ phone : $("#ver_phone").val(), action : "SEND_SMS_TO_PHONE_NUMBER" },
				startVerifyCb , "json")
				.fail(function() {
					alert("Error. Ajax returned maybe not in json format."); 
				})
			;
		});

		$("#b_CancelVerify").click(function () {
			$("#dlg_sms_verification").dialog('close');
		});

		$("#b_SendVerifyCode").click(function () {
			// check sms verification via backend
			// if verified, registerUser to the DB will be done inside smsVerifyCheckCode

			var params = {
				code : $("#ver_code").val()
				, phone : $("#ver_phone").val()
				, action : "CHECK_CODE_VALIDITY_AND_SUBMIT" 
			};

			dataPost = $("#registerform").serialize();
			dataPost += "&"+ $.param(params),

			$.post("index.php/register/smsVerifyCheckCode",
				dataPost,
				showVerifyResult , "json")
				.fail(function() { alert("Error. Ajax returned maybe not in json format."); })
			;
		});

		$("#b_login").click(function () {
			//verification success, use this button to login page.
			alert("redirect to LOGIN page !");
		});

		$("#b_retry").click(function () {
			//verification failed, use this button to close verification dialog, and focus on the phone number.
			$("#dlg_sms_verification").dialog('close');
		});
	}

	function startVerifyCb(data) {
		if(empty(data) || empty(data['result'])) {
			alert("Return data from register/smsVerifySendSms is error.");
			return;
		}
		if(data['result'] !='ok') {
			if(data['result'] =='duplicate') {
				alert("Phone Number is already used. Please use another!");
				return;	
			}
			if(data['result'] =='send_sms_error') {
				alert("Send sms error : " + data['message'] +". Please contact SweetHome support. ");
				return;	
			}
		}

		showVerifyForm();		
	}

	function showVerifyForm() {
		var jdialog = $("#dlg_sms_verification");
		jdialog.find("[stage]").each( function() {
			$(this).hide();
		});
		jdialog.find("#div_verify_process").show();		
		setTimerCountDown(60);
	}

	function showVerifyResult(data) {
		if(empty(data) || empty(data['result'])) {
			alert("Return data register/smsVerifySendSms is error.");
			return;
		}
		var jdialog = $("#dlg_sms_verification");
		jdialog.find("[stage]").each( function() {
			$(this).hide();
		});

		jdialog.find("#div_verify_result").show();
		if(data['result'] == "ok") {
			jdialog.find("#div_result_error").hide();
			jdialog.find("#div_result_success").show();
		}
		else {
			jdialog.find("#div_result_success").hide();
			jdialog.find("#div_result_error").show();

			if(!empty(data['message']))
				jdialog.find("#div_result_error").find("#ver_err_msg").html(data['message']);
		}
		clearInterval(g_verify_countdown);		
	}

	var g_verify_countdown = null;
	function setTimerCountDown(sec)
	{
		g_verify_countdown = setInterval(function() {
			$('#remain_time span').text(sec--);
			if (sec == -1)  
			{
				clearInterval(g_verify_countdown);
				showVerifyResult({result:"not valid", message:"You have exceeded maximum time. Please retry !"});
			}
		}, 1000);
	}


function empty (mixed_var) {
	// Checks if the argument variable is empty
	// undefined, null, false, number 0, empty string,
	// string "0", objects without properties and empty arrays
	// are considered empty
	//
	// http://kevin.vanzonneveld.net
	// +   original by: Philippe Baumann
	// +      input by: Onno Marsman
	// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +      input by: LH
	// +   improved by: Onno Marsman
	// +   improved by: Francesco
	// +   improved by: Marc Jansen
	// +      input by: Stoyan Kyosev (http://www.svest.org/)
	// +   improved by: Rafal Kukawski
	// *     example 1: empty(null);
	// *     returns 1: true
	// *     example 2: empty(undefined);
	// *     returns 2: true
	// *     example 3: empty([]);
	// *     returns 3: true
	// *     example 4: empty({});
	// *     returns 4: true
	// *     example 5: empty({'aFunc' : function () { alert('humpty'); } });
	// *     returns 5: false
	var undef, key, i, len;
	var emptyValues = [undef, null, false, 0, "", "0"];

	for (i = 0, len = emptyValues.length; i < len; i++) {
		if (mixed_var === emptyValues[i]) {
		  return true;
		}
	}

	if (typeof mixed_var === "object") {
	for (key in mixed_var) {
	  // TODO: should we check for own properties only?
	  //if (mixed_var.hasOwnProperty(key)) {
	  return false;
	  //}
	}
	return true;
	}

	return false;
}

	$(document).ready(function() {
		attachValidation();
		var jform = $("#registerform");
		var jrole = jform.find("input[name=role]");
		jrole.change(function () {
			updateRoleDisplay();
		});
		jrole.trigger("change");
		initSmsVerification();

	});
</script>
</html>

    