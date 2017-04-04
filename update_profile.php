<?php

include_once "function.php";

session_start();

  $username=$_SESSION['username'];

  if(isset($_POST['submit'])) {
    if($_POST['password1'] != $_POST['password2']) {
      $password_error = "Passwords do not match. Please re-enter.";
    }
    else {
      $update=update_profile_info($username,$_POST['password1'],mysql_real_escape_string($_POST['firstname']),mysql_real_escape_string($_POST['lastname']),mysql_real_escape_string($_POST['gender']),mysql_real_escape_string($_POST['email']));
      if($update==1) { ?>
        <form action="profile.php" method="post" id="updateProfile">
          <input type="hidden" name="username" value="<?php echo $username; ?>" />
        </form>

        <script type="text/javascript">
          document.getElementByID("updateProfile").submit();
        </script>
        <?php
      }
    }
  }

  $accountquery = "select *from account where username='$username'";
  $accountresult=mysql_query($accountquery);
  $rowresult=mysql_fetch_row($accountresult);

  $password=$rowresult[1];
  $firstname=$rowresult[2];
  $lastname=$rowresult[3];
  $gender=$rowresult[4];
  $email=$rowresult[5];
  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/default.css" />
<title>Update Profile</title>

<!-- this is the navigation bar at the top of the screen -->
<?php require 'header.php' ?>

</head>

<body>
  <div>
  <form method="post" action="update_profile.php" enctype="multipart/form-data">
    <fieldset>
      <legend>Update Profile</legend>
      <table width="100%">
      <tr>
        <td width="20%">
          <label for="inputUser">Username:</label>
        </td>
        <td>
          <input id="inputUser" type="text" name="username" value="<?php echo $username; ?>" disabled=""><br><br>
        </td>
      </tr>
      <tr>
        <td>
          <label for="inputPass1">Password:</label>
        </td>
        <td>
          <input id="inputPass1" type="password" name="password1" value="<?php echo $password; ?>"><br><br>
        </td>
      </tr>

      <tr>
        <td>
          <label for="inputPass2">Re-enter Password:</label>
        </td>
        <td>
          <input id="inputPass2" type="password" name="password2" value="<?php echo $password; ?>"><br><br>
        </td>
      </tr>

      <tr>
        <td>
          <label for="inputFirstName">First Name:</label>
        </td>
        <td>
          <input id="inputFirstName" type="text" name="firstname" value="<?php echo $firstname; ?>"><br><br>
        </td>
      </tr>

      <tr>
        <td>
          <label for="inputLastName">Last Name:</label>
        </td>
        <td>
          <input id="inputLastName" type="text" name="lastname" value="<?php echo $lastname; ?>"><br><br>
        </td>
      </tr>

      <tr>
        <td>
          <label for="inputGender">Gender:</label>
        </td>
        <td>
          <?php if( $gender  == "male") { ?>
            <input id="inputGender" type="radio" value="male" name="gender" value="<?php echo $gender ?>" checked="checked">Male
            <input id="inputGender" type="radio" value="female" name="gender" value="<?php echo $gender ?>">Female
          <?php }
          else { ?>
            <input id="inputGender" type="radio" value="male" name="gender" value="<?php echo $gender ?>">Male
            <input id="inputGender" type="radio" value="female" name="gender" value="<?php echo $gender ?>" checked="checked">Female
          <?php } ?><br><br>
        </td>
      </tr>

      <tr>
        <td>
          <label for="inputEmail">Email:</label>
        </td>
        <td>
          <input id="inputEmail" type="text" name="email" value="<?php echo $email; ?>"><br><br>
        </td>
      </tr>

      <tr>
        <td>
          <input name="submit" type="submit" class="btn btn-primary" value="Update">
        </td>
      </tr>
      </table>
    </fieldset>
  </form>

  <?php
  if(isset($password_error)) {
    echo "<div class='text-danger' id='password_result'><strong> Profile Update Error: ".$password_error."</strong></div>";
  } ?>
  </div>
</body>
</html>
