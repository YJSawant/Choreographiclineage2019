<?php
include 'util.php';
my_session_start();
if($_SESSION["user_type"] == "Admin")
{
	include 'admin_menu.php';
}else{
	include 'menu.php';
}
include 'connection_open.php';
$user_email_address =  mysqli_real_escape_string($dbc,$_POST['user_email_address']);
$user_one_time_password =  mysqli_real_escape_string($dbc,$_POST['user_one_time_password']);
$user_new_password =  mysqli_real_escape_string($dbc,$_POST['user_new_password']);
$query = "SELECT * FROM user_profile
WHERE user_email_address='$user_email_address' AND user_one_time_password='$user_one_time_password'";
$result = mysqli_query($dbc,$query)
or die('Error querying database.: '  .mysqli_error($dbc));
$count=mysqli_num_rows($result);
$count = 1;
if($count==1){
    // echo "Password Set";
    $user_one_time_password = rand(100000, 999999);
    $query = "UPDATE user_profile
	SET user_password='$user_new_password', user_one_time_password='$user_one_time_password'
	WHERE user_email_address='$user_email_address'";
    $result = mysqli_query($dbc,$query)
    or die('Error querying database.: '  .mysqli_error($dbc));
    include 'connection_close.php';
    $passwordSet = true;
}
else{
    $query = "SELECT * FROM user_profile
	WHERE user_email_address='$user_email_address'";
    $result = mysqli_query($dbc,$query)
    or die('Error querying database.: '  .mysqli_error($dbc));
    $count=mysqli_num_rows($result);
    if($count==1){
        $_SESSION["email"] = $user_email_address;
        $_SESSION["set_user_password"]="Incorrect one-time password! Please check your email or request new one-time password!";
        $_SESSION["error_flag"] = "y";
    }
    else{
        $_SESSION["email"] = $user_email_address;
        $_SESSION["set_user_password"]="Profile Does Not Exists! Please check your email address!";
        $_SESSION["error_flag"] = "y";
    }
    include 'connection_close.php';
    header('Location: set_user_password.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Password Set</title>
</head>
<body>

<body>
<div class="confirmation_container">
    <div class="row">
        <div class="small-12 medium-8 large-8 small-centered columns">
            <h2 class="text-center">
                <strong><?php
                    if($passwordSet){
                        echo "PASSWORD SET SUCCESSFULLY";
                        $_SESSION["user_email_address"] = $user_email_address;
                        $_SESSION["user_password"] = $user_new_password;
                    }else
                    ?><br>
                </strong>
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="small-12 medium-8 large-8 small-centered columns">
            <h4 class="text-center"><em>Thank You for joining Choreographic Lineage!! You will now be able to contribute your lineage.</em></h4>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="button_container small-12 medium-8 large-4 small-centered columns">
            <a href="login_mediator.php" class="button expanded radius text-center">Contribute Your Lineage</a>
        </div>
    </div>
</div>
</div>
</body>

</body>
</html>