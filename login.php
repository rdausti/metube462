<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<link rel="stylesheet" type="text/css" href="css/default.css" />
<?php
session_start();

include_once "function.php";

if(isset($_POST['submit'])) {
	if($_POST['username'] == "" || $_POST['password'] == "") {
		$login_error = "One or more fields are missing.";
	}
	else {
		$check = user_pass_check($_POST['username'],$_POST['password']); // Call functions from function.php
		if($check == 1) {
			$login_error = "User ".$_POST['username']." not found.";
		}
		elseif($check==2) {
			$login_error = "Incorrect password.";
		}
		else if($check==0){
			$_SESSION['username']=$_POST['username']; //Set the $_SESSION['username']
			header('Location: browse.php');
		}		
	}
}

?>

<body bgcolor=#00cc66>

<!-- this is the bar at the top -->
<?php require 'header.php'; ?>

<br>
	<form method="post" action="<?php echo "login.php"; ?>">
		<table width="100%">
			<tr>
				<td width="10%">
					<font style="color:#ffffff; font-family:verdana;">
						Username:
					</font>
				</td>
				<td width="90%">
					<input class="text" style="width:200px" type="text" name="username">
					<br>
				</td>
			</tr>
			<tr>
				<td width="10%">
					<font style="color:#ffffff; font-family:verdana;">
						Password:
					</font>
				</td>
				<td width="90%">
					<input class="text" style="width:200px"  type="password" name="password">
					<br>
				</td>
			</tr>
			<tr>
				<td>
					<input name="submit" style="width:200px" type="submit" value="Login">
					<br>
				</td>
			</tr>
		    <tr>
		    	<td>
		    		<input name="reset" style="width:200px" type="reset" value="Reset">
		    	</td>
		    </tr>
		</table>
	</form>

<?php
if(isset($login_error))
{  echo "<div id='passwd_result'>".$login_error."</div>";}
?>

</body>
</html>
