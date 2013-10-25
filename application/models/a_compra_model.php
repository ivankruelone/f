<?php
class A_compra_model extends CI_Model
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
    function busca_orden_compra($orden)
    {
$fecha = date('Y-m-d');
$nuevafecha = strtotime ( '-15 day' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );

   	$sql = "SELECT count(*) as cuenta from almacen.compraped  
        where folprv= ? and tipo='alm' and tipo3='C' and fece>='$nuevafecha'
        or 
        folprv= ? and tipo='ban' and tipo3='C'
        or 
        folprv= ? and tipo='met' and tipo3='C'";
        $query = $this->db->query($sql,array($orden,$orden,$orden));
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
        or
        folprv= ? and tipo='ban' and tipo3='C' and cans >= aplica
		or
		folprv= ? and tipo='ban' and tipo3='C' and metrom >= aplica
		";
        $query = $this->db->query($sql,array($orden,$orden,$orden,$orden));
        //echo $this->db->last_query();
        return $query;
    }
    
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
    function control()
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        $s = "SELECT a.* FROM desarrollo.compra_c a  where a.tipo='A' and a.cia=13 order by a.id";
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
       
       $l1 = anchor('a_compra/tabla_detalle/'.$r->id, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar detalle !', 'class' => 'encabezado'));
       $l2 = anchor('a_compra/borrar_compra_ctl/'.$r->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar !', 'class' => 'encabezado'));
           
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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
            
        $s = "SELECT * FROM almacen.compraped where 
        folprv=$orden and sec=$sec and  cans>0 and tipo='alm' 
        or
        folprv=$orden and sec=$sec and  cans>0 and tipo='ban'
        ";
        $q = $this->db->query($s);  
        if($q->num_rows() >0){ 
            $r= $q->row();
            $cos=$r->costo;
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
            'codigo'=>$cod,
            'costo' =>$cos,
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
    function cerrar_member_compra($id_cc,$prv)
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
         $codigo=$row->codigo;
         $costo=$row->costo;
         $this->__inv1($sec,$can,$id_cc,$lote,$cadu,$codigo,$costo);
         
        $data = array(
        'inv'     => 'S',
        'fechai'=> date('Y-m-d H:i')
        );
        $this->db->where('id_cc', $id_cc);
        $this->db->update('desarrollo.compra_d', $data);
        
        
        $sm = "SELECT *from almacen.compraped where 
        tipo='alm' and folprv=$orden and cans>0 and sec=$sec
        or
        tipo='ban' and folprv=$orden and cans>0 and sec=$sec
        or
        tipo='met' and folprv=$orden and cans>0 and sec=$sec"
        ;
        $qm = $this->db->query($sm);
        if($qm->num_rows() >0){ 
            $rm= $qm->row();
            $tiene=$rm->aplica;
            $prv=$rm->prv;
        $sg="update  almacen.compraped SET aplica=$tiene+$row->can where folprv=$orden and sec=$sec";
        $this->db->query($sg);
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
function __inv1($sec,$can,$id_cc,$lote,$cadu,$codigo,$costo)
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
                    'inv1'     => $des,
                    'costo'     => $costo,
                    'codigo'   => $codigo
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
                    'codigo'   => $codigo,
                    'costo'   => $costo,
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