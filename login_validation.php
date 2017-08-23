<?php

include'connection.php';


$username=$_POST['username'];
$password=$_POST['password'];


$query1="SELECT * from tbl_users WHERE username='$username' AND password='$password'";
$result1=mysql_query($query1);
$record=mysql_num_rows($result1);


if($record==1){
	$query2="SELECT * from tbl_users WHERE username='$username' AND password='$password'";
	$result2=mysql_query($query1);

	while(list($id,$firstname,$lastname,$username,$password,$userlevel)=mysql_fetch_array($result2))
	{
		$aid=$id;
		$afirstname=$firstname;
		$alastname=$lastname;
		$ausername=$username;
		$apassword=$password;
		$auserlevel=$userlevel;

	}
		session_start();
		$_SESSION['id']=$aid;
		$_SESSION['firstname']=$afirstname;
		$_SESSION['lastname']=$alastname;
		$_SESSION['username']=$ausername;
		$_SESSION['password']=$apassword;
		$_SESSION['userlevel']=$auserlevel;
		$_SESSION['id'];

		if($auserlevel=='Super Admin'){
		echo"
			<script type='text/javascript'>
				alert('Successfully login!')
				open('dashboard.php','_self');
			</script>
		";	
		}
		else if($auserlevel=='Admin'){
		echo"
			<script type='text/javascript'>
				open('dashboard.php','_self');
			</script>
		";	
		}
		else if($auserlevel=='Cashier'){
		echo"
			<script type='text/javascript'>
				open('cashier.php','_self');
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