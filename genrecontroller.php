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
$genreId = "";
if (array_key_exists('genreid', $decoded_params)){
  $genreId =  $decoded_params['genreid'];
}
$category = "";
if (array_key_exists('category', $decoded_params)){
  $category =  $decoded_params['category'];
}
$genreName = "";
if (array_key_exists('genrename', $decoded_params)){
  $genreName =  $decoded_params['genrename'];
}
if ($action == "addOrEditGenres"){
$args = array();
if (IsNullOrEmpty($genreId)){
 $sql = "INSERT INTO genres (genre_id,category,genre_name) VALUES ( ?,?,?);";
array_push($args, $genreId);
array_push($args, $category);
array_push($args, $genreName);
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
$sql = "UPDATE genres SET category = ?,genre_name = ? WHERE genre_id = ?; ";
array_push($args, $category);
array_push($args, $genreName);
array_push($args, $genreId);
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
} else if ($action == "deleteGenres"){
$sql = "DELETE FROM genres WHERE genre_id = ?";
$args = array();
array_push($args, $genreId);
if (!IsNullOrEmpty($genreId)){
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
} else if ($action == "getGenres"){
    $args = array();
    $sql = "SELECT * FROM genres";
 $first = true;
if (!IsNullOrEmpty($genreId)){
      if ($first) {
        $sql .= " WHERE genre_id = ? ";
        $first = false;
      }else{
        $sql .= " AND genre_id = ? ";
      }
      array_push ($args, $genreId);
    }
if (!IsNullOrEmpty($category)){
      if ($first) {
        $sql .= " WHERE category = ? ";
        $first = false;
      }else{
        $sql .= " AND category = ? ";
      }
      array_push ($args, $category);
    }
if (!IsNullOrEmpty($genreName)){
      if ($first) {
        $sql .= " WHERE genre_name = ? ";
        $first = false;
      }else{
        $sql .= " AND genre_name = ? ";
      }
      array_push ($args, $genreName);
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
        $json['genres'][] = $row1;
    }
} else {
    $json['Exception'] = "Unrecognized Action ";
}
}
else{
  $json['Exception'] = "Invalid JSON on Inbound Request";
}
echo json_encode($json);
closeConnections();
?>
