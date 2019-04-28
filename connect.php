<?php

$connections = array();

function getDbConnection(){

  $servername = "stark.cse.buffalo.edu";
  $username = "cl";
  $password = "DclSQLwebsiteLineage";
  $dbname = "choreographiclineage_db";
  error_log("Connecting to  ".$dbname." as user ".$username, 0);
  // $servername = 'localhost';
  // $username='root';
  // $password='';
  // $dbname='choreographiclineage_db';
  // error_log("Connecting to  ".$dbname." as user ".$username, 0);
  $conn = null;

  // Create connection
  try{
    //echo("trying connection");
    $conn = new PDO("mysql:host=".$servername.";dbname=".$dbname, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //array_push($connections, $conn);
    return $conn;
  }
  catch(Exception $e){
    echo "connection error ".$servername .$dbname .$username .$password;
    error_log("Error Connecting to  ".$dbname." as user ".$username, 0);
  }

}

function closeConnections(){

}

?>
