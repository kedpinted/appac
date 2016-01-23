<!DOCTYPE html> 
<html>
<head>
<meta charset="UTF-8">
<title>APPAC |  ADD URL</title>
	<link href="bower_components/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bower_components/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-social.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="assets/vendor/signin.css" rel="stylesheet">
</head> 
<?php
session_start();
include("connectdb.php");
?>

<body background="images/Login/login.jpg" position:"center"; background-repeat="no-repeat"; background-color: "#475262">
	<div class="container" align="center">
		<form  method="post" onSubmit="return check();" name="reg" action="add_url.php" >
			
			<input type="text" style="margin-top:10px;" name="vdo_name" required  size="25" class="vdo_name"
				id="vdo_name" maxlength="50"  placeholder="Video name" /><br>

			<input type="text" style="mmargin-top:10px;" name="vdo_id" required  size="25" class="vdo_id"
				id="vdo_id" maxlength="50"  placeholder="Paste url" />

			<div style="text-align:center">
			<input type="submit" style="margin-top:50px;width:150px;height:40px; background-color:#20b784; border-radius:5px;border: 1px solid #284473; font-size:1em; color:#FFF;" 
			name="add_url" value="Submit" id="add_url"> </div>
		</form>
	</div>
</body>
</html>