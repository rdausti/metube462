<?php
session_start();
include_once "function.php";

$username = $_SESSION['username'];
$channelid = $_POST['channelid'];

$delete = "delete from channel where channelid = '$channelid' and username = '$username';";
$result = mysql_query($delete) 
	or exit("Could not delete from channel table: ".mysql_error());

$delete1 = "delete from channelMedia where channelid = '$channelid';";
$result1 = mysql_query($delete1) 
	or exit("Could not delete from channelMedia table: ".mysql_error());

$delete2 = "delete from subscription where channelid = '$channelid';";
$result2 = mysql_query($delete2) 
	or exit("Could not delete from subscription table: ".mysql_error());


?>

<meta http-equiv="refresh" content="0; url=all_channels.php?id=<?php echo $username;?>">