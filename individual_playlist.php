<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
	Individual Playlist
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

	<form method="post" id="usernameForm<?php echo $username; ?>" action="profile.php">
    	<input type="hidden" name="username" value="<?php echo $username; ?>" />
    </form>

	<br><br>

	<?php
	$playlistid = $_POST['playlistid'];
	$playlistquery = "select title from playlist where playlistid='$playlistid';";
	$playlistresult = mysql_query($playlistquery);
	$playlistrowresult = mysql_fetch_row($playlistresult);
	$playlisttitle = $playlistrowresult[0];

	$username = $_SESSION['username'];
	$bigquery = "select * from playlistMedia join playlist where playlist.playlistid = playlistMedia.playlistid and playlist.playlistid = '$playlistid' and playlist.username = '$username';";
	$bigresult = mysql_query($bigquery);
	if(!$bigresult) {
		exit("Could not query playlistMedia: " .mysql_error());
	}

	?>

	<table width="100%" cellpadding="10">
    	<tr style="background:#003366" width="100%">
    		<td align="center">
    			<font style="color:#ffffff; font-family:verdana;">
    				<?php echo $playlisttitle; ?>
    			</font>
    		</td>
    	</tr>
    </table>

	<?php
	while($bigresultrow = mysql_fetch_row($bigresult)) {
		$mediaid = $bigresultrow[2];
		$mediaquery = "select * from media where mediaid = '$mediaid';";
		$mediaresult = mysql_query($mediaquery);
		$mediarow = mysql_fetch_row($mediaresult);
		$filename = $mediarow[0];
		$path = $mediarow[4];
		$title = $mediarow[5]; 
		?>
		<table width="100%">
			<tr valign="top">			
				<td  width="40px">
					<font style="color:#ffffff; font-family:verdana;">
						<?php echo $mediaid;?>
					</font>
				</td>
				<td  width="250px">
					<font style="color:#ffffff; font-family:verdana;">
						<?php echo $title;?>
					</font>
				</td>
	            <td>
		            <a href="media.php?id=<?php echo $mediaid;?>" target="_self" style="text-decoration:none">
		            	<font style="color:#ffffff; font-family:verdana;">
		            		<?php echo $filename;?>
		            	</font>
		            </a> 
	            </td>
	            <td align="center" style="background:#00994c" width="100px">
		            <a href="<?php echo $path;?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $path;?>);">
		            	<font style="color:#ffffff; font-family:verdana;">
		            		Download
		            	</font>
		            </a>
	            </td>
	            <td align="center" width="100px">
	            	<form method="post" action="delete_media_from_playlist_process.php" enctype="multipart/form-data">
	            		<input type="submit" value="Remove" name="delete">
	            		<input type="hidden" name="playlistid" value="<?php echo $playlistid ?>">
	            		<input type="hidden" name="mediaid" value="<?php echo $mediaid ?>">
	            	</form>
	            </td>
			</tr>
		</table>
	<?php } ?>
</body>
</html>