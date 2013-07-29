<?php
//============================================================+
// File name   : example_002.php
// Begin       : 2008-03-04
// Last Update : 2010-08-08
//
// Description : Example 002 for TCPDF class
//               Removing Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com s.r.l.
//               Via Della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Removing Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

require_once('tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF('L', PDF_UNIT, 'LETTER', true, 'UTF-8', false);

// set document information
$pdf->SetCreator('Ivan Zuniga Perez');
$pdf->SetAuthor('Ivan Zuniga Perez');
$pdf->SetTitle('Ivan Zuniga Perez');
$pdf->SetSubject('Ivan Zuniga Perez');
$pdf->SetKeywords('Ivan Zuniga Perez');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 8);
$pdf->AddPage();


foreach($query->result() as $row){

$reporte = $this->checador_model->get_reporte_juntificacion2_marysol($quincena, $row->succ);

// add a page
$tbl = <<<EOD
<p style="text-align: center;"><b>$row->succ - $row->nombre</b></p>
<p>Periodo: $perini al $perfin</p>
$reporte
EOD;


$pdf->writeHTML($tbl, true, false, false, false, '');


    
}

//Close and output PDF document
$pdf->Output('reporte_justificaciones.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+