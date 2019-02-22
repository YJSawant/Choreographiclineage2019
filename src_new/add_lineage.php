<?php
include 'path.php';
include 'menu.php';
include 'util.php';
my_session_start();
if(isset($_SESSION['artist_profile_view'])){
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
                                    <label>Relationship<large style="color:red;font-weight: bold;"> *</large>
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
                                                        <input class="relationship relation_danced_cb" name="relationship_danced[]" id="relationship_danced<?php echo '-'.$key ?>" type="checkbox" tilte="danced_for_section"
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
                                                        <input class="relationship relation_collaborated_cb" name="relationship_collaborated[]" id="relationship_collaborated<?php echo '-'.$key ?>" type="checkbox" title="collaborated_with_section"
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
                                                <div class="studied_with_section tabs-panel is-active" id="panel1v<?php echo '-'.$key ?>">
                                                    <fieldset id="study_repeat0">
                                                        <div class="row">
                                                            <div class="small-4 column">
                                                                <legend><strong>Studied With Details:</strong></legend>
                                                            </div>
                                                            <div class="small-4 small-offset-4 column">
                                                                <button type="button" class="btn btn-primary" id="studied_with_toggle" class="studied_with_toggle"
                                                                        style="padding: 5px 8px; background-color:grey; color:ghostwhite; font-weight: bold;" onclick="toggleDuration(this)">
                                                                    <large >Change to Duration</large>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="row duration_selection" value="studied">
                                                            <input class="relation_type" title="studied" style="display:none"/>
                                                            <div class="large-12 columns" id="studied_with_range_div">
                                                                <div class="large-12 columns" >
                                                                    <legend><strong>Range:</strong></legend>
                                                                </div>
                                                                <!--<div class="row">-->
                                                                <div class="large-12 columns">
                                                                    <div class="medium-6 column">
                                                                        <legend>From:</legend>
                                                                        <div class="small-6 column">

                                                                            <!--<label>Start Date
                                                                                <input type="text" class="start_date" id="studied_start_date<?php /*echo '-'.$key */?>" name="studied_start_date[]" placeholder="yyyy-mm-dd"
                                                                                       value="<?php /*echo (isset($_SESSION['studied_start_date'])?$_SESSION['studied_start_date'][$key]:'')*/?>"
                                                                                />
                                                                            </label>-->
                                                                            <select name="from_months">
                                                                                <option value>Month</option>
                                                                                <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="small-6 column">
                                                                            <!--<label>End Date
                                                                                <input type="text" class="end_date" id="studied_end_date<?php /*echo '-'.$key */?>" name="studied_end_date[]"  placeholder="yyyy-mm-dd"
                                                                                       value="<?php /*echo (isset($_SESSION['studied_end_date'])?$_SESSION['studied_end_date'][$key]:'')*/?>"
                                                                                />
                                                                            </label>-->
                                                                            <select name="from_years">
                                                                                <option value>Year</option>
                                                                                <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="medium-6 column">
                                                                        <legend>To:</legend>
                                                                        <div class="small-6 column">

                                                                            <select name="from_months">
                                                                                <option value>Month</option>
                                                                                <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="small-6 column">
                                                                            <select name="from_years">
                                                                                <option value>Year</option>
                                                                                <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="large-12 columns" id="studied_with_duration_div" style="display:none">
                                                                <div class="large-12 columns">
                                                                    <legend><strong>Duration:</strong></legend>
                                                                </div>
                                                                <div class="large-12 columns">
                                                                    <div class="small-4 column">
                                                                        <legend>Number of years:</legend>
                                                                        <input type="text" />
                                                                    </div>
                                                                    <div class="small-4 column">
                                                                        <legend>From:</legend>
                                                                        <select name="from_years">
                                                                            <option value>Year</option>
                                                                            <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php endfor; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="small-4 column">
                                                                        <legend>To:</legend>

                                                                        <select name="from_years">
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
                                                            <button type="button" class="success button secondary small" onclick="duplicate(this)">+</button>
                                                            <button type="button" class="alert button secondary small" onclick="remove(this)">-</button>
                                                        </div>

                                                    </fieldset>
                                                </div>

                                                <!-- Danced for tab section -->
                                                <div class="danced__with_section tabs-panel" id="panel2v<?php echo '-'.$key ?>">
                                                    <fieldset id="dance_repeat0">
                                                        <div class="row">
                                                            <div class="small-4 column">
                                                                <legend><strong>Danced for Details:</strong></legend>
                                                            </div>
                                                            <div class="small-4 small-offset-4 column">
                                                                <button type="button" class="btn btn-primary" id="danced__with_toggle"
                                                                        style="padding: 5px 8px; background-color:grey; color:ghostwhite; font-weight: bold;" onclick="toggleDuration(this)">
                                                                    <large >Change to Duration</large>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div class="row duration_selection" value="danced">
                                                            <input class="relation_type" title="danced" style="display:none"/>
                                                            <div class="large-12 columns" id="danced__with_range_div">
                                                                <div class="large-12 columns" >
                                                                    <legend><strong>Range:</strong></legend>
                                                                </div>
                                                                <div class="large-12 columns">
                                                                    <div class="medium-6 column">
                                                                        <legend>From:</legend>
                                                                        <div class="small-6 column">
                                                                            <select name="from_months">
                                                                                <option value>Month</option>
                                                                                <?php /*for ($i = 1; $i <= 12; $i++) : */?>
                                                                                    <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                                <?php /*endfor; */?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="small-6 column">
                                                                            <select name="from_years">
                                                                                <option value>Year</option>
                                                                                <?php /*for ($i = 2018; $i >=1000; $i--) : */?>
                                                                                    <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                                <?php /*endfor; */?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="medium-6 column">
                                                                        <legend>To:</legend>
                                                                        <div class="small-6 column">

                                                                            <select name="from_months">
                                                                                <option value>Month</option>
                                                                                <?php /*for ($i = 1; $i <= 12; $i++) : */?>
                                                                                    <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                                <?php /*endfor; */?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="small-6 column">
                                                                            <select name="from_years">
                                                                                <option value>Year</option>
                                                                                <?php /*for ($i = 2018; $i >=1000; $i--) : */?>
                                                                                    <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                                <?php /*endfor; */?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="large-12 columns" id="danced__with_duration_div" style="display:none">
                                                                <div class="large-12 columns">
                                                                    <legend><strong>Duration:</strong></legend>
                                                                </div>
                                                                <div class="large-12 columns">
                                                                    <div class="small-4 column">
                                                                        <legend>Number of years:</legend>
                                                                        <input type="text" />
                                                                    </div>
                                                                    <div class="small-4 column">
                                                                        <legend>From:</legend>
                                                                        <select name="from_years">
                                                                            <option value>Year</option>
                                                                            <?php /*for ($i = 2018; $i >=1000; $i--) : */?>
                                                                                <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                            <?php /*endfor; */?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="small-4 column">
                                                                        <legend>To:</legend>

                                                                        <select name="from_years">
                                                                            <option value>Year</option>
                                                                            <?php /*for ($i = 2018; $i >=1000; $i--) : */?>
                                                                                <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                            <?php /*endfor; */?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </fieldset>
                                                </div>

                                                <!-- Collaborated with tab section -->
                                                <div class="colbrtd_with_section tabs-panel" id="panel3v<?php echo '-'.$key ?>">
                                                    <fieldset id="collaborated_repeat0">

                                                        <div class="row">
                                                            <div class="small-4 column">
                                                                <legend><strong>Collaborated With Details:</strong></legend>
                                                            </div>
                                                            <div class="small-4 small-offset-4 column">
                                                                <button type="button" class="btn btn-primary" id="colbrtd_with_toggle"
                                                                        style="padding: 5px 8px; background-color:grey; color:ghostwhite; font-weight: bold;" onclick="toggleDuration(this)">
                                                                    <large >Change to Duration</large>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div class="row duration_selection" value="collaborated">
                                                            <input class="relation_type" title="collaborated" style="display:none"/>
                                                            <div class="large-12 columns" id="colbrtd_with_range_div">
                                                                <div class="large-12 columns" >
                                                                    <legend><strong>Range:</strong></legend>
                                                                </div>
                                                                <div class="large-12 columns">
                                                                    <div class="medium-6 column">
                                                                        <legend>From:</legend>
                                                                        <div class="small-6 column">
                                                                            <select name="from_months">
                                                                                <option value>Month</option>
                                                                                <?php /*for ($i = 1; $i <= 12; $i++) : */?>
                                                                                    <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                                <?php /*endfor; */?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="small-6 column">
                                                                            <select name="from_years">
                                                                                <option value>Year</option>
                                                                                <?php /*for ($i = 2018; $i >=1000; $i--) : */?>
                                                                                    <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                                <?php /*endfor; */?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="medium-6 column">
                                                                        <legend>To:</legend>
                                                                        <div class="small-6 column">

                                                                            <select name="from_months">
                                                                                <option value>Month</option>
                                                                                <?php /*for ($i = 1; $i <= 12; $i++) : */?>
                                                                                    <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                                <?php /*endfor; */?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="small-6 column">
                                                                            <select name="from_years">
                                                                                <option value>Year</option>
                                                                                <?php /*for ($i = 2018; $i >=1000; $i--) : */?>
                                                                                    <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                                <?php /*endfor; */?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="large-12 columns" id="colbrtd_with_duration_div" style="display:none">
                                                                <div class="large-12 columns">
                                                                    <legend><strong>Duration:</strong></legend>
                                                                </div>
                                                                <div class="large-12 columns">
                                                                    <div class="small-4 column">
                                                                        <legend>Number of years:</legend>
                                                                        <input type="text" />
                                                                    </div>
                                                                    <div class="small-4 column">
                                                                        <legend>From:</legend>
                                                                        <select name="from_years">
                                                                            <option value>Year</option>
                                                                            <?php /*for ($i = 2018; $i >=1000; $i--) : */?>
                                                                                <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                            <?php /*endfor; */?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="small-4 column">
                                                                        <legend>To:</legend>

                                                                        <select name="from_years">
                                                                            <option value>Year</option>
                                                                            <?php /*for ($i = 2018; $i >=1000; $i--) : */?>
                                                                                <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                            <?php /*endfor; */?>
                                                                        </select>
                                                                    </div>
                                                                </div>
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
                                <label for="artist_first_name">First Name <small> Required</small>
                                    <input type="text" class="artist_first_name"  id="artist_first_name-1" name="lineage_artist_first_name[]" placeholder="First Name">
                                </label>
                            </div>
                            <div class="small-3 column">
                                <label for="artist_last_name">Last Name <small> Required</small>
                                    <input  autocomplete="off" type="text" class="artist_last_name" id="artist_last_name-1" name="lineage_artist_last_name[]" placeholder="Last Name" >
                                </label>
                            </div>
                            <div class="small-3 column">
                                <label for="artist_email_address">Email Address <small></small>
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
                                <label>Relationship<small> Required</small></label>
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
                                            <div class="studied_with_section tabs-panel is-active" id="panel1v-1">
                                                <fieldset id="study_repeat0">
                                                    <div class="row">
                                                        <div class="small-4 column">
                                                            <legend><strong>Studied With Details:</strong></legend>
                                                        </div>
                                                        <div class="small-4 small-offset-4 column">
                                                            <button type="button" class="btn btn-primary" id="studied_with_toggle" class="studied_with_toggle"
                                                                    style="padding: 5px 8px; background-color:grey; color:ghostwhite; font-weight: bold;" onclick="toggleDuration(this)">
                                                                <large >Change to Duration</large>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="row duration_selection" value="studied">
                                                        <input class="relation_type" title="studied" style="display:none"/>
                                                        <div class="large-12 columns" id="studied_with_range_div">
                                                            <div class="large-12 columns" >
                                                                <legend><strong>Range:</strong></legend>
                                                            </div>
                                                            <!--<div class="row">-->
                                                            <div class="large-12 columns">
                                                                <div class="medium-6 column">
                                                                    <legend>From:</legend>
                                                                    <div class="small-6 column">

                                                                        <!--<label>Start Date
                                                                                <input type="text" class="start_date" id="studied_start_date<?php /*echo '-'.$key */?>" name="studied_start_date[]" placeholder="yyyy-mm-dd"
                                                                                       value="<?php /*echo (isset($_SESSION['studied_start_date'])?$_SESSION['studied_start_date'][$key]:'')*/?>"
                                                                                />
                                                                            </label>-->
                                                                        <select name="from_months">
                                                                            <option value>Month</option>
                                                                            <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php endfor; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="small-6 column">
                                                                        <!--<label>End Date
                                                                                <input type="text" class="end_date" id="studied_end_date<?php /*echo '-'.$key */?>" name="studied_end_date[]"  placeholder="yyyy-mm-dd"
                                                                                       value="<?php /*echo (isset($_SESSION['studied_end_date'])?$_SESSION['studied_end_date'][$key]:'')*/?>"
                                                                                />
                                                                            </label>-->
                                                                        <select name="from_years">
                                                                            <option value>Year</option>
                                                                            <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php endfor; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="medium-6 column">
                                                                    <legend>To:</legend>
                                                                    <div class="small-6 column">

                                                                        <select name="from_months">
                                                                            <option value>Month</option>
                                                                            <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php endfor; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="small-6 column">
                                                                        <select name="from_years">
                                                                            <option value>Year</option>
                                                                            <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php endfor; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="large-12 columns" id="studied_with_duration_div" style="display:none">
                                                            <div class="large-12 columns">
                                                                <legend><strong>Duration:</strong></legend>
                                                            </div>
                                                            <div class="large-12 columns">
                                                                <div class="small-4 column">
                                                                    <legend>Number of years:</legend>
                                                                    <input type="text" />
                                                                </div>
                                                                <div class="small-4 column">
                                                                    <legend>From:</legend>
                                                                    <select name="from_years">
                                                                        <option value>Year</option>
                                                                        <?php for ($i = 2018; $i >=1000; $i--) : ?>
                                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                        <?php endfor; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="small-4 column">
                                                                    <legend>To:</legend>

                                                                    <select name="from_years">
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
                                                        <button type="button" class="success button secondary small" onclick="duplicate(this)">+</button>
                                                        <button type="button" class="alert button secondary small" onclick="remove(this)">-</button>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="danced__with_section tabs-panel" id="panel2v-1">
                                                <fieldset id="dance_repeat0">
                                                    <div class="row">
                                                        <div class="small-4 column">
                                                            <legend><strong>Danced for Details:</strong></legend>
                                                        </div>
                                                        <div class="small-4 small-offset-4 column">
                                                            <button type="button" class="btn btn-primary" id="danced__with_toggle"
                                                                    style="padding: 5px 8px; background-color:grey; color:ghostwhite; font-weight: bold;" onclick="toggleDuration(this)">
                                                                <large >Change to Duration</large>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="row duration_selection" value="danced">
                                                        <input class="relation_type" title="danced" style="display:none"/>
                                                        <div class="large-12 columns" id="danced__with_range_div">
                                                            <div class="large-12 columns" >
                                                                <legend><strong>Range:</strong></legend>
                                                            </div>
                                                            <div class="large-12 columns">
                                                                <div class="medium-6 column">
                                                                    <legend>From:</legend>
                                                                    <div class="small-6 column">
                                                                        <select name="from_months">
                                                                            <option value>Month</option>
                                                                            <?php /*for ($i = 1; $i <= 12; $i++) : */?>
                                                                            <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                            <?php /*endfor; */?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="small-6 column">
                                                                        <select name="from_years">
                                                                            <option value>Year</option>
                                                                            <?php /*for ($i = 2018; $i >=1000; $i--) : */?>
                                                                            <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                            <?php /*endfor; */?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="medium-6 column">
                                                                    <legend>To:</legend>
                                                                    <div class="small-6 column">

                                                                        <select name="from_months">
                                                                            <option value>Month</option>
                                                                            <?php /*for ($i = 1; $i <= 12; $i++) : */?>
                                                                            <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                            <?php /*endfor; */?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="small-6 column">
                                                                        <select name="from_years">
                                                                            <option value>Year</option>
                                                                            <?php /*for ($i = 2018; $i >=1000; $i--) : */?>
                                                                            <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                            <?php /*endfor; */?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="large-12 columns" id="danced__with_duration_div" style="display:none">
                                                            <div class="large-12 columns">
                                                                <legend><strong>Duration:</strong></legend>
                                                            </div>
                                                            <div class="large-12 columns">
                                                                <div class="small-4 column">
                                                                    <legend>Number of years:</legend>
                                                                    <input type="text" />
                                                                </div>
                                                                <div class="small-4 column">
                                                                    <legend>From:</legend>
                                                                    <select name="from_years">
                                                                        <option value>Year</option>
                                                                        <?php /*for ($i = 2018; $i >=1000; $i--) : */?>
                                                                        <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                        <?php /*endfor; */?>
                                                                    </select>
                                                                </div>
                                                                <div class="small-4 column">
                                                                    <legend>To:</legend>

                                                                    <select name="from_years">
                                                                        <option value>Year</option>
                                                                        <?php /*for ($i = 2018; $i >=1000; $i--) : */?>
                                                                        <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                        <?php /*endfor; */?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </fieldset>
                                            </div>
                                            <div class="colbrtd_with_section tabs-panel" id="panel3v-1">
                                                <fieldset id="collaborated_repeat0">
                                                    <div class="row">
                                                        <div class="small-4 column">
                                                            <legend><strong>Collaborated With Details:</strong></legend>
                                                        </div>
                                                        <div class="small-4 small-offset-4 column">
                                                            <button type="button" class="btn btn-primary" id="colbrtd_with_toggle"
                                                                    style="padding: 5px 8px; background-color:grey; color:ghostwhite; font-weight: bold;" onclick="toggleDuration(this)">
                                                                <large >Change to Duration</large>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="row duration_selection" value="collaborated">
                                                        <input class="relation_type" title="collaborated" style="display:none"/>
                                                        <div class="large-12 columns" id="colbrtd_with_range_div">
                                                            <div class="large-12 columns" >
                                                                <legend><strong>Range:</strong></legend>
                                                            </div>
                                                            <div class="large-12 columns">
                                                                <div class="medium-6 column">
                                                                    <legend>From:</legend>
                                                                    <div class="small-6 column">
                                                                        <select name="from_months">
                                                                            <option value>Month</option>
                                                                            <?php /*for ($i = 1; $i <= 12; $i++) : */?>
                                                                            <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                            <?php /*endfor; */?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="small-6 column">
                                                                        <select name="from_years">
                                                                            <option value>Year</option>
                                                                            <?php /*for ($i = 2018; $i >=1000; $i--) : */?>
                                                                            <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                            <?php /*endfor; */?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="medium-6 column">
                                                                    <legend>To:</legend>
                                                                    <div class="small-6 column">

                                                                        <select name="from_months">
                                                                            <option value>Month</option>
                                                                            <?php /*for ($i = 1; $i <= 12; $i++) : */?>
                                                                            <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                            <?php /*endfor; */?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="small-6 column">
                                                                        <select name="from_years">
                                                                            <option value>Year</option>
                                                                            <?php /*for ($i = 2018; $i >=1000; $i--) : */?>
                                                                            <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                            <?php /*endfor; */?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="large-12 columns" id="colbrtd_with_duration_div" style="display:none">
                                                            <div class="large-12 columns">
                                                                <legend><strong>Duration:</strong></legend>
                                                            </div>
                                                            <div class="large-12 columns">
                                                                <div class="small-4 column">
                                                                    <legend>Number of years:</legend>
                                                                    <input type="text" />
                                                                </div>
                                                                <div class="small-4 column">
                                                                    <legend>From:</legend>
                                                                    <select name="from_years">
                                                                        <option value>Year</option>
                                                                        <?php /*for ($i = 2018; $i >=1000; $i--) : */?>
                                                                        <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                        <?php /*endfor; */?>
                                                                    </select>
                                                                </div>
                                                                <div class="small-4 column">
                                                                    <legend>To:</legend>

                                                                    <select name="from_years">
                                                                        <option value>Year</option>
                                                                        <?php /*for ($i = 2018; $i >=1000; $i--) : */?>
                                                                        <option value="<?php /*echo $i; */?>"><?php /*echo $i; */?></option>
                                                                        <?php /*endfor; */?>
                                                                    </select>
                                                                </div>
                                                            </div>
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

    <div class="row">
        <?php if(isset($_SESSION['artist_relation_add'])):?>
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
        <?php if(isset($_SESSION['artist_profile_add'])):?>
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
        <?php if(isset($_SESSION['artist_profile_edit'])):?>
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
        <?php if(isset($_SESSION['artist_profile_view'])):?>
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
        //var children = divName.getElementsByTagName();
        var divId = divName.parentNode.parentNode.parentNode.id;
        //console.log(divName.parentNode.parentNode.parentNode.id);
        var myDiv = document.getElementById(divId);
        var divClone = myDiv.cloneNode(true);
        divClone.id = divId + ++count;

        var divClass = divName.parentNode.parentNode.parentNode.className;
        var childDivPrefix = divClass.substring(0, 13);
        var divIdLength = divId.length;
        var childDivSuffix = divId.charAt(9,divIdLength+1);
        if(childDivSuffix == " ")
            childDivSuffix = '';

        var children = divClone.childNodes;

        //var c = divClone.querySelector("#"+childDivPrefix+"toggle");

        var changeButton = divClone.querySelector("#"+childDivPrefix+"toggle"+childDivSuffix);
        var durDiv= divClone.querySelector("#"+childDivPrefix+"duration_div"+childDivSuffix);
        var rangeDiv = divClone.querySelector("#"+childDivPrefix+"range_div"+childDivSuffix);
        /*var durDiv= divClone.getElementById(childDivPrefix+"duration_div");
        var rangeDiv = divClone.getElementById(childDivPrefix+"range_div");*/
        changeButton.id = childDivPrefix+"toggle"+count;
        durDiv.id = childDivPrefix+"duration_div"+count;
        rangeDiv.id = childDivPrefix+"range_div"+count;

        divName.parentNode.parentNode.parentNode.parentNode.appendChild(divClone);
    }
    function remove(divName) {
        console.log(divName.parentNode.parentNode.parentNode.id);
        var element = document.getElementById(divName.parentNode.parentNode.parentNode.id);
        element.outerHTML = "";
        delete element;
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
        $(".duration_years").change(function(){
            var num_years = $(this).val();
            var num_months = $(this).closest('.duration_selection').find(".duration_months").val();
            var relation_type = $(this).closest('.duration_selection').find(".relation_type").attr("title");
            var relation_checkbox = $(this).closest(".duration_selection").parent().parent().parent().parent().parent().find(".relation_" + relation_type + "_cb");
            if((num_years == 0 && num_months == 0) || ((num_years == "") && (num_months == ""))){
                $(relation_checkbox).prop('checked', false);
                $(relation_checkbox).hide();
            }else{
                $(relation_checkbox).prop('checked', true);
                $(relation_checkbox).show();
            }
        });
        $(".duration_months").change(function(){
            var num_years = $(this).closest('.duration_selection').find(".duration_years").val();
            var num_months = $(this).val();
            var relation_type = $(this).closest('.duration_selection').find(".relation_type").attr("title");
            var relation_checkbox = $(this).closest(".duration_selection").parent().parent().parent().parent().parent().find(".relation_" + relation_type + "_cb");
            if((num_years == 0 && num_months == 0) || ((num_years == "") && (num_months == ""))){
                $(relation_checkbox).prop('checked', false);
                $(relation_checkbox).hide();
            }else{
                $(relation_checkbox).prop('checked', true);
                $(relation_checkbox).show();
            }
        });
        $(".relationship").click(function(){
            console.log($(this).attr("title"));
            var relation_section = $(this).closest(".row").find("."+$(this).attr("title"));
            if($(this).attr("title") == "influenced_by_section"){
                $(this).prop('checked', false);
                $(this).hide();
                $(relation_section).find(".influenced").hide();
                $(relation_section).find(".not_influenced").show();
            }else{
                if(!$(this).is(":checked")){
                    $(relation_section).find(".duration_years").val("");
                    $(relation_section).find(".duration_months").val("");
                    $(relation_section).find(".start_date").val("");
                    $(relation_section).find(".end_date").val("");
                    $(relation_section).find(".duration_years").prop("readonly",false);
                    $(relation_section).find(".duration_months").prop("readonly",false);
                    $(this).prop('checked', false);
                    $(this).hide();
                }
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
    $(document).ready(function(){
        dateScripts();
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

        if(button_val == dur_text){
            button.innerText = range_text;
            document.getElementById(dur_div_id).style.display="block";
            document.getElementById(dur_range_id).style.display="none";
        }
        else{
            button.innerText = dur_text;
            document.getElementById(dur_range_id).style.display="block";
            document.getElementById(dur_div_id).style.display="none";
        }
    }
</script>
<?php
include 'form_links_footer.php';
include 'footer.php';
?>

</html>