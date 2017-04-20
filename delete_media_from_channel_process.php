<?php
session_start();
include_once "function.php";

$channelid = $_POST['channelid'];
$mediaid = $_POST['mediaid'];

$delete = "delete from channelMedia where channelid = '$channelid' and mediaid = '$mediaid';";
$result = mysql_query($delete) 
	or exit("Could not delete from channelMedia table: ".mysql_error());
?>

<meta http-equiv="refresh" content="0; url=individual_channel.php?id=<?php echo $channelid;?>">