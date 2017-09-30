<?php 
	require_once '../includes/DbOperations.php';
	
	$db = new DbOperations(); 
	
	if($_SERVER['REQUEST_METHOD']=='GET'){

		$res = array();
		$empty = array();

		$con = mysqli_connect("localhost","root","","dbecnewdeal");
		$sql = "SELECT * FROM tbl_subcategory";
		
		$r = mysqli_query($con, $sql);

		$x = $db->getAllProducts();

		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			array_push($res, array(
				"category_id" => $row['Category_ID'],
				"subcategory_name" => $row['SubCategory_Name']
				));
		}

		if (count($res) != 0) {
			echo json_encode($res);	
		} else {
			echo json_encode($empty);
		}
		
		
	}

?>