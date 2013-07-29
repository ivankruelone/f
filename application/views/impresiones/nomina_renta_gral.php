<?php
global $cabezota;

$cabezota=$cabeza;

require_once('tcpdf/config/lang/spa.php');
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
$pdf = new MYPDF('L', PDF_UNIT, 'A3', true, 'UTF-8', false); 

// set document information 
$pdf->SetCreator(PDF_CREATOR); 
$pdf->SetAuthor('Lidia Velazquez'); 
$pdf->SetTitle('Renta'); 
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
$pdf->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT); 
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
$sql = "SELECT a.*,b.nombre as sucx
      FROM catalogo.cat_beneficiario a
      left join catalogo.sucursal b on b.suc=a.suc
       ";
         $query = $this->db->query($sql);
        $detalle="
        <style>
        table
        {
        	font-family: \"Lucida Sans Unicode\", \"Lucida Grande\", Sans-Serif;
        }
        th
        {
        	font-weight: normal;
        	border-bottom: 2px solid #000000;
        }
        td
        {
        	border-bottom: 1px solid #000000;
        }
        </style>
        
        <table cellpadding=\"3\">
        <thead>
        <tr bgcolor=\"#CDCACA\">
            <th align=\"center\">SUCURSAL</th>
            <th align=\"center\">ARRENDADOR</th>
            <th align=\"center\">PERSONA</th>
            <th align=\"left\">No.EXP</th>
            <th align=\"center\">INICIA</th>
            <th align=\"center\">TERMINO</th>
            <th align=\"center\">% INCREMENTO</th>
            <th align=\"center\">PAGO</th>
            <th align=\"center\">DIFERENCIA</th>
            <th align=\"center\">CIERRE DE SUC</th>
            <th align=\"center\">ENTREGA DE LOCAL</th>
         </tr>
        </thead>
        <tbody>";
        foreach($query->result() as $row)
        {
            if($row->auxi==7003){
               $auxix='FISICA'; 
               if($row->iva>0) {$iva= $row->imp* $row->iva;}else{$iva=0;}
               if($row->isr>0) {$isr= $row->imp*($row->isr/100);}else{$isr=0;}
               if($row->iva_isr>0){$ivar=$row->imp*($row->iva_isr/100);}else{$ivar=0;}
               if($row->imp_cedular>0){$icedular= $row->imp*($row->imp_cedular/100);}else{$icedular=0;}
               $neta=$row->imp+$iva-$isr-$ivar-$icedular+$row->redondeo;
               }
            if($row->auxi==7004){$auxix='MORAL';
            if($row->iva>0) {$iva= $row->imp* $row->iva;}else{$iva=0;}
            $isr=0;
            $ivar=0;
            $icedular=0;
            $neta=$row->imp+$iva-$isr-$ivar-$icedular;
            }
            if($row->auxi==0){$auxi='NO CONFIGURADA';}
            $detalle.="
            
            <tr>
            <td align=\"left\">".$row->suc." ".trim($row->sucx)."</td>
            <td align=\"left\">".(trim($row->nom))."</td>
            <td align=\"left\">".$auxix."</td>
            <td align=\"left\">".trim($row->expediente)."</td>
            <td align=\"left\">".$row->contrato."</td>
            <td align=\"left\">".$row->fecha_termino."</td>
            <td align=\"left\">".$row->incremento."</td>
            <td align=\"left\">".$row->tipo_pago."</td>
            <td align=\"left\">".$row->diferencia."</td>
            <td align=\"left\">".$row->cierre."</td>
            <td align=\"left\">".$row->entrega_local."</td>
            </tr>
            <tr bgcolor=\"#F1FAFA\">
            
            <td align=\"left\" colspan=\"4\">MOTIVO.:".trim($row->motivo_cierre)."</td>
            <td align=\"left\" colspan=\"5\">OBSERVACION.:".trim($row->observacion)."</td>
            <td align=\"left\">RENTA BRUTA:".number_format($row->imp,2)."</td>
            <td align=\"left\">RENTA NETA:".number_format($neta,2)."</td>
            </tr>
               ";
            
        }
        
        $detalle.="</tbody>
        </table>";
// --------------------------------------------------------- 
// --------------------------------------------------------- 
//echo $detalle;
//die();
// set font
$pdf->SetFont('helvetica', '', 7	);

$pdf->AddPage();

// -----------------------------------------------------------------------------

$tbl = <<<EOD
$detalle
EOD;
$pdf->writeHTML($tbl, true, false, true, false, '');
// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('r.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+