<?php 
session_start();
include_once "function.php";

$username = $_SESSION['username'];
$mediaid = $_POST['mediaid'];

$add_fav = "insert into favorite(favoriteid, mediaid, username) values(NULL, '$mediaid', '$username')";
$add_favquery = mysql_query($add_fav)
	or exit("Insert into favorite unsuccessful in favorite_process.php" . mysql_error());
?>

<meta http-equiv="refresh" content="0; url=media.php?id=<?php echo $mediaid;?>">