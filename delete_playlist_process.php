<?php 
session_start();
include_once "function.php";

$username = $_SESSION['username'];
$playlistid = $_POST['playlistid'];

$deleteplaylist = "delete from playlist where username = '$username' and playlistid = '$playlistid'";
$deleteplaylistmedia = "delete from playlistMedia where playlistid = '$playlistid'";

$deleteplaylistresult = mysql_query($deleteplaylist)
	or exit("removing from playlist error delete_playlist_process.php" .mysql_error());
$deleteplaylistmediaresult = mysql_query($deleteplaylistmedia)
	or exit("removing from playlist media error delete_playlist_process" .mysql_error());

?>

<meta http-equiv="refresh" content="0;url=all_playlists.php">