<?php
$mysql_hostname = "postel.cse.buffalo.edu";
$mysql_user="cl";
$mysql_password="ChangeMe";
$mysql_database="choreographiclineage_db";
$connection = mysql_connect( $mysql_hostname , $mysql_user , $mysql_password);
$dbc = mysql_select_db($mysql_database);

//echo @mysql_ping() ? 'true' : 'false';

// $dbc = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database)
// 		or die('Error connecting to MySQL server.');
?>
