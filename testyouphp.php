<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>HTML5 MediaElement - YouTube</title>	
	
	<script src="js/jquery.js"></script>	
	<script src="build/mediaelement-and-player.min.js"></script>	
	<link rel="stylesheet" href="build/mediaelementplayer.min.css" />
</head>
<body>

<video width="640" height="360" id="player1">
    

 <?php
@session_start();
include("connectdb.php");

$sql = "SELECT * FROM add_vdo ORDER BY id ASC LIMIT 0,6";
        
$result = mysql_db_query("test-2015",$sql);
while($rs=mysql_fetch_array($result)) {
  $idvdo = $rs["vdo_id"];
  echo "<source type='video/youtube'  src='https://www.youtube.com/embed/$idvdo'/>";
  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}
  mysql_close();
  ?>

</video>

<span id="player1-mode"></span>

<script>

$('video').mediaelementplayer({
	success: function(media, node, player) {
		$('#' + node.id + '-mode').html('mode: ' + media.pluginType);
	}
});

</script>

</body>
</html>