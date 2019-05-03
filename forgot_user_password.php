<?php
include 'util.php';
my_session_start();
if($_SESSION["user_type"] == "Admin")
{
	include 'admin_menu.php';
}else{
	include 'menu.php';
}
?>
<html>
<head>
    <title>Password Reset</title>
    <script src="set_password_validation.js"></script>
</head>

<body>
<div class="row">
    <div class="medium-8 column">
        <section>
            <form id="add_user_profile_form" name="add_user_profile_form" method="post" action="forgot_user_password_mediator.php" onsubmit="return validateSetForm()" enctype="multipart/form-data">
                <fieldset>
                    <legend><strong>Forgot your password?</legend></strong>

                    <?php
                    if(isset($_SESSION["email_doesn't_exist"])){
                        echo "<font color=red>".$_SESSION["email_doesn't_exist"]."</font>";
                        // unset($_SESSION["email_doesn't_exist"]);
                    }
                    ?>

                    <div class="row">
                        <div class="small-12 column">
                            <label for="user_email_address">Email Address <large style="color:red;font-weight: bold;"> *</large>
                                <input  type="email" autocomplete="off" type="text" id="user_email_address" name="user_email_address" required placeholder = "Email Address" value = <?php
                                if(isset($_SESSION["incorrect_email"])) {
                                    echo $_SESSION["incorrect_email"];
                                    //my_session_unset();
                                }
                                ?> >
                            </label>
                        </div>
                        <div class="small-12 column">
                            <button class="secondary hollow button" type="submit" name="password_change_submit">
                                <span>Request Change Password</span>
                            </button>
                            <?php
                            if(isset($_SESSION["incorrect_email"])) {
                                echo '<a href="add_user_profile.php" style="float:right;margin-top: 9px"><u>Create New Account</u></a>';
                                my_session_unset();
                            }
                            ?>
                        </div>
                    </div>
                </fieldset>
            </form>
        </section>
    </div>
</div>
</body>

<?php
include 'footer.php';
?>
</html>