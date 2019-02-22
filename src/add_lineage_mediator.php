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
    $studied_sd = array();
    $studied_ed = array();
    $studied_years = array();
    $studied_months = array();
    $danced_sd = array();
    $danced_ed = array();
    $danced_years = array();
    $danced_months = array();
    $collaborated_sd = array();
    $collaborated_ed = array();
    $collaborated_years = array();
    $collaborated_months = array();
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

    // Studied related post variables
    if(isset($_POST["studied_from_months"]) && isset($_POST["studied_from_years"])
        && !empty($_POST["studied_from_months"]) && !empty($_POST["studied_from_years"])
        && isset($_POST["studied_to_months"]) && isset($_POST["studied_to_years"])
        && !empty($_POST["studied_to_months"]) && !empty($_POST["studied_to_years"])){

        $len = count($_POST["studied_from_months"]);
        for( $i = 0; $i<$len; $i++){

            if($_POST["studied_from_years"][$i] == "" || $_POST["studied_to_years"][$i]=="")
                continue;

            $_SESSION["studied_start_date"][] = $_POST["studied_from_years"][$i].'-'.$_POST["studied_from_months"][$i].'-1';
            $studied_sd[] = $_POST["studied_from_years"][$i].'-'.$_POST["studied_from_months"][$i].'-1';

            $_SESSION["studied_end_date"][] = $_POST["studied_to_years"][$i].'-'.$_POST["studied_to_months"][$i].'-1';
            $studied_ed[] = $_POST["studied_to_years"][$i].'-'.$_POST["studied_to_months"][$i].'-1';

            if($_POST["studied_to_months"][$i] > $_POST["studied_from_months"][$i]){
              $_SESSION["studied_duration_years"][] = $_POST["studied_to_years"][$i] - $_POST["studied_from_years"][$i];
              $_SESSION["studied_duration_months"][] = $_POST["studied_to_months"][$i] - $_POST["studied_from_months"][$i];
              $studied_years[] = $_POST["studied_to_years"][$i] - $_POST["studied_from_years"][$i];
              $studied_months[] = $_POST["studied_to_months"][$i] - $_POST["studied_from_months"][$i];
            }
            else{
                $_SESSION["studied_duration_years"][] = $_POST["studied_to_years"][$i] - $_POST["studied_from_years"][$i]-1;
                $_SESSION["studied_duration_months"][] = 12 - ($_POST["studied_from_months"][$i] - $_POST["studied_to_months"][$i]);
                $studied_years[] = $_POST["studied_to_years"][$i] - $_POST["studied_from_years"][$i] -1;
                $studied_months[] = 12 - ($_POST["studied_from_months"][$i] - $_POST["studied_to_months"][$i]);
            }
        }
    }

    if(isset($_POST["studied_duration_from_years"]) && isset($_POST["studied_duration_to_years"])
          && !empty($_POST["studied_duration_from_years"]) && !empty($_POST["studied_duration_to_years"])){
        $len = count($_POST["studied_duration_from_years"]);
        for( $i = 0; $i<$len; $i++){

            if($_POST["studied_duration_from_years"][$i] == "" || $_POST["studied_duration_to_years"][$i]=="")
                continue;

            $_SESSION["studied_start_date"][] = $_POST["studied_duration_from_years"][$i].'-01-01';
            $_SESSION["studied_end_date"][] = $_POST["studied_duration_to_years"][$i].'-01-01';
            $_SESSION["studied_duration_years"][] = $_POST["studied_duration_years"][$i];
            $_SESSION["studied_duration_months"][] = $_POST["studied_duration_months"][$i];

            $studied_years[] = $_POST["studied_duration_years"][$i];
            $studied_months[] = $_POST["studied_duration_months"][$i];
            $studied_sd[] = $_POST["studied_duration_from_years"][$i].'-01-01';
            $studied_ed[] = $_POST["studied_duration_to_years"][$i].'-01-01';
        }
    }

    // Danced related post variables
    if(isset($_POST["danced_from_months"]) && isset($_POST["danced_from_years"])
        && !empty($_POST["danced_from_months"]) && !empty($_POST["danced_from_years"])
        && isset($_POST["danced_to_months"]) && isset($_POST["danced_to_years"])
        && !empty($_POST["danced_to_months"]) && !empty($_POST["danced_to_years"])){

        $len = count($_POST["danced_from_months"]);
        for( $i = 0; $i<$len; $i++){

            if($_POST["danced_from_months"][$i] == "" || $_POST["danced_to_months"][$i]=="")
                continue;

            $_SESSION["danced_start_date"][] = $_POST["danced_from_years"][$i].'-'.$_POST["danced_from_months"][$i].'-1';
            $danced_sd[] = $_POST["danced_from_years"][$i].'-'.$_POST["danced_from_months"][$i].'-1';

            $_SESSION["danced_end_date"][] = $_POST["danced_to_years"][$i].'-'.$_POST["danced_to_months"][$i].'-1';
            $danced_ed[] = $_POST["danced_to_years"][$i].'-'.$_POST["danced_to_months"][$i].'-1';

            if($_POST["danced_to_months"][$i] > $_POST["danced_from_months"][$i]){
                $_SESSION["danced_duration_years"][] = $_POST["danced_to_years"][$i] - $_POST["danced_from_years"][$i];
                $_SESSION["danced_duration_months"][] = $_POST["danced_to_months"][$i] - $_POST["danced_from_months"][$i];
                $danced_years[] = $_POST["danced_to_years"][$i] - $_POST["danced_from_years"][$i];
                $danced_months[] = $_POST["danced_to_months"][$i] - $_POST["danced_from_months"][$i];
            }
            else{
                $_SESSION["danced_duration_years"][] = $_POST["danced_to_years"][$i] - $_POST["danced_from_years"][$i]-1;
                $_SESSION["danced_duration_months"][] = 12 - ($_POST["danced_from_months"][$i] - $_POST["danced_to_months"][$i]);
                $danced_years[] = $_POST["danced_to_years"][$i] - $_POST["danced_from_years"][$i] -1;
                $danced_months[] = 12 - ($_POST["danced_from_months"][$i] - $_POST["danced_to_months"][$i]);
            }
        }
    }

    if(isset($_POST["danced_duration_from_years"]) && isset($_POST["danced_duration_to_years"])
        && !empty($_POST["danced_duration_from_years"]) && !empty($_POST["danced_duration_to_years"])){
        $len = count($_POST["danced_duration_from_years"]);
        for( $i = 0; $i<$len; $i++){

            if($_POST["danced_duration_from_years"][$i] == "" || $_POST["danced_duration_to_years"][$i]=="")
                continue;

            $_SESSION["danced_start_date"][] = $_POST["danced_duration_from_years"][$i].'-01-01';
            $_SESSION["danced_end_date"][] = $_POST["danced_duration_to_years"][$i].'-01-01';
            $_SESSION["danced_duration_years"][] = $_POST["danced_duration_years"][$i];
            $_SESSION["danced_duration_months"][] = $_POST["danced_duration_months"][$i];

            $danced_years[] = $_POST["danced_duration_years"][$i];
            $danced_months[] = $_POST["danced_duration_months"][$i];
            $danced_sd[] = $_POST["danced_duration_from_years"][$i].'-01-01';
            $danced_ed[] = $_POST["danced_duration_to_years"][$i].'-01-01';
        }
    }

      // Collaborated related post variables
    if(isset($_POST["collaborated_from_months"]) && isset($_POST["collaborated_from_years"])
        && !empty($_POST["collaborated_from_months"]) && !empty($_POST["collaborated_from_years"])
        && isset($_POST["collaborated_to_months"]) && isset($_POST["collaborated_to_years"])
        && !empty($_POST["collaborated_to_months"]) && !empty($_POST["collaborated_to_years"])){

        $len = count($_POST["collaborated_from_months"]);
        for( $i = 0; $i<$len; $i++){

            if($_POST["collaborated_from_years"][$i] == "" || $_POST["collaborated_to_years"][$i]=="")
                continue;

            $_SESSION["collaborated_start_date"][] = $_POST["collaborated_from_years"][$i].'-'.$_POST["collaborated_from_months"][$i].'-1';
            $collaborated_sd[] = $_POST["collaborated_from_years"][$i].'-'.$_POST["collaborated_from_months"][$i].'-1';

            $_SESSION["collaborated_end_date"][] = $_POST["collaborated_to_years"][$i].'-'.$_POST["collaborated_to_months"][$i].'-1';
            $collaborated_ed[] = $_POST["collaborated_to_years"][$i].'-'.$_POST["collaborated_to_months"][$i].'-1';

            if($_POST["collaborated_to_months"][$i] > $_POST["collaborated_from_months"][$i]){
                $_SESSION["collaborated_duration_years"][] = $_POST["collaborated_to_years"][$i] - $_POST["collaborated_from_years"][$i];
                $_SESSION["collaborated_duration_months"][] = $_POST["collaborated_to_months"][$i] - $_POST["collaborated_from_months"][$i];
                $collaborated_years[] = $_POST["collaborated_to_years"][$i] - $_POST["collaborated_from_years"][$i];
                $collaborated_months[] = $_POST["collaborated_to_months"][$i] - $_POST["collaborated_from_months"][$i];
            }
            else{
                $_SESSION["collaborated_duration_years"][] = $_POST["collaborated_to_years"][$i] - $_POST["collaborated_from_years"][$i]-1;
                $_SESSION["collaborated_duration_months"][] = 12 - ($_POST["collaborated_from_months"][$i] - $_POST["collaborated_to_months"][$i]);
                $collaborated_years[] = $_POST["collaborated_to_years"][$i] - $_POST["collaborated_from_years"][$i] -1;
                $collaborated_months[] = 12 - ($_POST["collaborated_from_months"][$i] - $_POST["collaborated_to_months"][$i]);
            }
        }
    }

    if(isset($_POST["collaborated_duration_from_years"]) && isset($_POST["collaborated_duration_to_years"])
        && !empty($_POST["collaborated_duration_from_years"]) && !empty($_POST["collaborated_duration_to_years"])){
        $len = count($_POST["collaborated_duration_from_years"]);
        for( $i = 0; $i<$len; $i++){

            if($_POST["collaborated_duration_from_years"][$i] == "" || $_POST["collaborated_duration_to_years"][$i]=="")
                continue;

            $_SESSION["collaborated_start_date"][] = $_POST["collaborated_duration_from_years"][$i].'-01-01';
            $_SESSION["collaborated_end_date"][] = $_POST["collaborated_duration_to_years"][$i].'-01-01';
            $_SESSION["collaborated_duration_years"][] = $_POST["collaborated_duration_years"][$i];
            $_SESSION["collaborated_duration_months"][] = $_POST["collaborated_duration_months"][$i];

            $collaborated_years[] = $_POST["collaborated_duration_years"][$i];
            $collaborated_months[] = $_POST["collaborated_duration_months"][$i];
            $collaborated_sd[] = $_POST["collaborated_duration_from_years"][$i].'-01-01';
            $collaborated_ed[] = $_POST["collaborated_duration_to_years"][$i].'-01-01';
        }
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
      if(($studied_months[$key] != 0 || $studied_years[$key] != 0) && ($studied_months[$key] != "" || $studied_years[$key] != "")) {
          $len = count($studied_sd);
          for ($i = 0; $i < $len; $i++) {
              $relations[] = "('" . $_SESSION['artist_profile_id'] . "', '" . $artist_id_map[$value . $last_name[$key] . $email_address[$key] . $website[$key]] . "',
                       '" . $_SESSION['artist_first_name'] . "-" . $_SESSION['artist_last_name'] . "',
                       '" . $value . "-" . $last_name[$key] . "', '$email_address[$key]', '$website[$key]', 'Studied With', '" . $studied_sd[$i] . "',
                       '" . $studied_ed[$i] . "', '" . $studied_years[$i] . "', '" . $studied_months[$i] . "')";
          }
      }
      if(($danced_months[$key] != 0 || $danced_years[$key] != 0) && ($danced_months[$key] != "" || $danced_years[$key] != "")){
        $len = count($danced_sd);
        for ($i = 0; $i < $len; $i++) {
            $relations[] = "('" . $_SESSION['artist_profile_id'] . "', '" . $artist_id_map[$value . $last_name[$key] . $email_address[$key] . $website[$key]] . "',
                           '" . $_SESSION['artist_first_name'] . "-" . $_SESSION['artist_last_name'] . "',
                           '" . $value . "-" . $last_name[$key] . "', '$email_address[$key]', '$website[$key]', 'Danced For', '" . $danced_sd[$i] . "',
                           '" . $danced_ed[$i] . "', '" . $danced_years[i] . "', '" . $danced_months[$i] . "')";
        }
      }
      if(($collaborated_months[$key] != 0 || $collaborated_years[$key] != 0) && ($collaborated_months[$key] != "" || $collaborated_years[$key] != "")){
        $len = count($collaborated_sd);
        for ($i = 0; $i < $len; $i++) {
            $relations[] = "('" . $_SESSION['artist_profile_id'] . "', '" . $artist_id_map[$value . $last_name[$key] . $email_address[$key] . $website[$key]] . "',
                           '" . $_SESSION['artist_first_name'] . "-" . $_SESSION['artist_last_name'] . "',
                           '" . $value . "-" . $last_name[$key] . "', '$email_address[$key]', '$website[$key]', 'Collaborated With', '" . $collaborated_sd[$i] . "',
                           '" . $collaborated_ed[$i] . "', '" . $collaborated_years[$i] . "', '" . $collaborated_months[$i] . "')";
        }
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
echo ("<script>location.href='$location'</script>");?>
?>
