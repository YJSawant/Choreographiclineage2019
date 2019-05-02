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
    $conn = getDbConnection();
    $decoded_params = json_decode($json_params, TRUE);
    $action = $decoded_params['action'];
    $json['action'] = $action;
    // uncomment the following line if you want to turn PHP error reporting on for debug - note, this will break the JSON response
    //ini_set('display_errors', 1); error_reporting(-1);
  $relationId = "";
  if (array_key_exists('relationid', $decoded_params)){
    $relationId =  $decoded_params['relationid'];
  }
  $artistProfileId1 = "";
  if (array_key_exists('artistprofileid1', $decoded_params)){
    $artistProfileId1 =  $decoded_params['artistprofileid1'];
  }
  $artistProfileId2 = "";
  if (array_key_exists('artistprofileid1', $decoded_params)){
    $artistProfileId2 =  $decoded_params['artistprofileid2'];
  }
  $artistName1 = "";
  if (array_key_exists('artistname1', $decoded_params)){
    $artistName1 =  $decoded_params['artistname1'];
  }
  $artistEmailId1 = "";
  if (array_key_exists('artistemailId1', $decoded_params)){
    $artistEmailId1 =  $decoded_params['artistemailId1'];
  }
  $artistName2 = "";
  if (array_key_exists('artistname2', $decoded_params)){
    $artistName2 =  $decoded_params['artistname2'];
  }
  $artistEmailId2 = "";
  if (array_key_exists('artistemailId2', $decoded_params)){
    $artistEmailId2 =  $decoded_params['artistemailId2'];
  }
  $artistWebsite2 = "";
  if (array_key_exists('artistwebsite2', $decoded_params)){
    $artistWebsite2 =  $decoded_params['artistwebsite2'];
  }
  $artistRelation = "";
  if (array_key_exists('artistrelation', $decoded_params)){
    $artistRelation =  $decoded_params['artistrelation'];
  }
  $startDate = "";
  if (array_key_exists('startdate', $decoded_params)){
    $startDate =  $decoded_params['startdate'];
  }
  $endDate = "";
  if (array_key_exists('enddate', $decoded_params)){
    $endDate =  $decoded_params['enddate'];
  }
  $durationYears = "";
  if (array_key_exists('durationyears', $decoded_params)){
    $durationYears =  $decoded_params['durationyears'];
  }
  $durationMonths = "";
  if (array_key_exists('durationmonths', $decoded_params)){
    $durationMonths =  $decoded_params['durationmonths'];
  }
  $relationIdentifier = "";
  if (array_key_exists('relationidentifier', $decoded_params)){
    $relationIdentifier =  $decoded_params['relationidentifier'];
  }
  if ($action == "addOrEditArtistRelation"){
  $args = array();
  if (IsNullOrEmpty($relationId)){
  $sql = "INSERT INTO artist_relation (relation_id,artist_profile_id_1,artist_profile_id_2,artist_name_1,artist_email_id_1,artist_name_2,artist_email_id_2,artist_website_2,artist_relation,start_date,end_date,duration_years,duration_months,relation_identifier) VALUES ( ?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
  array_push($args, $relationId);
  array_push($args, $artistProfileId1);
  array_push($args, $artistProfileId2);
  array_push($args, $artistName1);
  array_push($args, $artistEmailId1);
  array_push($args, $artistName2);
  array_push($args, $artistEmailId2);
  array_push($args, $artistWebsite2);
  array_push($args, $artistRelation);
  array_push($args, $startDate);
  array_push($args, $endDate);
  array_push($args, $durationYears);
  array_push($args, $durationMonths);
  array_push($args, $relationIdentifier);
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
  $sql = "UPDATE artist_relation SET artist_profile_id_1 = ?,artist_profile_id_2 = ?,artist_name_1 = ?,artist_email_id_1 = ?,artist_name_2 = ?,artist_email_id_2 = ?,artist_website_2 = ?,artist_relation = ?,start_date = ?,end_date = ?,duration_years = ?,duration_months = ?,relation_identifier = ?; ";
  array_push($args, $artistProfileId1);
  array_push($args, $artistProfileId2);
  array_push($args, $artistName1);
  array_push($args, $artistEmailId1);
  array_push($args, $artistName2);
  array_push($args, $artistEmailId2);
  array_push($args, $artistWebsite2);
  array_push($args, $artistRelation);
  array_push($args, $startDate);
  array_push($args, $endDate);
  array_push($args, $durationYears);
  array_push($args, $durationMonths);
  array_push($args, $relationIdentifier);
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
  } else if ($action == "deleteArtistRelation"){
  $sql = "DELETE FROM artist_relation WHERE relation_id = ?";
  $args = array();
  array_push($args, $relationId);
  if (!IsNullOrEmpty($relationId)){
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
  } else if ($action == "getArtistRelation"){
      $args = array();
      $sql = "SELECT * FROM artist_relation";
      $first = true;
  if (!IsNullOrEmpty($relationId)){
        if ($first) {
          $sql .= " WHERE relation_id = ? ";
          $first = false;
        }else{
          $sql .= " AND relation_id = ? ";
        }
        array_push ($args, $relationId);
      }
  if (!IsNullOrEmpty($artistProfileId1)){
        if ($first) {
          $sql .= " WHERE artist_profile_id_1 = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_profile_id_1 = ? ";
        }
        array_push ($args, $artistProfileId1);
      }
  if (!IsNullOrEmpty($artistProfileId2)){
        if ($first) {
          $sql .= " WHERE artist_profile_id_2 = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_profile_id_2 = ? ";
        }
        array_push ($args, $artistProfileId2);
      }
  if (!IsNullOrEmpty($artistName1)){
        if ($first) {
          $sql .= " WHERE artist_name_1 = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_name_1 = ? ";
        }
        array_push ($args, $artistName1);
      }
  if (!IsNullOrEmpty($artistEmailId1)){
        if ($first) {
          $sql .= " WHERE artist_email_id_1 = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_email_id_1 = ? ";
        }
        array_push ($args, $artistEmailId1);
      }
  if (!IsNullOrEmpty($artistName2)){
        if ($first) {
          $sql .= " WHERE artist_name_2 = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_name_2 = ? ";
        }
        array_push ($args, $artistName2);
      }
  if (!IsNullOrEmpty($artistEmailId2)){
        if ($first) {
          $sql .= " WHERE artist_email_id_2 = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_email_id_2 = ? ";
        }
        array_push ($args, $artistEmailId2);
      }
  if (!IsNullOrEmpty($artistWebsite2)){
        if ($first) {
          $sql .= " WHERE artist_website_2 = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_website_2 = ? ";
        }
        array_push ($args, $artistWebsite2);
      }
  if (!IsNullOrEmpty($artistRelation)){
        if ($first) {
          $sql .= " WHERE artist_relation = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_relation = ? ";
        }
        array_push ($args, $artistRelation);
      }
  if (!IsNullOrEmpty($startDate)){
        if ($first) {
          $sql .= " WHERE start_date = ? ";
          $first = false;
        }else{
          $sql .= " AND start_date = ? ";
        }
        array_push ($args, $startDate);
      }
  if (!IsNullOrEmpty($endDate)){
        if ($first) {
          $sql .= " WHERE end_date = ? ";
          $first = false;
        }else{
          $sql .= " AND end_date = ? ";
        }
        array_push ($args, $endDate);
      }
  if (!IsNullOrEmpty($durationYears)){
        if ($first) {
          $sql .= " WHERE duration_years = ? ";
          $first = false;
        }else{
          $sql .= " AND duration_years = ? ";
        }
        array_push ($args, $durationYears);
      }
  if (!IsNullOrEmpty($durationMonths)){
        if ($first) {
          $sql .= " WHERE duration_months = ? ";
          $first = false;
        }else{
          $sql .= " AND duration_months = ? ";
        }
        array_push ($args, $durationMonths);
      }
  if (!IsNullOrEmpty($relationIdentifier)){
        if ($first) {
          $sql .= " WHERE relation_identifier = ? ";
          $first = false;
        }else{
          $sql .= " AND relation_identifier = ? ";
        }
        array_push ($args, $relationIdentifier);
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
          $json['artist_relation'][] = $row1;
      }
  }
   else {
      $json['Exception'] = "Unrecognized Action";
  }
  }
  else{
    $json['Exception'] = "Invalid JSON on Inbound Request";
  }
  echo json_encode($json);
  closeConnections();
  ?>
