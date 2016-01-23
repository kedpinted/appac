<?php
session_start();
include("connectdb.php");

    $sql = "SELECT * FROM account WHERE user_name = '" . $_POST['username'] . "' AND user_pass = '" . $_POST['password'] . "' ";
    $Query = mysql_query($sql);
    $result = mysql_fetch_array($Query);

if ($result) {

    $_SESSION["user_id"] = $result["user_id"];
    $_SESSION["user_name"] = $result["user_name"];
    $_SESSION["logged_in"] = 1;

    session_write_close();
    header("location:dashboard.php"); 
    
    }   else  {
        echo "Username and Password Incorrect!";
    header("location:login.php"); 

    }

mysql_close();
?>