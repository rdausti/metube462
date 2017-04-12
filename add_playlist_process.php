<?php 
session_start();
include_once "function.php";

$username = $_SESSION['username'];

if(isset($_POST['createPlaylist']) or isset($_POST['createAndAddToPlaylist'])) {
	if(isset($_POST['createPlaylist'])) {
		$title = $_POST['CPTitle'];
	}
	else { $title = $_POST['CADDTitle']; }

	$insertquery = "insert into playlist(playlistid,title,username) values(NULL, '$title', '$username');";
	$insertresult = mysql_query($insertquery)
		or exit("Insert into playlist unsuccessfull: " .mysql_error());
}

if(isset($_POST['addToPlaylist']) or isset($_POST['createAndAddToPlaylist'])) {
	if(isset($_POST['createAndAddToPlaylist'])) {
		$playlistTitle = $_POST['CADDTitle'];
	}
	else{ $playlistTitle = $_POST['ADDTitle']; }

	$idquery = "select playlistid from playlist where title = '$playlistTitle' and username = '$username';";
	$idresult = mysql_query($idquery)
		or exit("Select from playlist unsuccessfull: " .mysql_error());
	$idrow = mysql_fetch_row($idresult);
	$playlistid = $idrow[0];
	$mediaid = $_POST['mediaid'];
	$insertquery2 = "insert into playlistMedia(pmid, playlistid, mediaid) values(NULL, '$playlistid', '$mediaid');";
	$insertresult2 = mysql_query($insertquery2) 
		or exit("Insert into playlistMedia unsuccessfull: " .mysql_error());
}

if(isset($_POST['createPlaylist'])) { ?>
	<meta http-equiv="refresh" content="0;url=all_playlists.php">
<?php }
else { ?>
	<meta http-equiv="refresh" content="0;url=media.php?id=<?php echo $_POST['mediaid'];?>">
<?php } ?>