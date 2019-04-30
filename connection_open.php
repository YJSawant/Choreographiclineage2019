<?php

// $mysqli_hostname = "stark.cse.buffalo.edu";
// $mysqli_user="cl";
// $mysqli_password="DclSQLwebsiteLineage";
// $mysqli_database="choreographiclineage_db";

$mysqli_hostname = "localhost";
$mysqli_user="root";
$mysqli_password="";
$mysqli_database="choreographiclineage_db";

 $dbc = mysqli_connect($mysqli_hostname, $mysqli_user, $mysqli_password, $mysqli_database)
 		or die('Error connecting to MySQL server.');
?>
