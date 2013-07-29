<?php
global $cabezota;

$cabezota=$cabeza;

require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');
require_once('mypdf.php');

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
$f='';
$tot05=0;
$tot06=0;
$totgral=0;
$totped=0; 
$totimp=0;
       $s = "select a.*, sum(a.ped)as ped,sum(a.ped*a.vta)as imp, b.nombre as sucx,c.nom as ruta 
       from pedidos a 
       left join catalogo.sucursal b on b.suc=a.suc
       left join catalogo.almacen_rutas c on c.suc=a.suc and c.ruta=a.bloque
       left join catalogo.folio_pedidos_cedis d on d.id=a.fol
       where date(a.fechas)='$fecha' and tipo=1 and ped>0  and invcedis>0 and fol>=$fol1 and fol<=$fol2  group by suc,fol  order by suc,fol";
        $q = $this->db->query($s);
           $e.="<table border=\"1\" cellpadding=\"4\">
          
          ";
        $num=0;
        $num1=0;
        $num6=0;
        $normal=0;
         foreach($q->result() as $r)
         {
         
        $sx = "select a.*, sum(a.ped)as control 
       from pedidos a 
       where a.fechas between '$fecha' and '$fecha 23:59:59' and tipo=1 and ped>0  and invcedis>0 and mue=6 and fol=$r->fol  group by suc";
        $qx = $this->db->query($sx);
        if($qx->num_rows() > 0){
        $rx=$qx->row();
        $control=$rx->control;
        }else{
        $control=0;    
        }
        $num=$num+1;  
       $e.="
            <tr>
            <td width=\"30\" align=\"center\">".$num."</td>
            <td width=\"150\" align=\"left\">".$r->ruta."</td>
            <td width=\"70\" align=\"left\">".$r->fol."</td>
            <td width=\"30\" align=\"center\">".$r->tsuc."</td>
            <td width=\"160\" align=\"left\">".$r->suc." - ".$r->sucx."</td>
            <td width=\"55\" align=\"right\">".number_format($r->ped-$control,0)."</td>
            <td width=\"50\" align=\"right\">".number_format($control,0)."</td>
            <td width=\"55\" align=\"right\">".number_format($r->ped,0)."</td>
             <td width=\"80\" align=\"right\">$".number_format($r->imp,2)."</td>
            </tr>";   
            
        $normal=$r->ped-$control;      
        $tot05=$tot05+$r->ped-$control; 
        $tot06=$tot06+$control; 
        $totgral=$totgral+$r->ped;
        $totimp=$totimp+$r->imp; 
        if($control>0){$num6=$num6+1;}
        if($normal>0){$num1=$num1+1;}
        }
        
       $e.="
        <tr bgcolor=\"#E6E6E6\"><br />
        <td width=\"440\" align=\"right\"><strong>TOTAL CANTIDAD</strong></td>
        <td width=\"55\" align=\"right\"><strong>".number_format($tot05,0)."</strong></td>
        <td width=\"50\" align=\"right\"><strong>".number_format($tot06,0)."</strong></td>
        <td width=\"55\" align=\"right\"><strong>".number_format($totgral,0)."</strong></td>
        <td width=\"80\" align=\"right\"><strong>$".number_format($totimp,2)."</strong></td>
        </tr>

         <tr>
        <td width=\"680\" align=\"left\">SUCURSALES ALMACEN CONTROL.....: $num6</td>
        </tr>
        <tr>
        <td width=\"680\" align=\"left\">SUCURSALES ALMACEN GENERAL.....: $num1 </td>
        </tr>

        
        <tr>
        <td width=\"680\" align=\"center\">ATENTAMENTE<br /><br /><br /><br /><br /><br /></td>
        </tr>
        <tr>
        <td width=\"680\" align=\"center\">__________________________________________________________________</td>
        </tr>
        
        <tr>
        <td width=\"680\" align=\"center\">LIC. CARLOS ALBERTO CANSECO ORTEGA</td>
        </tr>
        <tr>
        <td width=\"680\" align=\"center\">GERENTE DE SISTEMAS</td>
        </tr>
        
        </table>";

// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// --------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------
// ---------------------------------------------------------  
// set font
$pdf->SetFont('helvetica', '', 7	);

$pdf->AddPage();
$tbl = <<<EOD
$e
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
$e='';
// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------



//Close and output PDF document
$pdf->Output($nomarchivo, $salida);

//============================================================+
// END OF FILE                                                 
//============================================================+