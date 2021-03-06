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

//set some language-dependent strings 
$pdf->setLanguageArray($l);  

// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
$e='';
$f='';
$totfal=0;
$numero=1;
       $s = "select a.* from pedidos a 
        left join catalogo.folio_pedidos_cedis_especial d on d.id=a.fol
       where a.fol=$fol and a.tipo=1 and a.sur>0
       order by a.mue, a.sec";
       $q = $this->db->query($s);
       $e.="<table  border=\"1\" cellpadding=\"4\">
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
            <td width=\"70\" align=\"right\">".number_format($r->sur,0)."</td>
            </tr>
            ";   
        $numero=$numero+1;    
        $totfal=$totfal+$r->sur; 
        }
        
       $e.="
        <tr bgcolor=\"#E6E6E6\"><br />
        <td width=\"610\" align=\"right\"><strong> PRODUCTOS...: $numero ______ TOTAL CANTIDAD</strong></td>
        <td width=\"70\" align=\"right\"><strong>".number_format($totfal,0)."</strong></td>
         </tr>
        </table>";
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

// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------



//Close and output PDF document
$pdf->Output('pedido_previo.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+