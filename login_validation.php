<link href="Assets/css/sweetalert.css" rel="stylesheet" />
 <script src="Assets/js/sweetalert.min.js"></script>
<?php

include'connection.php';


$username=$_POST['username'];
$password=$_POST['password'];
$pass = md5($password);

$query1="SELECT * from tbl_user WHERE username='$username' AND password='$pass'";
$result1=mysqli_query($open_connection,$query1);
$record=mysqli_num_rows($result1);


if($record==1){
	$query2="SELECT * from tbl_user WHERE username='$username' AND password='$pass'";
	$result2=mysqli_query($open_connection,$query1);

	while(list($id,$firstname,$lastname,$username,$password,$userlevel,$image)=mysqli_fetch_array($result2))
	{
		$aid=$id;
		$afirstname=$firstname;
		$alastname=$lastname;
		$ausername=$username;
		$apassword=$password;
		$auserlevel=$userlevel;
		$img_user=$image;

	}
		session_start();
		$_SESSION['id']=$aid;
		$_SESSION['firstname']=$afirstname;
		$_SESSION['lastname']=$alastname;
		$_SESSION['username']=$ausername;
		$_SESSION['password']=$apassword;
		$_SESSION['userlevel']=$auserlevel;
		$_SESSION['image']=$img_user;
		$_SESSION['id'];

		if($auserlevel=='Super Admin'){
		echo"
			<script type='text/javascript'>
				alert('Successfully logged in!')
				open('dashboard.php','_self');
			</script>
		";	
		}
		else if($auserlevel=='Admin'){
		echo"
			<script type='text/javascript'>
				alert('Successfully logged in!')
				open('dashboard.php','_self');
			</script>
		";	
		}
		else if($auserlevel=='Cashier'){
		echo"
			<script type='text/javascript'>
				alert('Successfully logged in!')
				open('cashierdashboard.php','_self');
			</script>
		";	
		}
		else if($auserlevel=='Merchandiser'){
		echo"
			<script type='text/javascript'>
				open('merchandiser.php','_self');
			</script>
		";	
		}
		else if($auserlevel=='Courier'){
		echo"
			<script type='text/javascript'>
				alert('Mobile Log in only!')
			</script>
		";	
		}
	}
	else{
		echo"
			<script type='text/javascript'>
				alert('Wrong username or Password!');
				open('index.php','_self');
			</script>
		";
	}
?>
