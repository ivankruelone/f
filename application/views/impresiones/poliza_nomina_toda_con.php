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
$pdf->SetMargins(PDF_MARGIN_LEFT, 5, PDF_MARGIN_RIGHT); 
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
       $s = "select a.fecha,a.nomina,a.cianom,sum(a.fal)as fal,a.clave,
c.ciax,d.nombre,d.puesto,b.nombre as clavex
from faltante a
left join catalogo.cat_nom_claves b on b.clave=a.clave
left join catalogo.cat_compa_nomina c on c.cia=a.cianom
left join usuarios d on d.id=a.id_user
         where a.fecpre = ? and a.clave= ? and a.tipo=2
         group by a.cianom";
        $q = $this->db->query($s,array($fec,$clave));
 foreach($q->result() as $r)
         {
        $nombre=$r->nombre;
        $puesto=$r->puesto;
        $ciax=$r->ciax;
        $cianom=$r->cianom;
        $nom=$r->nomina;
            
            $e.= "
           <table>
           
           <tr>
           <td colspan=\"13\" align=\"center\"><strong>CONTROL DE POLIZA DE PRENOMINA  $fec</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"13\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')."<br /></td>
           </tr>
           <tr>
           <td colspan=\"13\" align=\"center\">FECHA DE POLIZA..:<strong>".$mesx." DEL ".$aaa."</strong> <br /></td>
           </tr>
           <tr>
           <td colspan=\"13\" align=\"center\">COMPA&Ntilde;IA..:<strong>".$clave." - ".$r->clavex."</strong> <br /></td>
           </tr>
           <tr>
           <td colspan=\"13\" align=\"center\">COMPA&Ntilde;IA..:<strong>".$cianom." - ".$ciax."</strong> <br /></td>
           </tr>
           </table> 
            ";
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
$glo=0;
        
$sql="select a.observacion, a.cianom, a.folioi,a.fechai,a.fecha,a.nomina,a.cianom,fal,a.clave,
b.completo,c.nombre as clavex,d.nombre as nomx,d.puesto
from faltante a
left join catalogo.cat_empleado b on b.nomina=a.nomina  and b.cia=a.cianom
left join catalogo.cat_nom_claves c on c.clave=a.clave
left join usuarios d on d.id=a.id_user
         where a.fecpre = ? and a.clave= ? and a.cianom= ?  and a.tipo=2
         ";
         $query = $this->db->query($sql,array($fec,$clave,$cianom));
         
         $e.="<table>
            <tr>
            <td width=\"50\" align=\"left\"><strong>NOMINA</strong></td>
            <td width=\"240\" align=\"left\"><strong>NOMBRE</strong></td>
            <td width=\"60\" align=\"right\"><strong>FECHA</strong></td>
            <td width=\"60\" align=\"right\"><strong>IMPORTE</strong></td>
            <td width=\"10\" align=\"right\"><strong></strong></td>
            <td width=\"240\" align=\"left\"><strong>CONTADOR</strong></td>
            </tr>";
       $totfal=0;
       
       foreach($query->result() as $row)
         {
if($clave==644){       
       $e.="
            <tr>
            <td width=\"50\" align=\"left\">".$row->nomina."</td>
            <td width=\"240\" align=\"left\">".$row->completo."<br />".$row->observacion."</td>
            <td width=\"60\" align=\"left\">".$row->fecha."</td>
            <td width=\"60\" align=\"right\">".number_format($row->fal,2)."</td>
            <td width=\"10\" align=\"left\"></td>
            <td width=\"240\" align=\"left\">".$row->nomx."<br />".$row->puesto."</td>
            <td width=\"100\" align=\"left\">".$row->fechai."<br />FOL.:".$row->folioi."</td>
            </tr>";   
            
 }else{
        $e.="
            <tr>
            <td width=\"50\" align=\"left\">".$row->nomina."</td>
            <td width=\"240\" align=\"left\">".$row->completo."</td>
            <td width=\"60\" align=\"left\">".$row->fecha."</td>
            <td width=\"60\" align=\"right\">".number_format($row->fal,2)."</td>
            <td width=\"10\" align=\"left\"></td>
            <td width=\"240\" align=\"left\">".$row->nomx."<br />".$row->puesto."</td>
            <td width=\"100\" align=\"right\"></td>
            </tr>";   
          
          }    
        $totfal=$totfal+$row->fal;
        
         
          }
        $e.="
        <tr>
        <td width=\"350\" align=\"right\"><strong>TOTAL</strong></td>
        <td width=\"60\" align=\"right\"><strong>".number_format($totfal,2)."</strong></td>
        </tr>
        </table>";
        
        $totfal=0; 
       
  
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
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
$e='';
// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------

}

//Close and output PDF document
$pdf->Output('reportes.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+