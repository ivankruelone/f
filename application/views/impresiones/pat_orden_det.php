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
$pdf->SetMargins(PDF_MARGIN_LEFT, 35, PDF_MARGIN_RIGHT); 
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER); 
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER); 

//set auto page breaks 
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 

//set image scale factor 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  

//set some language-dependent strings 
$pdf->setLanguageArray($l);  
$id_userx= $this->session->userdata('id').'.png';
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
$e='';
$f='';
$totfal=0;$totimp=0;
       $s = "select *from almacen.compra_det where id_cc=$id_cc order by id";
       $q = $this->db->query($s);
       $e.="<table  border=\"1\" cellpadding=\"4\">
          ";
        
        $firma= '<img src="img/'.$id_userx.'" border="0" width="100px" />';
         foreach($q->result() as $r)
        {
       $e.="
            <tr>
            <td width=\"100\" align=\"left\">".$r->cod."</td>
            <td width=\"300\" align=\"left\">".$r->descri."</td>
            <td width=\"70\" align=\"right\">".number_format($r->can,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($r->costo,2)."</td>
            <td width=\"70\" align=\"right\">".number_format(($r->costo*$r->can),0)."</td>
            </tr>
            ";   
            
        $totfal=$totfal+$r->can; 
        $totimp=$totimp+($r->can*$r->costo); 
        }
        
       $e.="
        <tr bgcolor=\"#E6E6E6\"><br />
        <td width=\"470\" align=\"right\"><strong>TOTAL CANTIDAD</strong></td>
        <td width=\"70\" align=\"right\"><strong>".number_format($totfal,0)."</strong></td>
        <td width=\"70\" align=\"right\"><strong>".number_format($totimp,2)."</strong></td>
          </tr>
        </table>
        <table cellpading?=\"3\">
        <tr>
          <td  width=\"610\" align=\"center\"></td>
          </tr>
          <tr>
          <td  width=\"610\" align=\"center\">COMPRADOR</td>
          </tr>
          <tr>
          <td  width=\"610\" align=\"center\">$firma</td>
          </tr>
          <tr>
          <td  width=\"610\" align=\"center\">________________________________</td>
          </tr>
          <tr>
          <td  width=\"610\" align=\"center\">Lic. Rosa Mireyee Silva Perez</td>
          </tr>
          <tr>
          <td  width=\"610\" align=\"center\">COMPRADOR DE MEDICAMENTO PATENTADO</td>
          </tr>
          
          </table>
        ";
// ---------------------------------------------------------
// ---------------------------------------------------------  
//echo $e;
//die();
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
$pdf->Output('orden.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+