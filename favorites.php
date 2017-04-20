<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
session_start();
include_once "function.php";
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		My Favorites 
	</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<?php require 'header.php'; ?>
</head>

<body bgcolor="#00cc66">

	<form method="post" id="usernameForm<?php echo $username; ?>" action="profile.php">
  		<input type="hidden" name="username" value="<?php echo $username; ?>" />
	</form>

	<br><br>

	<table style="width:100%" cellpadding="10">
    	<tr style="background:#003366" >
    		<td align="center">
	            <font style="color:#ffffff; font-family:verdana;">
	            	My Favorites
	            </font>
    		</td>
    	</tr>
  	</table>

  	<?php 
  	$username = $_SESSION['username'];	
  	$favoritesquery = "select * from media join favorite on media.mediaid = favorite.mediaid where favorite.username = '$username'";
  	$favoritesresult = mysql_query($favoritesquery);
  	if(!$favoritesresult) {
  		exit("Could not query media join favorite table: " . mysql_error());
  	} ?>

  	<table width="100%" cellpadding="5" cellspacing="0">
  		<?php while($fav_resultrow = mysql_fetch_row($favoritesresult)) {
  			$mediaid = $fav_resultrow[3];
  			$filename = $fav_resultrow[0];
  			$path = $fav_resultrow[4];
  			$title = $fav_resultrow[5];
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
	            <td align="center" style="background:#00994c" width="100px">
		            <a href="<?php echo $path;?>" style="text-decoration:none" target="_blank">
		            	<font style="color:#ffffff; font-family:verdana;">
		            		Download
		            	</font>
		            </a>
	            </td>
	            <td align="center" style="background:#00994c" width="100px">
		            <form method="post" action="unfavorite_process.php" enctype="multipart/form-data">
		            	<input type="submit" value="Unfavorite" name="unfavoriteMedia">
		            	<input type="hidden" name="mediaid" value="<?php echo $mediaid;?>">
		            </form>
	            </td>
			</tr>

  		<?php } ?>
  	</table>

</body>
</html>