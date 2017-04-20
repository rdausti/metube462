<?php 
session_start();
include_once "function.php";

$username = $_SESSION['username'];
$channelid = $_POST['channelid'];

$insert = "insert into subscription(subscriptionid, channelid, username) values(NULL, '$channelid', '$username');";
$result = mysql_query($insert) 
	or exit("Could not insert into subscription table: " .mysql_error());
?>
<meta http-equiv="refresh" content="0;url=individual_channel.php?id=<?php echo $channelid;?>">