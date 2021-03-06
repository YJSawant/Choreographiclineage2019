<?php
include 'util.php';
my_session_start();
?>
<?php
if($_SESSION["user_type"] == "Admin")
{
	include 'admin_menu.php';
}else{
	include 'menu.php';
}
?>
<html>
<head>
	<title>Lineage</title>
	<link rel="stylesheet" href="dist/vis-network.min.css" type="text/css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/6.2.1/foundation.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="css/lineage_styles.css" type="text/css" />
</head>
<body  onload="draw()">
	<div id="network_div">
		<div id="network_row" class="row">
			<div id="filter_div" class="small-12 medium-12 large-2 columns">
				<div id="searchbox_row" class="row">
					<div class="large-13 columns">
						<label><b>Search</b></label>
       					<input id="searchbox" type="search" placeholder="Enter Name" />
						<input style="margin-bottom: 10px;" id="university-search-box" type="search" placeholder="Enter University" />
						<label><b>Living Status</b></label>
						<label style="display:inline-block;"><input id="chk" type="checkbox" class="checkbox_living" value="living">Living</label>
						<label style="display:inline-block;"><input id="chk" type="checkbox" class="checkbox_living" value="deceased"></span>Deceased</label>
						<label><b>Gender</b></label>
						<label style="display:inline-block;"><input id="chk" type="checkbox" class="checkbox_gender" value="male"></span>Male</label>
						<label style="display:inline-block;"><input id="chk" type="checkbox" class="checkbox_gender" value="female"></span>Female</label>
						<input style="margin-bottom: 10px;" id="state-search-box" type="search" placeholder="Enter State Code" />
						<input style="margin-bottom: 10px;" id="country-search-box" type="search" placeholder="Enter Country" />
						<input style="margin-bottom: 10px;" id="major-search-box" type="search" placeholder="Enter Major" />
						<input style="margin-bottom: 10px;" id="degree-search-box" type="search" placeholder="Enter Degree" />
						<input style="margin-bottom: 10px;" id="ethnicity-search-box" type="search" placeholder="Enter Ethnicity" />
						<input style="display:inline-block; margin-right: 15px;" id="clear" type="submit" value="Clear"/>
						<input style="display:inline-block; margin-bottom: 15px;" id="submit" type="button" value="Submit"/>
					</div>
				</div>
				<div class='my-legend'style="margin: auto;">
						<div class='legend-title'>Network Guide</div>
						<div class='legend-scale'>
  					<ul class='legend-labels'>
    					<li><span class="bluenode"></span>Own Contribution</li>
    					<li><span class="rednode"></span>Other's Contribution</li>
    					<li><span class="redarrow"></span>Studied Under</li>
    					<li><span class="yellowarrow"></span>Collaborated With</li>
    					<li><span class="greenarrow"></span>Danced in the work of</li>
						<li><span class="bluearrow"></span>Influenced By</li>
						<li><span class="greyarrow"></span>Any Relationship</li>
   				</ul>
				</div>
			 </div>
			<div hidden id="searchbox_node_id">
			</div>
			</div>
			<div id="load" class="loader-frame small-12 medium-12 large-10 columns">
				<div id="loader_circles_div">
					<div class="circle loader1"></div>
					<div class="circle1 loader2"></div>
				</div>
			</div>
			<div id="network_display_div" class="small-12 medium-12 large-10 columns">
				<div id="tab_bar_row" class="row tab">
					<span style = "cursor: pointer;" title="Use your mouse wheel to zoom in and out"><img src="img/help.png" style="height:20px;width:20px;"/></span>
					<button class="tablinks medium-offset-1 small-3 medium-2 columns active" id="full_network_tab">Full Network</button>
					<button class="tablinks small-2 columns" id="studied_with_tab">Studied under</button>
					<button class="tablinks small-3 medium-2 columns" id="collaborated_with_tab">Collaborated with</button>
					<button class="tablinks small-2 columns" id="danced_for_tab">Danced in the Work of</button>
					<button class="tablinks end small-2 columns" id="influenced_by_tab">Influenced by</button>
				</div>
				<div hidden id="searchTextValue">
				</div>
				<div hidden id="uniTextValue">
				</div>
				<div hidden id="stateTextValue">
				</div>
				<div hidden id="countryTextValue">
				</div>
				<div hidden id="majorTextValue">
				</div>
				<div hidden id="degreeTextValue">
				</div>
				<div hidden id="ethnicityTextValue">
				</div>
				<div hidden id="bioTextValue">
				</div>
				<div id="search_text">
				</div>
				<div id="my_network">
				</div>
				<div hidden id="mySidenav" class="sidenav">
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
					<img class="pic" id="artist_pic" src = "">
					<div class="info"> Background information</div>
					<div id="artist_name" class="name"> </div>
					<div id="artist_gender" class="gender"> </div>
					<div id="artist_status" class="status"> </div>
					<div id="artist_genre" class="genre" > </div>
					<div id="artist_education" class="education" > </div>
					<div id="artist_bio_div"> 
					<a href="javascript:void(0)" onclick="openPopUp()" id="artist_biography" class="biography">Click here for biography</a>
				    </div>   
					<div id="artist_lineage_text" class="lineage">Lineal Lines: </div>                         
					<div class="row"> 
						<table id="artist_lineals" class="display" style="width:100%;margin-left:8px;margin-right:2px;background-color:#eee;">
							<thead>
								<tr>
									<th data-field="a_name">Artist Names</th>
									<th data-field="a_relation">Relationship</th>
								</tr>
							</thead>
						</table>				
					</div>
				</div>
			</div>
		</div>
	</div>
	<style type='text/css'>
	.pic{
		height: 240px;
		overflow:hidden;	
		width: 100%;	
		margin-bottom: 1px;		
	}
	.info{
		text-align : center;
		font-weight: bold;
		background-color:#FFFFFF;
		margin-bottom: 5px;
	}

	.name{
		text-align : center;
		font-weight: bold;
		margin-bottom: 2px;
	}

	.gender{
		text-align : center;
		margin-bottom: 2px;
	}
	.status{
		text-align : center;
		margin-bottom: 2px;
	}
	.education{
		text-align : center;
		margin-bottom: 2px;
		margin-left: 2px;
	}
	.genre{
		text-align : center;
		margin-bottom: 2px;
	}

	.lineage{
		text-align : left;
		font-weight: bold;
		margin-left: 2px;
	}
	thead {
		display:none;
		}

	.biography{
		font-size: 15px;
		margin-bottom: 2px;
		color: #4743f7;
		text-align : center;
	}
	.bluenode:before {
		content: '\26AC';
		font-size: 20px;
		color:#da0067;
		}
	.rednode:before{
		content:'\26AC';
		font-size:20px;
		color:#025457;
	}
	.redarrow:before{
		content:'\279B';
		font-size:20px;
		color:red;
	}
	.yellowarrow:before{
		content:'\279B';
		font-size:20px;
		color:#FFC300;
	}
	.greenarrow:before{
		content:'\279B';
		font-size:20px;
		color:green;
	}
	.bluearrow:before{
		content:'\279B';
		font-size:20px;
		color:blue;
	}
	.greyarrow:before{
		content:'\279B';
		font-size:20px;
		color:grey;
	}

  .my-legend .legend-title {
    text-align: left;
    margin-bottom: 5px;
    font-weight: bold;
    font-size: 90%;
    }
  .my-legend .legend-scale ul {
    margin: 0;
    margin-bottom: 5px;
    padding: 0;
    float: left;
    list-style: none;
    }
  .my-legend .legend-scale ul li {
    font-size: 80%;
    list-style: none;
    margin-left: 0;
    line-height: 18px;
    margin-bottom: 2px;
    }
  .my-legend ul.legend-labels li span {
    display: block;
    float: left;
    height: 16px;
    width: 30px;
    margin-right: 5px;
    margin-left: 0;
    border: 1px solid #999;
    }
  .my-legend .legend-source {
    font-size: 70%;
    color: #999;
    clear: both;
    }
  .my-legend a {
    color: #777;
    }

body {
  font-family: "Lato", sans-serif;
  transition: background-color .5s;
}

.sidenav {
  height: 100%;
  width: 0%;
  position: fixed;
  z-index: 1;
  top: 0;
  right: 0;
  background-color: #DCDCDC;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
  color: #383839;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
	<script>
		function closeNav() {
		document.getElementById("mySidenav").style.display = "none"; 
		document.getElementById("mySidenav").style.width = "0";	
		}

		function openPopUp() {
		var urlVal= document.getElementById("bioTextValue").innerHTML;
		if(urlVal.startsWith("http") || urlVal.startsWith("https") || urlVal.startsWith("ftp"))
		{
			window.open(urlVal, '_blank', 'width=400,height=400');
		} else{
			var myWindow= window.open('', '_blank', 'width=400,height=400');
			myWindow.document.write(urlVal);
		} 		
		}
	</script>
	<script type="text/javascript" src="dist/vis.js"></script>
	<script src="https://cdn.jsdelivr.net/foundation/6.2.1/foundation.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="js/lineage_network.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</body>
</html>
