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
$artistGenreId = "";
if (array_key_exists('artistgenreid', $decoded_params)){
  $artistGenreId =  $decoded_params['artistgenreid'];
}
$artistProfileId = "";
if (array_key_exists('artistprofileid', $decoded_params)){
  $artistProfileId =  $decoded_params['artistprofileid'];
}
$genreId = "";
if (array_key_exists('genreid', $decoded_params)){
  $genreId =  $decoded_params['genreid'];
}
if ($action == "addOrEditArtistGenres"){
$args = array();
if (IsNullOrEmpty($artistGenreId)){
 $sql = "INSERT INTO artist_genres (artist_genre_id,artist_profile_id,genre_id) VALUES ( ?,?,?);";
array_push($args, $artistGenreId);
array_push($args, $artistProfileId);
array_push($args, $genreId);
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
$sql = "UPDATE artist_genres SET artist_profile_id = ?,genre_id = ? WHERE artist_genre_id = ?; ";
array_push($args, $artistProfileId);
array_push($args, $genreId);
array_push($args, $artistGenreId);
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
} else if ($action == "deleteArtistGenres"){
$sql = "DELETE FROM artist_genres WHERE artist_genre_id = ?";
$args = array();
array_push($args, $artistGenreId);
if (!IsNullOrEmpty($artistGenreId)){
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
} else if ($action == "getArtistGenres"){
    $args = array();
    $sql = "SELECT * FROM artist_genres";
 $first = true;
if (!IsNullOrEmpty($artistGenreId)){
      if ($first) {
        $sql .= " WHERE artist_genre_id = ? ";
        $first = false;
      }else{
        $sql .= " AND artist_genre_id = ? ";
      }
      array_push ($args, $artistGenreId);
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
if (!IsNullOrEmpty($genreId)){
      if ($first) {
        $sql .= " WHERE genre_id = ? ";
        $first = false;
      }else{
        $sql .= " AND genre_id = ? ";
      }
      array_push ($args, $genreId);
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
        $json['artist_genres'][] = $row1;
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
