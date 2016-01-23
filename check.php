<?php
ob_start();
if(!$_SESSION['logged_in']) header("location:home.php");
?>