<?php
include 'path.php';
include 'menu.php';
include 'util.php';
my_session_start();
if(isset($_SESSION["user_email_address"])){

}else{
    $location = "add_user_profile.php";
    echo("<script>location.href='$location'</script>");
}
// $contribution_method = $_POST['contribute_online_form'];
//$contribution_method = $_POST['contribute_type'];

// $contribution_type = $_POST['contribute_lineage'];
$contribution_type="own";

//if($contribution_method=="form"){         

    if($contribution_type == "own") {
        $_SESSION["contribution_type"] = "own";
        $_SESSION["profile_selection"] = "artist";
        $_SESSION["timeline_flow"]="edit";

    }
    else if($contribution_type == "another") {
        $_SESSION["contribution_type"] = "another";
        $_SESSION["profile_selection"] = "other";
    }
     echo ("<script>location.href='add_artist_profile.php'</script>");            

//}
// else if($contribution_method=="phone"){
//     echo ("<script>location.href='phone_contribution.php'</script>");
// }
?>