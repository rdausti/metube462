<?php

include_once "function.php";

session_start();

$mediaid = $_POST['mediaid'];

if(isset($_POST['submit'])) {
	$update = update_media_info($mediaid,mysql_real_escape_string($_POST['title']),mysql_real_escape_string($_POST['tags']),mysql_real_escape_string($_POST['description']),mysql_real_escape_string($_POST['category']));
	if($update == 1) { ?>
	    <form action="profile.php" method="post" id="updateMedia">
	    	<input type="hidden" name="mediaid" value="<?php echo $mediaid; ?>" />
	    </form>
	    <?php
	  }
}

$mediaquery = "select * from media where mediaid = '$mediaid'";
$mediaresult = mysql_query($mediaquery);
$rowresult = mysql_fetch_row($mediaresult);

$filename = $rowresult[0];
$username = $rowresult[1];
$type = $rowresult[2];
$path = $rowresult[4];
$title = $rowresult[5];
$tags = $rowresult[6];
$description = $rowresult[7];
$category = $rowresult[8];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>
		Update Media
	</title>
<!-- this is the navigation bar at the top of the screen -->
<?php require 'header.php' ?>

</head>

<body bgcolor="#00cc66">
	<form method="post" id="usernameForm<?php echo $username; ?>" action="profile.php">
    	<input type="hidden" name="username" value="<?php echo $username; ?>" />
    </form>

    <br><br>

    <table style="background:#003366; width:100%;" cellpadding="10">
    	<tr>
      		<td>
        		<font style="color:#ffffff; font-family:verdana;">
          			Update Media
        		</font>
      		</td>
    	</tr>
  	</table>

  	<br>

  	<div>
	  	<form method="post" action="update_media.php" name="mediaid" value="<?php echo $mediaid; ?>" enctype="multipart/form-data">
      		<table width="100%">
      			<tr>
      				<td>
      					<font style="color:#ffffff; font-family:verdana;">
      						Filename:
      					</font>
      				</td>
      				<td>
      					<font style="color:#ffffff; font-family:verdana;">
      						<?php echo $filename; ?>
      					</font>
      				</td>
      			</tr>
      			<tr>
      				<td>
      					<font style="color:#ffffff; font-family:verdana;">
      						Username:
      					</font>
      				</td>
      				<td>
      					<font style="color:#ffffff; font-family:verdana;">
      						<?php echo $username; ?>
      					</font>
      				</td>
      			</tr>
      			<tr>
      				<td>
      					<font style="color:#ffffff; font-family:verdana;">
      						Type of Media:
      					</font>
      				</td>
      				<td>
      					<font style="color:#ffffff; font-family:verdana;">
      						<?php echo $type; ?>
      					</font>
      				</td>
      			</tr>
      			<tr>
      				<td>
      					<font style="color:#ffffff; font-family:verdana;">
      						Media ID:
      					</font>
      				</td>
      				<td>
      					<font style="color:#ffffff; font-family:verdana;">
      						<?php echo $mediaid; ?>
      					</font>
      				</td>
      			</tr>
      			<tr>
      				<td>
      					<font style="color:#ffffff; font-family:verdana;">
      						File Path:
      					</font>
      				</td>
      				<td>
      					<font style="color:#ffffff; font-family:verdana;">
      						<?php echo $path; ?>
      					</font>
      				</td>
      			</tr>
      			<tr>
      				<td>
      					<font style="color:#ffffff; font-family:verdana;">
      						Title:
      					</font>
      				</td>
      				<td>
      					<input id="inputTitle" type="text" style="width:200px" name="title" value="<?php echo $title; ?>">
      				</td>
      			</tr>
      			<tr>
      				<td>
      					<font style="color:#ffffff; font-family:verdana;">
      						Tags:
      					</font>
      				</td>
      				<td>
      					<input id="inputTags" type="text" style="width:200px" name="tags" value="<?php echo $tags; ?>">
      				</td>
      			</tr>
      			<tr>
      				<td>
      					<font style="color:#ffffff; font-family:verdana;">
      						Description:
      					</font>
      				</td>
      				<td>
      					<input id="inputDescription" type="text" style="width:200px" name="description" value="<?php echo $description; ?>">
      				</td>
      			</tr>
      			<tr>
      				<td>
      					<font style="color:#ffffff; font-family:verdana;">
      						Category:
      					</font>
      				</td>
      				<td>
      					<select style="width:200px" name="category" value="<?php echo $category ?>">
      						<?php if($category == "Animals") {
      							?>
      							<option selected>Animals</option>
					        	<option>Cars</option>
					        	<option>Children</option>
					        	<option>History</option>
					        	<option>Home</option>
					        	<option>Humor</option>
					        	<option>Music</option>
					        	<option>News</option>
					        	<option>Outdoors</option>
					        	<option>Photography</option>
					        	<option>Science</option>
					        	<option>Sports</option>
					        	<option>Travel</option>
					        	<option>Weather</option>
					        	<option>Other</option>
      						<?php }
				        	else if($category == "Cars") {
      							?>
      							<option>Animals</option>
					        	<option selected>Cars</option>
					        	<option>Children</option>
					        	<option>History</option>
					        	<option>Home</option>
					        	<option>Humor</option>
					        	<option>Music</option>
					        	<option>News</option>
					        	<option>Outdoors</option>
					        	<option>Photography</option>
					        	<option>Science</option>
					        	<option>Sports</option>
					        	<option>Travel</option>
					        	<option>Weather</option>
					        	<option>Other</option>
					        <?php }
					        else if($category == "Children") {
      							?>
      							<option>Animals</option>
					        	<option>Cars</option>
					        	<option selected>Children</option>
					        	<option>History</option>
					        	<option>Home</option>
					        	<option>Humor</option>
					        	<option>Music</option>
					        	<option>News</option>
					        	<option>Outdoors</option>
					        	<option>Photography</option>
					        	<option>Science</option>
					        	<option>Sports</option>
					        	<option>Travel</option>
					        	<option>Weather</option>
					        	<option>Other</option>
					        <?php }
					        else if($category == "History") {
      							?>
      							<option>Animals</option>
					        	<option>Cars</option>
					        	<option>Children</option>
					        	<option selected>History</option>
					        	<option>Home</option>
					        	<option>Humor</option>
					        	<option>Music</option>
					        	<option>News</option>
					        	<option>Outdoors</option>
					        	<option>Photography</option>
					        	<option>Science</option>
					        	<option>Sports</option>
					        	<option>Travel</option>
					        	<option>Weather</option>
					        	<option>Other</option>
					        <?php }
					        else if($category == "Home") {
      							?>
      							<option>Animals</option>
					        	<option>Cars</option>
					        	<option>Children</option>
					        	<option>History</option>
					        	<option selected>Home</option>
					        	<option>Humor</option>
					        	<option>Music</option>
					        	<option>News</option>
					        	<option>Outdoors</option>
					        	<option>Photography</option>
					        	<option>Science</option>
					        	<option>Sports</option>
					        	<option>Travel</option>
					        	<option>Weather</option>
					        	<option>Other</option>
					        <?php }
					        else if($category == "Humor") {
      							?>
      							<option>Animals</option>
					        	<option>Cars</option>
					        	<option>Children</option>
					        	<option>History</option>
					        	<option>Home</option>
					        	<option selected>Humor</option>
					        	<option>Music</option>
					        	<option>News</option>
					        	<option>Outdoors</option>
					        	<option>Photography</option>
					        	<option>Science</option>
					        	<option>Sports</option>
					        	<option>Travel</option>
					        	<option>Weather</option>
					        	<option>Other</option>
					        <?php }
					        else if($category == "Music") {
      							?>
      							<option>Animals</option>
					        	<option>Cars</option>
					        	<option>Children</option>
					        	<option>History</option>
					        	<option>Home</option>
					        	<option>Humor</option>
					        	<option selected>Music</option>
					        	<option>News</option>
					        	<option>Outdoors</option>
					        	<option>Photography</option>
					        	<option>Science</option>
					        	<option>Sports</option>
					        	<option>Travel</option>
					        	<option>Weather</option>
					        	<option>Other</option>
					        <?php }
					        else if($category == "News") {
      							?>
      							<option>Animals</option>
					        	<option>Cars</option>
					        	<option>Children</option>
					        	<option>History</option>
					        	<option>Home</option>
					        	<option>Humor</option>
					        	<option>Music</option>
					        	<option selected>News</option>
					        	<option>Outdoors</option>
					        	<option>Photography</option>
					        	<option>Science</option>
					        	<option>Sports</option>
					        	<option>Travel</option>
					        	<option>Weather</option>
					        	<option>Other</option>
					        <?php }
					        else if($category == "Outdoors") {
      							?>
      							<option>Animals</option>
					        	<option>Cars</option>
					        	<option>Children</option>
					        	<option>History</option>
					        	<option>Home</option>
					        	<option>Humor</option>
					        	<option>Music</option>
					        	<option>News</option>
					        	<option selected>Outdoors</option>
					        	<option>Photography</option>
					        	<option>Science</option>
					        	<option>Sports</option>
					        	<option>Travel</option>
					        	<option>Weather</option>
					        	<option>Other</option>
					        <?php }
					        else if($category == "Photography") {
      							?>
      							<option>Animals</option>
					        	<option>Cars</option>
					        	<option>Children</option>
					        	<option>History</option>
					        	<option>Home</option>
					        	<option>Humor</option>
					        	<option>Music</option>
					        	<option>News</option>
					        	<option>Outdoors</option>
					        	<option selected>Photography</option>
					        	<option>Science</option>
					        	<option>Sports</option>
					        	<option>Travel</option>
					        	<option>Weather</option>
					        	<option>Other</option>
					        <?php }
					        else if($category == "Science") {
      							?>
      							<option>Animals</option>
					        	<option>Cars</option>
					        	<option>Children</option>
					        	<option>History</option>
					        	<option>Home</option>
					        	<option>Humor</option>
					        	<option>Music</option>
					        	<option>News</option>
					        	<option>Outdoors</option>
					        	<option>Photography</option>
					        	<option selected>Science</option>
					        	<option>Sports</option>
					        	<option>Travel</option>
					        	<option>Weather</option>
					        	<option>Other</option>
					        <?php }
					        else if($category == "Sports") {
      							?>
      							<option>Animals</option>
					        	<option>Cars</option>
					        	<option>Children</option>
					        	<option>History</option>
					        	<option>Home</option>
					        	<option>Humor</option>
					        	<option>Music</option>
					        	<option>News</option>
					        	<option>Outdoors</option>
					        	<option>Photography</option>
					        	<option>Science</option>
					        	<option selected>Sports</option>
					        	<option>Travel</option>
					        	<option>Weather</option>
					        	<option>Other</option>
					        <?php }
					        else if($category == "Travel") {
      							?>
      							<option>Animals</option>
					        	<option>Cars</option>
					        	<option>Children</option>
					        	<option>History</option>
					        	<option>Home</option>
					        	<option>Humor</option>
					        	<option>Music</option>
					        	<option>News</option>
					        	<option>Outdoors</option>
					        	<option>Photography</option>
					        	<option>Science</option>
					        	<option>Sports</option>
					        	<option selected>Travel</option>
					        	<option>Weather</option>
					        	<option>Other</option>
					        <?php }
					        else if($category == "Weather") {
      							?>
      							<option>Animals</option>
					        	<option>Cars</option>
					        	<option>Children</option>
					        	<option>History</option>
					        	<option>Home</option>
					        	<option>Humor</option>
					        	<option>Music</option>
					        	<option>News</option>
					        	<option>Outdoors</option>
					        	<option>Photography</option>
					        	<option>Science</option>
					        	<option>Sports</option>
					        	<option>Travel</option>
					        	<option selected>Weather</option>
					        	<option>Other</option>
					        <?php }
					        else { ?>
					        	<option>Animals</option>
					        	<option>Cars</option>
					        	<option>Children</option>
					        	<option>History</option>
					        	<option>Home</option>
					        	<option>Humor</option>
					        	<option>Music</option>
					        	<option>News</option>
					        	<option>Outdoors</option>
					        	<option>Photography</option>
					        	<option>Science</option>
					        	<option>Sports</option>
					        	<option>Travel</option>
					        	<option>Weather</option>
					        	<option selected >Other</option>
					        <?php } ?>
				        </select>
      				</td>
      			</tr>
      			<tr>
    				<td>
    					<form method="post" id="updateMediaForm<?php echo $mediaid; ?>" action="update_media.php">
            				<input type="hidden" name="mediaid" value="<?php echo $mediaid; ?>" />
          				</form>
      					<input name="submit" type="submit" value="Update">
    				</td>
				</tr>
      		</table>
	    </form>
	</div>


