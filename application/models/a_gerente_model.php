<?php
class A_gerente_model extends CI_Model
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
    function control_orden($aaa,$mes,$tit)
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        $s = "select aaae,mese,diae,folprv,prv,prvx,folprv,sum(cans)as cans,sum(cansbo)as cansbo
from almacen.compraped
where tipo3='C' and tipo='alm' and aaae=$aaa and mese=$mes
group by folprv
";

        $q = $this->db->query($s);
 

        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        
        <tr>
        <th>Fecha</th>
        <th>Orden</th>
        <th>Prv</th>
        <th>Proveedor</th>
        <th>Piezas<br />Cedis</th>
        <th>Entrega<br />Cedis</th>
        <th>% Entrega<br />Cedis</th>
        <th>Piezas<br />Farmabodega</th>
        <th>Entrega<br />Farmabodega</th>
        <th>% Entrega<br />Cedis</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  
         foreach($q->result() as $r)
        {
        	$ss="select a.orden,a.id,sum(can)as cans,sum(canr)as canr
from compra_c a
left join compra_d b on b.id_cc=a.id
where tipo='C' and a.orden=$r->folprv
group by a.orden";
 $qq = $this->db->query($ss);      
if($qq->num_rows()>0){
    $rr= $qq->row();
    $entrega=$rr->cans;
    }else{
    $entrega=0;    
    }
    $sss="select a.orden,a.id,sum(can)as cans,sum(canr)as canr
from farmabodega.compra_c a
left join farmabodega.compra_d b on b.id_cc=a.id
where a.orden=$r->folprv
group by a.orden";
 $qqq = $this->db->query($sss);      
if($qqq->num_rows()>0){
    $rrr= $qqq->row();
    $entregabo=$rrr->cans;
    }else{
    $entregabo=0;    
    }
 if($entrega>0){$porc=($entrega*100)/$r->cans;}else{$porc=0;}
 if($entregabo>0){$porb=($entregabo*100)/$r->cansbo;}else{$porb=0;}
       $l1 = anchor('a_gerente/tabla_control_order_prv/'.$aaa.'/'.$mes.'/'.$r->folprv, $r->prv, array('title' => 'Haz Click aqui para ver detalle !', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            
            <td align=\"left\">".$r->aaae."-".$r->mese."-".$r->diae."</td>
            <td align=\"left\">".$r->folprv."</td>
            <td align=\"left\">".$l1."</td>
            <td align=\"left\">".$r->prvx."</td>
            <td align=\"right\">".number_format($r->cans,0)."</td>
            <td align=\"right\">".number_format($entrega,0)."</td>
            <td align=\"right\">% ".number_format($porc,2)."</td>
            <td align=\"right\">".number_format($r->cansbo,0)."</td>
            <td align=\"right\">".number_format($entregabo,0)."</td>
            <td align=\"right\">% ".number_format($porb,2)."</td>
            </tr>
            ";
        }
         $tabla.="
        </tbody>
        
        </table>";
        
        echo $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
    function control_orden_prv($aaa,$mes,$tit,$fol)
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        $s = "select clabo,sec,susa,aaae,mese,diae,folprv,prv,prvx,folprv,(cans)as cans,(cansbo)as cansbo
from almacen.compraped
where tipo3='C' and tipo='alm' and aaae=$aaa and mese=$mes and folprv=$fol

";

        $q = $this->db->query($s);
 

        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        
        <tr>
        <th>Fecha</th>
        <th>Sec</th>
        <th>Sustancia Activa</th>
        <th>Factura</th>
        <th>Piezas<br />Cedis</th>
        <th>Regalo</th>
        <th>Piezas<br />Farmabodega</th>
        <th>Regalo</th>
        <th>Lote</th>
        <th>Caducidad</th>
        <th>Fecha</th>
       
        </tr>

        </thead>
        <tbody>
        ";
        
$farma=0;
        $farmar=0;
        $farmab=0;
        $farmabr=0;
        $penb=0;
        $penc=0;  
         foreach($q->result() as $r)
        {
         $tabla.="
            <tr>
             <td align=\"left\"><font color=\"black\">".$r->aaae."-".$r->mese."-".$r->diae."</font></td>
            <td align=\"left\"><font color=\"black\">".$r->sec." - ".$r->clabo."</font></td>
            <td align=\"left\"><font color=\"black\"><strong>".$r->susa."</strong></font></td>
            <td align=\"left\"></td>
            <td align=\"right\"><font color=\"black\"><strong>".number_format($r->cans,0)."</strong></font></td>
            <td align=\"right\"></td>
            <td align=\"right\"><font color=\"black\"><strong>".number_format($r->cansbo,0)."</strong></font></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            </tr>";   
  
        	$ss="select a.fechai,a.fac,a.orden,a.id,lote,cadu,(can)as cans,(canr)as canr
from compra_c a
left join compra_d b on b.id_cc=a.id
where tipo='C' and a.orden=$r->folprv and b.sec=$r->sec
group by a.orden";
 $qq = $this->db->query($ss);      
foreach($qq->result() as $rr)
        {
        $tabla.="
            <tr>
            
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\">".$rr->fac."</td>
            <td align=\"right\">".number_format($rr->cans,0)."</td>
            <td align=\"right\">".number_format($rr->canr,0)."</td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"right\">".$rr->lote."</td>
            <td align=\"right\">".$rr->cadu."</td>
            <td align=\"right\">".$rr->fechai."</td>
            </tr>
            ";    
        $farma=$farma+$rr->cans;
        $farmar=$farmar+$rr->canr;
        }
    $sss="select a.fecha,a.factura,a.orden,a.id,lote,caducidad,(can)as cans,(canr)as canr
from farmabodega.compra_c a
left join farmabodega.compra_d b on b.id_cc=a.id
where a.orden=$r->folprv and b.clave=$r->clabo
group by a.orden";
 $qqq = $this->db->query($sss);      
foreach($qqq->result() as $rrr)
        {
        $tabla.="
            <tr>
            
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\">".$rrr->factura."</td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"right\">".number_format($rrr->cans,0)."</td>
            <td align=\"right\">".number_format($rrr->canr,0)."</td>
            <td align=\"right\">".$rrr->lote."</td>
            <td align=\"right\">".$rrr->caducidad."</td>
            <td align=\"right\">".$rrr->fecha."</td>
            </tr>
            ";    
        $farmab=$farmab+$rrr->cans;
        $farmabr=$farmabr+$rrr->canr;
        }
        $penc=$r->cans-$farma;
        $penb=$r->cansbo-$farmab;
        $tabla.="
            <tr>
            
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"></td>
            <td align=\"left\"><font color=\"red\">TOTAL </font></td>
            <td align=\"right\"><font color=\"red\">".number_format($penc,0)."</font></td>
            <td align=\"right\"></td>
            <td align=\"right\"><font color=\"red\">".number_format($penb,0)."</font></td>
            <td align=\"right\"></td>
            <td align=\"right\"></td>
            <td align=\"right\"></td>
            <td align=\"right\"></td>
            </tr>
            ";  
        $farma=0;
        $farmar=0;
        $farmab=0;
        $farmabr=0;
        $penb=0;
        $penc=0;
        }
         $tabla.="
        </tbody>
        
        </table>";
        
        echo $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function inv_almacen_cedis($tipo,$fec1,$fec2,$tit)
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $aaa1=substr($fec1,0,4);
        $mes1=substr($fec1,5,2);
        $dia1=substr($fec1,8,2);
        $aaa2=substr($fec2,0,4);
        $mes2=substr($fec2,5,2);
        $dia2=substr($fec2,8,2);
        $ecom=0;$edev=0;$etra=0;$eaju=0;$ssur=0;$sdev=0;$saju=0;$stra=0;$invi=0; 
        
        $s="select a.*,b.susa1,b.susa2
        from inv_cedis_sec1 a
        left join catalogo.sec_unica b on a.sec=b.sec
        where a.sec>0 and a.sec<=2000";  
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        
        <tr>
        <th>SEC.</th>
        <th>SUSANCIA ACTIVA</th>
        <th>INV <BR />INICIAL</th>
        <th>ENTRADA <BR />COMPRA</th>
        <th>ENTRADA <BR />DEVOLU.</th>
        <th>ENTRADA <BR />TRASPA.</th>
        <th>ENTRADA <BR />AJUSTE</th>
        <th>SALIDA <BR />SURTIDO</th>
        <th>SALIDA <BR />DEVOLU.</th>
        <th>SALIDA <BR />TRASPA.</th>
        <th>SALIDA <BR />AJUSTE</th>
        <th>INV. <BR />FINAL</th>
        </tr>

        </thead>
        <tbody>
        ";
       $color='#070707';      
        $totecom=0;
        $totedev=0;
        $totetra=0;
        $toteaju=0;
        $totssur=0;
        $totsdev=0;
        $totstra=0;
        $totsaju=0;
        $totinv_f=0;
        $color='blue';
         $color1='green';   
         foreach($q->result() as $r)
        {
       
        $ss="SELECT sum(ecom)as ecom,sum(edev)as edev,sum(etra)as etra,sum(eaju)as eaju,
        sum(ssur)as ssur,sum(sdev)as sdev,sum(stra)as stra,sum(saju)as saju 
        from desarrollo.inv_cedis_dia a where a.sec=$r->sec and a.fecha>='$fec1' and a.fecha<='$fec2' 
         group by a.sec"; 
        $qq = $this->db->query($ss);
        if($qq->num_rows()> 0){
        $rr=$qq->row();
        $ecom=$rr->ecom;
$edev=$rr->edev;
$etra=$rr->etra;
$eaju=$rr->eaju;
$ssur=$rr->ssur;
$sdev=$rr->sdev;
$saju=$rr->saju;
$stra=$rr->stra;    
        }else{
$ecom=0;$edev=0;$etra=0;$eaju=0;$ssur=0;$sdev=0;$saju=0;$stra=0;   
        }

$invi=$r->inv1+$ssur+$sdev+$saju+$stra-$ecom-$edev-$etra-$eaju;               
        $l1='';$l2='';
        
        
		$num=$num+1;
         
            $tabla.="
            <tr>
           <td align=\"right\"><font size=\"-1\" color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->susa1."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($invi,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($ecom,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($edev,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($etra,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($eaju,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color1\">".number_format($ssur,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color1\">".number_format($sdev,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color1\">".number_format($stra,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color1\">".number_format($saju,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color1\">".number_format($r->inv1,0)."</font></td>
           </tr>
            ";
        $totecom=$totecom+$ecom;
        $totedev=$totedev+$edev;
        $totetra=$totetra+$etra;
        $toteaju=$toteaju+$eaju;
        $totssur=$totssur+$ssur;
        $totsdev=$totsdev+$sdev;
        $totstra=$totstra+$stra;
        $totsaju=$totsaju+$saju;
        $totinv_f=$totinv_f+$r->inv1;
        $inv_f=0;
        }
         $tabla.="
        </tbody>
        <tfoot>
        <tr>
        <td align=\"right\"><font size=\"+1\" color=\"$color\"></font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\"></font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\"></font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">TOTAL</font></td> 
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totecom,0)."</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totedev,0)."</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totetra,0)."</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($toteaju,0)."</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totssur,0)."</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totsdev,0)."</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totstra,0)."</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totsaju,0)."</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totinv_f,0)."</font></td>
        </tr>
            </tfoot>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function inv_almacen_farmabodega($tit)
    {
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        
        
        $s="select b.susa1,a.*
from farmabodega.inventario_d a
left join catalogo.catalogo_bodega b on b.clabo=a.clave
where a.cantidad<>0";  
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"2\" border=\"0\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\">
        <caption>$tit</caption>
        <thead>
        
        <tr>
        <th>CLAVE</th>
        <th>SUSANCIA ACTIVA</th>
       <th>LOTE</th>
        <th>CADUCIDAD</th>
        <th>EXISTENCIA</th>
        </tr>

        </thead>
        <tbody>
        ";
       $color='#070707';      
        $totecom=0;
        $totedev=0;
        $totetra=0;
        $toteaju=0;
        $totssur=0;
        $totsdev=0;
        $totstra=0;
        $totsaju=0;
        $totinv_f=0;
        $color='blue';
         $color1='green';   
         foreach($q->result() as $r)
        {
       
   
        
        
		$num=$num+1;
         
            $tabla.="
            <tr>
           <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->clave."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->susa1."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->lote."</font></td>
            <td align=\"center\"><font size=\"-1\" color=\"$color\">".$r->caducidad."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->cantidad,0)."</font></td>
           </tr>
            ";
        
        }
         $tabla.="
        </tbody>
        <tfoot>
        
            </tfoot>
        </table>";
        
        return $tabla;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////















































































































    function busca_orden_compra($orden)
    {
$fecha = date('Y-m-d');
$nuevafecha = strtotime ( '-15 day' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );

   	$sql = "SELECT count(*) as cuenta from almacen.compraped  
        where folprv= ? and tipo='alm' and tipo3='C' and fece>='$nuevafecha'";
        $query = $this->db->query($sql,array($orden));
        $row = $query->row();
      
        return $row->cuenta;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    function busca_orden_claves($orden)
    {
   	$sql = "SELECT * from almacen.compraped  
        where 
		folprv= ? and tipo='alm' and tipo3='C' and cans >= aplica
		or
		folprv= ? and tipo='alm' and tipo3='C' and metrom >= aplica
		";
        $query = $this->db->query($sql,array($orden,$orden));
        //echo $this->db->last_query();
        return $query;
    }
    

//tipo, fecha, orden, prv, id_user, id, fechai, fac, cxp
     function agrega_member_ctl($orden,$fac)
     {
         $id_user= $this->session->userdata('id');
         $new_member_insert_data = array(
            'tipo'  =>'A',
            'fac'   =>$fac,
            'orden' =>$orden,
            'prv' =>0,
            'fecha' =>date('Y-m-d'),
            'id_user'=>$id_user
		);
		$insert = $this->db->insert('desarrollo.compra_c', $new_member_insert_data);
        $id_cc= $this->db->insert_id();
        return $id_cc;
     }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function busca_folio($fol)
    {
        $sql = "SELECT a.* FROM desarrollo.compra_c a where a.id= ?";
        $query = $this->db->query($sql,array($fol));
         return $query;  
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function detalle_cap($id_cc)
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        

        $tabla= "
        <table cellpadding=\"4\">
        <thead>
        
        <tr>
        
        <th>SEC.</th>
        <th>SUSANCIA ACTIVA</th>
        <th>LOTE</th>
        <th>CADUCIDAD</th>
        <th>PIEZAS</th>
        <th>REGALO</th>
        <th>BORRAR</th>
        
        
        </tr>

        </thead>
        <tbody>
        ";
   $color='#070707';      
   $totcan=0;
        $s = "SELECT a.*,b.susa1 FROM desarrollo.compra_d a
        left join catalogo.sec_unica b on b.sec=a.sec
         where a.id_cc=$id_cc and b.sec<2000  order by a.sec";
         
         //echo $s;
         
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
          $l1 = anchor('a_compra/borra_detalle/'.$r->id.'/'.$id_cc, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar !', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->susa1."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->lote."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->cadu."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->can,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->canr,0)."</font></td>
             <td align=\"left\"><font size=\"-1\" color=\"$color\">$l1</font></td>
          	
            </tr>
            ";
        $totcan=$totcan+$r->can;
         
        }
              $tabla.="
        </tbody>
        </tr>
        <td align=\"right\"  colspan=\"4\"><font size=\"+1\" color=\"$color\">TOTAL</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totcan,0)."</font></td>
        <tr>  	
         </table>";
          return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//id_cc, sec, lote, cadu, can, inv, id
     function insert_member_detalle($orden,$cod,$can,$canr,$lote,$cadu,$id_cc)
     {
       $se = "SELECT * FROM catalogo.almacen where codigo=$cod ";
        $qe = $this->db->query($se);  
        if($qe->num_rows() >0){
         $re= $qe->row();   
         $sec=$re->sec;
            
        $s = "SELECT * FROM almacen.compraped where folprv=$orden and sec=$sec and  cans>0 and tipo='alm' ";
        $q = $this->db->query($s);  
        if($q->num_rows() >0){ 
            $r= $q->row();
            $solicita=$r->cans-$r->aplica+22200;
        $sx = "SELECT sec,sum(can)can FROM desarrollo.compra_d where id_cc = $id_cc and sec=$sec group by sec ";
        $qx = $this->db->query($sx);  
        if($qx->num_rows() >0){$rx= $qx->row();$final=$solicita-$rx->can-$can;}else{$final=$solicita-$can;}
       
         $sql = "SELECT * FROM desarrollo.compra_d where id_cc = ? and lote= ? and sec=? ";
        $query = $this->db->query($sql,array($id_cc,$lote,$sec));
        if($query->num_rows() == 0 and $final > 0){
        
         $new_member_insert_data = array(
			'orden' =>$orden,
            'sec'   =>$sec,
            'id_cc' =>$id_cc,
            'lote'  =>$lote,
            'cadu'  =>$cadu,
            'can'   =>$can,
            'canr'  =>$canr,
            'inv'   =>'N'
		);
		$insert = $this->db->insert('desarrollo.compra_d', $new_member_insert_data);
        }}}
        
        //echo $this->db->last_query();
     }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     function delete_member_detalle($id)
     {
         $sql = "SELECT * FROM desarrollo.compra_d where id = ? and inv='N' or id = ? and inv='M'";
        $query = $this->db->query($sql,array($id,$id));
        if($query->num_rows() == 1){
         $this->db->delete('desarrollo.compra_d', array('id' => $id));
	    }
     }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     function delete_member_ctl($id_cc)
     {
         $sql = "SELECT * FROM desarrollo.compra_d where id_cc = ?";
        $query = $this->db->query($sql,array($id));
        if($query->num_rows() == 0){
         $dataf = array(
        'tipo'     => 'X',
        'fechai'=> date('Y-m-d H:i')
        );
        $this->db->where('id', $id_cc);
        $this->db->update('desarrollo.compra_c', $dataf);
	    }
     }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function cerrar_member_compra($id_cc)
    {
        $id_user= $this->session->userdata('id');
        $s = "SELECT *from desarrollo.compra_c where id=$id_cc and tipo='A' ";
        $q = $this->db->query($s);
if($q->num_rows() >0){
//++++++++++++++++++++++++++++//++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/inv        
        $sql = "SELECT *from desarrollo.compra_d where id_cc=$id_cc and inv='N'";
        $query = $this->db->query($sql);
        
if($query->num_rows() >0){  
        foreach($query->result() as $row)
        {
         $can=$row->can+$row->canr;
         $sec=$row->sec;
         $lote=$row->lote;
         $cadu=$row->cadu;
         $orden=$row->orden;
         $this->__inv1($sec,$can,$id_cc,$lote,$cadu);
         
        $data = array(
        'inv'     => 'S',
        'fechai'=> date('Y-m-d H:i')
        );
        $this->db->where('id_cc', $id_cc);
        $this->db->update('desarrollo.compra_d', $data);
        
        
        $sm = "SELECT *from almacen.compraped where tipo='alm' and folprv=$orden and cans>0 and sec=$sec";
        $qm = $this->db->query($sm);
        if($qm->num_rows() >0){ 
            $rm= $qm->row();
            $tiene=$rm->aplica;
            $prv=$rm->prv;
        $datax = array(
        'aplica'     => $tiene+$row->can
        );
        $this->db->where('tipo', 'alm');
        $this->db->where('folprv', $orden);
        $this->db->where('sec', $sec);
        $this->db->where('cans', 0);
        $this->db->update('almacen.compraped', $datax);
        }
        }
        
  }
  
//++++++++++++++++++++++++++++//++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/inv        
$scxp = "SELECT *from catalogo.foliador1 where clav='cxp' ";
        $qcxp = $this->db->query($scxp);
        if($qcxp->num_rows() >0){
        $rcxp= $qcxp->row();
        $folcxp=$rcxp->num;
        
        $dataf = array(
        'tipo'     => 'C',
        'prv'     => $prv,
        'cxp'     => $folcxp,
        'fechai'=> date('Y-m-d H:i')
        );
        $this->db->where('id', $id_cc);
        $this->db->update('desarrollo.compra_c', $dataf);
        
        $datacxp = array(
        'num'     => $folcxp+1
        );
        $this->db->where('clav', 'cxp');
        $this->db->update('catalogo.foliador1', $datacxp);  
        
        
        }



}        
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function __inv1($sec,$can,$id_cc,$lote,$cadu)
{
   $id_user= $this->session->userdata('id');
   $sx = "SELECT * FROM inv_cedis where sec=$sec and lote='$lote'";
            $qx = $this->db->query($sx);
            if($qx->num_rows() >0){ 
            $rx= $qx->row();
            $exi=$rx->inv1;
            $invi=$rx->inv1;
            $id_inv=$rx->id;
                    $des=$exi+$can;
                    $datax1 = array(
                    'inv1'     => $des
                    );
                    $this->db->where('id', $id_inv);
                    $this->db->update('desarrollo.inv_cedis', $datax1);
}else{
$invi=0;
                    $datax4 = array(
            		'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'inv1'  =>$can,
            		'inv2'	=>0,
            		'fechai'=>date('Ymd')
                    );
                    $this->db->insert('desarrollo.inv_cedis', $datax4);  
}
$this->__inv_dia($sec,$can,$lote,$cadu,$invi);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ///-----------------------------------------------------------inventario por dia en movimientos
        function __inv_dia($sec,$can,$lote,$cadu,$invi)
{
$fecc=date('Y-m-d');    
$sd = "SELECT * FROM desarrollo.inv_cedis_dia a where fecha='$fecc' and sec=$sec and lote='$lote'";
        $qd = $this->db->query($sd);    
if($qd->num_rows() == 0){ 
            $rd= $qd->row();
            $exi=$rd->ecom;
            $id_inv_dia=$rd->id;
           $datad = array(
            		'invi' =>$invi,
                    'fecha' =>$fecc,
                    'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'ecom'  =>$can,
                    );
                    $this->db->insert('desarrollo.inv_cedis_dia', $datad);  
            
}else{
                    $datad1 = array(
                    'ecom' => $exi+$can
                    );
                    $this->db->where('id', $id_inv_dia);
                    $this->db->update('desarrollo.inv_cedis_dia', $datad1);
    
}
}
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_his()
    {
        
              
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        $s = "SELECT a.*,b.razo
        FROM desarrollo.compra_c a
        left join catalogo.provedor b on b.prov=a.prv 
        where a.tipo='C' order by a.fecha";
        $q = $this->db->query($s);
 

        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th colspan=\"7\">FACTURAS RECIBIDAS</th>
        </tr>
        <tr>
        <th>ORDEN</th>
        <th>PRV</th>
        <th>PROVEEDOR</th>
        <th>FACTURA</th>
        <th>FECHA</th>
        <th>FOLIO</th>
        <th>IMPRIME</th>
        
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
         foreach($q->result() as $r)
        {
        
       $l1 = anchor('a_compra/imprime_compra/'.$r->id, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado'));
           
            $tabla.="
            <tr>
            
            <td align=\"left\">".$r->orden."</td>
            <td align=\"left\">".$r->prv."</td>
            <td align=\"left\">".$r->razo."</td>
            <td align=\"right\">".$r->fac."</td>
            <td align=\"right\">".$r->fecha."</td>
            <td align=\"right\">".$r->id."</td>
            <td align=\"right\">".$l1."</td>
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
   
    function control_patente()
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        $s = "SELECT a.* FROM desarrollo.compra_c a  where a.tipo='A' and cia=1 order by a.id";
        $q = $this->db->query($s);
 

        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th colspan=\"5\">RECIBA DE CERRAR MEDICAMENTOS</th>
        </tr>
        <tr>
        <th>ORDEN</th>
        <th>FACTURA</th>
        <th>FECHA</th>
        <th>FOLIO</th>
         <th>DETALLE</th>
          <th>BORRAR</th>
        
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
         foreach($q->result() as $r)
        {
       
       $l1 = anchor('a_compra/tabla_detalle_patente/'.$r->id, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar detalle !', 'class' => 'encabezado'));
       $l2 = anchor('a_compra/borrar_compra_ctl_patente/'.$r->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar !', 'class' => 'encabezado'));
           
            $tabla.="
            <tr>
            
            <td align=\"left\">".$r->orden."</td>
            <td align=\"left\">".$r->fac."</td>
            <td align=\"right\">".$r->fecha."</td>
            <td align=\"right\">".$r->id."</td>
            <td align=\"right\">".$l1."</td>
            <td align=\"right\">".$l2."</td>
            </tr>
            ";
         
        }
         $tabla.="
        </tbody>
        
        </table>";
        
        return $tabla;
    
    }


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
     function agrega_member_ctl_patente($fac,$prv)
     {
        
         $id_user= $this->session->userdata('id');
         $new_member_insert_data = array(
            'tipo'  =>'A',
            'fac'   =>$fac,
            'orden' =>0,
            'orden' =>0,
            'cia'=>1,
            'prv'=>$prv,
            'fecha' =>date('Y-m-d'),
            'id_user'=>$id_user
		);
		$insert = $this->db->insert('desarrollo.compra_c', $new_member_insert_data);
        $id_cc= $this->db->insert_id();
        return $id_cc;
     }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//id_cc, sec, lote, cadu, can, inv, id
     function insert_member_detalle_patente($sec,$can,$canr,$lote,$cadu,$id_cc,$cod,$pub)
     {
       
        
         $sql = "SELECT * FROM desarrollo.compra_d where id_cc = ? and lote= ? and sec=? ";
        $query = $this->db->query($sql,array($id_cc,$lote,$sec));
        if($query->num_rows() == 0){
        
         $new_member_insert_data = array(
			'orden' =>0,
            'sec'   =>$sec,
            'id_cc' =>$id_cc,
            'lote'  =>$lote,
            'cadu'  =>$cadu,
            'can'   =>$can,
            'canr'  =>$canr,
            'codigo'  =>$cod,
            'pub'  =>$pub,
            'inv'   =>'M'
		);
		$insert = $this->db->insert('desarrollo.compra_d', $new_member_insert_data);
        }
        
        
     }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function cerrar_member_compra_patente($id_cc)
    {
        $id_user= $this->session->userdata('id');
        $s = "SELECT *from desarrollo.compra_c where id=$id_cc and tipo='A' ";
        $q = $this->db->query($s);
if($q->num_rows() >0){
$r= $q->row();
$prv=$r->prv;
//++++++++++++++++++++++++++++//++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/inv        
        $sql = "SELECT *from desarrollo.compra_d where id_cc=$id_cc and inv='N'";
        $query = $this->db->query($sql);
        
if($query->num_rows() >0){  
        foreach($query->result() as $row)
        {
         $can=$row->can+$row->canr;
         $sec=$row->sec;
         $lote=$row->lote;
         $cadu=$row->cadu;
         $orden=$row->orden;
         $this->__inv1($sec,$can,$id_cc,$lote,$cadu);
         
        $data = array(
        'inv'     => 'S',
        'fechai'=> date('Y-m-d H:i')
        );
        $this->db->where('id_cc', $id_cc);
        $this->db->update('desarrollo.compra_d', $data);
        
        }
        
  }
//++++++++++++++++++++++++++++//++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/inv        
$scxp = "SELECT *from catalogo.foliador1 where clav='cxp' ";
        $qcxp = $this->db->query($scxp);
        if($qcxp->num_rows() >0){
        $rcxp= $qcxp->row();
        $folcxp=$rcxp->num;
        
        $dataf = array(
        'tipo'     => 'C',
        'prv'     => $prv,
        'cxp'     => $folcxp,
        'fechai'=> date('Y-m-d H:i')
        );
        $this->db->where('id', $id_cc);
        $this->db->update('desarrollo.compra_c', $dataf);
        
        $datacxp = array(
        'num'     => $folcxp+1
        );
        $this->db->where('clav', 'cxp');
        $this->db->update('catalogo.foliador1', $datacxp);  
        
        
        }



}        
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function detalle_cap_patente($id_cc)
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        

        $tabla= "
        <table cellpadding=\"4\">
        <thead>
        
        <tr>
        
        <th>SEC.</th>
        <th>CODIGO</th>
        <th>SUSANCIA ACTIVA</th>
        <th>LOTE</th>
        <th>CADUCIDAD</th>
        <th>PIEZAS</th>
        <th>REGALO</th>
        <th>PUBLICO</th>
        <th>BORRAR</th>
        
        
        </tr>

        </thead>
        <tbody>
        ";
   $color='#070707';      
   $totcan=0;
        $s = "SELECT a.*,b.susa1 FROM desarrollo.compra_d a
        left join catalogo.almacen b on b.sec=a.sec
         where a.id_cc=$id_cc  group by sec order by a.sec";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
          $l1 = anchor('a_compra/borra_detalle_patente/'.$r->id.'/'.$id_cc, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar !', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".$r->sec."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".$r->codigo."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->susa1."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->lote."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->cadu."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->can,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->canr,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->pub,2)."</font></td>
             <td align=\"left\"><font size=\"-1\" color=\"$color\">$l1</font></td>
            </tr>
            ";
        $totcan=$totcan+$r->can;
         
        }
              $tabla.="
        </tbody>
        </tr>
        <td align=\"right\"  colspan=\"4\"><font size=\"+1\" color=\"$color\">TOTAL</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totcan,0)."</font></td>
        <tr>  	
         </table>";
          return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////














}