<?php
include 'path.php';
include 'menu.php';
include 'util.php';
my_session_start();
$prepopulated = "false";

if(isset($_SESSION["user_email_address"])){
    $user_email_address = $_SESSION["user_email_address"];
    $user_lastname = $_SESSION["user_lastname"];
    $user_firstname = $_SESSION["user_firstname"];
    if(isset($_SESSION["timeline_flow"]) &&  ($_SESSION['timeline_flow'] == "edit" || $_SESSION['timeline_flow'] == "view")) {
     	$prepopulated = "true";
        $user_email_address = $_SESSION["artist_email_address"];
        $user_lastname = $_SESSION["artist_last_name"];
        $user_firstname = $_SESSION["artist_first_name"];
    }

    if(isset($_SESSION['timeline_flow']) &&  $_SESSION['timeline_flow'] == "view") {
        echo "<script>var disabled_input=true;</script>";
    }else{
        echo "<script>var disabled_input=false;</script>";
    }
}
if(isset($_SESSION["contribution_type"])) {
    $contribution_form_type = $_SESSION["contribution_type"];
}
?>

<html>
<?php if(isset($_SESSION["user_email_address"])): ?>
    <head>
        <title>Add Artist</title>
    </head>

    <body>
    <form id="add_user_profile_form" name="add_user_profile_form" method="post" action="add_artist_personal_information.php" enctype="multipart/form-data">
        <div class="row">
            <div class="progress" role="progressbar" tabindex="0" aria-valuenow="10" aria-valuemin="0" aria-valuetext="10 percent" aria-valuemax="100">
				  <span class="progress-meter" style="width: 10%">
				    <p class="progress-meter-text">10%</p>
				  </span>
            </div>
        </div>

        <div class="row">
            <div class="medium-10 column">
                <section>
                    <fieldset>
                        <!--<legend><strong>Adding artist profile</strong></legend>-->
                        <legend><strong><?php echo (($_SESSION['contribution_type'] == "own")?'You :':'Adding artist profile :') ?></strong></legend>
                        <div class="row">
                            <div class="medium-4 column">
                                <!--<label for="artist_first_name">First Name of Artist</span> <span style="color:red;font-weight: bold;"> *</span>-->
                                    <label for="artist_first_name"><?php echo (($_SESSION['contribution_type'] == "own")?'Your First Name':'First Name of Artist') ?></span> <span style="color:red;font-weight: bold;"> *</span>
                                    <input  value="<?php echo (($_SESSION['contribution_type'] == "own")?$_SESSION['user_firstname']:'') ?>" autocomplete="off" type="text" id="artist_first_name" name="artist_first_name" placeholder="First Name" required>
                                </label>
                            </div>
                            <div class="medium-4 column">
                                <!--<label for="artist_last_name">Last Name <span class="other_artist">of Artist</span> <span style="color:red;font-weight: bold;"> *</span>-->
                                    <label for="artist_last_name"><?php echo (($_SESSION['contribution_type'] == "own")?'Your Last Name':'Last Name of Artist') ?></span> <span style="color:red;font-weight: bold;"> *</span>
                                    <input  value="<?php echo (($_SESSION['contribution_type'] == "own")?$_SESSION['user_lastname']:'') ?>" autocomplete="off" type="text" id="artist_last_name" name="artist_last_name" placeholder="Last Name" required>
                                </label>
                            </div>
                            <div class="medium-4 column">
                                <!--<label for="artist_email_address">Email Address <span class="other_artist">of Artist</span>-->
                                    <label for="artist_email_address"><?php echo (($_SESSION['contribution_type'] == "own")?'Your Email Address':'Email Address of Artist') ?></span>
                                    <input  value="<?php echo (($_SESSION['contribution_type'] == "own")?$_SESSION['user_email_address']:'') ?>" autocomplete="off" type="text" id="artist_email_address" name="artist_email_address" placeholder="Email Address">
                                </label>
                            </div>
                    </fieldset>
                </section>
            </div>
        </div>

        <div id="other_artist_section">
            <div class="row">
                <fieldset class="large-6 columns">
                    <legend><strong>Is the Artist living or deceased?</strong></legend>
                    <input type="radio" name="artist_status" value="living" id="artist_living"
                        <?php
                        if(isset($_SESSION["artist_status"])){
                            echo (($_SESSION["artist_status"]=='living')?'checked':'');
                        }
                        ?>
                    />
                    <label for="artist_living">Living</label>
                    <input type="radio" name="artist_status" value="deceased" id="artist_deceased"
                        <?php
                        if(isset($_SESSION["artist_status"])){
                            echo (($_SESSION["artist_status"]=='deceased')?'checked':'');
                        }
                        ?>
                    />
                    <label for="artist_deceased">Deceased</label>
                </fieldset>
            </div>

            <div class="row">
                <div class="column large-6">
                    <div class="row date_section">
                        <div class="column medium-6">
                            <fieldset>
                                <legend><strong>Date of Birth</strong>  <span style="color:red;font-weight: bold;"> *</span><legend>
                                        <input type="date" value="<?php echo isset($_SESSION['date_of_birth'])?$_SESSION['date_of_birth']:'' ?>" class="span2" id="date_of_birth" name="date_of_birth" placeholder="yyyy-mm-dd">
                            </fieldset>
                        </div>
                        <div class="column medium-6" id="date_of_death_div" style="display:none">
                            <fieldset  >
                                <legend><strong>Date of Death</strong><span style="color:red;font-weight: bold;"> *</span><legend>
                                        <input type="date" value="<?php echo isset($_SESSION['date_of_death'])?$_SESSION['date_of_death']:'' ?>" class="span2" id="date_of_death" name="date_of_death" placeholder="yyyy-mm-dd" >
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="medium-10 column">
                <section>
                    <fieldset>
                        <legend><strong>Type of Artist</strong> <small>(check all that apply)</small></legend>
                        <div class="medium-3 column">
                            <label for="Actor_Artist_Type">
                                <input  value="Actor" autocomplete="off" type="checkbox" id="Actor_Artist_Type" name="artist_genre[]"
                                    <?php
                                    if(isset($_SESSION['artist_genre'])){
                                        echo (strpos($_SESSION['artist_genre'], 'Actor')?'checked':'');
                                    }
                                    ?>
                                />
                                Actor
                            </label>
                        </div>
                        <div class="medium-3 column">
                            <label for="Choreographer_Artist_Type">
                                <input  value="Choreographer" autocomplete="off" type="checkbox" id="Choreographer_Artist_Type" name="artist_genre[]"
                                    <?php
                                    if(isset($_SESSION['artist_genre'])){
                                        echo (strpos($_SESSION['artist_genre'], 'Choreographer')?'checked':'');
                                    }
                                    ?>
                                />
                                Choreographer
                            </label>
                        </div>
                        <div class="medium-3 column">
                            <label for="Composer_Artist_Type">
                                <input  value="Composer" autocomplete="off" type="checkbox" id="Composer_Artist_Type" name="artist_genre[]"
                                    <?php
                                    if(isset($_SESSION['artist_genre'])){
                                        echo (strpos($_SESSION['artist_genre'], 'Composer')?'checked':'');
                                    }
                                    ?>
                                />
                                Composer
                            </label>
                        </div>
                        <div class="medium-3 column">
                            <label for="Costume_Designer_Artist_Type">
                                <input  value="Costume_Designer" autocomplete="off" type="checkbox" id="Costume_Designer_Artist_Type" name="artist_genre[]"
                                    <?php
                                    if(isset($_SESSION['artist_genre'])){
                                        echo (strpos($_SESSION['artist_genre'], 'Costume_Designer')?'checked':'');
                                    }
                                    ?>
                                />
                                Costume Designer
                            </label>
                        </div>
                        <div class="medium-3 column">
                            <label for="Dancer_Artist_Type">
                                <input  value="Dancer" autocomplete="off" type="checkbox" id="Dancer_Artist_Type" name="artist_genre[]"
                                    <?php
                                    if(isset($_SESSION['artist_genre'])){
                                        echo (strpos($_SESSION['artist_genre'], 'Dancer')?'checked':'');
                                    }
                                    ?>
                                />
                                Dancer
                            </label>
                        </div>
                        <div class="medium-3 column">
                            <label for="Filmmaker_Artist_Type">
                                <input  value="Filmmaker" autocomplete="off" type="checkbox" id="Filmmaker_Artist_Type" name="artist_genre[]"
                                    <?php
                                    if(isset($_SESSION['artist_genre'])){
                                        echo (strpos($_SESSION['artist_genre'], 'Filmmaker')?'checked':'');
                                    }
                                    ?>
                                />
                                Filmmaker
                            </label>
                        </div>
                        <div class="medium-3 column">
                            <label for="Lighting_Designer_Artist_Type">
                                <input  value="Lighting_Designer" autocomplete="off" type="checkbox" id="Lighting_Designer_Artist_Type" name="artist_genre[]"
                                    <?php
                                    if(isset($_SESSION['artist_genre'])){
                                        echo (strpos($_SESSION['artist_genre'], 'Lighting_Designer')?'checked':'');
                                    }
                                    ?>
                                />
                                Lighting Designer
                            </label>
                        </div>
                        <div class="medium-3 column">
                            <label for="Musician_Artist_Type">
                                <input  value="Musician" autocomplete="off" type="checkbox" id="Musician_Artist_Type" name="artist_genre[]"
                                    <?php
                                    if(isset($_SESSION['artist_genre'])){
                                        echo (strpos($_SESSION['artist_genre'], 'Musician')?'checked':'');
                                    }
                                    ?>
                                />
                                Musician
                            </label>
                        </div>
                        <div class="medium-3 column">
                            <label for="Poet_Artist_Type">
                                <input  value="Poet" autocomplete="off" type="checkbox" id="Poet_Artist_Type" name="artist_genre[]"
                                    <?php
                                    if(isset($_SESSION['artist_genre'])){
                                        echo (strpos($_SESSION['artist_genre'], 'Poet')?'checked':'');
                                    }
                                    ?>
                                />
                                Poet
                            </label>
                        </div>
                        <div class="medium-3 column">
                            <label for="Visual_Artist_Type">
                                <input  value="Visual_Artist" autocomplete="off" type="checkbox" id="Visual_Artist_Type" name="artist_genre[]"
                                    <?php
                                    if(isset($_SESSION['artist_genre'])){
                                        echo (strpos($_SESSION['artist_genre'], 'Visual_Artist')?'checked':'');
                                    }
                                    ?>
                                />
                                Visual Artist
                            </label>
                        </div>
                        <div class="medium-3 column">
                            <label for="Scenic_Designer_Artist_Type">
                                <input  value="Scenic_Designer" autocomplete="off" type="checkbox" id="Scenic_Designer_Artist_Type" name="artist_genre[]"
                                    <?php
                                    if(isset($_SESSION['artist_genre'])){
                                        echo (strpos($_SESSION['artist_genre'], 'Scenic_Designer')?'checked':'');
                                    }
                                    ?>
                                />
                                Scenic Designer
                            </label>
                        </div>
                        <div class="medium-3 column">
                            <label for="Other_Artist_Type">
                                <input  value="Other" autocomplete="off" type="checkbox" id="Other_Artist_Type" name="artist_genre[]"
                                    <?php
                                    if(isset($_SESSION['artist_genre'])){
                                        echo (strpos($_SESSION['artist_genre'], 'Other')?'checked':'');
                                    }
                                    ?>
                                />
                                Other
                            </label>
                        </div>
                        <div class="medium-3 column">
                            <label for="Other_Artist_Text_Input" id="Other_Artist_Text" style="display:none">
                                Please seperate multiple entries by comma:
                                <input  autocomplete="off" type="text" id="Other_Artist_Text_Input" name="other_artist_text_input"
                                        value="<?php echo isset($_SESSION['other_artist_text_input'])?$_SESSION['other_artist_text_input']:'' ?>"
                                />
                            </label>
                        </div>
                    </fieldset>
                </section>
            </div>
        </div>

        </div>
        <div class="row">
            <?php if(isset($_SESSION['artist_relation_add'])):?>
                <div class="large-2 small-8 columns">
                    <button class="primary button float-right" id="previous" type="button">
                        <span>Previous</span>
                    </button>
                </div>
            <?php else: ?>
                <div class="large-2 small-8 columns">
                    <button class="primary button float-right" type="button" name="home" id="home" onclick="saveAndBack()">
                        <span>Back to Profile</span>
                    </button>
                </div>
            <?php endif; ?>
            <div class="large-2 small-8 columns">
                <button class="primary button" id="next" type="submit">
                    <span><?php echo (($_SESSION['timeline_flow'] == "view")?"":"Save & ") ?>Next</span>
                </button>
            </div>
            <div class="column">
            </div>
        </div>
    </form>
    <script>
        function saveAndBack() {
            console.log($("#add_user_profile_form").serialize());
            $.ajax({
                type: "POST",
                url: 'save_add_artist_profile_back.php',
                data: $("#add_user_profile_form").serialize(),
                success: function() {
                    //success message mybe...
                    //alert("SUCCESS");
                },
                error: function (ErrorResponse) {
                    if (ErrorResponse.statusText == "OK") {
                    }
                    else {
                        alert("ErrorMsg:" + ErrorResponse.statusText);
                    }
                }
            });
            window.open('/src/add_user_profile.php','_self');
        }
        var prepopulated;
        var contribution_form_type;
        /*
        $(function(){
            $('#date_of_birth').fdatepicker({
                initialDate: '',
                format: 'yyyy-mm-dd',
                disableDblClickSelection: true,
                leftArrow:'<<',
                rightArrow:'>>',
                closeIcon:'X',
                closeButton: true
            });
        });
        $(function(){
            $('#date_of_death').fdatepicker({
                initialDate: '',
                format: 'yyyy-mm-dd',
                disableDblClickSelection: true,
                leftArrow:'<<',
                rightArrow:'>>',
                closeIcon:'X',
                closeButton: true
            });
        });
        */
        function artistStatusSelection(){
            if($('input[name="artist_status"]:checked').val() == "living"){
                $("#date_of_death").val("");
                $("#date_of_death_div").hide();
                $("#date_of_death").prop("required",false);
            }	else if ($('input[name="artist_status"]:checked').val() == "deceased") {
                $("#date_of_death_div").show();
                $("#date_of_death").prop("required",true);
            }
        }
        function fetchFields(){
            var first_name = "<?php echo $user_firstname ?>";
            var last_name = "<?php echo $user_lastname ?>";
            var email_address = "<?php echo $user_email_address ?>";
            $("#artist_first_name").val(first_name);
            $("#artist_last_name").val(last_name);
            $("#artist_email_address").val(email_address);
            console.log("TEST");
        }
        function artistTypeSelection(){
            if($("#Other_Artist_Type").is(":checked")){
                $("#Other_Artist_Text").show();
                $(".other_artist").show();
            }else{
                $("#Other_Artist_Text").hide();
                $("#Other_Artist_Text_Input").val("");
            }
        }
        $("#previous").click(function() {
            // onclick event is assigned to the #button element.
            window.open("/src/Contribution_Introduction.php","_self");
            //document.location.href = "/src/add_artist_personal_information.php",true;
        });
        // onclick event is assigned to the #button element.
        // $("#next").click(function() {
        // 	window.open("/src/add_artist_personal_information.php","_self");
        // });
        $(document).ready(function(){
            prepopulated = "<?php echo $prepopulated ?>";
            contribution_form_type = "<?php echo $contribution_form_type ?>";
            if(contribution_form_type == "another"){
                $("#other_artist_section").show();
                $(".other_artist").show();
                $("#date_of_birth").prop("required",true);
                $("#date_of_death_div").hide();
                $("#date_of_death").prop("required",false);

                //fetchFields();
            }
            else{
                // $("#date_of_death_div").hide();
                // $("#date_of_death").prop("required",false);
                $("#artist_first_name").prop("readonly",true);
                $("#artist_last_name").prop("readonly",true);
                $("#artist_email_address").prop("readonly",true);
                $("#other_artist_section").hide();
            }
            if(prepopulated == "true"){
            	console.log("SSS "  + prepopulated);
            	//profileSelection();
                fetchFields();
            	artistStatusSelection();
            	artistTypeSelection();
             }
             // else {
            // 	//$("input[name='profile_selection']").filter("[value='artist']").prop('checked',true);
            // 	 //$("#other_artist_section").hide();
            // 	 $("#artist_living").attr("checked",true);
            // 	 $("#date_of_death_div").hide();
            // 	 $("#Other_Artist_Text").hide();
            // 	 $(".other_artist").hide();
            // 	 fetchFields();
            // }
            //$("input[name='profile_selection']").click(profileSelection);
            $("#Other_Artist_Type").click(artistTypeSelection);
            $("input[name='artist_status']").click(artistStatusSelection);
            if(disabled_input){
                $('input').attr('disabled','true')
            }
        });
        $("#date_of_birth").change(function(){
            console.log("date_of_birth");
            var startDate = $(this).val();
            var endDate = $(this).closest('.date_section').find("#date_of_death").val();
            console.log(Date.parse(startDate) + " " + Date.parse(endDate));
            if(startDate != "" && endDate != ""){
                if ((Date.parse(startDate) >= Date.parse(endDate))) {
                    alert("Date of Death cannot be less than Date of Birth.");
                    $(this).val("");
                }
            }
        });
        $("#date_of_death").change(function(){
            console.log("date_of_death");
            var endDate = $(this).val();
            var startDate = $(this).closest('.date_section').find("#date_of_birth").val();
            console.log(Date.parse(startDate) + " " + Date.parse(endDate));
            if(startDate != "" && endDate != ""){
                if ((Date.parse(startDate) >= Date.parse(endDate))) {
                    alert("Date of Death cannot be less than Date of Birth.");
                    $(this).val("");
                }
            }
        });
    </script>
    <style>
        .button-group input{
            display: none;
        }
        .button-group label{
            width: 100%;
        }
        .button-group input:not(:checked) + label,
        .button-group input:not(:checked) + label:not(:active) {
            background-color: white;
            color: grey;
            border-color: grey;
        }
        .button-group input:checked + label,
        .button-group input:checked + label:active {
            background-color: darkgreen;
        }
    </style>
    </body>
<?php else: ?>
    <div class="row">
        <div style="text-align:center">
            <h3><strong>Please Login to access this page</strong></h3>
            <a href="/src/add_user_profile.php">Click here to login or create your new user</a>
        </div>
    </div>
<?php endif; ?>
<?php
include 'footer.php';
?>

</html>