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

$this->SetFont('Courier', '', 14	);
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
$pdf->SetMargins(PDF_MARGIN_LEFT, 58, PDF_MARGIN_RIGHT); 
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


       $s = "SELECT a.*, b.completo, b.succ,c.nombre as sucx, d.tipo as disp 
        FROM desarrollo.equipos_comunicaciones a 
        left join catalogo.cat_empleado b on b.id=a.id_user
        left join catalogo.sucursal c on c.suc=b.succ
        left join desarrollo.equipos_tipo d on d.id=a.tipo
        where a.activo=1 and a.tipo <>4 and a.id=$id
        order by succ, id_user
        ";
       $q = $this->db->query($s);
       
       if($q->num_rows() > 0){
        $row = $q->row();
        $equipo=$row->equipo;
        $disp=$row->disp;
        $sucx=$row->sucx;
       
       $e.="<div align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </div>";
       $e.="<div align=\"right\">Fecha de captura.:".$row->fecha." </div>";
       $e.="<br /><br /><br />Por medio de la presente, manifiesta que recibe un(a) $disp.<br /><br />";
       $e.="<div align=\"center\">Marca y Modelo: $equipo</div><br /><br /><br /><br />";
       $e.="<table>
        
        <tr>
        <td align=\"center\">Num</td>
        <td align=\"center\">IMEI</td>
        <td align=\"center\">ICCID</td>
        </tr>
        ";
       
       foreach($q->result() as $row)
         {
            
            $e.="
            <tr>
            <td align=\"center\">".$row->cel."</td>
            <td align=\"center\">".$row->imei."</td>
            <td align=\"center\">".$row->iccid."</td>
            </tr>
            ";
        
          }
          
        }else{
            
        }
    
        $e.="<br /><br />Para ser utilizada en las actividades propias de la empresa.";  
        
        $e.="<br /><br />Queda asentado, que, si este equipo llegara a sufrir pérdida, robo o daño alguno, el costo de reposición sera pagado sin reserva por el que recibe.<br /><br /><br /><br />"; 
            
        $e.="<tr>
        
        <td align=\"center\">RECIBIO<br /><br /></td>
        <td></td>
        <td align=\"center\">ENTREGA<br /><br /></td>
        
        </tr>
        <tr>
        
        <td align=\"center\">________________________</td>
        <td></td>
        <td align=\"center\">________________________</td>
        
        </tr>
        
        <tr>
        <td align=\"center\">".$row->completo."</td>
        <td></td>
        <td align=\"center\">ING. JOSÉ F. NAVARRETE SERRANO</td>
        </tr>
        <tr>
        <td align=\"center\">".$sucx."</td>
        <td></td>
        <td align=\"center\">GERENTE DE TELECOMUNICACIONES</td>
        </tr>
        
        </table>";
     
//echo $e;
// ---------------------------------------------------------
// ---------------------------------------------------------  

// ---------------------------------------------------------
// ---------------------------------------------------------  
// set font
$pdf->SetFont('helvetica', '', 12	);
$e = utf8_encode($e);
$pdf->AddPage();
$tbl = <<<EOD
$e
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
//-----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------



//Close and output PDF document
$pdf->Output('pedido.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+