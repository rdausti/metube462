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

  $accountquery = "select * from account where username='$username'";
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
<title>
  Update Profile
</title>

<!-- this is the navigation bar at the top of the screen -->
<?php require 'header.php' ?>

</head>

<body bgcolor="#00cc66">

    <form method="post" id="usernameForm<?php echo $username; ?>" action="profile.php">
      <input type="hidden" name="username" value="<?php echo $username; ?>" />
    </form>

  <br><br>
  <div>
  <form method="post" action="update_profile.php" enctype="multipart/form-data">
    <fieldset>
      <legend>
        <font style="color:#ffffff; font-family:verdana;">
          Update Profile
        </font>
      </legend>
      <table width="100%">
      <tr>
        <td valign="top" width="20%">
          <label for="inputUser">
            <font style="color:#ffffff; font-family:verdana;">
              Username:
            </font>
          </label>
        </td>
        <td>
          <input id="inputUser" type="text" style="width:200px" name="username" value="<?php echo $username; ?>" disabled="">
          <br><br>
        </td>
      </tr>
      <tr>
        <td valign="top">
          <label for="inputPass1">
            <font style="color:#ffffff; font-family:verdana;">
              Password:
            </font>
          </label>
        </td>
        <td>
          <input id="inputPass1" type="password" style="width:200px" name="password1" value="<?php echo $password; ?>">
          <br><br>
        </td>
      </tr>

      <tr>
        <td valign="top">
          <label for="inputPass2">
            <font style="color:#ffffff;font-family:verdana;">
              Re-enter Password:
            </font>
          </label>
        </td>
        <td>
          <input id="inputPass2" type="password" style="width:200px" name="password2" value="<?php echo $password; ?>">
          <br><br>
        </td>
      </tr>

      <tr>
        <td valign="top">
          <label for="inputFirstName">
            <font style="color:#ffffff; font-family:verdana;">
              First Name:
            </font>
          </label>
        </td>
        <td>
          <input id="inputFirstName" type="text" style="width:200px" name="firstname" value="<?php echo $firstname; ?>">
          <br><br>
        </td>
      </tr>

      <tr>
        <td valign="top">
          <label for="inputLastName">
            <font style="color:#ffffff; font-family:verdana;">
              Last Name:
            </font>
          </label>
        </td>
        <td>
          <input id="inputLastName" type="text" style="width:200px" name="lastname" value="<?php echo $lastname; ?>">
          <br><br>
        </td>
      </tr>

      <tr>
        <td valign="top">
          <label for="inputGender">
            <font style="color:#ffffff; font-family:verdana;">
              Gender:
            </font>
          </label>
        </td>
        <td>
          <?php if( $gender  == "male") { ?>
            <input id="inputGender" type="radio" value="male" name="gender" value="<?php echo $gender ?>" checked="checked">
            <font style="color:#ffffff; font-family:verdana;">
              Male
            </font>
            <input id="inputGender" type="radio" value="female" name="gender" value="<?php echo $gender ?>">
            <font style="color:#ffffff; font-family:verdana;">
              Female
            </font>
          <?php }
          else { ?>
            <input id="inputGender" type="radio" value="male" name="gender" value="<?php echo $gender ?>">
            <font style="color:#ffffff; font-family:verdana;">
              Male
            </font>
            <input id="inputGender" type="radio" value="female" name="gender" value="<?php echo $gender ?>" checked="checked">
            <font style="color:#ffffff; font-family:verdana;">
              Female
            </font>
          <?php } ?>
          <br><br>
        </td>
      </tr>

      <tr>
        <td valign="top">
          <label for="inputEmail">
            <font style="color:#ffffff; font-family:verdana;">
              Email:
            </font>
          </label>
        </td>
        <td>
          <input id="inputEmail" type="text" style="width:200px" name="email" value="<?php echo $email; ?>">
          <br><br>
        </td>
      </tr>

      <tr>
        <td>
          <input name="submit" type="submit" value="Update">
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
