<?php
//$mysql_hostname = "postel.cse.buffalo.edu";
//$mysql_user="cl";
//$mysql_password="DclSQLwebsiteLineage";
$mysql_database="choreographiclineage_db";
//$connection = mysqli_connect( "localhost" , "root" , "",choreographic_lineage);
//$dbc = mysql_select_db($mysql_database);

//echo @mysql_ping() ? 'true' : 'false';

$dbc = mysqli_connect("localhost", "root", "", "choreographic_lineage");

if (!$dbc) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
