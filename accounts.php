<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

  session_start();
  include_once "function.php";

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>
  All Users
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-latest.pack.js"></script>

<!-- bar on top of screen -->
<?php require 'header.php'; ?>
</head>

<body bgcolor="#00cc66">

  <?php
  //gets all the usernames in the account table
  $usernamequery = "select * from account";
  $usernameresult = mysql_query($usernamequery);

  //if account table is not able to be reached
  if(!$usernameresult) {
    exit("Could not query account table in database: <br />". mysql_error());
  } ?>

  <br><br>
  <table style="background:#003366; width:100%; text-align:center" cellpadding="10">
    <tr>
      <td>
        <font style="color:#ffffff; font-family:verdana;">
          Users - Click username to view profile
        <font>
      </td>
    </tr>
  </table>
  <table style="table-layout:auto; width:100%; margin:auto; text-align:center;">
    <tr>
      <th>
        <font style="color:#ffffff; font-family:verdana;">
          Username
        </font>
      </th>
      <th>
        <font style="color:#ffffff; font-family:verdana;">
          First Name
        </font>
      </th>
      <th>
        <font style="color:#ffffff; font-family:verdana;">
          Last Name
        </font>
      </th>
    </tr>
    <?php

    $count = 0;
    //looping through account table row by row to get usernames
    while($rowresult = mysql_fetch_row($usernameresult)) {
      // getting the username from the table
      $u_name=$rowresult[0];
      $u_first=$rowresult[2];
      $u_last=$rowresult[3];
      ?>
      <tr>
        <?php 
        // incrementing count to get the next row
        $count = $count + 1; ?>
      
        <form method="post" id="usernameForm<?php echo $u_name; ?>" action="profile.php">
          <input type="hidden" name="username" value="<?php echo $u_name; ?>" />
        </form>

        <td align="center" style="background:#00994c">
          <!-- make a clickable link to profile-->
          <a style="cursor:pointer; cursor:hand;" onclick="javascript:document.getElementById('usernameForm<?php echo $u_name; ?>').submit(); ">
            <font style="color:#ffffff; font-family:verdana;">
              <?php echo $u_name; ?>
            </font>
          </a>
        </td>
        <td>
          <font style="color:#ffffff; font-family:verdana;">
            <?php echo $u_first ?>
          </font>
        </td>
        <td>
          <font style="color:#ffffff; font-family:verdana;">
            <?php echo $u_last ?>
          </font>
        </td>
      </tr>
      <?php
    } ?>

    <br>
  </table>
</body>
</html>
