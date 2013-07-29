<?php
global $cabezota;



require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');



// create new PDF document 
$pdf = new TCPDF('L', PDF_UNIT, 'LETTER', true, 'UTF-8', false); 

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
$e = '
<table style="width: 100%; height: 100%;">
    <tr>
        <td style="border-bottom: black; border-right-style: dashed; border-bottom-style: dashed; border-bottom-width: 1px;">
        <br />
        <br />
        <div style="width: 100%;" align="center">Copia Recursos Humanos</div>
        '.$detalle.'
        <br />
        <br />
        </td>
        <td style="border-bottom: black; border-bottom-style: dashed; border-bottom-width: 1px;">
        <br />
        <br />
        <div style="width: 100%;" align="center">Copia Nominas</div>
        '.$detalle.'
        <br />
        <br />
        </td>
    </tr>
    <tr>
        <td style="border-right-style: dashed;">
        <br />
        <br />
        <div style="width: 100%;" align="center">Copia Archivo</div>
        '.$detalle.'
        </td>
        <td>
        <br />
        <br />
        <div style="width: 100%;" align="center">Copia Empleado</div>
        '.$detalle.'
        </td>
    </tr>
</table>';

$pdf->SetFont('helvetica', '', 8	);
$e = utf8_encode($e);
$pdf->AddPage();
$tbl = <<<EOD
$e
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');


//-----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------



//Close and output PDF document
$pdf->Output('pedido.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+