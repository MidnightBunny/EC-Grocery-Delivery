<?php

	include'connection.php';
	
	if(isset($_POST['ProductSubmit']))
       {
        $bc=$_POST['barcode'];    
        $pName=$_POST['ProductName'];
        $cat=$_POST['select_cat'];
        $scat=$_POST['radio_sc'];
        $supp=$_POST['supp'];
        $sp=$_POST['StandardPrice'];
        $lp=$_POST['ListPrice'];
        $disc = 0;
        $storedFile="images/products/".basename($_FILES["img_save"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $storedFile);
        mysql_query("INSERT into tbl_products VALUES('$bc','$pName','$cat','$scat','$supp',$sp,$lp,$disc,'$storedFile')") or die(mysql_error()); 
        
        echo"
				<script type='text/javascript'>
					alert('Product Successfully Added!');
					open('products.php','_self');
				</script>
			";


      }

	//Adding Category
	if (isset($_POST['CategorySubmit'])) {
		$category_name=$_POST['Category'];
		echo $sc_val = $_POST['SC_v'];
		$query1="SELECT * from tbl_category WHERE Category_Name='$category_name'";
		$result1=mysql_query($query1);
		$record=mysql_num_rows($result1);
		if($record<=0){
			$query2="INSERT into tbl_category(Category_Name)VALUES('$category_name')";
			mysql_query($query2);
			$id = mysql_insert_id();
			for($i=1; $i <= $sc_val ; $i++) { 
				$sc = $_POST["SC{$i}"];
				$query_sub = "INSERT into tbl_subcategory(Category_ID,SubCategory_Name)VALUES($id,'$sc')";
				mysql_query($query_sub);
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
		
	}
		
?>