<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
	My Playlists
</title>

<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script type="text/javascript">
	function saveDownload(id)
	{
		$.post("media_download_process.php",
		{ id: id, },
		function(message) 
	    { }
	 	);
	} 
</script>

<!-- bar on top of screen -->
<?php require 'header.php'; ?>

</head>

<body bgcolor="#00cc66">

	<br><br>

	<form method="post" id="usernameForm<?php echo $username; ?>" action="profile.php">
    	<input type="hidden" name="username" value="<?php echo $username; ?>" />
    </form>

    <table style="background:#003366; width:100%;" cellpadding="10">
    	<tr>
    		<td align="center">
    			<font style="color:#ffffff; font-family:verdana;">
    				My Playlists
    			</font>
    		</td>
    	</tr>
    </table>

    <?php
    $username = $_SESSION['username'];
    $playlistquery = "select * from playlist where username = '$username';";
    $playlistresult = mysql_query($playlistquery);
    if(!$playlistresult) {
    	exit("Could not query the playlist table: " . mysql_error());
    }
    ?>

    <table width="100%">
    	<?php
    	while($resultrow = mysql_fetch_row($playlistresult)) {
    		$title = $resultrow[1];
    		$playlistid = $resultrow[0];
    	?>
    	<tr>
    		<td>
                <form method="post" action="individual_playlist.php" enctype="multipart/form-data">
                    <input type="submit" value="<?php echo $title; ?>" name="title">
                    <input type="hidden" name="playlistid" value="<?php echo $playlistid;?>">
	    		</form>
	    	</td>
	    	<td align="right" width="100px">
	    		<form method="post" action="delete_playlist_process.php" enctype="multipart/form-data">
	    			<input type="submit" value="Delete Playlist" name="delete">
	    			<input type="hidden" name="playlistid" value="<?php echo $playlistid;?>">
	    		</form>
	    	</td>
    	</tr>
    	<?php } ?>
    </table>
    <br><br>
    <table>
    	<tr>
    		<form method="post" action="add_playlist_process.php" enctype="multipart/form-data">
    			<td width="130px">
    				<font style="color:#ffffff; font-family:verdana;">
	    				Create Playlist:
	    			</font>
    			</td>
    			<td width="200px">
    				<input type="text" name="CPTitle" id="CPTitle" style="width:200px">
    			</td>
    			<td>
    				<input type="submit" value="Create Playlist" name="createPlaylist">
    			</td>
    		</form>
    	</tr>
    </table>
</body>
</html>


