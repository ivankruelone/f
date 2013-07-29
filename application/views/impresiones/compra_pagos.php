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
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

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
$pdf->SetMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT); 
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
$tottot=0;$totmay=0;$totdir=0;$totseg=0;$totvar=0;
$ttottot=0;$ttotmay=0;$ttotdir=0;$ttotseg=0;$ttotvar=0;
       $ss = "select a.prv,b.razon as ciax 
       from pagos_cheque_orden a 
       left join catalogo.compa b on b.cia=a.cia
       where pre_pago='$fec' 
       group by prv order by prv";
       $qq = $this->db->query($ss);
         foreach($qq->result() as $rr)
         {
         $sx = "select *from catalogo.provedor where prov=$rr->prv";$qx = $this->db->query($sx);   
         if($qx->num_rows() > 0){$rx=$qx->row();$prvx=$rx->corto;}else{$prvx='';}
         
         $s = "select a.*,b.razon as ciax,
         case when archivo='AU' OR archivo='FN' OR archivo='PM' OR archivo='MZ' OR archivo='PN'
         then imp_cheque else 0 end as mayorista,
         case when archivo='SE' 
         then imp_cheque else 0 end as segpop,
         case when archivo='VR' 
         then imp_cheque else 0 end as varios,
         case when archivo='MA' 
         then imp_cheque else 0 end as directos 
       from pagos_cheque_orden a 
       left join catalogo.compa b on b.cia=a.cia
       where pre_pago='$fec' and prv=$rr->prv order by prv";
       $q = $this->db->query($s);
        
        
        $e.="<table  border=\"1\" cellpadding=\"4\">
       <thead>
          <tr>
          <th width=\"860\" align=\"center\"><font size=\"+2\"><strong>$rr->prv $prvx</strong></font></th>
          </tr>
          <tr>
          <th width=\"240\" align=\"left\">COMPA&Ntilde;IA</th>
          <th width=\"60\" align=\"left\">CHEQUE</th>
          <th width=\"60\" align=\"left\">FEC.VEN</th>
          <th width=\"100\" align=\"left\">MAYORISTA</th>
          <th width=\"100\" align=\"left\">DIRECTOS</th>
          <th width=\"100\" align=\"left\">SEGPOP</th>
          <th width=\"100\" align=\"left\">VARIOS</th>
          <th width=\"100\" align=\"left\">TOTAL</th>
          </tr>
       </thead>
       <tbody>
          ";
       foreach($q->result() as $r)
         {
          
          
       $e.="
            <tr>
            <td width=\"240\" align=\"left\">".$r->cia." ".$r->ciax."</td>
            <td width=\"60\" align=\"left\">".$r->cheque_real."</td>
            <td width=\"60\" align=\"left\">".$r->fecha_venci."</td>
            <td width=\"100\" align=\"right\">".number_format($r->mayorista,2)."</td>
            <td width=\"100\" align=\"right\">".number_format($r->directos,2)."</td>
            <td width=\"100\" align=\"right\">".number_format($r->segpop,2)."</td>
            <td width=\"100\" align=\"right\">".number_format($r->varios,2)."</td>
            <td width=\"100\" align=\"right\">".number_format($r->imp_cheque,2)."</td>
            </tr>
            ";   
            
        $tottot=$tottot+$r->imp_cheque;
        $totmay=$totmay+$r->mayorista;
        $totdir=$totdir+$r->directos;
        $totseg=$totseg+$r->segpop;
        $totvar=$totvar+$r->varios;
        $ttottot=$ttottot+$r->imp_cheque;
        $ttotmay=$ttotmay+$r->mayorista;
        $ttotdir=$ttotdir+$r->directos;
        $ttotseg=$ttotseg+$r->segpop;
        $ttotvar=$ttotvar+$r->varios;
        
        }
         $e.="
       </tbody>
       <tfoot>
        <tr bgcolor=\"#E6E6E6\">
        <td width=\"360\" align=\"right\"><strong>TOTAL $prvx</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($totmay,2)."</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($totdir,2)."</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($totseg,2)."</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($totvar,2)."</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($tottot,2)."</strong></td>
         </tr>
         </tfoot>
         </table>
        "; 
$tottot=0;$totmay=0;$totdir=0;$totseg=0;$totvar=0;
        
}        
$f.="
       
        <table border=\"1\">
        <tr bgcolor=\"#E6E6E6\">
        <td width=\"360\" align=\"right\"><font size=\"+2\"><strong>TOTAL GENERAL</strong></font></td>
        <td width=\"100\" align=\"right\"><font size=\"+2\"><strong>".number_format($ttotmay,2)."</strong></font></td>
        <td width=\"100\" align=\"right\"><font size=\"+2\"><strong>".number_format($ttotdir,2)."</strong></font></td>
        <td width=\"100\" align=\"right\"><font size=\"+2\"><strong>".number_format($ttotseg,2)."</strong></font></td>
        <td width=\"100\" align=\"right\"><font size=\"+2\"><strong>".number_format($ttotvar,2)."</strong></font></td>
        <td width=\"100\" align=\"right\"><font size=\"+2\"><strong>".number_format($ttottot,2)."</strong></font></td>
         </tr>
        </table>
        ";      
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

// -----------------------------------------------------------------------------
$tbl1 = <<<EOD
$f
EOD;
$pdf->writeHTML($tbl1, true, false, false, false, '');
// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------



//Close and output PDF document
$pdf->Output('pagos.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+