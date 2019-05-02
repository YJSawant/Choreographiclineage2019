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
  $artistProfileId = "";
  if (array_key_exists('artistprofileid', $decoded_params)){
    $artistProfileId =  $decoded_params['artistprofileid'];
  }
  $isUserArtist = "";
  if (array_key_exists('isuserartist', $decoded_params)){
    $isUserArtist =  $decoded_params['isuserartist'];
  }
  $profileName = "";
  if (array_key_exists('profilename', $decoded_params)){
    $profileName =  $decoded_params['profilename'];
  }
  $artistFirstName = "";
  if (array_key_exists('artistfirstname', $decoded_params)){
    $artistFirstName =  $decoded_params['artistfirstname'];
  }
  $artistLastName = "";
  if (array_key_exists('artistlastname', $decoded_params)){
    $artistLastName =  $decoded_params['artistlastname'];
  }
  $artistEmailAddress = "";
  if (array_key_exists('artistemailaddress', $decoded_params)){
    $artistEmailAddress =  $decoded_params['artistemailaddress'];
  }
  $artistLivingStatus = "";
  if (array_key_exists('artistlivingstatus', $decoded_params)){
    $artistLivingStatus =  $decoded_params['artistlivingstatus'];
  }
  $artistDob = "";
  if (array_key_exists('artistdob', $decoded_params)){
    $artistDob =  $decoded_params['artistdob'];
  }
  $artistDod = "";
  if (array_key_exists('artistdod', $decoded_params)){
    $artistDod =  $decoded_params['artistdod'];
  }
  $artistGenre = "";
  if (array_key_exists('artistgenre', $decoded_params)){
    $artistGenre =  $decoded_params['artistgenre'];
  }
  $artistEthnicity = "";
  if (array_key_exists('artistethnicity', $decoded_params)){
    $artistEthnicity =  $decoded_params['artistethnicity'];
  }
  $artistGender = "";
  if (array_key_exists('artistgender', $decoded_params)){
    $artistGender =  $decoded_params['artistgender'];
  }
  $genderOther = "";
  if (array_key_exists('genderother', $decoded_params)){
    $genderOther =  $decoded_params['genderother'];
  }
  $genreOther = "";
  if (array_key_exists('genreother', $decoded_params)){
    $genreOther =  $decoded_params['genreother'];
  }
  $ethnicityOther = "";
  if (array_key_exists('ethnicityother', $decoded_params)){
    $ethnicityOther =  $decoded_params['ethnicityother'];
  }
  $artistResidenceCity = "";
  if (array_key_exists('artistresidencecity', $decoded_params)){
    $artistResidenceCity =  $decoded_params['artistresidencecity'];
  }
  $artistResidenceState = "";
  if (array_key_exists('artistresidencestate', $decoded_params)){
    $artistResidenceState =  $decoded_params['artistresidencestate'];
  }
  $artistResidenceProvince = "";
  if (array_key_exists('artistresidenceprovince', $decoded_params)){
    $artistResidenceProvince =  $decoded_params['artistresidenceprovince'];
  }
  $artistResidenceCountry = "";
  if (array_key_exists('artistresidencecountry', $decoded_params)){
    $artistResidenceCountry =  $decoded_params['artistresidencecountry'];
  }
  $artistBirthCountry = "";
  if (array_key_exists('artistbirthcountry', $decoded_params)){
    $artistBirthCountry =  $decoded_params['artistbirthcountry'];
  }
  $artistBiography = "";
  if (array_key_exists('artistbiography', $decoded_params)){
    $artistBiography =  $decoded_params['artistbiography'];
  }
  $artistBiographyText = "";
  if (array_key_exists('artistbiographytext', $decoded_params)){
    $artistBiographyText =  $decoded_params['artistbiographytext'];
  }
  $artistPhotoPath = "";
  if (array_key_exists('artistphotopath', $decoded_params)){
    $artistPhotoPath =  $decoded_params['artistphotopath'];
  }
  $artistWebsite = "";
  if (array_key_exists('artistwebsite', $decoded_params)){
    $artistWebsite =  $decoded_params['artistwebsite'];
  }
  $institutionName = "";
  if (array_key_exists('institutionname', $decoded_params)){
    $institutionName =  $decoded_params['institutionname'];
  }
  $artistMajor = "";
  if (array_key_exists('artistmajor', $decoded_params)){
    $artistMajor =  $decoded_params['artistmajor'];
  }
  $artistDegree = "";
  if (array_key_exists('artistdegree', $decoded_params)){
    $artistDegree =  $decoded_params['artistdegree'];
  }
  $newGenre="";
  if (array_key_exists('newgenre', $decoded_params)){
    $newGenre =  $decoded_params['newgenre'];
  }
  if ($action == "addOrEditArtistProfile"){
  $args = array();
  if (IsNullOrEmpty($artistProfileId)){
  $sql = "INSERT INTO artist_profile (artist_profile_id,is_user_artist,profile_name,artist_first_name,artist_last_name,artist_email_address,artist_living_status,artist_dob,artist_dod,artist_genre,artist_ethnicity,artist_gender,gender_other,genre_other,ethnicity_other,artist_residence_city,artist_residence_state,artist_residence_province,artist_residence_country,artist_birth_country,artist_biography,artist_biography_text,artist_photo_path,artist_website,genre) VALUES ( ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
  array_push($args, $artistProfileId);
  array_push($args, $isUserArtist);
  array_push($args, $profileName);
  array_push($args, $artistFirstName);
  array_push($args, $artistLastName);
  array_push($args, $artistEmailAddress);
  array_push($args, $artistLivingStatus);
  array_push($args, $artistDob);
  array_push($args, $artistDod);
  array_push($args, $artistGenre);
  array_push($args, $artistEthnicity);
  array_push($args, $artistGender);
  array_push($args, $genderOther);
  array_push($args, $genreOther);
  array_push($args, $ethnicityOther);
  array_push($args, $artistResidenceCity);
  array_push($args, $artistResidenceState);
  array_push($args, $artistResidenceProvince);
  array_push($args, $artistResidenceCountry);
  array_push($args, $artistBirthCountry);
  array_push($args, $artistBiography);
  array_push($args, $artistBiographyText);
  array_push($args, $artistPhotoPath);
  array_push($args, $artistWebsite);
  array_push($args, $newGenre);
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
  $sql = "UPDATE artist_profile SET is_user_artist = ?,profile_name = ?,artist_first_name = ?,artist_last_name = ?,artist_email_address = ?,artist_living_status = ?,artist_dob = ?,artist_dod = ?,artist_genre = ?,artist_ethnicity = ?,artist_gender = ?,gender_other = ?,genre_other = ?,ethnicity_other = ?,artist_residence_city = ?,artist_residence_state = ?,artist_residence_province = ?,artist_residence_country = ?,artist_birth_country = ?,artist_biography = ?,artist_biography_text = ?,artist_photo_path = ?,artist_website = ?, genre=? WHERE artist_profile_id = ?; ";
  array_push($args, $isUserArtist);
  array_push($args, $profileName);
  array_push($args, $artistFirstName);
  array_push($args, $artistLastName);
  array_push($args, $artistEmailAddress);
  array_push($args, $artistLivingStatus);
  array_push($args, $artistDob);
  array_push($args, $artistDod);
  array_push($args, $artistGenre);
  array_push($args, $artistEthnicity);
  array_push($args, $artistGender);
  array_push($args, $genderOther);
  array_push($args, $genreOther);
  array_push($args, $ethnicityOther);
  array_push($args, $artistResidenceCity);
  array_push($args, $artistResidenceState);
  array_push($args, $artistResidenceProvince);
  array_push($args, $artistResidenceCountry);
  array_push($args, $artistBirthCountry);
  array_push($args, $artistBiography);
  array_push($args, $artistBiographyText);
  array_push($args, $artistPhotoPath);
  array_push($args, $artistWebsite);
  array_push($args, $newGenre);
  array_push($args, $artistProfileId);
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
  } else if ($action == "deleteArtistProfile"){
  $sql = "DELETE FROM artist_profile WHERE artist_profile_id = ?";
  $args = array();
  array_push($args, $artistProfileId);
  if (!IsNullOrEmpty($artistProfileId)){
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
  } else if ($action == "getArtistProfile"){
      $args = array();
      $sql = "SELECT * FROM artist_profile";
  $first = true;
  if (!IsNullOrEmpty($artistProfileId)){
        if ($first) {
          $sql .= " WHERE artist_profile_id = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_profile_id = ? ";
        }
        array_push ($args, $artistProfileId);
      }
  if (!IsNullOrEmpty($isUserArtist)){
        if ($first) {
          $sql .= " WHERE is_user_artist = ? ";
          $first = false;
        }else{
          $sql .= " AND is_user_artist = ? ";
        }
        array_push ($args, $isUserArtist);
      }
  if (!IsNullOrEmpty($profileName)){
        if ($first) {
          $sql .= " WHERE profile_name = ? ";
          $first = false;
        }else{
          $sql .= " AND profile_name = ? ";
        }
        array_push ($args, $profileName);
      }
  if (!IsNullOrEmpty($artistFirstName)){
        if ($first) {
          $sql .= " WHERE artist_first_name = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_first_name = ? ";
        }
        array_push ($args, $artistFirstName);
      }
  if (!IsNullOrEmpty($artistLastName)){
        if ($first) {
          $sql .= " WHERE artist_last_name = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_last_name = ? ";
        }
        array_push ($args, $artistLastName);
      }
  if (!IsNullOrEmpty($artistEmailAddress)){
        if ($first) {
          $sql .= " WHERE artist_email_address = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_email_address = ? ";
        }
        array_push ($args, $artistEmailAddress);
      }
  if (!IsNullOrEmpty($artistLivingStatus)){
        if ($first) {
          $sql .= " WHERE artist_living_status = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_living_status = ? ";
        }
        array_push ($args, $artistLivingStatus);
      }
  if (!IsNullOrEmpty($artistDob)){
        if ($first) {
          $sql .= " WHERE artist_dob = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_dob = ? ";
        }
        array_push ($args, $artistDob);
      }
  if (!IsNullOrEmpty($artistDod)){
        if ($first) {
          $sql .= " WHERE artist_dod = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_dod = ? ";
        }
        array_push ($args, $artistDod);
      }
  if (!IsNullOrEmpty($artistGenre)){
        if ($first) {
          $sql .= " WHERE artist_genre = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_genre = ? ";
        }
        array_push ($args, $artistGenre);
      }
  if (!IsNullOrEmpty($artistEthnicity)){
        if ($first) {
          $sql .= " WHERE artist_ethnicity = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_ethnicity = ? ";
        }
        array_push ($args, $artistEthnicity);
      }
  if (!IsNullOrEmpty($artistGender)){
        if ($first) {
          $sql .= " WHERE artist_gender = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_gender = ? ";
        }
        array_push ($args, $artistGender);
      }
  if (!IsNullOrEmpty($genderOther)){
        if ($first) {
          $sql .= " WHERE gender_other = ? ";
          $first = false;
        }else{
          $sql .= " AND gender_other = ? ";
        }
        array_push ($args, $genderOther);
      }
  if (!IsNullOrEmpty($genreOther)){
        if ($first) {
          $sql .= " WHERE genre_other = ? ";
          $first = false;
        }else{
          $sql .= " AND genre_other = ? ";
        }
        array_push ($args, $genreOther);
      }
  if (!IsNullOrEmpty($ethnicityOther)){
        if ($first) {
          $sql .= " WHERE ethnicity_other = ? ";
          $first = false;
        }else{
          $sql .= " AND ethnicity_other = ? ";
        }
        array_push ($args, $ethnicityOther);
      }
  if (!IsNullOrEmpty($artistResidenceCity)){
        if ($first) {
          $sql .= " WHERE artist_residence_city = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_residence_city = ? ";
        }
        array_push ($args, $artistResidenceCity);
      }
  if (!IsNullOrEmpty($artistResidenceState)){
        if ($first) {
          $sql .= " WHERE artist_residence_state = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_residence_state = ? ";
        }
        array_push ($args, $artistResidenceState);
      }
  if (!IsNullOrEmpty($artistResidenceProvince)){
        if ($first) {
          $sql .= " WHERE artist_residence_province = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_residence_province = ? ";
        }
        array_push ($args, $artistResidenceProvince);
      }
  if (!IsNullOrEmpty($artistResidenceCountry)){
        if ($first) {
          $sql .= " WHERE artist_residence_country = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_residence_country = ? ";
        }
        array_push ($args, $artistResidenceCountry);
      }
  if (!IsNullOrEmpty($artistBirthCountry)){
        if ($first) {
          $sql .= " WHERE artist_birth_country = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_birth_country = ? ";
        }
        array_push ($args, $artistBirthCountry);
      }
  if (!IsNullOrEmpty($artistBiography)){
        if ($first) {
          $sql .= " WHERE artist_biography = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_biography = ? ";
        }
        array_push ($args, $artistBiography);
      }
  if (!IsNullOrEmpty($artistBiographyText)){
        if ($first) {
          $sql .= " WHERE artist_biography_text = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_biography_text = ? ";
        }
        array_push ($args, $artistBiographyText);
      }
  if (!IsNullOrEmpty($artistPhotoPath)){
        if ($first) {
          $sql .= " WHERE artist_photo_path = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_photo_path = ? ";
        }
        array_push ($args, $artistPhotoPath);
      }
  if (!IsNullOrEmpty($artistWebsite)){
        if ($first) {
          $sql .= " WHERE artist_website = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_website = ? ";
        }
        array_push ($args, $artistWebsite);
      }
      if (!IsNullOrEmpty($newGenre)){
        if ($first) {
          $sql .= " WHERE genre = ? ";
          $first = false;
        }else{
          $sql .= " AND genre = ? ";
        }
        array_push ($args, $newGenre);
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
          $json['artist_profile'][] = $row1;
      }
  }else if ($action == "getArtistProfileForNetwork"){
    $args = array();
    $sql = "SELECT distinct ap.* from artist_profile ap, artist_education ae
    WHERE ap.artist_profile_id = ae.artist_profile_id" ;
    $first = false;
    if (!IsNullOrEmpty($artistProfileId)){
      if ($first) {
        $sql .= " WHERE ap.artist_profile_id = ? ";
        $first = false;
      }else{
        $sql .= " AND ap.artist_profile_id = ? ";
      }
      array_push ($args, $artistProfileId);
    }
if (!IsNullOrEmpty($institutionName)){
  if ($first) {
    $sql .= " WHERE ae.institution_name = ? ";
    $first = false;
  }else{
    $sql .= " AND ae.institution_name = ? ";
  }
  array_push ($args, $institutionName);
}
if (!IsNullOrEmpty($artistLivingStatus)){
      if ($first) {
        $sql .= " WHERE ap.artist_living_status = ? ";
        $first = false;
      }else{
        $sql .= " AND ap.artist_living_status = ? ";
      }
      array_push ($args, $artistLivingStatus);
    }
if (!IsNullOrEmpty($artistEthnicity)){
      if ($first) {
        $sql .= " WHERE ap.artist_ethnicity = ? ";
        $first = false;
      }else{
        $sql .= " AND ap.artist_ethnicity = ? ";
      }
      array_push ($args, $artistEthnicity);
    }
if (!IsNullOrEmpty($artistGender)){
      if ($first) {
        $sql .= " WHERE ap.artist_gender = ? ";
        $first = false;
      }else{
        $sql .= " AND ap.artist_gender = ? ";
      }
      array_push ($args, $artistGender);
    }
if (!IsNullOrEmpty($genderOther)){
      if ($first) {
        $sql .= " WHERE ap.gender_other = ? ";
        $first = false;
      }else{
        $sql .= " AND ap.gender_other = ? ";
      }
      array_push ($args, $genderOther);
    }
if (!IsNullOrEmpty($ethnicityOther)){
      if ($first) {
        $sql .= " WHERE ap.ethnicity_other = ? ";
        $first = false;
      }else{
        $sql .= " AND ap.ethnicity_other = ? ";
      }
      array_push ($args, $ethnicityOther);
    }
if (!IsNullOrEmpty($artistResidenceState)){
      if ($first) {
        $sql .= " WHERE ap.artist_residence_state = ? ";
        $first = false;
      }else{
        $sql .= " AND ap.artist_residence_state = ? ";
      }
      array_push ($args, $artistResidenceState);
    }
if (!IsNullOrEmpty($artistResidenceCountry)){
      if ($first) {
        $sql .= " WHERE ap.artist_residence_country = ? ";
        $first = false;
      }else{
        $sql .= " AND ap.artist_residence_country = ? ";
      }
      array_push ($args, $artistResidenceCountry);
    }
if (!IsNullOrEmpty($institutionName)){
  if ($first) {
    $sql .= " WHERE ae.institution_name = ? ";
    $first = false;
  }else{
    $sql .= " AND ae.institution_name = ? ";
  }
  array_push ($args, $institutionName);
}
if (!IsNullOrEmpty($artistDegree)){
  if ($first) {
    $sql .= " WHERE ae.degree = ? ";
    $first = false;
  }else{
    $sql .= " AND ae.degree = ? ";
  }
  array_push ($args, $artistDegree);
}
if (!IsNullOrEmpty($artistMajor)){
  if ($first) {
    $sql .= " WHERE ae.major = ? ";
    $first = false;
  }else{
    $sql .= " AND ae.major = ? ";
  }
  array_push ($args, $artistMajor);
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
        $json['artist_profile'][] = $row1;
    }
}
else if ($action == "getArtistNames"){
  $args = array();
  $sql = "SELECT distinct artist_profile_id, artist_first_name, artist_last_name, artist_photo_path from artist_profile";
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
      $json['artist_name'][] = $row1;
  }
}
else if ($action == "getUniversityNames"){
  $args = array();
  $sql = "SELECT distinct institution_name from artist_education";
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
      $json['university'][] = $row1;
  }
}
else if ($action == "getStateNames"){
  $args = array();
  $sql = "SELECT distinct artist_residence_state from artist_profile";
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
      $json['state_names'][] = $row1;
  }
}
else if ($action == "getCountryNames"){
  $args = array();
  $sql = "SELECT distinct artist_residence_country from artist_profile";
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
      $json['country_names'][] = $row1;
  }
}
else if ($action == "getMajor"){
  $args = array();
  $sql = "SELECT distinct major from artist_education";
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
      $json['major_names'][] = $row1;
  }
}
else if ($action == "getDegree"){
  $args = array();
  $sql = "SELECT distinct degree from artist_education";
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
      $json['degree_names'][] = $row1;
  }
}
else if ($action == "getEthnicity"){
  $args = array();
  $sql = "SELECT distinct artist_ethnicity from artist_profile";
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
      $json['ethnicity_names'][] = $row1;
  }
}
   else if ($action == "getCompleteArtistProfile"){
      $args = array();
      $sql = "SELECT * FROM artist_profile";
  $first = true;
  if (!IsNullOrEmpty($artistProfileId)){
        if ($first) {
          $sql .= " WHERE artist_profile_id = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_profile_id = ? ";
        }
        array_push ($args, $artistProfileId);
      }
  if (!IsNullOrEmpty($isUserArtist)){
        if ($first) {
          $sql .= " WHERE is_user_artist = ? ";
          $first = false;
        }else{
          $sql .= " AND is_user_artist = ? ";
        }
        array_push ($args, $isUserArtist);
      }
  if (!IsNullOrEmpty($profileName)){
        if ($first) {
          $sql .= " WHERE profile_name = ? ";
          $first = false;
        }else{
          $sql .= " AND profile_name = ? ";
        }
        array_push ($args, $profileName);
      }
  if (!IsNullOrEmpty($artistFirstName)){
        if ($first) {
          $sql .= " WHERE artist_first_name = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_first_name = ? ";
        }
        array_push ($args, $artistFirstName);
      }
  if (!IsNullOrEmpty($artistLastName)){
        if ($first) {
          $sql .= " WHERE artist_last_name = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_last_name = ? ";
        }
        array_push ($args, $artistLastName);
      }
  if (!IsNullOrEmpty($artistEmailAddress)){
        if ($first) {
          $sql .= " WHERE artist_email_address = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_email_address = ? ";
        }
        array_push ($args, $artistEmailAddress);
      }
  if (!IsNullOrEmpty($artistLivingStatus)){
        if ($first) {
          $sql .= " WHERE artist_living_status = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_living_status = ? ";
        }
        array_push ($args, $artistLivingStatus);
      }
  if (!IsNullOrEmpty($artistDob)){
        if ($first) {
          $sql .= " WHERE artist_dob = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_dob = ? ";
        }
        array_push ($args, $artistDob);
      }
  if (!IsNullOrEmpty($artistDod)){
        if ($first) {
          $sql .= " WHERE artist_dod = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_dod = ? ";
        }
        array_push ($args, $artistDod);
      }
  if (!IsNullOrEmpty($artistGenre)){
        if ($first) {
          $sql .= " WHERE artist_genre = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_genre = ? ";
        }
        array_push ($args, $artistGenre);
      }
  if (!IsNullOrEmpty($artistEthnicity)){
        if ($first) {
          $sql .= " WHERE artist_ethnicity = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_ethnicity = ? ";
        }
        array_push ($args, $artistEthnicity);
      }
  if (!IsNullOrEmpty($artistGender)){
        if ($first) {
          $sql .= " WHERE artist_gender = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_gender = ? ";
        }
        array_push ($args, $artistGender);
      }
  if (!IsNullOrEmpty($genderOther)){
        if ($first) {
          $sql .= " WHERE gender_other = ? ";
          $first = false;
        }else{
          $sql .= " AND gender_other = ? ";
        }
        array_push ($args, $genderOther);
      }
  if (!IsNullOrEmpty($genreOther)){
        if ($first) {
          $sql .= " WHERE genre_other = ? ";
          $first = false;
        }else{
          $sql .= " AND genre_other = ? ";
        }
        array_push ($args, $genreOther);
      }
  if (!IsNullOrEmpty($ethnicityOther)){
        if ($first) {
          $sql .= " WHERE ethnicity_other = ? ";
          $first = false;
        }else{
          $sql .= " AND ethnicity_other = ? ";
        }
        array_push ($args, $ethnicityOther);
      }
  if (!IsNullOrEmpty($artistResidenceCity)){
        if ($first) {
          $sql .= " WHERE artist_residence_city = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_residence_city = ? ";
        }
        array_push ($args, $artistResidenceCity);
      }
  if (!IsNullOrEmpty($artistResidenceState)){
        if ($first) {
          $sql .= " WHERE artist_residence_state = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_residence_state = ? ";
        }
        array_push ($args, $artistResidenceState);
      }
  if (!IsNullOrEmpty($artistResidenceProvince)){
        if ($first) {
          $sql .= " WHERE artist_residence_province = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_residence_province = ? ";
        }
        array_push ($args, $artistResidenceProvince);
      }
  if (!IsNullOrEmpty($artistResidenceCountry)){
        if ($first) {
          $sql .= " WHERE artist_residence_country = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_residence_country = ? ";
        }
        array_push ($args, $artistResidenceCountry);
      }
  if (!IsNullOrEmpty($artistBirthCountry)){
        if ($first) {
          $sql .= " WHERE artist_birth_country = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_birth_country = ? ";
        }
        array_push ($args, $artistBirthCountry);
      }
  if (!IsNullOrEmpty($artistBiography)){
        if ($first) {
          $sql .= " WHERE artist_biography = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_biography = ? ";
        }
        array_push ($args, $artistBiography);
      }
  if (!IsNullOrEmpty($artistBiographyText)){
        if ($first) {
          $sql .= " WHERE artist_biography_text = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_biography_text = ? ";
        }
        array_push ($args, $artistBiographyText);
      }
  if (!IsNullOrEmpty($artistPhotoPath)){
        if ($first) {
          $sql .= " WHERE artist_photo_path = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_photo_path = ? ";
        }
        array_push ($args, $artistPhotoPath);
      }
  if (!IsNullOrEmpty($artistWebsite)){
        if ($first) {
          $sql .= " WHERE artist_website = ? ";
          $first = false;
        }else{
          $sql .= " AND artist_website = ? ";
        }
        array_push ($args, $artistWebsite);
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
      $sql = "SELECT genres.* FROM artist_profile, artist_genres, genres WHERE 
              artist_profile.artist_profile_id = artist_genres.artist_profile_id
              AND artist_genres.genre_id = genres.genre_id AND artist_profile.artist_profile_id = ".$row1['artist_profile_id'];
      $json['SQL artist_genres'] = $sql; 
      try{
        $conn2 = getDbConnection();      
        $statement2 = $conn2->prepare($sql);
        $statement2->setFetchMode(PDO::FETCH_ASSOC);
        $statement2->execute();
        $result2 = $statement2->fetchAll();
      }catch (Exception $e) { 
        $json['Exception'] =  $e->getMessage();
      }
      foreach($result2 as $row2 ) {
          $row1['genres'][] = $row2;
      }
      $sql = "SELECT works.* ,artist_works.involvement FROM artist_profile, artist_works, works WHERE 
              artist_profile.artist_profile_id = artist_works.artist_profile_id
              AND artist_works.work_id = works.work_id AND artist_profile.artist_profile_id = ".$row1['artist_profile_id'];
      $json['SQL artist_works'] = $sql; 
      try{
        $conn2 = getDbConnection();      
        $statement2 = $conn2->prepare($sql);
        $statement2->setFetchMode(PDO::FETCH_ASSOC);
        $statement2->execute();
        $result2 = $statement2->fetchAll();
      }catch (Exception $e) { 
        $json['Exception'] =  $e->getMessage();
      }
      foreach($result2 as $row2 ) {
          $row1['works'][] = $row2;
      }  
      $sql = "SELECT artist_education.* FROM artist_profile, artist_education WHERE 
              artist_profile.artist_profile_id = artist_education.artist_profile_id
              AND artist_education.artist_profile_id = ".$row1['artist_profile_id'];
      $json['SQL artist_education'] = $sql; 
      try{
        $conn2 = getDbConnection();      
        $statement2 = $conn2->prepare($sql);
        $statement2->setFetchMode(PDO::FETCH_ASSOC);
        $statement2->execute();
        $result2 = $statement2->fetchAll();
      }catch (Exception $e) { 
        $json['Exception'] =  $e->getMessage();
      }
      foreach($result2 as $row2 ) {
          $row1['artist_education'][] = $row2;
      }
      $sql = "SELECT artist_relation.* FROM artist_profile, artist_relation WHERE 
              artist_profile.artist_profile_id = artist_relation.artist_profile_id_1
                AND artist_profile.artist_profile_id = ".$row1['artist_profile_id'];
      $json['SQL artist_relation'] = $sql; 
      try{
        $conn2 = getDbConnection();      $statement2 = $conn2->prepare($sql);
        $statement2->setFetchMode(PDO::FETCH_ASSOC);
        $statement2->execute();
        $result2 = $statement2->fetchAll();
      }catch (Exception $e) { 
        $json['Exception'] =  $e->getMessage();
      }
      foreach($result2 as $row2 ) {
          $row1['artist_relation'][] = $row2;
      }
          $json['artist_profile'][] = $row1;
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
