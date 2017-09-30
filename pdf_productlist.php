<?php
	session_start();
	require("fpdf181/fpdf.php");
	require("connection.php");
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',16);
	$pdf->Cell(0,8,'EC New Deal Supermarket',0,0,'C');
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(0,8,'A.B Fernendez Ave.,Dagupan City,2400',0,0,'C');
	$pdf->Ln(20);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(0,8,'Date:'.date('d-m-Y').'',0,0,'R');
	$pdf->Ln(15);

	$pdf->Cell(0,8,'Product List',1,0,'C');
	$pdf->Ln(20);
	$pdf->Cell(30,8,'Barcode','B');
	$pdf->Cell(30,8,'Name','B');
	$pdf->Cell(30,8,'Category','B');
	$pdf->Cell(30,8,'Sub Category','B');
	$pdf->Cell(30,8,'Standard Price','B');
	$pdf->Cell(30,8,'List Price','B');
	$pdf->Ln(8);



	$sql=mysqli_query($open_connection,"SELECT product_ID,barcode,product_name,p.Category_ID,Category_Name,p.SCat_ID,SubCategory_Name,s.supplier_ID,supplier_name,standard_price,list_price,discontinue,image FROM tbl_products p INNER JOIN tbl_category USING(`Category_ID`) INNER JOIN tbl_subcategory USING (`SCat_ID`) Inner JOIN tbl_supplier s USING (`supplier_ID`) ORDER BY product_ID ASC");
	while($row = mysqli_fetch_array($sql)){
		$pdf->Cell(30,8,$row['barcode'],'B');
		$pdf->Cell(30,8,$row['product_name'],'B');
		$pdf->Cell(30,8,$row['Category_Name'],'B');
		$pdf->Cell(30,8,$row['SubCategory_Name'],'B');
		$pdf->Cell(30,8,$row['standard_price'],'B');
		$pdf->Cell(30,8,$row['list_price'],'B');
		$pdf->Ln();
		
	}
	
	$pdf->Output();
?>