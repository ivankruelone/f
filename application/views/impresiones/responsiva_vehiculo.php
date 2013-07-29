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
$pdf->SetMargins(PDF_MARGIN_LEFT, 55, PDF_MARGIN_RIGHT); 
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

       $s = "select v.id, marca, modelo, placas, anio, numser, completo, color from desarrollo.vehiculo v
        left join catalogo.cat_empleado c on recibe=nomina where v.id=$id
        ";
       $q = $this->db->query($s);
       
       if($q->num_rows() > 0){
        $row = $q->row();
        $completo=$row->completo;
        $marca=$row->marca;
        $modulo=$row->modelo;
        $placas=$row->placas;
        $anio=$row->anio;
        $numser=$row->numser;
        $color=$row->color;
        }
       
        $e.="<p align=\"justify\">CONTRATO DE COMODATO QUE  CELEBRAN POR UNA PARTE LA SOCIEDAD ANÓNIMA DE
        CAPITAL VARIABLE DENOMINADA “FARMACIAS EL FENIX DEL CENTRO”, REPRESENTADA POR  <strong>C.P.
        ARMANDO ALEMAN MAYEN</strong>  A QUIEN EN LO SUCESIVO SE LE DENOMINARA “EL COMODANTE” Y  POR
        OTRA PARTE  <strong>".$row->completo."</strong> A QUIEN PARA EFECTOS DEL PRESENTE CONTRATO SE
        LE DENOMIMARÁ “EL COMODATARIO” DE ACUERDO A LO QUE SE CONTIENEN EN LAS SIGUIENTES
        DECLARACIONES Y CLAUSULAS:
        </p>
        <br />";
        $e.="<p align=\"justify\"><strong>DECLARACIONES</strong></p>";
        $e.="<p align=\"justify\"><strong>I.- DECLARA  “EL COMODANTE”.</strong></p>
        <br />";
        $e.="<p align=\"justify\">1.Que es una Sociedad Mercantil de las denominadas Sociedad Anónima de Capital Variable,
        constituida de conformidad con las Leyes Mexicanas .</p>
        <br />";
        $e.="<p align=\"justify\">2.Que es  propietaria del Automóvil  que se describe a continuación:</p>";
        $e.='
        <p>
        <table border="1" width = "50%";>
        <tr>
        <td>a. Marca:</td>
        <td>'.$row->marca.'</td>
        </tr>
        <tr>
        <td>b. Modelo:</td>
        <td>'.$row->modelo.'</td>
        </tr>
        <tr>
        <td>c. Año:</td>
        <td>'.$row->anio.'</td>
        </tr>
        <tr>
        <td>d. Numero de serie:</td>
        <td>'.$row->numser.'</td>
        </tr>
        <tr>
        <td>e. placas:</td>
        <td>'.$row->placas.'</td>
        </tr>
        <tr>
        <td>f. Color:</td>
        <td>'.$row->color.'</td>
        </tr>
        </table>
        </p>';
        $e.="<p align=\"justify\"><strong>DEPARTAMENTO : COMPRAS</strong></p>";
        $e.="<p align=\"justify\"><strong>II.- DECLARA “EL COMODATARIO”</strong></p>
        <br />";
        $e.="<p align=\"justify\">A) Encontrarse interesado en recibir en comodato el VEH&Iacute;CULO
        descrito en la declaración anterior para usarlo a tiempo completo sin límite de kilometraje. </p>
        <br />";
        $e.="<p align=\"justify\">B) Tener licencia de manejo vigente, así como los demás requisitos necesarios para el uso del VEH&Iacute;CULO. </p>
        <br />";
        $e.="<p align=\"justify\">Atentas las partes a las declaraciones formuladas con anterioridad, manifiestan su conformidad en
        otorgar el presente contrato bajo las siguientes:  </p>
        <br />";
        $e.="<p align=\"justify\"><strong>CLAUSULAS</strong></p>
        <br />";
        $e.="<p align=\"justify\"><strong>PRIMERA:</strong> “EL COMODANTE” concede al “COMODATARIO” en forma gratuita el uso del VEH&Iacute;CULO  
        aceptándolo este último en las actuales condiciones físicas en que se encuentra y
        obligándose a devolverlo en el mismo estado a “EL COMODANTE”. </p>
        <br />";
        $e.="<p align=\"justify\"><strong>SEGUNDA:</strong> “EL COMODATARIO” se obliga a utilizar el vehiculo únicamente para el desempeño de
        las funciones que se desprenden de su cargo, por tiempo completo, sin límite de kilometraje, 
        y cuyo uso será gratuito.  </p>
        <br />";
        $e.="<p align=\"justify\"><strong>TERCERA:</strong> “EL COMODATARIO” se obliga a no destinar el vehiculo a usos distintos a los que requiera 
        el ejercicio de su cargo, ni podrá otorgar a su vez dicho vehiculo en comodato, ni conceder el uso
        ni la posesión del mismo, bajo ninguna circunstancia a terceras personas. </p>
        <br />";
        $e.="<p align=\"justify\"><strong>CUARTA:</strong> Las partes establecen que el término del presente contrato estará condicionado por la 
        relación laboral existente entre el comodante y el comodatario, o bien, a que las actividades
        del comodatario cambien y no se haga indispensable el uso del vehículo para atender la nueva
        encomienda.  </p>
        <br />";
        $e.="<p align=\"justify\"><strong>QUINTA:</strong> “EL COMODANTE” se obliga a cubrir los gastos erogados por concepto de consumibles
        del automóvil que otorga en comodato. </p>
        <br />";
        $e.="<p align=\"justify\"><strong>SEXTA:</strong> “EL COMODATARIO” responderá del pago de derechos o multas que se generen por
        infracciones al reglamento de tránsito; así como del pago del deducible de la póliza
        de seguro, en caso de que se genere un accidente, el cuál se encuentre fuera de las 
        actividades propias de la empresa, y se obliga a devolverlo en perfectas condiciones
        a “EL COMODANTE”, excepto en aquellos casos que el deterioro fuera una causa derivada
        del uso normal del veh&iacute;culo. </p>
        <br />";
        $e.="<p align=\"justify\"><strong>SÉPTIMA:</strong> Las partes se someten expresamente para todo lo relacionado con el cumplimiento
        del presente contrato a las leyes  y tribunales de la ciudad de México, Distrito Federal,
        renunciando expresamente a cualquier otro que se pudiera tener por razón de sus domicilios
        presentes o futuros. </p>
        <br />";
        $e.="<p><strong>OCTAVA:</strong> Para todo lo relacionado con el presente contrato las partes señalan como sus 
        domicilios los siguientes: 
        <br />";
        $e.="“EL COMODANTE”  : Lago Trasímeno nº 36, Col. Anahuac, Del. Miguel Hidalgo. México DF,
         C.P. 11320</p>
        <p>“EL COMODATARIO”<hr /></p><p><hr /></p>";
        $e.="<p align=\"justify\"><strong>NOVENA:</strong>  Cualquier siniestro ocasionado por omisión y/o negligencia del COMODATARIO, 
        o por uso indebido del bien,  serán su TOTAL responsabilidad civil y económica, liberando
        al COMODANTE de cualquier pago u acción legal derivada de los sucesos.</p>

        <p align=\"justify\">Leído que fue el presente contrato, las partes lo firman al margen y al calce en la 
        ciudad de México, Distrito Federal, El día</p><p>. <hr /></p><br /><br /><br /><br />";


        
        $e.='
        <p>
        <table><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        <tr>
        <td align="center">EL  COMODANTE</td>
        <td align="center">EL COMODATARIO</td>
        </tr><br /><br />
        <tr>
        <td align="center">______________________________</td>
        <td align="center">______________________________</td>
        </tr>
        <tr>
        <td align="center">C.P. ARMANDO ALEMAN MAYEN</td>
        <td align="center">'.$row->completo.'</td>
        </tr>
        </table>
        </p>';
        
        
        
              
       
     
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