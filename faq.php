<?php
include 'util.php';
my_session_start();
if($_SESSION["user_type"] == "Admin")
{
	include 'admin_menu.php';
}else{
	include 'menu.php';
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon | Choreographic Lineage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/6.2.1/foundation.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Asap">
    <link rel="stylesheet" href="../css/global.css">
    <style>
    .loader {
      margin-top:50px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid green;
        border-bottom: 16px solid green;
        width: 60px;
        height: 60px;
        -webkit-animation: spin 4s linear infinite alternate;
        animation: spin 4s linear infinite alternate;
        margin-left: auto;
        margin-right: auto;
    
        }
    html,body{
      margin:0;
     padding:0;
     height:100%;
      }
    
    .footer {
      position:absolute;
      bottom:0;
      margin-bottom: 2%;
      width:100%;
      height:60px;
    }
    .content {
      height: 1000px; /* Changed this height */
      padding-bottom:60px;
    }
    
    @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }
    .portrait {
       width: 200px;
        }
  </style>
  </head>

  <body>
      <div id="content">
        <h3 class="text-center" style="font-family: 'Open Sans Condensed',sans-serif ">Coming Soon!</h3>
        <div class="loader" ></div>
      </div>

  </body>
  <div class="footer">
  <?php
  include 'footer.php';
  ?>
  </div>
</div>
</html>
