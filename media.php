<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	include_once "function.php";
?>	
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/default.css" />
<title>
  Media
</title>
<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>


<!-- this is the bar on the top of the screen -->
<?php require 'header.php'; ?>

</head>

<body bgcolor="#00cc66">

<form method="post" id="usernameForm<?php echo $username; ?>" action="profile.php">
  <input type="hidden" name="username" value="<?php echo $username; ?>" />
</form>

<div>
  <?php

  //IF THE MEDIA ID IS SET
  if(isset($_GET['id'])) {
  	$mediaquery = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
  	$mediaresult = mysql_query( $mediaquery );
          $resultrow = mysql_fetch_row($mediaresult);
  	
  	$filename=$resultrow[0]; 
  	$path=$resultrow[4];
          $title=$resultrow[5];
          $description=$resultrow[7]; 
  	$type=$resultrow[2];

    //IMAGE
  	if(substr($type,0,5)=="image") { ?>
      <h2>
        <font style="color:#ffffff; font-family:verdana;">
          Viewing image: <?php echo $title;?>
        </font>
      </h2>
      <br>
      <img src="<?php echo $path?>"/>
      <br>
      <a href="<?php echo $path; ?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[4]; ?>);">
        <font style="color:#ffffff; font-family:verdana;">
          Click to Download
        </font>
        <br><br>
      </a>
    <?php
  	}

    //VIDEO
  	else if (substr($type,0,5)=="video") { ?>	
  	  <h2>
        <font style="color:#ffffff; font-family:verdana;">
          Viewing Video: <?php echo $title;?>
        </font>
      </h2>
      <br>
    
      <object id="MediaPlayer" width=320 height=286 classid="CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95" standby="Loading Windows Media Player components..." type="application/x-oleobject" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112">

        <param name="filename" value="<?php echo $filename;?>">	
        <param name="Showcontrols" value="True">
        <param name="autoStart" value="True">
        <div style="text-align:center">
          <video width="400" controls>
            <source src="<?php echo $path; ?>" type="video/mp4">
            <source src="<?php echo $path; ?>" type="video/webm">
            <source src="<?php echo $path; ?>" type="video/ogg">
            Your browser cannot support HTML5 video.
          </video>
          <br>
        </div>
        
        <script>
          var myVideo = document.getElementById("video1");
          myVideo.onseeking = function(){};
        </script>
      </object>

      <a href="<?php echo $path; ?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $path; ?>);">
        <font style="color:#ffffff; font-family:verdana;">
          Click to Download
        </font>
        <br><br>
      </a>    
    <?php
    }

    //AUDIO
    else if(substr($type,0,5) == "audio") { ?>
      <h2>
        <font style="color:#ffffff; font-family:verdana;">
          Listening to Audio: <?php echo $title; ?> 
        </font>
      </h2>
      <br>
      
      <object id="MediaPlayer" width=320 height=286 classid="CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95" standby="Loading Windows Media Player components..." type="application/x-oleobject" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112">

        <param name="filename" value="<?php echo $filename;?>">       
        <param name="Showcontrols" value="True">
        <param name="autoStart" value="True">
        <div style="text-align:center">
          <audio controls>
            <source src="<?php echo $path; ?>" type="audio/mpeg">
            <source src="<?php echo $path; ?>" type="audio/ogg">
            Your browser cannot support HTML5 audio.
          </audio>
          <br>
        </div>
        
        <script>
          var myAudio = document.getElementById("audio1");
          myAudio.onseeking = function(){};
        </script>
      </object>

      <a href="<?php echo $path; ?>" style="text-decoration:none" target="_blank" onclick="javascript:saveDownload(<?php echo $path; ?>);">
        <font style="color:#ffffff; font-family:verdana;">
          Click to Download
        </font>
        <br><br>
      </a>
    <?php
    }

    //OTHER MEIDA FORMS
    else { ?>

      <h2>
        <font style="color:#ffffff; font-family:verdana;">
          Other file: <?php echo $title; ?>
        </font>
      </h2>
      <br>

      <tr>
        <td>
          <?php echo $filename; ?>
        </td>
        <td>
          <a href="<?php echo $path; ?>" target="_blank" onclick="javascript:saveDownload(<?php echo $path; ?>);">
            <font style="color:#ffffff; font-family:verdana;">
              Click to Download
            </font>
            <br><br>
          </a>
        </td>
      </tr>
      <br>

    <?php
    }

    $mediaid=$_GET['id'];

    //IF A USER IS LOGED IN
    if(isset($_SESSION['username'])) {
      $username=$_SESSION['username']; ?>

      <!-- FAVORITES -->
      <div>
        <?php
        echo "<h4>Favorites: </h4><br>";
        $favoritequery = "select * from favorite where mediaid=$mediaid and username='$username';";
        $rows = mysql_query($favoritequery);
        $favorite = mysql_num_rows($rows);
       // $channelquery="select channeltitle, channels.channelid, username from channelmedia join channels where channels.channelid=channelmedia.channelid and mediaid=$mediaid;";
       // $channel=mysql_query($channelquery);
       // $singlechannel=mysql_fetch_row($channel);
       // $channeltitle=$singlechannel[0];
       // $channelid=$singlechannel[1];
       // $channelowner=$singlechannel[2];
       // if(isset$channelid)) {
         // $subquery="select * from subs where channelid=$channelid and username='$username';";
         // $subscription=mysql_query($subquery);
         // $is_subbed=mysql_num_rows($subscription);
        //}
        ?>

        <script type="text/javascript">
          function changeAction(type) {
            if(type=="unfavorite") {
              document.getElementById('button form').action="unfavorite_process.php";
            }
            else if (type=="favorite") {
              document.getElementById('button form').action="favorite_process.php";
            }
            else if (type=="unsubscribe") {
              document.getElementById('button form').action="unsubscribe_process.php";
            }
            else if (type=="subscribe") {
              document.getElementById('button form').action="subscribe_process.php";
            }
          }
        </script>
        <form method="post" id="button form" action="" enctype="multipart/form-data">
          <?php
          if($favorite) { ?>
            <input onclick="changeAction('unfavorite')" type="submit" value="Unfavorite" name="unfavorite">
            <input type="hidden" name="mediaid" value="<?php echo $mediaid?>">
          <?php
          }
          else { ?>
            <input onclick="changeAction('favorite')" type="submit" value="Favorite" name="favorite">
            <input type="hidden" name="mediaid" value="<?php echo $mediaid?>">
          <?php
          }

         // if(isset($channelid) and $username != $channelowner) {
           // if($is_subbed) { ?>
             <!-- <input onclick="changeAction('unsubscribe')" type="submit" value="Unsubscribe from <?php echo $channeltitle; ?>" name="unsubscribe" />
              <input type="hidden name="channelid" value="<?php echo $channelid?>">
            //<?php
            //}
              //else { ?>
                <input onclick="changeAction('subscribe')" type="submit" value="Subscribe to <?php echo $channeltitle; ?>" name="subscribe" />
                <input type="hidden" name="channelid" value="<?php echo $channelid?>">
              //<?php
             // }
            //} ?> -->
        </form>
      </div> 

      <script type="text/javascript">
        function checkValue(val) {
          if(val == "add new") {
            document.getElementById('playlistTitleNew').style.display='block';
            document.getElementById('createAndAddToPlaylist').style.display='block';
            document.getElementById('addToPlaylist').style.display='block';
          }
          else {
            document.getElementById('playlistTitleNew').style.display='none';
            document.getElementById('createAndAddToPlaylist').style.display='none';
            document.getElementById('addToPlaylist').style.display='block';
          }
        }
      </script>



      <?php
      // $queryPlaylist = "select * from playlists where username = '$username' and playlistid not in (select playlistid from playlistmedia where username='$username' and mediaid = $mediaid);";
      // $playlistresult = mysql_query($queryPlaylist);
      ?>

      <!-- PLYALISTS -->
      <div>
        <form method="post" action="add_to_playlist_process.php" enctype="multipart/form-data">
          <label for="playlistTitle">
            <font style="color:#ffffff; font-family:verdana;">
              Select playlist: 
            </font>
          </label>
          <div>
            <select onchange='checkValue(this.value);' name="playlistTitle">
             // <?php
             // while($singleplaylist=mysql_fetch_row($playlistresult)) {
               // $playlisttitle=$singleplaylist[1];
             // ?>
                <option value="<?php echo $playlisttitle; ?>">
                  <?php echo$playlisttitle?>
                </option>
              <?php
             // } ?>
              <option value="add new">
                Make new playlist
              </option>
            </select>
            <input type="hidden" name="mediaid" value="<?php echo $mediaid; ?>" />
            <span>
              <input type="submit" value="Add" id="addToPlaylist" name="addToPlaylist" />
            </span>
          </div>
          <div>
            <input type="text" name="playlistTitleNew" id="playlistTitleNew" style='display:none;' />
            <span>
              <input type="submit" value="Add" id="createAndAddToPLaylist" name="createAndAddtoPlaylist" style='display:none;' />
            </span>
          </div>
        </form>
      </div>

      <!-- DESCRIPTION -->
      <table style="width:100%" cellpadding="10">
        <tr style="background:#003366" >
          <td>
            <font style="color:#ffffff; font-family:verdana;">
              Description: &nbsp;
            </font>
          </td>
        </tr>
        <tr>
          <td>
            <font style="color:#ffffff; font-family:verdana;">
              <?php echo $description; ?>
            </font>
          </td>
        <tr>
      </table>


      <?php
      //COMMENTS 
      $commentquery = "select * from comment where mediaid='$mediaid'";
      $comments = mysql_query($commentquery);
      if(!$comments) {
        exit("Could not query comment table in database: <br />".mysql_error());
      }
      ?>
      <br>
      <table style="width:100%" cellpadding="10">
        <tr style="background:#003366" >
          <td>
            <font style="color:#ffffff; font-family:verdana;">
              Comments: &nbsp;
            </font>
          </td>
        </tr>
      </table>
      <table>
        <?php
        while($singlecomment = mysql_fetch_row($comments)) {
          $commentid = $singlecomment[0];
          $commentuser = $singlecomment[2];
          $commentbody = $singlecomment[3];
          ?>
          <tr>
            <td style="width:100px">
              <form id="showProfile<?php echo $commentid; ?>" method="post" action="profile.php">
                <a href="javascript:document.getElementById('showProfile<?php echo $commentid; ?>').submit();">
                  <font style="color:#ffffff; font-family:verdana;">
                    <b>
                      <?php echo $commentuser; 
                      echo ":"; ?>
                    </b>
                  </font>
                </a>
                <input type="hidden" value="<?php echo $commentuser; ?>" name="username" />
              </form>
            </td>
            <td>
              <font style="color:#ffffff; font-family:verdana;">
                <?php echo $commentbody?>
              </font>
            </td>
          </tr>
        <?php
        } ?>

          <tr>
            <td>
              &nbsp;
            </td>
          </tr>
        </table>

        <?php
        if(isset($username)) { ?>
          <table>
            <tr>
              <td>
                <form method="post" action="comment_process.php">
                  <label>
                    <font style="color:#ffffff; font-family:verdana;">
                      <?php echo $_SESSION['username']?>:
                    </font>
                  </label>
                  <br>
                  <textarea style="width:400px" rows="3" name="usercomment"> </textarea>
                  <input type="submit" value="Post"/>
                  <input type="hidden" name="mediaid" value="<?php echo $mediaid ?>" />
                </form>
              </td>
            </tr> 
          </table>
        <?php } ?>
    <?php 
    } ?>
</div>

<?php
} 
else { ?>
  <meta http-equiv="refresh" content="0;url=browse.php">
<?php } ?>
</body>
</html>
