<?php

  $first_name = $_POST['first_name'];
  $last_name =  $_POST['last_name'];
  $address = $_POST['address'];
  $contact_no =  $_POST['contact_no'];
  $password = $_POST['password'];

//Create connection
$con=mysqli_connect("localhost","root","","db_ecnewdeal");

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
// This SQL statement selects ALL from the table 'users'
$sql = "INSERT INTO tbl_customer (first_name, last_name, address, contact_no, password) VALUES ('$first_name','$last_name','$address','$contact_no','$password')";

//$sql = "SELECT * FROM menu WHERE itemCategory = '$category'";
 
// Check if there are results
if ($result = mysqli_query($con, $sql))
{
	// If so, then create a results array and a temporary one
	// to hold the data
	$resultArray = array();
	$tempArray = array();
 
	// Loop through each row in the result set
	while($row = fetch_array($result))
	{
		// Add each row into our results array
		$tempArray = $row;
	    array_push($resultArray, $tempArray);
	}
 
	// Finally, encode the array to JSON and output the results
	echo json_encode($resultArray);
}
 
// Close connections
mysqli_close($con);




?>