<?php 
session_start();
include_once "function.php";

$username = $_SESSION['username'];
$channelid = $_POST['channelid'];

$delete = "delete from subscription where username = '$username' and channelid = '$channelid';";
$result = mysql_query($delete)
	or exit("Could not delete from subscription table: " .mysql_error());
?>
<meta http-equiv="refresh" content="0;url=all_channels.php?id=<?php echo $username;?>">