<?php
global $cabezota;

$cabezota=$cabeza;

require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');
require_once('mypdf.php');

// create new PDF document 
$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

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
$pdf->SetMargins(PDF_MARGIN_LEFT, 60, PDF_MARGIN_RIGHT); 
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER); 
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER); 

//set auto page breaks 
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 

//set image scale factor 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  

//set some language-dependent strings 
$pdf->setLanguageArray($l);  

// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// --------------------------------------------------------
 $dianombre=date('D');  
 $num=1;       
        $x="select *from catalogo.dias where par='$dianombre'";
        $z = $this->db->query($x);
        $y=$z->row(); 
        $diax=$y->dia;
		$fecha = date('Y-m-d');
        $sx = "sELECT * FROM 
        catalogo.sucursal 
        where dia='$diax' and suc not in (select suc from pedidos where fechas between '$fecha' and '$fecha 23:59:59')";
        $qx = $this->db->query($sx);
        
        
$tabla='<table>';
        foreach($qx->result() as $rx)
        {    
            
            $fol=0;
            $fechas=0;
            $ped=0;
            $tabla.="
            <tr>
            <td align=\"left\" width=\"30\">".$num."</td>
            <td align=\"center\" width=\"40\">".$rx->tipo2."</td>
            <td align=\"left\" width=\"200\">".$rx->suc." - ".$rx->nombre."</td>
            </tr>
            ";
         $num=$num+1;
        }
        $tabla.="
        <tr>
        <td width=\"680\" align=\"center\">ATENTAMENTE<br /><br /><br /><br /><br /><br /></td>
        </tr>
        <tr>
        <td width=\"680\" align=\"center\">__________________________________________________________________</td>
        </tr>
        
        <tr>
        <td width=\"680\" align=\"center\">LIC. CARLOS ALBERTO CANSECO ORTEGA</td>
        </tr>
        <tr>
        <td width=\"680\" align=\"center\">GERENTE DE SISTEMAS</td>
        </tr>
        </table>"; 
// ---------------------------------------------------------
// ---------------------------------------------------------
// -----------------------------------------------------------------------------
$pdf->AddPage();
$tbl = <<<EOD
$tabla
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
$e='';
// -----------------------------------------------------------------------------



//Close and output PDF document
$pdf->Output($nomarchivo, $salida);

//============================================================+
// END OF FILE                                                 
//============================================================+