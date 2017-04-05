
<body>

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

    <form>
      <table width="100%" bgcolor="#ff007f">
        <div>
          <tr>
            <td align="center">
              <!-- METUBE button that takes user to browse.php -->
              <a href="browse.php" style="color:#ffffff"> 
                METUBE 
              </a>
            </td>
            <td align="center">
              <!-- Media button that takes the user to browse.php -->
              <a href="browse.php" style="color:#ffffff"> 
                Media 
              </a>
            </td>
            <td align="center">
              <!-- Users button that takes the user to accounts.php -->
              <a href="accounts.php" style="color:#ffffff"> 
                Users 
              </a>
            </td>
            <td style="width:500px"> 
              <!-- Empty cell -->
              &nbsp;
            </td>
            <td align="right" style="width:50px">
              <!-- Inbox button that take the user to their inbox -->
              <a href="inbox.php" style="color:#ffffff"> 
                Inbox 
              </a>
            </td>
            <td align="right" style="width:50px">
              <!-- Proflie button that takes the user to their proflie -->
              <a onclick="goToProflie()" style="color:#ffffff"> 
                Proflie
              </a>
            </td>
            <td>
              <!-- Logout button that allows the user to log out -->
              <a href="logout.php" style="color:#ffffff"> 
                Logout 
              </a>
            </td>
            <td align="right" style="width:200px">
              <!-- Search bar that will open searchMedia.php -->
              <form method="post" role="serach" action="searchMedia.php">
                <div>
                  <input type="text" style="width:200px" name="serachWords" placeholder="Search">
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
    function goToProfile() {
      document.getElementById("profile").submit();
    }
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
              <a href="browse.php" style="color:#ffffff"> 
                METUBE 
              </a>
            </td>
            <td align="center">
              <!-- Media button that takes the user to browse.php -->
              <a href="browse.php" style="color:#ffffff"> 
                Media 
              </a>
            </td>
            <td align="center">
              <!-- Users button that takes the user to accounts.php -->
              <a href="login_error.php" style="color:#ffffff"> 
                Users 
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
              <a href="login.php" style="color:#ffffff"> 
                Login 
              </a>
            </td>
            <td align="right" style="width:50px"> 
              <!-- Register button that takes the user to the regester.php -->
              <a href="register.php" style="color:#ffffff"> 
                Register 
              </a>
            </td>
            <td align="right" style="width:200px">
              <!-- Search bar that will open searchMedia.php -->
              <form method="post" role="serach" action="searchMedia.php">
                <div>
                  <input type="text" style="width:200px" name="serachWords" placeholder="Search">
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
