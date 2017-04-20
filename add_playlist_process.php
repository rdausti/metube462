<?php 
session_start();
include_once "function.php";

$username = $_SESSION['username'];
$title = $_POST['CPTitle']; 

$insertquery = "insert into playlist(playlistid,title,username) values(NULL, '$title', '$username');";
$insertresult = mysql_query($insertquery)
	or exit("Insert into playlist unsuccessfull: " .mysql_error());

?>
<meta http-equiv="refresh" content="0;url=all_playlists.php">
