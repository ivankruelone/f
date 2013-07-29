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
$pdf = new MYPDF('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false); 

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
$detalle=utf8_encode("
Contrato de arrendamiento que celebran por una parte el Sr. RAMON HUITRON GONZALEZ  quien  será “EL ARRENDADOR”  y por la otra y como “ARRENDATARIA”, “FARMACIA DE GENERICOS, S.A. DE C.V.”,   representada por su apoderado general Lic. Gerardo González Zirión  de acuerdo a las siguientes declaraciones y cláusulas

DECLARACIONES

		1.- Declara LA ARRENDADORA:

		a) Ser legítima propietario del inmueble ubicado en la calle  Xicoténcatl No. 11101, Municipio de Tlaxcala, entre Francisco Sarabia y Emilio Carranza, Colonia Centro, C.P.  90300, Apizaco, Tlax.

		b) Que tiene su domicilio en Aquiles Serdan  1107, Colonia Centro, C.P.  90300 en Apizaco, Tlaxcala.

		c) Que  está inscrito en el Registro Federal de Contribuyentes con la clave HUGR-451211-118, y que puede expedir recibos de arrendamiento con todos los requisitos que requieran las leyes fiscales.

		2.- Declara LA ARRENDATARIA

		a) Que es una sociedad constituida y registrada conforme a las leyes, con domicilio social y principal asiento de sus negocios en la calle de Lago Trasimeno No. 36,  Colonia Anáhuac, de la ciudad de México, distrito Federal, lugar donde se le deberán practicas cualesquiera notificaciones con motivo del presente contrato.

		b) Que su representante legal tiene facultades para actos de administración con su nombre y que las mismas no le han sido limitadas o revocadas.

		c) Que su objeto social comprende, entre otras actividades, la compra-venta de medicinas, artículos de perfumería, abarrotes, regalos, discos, juguetes, accesorios diversos, Etc.

CLAUSULAS

		PRIMERA.- EL ARRENDADOR  da a la ARRENDATARIA a título de arrendamiento, el inmueble a que se refiere la declaración primera inciso a) de este contrato.

		SEGUNDA.- La ARRENDATARIA  pagará a EL ARRENDADOR en concepto de renta la cantidad de $30,000.00 (treinta mil pesos 00/100 m.n.), por mensualidades anticipadas, dentro de los 10 primeros días de cada mes.  EL ARRENDADOR repercutirá el Impuesto al Valor Agregado que corresponda y LA ARRENDATARIA  le retendrá el anticipo del Impuesto Sobre la Renta correspondiente, así como las dos terceras partes del IVA  repercutido. Todo pago de renta deberá hacerse precisamente contra la entrega del recibo que cumpla con todos los requisitos que exigen las leyes fiscales.

		TERCERA.- La renta convenida estará vigente durante doce meses. A partir del segundo año, inclusive, la renta se incrementará en el mismo porcentaje de la inflación correspondiente a los doce meses inmediatos anteriores, y así sucesivamente hasta la terminación del contrato. Servirá de base para el cálculo del índice inflacionario, el que dé a conocer el Banco de México.

		CUARTA.-  El presente contrato se celebra por un término forzoso de 10 AÑOS  para EL ARRENDADOR. Para  la ARRENDATARIA únicamente será forzoso el primer año de vigencia y los restantes años, de duración voluntaria. Para el caso de que dentro de los 09 años de duración voluntaria, LA ARRENDATARIA  quisiera darlo por terminado, bastará  que se lo notifique   a  EL ARRENDADOR con sesenta días naturales de anticipación.

		QUINTA.- El inmueble arrendado se destinará al uso de farmacia, farmacia de auto servicio, perfumería, compra-venta de abarrotes, juguetes, discos, regalos, fotografía, accesorios diversos y cualquier otra similar o conexo y que no está autorizado a traspaso de dicho local.

		SEXTA.- Será a cargo de  LA ARRENDATARIA todos los gastos que origine el mantenimiento del inmueble arrendado, como  son: pintura, pisos, muebles de baño, electricidad interna, cortinas metálicas y anuncios, y en general, cualquier reparación menor que sea necesario efectuar dentro del local sin derecho a indemnización o rembolso, LA ARRENDATARIA  podrá realizar en el inmueble todo tipo de obras útiles o de ornato.

		Será a cargo de EL ARRENDADOR todas las obras de reparación mayor que requiera el local arrendado, tales como: bajadas de agua pluvial, tinacos, filtraciones de agua, mantenimiento e impermeabilización de azoteas, drenajes, red interna de tuberías de agua potable y, en general las reparaciones que requiera la cimentación y estructura, muros  y techos del inmueble en que se ubica la localidad arrendada.

		SEPTIMA.-  Las partes convienen en que el consumo de agua será cubierto por EL ARRENDADOR.

		OCTAVA.- LA ARRENDATARIA tendrá el derecho de colocar en el interior, marquesina, frente y azotea del inmueble arrendado, uno o varios anuncios luminosos, y podrá  subarrendar un espacio de la localidad para que “SALUD PARA TODOS, A.C.”, brinde servicios médicos a la población.

		LA ARRENDATARIA subarrendara una superficie de 30 m2  para consultorio, a “SALUD PARA TODOS, A.C.”,  para que brinde servicios médicos a la población, mismo que tendrá como domicilio en calle  Xicoténcatl No. 1110-1”A”, Municipio de Tlaxcala, entre Francisco Sarabia y Emilio Carranza, Colonia Centro, C.P.  90300, Apizaco, Tlax. 

		EL ARRENDADOR, se compromete a entregar anualmente, copia de la boleta predial y boleta del agua sin adeudo y ya pagado, para realizar los trámites relacionados con la revalidación de la Licencia de Funcionamiento.

		NOVENA.- Este contrato se rescindirá en forma automática para el caso de que las autoridades administrativas municipales, estatales o federales restrinjan y/o  nieguen el uso comercial de farmacia en la ubicación del local arrendado, o bien condicionen su uso a la disposición de ciertos lugares de estacionamiento de vehículos para la clientela o por alguna causa imputable a el ARRENDADOR. En estos casos, el ARRENDADOR  deberá devolver a LA ARRENDATARIA  el importe de los anticipos de renta y el depósito en garantía del cumplimiento de este contrato.

		DECIMA.- El presente contrato entrará en vigor para todos sus efectos legales el día primero de junio de dos mil doce.

		En el acto de la firma de este contrato. LA ARRENDATARIA recibe las llaves y la posesión del inmueble, para poder realizar las obras  indispensables de acondicionamiento para la operación  del giro.

		DECIMA PRIMERA.-  En este acto LA ARRENDATARIA  entrega a  el ARRENDADOR la cantidad de $60,000.00 (sesenta mil pesos 00/100 m.n.), en concepto de depósito en garantía del cumplimiento del presente contrato, sirviendo la firma de este documento como recibo amplio y satisfactorio  dicha suma, la que será devuelta o compensada al término del presente contrato.

		DECIMA SEGUNDA.- Serán causas de recisión del presente contrato la falta de pago de dos o más mensualidades de renta y las demás reguladas por el Código Civil.

		DECIMA TERCERA.- EL ARRENDADOR manifiesta que la localidad arrendada no tiene adeudos por consumos de electricidad, anteriores a la fecha de este contrato. Para el caso de que existieren adeudos de consumos de energía eléctrica anteriores a la fecha de este contrato, el pago que de los mismos haga LA ARRENDATARIA le será descontado del importe de la renta.

		DECIMA CUARTA.- Para la interpretación y cumplimiento de este contrato las partes se someten a la jurisdicción de los Tribunales del fuero común que corresponda a la ubicación del inmueble arrendado, con renuncia expresa al fuero que por razón de sus domicilios presentes o futuros les pudiera llegar a corresponder.

		El presente contrato se firma en Apizaco, Tlax.,  el día treinta de mayo de dos mil doce.

EL ARRENDADOR				LA ARRENDATARIA

Sr. Ramón Huitron González			FARMACIAS DE GENERICOS, S.A. DE C.V.
						Lic. Gerardo González Zirión
						Apoderado.
	
");
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