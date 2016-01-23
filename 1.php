<?php
//set connection variables
session_start();
include("connectdb.php");


$action = isset($_POST['action']) ? $_POST['action'] : "";

if($action=='create'){ //the the user submitted the form

$query  = "INSERT INTO annotation 
VALUES (null,'".$_POST['comment']."','".$_POST['pos_x']."','".$_POST['pos_y']."','".$_POST['time']."')";
              
header("location:2.php"); 
//close database connection
}
mysql_close();
?>