<?php 
session_start();
include_once "function.php";

$username = $_SESSION['username'];
$title = $_POST['title'];
$description = $_POST['description'];

$insert = "insert into channel(channelid, title, description, username) values(NULL, '$title', '$description', '$username');";
$queryresult = mysql_query($insert) 
	or exit("Could not insert into channel table: " .mysql_error());
?>

<meta http-equiv="refresh" content="0; url=all_channels.php?id=<?php echo $username;?>">