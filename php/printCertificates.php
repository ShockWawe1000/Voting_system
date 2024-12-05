
<?php

// https://github.com/gitcodes
// taken from his repo and edited


session_start();
require('fpdf181/fpdf.php'); 


$endorsement = $_SESSION["certEnd"] ;
$fullname = $_SESSION["certName"] ;

    class PDF extends FPDF
    {
        function Footer()
        {
            $this->SetY(-27);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'This certificate has been © produced by thetutor edited by Edis Usein', 0, 0, 'R');
        }
    }

    // Create PDF instance
    $pdf = new FPDF('L', 'pt', 'A4');
    $pdf->SetTopMargin(20);
    $pdf->SetLeftMargin(20);
    $pdf->SetRightMargin(20);
    $pdf->AddPage();
    $pdf->Image("fpdf181/cert2.png", 20, 20, 780); 
    $pdf->Image("fpdf181/logo.png", 140, 280, 240); 

    // Print certificate details
    $pdf->SetFont('times', 'B', 80);
    $pdf->Cell(720 + 10, 200, "CERTIFICATE", 0, 0, 'C');
   
   
    $pdf->SetFont('Arial', 'I', 34);
    $pdf->SetXY(370, 220);
    $pdf->Cell(350, 25, $fullname, "B", 0, 'C', 0);

  


    $pdf->SetFont('Arial', 'I', 14);
    $pdf->SetXY(370, 280);
    $message = "FOR BEING THE";
    $pdf->MultiCell(350, 14, $message, 0, 'C', 0);

    $pdf->SetFont('Arial', 'I', 44);
    $pdf->SetXY(370, 420);
    $pdf->Cell(350, -35, $endorsement, "T", 0, 'C', 0);

    
    $pdf->Output();


?>


