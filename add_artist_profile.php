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
        $user_email_address = $_SESSION["user_email_address"];
        $user_lastname = $_SESSION["user_lastname"];
        $user_firstname = $_SESSION["user_firstname"];
    }

    if(isset($_SESSION['timeline_flow']) &&  $_SESSION['timeline_flow'] == "view") {
        echo "<script>var disabled_input=true;</script>";
    }else{
        echo "<script>var disabled_input=false;</script>";
    }
}
if(isset($_SESSION["contribution_type"])) {
    $contribution_form_type = $_SESSION["contribution_type"];
    if (isset($_SESSION["artist_first_name"])){
        $artist_fname=$_SESSION["artist_first_name"];
    }
    else{
        $artist_fname="";
    }
    if (isset($_SESSION["artist_last_name"])){
        $artist_lname=$_SESSION["artist_last_name"];
    }
    else{
        $artist_lname="";
    }
}

?>

<html>
<style>
.progressbar {
      counter-reset: step;
  }
  .progressbar li {
      list-style-type: none;
      width: 25%;
      float: left;
      font-size: 12px;
      position: relative;
      text-align: center;
      text-transform: uppercase;
      color: #7d7d7d;
  }
  .progressbar li:before {
      width: 30px;
      height: 30px;
      content: counter(step);
      counter-increment: step;
      line-height: 30px;
      border: 2px solid #7d7d7d;
      display: block;
      text-align: center;
      margin: 0 auto 10px auto;
      border-radius: 50%;
      background-color: white;
  }
  .progressbar li:after {
      width: 100%;
      height: 2px;
      content: '';
      position: absolute;
      background-color: #7d7d7d;
      top: 15px;
      left: -50%;
      z-index: -1;
  }
  .progressbar li:first-child:after {
      content: none;
  }
  .progressbar li.active {
      color: green;
  }
  .progressbar li.active:before {
      border-color: #55b776;
  }
  .progressbar li.active + li:after {
      background-color: #55b776;
  }

</style>

<?php if(isset($_SESSION["user_email_address"])): ?>
    <head>
        <title>Add Artist</title> 
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <style>  
           ul{  
                cursor:pointer;  
                list-style-type:none;
           }  
           </style>     
    </head>

    <body>
    <form id="add_user_profile_form" name="add_user_profile_form" method="post" action="add_artist_personal_information.php" enctype="multipart/form-data">
        <div class="row">
            <ul class="progressbar">
          <li class="active" id="first"><a href="add_artist_profile.php">Add Artist Profile</a></li>
          <li id="second"><a href="add_artist_personal_information.php">Add Artist Personal Info</a></li>
          <li id="third"><a href="add_artist_biography.php">Add Artist Biography</a></li>
          <li id="fourth"><a href="add_lineage.php">Add Lineage</a></li>
          
  </ul>

        </div>
        <div class="row">
            <div class="medium-10 column">
                <section>
                    <fieldset>
                        <!--<legend><strong>Adding artist profile</strong></legend>-->
                        <div class="row">
                            <h2  style="display:inline; text-align: left;"><strong>BASIC INFORMATION</strong></h2>
                            <h5  style="display:inline; float: right; color: #006400;">(<?php echo "<strong>You are in ".$_SESSION['timeline_flow']." mode </strong>";?>)</h5>
                        </div>
                       <div></div>
                        <div class="row">
                            <div class="medium-4 column">
                                <!--<label for="artist_first_name">First Name of Artist</span> <span style="color:red;font-weight: bold;"> *</span>-->
                                    <label for="artist_first_name"><?php echo (($_SESSION['contribution_type'] == "own")?'Your First Name':'First Name of Artist') ?></span> <span style="color:red;font-weight: bold;"> *</span>
                                    <input value="<?php echo (($_SESSION['contribution_type'] == "own")?$_SESSION['user_firstname']:$artist_fname) ?>" autocomplete="off" type="text" id="artist_first_name" name="artist_first_name" placeholder="First Name" required>
                                    <div id ="firstnamelist" style="background-color:#eee;"></div>  

                                </label>
                            </div>
                            <div class="medium-4 column">
                                <!--<label for="artist_last_name">Last Name <span class="other_artist">of Artist</span> <span style="color:red;font-weight: bold;"> *</span>-->
                                    <label for="artist_last_name"><?php echo (($_SESSION['contribution_type'] == "own")?'Your Last Name':'Last Name of Artist') ?></span> <span style="color:red;font-weight: bold;"> *</span>
                                    <input  value="<?php echo (($_SESSION['contribution_type'] == "own")?$_SESSION['user_lastname']:$artist_lname) ?>" autocomplete="off" type="text" id="artist_last_name" name="artist_last_name" placeholder="Last Name" required>
                                    <div id="lastnamelist" style="background-color:#eee;"></div>
                                    <div id ="duplication_check" style="color:red" ></div>
                                </label>
                            </div>
                            <div class="medium-4 column">
                                <!--<label for="artist_email_address">Email Address <span class="other_artist">of Artist</span>-->
                                    <label for="artist_email_address"><?php echo (($_SESSION['contribution_type'] == "own")?'Your Email Address':'Email Address of Artist') ?></span>
                                    <input value="<?php echo (($_SESSION['contribution_type'] == "own")?$_SESSION['user_email_address']:'') ?>" autocomplete="off" type="email" id="artist_email_address" name="artist_email_address" placeholder="Email Address">
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
                    <input type="radio" name="artist_status" value="living" id="artist_living" checked
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
                                <legend><strong>Date of Birth</strong>  <span style="color:red;font-weight: bold;"> *</span></legend>
                                        <input type="date" value="<?php echo isset($_SESSION['date_of_birth'])?$_SESSION['date_of_birth']:'' ?>" class="span2" id="date_of_birth" name="date_of_birth" placeholder="yyyy-mm-dd" 
                                        onblur="datevalidation()">
                            </fieldset>
                        </div>
                        <div class="column medium-6" id="date_of_death_div" style="display:block">
                            <fieldset  >
                                <legend><strong>Date of Death</strong><span style="color:red;font-weight: bold;"> *</span></legend>
                                        <input type="date" value="<?php echo isset($_SESSION['date_of_death'])?$_SESSION['date_of_death']:'' ?>" class="span2" id="date_of_death" name="date_of_death" placeholder="yyyy-mm-dd" 
                                        onblur="deathvalidation()"
                                        maxlength="4">
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
       
        <div class="row">
                <fieldset class="large-6 columns">
                    <legend>
                    <div style="color:red;" id="date_message"></div>
                    </legend>
                </fieldset>
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
                        <div id="checkboxvalidation" style="color:red;"></div><br>
                        <div class="medium-3 column">
                            <label for="Other_Artist_Text_Input" id="Other_Artist_Text" style="display:none">
                                Please separate multiple entries by comma:
                                <input  autocomplete="off" type="text" id="Other_Artist_Text_Input" name="other_artist_text_input"
                                        value="<?php echo isset($_SESSION['other_artist_text_input'])?$_SESSION['other_artist_text_input']:'' ?>"
                                />
                            </label>
                        </div>
                    </fieldset>
                </section>
            </div>
        </div>

        <br/>
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
                    <button class="primary button" type="button" name="home" id="home" onclick="saveAndBack()">
                        <span>Back to Profile</span>
                    </button>
                </div>
            <?php endif; ?>
            <div class="large-2 small-8 columns">
                <button class="primary button" id="next" type="submit" name="submit">
                    <span><?php echo (($_SESSION['timeline_flow'] == "view")?"":"Save & ") ?>Next</span>
                </button>
            </div>
            <div class="large-2 small-8 columns">
            <button class="primary button" id="next1" type="button">
                <span>Continue Later</span>
            </button>
        </div>
   
            <div class="column">
            </div>
        </div>
    </form>
    <script>
 $("#first").click(function() {
            // onclick event is assigned to the #button element.
            return false;
            window.open("add_artist_profile.php","_self");

            //document.location.href = "add_artist_personal_information.php",true;
        });

 $("#second").click(function() {
            // onclick event is assigned to the #button element.
            window.open("add_artist_personal_information.php","_self");
            //document.location.href = "add_artist_personal_information.php",true;
        });
  $("#third").click(function() {
            // onclick event is assigned to the #button element.
            window.open("add_artist_biography.php","_self");
            //document.location.href = "add_artist_personal_information.php",true;
        });
   $("#fourth").click(function() {
            // onclick event is assigned to the #button element.
            window.open("add_lineage.php","_self");
            //document.location.href = "add_artist_personal_information.php",true;
        });

        function saveAndBack() {
            console.log($("#add_user_profile_form").serialize());
            $.ajax({
                type: "GET",
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
            window.open('add_user_profile.php','_self');
        }
        var prepopulated;
        var contribution_form_type;
 
        function artistStatusSelection(){
            if($('input[name="artist_status"]:checked').val() == "living"){
                $("#date_of_death").val("");
                $("#date_of_death_div").hide();
                $("#date_of_death").prop("required",false);
            }   else if ($('input[name="artist_status"]:checked').val() == "deceased") {
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
            window.open("contribution_introduction.php","_self");
            //document.location.href = "add_artist_personal_information.php",true;
        });
        // onclick event is assigned to the #button element.
        // $("#next").click(function() {
        //  window.open("add_artist_personal_information.php","_self");
        // });
              $("#next1").click(function() {
        window.open("profiles.php","_self");
         });


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
                //profileSelection();
                fetchFields();
                artistStatusSelection();
                artistTypeSelection();
             }
             // else {
            //  //$("input[name='profile_selection']").filter("[value='artist']").prop('checked',true);
            //   //$("#other_artist_section").hide();
            //   $("#artist_living").attr("checked",true);
            //   $("#date_of_death_div").hide();
            //   $("#Other_Artist_Text").hide();
            //   $(".other_artist").hide();
            //   fetchFields();
            // }
            //$("input[name='profile_selection']").click(profileSelection);
            $("#Other_Artist_Type").click(artistTypeSelection);
            $("input[name='artist_status']").click(artistStatusSelection);
            if(disabled_input){
                $('input').attr('disabled','true')
            }
        });
        
        function datevalidation(){
              var birthdate=document.getElementById('date_of_birth');
              var date = new Date();
              birth=new Date(birthdate.value);
              var today = new Date();
              var dd = today.getDate();
              var mm = today.getMonth() + 1; //January is 0!
              var yyyy = today.getFullYear();
              if (dd < 10) {
                dd = '0' + dd;
              }
              if (mm < 10) {
                mm = '0' + mm;
              }
              var today = yyyy + '-' + mm + '-' + dd;
              if(date<birth){
                document.getElementById('date_message').style.display="block";
                document.getElementById("date_message").innerHTML="Date of Birth cannot be in future!";
              }
              else if(today===birthdate.value){
                document.getElementById('date_message').style.display="block";
                document.getElementById("date_message").innerHTML="Date of Birth cannot be today!";
              }
              else{
                document.getElementById('date_message').style.display="none";
              }
          }  

        function deathvalidation(){
            var birth=document.getElementById("date_of_birth");
            var death=document.getElementById("date_of_death");
            var bd=new Date(birth.value);
            var dd=new Date(death.value);
            if (bd>dd){
              document.getElementById('date_message').style.display="block";
              document.getElementById('date_message').innerHTML="! Invalid Date of Death";
            }
            else{
              document.getElementById('date_message').style.display="none";
            }
          }
        
       
        var submit=document.getElementById("next");
        submit.addEventListener('click',function(event){
            var birthdate=document.getElementById('date_of_birth');
            dateformat_birth= new Date(birthdate.value);
            var deathdate=document.getElementById('date_of_death');
            dateformat_death= new Date(deathdate.value);
            if(dateformat_death<dateformat_birth){
                alert("Please change Date of Death !");
                event.preventDefault();
            }
            var date = new Date();
            birth=new Date(birthdate.value);
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd;
            }
            if (mm < 10) {
                mm = '0' + mm;
            }
            var today = yyyy + '-' + mm + '-' + dd;
            if(today===birthdate.value){
                alert("Please change Date of Birth !");
                event.preventDefault();
            }
            if (date<birth){
                alert("Please change Date of Birth, cannot be in future!");
                event.preventDefault();
            }
            var text=document.getElementById("duplication_check").innerHTML;
            console.log(text);
            if(text.trim()===("!! User already exists. Please change artist name").trim()){
                alert("Cannot submit form with duplicate artist name");
                event.preventDefault();
            }
            if ($('#add_user_profile_form :checkbox:checked').length > 0){

            }
            else{
                $('#checkboxvalidation').html("Please select Type of Artist !!");
                event.preventDefault();
            }
        });

        

        // });
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
            <a href="add_user_profile.php">Click here to login or create your new user</a>
        </div>
    </div>
<?php endif; ?>
<?php
include 'footer.php';
?>

<script>
    $(function() {
        // this will get the full URL at the address bar
        var url = window.location.href;
        if(url.search("add_artist_profile.php"))
        {
            var lineage_contri = document.getElementById("contri_lineage");
            $(lineage_contri).addClass('active');
        }
    }); 
</script>
<script>  
 $(document).ready(function(){  
      $('#artist_first_name').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"auto_complete_firstname.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#firstnamelist').fadeIn();  
                          $('#firstnamelist').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', 'li', function(){  
           $('#artist_first_name').val($(this).text());  
           $('#firstnamelist').fadeOut();  
      });  
 });  
 $(document).ready(function(){
    $("#artist_last_name").blur(function(){
        var lname=$(this).val();
        var fname=$("#artist_first_name").val();
        if (lname && fname){
            $.ajax({
                url:"duplication_check.php",
                method:"POST",
                data:{
                    first:fname,
                    last:lname
                },
                success:function(response)
                {   
                    $('#duplication_check').html(response);
                    // if(response=="success")
                        // alert("Artist already exists");
                        // $("#next").prop("disabled",true);
                }
            });
        }
    })
 });

</script>
  <!-- <script>  
 $(document).ready(function(){  
      $('#artist_last_name').keyup(function(){  
           var query = $(this).val();  
           console.log(query);
           if(query != '')  
           {  
                $.ajax({  
                     url:"auto_complete_firstname.php",  
                     method:"POST",  
                     data:{query1:query},  
                     success:function(data)  
                     {  
                          $('#lastnamelist').fadeIn();  
                          $('#lastnamelist').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', 'li', function(){  
           $('#artist_last_name').val($(this).text());  
           $('#lastnamelist').fadeOut();  
      });  
 });  
 </script>   -->

</html>