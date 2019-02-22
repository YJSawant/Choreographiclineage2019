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
        <h4><strong><?php echo ((isset($_SESSION["profile_selection"])&&$_SESSION["profile_selection"] == "artist")?"YOUR":"ARTIST'S"); ?> LINEAGE</strong></h4>
    </div>
</div>
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
                                                        <input class="relationship relation_studied_cb" name="relationship_studied[]" id="relationship_studied<?php echo '-'.$key ?>" type="checkbox" title="studied_with_section"
                                                            <?php
                                                            if(isset($_SESSION['studied_duration_months'])){
                                                                echo (($_SESSION['studied_duration_months'][$key] != '' || $_SESSION['studied_duration_years'][$key] != '') &&
                                                                ($_SESSION['studied_duration_months'][$key] != 0 || $_SESSION['studied_duration_years'][$key] != 0) ?'checked':'');
                                                            }
                                                            ?>
                                                        />
                                                        <label for="relationship_studied<?php echo '-'.$key ?>">Studied With</label>
                                                    </a></li>
                                                <li class="tabs-title"><a href="#panel2v<?php echo '-'.$key ?>" aria-controls="panel2v<?php echo '-'.$key ?>">
                                                        <input class="relationship relation_danced_cb" name="relationship_danced[]" id="relationship_danced<?php echo '-'.$key ?>" type="checkbox" tilte="danced__with_section"
                                                            <?php
                                                            if(isset($_SESSION['danced_duration_months'])){
                                                                echo (($_SESSION['danced_duration_months'][$key] != '' || $_SESSION['danced_duration_years'][$key] != '') &&
                                                                ($_SESSION['danced_duration_months'][$key] != 0 || $_SESSION['danced_duration_years'][$key] != 0) ?'checked':'');
                                                            }
                                                            ?>
                                                        />
                                                        <label for="relationship_danced<?php echo '-'.$key ?>">Danced For</label>
                                                    </a></li>
                                                <li class="tabs-title"><a href="#panel3v<?php echo '-'.$key ?>" aria-controls="panel3v<?php echo '-'.$key ?>">
                                                        <input class="relationship relation_collaborated_cb" name="relationship_collaborated[]" id="relationship_collaborated<?php echo '-'.$key ?>" type="checkbox" title="colbrtd_with_section"
                                                            <?php
                                                            if(isset($_SESSION['collaborated_duration_months'])){
                                                                echo (($_SESSION['collaborated_duration_months'][$key] != '' || $_SESSION['collaborated_duration_years'][$key] != '') &&
                                                                ($_SESSION['collaborated_duration_months'][$key] != 0 || $_SESSION['collaborated_duration_years'][$key] != 0) ?'checked':'');
                                                            }
                                                            ?>
                                                        />
                                                        <label for="relationship_collaborated<?php echo '-'.$key ?>">Collaborated With</label>
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

                                                <!-- Studied with tab section -->
                                                <div class="studied_with_section tabs-panel is-active" id="panel1v<?php echo '-'.$key ?> " >
                                                    <fieldset id="study_repeat0" style="background-image: linear-gradient(#016400, white); margin-bottom: 5px;">
                                                        <div class="large-12 columns" >
                                                            <div class="small-4 column" style="margin-top: 5px;">
                                                                <legend><strong style="color:white;">Studied With Details:</strong></legend>
                                                            </div>
                                                            <div class="small-8 column" style="background-color: #016400">
                                                            </div>
                                                            <div class="row duration_selection" value="studied">
                                                                <input class="relation_type" title="studied" style="display:none"/>
                                                                <div class="large-12 columns range_div" id="studied_with_range_div">
                                                                    <div class="large-12 columns" >
                                                                        <legend><strong style="color:white;">Range: <span style = "cursor: pointer;" title="Provide a specific time range for this relationship."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                                            </strong></legend>
                                                                    </div>
                                                                    <div class="large-12 columns">
                                                                        <div class="medium-6 column">
                                                                            <legend style="color:white;">From:</legend>
                                                                            <div class="small-6 column">

                                                                                <select name="studied_from_months[]" class="range_from_months">
                                                                                    <option value>Month</option>
                                                                                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="small-6 column">

                                                                                <select name="studied_from_years[]" class="range_from_years">
                                                                                    <option value>Year</option>
                                                                                    <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="medium-6 column">
                                                                            <legend style="color:white;">To:</legend>
                                                                            <div class="small-6 column">

                                                                                <select name="studied_to_months[]" class="range_to_months">
                                                                                    <option value>Month</option>
                                                                                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="small-6 column">
                                                                                <select name="studied_to_years[]" class="range_to_years">
                                                                                    <option value>Year</option>
                                                                                    <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="large-12 columns duration_div" id="studied_with_duration_div" style="display:none">
                                                                    <div class="large-12 columns">
                                                                        <legend><strong style="color:white;">Duration: <span style = "cursor: pointer;" title="Provide total number of years and/or months for this relationship. Please also tell us over what time span this total duration was (From/To)."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                                            </strong></legend>
                                                                    </div>
                                                                    <div class="large-12 columns">
                                                                        <div class="small-3 column">
                                                                            <legend style="color:white;">Total Years</legend>
                                                                            <input type="text" name="studied_duration_years[]" disabled="disabled" class="duration_years" placeholder="Total Years"/>
                                                                        </div>
                                                                        <div class="small-3 column">
                                                                            <legend style="color:white;">And/Or Months</legend>
                                                                            <input type="text" name="studied_duration_months[]" disabled="disabled" class="duration_months" placeholder="Total Months"/>
                                                                        </div>
                                                                        <div class="small-3 column">
                                                                            <legend style="color:white;">From:</legend>
                                                                            <select name="studied_duration_from_years[]" disabled="disabled" class="duration_from_years">
                                                                                <option value>Year</option>
                                                                                <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="small-3 column">
                                                                            <legend style="color:white;">To:</legend>

                                                                            <select name="studied_duration_to_years[]" disabled="disabled" class="duration_to_years">
                                                                                <option value>Year</option>
                                                                                <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="large-12 columns">
                                                                <div class="medium-5 column">
                                                                    <button type="button" class="btn btn-primary" id="remove_button" onclick="remove(this,4)"
                                                                            style="padding: 5px 8px; background-color:red; color:ghostwhite; font-weight: bold;" >Remove</button>
                                                                </div>
                                                                <div class="medium-2 column"></div>
                                                                <div class="medium-5 column">
                                                                    <button type="button" class="btn btn-primary" id="studied_with_toggle" class="studied_with_toggle"
                                                                            style="padding: 5px 8px; background-color:grey; color:ghostwhite; font-weight: bold;" onclick="toggleDuration(this)">
                                                                        <large >Change to Duration</large>
                                                                    </button>
                                                                    <span style = "cursor: pointer;" title="Toggle between range and duration for filling details. For specific details - change to range. For vague details - change to duration."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                                </div>
                                                            </div>

                                                            <div class="large-12 columns" style="margin-top: 5px">
                                                                <div class="medium-4 column"></div>
                                                                <div class="medium-4 column">
                                                                    <button type="button" class="btn btn-primary"
                                                                            style="padding: 5px 8px; background-color:#62ad61; color:ghostwhite; font-weight: bold;" onclick="duplicate(this)">Add another timeline</button>
                                                                </div>
                                                                <div class="medium-4 column"></div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>




                                                <!-- Danced for tab section -->

                                                <div class="danced__with_section tabs-panel" id="panel2v<?php echo '-'.$key ?>" style="background-image: linear-gradient(#62ad61, white);">
                                                    <fieldset id="dance_repeat0" style="background-image: linear-gradient(#0820aa, white); margin-bottom: 5px;">
                                                        <div class="large-12 columns" >
                                                            <div class="small-4 column" style="margin-top: 5px;">
                                                                <legend><strong style="color:white;">Danced for Details:</strong></legend>
                                                            </div>
                                                            <div class="small-8 column" style="background-color: #0820aa">
                                                            </div>

                                                            <div class="row duration_selection" value="danced">
                                                                <input class="relation_type" title="danced" style="display:none"/>

                                                                <div class="large-12 columns range_div" id="danced__with_range_div">
                                                                    <div class="large-12 columns" >
                                                                        <legend><strong style="color:white;">Range: <span style = "cursor: pointer;" title="Provide a specific time range for this relationship."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                                            </strong></legend>
                                                                    </div>
                                                                    <div class="large-12 columns">
                                                                        <div class="medium-6 column">
                                                                            <legend style="color:white;">From:</legend>
                                                                            <div class="small-6 column">

                                                                                <select name="danced_from_months[]" class="range_from_months">
                                                                                    <option value>Month</option>
                                                                                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="small-6 column">

                                                                                <select name="danced_from_years[]" class="range_from_years">
                                                                                    <option value>Year</option>
                                                                                    <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="medium-6 column">
                                                                            <legend style="color:white;">To:</legend>
                                                                            <div class="small-6 column">

                                                                                <select name="danced_to_months[]" class="range_to_months">
                                                                                    <option value>Month</option>
                                                                                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="small-6 column">
                                                                                <select name="danced_to_years[]" class="range_to_years">
                                                                                    <option value>Year</option>
                                                                                    <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="large-12 columns duration_div" id="danced__with_duration_div" style="display:none">
                                                                    <div class="large-12 columns">
                                                                        <legend><strong style="color:white;">Duration: <span style = "cursor: pointer;" title="Provide total number of years and/or months for this relationship. Please also tell us over what time span this total duration was (From/To)."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                                            </strong></legend>
                                                                    </div>
                                                                    <div class="large-12 columns">
                                                                        <div class="small-3 column">
                                                                            <legend style="color:white;">Total Years</legend>
                                                                            <input type="text" name="danced_duration_years[]" disabled="disabled"  class="duration_years" placeholder="Total Years"/>
                                                                        </div>
                                                                        <div class="small-3 column">
                                                                            <legend style="color:white;">And/Or Months</legend>
                                                                            <input type="text" name="danced_duration_months[]" disabled="disabled"  class="duration_months" placeholder="Total Months"/>
                                                                        </div>
                                                                        <div class="small-3 column">
                                                                            <legend style="color:white;">From:</legend>
                                                                            <select name="danced_duration_from_years[]" disabled="disabled"  class="duration_from_years">
                                                                                <option value>Year</option>
                                                                                <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="small-3 column">
                                                                            <legend style="color:white;">To:</legend>

                                                                            <select name="danced_duration_to_years[]" disabled="disabled"  class="duration_to_years">
                                                                                <option value>Year</option>
                                                                                <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="large-12 columns">
                                                                <div class="medium-5 column">
                                                                    <button type="button" class="btn btn-primary" id="remove_button" onclick="remove(this,4)"
                                                                            style="padding: 5px 8px; background-color:red; color:ghostwhite; font-weight: bold;" >Remove</button>
                                                                </div>
                                                                <div class="medium-2 column"></div>
                                                                <div class="medium-5 column">
                                                                    <button type="button" class="btn btn-primary" id="danced__with_toggle" class="danced__with_toggle"
                                                                            style="padding: 5px 8px; background-color:grey; color:ghostwhite; font-weight: bold;" onclick="toggleDuration(this)">
                                                                        <large >Change to Duration</large>
                                                                    </button>
                                                                    <span style = "cursor: pointer;" title="Toggle between range and duration for filling details. For specific details - change to range. For vague details - change to duration."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                                </div>
                                                            </div>

                                                            <div class="large-12 columns" style="margin-top: 5px">
                                                                <div class="medium-4 column"></div>
                                                                <div class="medium-4 column">
                                                                    <button type="button" class="btn btn-primary"
                                                                            style="padding: 5px 8px; background-color:#62ad61; color:ghostwhite; font-weight: bold;" onclick="duplicate(this)">Add another timeline</button>
                                                                </div>
                                                                <div class="medium-4 column"></div>
                                                            </div>

                                                        </div>
                                                    </fieldset>
                                                </div>


                                                <div class="colbrtd_with_section tabs-panel" id="panel3v<?php echo '-'.$key ?>" style="background-image: linear-gradient(#62ad61, white);">
                                                    <fieldset id="colab_repeat0" style="background-image: linear-gradient(#969101, white); margin-bottom: 5px;">
                                                        <div class="large-12 columns" >
                                                            <div class="small-6 column" style="margin-top: 5px;">
                                                                <legend><strong style="color:white;">Collaborated With Details:</strong></legend>
                                                            </div>
                                                            <div class="small-6 column" style="background-color: #969101">
                                                            </div>


                                                            <div class="row duration_selection" value="collaborated">
                                                                <input class="relation_type" title="collaborated" style="display:none"/>
                                                                <div class="large-12 columns range_div" id="colbrtd_with_range_div">

                                                                    <div class="large-12 columns" >
                                                                        <legend><strong style="color:white;">Range: <span style = "cursor: pointer;" title="Provide a specific time range for this relationship."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                                            </strong></legend>
                                                                    </div>

                                                                    <div class="large-12 columns">
                                                                        <div class="medium-6 column">
                                                                            <legend style="color:white;">From:</legend>
                                                                            <div class="small-6 column">

                                                                                <select name="collaborated_from_months[]" class="range_from_months">
                                                                                    <option value>Month</option>
                                                                                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="small-6 column">

                                                                                <select name="collaborated_from_years[]" class="range_from_years">
                                                                                    <option value>Year</option>
                                                                                    <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="medium-6 column">
                                                                            <legend style="color:white;">To:</legend>
                                                                            <div class="small-6 column">

                                                                                <select name="collaborated_to_months[]" class="range_to_months">
                                                                                    <option value>Month</option>
                                                                                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="small-6 column">
                                                                                <select name="collaborated_to_years[]" class="range_to_years">
                                                                                    <option value>Year</option>
                                                                                    <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="large-12 columns duration_div" id="colbrtd_with_duration_div" style="display:none">
                                                                    <div class="large-12 columns">
                                                                        <legend><strong style="color:white;">Duration: <span style = "cursor: pointer;" title="Provide total number of years and/or months for this relationship. Please also tell us over what time span this total duration was (From/To)."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                                            </strong></legend>
                                                                    </div>
                                                                    <div class="large-12 columns">
                                                                        <div class="small-3 column">
                                                                            <legend style="color:white;">Total Years</legend>
                                                                            <input type="text" name="collaborated_duration_years[]" disabled="disabled" class="duration_years" placeholder="Total Years"/>
                                                                        </div>

                                                                        <div class="small-3 column">
                                                                            <legend style="color:white;">And/Or Months</legend>
                                                                            <input type="text" name="collaborated_duration_months[]" disabled="disabled" class="duration_months" placeholder="Total Months"/>
                                                                        </div>
                                                                        <div class="small-3 column">
                                                                            <legend style="color:white;">From:</legend>
                                                                            <select name="collaborated_duration_from_years[]" disabled="disabled" class="duration_from_years">
                                                                                <option value>Year</option>
                                                                                <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="small-3 column">
                                                                            <legend style="color:white;">To:</legend>

                                                                            <select name="collaborated_duration_to_years[]" disabled="disabled" class="duration_to_years">
                                                                                <option value>Year</option>
                                                                                <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="large-12 columns">
                                                                <div class="medium-5 column">
                                                                    <button type="button" class="btn btn-primary" id="remove_button" onclick="remove(this,4)"
                                                                            style="padding: 5px 8px; background-color:red; color:ghostwhite; font-weight: bold;" >Remove</button>
                                                                </div>
                                                                <div class="medium-2 column"></div>
                                                                <div class="medium-5 column">
                                                                    <button type="button" class="btn btn-primary" id="colbrtd_with_toggle" class="colbrtd_with_toggle"
                                                                            style="padding: 5px 8px; background-color:grey; color:ghostwhite; font-weight: bold;" onclick="toggleDuration(this)">
                                                                        <large >Change to Duration</large>
                                                                    </button>
                                                                    <span style = "cursor: pointer;" title="Toggle between range and duration for filling details. For specific details - change to range. For vague details - change to duration."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                                </div>
                                                            </div>

                                                            <div class="large-12 columns" style="margin-top: 5px">
                                                                <div class="medium-4 column"></div>
                                                                <div class="medium-4 column">
                                                                    <button type="button" class="btn btn-primary"
                                                                            style="padding: 5px 8px; background-color:#62ad61; color:ghostwhite; font-weight: bold;" onclick="duplicate(this)">Add another timeline</button>
                                                                </div>
                                                                <div class="medium-4 column"></div>
                                                            </div>

                                                        </div>
                                                    </fieldset>
                                                </div>

                                                <!-- Influenced tab section -->
                                                <div class="tabs-panel influenced_by_section" id="panel4v<?php echo '-'.$key ?>">
                                                    <fieldset>
                                                        <legend><strong>Influenced by Details:</strong></legend>
                                                        <div class="row not_influenced" <?php echo isset($_SESSION["influenced_by"][$key])?"style='display:none'":""; ?>>
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
                                                        <div class="row influenced" <?php echo !isset($_SESSION["influenced_by"][$key])?"style='display:none'":""; ?>>
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
                                <label for="artist_email_address">Email Address <large style="color:red;font-weight: bold;"> *</large>
                                    <input  autocomplete="off" type="text" class="artist_email_address" id="artist_email_address-1" name="lineage_artist_email_address[]" placeholder="Email Address">
                                </label>
                            </div>
                            <div class="small-3 column">
                                <label for="artist_website">Website <small></small>
                                    <input  autocomplete="off" type="text" class="artist_website" id="artist_website-1" name="lineage_artist_website[]" placeholder="Website">
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
                                                    <input class="relationship relation_studied_cb" name="relationship_studied[]" id="relationship_studied-1" type="checkbox" title="studied_with_section"><label for="relationship_studied">Studied With</label>
                                                </a></li>
                                            <li class="tabs-title"><a href="#panel2v-1">
                                                    <input class="relationship relation_danced_cb" name="relationship_danced[]" id="relationship_danced-1" type="checkbox" title="danced_for_section" ><label for="relationship_danced">Danced For</label>
                                                </a></li>
                                            <li class="tabs-title"><a href="#panel3v-1">
                                                    <input class="relationship relation_collaborated_cb" name="relationship_collaborated[]" id="relationship_collaborated-1" type="checkbox" title="collaborated_with_section" ><label for="relationship_collaborated">Collaborated With</label>
                                                </a></li>
                                            <li class="tabs-title"><a href="#panel4v-1">
                                                    <input class="relationship relation_influenced_cb" name="relationship_influenced[]" id="relationship_influenced-1" type="checkbox" title="influenced_by_section" value="0"><label for="relationship_influenced">Influenced By</label>
                                                </a></li>
                                        </ul>
                                    </div>
                                    <div class="medium-9 columns">
                                        <div class="tabs-content" data-tabs-content="relation-tabs-1">

                                            <!--Studied with tab : New-->
                                            <div class="studied_with_section tabs-panel is-active" id="panel1v-1">
                                                <fieldset id="study_repeat0" style="background-image: linear-gradient(#016400, white); margin-bottom: 5px;">
                                                    <div class="large-12 columns" >
                                                        <div class="small-4 column" style="margin-top: 5px;">
                                                            <legend><strong style="color:white;">Studied With Details:</strong></legend>
                                                        </div>
                                                        <div class="small-8 column" style="background-color: #016400">
                                                        </div>
                                                        <div class="row duration_selection" value="studied">
                                                            <input class="relation_type" title="studied" style="display:none"/>
                                                            <div class="large-12 columns range_div" id="studied_with_range_div">
                                                                <div class="large-12 columns" >
                                                                    <legend><strong style="color:white;">Range: <span style = "cursor: pointer;" title="Provide a specific time range for this relationship."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                                        </strong></legend>


                                                                </div>
                                                                <div class="large-12 columns">
                                                                    <div class="medium-6 column">
                                                                        <legend style="color:white;">From:</legend>
                                                                        <div class="small-6 column">

                                                                            <select name="studied_from_months[]" class="range_from_months">
                                                                                <option value>Month</option>
                                                                                <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="small-6 column">

                                                                            <select name="studied_from_years[]" class="range_from_years">
                                                                                <option value>Year</option>
                                                                                <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="medium-6 column">
                                                                        <legend style="color:white;">To:</legend>
                                                                        <div class="small-6 column">

                                                                            <select name="studied_to_months[]" class="range_to_months">
                                                                                <option value>Month</option>
                                                                                <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="small-6 column">
                                                                            <select name="studied_to_years[]" class="range_to_years">
                                                                                <option value>Year</option>
                                                                                <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="large-12 columns duration_div" id="studied_with_duration_div" style="display:none">
                                                                <div class="large-12 columns">
                                                                    <legend><strong style="color:white;">Duration: <span style = "cursor: pointer;" title="Provide total number of years and/or months for this relationship. Please also tell us over what time span this total duration was (From/To)."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                                        </strong></legend>
                                                                </div>
                                                                <div class="large-12 columns">
                                                                    <div class="medium-3 column">
                                                                        <legend style="color:white;">Total Years</legend>
                                                                        <input type="text" name="studied_duration_years[]" disabled="disabled" class="duration_years" placeholder="Total Years"/>
                                                                    </div>
                                                                    <div class="medium-3 column">
                                                                        <legend style="color:white;">And/Or Months</legend>
                                                                        <input type="text" name="studied_duration_months[]" disabled="disabled" class="duration_months" placeholder="Total Months"/>
                                                                    </div>
                                                                    <div class="small-3 column">
                                                                        <legend style="color:white;">From:</legend>
                                                                        <select name="studied_duration_from_years[]" disabled="disabled" class="duration_from_years">
                                                                            <option value>Year</option>
                                                                            <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php endfor; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="small-3 column">
                                                                        <legend style="color:white;">To:</legend>

                                                                        <select name="studied_duration_to_years[]" disabled="disabled" class="duration_to_years">
                                                                            <option value>Year</option>
                                                                            <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php endfor; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="large-12 columns">
                                                            <div class="medium-5 column">
                                                                <button type="button" class="btn btn-primary" id="remove_button" onclick="remove(this,4)"
                                                                        style="padding: 5px 8px; background-color:red; color:ghostwhite; font-weight: bold;" >Remove</button>
                                                            </div>
                                                            <div class="medium-2 column"></div>
                                                            <div class="medium-5 column">
                                                                <button type="button" class="btn btn-primary" id="studied_with_toggle" class="studied_with_toggle"
                                                                        style="padding: 5px 8px; background-color:grey; color:ghostwhite; font-weight: bold;" onclick="toggleDuration(this)">
                                                                    <large >Change to Duration</large>
                                                                </button>
                                                                <span style = "cursor: pointer;" title="Toggle between range and duration for filling details. For specific details - change to range. For vague details - change to duration."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                            </div>
                                                        </div>

                                                        <div class="large-12 columns" style="margin-top: 5px">
                                                            <div class="medium-4 column"></div>
                                                            <div class="medium-4 column">
                                                                <button type="button" class="btn btn-primary"
                                                                        style="padding: 5px 8px; background-color:#62ad61; color:ghostwhite; font-weight: bold;" onclick="duplicate(this)">Add another timeline</button>
                                                            </div>
                                                            <div class="medium-4 column"></div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <!--Danced with tab : Other artist-->
                                            <div class="danced__with_section tabs-panel" id="panel2v-1">
                                                <fieldset id="dance_repeat0" style="background-image: linear-gradient(#0820aa, white); margin-bottom: 5px;">
                                                    <div class="large-12 columns" >
                                                        <div class="small-4 column" style="margin-top: 5px;">
                                                            <legend><strong style="color:white;">Danced for Details:</strong></legend>
                                                        </div>
                                                        <div class="small-8 column" style="background-color: #0820aa">
                                                        </div>

                                                        <div class="row duration_selection" value="danced">
                                                            <input class="relation_type" title="danced" style="display:none"/>

                                                            <div class="large-12 columns range_div" id="danced__with_range_div">
                                                                <div class="large-12 columns" >
                                                                    <legend><strong style="color:white;">Range: <span style = "cursor: pointer;" title="Provide a specific time range for this relationship."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                                        </strong></legend>
                                                                </div>
                                                                <div class="large-12 columns">
                                                                    <div class="medium-6 column">
                                                                        <legend style="color:white;">From:</legend>
                                                                        <div class="small-6 column">

                                                                            <select name="danced_from_months[]" class="range_from_months">
                                                                                <option value>Month</option>
                                                                                <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="small-6 column">

                                                                            <select name="danced_from_years[]" class="range_from_years">
                                                                                <option value>Year</option>
                                                                                <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="medium-6 column">
                                                                        <legend style="color:white;">To:</legend>
                                                                        <div class="small-6 column">

                                                                            <select name="danced_to_months[]" class="range_to_months">
                                                                                <option value>Month</option>
                                                                                <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="small-6 column">
                                                                            <select name="danced_to_years[]" class="range_to_years">
                                                                                <option value>Year</option>
                                                                                <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="large-12 columns duration_div" id="danced__with_duration_div" style="display:none">
                                                                <div class="large-12 columns">
                                                                    <legend><strong style="color:white;">Duration: <span style = "cursor: pointer;" title="Provide total number of years and/or months for this relationship. Please also tell us over what time span this total duration was (From/To)."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                                        </strong></legend>
                                                                </div>
                                                                <div class="large-12 columns">
                                                                    <div class="small-3 column">
                                                                        <legend style="color:white;">Total Years</legend>
                                                                        <input type="text" name="danced_duration_years[]" disabled="disabled"  class="duration_years" placeholder="Total Years"/>
                                                                    </div>
                                                                    <div class="small-3 column">
                                                                        <legend style="color:white;">And/Or Months</legend>
                                                                        <input type="text" name="danced_duration_months[]" disabled="disabled"  class="duration_months" placeholder="Total Months"/>
                                                                    </div>
                                                                    <div class="small-3 column">
                                                                        <legend style="color:white;">From:</legend>
                                                                        <select name="danced_duration_from_years[]" disabled="disabled"  class="duration_from_years">
                                                                            <option value>Year</option>
                                                                            <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php endfor; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="small-3 column">
                                                                        <legend style="color:white;">To:</legend>

                                                                        <select name="danced_duration_to_years[]" disabled="disabled"  class="duration_to_years">
                                                                            <option value>Year</option>
                                                                            <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php endfor; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="large-12 columns">
                                                            <div class="medium-5 column">
                                                                <button type="button" class="btn btn-primary" id="remove_button" onclick="remove(this,4)"
                                                                        style="padding: 5px 8px; background-color:red; color:ghostwhite; font-weight: bold;" >Remove</button>
                                                            </div>
                                                            <div class="medium-2 column"></div>
                                                            <div class="medium-5 column">
                                                                <button type="button" class="btn btn-primary" id="danced__with_toggle" class="danced__with_toggle"
                                                                        style="padding: 5px 8px; background-color:grey; color:ghostwhite; font-weight: bold;" onclick="toggleDuration(this)">
                                                                    <large >Change to Duration</large>
                                                                </button>
                                                                <span style = "cursor: pointer;" title="Toggle between range and duration for filling details. For specific details - change to range. For vague details - change to duration."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                            </div>
                                                        </div>

                                                        <div class="large-12 columns" style="margin-top: 5px">
                                                            <div class="medium-4 column"></div>
                                                            <div class="medium-4 column">
                                                                <button type="button" class="btn btn-primary"
                                                                        style="padding: 5px 8px; background-color:#62ad61; color:ghostwhite; font-weight: bold;" onclick="duplicate(this)">Add another timeline</button>
                                                            </div>
                                                            <div class="medium-4 column"></div>
                                                        </div>

                                                    </div>
                                                </fieldset>
                                            </div>


                                            <!--Collaborated with tab : Other artist-->
                                            <div class="colbrtd_with_section tabs-panel" id="panel3v-1">
                                                <fieldset id="colab_repeat0" style="background-image: linear-gradient(#969101, white); margin-bottom: 5px;">
                                                    <div class="large-12 columns" >
                                                        <div class="small-6 column" style="margin-top: 5px;">
                                                            <legend><strong style="color:white;">Collaborated With Details:</strong></legend>
                                                        </div>
                                                        <div class="small-6 column" style="background-color: #969101">
                                                        </div>


                                                        <div class="row duration_selection" value="collaborated">
                                                            <input class="relation_type" title="collaborated" style="display:none"/>
                                                            <div class="large-12 columns range_div" id="colbrtd_with_range_div">

                                                                <div class="large-12 columns" >
                                                                    <legend><strong style="color:white;">Range: <span style = "cursor: pointer;" title="Provide a specific time range for this relationship."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                                        </strong></legend>
                                                                </div>

                                                                <div class="large-12 columns">
                                                                    <div class="medium-6 column">
                                                                        <legend style="color:white;">From:</legend>
                                                                        <div class="small-6 column">

                                                                            <select name="collaborated_from_months[]" class="range_from_months">
                                                                                <option value>Month</option>
                                                                                <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="small-6 column">

                                                                            <select name="collaborated_from_years[]" class="range_from_years">
                                                                                <option value>Year</option>
                                                                                <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="medium-6 column">
                                                                        <legend style="color:white;">To:</legend>
                                                                        <div class="small-6 column">

                                                                            <select name="collaborated_to_months[]" class="range_to_months">
                                                                                <option value>Month</option>
                                                                                <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="small-6 column">
                                                                            <select name="collaborated_to_years[]" class="range_to_years">
                                                                                <option value>Year</option>
                                                                                <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="large-12 columns duration_div" id="colbrtd_with_duration_div" style="display:none">
                                                                <div class="large-12 columns">
                                                                    <legend><strong style="color:white;">Duration: <span style = "cursor: pointer;" title="Provide total number of years and/or months for this relationship. Please also tell us over what time span this total duration was (From/To)."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                                        </strong></legend>
                                                                </div>
                                                                <div class="large-12 columns">
                                                                    <div class="small-3 column">
                                                                        <legend style="color:white;">Total Years</legend>
                                                                        <input type="text" name="collaborated_duration_years[]" disabled="disabled" class="duration_years" placeholder="Total Years"/>
                                                                    </div>
                                                                    <div class="small-3 column">
                                                                        <legend style="color:white;">And/Or Months</legend>
                                                                        <input type="text" name="collaborated_duration_months[]" disabled="disabled" class="duration_months" placeholder="Total Months"/>
                                                                    </div>
                                                                    <div class="small-3 column">
                                                                        <legend style="color:white;">From:</legend>
                                                                        <select name="collaborated_duration_from_years[]" disabled="disabled" class="duration_from_years">
                                                                            <option value>Year</option>
                                                                            <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php endfor; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="small-3 column">
                                                                        <legend style="color:white;">To:</legend>

                                                                        <select name="collaborated_duration_to_years[]" disabled="disabled" class="duration_to_years">
                                                                            <option value>Year</option>
                                                                            <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php endfor; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="large-12 columns">
                                                            <div class="medium-5 column">
                                                                <button type="button" class="btn btn-primary" id="remove_button" onclick="remove(this,4)"
                                                                        style="padding: 5px 8px; background-color:red; color:ghostwhite; font-weight: bold;" >Remove</button>
                                                            </div>
                                                            <div class="medium-2 column"></div>
                                                            <div class="medium-5 column">
                                                                <button type="button" class="btn btn-primary" id="colbrtd_with_toggle" class="colbrtd_with_toggle"
                                                                        style="padding: 5px 8px; background-color:grey; color:ghostwhite; font-weight: bold;" onclick="toggleDuration(this)">
                                                                    <large >Change to Duration</large>
                                                                </button>
                                                                <span style = "cursor: pointer;" title="Toggle between range and duration for filling details. For specific details - change to range. For vague details - change to duration."><img src="img/help.png" style="height:15px;width:15px;"/></span>
                                                            </div>
                                                        </div>

                                                        <div class="large-12 columns" style="margin-top: 5px">
                                                            <div class="medium-4 column"></div>
                                                            <div class="medium-4 column">
                                                                <button type="button" class="btn btn-primary"
                                                                        style="padding: 5px 8px; background-color:#62ad61; color:ghostwhite; font-weight: bold;" onclick="duplicate(this)">Add another timeline</button>
                                                            </div>
                                                            <div class="medium-4 column"></div>
                                                        </div>

                                                    </div>
                                                </fieldset>
                                            </div>

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
        5. You are accepting the terms and conditions for your current entries and your future additions to your lineage.
    </div>

    <div class="row">
        <?php if($_SESSION["timeline_flow"] == "relation_add"):?>
            <div class="large-2 small-8 column">
                <button class="primary button float-right" type="button" name="home" id="home" onclick="window.open('/src/add_user_profile.php','_self');">
                    <span>Back to Profile</span>
                </button>
            </div>
            <div class="large-2 small-8 column">
                <button class="primary button" type="submit" name="save" id="save">
                    <span>Save</span>
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
            <div class="large-2 small-8 column">
                <button class="primary button" type="button" name="home" id="home" onclick="window.open('/src/add_user_profile.php','_self');">
                    <span>Back to Profile</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="column">
        </div>
    </div>
</form>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="js/getData.js"></script>
</body>


<script type="text/javascript">
    var count = 0;
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
            +	"<legend><strong>Influenced by Details:</strong></legend>"
            +	"<div class='row not_influenced'>"
            +		"<input class='relation_type' title='influenced' style='display:none'/>"
            +		"<div class='column'>"
            +			"<div class='row'>"
            +				"<div class='column'>"
            +					"People who have significantly influenced your work, such as artists, authors, philosophers, etc. You do not need"
            +					"to have a relationship with this person in order to list them as having an impact on your work."
            +					"By choosing Influenced by you are acknowledging that you have been influenced by this person. No time based data"
            +					"is necessary."
            +				"</div>"
            +			"</div>"
            +			"<div class='row'>"
            +				"<center>"
            +					"<button class='primary button influenced_by' type='button' style='margin-top:5%'>"
            +						"<span>Influenced by</span>"
            +					"</button>"
            +				"</center>"
            +			"</div>"
            +		"</div>"
            +	"</div>"
            +	"<div class='row influenced' style='display:none;'>"
            +		"<div class='column' style='color:darkgreen;'>"
            +			"<center><h3><strong>You are influenced by this Artist</h3></strong></center>"
            +		"</div>"
            +	"</div>"
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
    });
    $("#previous").click(function() {
        // onclick event is assigned to the #button element.
        if(disabled_input){
            window.open("/src/add_artist_biography.php","_self");
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
            window.open("/src/about_lineage.php","_self");
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
        $(function(){
            $('.start_date').fdatepicker({
                initialDate: '',
                format: 'yyyy-mm-dd',
                disableDblClickSelection: true,
                leftArrow:'<<',
                rightArrow:'>>',
                closeIcon:'X',
                closeButton: true
            });
        });
        $(".start_date").change(function(){
            var startDate = $(this).val();
            var endDate = $(this).closest('.duration_selection').find(".end_date").val();
            if(startDate != "" && endDate != ""){
                if ((Date.parse(startDate) >= Date.parse(endDate))) {
                    alert("Start Date cannot be greater than end date");
                    $(this).val("");
                } else {
                    var st = new Date(startDate);
                    var et= new Date(endDate);
                    var millisecondsPerDay = 1000 * 60 * 60 * 24;
                    var millisBetween = et.getTime() - st.getTime();
                    var days = millisBetween / millisecondsPerDay;
                    var years = Math.round(days/365);
                    var months = Math.round(days/30 - (years*12));
                    if(months < 0){
                        years = years - 1;
                        months = months + 12;
                    }
                    $(this).closest('.duration_selection').find(".duration_years").val(years);
                    $(this).closest('.duration_selection').find(".duration_months").val(months);
                    $(this).closest('.duration_selection').find(".duration_years").prop("readonly",true);
                    $(this).closest('.duration_selection').find(".duration_months").prop("readonly",true);
                    $(this).closest('.duration_selection').find(".duration_months").change();
                }
            } else if(startDate == "" && endDate == ""){
                $(this).closest('.duration_selection').find(".duration_years").prop("readonly",false);
                $(this).closest('.duration_selection').find(".duration_months").prop("readonly",false);
            } else {
                $(this).closest('.duration_selection').find(".duration_years").val(0);
                $(this).closest('.duration_selection').find(".duration_months").val(0);
                $(this).closest('.duration_selection').find(".duration_years").prop("readonly",true);
                $(this).closest('.duration_selection').find(".duration_months").prop("readonly",true);
                $(this).closest('.duration_selection').find(".duration_months").change();
            }
        });
        $(function(){
            $('.end_date').fdatepicker({
                initialDate: '',
                format: 'yyyy-mm-dd',
                disableDblClickSelection: true,
                leftArrow:'<<',
                rightArrow:'>>',
                closeIcon:'X',
                closeButton: true
            });
        });
        $(".end_date").change(function(){
            var endDate = $(this).val();
            var startDate = $(this).closest('.duration_selection').find(".start_date").val();
            if(startDate != "" && endDate != ""){
                if ((Date.parse(startDate) >= Date.parse(endDate))) {
                    alert("Start Date cannot be greater than end date");
                    $(this).val("");
                } else {
                    console.log(startDate + " " + endDate);
                    var st = new Date(startDate);
                    var et= new Date(endDate);
                    var millisecondsPerDay = 1000 * 60 * 60 * 24;
                    var millisBetween = et.getTime() - st.getTime();
                    var days = millisBetween / millisecondsPerDay;
                    var years = Math.round(days/365);
                    var months = Math.round(days/30 - (years*12));
                    if(months < 0){
                        years = years - 1;
                        months = months + 12;
                    }
                    $(this).closest('.duration_selection').find(".duration_years").val(years);
                    $(this).closest('.duration_selection').find(".duration_months").val(months);
                    $(this).closest('.duration_selection').find(".duration_years").prop("readonly",true);
                    $(this).closest('.duration_selection').find(".duration_months").prop("readonly",true);
                    $(this).closest('.duration_selection').find(".duration_months").change();
                }
            } else if(startDate == "" && endDate == ""){
                $(this).closest('.duration_selection').find(".duration_years").prop("readonly",false);
                $(this).closest('.duration_selection').find(".duration_months").prop("readonly",false);
            } else {
                $(this).closest('.duration_selection').find(".duration_years").val(0);
                $(this).closest('.duration_selection').find(".duration_months").val(0);
                $(this).closest('.duration_selection').find(".duration_years").prop("readonly",true);
                $(this).closest('.duration_selection').find(".duration_months").prop("readonly",true);
                $(this).closest('.duration_selection').find(".duration_months").change();
            }
        });

        //Range validation
        $(".range_from_months").change(function(){
            var from_months = $(this).val();
            var from_years = $(this).closest('.duration_selection').find(".range_from_years").val();
            var to_months = $(this).closest('.duration_selection').find(".range_to_months").val();
            var to_years = $(this).closest('.duration_selection').find(".range_to_years").val();

            validateRange(from_months, from_years, to_months, to_years, $(this));
        });
        $(".range_from_years").change(function(){
            var from_months = $(this).closest('.duration_selection').find(".range_from_months").val();
            var from_years = $(this).val();
            var to_months = $(this).closest('.duration_selection').find(".range_to_months").val();
            var to_years = $(this).closest('.duration_selection').find(".range_to_years").val();

            validateRange(from_months, from_years, to_months, to_years, $(this));
        });
        $(".range_to_months").change(function(){
            var from_months = $(this).closest('.duration_selection').find(".range_from_months").val();
            var from_years = $(this).closest('.duration_selection').find(".range_from_years").val();
            var to_months = $(this).val();
            var to_years = $(this).closest('.duration_selection').find(".range_to_years").val();

            validateRange(from_months, from_years, to_months, to_years, $(this));
        });
        $(".range_to_years").change(function(){
            var from_months = $(this).closest('.duration_selection').find(".range_from_months").val();
            var from_years = $(this).closest('.duration_selection').find(".range_from_years").val();
            var to_months = $(this).closest('.duration_selection').find(".range_to_months").val();
            var to_years = $(this).val();

            validateRange(from_months, from_years, to_months, to_years, $(this));
        });


        //Duration validation
        $(".duration_years").change(function(){
            var num_years = $(this).val();
            var num_months = $(this).closest('.duration_selection').find(".duration_months").val();
            var from_years = $(this).closest('.duration_selection').find(".duration_from_years").val();
            var to_years = $(this).closest('.duration_selection').find(".duration_to_years").val();

            validateDuration(num_years, num_months, from_years, to_years, $(this));
        });
        $(".duration_months").change(function(){
            var num_years = $(this).closest('.duration_selection').find(".duration_years").val();
            var num_months = $(this).val();
            var from_years = $(this).closest('.duration_selection').find(".duration_from_years").val();
            var to_years = $(this).closest('.duration_selection').find(".duration_to_years").val();

            validateDuration(num_years, num_months, from_years, to_years, $(this));
        });

        $(".duration_from_years").change(function(){
            var num_years = $(this).closest('.duration_selection').find(".duration_years").val();
            var num_months = $(this).closest('.duration_selection').find(".duration_months").val();
            var from_years = $(this).val();
            var to_years = $(this).closest('.duration_selection').find(".duration_to_years").val();

            validateDuration(num_years, num_months, from_years, to_years, $(this));

        });

        $(".duration_to_years").change(function(){
            var num_years = $(this).closest('.duration_selection').find(".duration_years").val();
            var num_months = $(this).closest('.duration_selection').find(".duration_months").val();
            var from_years = $(this).closest('.duration_selection').find(".duration_from_years").val();
            var to_years = $(this).val();

            validateDuration(num_years, num_months, from_years, to_years, $(this));

        });

        $(".relationship").click(function(){
            console.log($(this).attr("title"));
            var relation_section = $(this).closest(".row").find("."+$(this).attr("title"));
            if($(this).attr("title") == "influenced_by_section"){
                $(this).prop('checked', false);
                $(this).hide();
                $(relation_section).find(".influenced").hide();
                $(relation_section).find(".not_influenced").show();
            }
        });
        $(".influenced_by").click(function(){
            var relation_checkbox = $(this).closest(".not_influenced").parent().parent().parent().parent().parent().find(".relation_" + "influenced" + "_cb");
            $(relation_checkbox).prop('checked', true);
            $(relation_checkbox).show();
            $(this).closest("fieldset").find(".influenced").show();
            $(this).closest("fieldset").find(".not_influenced").hide();
        });
    }

    function validateRange(from_months, from_years, to_months, to_years, curr){

        var relation_type = curr.closest('.duration_selection').find(".relation_type").attr("title");
        var relation_checkbox = curr.closest(".duration_selection").parent().parent().parent().parent().parent().parent().find(".relation_" + relation_type + "_cb");

        if ((to_years!=0 && from_years!=0) && to_years < from_years) {
            alert("Start year cannot be greater than end year");
            curr.val("");
        }
        else if((to_years!=0 && from_years!=0) && (to_years == from_years) && (to_months < from_months )){
            alert("Start month cannot be greater than end month for same year");
            curr.val("");
        }
        validateAllForCheckbox(curr);
    }

    function validateDuration(num_years, num_months, from_years, to_years, curr){

        var relation_type = curr.closest('.duration_selection').find(".relation_type").attr("title");
        var relation_checkbox = curr.closest(".duration_selection").parent().parent().parent().parent().parent().parent().find(".relation_" + relation_type + "_cb");

        if (to_years!=0 && to_years < from_years) {
            alert("Start year cannot be greater than end year");
            curr.val("");
        }
        else if(((num_years != "") || (num_years!=0)) && ((from_years != "") || (from_years!=0)) && ((to_years != "") || (to_years!=0)) ){
            if((to_years - from_years < num_years)){
                alert("Duration years can't be more than the start and end years.");
                curr.val("");
            }
        }
        validateAllForCheckbox(curr);
    }

    function validateAllForCheckbox(curr){
        var relation_root = curr.closest(".duration_selection").parent().parent().parent();

        var relation_type = curr.closest('.duration_selection').find(".relation_type").attr("title");
        var relation_checkbox = curr.closest(".duration_selection").parent().parent().parent().parent().parent().parent().find(".relation_" + relation_type + "_cb");

        //relation_root.childNodes;
        var childCount ;
        if(relation_root[0] != undefined)
            childCount = relation_root[0].childElementCount;
        else
            childCount = relation_root.childElementCount;

        var i =0;
        if(childCount>0) {
            while(childCount>0){
                var node = relation_root[0].childNodes[i];
                if(node.id != null) {
                    if(!node.querySelector(".duration_years").disabled) {
                        var num_years = node.querySelector(".duration_years").value;
                        var num_months = node.querySelector(".duration_months").value;
                        var from_years = node.querySelector(".duration_from_years").value;
                        var to_years = node.querySelector(".duration_to_years").value;
                        if(((from_years == 0) || (to_years == 0) || (from_years == "") || (to_years == "")) || (((num_years == 0) && (num_months==0)) || ((num_years == "") && (num_months=="")))){
                            $(relation_checkbox).prop('checked', false);
                            $(relation_checkbox).hide();
                        }else{
                            $(relation_checkbox).prop('checked', true);
                            $(relation_checkbox).show();
                            return;
                        }
                    }
                    else{

                        var from_months = node.querySelector(".range_from_months").value;
                        var from_years = node.querySelector(".range_from_years").value;
                        var to_months = node.querySelector(".range_to_months").value;
                        var to_years = node.querySelector(".range_to_years").value;

                        if(((from_years == 0) || (to_years == 0) || (from_years == "") || (to_years == "") ||
                            (to_months == "") || (to_months == "") || (from_months== "") || (from_months == ""))){
                            $(relation_checkbox).prop('checked', false);
                            $(relation_checkbox).hide();
                        }else{
                            $(relation_checkbox).prop('checked', true);
                            $(relation_checkbox).show();
                            return;
                        }

                    }

                    childCount--;
                }
                i++;
            }
        }


    }


    $(document).ready(function(){
        dateScripts();

        $( "#dialog-1" ).dialog({
            autoOpen: false,
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



    /*
    * toggle duration button function to toggle from
    * range to duration
    * */
    function toggleDuration(buttonName) {
        var _id = buttonName.id;

        var prefix = _id.substring(0, 13);
        var suffix = _id.charAt(19);

        var dur_div_id = prefix+"duration_div"+suffix;
        var dur_range_id = prefix+"range_div"+suffix;


        var dur_text = "Change to Duration";
        var range_text = "Change to Range";

        console.log("dur div id : ", dur_div_id);
        console.log("dur range id : ", dur_range_id);

        var button = document.getElementById(_id);
        var button_val = button.innerText;

        var dur_div = document.getElementById(dur_div_id);
        var range_div = document.getElementById(dur_range_id);

        if(button_val == dur_text){
            button.innerText = range_text;
            dur_div.style.display="block";
            range_div.style.display="none";

            all = range_div.getElementsByTagName('select');
            for (i = 0; i < all.length; i++) {
                all[i].setAttribute("disabled", "disabled");
            }

            all = dur_div.getElementsByTagName('input');
            for (i = 0; i < all.length; i++) {
                all[i].removeAttribute("disabled");
            }
            all = dur_div.getElementsByTagName('select');
            for (i = 0; i < all.length; i++) {
                all[i].removeAttribute("disabled");
            }
            var num_years = $(dur_div).closest('.duration_selection').find(".duration_years").val();
            var num_months = $(dur_div).closest('.duration_selection').find(".duration_months").val();
            var from_years = $(dur_div).closest('.duration_selection').find(".duration_from_years").val();
            var to_years = $(dur_div).closest('.duration_selection').find(".duration_to_years").val();

            validateDuration(num_years, num_months, from_years, to_years, $(dur_div));

        }
        else{
            button.innerText = dur_text;
            range_div.style.display="block";
            dur_div.style.display="none";

            all = range_div.getElementsByTagName('select');
            for (i = 0; i < all.length; i++) {
                all[i].removeAttribute("disabled");
            }
            all = dur_div.getElementsByTagName('input');
            for (i = 0; i < all.length; i++) {
                all[i].setAttribute("disabled", "disabled");
            }
            all = dur_div.getElementsByTagName('select');
            for (i = 0; i < all.length; i++) {
                all[i].setAttribute("disabled", "disabled");
            }

            var from_months = $(range_div).closest('.duration_selection').find(".range_from_months").val();
            var from_years = $(range_div).closest('.duration_selection').find(".range_from_years").val();
            var to_months = $(range_div).closest('.duration_selection').find(".range_to_months").val();
            var to_years = $(range_div).closest('.duration_selection').find(".range_to_years").val();

            validateRange(from_months, from_years, to_months, to_years, $(range_div));
        }
    }
</script>
<?php
include 'form_links_footer.php';
include 'footer.php';
?>

</html>