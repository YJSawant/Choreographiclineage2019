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
    <title>Coming Soon | Choreographic Lineage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/6.2.1/foundation.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Asap">
    <link rel="stylesheet" href="../css/global.css">
    <style>
    .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid green;
      border-bottom: 16px solid green;
      width: 120px;
      height: 120px;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
      margin-left: auto;
      margin-right: auto;
  
}
.gap-50 {
        width:100%;
        height:50px;
      }
.gap-80 {
        width:100%;
        height:80px;
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
    <h2 class="text-center">Coming Soon</h2>

    <div class="gap-50"></div>
   <div class="loader" ></div>
    <div class="gap-80"></div>


  </body>
<?php
include 'footer.php';

?>
</html>
