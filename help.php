<?php
include 'path.php';
include 'menu.php';
include 'util.php';

my_session_start();
if (isset($_SESSION["user_email_address"])){
  $user_email_address=$_SESSION["user_email_address"];
  $user_firstname=$_SESSION["user_firstname"];
  $user_lastname=$_SESSION["user_lastname"];
  $user_name=$user_firstname." ".$user_lastname;

}
else{
  $user_name="";
  $user_email_address="";
}
?>
<html>
<head>
  <title>Help Page</title>
  <style>
    .footer{
      margin-top: 2.9%;
    }
  </style>
</head>
<div class="container">
  <div style="text-align:center">
    <h4>Kindly tell us your query</h4>
  </div>
  <div class="row">
      <form method ="post" action="help_mediator.php" name="emailform">
        <label for="fname">Name</label>
        <input type="text" id="name" name="name" placeholder="Your name" value="<?php echo $user_name?>">
        <label for="lname">Email</label>
        <input type="Email" id="mail" name="mail" placeholder="Your Email-ID" value="<?php echo $user_email_address?>">
        <label for="subject">Subject</label>
        <textarea id="subject" name="content"
         placeholder="Please start writing here"
         style="height:110px">
        </textarea>
        <input type="submit" name="submit" value="Submit" style="color:black">
      </form>
    </div>
</div>
<div class="footer">
  <?php
  include 'footer.php';
  ?>
  </div>
</div>
</html>
