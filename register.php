<!DOCTYPE html>
<html lang="en">

<head>
<title>Register</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<link rel="stylesheet" type="text/css" href="css/default.css" />

<body>

<?php
session_start();

include_once "function.php";


if(isset($_POST['submit'])) {
	if( $_POST['password1'] != $_POST['password2']) {
		$register_error = "Passwords don't match. Try again?";
	}
	else {
		$check = user_exist_check(ucfirst($_POST['username']), $_POST['password1'], $_POST['firstname'], $_POST['lastname'], $_POST['gender'], $_POST['email']);	
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
  <table>
    <tr>
      <td valign="top">
        <label for="inputUser">Username:</label>
      </td>
      <td>
        <input type="text" style="width:200px" name="username"> <br><br>
      </td>
    </tr>
    <tr>
      <td valign="top">
	<label for="inputPass">Create Password:</label>
      </td>
      <td>
        <input type="password" style="width:200px" name="password1"> <br><br>
      </td>
    </tr>
    <tr>
      <td valign="top">
	<label for="inputRepeatPass">Repeat password:</label>
      </td>
      <td>
        <input type="password" style="width:200px" name="password2"> <br><br>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <label for="inputFirst">First Name:</label>
      </td>
      <td>
        <input type="text" style="width:200px" name="firstname"> <br><br>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <label for="inputLast">Last Name:</label>
      </td>
      <td>
        <input type="text" style="width:200px" name="lastname"> <br><br>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <label for="gender">Gender:</label>
      </td>
      <td>
        <input type="radio" value="male" name="gender">Male
        <input type="radio" value="female" name="gender">Female <br><br>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <label for="email">Email:</label>
      </td>
      <td>
        <input type="text" style="width:200px" name="email"> <br><br>
      </td>
    </tr>
    <tr>
      <td>
	<input name="submit" type="submit" value="Submit">
      </td>
    </tr>
  </table>
</form>

<?php
  if(isset($register_error))
   {  echo "<div id='passwd_result'> register_error:".$register_error."</div>";}
?>

</body>
</html>
