<?php
include_once "function.php";

  //IF THE USER IS LOGGED IN THEN THE HEARD WILL HAVE THE LINKS
  //METUBE, media, users, seach bar, messages, profile, and logout
  if(isset($_SESSION['username'])) { 

    $username = $_SESSION['username'];
    //getting the messages where the username is the receiver
    $messagequery = "select * from message where receiver='$username' and isItRead=0;";
    $messageresults = mysql_query($messagequery);
    $messagecount = mysql_num_rows($messageresults);

    ?>

  <!-- profile link -->
    <form method="POST" action="profile.php" id="profile">
    <input type="hidden" name="username" value="<?php echo $username;?>"/>
    </form>

  <nav background-color=#CC0066>
    <div>
      <div>
        <button type="button"  data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span>Toggle navigation</span>
          <span></span>
          <span></span>
          <span></span>
        </button>
        <!-- METUBE link that goes to browse.hph -->
        <a href="browse.php">METUBE</a>
      </div>
      <div id="bs-example-navbar-collapse-1">
        <ul>
          <!-- Media link that goes to browse.php -->
          <li class=""><a href="browse.php">Media<span></span></a></li>
        </ul>
        <ul>
          <!-- Users link that goes to accounts.php -->
          <li><a href="accounts.php">Users<span></span></a></li>
        </ul>
        <!-- Search bar that will open serachMedia.php -->
        <form method="post" role="search" action="searchMedia.php">
          <div>
            <input type="text" name="searchWords" placeholder="Search">
          </div>
          <button type="submit">Submit</button>
        </form>
        <ul>
          <!-- Messages link that will open up the users inbox -->
          <li><a href="inbox.php">Messages
          <?php if($messagecount != 0) {?>
            <span><?php echo $messagecount; ?></span>
          <?php } ?>
          <!-- Profile link that will take the user to their profile -->
          <li style="cursor:pointer; cursor:hand?"><a onclick="goToProfile()">Profile</a></li>
          <!-- Logout link that will take them to logout.php -->
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <script type="text/javascript">
    function goToProfile() {
      document.getElementById("profile").submit();
    }
  </script>

<?php }
  //IF THE THEY ARE NTO LOGGED IN THEN THIS IS WHAT WILL BE ON THE HEADER BAR
  //METUBE, Media, Users, Search Bar, Register, and Login 
  else { ?>

  <nav>
    <div>
      <div>
        <button type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span>Toggle navigation</span>
          <span></span>
          <span></span>
          <span></span>
        </button>

	<!-- METUBE link that will open up browse.php -->
        <a href="browse.php">MeTube</a>

      </div>

      <div id="bs-example-navbar-collapse-1">
        <ul>
          <!-- Media link that will open up browse.php -->
          <li><a href="browse.php">Media<span></span></a></li>
        </ul>
        <ul>
          <!-- Users link that will open a login error page that will tell them they need to login before they can view the users -->
          <li><a href="login_error.php">Users<span></span></a></li>
        </ul>
        <!-- Search bar that will open up searchMedia.php -->
        <form method="post" role="search" action="searchMedia.php">
          <div>
            <input type="text" name="searchWords" placeholder="Search">
          </div>
          <button type="submit">Submit</button>
        </form>
        <ul>
          <!-- Register button that will allow the user to register as a user -->
          <li><a href="register.php">Register</a></li>
          <!-- Login button that will allow a current user to login -->
          <li><a href="login.php">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>
<?php } ?>

