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
  $pdf->Cell(30,8,'Supplier Name','B');
  $pdf->Cell(90,8,'Address','B');
  $pdf->Cell(30,8,'Landline','B');
  $pdf->Cell(30,8,'Mobile','B');
  
  $pdf->Ln(8);

  $sql=mysqli_query($open_connection,"SELECT * FROM tbl_supplier");
  while($row = mysqli_fetch_array($sql)){
    $pdf->Cell(30,8,$row['supplier_name'],'B');
    $pdf->Cell(90,8,$row['address'],'B');
    $pdf->Cell(30,8,$row['landline'],'B');
    $pdf->Cell(30,8,$row['contact_no'],'B');
    $pdf->Ln();
    
  }
  
  $pdf->Output();
?>