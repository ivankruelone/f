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
Contrato de arrendamiento que celebran por una parte el Sr. RAMON HUITRON GONZALEZ  quien  ser� �EL ARRENDADOR�  y por la otra y como �ARRENDATARIA�, �FARMACIA DE GENERICOS, S.A. DE C.V.�,   representada por su apoderado general Lic. Gerardo Gonz�lez Ziri�n  de acuerdo a las siguientes declaraciones y cl�usulas

DECLARACIONES

		1.- Declara LA ARRENDADORA:

		a) Ser leg�tima propietario del inmueble ubicado en la calle  Xicot�ncatl No. 11101, Municipio de Tlaxcala, entre Francisco Sarabia y Emilio Carranza, Colonia Centro, C.P.  90300, Apizaco, Tlax.

		b) Que tiene su domicilio en Aquiles Serdan  1107, Colonia Centro, C.P.  90300 en Apizaco, Tlaxcala.

		c) Que  est� inscrito en el Registro Federal de Contribuyentes con la clave HUGR-451211-118, y que puede expedir recibos de arrendamiento con todos los requisitos que requieran las leyes fiscales.

		2.- Declara LA ARRENDATARIA

		a) Que es una sociedad constituida y registrada conforme a las leyes, con domicilio social y principal asiento de sus negocios en la calle de Lago Trasimeno No. 36,  Colonia An�huac, de la ciudad de M�xico, distrito Federal, lugar donde se le deber�n practicas cualesquiera notificaciones con motivo del presente contrato.

		b) Que su representante legal tiene facultades para actos de administraci�n con su nombre y que las mismas no le han sido limitadas o revocadas.

		c) Que su objeto social comprende, entre otras actividades, la compra-venta de medicinas, art�culos de perfumer�a, abarrotes, regalos, discos, juguetes, accesorios diversos, Etc.

CLAUSULAS

		PRIMERA.- EL ARRENDADOR  da a la ARRENDATARIA a t�tulo de arrendamiento, el inmueble a que se refiere la declaraci�n primera inciso a) de este contrato.

		SEGUNDA.- La ARRENDATARIA  pagar� a EL ARRENDADOR en concepto de renta la cantidad de $30,000.00 (treinta mil pesos 00/100 m.n.), por mensualidades anticipadas, dentro de los 10 primeros d�as de cada mes.  EL ARRENDADOR repercutir� el Impuesto al Valor Agregado que corresponda y LA ARRENDATARIA  le retendr� el anticipo del Impuesto Sobre la Renta correspondiente, as� como las dos terceras partes del IVA  repercutido. Todo pago de renta deber� hacerse precisamente contra la entrega del recibo que cumpla con todos los requisitos que exigen las leyes fiscales.

		TERCERA.- La renta convenida estar� vigente durante doce meses. A partir del segundo a�o, inclusive, la renta se incrementar� en el mismo porcentaje de la inflaci�n correspondiente a los doce meses inmediatos anteriores, y as� sucesivamente hasta la terminaci�n del contrato. Servir� de base para el c�lculo del �ndice inflacionario, el que d� a conocer el Banco de M�xico.

		CUARTA.-  El presente contrato se celebra por un t�rmino forzoso de 10 A�OS  para EL ARRENDADOR. Para  la ARRENDATARIA �nicamente ser� forzoso el primer a�o de vigencia y los restantes a�os, de duraci�n voluntaria. Para el caso de que dentro de los 09 a�os de duraci�n voluntaria, LA ARRENDATARIA  quisiera darlo por terminado, bastar�  que se lo notifique   a  EL ARRENDADOR con sesenta d�as naturales de anticipaci�n.

		QUINTA.- El inmueble arrendado se destinar� al uso de farmacia, farmacia de auto servicio, perfumer�a, compra-venta de abarrotes, juguetes, discos, regalos, fotograf�a, accesorios diversos y cualquier otra similar o conexo y que no est� autorizado a traspaso de dicho local.

		SEXTA.- Ser� a cargo de  LA ARRENDATARIA todos los gastos que origine el mantenimiento del inmueble arrendado, como  son: pintura, pisos, muebles de ba�o, electricidad interna, cortinas met�licas y anuncios, y en general, cualquier reparaci�n menor que sea necesario efectuar dentro del local sin derecho a indemnizaci�n o rembolso, LA ARRENDATARIA  podr� realizar en el inmueble todo tipo de obras �tiles o de ornato.

		Ser� a cargo de EL ARRENDADOR todas las obras de reparaci�n mayor que requiera el local arrendado, tales como: bajadas de agua pluvial, tinacos, filtraciones de agua, mantenimiento e impermeabilizaci�n de azoteas, drenajes, red interna de tuber�as de agua potable y, en general las reparaciones que requiera la cimentaci�n y estructura, muros  y techos del inmueble en que se ubica la localidad arrendada.

		SEPTIMA.-  Las partes convienen en que el consumo de agua ser� cubierto por EL ARRENDADOR.

		OCTAVA.- LA ARRENDATARIA tendr� el derecho de colocar en el interior, marquesina, frente y azotea del inmueble arrendado, uno o varios anuncios luminosos, y podr�  subarrendar un espacio de la localidad para que �SALUD PARA TODOS, A.C.�, brinde servicios m�dicos a la poblaci�n.

		LA ARRENDATARIA subarrendara una superficie de 30 m2  para consultorio, a �SALUD PARA TODOS, A.C.�,  para que brinde servicios m�dicos a la poblaci�n, mismo que tendr� como domicilio en calle  Xicot�ncatl No. 1110-1�A�, Municipio de Tlaxcala, entre Francisco Sarabia y Emilio Carranza, Colonia Centro, C.P.  90300, Apizaco, Tlax. 

		EL ARRENDADOR, se compromete a entregar anualmente, copia de la boleta predial y boleta del agua sin adeudo y ya pagado, para realizar los tr�mites relacionados con la revalidaci�n de la Licencia de Funcionamiento.

		NOVENA.- Este contrato se rescindir� en forma autom�tica para el caso de que las autoridades administrativas municipales, estatales o federales restrinjan y/o  nieguen el uso comercial de farmacia en la ubicaci�n del local arrendado, o bien condicionen su uso a la disposici�n de ciertos lugares de estacionamiento de veh�culos para la clientela o por alguna causa imputable a el ARRENDADOR. En estos casos, el ARRENDADOR  deber� devolver a LA ARRENDATARIA  el importe de los anticipos de renta y el dep�sito en garant�a del cumplimiento de este contrato.

		DECIMA.- El presente contrato entrar� en vigor para todos sus efectos legales el d�a primero de junio de dos mil doce.

		En el acto de la firma de este contrato. LA ARRENDATARIA recibe las llaves y la posesi�n del inmueble, para poder realizar las obras  indispensables de acondicionamiento para la operaci�n  del giro.

		DECIMA PRIMERA.-  En este acto LA ARRENDATARIA  entrega a  el ARRENDADOR la cantidad de $60,000.00 (sesenta mil pesos 00/100 m.n.), en concepto de dep�sito en garant�a del cumplimiento del presente contrato, sirviendo la firma de este documento como recibo amplio y satisfactorio  dicha suma, la que ser� devuelta o compensada al t�rmino del presente contrato.

		DECIMA SEGUNDA.- Ser�n causas de recisi�n del presente contrato la falta de pago de dos o m�s mensualidades de renta y las dem�s reguladas por el C�digo Civil.

		DECIMA TERCERA.- EL ARRENDADOR manifiesta que la localidad arrendada no tiene adeudos por consumos de electricidad, anteriores a la fecha de este contrato. Para el caso de que existieren adeudos de consumos de energ�a el�ctrica anteriores a la fecha de este contrato, el pago que de los mismos haga LA ARRENDATARIA le ser� descontado del importe de la renta.

		DECIMA CUARTA.- Para la interpretaci�n y cumplimiento de este contrato las partes se someten a la jurisdicci�n de los Tribunales del fuero com�n que corresponda a la ubicaci�n del inmueble arrendado, con renuncia expresa al fuero que por raz�n de sus domicilios presentes o futuros les pudiera llegar a corresponder.

		El presente contrato se firma en Apizaco, Tlax.,  el d�a treinta de mayo de dos mil doce.

EL ARRENDADOR				LA ARRENDATARIA

Sr. Ram�n Huitron Gonz�lez			FARMACIAS DE GENERICOS, S.A. DE C.V.
						Lic. Gerardo Gonz�lez Ziri�n
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