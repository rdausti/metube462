<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
	Channel
</title>

<!-- bar on top of screen -->
<?php require 'header.php'; ?>

</head>

<body bgcolor="#00cc66">

	<br><br>

	<form method="post" id="usernameForm<?php echo $username; ?>" action="profile.php">
    	<input type="hidden" name="username" value="<?php echo $username; ?>" />
    </form>

    <?php
    $channelid = $_GET['id'];
    $channelquery = "select * from channel where channelid = '$channelid';";
    $channelresult = mysql_query($channelquery);
    if(!$channelresult) {
    	exit("Couldn't query channel table: ".mysql_error());
    }
    $channelrow = mysql_fetch_row($channelresult);
    $title = $channelrow[1];
    $description = $channelrow[2];
    $username = $channelrow[3];
   	?>

    <table width="100%" cellpadding="10">
    	<tr style="background:#003366">
      		<td>
        		<font style="color:#ffffff; font-family:verdana;">
          			<?php echo $title;?>
       			</font>
      		</td>
    	</tr>
    	<tr>
    		<td>
	    		<font style="color:#ffffff; font-family:verdana;">
	      			Description: &nbsp;
	      			<?php echo $description;?>
	   			</font>
	   		</td>
    	</tr>
  	</table>
  	<br><br>

  	<?php
  	$cmediaquery = "select * from channelMedia inner join channel on channelMedia.channelid = channel.channelid where channelMedia.channelid = '$channelid';";
  	$cmediaresult = mysql_query($cmediaquery);
  	if(!$cmediaresult) {
  		exit("Could not query channelMedia table: " .mysql_error());
  	} ?>

  	<table width="100%">
  	<?php while($cmediarow = mysql_fetch_row($cmediaresult)) {
  		$mediaid = $cmediarow[2];

  		$mediaquery = "select * from media where mediaid = '$mediaid';";
  		$mediaresult = mysql_query($mediaquery);
  		if(!$mediaresult) {
  			exit("Could not query media table: " .mysql_error());
  		}
  		$mediarow = mysql_fetch_row($mediaresult);
  		$filename = $mediarow[0];
  		$path = $mediarow[4];
  		$title = $mediarow[5];
  		?>
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
            <?php
            //if we are logged in 
		    if(isset($_SESSION['username'])) {
		    	//if we are looking at our channel
		   		if($_SESSION['username'] == $username) { ?>
			   		<td align="right" width="100px">
		    			<form method="post" action="delete_media_from_channel_process.php" enctype="multipart/form-data">
		    				<input type="submit" value="Remove Media" name="delete">
							<input type="hidden" name="mediaid" value="<?php echo $mediaid;?>">
							<input type="hidden" name="channelid" value="<?php echo $channelid;?>">
		    			</form>
		    		</td>
		   		<?php } 
		   	}?>
            <td align="center" style="background:#00994c" width="100px">
	            <a href="<?php echo $path;?>" style="text-decoration:none" target="_blank">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		Download
	            	</font>
	            </a>
            </td>
		</tr>

  	<?php }
  	?>
</body>
</html>