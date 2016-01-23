<!DOCTYPE html>
<?php
session_start();
include("connectdb.php");
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.ico">

    <title>APPAC | Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap-social.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700">
</head>

<body background="images/Login/login.jpg" position:"center"; background-repeat="no-repeat"; >
    <div class="container" align="center">
        <img src="images/Login/appac.png" alt="Logo" style="width:auto;height:140px;padding-bottom:30px;"/><br>
        <button class="btn btn-facebook" style="width:115px;height:35px;margin-right:5px;"><i class="fa fa-facebook"></i> |  Facebook</button>
        <button class="btn btn-google-plus" style="width:115px;height:35px;margin-left:5px;"><i class="fa fa-google-plus"></i> |  Google+</button><br><br>
        <img src="images/Login/or.png" style="width:auto;height:40px;padding-bottom:10px"/><br>
        <form class="form-signin" method="post" action="check_login.php">
            <input type="text" class="form-control" placeholder="Username" name="username" required autofocus><br><br>
            <input type="password" class="form-control" placeholder="Password" name="password" required><br><br>
            <input type="submit" value="Log in" name="Login" class="login-submit" style="background-color:#EABC00;
            width:150px;height:40px; border-radius: 5px; border: 1px solid #284473;font-size:1.2em;font-weight: bold; color:#FFF;"/>
            <a href="register.php">
                <p>Create an account now.</p>
            </a>
        </form>
    </div> <!-- /container -->
</body>
</html>
