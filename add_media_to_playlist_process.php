<?php 
session_start();
include_once "function.php";

$username = $_SESSION['username'];
$playlistTitle = $_POST['ADDTitle'];

$idquery = "select playlistid from playlist where title = '$playlistTitle' and username = '$username';";
$idresult = mysql_query($idquery)
	or exit("Select from playlist unsuccessfull: " .mysql_error());
$idrow = mysql_fetch_row($idresult);
$playlistid = $idrow[0];
$mediaid = $_POST['mediaid'];
$insertquery2 = "insert into playlistMedia(pmid, playlistid, mediaid) values(NULL, '$playlistid', '$mediaid');";
$insertresult2 = mysql_query($insertquery2) 
	or exit("Insert into playlistMedia unsuccessfull: " .mysql_error());
?>

<meta http-equiv="refresh" content="0;url=all_playlists.php">