<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
	Create Channel
</title>

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
    				Create Channel
    			</font>
    		</td>
    	</tr>
    </table>
    <br><br>
    <form action="create_channel_process.php" method="post" enctype="multipart/form-data">
	    <table>
	    	<tr>
	    		<td>
	    			<font style="color:#ffffff; font-family:verdana;">
			            Title:
			        </font>
	    		</td>
	    		<td>
	    			<input type="text" style="width:200px" name="title"> 
	    		</td>
	    	</tr>
	    	<tr>
	    		<td>
	    			<font style="color:#ffffff; font-family:verdana;">
			            Description:
			        </font>
	    		</td>
	    		<td>
	    			<textarea style="width:200px" rows="3" name="description"></textarea>
	    		</td>
	    	</tr>
	    	<tr>
				<td>
			    	<input name="submit" type="submit" value="Submit">
			  	</td>
			</tr>
	    </table>
	</form>
</body>
</html>