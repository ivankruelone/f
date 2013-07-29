<?php
global $cabezota;

$cabezota=$cabeza;

require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');


// Extend the TCPDF class to create custom Header and Footer 
class MYPDF extends TCPDF { 
   	
    
    public function Header() { 


/////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////
global $cabezota;

$this->SetFont('helvetica', '', 8	);
$tbl = <<<EOD
$cabezota
EOD;
$this->writeHTML($tbl, true, false, false, false, '');
    } 
     
    // Page footer 
    public function Footer() { 
        // Position at 1.5 cm from bottom 
        $this->SetY(-15); 
        // Set font 
        $this->SetFont('helvetica', 'I', 9); 
        // Page number 
        $this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'C'); 
    } 
} 

// create new PDF document 
$pdf = new MYPDF('L', PDF_UNIT, 'LETTER', true, 'UTF-8', false); 

// set document information 
$pdf->SetCreator(PDF_CREATOR); 
$pdf->SetAuthor('Lidia Velazquez'); 
$pdf->SetTitle('Cueque'); 
$pdf->SetSubject('TCPDF Tutorial'); 
$pdf->SetKeywords('TCPDF, PDF, example, test, guide'); 

// set default header data 
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING); 

// set header and footer fonts 
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN)); 
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins 
$pdf->SetMargins(8, 30, PDF_MARGIN_RIGHT); 
$pdf->SetHeaderMargin(15); 
$pdf->SetFooterMargin(5); 

//set auto page breaks 
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 

//set image scale factor 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  

$pdf->SetFont('helvetica', '', 6	);

$pdf->AddPage();

$tbl = <<<EOD
$detalle
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->AddPage();
$pdf->SetFont('helvetica', '', 10	);
$tbl = <<<EOD
$detalle1
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->AddPage();
$pdf->SetFont('helvetica', '', 6	);
$tbl = <<<EOD
$detalle_esp
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->AddPage();
$pdf->SetFont('helvetica', '', 10	);
$tbl = <<<EOD
$detalle_esp1
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->AddPage();
$pdf->SetFont('helvetica', '', 10	);
$tbl = <<<EOD
$detalle_total
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('pedido.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+