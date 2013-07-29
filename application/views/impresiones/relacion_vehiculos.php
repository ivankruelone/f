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

$this->SetFont('Courier', '', 12	);
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
$pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT); 
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


       $s = "select completo, nombre, marca, modelo, anio, placas from desarrollo.vehiculo v
            left join catalogo.cat_empleado c on recibe=nomina
            left join catalogo.sucursal s on succ=s.suc where activo=2
        ";
       $q = $this->db->query($s);
       
       if($q->num_rows() > 0){
        $row = $q->row();
        $completo=$row->completo;
        $nombre=$row->nombre;
        $marca=$row->marca;
        $modelo=$row->modelo;
        $anio=$row->anio;
        $placas=$row->placas;
        
        }
        
        $e="";
        
        $e="<p align=\"right\">Fecha de impresion.:<br />".date('Y-m-d H:i:s')."</p>
        <p align=\"center\"><B>RELACI&Oacute;N DE VEH&Iacute;CULOS EN USO</B></p>
        <table border=\"1\" >
        <thead>
        <tr>
        <th width=\"20px\"><strong>#</strong></th>
        <th width=\"250px\"><strong>EMPLEADO</strong></th>
        <th width=\"100px\"><strong>DEPARTAMENTO</strong></th>
        <th width=\"100px\"><strong>MARCA</strong></th>
        <th width=\"100px\"><strong>MODELO</strong></th>
        <th width=\"30px\"><strong>AÑO</strong></th>
        <th width=\"60px\"><strong>PLACAS</strong></th>
        </tr>
        </thead>
        <tbody>
        ";
        $n = 1;
        $ped = 0;
        $sur = 0;
        foreach($q->result() as $row)
        { 
            
        $e.=" 
        <tr>
        <td width=\"20px\">".$n."</td>
        <td width=\"250px\">".$row->completo."</td>
        <td width=\"100px\">".$row->nombre."</td>
        <td width=\"100px\">".$row->marca."</td>
        <td width=\"100px\">".$row->modelo."</td>
        <td width=\"30px\">".$row->anio."</td>
        <td width=\"60px\">".$row->placas."</td>
        </tr>
        ";
         $n++; 
        }
        
        $e.="</tbody>
        </table>";
       
        
        
        
        
        
              
       
     
//echo $e;
// ---------------------------------------------------------
// ---------------------------------------------------------  

// ---------------------------------------------------------
// ---------------------------------------------------------  
// set font
$pdf->SetFont('helvetica', '', 8.5	);
$e = utf8_encode($e);

//echo $e;
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