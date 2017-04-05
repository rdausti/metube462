<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
include_once "function.php";
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/default.css" />
<title>Message</title>
<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="Sripts/AC_RunActiveContent.js" type="text/javascript"></script>

<!-- this is the bar at the top-->
<?php require 'header.php'; ?>

</head>

<body bgcolor=#00cc66>

  <div>
  
  <?php
  $receiver=ucfirst($_POST['sendTo']);
  $sender=$_SESSION['username'];

  if($sender == $receiver) {
    echo "<div>Error: Cannot message yourself. Please pick new receiver.</div>";
  }
  else {
    if(isset($_POST['send'])) {
      $sendTo = $_POST['sendTo'];
      $content = mysql_real_escape_string($_POST['content']);
      $sendFrom = $_POST['sender'];
      $insert = "insert into message(messageid, content, sender, receiver, isItRead) values(NULL, '$content', '$sendFrom', '$sendTo', FALSE)";
      $insertResult = mysql_query($insert) or die("Insert into Messages error". mysql_error());
    }

    $messagequery = "select * from message where (receiver = '$sender' and sender = '$receiver') or (receiver = '$receiver' and sender = '$sender');";

    $messageresult = mysql_query($messagequery);
    if(!$messageresult) {
      exit("Could not query message table in database: <br />".mysql_error());
    }
    ?>

    <br>
    <fieldset>
      <table style="width:100%">
        <legend>Messages with <?php echo $receiver ?></legend>
        <?php
        while($oneMessage = mysql_fetch_row($messageresult)) {
          $messageid = $oneMessage[0];
          $body = $oneMessage[1];
          $messageSender = $oneMessage[2];
          $isItRead = $oneMessage[4];
        ?>

          <tr>
            <td style="width:8%">
              <label>
                <font color=#ffffff>
                  <?php echo $messageSender;?>
                  :
                </font>
              </label>
            </td>
            <td>
              <label>
                <font color=#ffffff>
                  <?php echo $body;?>
                </font>
              </label>
            </td>
          </tr>
          <?php
        } ?>
      </table>
    </fieldset>

    <fieldset>
      <table>
        <tr>
          <td>
            <form method="post" action="">
              <label>
                <font color=#ffffff>
                  Send to <?php echo $receiver?>:
                </font>
              </label>
              <br><br>
              <textarea rows="6" style="width:800px" name="content"></textarea>
              <br><br>
              <input type="submit" name="send" value="Send"/>
              <input type="hidden" name="sendTo" value="<?php echo $receiver;?>"/>
              <input type="hidden" name="sender" value="<?php echo $sender;?>"/>
            </form>
          </td>
        </tr>
      </table>
    </fieldset>
    </div>
 
  <?php
  }

  $updatemessage = "update message set isItRead=1 where receiver='$sender' and sender = '$receiver';";
  $messageesult = mysql_query($updatemessage) or die("Could not query message: <br />". mysql_error());
  ?>
</body>
</html>
