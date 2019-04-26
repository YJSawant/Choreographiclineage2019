<?php
include 'path.php';
include 'menu.php';
include 'util.php';

my_session_start();
  if(isset($_SESSION["user_email_address"]) &&  $_SESSION["timeline_flow"] != "view"){
    $first_name = array();
    $last_name = array();
    $email_address = array();
    $website = array();

    $studied_under = array();
    $danced_with = array();
    $collaborated_with = array();
    $influenced_by = array();

    if(isset($_POST["lineage_artist_first_name"]) && !empty($_POST["lineage_artist_first_name"])){
      $_SESSION["lineage_artist_first_name"] = $_POST["lineage_artist_first_name"];
      $first_name = $_POST["lineage_artist_first_name"];
    }

    if(isset($_POST["lineage_artist_last_name"]) && !empty($_POST["lineage_artist_last_name"])){
      $_SESSION["lineage_artist_last_name"] = $_POST["lineage_artist_last_name"];
      $last_name = $_POST["lineage_artist_last_name"];
    }

    if(isset($_POST["lineage_artist_email_address"]) && !empty($_POST["lineage_artist_email_address"])){
      $_SESSION["lineage_artist_email_address"] = $_POST["lineage_artist_email_address"];
      $email_address = $_POST["lineage_artist_email_address"];
    }

    if(isset($_POST["lineage_artist_website"]) && !empty($_POST["lineage_artist_website"])){
      $_SESSION["lineage_artist_website"] = $_POST["lineage_artist_website"];
      $website = $_POST["lineage_artist_website"];

    }

    if(isset($_POST["lineage_artist_genre"]) && !empty($_POST["lineage_artist_genre"])){
      $_SESSION["lineage_artist_genre"] = $_POST["lineage_artist_genre"];
      $genres= $_POST["lineage_artist_genre"];

    }




      /*if(isset($_POST["danced_start_date"]) && !empty($_POST["danced_start_date"])){
      $_SESSION["danced_start_date"] = $_POST["danced_start_date"];
      $danced_sd = $_POST["danced_start_date"];
    }

    if(isset($_POST["danced_end_date"]) && !empty($_POST["danced_end_date"])){
      $_SESSION["danced_end_date"] = $_POST["danced_end_date"];
      $danced_ed = $_POST["danced_end_date"];
    }

    if(isset($_POST["danced_duration_years"]) && !empty($_POST["danced_duration_years"])){
      $_SESSION["danced_duration_years"] = $_POST["danced_duration_years"];
      $danced_years = $_POST["danced_duration_years"];
    }

    if(isset($_POST["danced_duration_months"]) && !empty($_POST["danced_duration_months"])){
      $_SESSION["danced_duration_months"] = $_POST["danced_duration_months"];
      $danced_months = $_POST["danced_duration_months"];
    }*/

    /*if(isset($_POST["collaborated_start_date"]) && !empty($_POST["collaborated_start_date"])){
      $_SESSION["collaborated_start_date"] = $_POST["collaborated_start_date"];
      $collaborated_sd = $_POST["collaborated_start_date"];
    }

    if(isset($_POST["collaborated_end_date"]) && !empty($_POST["collaborated_end_date"])){
      $_SESSION["collaborated_end_date"] = $_POST["collaborated_end_date"];
      $collaborated_ed = $_POST["collaborated_end_date"];
    }

    if(isset($_POST["collaborated_duration_years"]) && !empty($_POST["collaborated_duration_years"])){
      $_SESSION["collaborated_duration_years"] = $_POST["collaborated_duration_years"];
      $collaborated_years = $_POST["collaborated_duration_years"];
    }

    if(isset($_POST["collaborated_duration_months"]) && !empty($_POST["collaborated_duration_months"])){
      $_SESSION["collaborated_duration_months"] = $_POST["collaborated_duration_months"];
      $collaborated_months = $_POST["collaborated_duration_months"];
    }*/

    if(isset($_POST["relationship_studied"])){
      foreach ($_POST["relationship_studied"] as $studied) {
        $studied_under[$studied] = $studied;

      }
      $_SESSION["studied_under"] = $studied_under;
    }

    if(isset($_POST["relationship_danced"])){
      foreach ($_POST["relationship_danced"] as $danced) {
        $danced_with[$danced] = $danced;

      }
      $_SESSION["danced_with"] = $danced_with;
    }

    if(isset($_POST["relationship_collaborated"])){
      foreach ($_POST["relationship_collaborated"] as $collaborated) {
        $collaborated_with[$collaborated] = $collaborated;

      }
      $_SESSION["collaborated_with"] = $collaborated_with;
    }

    if(isset($_POST["relationship_influenced"])){
      foreach ($_POST["relationship_influenced"] as $influenced) {
        $influenced_by[$influenced] = $influenced;

      }
      $_SESSION["influenced_by"] = $influenced_by;
    }

    // if(isset($_POST["influenced_start_date"]) && !empty($_POST["influenced_start_date"])){
    //   $_SESSION["influenced_start_date"] = $_POST["influenced_start_date"];
    //   $influenced_sd = $_POST["influenced_start_date"];
    // }
    //
    // if(isset($_POST["influenced_end_date"]) && !empty($_POST["influenced_end_date"])){
    //   $_SESSION["influenced_end_date"] = $_POST["influenced_end_date"];
    //   $influenced_ed = $_POST["influenced_end_date"];
    // }
    //
    // if(isset($_POST["influenced_duration_years"]) && !empty($_POST["influenced_duration_years"])){
    //   $_SESSION["influenced_duration_years"] = $_POST["influenced_duration_years"];
    //   $influenced_years = $_POST["influenced_duration_years"];
    // }
    //
    // if(isset($_POST["influenced_duration_months"]) && !empty($_POST["influenced_duration_months"])){
    //   $_SESSION["influenced_duration_months"] = $_POST["influenced_duration_months"];
    //   $influenced_months = $_POST["influenced_duration_months"];
    // }

    $artist_id_map = array();
    foreach ($first_name as $key => $value) {
      $artist_id_map[$value.$last_name[$key].$email_address[$key].$website[$key]] = -1;
    }

    /*************/

    include 'connection_open.php';

    $query = "SELECT artist_first_name, artist_last_name, artist_email_address, artist_website, artist_profile_id FROM artist_profile WHERE ";
    foreach($first_name as $key => $value){
      $query .= "(artist_first_name = '".$value."' AND artist_last_name = '".$last_name[$key]."' AND artist_email_address = '".$email_address[$key]."' AND artist_website = '".$website[$key]."') OR ";
    }

    $query = substr($query, 0, -3);
    $result = mysqli_query($dbc,$query) or die('Error querying database.: '  .mysqli_error($dbc));

    while($row = mysqli_fetch_assoc($result)){
      if($artist_id_map[$row["artist_first_name"].$row["artist_last_name"].$row["artist_email_address"].$row["artist_website"]] == -1){
        $artist_id_map[$row["artist_first_name"].$row["artist_last_name"].$row["artist_email_address"].$row["artist_website"]] = $row["artist_profile_id"];
      }
    }

    if(count($first_name) > mysqli_num_rows($result)){
      $artists = array();
      $query = "INSERT INTO artist_profile (artist_first_name, artist_last_name, artist_email_address, artist_website, is_user_artist) VALUES ";
      foreach ($first_name as $key => $value) {
        if($artist_id_map[$value.$last_name[$key].$email_address[$key].$website[$key]] == -1){
          $artists[] = "('".$value."', '".$last_name[$key]."', '".$email_address[$key]."', '".$website[$key]."', 'other')";
        }
      }
      $query .= implode(',', $artists);
      $result = mysqli_query($dbc,$query) or die('Error querying database.: '  .mysqli_error($dbc));

      $query = "SELECT artist_first_name, artist_last_name, artist_email_address, artist_website, artist_profile_id FROM artist_profile WHERE ";
      foreach($first_name as $key => $value){
        $query .= "(artist_first_name = '".$value."' AND artist_last_name = '".$last_name[$key]."' AND artist_email_address = '".$email_address[$key]."' AND artist_website = '".$website[$key]."') OR ";
      }

      $query = substr($query, 0, -3);
      $result = mysqli_query($dbc,$query) or die('Error querying database.: '  .mysqli_error($dbc));

      while($row = mysqli_fetch_assoc($result)){
        if($artist_id_map[$row["artist_first_name"].$row["artist_last_name"].$row["artist_email_address"].$row["artist_website"]] == -1){
          $artist_id_map[$row["artist_first_name"].$row["artist_last_name"].$row["artist_email_address"].$row["artist_website"]] = $row["artist_profile_id"];
        }
      }
    }

    /*$query = "DELETE FROM artist_relation WHERE artist_profile_id_1='".$_SESSION['artist_profile_id']."'";
    $result = mysqli_query($dbc,$query) or die('Error querying database.: '  .mysqli_error($dbc));*/

    $query = "INSERT INTO artist_relation (artist_profile_id_1, artist_profile_id_2, artist_name_1, artist_name_2, artist_email_id_2,
              artist_website_2, artist_relation, start_date, end_date, duration_years, duration_months) VALUES ";

    foreach($first_name as $key => $value){

      if(isset($studied_under[$key])){
        $relations[] = "('".$_SESSION['artist_profile_id']."', '".$artist_id_map[$value.$last_name[$key].$email_address[$key].$website[$key]]."',
                       '".$_SESSION['artist_first_name']."-".$_SESSION['artist_last_name']."',
                       '".$value."-".$last_name[$key]."', '$email_address[$key]', '$website[$key]', 'Studied With', '',
                       '', '', '')";

      }

      if(isset($danced_with[$key])){
        $relations[] = "('".$_SESSION['artist_profile_id']."', '".$artist_id_map[$value.$last_name[$key].$email_address[$key].$website[$key]]."',
                       '".$_SESSION['artist_first_name']."-".$_SESSION['artist_last_name']."',
                       '".$value."-".$last_name[$key]."', '$email_address[$key]', '$website[$key]', 'Danced For', '',
                       '', '', '')";

      }

      if(isset($collaborated_with[$key])){
        $relations[] = "('".$_SESSION['artist_profile_id']."', '".$artist_id_map[$value.$last_name[$key].$email_address[$key].$website[$key]]."',
                       '".$_SESSION['artist_first_name']."-".$_SESSION['artist_last_name']."',
                       '".$value."-".$last_name[$key]."', '$email_address[$key]', '$website[$key]', 'Collaborated With', '',
                       '', '', '')";

      }

      if(isset($influenced_by[$key])){
        $relations[] = "('".$_SESSION['artist_profile_id']."', '".$artist_id_map[$value.$last_name[$key].$email_address[$key].$website[$key]]."',
                       '".$_SESSION['artist_first_name']."-".$_SESSION['artist_last_name']."',
                       '".$value."-".$last_name[$key]."', '$email_address[$key]', '$website[$key]', 'Influenced By', '',
                       '', '', '')";
                       
      }
    }
    if($relations == null){

    }else{
        $query .= implode(',', $relations);
        /*$query .= " ON DUPLICATE KEY UPDATE artist_name_1 = VALUES(artist_name_1), artist_name_2 = VALUES(artist_name_2),
              artist_email_id_2 = VALUES(artist_email_id_2), artist_website_2 = VALUES(artist_website_2), start_date = VALUES(start_date),
              end_date = VALUES(end_date), duration_years = VALUES(duration_years), duration_months=VALUES(duration_months)";*/
        echo $query;
        $result = mysqli_query($dbc,$query) or die('Error querying database.: '  .mysqli_error($dbc));
    }

  }
  if($_SESSION["timeline_flow"] == "artist_add"){
      //header("Location: thank_you.php");
      $location = "thank_you.php";
  }else{
     //header("Location: add_user_profile.php");
        $location = "thank_you.php";
  }
//echo ("<script>location.href='$location'</script>");?>
?>
