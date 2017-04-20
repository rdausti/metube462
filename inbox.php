<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
include_once "function.php";
  if(isset($_POST['submit2'])) {
    if(isset($_POST['sendTo'])) {
      $send = $_POST['sendTo'];
      $usernamequery = "select * from account where username = '$send'";
      $usernameresult = mysql_query($usernamequery);
      if (!$usernameresult){
        exit ("counldn't query account table in Inbox". mysql_error());
      }
      else {
        $rowresult = mysql_fetch_assoc($usernameresult);
        if($rowresult == 0){
          $senderror = "Username does not exist.";
        }
        else if($send == $_SESSION['username']) {
          $senderror = "You cannot send a message to yourself.";
        }
        else { 
          header('Location: message_process.php?sendTo='.$send);
        }
      }
    }
  }
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
  Messages Inbox
</title>

<!-- bar on top of screen -->
<?php require 'header.php'; ?>

</head>

<body bgcolor="#00cc66">
  <form method="post" id="usernameForm<?php echo $username; ?>" action="profile.php">
    <input type="hidden" name="username" value="<?php echo $username; ?>" />
  </form>
  <?php
  //getting the username
  $username = $_SESSION['username'];
  //getting all the messages where the user is the receiver and group them on the sender 
  $usersquery = "select * from message where receiver='$username' group by sender;";
  $userresults = mysql_query($usersquery) or exit("Could not query the message table <br> " . mysql_error());
  ?>
  <br><br>
    <table style="background:#003366; width:100%;" cellpadding="10">
      <tr>
        <td>
          <font style="color:#ffffff; font-family:verdana;">
            Messages Inbox
          </font>
        </td>
      </tr>
    </table>
    <br><br>
    <table cellpadding="5">
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
        $m_read = 1; //TRUE - IT HAS BEEN READ - NOT RED
        $num_messages = mysql_num_rows($messages);
        $count = 0;
        //looping through the messages between one user to see if any are unread
        //if one is then set m_read to false
        while($count != $num_messages) {
          $m = mysql_fetch_row($messages);
          //IF NOT READ THEN SET TO FALSE
          if((!$m[4])) {
            $m_read = 0; //FLASE - NOT BEEN READ BY RECIEVER - RED
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
      <?php } ?>
    </table>
    <br><br> 

    <!-- creating a new message chian with a user that we haven't messaged yet -->
    <form method="post" action="inbox.php">
      <table>
        <tr>
          <td width="15%"> 
            <label for="sendTo">
              <font style="color:#ffffff; font-family:verdana;">
                Send Message To: 
              </font>
            </label>
          </td>
          <td width="200px">
            <input style="width:400px" title="sendTo" type="text" name="sendTo" placeholder="Username"> 
            <br> 
          </td>
          <td>
            <input type="submit" value="Send" name="submit2">
          </td>
        </tr>
      </table>
    </form>
    
    <?php
      if(isset($senderror)) { ?>
        <font style="color:#ffffff; font-family:verdana;">
        <?php echo "<div id='username_result'>".$senderror."</div>"; ?>
        </font> 
      <?php }
    ?>
</body>
</html>
