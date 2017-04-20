<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
  Media Upload
</title>

<!-- this is the bar on top of the page -->
<?php require 'header.php'; ?>

<?php
$username = $_SESSION['username'];
$channelquery = "select * from channel where username='$username';";
$channelresult = mysql_query($channelquery);
if(!$channelresult) {
  exit("Could not query channel table in database: ". mysql_error());
}?>

</head>

<body bgcolor="#00cc66">

  <form method="post" id="usernameForm<?php echo $username; ?>" action="profile.php">
    <input type="hidden" name="username" value="<?php echo $username; ?>" />
  </form>

  <br><br>

  <table style="background:#003366; width:100%;" cellpadding="10">
    <tr>
      <td>
        <font style="color:#ffffff; font-family:verdana;">
          Upload Media
        </font>
      </td>
    </tr>
  </table>
  <br>

  <div>
    <form method="post" action="media_upload_process.php" enctype="multipart/form-data" >
      <div>
        <label for="title">
          <font style="color:#ffffff; font-family:verdana;">
            Title:
          </font>
        </label>
        <div>
          <input type="text" style="width:200px" name="title"> 
          <br>
        </div>
      </div>
      <br>
      <div>
        <label for="description">
          <font style="color:#ffffff; font-family:verdana;">
            Description:
          </font>
        </label>
        <div>
          <textarea style="width:200px" rows=3 name="description"></textarea>
        </div>
      </div>
      <br>
      <div>
        <label for="category">
          <font style="color:#ffffff; font-family:verdana;">
            Category:
          </font>
        </label>
        <div name="category">
          <select style="width:200px" name="category">
            <option>Animals</option>
            <option>Cars</option>
            <option>Children</option>
            <option>History</option>
            <option>Home</option>
            <option>Humor</option>
            <option>Music</option>
            <option>News</option>
            <option>Outdoors</option>
            <option>Photography</option>
            <option>Science</option>
            <option>Sports</option>
            <option>Travel</option>
            <option>Weather</option>
            <option>Other</option>
          </select>
        </div>
      </div>
      <br>
      <div>
        <label for="tags">
          <font style="color:#ffffff; font-family:verdana;">
            Tags:
          </font>
        </label>
        <div>
          <textarea style="width:200px" rows=3 name="tags"></textarea>
          <br>
        </div>
      </div>
      <br>
      <div>
        <label>  
          <font style="color:#ffffff; font-family:verdana;">
            Add a Media: 
            <label>
              <em> 
                (Each file limit 10M)
              </em>
            </label>
          </font>
          <br>
        </lable>
        <div>
          <font style="color:#ffffff; font-family:verdana;">
            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
            <input  name="file" type="file" size="50" />
            <br><br>
          </font>
          <input value="Upload" name="submit" type="submit" />
        </div>
      </div>             
    </form>
  </div>
</body>
</html>
