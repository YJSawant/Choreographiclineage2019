<?php
include 'path.php';
include 'menu.php';
include 'util.php';

my_session_start();
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
      <title>Sidenav</title>
      <link rel="stylesheet" href="dist/vis-network.min.css" type="text/css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/6.2.1/foundation.min.css">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <link rel="stylesheet" href="css/lineage_styles.css" type="text/css" />
    </head>
    <style>
      
    </style>
  </head>

  <body>
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div id="artist_name"> </div>
    <div id="artist_details"> </div>
</div>
  </body>
<?php
include 'footer.php';
?>
</html>
