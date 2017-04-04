<?php
session_start();

include_once "function.php";

  $username = $_SESSION['username'];
  $sendTo = $_POST['sendTo'];
  $content = $_POST['content'];
  $sender = $_POST['sender'];

  $messagequery = "insert into message(messageid, content, sender, receiver, isItRead) values (NULL, '$content', '$sender', $sendTo', FALSE)";
  $messageresult = mysql_query($messagequery) or die("insert into message error". mysql_error());
  ?>

<meta http-equiv="refresh" content="0;url=message_process.php">

  <form method="post" action="message_send_process.php">
    <input type="hidden" name="sendTo" value="<?php echo $sendTo?>"/>
  </form>
