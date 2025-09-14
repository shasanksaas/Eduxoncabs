<?php
require_once __DIR__ . '/vendor/autoload.php';

use Mpdf\Mpdf;

// Initialize mPDF
$mpdf = new Mpdf();

// Load HTML file
$html = "Mpdf welcomes you";

// Convert to PDF
$mpdf->WriteHTML($html);
$mpdf->Output('invoice.pdf', 'I');  // Save to folder

echo "PDF generated successfully!";
?>
