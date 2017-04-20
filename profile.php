<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1?DTD/xhtml1-transitional.dtd">

<?php
session_start();
include_once "function.php";
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
  Profile
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
</head>

<body bgcolor="#00cc66">

<!-- this is the bar on the top of the screen -->
<?php require 'header.php'; ?>

<form method="post" id="usernameForm<?php echo $username; ?>" action="profile.php">
  <input type="hidden" name="username" value="<?php echo $username; ?>" />
</form>

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
  <div>
  <?php
  //if there is a user logged in 
  if(isset($_SESSION['username'])) {

    //if the user is looking at their profile
    if($_SESSION['username'] == $username) { ?>
      
      <br><br>

      <table style="width:100%; text-align:center; background:#003366; color:#ffffff; width:100%; margin:auto;" cellpadding="10">
        <tr>
          <td>
            <a style="text-decoration:none; cursor:pointer; cursor:hand;" onclick="userToProfile()">
              <font style="color:#ffffff; font-family:verdana;">
                My Channels
              </font>
            </a>
          </td>
          <td>
            <a href="./favorites.php" style="text-decoration:none">
              <font style="color:#ffffff; font-family:verdana;">
                My Favorites
              </font>
            </a>
          </td>
          <td>
            <a href="./all_playlists.php" style="text-decoration:none">
              <font style="color:#ffffff; font-family:verdana;">
                My Playlists
              </font>
            </a>
          </td>
          <td>
            <a href="./update_profile.php" style="text-decoration:none">
              <font style="color:#ffffff; font-family:verdana;">
                Update Profile
              </font>
            </a>
          </td>
        </tr>
      </table>
      <br>

      <h1>
        <font style="color:#ffffff; font-family:verdana;">
          <?php 
            echo $username 
          ?>
        </font>
      </h1>

      <h3>
        <font style="color:#ffffff; font-family:verdana;">
          Name:
          <?php 
            echo " ";
            echo $firstname;
            echo " ";
            echo $lastname; 
          ?>
        </font>
      </h3>

      <h4>
        <font style="color:#ffffff; font-family:verdana;">
          Gender:
          <?php 
            echo " ";
            echo $gender; 
          ?>
        </font>
      </h4>

      <h4>
        <font style="color:#ffffff; font-family:verdana;">
          Email: 
          <?php 
            echo " ";
            echo $email; 
          ?>
        </font>
      </h4>

    <?php
    }
    //if they are looking at someone elses profile
    else { ?>

      <h1>
        <font style="color:#ffffff; font-family:verdana;">
          <?php 
          echo $username;
          ?>
        </font>
      </h1>

      <h3>
        <font style="color:#ffffff; font-family:verdana;">
          Name:
          <?php 
            echo " ";
            echo $firstname;
            echo " ";
            echo $lastname; 
          ?>
        </font>
      </h3>

      <h4>
        <font style="color:#ffffff; font-family:verdana;">
          Gender: 
          <?php 
            echo " ";
            echo $gender; 
          ?>
        </font>
      </h4>

      <h4>
        <font style="color:#ffffff; font-family:verdana;">
          Email:
          <?php 
            echo " ";
            echo $email; 
          ?>
        </font>
      </h4>

      <br>

      <form method="POST" action="all_channels.php" id="Channels">
        <input type="submit" value="<?php echo $username;?>'s Channels">
        <input type="hidden" name="username" value="<?php echo $username;?>"/>
      </form>

      <br>

      <form method="POST" action="message_process.php" id="sendMessage">
        <input type="submit" value="Send Message to <?php echo $username;?>">
        <input type="hidden" name="sendTo" value="<?php echo $username;?>"/>
      </form>

      <br>
    <?php
    }
  }

  $mediaquery = "select * from media where username = '$username'";
  $mediaresult = mysql_query($mediaquery);
  if(!$mediaresult) {
    echo "no media";
  } 

  else { ?>
    <br>

    <?php 
    if(!isset($_SESSION['username'])) { ?>
      <h1>
        <font style="color:#ffffff; font-family:verdana;">
          <?php 
          echo $username;
          ?>
        </font>
      </h1>

      <h3>
        <font style="color:#ffffff; font-family:verdana;">
          Name:
          <?php 
            echo " ";
            echo $firstname;
            echo " ";
            echo $lastname; 
          ?>
        </font>
      </h3>

      <h4>
        <font style="color:#ffffff; font-family:verdana;">
          Gender: 
          <?php 
            echo " ";
            echo $gender; 
          ?>
        </font>
      </h4>

      <h4>
        <font style="color:#ffffff; font-family:verdana;">
          Email:
          <?php 
            echo " ";
            echo $email; 
          ?>
        </font>
      </h4>

      <a style="cursor:pointer; cursor:hand;" onclick="userToProfile()">
        <font style="background:#00994c; color:#ffffff; font-family:verdana;">
          <?php 
          echo $username;
          echo "'s";
          ?>
          Channels
        </font>
      </a>
    <?php } ?>
    <br><br>
    <table style="background:#003366; width:100%; margin:auto; text-align:left;" cellpadding="10">
      <tr>
        <td>
          <font style="color:#ffffff; font-family:verdana;">
            <?php 
              echo $username;
              echo "'s";
            ?>
            Media - Click filename to view Media
          </font>
        </td>
      </tr>
    </table>
    <table style="width:100%;">
      <?php
      while($rowresult = mysql_fetch_row($mediaresult)) {
        $mediaid = $rowresult[3];
        $filename = $rowresult[0];
        $path = $rowresult[4];
        $title = $rowresult[5]; ?>
        <tr> 
          <td  width="40px">
            <font style="color:#ffffff; font-family:verdana;">
              <?php echo $mediaid;?>
            </font>
          </td>
          <td  width="250px">
            <font style="color:#ffffff; font-family:verdana;">
              <?php echo $title;?>
            </font>
          </td>
          <td style="text-align:left">
            <a href="media.php?id=<?php echo $mediaid;?>" style="text-decoration:none" target="_self">
              <font style="color:#ffffff; font-family:verdana;">
                <?php 
                  echo $filename;
                ?>
              </font>
            </a>
          </td>
          <?php 
          if(isset($_SESSION['username'])) {
            if($_SESSION['username'] == $username) { ?>
              <td style="background:#00994c; text-align:center" width="200px">
                <form method="post" id="updateMediaForm<?php echo $mediaid; ?>" action="update_media.php">
                  <input type="hidden" name="mediaid" value="<?php echo $mediaid; ?>" />
                </form>
                <a style="cursor:pointer; cursor:hand; text-decoration:none;" onclick="javascript:document.getElementById('updateMediaForm<?php echo $mediaid; ?>').submit(); ">
                  <font style="color:#ffffff; font-family:verdana;">
                    Update Media
                  </font>
                </a>
              </td>
          <?php }
          } ?>
          <td style="background:#00994c; text-align:center" width="100px">
            <a href="<?php echo $path;?>" style="text-decoration:none" target="_blank">
              <font style="color:#ffffff; font-family:verdana;">
                Download
              </font>
            </a>
          </td>
        </tr>
      <?php } ?>
      <br>
    </table>
  <?php } ?>

  </div>
</body>
</html>
