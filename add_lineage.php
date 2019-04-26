<?php
include 'path.php';
include 'menu.php';
include 'util.php';
my_session_start();
if($_SESSION["timeline_flow"] == "view"){
    echo "<script>var disabled_input=true;</script>";
}else{
    echo "<script>var disabled_input=false;</script>";
}
$artist_fname=$_SESSION["artist_first_name"];
$artist_lname=$_SESSION["artist_last_name"];
$artist_fullname=$artist_fname.' '.$artist_lname;
?>

<html>
<head>
    <title>Add Lineage</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>

<body onload="getData()">
<div class="row">
    <div class="progress" role="progressbar" tabindex="0" aria-valuenow="80" aria-valuemin="0" aria-valuetext="80 percent" aria-valuemax="100">
            <span class="progress-meter" style="width: 80%">
                <p class="progress-meter-text">80%</p>
            </span>
    </div>
</div>
<div class="row">
    <div class="large-4 columns large-offset-4">
        <h4><strong><?php echo ((isset($_SESSION["profile_selection"])&&$_SESSION["profile_selection"] == "artist")?"YOUR LINEAGE":'You are contributing lineage for '.$artist_fullname); ?></strong></h4>
    </div>
</div>
<div class="medium-9 row"><p><i>Lineal artists are the people with whom you have studied, danced, collaborated and have been influenced by.</i></p></div>
<form id="add_user_profile_form" name="add_user_profile_form" method="POST" action="add_lineage_mediator.php" enctype="multipart/form-data">
    <?php if(isset($_SESSION['lineage_artist_first_name']) && count($_SESSION['lineage_artist_first_name']) > 0): ?>
        <?php foreach ($_SESSION['lineage_artist_first_name'] as $key => $value): ?>
            <div class="row artist_lineage_container" id="artist_lineage_container" style="margin-bottom:2%">
                <div class="medium-10 column">
                    <section>
                        <fieldset>
                            <div class="row">
                                <div class="small-4 column">
                                    <p class="lineal_header"><strong>LINEAL ARTIST <span class="lineal_artist_number"><?php echo ($key + 1) ?><span></strong></p>
                                </div>
                                <div class="small-4 small-offset-4 column">
                                    <button class="primary alert button delete_artist artist_button
                                            " style="float:right" id="delete_artist" type="button" onclick="deleteArtist(this)">
                                        <span>Remove this Artist</span>
                                    </button>
                                </div>
                                <input style="display:none" value="<?php echo ($key + 1) ?>" class="artist_number">
                            </div>
                            <div class="row">
                                <div class="small-3 column">
                                    <label for="artist_first_name<?php echo '-'.$key ?>">First Name<large style="color:red;font-weight: bold;"> *</large>
                                        <input  autocomplete="off" type="text" class="artist_first_name"  id="artist_first_name<?php echo '-'.$key ?>" name="lineage_artist_first_name[]" placeholder="First Name"
                                                value="<?php echo $value ?>"
                                        />
                                    </label>
                                </div>
                                <div class="small-3 column">
                                    <label for="artist_last_name<?php echo '-'.$key ?>">Last Name <large style="color:red;font-weight: bold;"> *</large>
                                        <input  autocomplete="off" type="text" class="artist_last_name" id="artist_last_name<?php echo '-'.$key ?>" name="lineage_artist_last_name[]" placeholder="Last Name"
                                                value="<?php echo (isset($_SESSION['lineage_artist_last_name'][$key])?$_SESSION['lineage_artist_last_name'][$key]:'')?>"
                                        />
                                    </label>
                                </div>
                                <div class="small-3 column">
                                    <label for="artist_email_address<?php echo '-'.$key ?>">Email Address <small></small>
                                        <input  autocomplete="off" type="text" class="artist_email_address" id="artist_email_address<?php echo '-'.$key ?>" name="lineage_artist_email_address[]" placeholder="Email Address"
                                                value="<?php echo (isset($_SESSION['lineage_artist_email_address'][$key])?$_SESSION['lineage_artist_email_address'][$key]:'')?>"
                                        />
                                    </label>
                                </div>
                                <div class="small-3 column">
                                    <label for="artist_website<?php echo '-'.$key ?>">Website <small></small>
                                        <input  autocomplete="off" type="text" class="artist_website" id="artist_website<?php echo '-'.$key ?>" name="lineage_artist_website[]" placeholder="Website"
                                                value="<?php echo (isset($_SESSION['lineage_artist_website'][$key])?$_SESSION['lineage_artist_website'][$key]:'')?>"
                                        />
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-12 column">
                                    <label>Type of Relationship<large style="color:red;font-weight: bold;"> *</large>
                                        <span style = "cursor: pointer;" title="Select at least one type of relationship." disabled ="true" ><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                </div>
                                <div class="small-12 column">
                                    <div class="row collapse">
                                        <div class="medium-3 columns">
                                            <ul class="vertical tabs" data-tabs id="relation-tabs<?php echo '-'.$key ?>">
                                                <li class="tabs-title is-active"><a href="#panel1v<?php echo '-'.$key ?>" aria-selected="true" aria-controls="panel1v<?php echo '-'.$key ?>">
                                                        <input class="relationship relation_studied_cb" name="relationship_studied[]" id="relationship_studied<?php echo '-'.$key ?>" type="checkbox" title="studied_with_section" value="<?php echo $key ?>"
                                                            <?php
                                                            if(isset($_SESSION['studied_under'])){
                                                                echo (isset($_SESSION['studied_under'][$key])?'checked':'');
                                                            }
                                                            ?>
                                                        />
                                                        <label for="relationship_studied<?php echo '-'.$key ?>">Studied Under</label><span style = "cursor: pointer;" title="Teachers/people under whom you have studied."><img src="img/help.png" style="height:13px;width:13px;"/></span>
                                                    </a></li>
                                                <li class="tabs-title"><a href="#panel2v<?php echo '-'.$key ?>" aria-controls="panel2v<?php echo '-'.$key ?>">
                                                        <input class="relationship relation_danced_cb" name="relationship_danced[]" id="relationship_danced<?php echo '-'.$key ?>" type="checkbox" title="danced__with_section" value="<?php echo $key ?>"
                                                            <?php
                                                            if(isset($_SESSION['danced_with'])){
                                                                echo (isset($_SESSION['danced_with'][$key])?'checked':'');
                                                            }
                                                            ?>
                                                        />
                                                        <label for="relationship_danced<?php echo '-'.$key ?>">Danced in the Work of</label><span style = "cursor: pointer;" title="Choreographers whose works you have danced in."><img src="img/help.png" style="height:13px;width:13px;"/></span>
                                                    </a></li>
                                                <li class="tabs-title"><a href="#panel3v<?php echo '-'.$key ?>" aria-controls="panel3v<?php echo '-'.$key ?>">
                                                        <input class="relationship relation_collaborated_cb" name="relationship_collaborated[]" id="relationship_collaborated<?php echo '-'.$key ?>" type="checkbox" title="collaborated_with_section" value="<?php echo $key ?>"
                                                            <?php
                                                            if(isset($_SESSION['collaborated_with'])){
                                                                echo (isset($_SESSION['collaborated_with'][$key])?'checked':'');
                                                            }
                                                            ?>
                                                        />
                                                        <label for="relationship_collaborated<?php echo '-'.$key ?>">Collaborated Under</label><span style = "cursor: pointer;" title="Artists with whom you have collaborated."><img src="img/help.png" style="height:13px;width:13px;"/></span>
                                                    </a></li>
                                                <li class="tabs-title"><a href="#panel4v<?php echo '-'.$key ?>" aria-controls="panel4v<?php echo '-'.$key ?>">
                                                        <input class="relationship relation_influenced_cb" name="relationship_influenced[]" id="relationship_influenced<?php echo '-'.$key ?>" type="checkbox" title="influenced_by_section" value="<?php echo $key ?>"
                                                            <?php
                                                            if(isset($_SESSION['influenced_by'])){
                                                                echo (isset($_SESSION['influenced_by'][$key])?'checked':'');
                                                            }
                                                            ?>
                                                        />
                                                        <label for="relationship_influenced<?php echo '-'.$key ?>">Influenced By</label>
                                                    </a></li>
                                            </ul>
                                        </div>
                                        <div class="medium-9 columns">
                                            <div class="tabs-content" data-tabs-content="relation-tabs<?php echo '-'.$key ?>">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </section>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="row artist_lineage_container" id="artist_lineage_container" style="margin-bottom:2%">
            <div class="medium-10 column">
                <section>
                    <fieldset>
                        <div class="row">
                            <div class="small-4 column">
                                <p class="lineal_header"><strong>LINEAL ARTIST <span class="lineal_artist_number">1<span></strong></p>
                            </div>
                            <div class="small-4 small-offset-4 column">
                                <button class="primary alert button delete_artist artist_button" style="float:right" id="delete_artist" type="button" onclick="deleteArtist(this)">
                                    <span>Remove this Artist</span>
                                </button>
                            </div>
                            <input style="display:none" value="1" class="artist_number">
                        </div>
                        <div class="row">
                            <div class="small-3 column">
                                <label for="artist_first_name">First Name <large style="color:red;font-weight: bold;"> *</large>
                                    <input type="text" class="artist_first_name"  id="artist_first_name-1" name="lineage_artist_first_name[]" placeholder="First Name">
                                </label>
                            </div>
                            <div class="small-3 column">
                                <label for="artist_last_name">Last Name <large style="color:red;font-weight: bold;"> *</large>
                                    <input  autocomplete="off" type="text" class="artist_last_name" id="artist_last_name-1" name="lineage_artist_last_name[]" placeholder="Last Name" >
                                </label>
                            </div>
                            <div class="small-3 column">
                                <label for="artist_email_address">Email Address
                                    <input  autocomplete="off" type="text" class="artist_email_address" id="artist_email_address-1" name="lineage_artist_email_address[]" placeholder="Email Address">
                                </label>
                            </div>
                            <div class="small-3 column">
                                <label for="artist_website">Website <small></small>
                                    <input  autocomplete="off" type="text" class="artist_website" id="artist_website-1" name="lineage_artist_website[]" placeholder="Website">
                                </label>
                            </div>
                            <div class="small-3 column">
                                <label for="artist_genre">Genre <small></small>
                                    <input type="text" class="artist_genre" id="artist_genre-1" name="lineage_artist_genre[]" placeholder="Select">
                                </label>
                            </div>

                        </div>


                        <div class="row">
                            <div class="small-12 column">
                                <label>Type of Relationship <large style="color:red;font-weight: bold;"> *</large>
                                    <span style = "cursor: pointer;" title="Select at least one type of relationship." disabled ="true" ><img src="img/help.png" style="height:15px;width:15px;"/></span>
                            </div>
                            <div class="small-12 column">
                                <div class="row collapse">
                                    <div class="medium-3 columns">
                                        <ul class="vertical tabs" data-tabs id="relation-tabs-1">
                                            <li class="tabs-title is-active"><a href="#panel1v-1" aria-selected="true">
                                                    <input class="relationship relation_studied_cb" name="relationship_studied[]" id="relationship_studied-1" type="checkbox" title="studied_with_section" value="0"><label for="relationship_studied">Studied Under</label><span style = "cursor: pointer;" title="Teachers/people under whom you have studied."><img src="img/help.png" style="height:13px;width:13px;"/></span>
                                                </a></li>
                                            <li class="tabs-title"><a href="#panel2v-1">
                                                    <input class="relationship relation_danced_cb" name="relationship_danced[]" id="relationship_danced-1" type="checkbox" title="danced_for_section" value="0"><label for="relationship_danced">Danced in the Work of</label><span style = "cursor: pointer;" title="Choreographers whose works you have danced in."><img src="img/help.png" style="height:13px;width:13px;"/></span>
                                                </a></li>
                                            <li class="tabs-title"><a href="#panel3v-1">
                                                    <input class="relationship relation_collaborated_cb" name="relationship_collaborated[]" id="relationship_collaborated-1" type="checkbox" title="collaborated_with_section" value="0"><label for="relationship_collaborated">Collaborated With</label><span style = "cursor: pointer;" title="Artists with whom you have collaborated."><img src="img/help.png" style="height:13px;width:13px;"/></span>
                                                </a></li>
                                            <li class="tabs-title"><a href="#panel4v-1">
                                                    <input class="relationship relation_influenced_cb" name="relationship_influenced[]" id="relationship_influenced-1" type="checkbox" title="influenced_by_section" value="0"><label for="relationship_influenced">Influenced By</label>
                                                </a></li>
                                        </ul>
                                    </div>
                                    <div class="medium-9 columns">
                                        <div class="tabs-content" data-tabs-content="relation-tabs-1">


                                          <!-- Studied Under tab -->
                                          <div class="tabs-panel studied_under_section is-active" id="panel1v-1">
                                              <fieldset>
                                                  <legend><strong>Studied Under Details:</strong></legend>
                                                  <div class="row not_studied">
                                                      <input class="relation_type" title="studied" style="display:none"/>
                                                      <div class="column">
                                                          <div class="row">
                                                              <div class="column">
                                                                  Studied Under
                                                              </div>
                                                          </div>
                                                          <div class="row">
                                                              <center>
                                                                  <button class="primary button studied_under" type="button" style="margin-top:5%">
                                                                      <span>Studied Under</span>
                                                                  </button>
                                                              </center>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="row studied" style="display:none;">
                                                      <div class="column" style="color:darkgreen;">
                                                          <center><h3><strong>You have studied under this Artist</h3></strong></center>
                                                      </div>
                                                  </div>
                                              </fieldset>
                                          </div>

                                          <!-- Danced In the work of tab -->
                                          <div class="tabs-panel danced_with_section" id="panel2v-1">
                                              <fieldset>
                                                  <legend><strong>Danced in the work of Details:</strong></legend>
                                                  <div class="row not_danced">
                                                      <input class="relation_type" title="danced" style="display:none"/>
                                                      <div class="column">
                                                          <div class="row">
                                                              <div class="column">
                                                                  Danced in the work of
                                                              </div>
                                                          </div>
                                                          <div class="row">
                                                              <center>
                                                                  <button class="primary button danced_with" type="button" style="margin-top:5%">
                                                                      <span>Danced in the work of</span>
                                                                  </button>
                                                              </center>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="row danced" style="display:none;">
                                                      <div class="column" style="color:darkgreen;">
                                                          <center><h3><strong>You have danced in the work of this Artist</h3></strong></center>
                                                      </div>
                                                  </div>
                                              </fieldset>
                                          </div>

                                          <!-- Collaborated With tab -->
                                          <div class="tabs-panel collaborated_with_section" id="panel3v-1">
                                              <fieldset>
                                                  <legend><strong>Collaborated With Details:</strong></legend>
                                                  <div class="row not_collaborated">
                                                      <input class="relation_type" title="collaborated" style="display:none"/>
                                                      <div class="column">
                                                          <div class="row">
                                                              <div class="column">
                                                                  Collaborated With
                                                              </div>
                                                          </div>
                                                          <div class="row">
                                                              <center>
                                                                  <button class="primary button collaborated_with" type="button" style="margin-top:5%">
                                                                      <span>Collaborated with</span>
                                                                  </button>
                                                              </center>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="row collaborated" style="display:none;">
                                                      <div class="column" style="color:darkgreen;">
                                                          <center><h3><strong>You have collaborated with this Artist</h3></strong></center>
                                                      </div>
                                                  </div>
                                              </fieldset>
                                          </div>

                                            <!-- Influenced By tab -->
                                            <div class="tabs-panel influenced_by_section" id="panel4v-1">
                                                <fieldset>
                                                    <legend><strong>Influenced by Details:</strong></legend>
                                                    <div class="row not_influenced">
                                                        <input class="relation_type" title="influenced" style="display:none"/>
                                                        <div class="column">
                                                            <div class="row">
                                                                <div class="column">
                                                                    People who have significantly influenced your work, such as artists, authors, philosophers, etc. You do not need
                                                                    to have a relationship with this person in order to list them as having an impact on your work.
                                                                    By choosing Influenced by you are acknowledging that you have been influenced by this person. No time based data
                                                                    is necessary.
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <center>
                                                                    <button class="primary button influenced_by" type="button" style="margin-top:5%">
                                                                        <span>Influenced by</span>
                                                                    </button>
                                                                </center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row influenced" style="display:none;">
                                                        <div class="column" style="color:darkgreen;">
                                                            <center><h3><strong>You are influenced by this Artist</h3></strong></center>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </section>
            </div>
        </div>
    <?php endif; ?>


    <div class="row artist_button">
        <div class="large-4 columns large-offset-4">
            <button class="secondary success button " id="addArtist" type="button">
                <span>Save and Add another Artist</span>
            </button>
        </div>
    </div>

    <!--<div class="row">
        <input type="checkbox" name="terms" id="terms" value="accepted">Accept Terms and Condition</div>
    </div>-->

    <div class="row">
        <input type="checkbox" name="terms" id="terms" value="accepted">  Accept <a href="javascript:readTermsConditions();">Terms and Conditions</a></input>
        <!--<button text="Read terms and conitions here" id="read_terms" name="read_terms" onclick="readTermsConditions()"/>-->
    </div>
    <div id = "dialog-1" style="font-weight: bold;width:600px;height:700px"
         title = "TERMS AND CONDITIONS">
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
                <button class="primary button float-right" type="button" name="previous" id="previous">
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
                <button class="primary button float-right" type="button" name="previous" id="previous">
                    <span>Previous</span>
                </button>
            </div>
            <div class="large-2 small-8 column">
                <button class="primary button" type="submit" name="save" id="save">
                    <span>Save</span>
                </button>
            </div>
        <?php endif; ?>
        <?php if($_SESSION["timeline_flow"] == "view"):?>
            <div class="large-2 small-8 column">
                <button class="primary button float-right" type="button" name="previous" id="previous">
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

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="js/combo/Drop-Down-Combo-Tree/style.css">
<script src="js/combo/Drop-Down-Combo-Tree/comboTreePlugin.js"></script>
<script src="js/combo/Drop-Down-Combo-Tree/icontains.js"></script>
<script type="text/javascript" src="js/getData.js"></script>
</body>


<script type="text/javascript">
    var count = 0;

    function checkfunction(){
      $('')
    }

    function duplicate(divName) {
        var rootToDuplicate = divName.parentNode.parentNode.parentNode.parentNode;
        var rootsId = divName.parentNode.parentNode.parentNode.parentNode.id;


        var divClone = rootToDuplicate.cloneNode(true);

        var rootsParent = rootToDuplicate.parentNode;
        var parentsClass = rootsParent.className;

        var parentClassPrefix = parentsClass.substring(0, 13);

        var rootsPrefix = rootsId.substring(0, 12);
        var divIdLength = rootsId.length;
        var suffix = rootsId.substring(12,divIdLength+1);
        if(suffix == 0)
            suffix = '';

        divClone.id = rootsPrefix + ++count;

        var changeButton = divClone.querySelector("#"+parentClassPrefix+"toggle"+suffix);
        var durDiv= divClone.querySelector("#"+parentClassPrefix+"duration_div"+suffix);
        var rangeDiv = divClone.querySelector("#"+parentClassPrefix+"range_div"+suffix);

        changeButton.id = parentClassPrefix+"toggle"+count;
        durDiv.id = parentClassPrefix+"duration_div"+count;
        rangeDiv.id = parentClassPrefix+"range_div"+count;

        rangeDiv.style.display="block";
        durDiv.style.display="none";

        all = rangeDiv.getElementsByTagName('select');
        for (i = 0; i < all.length; i++) {
            all[i].removeAttribute("disabled");
        }



        all = durDiv.getElementsByTagName('input');
        for (i = 0; i < all.length; i++) {
            all[i].setAttribute("disabled", "disabled");
        }
        all = durDiv.getElementsByTagName('select');
        for (i = 0; i < all.length; i++) {
            all[i].setAttribute("disabled", "disabled");
        }

        divName.parentNode.parentNode.parentNode.parentNode.parentNode.appendChild(divClone);
        dateScripts();
        //updateRemoveVisibility(rootsParent, divName, 4);
    }


    function isRemovable(divName, root_up_count){
        for(var i=0; i<root_up_count; i++){
            divName = divName.parentNode;
        }
        var parent = document.getElementById(divName.parentNode.id);

        var childCount = parent.childElementCount;

        if(childCount<2)
            return false;

        return true;
    }

    function commonClassSiblingExists(divName){
        var node = document.getElementById(divName.id).parentNode.firstChild;
        while ( node ) {
            node = node.nextElementSibling || node.nextSibling;
            if ( node.id != divName.id && node.nodeType === Node.ELEMENT_NODE )
                if(node.className == divName.className)
                    return false;
        }

        return true;
    }


    function remove(divName, root_up_count) {
        var element = document.getElementById(divName.parentNode.parentNode.parentNode.parentNode.id);
        var current = document.getElementById(divName.parentNode.parentNode.parentNode.parentNode.parentNode.id);
        if(isRemovable(divName, root_up_count)) {
            console.log(divName.parentNode.parentNode.parentNode.parentNode.id);

            element.outerHTML = "";
            delete element;
            //updateRemoveVisibility(parent, divName, 4);
        }
        else{
            alert("Please enter value for removal");

            element.querySelector(".range_from_months").value="";
            element.querySelector(".range_from_years").value="";
            element.querySelector(".range_to_months").value="";
            element.querySelector(".range_to_years").value="";

            element.querySelector(".duration_years").value="";
            element.querySelector(".duration_months").value="";
            element.querySelector(".duration_from_years").value="";
            element.querySelector(".duration_to_years").value="";

            var curr_root = document.getElementById(divName.parentNode.parentNode.parentNode.parentNode.id);

            //var relation_root = curr.closest(".duration_selection").parent().parent().parent();

            var relation_type = curr_root.querySelector(".relation_type").getAttribute("title");

            var relation_checkbox_root = divName.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;

            var relation_checkbox = relation_checkbox_root.querySelector(".relation_" + relation_type + "_cb");
            //var relation_checkbox = $(curr).closest(".duration_selection").parent().parent().parent().parent().parent().parent().find(".relation_" + relation_type + "_cb");
            $(relation_checkbox).prop('checked', false);
            $(relation_checkbox).hide();

        }
    }

    function updateRemoveVisibility(parent, divName, root_up_count){
        for(var i=0; i<root_up_count; i++){
            divName = divName.parentNode;
        }
        var divPrefix = divName.id.substring(0, 12);
        //var parent = document.getElementById(divName.parentNode.id);

        var childCount = parent.childElementCount;

        var i =0;
        if(childCount==1) {
            while(childCount>0){
                var node = parent.childNodes[i];
                if(node.id != null) {
                    parent.childNodes[i].querySelector("#remove_button").style.display = "none";
                    childCount--;
                }
                i++;
            }

        }
        else if(childCount >= 2){
            while(childCount>0){
                var node = parent.childNodes[i];
                if(node.id != null) {
                    node.querySelector("#remove_button").style.display = "block";
                    childCount--;
                }
                i++;
            }
        }
    }

    var lineal_artist_count = 1;
    function deleteArtist(ele){
        if($(".artist_lineage_container").length > 1){
            lineal_artist_count = lineal_artist_count - 1;
            var artist_number_removed = parseInt($(ele).parent().parent().find(".artist_number").val());
            $(ele).closest(".artist_lineage_container").remove();
            var list_of_artist = $(".artist_lineage_container");
            for(var i = artist_number_removed - 1; i < lineal_artist_count; i++){
                var num = i + 1;
                var artist_object = list_of_artist[i];
                $(artist_object).find(".lineal_artist_number").html(num);
                $(artist_object).find(".tabs").attr("id", $(artist_object).find(".tabs").attr("id").split("-")[0] + "-" + num);
                $(artist_object).find(".tabs-content").attr("data-tabs-content", $(artist_object).find(".tabs-content").attr("data-tabs-content").split("-")[0] + "-" + num);
                for(var j = 0; j < 4; j++){
                    var temp = $(artist_object).find(".tabs").find("a")[j];
                    $(temp).attr("href", $(temp).attr("href").split("-")[0] + "-" + num);
                    $(temp).attr("aria-controls", $(temp).attr("aria-controls").split("-")[0] + "-" + num);
                }
                for(var k = 0; k < 4; k++){
                    var temp = $(artist_object).find(".tabs-panel")[k];
                    $(temp).attr("id", $(temp).attr("id").split("-")[0] + "-" + num);
                }
                $(artist_object).find(".artist_number").val(num);
                $(artist_object).find(".relation_influenced_cb").val(i);
            }
        }else{
            if($(".artist_lineage_container").length == 1){
            alert("Artist cannot be deleted");
            }
            lineal_artist_count = 1;
            var artist_object = $(ele).closest(".artist_lineage_container");
            $(artist_object).find("input:text").val("");
            $(artist_object).find("input:checkbox").attr("checked",false);
            $(artist_object).find(".lineal_artist_number").html(lineal_artist_count);
            $(artist_object).find(".duration_years").prop("readonly",false);
            $(artist_object).find(".duration_months").prop("readonly",false);
            $(artist_object).find(".relationship").hide();
            $(artist_object).find(".tabs").attr("id", $(artist_object).find(".tabs").attr("id").split("-")[0] + "-" + lineal_artist_count);
            $(artist_object).find(".tabs-content").attr("data-tabs-content", $(artist_object).find(".tabs-content").attr("data-tabs-content").split("-")[0] + "-" + lineal_artist_count);
            for(var i = 0; i < 4; i++){
                var temp = $(artist_object).find(".tabs").find("a")[i];
                $(temp).attr("href", $(temp).attr("href").split("-")[0] + "-" + lineal_artist_count);
                $(temp).attr("aria-controls", $(temp).attr("aria-controls").split("_")[0] + "_" + lineal_artist_count);
            }
            for(var i = 0; i < 4; i++){
                var temp = $(artist_object).find(".tabs-panel")[i];
                $(temp).attr("id", $(temp).attr("id").split("-")[0] + "-" + lineal_artist_count);
            }
            $(artist_object).find(".artist_number").val(lineal_artist_count);
            $(artist_object).find(".relation_influenced_cb").val(0);
        }
    }
    $("#addArtist").click(function(){
      if(lineal_artist_count<50){
        lineal_artist_count = lineal_artist_count + 1;
        var clone = $('.artist_lineage_container:last').clone();
        clone.find("input:text").val("");
        clone.find("input:checkbox").attr("checked",false);
        clone.find(".lineal_artist_number").html(lineal_artist_count);
        clone.find(".duration_years").prop("readonly",false);
        clone.find(".duration_months").prop("readonly",false);
        clone.find(".relationship").hide();
        clone.find(".tabs-title").removeClass("is-active");
        $(clone.find(".tabs-title")[0]).addClass("is-active");
        clone.find(".tabs-panel").removeClass("is-active");
        $(clone.find(".tabs-panel")[0]).addClass("is-active");
        clone.find(".relation_influenced_cb").val(lineal_artist_count - 1);
        clone.find(".influenced_by_section").html(
            "<fieldset>"
            +   "<legend><strong>Influenced by Details:</strong></legend>"
            +   "<div class='row not_influenced'>"
            +       "<input class='relation_type' title='influenced' style='display:none'/>"
            +       "<div class='column'>"
            +           "<div class='row'>"
            +               "<div class='column'>"
            +                   "People who have significantly influenced your work, such as artists, authors, philosophers, etc. You do not need"
            +                   "to have a relationship with this person in order to list them as having an impact on your work."
            +                   "By choosing Influenced by you are acknowledging that you have been influenced by this person. No time based data"
            +                   "is necessary."
            +               "</div>"
            +           "</div>"
            +           "<div class='row'>"
            +               "<center>"
            +                   "<button class='primary button influenced_by' type='button' style='margin-top:5%'>"
            +                       "<span>Influenced by</span>"
            +                   "</button>"
            +               "</center>"
            +           "</div>"
            +       "</div>"
            +   "</div>"
            +   "<div class='row influenced' style='display:none;'>"
            +       "<div class='column' style='color:darkgreen;'>"
            +           "<center><h3><strong>You are influenced by this Artist</h3></strong></center>"
            +       "</div>"
            +   "</div>"
            + "</fieldset>"
        );
        clone.find(".tabs").attr("id", clone.find(".tabs").attr("id").split("-")[0] + "-" + lineal_artist_count);
        clone.find(".tabs-content").attr("data-tabs-content", clone.find(".tabs-content").attr("data-tabs-content").split("-")[0] + "-" + lineal_artist_count);
        for(var i = 0; i < 4; i++){
            var temp = $(clone).find(".tabs").find("a")[i];
            $(temp).attr("href", $(temp).attr("href").split("-")[0] + "-" + lineal_artist_count);
        }
        for(var i = 0; i < 4; i++){
            var temp = $(clone).find(".tabs-panel")[i];
            $(temp).attr("id", $(temp).attr("id").split("-")[0] + "-" + lineal_artist_count);
        }
        clone.find(".artist_number").val(lineal_artist_count);
        clone.insertAfter('.artist_lineage_container:last');
        var scrollPos =  $(".artist_lineage_container:last").offset().top;
        $(window).scrollTop(scrollPos);
        dateScripts();
        $(document).foundation();
        //deleteArtist();
      }
      else{
        alert("Cannot add more than 50 Artists!");
      }
    });
    $("#previous").click(function() {
        // onclick event is assigned to the #button element.
        if(disabled_input){
            window.open("add_artist_biography.php","_self");
        }else{
            //add_user_profile_form
            //$("#add_artist_personal_id").serialize()
            $.ajax({
                type: "POST",
                url: "save_add_artist_pi_back.php",
                data: $("#add_user_profile_form").serialize(),
                success: function(response) {
                    console.log(response);
                    //success message mybe...
                    // alert("SUCCESS");
                }
            });
            <?php unset($_SESSION['lineage_artist_first_name']);?>
            window.open("about_lineage.php","_self");
        }
    });

    /*$("#terms_and_condition_link").click(function() {
        alert("1. You are filling this form out voluntarily.\n" +
            "2. You are aware that the information you provide will be used as a global resource, accessible to the general public, unless otherwise noted in the survey. \n" +
            "3. Choreographic Lineage will not sell, share or rent your personal information to any third party or use your e-mail address for unsolicited mail. Any emails sent by Choreograhic Lineage will only be in connection with the Choreographic Lineage resource. \n" +
            "4. The information you provide to Choreographic Lineage is accurate to the best of your knowledge. \n" +
            "5. You are accepting the terms and conditions for your current entries and your future additions to your lineage.");
    }*/


    function dateScripts(){



        $(".relationship").click(function(){
            console.log($(this).attr("title"));
            var relation_section = $(this).closest(".row").find("."+$(this).attr("title"));
            if($(this).attr("title") == "studied_under_section"){
                $(this).prop('checked', false);
                $(this).hide();
                $(relation_section).find(".studied").hide();
                $(relation_section).find(".not_studied").show();
            }
            else if($(this).attr("title") == "danced_with_section"){
                $(this).prop('checked', false);
                $(this).hide();
                $(relation_section).find(".danced").hide();
                $(relation_section).find(".not_danced").show();
            }
            else if($(this).attr("title") == "collaborated_with_section"){
                $(this).prop('checked', false);
                $(this).hide();
                $(relation_section).find(".collaborated").hide();
                $(relation_section).find(".not_collaborated").show();
            }
            else if($(this).attr("title") == "influenced_by_section"){
                $(this).prop('checked', false);
                $(this).hide();
                $(relation_section).find(".influenced").hide();
                $(relation_section).find(".not_influenced").show();
            }
        });

        $(".studied_under").click(function(){
            var relation_checkbox = $(this).closest(".not_studied").parent().parent().parent().parent().parent().find(".relation_" + "studied" + "_cb");
            $(relation_checkbox).prop('checked', true);
            $(relation_checkbox).show();
            $(this).closest("fieldset").find(".studied").show();
            $(this).closest("fieldset").find(".not_studied").hide();
        });

        $(".danced_with").click(function(){
            var relation_checkbox = $(this).closest(".not_danced").parent().parent().parent().parent().parent().find(".relation_" + "danced" + "_cb");
            $(relation_checkbox).prop('checked', true);
            $(relation_checkbox).show();
            $(this).closest("fieldset").find(".danced").show();
            $(this).closest("fieldset").find(".not_danced").hide();
        });

        $(".collaborated_with").click(function(){
            var relation_checkbox = $(this).closest(".not_collaborated").parent().parent().parent().parent().parent().find(".relation_" + "collaborated" + "_cb");
            $(relation_checkbox).prop('checked', true);
            $(relation_checkbox).show();
            $(this).closest("fieldset").find(".collaborated").show();
            $(this).closest("fieldset").find(".not_collaborated").hide();
        });

        $(".influenced_by").click(function(){
            var relation_checkbox = $(this).closest(".not_influenced").parent().parent().parent().parent().parent().find(".relation_" + "influenced" + "_cb");
            $(relation_checkbox).prop('checked', true);
            $(relation_checkbox).show();
            $(this).closest("fieldset").find(".influenced").show();
            $(this).closest("fieldset").find(".not_influenced").hide();
        });
    }




    $(document).ready(function(){


        $(function() {
            // this will get the full URL at the address bar
            var url = window.location.href;
            if(url.search("about_lineage.php"))
            {
                var lineage_contri = document.getElementById("contri_lineage");
                $(lineage_contri).addClass('active');
            }
        });


        dateScripts();

        $( "#dialog-1" ).dialog({
            autoOpen: false,
        });

        $('#accept').click(function(){
        //console.log("I am clicked");
        $( "#dialog-1" ).dialog( "close" );
        document.getElementById("terms").checked = true;
     });

     $('#ui-id-1').click(function(){
        //console.log("I am clicked");
        $( "#dialog-1" ).dialog( "close" );
        document.getElementById("terms").checked = false;
     });

        var relation = $(".relationship");
        for (var i = 0; i < relation.length; i++) {
            if(!$(relation[i]).is(":checked")){
                $(relation[i]).hide();
            }
        }
        //deleteArtist();
        lineal_artist_count = parseInt($(".artist_lineage_container:last").find(".artist_number").val());
        //$(".relationship").prop('disabled', true);
        if(disabled_input){
            $('input').attr('disabled','true');
            $('.artist_button').hide();
        }
    });
    $(document).foundation();
    $(function () {
        $("#btnAdd").bind("click", function () {
            var div = $("<div />");
            div.html(GetDynamicTextBox(""));
            $("#TextBoxContainer").append(div);
        });
        $("#btnGet").bind("click", function () {
            var values = "";
            $("input[name=DynamicTextBox]").each(function () {
                values += $(this).val() + "\n";
            });
            alert(values);
        });
        $("body").on("click", ".remove", function () {
            $(this).closest("div").remove();
        });
    });
    function GetDynamicTextBox(value) {
        return '<input name = "DynamicTextBox" type="text" value = "' + value + '" />&nbsp;' +
            '<input type="button" value="Remove" class="remove" />'
    }


    function readTermsConditions(){
        $( "#dialog-1" ).dialog({
            width: 600
        })

        $( "#dialog-1" ).dialog( "open" );
    }

    $('#add_user_profile_form').submit(function(event){
        if($('#terms').is(':checked') == false){
            event.preventDefault();
            alert("Please accept terms and conditions to submit.");
            return false;
        }
    });

</script>
<?php
include 'form_links_footer.php';
include 'footer.php';
?>

</html>
