<!DOCTYPE html> 
<html>
<head>
<meta charset="UTF-8">
<title>APPAC |  Register</title>
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap-social.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head> 
<?php
session_start();
include("connectdb.php");
?>

<body background="images/Login/login.jpg" position:"center"; background-repeat="no-repeat"; background-color: "#475262">
	<div class="container" align="center">
		<form  method="post" onSubmit="return check();" name="reg" action="keep_register.php" >
			<div style="margin-left:50px;color:#ffffff; font-weight:bold; font-size:25"> <h1>Create Account</h1> </div>

			<div style="margin-left:50px; margin-top:20px; font-size:42px; color:#ffffff;" class="text">Firstname 
				<input type="text" style="margin-left:50px; margin-top:10px;" name="user_firstname" required class="register-input" 
				id="user_firstname" maxlength="20" placeholder="First Name"/>
			</div>

			<div style="margin-left:50px; margin-top:20px; font-size:42px; color:#ffffff;" class="text">Lastname
				<input type="text" style="margin-left:50px; margin-top:10px;" name="user_lastname" required  size="25" class="register-input"
				id="user_lastname" maxlength="40"  placeholder="Last Name" />
			</div>

			<div style="margin-left:50px; margin-top:30px; font-size:42px; color:#ffffff;"> Username
				<input type="text" style="margin-left:50px; margin-top:10px;" name="user_name" required size="25" class="register-input" 
				id="user_name" maxlength="20" placeholder="Username" />
			</div>

        	<div style="margin-left:50px; margin-top:30px; font-size:42px; color:#ffffff;"> Password
				<input type="password" style="margin-left:50px; margin-top:10px;" name="user_pass" required size="25" class="register-input" 
				id="user_pass" maxlength="20" placeholder="Password" />
			</div>
  
        	<div style="margin-left:50px; margin-top:30px; font-size:42px; color:#ffffff;"> Confirm Password
				<input type="password" style="margin-left:50px; margin-top:10px;" name="confirm_password" required size="25" class="register-input" 
				id="confirm_password" maxlength="20" placeholder="Confirm Password" />
			</div>

        	<div style="margin-left:50px; margin-top:30px; font-size:42px; color:#ffffff;">  Email
				<input type="text" style="margin-left:50px; margin-top:10px;" name="user_email" required  size="25" class="register-input" 
				id="user_email" maxlength="40" placeholder="E-mail" />
			</div>

			<div style="text-align:center">
			<input type="submit" style="margin-top:50px;width:150px;height:40px; background-color:#20b784; border-radius:5px;border: 1px solid #284473; font-size:1.5em; color:#FFF;" 
			name="signup" value="Submit" id="sign_button"> </div>
		</form>
	</div>
</body>
</html>