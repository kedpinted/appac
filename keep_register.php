<?php
session_start();
include("connectdb.php");

	if($_POST["user_pass"] != $_POST["confirm_password"])
	{
		echo "Password not Match!";
		exit();
	}
	else{
		$sql = "INSERT INTO account
		VALUES (null,'".$_POST['user_firstname']."','".$_POST['user_lastname']."',
			'".$_POST['user_name']."','".$_POST['user_pass']."','".$_POST['user_email']."')";
				
		$objQuery = mysql_query($sql);


		if(!$objQuery)
		{
		die('Error: ' . mysql_error());
		echo "<br> Go to <a href='index.php'>Login page</a>";
		}
	}

	mysql_close();
    header("location:index.php");

?>
