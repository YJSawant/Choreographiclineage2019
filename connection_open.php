<?php
//$mysqli_hostname = "postel.cse.buffalo.edu";
//$mysqli_user="cl";
//$mysqli_password="DclSQLwebsiteLineage";
$mysqli_hostname = "localhost";
$mysqli_user="root";
# Comment this if working using XAMPP
# $mysqli_password="root";

#Comment this if working using WAMP
$mysqli_password="";
$mysqli_database="choreographiclineage_db";
#$connection = mysqli_connect( $mysqli_hostname , $mysqli_user , $mysqli_password);
#$dbc = mysqli_select_db($mysqli_database);

//echo @mysqli_ping() ? 'true' : 'false';

 $dbc = mysqli_connect($mysqli_hostname, $mysqli_user, $mysqli_password, $mysqli_database)
 		or die('Error connecting to MySQL server.');
?>
