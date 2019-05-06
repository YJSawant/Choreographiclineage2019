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

</head>


<!-- Libraries for datatables -->

<body onload="getData()">
    <div class="row">
		  <ul class="progressbar">
          <li class="active"id="first"><a href="add_artist_profile.php">Add Artist Profile</a></li>
          <li class="active" id="second"><a href="add_artist_personal_information.php">Add Artist Personal Info</a></li>
          <li class="active" id="third"><a href="add_artist_biography.php">Add Artist Biography</a></li>
          <li class="active" id="fourth"><a href="add_lineage.php">Add Lineage</a></li>
     </ul>
		</div>
    <div class="row">
          <h4 style="display:inline;  align:center"><strong>ENTER YOUR LINEAGE</strong></h4>
          <h5 style="display:inline; float: right; color: #006400;"><?php echo "<strong>(You are in ".$_SESSION['timeline_flow']." mode)</strong>";?></h5>
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
                                        id="lineal_first_name" name="lineal_first_name" placeholder="First Name" />
                                    </label>
                                </div>
                                <div class="small-2 column">
                                      <label for="lineal_last_name">Last Name <large style="color:red;font-weight: bold;"> *</large>
                                          <input autocomplete="off" type="text" class="lineal_last_name" id="lineal_last_name" name="lineal_last_name" placeholder="Last Name" />
                                      </label>
                                </div>
                                <div class="small-3 column">
                                    <label for="lineal_genre">Genre
                                      <br>
                                      <select id="lineal_genre" name = 'genre[]' class="multi-select-dd" multiple="multiple">
                                          <option value="Acro">Acro</option>
                                          <option value="Aduma">Aduma (Kenya)</option>
                                          <option value="Aerial">Aerial</option>
                                          <option value="African">African</option>
                                          <option value="AfricanContemporary">African Contemporary</option>
                                          <option value="AfricanTraditionalorFolk">African Traditional or Folk</option>
                                          <option value="AfroCaribbean">Afro-Caribbean</option>
                                          <option value="Arabic">Arabic/Middle Eastern</option>
                                          <option value="Armenian">Armenian</option>
                                          <option value="Atilogwu">Atilogwu (Nigeria)</option>
                                          <option value="Bachata">Bachata</option>
                                          <option value="Balkan">Balkan</option>
                                          <option value="Ballet">Ballet</option>
                                          <option value="Ballroom">Ballroom</option>
                                          <option value="Bangladeshi">Bangladeshi</option>
                                          <option value="Bboyingor">Bboying or Bgirling</option>
                                          <option value="Bhangra">Bhangra</option>
                                          <option value="BellyDance">Belly Dance</option>
                                          <option value="Brazilian">Brazilian</option>
                                          <option value="Burlesque">Burlesque/Cabaret</option>
                                          <option value="Capoeira">Capoeira</option>
                                          <option value="Cha">Cha-cha-cha</option>
                                          <option value="Charleston">Charleston</option>
                                          <option value="Chilean">Chilean</option>
                                          <option value="Chinese">Chinese</option>
                                          <option value="Circus">Circus</option>
                                          <option value="Clogging">Clogging</option>
                                          <option value="Colombian">Colombian</option>
                                          <option value="ContactImprovisation">Contact Improvisation</option>
                                          <option value="ContemporaryorModern">Contemporary or Modern</option>
                                          <option value="Contra">Contra</option>
                                          <option value="CountryWestern">Country Western</option>
                                          <option value="Croatian">Croatian</option>
                                          <option value="Dancehall">Dancehall</option>
                                          <option value="Dancesport">Dancesport</option>
                                          <option value="Danish">Danish</option>
                                          <option value="Eskista">Eskista (Ethiopia)</option>
                                          <option value="EuropeanFolkDance">European Folk Dance</option>
                                          <option value="Ewegh">Ewegh (Niger)</option>
                                          <option value="Finnish">Finnish</option>
                                          <option value="FlamencoorSpanish">Flamenco  or Spanish</option>
                                          <option value="Foxtrot">Foxtrot</option>
                                          <option value="Greek">Greek</option>
                                          <option value="German">German</option>
                                          <option value="Guinean">Guinean</option>
                                          <option value="Gumboot">Gumboot</option>
                                          <option value="GarbaandRaas">Garba and Raas</option>
                                          <option value="Krumping">Krumping</option>
                                          <option value="Liturgical">Liturgical</option>
                                          <option value="Locking">Locking</option>
                                          <option value="Haitian">Haitian</option>
                                          <option value="HipHop">Hip Hop</option>
                                          <option value="Historical">Historical: Baroque, Medieval, Renaissance</option>
                                          <option value="House">House</option>
                                          <option value="Hustle">Hustle</option>
                                          <option value="IceDancing">IceDancing</option>
                                          <option value="Indian Classical">Indian Classical</option>
                                          <option value="Indlamu">Indlamu (South Africa)</option>
                                          <option value="Inuit">Inuit</option>
                                          <option value="Irish">Irish</option>
                                          <option value="Israeli">Israeli</option>
                                          <option value="Italian">Italian</option>
                                          <option value="Japanese">Japanese</option>
                                          <option value="Jazz">Jazz</option>
                                          <option value="Jive">Jive</option>
                                          <option value="Kizomba">Kizomba</option>
                                          <option value="Korean">Korean</option>
                                          <option value="Lebanese">Lebanese</option>
                                          <option value="LindyHop">Lindy Hop</option>
                                          <option value="Lyrical">Lyrical</option>
                                          <option value="Macedonian">Macedonian</option>
                                          <option value="Malagasy">Malagasy</option>
                                          <option value="Mbalax">Mbalax </option>
                                          <option value="Merengue">Merengue </option>
                                          <option value="Mexican">Mexican</option>
                                          <option value="Moribayasa">Moribayasa (Guinea)</option>
                                          <option value="MusicTheater">Music Theater</option>
                                          <option value="Pakistani">Pakistani</option>
                                          <option value="Pat">Pat Pat(Senegal)</option>
                                          <option value="Persian">Persian</option>
                                          <option value="Peruvian">Peruvian</option>
                                          <option value="Philippine">Philippine</option>
                                          <option value="Polish">Polish</option>
                                          <option value="Polka">Polka</option>
                                          <option value="Polynesian">Polynesian</option>
                                          <option value="Popping">Popping</option>
                                          <option value="Romanian">Romanian</option>
                                          <option value="Rumba">Rumba</option>
                                          <option value="Russian">Russian</option>
                                          <option value="Sacred">Sacred</option>
                                          <option value="Salsa">Salsa</option>
                                          <option value="Samba">Samba</option>
                                          <option value="San">San Dancing (Botswana)</option>
                                          <option value="Scandinavian">Scandinavian</option>
                                          <option value="Semba">Semba</option>
                                          <option value="Serbian">Serbian</option>
                                          <option value="Shag">Shag</option>
                                          <option value="Slovak">Slovak</option>
                                          <option value="Swing">Swing</option>
                                          <option value="SouthAsian">South Asian</option>
                                          <option value="Square">Square</option>
                                          <option value="Tango">Tango</option>
                                          <option value="Tap">Tap</option>
                                          <option value="Thai">Thai</option>
                                          <option value="Turkish">Turkish</option>
                                          <option value="Ukrainian">Ukrainian</option>
                                          <option value="Venezuelan">Venezuelan</option>
                                          <option value="Vietnamese">Vietnamese</option>
                                          <option value="Waacking">Waacking</option>
                                          <option value="Waltz">Waltz</option>
                                          <option value="Zouk">Zouk</option>
                                          <option value="Zumba">Zumba</option>
                                      </select>
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
                               <input type="checkbox" id="studied" name="studied" class="rel_studied" value="Studied Under">
                               <label for="studied">Studied Under</label><span style="cursor:pointer;" title="Teachers with whom you have studied."><img src="img/help.png" style="height:13px;width:13px;"/></span>
                             </div>
                             <div class="small-3 column">
                               <input type="checkbox" id="danced" name="danced" class="rel_danced" value="Danced in the Work of">
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
                                <button class="secondary success button " id="clearform" type="button" onclick="clearFormEvent()">
                                <span>Clear Form</span>
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
                                    &nbsp;
                                    <button class="primary button" type="submit" name="save" id="save">
                                        <span>Save and Contribute Lineage</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <?php if($_SESSION["timeline_flow"] == "artist_add"):?>
                                <div class="large-10">
                                    <button class="primary button " type="button" name="previous" id="previous">
                                        <span>Previous</span>
                                    </button>
                                    &nbsp;
                                    <button class="primary button" type="submit" name="next" id="next">
                                        <span>Save and Contribute Lineage</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <?php if($_SESSION["timeline_flow"] == "edit"):?>
                                <div class="large-10">
                                    <button class="primary button" type="button" name="previous" id="previous">
                                        <span>Previous</span>
                                    </button>
                                    &nbsp;
                                    <button class="primary button" type="submit" name="save" id="save">
                                        <span>Save and Contribute Lineage</span>
                                    </button>
                                </div>
                                <div id="terms_validation" style="red"></div>
                            <?php endif; ?>
                            <?php if($_SESSION["timeline_flow"] == "view"):?>
                                <div class="large-10">
                                    <button class="primary button " type="button" name="previous" id="previous">
                                        <span>Previous</span>
                                    </button>
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
<link href="css/fSelect2.css" rel="stylesheet">
<script src="js/fSelect.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

</body>
<?php
include 'form_links_footer.php';
include 'footer.php';
?>
<script>
  $("#first").click(function() {
              // onclick event is assigned to the #button element.
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
              return false;
              // window.open("add_lineage.php","_self");
              //document.location.href = "add_artist_personal_information.php",true;
        });
  function clearFormEvent(){
    isArtistEntryFormPopulated=false;
    artistIdInForm=null;

    var genreList = document.getElementById('lineal_genre');
    genreListLength = genreList.options.length;
    for(var i=0; i<genreListLength; i++){
        genreListOption = genreList.options[i];
        genreListValue = genreList.options[i].value;

        genreListOption.selected=false;
        //console.log(genreListOption.selected);
    }
    $('.multi-select-dd').fSelect('reload');

    $('#add_user_profile_form')[0].reset();

  }
  var comboTree1;
  var table;
  var isArtistEntryFormPopulated=false;
  var artistIdInForm=null;




  function getData() {
  		//window.open('/src/load_artists_data.php?'+dta,'_self');


  		//console.log(JSON.stringify({"action": "getGenres"}));

      table=$("#display_relations").DataTable({
        "ajax": {
                    "type": "POST",
                    "url": "artistrelationcontroller.php",
                    "data": function(d){
                                      return JSON.stringify({"action": "getArtistWithGroupedRelations",
                                                            "artistprofileid1":<?php echo $_SESSION["artist_profile_id"]?>,
                                                            "artistprofileid2":""
                                                          });
                    },
                    "dataSrc" : function (json) {
                                      // manipulate your data (json)

                                      response = JSON.stringify(json);
                                      jsonData = $.parseJSON(response);
                                      jsonData = jsonData.artist_relation;
                                      if(!jsonData){
                                        jsonData="";
                                      }
                                      // return the data that DataTables is to use to draw the table
                                      return jsonData;
                                  }
                },
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
                  ]
      });


  }


$(document).ready(function(){
  $('.multi-select-dd').fSelect();
  $('#danced').change(function() {
    if(this.checked) {
      $("#danced_options").fadeIn('slow');
      }
      else {
        $("#danced_options").fadeOut('slow');
      }
    });

    //delete relation
    $('#display_relations').on('click', 'a.editor_remove', function (e) {
        var deletedrow=table.row($(this).parents('tr')).data();
        //console.log(deletedrow.artist_profile_id_2);
        $.ajax({
          type: "POST",
          url: 'artistrelationcontroller.php',
          data: JSON.stringify({"action": "deleteArtistRelationWithOtherIdentifiers",
                                "artistprofileid2":deletedrow.artist_profile_id_2
                              }),
             success: function(response) {
               //console.log("record deleted from artistrelation");
            }
        });
        $('#display_relations').DataTable().ajax.reload();
      })

      //edit existing relations
      $('#display_relations').on('click', 'a.editor_edit', function (e) {
          var editedrow=table.row($(this).parents('tr')).data();
          //console.log(editedrow);
          isArtistEntryFormPopulated=true;
          artistIdInForm=editedrow.artist_profile_id_2;
          var relationString=editedrow.artist_relation;
          var relation_array=relationString.split(',');
          //console.log(relation_array);

          if(relation_array.includes('Danced in the Work of')){
            $.ajax({
              type:"POST",
              url:'artistrelationcontroller.php',
              data:JSON.stringify({
                "action":"getArtistRelation",
                "artistprofileid1":<?php echo $_SESSION['artist_profile_id']?>,
                "artistprofileid2":editedrow.artist_profile_id_2,
                "artistrelation":'Danced in the Work of'
              }),
              success:function(response){
                console.log(<?php echo $_SESSION['artist_profile_id']?>);
                console.log(editedrow.artist_profile_id_2);
                response = JSON.stringify(response);
                jsonData = $.parseJSON(response);

                jsonData=jsonData.artist_relation[0];
                $('#danced_titles').val(jsonData.works);
                $("#danced_options").fadeIn('slow');
              }
            });
          }


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
                 //console.log(jsonData);
                 $('#lineal_first_name').val(jsonData.artist_first_name);
                 $('#lineal_last_name').val(jsonData.artist_last_name);
                 $('#lineal_email_address').val(jsonData.artist_email_address);
                 $('#lineal_website').val(jsonData.artist_website);
                 var gstr=jsonData.genre;
                 gstr = gstr.split(",");
                 var genreList = document.getElementById('lineal_genre');
                 genreListLength = genreList.options.length;
                 for(var i=0; i<genreListLength; i++){
                     genreListOption = genreList.options[i];
                     genreListValue = genreList.options[i].value;

                     if(gstr.includes(genreListValue))
                     {
                         genreListOption.selected= true;
                     }else{
                         genreListOption.selected = false;

                     }
                 }
                 $('.multi-select-dd').fSelect('reload');
              }
          });

          $('#studied').prop('checked', false);
          $('#danced').prop('checked', false);
          $('#collaborated').prop('checked', false);
          $('#influenced').prop('checked', false);
          for (var i=0 ; i <relation_array.length; i++){
              if(relation_array[i]=='Studied Under'){
                  $('#studied').prop('checked', true);
              }
              else if(relation_array[i]=='Danced in the Work of'){
                  $('#danced').prop('checked', true);
              }
              else if(relation_array[i]=='Collaborated With'){
                  $('#collaborated').prop('checked', true);
              }
              else if(relation_array[i]=='Influenced By'){
                  $('#influenced').prop('checked', true);
              }
          }

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
          var works=document.getElementById("danced_titles").value;

          var g=document.getElementById("lineal_genre");
          var glength=g.options.length;
          var glist="";
          for(var i=0;i<glength;i++){
            if(g.options[i].selected){
                glist=glist+','+g.options[i].value;
            }
          }
          glist=glist.substr(1,glist.length);


          if (fname == ""){
            alert("Please enter First Name for lineal artist");
            return;
          }
          if(lname == ""){
            alert("Please enter Last Name for lineal artist");
            event.preventDefault();
            return;
          }
          if(document.getElementById('studied').checked==false && document.getElementById('danced').checked==false && document.getElementById('collaborated').checked==false && document.getElementById('influenced').checked==false){
            alert("Please select type of relationship");
            event.preventDefault();
            return;
          }


          //creating new profile or editing existing one
          var payloadForAristForm= {"action": "addOrEditArtistProfile",
                                "artistfirstname":fname,
                                "artistlastname":lname,
                                "artistemailaddress":mail,
                                "profilename":mail,
                                "isuserartist":"other",
                                "artistwebsite":website,
                                "newgenre":glist
                              };

          if(isArtistEntryFormPopulated){
            payloadForAristForm.artistprofileid = artistIdInForm;
          }

          //console.log(payloadForAristForm);
          $.ajax({
              type: "POST",
              url: 'artistcontroller.php',
              data: JSON.stringify(payloadForAristForm),
                complete: function(response) {
                  // get parent profile
                  $.ajax({
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

                        //console.log('parent:'+pid1);

                        //get child profile
                        $.ajax({
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

                              //console.log('child:'+pid2);

                              var selected_checkboxes=new Array();
                              var unselected_checkboxes=new Array();

                              if($('#studied').is(':checked')){
                                selected_checkboxes.push($('#studied').val());
                              }
                              else{
                                unselected_checkboxes.push('Studied Under');
                              }
                              if($('#danced').is(':checked')){
                                selected_checkboxes.push($('#danced').val());
                              }
                              else{
                                unselected_checkboxes.push('Danced in the Work of');
                              }if($('#collaborated').is(':checked')){
                                selected_checkboxes.push($('#collaborated').val());
                              }
                              else{
                                unselected_checkboxes.push('Collaborated With');
                              }if($('#influenced').is(':checked')){
                                selected_checkboxes.push($('#influenced').val());
                              }
                              else{
                                unselected_checkboxes.push('Influenced By');
                              }
                              //console.log(unselected_checkboxes);
                              for (var i=0 ; i <unselected_checkboxes.length; i++){
                                $.ajax({
                                  type: "POST",
                                  url: 'artistrelationcontroller.php',
                                  data: JSON.stringify({"action": "deleteArtistRelationWithOtherIdentifiers",
                                                        "artistprofileid1":pid1,
                                                        "artistprofileid2":pid2,
                                                        "artistrelation":unselected_checkboxes[i]
                                                      }),
                                     success: function(response) {
                                       //console.log("record deleted from artistrelation");
                                       //console.log('Pseudo Delete done.');
                                    }
                                });
                              }

                                // add reations in artist_relation
                              var loopLength=selected_checkboxes.length;
                              for (var i=0 ; i <selected_checkboxes.length; i++){

                                artistRelationPayload = {"action": "addOrEditArtistRelationWithOtherFields",
                                                      "artistprofileid1":pid1,
                                                      "artistprofileid2":pid2,
                                                      "artistname1":fullname1,
                                                      "artistemailId1":email1,
                                                      "artistname2":fullname2,
                                                      "artistemailId2":email2,
                                                      "artistwebsite2":website2,
                                                      "artistrelation":selected_checkboxes[i]
                                                    };

                                if(selected_checkboxes[i]=='Danced in the Work of'){
                                    console.log(works);
                                    artistRelationPayload.works=works;
                                }

                                $.ajax({
                                  type: "POST",
                                  url: 'artistrelationcontroller.php',
                                  data: JSON.stringify(artistRelationPayload),
                                     success: function(response) {
                                       //console.log("new artist added to db for artist relation");
                                       loopLength--;
                                       if(loopLength==0){
                                          // Add genres in artist_genres

                                         //reload table
                                           $('#display_relations').DataTable().ajax.reload();
                                           isArtistEntryFormPopulated=false;
                                           artistIdInForm=null;

                                           var genreList = document.getElementById('lineal_genre');
                                           genreListLength = genreList.options.length;
                                           for(var i=0; i<genreListLength; i++){
                                               genreListOption = genreList.options[i];
                                               genreListValue = genreList.options[i].value;

                                               genreListOption.selected=false;
                                               //console.log(genreListOption.selected);
                                           }
                                           $('.multi-select-dd').fSelect('reload');
                                           $('#add_user_profile_form')[0].reset();


                                       }
                                    },
                                    error: function(response){
                                      console.log(response);
                                    }
                                });
                              }


                            }
                        });


                      }
                  });


                }
          });

      });



});
$('#accept').click(function(){
        $( "#dialog-1" ).dialog( "close" );
        document.getElementById("terms").checked = true;
});

function readTermsConditions(){
      $( "#dialog-1" ).dialog({
        width: 600
      });
    $( "#dialog-1" ).dialog( "open" );
    console.log("ok")
}

$("#previous").click(function() {
    if(disabled_input){
        window.open("add_artist_biography.php","_self");
    }else{

        window.open("about_lineage.php","_self");
    }
});
</script>
</html>
