<?php
session_start();
include("../connectdb.php");

$json_result = array('status'=> false);

 	$vdo_id = (int)$_GET['vdo_id'];

 	$sql = "SELECT * FROM annotation WHERE vdo_id = ".(int)$vdo_id.' ORDER BY time ASC';

 	$result = mysql_query($sql);

 	if($result) {
 		$json_result['status'] = true;
	 	while($data = mysql_fetch_assoc($result)){
	 		$json_result['annotation'][] = $data;
	 	}
 	}
	

	echo json_encode($json_result);
	// echo "<script>alert('tests');</script>";
	
	mysql_close();
?>