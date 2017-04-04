<?php
include "mysqlClass.inc.php";


function user_exist_check ($username, $password, $firstname, $lastname, $gender, $email){
	$accountquery = "select * from account where username='$username'";
	$accountresult = mysql_query( $accountquery );
	if (!$accountresult){
		exit ("user_exist_check() failed. Could not query the database: <br />". mysql_error());
	}	
	else {
		$rowresult = mysql_fetch_assoc($accountresult);
		if($rowresult == 0){
			$insertquery = "insert into account(username,password,firstname,lastname,gender,email) values('$username','$password','$firstname','$lastname','$gender','$email')";
			//echo "insert query:" . $query;
			$insertresult = mysql_query( $insertquery );
			if($insertresult)
				return 1;
			else
				exit("Could not insert into the database: <br />". mysql_error());		
		}
		else{
			return 2;
		}
	}
}


function user_pass_check($username, $password)
{
	
	$accountquery = "select * from account where username='$username'";
	echo  $accountquery;
	$accountresult = mysql_query( $accountquery );
		
	if (!$accountresult)
	{
	   exit("user_pass_check() failed. Could not query the database: <br />". mysql_error());
	}
	else{
		$rowresult = mysql_fetch_row($accountresult);
		if(strcmp($rowresult[1],$password))
			return 2; //wrong password
		else 
			return 0; //Checked.
	}	
}

function updateMediaTime($mediaid)
{
	$updatequery = "update  media set lastaccesstime=NOW()
   						WHERE '$mediaid' = mediaid
					";
					 // Run the query created above on the database through the connection
        $updateresult = mysql_query( $updatequery );
	if (!$updateresult)
	{
	   exit("updateMediaTime() failed. Could not query the database: <br />". mysql_error());
	}
}

function upload_error($result)
{
	//view erorr description in http://us2.php.net/manual/en/features.file-upload.errors.php
	switch ($result){
	case 1:
		return "UPLOAD_ERR_INI_SIZE";
	case 2:
		return "UPLOAD_ERR_FORM_SIZE";
	case 3:
		return "UPLOAD_ERR_PARTIAL";
	case 4:
		return "UPLOAD_ERR_NO_FILE";
	case 5:
		return "File has already been uploaded";
	case 6:
		return  "Failed to move file from temporary directory";
	case 7:
		return  "Upload file failed";
	}
}

function update_profile_info($user, $pass, $first, $last, $gender, $email) {
  if($pass != "") {
    $passwordquery = "update account set password='$pass' where username='$user'";
    $passwordresult = mysql_query($passwordquery);
  }
  
  if($first != "") {
    $firstquery = "update account set firstname='$first' where username='$user'";
    $firstresult = mysql_query($firstquery);
  }

  if($last != "") {
    $lastquery = "update account set lastname='$last' where username='$user'";
    $lastresult = mysql_query($lastquery);
  }
 
  if($gender != "") {
    $genderquery = "update account set gender='$gender' where username='$user'";
    $genderresult = mysql_query($genderquery);
  }

  if($email != "") {
    $emailquery = "update account set email='$email' where username='$user'";
    $emailresult = mysql_query($emailquery);
  }

  return 1;
}
	
?>
