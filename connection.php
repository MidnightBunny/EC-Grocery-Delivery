<?php
//name the database
$db_name="ecnd_db";
//open the connection
$open_connection=mysqli_connect("localhost","root","") or die(mysqli_error($open_connection));
//select your database
mysqli_select_db($open_connection,$db_name) or die(mysqli_error($open_connection));
//close the connection
if($open_connection===TRUE)
{
	mysqli_close($open_connection);
}


?>