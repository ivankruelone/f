<?php
class Gerente_model extends CI_Model
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
       $l1 = anchor('gerente/tabla_control_pedidos_ger_det/'.$fec.'/'.$r->superv,$r->superx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
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


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
		 where suc=$r->suc and date_format(fechas,'%Y-%m')='$fec' and tid<>'X' group by suc";       
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
       $l1 = anchor('gerente/pedido_folio/'.$r->suc.'/'.$fec,$r->tipo2.' - '.$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
       $l1 = anchor('gerente/pedido_detalle/'.$r->suc.'/'.$fec.'/'.$r->id,$r->id.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
       $l2 = anchor('a_surtido/imprime_pedidos_rem/'.$r->id.'/'.$r->suc, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado', 'target' => '_blank')); 
	   if($r->tid=='C'){$tipox='SURTIDO'; $color='black';}
       if($r->tid=='S'){$tipox='SIN EXISTENCIA'; $color='orange';}
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
       if($re->tid=='S'){$tipox='SIN EXISTENCIA'; $color='orange';}
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_pedido_detalle($suc,$fec,$fol)
    {
    $totped=0;
    $totcom=0;
	$totcan=0; 
    echo date('Y-m-d')-1;
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
        $totpeds=0;
        foreach($q->result() as $r)
        {
        if($r->ped<>$r->sur){
        $color='red';
        }else{
        $color='black';    
        }
        if($r->tipo==4){$de='DESCONTINUADO';$color='blue';}else{$totpeds=$totpeds+$r->ped;   
        }
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
		$porce=($totcom*100)/$totpeds;
        
        
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function control_ventas_sup($fec)
    {
        
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*, b.nombre as supervx, 
        sum(venta)as can, 
        sum(total)as sub,
        sum(descuento)as des, 
        sum(importe)as vta
        from catalogo.sucursal a
        left join usuarios b on b.plaza=a.superv and nivel=14 and activo=1 and responsable='R'
        left join vtadc.venta c on a.suc=c.sucursal and aaa=$aaa and mes=$mes
        where regional=$plaza  and a.tlid=1 and a.suc>100 and a.suc<=2000 group by a.superv 
        order by superv";   
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
	   $num=$num+1;
       $l1 = anchor('gerente/tabla_control_ventas/'.$r->superv.'/'.$fec,$r->superv.' - '.$r->supervx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->sub,2)."</td>
            <td align=\"right\">".number_format($r->des,2)."</td>
            <td align=\"right\">".number_format($r->vta,2)."</td>
            </tr>
            ";
           
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function control_ventas($superv,$fec)
    {
$aaa=substr($fec,0,4);
$mes=substr($fec,5,2);        
        $id_user= $this->session->userdata('id');
        $s="select a.*, b.nombre as supervx, 
        sum(venta)as can, 
        sum(total)as sub,
        sum(descuento)as des, 
        sum(importe)as vta
        from catalogo.sucursal a
        left join usuarios b on b.plaza=a.superv and nivel=14 and activo=1 and responsable='R'
        left join vtadc.venta c on a.suc=c.sucursal and aaa=$aaa and mes=$mes
        where superv=$superv  and a.tlid=1 and a.suc>100 and a.suc<=2000 group by a.suc
        order by superv";   
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
       $l1 = anchor('gerente/venta_producto/'.$r->suc.'/'.$fec,$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
       $l2 = anchor('gerente/venta_dia/'.$r->suc.'/'.$fec,'DIAS</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));     
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
             <td align=\"right\">".number_format($r->can,0)."</td>
            <td align=\"right\">".number_format($r->sub,2)."</td>
            <td align=\"right\">".number_format($r->des,2)."</td>
            <td align=\"right\">".number_format($r->vta,2)."</td>
            <td align=\"left\">$l2</td>
            </tr>
            ";
           
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
       	$l1 = anchor('gerente/venta_detalle/'.$r->suc.'/'.$fec.'/'.$r->fecha,$r->fecha.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
		     
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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_cortes_sup($fec)
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,b.nombre as supervx,
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
		from catalogo.sucursal a 
        left join usuarios b on b.plaza=a.superv and nivel=14 and activo=1 and responsable='R'
        left join cortes_c c on c.suc=a.suc and date_format(c.fechacorte,'%Y-%m')='$fec'
        where a.regional=$plaza and date_format(c.fechacorte,'%Y-%m')='$fec'  and a.tlid=1 and a.suc>100 and a.suc<=2000 
        group by superv
         
		order by a.superv";
        
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
       $arqueo=0;
       $arqueo=$r->tar+$r->vale+$r->pesos+$r->asalto+$r->mn;
	   $num=$num+1;
       $l1 = anchor('gerente/tabla_control_cortes/'.$r->superv.'/'.$fec,$r->superv.' - '.$r->supervx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
           
            $fol=0;
            $fechas=0;
            $ped=0;
           
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\">".number_format($r->pesos,2)."</td>
            <td align=\"right\">".number_format($r->mn,2)."</td>
			<td align=\"right\">".number_format($r->tar,2)."</td>
            <td align=\"right\">".number_format($r->vale,2)."</td>
            <td align=\"right\">".number_format($r->asalto,2)."</td>
            <td align=\"right\">".number_format($arqueo,2)."</td>
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
           $totarqueo=$totarqueo+$arqueo;
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_cortes($superv,$fec)
    {
        
        $id_user= $this->session->userdata('id');
        $s="select a.*
		from catalogo.sucursal a where a.superv=$superv  and a.tlid=1 and a.suc>100 and a.suc<=2000
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
       $l1 = anchor('gerente/corte_dia/'.$r->suc.'/'.$fec,$r->tipo2.' - '.$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
           
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
       $l1 = anchor('gerente/corte_detalle/'.$r->id.'/'.$fec.'/'.$suc,$r->fechacorte.' </a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
           
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
    function control_cortes_recarga_sup($fec)
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select a.*,d.nombre as supervx, sum(c.corregido) as recarga
        from catalogo.sucursal a
        left join cortes_c b on b.suc=a.suc
        left join cortes_d c on c.id_cc=b.id and c.clave1=20
        left join usuarios d on d.plaza=a.superv and nivel=14 and activo=1 and responsable='R'
         where a.regional= $plaza  and c.clave1=20 and date_format(b.fechacorte,'%Y-%m')='$fec'  and a.tlid=1 and a.suc>100 and a.suc<=2000
         group by a.superv";   
        $q = $this->db->query($s);
        
$num=0;
		   $totrec=0;
          
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUPERVISOR</th>
        <th>RECARGA PDV</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  		$monto=0;
  		$totcom=0;
        foreach($q->result() as $r)
        {
        



	   
	   $num=$num+1;
       $l1 = anchor('gerente/tabla_control_recarga/'.$r->superv.'/'.$fec,$r->superv.' - '.$r->supervx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\">$l1</td>
            <td align=\"right\"><font color=\"blue\">".number_format($r->recarga,2)."</font></td>
            
            
            
             
            </tr>
            ";
           $totrec=$totrec+$r->recarga;
        }
         $tabla.="
        </tbody>
        <tr>
            <td align=\"right\" colspan=\"1\">TOTAL</td>
            <td align=\"right\">".number_format($totrec,2)."</td>
        </tr>
        </table>";
        
        return $tabla;
    
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_cortes_recarga($superv,$fec)
    {
        $ci=& get_instance();
        $ci->load->model('cortes_model');
        
        $id_user= $this->session->userdata('id');
        $s="select *from catalogo.sucursal where superv=$superv  and a.tlid=1 and a.suc>100 and a.suc<=2000 order by superv,suc"; 
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
       $l1 = anchor('gerente/corte_dia_comanche/'.$r->suc.'/'.$fec,$r->tipo2.' - '.$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

   function __tablo($sucursal, $fecha)
    {
        $this->load->library('nuSoap_lib');
        
        
$client = new nusoap_client("http://201.156.18.162/comanche/index.php/wsta/MontoSucursalDia_/wsdl", false);
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
        $s="select a.*,sum(b.fol2-b.fol1+1)as inv,c.nombre as supervx
        from catalogo.sucursal a
        left join  vtadc.tarjetas_suc b on b.suc=a.suc
        left join usuarios c on c.plaza=a.superv and nivel=14 and activo=1 and responsable='R'
        where regional=$plaza and fol1 is not null  and a.tlid=1 and a.suc>100 and a.suc<=2000  group by a.superv";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        <tr>
        <th colspan=\"2\" align=\"center\">CLIENTE PREFERENTE</th>
        </tr>
        
        <tr>
        <th>SUPERVISOR</th>
        <th>ENTREGAN</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  
        foreach($q->result() as $r)
        {
        	
	
       $l0 = anchor('gerente/tarjetas_sup/'.$r->superv,$r->superv.' - '.$r->supervx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
        
            $tabla.="
            <tr>
            <td align=\"left\">".$l0."</td>
            <td align=\"center\">".$r->inv."</td>
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function control_tar_sup($superv)
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
        $s="select a.*,b.fol1,b.fol2,(b.fol2-b.fol1+1)inv
        from catalogo.sucursal a
        left join  vtadc.tarjetas_suc b on b.suc=a.suc
        where superv=$superv and fol1 is not null  and a.tlid=1 and a.suc>100 and a.suc<=2000"; 
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
           
	  $tottar=$r->inv-$tar;
	   $num=$num+1;
       $l0 = anchor('gerente/tabla_control_tarjetas_fol/'.$r->suc,$tar.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
       $l1 = anchor('gerente/tabla_control_tarjetas_fol_otras/'.$r->suc,$tar1.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
       $l2 = anchor('gerente/tabla_control_tarjetas_pro/'.$r->suc,'<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver el detalle de productos con descuento de cliente preferente!', 'class' => 'encabezado'));
       $l3 = anchor('gerente/tabla_control_tarjetas_pro_otras/'.$r->suc,'<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver el detalle de productos con descuento de otras tarjetas!', 'class' => 'encabezado'));     
       }
       if($tottar==0){$color='red';}else{$color='black';}
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$r->tipo2." - ".$r->suc." - ".$r->nombre."</font></td>
            <td align=\"right\"><font color=\"$color\">".$r->fol1."</font></td>
            <td align=\"right\"><font color=\"$color\">".$r->fol2."</font></td>
            <td align=\"center\"><font color=\"$color\">".$r->inv."</font></td>
            <td align=\"center\"><font color=\"$color\">$l0</font></td>
            <td align=\"center\"><font color=\"$color\">".$tottar."</font></td>
            <td align=\"center\"><font color=\"$color\">".$l2."</font></td>
            <td align=\"center\"><font color=\"$color\">$l1</font></td>
             <td align=\"center\"><font color=\"$color\">$l3</font></td>
            </tr>
            ";
           
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

        $l1 = anchor('gerente/tabla_control_tarjetas_fol_pro/'.$suc.'/'.$r->codigo,$r->codigo.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
	
    
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
        $l1 = anchor('gerente/tabla_control_tarjetas_pro_det/'.$suc.'/'.$r->codigo,$r->codigo.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
	
    
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
        $l1 = anchor('gerente/tabla_control_tarjetas_fol_pro_otras/'.$suc.'/'.$r->codigo,$r->codigo.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
	
    
    	
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
        $l1 = anchor('gerente/tabla_control_tarjetas_pro_det_otras/'.$suc.'/'.$r->codigo,$r->codigo.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
	
    
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


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function control_ventas_nat($aaa)
    {
$tim01=0;$tim02=0;$tim03=0;$tim04=0;$tim05=0;$tim06=0;$tim07=0;$tim08=0;$tim09=0;$tim10=0;$tim11=0;$tim12=0;
$tima01=0;$tima02=0;$tima03=0;$tima04=0;$tima05=0;$tima06=0;$tima07=0;$tima08=0;$tima09=0;$tima10=0;$tima11=0;$tima12=0;
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
$aaax=$aaa-1;
        $s="SELECT b.superv, c.nombre as supervx,
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
FROM vtadc.fe_prox_det_nat  a
left join catalogo.sucursal b on b.suc=a.suc
left join  desarrollo.usuarios c on c.plaza=b.superv and c.nivel=14 and c.activo=1 and responsable='R'
where aaa=$aaa and b.regional=$plaza and tlid=1 and b.suc>100 and b.suc<=2000 and b.tipo2<>'F'
group by b.superv";
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <th colspan=\"7\">REPORTE DE VENTAS DE PRODUCTOS NATURISTAS</th>
        </thead>
        <tbody>
        ";
        
  $por01=0;$por02=0;$por03=0;$por04=0;$por05=0;$por06=0;$por07=0;$por08=0;$por09=0;$por10=0;$por11=0;$por12=0;
        foreach($q->result() as $r)
        {
if($r->impn01 > $r->imp01 && $r->impn01 > 0){$por01=(($r->imp01*100)/$r->impn01);}
if($r->impn02 > $r->imp02 && $r->impn02 > 0){$por02=(($r->imp02*100)/$r->impn02);}
if($r->impn03 > $r->imp03 && $r->impn03 > 0){$por03=(($r->imp03*100)/$r->impn03);}
if($r->impn04 > $r->imp04 && $r->impn04 > 0){$por04=(($r->imp04*100)/$r->impn04);}
if($r->impn05 > $r->imp05 && $r->impn05 > 0){$por05=(($r->imp05*100)/$r->impn05);}
if($r->impn06 > $r->imp06 && $r->impn06 > 0){$por06=(($r->imp06*100)/$r->impn06);}
if($r->impn07 > $r->imp07 && $r->impn07 > 0){$por07=(($r->imp07*100)/$r->impn07);}
if($r->impn08 > $r->imp08 && $r->impn08 > 0){$por08=(($r->imp08*100)/$r->impn08);}
if($r->impn09 > $r->imp09 && $r->impn09 > 0){$por09=(($r->imp09*100)/$r->impn09);}
if($r->impn10 > $r->imp10 && $r->impn10 > 0){$por10=(($r->imp10*100)/$r->impn10);}
if($r->impn11 > $r->imp11 && $r->impn11 > 0){$por11=(($r->imp11*100)/$r->impn11);}
if($r->impn12 > $r->imp12 && $r->impn12 > 0){$por12=(($r->imp12*100)/$r->impn12);}
	   
	   $num=$num+1;
       $l1 = anchor('gerente/tabla_control_ventas_nat_sup/'.$r->superv.'/'.$aaa,$r->supervx.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"1\">Sup</td>
            <td align=\"left\" colspan=\"6\">$l1</td>
            </tr>
            <tr>
            <td align=\"left\">Mes</td>
            <td align=\"right\">Ene <font color=\"red\">% ".number_format($por01,2)."</font></td>
            <td align=\"right\">Feb <font color=\"red\">% ".number_format($por02,2)."</font></td>
            <td align=\"right\">Mar <font color=\"red\">% ".number_format($por03,2)."</font></td>
            <td align=\"right\">Abr <font color=\"red\">% ".number_format($por04,2)."</font></td>
            <td align=\"right\">May <font color=\"red\">% ".number_format($por05,2)."</font></td>
            <td align=\"right\">Jun <font color=\"red\">% ".number_format($por06,2)."</font></td>
            </tr>
            <tr>
<td align=\"left\" colspan=\"1\">Naturista $aaa</td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp01,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp02,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp03,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp04,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp05,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp06,2)."</font></td>
            </tr>
            <tr>
<td align=\"left\" colspan=\"1\">Naturista $aaax</td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn01,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn02,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn03,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn04,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn05,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn06,2)."</font></td>
            </tr>
            <tr>
            <td align=\"left\">Mes</td>
            <td align=\"right\">Jul <font color=\"red\">% ".number_format($por07,2)."</font></td>
            <td align=\"right\">Ago <font color=\"red\">% ".number_format($por08,2)."</font></td>
            <td align=\"right\">Sep <font color=\"red\">% ".number_format($por09,2)."</font></td>
            <td align=\"right\">Oct <font color=\"red\">% ".number_format($por10,2)."</font></td>
            <td align=\"right\">Nov <font color=\"red\">% ".number_format($por11,2)."</font></td>
            <td align=\"right\">Dic <font color=\"red\">% ".number_format($por12,2)."</font></td>
            </tr>
            <tr>
<td align=\"left\" colspan=\"1\">Naturista $aaa</td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp07,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp08,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp09,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp10,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp11,2)."</font></td>
<td align=\"right\"><font color=\"blue\">".number_format($r->imp12,2)."</font></td>
			</tr>
            <tr>
<td align=\"left\" colspan=\"1\">Naturista $aaax</td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn07,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn08,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn09,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn10,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn11,2)."</font></td>
<td align=\"right\"><font color=\"black\">".number_format($r->impn12,2)."</font></td>
<td align=\"right\"><font color=\"blue\"></font></td>	
			</tr>";
$tim01=$tim01+$r->imp01;
$tim02=$tim02+$r->imp02;
$tim03=$tim03+$r->imp03;
$tim04=$tim04+$r->imp04;
$tim05=$tim05+$r->imp05;
$tim06=$tim06+$r->imp06;
$tim07=$tim07+$r->imp07;
$tim08=$tim08+$r->imp08;
$tim09=$tim09+$r->imp09;
$tim10=$tim10+$r->imp10;
$tim11=$tim11+$r->imp11;
$tim12=$tim12+$r->imp12;
$tima01=$tima01+$r->impn01;
$tima02=$tima02+$r->impn02;
$tima03=$tima03+$r->impn03;
$tima04=$tima04+$r->impn04;
$tima05=$tima05+$r->impn05;
$tima06=$tima06+$r->impn06;
$tima07=$tima07+$r->impn07;
$tima08=$tima08+$r->impn08;
$tima09=$tima09+$r->impn09;
$tima10=$tima10+$r->impn10;
$tima11=$tima11+$r->impn11;
$tima12=$tima12+$r->impn12;
        }
         $tabla.="
         <tr>
            <td align=\"center\" colspan=\"12\"><font size=\"+2\">TOTAL</font></td>
            </tr>
            <td align=\"right\"><font color=\"black\">$aaa</font></td>
            <td align=\"right\"><font color=\"black\">ENE: ".number_format($tim01,2)."</font><br /><font color=\"blue\">JUL: ".number_format($tim07,2)."</font></td>
            <td align=\"right\"><font color=\"black\">FEB: ".number_format($tim02,2)."</font><br /><font color=\"blue\">AGO: ".number_format($tim08,2)."</font></td>
            <td align=\"right\"><font color=\"black\">MAR: ".number_format($tim03,2)."</font><br /><font color=\"blue\">SEP: ".number_format($tim09,2)."</font></td>
            <td align=\"right\"><font color=\"black\">ABR: ".number_format($tim04,2)."</font><br /><font color=\"blue\">OCT: ".number_format($tim10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">MAY: ".number_format($tim05,2)."</font><br /><font color=\"blue\">NOV: ".number_format($tim11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">JUN: ".number_format($tim06,2)."</font><br /><font color=\"blue\">DEC: ".number_format($tim12,2)."</font></td>
         </tr>
            
         <tr>
            <td align=\"right\"><font color=\"black\">$aaax</font></td>
            <td align=\"right\"><font color=\"black\">ENE: ".number_format($tima01,2)."</font><br /><font color=\"blue\">JUL: ".number_format($tima07,2)."</font></td>
            <td align=\"right\"><font color=\"black\">MAR: ".number_format($tima02,2)."</font><br /><font color=\"blue\">SEP: ".number_format($tima08,2)."</font></td>
            <td align=\"right\"><font color=\"black\">ABR: ".number_format($tima03,2)."</font><br /><font color=\"blue\">OCT: ".number_format($tima09,2)."</font></td>
            <td align=\"right\"><font color=\"black\">FEB: ".number_format($tima04,2)."</font><br /><font color=\"blue\">AGO: ".number_format($tima10,2)."</font></td>
            <td align=\"right\"><font color=\"black\">MAY: ".number_format($tima05,2)."</font><br /><font color=\"blue\">NOV: ".number_format($tima11,2)."</font></td>
            <td align=\"right\"><font color=\"black\">JUN: ".number_format($tima06,2)."</font><br /><font color=\"blue\">DEC: ".number_format($tima12,2)."</font></td>
        </tr>    
        </tbody>
        </table>";
        
        return $tabla;

    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function control_ventas_nat_sup($superv,$aaa)
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
        superv=$superv and tipo2<>'F'
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
       $l1 = anchor('gerente/venta_producto_nat/'.$r->suc.'/'.$aaa,$r->tipo2.' - '.$r->suc.' - '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
        $l1 = anchor('gerente/tabla_comision_sup/'.$r->fecha, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
             
        
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
 function comision_sup($fecha)
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
         
       $s = "select c.nombre as supervx,
       b.superv,
	    a.tipo,a.id,a.diad,a.diac,a.his_vta,a.vta_naturista,a.tipo2,a.suc,a.sucx,sum(a.siniva)as siniva
       
       from desarrollo.cortes_g a
       left join catalogo.sucursal b on b.suc=a.suc
       left join usuarios c on c.plaza=b.superv  and responsable='R'
       where
       fecha='$fecha' and clave1<>20 and regional=$plaza
       group by b.superv";
        $q = $this->db->query($s); 
 $color='#F9075C';        
$totgere=0;
$totsup=0;

        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>SUPERVISOR</th>
        <th>VTA SIN RECARGA</th>
        
        <th></th>
        
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
        $num=1;
        foreach($q->result() as $r)
        {
        $l1 = anchor('gerente/comision_det/'.$r->superv.'/'.$fecha, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
             
        
            $tabla.="
            <tr>
            <td align=\"left\"><font size=\"4\" color=\"$color\">".$r->superv." - ".$r->supervx."</font></td>
            <td align=\"right\"><font size=\"2\" color=\"green\">".number_format($r->siniva,2)."<br />_</font></td>
            
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

 function comision_det($superv,$fecha)
    {
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
       $s = "select a.tipo,a.id,a.diad,a.diac,a.his_vta,a.vta_naturista,a.tipo2,a.suc,a.sucx,sum(a.siniva)as siniva,
       (select sum(aa.siniva)from desarrollo.cortes_g aa where fecha='$fecha' and aa.suc=a.suc and aa.clave1<>20)as total_vta
       from desarrollo.cortes_g a
       left join catalogo.sucursal b on b.suc=a.suc
       where
       fecha='$fecha' and clave1=10 and superv=$superv
       or
       fecha='$fecha' and clave1=11 and superv=$superv
       or
       fecha='$fecha' and clave1=16 and superv=$superv
       or
       fecha='$fecha' and clave1=24 and superv=$superv
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
  function agrega_member_movimiento($id_emp,$id_mov,$fecha_i,$obser,$suc)
    {
       //
        $id_user= $this->session->userdata('id');
        $s = "SELECT a.*,b.nombre as sucx,b.id_plaza,d.nombre as suc2x
FROM catalogo.cat_empleado a
left join catalogo.sucursal b on b.suc=a.succ
left join catalogo.sucursal d on d.suc=$suc
where a.id=$id_emp";
        $q = $this->db->query($s);
        if($q->num_rows() == 1){
        $r = $q->row();
        $id_plaza=$r->id_plaza; 
        if($id_mov==3){
            $sucur=$suc;
            $causax=' DE '.$r->suc.' '.trim($r->sucx).' A '.$suc.' '.trim($r->suc2x).' '.$obser;   
        }else{
            $sucur=$r->succ;
            $causax=$obser;
            }
   
            //id, cia, nomina, motivo, causa, suc1, suc2, id_user, dias, fecha_c, id_rh, fecha_rh, tipo, id_plaza       
            $new_member_insert_data = array(
            'cia'=>$r->cia,
            'nomina'=>$r->nomina,
            'motivo'=>$id_mov,
            'causa'=>strtoupper(trim($causax)),
            'suc1'=>$sucur,
            'suc2'=>$suc,
            'id_user'=>$id_user,
            'dias'=>1,
            'fecha_c'=> date('Y-m-d H:i:s'),
            'id_plaza'=>$id_plaza,
            'fecha_mov'=>$fecha_i,
            'tipo'=>1
            
		);
		$insert = $this->db->insert('mov_supervisor', $new_member_insert_data);
       
        }
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
////////////////////////////////////
    function valida_member_empleados($id,$fechaf)
    {
     $nivel= $this->session->userdata('nivel');
     $id_user= $this->session->userdata('id');


     $data = array('tipo'=>2, 'fecha_c'=>date('Y-m-d H:i:s'));
 	 $this->db->where('id', $id);
     $this->db->update('mov_supervisor', $data);
     return $this->db->affected_rows();
        	 
     }
     
//////////////////////////////////////////////////
    function delete_member_empleados($id)
    {
     $data = array('tipo'=>4, 'fecha_c'=>date('Y-m-d H:i:s'));
 	 $this->db->where('id', $id);
     $this->db->update('mov_supervisor', $data);
    }

/////////////////////////////////////////////////////
//**************************************************************
function captura_de_mov()
    {
    $id_user= $this->session->userdata('id');
    
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,bb.nombre as motivox 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      where a.id_user=$id_user and a.tipo=1";
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
            $l3 = anchor('gerente/tabla_empleados_borrar/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            $l4 = anchor('gerente/tabla_empleados_validar/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
            
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">Empleado :".$row->nomina." ".$row->pat." ".$row->mat." ".$row->nom."<br /><font color=\"blue\">".$row->causa."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong>".$row->fecha_mov."<br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivox."</font></td>
            <td>$l3</td>
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
function captura_de_mov_his($motivo,$superv)
    {
    $id_user= $this->session->userdata('id');
    $plaza= $this->session->userdata('plaza');
    
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,bb.nombre as motivox,e.nombre as rhx,e.puesto as rhpuestox 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join usuarios e  on e.id=a.id_rh
      where b.superv=$superv and a.tipo>1 and a.tipo>1 and motivo=$motivo
	  order by fecha_c desc";
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
            $l3 = anchor('supervisor/tabla_empleados_borrar/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            $l4 = anchor('supervisor/tabla_empleados_validar/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
            
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">Empleado :".$row->nomina." ".$row->pat." ".$row->mat." ".$row->nom."<br /><font color=\"blue\">".$row->causa."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong><font color=\"green\">".$row->fecha_mov."</font><br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivox."</font></td>
            <td>RECURSOS o CONTADOR.: <br />".$row->rhx." <br />".$row->rhpuestox."</td>
            </tr>
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->id_userx."<br /><font color=\"green\">".$row->fecha_c."</font></td>
            <td>FECHA DE VAL.: <font color=\"green\">".$row->fecha_rh."</font></td>
            </tr>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
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
//**************************************************************
//**************************************************************
function alta_baja_emp($motivo,$superv)
    {
    $id_user= $this->session->userdata('id');
    $plaza= $this->session->userdata('plaza');
    
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,aa.puestox,
    e.nombre as rhx,e.puesto as rhpuestox,aa.curp,e.nombre as id_superx 
      FROM catalogo.cat_alta_empleado a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.empleado
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join usuarios e  on e.id=a.id_rh
      left join usuarios f  on e.id=a.id_super
      where b.superv=$superv and a.tipo>1  and motivo='$motivo'
	  order by fecha desc";
      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"5\" align=\"center\"><strong>EMPLEADOS CON MOVIMIENTOS</strong></th>
        </tr>
        <tr>
        <th><strong>SUCURSAL</strong></th>
        <th><strong>CAPTURA</strong></th>
        <th><strong>VALIDA</strong></th>
        <th><strong>SUPERVISOR</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        $color1='red';
        $color2='blue';
        $color3='green';
        foreach($query->result() as $row)
        {
            if($row->id_super==0){$superx='';}else{$superx=0;}
            $l3 = anchor('supervisor/tabla_empleados_borrar/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            $l4 = anchor('supervisor/tabla_empleados_validar/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
            
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"6\"><font>".$row->cia."-".$row->ciax."</td>
            </tr>
            <tr>
            <td align=\"left\" colspan=\"6\"><font>EMPLEADO: ".$row->empleado."-".$row->pat."".$row->mat."".$row->nom."_________".$row->puestox."</td>
            </tr>
            <tr>
            <td align=\"left\">".$row->suc."-".$row->sucx."<br />".$row->fecha_i."</td>
            <td align=\"left\">".$row->id_userx."<br /><font color=\"$color2\">".$row->fecha."</font></td>
            <td align=\"left\">".$row->rhx."<br /><font color=\"$color3\">".$row->fecha_rh."</font></td>
            <td align=\"left\"><font color='purple'>".$superx."<br />".$row->fecha_super."</font></td>
            </tr>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
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
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
/////////////////////////////////////////////////////////////////////////////////////////
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