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
$totencf=0;
$totjeff=0;
$totcomf=0;
$totsupf=0;
$totgerf=0;
$s0="select a.*,b.nombre as gerx from comision_ctl a left join  usuarios b on b.plaza=a.ger and nivel=21 and activo=1
where a.motivo='comision' and a.fecha='$fec' and a.tipo='C' and a.ger>0 
group by a.ger";
       $q0 = $this->db->query($s0);
foreach($q0->result() as $r0)
         {
$e='';
$f='';
$totcom=0;$totjef=0;$totsup=0;$totger=0;$totenc=0;$totimp=0;
       $s = "select sum(a.importe)as comision, sum(a.i_enc)as imp_enc, sum(a.i_jef)as imp_jef,b.nombre as sucx,c.medico,c.importe,c.base,((c.importe*100)/base)as porce, 
(select importe from comision_det aa where aa.suc=a.suc and aa.fecha=a.fecha and aa.ger=a.ger  and aa.tipo=a.tipo and aa.motivo='comisiong')as imp_ger,
aa.importe as imp_sup,aa.completo as supx	      
	   from comision_det a 
	   left join  comision_det aa on aa.suc=a.suc and aa.fecha=a.fecha and aa.ger=a.ger  and aa.tipo=a.tipo and aa.motivo='comisions'
	   left join catalogo.sucursal b on b.suc=a.suc
	   left join desarrollo.comision_ctl c on c.suc=a.suc and c.fecha=a.fecha and c.motivo=a.motivo and c.tipo='C' 
	   where a.fecha='$fec' and a.ger=$r0->ger  and a.tipo='C' and a.nueva_nomina>0 and a.motivo='comision' 
	   group by a.suc,a.sup order by medico,a.sup";
       
       $q = $this->db->query($s);
       $e.="<table  border=\"1\" cellpadding=\"4\">
          <tr>
           <th width=\"250\" align=\"center\"><strong>SUPERVISOR</strong></th>
           <th width=\"140\" align=\"center\"><strong>SUCURSAL</strong></th>
           <th width=\"90\" align=\"center\"><strong>VTA-T.AIRE<br />DEPTO.CORTES</strong></th>
           <th width=\"90\" align=\"center\"><strong>IMPORTE<br />NATURISTA</strong></th>
           <th width=\"50\" align=\"center\"><strong>%</strong></th>
           <th width=\"60\" align=\"left\"><strong>COMISION<br />EN $</strong></th>
           <th width=\"60\" align=\"left\"><strong>JEF.</strong></th>
           <th width=\"60\" align=\"left\"><strong>ENC.</strong></th>
           <th width=\"60\" align=\"left\"><strong>SUP.</strong></th>
           <th width=\"60\" align=\"left\"><strong>GER.</strong></th>
           
          </tr>      
          ";
        
        
         foreach($q->result() as $r)
         {
            if($r->medico=='S'){$supx='COMISION SOLO PARA MEDICO';$color='red';}
            elseif($r->importe<7000){$supx='LA VENTA NATURISTA FUE MENOR A $ 7000.00';$color='blue';}else{$supx=$r->supx;$color='black';}
       $e.="
            <tr>
            <td width=\"250\" align=\"left\"><font color=\"$color\">".$supx."</font></td>
            <td width=\"140\" align=\"left\"><font color=\"$color\">".$r->sucx."</font></td>
            <td width=\"90\" align=\"right\"><font color=\"$color\">".number_format($r->base,2)."</font></td>
            <td width=\"90\" align=\"right\"><font color=\"$color\">".number_format($r->importe,2)."</font></td>
            <td width=\"50\" align=\"right\"><font color=\"$color\">% ".number_format($r->porce,2)."</font></td>
            <td width=\"60\" align=\"right\"><font color=\"$color\">".number_format($r->comision,2)."</font></td>
            <td width=\"60\" align=\"right\"><font color=\"$color\">".number_format($r->imp_jef,2)."</font></td>
            <td width=\"60\" align=\"right\"><font color=\"$color\">".number_format($r->imp_enc,2)."</font></td>
            <td width=\"60\" align=\"right\"><font color=\"$color\">".number_format($r->imp_sup,2)."</font></td>
            <td width=\"60\" align=\"right\"><font color=\"$color\">".number_format($r->imp_ger,2)."</font></td>
            
            </tr>";   
         $totcom=$totcom+$r->comision;
         $totimp=$totimp+$r->importe;
         $totenc=$totenc+$r->imp_enc;
         $totjef=$totjef+$r->imp_jef;   
         $totsup=$totsup+$r->imp_sup;
         $totger=$totger+$r->imp_ger;
         $totsupf=$totsupf+$r->imp_sup;
         $totgerf=$totgerf+$r->imp_ger;
         $totcomf=$totcomf+$r->comision;
         $totencf=$totencf+$r->imp_enc;
         $totjeff=$totjeff+$r->imp_jef;     
        }
        
       $e.="
         <tr bgcolor=\"#E6E6E6\">
        <td width=\"480\" align=\"right\"><strong>TOTAL </strong></td>
        <td width=\"90\" align=\"right\"><strong>".number_format($totimp,2)."</strong></td>
        <td width=\"50\" align=\"right\"></td>
        <td width=\"60\" align=\"right\"><strong>".number_format($totcom,2)."</strong></td>
        <td width=\"60\" align=\"right\"><strong>".number_format($totjef,2)."</strong></td>
        <td width=\"60\" align=\"right\"><strong>".number_format($totenc,2)."</strong></td>
        <td width=\"60\" align=\"right\"><strong>".number_format($totsup,2)."</strong></td>
        <td width=\"60\" align=\"right\"><strong>".number_format($totger,2)."</strong></td>
         </tr>
        <tr bgcolor=\"#E6E6E6\">
        <td width=\"860\" align=\"right\"><strong>".$r0->gerx." </strong></td>
        <td width=\"60\" align=\"right\"><strong>".number_format($totger,2)."</strong></td>
         </tr>
         <tr>
         <td width=\"460\" align=\"center\"><strong>AUTORIZADO<br /><br /><br /><br /><br />
         LIC. XAVIER GONZALEZ ZIRION<br />DIRECTOR GENERAL</strong></td>
         <td width=\"460\" align=\"center\"><strong>AUTORIZADO<br /><br /><br /><br /><br />
         LIC. FERNANDO FIERRO MEDEL<br />GERENCIA COMERCIAL</strong></td>
         </tr>
         
        </table>";

// ---------------------------------------------------------
// ---------------------------------------------------------  

// ---------------------------------------------------------
// ---------------------------------------------------------  
// set font
$pdf->SetFont('helvetica', '', 8	);

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
         <td width=\"310\" align=\"right\"><strong></strong></td>
         <td width=\"200\" align=\"left\"><strong></strong></td>
         <td width=\"100\" align=\"right\"><strong>IMPORTE</strong></td>
         <td width=\"310\" align=\"right\"><strong></strong></td>
         </tr>
         <tr>
         <td width=\"310\" align=\"right\"><strong></strong></td>
         <td width=\"200\" align=\"left\"><strong>10% EMPLEADOS DE FARMACIA</strong></td>
         <td width=\"100\" align=\"right\"><strong>".number_format($totcomf,2)."</strong></td>
         <td width=\"310\" align=\"right\"><strong></strong></td>
         </tr>
         <tr>
         <td width=\"310\" align=\"right\"><strong></strong></td>
         <td width=\"200\" align=\"left\"><strong>COMISION A JEFES 0.5% A CADA JEFE, SI HAY MAS DE 2 JEFES SE DIVIDE EL 1% ENTRE TODOS</strong></td>
         <td width=\"100\" align=\"right\"><strong>$ ".number_format($totjeff,2)."</strong></td>
         <td width=\"310\" align=\"right\"><strong></strong></td>
         </tr>
         <tr>
         <td width=\"310\" align=\"right\"><strong></strong></td>
         <td width=\"200\" align=\"left\"><strong>1% A ENCARGADOS</strong></td>
         <td width=\"100\" align=\"right\"><strong>$ ".number_format($totencf,2)."</strong></td>
         <td width=\"310\" align=\"right\"><strong></strong></td>
         </tr>
         <tr>
         <td width=\"310\" align=\"right\"><strong></strong></td>
         <td width=\"200\" align=\"left\"><strong>.5% SUPERVISORES</strong></td>
         <td width=\"100\" align=\"right\"><strong>$ ".number_format($totsupf,2)."</strong></td>
         <td width=\"310\" align=\"right\"><strong></strong></td>
         </tr>
         <tr>
         <td width=\"310\" align=\"right\"><strong></strong></td>
         <td width=\"200\" align=\"left\"><strong>.3% A GERENTES REGIONALES</strong></td>
         <td width=\"100\" align=\"right\"><strong>$ ".number_format($totgerf,2)."</strong></td>
         <td width=\"310\" align=\"right\"><strong></strong></td>
         </tr>
         <tr  bgcolor=\"#E6E6E6\">
         <td width=\"310\" align=\"right\"><strong></strong></td>
         <td width=\"200\" align=\"left\"><strong>TOTAL GENERAL</strong></td>
         <td width=\"100\" align=\"right\"><strong>$ ".number_format($totcomf+$totencf+$totjeff+$totsupf+$totgerf,2)."</strong></td>
         <td width=\"310\" align=\"right\"><strong></strong></td>
         </tr>
         <tr>
         <td width=\"460\" align=\"center\"><strong>AUTORIZADO<br /><br /><br /><br /><br />LIC. XAVIER GONZALEZ ZIRION<br />DIRECTOR GENERAL</strong></td>
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