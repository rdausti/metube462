<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
	Channels
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

    <?php 
    if(!isset($_POST['username'])) {
    	$username = $_GET['id'];
    }
    else {
    	$username = $_POST['username'];
	}	
    ?>

    <?php 

    //if you are logged in
    if(isset($_SESSION['username'])) {
    	if($_SESSION['username'] == $username) { ?>


    		<!-- MY CHANNELS -->
	    	<table style="background:#003366; width:100%;" cellpadding="10">
		    	<tr>
		    		<td align="center">
		    			<font style="color:#ffffff; font-family:verdana;">
		    				My Channels
		    			</font>
		    		</td>
		    	</tr>
		    </table>

		    <?php 
		    $channelquery = "select * from channel where username = '$username'";
		    $channelresult = mysql_query($channelquery);
		    if(!$channelresult) {
		    	exit("Couldn't query channel table: " .mysql_error());
		    }
		    ?>
		    <br>
		    <table width="100%">
		    	<?php while($channelrow = mysql_fetch_row($channelresult)) {
		    		$channelid = $channelrow[0];
		    		$title = $channelrow[1];
		    		?>
		    		<script type="text/javascript">
		    			function channelSubmit(id) {
		    				document.getElementById("goToChannel"+id).submit();
		    			}
		    		</script>
		    		<tr>
			    		<td>
			    			<form method="post" action="individual_channel.php?id=<?php echo $channelid;?>" id="goToChannel<?php echo $channelid;?>">
			    				<input type="hidden" name="username" value="<?php echo $username;?>">
			    			</form>
			    			<a style="cursor:pointer; cursor:hand;" onclick="channelSubmit(<?php echo $channelid;?>)">
			    				<font style="color:#ffffff; font-family:verdana;">
				    				<?php echo $title;?>
				    			</font>
			    			</a>
			    		</td>
			    		<td align="right" width="100px">
			    			<form method="post" action="delete_channel_process.php" enctype="multipart/form-data">
			    				<input type="submit" value="Delete Channel" name="delete">
	    						<input type="hidden" name="channelid" value="<?php echo $channelid;?>">
			    			</form>
			    		</td>
			    	</tr>
		    	<?php } 
		    	?>
		    </table>
		    <br><br>
		    <table>
		    	<tr>
		    		<form method="post" action="create_channel.php" enctype="multipart/form-data">
		    			<td>
		    				<input type="submit" value="Create Channel" name="createChannel">
		    			</td>
		    		</form>
		    	</tr>
		    </table>

		    <!-- MY SUBSCRIPTIONS -->
		    <br><br>
		    <table style="background:#003366; width:100%;" cellpadding="10">
		    	<tr>
		    		<td align="center">
		    			<font style="color:#ffffff; font-family:verdana;">
		    				My Subscriptions 
		    			</font>
		    		</td>
		    	</tr>
		    </table>

		    <?php 
		    $subquery = "select subscription.subscriptionid, subscription.channelid, channel.title from subscription inner join channel on subscription.channelid = channel.channelid where subscription.username = '$username'";
		    $subresult = mysql_query($subquery);
		    if(!$subresult) {
		    	exit("Couldn't query Subscription table: " .mysql_error());
		    }
		    ?>
		    <br>
		    <table width="100%">
		    	<?php while($subrow = mysql_fetch_row($subresult)) {
		    		$subid = $subrow[0];
		    		$channelid = $subrow[1];
		    		$title = $subrow[2];
		    		?>
		    		<script type="text/javascript">
		    			function channelSubmit(id) {
		    				document.getElementById("goToChannel"+id).submit();
		    			}
		    		</script>
		    		<tr>
			    		<td>
			    			<form method="post" action="individual_channel.php?id=<?php echo $channelid;?>" id="goToChannel<?php echo $channelid;?>">
			    				<input type="hidden" name="username" value="<?php echo $username;?>">
			    			</form>
			    			<a style="cursor:pointer; cursor:hand;" onclick="channelSubmit(<?php echo $channelid;?>)">
			    				<font style="color:#ffffff; font-family:verdana;">
				    				<?php echo $title;?>
				    			</font>
			    			</a>
			    		</td>
			    		<td align="right" width="100px">
			    			<form method="post" action="unsubscribe_process.php" enctype="multipart/form-data">
			    				<input type="submit" value="Unsubscribe" name="unsubscribe">
	    						<input type="hidden" name="channelid" value="<?php echo $channelid;?>">
			    			</form>
			    		</td>
			    	</tr>
		    	<?php } 
		    	?>
		    </table>

	    <?php }

	    //if we are looking at someone elses channel and logged in
	    else { ?>
	    	<?php 
	    	$myUsername = $_SESSION['username'];
	    	?>
	    	<table style="background:#003366; width:100%;" cellpadding="10">
		    	<tr>
		    		<td align="center">
		    			<font style="color:#ffffff; font-family:verdana;">
		    				<?echo $username."'s ";?>
		    				Channels
		    			</font>
		    		</td>
		    	</tr>
		    </table>

		    <?php 
		    $chanelquery = "select * from channel where username = '$username'";
		    $channelresult = mysql_query($chanelquery);
		    if(!$channelresult) {
		    	exit("Couldn't query channel table: " .mysql_error());
		    }
		    ?>
		    <br>
		    <table width="100%">
		    	<?php while($channelrow = mysql_fetch_row($channelresult)) {
		    		$channelid = $channelrow[0];
		    		$title = $channelrow[1];
		    		?>
		    		<script type="text/javascript">
		    			function channelSubmit(id) {
		    				document.getElementById("goToChannel"+id).submit();
		    			}
		    		</script>
		    		<tr>
			    		<td>
			    			<form method="post" action="individual_channel.php?id=<?php echo $channelid;?>" id="goToChannel<?php echo $channelid;?>">
			    				<input type="hidden" name="username" value="<?php echo $username;?>">
			    			</form>
			    			<a onclick="channelSubmit(<?php echo $channelid;?>)">
			    				<font style="color:#ffffff; font-family:verdana;">
				    				<?php echo $title;?>
				    			</font>
			    			</a>
			    		</td>
			    		<?php 
			    		$subquery = "select * from subscription where channelid = '$channelid' and username = '$myUsername';";
				    	$subresult = mysql_query($subquery);
				    	if(!$subresult) {
				    		exit("Could not query subscription table: ".mysql_error());
				    	}
				    	$subrow = mysql_fetch_row($subresult);
				    	if($subrow) { ?>
				    		<td align="right">
					    		<form method="post" action="unsubscribe_process.php" enctype="multipart/form-data">
									<input type="submit" value="Unubscribe" name="unsubscribe">
									<input type="hidden" name="channelid" value="<?php echo $channelid;?>">
								</form>
							</td>
				    	<?php }
				  		else { ?>
					  		<td align="right">
						    	<form method="post" action="subscribe_process.php" enctype="multipart/form-data">
									<input type="submit" value="Subscribe" name="subscribe">
									<input type="hidden" name="channelid" value="<?php echo $channelid;?>">
								</form>
							</td>
						<?php } ?>
			    	</tr>
		    	<?php } 
		    	?>
		    </table>

	    <?php }
    }

    //if you are NOT logged in
    else { ?>
    	<table style="background:#003366; width:100%;" cellpadding="10">
	    	<tr>
	    		<td align="center">
	    			<font style="color:#ffffff; font-family:verdana;">
	    				<?echo $username."'s ";?>
	    				Channels
	    			</font>
	    		</td>
	    	</tr>
	    </table>

	    <?php 
	    $chanelquery = "select * from channel where username = '$username'";
	    $channelresult = mysql_query($chanelquery);
	    if(!$channelresult) {
	    	exit("Couldn't query channel table: " .mysql_error());
	    }
	    ?>
	    <br>
	    <table>
	    	<?php while($channelrow = mysql_fetch_row($channelresult)) {
	    		$channelid = $channelrow[0];
	    		$title = $channelrow[1];
	    		?>
	    		<script type="text/javascript">
	    			function channelSubmit(id) {
	    				document.getElementById("goToChannel"+id).submit();
	    			}
	    		</script>
	    		<tr>
		    		<td>
		    			<form method="post" action="individual_channel.php?id=<?php echo $channelid;?>" id="goToChannel<?php echo $channelid;?>">
		    				<input type="hidden" name="username" value="<?php echo $username;?>">
		    			</form>
		    			<a onclick="channelSubmit(<?php echo $channelid;?>)">
		    				<font style="color:#ffffff; font-family:verdana;">
			    				<?php echo $title;?>
			    			</font>
		    			</a>
		    		</td>
		    	</tr>
	    	<?php } 
	    	?>
	    </table>
    <?php } ?>

</body>
</html>

    