<?php
include 'util.php';
my_session_start();
if($_SESSION["user_type"] == "Admin")
{
	include 'admin_menu.php';
}else{
	include 'menu.php';
}
if($_SESSION["timeline_flow"] == "view"){
    echo "<script>var disabled_input=true;</script>";
}else{
    echo "<script>var disabled_input=false;</script>";
}
$user_fname=$_SESSION["user_firstname"];
$user_lname=$_SESSION["user_lastname"];
$artist_fullname=$user_fname.' '.$user_lname;
$user_email=$_SESSION["user_email_address"]

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Lineage</title>
</head>


<!-- Libraries for datatables -->

<body onload="getData()">
    <!-- Yogesh progressbar -->
    <div class="row">
        <div class="progress" role="progressbar" tabindex="0" aria-valuenow="80" aria-valuemin="0" aria-valuetext="80 percent" aria-valuemax="100">
                <span class="progress-meter" style="width: 80%">
                    <p class="progress-meter-text">80%</p>
                </span>
        </div>
    </div>
    <div class="row">
      <div class="large-2 columns large-offset-4">
          <h4><strong><center><?php echo ("Enter Your Lineage"); ?></center></strong></h4>
      </div>
  </div>
  <div class="medium-9 row">
    <p>
      <i>
        Lineal artists are the people with whom you have studied, danced, collaborated and have been influenced by.
      </i>
    </p>
  </div>
  <form id="add_user_profile_form" name="add_user_profile_form" method="POST" action="thank_you.php"
  enctype="multipart/form-data">
  <div class="row artist_lineage_container" id="artist_lineage_container" style="margin-bottom:2%">
              <div class="medium-12 column">
                  <section>
                      <fieldset>
                          <div class="row">
                              <div class="small-3 column">
                                  <p class="lineal_header"><strong>Details of Lineal Artist</strong></p>
                              </div>
                          </div>
                          <div class="row">
                                <div class="small-2 column">
                                    <label for="lineal_first_name">First Name<large style="color:red;font-weight: bold;"> *</large>
                                        <input autocomplete="off" type="text" class="lineal_first_name"
                                        id="lineal_first_name" name="lineal_first_name" placeholder="First Name" required/>
                                    </label>
                                </div>
                                <div class="small-2 column">
                                      <label for="lineal_last_name">Last Name <large style="color:red;font-weight: bold;"> *</large>
                                          <input autocomplete="off" type="text" class="lineal_last_name" id="lineal_last_name" name="lineal_last_name" placeholder="Last Name" required/>
                                      </label>
                                </div>
                                <div class="small-3 column">
                                    <label for="lineal_genre">Genre <small></small>
                                       <input autocomplete="off" type="text" class="lineal_genre" id="lineal_genre" name="lineal_genre" placeholder="Genre" onfocusout="testfunction()"/>
                                    </label>
                                </div>
                                <div class="small-3 column">
                                    <label for="lineal_email_address">Email Address <small></small>
                                        <input  autocomplete="off" type="email" class="lineal_email_address" id="lineal_email_address" name="lineal_email_address" placeholder="Email Address"/>
                                    </label>
                                </div>
                                <div class="small-2 column">
                                    <label for="lineal_website">Website <small></small>
                                       <input autocomplete="off" type="url" class="lineal_website" id="lineal_website" name="lineal_website" placeholder="Website"/>
                                    </label>
                                </div>
                          </div>
                          <div class="row">
                                <div class="small-12 column">
                                    <label>Type of Relationship  (Check All that Apply):</label>
                                </div>
                          </div>
                          <br>
                          <div class="row">
                             <div class="small-3 column">
                               <input type="checkbox" id="studied" name="studied" class="rel_studied" value="Studied With">
                               <label for="studied">Studied Under</label><span style="cursor:pointer;" title="Teachers with whom you have studied."><img src="img/help.png" style="height:13px;width:13px;"/></span>
                             </div>
                             <div class="small-3 column">
                               <input type="checkbox" id="danced" name="danced" class="rel_danced" value="Danced For">
                               <label for="danced">Danced in the Work of </label><span style="cursor:pointer;" title="Choreographers whose works you have danced in."><img src="img/help.png" style="height:13px;width:13px;"/></span>
                             </div>
                             <div class="small-3 column">
                               <input type="checkbox" id="collaborated" name="collaborated" class="rel_collaborated" value="Collaborated With">
                               <label for="collaborated">Collaborated With </label><span style="cursor:pointer;" title="Artists with whom you have collaborated."><img src="img/help.png" style="height:13px;width:13px;"/></span>
                             </div>
                             <div class="small-3 column">
                               <input type="checkbox" id="influenced" name="influenced" class="rel_influenced" value="Influenced By">
                               <label for="influenced">Influenced By </label><span style="cursor:pointer;" title="People who have significantly influenced your work such as artists, authors, philosophers, etc.  You do not need to have a personal relationship with this person in order to list them as having an impact on your work."><img src="img/help.png" style="height:13px;width:13px;"/></span>
                             </div>
                          </div>
                          <div class="row">
                            <div class="small-6 column">
                               <div id="danced_options" style="display:none;">
                                 <p>Please list titles of the works you have danced in by the artist</p>
                                 <input type="text" id="danced_titles" class="danced_titles" name="Danced_titles" placeholder="Dance titles">
                               </div>
                             </div>
                          </div>

                          </div>
                           <div class="row artist_button">
                             <div class="large-4 columns large-offset-4">
                               <button class="secondary success button " id="addArtist" type="button">
                                 <span>Save and Add another Artist</span>
                               </button>
                             </div>
                           </div>
                           <div class="row">
                             <div class="medium-12 column">
                               <table id="display_relations" class="display" style="width:100%;margin-left:auto;margin-right:auto;">
                                  <thead>
                                      <tr>
                                          <th>Name</th>
                                          <th>Email Address</th>
                                          <th>Website</th>
                                          <th>Relation</th>
                                          <th>Edit / Delete</th>
                                      </tr>
                                  </thead>
                             </table>
                           </div>
                          </div>
                           <div class="row">
                              <input type="checkbox" name="terms" id="terms" value="accepted">  Accept <a href="javascript:readTermsConditions();">Terms and Conditions</a></input>
                              <!--<button text="Read terms and conitions here" id="read_terms" name="read_terms" onclick="readTermsConditions()"/>-->
                          </div>
                          <div id="extraControls" style="display: none;">
                           <div id = "dialog-1" style="font-weight: bold;width:600px;height:700px;background-color:#E7FBE9"
                           title="TERMS AND CONDITIONS">
                              1. You are filling this form out voluntarily.</br>
                              2. You are aware that the information you provide will be used as a global resource, accessible to the general public, unless otherwise noted in the survey. </br>
                              3. Choreographic Lineage will not sell, share or rent your personal information to any third party or use your e-mail address for unsolicited mail. Any emails sent by Choreograhic Lineage will only be in connection with the Choreographic Lineage resource. </br>
                              4. The information you provide to Choreographic Lineage is accurate to the best of your knowledge. </br>
                              5. You are accepting the terms and conditions for your current entries and your future additions to your lineage.</br>
                              </br>
                              <button class="primary button" style="margin:auto; display:block;" id="accept" type="submit" name="Accept">
                              <span>Accept</span>
                               </button>
                          </div>
                        </div>
                          <div class="row">
                            <?php if($_SESSION["timeline_flow"] == "relation_add"):?>
                                <div class="large-10">
                                    <button class="primary button" type="button" name="home" id="home" onclick="window.open('add_user_profile.php','_self');">
                                        <span>Back to Profile</span>
                                    </button>
                                    <button class="primary button" type="submit" name="save" id="save">
                                        <span>Save and Contribute Lineage</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <?php if($_SESSION["timeline_flow"] == "artist_add"):?>
                                <div class="large-2 small-8 column">
                                    <button class="primary button" type="button" name="previous" id="previous">
                                        <span>Previous</span>
                                    </button>
                                </div>
                                <div class="large-2 small-8 column">
                                    <button class="primary button" type="submit" name="next" id="next">
                                        <span>Save & Next</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <?php if($_SESSION["timeline_flow"] == "edit"):?>
                                <div class="large-2 small-8 column">
                                    <button class="primary button" type="button" name="previous" id="previous">
                                        <span>Previous</span>
                                    </button>
                                </div>
                                <div class="large-2 small-8 column">
                                    <button class="primary button" type="submit" name="save" id="save">
                                        <span>Save</span>
                                    </button>
                                </div>
                                <div id="terms_validation" style="red"></div>
                            <?php endif; ?>
                            <?php if($_SESSION["timeline_flow"] == "view"):?>
                                <div class="large-2 small-8 column">
                                    <button class="primary button" type="button" name="previous" id="previous">
                                        <span>Previous</span>
                                    </button>
                                </div>
                                <div class="large-2 small-8 column" style="margin-left: 0px;">
                                    <button class="primary button" type="button" name="home" id="home" onclick="window.open('add_user_profile.php','_self');">
                                        <span>Back to Profile</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <div class="column">
                            </div>
                        </div>
</form>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="js/combo/Drop-Down-Combo-Tree/style.css">
<script src="js/combo/Drop-Down-Combo-Tree/comboTreePlugin.js"></script>
<script src="js/combo/Drop-Down-Combo-Tree/icontains.js"></script>
<script type="text/javascript" src="js/getData.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

</body>
<?php
include 'form_links_footer.php';
include 'footer.php';
?>
<script>
var comboTree1;
var selectedIds = new Array();
function testfunction(){

  selectedIds = comboTree1.getSelectedItemsId();
  console.log(selectedIds);

}
$(document).ready(function(){
  $('#danced').change(function() {
    if(this.checked) {
      $("#danced_options").fadeIn('slow');
      }
      else {
        $("#danced_options").fadeOut('slow');
      }
    });
    jQuery.ajax({
      type: "POST",
      url: 'artistrelationcontroller.php',
      data: JSON.stringify({"action": "getArtistRelation",
                            "artistprofileid1":<?php echo $_SESSION["artist_profile_id"]?>,
                            "artistprofileid2":""
                          }),
         success: function(response) {
               response = JSON.stringify(response);
               jsonData = $.parseJSON(response);
               jsonData = jsonData.artist_relation;
               displaydata=jsonData;
        },
        async:false
    });
    table=$("#display_relations").DataTable({
      data:displaydata,
      columns:[
        { "data": "artist_name_2" },
        { "data": "artist_email_id_2" },
        { "data": "artist_website_2" },
        { "data": "artist_relation" },
        {
                data: null,
                className: "center",
                defaultContent: '<a class="editor_edit">Edit</a> / <a class="editor_remove">Delete</a>'
            }
      ],
      "bDestroy": true
    });
    $('#display_relations').on('click', 'a.editor_remove', function (e) {
        var deletedrow=table.row($(this).parents('tr')).data();
        $.ajax({
          type: "POST",
          url: 'artistrelationcontroller.php',
          data: JSON.stringify({"action": "deleteArtistRelation",
                                "relationid":deletedrow.relation_id
                              }),
             success: function(response) {
               console.log("record deleted from artistrelation");
            },
            async:false
        });
        table
        .row( $(this).parents('tr') )
        .remove()
        .draw();
      })

      $('#display_relations').on('click', 'a.editor_edit', function (e) {
          var editedrow=table.row($(this).parents('tr')).data();
          //console.log(editedrow.artist_profile_id_2);
          $.ajax({
            type: "POST",
            url: 'artistcontroller.php',
            data: JSON.stringify({"action": "getArtistProfile",
                                  "artistprofileid":editedrow.artist_profile_id_2
                                }),
               success: function(response) {
                 response = JSON.stringify(response);
                 jsonData = $.parseJSON(response);
                 jsonData = jsonData.artist_profile;
                 jsonData = jsonData[0];
                 console.log(jsonData);
                 $('#lineal_first_name').val(jsonData.artist_first_name);
                 $('#lineal_last_name').val(jsonData.artist_first_name);
                 $('#lineal_email_address').val(jsonData.artist_email_address);
                 $('#lineal_website').val(jsonData.artist_website);
              },
              async:false
          });



        })







});
$('#add_user_profile_form').submit(function(event){
        if($('#terms').is(':checked') == false){
            event.preventDefault();
            alert("Please accept terms and conditions to submit.");
            return false;
        }
    });
$('#addArtist').click(function(){
  var fname=document.getElementById('lineal_first_name').value;
  var lname=document.getElementById('lineal_last_name').value;
  var mail=document.getElementById('lineal_email_address').value;
  var website=document.getElementById('lineal_website').value;
  var genre=document.getElementById('lineal_genre').value;
  var pid1=0;
  var fname1="";
  var lname1="";
  var fullname1="";
  var email1="";
  var pid2=0;
  var fname2="";
  var lname2="";
  var fullname2="";
  var email2="";
  var website2="";
  
  
  $.ajax({
        type: "POST",
        url: 'artistcontroller.php',
        data: JSON.stringify({"action": "addOrEditArtistProfile",
                              "artistfirstname":fname,
                              "artistlastname":lname,
                              "artistemailaddress":mail,
                              "profilename":mail,
                              "isuserartist":"other",
                              "artistwebsite":website
                            }),
           success: function(response) {
             console.log("new artist added to db");
          },
          error: function(response){
            console.log(response);
          }
      });
  
  //getting your details
  jQuery.ajax({
    type: "POST",
    url: 'artistcontroller.php',
    data: JSON.stringify({"action": "getArtistProfile",
                          "artistemailaddress":'<?php echo $user_email?>'
                        }),
      success: function(response){
        response = JSON.stringify(response);
        jsonData = $.parseJSON(response);
        pid1=parseInt(jsonData.artist_profile[0].artist_profile_id);
        email1=jsonData.artist_profile[0].profile_name;
        fname1=jsonData.artist_profile[0].artist_first_name;
        lname1=jsonData.artist_profile[0].artist_last_name;
        fullname1=fname1.concat('-',lname1);
      },
      async:false
  });
  console.log("fullname1 after ajax",fullname1);

  //getting artist2 details
  jQuery.ajax({
    type: "POST",
    url: 'artistcontroller.php',
    data: JSON.stringify({"action": "getArtistProfile",
                          "artistfirstname":fname,
                          "artistlastname":lname,
                          "artistemailaddress":mail
                        }),
      success: function(response){
        response = JSON.stringify(response);
        jsonData = $.parseJSON(response);
        pid2=parseInt(jsonData.artist_profile[0].artist_profile_id);
        email2=jsonData.artist_profile[0].profile_name;
        fname2=jsonData.artist_profile[0].artist_first_name;
        lname2=jsonData.artist_profile[0].artist_last_name;
        fullname2=fname2.concat('-',lname2);
        website2=jsonData.artist_profile[0].artist_website;
      },
      async:false
  });
  console.log("artist2 details got after ajax :",pid2,fullname2,website2);

  // adding into artist genre database

  var selected_checkboxes=new Array();
  var inputs = document.querySelectorAll("input[type='checkbox']");
  for(var i = 0; i < inputs.length; i++) {
      if(inputs[i].checked == true){
        if (inputs[i].value!='checked' && inputs[i].value!='on'){
          selected_checkboxes.push(inputs[i].value);
        }
      }
  }
  for (var i=0 ; i <selected_checkboxes.length; i++){
    $.ajax({
      type: "POST",
      url: 'artistrelationcontroller.php',
      data: JSON.stringify({"action": "addOrEditArtistRelation",
                            "artistprofileid1":pid1,
                            "artistprofileid2":pid2,
                            "artistname1":fullname1,
                            "artistemailId1":email1,
                            "artistname2":fullname2,
                            "artistemailId2":email2,
                            "artistwebsite2":website2,
                            "artistrelation":selected_checkboxes[i]
                          }),
         success: function(response) {
           console.log("new artist added to db for artist relation");
        },
        error: function(response){
          console.log(response);
        }
    });
  }
  console.log("genredata",selectedIds);

  for(var i=0;i<selectedIds.length;i++){
    jQuery.ajax({
      type: "POST",
      url: 'artistgenrecontroller.php',
      data: JSON.stringify({"action": "addOrEditArtistGenres",
                              "genreid":parseInt(selectedIds[i]),
                              "artistprofileid":pid2
                          }),
         success: function(response) {
           response = JSON.stringify(response);
           jsonData = $.parseJSON(response);
           if (jsonData.artist_profile==null){
             console.log("Artist added to artistgenre table!");
           }

        },
        async:false
    });
  }
  $.ajax({
    type: "POST",
    url: 'artistrelationcontroller.php',
    data: JSON.stringify({"action": "getArtistRelation",
                          "artistprofileid1":pid1,
                          "artistprofileid2":""
                        }),
       success: function(response) {
             response = JSON.stringify(response);
             jsonData = $.parseJSON(response);
             jsonData = jsonData.artist_relation;
             var oTable = $('#display_relations').dataTable();
             oTable.fnClearTable();
             $("#display_relations").DataTable({
               data:jsonData,
               columns:[
                 { "data": "artist_name_2" },
                 { "data": "artist_email_id_2" },
                 { "data": "artist_website_2" },
                 { "data": "artist_relation" },
                 {
                         data: null,
                         className: "center",
                         defaultContent: '<a href="" class="editor_edit">Edit</a> / <a href="" class="editor_remove">Delete</a>'
                     }
               ],
               "bDestroy": true
          });
          $('#display_relations').on('click', 'a.editor_remove', function (e) {
              var deletedrow=table.row($(this).parents('tr')).data();
              $.ajax({
                type: "POST",
                url: 'artistrelationcontroller.php',
                data: JSON.stringify({"action": "deleteArtistRelation",
                                      "relationid":deletedrow.relation_id
                                    }),
                   success: function(response) {
                     console.log("record deleted from artistrelation");
                  },
                  async:false
              });
              table
              .row( $(this).parents('tr') )
              .remove()
              .draw();
            })
      },
      async:false
  });
    $('#add_user_profile_form')[0].reset();
     // location=location;
});

$('#accept').click(function(){
        $( "#dialog-1" ).dialog( "close" );
        document.getElementById("terms").checked = true;
});

function readTermsConditions(){
      $( "#dialog-1" ).dialog({
        width: 600
      })
    $( "#dialog-1" ).dialog( "open" );
}

$("#previous").click(function() {
    if(disabled_input){
        window.open("add_artist_biography.php","_self");
    }else{

        $.ajax({
            type: "POST",
            url: "save_add_artist_pi_back.php",
            data: $("#add_user_profile_form").serialize(),
            success: function(response) {
                console.log(response);
            }
        });
         // <?php unset($_SESSION['lineage_artist_first_name']);?>
        window.open("about_lineage.php","_self");
    }
});
</script>
</html>
