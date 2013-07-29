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
$pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT); 
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

$f='';
$totped=0; 
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
       $s0 = "select a.*, sum(a.ped)as ped 
       from pedidos a 
       left join catalogo.folio_pedidos_cedis d on d.id=a.fol
       where a.fechas between '$fecha' and '$fecha 23:59:59' and tipo=1 and ped>0  and invcedis>0 and fol<11000000 group by sec order by mue,sec";
        $q0 = $this->db->query($s0);
           $f.="<table border=\"1\" cellpadding=\"1\">
          
          ";
        
        $num=1;
         foreach($q0->result() as $r0)
         {
        
       $f.="
            <tr>
            <td width=\"50\" align=\"center\">".$r0->mue."</td>
            <td width=\"70\" align=\"center\">".$r0->sec."</td>
            <td width=\"400\" align=\"left\">".$r0->susa."</td>
            <td width=\"70\" align=\"right\">".number_format($r0->ped,0)."</td>
            </tr>";   
            
        $num=$num+1; 
        $totped=$totped+$r0->ped; 
         
        }
        
       $f.="
        <tr bgcolor=\"#E6E6E6\"><br />
        <td width=\"520\" align=\"right\"><strong>TOTAL CANTIDAD</strong></td>
        <td width=\"70\" align=\"right\"><strong>".number_format($totped,0)."</strong></td>
        </tr>
        </table>";
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------  
// set font
$pdf->SetFont('helvetica', '', 7	);

// -----------------------------------------------------------------------------
$pdf->AddPage();
$tbl = <<<EOD
$f
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------



//Close and output PDF document
$pdf->Output($nomarchivo, $salida);

//============================================================+
// END OF FILE                                                 
//============================================================+