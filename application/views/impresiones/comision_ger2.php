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
$pdf = new MYPDF('C', PDF_UNIT, 'LETTER', true, 'UTF-8', false); 

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
$pdf->SetMargins(PDF_MARGIN_LEFT, 5, PDF_MARGIN_RIGHT); 
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER); 
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER); 

//set auto page breaks 
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 

//set image scale factor 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  
$num=1;
$s0 = "select a.*, sum(ger_nat)as premio_nat  from vtadc.comision a
where
fecha='$fecha' and puestox='GER' and ger_nat>0
group by  nomina";
$q0 = $this->db->query($s0);
$detalle="<table border=\".1\">
           <tr>
           <td colspan=\"4\" align=\"center\"><strong>COMISION MENSUAL DE $mesx DEL $aaa POR VENTA DE ENERGIA Y VIDA</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"4\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')."<br /></td>
           </tr>";

   $total1=0;      
 foreach($q0->result() as $r0)
        {
//----------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------
        $detalle.="
           
        <tr>
        <th align=\"left\"><strong>TIPO</strong></th>
        <th align=\"left\"><strong>SUCURSAL</strong></th>
        <th align=\"right\"><strong>IMPORTE</strong></th>
        </tr>
        ";
      
       
       $vta_gontor=0;
       $incremento='';
 $s2 = "select a.*,b.nombre as sucx,b.tipo2
 from vtadc.comision a
 left join catalogo.sucursal b on b.suc=a.suc 
 where a.nomina=$r0->nomina  and fecha='$fecha' and ger_nat>0";
        $q2 = $this->db->query($s2);
        foreach($q2->result() as $r2)
        {
$detalle.="

         <tr>
            <td align=\"left\" colspan=\"1\">".$num."</td>
            <td align=\"left\" colspan=\"1\">".$r2->tipo2."</td>
            <td align=\"left\" colspan=\"1\">".str_pad($r2->suc,4,"0",STR_PAD_LEFT)." - ".trim($r2->sucx)."</td>
            <td align=\"right\" colspan=\"1\"><strong> $ ".number_format($r2->ger_nat,2)."</strong></td>
        </tr> ";  
$num=$num+1;
        }           
$detalle.=" 
        <tr bgcolor=\"#EDD8D8\">
           <td colspan=\"3\" align=\"center\">GERENTE..:<strong>".$r0->nomina." - ".$r0->pat." ".$r0->mat." ".$r0->nom."</strong> <br /></td>
           <td colspan=\"1\" align=\"right\">IMPORTE..:<strong>".$r0->premio_nat."</strong></td>
           </tr>"; 
$total1=$total1+$r0->premio_nat;
}
$detalle.="
<tr bgcolor=\"#DAFACB\">
           <td colspan=\"3\" align=\"right\"><strong>TOTAL..:</strong> <br /></td>
           <td colspan=\"1\" align=\"right\"><strong>".number_format($total1,2)."</strong></td>
           </tr>
           </table>";           
//----------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------

$pdf->SetFont('helvetica', '', 8	);

$pdf->AddPage();
$tbl = <<<EOD
$detalle
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
$detalle='';



//Close and output PDF document
$pdf->Output('pedido.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+