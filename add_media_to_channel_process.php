<?php
session_start();
include_once "function.php";

$username = $_SESSION['username'];
$channelid = $_POST['channelid'];

if(isset($_POST['addToChannel'])) {
	if(isset($_POST['mediaid'])) {
		$mediaid = $_POST['mediaid'];

		$insertmedia = "insert into channelMedia(cmid, channelid, mediaid) values(NULL, '$channelid', '$mediaid');";
		$insertquery = mysql_query($insertmedia);
		if(!$insertquery) {
			exit("could not insert into channelMedia: " .mysql_error());
		}
	} 
}


?>

<meta http-equiv="refresh" content="0;url=all_channels.php?id=<?php echo $username;?>">