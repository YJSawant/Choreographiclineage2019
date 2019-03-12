<?php
include 'path.php';
include 'menu.php';
include 'util.php';
my_session_start();
include 'connection_open.php';
if(isset($_SESSION["user_password"])){
    console.log("user password was set");
    $user_password = $_SESSION["user_password"];
    $user_email_address =  $_SESSION['user_email_address'];
}
else{
    $user_email_address = $_POST['user_email_address'];
    $user_password =  mysqli_real_escape_string($dbc,$_POST['user_password']);
}


$query = "SELECT * FROM user_profile
	WHERE user_email_address='$user_email_address' and user_password='$user_password'";
$result = mysqli_query($dbc,$query)
or die('Error querying database.: '  .mysqli_error());
#$data = mysqli_fetch_array($result);

$count=mysqli_num_rows($result);
if($count==1){
    $_SESSION["user_email_address"] = $user_email_address;
    $firstrow = mysqli_fetch_assoc($result);
    
    $_SESSION["user_firstname"] = $firstrow["user_first_name"];
    $_SESSION["user_lastname"] = $firstrow["user_last_name"];
    $_SESSION["user_id"] = $firstrow["user_id"];
    //echo "Logged in as: ".$user_email_address;
    if($firstrow['user_type']=='User')
     $location = "profiles.php";
    else
     $location = "AdminIndex.php";
}
else{
    $_SESSION["login_message"] = "Incorrect credentials!";
    $location = "add_user_profile.php";
}
include 'connection_close.php';
//header("location: ".$location."");
echo ("<script>location.href='$location'</script>");
?>
