<?php 
	include 'connection.php';
	
	$q = $_GET['q']; 
	$a = mysqli_query($open_connection,"SELECT lastname from tbl_user WHERE id =$q");
	while ($r=mysqli_fetch_array($a)) {
        $b=$r['lastname'];
      }
    $c = md5(strtoupper($b));
    mysqli_query($open_connection,"UPDATE tbl_user SET password='$c' WHERE id =$q");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
</head>
<body style="background-color:#aa0e15">
	<img id="logo-img" class="logo-img" style="width:200px;display: block;margin: 0 auto;" src="Assets/Images/EC.png" />
	<h1 style="color: white; text-align: center;">Password has been reset to your default password</h1>
	<div style="text-align:center;"><a href="index.php" style="text-align:center;text-decoration: none;color: white;">Return to Log in </a></div>
</body>
</html>