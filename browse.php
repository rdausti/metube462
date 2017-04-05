<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Browse</title>
<link rel="stylesheet" type="text/css" href="css/default.css" />
<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script type="text/javascript">

function saveDownload(id)
{
	$.post("media_download_process.php",
	{
       id: id,
	},
	function(message) 
    { }
 	);
} 
</script>

<!-- bar on top of screen -->
<?php require 'header.php'; ?>

</head>

<body bgcolor=#00cc66>
	<?php 
	//if a user with a username hasn't started a session yet
	if(!isset($_SESSION['username'])) { ?>
	  <h2>
	  	<font color=#ffffff>
	  		Welcome
	  	</font>
	  </h2>
	<?php } 
	//if a user with a username has started a session 
	else { ?>
	  <h2>
	  	<font color=#ffffff>
	  		Welcome <?php echo $_SESSION['username'];?>
	  	</font>
	  </h2>

	  <a href='media_upload.php'  style="color:#ffffff;">
	  	Upload File
	  </a>
	  
	  <div id='upload_result'>
		<?php 
			if(isset($_REQUEST['result']) && $_REQUEST['result']!=0) {		
				echo upload_error($_REQUEST['result']);
			} 
		?>
	  </div>
	  <br/><br/>
	<?php } ?>

	<?php
		//selecting everything from the media table
		$mediaquery = "SELECT * from media"; 
		$mediaresult = mysql_query( $mediaquery );
		if (!$mediaresult) {
		   exit("Could not query the media table in the database: <br />". mysql_error());
		}
	?>
	    
    <div style="background:#ff007f;color:#FFFFFF; width:100%;">
    	Uploaded Media
    </div>

	<table width="100%" cellpadding="5" cellspacing="0">
		<?php
		while ($rowresult = mysql_fetch_row($mediaresult)) { 
			$mediaid = $rowresult[3];
			$filename = $rowresult[0];
			$filenpath = $rowresult[4];
		?>
        <tr valign="top">			
			<td>
				<font color=#ffffff>
					<?php echo $mediaid;?>
				</font>
			</td>
            <td>
	            <a href="media.php?id=<?php echo $mediaid;?>" target="_blank">
	            	<font color=#ffffff>
	            		<?php echo $filename;?>
	            	</font>
	            </a> 
            </td>
            <td>
	            <a href="<?php echo $filenpath;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $filenpath;?>);">
	            	<font color=#ffffff>
	            		Download
	            	</font>
	            </a>
            </td>
		</tr>
        <?php } ?>
	</table>
</body>
</html>
