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
$pdf = new MYPDF('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false); 

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

//----------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------
$s = "select a.*,b.linx 
from desarrollo.cortes_g a
left join catalogo.lineas_cortes b on a.clave1=b.lin 
where  fecha='$fecha' and a.suc=$suc order by clave1
       ";
        $q = $this->db->query($s);
        $detalle="
         <table border=\".1\">
            <tr>
           <td colspan=\"3\" align=\"center\"><strong>REPORTE DE VENTAS MENSUAL DE $mesx DEL $aaa</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"3\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')."<br /></td>
           </tr>
           <tr>
           <td colspan=\"3\" align=\"center\">SUCURSAL..:<strong>".$suc." DEL ".$sucx."</strong> <br /></td>
           </tr>
 
        <tr>
        <th align=\"left\"><strong>LINEA</strong></th>
        <th align=\"right\"><strong>IMPORTE</strong></th>
        <th align=\"right\"><strong>IMPORTE SIN IVA</strong></th>
        </tr>
        ";
       $total1=0;
       $total2=0;
       $total3=0;
       $vta_gontor=0;
       $incremento='';
       foreach($q->result() as $r)
        {
if($r->his_vta==0 and $r->siniva>=100000 and $r->tipo2=='G'){$incremento=30;}
if($r->his_vta==0 and $r->siniva>=150000 and $r->tipo2=='D'){$incremento=30;}

        $detalle.="
        <tr>
            <td align=\"left\"><font color=\"black\">".str_pad($r->clave1,2,"0",STR_PAD_LEFT)." - ".$r->linx."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->corregido,2)."</font></td>
            <td align=\"right\"><font color=\"black\">".number_format($r->siniva,2)."</font></td>
        </tr>
        ";
        $total1=$total1+$r->corregido;
        $total2=$total2+$r->siniva;
        $his_vta=$r->his_vta;
        
        if($r->clave1<>20){$total3=$total3+$r->siniva;$vta_nat=$r->vta_naturista;}
        if($r->clave1 == 10 || $r->clave1 == 11 || $r->clave1 == 16 ){$vta_gontor=$vta_gontor+$r->siniva;}    
        }
        $porce=round(($vta_nat*100)/$total3,2); 
       $detalle.="
       <tr>
            <td align=\"right\"><font color=\"blue\"><strong>TOTAL</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($total1,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($total2,2)."</strong></font></td>
        </tr>
        <tr>
            <td align=\"left\"><font color=\"blue\"><strong>TOTAL VENTA SIN RECARGAS</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong></strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($total3,2)."</strong></font></td>
         </tr>
         <tr>
            <td align=\"left\"><font color=\"blue\"><strong>TOTAL VENTA ENERGIA Y VIDA</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>NATURISTA v VENTA % ".number_format($porce,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($vta_nat,2)."</strong></font></td>
        </tr>
        <tr>
            <td align=\"left\"><font color=\"blue\"><strong>TOTAL VENTA GONTOR E IMPERIAL</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong></strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($vta_gontor,2)."</strong></font></td>
        </tr>
        <tr>
            <td align=\"center\" colspan=\"3\"><font color=\"red\"><strong>HISTORICO DE VENTA ".number_format($his_vta,2)."</strong></font></td>
        </tr>
       </table>
        ";    
 
$s1 = "select * from vtadc.comision where suc=$suc and puestox=''  and fecha='$fecha' order by puesto";
        $q1 = $this->db->query($s1);
$detalle.="
         <table border=\".1\">
            <tr>
           <td colspan=\"11\" align=\"center\"><strong>PREMIOS DE $mesx DEL $aaa</strong></td>
           </tr>
           <tr>
           <td colspan=\"11\" align=\"center\">SUCURSAL..:<strong>".$suc." DEL ".$sucx."</strong> <br /></td>
           </tr>
 
        <tr>
        <th colspan=\"8\" align=\"right\"><strong></strong></th>
        <th colspan=\"3\" align=\"center\"><strong>ENERGIA Y VIDA</strong></th>
        </tr>

        <tr>
        <th align=\"center\" colspan=\"2\"><strong>PUESTO</strong></th>
        <th align=\"center\"  colspan=\"6\"><strong>EMPLEADO</strong></th>
        <th align=\"center\"><strong>$ VENTA</strong></th>
        <th align=\"center\"><strong>$ PUESTO</strong></th>
        <th align=\"center\"><strong>$ TOTAL</strong></th>
        </tr>
        ";
foreach($q1->result() as $r1)
        {
            //fecha, suc, cianom, nomina, pat, mat, nom,
            // vta_dias, incre_dias, natur, ger_vta, ger_nat, sup_vta, sup_nat, enc_nat, jef_nat, puesto
$detalle.="
         <tr>
            <td align=\"left\" colspan=\"2\"><font color=\"black\">".$r1->puesto."</font></td>
            <td align=\"left\" colspan=\"6\"><font color=\"black\">".str_pad($r1->nomina,6,"0",STR_PAD_LEFT)." - ".trim($r1->pat)." ".trim($r1->mat)." ".trim($r1->nom)."</font></td>
            <td align=\"center\"><font color=\"blue\"><strong>".$r1->natur."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong> $ ".number_format($r1->enc_nat+$r1->jef_nat,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong> $ ".number_format($r1->enc_nat+$r1->jef_nat+$r1->natur,2)."</strong></font></td>
        </tr> ";  
        }
$detalle.="</table>";
$s2 = "select * from vtadc.comision where suc=$suc and puestox<>'' and fecha='$fecha' order by puesto";
        $q2 = $this->db->query($s2);
$detalle.="<table>
<tr>
<td colspan=\"3\"></td>
<td colspan=\"7\"></td>
<td colspan=\"2\"></td>
</tr>";
        foreach($q2->result() as $r2)
        {
$detalle.="

         <tr bgcolor=\"#DDD5D5\">
            <td align=\"left\" colspan=\"3\">".$r2->puesto."</td>
            <td align=\"left\" colspan=\"7\">".str_pad($r2->nomina,6,"0",STR_PAD_LEFT)." - ".trim($r2->pat)." ".trim($r2->mat)." ".trim($r2->nom)."</td>
            <td align=\"right\" colspan=\"2\"><strong> $ ".number_format($r2->sup_vta+$r2->sup_nat+$r2->ger_vta+$r2->ger_nat,2)."</strong></td>
        </tr> ";  
        }           
 

$detalle.=" </table>";           
//----------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------

$pdf->SetFont('helvetica', '', 8	);

$pdf->AddPage();
$tbl = <<<EOD
$detalle
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');



//Close and output PDF document
$pdf->Output('pedido.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+