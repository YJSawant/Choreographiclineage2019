<?php

$connections = array();

function getDbConnection(){

<<<<<<< HEAD
  //$servername = "stark.cse.buffalo.edu";
  //$username = "cl";
  //$password = "DclSQLwebsiteLineage";
  //$dbname = "choreographiclineage_db";
  //error_log("Connecting to  ".$dbname." as user ".$username, 0);
   $servername = 'localhost';
   $username='root';
   $password='';
   $dbname='choreographiclineage_db';
  // error_log("Connecting to  ".$dbname." as user ".$username, 0);
=======
  // $servername = "stark.cse.buffalo.edu";
  // $username = "cl";
  // $password = "DclSQLwebsiteLineage";
  // $dbname = "choreographiclineage_db";
  $servername = 'localhost';
  $username='root';
  $password='';
  $dbname='choreographiclineage_db';
  error_log("Connecting to  ".$dbname." as user ".$username, 0);
>>>>>>> 480c697546a865492604ed69d57cf0ab004ba81b
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
