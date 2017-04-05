<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	include_once "function.php";
?>	
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/default.css" />
<title>Media</title>
<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>


<!-- this is the bar on the top of the screen -->
<?php require 'header.php'; ?>

</head>

<body bgcolor=#00cc66>

<div>

<?php
if(isset($_GET['id'])) {
	$mediaquery = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
	$mediaresult = mysql_query( $mediaquery );
        $resultrow = mysql_fetch_row($mediaresult);
	
	$filename=$resultrow[0]; 
	$path=$resultrow[4];
        $title=$resultrow[5];
        $description=$resultrow[7]; 
	$type=$resultrow[2];
	if(substr($type,0,5)=="image") //view image
	{ ?>
          <h2>Viewing image: <?php echo $title;?></h2><br>
          <img src="<?php echo $path?>"/><br>
          <a href="<?php echo $path; ?>" target=_blank" onclick="javascript:saveDownload(<?php echo $result_row[4]; ?>);">Download</a>
        <?php
	}
	else if (substr($type,0,5)=="video")//view movie
	{ ?>	
	  <h2>Viewing Video:<?php echo $title;?><h2>

          <br>
	      
          <object id="MediaPlayer" width=320 height=286 classid="CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95" standby="Loading Windows Media Player components..." type="application/x-oleobject" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112">

          <param name="filename" value="<?php echo $filename;?>">	
          <param name="Showcontrols" value="True">
          <param name="autoStart" value="True">
          <div style="text-align:center">

          <video width="400" controls>
            <source src="<?php echo $filepath; ?>" type="video/mp4">
            <source src="<?php echo $filepath; ?>" type="video/webm">
            <source src="<?php echo $filepath; ?>" type="video/ogg">
            Your browser cannot support HTML5 video.
          </video>
          <br>
          </div>
          
          <script>
            var myVideo = document.getElementById("video1");
            myVideo.onseeking = function(){};
          </script>
          </object>

          <a href="<?php echo $filepath; ?>" target="_blank" onclick="javascript:saveDownload(<?php echo $path; ?>);">Download</a>

          <!-- <embed type="application/x-mplayer2" src="<?php echo $filepath;  ?>" name="MediaPlayer" width=320 height=240></embed> -->
              
<?php
	}
        else if(substr($type,0,5) == "audio") { ?>
          <h2>Listening to Audio: <?php echo $title; ?> </h2>
          <br>
          
           <object id="MediaPlayer" width=320 height=286 classid="CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95" standby="Loading Windows Media Player components..." type="application/x-oleobject" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112">

          <param name="filename" value="<?php echo $filename;?>">       
          <param name="Showcontrols" value="True">
          <param name="autoStart" value="True">
          <div style="text-align:center">

          <audio controls>
            <source src="<?php echo $filepath; ?>" type="audio/mpeg">
            <source src="<?php echo $filepath; ?>" type="audio/ogg">
            Your browser cannot support HTML5 audio.
          </audio>
          <br>
          </div>
          
          <script>
            var myAudio = document.getElementById("audio1");
            myAudio.onseeking = function(){};
          </script>
          </object>

          <a href="<?php echo $filepath; ?>" target="_blank" onclick="javascript:saveDownload(<?php echo $path; ?>);">Download</a>
<?php
        }
        else { ?>

          <h2>Other file: <?php echo $title; ?></h2>
          <br>
      
          <tr>
            <td>
              <?php echo $filename; ?>
            </td>
            <td>
              <a href="<?php echo $filepath; ?>" target="_blank" onclick="javascript:saveDownload(<?php echo $path; ?>);">Download</a>
            </td>
          </tr>
          <br>

<?php
        }
        $mediaid=$_GET['id'];
        if(isset($_SESSION['username'])) {
          $username=$_SESSION['username'];
        ?>
        
        <div>
          <?php
          echo "<h4>Favorites: </h4><br>";
         // $favoritequery = "select * from favorites where mediaid=$mediaid and username='$username';";
         // $rows = mysql_query($favoritequery);
         // $favorite = mysql_num_rows($rows);
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
         // }
          ?>

          <script type="text/javascript">
            function changeAction(type) {
              if(type=="unF") {
                document.getElementById('button form').action="unfavorite_process.php";
              }
              else if (type=="F") {
                document.getElementsById('button form').action="favorite_process.php";
              }
              else if (type=="unS") {
                document.getElementsById('button form').action="unsubscribe_process.php";
              }
              else if (type=="S") {
                document.getElementsById('button form').action="subscribe_process.php";
              }
            }
          </script>
          <form method="post" id="button form" action="" enctype="multipart/form-data">
          <?php
          //if($favorite) { ?>
            <!-- <input onclick="changeAction('unF')" type="submit" value="Unfavorite" name="unfavorite" />
            <input type="hidden" name="mediaid" value="<?php echo $mediaid?>"> -->
          <?php
         // }
         // else { ?>
           <!-- <input onclick="changeAction('F')" type="submit" value="Favorite" name="favorite" />
            <input type="hidden" name="mediaid" value="<?php echo $mediaid?>"> -->
          <?php
         // }

         // if(isset($channelid) and $username != $channelowner) {
           // if($is_subbed) { ?>
             <!-- <input onclick="changeAction('unS')" type="submit" value="Unsubscribe from <?php echo $channeltitle; ?>" name="unsubscribe" />
              <input type="hidden name="channelid" value="<?php echo $channelid?>">
            //<?php
            //}
              //else { ?>
                <input onclick="changeAction('S')" type="submit" value="Subscribe to <?php echo $channeltitle; ?>" name="subscribe" />
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
          </script>

          <?php
         // $queryPlaylist = "select * from playlists where username = '$username' and playlistid not in (select playlistid from playlistmedia where username='$username' and mediaid = $mediaid);";
         // $playlistresult = mysql_query($queryPlaylist);
          ?>
          <div>
            <form method="post" action="add_to_playlist_process.php" enctype="multipart/form-data">
              <label for="playlistTitle">Select playlist: </label>
              <div>
                <select onchange='checkValue(this.value);' name="playlistTitle">
                 // <?php
                 // while($singleplaylist=mysql_fetch_row($playlistresult)) {
                   // $playlisttitle=$singleplaylist[1];
                 // ?>
                    <option value="<?php echo $playlisttitle; ?>"><?php echo$playlisttitle?></option>
                  <?php
                 // } ?>
                  <option value="add new">Make new playlist</option>
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
         
         <?php }
         echo "<h4>Description: &nbsp;</h4> ";
         echo "<p>$description</p>";

        // $commentquery = "select * from comments where mediaid='$mediaid'";
        // $comments = mysql_query($commentquery);
        // if(!$comments) {
          // die("Could not query comment table in database: <br />".mysql_error());
        // }
        // ?>
         <!-- <br>
          <fieldset class="form-horizontal">
            <legend>Comments</legend>
            <table class="table table-striped">
           // <?php
           // while($singlecomment = mysql_fetch_row($comments)) {
             // $commentid = $singlecomment[0];
             // $commentuser = $singlecomment[2];
            //  $commentbody = $singlecomment[3];
           // ?>
              <tr>
              <td label>
             // <?php
            //  if(!isset($username) or $username != $commentuser) { ?>
                <form id="showProfile<?php echo $commentid; ?>" method="post" action="profile.php">
                  <a href="javascript:document.getElementById('showProfile<?php echo $commentid; ?>').submit();"><?php echo $commentuser; ?></a>
                  <input type="hidden" value="<?php echo $commentuser; ?>" name="username" />
                </form>
             // <?php
            //  }
             // else { ?>
                <form id="deletecomment<?php echo $commentid; ?>" method="post" action="delete_comment_process.php">
               //   <?php echo $commentuser;
                //  echo ':'; ?>
                  <a href="javascript:document.getElementById('deletecomment<?php echo $commentid; ?>').submit();"><small>Delete</small></a>
                  <input type="hidden" value="<?php echo $commentid; ?>" name="commentid" />
                  <input type="hidden" value="<?php echo $mediaid; ?>" name="mediaid" />
                </form> -->
             // <?php
             // } ?>
           <!-- </label>
            
            <br><p><?php echo $commentBody?></p>
            </td>
            </tr>-->
         // <?php
         // }
         // if(isset($username)) { ?>
          <!--  <tr>
              <td>
                <form method="post" action="comment_process.php">
                  <label><?php echo $_SESSION['username']?>:</label>
                  <br>
                  <textarea rows="3" name="usercomment"></textarea>
                  <input type="submit" value="Post Comment"/>
                  <input type="hidden" name="mediaid" value="<?php echo $mediaid ?>" />
                </form>
              </td>
            </tr> -->
          </table>
        </fieldset>

</div>

<?php
  }       

else
{
?>
<meta http-equiv="refresh" content="0;url=browse.php">
<?php
}
?>
</body>
</html>
