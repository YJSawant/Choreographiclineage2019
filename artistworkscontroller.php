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
$artistWorksId = "";
if (array_key_exists('artistworksid', $decoded_params)){
  $artistWorksId =  $decoded_params['artistworksid'];
}
$artistProfileId = "";
if (array_key_exists('artistprofileid', $decoded_params)){
  $artistProfileId =  $decoded_params['artistprofileid'];
}
$workId = "";
if (array_key_exists('workid', $decoded_params)){
  $workId =  $decoded_params['workid'];
}
$involvement = "";
if (array_key_exists('involvement', $decoded_params)){
  $involvement =  $decoded_params['involvement'];
}
if ($action == "addOrEditArtistWorks"){
$args = array();
if (IsNullOrEmpty($artistWorksId)){
 $sql = "INSERT INTO artist_works (artist_works_id,artist_profile_id,work_id,involvement) VALUES ( ?,?,?,?);";
array_push($args, $artistWorksId);
array_push($args, $artistProfileId);
array_push($args, $workId);
array_push($args, $involvement);
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
$sql = "UPDATE artist_works SET artist_profile_id = ?,work_id = ?,involvement = ? WHERE artist_works_id = ?; ";
array_push($args, $artistProfileId);
array_push($args, $workId);
array_push($args, $involvement);
array_push($args, $artistWorksId);
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
} else if ($action == "deleteArtistWorks"){
$sql = "DELETE FROM artist_works WHERE artist_works_id = ?";
$args = array();
array_push($args, $artistWorksId);
if (!IsNullOrEmpty($artistWorksId)){
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
} else if ($action == "getArtistWorks"){
    $args = array();
    $sql = "SELECT * FROM artist_works";
 $first = true;
if (!IsNullOrEmpty($artistWorksId)){
      if ($first) {
        $sql .= " WHERE artist_works_id = ? ";
        $first = false;
      }else{
        $sql .= " AND artist_works_id = ? ";
      }
      array_push ($args, $artistWorksId);
    }
if (!IsNullOrEmpty($artistProfileId)){
      if ($first) {
        $sql .= " WHERE artist_profile_id = ? ";
        $first = false;
      }else{
        $sql .= " AND artist_profile_id = ? ";
      }
      array_push ($args, $artistProfileId);
    }
if (!IsNullOrEmpty($workId)){
      if ($first) {
        $sql .= " WHERE work_id = ? ";
        $first = false;
      }else{
        $sql .= " AND work_id = ? ";
      }
      array_push ($args, $workId);
    }
if (!IsNullOrEmpty($involvement)){
      if ($first) {
        $sql .= " WHERE involvement = ? ";
        $first = false;
      }else{
        $sql .= " AND involvement = ? ";
      }
      array_push ($args, $involvement);
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
        $json['artist_works'][] = $row1;
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
