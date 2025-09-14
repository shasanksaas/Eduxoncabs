<?php
date_default_timezone_set('Asia/Kolkata'); // Change to your preferred timezone

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'vendor/autoload.php';


use TCPDF;

// Create new PDF document
$pdf = new TCPDF();
$pdf->SetCreator('TCPDF');
$pdf->SetAuthor('Eduxoncabs');
$pdf->SetTitle('Invoice 5896');
$pdf->SetMargins(15, 20, 15);
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 10);

// Header
$pdf->Cell(0, 10, 'Invoice No: 5896', 0, 1, 'L');
$pdf->Cell(0, 10, 'Booking Date: 2020-01-08 8:00', 0, 1, 'L');
$pdf->Ln(4);

// Booking For
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 6, 'Booking For: Maruti Suzuki Dzire', 0, 1, 'L');
$pdf->Ln(2);

// Company Address
$pdf->SetFont('helvetica', '', 10);
$pdf->MultiCell(90, 5, "Company Address\nRoom No:116, Bharati Tower,\nForest Park, Aerodrome Area,\nBhubaneswar, Odisha 751020", 1);
$pdf->Ln(1);

// Billing To
$pdf->MultiCell(90, 5, "Billing To\nName: Ravikant Choudhary\nContact No: 7351716388\nEmail: mailto:choudhary.ravikant@gmail.com", 1);
$pdf->Ln(1);

// Rental Duration
$pdf->MultiCell(90, 5, "Rental Duration\nFrom: 2020-01-08 8:00 To: 2020-01-09 23:00", 1);

// Delivery Location
$pdf->MultiCell(90, 5, "Delivery Location\nBharti Tower, Airport Road,\nForest Park, Bhubaneswar, Odisha", 1);
$pdf->Ln(2);

// Order Summary
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 6, 'Order Summary', 0, 1, 'L');
$pdf->SetFont('helvetica', '', 10);
$pdf->MultiCell(0, 5, "Vehicle Type: Car\nVehicle Name: Maruti Suzuki Dzire\n\nPrice For 24 Hours Regular days: Rs.1790\nPrice For 24 Hours Weekend days: Rs.1920\n\nTotal Regular Days Hours: 39 hour total 2909\nTotal: Rs.2908.00\nPayment Received: Rs.2908.00", 0, 'L');
$pdf->Ln(2);

// Terms & Conditions
$pdf->SetFont('helvetica', 'I', 9);
$pdf->MultiCell(0, 5, "Terms & Conditions\nPlease read carefully from Eduxoncabs Website/App all terms & conditions before vehicle Pickup", 0, 'L');

// Output PDF
$pdf->Output('invoice_5896.pdf', 'I');
?>
