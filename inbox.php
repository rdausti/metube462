<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
include_once "function.php";
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/default.css" />
<title>Messages Inbox</title>
<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>

<!-- bar on top of screen -->
<?php require 'header.php'; ?>

</head>

<body bgcolor=#00cc66>
  <?php
  //getting the username
  $username = $_SESSION['username'];
  //getting all the messages where the user is the receiver and group them on the sender 
  $usersquery = "select * from message where receiver='$username' group by sender;";
  $userresults = mysql_query($usersquery) or exit("Could not query the message table <br> " . mysql_error());
  ?>

  <br><br>

  <div>
    <fieldset>
      <legend> 
        <font color=#ffffff>
          Messages Inbox 
        </font>
      </legend>
      <table cellpadding="10">
        <?php
        //while the current sender still has a message  
        while ($single_message = mysql_fetch_row($userresults)) {
          $m_sender = $single_message[2];
          //taking into account the two way conversation where each messager is a sender or receiver
          $messagequery="select * from message where ((receiver='$username' and sender='$m_sender') or (receiver='$m_sender' and sender='$username')) order by messageid desc;";
          $messages = mysql_query($messagequery);
          if(!$messages) {
            exit("Could not query the message table <br> " .mysql_error());
          }
          $m_read = 1;
          $num_messages = mysql_num_rows($messages);
          $count = 0;
          //looping through the messages between one user to see if any are unread
          //if one is then set m_read to false
          while($count != $num_messages) {
            $m = mysql_fetch_row($messages);
            if(!$m[4]) {
              $m_read = 0;
            }
            $count = $count + 1;
          }
          ?>
          <tr>
            <td>
              <form method="post" action="message_process.php">
                <!-- if there are no unread messages then just print normally -->
                <?php if($m_read) { ?>
                  <input type="submit" style=" width:200px" value="<?php echo $m_sender ?>" name="readMessage" />
                  <input type="hidden" name="sendTo" value="<?php echo $m_sender?>"/>
                <!-- if there is an unread message then print in red to notify the user as to which message chain needs attention-->
                <?php } else { ?>
                  <input type="submit" style="color:red; width:200px" value="<?php echo $m_sender ?>" name="readMessage" />
                  <input type="hidden" name="sendTo" value="<?php echo $m_sender?>"/>
                <?php } ?> 
              </form>
            </td>
          </tr>
          <?php
        }
        ?>
      </table>
    </fieldset>
    <br><br>

    <!-- creating a new message chian with a user that we haven't messaged yet -->
    <form method="post" action="message_process.php">
      <table>
        <tr>
          <td width="10%"> 
            <label for="sendTo">
              <font color=#ffffff>
                Send Message To: 
              </font>
            </label>
          </td>
          <td width="200px">
            <input style="width:400px" title="sendTo" type="text" name="sendTo" placeholder="Username"> 
            <br> 
          </td>
          <td>
            <input type="submit" value="Send" name="readMessage">
          </td>
        </tr>
      </table>
    </form>
  </div>
</body>
</html>
