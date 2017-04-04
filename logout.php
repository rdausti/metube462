<!DOCTYPE html PUBLIC "-//W3C//DTD CHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>

<title>MeTube</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/default.css" />
  
  <!-- this is the bar on top of the screen -->
  <?php require 'header.php'; ?>

</head>
<body>

<?php
session_start();
session_destroy();
header("refresh:2; url=index.php");

?>

<p class="text-primary">
  You have logged out. Please vist MeTube again.
</p>

</body>
</html>
