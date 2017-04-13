<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
session_start();
include_once "function.php";
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		Search
	</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<?php require 'header.php'; ?>
</head>

<body bgcolor="#00cc66">

	<form method="post" id="usernameForm<?php echo $username; ?>" action="profile.php">
    	<input type="hidden" name="username" value="<?php echo $username; ?>" />
  	</form>

	<div>
		<br>
		<table style="width:100%" cellpadding="10">
        	<tr style="background:#003366" >
        		<td>
		            <font style="color:#ffffff; font-family:verdana;">
		            	Search Results - Click Filename to view Media
		            </font>
        		</td>
        	</tr>
      	</table>
		<table style="width:100%; cellpadding:5; cellspacing:0;">
			<?php 
			//breaking search input into chuncks to search on
			$searchItems = explode(' ', mysql_escape_string($_POST["searchItems"]));
			$foundmediaids = [];
			$i = 0;

			foreach($searchItems as $item) {
				$mediaquery = "select * from media where tags like '%$item%'";
				$mediaresult = mysql_query($mediaquery);
				if(!$mediaresult) {
					exit("Could not query media table: " .mysql_error());
				}

				while($mediaresult_row = mysql_fetch_row($mediaresult)) {
					$mediaid = $mediaresult_row[3];
					if(!in_array($mediaid, $foundmediaids)) {
						$foundmediaids[$i] = $mediaid;
						$i++;
						$filename = $mediaresult_row[0];
						$path = $mediaresult_row[4];
						$title = $mediaresult_row[5];
						?>
						<tr>
							<td width="40px">
								<font style="color:#ffffff; font-family:verdana;">
									<?php echo $mediaid; ?>
								</font>
							</td>
							<td width="250px">
								<font style="color:#ffffff; font-family:verdana;">
									<?php echo $title; ?>
								</font>
								</a>
							</td>
							<td>
					            <a href="media.php?id=<?php echo $mediaid;?>" target="_blank" style="text-decoration:none">
					            	<font style="color:#ffffff; font-family:verdana;">
					            		<?php echo $filename;?>
					            	</font>
					            </a> 
				            </td>
							<td align="center" style="background:#00994c" width="100px">
								<a href="<?php echo $path; ?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $mediaresult_row[4];?>);">
									<font style="color:#ffffff; font-family:verdana;">
										Download
									</font>
								</a>
							</td>
						</tr>
					<?php }
				}
			} ?>
		</table>
		<br>
		<font style="color:#ffffff; font-family:verdana;">
			End of search results.
		</font>
	</div>
</body>
</html>