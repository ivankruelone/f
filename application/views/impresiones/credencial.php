<?php
global $cabezota;



require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');



// create new PDF document 
$pdf = new TCPDF('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false); 

// set document information 
$pdf->SetCreator(PDF_CREATOR); 
$pdf->SetAuthor('Ivan Zuñiga Perez'); 
$pdf->SetTitle('Credencial'); 
$pdf->SetSubject('Recursos humanos'); 
$pdf->SetKeywords('Credencial'); 

// set default header data 
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING); 

// set header and footer fonts 
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN)); 
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
//set margins 
$pdf->SetMargins(5, 0, 0, 0);
$pdf->SetHeaderMargin(0); 
$pdf->SetFooterMargin(0); 

//set auto page breaks 
$pdf->SetAutoPageBreak(TRUE, 0); 

//set image scale factor 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  

//set some language-dependent strings 
$pdf->setLanguageArray($l);  

// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------

$pdf->SetFont('helvetica', '', 8	);
$pdf->AddPage();
$tbl = <<<EOD
$detalle
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');


//-----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------



//Close and output PDF document
$pdf->Output('credencial.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+