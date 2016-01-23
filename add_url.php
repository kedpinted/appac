<?php
session_start();
include("connectdb.php");

	$e = explode("?v=", $_POST[vdo_id]);
	$vdo = $e[1];
	$sql = "INSERT INTO add_vdo
	VALUES (null,'".$vdo."','".$_POST['vdo_name']."')";
				
		$objQuery = mysql_query($sql);


		if(!$objQuery)
		{
		die('Error: ' . mysql_error());
		echo "<br> Go to <a href='add.php'>Login page</a>";
		}

	mysql_close();
    header("location:dashboard.php");

?>
