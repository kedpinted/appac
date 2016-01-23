<?php
session_start();
include("connectdb.php");

	$sql = "INSERT INTO annotation
	VALUES (null,'".$_POST['anno_content']."')";
				
		$objQuery = mysql_query($sql);


		if(!$objQuery)
		{
		die('Error: ' . mysql_error());
		echo "<br> Go to <a href='#'>Login page</a>";
		}

	mysql_close();
    header("location:anno.php");

?>
