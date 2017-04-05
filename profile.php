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
  
</head>

<body bgcolor=#00cc66>

<!-- this is the bar on the top of the screen -->
<?php require 'header.php'; ?>

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
  //if there is a user logged in 
  if(isset($_SESSION['username'])) {

    //if the user is looking at their profile
    if($_SESSION['username'] == $username) { ?>
      <div style="background:#ff007f;color:#ffffff; width:100%; margin:auto; padding-top: 10px; padding-bottom: 10px;">
        <table style="width:100%; text-align:center">
          <tr>
            <td>
              <a href="./channels.php" style="font-size:25px;color:#ffffff">
                My Channels
              </a>
            </td>
            <td>
              <a href="./my_media.php" style="font-size:25px;color:#ffffff">
                My Media
              </a>
            </td>
            <td>
              <a href="./update_profile.php" style="font-size:25px;color:#ffffff">
                Update Profile
              </a>
            </td>
          </tr>
        </table>
      </div><br>

    <?php
    }
    //if they are looking at someone elses profile
    else { ?>

    <a style="cursor:pointer; curson:hand;"onclick="userToProfile()">
      Channels
    </a>

    <?php
    } ?>

    <!-- print the user's username, firstname, lastname, gender and email -->
    <h1>
      <font color=#ffffff>
        <?php echo $username ?>
      </font>
    </h1>

    <h3>
      <font color=#ffffff>
        <?php 
          echo $firstname;
          echo " ";
          echo $lastname; 
        ?>
      </font>
    </h3>

    <h4>
      <font color=#ffffff>
        <?php echo $gender; ?>
      </font>
    </h4>

    <h4>
      <font color=#ffffff>
        <?php echo $email; ?>
      </font>
    </h4>

  <?php
  }

  //if they are logged in and looking at someone elses profile
  if($_SESSION['username'] != $username and isset($_SESSION['username'])) { ?>
    <a style="cursor:pointer; cursor:hand;"onclick="sendMessage()">
      <font color=#ffffff>
        Send Message
      </font>
    </a>
  <?php
  } 

  //if they are logged in and lookin at their profile 
  else { ?>
    <a style="cursor:pointer; cursor:hand;"onclick="userToProfile()">
      <font color=#ffffff>
        Channels
      </font>
    </a>

    <h2>
      <font color=#ffffff>
        <?php echo $username; ?>
      </font>
    </h2>

    <h3>
      <font color=#ffffff>
        <?php echo $firstname; ?>
        &nbsp;
        <?php echo $lastname; ?> 
      </font>
    </h3>

  <?php
  } 

  $mediaquery = "select * from media where username='$username'";
  $mediaresult = mysql_query($mediaquery);
  if(!$mediaresult) {
    exit("Could not get information from Media table: <br />". mysql_error());
  } ?>

  <br>
  <div style="background:#ff007f;color:#ffffff; width:100%; margin:auto; text-align:center; padding-top: 10px; padding-bottom: 10px;">
    <?php echo $username;?>'s Media
  </div>
  <table style="width:100%;" class="table table-hover">
    <?php
    while($rowresult = mysql_fetch_row($mediaresult)) {
      $mediaid = $rowresult[3];
      $filename = $rowresult[0];
      $path = $rowresult[4];
      $title = $rowresult[5]; ?>
      <tr> 
        <td style="text-align:left">
          <a href="media.php?id=<?php echo $mediaid;?>" target="_blank">
            <font color=#ffffff>
              <?php echo $title;?>
            </font>
          </a>
        </td>
        <td style="text-align:right">
          <a href="<?php echo $path;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $success_row[4];?>);">
            <font color=#ffffff>
              Download
            </font>
          </a>
        </td>
      </tr>
    <?php } ?>
    <br>
  </table>
  </div>
</body>
</html>
