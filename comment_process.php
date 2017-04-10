<?php 
session_start();
include_once "function.php";

$username = $_SESSION['username'];
$mediaid = $_POST["mediaid"];
$content = mysql_real_escape_string($_POST['usercomment']);

$insert = "insert into comment(commentid, mediaid, username, content) values (NULL, '$mediaid', '$username', '$content')";
$insertquery = mysql_query($insert) or exit("Cannot insert into comment table, error in comment_process.php " .mysql_error());

?>

<meta http-equiv="refresh" content="0;url=media.php?id=<?php echo $mediaid; ?>">