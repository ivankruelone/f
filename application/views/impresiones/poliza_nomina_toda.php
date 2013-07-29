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
// ---------------------------------------------------------cia, plaza, succ, nomina, pat, mat, nom, completo, id, id_user, suc, contador, tipo
$e=''; 
       $s = "select a.fecha,a.nomina,a.cianom,sum(a.fal)as fal,a.clave,
c.ciax,d.nombre,d.puesto
from faltante a
left join catalogo.cat_compa_nomina c on c.cia=a.cianom
left join usuarios d on d.id=a.id_user
         where a.fecpre = ? and a.id_user= ? and a.tipo>1
         group by cianom";
        $q = $this->db->query($s,array($fec,$user_con));
 foreach($q->result() as $r)
         {
        $nombre=$r->nombre;
        $puesto=$r->puesto;
        $ciax=$r->ciax;
        $cianom=$r->cianom;
        
            
            $e.= "
           <table>
           
           <tr>
           <td colspan=\"12\" align=\"center\"><strong>CONTROL DE POLIZA DE PRENOMINA $fec</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"12\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')."<br /></td>
           </tr>
           <tr>
           <td colspan=\"12\" align=\"center\">FECHA DE POLIZA..:<strong>".$mesx." DEL ".$aaa."</strong> <br /></td>
           </tr>
           <tr>
           <td colspan=\"12\" align=\"center\">COMPA&Ntilde;IA..:<strong>".$cianom." - ".$ciax."</strong> <br /></td>
           </tr>
           <tr>
           <td colspan=\"12\" align=\"center\">CONTADOR..:<strong>".$nombre."</strong>  PLAZA..:<strong>".$puesto."</strong> <br /></td>
           </tr>
           </table> 
            ";
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
$glo=0;
         $sql="select a.fecha,a.nomina,a.cianom,sum(a.fal)as fal,a.clave,b.pat,b.mat,b.nom
          from faltante a
          left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom  and b.tipo=1
         where a.fecpre = ? and a.id_user= ? and a.cianom= ? and a.tipo>1
         group by nomina";
         $query = $this->db->query($sql,array($fec,$user_con,$cianom));
         
          $e.="<table>";
        
        
         foreach($query->result() as $row)
         {
         $nom=$row->nomina;
$s="select a.folioi,a.fechai,a.fecha,a.nomina,a.cianom,sum(a.fal)as fal,a.clave,
b.completo,c.nombre as clavex
from faltante a
left join catalogo.cat_empleado b on b.nomina=a.nomina  and b.cia=a.cianom  and b.tipo=1
left join catalogo.cat_nom_claves c on c.clave=a.clave
         where a.fecpre = ? and a.id_user= ? and a.cianom= ? and a.nomina= ? and a.tipo>1
         group by nomina,clave";
         $q = $this->db->query($s,array($fec,$user_con,$cianom,$nom));
         
         $e.="
            <tr bgcolor=\"#F8F1F1\">
            <td width=\"650\" align=\"left\"><strong>Empleado:</strong> ".$row->nomina." - ".$row->pat." ".$row->mat." ".$row->nom."</td>
            </tr>
            <tr>
            <td width=\"150\" align=\"left\"></td>
            <td width=\"40\" align=\"left\"><strong>CLAVE</strong></td>
            <td width=\"200\" align=\"left\"><strong>CONCEPTO</strong></td>
            <td width=\"100\" align=\"right\"><strong>IMPORTE</strong></td>
            <td width=\"70\" align=\"right\"><strong></strong></td>
            <td width=\"70\" align=\"right\"><strong></strong></td>
            </tr>";
       $totfal=0;
       
       foreach($q->result() as $r)
         {
        $glo=$glo+$r->fal;
if($r->clave==644){       
       $e.="
            <tr>
            <td width=\"150\" align=\"left\"></td>
            <td width=\"40\" align=\"left\">".$r->clave."</td>
            <td width=\"200\" align=\"left\">".$r->clavex."</td>
            <td width=\"100\" align=\"right\">".number_format($r->fal,2)."</td>
            <td width=\"70\" align=\"right\">".$r->fechai."</td>
            <td width=\"70\" align=\"right\">".$r->folioi."</td>
            </tr>";   
            
 }else{
        $e.="
            <tr>
            <td width=\"150\" align=\"left\"></td>
            <td width=\"40\" align=\"left\">".$r->clave."</td>
            <td width=\"200\" align=\"left\">".$r->clavex."</td>
            <td width=\"100\" align=\"right\">".number_format($r->fal,2)."</td>
            <td width=\"70\" align=\"right\"></td>
            <td width=\"70\" align=\"right\"></td>
            </tr>";   
 }           
              
        $totfal=$totfal+$r->fal;
        
         }
        $e.="
        <tr>
        <td width=\"390\" align=\"right\"><strong>TOTAL</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($totfal,2)."</strong></td>
        </tr>";
        
        $totfal=0; 
        }
        
       $e.="
       <tr bgcolor=\"#E6E6E6\"><br />
        <td width=\"390\" align=\"right\"><strong>TOTAL GENERAL DE LA COMPA&Ntilde;IA</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($glo,2)."</strong></td>
        <td width=\"160\" align=\"left\"></td>
        </tr>
        </table>
        "; 
 
     
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
$detalle='';
$sqlx="select a.fecha,a.nomina,a.cianom,sum(a.fal)as fal,a.clave,
b.completo,c.nombre as clavex
from faltante a
left join catalogo.cat_empleado b on b.nomina=a.nomina  and b.cia=a.cianom  and b.tipo=1
left join catalogo.cat_nom_claves c on c.clave=a.clave
         where a.fecpre = ? and a.id_user= ? and a.cianom= ? and a.tipo>1
         group by clave";
         $queryx = $this->db->query($sqlx,array($fec,$user_con,$cianom));
         
         
         
          $detalle.= "
          
          <table>
            <tr bgcolor=\"#E6FFFF\">
            <td width=\"650\" align=\"center\"><strong>CONCENTRADO POR CONCEPTO</strong></td>
            </tr>
          <tr>
            <td width=\"40\" align=\"left\"><strong>CLAVE</strong></td>
            <td width=\"200\" align=\"left\"><strong>CONCEPTO</strong></td>
            <td width=\"100\" align=\"right\"><strong>IMPORTE</strong></td>
            </tr>";
          
        
        $totfal=0;
         foreach($queryx->result() as $rowx)
         {
         $detalle.="
         
         <tr>
            <td width=\"40\" align=\"left\">".$rowx->clave."</td>
            <td width=\"200\" align=\"left\">".$rowx->clavex."</td>
            <td width=\"100\" align=\"right\">".number_format($rowx->fal,2)."</td>
            </tr>"; 
        $totfal=$totfal+$rowx->fal;
        
         }
        $detalle.="
        <tr>
        <td width=\"240\" align=\"right\"><strong>TOTAL</strong></td>
        <td width=\"100\" align=\"right\"><strong>".number_format($totfal,2)."</strong></td>
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
$pdf->SetFont('helvetica', '', 8	);

$pdf->AddPage();
$tbl = <<<EOD
$e
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
$e='';
// -----------------------------------------------------------------------------
$tbl = <<<EOD
$detalle
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
$detalle='';
// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------

}

//Close and output PDF document
$pdf->Output('reportes.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+