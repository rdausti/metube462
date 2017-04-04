<?php
session_start();
include_once "function.php";


$username=$_SESSION['username'];
$title= mysql_real_escape_string($_POST['title']);
$tags=mysql_real_escape_string($_POST['tags']);
$description=mysql_real_escape_string($_POST['description']);
$category=mysql_real_escape_string($_POST['category']);

//Create Directory if doesn't exist
if(!file_exists('uploads/'))
	mkdir('uploads/', 0757);
$dirfile = 'uploads/'.$username.'/';
if(!file_exists($dirfile))
	mkdir($dirfile,0755);
	chmod( $dirfile,0755);
	if($_FILES["file"]["error"] > 0 )
	{ 	$result=$_FILES["file"]["error"];} //error from 1-4
	else
	{
		$upfile = $dirfile.urlencode($_FILES["file"]["name"]);
	  
	  if(file_exists($upfile))
	  {
	  	$result="5"; //The file has been uploaded.
	  }
	  else{
			if(is_uploaded_file($_FILES["file"]["tmp_name"]))
			{
				if(!move_uploaded_file($_FILES["file"]["tmp_name"],$upfile))
				{
					$result="6"; //Failed to move file from temporary directory
				}
				else /*Successfully upload file*/
				{
					//insert into media table
					$insert = "insert into media(mediaid, filename,username,type, path,title,tags,description,category)".
							  "values(NULL,'". urlencode($_FILES["file"]["name"])."','$username','".$_FILES["file"]["type"]."', '$upfile','$title','$tags','$description','$category')";
					$queryresult = mysql_query($insert)
						  or die("Insert into Media error in media_upload_process.php " .mysql_error());
					$result="0";
					chmod($upfile, 0644);
				}
			}
			else  
			{
					$result="7"; //upload file failed
			}
		}
	}
       // $channelid=$_POST['channels'];
       // if($channelid != "none") {
         // $queryMedia = "select mediaid from media where username='$username' order by mediaid desc;";
         // $resultMedia = mysql_query($mediaquery);
         // $resultMedia_row = mysql_fetch_row($media_result);
         // $mediaid=$resultMedia_row[0];
         // $queryChannel = "insert into channelmedia(mapid,channelid,mediaid) values (NULL,$channelid, $mediaid);";
         // $channelresult = mysql_query($queryChannel);
       // }
	
	//You can process the error code of the $result here.
?>

<meta http-equiv="refresh" content="0;url=browse.php?result=<?php echo $result;?>">
