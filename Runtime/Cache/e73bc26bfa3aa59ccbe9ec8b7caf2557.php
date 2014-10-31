<?php if (!defined('THINK_PATH')) exit(); echo '<?'; ?>
xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- actually the first html file I have edited-->
<head>
	<meta name="keywords" content="login, faq, bbs, software, experiment" />
	<meta name="Auther" content="Redrock" />
	<title>FAQBBS</title>
	<style type="text/css">
	.input-wrapper input{
		background: #e7f1f8;
		font-size: 15px;
		border: 1px solid #1672B9;
		border-radius: 5px;
		padding: 8px 10px;
		box-shadow: inset 0 1px 2px rgba(15,82,135,.25),0 1px 0 rgba(255,255,255,.15);
		width: 180px;
		margin-top: 3px;
		color: #555;
		line-height: 17px;
	}

	.button-wrapper {
		margin-top: 5px;
	}
	
	.sign-button{
		border: 1px solid #1D80CF;
		width: 100%;
		text-align: center;
		font-size: 15px;
		color: #fff;
		text-shadow: 0 1px 1px rgba(0,0,0,.2);
		background: #80C3F7;
		background: -webkit-gradient(linear,left top,left bottom,from(#80c3f7),to(#6bbaf8));
		box-shadow: inset 0 1px 0 rgba(255,255,255,.3),0 1px 1px rgba(50,50,50,.05);
		border-radius: 5px;
		cursor: pointer;
		line-height: 33px;
		display: block;
		padding: 0 15px;
		outline: 0;

	}

	.view{
		width: 202px;
		margin: 38px 0;
		margin-top: 38px;
		margin-right: 0px;
		margin-bottom: 38px;
		margin-left: 0px;
	}

	.sign-flow{
		width: 202px;
		height: 220px;
	}

	#signin-view{
		display: none;
		-moz-transition: opacity 1s ease-in;
    	-webkit-transition: opacity 1s ease-in;
    	-o-transition: opacity 1s ease-in;
    	transition: opacity 1s ease-in;
	}

	#signup-view{
		display: block;
		-moz-transition: opacity 1s ease-in;
    	-webkit-transition: opacity 1s ease-in;
    	-o-transition: opacity 1s ease-in;
    	transition: opacity 1s ease-in;
		
	}

	input.first, input.last{
		width: 72px;
		display: inline-block;
		zoom: 1;
	}

	input.last{
		margin-left: 10px;
	}

	</style>
</head>
<body>
	<h1 id="faqbbs">faqbbs</h1>
	<script type="text/javascript">
		document.write("__URL__");

	</script>
<?php echo ($name); ?>
	<hr />


	<div class="sign-flow">
<!--用户注册-->
	<div id="signin-view" class="view view-signin " >
		<button class="sign-button" id="display-signup">登录</button>
		<form id="signin" method="post" action="__URL__/signin" class="zu-side-signup-box" novalidate="novalidate">
			
			<div class="name input-wrapper">
				<input id="firstname" required="" name="last_name" class="first" placeholder="姓">
				<input id="lastname" required="" name="first_name" class="last" placeholder="名">
			</div>
			<div class="email input-wrapper">
				<input id="emailaddress" required="" type="email" name="email" placeholder="知乎注册邮箱">
			</div>
			<div class="input-wrapper">
				<input id="initial" required="" type="password" name="password" maxlength="128" placeholder="密码">
			</div>
			<div class="input-wrapper">
				<input id="veritfication" required="" type="password" name="password_identify" maxlength="128" placeholder="确认密码">
			</div>

			<div class="button-wrapper command">
				<button class="sign-button" type="submit" >注册</button>
			</div>
		</form>
	</div>


<!--用户登录-->
	<div id="signup-view" class="view view-signup " >
		<button class="sign-button" id="display-signin">注册</button>
		<form id="signup" method="post" action="__URL__/signup" class="zu-side-signin-box" novalidate="novalidate">
			<div class="email input-wrapper">
				<input id="emailaddress2" required="" type="email" name="email" placeholder="登录邮箱">
			</div>
			<div class="input-wrapper">
				<input id="password" required="" type="password" name="password" maxlength="128" placeholder="密码">
			</div>
			<div class="button-wrapper command">
				<button class="sign-button" type="submit" >登录</button>
			</div>
		</form>	
	</div>
	
	</div>


	<script type="text/javascript">
<!--注册信息验证-->
		function chk_password(password){
			return password!="";
		}

		function chk_emailaddress(email){
			var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			
			if (filter.test(email)){

				return true;
			}
 			else {
 				return false;
 			}
 		}

		function chk_signin_value(){
			var firstname=document.getElementById("firstname");
			var lastname=document.getElementById("lastname");
			if(firstname.value==""||lastname.value==""){
				alert("姓名不能为空");
				return false;
			}
			var emailv=document.getElementById("emailaddress");
			if(!chk_emailaddress(emailv.value)){
				alert("邮件格式有误");
				return false;
			}

			var init= document.getElementById("initial");
			if(!chk_password(init.value)){
				alert("密码不能为空");
				return false;
			}

			var verit=document.getElementById("veritfication");
			if(init.value!=verit.value){
				alert("密码输入不一致");
				return false;
			}
			return true;
		}
		
<!--登录信息验证-->
		function chk_signup_value(){
			var emailaddress2=document.getElementById("emailaddress2");
			if(!chk_emailaddress(emailaddress2.value)){
				alert("邮箱地址错误");
				return false;
			}
			var password=document.getElementById("password");
			if(!chk_password(password.value)){
				alert("密码不能为空");
				return false;
			}
			return true;
		}

		function startrun(obj,target){
		  	clearInterval(obj.timer);
		  	obj.timer = setInterval(function(){
		    var speed = 0;
		    if(target>obj.alpha){
		      speed = 5;
		    }else{
		      speed = -5;
		    }
		    
		    if(obj.alpha == target){
		      clearInterval(obj.timer);
		    }else{
		      obj.alpha = obj.alpha + speed;
		      obj.style.filter = "alpha(opacity="+obj.alpha+")";
		      obj.style.opacity = obj.alpha/100;
		    }
		  
		  },5)
		}


		function display_signin(){
			//alert("abc1");
			var display_signin=document.getElementById("signin-view");
			var display_signup=document.getElementById("signup-view");

			//display_signup.style.opacity="0";
			display_signup.style.display="none";
	
			display_signin.style.opacity="0";			
			display_signin.style.display="block";

			//alert("abc");
			display_signin.alpha=0;
			startrun(display_signin,100);
		}

		function display_signup(){
			//alert("abc");
			var display_signin=document.getElementById("signin-view");
			var display_signup=document.getElementById("signup-view");

			//display_signup.style.opacity="0";
			display_signin.style.display="none";
	
			display_signup.style.opacity="0";			
			display_signup.style.display="block";

			//alert("abc");
			display_signup.alpha=0;
			startrun(display_signup,100);			
		}



		//alert("abc0");
		document.getElementById("signin").onsubmit=chk_signin_value;
		document.getElementById("signup").onsubmit=chk_signup_value;
		document.getElementById("display-signin").onclick=display_signin;
		document.getElementById("display-signup").onclick=display_signup;
	</script>
</body>
</html>