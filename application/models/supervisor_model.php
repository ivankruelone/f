<?php
class Supervisor_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
    }
     
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_cortes($fec)
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*
		from catalogo.sucursal a where a.superv=$plaza or a.regional=$plaza and a.tlid=1 and a.suc>100 and a.suc<=2000
		order by a.superv,suc";   
        $q = $this->db->query($s);
        
$num=0;
		   $totfal=0;
           $totsob=0;
           $tottar=0;
           $totvale=0;
           $totpesos=0;
           $totasalto=0;
           $totcorte=0;
           $totmn=0;
           $totarqueo=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUCURSAL</th>
        <th>DIAS</th>
        <th>EFEC.</th>
        <th>CONV.</th>
        <th>TAR.</th>
        <th>VALE</th>
        <th>ASALTO</th>
        <th>ARQUEO</th>
        <th>CORTE</th>
        <th>FAL</th>
        <th>SOB</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
		$sx="select count(*)as dias,
sum(turno1_fal + turno2_fal + turno3_fal + turno4_fal)as fal,
sum(turno1_sob + turno2_sob + turno3_sob + turno4_sob)as sob,
sum(turno1_exp + turno2_exp + turno3_exp + turno4_exp +
turno1_bbv + turno2_bbv + turno3_bbv + turno4_bbv+ 
turno1_san + turno2_san + turno3_san + turno4_san)as tar,
sum(turno1_vale + turno2_vale + turno3_vale + turno4_vale)as vale,
sum(turno1_pesos + turno2_pesos + turno3_pesos + turno4_pesos)as pesos,
sum(turno1_mn + turno2_mn + turno3_mn + turno4_mn)as mn,
sum(turno1_corte + turno2_corte + turno3_corte + turno4_corte)as corte,
sum(turno1_asalto + turno2_asalto + turno3_asalto + turno4_asalto)as asalto

		 from desarrollo.cortes_c where suc=$r->suc and date_format(fechacorte,'%Y-%m')='$fec' group by suc";       
	    $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){
 		   $rx= $qx->row();
           $dias=$rx->dias;	
           $fal=$rx->fal;
           $sob=$rx->sob;
           $tar=$rx->tar;
           $vale=$rx->vale;
           $pesos=$rx->pesos;
           $asalto=$rx->asalto;
           $corte=$rx->corte;
           $mn=$rx->mn;
           $arqueo=$tar+$vale+$pesos+$asalto+$mn;
	    }else{
	       $dias=0;
	       $fal=0;
           $sob=0;
           $tar=0;
           $vale=0;
           $pesos=0;
           $asalto=0;
           $corte=0;
           $mn=0;
           $arqueo=0;
	    }
	   
	   $num=$num+1;
       $l1 = anchor('supervisor/corte_dia/'.$r->suc.'/'.$fec,$r->tipo2.' - '.$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
           
            $fol=0;
            $fechas=0;
            $ped=0;
           
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\">".$dias."</td>
            <td align=\"right\">".number_format($pesos,2)."</td>
            <td align=\"right\">".number_format($mn,2)."</td>
			<td align=\"right\">".number_format($tar,2)."</td>
            <td align=\"right\">".number_format($vale,2)."</td>
            <td align=\"right\">".number_format($asalto,2)."</td>
            <td align=\"right\">".number_format($arqueo,2)."</td>
            <td align=\"right\">".number_format($corte,2)."</td>
            <td align=\"right\">".number_format($fal,2)."</td>
            <td align=\"right\">".number_format($sob,2)."</td>
            
             
            </tr>
            ";
           $totfal=$totfal+$fal;
           $totsob=$totsob+$sob;
           $tottar=$tottar+$tar;
           $totvale=$totvale+$vale;
           $totpesos=$totpesos+$pesos;
           $totasalto=$totasalto+$asalto;
           $totcorte=$totcorte+$corte;
           $totmn=$totmn+$mn;
           $totarqueo=$totarqueo+$arqueo;
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"2\">TOTAL</td>
            <td align=\"right\">".number_format($totpesos,2)."</td>
            <td align=\"right\">".number_format($totmn,2)."</td>
			<td align=\"right\">".number_format($tottar,2)."</td>
            <td align=\"right\">".number_format($totvale,2)."</td>
            <td align=\"right\">".number_format($totasalto,2)."</td>
            <td align=\"right\">".number_format($totarqueo,2)."</td>
            <td align=\"right\">".number_format($totcorte,2)."</td>
            <td align=\"right\">".number_format($totfal,2)."</td>
            <td align=\"right\">".number_format($totsob,2)."</td>
            
        </tr>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function control_corte_dia($fec,$suc)
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
$s="select fechacorte,id,
(turno1_fal + turno2_fal + turno3_fal + turno4_fal)as fal,
(turno1_sob + turno2_sob + turno3_sob + turno4_sob)as sob,
(turno1_exp + turno2_exp + turno3_exp + turno4_exp +
turno1_bbv + turno2_bbv + turno3_bbv + turno4_bbv+ 
turno1_san + turno2_san + turno3_san + turno4_san)as tar,
(turno1_vale + turno2_vale + turno3_vale + turno4_vale)as vale,
(turno1_pesos + turno2_pesos + turno3_pesos + turno4_pesos)as pesos,
(turno1_mn + turno2_mn + turno3_mn + turno4_mn)as mn,
(turno1_asalto + turno2_asalto + turno3_asalto + turno4_asalto)as asalto,
(turno1_corte + turno2_corte + turno3_corte + turno4_corte)as corte,

(turno1_exp + turno2_exp + turno3_exp + turno4_exp +
turno1_bbv + turno2_bbv + turno3_bbv + turno4_bbv + 
turno1_san + turno2_san + turno3_san + turno4_san +
turno1_vale + turno2_vale + turno3_vale + turno4_vale +
turno1_pesos + turno2_pesos + turno3_pesos + turno4_pesos +
turno1_mn + turno2_mn + turno3_mn + turno4_mn +
turno1_asalto + turno2_asalto + turno3_asalto + turno4_asalto)as arqueo


		 from desarrollo.cortes_c where suc=$suc and date_format(fechacorte,'%Y-%m')='$fec'";       
$q = $this->db->query($s);
        
$num=0;
		   $totfal=0;
           $totsob=0;
           $tottar=0;
           $totvale=0;
           $totpesos=0;
           $totasalto=0;
           $totcorte=0;
           $totmn=0;
           $totarqueo=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>FECHA</th>
        <th>EFEC.</th>
        <th>CONV.</th>
        <th>TAR.</th>
        <th>VALE</th>
        <th>ASALTO</th>
        <th>ARQUEO</th>
        <th>CORTE</th>
        <th>FAL</th>
        <th>SOB</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
	   
	   $num=$num+1;
       $l1 = anchor('supervisor/corte_detalle/'.$r->id.'/'.$fec.'/'.$suc,$r->fechacorte.' </a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
           
            $tabla.="
            <tr>
            <td align=\"right\">".$l1."</td>
            <td align=\"right\">".number_format($r->pesos,2)."</td>
            <td align=\"right\">".number_format($r->mn,2)."</td>
			<td align=\"right\">".number_format($r->tar,2)."</td>
            <td align=\"right\">".number_format($r->vale,2)."</td>
            <td align=\"right\">".number_format($r->asalto,2)."</td>
            <td align=\"right\">".number_format($r->arqueo,2)."</td>
            <td align=\"right\">".number_format($r->corte,2)."</td>
            <td align=\"right\">".number_format($r->fal,2)."</td>
            <td align=\"right\">".number_format($r->sob,2)."</td>
            
             
            </tr>
            ";
           $totfal=$totfal+$r->fal;
           $totsob=$totsob+$r->sob;
           $tottar=$tottar+$r->tar;
           $totvale=$totvale+$r->vale;
           $totpesos=$totpesos+$r->pesos;
           $totasalto=$totasalto+$r->asalto;
           $totcorte=$totcorte+$r->corte;
           $totmn=$totmn+$r->mn;
           $totarqueo=$totarqueo+$r->arqueo;
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"1\">TOTAL</td>
            <td align=\"right\">".number_format($totpesos,2)."</td>
            <td align=\"right\">".number_format($totmn,2)."</td>
			<td align=\"right\">".number_format($tottar,2)."</td>
            <td align=\"right\">".number_format($totvale,2)."</td>
            <td align=\"right\">".number_format($totasalto,2)."</td>
            <td align=\"right\">".number_format($totarqueo,2)."</td>
            <td align=\"right\">".number_format($totcorte,2)."</td>
            <td align=\"right\">".number_format($totfal,2)."</td>
            <td align=\"right\">".number_format($totsob,2)."</td>
            
        </tr>
        </table>";
        
        return $tabla;
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_cortes_recarga($fec)
    {
        $ci=& get_instance();
        $ci->load->model('cortes_model');
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select *from catalogo.sucursal a 
        where superv=$plaza  and a.tlid=1 and a.suc>100 and a.suc<=2000 
        or 
        regional= $plaza  and a.tlid=1 and a.suc>100 and a.suc<=2000
        order by superv,suc";   
        $q = $this->db->query($s);
        
$num=0;
		   $totrec=0;
          
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUCURSAL</th>
        <th>DIAS</th>
        <th>RECARGA PDV</th>
        <th>COMANCHE.</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  		$monto=0;
  		$totcom=0;
        foreach($q->result() as $r)
        {
        $suc=$r->suc;
            
        
        $monto=$ci->cortes_model->tam($suc,$fec);
            
		$sx="select count(fechacorte)as dias
		 from desarrollo.cortes_c a
         where suc=$r->suc and date_format(fechacorte,'%Y-%m')='$fec' group by suc";       
	    $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){$rx= $qx->row();
           $dias=$rx->dias;	
	    }else{$dias=0;}
		$sx1="select a.id, sum(b.corregido)as recarga
		 from desarrollo.cortes_c a
         left join desarrollo.cortes_d b on b.id_cc=a.id and b.clave1=20
          where suc=$r->suc and date_format(fechacorte,'%Y-%m')='$fec' group by suc";       
	    $qx1 = $this->db->query($sx1);
	    if($qx1->num_rows()> 0){$rx1= $qx1->row();
         $recarga=$rx1->recarga;
	    }else{$recarga=0;}



	   
	   $num=$num+1;
       $l1 = anchor('supervisor/corte_dia_comanche/'.$r->suc.'/'.$fec,$r->tipo2.' - '.$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
        if($recarga<>$monto){$color='red';}else{$color='black';}   
            $fol=0;
            $fechas=0;
            $ped=0;
           
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\"><font color=\"$color\">".$dias."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($recarga,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($monto,2)."</font></td>
            
            
             
            </tr>
            ";
           $totrec=$totrec+$recarga;
           $totcom=$totcom+$monto;
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"2\">TOTAL</td>
            <td align=\"right\">".number_format($totrec,2)."</td>
            <td align=\"right\">".number_format($totcom,2)."</td>
        </tr>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function control_corte_dia_comanche($fec,$suc)
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
$s="select id, fechacorte from desarrollo.cortes_c where suc=$suc and date_format(fechacorte,'%Y-%m')='$fec'";          
$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>FECHA</th>
        <th>RECARGGA PDV</th>
        <th>COMANCHE</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $totmon=0;
  $totrec=0;
        foreach($q->result() as $r)
        {
	   $monto=$this->__tablo($suc,$r->fechacorte);
       $sx1="select *from desarrollo.cortes_d b where b.id_cc=$r->id and b.clave1=20";    	    $qx1 = $this->db->query($sx1);
	    if($qx1->num_rows()> 0){$rx1= $qx1->row();
         $recarga=$rx1->corregido;
	    }else{$recarga=0;}
 if($recarga<>$monto){$color='red';}else{$color='black';}
	   $num=$num+1;
            $tabla.="
            <tr>
            <td align=\"right\"><font color=\"$color\">".$r->fechacorte."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($recarga,2)."</font></td>
            <td align=\"right\"><font color=\"$color\">".number_format($monto,2)."</font></td>
			</tr>
            ";
           $totmon=$totmon+$monto;
           $totrec=$totrec+$recarga;
           
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"1\">TOTAL</td>
            <td align=\"right\">".number_format($totrec,2)."</td>
            <td align=\"right\">".number_format($totrec,2)."</td>
			</tr>
        </table>";
        
        return $tabla;
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////


   function __tablo($sucursal, $fecha)
    {
        $this->load->library('nuSoap_lib');
        
        
$client = new nusoap_client("http://192.168.1.79/comanche/index.php/wsta/MontoSucursalDia_/wsdl", false);
$client->soap_defencoding = 'UTF-8';

$err = $client->getError();
if ($err) {
	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
	exit();
}
// This is an archaic parameter list
$params = array(
                    'user'		    => 'ivankruel',
                    'password'		=> 'garigol',
                    'sucursal'      => $sucursal,
                    'fecha'         => $fecha
                    );


$result = $client->call('MontoSucursalDia', $params, 'http://ResultadoWSDL', 'ResultadoWSDL#MontoSucursalDia');

if ($client->fault) {
	echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
} else {
	$err = $client->getError();
	if ($err) {
		echo '<h2>Error</h2><pre>' . $err . '</pre>';
	} else {
		//echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
        return $result['monto'];
        
	}
}

    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
    function control_pedidos_ger($fec)
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,b.nombre as superx,b.puesto,b.email
		from catalogo.sucursal a
		left join usuarios b on b.plaza=a.superv and b.nivel=14 and responsable='R'
		where regional=$plaza and b.activo=1  and a.tlid=1 and a.suc>100 and a.suc<=2000
		group by superv
		order by superv";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUCURSAL</th>
        <th>SUPERVISOR</th>
        <th>ZONA</th>
        <th>CORREO</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $pedtot=0;
        foreach($q->result() as $r)
        {
		$num=$num+1;
       $l1 = anchor('supervisor/tabla_control_pedidos_ger_det/'.$fec.'/'.$r->superv,$r->superx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"left\">".$r->puesto."</td>
            <td align=\"center\">".$r->superv."</td>
            <td align=\"left\">".$r->email."</td>
            
            </tr>
            ";
         $pedtot=0;  
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }

///////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_pedidos_ger_sup($fec,$sup)
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,b.nombre as superx,b.puesto
		from catalogo.sucursal a
		left join usuarios b on b.plaza=a.superv and b.nivel=14 and responsable='R'
		where regional=$plaza and b.activo=1 and superv=$sup  and a.tlid=1 and a.suc>100 and a.suc<=2000
		order by suc";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUCURSAL</th>
        <th>SUPERVISOR</th>
        <th>PEDIDOS EN EL MES</th>
        <th>DIA</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $pedtot=0;
        foreach($q->result() as $r)
        {
		$sx="select count(*)as ped from catalogo.folio_pedidos_cedis
		 where suc=$r->suc and date_format(fechas,'%Y-%m')='$fec' and tid<>'X'  group by suc";       
	    $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){
 		   $rx= $qx->row();
           $numped=$rx->ped;}else{$numped=0;}
      $sx="select count(*)as ped from catalogo.folio_pedidos_cedis_especial
		 where suc=$r->suc and date_format(fechas,'%Y-%m')='$fec' and tid<>'X'  group by suc";       
	    $qx1 = $this->db->query($sx);
	    if($qx1->num_rows()> 0){
 		   $rx1= $qx1->row();
           $numped1=$rx1->ped;}else{$numped1=0;}
	   $pedtot=$numped+$numped1;
	   $num=$num+1;
       $l1 = anchor('supervisor/pedido_folio/'.$r->suc.'/'.$fec,$r->tipo2.' - '.$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"left\">".$r->superx."</td>
            <td align=\"center\">".$pedtot."</td>
            <td align=\"right\">".$r->dia."</td>
            
            </tr>
            ";
         $pedtot=0;  
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_pedidos($fec)
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select *from catalogo.sucursal a where superv=$plaza  and a.tlid=1 and a.suc>100 and a.suc<=2000";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUCURSAL</th>
        <th>PEDIDOS EN EL MES</th>
        <th>DIA</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
		$sx="select count(*)as ped from catalogo.folio_pedidos_cedis
		 where suc=$r->suc and date_format(fechas,'%Y-%m')='$fec' and tid<>'X'  group by suc";       
	    $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){
 		   $rx= $qx->row();
           $numped=$rx->ped;}else{$numped=0;}
	   
	   $num=$num+1;
       $l1 = anchor('supervisor/pedido_folio/'.$r->suc.'/'.$fec,$r->tipo2.' - '.$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"center\">".$numped."</td>
            <td align=\"right\">".$r->dia."</td>
            
            </tr>
            ";
           
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////////////
    function control_pedido_folio($fec,$suc)
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select *from catalogo.folio_pedidos_cedis
		 where suc=$suc and date_format(fechas,'%Y-%m')='$fec' and tid<>'X' ";  
          $q = $this->db->query($s);
        
        $num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        <tr>
		<th colspan=\"4\"></th>
		<th colspan=\"5\">NO SE TOMAN LOS DESCONTINUADOS</th>
		</tr>
        <tr>
        <th>FOLIO</th>
        <th>STATUS</th>
        <th>FECHA</th>
        <th>DESCONTI.</th>
        <th>PEDIDO</th>
        <th>GENERADO</th>
        <th>SURTIDO</th>
        <th>ABASTO<BR />SOLICITADO<BR /> v<BR /> SURTIDO</th>
        <th>ABASTO<BR />GENERADO<BR /> v<BR /> SURTIDO</th>
        </tr>

        </thead>
        <tbody>
        ";
        
 $tipox=''; 
        foreach($q->result() as $r)
        {
		$sx="select sum(can)as can,sum(ped)as ped,sum(sur)as sur from desarrollo.pedidos
		 where fol=$r->id and tipo=1";       
	    $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){
 		   $rx= $qx->row();
           $ped=$rx->ped;$sur=$rx->sur;$can=$rx->can;}else{$ped=0;$sur=0;$can=0;}
      $sxd="select sum(can)as can,sum(ped)as ped,sum(sur)as sur from desarrollo.pedidos
		 where fol=$r->id and tipo=4";       
	    $qxd = $this->db->query($sxd);
	    if($qxd->num_rows()> 0){
 		   $rxd= $qxd->row();
           $desco=$rxd->ped;}else{$desco=0;}
	   
	   if($sur==0){$abasto=0;}else{$abasto=($sur*100)/$ped;}
	   if($sur==0){$abastos=0;}else{$abastos=($sur*100)/$can;}
	   $num=$num+1;
       $l1 = anchor('supervisor/pedido_detalle/'.$r->suc.'/'.$fec.'/'.$r->id,$r->id.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
       $l2 = anchor('a_surtido/imprime_pedidos_rem/'.$r->id.'/'.$r->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado', 'target' => '_blank')); 
	   if($r->tid=='C'){$tipox='SURTIDO'; $color='black';}
       if($r->tid=='A'){$tipox='PENDIENTE'; $color='red';}	       
              $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"center\"><font color=\"$color\">".$tipox."</td>
            <td align=\"left\">".$r->fechas."</td>
            <td align=\"right\">".$desco."</td>
			<td align=\"right\">".$can."</td>
            <td align=\"right\">".$ped."</td>
            <td align=\"right\">".$sur."</td>
            <td align=\"right\"> % ".number_format($abastos,2)."</td>
            <td align=\"right\"> % ".number_format($abasto,2)."</td>
            <td align=\"right\">$l2</td>
            </tr>
            ";
          echo '1'; 
        }
        
        $l1e='';
        $se="select *from catalogo.folio_pedidos_cedis_especial
		 where suc=$suc and date_format(fechas,'%Y-%m')='$fec' and tid<>'X' ";  
        $qe = $this->db->query($se);
         if($qe->num_rows()> 0){
       	$tipox='';
        foreach($qe->result() as $re)
        {
         $sxe="select sum(can)as can,sum(ped)as ped,sum(sur)as sur from desarrollo.pedidos 
		 where fol=$re->id and tipo=1";       
	    $qxe = $this->db->query($sxe);
	    if($qxe->num_rows()> 0){
 		   $rxe= $qxe->row();
           $pede=$rxe->ped;$sure=$rxe->sur;$cane=$rxe->can;}else{$sure=0;$pede=0;$cane=0;}
           $sxde="select sum(can)as can,sum(ped)as ped,sum(sur)as sur from desarrollo.pedidos
		 where fol=$r->id and tipo=4";       
	    $qxde = $this->db->query($sxde);
	    if($qxde->num_rows()> 0){
 		   $rxde= $qxde->row();
           $descoe=$rxde->ped;}else{$descoe=0;}
	  
	   if($sure==0){$abastoe=0;}else{$abastoe=($sure*100)/$pede;}
	   if($sure==0){$abastoes=0;}else{$abastoes=($sure*100)/$cane;}
	   $num=$num+1;
       $l1e = anchor('supervisor/pedido_detalle/'.$re->suc.'/'.$fec.'/'.$re->id,$re->id.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
       $l2e = anchor('a_surtido/imprime_pedidos_rem/'.$re->id.'/'.$re->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado', 'target' => '_blank')); 
	   if($re->tid=='C'){$tipox='SURTIDO'; $color='black';}
       if($re->tid=='A'){$tipox='PENDIENTE'; $color='red';}	       
  
         
         $tabla.="
         <tr>
            <td align=\"left\">$l1e</td>
            <td align=\"center\"><font color=\"$color\">".$tipox."</td>
            <td align=\"left\">".$re->fechas."</td>
            <td align=\"right\">".$descoe."</td>
            <td align=\"right\">".$pede."</td>
            <td align=\"right\">".$cane."</td>
            <td align=\"right\">".$sure."</td>
            <td align=\"right\"> % ".number_format($abastoes,2)."</td>
            <td align=\"right\"> % ".number_format($abastoe,2)."</td>
            <td align=\"right\">$l2e</td>
			</tr>";
       
        
        
    
    }}
$tabla.=" </tbody>
        </table>";    
return $tabla;
}
//**************************************************************
//**************************************************************
//**************************************************************
    function control_pedido_detalle($suc,$fec,$fol)
    {
    $totped=0;
    $totcom=0;
	$totcan=0; 
	 $s = "SELECT * FROM pedidos
          where fol=$fol order by tipo,sec";
 $q = $this->db->query($s);
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>SEC</th>
        <th>SUSTANCIA ACTIVA</th>
        <th>PEDIDO</th>
        <th>SUCURSAL</th>
        <th></th>
        </tr>

        </thead>
        <tbody>
        ";
        $de='';
        foreach($q->result() as $r)
        {
        if($r->ped<>$r->sur){
        $color='red';
        }else{
        $color='black';    
        }
        if($r->tipo==4){$de='DESCONTINUADO';$color='blue';}
            $num=+1;
            $tabla.="
            <tr>
            
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->susa."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->can,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->ped,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->sur,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".$de."</font></td>
            </tr>
            ";
        $totcan=$totcan+$r->can;
        $totped=$totped+$r->ped;
        $totcom=$totcom+$r->sur;         
        }
        $porce=0;
		$porce=($totcom*100)/$totped;
        
  $tabla.="
        </tbody>
            <tr>
            <td align=\"left\" colspan=\"3\"><font size=\"-1\"><strong> % DE SUTIDO ".$porce." TOTAL </strong></font></td>
            <td align=\"right\"><font size=\"-1\" ><strong>".number_format($totcan,0)."</strong></font></td>
            <td align=\"right\"><font size=\"-1\" ><strong>".number_format($totped,0)."</strong></font></td>
            <td align=\"right\"><font size=\"-1\" ><strong>".number_format($totcom,0)."</strong></font></td>
            </tr>
         </table>";
        
        return $tabla;        
}
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
   function control_ventas($fec)
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select *from catalogo.sucursal a
        where superv=$plaza  and a.tlid=1 and a.suc>100 and a.suc<=2000
        or 
        regional=$plaza  and a.tlid=1 and a.suc>100 and a.suc<=2000 order by superv,suc";   
        $q = $this->db->query($s);
       
        $num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUCURSAL</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>TOTAL</th
        </tr>

        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
            
		$sx="select sum(can)as can, sum(importe)as importe, sum(can*des)as des, sum(can*vta)as vta  from vtadc.venta_detalle
		 where suc=$r->suc and date_format(fecha,'%Y-%m')='$fec' group by suc";       
	            $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){
 		   $rx= $qx->row();
           $can=$rx->can; $imp=$rx->importe;
           $vta=$rx->vta; $des=$rx->des;
           }else{$can=0;$imp=0;
           $vta=0;$des=0;
           }
	   
	   $num=$num+1;
       $l1 = anchor('supervisor/venta_producto/'.$r->suc.'/'.$fec,$r->tipo2.' - '.$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
       $l2 = anchor('supervisor/venta_dia/'.$r->suc.'/'.$fec,'DIAS</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));     
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\">".number_format($can,0)."</td>
            <td align=\"right\">".number_format($vta,2)."</td>
            <td align=\"right\">".number_format($des,2)."</td>
            <td align=\"right\">".number_format($imp,2)."</td>
            <td align=\"left\">$l2</td>
            </tr>
            ";
           
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
//**************************************************************
//**************************************************************
   function control_ventas_naturistas($fec)
    {
        
        $premiosup=0;
        $premioger=0;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*, 
        (select count(fecha) from desarrollo.cortes_c where suc=a.suc and date_format(fechacorte,'%Y-%m')='$fec')as dias
        from catalogo.sucursal a
        where superv=$plaza  and a.tlid=1 and a.suc>100 and a.suc<=2000
        or 
        regional=$plaza  and a.tlid=1 and a.suc>100 and a.suc<=2000 order by superv,suc";   
        $q = $this->db->query($s);
$lp = anchor('supervisor/venta_producto_naturistas_premio/'.$fec,'PREMIOS</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));       
        $num=0;
            $totcan=0;
            $totimp=0;
            $totdes=0;
            $totimp_b=0;
            $totimp_b_c=0;
            $totimp_b_c_iva=0;
            $totcomision=0;
        
        $tabla= "
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th></th>
        <th colspan=\"4\"><font color=\"green\">'.$lp.'</font></th>
        <th colspan=\"13\">COMISIONES NATURISTAS</th>
        </tr>
        <tr>
        <th>SUCURSAL</th>

        <th><font color=\"green\">HIST.VENTA</font></th>
        <th><font color=\"green\">GONTOR E IMPERIAL</font></th>
        <th><font color=\"green\">PREMIO</font></th>
        <th><font color=\"green\">POR INCREMENTO</font></th>
        
        <th>DIAS TRAB.COR</th>
        <th>VTA-IVA<br />
        -T.AIRE<br />DEPTO.CORTES</th>
        <th colspan=\"2\">% PORCENTAJE</th>
        <th>CANT.</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>IMP BRUTO</th>
        <th>CANC.</th>
        <th>IMP.CANC - IVA</th>
        <th>COMISION</th
        </tr>

        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
            
		$sx="select a.suc,b.nombre, sum(can) as cantidad, sum(can*vta)as imp, sum(can*des)as descuento,sum(importe)imp_bruto,sum(imp_cancela)as imp_cancela,
        sum(case when c.iva='S'
        then round((importe-imp_cancela)/(1+b.iva),2) 
        else
        (importe-imp_cancela)
        end)as imp_menos_iva_menos_cancela,

        sum(case when c.iva='S'
        then round(((importe-imp_cancela)/(1+b.iva)*.10),2)
        else
        round(((importe-imp_cancela)*.10),2)
        end)as comision

        from vtadc.venta_detalle_nat a
        left join catalogo.sucursal b on b.suc=a.suc
        left join catalogo.cat_naturistas c on c.sec=a.sec
        where tipo2<>'F' and b.suc=$r->suc and date_format(fecha, '%Y-%m') = '$fec'   group by suc";
        $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){
 		   $rx= $qx->row();
           $can=$rx->cantidad; 
           $imp=$rx->imp;
           $des=$rx->descuento;
           $imp_b=$rx->imp_bruto;
           $imp_b_c=$rx->imp_cancela;
           $imp_b_c_iva=$rx->imp_menos_iva_menos_cancela;
           $comision=$rx->comision;
                      
        $sx1="select suc,date_format(fechacorte,'%Y-%m'),sum(siniva)as siniva, sum(corregido)as venta
        from cortes_c a
        left join cortes_d b on b.id_cc=a.id
        where clave1>0 and clave1<=48 and clave1<>20 and  date_format(fechacorte,'%Y-%m')='$fec' and suc=$r->suc
        group by suc"; 
           
         $qx1 = $this->db->query($sx1);
	     if($qx1->num_rows()> 0){
 		 $rx1= $qx1->row();  
         $siniva=$rx1->siniva;
         $s2="select a.suc,date_format(fechacorte,'%Y-%m'),sum(siniva)as siniva, sum(corregido)as venta,
(select farmacia from catalogo.cat_comision where tipo='$r->tipo2' and sum(siniva) between monto1 and monto2 )as farmacia
from cortes_c a
left join cortes_d b on b.id_cc=a.id
where
clave1=10 and  date_format(fechacorte,'%Y-%m')='$fec' and  suc=$r->suc and suc<1600
or
clave1=16 and  date_format(fechacorte,'%Y-%m')='$fec' and suc=$r->suc and suc<1600
or
clave1=11 and  date_format(fechacorte,'%Y-%m')='$fec' and suc=$r->suc and suc<1600
group by suc";

$q2=$this->db->query($s2);
if($q2->num_rows()> 0){
$r2= $q2->row();  
$gontor=$r2->siniva;
$premio=$r2->farmacia;}else{$gontor=0;$premio=0;}
           }else{
           $meta=0; 
           $siniva=0; 
           $can=0;
           $imp=0;
           $des=0;
           $imp_b=0;
           $imp_b_c=0;
           $imp_b_c_iva=0;
           $comision=0;
           }
 	   $meta=$imp_b_c_iva*100/$siniva;
       if($meta>=13 and $r->suc<1600){
       $i='<a><img src="'.base_url().'img/feliz.jpeg" border="0" width="20px" /></a>';
       }else{
       $i='<a><img src="'.base_url().'img/triste.jpeg" border="0" width="20px" /></a>';
       $comision=0; 
       }
	   $num=$num+1;
       $l1 = anchor('supervisor/venta_producto_naturistas/'.$r->suc.'/'.$fec.'/'.$meta,$r->tipo2.' - '.$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
       $l2 = anchor('supervisor/venta_dia_naturistas/'.$r->suc.'/'.$fec,'DIAS</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));    
       $importe=$gontor-($r->his_venta);if($r->his_venta==0){$importe=0;} 
       if($importe>=15000){$incremento=15;}
       elseif($importe>=20000){$incremento=20;}
       elseif($importe>=25000){$incremento=25;}
       else{$incremento=0;}
       if($premio==10){$premiosup=$premiosup+200;$premioger=$premioger+100;}
       if($premio==15){$premiosup=$premiosup+300;$premioger=$premioger+150;}
       if($premio==20){$premiosup=$premiosup+400;$premioger=$premioger+200;}
       if($premio==30){$premiosup=$premiosup+600;$premioger=$premioger+300;}
            $tabla.="
            <tr>
            <td align=\"left\">".$l1."</td>
            <td align=\"right\"><font color=\"green\">".number_format($r->his_venta,2)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($gontor,2)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($premio)."</font></td>
            <td align=\"right\"><font color=\"green\">".number_format($incremento)."</td>
            <td align=\"right\">".($r->dias)."</td>
            <td align=\"right\">".number_format($siniva,2)."</td>
            <td align=\"right\">".$i."</td>
            <td align=\"right\">% ".round ($meta,2)."</td>
            <td align=\"right\">".number_format($can,0)."</td>
            <td align=\"right\">".number_format($imp,2)."</td>
            <td align=\"right\">".number_format($des,2)."</td>
            <td align=\"right\">".number_format($imp_b,2)."</td>
            <td align=\"right\">".number_format($imp_b_c,2)."</td>
            <td align=\"right\">".number_format($imp_b_c_iva,2)."</td>
            <td align=\"right\">".number_format($comision,2)."</td>
            <td align=\"left\">$l2</td>
            </tr>
            ";
           $totcan=$totcan+$can;
           $totimp=$totimp+$imp;
           $totdes=$totdes+$des;
           $totimp_b=$totimp_b+$imp_b;
           $totimp_b_c=$totimp_b_c+$imp_b_c;
           $totimp_b_c_iva=$totimp_b_c_iva+$imp_b_c_iva;
           $totcomision=$totcomision+$comision;
        }   
        }
         $tabla.="
        </tbody>
        <tr>
        <td align=\"right\" colspan=\"9\">TOTAL</td>
        <td align=\"right\">".number_format($totcan,0)."</td>
        <td align=\"right\">".number_format($totimp,2)."</td>
        <td align=\"right\">".number_format($totdes,2)."</td>
        <td align=\"right\">".number_format($totimp_b,2)."</td>
        <td align=\"right\">".number_format($totimp_b_c,2)."</td>
        <td align=\"right\">".number_format($totimp_b_c_iva,2)."</td>
        <td align=\"right\">".number_format($totcomision,2)."</td>
        </tr>
         <tr>
         <td align=\"right\" colspan=\"4\">PREMIO AL SUPERVISOR DE GENERICOS ".$this->session->userdata('nombre')."</td>
         <td align=\"right\" colspan=\"2\">".number_format($premiosup,2)."</td>
         <tr>
         <tr>
         <td align=\"right\" colspan=\"4\">PREMIO AL GERENTES DE GENERICOS</td>
         <td align=\"right\" colspan=\"2\">".number_format($premioger,2)."</td>
          <tr>
        </table>";
        
        echo $tabla;
    
    }
//**************************************************************
/////////////////++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//**************************************************************
//**************************************************************
//**************************************************************
 /////////////////++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//**************************************************************
   function control_ventas_producto($fec,$suc,$meta)
    {
        
        $s="select suc,fecha,codigo,descri,sum(can)as can, sum(importe)as importe, sum(can*des)as des, sum(can*vta)as vta  from vtadc.venta_detalle
		 where suc=$suc and date_format(fecha,'%Y-%m')='$fec' group by codigo order by can desc";   
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>CODIGO</th>
        <th>DESCRIPCION</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>TOTAL</th>

        </tr>

        </thead>
        <tbody>
        ";
        
  $totcan=0;
  $totimp=0;
  $totdes=0;
  $totvta=0;

        foreach($q->result() as $r)
        {
		     
            $tabla.="
            <tr>
            <td align=\"right\">".$r->codigo."</td>
            <td align=\"left\">".$r->descri."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->vta,2)."</td>
            <td align=\"right\">".number_format($r->des,2)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            </tr>
            ";
        $totcan=$totcan+$r->can;
		$totimp=$totimp+$r->importe;
        $totdes=$totdes+$r->des;
     	$totvta=$totvta+$r->vta;
   
        }
         $tabla.="
        	 <tr>
            <td align=\"right\" colspan=\"2\">TOTAl</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totvta,2)."</td>
            <td align=\"right\">".number_format($totdes,2)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }
    
    //**************************************************************
//**************************************************************
   function control_ventas_producto_naturistas($fec,$suc,$meta)
    {
        
        $s="select  a.suc, a.nomina, sum(can) as can, sum(can*vta)as imp, sum(can*des)as des,sum(importe)imp_bruto,sum(imp_cancela)as imp_cancela,

        sum(case when c.iva='S'
        then round((importe-imp_cancela)/(1+b.iva),2)
        else
        (importe-imp_cancela)
        end)as imp_menos_iva_menos_cancela,

        sum(case when c.iva='S'
        then round(((importe-imp_cancela)/(1+b.iva)*.10),2)
        else
        round(((importe-imp_cancela)*.10),2)
        end)as comision

        from vtadc.venta_detalle_nat a
        left join catalogo.sucursal b on b.suc=a.suc
        left join catalogo.cat_naturistas c on c.sec=a.sec
        where  a.suc=$suc and date_format(fecha, '%Y-%m')='$fec' group by nomina order by can";   
 		$q = $this->db->query($s);
        
        $num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>EMPLEADO(A)<BR />NOMINA</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>IMP BRUTO</th>
        <th>I.B. - CANC</th>
        <th>I.B.-CANC-IVA</th>
        <th>COMISION NETA</th>
        <th>SUC.ACTUAL</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $totcan=0;
        $totimp=0;
        $totdes=0;
        $totimp_bruto=0;
        $totimp_menos_cancela=0;
        $totimp_menos_iva_menos_cancela=0;
        $totcomision=0;
        
        foreach($q->result() as $r)
        {
         $s1="select min(tipo)as tipo, a.*,e.nombre as suce 
         from catalogo.cat_empleado a 
         left join catalogo.sucursal e on e.suc=a.succ
         where a.NOMINA=$r->nomina and tipo=1 group by nomina";
         $q1=$this->db->query($s1); 
         if($q1->num_rows()==1){
         $r1=$q1->row();
         $nom=trim($r1->pat).' '.trim($r1->mat).' '.trim($r1->nom);
         $tipo=$r1->tipo; 
         $suce=$r1->suce;
         $puesto=trim($r1->puestox); 
         }else{$nom='';$tipo=0; $suce='';$puesto='';}
         
            if($tipo=='2'||$tipo==0 || $puesto=='SUPERVISOR ANALISIS' || $puesto=='MEDICO' and $r->imp_menos_iva_menos_cancela<3000)
            	{$color='red';$mot='SE PIERDE COMISION, No es transferible el monto'; 
           	}else{
            	$color='black';$mot='';
            	}
               
          if(($meta <13)){$comision=0;}else{$comision=$r->comision;}
          if($puesto=='MEDICO' and $r->imp_menos_iva_menos_cancela>=3000){$comision=$r->comision;}  
        $num=$num+1;
         
        $l1 = anchor('supervisor/venta_producto_naturistas_empleado/'.$r->suc.'/'.$fec.'/'.$r->nomina.'/'.$meta, $r->nomina.' '.$nom.'<br /> '.$puesto.'<br ><font color=red>'.$mot.'</font>');
		    
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\"><font color='$color'>".number_format($r->can,0)."</font></td>
            <td align=\"right\"><font color='$color'>".number_format($r->imp,2)."</font></td>
            <td align=\"right\"><font color='$color'>".number_format($r->des,2)."</font></td>
            <td align=\"right\"><font color='$color'>".number_format($r->imp_bruto,2)."</font></td>
            <td align=\"right\"><font color='$color'>".number_format($r->imp_cancela,2)."</font></td>
            <td align=\"right\"><font color='$color'>".number_format($r->imp_menos_iva_menos_cancela,2)."</font></td>
            <td align=\"right\"><font color='$color'>".number_format($comision,2)."</font></td>
            <td align=\"right\">".($suce)."</td>
            </tr>
            ";
        $totcan=$totcan+$r->can;
        $totimp=$totimp+$r->imp;
        $totdes=$totdes+$r->des;
		$totimp_bruto=$totimp_bruto+$r->imp_bruto;
        $totimp_menos_cancela=$totimp_menos_cancela+$r->imp_cancela;
 	    $totimp_menos_iva_menos_cancela=$totimp_menos_iva_menos_cancela+$r->imp_menos_iva_menos_cancela;
     	$totcomision=$totcomision+$comision;
   
        }
        $encargado=round($totimp_menos_iva_menos_cancela/100,2);
        $jefe=round($encargado/2,2);
         $tabla.="
        	 <tr>
            <td align=\"right\" colspan=\"1\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            <td align=\"right\">".number_format($totdes,2)."</td>
            <td align=\"right\">".number_format($totimp_bruto,2)."</td>
            <td align=\"right\">".number_format($totimp_menos_cancela,2)."</td>
            <td align=\"right\">".number_format($totimp_menos_iva_menos_cancela,2)."</td>
            <td align=\"right\">".number_format($totcomision,2)."</td>
            <td align=\"right\"></td>
            </tr>
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
function control_ventas_producto_nat_empleado($fec,$suc,$nomina,$meta)
    {
        $s="select a.nomina,a.tipo, fecha, tiket, codigo, a.descri, a.suc, d.id, nom, pat, mat, can, (can*vta)as imp, (can*des)as des,(importe)imp_bruto, (imp_cancela)imp_cancela,

        (case when c.iva='S'
        then round((importe-imp_cancela)/(1+b.iva),2)
        else
        (importe-imp_cancela)
        end)as imp_menos_iva_menos_cancela,

        (case when c.iva='S'
        then round(((importe-imp_cancela)/(1+b.iva)*.10),2)
        else
        round(((importe-imp_cancela)*.10),2)
        end)as comision

        from vtadc.venta_detalle_nat a
        left join catalogo.sucursal b on b.suc=a.suc
        left join catalogo.cat_naturistas c on c.sec=a.sec
        left join catalogo.cat_empleado d on d.nomina=a.nomina
        
        where a.nomina=$nomina and a.suc=$suc and date_format(fecha, '%Y-%m')='$fec'";   
 		$q = $this->db->query($s);
        
        $num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>TICKET<BR />CODIGO</th>
        <th>DESCRIPCION<BR />FECHA</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>IMP BRUTO</th>
        <th>IMP CANCELADO</th>
        <th>IMP-CANC-IVA</th>
        <th>COMISION NETA</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
        $totcan=0;
        $totimp=0;
        $totdes=0;
        $totimp_bruto=0;
        $totimp_menos_cancela=0;
        $totimp_menos_iva_menos_cancela=0;
        $totcomision=0;

        

        foreach($q->result() as $r)
        {
        if($meta<13){$comision=0;}else{$comision=$r->comision;}    
            
            
            
        $num=$num+1;
        $l1 = anchor('supervisor/venta_producto_naturistas_empleado/'.$r->suc.'/'.$fec.' - '.$r->suc.' - '.$r->nom. ' ' .$r->pat. ' ' .$r->mat. ' '.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
		     
            $tabla.="
            
            <tr>
            <td align=\"left\">".$r->tiket." <BR />".$r->codigo."</td>
            <td align=\"left\">".$r->descri." <BR />".$r->fecha."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->imp,2)."</td>
            <td align=\"right\">".number_format($r->des,2)."</td>
            <td align=\"right\">".number_format($r->imp_bruto,2)."</td>
            <td align=\"right\">".number_format($r->imp_cancela,2)."</td>
            <td align=\"right\">".number_format($r->imp_menos_iva_menos_cancela,2)."</td>
            <td align=\"right\">".number_format($comision,2)."</td>
            
            </tr>
            ";
        $totcan=$totcan+$r->can;
        $totimp=$totimp+$r->imp;
        $totdes=$totdes+$r->des;
        $totimp_bruto=$totimp_bruto+$r->imp_bruto;
        $totimp_menos_cancela=$totimp_menos_cancela+$r->imp_cancela;
 	    $totimp_menos_iva_menos_cancela=$totimp_menos_iva_menos_cancela+$r->imp_menos_iva_menos_cancela;
     	$totcomision=$totcomision+$comision;
   
        }
         $tabla.="
        	 <tr>
            <td align=\"right\" colspan=\"2\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            <td align=\"right\">".number_format($totdes,2)."</td>
            <td align=\"right\">".number_format($totimp_bruto,2)."</td>
            <td align=\"right\">".number_format($totimp_menos_cancela,2)."</td>
            <td align=\"right\">".number_format($totimp_menos_iva_menos_cancela,2)."</td>
            <td align=\"right\">".number_format($totcomision,2)."</td>
            
            </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
   function control_ventas_dia($fec,$suc)
    {
        
        $s="select suc,fecha,sum(can)as can, sum(importe)as importe, sum(can*des)as des, sum(can*vta)as vta  from vtadc.venta_detalle
		 where suc=$suc and date_format(fecha,'%Y-%m')='$fec' group by fecha order by fecha";   
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>FECHA</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>TOTAL</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $totcan=0;
  $totimp=0;
  $totdes=0;
  $totvta=0;
        foreach($q->result() as $r)
        {
       	$l1 = anchor('supervisor/venta_detalle/'.$r->suc.'/'.$fec.'/'.$r->fecha,$r->fecha.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
		     
            $tabla.="
            <tr>
            <td align=\"right\">$l1</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->vta,2)."</td>
            <td align=\"right\">".number_format($r->des,2)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            </tr>
            ";
        $totcan=$totcan+$r->can;
		$totimp=$totimp+$r->importe;
 	    $totdes=$totdes+$r->des;
     	$totvta=$totvta+$r->vta;
        }
         $tabla.="
        	 <tr>
            <td align=\"right\" colspan=\"1\">TOTAl</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totvta,2)."</td>
            <td align=\"right\">".number_format($totdes,2)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }
    //**************************************************************
//**************************************************************
   function control_ventas_dia_naturistas($fec,$suc)
    {
        
        $s="select b.suc, fecha, sum(can) as can, sum(can*vta)as imp,sum(can*des)as des,sum(importe)imp_bruto,sum(imp_cancela)imp_cancela,
        sum(case when c.iva='S'
        then round((importe-imp_cancela)/(1+b.iva),2)
        else
        (importe-imp_cancela)
        end)as imp_menos_iva_menos_cancela,
        sum(case when c.iva='S'
        then round(((importe-imp_cancela)/(1+b.iva)*.10),2)
        else
        round(((importe-imp_cancela)*.10),2)
        end)as comision

        from vtadc.venta_detalle_nat a
        left join catalogo.sucursal b on b.suc=a.suc
        left join catalogo.cat_naturistas c on c.sec=a.sec
        where a.suc=$suc and date_format(fecha, '%Y-%m') = '$fec' group by fecha";   
 		$q = $this->db->query($s);
        
        $num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
         	 	
        <tr>
        <th>FECHA</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>IMP BRUTO</th>
        <th>I.B. - CANC</th>
        <th>I.B. - CANC - IVA</th>
        <th>COMISION NETA</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $totcan=0;
        $totimp=0;
        $totdes=0;
        $totimp_bruto=0;
        $totimp_menos_cancela=0;
        $totimp_menos_iva_menos_cancela=0;
        $totcomision=0;
        foreach($q->result() as $r)
        {
       	$l1 = anchor('supervisor/venta_detalle_naturistas/'.$r->suc.'/'.$fec.'/'.$r->fecha,$r->fecha.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
		     
            $tabla.="
            <tr>
            <td align=\"right\">$l1</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->imp,2)."</td>
            <td align=\"right\">".number_format($r->des,2)."</td>
            <td align=\"right\">".number_format($r->imp_bruto,2)."</td>
            <td align=\"right\">".number_format($r->imp_cancela,2)."</td>
            <td align=\"right\">".number_format($r->imp_menos_iva_menos_cancela,2)."</td>
            <td align=\"right\">".number_format($r->comision,2)."</td>
            </tr>
            ";
        $totcan=$totcan+$r->can;
		$totimp=$totimp+$r->imp;
 	    $totdes=$totdes+$r->des;
     	$totimp_bruto=$totimp_bruto+$r->imp_bruto;
        $totimp_menos_cancela=$totimp_menos_cancela+$r->imp_cancela;
        $totimp_menos_iva_menos_cancela=$totimp_menos_iva_menos_cancela+$r->imp_menos_iva_menos_cancela;
        $totcomision=$totcomision+$r->comision;
        }
         $tabla.="
        	 <tr>
            <td align=\"right\" colspan=\"1\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            <td align=\"right\">".number_format($totdes,2)."</td>
            <td align=\"right\">".number_format($totimp_bruto,2)."</td>
            <td align=\"right\">".number_format($totimp_menos_cancela,2)."</td>
            <td align=\"right\">".number_format($totimp_menos_iva_menos_cancela,2)."</td>
            <td align=\"right\">".number_format($totcomision,2)."</td>
            </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }
//**************************************************************
   function control_ventas_det($suc,$fecha)
    {
        
        $s="select *  from vtadc.venta_detalle where suc=$suc and fecha='$fecha' order by tiket";   
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>TICKET</th>
        <th>CODIGO</th>
        <th>DESCRIPCION</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>TOTAL</th>

        </tr>

        </thead>
        <tbody>
        ";
        
  $totcan=0;
  $totimp=0;
  $totdes=0;
  $totvta=0;

        foreach($q->result() as $r)
        {
		     
            $tabla.="
            <tr>
            <td align=\"right\">".$r->tiket."</td>
            <td align=\"right\">".$r->codigo."</td>
            <td align=\"left\">".$r->descri."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->can*$r->vta,2)."</td>
            <td align=\"right\">".number_format($r->can*$r->des,2)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            </tr>
            ";
        $totcan=$totcan+$r->can;
		$totimp=$totimp+$r->importe;
        $totdes=$totdes+$r->can*$r->des;
     	$totvta=$totvta+$r->can*$r->vta;
   
        }
         $tabla.="
        	 <tr>
            <td align=\"right\" colspan=\"3\">TOTAl</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totvta,2)."</td>
            <td align=\"right\">".number_format($totdes,2)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }
    //**************************************************************
   function control_ventas_det_nat($suc,$fecha)
    {
        
        $s="select tiket, codigo, a.descri,  sum(can) as can, (vta*sum(can)) as imp, (sum(des*can)) as des, sum(importe) as importe , (imp_cancela) as imp_cancela,
        sum(case when c.iva='S'
        then round((importe-imp_cancela)/(1+b.iva),2)
        else
        (importe-imp_cancela)
        end)as imp_menos_iva_menos_cancela,

        sum(case when c.iva='S'
        then round(((importe-imp_cancela)/(1+b.iva)*.10),2)
        else
        round(((importe-imp_cancela)*.10),2)
        end)as comision

        from vtadc.venta_detalle_nat a
        left join catalogo.sucursal b on b.suc=a.suc
        left join catalogo.cat_naturistas c on c.sec=a.sec
        where a.suc=$suc and fecha='$fecha' group by codigo order by codigo";   
 		$q = $this->db->query($s);
        
        $num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>CODIGO</th>
        <th>DESCRIPCION</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>IMP BRUTO</th>
        <th>I.B. - CANC</th>
        <th>IMP-IVA-CANC</th>
        <th>COMISION</th>

        </tr>

        </thead>
        <tbody>
        ";
        
  $totcan=0;
  $totimp=0;
  $totdes=0;
  $totimp_b=0;
  $totimp_b_canc=0;
  $totimp_b_iva=0;
  $totcomision=0;

        foreach($q->result() as $r)
        {
		     
            $tabla.="
            <tr>
            <td align=\"right\">".$r->codigo."</td>
            <td align=\"left\">".$r->descri."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->imp,2)."</td>
            <td align=\"right\">".number_format($r->des,2)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            <td align=\"right\">".number_format($r->imp_cancela,2)."</td>
            <td align=\"right\">".number_format($r->imp_menos_iva_menos_cancela,2)."</td>
            <td align=\"right\">".number_format($r->comision,2)."</td>
            </tr>
            ";
        $totcan=$totcan+$r->can;
		$totimp=$totimp+$r->imp;
        $totdes=$totdes+$r->des;
        $totimp_b=$totimp_b+$r->importe;
        $totimp_b_canc=$totimp_b_canc+$r->imp_cancela;
        $totimp_b_iva=$totimp_b_iva+$r->imp_menos_iva_menos_cancela;
     	$totcomision=$totcomision+$r->comision;
   
        }
         $tabla.="
        	 <tr>
            <td align=\"right\" colspan=\"2\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            <td align=\"right\">".number_format($totdes,2)."</td>
            <td align=\"right\">".number_format($totimp_b,2)."</td>
            <td align=\"right\">".number_format($totimp_b_canc,2)."</td>
            <td align=\"right\">".number_format($totimp_b_iva,2)."</td>
            <td align=\"right\">".number_format($totcomision,2)."</td>
            </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//**************************************************************
//**************************************************************
//**************************************************************
  function control_tar()
    {
  $fol1=0;
  $fol2=0;
  $tar1=0;
  $tottar=0;
  $inv=0;
  $l1=0;
  $l2=0;
  $l3=0;
  $l4=0;      
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,b.fol1,b.fol2
        from catalogo.sucursal a
        left join  vtadc.tarjetas_suc b on b.suc=a.suc
        where superv=$plaza and superv>0 and fol1 is not null  and a.tlid=1 and a.suc>100 and a.suc<=2000
        or regional=$plaza and fol1 is not null  and a.tlid=1 and a.suc>100 and a.suc<=2000";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        <tr>
        <th></th>
        <th colspan=\"6\" align=\"center\">CLIENTE PREFERENTE</th>
        <th colspan=\"2\" align=\"center\">OTRAS</th>
        </tr>
        
        <tr>
        <th>SUCURSAL</th>
        <th>FOLIO INI.</th>
        <th>FOLIO FIN.</th>
        <th>ENTREGAN</th>
        <th>VENTA</th>
        <th>EXIS.</th>
        <th>DETALLE</th>
        <th>OTRAS</th>
        <th>DETALLE</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
        	$fol1=0;
            $fol2=0;
            $fol1=$r->fol1;
        	$fol2=$r->fol2;
        $tottar=$r->fol2-$r->fol1+1;
        
        if($fol1>0){
		$sx="select count(*)as tar from vtadc.tarjetas where suc=$r->suc and tipo=1 and codigo>=$fol1 and codigo<=$fol2";       
        $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){
 		   $rx= $qx->row();
           $tar=$rx->tar; }else{ $tar=0;}
        $sx1="select count(*)as tar from vtadc.tarjetas where suc=$r->suc and tipo<>1";       
        $qx1 = $this->db->query($sx1);
	    if($qx1->num_rows()> 0){
 		   $rx1= $qx1->row();
           $tar1=$rx1->tar; }else{ $tar1=0;}   
           //tabla_control_tarjetas_pro_otras
	   $inv=$tottar-$tar;
	   $num=$num+1;
       $l0 = anchor('supervisor/tabla_control_tarjetas_fol/'.$r->suc,$tar.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
       $l1 = anchor('supervisor/tabla_control_tarjetas_fol_otras/'.$r->suc,$tar1.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
       $l2 = anchor('supervisor/tabla_control_tarjetas_pro/'.$r->suc,'<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver el detalle de productos con descuento de cliente preferente!', 'class' => 'encabezado'));
       $l3 = anchor('supervisor/tabla_control_tarjetas_pro_otras/'.$r->suc,'<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver el detalle de productos con descuento de otras tarjetas!', 'class' => 'encabezado'));     
       }
            $tabla.="
            <tr>
            <td align=\"left\">".$r->tipo2." - ".$r->suc." - ".$r->nombre."</td>
            <td align=\"right\">".$r->fol1."</td>
            <td align=\"right\">".$r->fol2."</td>
            <td align=\"center\">".$tottar."</td>
            <td align=\"center\">$l0</td>
            <td align=\"center\">".$inv."</td>
            <td align=\"center\">".$l2."</td>
            <td align=\"center\">$l1</td>
             <td align=\"center\">$l3</td>
            </tr>
            ";
           
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
//**************************************************************
//**************************************************************
   function control_tar_folio($suc)
    {
        
        $s="select *  from vtadc.tarjetas where suc=$suc and tipo=1 order by codigo";   
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>TARJETA</th>
        <th>DIRECCION</th>
        <th>VENTA</th>
        <th>VIGENCIA</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $totcan=0;
  $totimp=0;
        foreach($q->result() as $r)
        {

        $l1 = anchor('supervisor/tabla_control_tarjetas_fol_pro/'.$suc.'/'.$r->codigo,$r->codigo.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
	
    
           $num=$num+1;     
            $tabla.="
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$l1."<br />".$r->nombre."</td>
            <td align=\"left\">".$r->dire."</td>
            <td align=\"left\">".$r->venta."</td>
            <td align=\"left\">".$r->vigencia."</td>
            </tr>
            ";
         
         }
         $tabla.="
       	    
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
function control_tar_folio_pro($suc,$tar)
    {
        
        $s="select * from vtadc.venta_detalle a 
        left join catalogo.sucursal b on b.suc=a.suc
        where tarjeta=$tar and tipo=1  and b.tlid=1 and b.suc>100 and b.suc<=2000"; 
       
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>APLICO</th>
        <th>FECHA</th>
        <th>TIKET</th>
        <th>CODIGO</th>
        <th>DESCRIPCION</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $totcan=0;
  $totimp=0;
        foreach($q->result() as $r)
        {
        
           $num=$num+1;     
            $tabla.="
            <td align=\"left\">".$num."</td>
            <td align=\"center\">".$r->suc."<br />".$r->nombre."</td>
            <td align=\"left\">".$r->fecha."</td>
            <td align=\"right\">".$r->tiket."</td>
            <td align=\"right\">".$r->codigo."</td>
            <td align=\"left\">".$r->descri."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            </tr>
            ";
         
        $totcan=$totcan+$r->can;
         $totimp=$totimp+$r->importe;
         }
         $tabla.="
       	 <tr>
            <td align=\"right\" colspan=\"6\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
  function control_tar_pro($suc)
    {
        
        $s="select codigo,descri,sum(can)as can,sum(importe)as importe, sum(can*vta)as vta, sum(can*des)as des from vtadc.venta_detalle a 
        where a.suc=$suc and tipo=1 and importe>0 group by codigo order by can desc ";   
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>CODIGO</th>
        <th>DESCRIPCION</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>TOTAL</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $totcan=0;
  $totimp=0;
  $totdes=0;
  $totvta=0;
        foreach($q->result() as $r)
        {
        $l1 = anchor('supervisor/tabla_control_tarjetas_pro_det/'.$suc.'/'.$r->codigo,$r->codigo.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
	
    
           $num=$num+1;     
            $tabla.="
            <td align=\"left\">".$num."</td>
            <td align=\"right\">".$l1."</td>
            <td align=\"left\">".$r->descri."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->vta,2)."</td>
            <td align=\"right\">".number_format($r->des,2)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>

            </tr>
            ";
         $totcan=$totcan+$r->can;
         $totimp=$totimp+$r->importe;
         $totvta=$totvta+$r->vta;
         $totdes=$totdes+$r->des;
          }
         $tabla.="
       	 <tr>
            <td align=\"right\" colspan=\"3\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totvta,2)."</td>
            <td align=\"right\">".number_format($totdes,2)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            </tr>
              
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
function control_tar_pro_det($suc,$cod)
    {
        
        $s="select * from vtadc.venta_detalle a 
        where codigo=$cod and suc=$suc and tipo=1";   
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>APLICO</th>
        <th>FECHA</th>
        <th>TIKET<BR />CODIGO</th>
        <th>DESCRIPCION</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>TOTAL</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $totdes=0;
  $totvta=0;     
  $totcan=0;
  $totimp=0;
  
        foreach($q->result() as $r)
        {
        
           $num=$num+1;     
            $tabla.="
            <tr>
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$r->tarjeta."</td>
            <td align=\"left\">".$r->fecha."</td>
            <td align=\"right\">".$r->tiket."<BR />".$r->codigo."</td>
            <td align=\"left\">".$r->descri."</td>
             <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->vta*$r->can,2)."</td>
            <td align=\"right\">".number_format($r->des*$r->can,2)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            </tr>
            ";
        
         $totcan=$totcan+$r->can;
         $totvta=$totvta+$r->vta*$r->can;
         $totdes=$totdes+$r->des*$r->can;
         $totimp=$totimp+$r->importe;
         }
         $tabla.="
       	 <tr>
            <td align=\"right\" colspan=\"5\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totvta,2)."</td>
            <td align=\"right\">".number_format($totdes,2)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }
//**************************************************************
//**************************************************************
//**************************************************************otras tarjetas que han aplicado descuentos
   function control_tar_folio_otras($suc)
    {
        
        $s="select a.*,b.nombre as tarjetax
from vtadc.tarjetas a
left join catalogo.cat_tarjetas b on b.num=a.tipo
where suc=$suc and tipo>1 order by tipo";   
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>TARJETA</th>
        <th>DIRECCION</th>
        <th>VENTA</th>
        <th>VIGENCIA</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $totcan=0;
  $totimp=0;
        foreach($q->result() as $r)
        {
        $l1 = anchor('supervisor/tabla_control_tarjetas_fol_pro_otras/'.$suc.'/'.$r->codigo,$r->codigo.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
	
    
    	
           $num=$num+1;     
            $tabla.="
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$l1." <font color=\"blue\">".$r->tarjetax."</font><br />".$r->nombre."</td>
            <td align=\"left\">".$r->dire."</td>
            <td align=\"left\">".$r->venta."</td>
            <td align=\"left\">".$r->vigencia."</td>
             </tr>
            ";
         
         }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
function control_tar_folio_pro_otras($suc,$tar)
    {
        
        $s="select * from vtadc.venta_detalle a 
        left join catalogo.sucursal b on b.suc=a.suc 
        where tarjeta=$tar  and a.suc=$suc"; 
         $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>APLICO</th>
        <th>FECHA</th>
        <th>TIKET<BR />CODIGO</th>
        <th>DESCRIPCION</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        <th>DESCUENTO</th>
        <th>TOTAL</th>
        </tr>

        </thead>
        <tbody>
        ";
  $totdes=0;
  $totvta=0;     
  $totcan=0;
  $totimp=0;
        foreach($q->result() as $r)
        {
        
           $num=$num+1;     
            $tabla.="
            <td align=\"left\">".$num."</td>
            <td align=\"center\">".$r->suc."<br />".$r->nombre."</td>
            <td align=\"left\">".$r->fecha."</td>
            <td align=\"right\">".$r->tiket."<BR />".$r->codigo."</td>
            <td align=\"left\">".$r->descri."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->vta*$r->can,2)."</td>
            <td align=\"right\">".number_format($r->des*$r->can,2)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            </tr>
            ";
         
         $totcan=$totcan+$r->can;
         $totvta=$totvta+$r->vta*$r->can;
         $totdes=$totdes+$r->des*$r->can;
         $totimp=$totimp+$r->importe;
         }
         $tabla.="
       	 <tr>
            <td align=\"right\" colspan=\"5\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totvta,2)."</td>
            <td align=\"right\">".number_format($totdes,2)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
  function control_tar_pro_otras($suc)
    {
        
        $s="select codigo,descri,sum(can)as can,sum(importe)as importe from vtadc.venta_detalle a 
        where a.suc=$suc and tipo>1 and importe>0 group by codigo order by can desc ";   
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>CODIGO</th>
        <th>DESCRIPCION</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $totcan=0;
  $totimp=0;
        foreach($q->result() as $r)
        {
        $l1 = anchor('supervisor/tabla_control_tarjetas_pro_det_otras/'.$suc.'/'.$r->codigo,$r->codigo.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
	
    
    	$sx="select sum(can)as can,sum(importe)as imp from vtadc.venta_detalle where tarjeta=$r->codigo group by tarjeta";       
        $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){
 		   $rx= $qx->row();
           $can=$rx->can;
           $imp=$rx->imp; }else{ $can=0; $imp=0;}
           $num=$num+1;     
            $tabla.="
            <td align=\"left\">".$num."</td>
            <td align=\"right\">".$l1."</td>
            <td align=\"left\">".$r->descri."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>

            </tr>
            ";
         $totcan=$totcan+$r->can;
         $totimp=$totimp+$r->importe;
          }
         $tabla.="
       	 <tr>
            <td align=\"right\" colspan=\"3\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            </tr>
              
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
function control_tar_pro_det_otras($suc,$cod)
    {
        
        $s="select * from vtadc.venta_detalle a 
        where codigo=$cod and suc=$suc and tipo>1";   
 		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>TARJETA</th>
        <th>FECHA</th>
        <th>TIKET</th>
        <th>CODIGO</th>
        <th>DESCRIPCION</th>
        <th>CANTIDAD</th>
        <th>IMPORTE</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $totcan=0;
  $totimp=0;
        foreach($q->result() as $r)
        {
        
           $num=$num+1;     
            $tabla.="
            <tr>
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$r->tarjeta."</td>
            <td align=\"left\">".$r->fecha."</td>
            <td align=\"right\">".$r->tiket."</td>
            <td align=\"right\">".$r->codigo."</td>
            <td align=\"left\">".$r->descri."</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->importe,2)."</td>
            </tr>
            ";
        
         $totcan=$totcan+$r->can;
         $totimp=$totimp+$r->importe;
         }
         $tabla.="
       	 <tr>
            <td align=\"right\" colspan=\"6\">TOTAL</td>
            <td align=\"right\">".number_format($totcan,0)."</td>
            <td align=\"right\">".number_format($totimp,2)."</td>
            </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }

//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
//**************************************************************
//**************************************************************
//**************************************************************
   function control_ventas_nat($aaa)
    {
$aaax=$aaa-1;
$fec1=$aaa.'-'.'01';$fec2=$aaa.'-'.'02';$fec3=$aaa.'-'.'03';$fec4=$aaa.'-'.'04';$fec5=$aaa.'-'.'05';$fec6=$aaa.'-'.'06';
$fec7=$aaa.'-'.'07';$fec8=$aaa.'-'.'08';$fec9=$aaa.'-'.'09';$fec10=$aaa.'-'.'10';$fec11=$aaa.'-'.'11';$fec12=$aaa.'-'.'12';
$m01=0;$m02=0;$m03=0;$m04=0;$m05=0;$m06=0;$m07=0;$m08=0;$m09=0;$m10=0;$m11=0;$m12=0;
$im01=0;$im02=0;$im03=0;$im04=0;$im05=0;$im06=0;$im07=0;$im08=0;$im09=0;$im10=0;$im11=0;$im12=0;
$tim01=0;$tim02=0;$tim03=0;$tim04=0;$tim05=0;$tim06=0;$tim07=0;$tim08=0;$tim09=0;$tim10=0;$tim11=0;$tim12=0;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select *from catalogo.sucursal where 
        superv=$plaza and tipo2<>'F'
        ";
		$q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        </tr>

        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
		$sx="select 
sum(importe_act_1)as imp01,
sum(importe_act_2)as imp02,
sum(importe_act_3)as imp03,
sum(importe_act_4)as imp04,
sum(importe_act_5)as imp05,
sum(importe_act_6)as imp06,
sum(importe_act_7)as imp07,
sum(importe_act_8)as imp08,
sum(importe_act_9)as imp09,
sum(importe_act_10)as imp10,
sum(importe_act_11)as imp11,
sum(importe_act_12)as imp12,
sum(importe_ant_1)as impn01,
sum(importe_ant_2)as impn02,
sum(importe_ant_3)as impn03,
sum(importe_ant_4)as impn04,
sum(importe_ant_5)as impn05,
sum(importe_ant_6)as impn06,
sum(importe_ant_7)as impn07,
sum(importe_ant_8)as impn08,
sum(importe_ant_9)as impn09,
sum(importe_ant_10)as impn10,
sum(importe_ant_11)as impn11,
sum(importe_ant_12)as impn12
from vtadc.fe_prox_det
		 where suc=$r->suc and aaa=$aaa and lab='NATURISTAS'";       
	    $qx = $this->db->query($sx);
	    if($qx->num_rows()> 0){
 		   $rx= $qx->row();
$im01=$rx->imp01;$im02=$rx->imp02;$im03=$rx->imp03;$im04=$rx->imp04;$im05=$rx->imp05;$im06=$rx->imp06;
$im07=$rx->imp07;$im08=$rx->imp08;$im09=$rx->imp09;$im10=$rx->imp10;$im11=$rx->imp11;$im12=$rx->imp12;
$imn01=$rx->impn01;$imn02=$rx->impn02;$imn03=$rx->impn03;$imn04=$rx->impn04;$imn05=$rx->impn05;$imn06=$rx->impn06;
$imn07=$rx->impn07;$imn08=$rx->impn08;$imn09=$rx->impn09;$imn10=$rx->impn10;$imn11=$rx->impn11;$imn12=$rx->impn12;
}
$s01="select a.suc,sum(siniva)as vta from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec1' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q01 = $this->db->query($s01);if($q01->num_rows()> 0){$r01= $q01->row();$v01=$r01->vta;}else{$v01=0;}
$s02="select a.suc,sum(siniva)as vta from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec2' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q02 = $this->db->query($s02);if($q02->num_rows()> 0){$r02= $q02->row();$v02=$r02->vta;}else{$v02=0;}
$s03="select a.suc,sum(siniva)as vta from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec3' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q03 = $this->db->query($s03);if($q03->num_rows()> 0){$r03= $q03->row();$v03=$r03->vta;}else{$v03=0;}
$s04="select a.suc,sum(siniva)as vta from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec4' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q04 = $this->db->query($s04);if($q04->num_rows()> 0){$r04= $q04->row();$v04=$r04->vta;}else{$v04=0;}
$s05="select a.suc,sum(siniva)as vta  from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec5' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q05 = $this->db->query($s05);if($q05->num_rows()> 0){$r05= $q05->row();$v05=$r05->vta;}else{$v05=0;}
$s06="select a.suc,sum(siniva)as vta  from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec6' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q06 = $this->db->query($s06);if($q06->num_rows()> 0){$r06= $q06->row();$v06=$r06->vta;}else{$v06=0;}
$s07="select a.suc,sum(siniva)as vta  from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec7' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q07= $this->db->query($s07);if($q07->num_rows()> 0){$r07= $q07->row();$v07=$r07->vta;}else{$v07=0;}
$s08="select a.suc,sum(siniva)as vta  from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec8' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q08 = $this->db->query($s08);if($q08->num_rows()> 0){$r08= $q08->row();$v08=$r08->vta;}else{$v08=0;}
$s09="select a.suc,sum(siniva)as vta  from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec9' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q09 = $this->db->query($s09);if($q09->num_rows()> 0){$r09= $q09->row();$v09=$r09->vta;}else{$v09=0;}
$s10="select a.suc,sum(siniva)as vta  from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec10' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q10 = $this->db->query($s10);if($q10->num_rows()> 0){$r10= $q10->row();$v10=$r10->vta;}else{$v10=0;}
$s11="select a.suc,sum(siniva)as vta  from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec11' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q11 = $this->db->query($s11);if($q11->num_rows()> 0){$r11= $q11->row();$v11=$r11->vta;}else{$v11=0;}
$s12="select a.suc,sum(siniva)as vta  from cortes_c a left join cortes_d b on b.id_cc=a.id
where date_format(a.fechacorte,'%Y-%m')='$fec12' and suc=$r->suc  and b.clave1<>20 and clave1<29 group by suc";       
$q12 = $this->db->query($s12);if($q12->num_rows()> 0){$r12= $q12->row();$v12=$r12->vta;}else{$v12=0;}

if($v01>0){$p01=($im01*100)/$v01;}else{$p01=0;}
if($v02>0){$p02=($im02*100)/$v02;}else{$p02=0;}
if($v03>0){$p03=($im03*100)/$v03;}else{$p03=0;}
if($v04>0){$p04=($im04*100)/$v04;}else{$p04=0;}
if($v05>0){$p05=($im05*100)/$v05;}else{$p05=0;}
if($v06>0){$p06=($im06*100)/$v06;}else{$p06=0;}
if($v07>0){$p07=($im07*100)/$v07;}else{$p07=0;}
if($v08>0){$p08=($im08*100)/$v08;}else{$p08=0;}
if($v09>0){$p09=($im09*100)/$v09;}else{$p09=0;}
if($v10>0){$p10=($im10*100)/$v10;}else{$p10=0;}
if($v11>0){$p11=($im11*100)/$v11;}else{$p11=0;}
if($v12>0){$p12=($im12*100)/$v12;}else{$p12=0;}
	   
	   $num=$num+1;
       $l1 = anchor('supervisor/venta_producto_nat/'.$r->suc.'/'.$aaa,$r->tipo2.' - '.$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"1\">Sucursal</td>
            <td align=\"left\" colspan=\"6\">$l1</td>
            </tr>
            <tr>
            <td align=\"left\">Mes</td>
            <td align=\"center\">Ene</td>
            <td align=\"center\">Feb</td>
            <td align=\"center\">Mar</td>
            <td align=\"center\">Abr</td>
            <td align=\"center\">May</td>
            <td align=\"center\">Jun</td>
            </tr>
            <tr>
<td align=\"left\" colspan=\"1\">Venta $aaa</td>
<td align=\"right\"><font color=\"green\">".number_format($v01,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v02,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v03,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v04,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v05,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v06,2)."</font></td>
            </tr>
            
            <tr>
<td align=\"left\" colspan=\"1\">Naturista $aaa</td>
<td align=\"right\"><font color=\"blue\">".number_format($im01,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im02,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im03,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im04,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im05,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im06,2)."</font></td>
            </tr>

            <tr>
<td align=\"left\" colspan=\"1\">%</td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p01,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p02,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p03,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p04,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p05,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p06,2)."</font></td>	
			</tr>
<tr>
<td align=\"left\" colspan=\"1\">Naturista $aaax</td>
<td align=\"right\"><font color=\"black\">".number_format($imn01,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn02,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn03,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn04,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn05,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn06,2)."</font></td>
            </tr>
<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>            
            <tr>
            <td align=\"left\">Mes</td>
            <td align=\"center\">Jul</td>
            <td align=\"center\">Ago</td>
            <td align=\"center\">Sep</td>
            <td align=\"center\">Oct</td>
            <td align=\"center\">Nov</td>
            <td align=\"center\">Dic</td>
            </tr>
             
            <tr>
<td align=\"left\" colspan=\"1\">Venta</td>
<td align=\"right\"><font color=\"green\">".number_format($v07,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v08,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v09,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v10,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v11,2)."</font></td>
<td align=\"right\"><font color=\"green\">".number_format($v12,2)."</font></td>
            </tr>
            <tr>
<td align=\"left\" colspan=\"1\">Naturista</td>
<td align=\"right\"><font color=\"blue\">".number_format($im07,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im08,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im09,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im10,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im11,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($im12,2)."</font></td>	
			</tr>
			<tr>
<td align=\"left\" colspan=\"1\">%</td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p07,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p08,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p09,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p10,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p11,2)."</font></td>
<td align=\"right\"><font color=\"orange\">% ".number_format($p12,2)."</font></td>	
			</tr>
<tr>
<td align=\"left\" colspan=\"1\">Naturista $aaax</td>
<td align=\"right\"><font color=\"black\">".number_format($imn07,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn08,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn09,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn10,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn11,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($imn12,2)."</font></td>
            </tr> 
            ";
$tim01=$tim01+$im01;
$tim02=$tim02+$im02;
$tim03=$tim03+$im03;
$tim04=$tim04+$im04;
$tim05=$tim05+$im05;
$tim06=$tim06+$im06;
$tim07=$tim07+$im07;
$tim08=$tim08+$im08;
$tim09=$tim09+$im09;
$tim10=$tim10+$im10;
$tim11=$tim11+$im11;
$tim12=$tim12+$im12;
        }
         $tabla.="
         <tr>
          <tr>
            <td align=\"center\" colspan=\"12\"><font size=\"+2\">TOTAL</font></td>
            </tr>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim01,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim02,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim03,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim04,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim05,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim06,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim07,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim08,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim09,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim10,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim11,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim12,2)."</strong></font></td>
        </tr>    
        </tbody>
        </table>";
        
        return $tabla;
    
       
    }
//**************************************************************
//**************************************************************
   function control_ventas_producto_nat($aaa,$suc)
    {
$tim01=0;$tim02=0;$tim03=0;$tim04=0;$tim05=0;$tim06=0;$tim07=0;$tim08=0;$tim09=0;$tim10=0;$tim11=0;$tim12=0;
        $s="select * from vtadc.fe_prox_det where suc=$suc and aaa=$aaa and lab='NATURISTAS'";     
 		$q = $this->db->query($s);
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>ENE</th>
        <th>FEB</th>
        <th>MAR</th>
        <th>ABR</th>
        <th>MAY</th>
        <th>JUN</th>
        <th>JUL</th>
        <th>AGO</th>
        <th>SEP</th>
        <th>OCT</th>
        <th>NOV</th>
        <th>DIC</th>
        </tr>
        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
		     
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"12\">".$r->codigo." - ".$r->descri."</td>
            </tr>
            <tr>
            <td align=\"right\">".number_format($r->venta_act_1,0)."<br /><font color=\"blue\">".number_format($r->importe_act_1,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_2,0)."<br /><font color=\"blue\">".number_format($r->importe_act_2,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_3,0)."<br /><font color=\"blue\">".number_format($r->importe_act_3,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_4,0)."<br /><font color=\"blue\">".number_format($r->importe_act_4,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_5,0)."<br /><font color=\"blue\">".number_format($r->importe_act_5,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_6,0)."<br /><font color=\"blue\">".number_format($r->importe_act_6,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_7,0)."<br /><font color=\"blue\">".number_format($r->importe_act_7,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_8,0)."<br /><font color=\"blue\">".number_format($r->importe_act_8,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_9,0)."<br /><font color=\"blue\">".number_format($r->importe_act_9,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_10,0)."<br /><font color=\"blue\">".number_format($r->importe_act_10,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_11,0)."<br /><font color=\"blue\">".number_format($r->importe_act_11,2)."</font></td>
            <td align=\"right\">".number_format($r->venta_act_12,0)."<br /><font color=\"blue\">".number_format($r->importe_act_12,2)."</font></td>
          
            </tr>
            ";
     
$tim01=$tim01+$r->importe_act_1;
$tim02=$tim02+$r->importe_act_2;
$tim03=$tim03+$r->importe_act_3;
$tim04=$tim04+$r->importe_act_4;
$tim05=$tim05+$r->importe_act_5;
$tim06=$tim06+$r->importe_act_6;
$tim07=$tim07+$r->importe_act_7;
$tim08=$tim08+$r->importe_act_8;
$tim09=$tim09+$r->importe_act_9;
$tim10=$tim10+$r->importe_act_10;
$tim11=$tim11+$r->importe_act_11;
$tim12=$tim12+$r->importe_act_12;
        }
         $tabla.="
         <tr>
          <tr>
            <td align=\"center\" colspan=\"12\"><font size=\"+2\">TOTAL</font></td>
            </tr>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim01,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim02,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim03,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim04,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim05,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim06,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim07,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim08,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim09,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim10,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim11,2)."</strong></font></td>
            <td align=\"right\"><font color=\"blue\"><strong>".number_format($tim12,2)."</strong></font></td>
        </tr>
            
        </tbody>
        </table>";
        
        return $tabla;
    
    }
//**************************************************************
//**************************************************************
  function agrega_member_movimiento($id_emp,$id_mov,$fecha_i,$obser,$suc,$folio_inca,$causa,$dias,$clave)
    {
       //
        $id_user= $this->session->userdata('id');
        $graba='SI';
        $s = "SELECT a.*,b.nombre as sucx,b.id_plaza,d.nombre as suc2x,
        DAYOFWEEK('$fecha_i') as domingo
FROM catalogo.cat_empleado a
left join catalogo.sucursal b on b.suc=a.succ
left join catalogo.sucursal d on d.suc=$suc
where a.id=$id_emp";
        $q = $this->db->query($s);
        if($q->num_rows() == 1){
        $r = $q->row();
        $id_plaza=$r->id_plaza;
        
         
        if($id_mov==3){
            $suc_anterior=$r->succ;
            $causax=' DE '.$r->succ.' '.trim($r->sucx).' A '.$suc.' '.trim($r->suc2x).' '.$obser;   
        }else{
            
            $suc_anterior=$suc;
            $causax=$obser;
            }
 if($suc==0){$suc_anterior=$r->succ;$suc=$r->succ;}  
            //id, cia, nomina, motivo, causa, suc1, suc2, id_user, dias, fecha_c, id_rh, fecha_rh, tipo, id_plaza 
            if($id_mov==2){$ds=0;}else{$ds=$dias;}
            if($id_mov==6 and $r->domingo<>1){$graba='NO';}
$sql="select *from mov_supervisor where nomina=$r->nomina and cia=$r->cia and fecha_mov='$fecha_i' and motivo=$id_mov";
$query = $this->db->query($sql);
if($graba=='SI' and $query->num_rows() == 0){                  
            $new_member_insert_data = array(
            'cia'=>$r->cia,
            'nomina'=>$r->nomina,
            'motivo'=>$id_mov,
            'causa'=>strtoupper(trim($causax)),
            'suc1'=>$suc_anterior,
            'suc2'=>$suc,
            'id_user'=>$id_user,
            'dias'=>$ds,
            'fecha_c'=> date('Y-m-d H:i:s'),
            'id_plaza'=>$id_plaza,
            'fecha_mov'=>$fecha_i,
            'folio_inca'=>$folio_inca,
            'obser2'=>$causa,
            'nomina_cap'=>$clave,
            'tipo'=>1
		);
		$insert = $this->db->insert('mov_supervisor', $new_member_insert_data);
        
        return $this->db->insert_id(); 
}       
        }
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
function agrega_member_movimiento_alta($nom,$id_mov,$fecha,$cia,$suc,$nomina)
    {
       //
        $id_user= $this->session->userdata('id');
        $s="select *from catalogo.sucursal where suc=$suc";
        $q = $this->db->query($s);
        if($q->num_rows() == 1 and $cia>0 and $id_user>0){
        $r = $q->row();
        $id_plaza=$r->id_plaza;
 
            //id, cia, nomina, motivo, causa, suc1, suc2, id_user, dias, fecha_c, id_rh, fecha_rh, tipo, id_plaza  
            $new_member_insert_data = array(
            'cia'=>$cia,
            'nomina'=>$nomina,
            'motivo'=>$id_mov,
            'causa'=>' ',
            'suc1'=>$suc,
            'suc2'=>$suc,
            'id_user'=>$id_user,
            'dias'=>0,
            'fecha_c'=> date('Y-m-d H:i:s'),
            'id_plaza'=>$id_plaza,
            'fecha_mov'=>$fecha,
            'nombre'=>strtoupper(trim($nom)),
            'tipo'=>1
            
		);
		$insert = $this->db->insert('mov_supervisor', $new_member_insert_data);
        
       }
        
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
//**************************************************************/////////////////////////////////////////////////////
    function valida_member_empleados($id,$fechaf)
    {
     $nivel= $this->session->userdata('nivel');
     $id_user= $this->session->userdata('id');

$s="select a.*,b.suc as sucn, b.succ,b.plaza,b.id_plaza,b.personal
from mov_supervisor a
left join catalogo.cat_empleado b on b.cia=a.cia and b.nomina=a.nomina 
where a.id=$id and a.tipo=1";
$q = $this->db->query($s);
  if($q->num_rows() == 1 && $id_user > 0){
  $r= $q->row();
  
  if($r->motivo==1){
$clave=613;
  $this->__falta($id,$id_user,$r->id_plaza,$r->nomina,$r->cia,$r->fecha_mov,$fechaf,$r->succ,$r->plaza,$r->dias,$r->causa,$clave);	
  }elseif($r->motivo==6){
$clave=333;
  $this->__falta($id,$id_user,$r->id_plaza,$r->nomina,$r->cia,$r->fecha_mov,$fechaf,$r->succ,$r->plaza,$r->dias,$r->causa,$clave);	
  }elseif($r->motivo==7){
$clave=331;
  $this->__festivo($id,$id_user,$r->id_plaza,$r->nomina,$r->cia,$r->fecha_mov,$fechaf,$r->succ,$r->plaza,$r->dias,$r->causa,$clave);	
  }elseif($r->motivo==5){
  $clave=644;
  $this->__incapacidad($id,$id_user,$r->id_plaza,$r->nomina,$r->cia,$r->fecha_mov,$fechaf,$r->succ,$r->plaza,$r->folio_inca,$r->dias,$r->obser2,$clave,$r->personal);	
  }
  
  
  
     }
     $data = array('tipo'=>2, 'fecha_c'=>date('Y-m-d H:i:s'));
 	 $this->db->where('id', $id);
     $this->db->update('mov_supervisor', $data);
     return $this->db->affected_rows();
     
     }
     
//////////////////////////////////////////////////
//////////////////////////////////////////////////
function __falta($id,$id_user,$id_plaza,$nomina,$cia,$fecha_mov,$fechaf,$succ,$plaza,$dias,$causa,$clave)
{
$s1 = "SELECT a.* FROM desarrollo.faltante a where  nomina=$nomina and cianom=$cia and fecha='$fecha_mov' and clave=$clave";
 $q1 = $this->db->query($s1);
  if($q1->num_rows() == 0){
$r1= $q1->row();
$dataz= array(
            'fecha'   =>$fecha_mov,
            'corte'   =>0,  
            'nomina'  =>$nomina,
            'turno'   =>0,
            'fal'     =>$dias,
            'id_cor'  =>$id_user,
            'id_user' =>$id_user,
            'succ'    =>$succ,
            'suc'     =>$succ,
            'plaza'  =>0,
            'cia'    =>0,
            'plazanom'=>$plaza,
            'clave'  =>$clave,
            'folioi'  => ' ',
            'fechai'  =>'0000-00-00',
            'cianom' =>$cia,
            'tipo'=>2,
            'fecpre'=>$fechaf,
            'id_plaza' =>$id_plaza,
            'observacion'=>$causa,
            'fechacaptura'=>date('Y-m-d H:i:s')
            );
$insert = $this->db->insert('desarrollo.faltante', $dataz);
	 
     $data = array('tipo'=>2, 'fecha_c'=>date('Y-m-d H:i:s'),'id_rh'=>558,'fecha_rh'=>$fechaf);
 	 $this->db->where('id', $id);
     $this->db->update('mov_supervisor', $data);
     return $this->db->affected_rows();
     }  

}
//////////////////////////////////////////////////
//////////////////////////////////////////////////
function __festivo($id,$id_user,$id_plaza,$nomina,$cia,$fecha_mov,$fechaf,$succ,$plaza,$dias,$causa,$clave)
{
$s1 = "SELECT a.* FROM desarrollo.faltante a where  nomina=$nomina and cianom=$cia and fecha='$fecha_mov' and clave=$clave";
 $q1 = $this->db->query($s1);
  if($q1->num_rows() == 0){
$r1= $q1->row();
$dataz= array(
            'fecha'   =>$fecha_mov,
            'corte'   =>0,  
            'nomina'  =>$nomina,
            'turno'   =>0,
            'fal'     =>$dias,
            'id_cor'  =>$id_user,
            'id_user' =>$id_user,
            'succ'    =>$succ,
            'suc'     =>$succ,
            'plaza'  =>0,
            'cia'    =>0,
            'plazanom'=>$plaza,
            'clave'  =>$clave,
            'folioi'  => ' ',
            'fechai'  =>'0000-00-00',
            'cianom' =>$cia,
            'tipo'=>2,
            'fecpre'=>$fechaf,
            'id_plaza' =>$id_plaza,
            'observacion'=>$causa,
            'fechacaptura'=>date('Y-m-d H:i:s')
            );
$insert = $this->db->insert('desarrollo.faltante', $dataz);
	 
     $data = array('tipo'=>2, 'fecha_c'=>date('Y-m-d H:i:s'),'id_rh'=>558,'fecha_rh'=>$fechaf);
 	 $this->db->where('id', $id);
     $this->db->update('mov_supervisor', $data);
     return $this->db->affected_rows();
     }  

}
//////////////////////////////////////////////////
//////////////////////////////////////////////////
function __incapacidad($id,$id_user,$id_plaza,$nomina,$cia,$fecha_mov,$fechaf,$succ,$plaza,$folio_inca,$dias,$causa,$clave,$personal)
{
$s1 = "SELECT a.* FROM desarrollo.faltante a where  nomina=$nomina and cianom=$cia and fecha='$fecha_mov' and clave=$clave";
$q1 = $this->db->query($s1);

$mm=substr($fecha_mov,5,2);
$dd=substr($fecha_mov,8,2);
$mmf=substr($fechaf,4,2);
$ddf=substr($fechaf,6,2);

if(
$mmf==$mm and $dd>=16 and $dd<=31 and $ddf>=16 and $ddf<=31 and $dias>15
or
$mmf==$mm and $dd>=01 and $dd<=15 and $ddf>=01 and $ddf<=15 and $dias>15
){
$s0="select '$fechaf' as fcalculada,DATEDIFF('$fechaf','$fecha_mov')+1 as di, day(LAST_DAY(date('$fechaf')))as diaf,day('$fechaf')as quin";
$q0 = $this->db->query($s0);
$r0= $q0->row(); 



		if($r0->quin > 15 and $personal='SIND' and $r0->diaf==31){
			$di=$r0->di-1;
		}elseif($r0->quin == 15 or $r0->quin==30){
			$di=$r0->di;    
		}

		$var=$dias-$di;
}

if($mm==$mmf and $dias>15 and $dd<16 and $ddf==15 or $mm==$mmf and $dias>15 and $dd<16 and $ddf==30){
$var=$dias-15;$di=15;
}
if($mm==$mmf and $dias>15 and $dd<16 and $ddf==31){
$var=$dias-16;$di=16;
}

if($mm<>$mmf and $dias<=15 ||  $mm==$mmf and $dias<=15 and $ddf>16){
$var=0;
$di=$dias;
}
if($mm<>$mmf and $dias>15 and $ddf==15  or $mm<>$mmf and $dias>15 and $ddf==30 or $mm<>$mmf and $dias>15 and $ddf==31){
$var=$dias-15;
$di=15;
}

if($mm<>$mmf and $dias>15 and $ddf>15){
$var=$dias-16;
$di=16;
}if($mm==$mmf and $dias<=15 and $ddf>16){
$di=$dias;
$var=0;
}if($mm<>$mmf and $dias<=15 and $ddf==15){
$di=$dias;
$var=0;    
}if($mm==$mmf and $dias<=15 and $ddf==15){
$di=$dias;
$var=0;
}if($mm==$mmf and $dias>15 and $ddf==28){
$di=13;
$var=$dias-$di;
}

if($q1->num_rows() == 0){
$r1= $q1->row();
////va el primer insert
$dataz= array(
            'fecha'   =>$fecha_mov,
            'corte'   =>0,  
            'nomina'  =>$nomina,
            'turno'   =>0,
            'fal'     =>$di,
            'id_cor'  =>$id_user,
            'id_user' =>$id_user,
            'succ'    =>$succ,
            'suc'     =>$succ,
            'plaza'  =>0,
            'cia'    =>0,
            'plazanom'=>$plaza,
            'clave'  =>$clave,
            'folioi'  =>$folio_inca,
            'fechai'  =>$fecha_mov,
            'cianom' =>$cia,
            'tipo'=>2,
            'fecpre'=>$fechaf,
            'id_plaza' =>$id_plaza,
            'observacion' =>$causa,
            'fechacaptura'=>date('Y-m-d H:i:s')
            );
$insert = $this->db->insert('desarrollo.faltante', $dataz);
 }
//****************	 
 if($var>0){
if($r0->quin==15 and $r0->diaf==31 and $personal=='SIND'){
$s01="select DATEDIFF('$fechaf','$fechaf')+16 as di, ('$fechaf'+ INTERVAL 16 day) as cobro1, ('$fechaf'+ INTERVAL 16 day) as cobro1m,
day(('$fechaf'+ INTERVAL 16 day))as quin,day(LAST_DAY(date(('$fechaf'+ INTERVAL 16 day))))as diaf";

$q01 = $this->db->query($s01);
$r01= $q01->row(); 
$di01=16;
}else{
$s01="select DATEDIFF('$fechaf','$fechaf')+15 as di, ('$fechaf'+ INTERVAL 15 day) as cobro1,('$fechaf'+ INTERVAL 15 day) as cobro1m,
day(('$fechaf'+ INTERVAL 15 day))as quin,day(LAST_DAY(date(('$fechaf'+ INTERVAL 15 day))))as diaf";
$q01 = $this->db->query($s01);
$r01= $q01->row();     
$di01=15;
}    
if($var>=$di01){$var1=$var-$di01;}else{$di01=$var;$var1=0;}

////////va el segundo insert
$dataz1= array(
            'fecha'   =>$r01->cobro1m,
            'corte'   =>0,  
            'nomina'  =>$nomina,
            'turno'   =>0,
            'fal'     =>$di01,
            'id_cor'  =>$id_user,
            'id_user' =>$id_user,
            'succ'    =>$succ,
            'suc'     =>$succ,
            'plaza'  =>0,
            'cia'    =>0,
            'plazanom'=>$plaza,
            'clave'  =>$clave,
            'folioi'  =>$folio_inca,
            'fechai'  =>$fecha_mov,
            'cianom' =>$cia,
            'tipo'=>2,
            'fecpre'=>$r01->cobro1,
            'id_plaza' =>$id_plaza,
            'observacion' =>$causa,
            'fechacaptura'=>date('Y-m-d H:i:s')
            );
$insert = $this->db->insert('desarrollo.faltante', $dataz1);
}
//****************


if($var1>0){
if($r01->quin==31 and $r01->diaf==31 and $personal=='SIND'){
$s02="select DATEDIFF('$r01->cobro1','$r01->cobro1')+15 as di, ('$r01->cobro1'+ INTERVAL 15 day) as cobro2, ('$r01->cobro1'+ INTERVAL 16 day) as cobro2m,
day(('$r01->cobro1'+ INTERVAL 15 day))as quin,day(LAST_DAY(date(('$r01->cobro1'+ INTERVAL 15 day))))as diaf";
$q02 = $this->db->query($s02);
$r02= $q02->row(); 
$di02=15;
}else{
$s02="select DATEDIFF('$r01->cobro1','$r01->cobro1')+15 as di, ('$r01->cobro1'+ INTERVAL 15 day) as cobro2,('$r01->cobro1'+ INTERVAL 15 day) as cobro2m,
day(('$r01->cobro1'+ INTERVAL 15 day))as quin,day(LAST_DAY(date(('$r01->cobro1'+ INTERVAL 15 day))))as diaf";
$q02 = $this->db->query($s02);
$r02= $q02->row();     
$di02=15;
}    
if($var1>=$di02){$var2=$var1-$di02;}else{$di02=$var1;$var2=0;}

//**************** 
////////va el segundo insert 
$dataz2= array(
            'fecha'   =>$r02->cobro2m,
            'corte'   =>0,  
            'nomina'  =>$nomina,
            'turno'   =>0,
            'fal'     =>$di02,
            'id_cor'  =>$id_user,
            'id_user' =>$id_user,
            'succ'    =>$succ,
            'suc'     =>$succ,
            'plaza'  =>0,
            'cia'    =>0,
            'plazanom'=>$plaza,
            'clave'  =>$clave,
            'folioi'  =>$folio_inca,
            'fechai'  =>$fecha_mov,
            'cianom' =>$cia,
            'tipo'=>2,
            'fecpre'=>$r02->cobro2,
            'id_plaza' =>$id_plaza,
            'observacion' =>$causa,
            'fechacaptura'=>date('Y-m-d H:i:s')
            );
$insert = $this->db->insert('desarrollo.faltante', $dataz2); 
 
 
}

//****************

if($var2>0){
if($r02->quin==15 and $r02->diaf==31 and $personal=='SIND'){
$s03="select DATEDIFF('$r02->cobro2','$r02->cobro2')+16 as di, ('$r02->cobro2'+ INTERVAL 16 day) as cobro3,('$r02->cobro2'+ INTERVAL 16 day) as cobro3m,
day(('$r02->cobro2'+ INTERVAL 16 day))as quin,day(LAST_DAY(date(('$r02->cobro2'+ INTERVAL 16 day))))as diaf";
$q03 = $this->db->query($s03);
$r03= $q03->row(); 
$di03=16;
}elseif($r02->quin==15 and $r02->diaf==30 || $r02->quin > 15){
$s03="select DATEDIFF('$r02->cobro2','$r02->cobro2')+15 as di, ('$r02->cobro2'+ INTERVAL 15 day) as cobro3,('$r02->cobro2'+ INTERVAL 15 day) as cobro3m,
day(('$r02->cobro2'+ INTERVAL 15 day))as quin,day(LAST_DAY(date(('$r02->cobro2'+ INTERVAL 15 day))))as diaf";
$q03 = $this->db->query($s03);
$r03= $q03->row();     
$di03=15;

}    
echo $var2."<br />";
echo $di03."<br />";
if($var2<=$di03){$di03=$var2;}
echo $di03;
//**************** 
////////va el segundo insert
$dataz2= array(
            'fecha'   =>$r03->cobro3m,
            'corte'   =>0,  
            'nomina'  =>$nomina,
            'turno'   =>0,
            'fal'     =>$di03,
            'id_cor'  =>$id_user,
            'id_user' =>$id_user,
            'succ'    =>$succ,
            'suc'     =>$succ,
            'plaza'  =>0,
            'cia'    =>0,
            'plazanom'=>$plaza,
            'clave'  =>$clave,
            'folioi'  =>$folio_inca,
            'fechai'  =>$fecha_mov,
            'cianom' =>$cia,
            'tipo'=>2,
            'fecpre'=>$r03->cobro3,
            'id_plaza' =>$id_plaza,
            'observacion' =>$causa,
            'fechacaptura'=>date('Y-m-d H:i:s')
            );
$insert = $this->db->insert('desarrollo.faltante', $dataz2);
  
die();
}     
     
     $data = array('tipo'=>2, 'fecha_c'=>date('Y-m-d H:i:s'),'id_rh'=>558,'fecha_rh'=>$fechaf);
 	 $this->db->where('id', $id);
     $this->db->update('mov_supervisor', $data);
     return $this->db->affected_rows();
   

}

//////////////////////////////////////////////////
//////////////////////////////////////////////////
//////////////////////////////////////////////////

    function delete_member_empleados($id)
    {
    $this->db->delete('mov_supervisor', array('id' => $id,'tipo'=>1));
 	 
    }

/////////////////////////////////////////////////////
    function valida_member_empleados_rh($id)
    {
     $nivel= $this->session->userdata('nivel');
     $id_user= $this->session->userdata('id');
     $data = array('tipo'=>3, 'fecha_rh'=>date('Y-m-d H:i:s'),'id_rh'=>$id_user);
 	 $this->db->where('id', $id);
     $this->db->update('mov_supervisor', $data);
     return $this->db->affected_rows();   	 
     }
     
//////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function valida_member_empleados_envio_suc($id,$obser)
    {
     $nivel= $this->session->userdata('nivel');
     $id_user= $this->session->userdata('id');
     $data = array('tipo'=>3, 'fecha_super'=>date('Y-m-d H:i:s'),'id_super'=>$id_user,'aviso' => strtoupper(trim($obser)));
 	 $this->db->where('id', $id);
     $this->db->update('catalogo.cat_alta_empleado', $data);
     return $this->db->affected_rows();   	 
     }
     
//////////////////////////////////////////////////
/////////////////////////////////////////////////////

//**************************************************************
function captura_de_mov()
    {
    $id_user= $this->session->userdata('id');
    $nivel= $this->session->userdata('nivel');
    $tipo= $this->session->userdata('tipo');
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,bb.nombre as motivox 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      where a.id_user=$id_user and  a.tipo=1";
      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"4\" align=\"center\"><strong>EMPLEADOS PARA VALIDAR MOVIMIENTO</strong></th>
        </tr>
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>PLAZA</strong></th>
        <th><strong>CAPTURO</strong></th>
        <th><strong>VALIDO</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
       if($nivel==14){
            $l3 = anchor('supervisor/tabla_empleados_borrar/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            $l4 = anchor('supervisor/tabla_empleados_validar/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
        
       }elseif($nivel==33 and $tipo==6){
        $l3 = anchor('recursos_humanos/tabla_empleados_borrar/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            $l4 = anchor('recursos_humanos/tabla_empleados_validar_incapacidad/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
        }else{
            $l3 = anchor('recursos_humanos/tabla_empleados_borrar/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            $l4 = anchor('recursos_humanos/tabla_empleados_validar/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
       }     
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">".$l3."Empleado :".$row->nomina." ".$row->pat." ".$row->mat." ".$row->nom."<br /><font color=\"blue\">".$row->causa." ".$row->obser2." ".$row->dias."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong>".$row->fecha_mov."<br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivox." ".$row->folio_inca."</font></td>
            <td>/td>
            </tr>
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->id_userx."<br /> ".$row->fecha_c."</td>
            <td>$l4</td>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE EMPLEADOS :".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function captura_de_mov_fal()
    {
    $id_user= $this->session->userdata('id');
    $nivel= $this->session->userdata('nivel');
    $tipo= $this->session->userdata('tipo');
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,bb.nombre as motivox 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      where a.id_user=$id_user and a.tipo=1 and a.motivo=1";
      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"4\" align=\"center\"><strong>EMPLEADOS PARA VALIDAR MOVIMIENTO</strong></th>
        </tr>
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>PLAZA</strong></th>
        <th><strong>CAPTURO</strong></th>
        <th><strong>VALIDO</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
       if($nivel==14){
            $l3 = anchor('supervisor/tabla_empleados_borrar/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            $l4 = anchor('supervisor/tabla_empleados_validar/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
        
       }elseif($nivel==33 and $tipo==6){
        $l3 = anchor('recursos_humanos/tabla_empleados_borrar/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            $l4 = anchor('recursos_humanos/tabla_empleados_validar_incapacidad/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
        }else{
            $l3 = anchor('recursos_humanos/tabla_empleados_borrar/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            $l4 = anchor('recursos_humanos/tabla_empleados_validar/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
        
       }     
            
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">$l3 Empleado :".$row->nomina." ".$row->pat." ".$row->mat." ".$row->nom."<br /><font color=\"blue\">".$row->causa." ".$row->obser2." ".$row->dias."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong>".$row->fecha_mov."<br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivox." ".$row->folio_inca."</font></td>
            <td></td>
            </tr>
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->id_userx."<br /> ".$row->fecha_c."</td>
            <td>$l4</td>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE EMPLEADOS :".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
//**************************************************************
function captura_de_mov_his($motivo,$aaa,$mes)
    {
    $id_user= $this->session->userdata('id');
    $plaza= $this->session->userdata('plaza');
    $fec=$this->input->post('aaa')."-".str_pad($this->input->post('mes'),2,"0",STR_PAD_LEFT);
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,bb.nombre as motivox,e.nombre as rhx,e.puesto as rhpuestox 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join usuarios e  on e.id=a.id_rh
      where b.superv=$plaza and a.tipo>1 and a.tipo<=3 and motivo=$motivo and date_format(fecha_mov,'%Y-%m')='$fec' ";
     
         
      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"4\" align=\"center\"><strong>EMPLEADOS CON MOVIMIENTOS</strong></th>
        </tr>
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>PLAZA</strong></th>
        <th><strong>CAPTURO</strong></th>
        <th><strong>VALIDO</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            $l1 = anchor('supervisor/imprimir_fal/'.$row->id, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para Imprimir!', 'class' => 'encabezado'));
            
            
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">Empleado :".$row->nomina." ".$row->pat." ".$row->mat." ".$row->nom."<br /><font color=\"blue\">".$row->causa."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong><font color=\"green\">".$row->fecha_mov."</font><br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivox."</font></td>
            <td>RECURSOS o CONTADOR.: <br />".$row->rhx." <br />".$row->rhpuestox."</td>
            </tr>
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax." <br /><font color=\"#8E4BF8\">".$row->fecha_mov." - ".$row->folio_inca."</font></td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->id_userx."<br /><font color=\"green\">".$row->fecha_c."</font></td>
            <td>FECHA DE VAL.: <font color=\"green\">".$row->fecha_rh."</font></td>
            <td>$l1</td>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE EMPLEADOS :".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }

//**************************************************************
function imp_falta($id)
    {
    $id_user= $this->session->userdata('id');
    $plaza= $this->session->userdata('plaza');
    
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,
    bb.nombre as motivox,e.nombre as rhx,e.puesto as rhpuestox,aa.puestox as puestoox 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join usuarios e  on e.id=a.id_rh
      where a.id=$id";
      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"4\" align=\"center\"><strong>EMPLEADOS CON MOVIMIENTOS</strong></th>
        </tr>
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>PLAZA</strong></th>
        <th><strong>CAPTURO</strong></th>
        <th><strong>APLICADO</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            
            
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">Empleado :".$row->nomina." ".$row->pat." ".$row->mat." ".$row->nom."<br />".$row->puestoox."<br /><font color=\"blue\">".$row->causa."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong><font color=\"green\">".$row->fecha_mov."</font><br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivox."</font></td>
            <td>RECURSOS o CONTADOR.: <br />".$row->rhx." <br />".$row->rhpuestox."</td>
            </tr>
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->id_userx."<br /><font color=\"green\">".$row->fecha_c."</font></td>
            <td>FECHA DE VAL.: <font color=\"green\">".$row->fecha_rh."</font></td>
            </tr>
            
            <tr>
            <td align=\"center\" colspan=\"2\">CAPTURADO POR<br /><br /><br /></td>
            <td align=\"center\" colspan=\"2\">EMPLEADO<br /><br /><br /></td>
           </tr>
           
           <tr>
            <td align=\"center\" colspan=\"2\">".$row->id_userx."<br />".$row->contador."</td>
            <td align=\"center\" colspan=\"2\">".$row->pat."".$row->mat."".$row->nom."<br />".$row->puestoox."</td>
           </tr>  
</table>";
    }    
        
        return $tabla;
    
    }
//**************************************************************
function mov_pendiente()
    {
    $id_user= $this->session->userdata('id');
    $id_plaza= $this->session->userdata('id_plaza');
    $tipo= $this->session->userdata('tipo');
    $nivel= $this->session->userdata('nivel');
    if($nivel==33){
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,bb.nombre as motivox 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      where a.tipo=2 and motivo=3
      or  a.id_plaza=$id_plaza and a.tipo=2 and motivo>1";
      	$query = $this->db->query($sql);
   }else{
   $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,bb.nombre as motivox 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      where a.id_plaza=$id_plaza and a.tipo=2 and motivo>1
     ";
      	$query = $this->db->query($sql);  
   }     
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"5\" align=\"center\"><strong>EMPLEADOS CON MOVIMIENTOS</strong></th>
        </tr>
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>PLAZA</strong></th>
        <th><strong>CAPTURO</strong></th>
        <th><strong>VALIDO</strong></th>
        <th><strong></strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            
    $l1 = anchor('supervisor/tabla_empleados_validar_rh/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));    
if($nivel==33 and $tipo==0){$l1='';}

           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">Empleado :".$row->nomina." ".$row->pat." ".$row->mat." ".$row->nom."<br /><font color=\"blue\">".$row->causa."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong>".$row->fecha_mov."<br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivox."</font></td>
            <td>RECURSOS o CONTADOR.:".$row->id_rh."</td>
            </tr>
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->id_userx."<br /> ".$row->fecha_c."</td>
            <td>FECHA DE VAL.: ".$row->fecha_rh."</td>
            <td>$l1</td>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE EMPLEADOS :".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////////////
function mov_pendiente_contador()
    {
    $id_user= $this->session->userdata('id');
    $id_plaza= $this->session->userdata('id_plaza');
    $tipo= $this->session->userdata('tipo');
    $nivel= $this->session->userdata('nivel');
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,b.id_plaza,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,bb.nombre as motivox 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc1
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      where b.id_plaza=$id_plaza and a.tipo=2 and motivo=2 ";
      
      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"5\" align=\"center\"><strong>EMPLEADOS CON MOVIMIENTOS</strong></th>
        </tr>
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>PLAZA</strong></th>
        <th><strong>CAPTURO</strong></th>
        <th><strong>VALIDO</strong></th>
        <th><strong></strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            
    $l1 = anchor('supervisor/tabla_empleados_validar_contador/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));    
if($nivel==33 and $tipo==0){$l1='';}

           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">Empleado :".$row->nomina." ".$row->pat." ".$row->mat." ".$row->nom."<br /><font color=\"blue\">".$row->causa."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong>".$row->fecha_mov."<br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivox."</font></td>
            <td>RECURSOS o CONTADOR.:".$row->id_rh."</td>
            </tr>
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->id_userx."<br /> ".$row->fecha_c."</td>
            <td>FECHA DE VAL.: ".$row->fecha_rh."</td>
            <td>$l1</td>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE EMPLEADOS :".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////////////
function mov_pendiente_contador_his()
    {
    $id_user= $this->session->userdata('id');
    $id_plaza= $this->session->userdata('id_plaza');
    $tipo= $this->session->userdata('tipo');
    $nivel= $this->session->userdata('nivel');
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,b.id_plaza,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,bb.nombre as motivox 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc1
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      where b.id_plaza=$id_plaza and a.tipo=3 and a.motivo=2 
      order by activo";
      
      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"5\" align=\"center\"><strong>EMPLEADOS CON MOVIMIENTOS</strong></th>
        </tr>
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>PLAZA</strong></th>
        <th><strong>CAPTURO</strong></th>
        <th><strong>VALIDO</strong></th>
        <th><strong></strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
         if($row->activo==2){$color='black'; $s='';}else{$color='red'; $s='No esta dado de baja';}        
    
           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\"><font color=\"$color\">Empleado :".$row->nomina." ".$row->pat." ".$row->mat." ".$row->nom."<br /><font color=\"blue\">".$row->causa."</font></td>
            <td colspan=\"1\"><font color=\"$color\"><strong> Fecha mov.:</strong>".$row->fecha_mov."<br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivox."</font></td>
            <td>RECURSOS o CONTADOR.:".$row->id_rh."</td>
            </tr>
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->id_userx."<br />".$row->fecha_c."</td>
            <td><font color=\"$color\">FECHA DE VAL.: ".$row->fecha_rh."<br />".$s."</font></td>
            <td></td>
            </tr>
            <tr>
            
            </tr>
            <tr></tr><tr></tr><tr></tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE EMPLEADOS :".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////////////

function mov_val_de_sup()
    {
    $id_user= $this->session->userdata('id');
    $id_plaza= $this->session->userdata('id_plaza');
    echo $id_plaza;
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,b.id_plaza,
    bb.nombre as motivox,e.nombre as id_rhx, f.nombre as sucx1,id_super,a.aviso,g.nombre as superx
      FROM catalogo.cat_alta_empleado a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.empleado
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join usuarios e on e.id=a.id_rh
      left join usuarios g on g.id=a.id_super
      left join catalogo.sucursal f on f.suc=a.suc
      where b.id_plaza=$id_plaza and a.motivo='ALTA' and a.cia<>20
      order by a.activo";
      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"5\" align=\"center\"><strong>EMPLEADOS CON MOVIMIENTOS</strong></th>
        </tr>
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>PLAZA</strong></th>
        <th><strong>CAPTURO</strong></th>
        <th><strong>VALIDO</strong></th>
        <th><strong></strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        $s='';
        foreach($query->result() as $row)
        {
       $obser='';$color='black';
       if($row->activo==2 ){$color='red';$s='YA ESTA DADO DE BAJA';}else{$color='black'; $s='';}
       if($row->tipo==2 AND $row->motivo==3){$obser='NO LO HA VALIDADO RECURSOS HUMANOS'; $color='red';$s=$row->sucx;}
       if($row->motivo==4 or $row->motivo==2){$s=$row->sucx1;}
       if($row->motivo==3){$s=$row->sucx;}
           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">Empleado :".$row->empleado." ".$row->pat." ".$row->mat." ".$row->nom."<font color=\"blue\">".$row->causa."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong>".$row->fecha_i."<br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivo." ".$row->suc." - ".$row->sucx."</font></td>
            <td>RECURSOS o CONTADOR.:".$row->id_rh." ".$row->id_rhx."</td>
            </tr>
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->id_userx."<br /> ".$row->fecha."</td>
            <td>FECHA DE VAL.: ".$row->fecha_rh."</td>
            <td><font color=\"$color\">$obser</font></td>
            </tr>
            <tr>
            <td>SUPERVISOR.:".$row->id_super." ".$row->superx."</td>
            <td  colspan=\"4\"><font color=\"$color\">".$row->fecha_super." ".$row->aviso."<br />".$s." </font></td>
            </tr>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE EMPLEADOS :".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////ajustado por cat_alta_empleado
function captura_de_mov_his_alta()
    {
    $id_user= $this->session->userdata('id');
    $plaza= $this->session->userdata('plaza');
    
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax,aa.completo, 
    bb.nombre as motivox,e.nombre as rhx,e.puesto as rhpuestox,b.superv ,aa.puestox
      FROM catalogo.cat_alta_empleado a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.empleado
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join usuarios e  on e.id=a.id_rh
      where superv=$plaza and a.tipo>2 and id_super=0 and empleado>0 and superv>0";
      


      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"4\" align=\"center\"><strong>EMPLEADOS CON MOVIMIENTOS</strong></th>
        </tr>
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>PLAZA</strong></th>
        <th><strong>CAPTURO</strong></th>
        <th><strong>VALIDO</strong></th>
        
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            $l1 = anchor('supervisor/movimiento_his_alta_observa/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
            
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">Empleado :".$row->empleado." ".$row->pat." ".$row->mat." ".$row->nom."<br />".$row->completo."<br />".$row->puestox."<br /><font color=\"blue\">".$row->causa."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong><font color=\"green\">".$row->fecha_i."</font><br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivo."<br />".$row->sucx."</font></td>
            <td>SUPERVISOR.: <br />".$row->id_super."<br />".$row->fecha_super." </td>
            </tr>
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->id_userx."<br /><font color=\"green\">".$row->fecha_rh."</font></td>
            <td>$l1</td>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE EMPLEADOS :".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
function captura_de_mov_his_envio_suc($id)
    {
    $id_user= $this->session->userdata('id');
    $plaza= $this->session->userdata('plaza');
    
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,
    aa.mat,bb.nombre as motivox,e.nombre as rhx,e.puesto as rhpuestox,b.superv ,aa.puestox
      FROM catalogo.cat_alta_empleado a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.empleado
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join usuarios e  on e.id=a.id_rh
      where a.id=$id";
      
 
      
      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"4\" align=\"center\"><strong>EMPLEADOS CON MOVIMIENTOS</strong></th>
        </tr>
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>PLAZA</strong></th>
        <th><strong>CAPTURO</strong></th>
        <th><strong>VALIDO</strong></th>
        
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">Empleado :".$row->empleado." ".$row->pat." ".$row->mat." ".$row->nom."<br />".$row->puestox."<br /><font color=\"blue\">".$row->causa."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong><font color=\"green\">".$row->fecha_i."</font><br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivo."<br />".$row->sucx."</font></td>
            <td>SUPERVISOR.: <br />".$row->id_super."<br />".$row->fecha_super." </td>
            </tr>
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->id_userx."<br /><font color=\"green\">".$row->fecha_rh."</font></td>
            <td></td>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="

</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

function captura_de_mov_his_alta_historico($fec1,$fec2)
    {
    $id_user= $this->session->userdata('id');
    $plaza= $this->session->userdata('plaza');
    
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,
    aa.mat,bb.nombre as motivox,e.nombre as rhx,e.puesto as rhpuestox,b.superv,aa.puestox,f.nombre as id_superx 
      FROM catalogo.cat_alta_empleado a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.empleado
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join usuarios e  on e.id=a.id_rh
      left join usuarios f  on f.id=a.id_super
      where superv=$plaza and a.tipo>=3 and id_super>0 ";
      
      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"5\" align=\"center\"><strong>EMPLEADOS CON MOVIMIENTOS</strong></th>
        </tr>
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>PLAZA</strong></th>
        <th><strong>CAPTURO</strong></th>
        <th><strong>VALIDO</strong></th>

        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            
            
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">Empleado :".$row->empleado." ".$row->pat." ".$row->mat." ".$row->nom."<br />".$row->puestox."<br /><font color=\"blue\">".$row->causa."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong><font color=\"green\">".$row->fecha_i."</font><br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivo."<br />".$row->sucx."</font></td>
            <td>SUPERVISOR.: <br />".$row->id_superx."<br />".$row->fecha_super." </td>
            </tr>
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->id_userx."<br /><font color=\"green\">".$row->fecha_rh."</font></td>
            <td></td>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE EMPLEADOS :".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
function mov_personal_que_llego()
    {
    $id_user= $this->session->userdata('id');
    $id_plaza= $this->session->userdata('id_plaza');
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,
    bb.nombre as motivox,e.nombre as id_rhx 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join usuarios e on e.id=a.id_rh
      where a.id_plaza=$id_plaza and a.tipo=3";
      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"5\" align=\"center\"><strong>EMPLEADOS CON MOVIMIENTOS</strong></th>
        </tr>
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>PLAZA</strong></th>
        <th><strong>CAPTURO</strong></th>
        <th><strong>VALIDO</strong></th>
        <th><strong></strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
       
           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">Empleado :".$row->nomina." ".$row->pat." ".$row->mat." ".$row->nom."<br /><font color=\"blue\">".$row->causa."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong>".$row->fecha_mov."<br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivox."</font></td>
            <td>RECURSOS o CONTADOR.:".$row->id_rh." ".$row->id_rhx."</td>
            </tr>
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->id_userx."<br /> ".$row->fecha_c."</td>
            <td>FECHA DE VAL.: ".$row->fecha_rh."</td>
            <td></td>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE EMPLEADOS :".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////////////

  function comision()
    {
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select a.*
       from desarrollo.cortes_g a
       where tipo>=2
       group by fecha
       order by fecha desc";
        $q = $this->db->query($s); 
 $color='#F9075C';        
$totgere=0;
$totsup=0;

        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th></th>
        <th>FECHA</th>
        <th></th>
        
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $num=1;
        foreach($q->result() as $r)
        {
        $l1 = anchor('supervisor/comision_det/'.$r->fecha, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
             
        
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"4\" color=\"$color\"> VENTAS MENSUALES</font></td>
            <td align=\"left\"><font size=\"4\" color=\"$color\">".$r->fecha."</font></td>
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            </tr>
            ";
            $num=$num+1;
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 function comision_det($fecha)
    {
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        $plaza= $this->session->userdata('plaza');
       $s = "select a.tipo,a.id,a.diad,a.diac,a.his_vta,a.vta_naturista,a.tipo2,a.suc,a.sucx,sum(a.siniva)as siniva,
       (select sum(aa.siniva)from desarrollo.cortes_g aa where fecha='$fecha' and aa.suc=a.suc and aa.clave1<>20)as total_vta
       from desarrollo.cortes_g a
       left join catalogo.sucursal b on b.suc=a.suc
       where
       fecha='$fecha' and clave1=10 and superv=$plaza
       or
       fecha='$fecha' and clave1=11 and superv=$plaza
       or
       fecha='$fecha' and clave1=16 and superv=$plaza
       or
       fecha='$fecha' and clave1=24 and superv=$plaza
       group by suc
       order by tipo2,siniva desc
       ";
       
        $q = $this->db->query($s); 
    
$totgere=0;
$totsup=0;
       $tabla= "
       
        <table cellpadding=\"3\">
        
        <tr>
        <th></th>
        <th></th>
        <th align=\"center\" colspan=\"3\"><strong>Venta</strong></th>
        <th align=\"center\" colspan=\"2\">COMISION</th>
        <th></th>
        
        </tr>
        
        <tr>
        <th>#</th>
        <th>Sucursal</th>
        <th>Total</th>
        <th>Historico <br />Gontor e Imperial</th>
        <th>Gontor e Imperial</th>
        <th align=\"center\">Vta<br />Dias</th>
        <th align=\"center\">Incremento<br />Dias</th>
        <th></th>
        </tr>
        <tbody>
        ";
        
  
        $num=0;
        $sup=0;
        $ger=0;
        $nat_ger=0;
        $nat_sup=0;
         $color='black';
        foreach($q->result() as $r)
        {
        $farmacia=' ';
        $incremento=' ';
        $dif=0;
        if($r->his_vta>0){$dif=$r->siniva-$r->his_vta;}
        if($dif>=15000 and $dif<=19999){$incremento=15;}
        if($dif>=20000 and $dif<=24999){$incremento=20;}
        if($dif>=25000){$incremento=25;}
        if($r->his_vta==0 and $r->siniva>=100000 and $r->tipo2=='G'){$incremento=30;}
        if($r->his_vta==0 and $r->siniva>=150000 and $r->tipo2=='D'){$incremento=30;}
        $l1 = anchor('ventas/imprimir_det1/'.$fecha.'/'.$r->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target' => 'blank'));
         $sx1 = "select *from catalogo.cat_comision  where tipo='$r->tipo2' and $r->siniva between monto1 and monto2";
        $qx1 = $this->db->query($sx1);
        if($qx1->num_rows() > 0){    
        $rx1=$qx1->row();
        $farmacia=$rx1->farmacia;
        $ger=$ger+$rx1->gere;
        $sup=$sup+$rx1->sup;
        }     

        $num=$num+1; 
        
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"2\" color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font size=\"2\" color=\"$color\">".$r->tipo2." ".str_pad( $r->suc,4,"0",STR_PAD_LEFT)." - ".$r->sucx."<br /><font color=\"gray\">".$r->diac." - ".$r->diad."</font></font></td>
            <td align=\"right\"><font size=\"2\" color=\"green\">".number_format($r->total_vta,2)."<br />_</font></td>
            <td align=\"right\"><font size=\"2\" color=\"blue\">".number_format($r->his_vta,2)."</font></td>
            <td align=\"right\"><font size=\"2\" color=\"blue\">".number_format($r->siniva,2)."</font></td>
            
            <td align=\"right\"><font size=\"1\" color=\"blue\">".$farmacia."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"red\">".$incremento."</font></td>
            <td align=\"right\"><font size=\"1\" color=\"green\">".$l1."</font></td>
            
             </tr>
            ";

         }
         $tabla.="
        
           
        </tbody>
       ";
//****************************************************
  
//****************************************************    
$tabla.="</table>";


        return $tabla;
        }
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
/////**************************************************************
//**************************************************************
//**************************************************************

//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////**************************************************************
//**************************************************************
//**************************************************************

//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////**************************************************************
//**************************************************************
//**************************************************************

//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///


//**************************************************************
//**************************************************************
//**************************************************************
}