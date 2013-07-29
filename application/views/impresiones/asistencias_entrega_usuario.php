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
$pdf->SetFont('helvetica', '', 12);

foreach($query->result() as $row)
{
    $a = "<table>
    <tr>
    <td colspan=\"2\" style=\"text-align: center;\" height=\"50px\"><b>FARMACIAS EL FENIX DEL CENTRO SA DE CV</b></td>
    </tr>
    <tr>
    <td width=\"15%\">Depto.: </td>
    <td width=\"85%\"><b>$row->sucursal</b></td>
    </tr>
    <tr>
    <td width=\"15%\"># Nomina: </td>
    <td><b>$row->nomina</b></td>
    </tr>
    <tr>
    <td>Nombre: </td>
    <td><b>$row->completo</b></td>
    </tr>
    <tr>
    <td>Usuario: </td>
    <td><b>$row->nomina</b></td>
    </tr>
    <tr>
    <td>Contrase&ntilde;a: </td>
    <td><b>$row->pass</b></td>
    </tr>
    <tr>
    <td>Direcci&oacute;n: </td>
    <td><b>http://201.151.238.53/ &oacute; http://www.sistemasfenix.com.mx</b></td>
    </tr>
    <tr>
    <td colspan=\"2\" style=\"text-align: center;\">&nbsp;</td>
    </tr>
    <tr>
    <td colspan=\"2\" style=\"text-align: center;\">___________________________________</td>
    </tr>
    <tr>
    <td colspan=\"2\" style=\"text-align: center;\">Nombre y firma de quien recibe</td>
    </tr>
    </table>";
    
    $b = "<table cellpadding=\"30px\">
    <tr>
    <td height=\"400px\" style=\"border-bottom-color: black; border-bottom-style: dashed; border-bottom-width: 1px;\">$a<p style=\"text-align: center;\">Copia Empleado</p></td>
    </tr>
    <tr>
    <td>$a<p style=\"text-align: center;\">Copia Recursos Humanos</p></td>
    </tr>
    </table>";
    
$tbl = <<<EOD
$b
EOD;
$pdf->AddPage();
$pdf->writeHTML($tbl, true, false, false, false, '');

}

//Close and output PDF document
$pdf->Output('entrega_de_usuarios.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+