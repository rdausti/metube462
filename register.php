<html>
<body>

<?php
session_start();

include_once "function.php";


if(isset($_POST['submit'])) {
	if( $_POST['password1'] != $_POST['password2']) {
		$register_error = "Passwords don't match. Try again?";
	}
	else {
		$check = user_exist_check($_POST['username'], $_POST['password1']);	
		if($check == 1){
			//echo "Rigister succeeds";
			$_SESSION['username']=$_POST['username'];
			header('Location: browse.php');
		}
		else if($check == 2){
			$register_error = "Username already exists. Please user a different username.";
		}
	}
}

?>
<form action="register.php" method="post">
	Username: <input type="text" name="username"> <br>
	Create Password: <input  type="password" name="password1"> <br>
	Repeat password: <input type="password" name="password2"> <br>
        Input First Name: <input type="firstName" name="firstName"> <br>
        Input Last Name: <input type="lastName" name="lastName"> <br>
	<input name="submit" type="submit" value="Submit">
</form>

<?php
  if(isset($register_error))
   {  echo "<div id='passwd_result'> register_error:".$register_error."</div>";}
?>

</body>
</html>
