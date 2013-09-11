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
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);

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
$pdf->SetMargins(5, PDF_MARGIN_TOP, 5);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings

// ---------------------------------------------------------

// set font
$pdf->SetFont('freemono', 'BI', 8);

$cuantos = count($datos);
$modulo = $cuantos % 2;
$hasta = ($cuantos - $modulo) / 2;


    
    $j = 0;
    
    for($i = 1; $i <= $hasta; $i++)
    {
        $a = "<table cellpadding=\"30\">
        <tr>
        <td style=\"border-right: silver; border-right-color: silver; border-right-width: 1px; border-right-style: dashed;\">".$datos[$j]."</td>";
        $j++;
        $a.="
        <td>".$datos[$j]."</td>
        </tr>
        </table>";
        $j++;
        
$pdf->AddPage();
$tbl = <<<EOD
$a
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

//echo $a;
    }

if($modulo == 1){
    $pdf->AddPage();

        $a = "<table>
        <tr>
        <td>".$datos[$cuantos - 1]."</td>";
        $j++;
        $a.="
        <td>&nbsp;</td>
        </tr>
        </table>";


$tbl = <<<EOD
$a
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');


}


/***
$ret = count($retardos);
$fal = count($faltas);

$pdf->SetFont('helvetica', 'BI', 8);

if($ret > 0)
{
    
    
    for($k = 1; $k <= $ret; $k++)
    {
        $pdf->AddPage();
        
        $b = $retardos[$k - 1];

$tbl = <<<EOD
$b
EOD;
        $pdf->writeHTML($tbl, true, false, false, false, '');
    }
}


if($fal > 0)
{
    
    
    for($k = 1; $k <= $fal; $k++)
    {
        $pdf->AddPage();
        
        $b = $faltas[$k - 1];

$tbl = <<<EOD
$b
EOD;
        $pdf->writeHTML($tbl, true, false, false, false, '');
    }
}

*/


// add a page
$pdf->AddPage();

$pdf->SetFont('helvetica', '', 20);

$tbl = <<<EOD
$justificaciones
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->AddPage();

$pdf->SetFont('helvetica', '', 20);

$tbl = <<<EOD
$faltasyretardos
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->AddPage();

$pdf->SetFont('helvetica', '', 20);

$tbl = <<<EOD
$faltasyretardos
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('reporte_asistencias.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+