<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
	Browse by Category
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
    $animalsquery = "select * from media where category = 'Animals'";
    $animalsresult = mysql_query($animalsquery);
    if (!$animalsresult) {
		exit("Could not query the media table in the database: <br />". mysql_error());
	} ?>

	<table style="background:#003366; width:100%;" cellpadding="10">
    	<tr>
    		<td>
    			<font style="color:#ffffff; font-family:verdana;">
    				Animals
    			</font>
    		</td>
    	</tr>
    </table>

    <table width="100%" cellpadding="5" cellspacing="0">
		<?php
		while ($animalrow = mysql_fetch_row($animalsresult)) { 
			$animalmediaid = $animalrow[3];
			$animaltitle = $animalrow[5];
			$animalfilename = $animalrow[0];
			$animalfilenpath = $animalrow[4];
		?>
        <tr valign="top">			
			<td  width="40px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $animalmediaid;?>
				</font>
			</td>
			<td  width="250px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $animaltitle;?>
				</font>
			</td>
            <td>
	            <a href="media.php?id=<?php echo $animalmediaid;?>" target="_self" style="text-decoration:none">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		<?php echo $animalfilename;?>
	            	</font>
	            </a> 
            </td>
            <td align="center" style="background:#00994c" width="100px">
	            <a href="<?php echo $animalfilenpath;?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $animalfilenpath;?>);">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		Download
	            	</font>
	            </a>
            </td>
		</tr>
        <?php } ?>
	</table>

	<br><br>

	<?php
    $carsquery = "select * from media where category = 'Cars'";
    $carsresult = mysql_query($carsquery);
    if (!$carsresult) {
		exit("Could not query the media table in the database: <br />". mysql_error());
	} ?>

	<table style="background:#003366; width:100%;" cellpadding="10">
    	<tr>
    		<td>
    			<font style="color:#ffffff; font-family:verdana;">
    				Cars
    			</font>
    		</td>
    	</tr>
    </table>

    <table width="100%" cellpadding="5" cellspacing="0">
		<?php
		while ($carsrow = mysql_fetch_row($carsresult)) { 
			$carsmediaid = $carsrow[3];
			$carstitle = $carsrow[5];
			$carsfilename = $carsrow[0];
			$carsfilenpath = $carsrow[4];
		?>
        <tr valign="top">			
			<td  width="40px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $carsmediaid;?>
				</font>
			</td>
			<td  width="250px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $carstitle;?>
				</font>
			</td>
            <td>
	            <a href="media.php?id=<?php echo $carsmediaid;?>" target="_self" style="text-decoration:none">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		<?php echo $carsfilename;?>
	            	</font>
	            </a> 
            </td>
            <td align="center" style="background:#00994c" width="100px">
	            <a href="<?php echo $carsfilenpath;?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $carsfilenpath;?>);">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		Download
	            	</font>
	            </a>
            </td>
		</tr>
        <?php } ?>
	</table>

	<br><br>

	<?php
    $childrenquery = "select * from media where category = 'Children'";
    $childrenresult = mysql_query($childrenquery);
    if (!$childrenresult) {
		exit("Could not query the media table in the database: <br />". mysql_error());
	} ?>

	<table style="background:#003366; width:100%;" cellpadding="10">
    	<tr>
    		<td>
    			<font style="color:#ffffff; font-family:verdana;">
    				Children
    			</font>
    		</td>
    	</tr>
    </table>

    <table width="100%" cellpadding="5" cellspacing="0">
		<?php
		while ($childrenrow = mysql_fetch_row($childrenresult)) { 
			$childrenmediaid = $childrenrow[3];
			$childrentitle = $childrenrow[5];
			$childrenfilename = $childrenrow[0];
			$childrenfilenpath = $childrenrow[4];
		?>
        <tr valign="top">			
			<td  width="40px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $childrenmediaid;?>
				</font>
			</td>
			<td  width="250px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $childrentitle;?>
				</font>
			</td>
            <td>
	            <a href="media.php?id=<?php echo $childrenmediaid;?>" target="_self" style="text-decoration:none">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		<?php echo $childrenfilename;?>
	            	</font>
	            </a> 
            </td>
            <td align="center" style="background:#00994c" width="100px">
	            <a href="<?php echo $childrenfilenpath;?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $childrenfilenpath;?>);">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		Download
	            	</font>
	            </a>
            </td>
		</tr>
        <?php } ?>
	</table>

	<br><br>

	<?php
    $historyquery = "select * from media where category = 'History'";
    $historyresult = mysql_query($historyquery);
    if (!$historyresult) {
		exit("Could not query the media table in the database: <br />". mysql_error());
	} ?>

	<table style="background:#003366; width:100%;" cellpadding="10">
    	<tr>
    		<td>
    			<font style="color:#ffffff; font-family:verdana;">
    				History
    			</font>
    		</td>
    	</tr>
    </table>

    <table width="100%" cellpadding="5" cellspacing="0">
		<?php
		while ($historyrow = mysql_fetch_row($historyresult)) { 
			$historymediaid = $historyrow[3];
			$historytitle = $historyrow[5];
			$historyfilename = $historyrow[0];
			$historyfilenpath = $historyrow[4];
		?>
        <tr valign="top">			
			<td  width="40px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $historymediaid;?>
				</font>
			</td>
			<td  width="250px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $historytitle;?>
				</font>
			</td>
            <td>
	            <a href="media.php?id=<?php echo $historymediaid;?>" target="_self" style="text-decoration:none">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		<?php echo $historyfilename;?>
	            	</font>
	            </a> 
            </td>
            <td align="center" style="background:#00994c" width="100px">
	            <a href="<?php echo $historyfilenpath;?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $historyfilenpath;?>);">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		Download
	            	</font>
	            </a>
            </td>
		</tr>
        <?php } ?>
	</table>

	<br><br>

	<?php
    $homequery = "select * from media where category = 'Home'";
    $homeresult = mysql_query($homequery);
    if (!$homeresult) {
		exit("Could not query the media table in the database: <br />". mysql_error());
	} ?>

	<table style="background:#003366; width:100%;" cellpadding="10">
    	<tr>
    		<td>
    			<font style="color:#ffffff; font-family:verdana;">
    				Home
    			</font>
    		</td>
    	</tr>
    </table>

    <table width="100%" cellpadding="5" cellspacing="0">
		<?php
		while ($homerow = mysql_fetch_row($homeresult)) { 
			$homemediaid = $homerow[3];
			$hometitle = $homerow[5];
			$homefilename = $homerow[0];
			$homefilenpath = $homerow[4];
		?>
        <tr valign="top">			
			<td  width="40px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $homemediaid;?>
				</font>
			</td>
			<td  width="250px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $hometitle;?>
				</font>
			</td>
            <td>
	            <a href="media.php?id=<?php echo $homemediaid;?>" target="_self" style="text-decoration:none">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		<?php echo $homefilename;?>
	            	</font>
	            </a> 
            </td>
            <td align="center" style="background:#00994c" width="100px">
	            <a href="<?php echo $homefilenpath;?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $homefilenpath;?>);">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		Download
	            	</font>
	            </a>
            </td>
		</tr>
        <?php } ?>
	</table>

	<br><br>

	<?php
    $humorquery = "select * from media where category = 'Humor'";
    $humorresult = mysql_query($humorquery);
    if (!$humorresult) {
		exit("Could not query the media table in the database: <br />". mysql_error());
	} ?>

	<table style="background:#003366; width:100%;" cellpadding="10">
    	<tr>
    		<td>
    			<font style="color:#ffffff; font-family:verdana;">
    				Humor
    			</font>
    		</td>
    	</tr>
    </table>

    <table width="100%" cellpadding="5" cellspacing="0">
		<?php
		while ($humorrow = mysql_fetch_row($humorresult)) { 
			$humormediaid = $humorrow[3];
			$humortitle = $humorrow[5];
			$humorfilename = $humorrow[0];
			$humorfilenpath = $humorrow[4];
		?>
        <tr valign="top">			
			<td  width="40px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $humormediaid;?>
				</font>
			</td>
			<td  width="250px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $humortitle;?>
				</font>
			</td>
            <td>
	            <a href="media.php?id=<?php echo $humormediaid;?>" target="_self" style="text-decoration:none">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		<?php echo $humorfilename;?>
	            	</font>
	            </a> 
            </td>
            <td align="center" style="background:#00994c" width="100px">
	            <a href="<?php echo $humorfilenpath;?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $humorfilenpath;?>);">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		Download
	            	</font>
	            </a>
            </td>
		</tr>
        <?php } ?>
	</table>

	<br><br>

	<?php
    $musicquery = "select * from media where category = 'Music'";
    $musicresult = mysql_query($musicquery);
    if (!$musicresult) {
		exit("Could not query the media table in the database: <br />". mysql_error());
	} ?>

	<table style="background:#003366; width:100%;" cellpadding="10">
    	<tr>
    		<td>
    			<font style="color:#ffffff; font-family:verdana;">
    				Music
    			</font>
    		</td>
    	</tr>
    </table>

    <table width="100%" cellpadding="5" cellspacing="0">
		<?php
		while ($musicrow = mysql_fetch_row($musicresult)) { 
			$musicmediaid = $musicrow[3];
			$musictitle = $musicrow[5];
			$musicfilename = $musicrow[0];
			$musicfilenpath = $musicrow[4];
		?>
        <tr valign="top">			
			<td  width="40px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $musicmediaid;?>
				</font>
			</td>
			<td  width="250px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $musictitle;?>
				</font>
			</td>
            <td>
	            <a href="media.php?id=<?php echo $musicmediaid;?>" target="_self" style="text-decoration:none">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		<?php echo $musicfilename;?>
	            	</font>
	            </a> 
            </td>
            <td align="center" style="background:#00994c" width="100px">
	            <a href="<?php echo $musicfilenpath;?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $musicfilenpath;?>);">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		Download
	            	</font>
	            </a>
            </td>
		</tr>
        <?php } ?>
	</table>

	<br><br>

	<?php
    $newsquery = "select * from media where category = 'News'";
    $newsresult = mysql_query($newsquery);
    if (!$newsresult) {
		exit("Could not query the media table in the database: <br />". mysql_error());
	} ?>

	<table style="background:#003366; width:100%;" cellpadding="10">
    	<tr>
    		<td>
    			<font style="color:#ffffff; font-family:verdana;">
    				News
    			</font>
    		</td>
    	</tr>
    </table>

    <table width="100%" cellpadding="5" cellspacing="0">
		<?php
		while ($newsrow = mysql_fetch_row($newsresult)) { 
			$newsmediaid = $newsrow[3];
			$newstitle = $newsrow[5];
			$newsfilename = $newsrow[0];
			$newsfilenpath = $newsrow[4];
		?>
        <tr valign="top">			
			<td  width="40px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $newsmediaid;?>
				</font>
			</td>
			<td  width="250px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $newstitle;?>
				</font>
			</td>
            <td>
	            <a href="media.php?id=<?php echo $newsmediaid;?>" target="_self" style="text-decoration:none">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		<?php echo $newsfilename;?>
	            	</font>
	            </a> 
            </td>
            <td align="center" style="background:#00994c" width="100px">
	            <a href="<?php echo $newsfilenpath;?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $newsfilenpath;?>);">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		Download
	            	</font>
	            </a>
            </td>
		</tr>
        <?php } ?>
	</table>

	<br><br>

	<?php
    $outdoorsquery = "select * from media where category = 'Outdoors'";
    $outdoorsresult = mysql_query($outdoorsquery);
    if (!$outdoorsresult) {
		exit("Could not query the media table in the database: <br />". mysql_error());
	} ?>

	<table style="background:#003366; width:100%;" cellpadding="10">
    	<tr>
    		<td>
    			<font style="color:#ffffff; font-family:verdana;">
    				Outdoors
    			</font>
    		</td>
    	</tr>
    </table>

    <table width="100%" cellpadding="5" cellspacing="0">
		<?php
		while ($outdoorsrow = mysql_fetch_row($outdoorsresult)) { 
			$outdoorsmediaid = $outdoorsrow[3];
			$outdoorstitle = $outdoorsrow[5];
			$outdoorsfilename = $outdoorsrow[0];
			$outdoorsfilenpath = $outdoorsrow[4];
		?>
        <tr valign="top">			
			<td  width="40px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $outdoorsmediaid;?>
				</font>
			</td>
			<td  width="250px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $outdoorstitle;?>
				</font>
			</td>
            <td>
	            <a href="media.php?id=<?php echo $outdoorsmediaid;?>" target="_self" style="text-decoration:none">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		<?php echo $outdoorsfilename;?>
	            	</font>
	            </a> 
            </td>
            <td align="center" style="background:#00994c" width="100px">
	            <a href="<?php echo $outdoorsfilenpath;?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $outdoorsfilenpath;?>);">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		Download
	            	</font>
	            </a>
            </td>
		</tr>
        <?php } ?>
	</table>

	<br><br>

	<?php
    $photoquery = "select * from media where category = 'Photography'";
    $photoresult = mysql_query($photoquery);
    if (!$photoresult) {
		exit("Could not query the media table in the database: <br />". mysql_error());
	} ?>

	<table style="background:#003366; width:100%;" cellpadding="10">
    	<tr>
    		<td>
    			<font style="color:#ffffff; font-family:verdana;">
    				Photography
    			</font>
    		</td>
    	</tr>
    </table>

    <table width="100%" cellpadding="5" cellspacing="0">
		<?php
		while ($photorow = mysql_fetch_row($photoresult)) { 
			$photomediaid = $photorow[3];
			$phototitle = $photorow[5];
			$photofilename = $photorow[0];
			$photofilenpath = $photorow[4];
		?>
        <tr valign="top">			
			<td  width="40px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $photomediaid;?>
				</font>
			</td>
			<td  width="250px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $phototitle;?>
				</font>
			</td>
            <td>
	            <a href="media.php?id=<?php echo $photomediaid;?>" target="_self" style="text-decoration:none">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		<?php echo $photofilename;?>
	            	</font>
	            </a> 
            </td>
            <td align="center" style="background:#00994c" width="100px">
	            <a href="<?php echo $photofilenpath;?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $photofilenpath;?>);">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		Download
	            	</font>
	            </a>
            </td>
		</tr>
        <?php } ?>
	</table>

	<br><br>

	<?php
    $sciencequery = "select * from media where category = 'Science'";
    $scienceresult = mysql_query($sciencequery);
    if (!$scienceresult) {
		exit("Could not query the media table in the database: <br />". mysql_error());
	} ?>

	<table style="background:#003366; width:100%;" cellpadding="10">
    	<tr>
    		<td>
    			<font style="color:#ffffff; font-family:verdana;">
    				Science
    			</font>
    		</td>
    	</tr>
    </table>

    <table width="100%" cellpadding="5" cellspacing="0">
		<?php
		while ($sciencerow = mysql_fetch_row($scienceresult)) { 
			$sciencemediaid = $sciencerow[3];
			$sciencetitle = $sciencerow[5];
			$sciencefilename = $sciencerow[0];
			$sciencefilenpath = $sciencerow[4];
		?>
        <tr valign="top">			
			<td  width="40px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $sciencemediaid;?>
				</font>
			</td>
			<td  width="250px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $sciencetitle;?>
				</font>
			</td>
            <td>
	            <a href="media.php?id=<?php echo $sciencemediaid;?>" target="_self" style="text-decoration:none">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		<?php echo $sciencefilename;?>
	            	</font>
	            </a> 
            </td>
            <td align="center" style="background:#00994c" width="100px">
	            <a href="<?php echo $sciencefilenpath;?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $sciencefilenpath;?>);">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		Download
	            	</font>
	            </a>
            </td>
		</tr>
        <?php } ?>
	</table>

	<br><br>

	<?php
    $sportsquery = "select * from media where category = 'Sports'";
    $sportsresult = mysql_query($sportsquery);
    if (!$sportsresult) {
		exit("Could not query the media table in the database: <br />". mysql_error());
	} ?>

	<table style="background:#003366; width:100%;" cellpadding="10">
    	<tr>
    		<td>
    			<font style="color:#ffffff; font-family:verdana;">
    				Sports
    			</font>
    		</td>
    	</tr>
    </table>

    <table width="100%" cellpadding="5" cellspacing="0">
		<?php
		while ($sportsrow = mysql_fetch_row($sportsresult)) { 
			$sportsmediaid = $sportsrow[3];
			$sportstitle = $sportsrow[5];
			$sportsfilename = $sportsrow[0];
			$sportsfilenpath = $sportsrow[4];
		?>
        <tr valign="top">			
			<td  width="40px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $sportsmediaid;?>
				</font>
			</td>
			<td  width="250px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $sportstitle;?>
				</font>
			</td>
            <td>
	            <a href="media.php?id=<?php echo $sportsmediaid;?>" target="_self" style="text-decoration:none">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		<?php echo $sportsfilename;?>
	            	</font>
	            </a> 
            </td>
            <td align="center" style="background:#00994c" width="100px">
	            <a href="<?php echo $sportsfilenpath;?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $sportsfilenpath;?>);">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		Download
	            	</font>
	            </a>
            </td>
		</tr>
        <?php } ?>
	</table>

	<br><br>

	<?php
    $travelquery = "select * from media where category = 'Travel'";
    $travelresult = mysql_query($travelquery);
    if (!$travelresult) {
		exit("Could not query the media table in the database: <br />". mysql_error());
	} ?>

	<table style="background:#003366; width:100%;" cellpadding="10">
    	<tr>
    		<td>
    			<font style="color:#ffffff; font-family:verdana;">
    				Travel
    			</font>
    		</td>
    	</tr>
    </table>

    <table width="100%" cellpadding="5" cellspacing="0">
		<?php
		while ($travelrow = mysql_fetch_row($travelresult)) { 
			$travelmediaid = $travelrow[3];
			$traveltitle = $travelrow[5];
			$travelfilename = $travelrow[0];
			$travelfilenpath = $travelrow[4];
		?>
        <tr valign="top">			
			<td  width="40px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $travelmediaid;?>
				</font>
			</td>
			<td  width="250px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $traveltitle;?>
				</font>
			</td>
            <td>
	            <a href="media.php?id=<?php echo $travelmediaid;?>" target="_self" style="text-decoration:none">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		<?php echo $travelfilename;?>
	            	</font>
	            </a> 
            </td>
            <td align="center" style="background:#00994c" width="100px">
	            <a href="<?php echo $travelfilenpath;?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $travelfilenpath;?>);">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		Download
	            	</font>
	            </a>
            </td>
		</tr>
        <?php } ?>
	</table>

	<br><br>

	<?php
    $weatherquery = "select * from media where category = 'Weather'";
    $weatherresult = mysql_query($weatherquery);
    if (!$weatherresult) {
		exit("Could not query the media table in the database: <br />". mysql_error());
	} ?>

	<table style="background:#003366; width:100%;" cellpadding="10">
    	<tr>
    		<td>
    			<font style="color:#ffffff; font-family:verdana;">
    				Weather
    			</font>
    		</td>
    	</tr>
    </table>

    <table width="100%" cellpadding="5" cellspacing="0">
		<?php
		while ($weatherrow = mysql_fetch_row($weatherresult)) { 
			$weathermediaid = $weatherrow[3];
			$weathertitle = $weatherrow[5];
			$weatherfilename = $weatherrow[0];
			$weatherfilenpath = $weatherrow[4];
		?>
        <tr valign="top">			
			<td  width="40px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $weathermediaid;?>
				</font>
			</td>
			<td  width="250px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $weathertitle;?>
				</font>
			</td>
            <td>
	            <a href="media.php?id=<?php echo $weathermediaid;?>" target="_self" style="text-decoration:none">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		<?php echo $weatherfilename;?>
	            	</font>
	            </a> 
            </td>
            <td align="center" style="background:#00994c" width="100px">
	            <a href="<?php echo $weatherfilenpath;?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $weatherfilenpath;?>);">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		Download
	            	</font>
	            </a>
            </td>
		</tr>
        <?php } ?>
	</table>

		<br><br>

	<?php
    $otherquery = "select * from media where category = 'Other'";
    $otherresult = mysql_query($otherquery);
    if (!$otherresult) {
		exit("Could not query the media table in the database: <br />". mysql_error());
	} ?>

	<table style="background:#003366; width:100%;" cellpadding="10">
    	<tr>
    		<td>
    			<font style="color:#ffffff; font-family:verdana;">
    				Other
    			</font>
    		</td>
    	</tr>
    </table>

    <table width="100%" cellpadding="5" cellspacing="0">
		<?php
		while ($otherrow = mysql_fetch_row($otherresult)) { 
			$othermediaid = $otherrow[3];
			$othertitle = $otherrow[5];
			$otherfilename = $otherrow[0];
			$otherfilenpath = $otherrow[4];
		?>
        <tr valign="top">			
			<td  width="40px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $othermediaid;?>
				</font>
			</td>
			<td  width="250px">
				<font style="color:#ffffff; font-family:verdana;">
					<?php echo $othertitle;?>
				</font>
			</td>
            <td>
	            <a href="media.php?id=<?php echo $othermediaid;?>" target="_self" style="text-decoration:none">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		<?php echo $otherfilename;?>
	            	</font>
	            </a> 
            </td>
            <td align="center" style="background:#00994c" width="100px">
	            <a href="<?php echo $otherfilenpath;?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $otherrfilenpath;?>);">
	            	<font style="color:#ffffff; font-family:verdana;">
	            		Download
	            	</font>
	            </a>
            </td>
		</tr>
        <?php } ?>
	</table>
</body>
</html>