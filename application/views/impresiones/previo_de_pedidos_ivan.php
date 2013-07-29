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
$pdf->SetMargins(PDF_MARGIN_LEFT, 38, PDF_MARGIN_RIGHT); 
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER); 
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER); 

//set auto page breaks 
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 

//set image scale factor 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  


// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
$e='';
$f='';
$totfal=0; 
       $s = "select * from pedidos where fol = $fol and tipo = 1 and ped > 0  and mue <> 6  and invcedis>0 order by mue, sec";
        $q = $this->db->query($s);
        $numrows = $q->num_rows();
        
        if($numrows > 0){
        
           $e.="<table border=\"1\" cellpadding=\"4\">
          
          ";
        
        
         foreach($q->result() as $r)
         {
          $sx = "select *from catalogo.almacen where sec=$r->sec and tsec='G'";
          $qx = $this->db->query($sx);   
          if($qx->num_rows() > 0){
            $rx=$qx->row();
            $des=$rx->susa2;
            }else{
            $des='';    
            }
       $e.="
            <tr>
            <td width=\"40\" align=\"center\">".$r->mue."</td>
            <td width=\"40\" align=\"left\">".$r->sec."</td>
            <td width=\"310\" align=\"left\">".$r->susa."</td>
            <td width=\"220\" align=\"left\">".$des."</td>
            <td width=\"70\" align=\"right\">".number_format($r->ped,0)."</td>
            </tr>
            ";   
            
         
        $totfal=$totfal+$r->ped; 
        }
        
       $e.="
        <tr bgcolor=\"#E6E6E6\"><br />
        <td width=\"610\" align=\"right\"><strong>TOTAL CANTIDAD</strong></td>
        <td width=\"70\" align=\"right\"><strong>".number_format($totfal,0)."</strong></td>
         </tr>
        </table>";

// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------  
// set font
$pdf->SetFont('helvetica', '', 9	);

$pdf->AddPage();
$tbl = <<<EOD
$e
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
$e='';
// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------



//Close and output PDF document
$pdf->Output($nomarchivo, 'F');

}
//============================================================+
// END OF FILE                                                 
//============================================================+