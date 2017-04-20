<?php
session_start();
include_once "function.php";

$mediaid = $_POST['mediaid'];
$playlistid = $_POST['playlistid'];

$deleteplaylistmediaquery = "delete from playlistMedia where playlistid = '$playlistid' and mediaid = '$mediaid';";
$deleteplaylistmediaresult = mysql_query($deleteplaylistmediaquery)
	or exit("removing from playlistmedia error in delete_media_from_playlist_process.php" .mysql_error());

?>

<meta http-equiv="refresh" content="0;url=individual_playlist.php?id=<?php echo $playlistid; ?>">
	