<!DOCTYPE html>
<html lang="en">

<head>
<title>
  Register
</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body bgcolor="#00cc66">
<?php require 'header.php'; ?>

<?php
session_start();

include_once "function.php";


if(isset($_POST['submit'])) {
	if( $_POST['password1'] != $_POST['password2']) {
		$register_error = "Passwords don't match. Try again?";
	}
	else {
		$check = user_exist_check($_POST['username'], $_POST['password1'], $_POST['firstname'], $_POST['lastname'], $_POST['gender'], $_POST['email']);	
		if($check == 1){
			$_SESSION['username']=$_POST['username'];
			header('Location: browse.php');
		}
		else if($check == 2){
			$register_error = "Username already exists. Please use a different username.";
		}
	}
}

?>
<br><br>
<table style="background:#003366; width:100%;" cellpadding="10">
  <tr>
    <td align="center">
      <font style="color:#ffffff; font-family:verdana;">
        Register
      </font>
    </td>
  </tr>
</table>
<br><br>
<form action="register.php" method="post">
  <table>
    <tr>
      <td valign="top">
        <label for="inputUser">
          <font style="color:#ffffff; font-family:verdana;">
            Username:
          </font>
        </label>
      </td>
      <td>
        <input type="text" style="width:200px" name="username"> 
        <br><br>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <label for="inputPass">
          <font style="color:#ffffff; font-family:verdana;">
            Create Password:
          </font>
        </label>
      </td>
      <td>
        <input type="password" style="width:200px" name="password1"> 
        <br><br>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <label for="inputRepeatPass">
          <font style="color:#ffffff; font-family:verdana;">
            Repeat password:
          </font>
        </label>
      </td>
      <td>
        <input type="password" style="width:200px" name="password2"> 
        <br><br>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <label for="inputFirst">
          <font style="color:#ffffff; font-family:verdana;">
            First Name:
          </font>
        </label>
      </td>
      <td>
        <input type="text" style="width:200px" name="firstname">
        <br><br>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <label for="inputLast">
          <font style="color:#ffffff; font-family:verdana;">
            Last Name:
          </font>
        </label>
      </td>
      <td>
        <input type="text" style="width:200px" name="lastname"> 
        <br><br>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <label for="gender">
          <font style="color:#ffffff; font-family:verdana;">
            Gender:
          </font>
        </label>
      </td>
      <td>
        <input type="radio" value="male" name="gender">
          <font style="color:#ffffff; font-family:verdana;">
            Male
          </font>
        <input type="radio" value="female" name="gender">
          <font style="color:#ffffff; font-family:verdana;">
            Female
          </font>
        <br><br>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <label for="email">
          <font style="color:#ffffff; font-family:verdana;">
            Email:
          </font>
        </label>
      </td>
      <td>
        <input type="text" style="width:200px" name="email"> 
        <br><br>
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
  if(isset($register_error)) {   ?>
    <font style="color:#ffffff; font-family:verdana;">
      <?php echo "<div id='passwd_result'> register_error:".$register_error."</div>"; ?>
    </font>
  <?php 
  }
  ?>

</body>
</html>
