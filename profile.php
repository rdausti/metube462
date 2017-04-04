<!DOCTYPE html PUBLIC "-//W#C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1?DTD/xhtml1-transitional.dtd">

<?php
session_start();
include_once "function.php";
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Profile</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/default.css" />
  
  <!-- this is the bar on the top of the screen -->
  <?php require 'header.php'; ?>

</head>

<body bgcolor="#00cc66">

<?php

  $username = $_POST['username'];

  $accountquery = "select * from account where username = '$username'";
  $accountresult = mysql_query($accountquery);

  $rowresult = mysql_fetch_row($accountresult);

  $firstname = $rowresult[2];
  $lastname = $rowresult[3];
  $gender = $rowresult[4];
  $email = $rowresult[5];

?>

  <script type="text/javascript">
    function sendMessage() {
      document.getElementById("sendMessage").submit();
    } 
  </script>

  <form method="POST" action="message_process.php" id="sendMessage">
    <input type="hidden" name="sendTo" value="<?php echo $username;?>"/>
  </form>

  <script type="text/javascript">
    function userToProfile() {
      document.getElementById("Channels").submit();
    }
  </script>

  <form method="POST" action="channels.php" id="Channels">
    <input type="hidden" name="username" value="<?php echo $username;?>"/>
  </form>

  
  <div>
  <?php
  if(isset($_SESSION['username'])) {
  if($_SESSION['username'] == $username) { ?>
    <div style="background:#ffffff;color:#ff007f; width:100%; margin:auto; padding-top: 10px; padding-bottom: 10px;">
      <table style="width:100%; text-align:center">
        <tr>
          <td>
            <a href="./channels.php" style="font-size:25px;color:#ff007f">My Channels</a>
          </td>
          <td>
            <a href="./my_media.php" style="font-size:25px;color:#ff007f">My Media</a>
          </td>
          <td>
            <a href="./update_profile.php" style="font-size:25px;color:#ff007f">Update Profile</a>
          </td>
        </tr>
      </table>
    </div><br>

  <?php
  }
  else { ?>

  <a style="cursor:pointer; curson:hand;"onclick="userToProfile()">Channels</a>

  <?php
  } ?>

  <h1><?php echo $username ?></h1>

  <h3><?php echo $firstname;
            echo " ";
            echo $lastname; ?></h3>

  <h4><?php echo $gender; ?></h4>

  <h4><?php echo $email; ?></h4>

  <?php
  if($_SESSION['username'] != $username and isset($_SESSION['username'])) { ?>
    <a style="cursor:pointer; cursor:hand;"onclick="sendMessage()">Send Message</a>
  <?php
  }
  } 
  else { ?>
    <a style="cursor:pointer; cursor:hand;"onclick="userToProfile()">Channels</a>

    <h2><?php echo $username; ?></h2>

    <h3><?php echo $firstname; ?>
      &nbsp;
      <?php echo $lastname; ?> </h3>

  <?php
  } 

  $mediaquery = "select * from media where username='$username'";
  $mediaresult = mysql_query($mediaquery);
  if(!$mediaresult) {
    die("Could not get information from Media table: <br />". mysql_error());
  } ?>

    <br>
    <div style="background:#ffffff;color:#ff007f; width:100%; margin:auto; text-align:center; padding-top: 10px; padding-bottom: 10px;"><?php echo $username;?>'s Media</div>
    <table style="width:100%;" class="table table-hover">
      <?php
      while($rowresult = mysql_fetch_row($mediaresult)) {
        $mediaid = $rowresult[3];
        $filename = $rowresult[0];
        $path = $rowresult[4];
        $title = $rowresult[5];
      ?>
        <tr> 
          <td style="text-align:left">
            <a href="media.php?id=<?php echo $mediaid;?>" target="_blank"><?php echo $title;?></a>
          </td>
          <td style="text-align:right">
            <a href="<?php echo $path;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $success_row[4];?>);">Download</a>
          </td>
        </tr>
      <?php
      } ?>
      <br>
    </table>
  </div>
</body>
</html>
