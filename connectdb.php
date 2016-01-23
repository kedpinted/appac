<?php
mysql_connect('localhost', 'root', '') or die(mysql_error());
mysql_select_db('test-2015') or die(mysql_error());
date_default_timezone_set('Asia/Bangkok');
date("H:i:s"); 
mysql_query("SET NAMES UTF8");
?>