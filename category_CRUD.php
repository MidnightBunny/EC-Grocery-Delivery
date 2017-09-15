<?php

	include'connection.php';
	
	//Adding Category
	if (isset($_POST['CategorySubmit'])) {
		$category_name=$_POST['Category'];
		$sc_val = $_POST['SC_v'];
		$query1="SELECT * from tbl_category WHERE Category_Name='$category_name'";
		$result1=mysqli_query($open_connection,$query1);
		$record=mysqli_num_rows($result1);
		if($record<=0){
			$query2="INSERT into tbl_category(Category_Name)VALUES('$category_name')";
			mysqli_query($open_connection,$query2);
			$id = mysqli_insert_id($open_connection);
			for($i=1; $i <= $sc_val ; $i++) { 
				$sc = $_POST["SC{$i}"];
				$query_sub = "INSERT into tbl_subcategory(Category_ID,SubCategory_Name)VALUES($id,'$sc')";
				mysqli_query($open_connection,$query_sub);
			} 
			echo"
				<script type='text/javascript'>
					alert('Category Successfully Added!');
					open('category.php','_self');
				</script>
			";
		}
		else{
			echo"
				<script type='text/javascript'>
					alert('This Category Already Exists!');
					open('category.php','_self');
					</script>";
		}
		
	}//Adding Sub Categories
	elseif (isset($_POST['SubCategorySubmit'])) {
		$scat=$_POST['SubCategory'];
		$cat_id=$_POST["Sub"];
		$query_a="SELECT * from tbl_subcategory WHERE SubCategory_Name='$scat'";
		$result2=mysqli_query($open_connection,$query_a);
		$record2=mysqli_num_rows($result2);
		if($record2<=0){
		$query_b="INSERT into tbl_subcategory(Category_ID,SubCategory_Name)VALUES($cat_id,'$scat')";
		mysqli_query($open_connection,$query_b);
		echo"
				<script type='text/javascript'>
					alert('Sub Category Successfully Added!');
					open('category.php','_self');
				</script>
			";
		}
		else{
			echo"
				<script type='text/javascript'>
					alert('This Sub Category Already Exists!');
					open('category.php','_self');
					</script>";
		}
	}
	elseif (isset($_POST['EditCategorySubmit'])) {
		$cat_id=$_POST["C_ID"];
		$cat_name=$_POST['Ctgry'];
		$query_c="UPDATE tbl_category SET Category_Name='$cat_name' WHERE  Category_ID=$cat_id";
		mysqli_query($open_connection,$query_c);
		echo"
				<script type='text/javascript'>
					alert('Category Successfully Edited!');
					open('category.php','_self');
				</script>
			";
		
	}
	elseif (isset($_POST['EditSCategorySubmit'])) {
		$scat_id=$_POST["SC_ID"];
		$scat_name=$_POST['SCtgry'];
		echo $query_d="UPDATE tbl_subcategory SET SubCategory_Name='$scat_name' WHERE  SCat_ID=$scat_id";
		mysqli_query($open_connection,$query_d);
		echo"
				<script type='text/javascript'>
					alert('Sub Category Successfully Edited!');
					open('category.php','_self');
				</script>
			";
		
	}
		
?>