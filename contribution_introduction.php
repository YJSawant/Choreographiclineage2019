<?php
include 'util.php';
my_session_start();
if($_SESSION["user_type"] == "Admin")
{
	include 'admin_menu.php';
}else{
	include 'menu.php';
}
if(isset($_SESSION["user_email_address"])){
}else{
    $location = "add_user_profile.php";
    echo("<script>location.href='$location'</script>");
}

?>

<html>
<head>
    <title>Contribution Welcome Page</title>
</head>
<body>

<div class="row">
    <div class="column small-12">
        <legend><strong>Welcome</strong></legend>
        <p>Thank you in advance for contributing your lineage. Your contribution is vital to
            building a global resource for dance. The amount of time it will take to fill out
            this form will vary depending on how many artists you include in your lineage. We
            encourage you to take time to include all of the people you have studied under, danced
            in the work of, collaborated with and been influenced by so that this resource can most accurately
            represent the rich network of our field. You can complete your lineage over time by saving it and coming back to finish it when you are ready.</p>
    </div>
</div>
<div class="row">
    <div class="column small-12">
        <p>See the network: <a href="lineage_index.php">Click Here</a></p>
    </div>
</div>

<form id="contribution_form" name="contribution_form" method="post" action="contribution_introduction_mediator.php" enctype="multipart/form-data">
    <div class="row">
        <!-- <fieldset> -->
            <!-- <legend class="column"><strong>Contribution Method</strong></legend>
            <div class="column small-6">
                <label>
                    <input type="radio" id="contribute_online" name="contribute_online_form" class="contribute_online_form" value="form" checked>
                    Contribute lineage via this online form
                </label>
            </div>
            <div class="column small-6">
                <label>
                    <input type="radio" id="contribute_phone" name="contribute_online_form" class="contribute_online_form" value="phone">
                    Contribute lineage via phone
                </label>
            </div> -->


            <div class="column" style="display:none;margin-bottom:1%"  id="contribution_type" name="contribution_type">
                <legend><strong>Contribution Type</strong></legend>
                <div>
                    <label>
                        <input type="radio" id="contribute_own_lineage" name="contribute_lineage" class="contribute_lineage" value="own" checked>
                        I am contributing my own lineage
                    </label>
                </div>
                <div>
                    <label>
                        <input type="radio" id="contribute_another_artist_lineage" name="contribute_lineage" class="contribute_lineage" value="another">
                        I am contributing lineage for another artist
                    </label>
                </div>
            </div>

            <div class="large-12 column">
                <button class="primary button" type="submit" name="login_submit" id="enter">
                    <span>Begin</span>
                </button>
            </div>
            <!-- </fieldset> -->
    </div>
    </div>
</form>
</body>
<?php
include 'footer.php';
?>

<script>
    $(function() {
        var url = window.location.href;
        if(url.search("contribution_introduction.php"))
        {
            var lineage_contri = document.getElementById("contri_lineage");
            $(lineage_contri).addClass('active');
        }
    });
</script>

</html>
