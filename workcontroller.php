<?php

//testing
require 'utils.php';
require 'connect.php';

// the response will be a JSON object
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");$json = array();
// pull the input, which should be in the form of a JSON object
$json_params = file_get_contents('php://input');
// check to make sure that the JSON is in a valid format
if (isValidJSON($json_params)){
 //load in all the potential parameters.  These should match the database columns for the objects. 
  $conn = getDbConnection();  $decoded_params = json_decode($json_params, TRUE);
  $action = $decoded_params['action'];
  $json['action'] = $action;
  // uncomment the following line if you want to turn PHP error reporting on for debug - note, this will break the JSON response
  //ini_set('display_errors', 1); error_reporting(-1);
$workId = "";
if (array_key_exists('workid', $decoded_params)){
  $workId =  $decoded_params['workid'];
}
$type = "";
if (array_key_exists('type', $decoded_params)){
  $type =  $decoded_params['type'];
}
$genre = "";
if (array_key_exists('genre', $decoded_params)){
  $genre =  $decoded_params['genre'];
}
$name = "";
if (array_key_exists('name', $decoded_params)){
  $name =  $decoded_params['name'];
}
if ($action == "addOrEditWorks"){
$args = array();
if (IsNullOrEmpty($workId)){
 $sql = "INSERT INTO works (work_id,type,genre,name) VALUES ( ?,?,?,?);";
array_push($args, $workId);
array_push($args, $type);
array_push($args, $genre);
array_push($args, $name);
try{
$statement = $conn->prepare($sql);
$statement->execute($args);
$last_id = $conn->lastInsertId();
$json['Record Id'] = $last_id;
$json['Status'] = "SUCCESS - Inserted Id $last_id";
}catch (Exception $e) { 
    $json['Exception'] =  $e->getMessage();
}
}else{
$sql = "UPDATE works SET type = ?,genre = ?,name = ? WHERE work_id = ?; ";
array_push($args, $type);
array_push($args, $genre);
array_push($args, $name);
array_push($args, $workId);
try{
$statement = $conn->prepare($sql);
$statement->execute($args);
$count = $statement->rowCount();
if ($count > 0){
$json['Status'] = "SUCCESS - Updated $count Rows";
} else {
$json['Status'] = "ERROR - Updated 0 Rows - Check for Valid Ids ";
}
}catch (Exception $e) { 
    $json['Exception'] =  $e->getMessage();
}
$json['Action'] = $action;
}
} else if ($action == "deleteWorks"){
$sql = "DELETE FROM works WHERE work_id = ?";
$args = array();
array_push($args, $workId);
if (!IsNullOrEmpty($workId)){
try{
  $statement = $conn->prepare($sql);
  $statement->execute($args);
$count = $statement->rowCount();
if ($count > 0){
$json['Status'] = "SUCCESS - Deleted $count Rows";
} else {
$json['Status'] = "ERROR - Deleted 0 Rows - Check for Valid Ids ";
}
}catch (Exception $e) { 
    $json['Exception'] =  $e->getMessage();
}
} else {
$json['Status'] = "ERROR - Id is required";
}
$json['Action'] = $action;
} else if ($action == "getWorks"){
    $args = array();
    $sql = "SELECT * FROM works";
 $first = true;
if (!IsNullOrEmpty($workId)){
      if ($first) {
        $sql .= " WHERE work_id = ? ";
        $first = false;
      }else{
        $sql .= " AND work_id = ? ";
      }
      array_push ($args, $workId);
    }
if (!IsNullOrEmpty($type)){
      if ($first) {
        $sql .= " WHERE type = ? ";
        $first = false;
      }else{
        $sql .= " AND type = ? ";
      }
      array_push ($args, $type);
    }
if (!IsNullOrEmpty($genre)){
      if ($first) {
        $sql .= " WHERE genre = ? ";
        $first = false;
      }else{
        $sql .= " AND genre = ? ";
      }
      array_push ($args, $genre);
    }
if (!IsNullOrEmpty($name)){
      if ($first) {
        $sql .= " WHERE name = ? ";
        $first = false;
      }else{
        $sql .= " AND name = ? ";
      }
      array_push ($args, $name);
    }
    $json['SQL'] = $sql; 
    try{
      $statement = $conn->prepare($sql);
      $statement->setFetchMode(PDO::FETCH_ASSOC);
      $statement->execute($args);
      $result = $statement->fetchAll();
    }catch (Exception $e) { 
      $json['Exception'] =  $e->getMessage();
    }
    foreach($result as $row1 ) {
        $json['works'][] = $row1;
    }
} else { 
    $json['Exeption'] = "Unrecognized Action ";
} 
} 
else{
  $json['Exeption'] = "Invalid JSON on Inbound Request";
} 
echo json_encode($json);
closeConnections(); 
?>
