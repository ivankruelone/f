<?php
class A_devolucion_model extends CI_Model
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
 ////////////////////////////////////////////////////////////////////////////////////////
    function control()
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        $s = "SELECT a.*,b.nombre as sucx FROM desarrollo.devolucion_c a left join catalogo.sucursal b on b.suc=a.suc where a.tipo2='A' order by a.id";
        $q = $this->db->query($s);
 

        $tabla= "
        <table cellpadding=\"1\">
        <thead>
        
        <tr>
        <th colspan=\"6\">DEVOLUCION PENDIENTES DE CERRAR</th>
        </tr>
        <tr>
        <th>SUCURSAL</th>
        <th>FECHA</th>
        <th>RRM</th>
        <th>FOLIO</th>
         <th>DETALLE</th>
          <th>BORRAR</th>
        
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
         foreach($q->result() as $r)
        {
        $tipo=$r->tipo;
        if($tipo=='E'){
                    $sucursal='ENTRA MERCANCIA AL ALMACEN CEDIS Y SA LE DE'.$r->sucx;    
        }elseif($tipo=='S'){
                    $sucursal='SALE MERCANCIA AL ALMACEN CEDIS Y ENTRA EN '.$r->sucx;    
        }
       $l0 = anchor('a_devolucion/modificar_ctl/'.$r->id.'/'.$r->rrm, $r->id, array('title' => 'Haz Click aqui para modificar RRM !', 'class' => 'encabezado'));
       $l1 = anchor('a_devolucion/tabla_detalle/'.$r->id, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar detalle !', 'class' => 'encabezado'));
       $l2 = anchor('a_devolucion/borrar_devolucion_ctl/'.$r->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar !', 'class' => 'encabezado'));
           
            $tabla.="
            <tr>
            
            <td align=\"left\">".$sucursal."</td>
            <td align=\"right\">".$r->fecha."</td>
            <td align=\"right\">".$r->rrm."</td>
            <td align=\"right\">".$l0."</td>
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
//tipo, suc, fecha, tipo2, id_user, id
     function agrega_member_ctl($suc,$tipo,$mov,$rrm)
     {
         $id_user= $this->session->userdata('id');
         $new_member_insert_data = array(
			'suc'   =>$suc,
            'tipo'  =>$tipo,
            'mov'  =>$mov,
            'tipo2'  =>'A',
            'rrm'  =>$rrm,
            'fecha' =>date('Y-m-d'),
            'id_user'=>$id_user
		);
		$insert = $this->db->insert('desarrollo.devolucion_c', $new_member_insert_data);
        $id_cc= $this->db->insert_id();
        return $id_cc;
     }
     
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//tipo, suc, fecha, tipo2, id_user, id
     function cambia_member_ctl($fol,$rrm)
     {
         $id_user= $this->session->userdata('id');
         $newx = array('rrm'  =>$rrm);
		$this->db->where('id', $fol);
        $this->db->update('desarrollo.devolucion_c', $newx);  
     }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function busca_folio($fol)
    {
        $sql = "SELECT a.* FROM desarrollo.devolucion_c a where a.id= ?";
        $query = $this->db->query($sql,array($fol));
         return $query;  
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function detalle_cap($fol)
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
        <th>BORRAR</th>
        
        
        </tr>

        </thead>
        <tbody>
        ";
   $color='#070707';      
   $totcan=0;
        $s = "SELECT a.*,b.susa1 FROM desarrollo.devolucion_d a
        left join catalogo.sec_unica b on b.sec=a.sec
         where a.id_cc=$fol  order by a.sec";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
          $l1 = anchor('a_devolucion/borra_detalle/'.$r->id.'/'.$fol, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar !', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".$r->sec."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".$r->codigo."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->susa1."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->lote."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->cadu."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->can,0)."</font></td>
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
     function insert_member_detalle($fol,$cod,$can,$lote,$cadu,$tipo)
     {
if($tipo=='S'){
          $se = "SELECT a.sec,b.lote, b.cadu,b.inv1
FROM catalogo.almacen a
left join desarrollo.inv_cedis b on b.sec=a.sec
 where a.codigo=$cod and b.inv1>0 ";
        $qe = $this->db->query($se);
}else{
          $se = "SELECT *FROM catalogo.almacen a where a.codigo=$cod ";
          $qe = $this->db->query($se);
}   
        if($qe->num_rows() >0){
         $re= $qe->row();
if($tipo=='S'){
$cadu=$re->cadu;    
}   
         $sec=$re->sec;
         
         
         $sql = "SELECT * FROM desarrollo.devolucion_d where id_cc = ? and lote= ? and sec = ?";
        $query = $this->db->query($sql,array($fol,$lote,$sec));
        if($query->num_rows() == 0){
         $id_user= $this->session->userdata('id');
         $new_member_insert_data = array(
			'id_cc' =>$fol,
            'codigo'=>$cod,
            'sec'   =>$sec,
            'lote'  =>$lote,
            'cadu'  =>$cadu,
            'can'  =>$can,
            'inv'   =>'N'
		);
		$insert = $this->db->insert('desarrollo.devolucion_d', $new_member_insert_data);
        $id_cc= $this->db->insert_id();
        return $id_cc;
        }else{
         $row= $query->row();
         $exi=$row->can;
         $id_d=$row->id;    
        $dataf = array(
        'can'     => $exi+$can,
        'fechai'=> date('Y-m-d H:i')
        );
        $this->db->where('id', $id_d);
        $this->db->update('desarrollo.devolucion_d', $dataf);    
        }
        
        }
     }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     function delete_member_detalle($id)
     {
         $sql = "SELECT * FROM desarrollo.devolucion_d where id = ? and inv='N'";
        $query = $this->db->query($sql,array($id));
        if($query->num_rows() == 1){
         $this->db->delete('desarrollo.devolucion_d', array('id' => $id));
	    }
     }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     function delete_member_ctl($id_cc)
     {
         $sql = "SELECT * FROM desarrollo.devolucion_d where id_cc = ?";
        $query = $this->db->query($sql,array($id));
        if($query->num_rows() == 0){
         $dataf = array(
        'tipo2'     => 'X',
        'fechai'=> date('Y-m-d H:i')
        );
        $this->db->where('id', $id_cc);
        $this->db->update('desarrollo.devolucion_c', $dataf);
	    }
     }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function cerrar_member_devolucion($fol,$tipo,$mov)
    {
        $id_user= $this->session->userdata('id');
        $s = "SELECT *from desarrollo.devolucion_c where id=$fol and tipo2='A' ";
        $q = $this->db->query($s);
if($q->num_rows() >0){
//++++++++++++++++++++++++++++//++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/inv        
        $sql = "SELECT *from desarrollo.devolucion_d where id_cc=$fol and inv='N'";
        $query = $this->db->query($sql);
        
if($query->num_rows() >0){  
        foreach($query->result() as $row)
        {
         $can=$row->can;
         $sec=$row->sec;
         $lote=$row->lote;
         $cadu=$row->cadu;

         if($tipo=='E' and $mov > 0 and $mov < 3 ){
            $var=$this->__inv1($sec,$can,$fol,$lote,$cadu);
            }
         if($tipo=='S'){
            $var=$this->__inv2($sec,$can,$fol,$lote,$cadu);
            }
        $data = array(
        'inv'     => 'S',
        'fechai'=> date('Y-m-d H:i')
        );
        $this->db->where('id_cc', $fol);
        $this->db->update('desarrollo.devolucion_d', $data);
        }
        
  }
//++++++++++++++++++++++++++++//++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/inv        

        $dataf = array(
        'tipo2'     => 'C',
        'fechai'=> date('Y-m-d H:i')
        );
        $this->db->where('id', $fol);
        $this->db->update('desarrollo.devolucion_c', $dataf);

}        
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function __inv1($sec,$can,$fol,$lote,$cadu)
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
           $this->__inv_diae($sec,$can,$lote,$cadu,$invi);
           return $var;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function __inv2($sec,$can,$fol,$lote,$cadu)
{
   $id_user= $this->session->userdata('id');
   $sx = "SELECT * FROM inv_cedis where sec=$sec and lote='$lote'";
            $qx = $this->db->query($sx);
            if($qx->num_rows() >0){ 
            $rx= $qx->row();
            $exi=$rx->inv1;
            $invi=$rx->inv1;
            $id_inv=$rx->id;
                    $des=$exi-$can;
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
            		'inv1'  =>0-$can,
            		'inv2'	=>0,
            		'fechai'=>date('Ymd')
                    );
                    $this->db->insert('desarrollo.inv_cedis', $datax4);  
}
 $this->__inv_dias($sec,$can,$lote,$cadu,$invi);
           return $var;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ///-----------------------------------------------------------inventario por dia en movimientos
function __inv_dias($sec,$can,$lote,$cadu,$invi)
{
$fecc=date('Y-m-d');    
$sd = "SELECT * FROM desarrollo.inv_cedis_dia a where fecha='$fecc' and sec=$sec and lote='$lote'";
        $qd = $this->db->query($sd);    
if($qd->num_rows() == 0){ 
            $rd= $qd->row();
            $exi=$rd->sdev;
            $id_inv_dia=$rd->id;
           $datad = array(
                    'invi' =>$invi,
            		'fecha' =>$fecc,
                    'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'sdev'  =>$can,
                    );
                    $this->db->insert('desarrollo.inv_cedis_dia', $datad);  
            
}else{
                    $datad1 = array(
                    'sdev'     => $exi+$can
                    );
                    $this->db->where('id', $id_inv_dia);
                    $this->db->update('desarrollo.inv_cedis_dia', $datad1);
    
}
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ///-----------------------------------------------------------inventario por dia en movimientos
function __inv_diae($sec,$can,$lote,$cadu,$invi)
{
$fecc=date('Y-m-d');    
$sd = "SELECT * FROM desarrollo.inv_cedis_dia a where fecha='$fecc' and sec=$sec and lote='$lote'";
        $qd = $this->db->query($sd);    
if($qd->num_rows() == 0){ 
            $rd= $qd->row();
            $exi=$rd->edev;
            $id_inv_dia=$rd->id;
           $datad = array(
                    'invi' =>$invi,
            		'fecha' =>$fecc,
                    'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'edev'  =>$can,
                    );
                    $this->db->insert('desarrollo.inv_cedis_dia', $datad);  
            
}else{
                    $datad1 = array(
                    'edev'     => $exi+$can
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
        $s = "SELECT a.*,b.nombre as sucx,c.nom 
        FROM desarrollo.devolucion_c a 
        left join catalogo.sucursal b on b.suc=a.suc
         left join catalogo.devolucion c on c.num=a.mov
        where a.tipo2='C' order by a.id";
        $q = $this->db->query($s);
 

        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th colspan=\"5\">devolucionS PENDIENTES DE CERRAR</th>
        </tr>
        <tr>
        <th>SUCURSAL</th>
        <th>MOVIMIENTO</th>
        <th>FECHA</th>
        <th>FOLIO</th>
        <th>IMPRIME</th>
        
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
  
         foreach($q->result() as $r)
        {
        $tipo=$r->tipo;
        if($tipo=='E'){
                    $sucursal='ENTRA MERCANCIA AL ALMACEN CEDIS Y SA LE DE'.$r->sucx;    
        }elseif($tipo=='S'){
                    $sucursal='SALE MERCANCIA AL ALMACEN CEDIS Y ENTRA EN '.$r->sucx;    
        }
       $l1 = anchor('a_devolucion/imprime_devolucion/'.$r->id.'/'.$r->suc.'/'.$r->tipo.'/'.$r->mov, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado'));
           
            $tabla.="
            <tr>
            
            <td align=\"left\">".$sucursal."</td>
             <td align=\"right\">".$r->nom."</td>
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


function reporte_diario_encabezado($fecha1, $fecha2)
    {
        $tabla = "
        <table>
        <tr>
        <td>CENTRO DE DISTRIBUCION DE FARMACIAS EL FENIX</td>
        <td>REPORTE DE DEVOLUCION DEL DIA $fecha1 AL $fecha2</td>
        </tr>
        <tr>
        <td colspan=\"2\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_diario($fecha1, $fecha2)
    {
        
       $sql="select a.*,b.*,c.nombre,d.nombre as sucursal,e.nom
from devolucion_c a
left join devolucion_d b on b.id_cc=a.id
left join usuarios c on c.id=a.id_user
left join catalogo.sucursal d on d.suc=a.suc
left join catalogo.devolucion e on e.num=a.mov
where a.tipo2='C' and codigo>0 and date_format(a.fecha,'%Y-%m-%d') between '$fecha1' and '$fecha2' 

order by sec";
        $query=$this->db->query($sql);

        
        $tabla = "
        <h1>TRASPASO</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th width=\"3%\">#</th>
        <th width=\"7%\">FECHA</th>
        <th width=\"7%\">SECUENCIA</th>
        <th width=\"28%\">DESCRIPCION</th>
        <th width=\"8%\">LOTE</th>
        <th width=\"8%\">CADUCIDAD</th>
        <th width=\"13%\">USUARIO</th>
        <th width=\"5%\">CAN</th>
        <th width=\"5%\">TIPO</th>
        <th width=\"7%\">MOV</th>
        <th width=\"10%\">SUCURSAL</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $n = 1;
        $can = 0;
        
        foreach($query->result() as $row)
       
       {
        $s="select *from catalogo.almacen where sec>=1 and sec<=2000 and codigo=$row->codigo";
        $q=$this->db->query($s);
        if($q->num_rows()>0){$r=$q->row();$susa=$r->susa1;$descri=$r->susa2;}else{$susa='';$descri='';}
           $tabla.="
            <tr>
            <td align=\"left\" width=\"3%\">".$n."</td>
            <td align=\"left\" width=\"7%\">".$row->fechai."</td>
            <td align=\"center\" width=\"7%\">".$row->sec."</td>
            <td align=\"left\" width=\"28%\">".$susa."<br/>".$descri."</td>
            <td align=\"left\" width=\"8%\">".$row->lote."</td>
            <td align=\"left\" width=\"8%\">".$row->cadu."</td>
            <td align=\"left\" width=\"13%\">".$row->nombre."</td>
            <td align=\"right\" width=\"5%\">".number_format($row->can,0)."</td>
            <td align=\"left\" width=\"5%\">".$row->tipo."</td>
            <td align=\"left\" width=\"7%\">".$row->nom."</td>
            <td align=\"left\" width=\"10%\">".$row->sucursal."<br />".$row->rrm."</td>
            </tr>
            ";
            
            $n++;
            $can = $can + $row->can;
        }
        
       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"7\">TOTALES</td>
        <td align=\"right\">".number_format($can,0)."</td>
        </tr>
        </tfoot>
        </table>";
        return $tabla;
        
    }
//**************************************************************
//**************************************************************
    function reporte_excedente_encabezado($fecha1, $fecha2, $motivox)
    {
        $tabla = "
        <table>
        <tr>
        <td><strong>CENTRO DE DISTRIBUCION DE FARMACIAS EL FENIX</strong></td>
        <td><strong>REPORTE DEL DIA $fecha1 AL $fecha2</strong></td>
        </tr>
        <tr>
        <td colspan=\"2\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_excedente($fecha1, $fecha2, $motivox)
    {
        $this->db->select("t.sec, a.susa1, a.susa2, t.lote, t.cadu, t.fechai, p.nombre, (can) as can, c.tipo, x.nom, s.nombre as sucursal, case
when s.tipo2 = 'D' then a.vtaddr
when s.tipo2 = 'G' then a.vtagen
when s.tipo2 = 'F' then a.publico
end as precio", false);
        $this->db->from('desarrollo.devolucion_d t');
        $this->db->join('desarrollo.devolucion_c c', 'c.fechai=t.fechai', 'LEFT');
        $this->db->join('catalogo.almacen a', 'a.sec=t.sec', 'LEFT');
        $this->db->join('desarrollo.usuarios p', 'p.id=c.id_user', 'LEFT');
        $this->db->join('catalogo.sucursal s', 's.suc=c.suc', 'LEFT');
        $this->db->join('catalogo.devolucion x', 'x.num=c.mov', 'LEFT');
        $this->db->where("date(t.fechai) between '$fecha1' and '$fecha2'", '', false);
        $this->db->where('mov',$motivox);
        $this->db->group_by('lote');
        $this->db->group_by('sec');
        $this->db->order_by('c.suc');
        $this->db->order_by('t.sec');
        $query = $this->db->get();
        
        if($query->num_rows() > 0){
        $r = $query->row();
        $nom=$r->nom;
        
        //echo $this->db->last_query();
        //die();

        $tabla = "
        <h1>".$nom."</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th width=\"3%\"><strong>#</strong></th>
        <th width=\"7%\"><strong>FECHA</strong></th>
        <th width=\"7%\"><strong>SECUENCIA</strong></th>
        <th width=\"20%\"><strong>DESCRIPCION</strong></th>
        <th width=\"8%\"><strong>LOTE</strong></th>
        <th width=\"8%\"><strong>CADUCIDAD</strong></th>
        <th width=\"13%\"><strong>USUARIO</strong></th>
        <th width=\"7%\"><strong>CAN</strong></th>
        <th width=\"3%\"><strong>TIPO</strong></th>
        <th width=\"7%\"><strong>VTA</strong></th>
        <th width=\"7%\"><strong>MOV</strong></th>
        <th width=\"10%\"><strong>SUCURSAL</strong></th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $n = 1;
        $can = 0;
        $tot = 0;
        
        foreach($query->result() as $row)
       
       {
        
            $tabla.="
            <tr>
            <td align=\"left\" width=\"3%\">".$n."</td>
            <td align=\"left\" width=\"7%\">".$row->fechai."</td>
            <td align=\"center\" width=\"7%\">".$row->sec."</td>
            <td align=\"left\" width=\"20%\">".$row->susa1."<br/>".$row->susa2."</td>
            <td align=\"left\" width=\"8%\">".$row->lote."</td>
            <td align=\"left\" width=\"8%\">".$row->cadu."</td>
            <td align=\"left\" width=\"13%\">".$row->nombre."</td>
            <td align=\"right\" width=\"7%\">".number_format($row->can,0)."</td>
            <td align=\"left\" width=\"3%\">".$row->tipo."</td>
            <td align=\"right\" width=\"7%\">".number_format($row->precio*$row->can, 2)."</td>
            <td align=\"left\" width=\"7%\">".$row->nom."</td>
            <td align=\"left\" width=\"10%\">".$row->sucursal."</td>
            </tr>
            ";
            
            $n++;
            $can = $can + $row->can;
            $tot = $tot + $row->can * $row->precio;
        }
        
       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"7\">TOTALES</td>
        <td align=\"right\">".number_format($can,0)."</td>
        <td align=\"right\"></td>
        <td align=\"right\">".number_format($tot,2)."</td>
        </tr>
        </tfoot>
        </table>";
        return $tabla;
        
        }else{
            echo "No hay Resultados que mostrar.";
        }
        
    }
////////////////////////////////////////////////////////////////////////////////////////////////////
function busca_cod($cod)
	{

		$sql = "SELECT a.sec,susa1
FROM catalogo.almacen a
 where a.codigo=$cod and sec>0 and sec<=2000";
         
        $query = $this->db->query($sql);
        
         if($query->num_rows() == 0){
            $tabla = 0;
        }else{
        
        $tabla = "<option value=\"-\">Selecciona un producto</option>";
        
        foreach($query->result() as $row)
        {

            $tabla.="
            <option value =\"".$row->sec."\">".$row->sec." ".$row->susa1."</option>
            ";
        }
        }
        
        return $tabla;
	}
    
    








}
