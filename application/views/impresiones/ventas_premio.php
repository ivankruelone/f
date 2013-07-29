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

$this->SetFont('helvetica', '', 7	);
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
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

// set document information 
$pdf->SetCreator(PDF_CREATOR); 
$pdf->SetAuthor('Lidia Velazquez'); 
$pdf->SetTitle('Premio'); 
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
$pdf->SetMargins(PDF_MARGIN_LEFT, 12, PDF_MARGIN_RIGHT); 
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
$fin='';
// ---------------------------------------------------------
$totplaf=0;
$totperf=0;
$totsupf=0;
$totgerf=0;
$s0="select *from comision_ctl where motivo='premio' and fecha='$fec' and tipo='C' and ger>0 group by ger";
       $q0 = $this->db->query($s0);
foreach($q0->result() as $r0)
         {
$e='';
$f='';
$totpla=0;
$totper=0;
$totsup=0;
$totger=0;
       $s = "select d.completo as gerx,d.importe as imp_ger, c.completo as supx,c.importe as imp_sup,
       b.nombre as sucx, a.*,b.plantilla,
       (select count(*) from comision_det aa where aa.fecha='$fec' and a.suc=aa.suc and motivo='premio' and tipo='C')as persona
        from comision_ctl a
       left join catalogo.sucursal b on a.suc=b.suc
       left join comision_det c on c.suc=a.suc and c.fecha=a.fecha and c.motivo='premios' and c.tipo='C'
       left join comision_det d on d.suc=a.suc and d.fecha=a.fecha and d.motivo='premiog' and d.tipo='C'
       where a.fecha='$fec' and a.tipo='C' and a.ger=$r0->ger  and a.motivo='premio' order by a.sup,a.suc";
       
       $q = $this->db->query($s);
       $e.="<table  border=\"1\" cellpadding=\"4\">
          <tr>
           <th width=\"250\" align=\"center\"><strong>SUPERVISOR</strong></th>
           <th width=\"40\" align=\"center\"><strong>NID</strong></th>
           <th width=\"140\" align=\"center\"><strong>SUCURSAL</strong></th>
           <th width=\"90\" align=\"center\"><strong>HIS.VENTA</strong></th>
           <th width=\"90\" align=\"center\"><strong>GONTOR<br />IMPERIAL</strong></th>
           <th width=\"60\" align=\"left\"><strong>PREMIO<br />EN DIAS</strong></th>
           <th width=\"80\" align=\"left\"><strong>PLANTILLA<br />ACTUAL</strong></th>
           <th width=\"85\" align=\"left\"><strong>PLANTILLA<br />AUTORIZADA</strong></th>
           <th width=\"85\" align=\"left\"><strong>PREMIO<br />SUPERVISOR</strong></th>
           
          </tr>      
          ";
        
        
         foreach($q->result() as $r)
         {
          
       $e.="
            <tr>
            <td width=\"250\" align=\"left\">".$r->supx."</td>
            <td width=\"40\" align=\"left\">".$r->suc."</td>
            <td width=\"140\" align=\"left\">".$r->sucx."</td>
            <td width=\"90\" align=\"right\">".number_format($r->base,2)."</td>
            <td width=\"90\" align=\"right\">".number_format($r->importe,2)."</td>
            <td width=\"60\" align=\"right\">".number_format($r->comision,0)."</td>
            <td width=\"80\" align=\"right\">".number_format($r->persona,0)."</td>
            <td width=\"85\" align=\"right\">".number_format($r->plantilla,0)."</td>
            <td width=\"85\" align=\"right\">".number_format($r->imp_sup,2)."</td>
            </tr>
            ";   
            
        $totpla=$totpla+$r->plantilla; 
        $totper=$totper+$r->persona; 
        $totsup=$totsup+$r->imp_sup;
        $totger=$totger+$r->imp_ger;
        $totplaf=$totplaf+$r->plantilla; 
        $totperf=$totperf+$r->persona; 
        $totsupf=$totsupf+$r->imp_sup;
        $totgerf=$totgerf+$r->imp_ger;  
        }
        
       $e.="
        <tr bgcolor=\"#E6E6E6\">
        <td width=\"670\" align=\"right\"><strong>TOTAL CANTIDAD</strong></td>
        <td width=\"80\" align=\"right\"><strong>".number_format($totper,0)."</strong></td>
        <td width=\"85\" align=\"right\"><strong>".number_format($totpla,0)."</strong></td>
        <td width=\"85\" align=\"right\"><strong>".number_format($totsup,2)."</strong></td>
         </tr>
         <tr bgcolor=\"#E6E6E6\">
         <td width=\"250\" align=\"left\"><strong># DE EMPLEADOS : ".number_format($totper)."</strong></td>
         <td width=\"306\" align=\"left\"><strong>IMPORTE A SUPERVISORES  $ ".number_format($totsup,2)."</strong></td>
         <td width=\"363\" align=\"left\"><strong>GERENTE REGIONAL ".$r->gerx." $ ".number_format($totger,2)."</strong></td>
         </tr>
         <tr>
         <td width=\"460\" align=\"center\"><strong>AUTORIZADO<br /><br /><br /><br /><br />
         LIC. GERARDO GONZALEZ ZIRION<br />DIRECCION DE VENTAS</strong></td>
         <td width=\"460\" align=\"center\"><strong>AUTORIZADO<br /><br /><br /><br /><br />
         LIC. FERNANDO FIERRO MEDEL<br />GERENCIA COMERCIAL</strong></td>
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
}
// -----------------------------------------------------------------------------
// ---------------------------------------------------------  
$fin="<table border=\"1\"  cellpadding=\"5\">
         <tr bgcolor=\"#E6E6E6\">
         <td width=\"920\" align=\"center\"><strong> TOTAL GENERAL</strong></td>
         </tr>  
         <tr>
         <td width=\"200\" align=\"left\"><strong></strong></td>
         <td width=\"100\" align=\"right\"><strong>EMPLEADOS</strong></td>
         <td width=\"100\" align=\"right\"><strong>IMPORTE</strong></td>
         <td width=\"520\" align=\"right\"><strong></strong></td>
         </tr>
         <tr>
         <td width=\"200\" align=\"left\"><strong># DE EMPLEADOS</strong></td>
         <td width=\"100\" align=\"right\"><strong>".number_format($totperf,0)."</strong></td>
         <td width=\"100\" align=\"right\"><strong></strong></td>
         <td width=\"520\" align=\"right\"><strong></strong></td>
         </tr>
         <tr>
         <td width=\"200\" align=\"left\"><strong>IMPORTE A SUPERVISORES</strong></td>
          <td width=\"100\" align=\"right\"><strong></strong></td>
         <td width=\"100\" align=\"right\"><strong>$ ".number_format($totsupf,2)."</strong></td>
         <td width=\"520\" align=\"right\"><strong></strong></td>
         </tr>
         <tr>
         <td width=\"200\" align=\"left\"><strong>GERENTE REGIONAL</strong></td>
          <td width=\"100\" align=\"right\"><strong></strong></td>
         <td width=\"100\" align=\"right\"><strong>$ ".number_format($totgerf,2)."</strong></td>
         <td width=\"520\" align=\"right\"><strong></strong></td>
         </tr>
         <tr  bgcolor=\"#E6E6E6\">
         <td width=\"200\" align=\"left\"><strong>TOTAL GENERAL</strong></td>
          <td width=\"100\" align=\"right\"><strong></strong></td>
         <td width=\"100\" align=\"right\"><strong>$ ".number_format($totsupf+$totgerf,2)."</strong></td>
         <td width=\"520\" align=\"right\"><strong></strong></td>
         </tr>
         <tr>
         <td width=\"460\" align=\"center\"><strong>AUTORIZADO<br /><br /><br /><br /><br />LIC. GERARDO GONZALEZ ZIRION<br />DIRECCION DE VENTAS</strong></td>
          <td width=\"460\" align=\"center\"><strong>AUTORIZADO<br /><br /><br /><br /><br />LIC. FERNANDO FIERRO MEDEL<br />GERENCIA COMERCIAL</strong></td>
         </tr>
        </table> 
        ";
// set font


$pdf->SetFont('helvetica', '', 9	);

$pdf->AddPage();
$tbl = <<<EOD
$fin
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------



//Close and output PDF document
$pdf->Output('premios.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+