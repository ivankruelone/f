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

$this->SetFont('helvetica', '', 9	);
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
// ---------------------------------------------------------
$e='';
$f='';
$totfal=0;
if($id_captura==931){
 $s = "select a.*,b.puesto as puestox,c.puesto as puesto_cox,d.completo as reportax
 from oficinas.actividad a 
       left join catalogo.cat_puesto b on b.id=a.puesto
       left join catalogo.cat_puesto c on c.id=a.id_puesto_co
       left join catalogo.cat_empleado d on d.nomina=a.reporta 
       where a.id_captura=$id_captura and a.tipo='A' and reporta>0
       order by a.id_importancia";
       
        $q = $this->db->query($s);   
}else{
$s = "select a.*,b.puesto as puestox,c.puesto as puesto_cox from oficinas.actividad a 
       left join catalogo.cat_puesto b on b.id=a.puesto
       left join catalogo.cat_puesto c on c.id=a.id_puesto_co 
       where a.id_captura=$id_captura and a.tipo='A'
       order by a.reporta";
       
        $q = $this->db->query($s);    
} 
     
           $e.="<table  border=\"1\" cellpadding=\"4\">
          <thead>
          <tr>
          <th width=\"870\" align=\"left\">$id_captura</th>
          </tr>
          <tr>
          <th width=\"70\" align=\"center\">Nomina</th>
          <th width=\"200\" align=\"left\">Emleado</th>
          <th width=\"600\" align=\"left\">Actividad</th>
          </tr>
          </thead>
          
          ";
        
        
         foreach($q->result() as $r)
         {
          if($r->puestox==null){$pu=$r->puestox;}else{$pu='';} 
       $e.="
            <tr>
            <td width=\"70\" align=\"center\">".$r->nomina."</td>
            <td width=\"200\" align=\"left\">".$r->completo."<br />".$r->puestox."<br /><font color=\"blue\">".$r->puesto_cox."<br />".$r->obser."<br />REPORTA A: ".$pu."</font></td>
            <td width=\"600\" align=\"left\">".$r->actividad."</td>
            </tr>
            ";   
            
         
        $totfal=$totfal+1; 
        }
        
       $e.="
        <tr bgcolor=\"#E6E6E6\"><br />
        <td width=\"800\" align=\"right\"><strong>TOTAL EMPLEADOS</strong></td>
        <td width=\"70\" align=\"right\"><strong>".number_format($totfal,0)."</strong></td>
        </tr>
        </table>";

// ---------------------------------------------------------
// ---------------------------------------------------------
$s1 = "select *from oficinas.diagnostico where id_captura=$id_captura";
        $q1 = $this->db->query($s1);
if($q1->num_rows()>0){
           $f.="<table  border=\"1\" cellpadding=\"4\">
          ";
        
        
         foreach($q1->result() as $r1)
         {
       $f.="<tr>
            <td width=\"870\" align=\"center\">Perspectiva a corto, mediano y largo plazo</td>
            </tr>
            
            <tr>
            <td width=\"217\" align=\"left\">1 a&ntilde;o</td>
            <td width=\"217\" align=\"left\">3 a&ntilde;os</td>
            <td width=\"217\" align=\"left\">5 a&ntilde;os</td>
            <td width=\"219\" align=\"left\">10 a&ntilde;os</td>
            </tr>
            
            <tr>
            <td width=\"217\" align=\"left\">".$r1->uno."</td>
            <td width=\"217\" align=\"left\">".$r1->tres."</td>
            <td width=\"217\" align=\"left\">".$r1->cinco."</td>
            <td width=\"217\" align=\"left\">".$r1->diez."</td>
            </tr>
            
            <tr>
            <td width=\"870\" align=\"center\">Mision Vision y Valores</td>
            </tr>
            
            <tr>
            <td width=\"870\" align=\"left\">".$r1->propuesta."</td>
            </tr>
            
            <tr>
            <td width=\"870\" align=\"center\">Procedimiento a Mediano Plazo</td>
            </tr>
            
            <tr>
            <td width=\"870\" align=\"left\">".$r1->plazo."</td>
            </tr>
            
            <tr>
            <td width=\"870\" align=\"center\">Necesidades para el estado ideal</td>
            </tr>
            
            <tr>
            <td width=\"870\" align=\"left\">".$r1->alinear."</td>
            </tr>
            ";   
            
         
        $totfal=$totfal+1; 
        }
        
       $f.="
       
        </table>";
}
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
$pdf->SetFont('helvetica', '', 8	);

$pdf->AddPage();
$tbl = <<<EOD
$f
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------


//Close and output PDF document
$pdf->Output('diagnostico.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+