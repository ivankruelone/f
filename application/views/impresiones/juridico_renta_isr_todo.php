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

$this->SetFont('helvetica', '', 10	);
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
        $this->Cell(0, 10, ' '); 
    } 
} 

// create new PDF document 
$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

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
$pdf->SetMargins(PDF_MARGIN_LEFT, 28, PDF_MARGIN_RIGHT); 
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER); 
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER); 

//set auto page breaks 
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 

//set image scale factor 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  

//set some language-dependent strings 
$pdf->setLanguageArray($l);  

// --------------------------------------------------------- 

// set font
$pdf->SetFont('helvetica', '', 10	);
$s="select *from  rentas where aaa=$aaa and mes=$mes";

$q = $this->db->query($s);   
foreach($q->result() as $r)
        {




     $sql = "SELECT d.contra,d.rfc_contra,d.curp_contra,d.razon,d.rfc as rfc_cia,a.*,c.mes as mesx,b.nombre as sucx,a.imp,
     (imp*a.iva)as ivaf,(imp*(isr/100))as isrf,(imp*(iva_isr/100))as iva_isrf,

case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
 as total

FROM rentas a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.compa d on d.cia=a.cia
left join catalogo.mes c on c.num=a.mes
where a.id=$r->id and a.auxi=7003
";
      
        $query = $this->db->query($sql);
        $tabla= "
        <table cellpading=\"2\">
        <thead>
        
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        $me=$row->mes;
        $mee=$row->mes-1;
        $espacio=' ';
        if($row->pago=='MN'){$color='black';}else{$color='blue';}
        
            $tabla.="
            <tr>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\">".$mee."</td>
            <td align=\"left\"></td>
            <td align=\"left\">".$me."</td>
            <td align=\"left\">".$row->aaa."</td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ><BR/ ><BR/ ></td>
            </tr>
            ";
            
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"left\" colspan=\"5\">".$row->rfc."</td>
            <td align=\"left\" colspan=\"9\"></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"left\" colspan=\"5\">".$row->curp."</td>
            <td align=\"left\" colspan=\"9\"></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"left\" colspan=\"10\">".$row->nom."</td>
            <td align=\"left\" colspan=\"4\"></td>
            </tr>
            ";
            
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ><BR/ ></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"right\">B1</td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ><BR/ ></td>
            </tr>
            ";
             $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"left\" colspan=\"10\">ARRENDAMIENTO</td>
            <td align=\"left\" colspan=\"4\"></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"right\" colspan=\"4\">".number_format($row->imp,2)."</td>
            <td align=\"right\" colspan=\"5\">".number_format($row->imp,2)."</td>
            <td align=\"left\" colspan=\"5\"></td>
             </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ><BR/ ></td>
            </tr>
            ";
             $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"right\" colspan=\"4\">".number_format($row->isrf,2)."</td>
            <td align=\"right\" colspan=\"5\">".number_format($row->iva_isrf,2)."</td>
            <td align=\"left\" colspan=\"5\"></td>
             </tr>
            ";
           $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ><BR/ ></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"left\" colspan=\"10\">".$row->rfc_cia."</td>
            <td align=\"left\" colspan=\"4\"></td>
             </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"left\" colspan=\"10\">".$row->razon."</td>
            <td align=\"left\" colspan=\"4\"></td>
             </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"5\"><BR/ ></td>
            <td align=\"left\" colspan=\"5\"><BR/ ></td>
            <td align=\"left\" colspan=\"7\"><BR/ ></td>
            </tr>
            ";
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"left\" colspan=\"10\">".$row->contra."</td>
            <td align=\"left\" colspan=\"4\"></td>
             </tr>
            ";
            
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"3\"></td>
            <td align=\"left\" colspan=\"8\">".$row->rfc_contra."</td>
            <td align=\"left\" colspan=\"6\"> ".$row->curp_contra."</td>
             </tr>";
           
        }
        
        $tabla.="
        </tbody>
        </table>";


$pdf->AddPage();

// -----------------------------------------------------------------------------

$tbl = <<<EOD
$tabla
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
// -----------------------------------------------------------------------------
}
// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('reportes.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+