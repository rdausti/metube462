<?php 
session_start();
include_once "function.php";

$username = $_SESSION['username'];
$mediaid = $_POST['mediaid'];

$unfavoritequery = "delete from favorite where username = '$username' and mediaid = '$mediaid'";
$unfavoriteresult = mysql_query($unfavoritequery)
	or exit("Delete from favorite unsuccessful in unfavorite.php: " . mysql_error());

if(isset($_POST['unfavoriteMedia'])) {
	?>
	<meta http-equiv="refresh" content="0; url=favorites.php">
	<?php
}
else {
	?>
	<meta http-equiv="refresh" content="0; url=media.php?id=<?php echo $mediaid; ?>">
<?php } ?>