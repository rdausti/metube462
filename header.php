<?php
include_once "function.php";

  //IF THE USER IS LOGGED IN THEN THE HEARD WILL HAVE THE LINKS
  //METUBE, media, users, inbox, profile, logout, and search bar
  if(isset($_SESSION['username'])) { 

    $username = $_SESSION['username'];
    //getting the messages where the username is the receiver
    $messagequery = "select * from message where receiver='$username' and isItRead=0;";
    $messageresults = mysql_query($messagequery);
    $messagecount = mysql_num_rows($messageresults);

    ?>

<body>
  <form>
    <table width="100%" bgcolor="#ff007f" cellpadding="10">
      <div>
        <tr>
          <td align="left" style="width:50px">
            <!-- METUBE button that takes user to browse.php -->
            <a href="browse.php" style="text-decoration:none">
              <font style="color:#ffffff; font-family:verdana;"> 
                METUBE 
              </font>
            </a>
          </td>
          <td align="left" style="width:50px">
            <!-- Media button that takes the user to browse.php -->
            <a href="browse.php" style="text-decoration:none">
              <font style="color:#ffffff; font-family:verdana;"> 
                Media 
              </font>
            </a>
          </td>
          <td align="left" style="width:50px">
            <!-- Users button that takes the user to accounts.php -->
            <a href="accounts.php" style="text-decoration:none">
              <font style="color:#ffffff; font-family:verdana;"> 
                Users 
              </font>
            </a>
          </td>
          <td style="width:500px"> 
            <!-- Empty cell -->
            &nbsp;
          </td>
          <td align="right" style="width:90px">
            <!-- Inbox button that take the user to their inbox -->
            <a href="inbox.php" style="text-decoration:none">
              <font style="color:#ffffff; font-family:verdana;"> 
                <?php if($messagecount != 0) { ?>
                  <span>
                    <?php 
                      echo "Inbox";
                      echo " (";
                      echo $messagecount; 
                      echo ")"; ?>
                  </span>
                <?php } 
                else { ?>
                  <span>
                    <?php echo "Inbox"; ?>
                  </span>
                <?php } ?>
              </font>
            </a>
          </td>
          <td align="right" style="width:50px">
            <!-- Proflie button that takes the user to their proflie -->
            <form method="post" id="usernameForm<?php echo $username; ?>" action="profile.php">
              <input type="hidden" name="username" value="<?php echo $username; ?>" />
            </form>
            <a style="cursor:pointer; cursor:hand;" onclick="javascript:document.getElementById('usernameForm<?php echo $username; ?>').submit();">
              <font style="color:#ffffff; font-family:verdana; cursor:pointer; cursor:hand;"> 
                Profile
              </font>
            </a>
          </td>
          <td align="right" style="width:50px">
            <!-- Logout button that allows the user to log out -->
            <a href="logout.php" style="text-decoration:none">
              <font style="color:#ffffff; font-family:verdana;"> 
                Logout 
              </font>
            </a>
          </td>
          <td align="right" style="width:200px">
            <!-- Search bar that will open searchMedia.php -->
            <form method="post" role="serach" action="search_process.php">
              <div>
                <input type="text" style="width:200px" name="searchItems" placeholder="Search">
              </div>
            </form>
          </td>
          <td align="right" style="width:10px">
            <button type="submit"> 
              Submit 
            </button>
          </td>
        </tr>
      </div>
    </table>
  </form>

  <script type="text/javascript">
    function goToProfile() { document.getElementById("profile").submit(); }
  </script>

  <?php      
  //IF THE THEY ARE NTO LOGGED IN THEN THIS IS WHAT WILL BE ON THE HEADER BAR
  //METUBE, Media, Users, Login, Register, and Search Bar
  } else { ?>

  <form>
    <div>
      <table width="100%" bgcolor="#ff007f" cellpadding="10">
        <tr>
          <td align="center">
            <!-- METUBE button that takes user to browse.php -->
            <a href="browse.php" style="text-decoration:none">
              <font style="color:#ffffff; font-family:verdana;"> 
                METUBE 
             </font>
            </a>
          </td>
          <td align="center">
            <!-- Media button that takes the user to browse.php -->
            <a href="browse.php" style="text-decoration:none">
              <font style="color:#ffffff; font-family:verdana;"> 
                Media 
              </font>
            </a>
          </td>
          <td align="center">
            <!-- Users button that takes the user to accounts.php -->
            <a href="accounts.php" style="text-decoration:none">
              <font style="color:#ffffff; font-family:verdana;"> 
                Users 
              </font>
            </a>
          </td>
          <td style="width:500px"> 
            <!-- Empty cell -->
            &nbsp;
          </td>
          <td style="width:50px"> 
            <!-- Empty cell -->
            &nbsp;
          </td>
          <td align="right" style="width:50px">
            <!-- Login button that takes the user to login.php -->
            <a href="login.php" style="text-decoration:none">
              <font style="color:#ffffff; font-family:verdana;"> 
               Login 
              </font>
            </a>
          </td>
          <td align="right" style="width:50px"> 
            <!-- Register button that takes the user to the regester.php -->
            <a href="register.php" style="text-decoration:none">
              <font style="color:#ffffff; font-family:verdana;"> 
                Register
              </font> 
            </a>
          </td>
          <td align="right" style="width:200px">
            <!-- Search bar that will open searchMedia.php -->
            <form method="post" role="search" action="search_process.php">
              <div>
                <input type="text" style="width:200px" name="searchItems" placeholder="Search">
              </div>
            </form>
          </td>
          <td align="right" style="width:10px">
            <button type="submit"> 
              Submit 
            </button>
          </td>
        </tr>
      </table>
    </div>
  </form>

  <?php } ?>

</body>
</html>
