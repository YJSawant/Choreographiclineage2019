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
            encourage you to take time to include all of the people you have studied with, danced
            for, collaborated with and been influenced by so that this resource can most accurately
            represent the rich network of our field. You can complete your lineage over time by saving it and coming back to finish it when you are ready.</p>
    </div>
</div>
<div class="row">
    <div class="column small-12">
        <p>See the network: <a href="#">http://www.choreagraphiclineage.buffalo.edu/Network/index.html</a></p>
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


            <div class="column" style="margin-bottom:1%"  id="contribution_type" name="contribution_type">
                <legend><strong>Contribution Type</strong></legend>
                <div>
                    <label>
                        <input type="radio" id="contribute_own_lineage" name="contribute_lineage" class="contribute_lineage" value="own">
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
                <button class="primary button" type="submit" name="login_submit">
                    <span>Next Page</span>
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

<!-- <script>
    $("#contribute_online").click(function() {
        $("#contribution_type").show();
    });
    $("#contribute_phone").click(function() {
        $("#contribution_type").hide();
    });
</script> -->

<script>
    $(function() {
        // this will get the full URL at the address bar
        var url = window.location.href;
        if(url.search("Contribution_Introduction.php"))
        {
            var lineage_contri = document.getElementById("contri_lineage");
            $(lineage_contri).addClass('active');
        }
    }); 
</script>

</html>