<?php
//name the database
$db_name="dbecnewdeal";
//open the connection
$open_connection=mysql_connect("localhost","root","") or die(mysql_error());
//select your database
mysql_select_db($db_name) or die(mysql_error());
//close the connection
if($open_connection===TRUE)
{
	mysql_close($open_connection);
}


?>