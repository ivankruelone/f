<?php
class A_traspaso_model extends CI_Model
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
        $s = "SELECT a.*,b.nombre as sucx FROM desarrollo.traspaso_c a left join catalogo.sucursal b on b.suc=a.suc where a.tipo2='A' order by a.id";
        $q = $this->db->query($s);
 

        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th colspan=\"5\">TRASPASOS PENDIENTES DE CERRAR</th>
        </tr>
        <tr>
        <th>SUCURSAL</th>
        <th>TRANSMITIO</th>
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
       $l1 = anchor('a_traspaso/tabla_detalle/'.$r->id, '<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar detalle !', 'class' => 'encabezado'));
       $l2 = anchor('a_traspaso/borrar_traspaso_ctl/'.$r->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar !', 'class' => 'encabezado'));
           
            $tabla.="
            <tr>
            
            <td align=\"left\">".$sucursal."</td>
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
//tipo, suc, fecha, tipo2, id_user, id
     function agrega_member_ctl($suc,$tipo)
     {
         $id_user= $this->session->userdata('id');
         $new_member_insert_data = array(
			'suc'   =>$suc,
            'tipo'  =>$tipo,
            'tipo2'  =>'A',
            'fecha' =>date('Y-m-d'),
            'id_user'=>$id_user
		);
		$insert = $this->db->insert('desarrollo.traspaso_c', $new_member_insert_data);
        $id_cc= $this->db->insert_id();
        return $id_cc;
     }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function busca_folio($fol)
    {
        $sql = "SELECT a.* FROM desarrollo.traspaso_c a where a.id= ?";
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
        $s = "SELECT a.*,b.susa1 FROM desarrollo.traspaso_d a
        left join catalogo.sec_unica b on b.sec=a.sec
         where a.id_cc=$fol  order by a.sec";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
          $l1 = anchor('a_traspaso/borra_detalle/'.$r->id.'/'.$fol, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar !', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".$r->sec."</font></td>
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
     function insert_member_detalle($fol,$sec,$can,$lote,$cadu,$tipo)
     {
        if($tipo=='S'){
        $sx = "SELECT * FROM desarrollo.inv_cedis where sec = ? and lote= ? and inv1>0 ";
        $qx = $this->db->query($sx,array($sec,$lote));
        if($qx->num_rows() == 1){
         $rx= $qx->row();
            $cadu=$rx->cadu;
         }}
            
         $sql = "SELECT * FROM desarrollo.traspaso_d where id_cc = ? and lote= ? ";
        $query = $this->db->query($sql,array($fol,$lote));
        if($query->num_rows() == 0){
         $id_user= $this->session->userdata('id');
         $new_member_insert_data = array(
			'id_cc' =>$fol,
            'sec'   =>$sec,
            'lote'  =>$lote,
            'cadu'  =>$cadu,
            'can'  =>$can,
            'inv'   =>'N'
		);
		$insert = $this->db->insert('desarrollo.traspaso_d', $new_member_insert_data);
        $id_cc= $this->db->insert_id();
        return $id_cc;
        }
     }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     function delete_member_detalle($id)
     {
         $sql = "SELECT * FROM desarrollo.traspaso_d where id = ? and inv='N'";
        $query = $this->db->query($sql,array($id));
        if($query->num_rows() == 1){
         $this->db->delete('desarrollo.traspaso_d', array('id' => $id));
	    }
     }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     function delete_member_ctl($id_cc)
     {
         $sql = "SELECT * FROM desarrollo.traspaso_d where id_cc = ?";
        $query = $this->db->query($sql,array($id));
        if($query->num_rows() == 0){
         $this->db->delete('desarrollo.traspaso_d', array('id_cc' => $id_cc));
          $this->db->delete('desarrollo.traspaso_c', array('id' => $id_cc));
	    }
     }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function cerrar_member_traspaso($fol,$tipo)
    {
        $id_user= $this->session->userdata('id');
        $s = "SELECT *from desarrollo.traspaso_c where id=$fol and tipo2='A' ";
        $q = $this->db->query($s);
if($q->num_rows() >0){
//++++++++++++++++++++++++++++//++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/inv        
        $sql = "SELECT *from desarrollo.traspaso_d where id_cc=$fol and inv='N'";
        $query = $this->db->query($sql);
        
if($query->num_rows() >0){  
        foreach($query->result() as $row)
        {
         $can=$row->can;
         $sec=$row->sec;
         $lote=$row->lote;
         $cadu=$row->cadu;
         if($tipo=='E'){
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
        $this->db->update('desarrollo.traspaso_d', $data);
        }
        
  }
//++++++++++++++++++++++++++++//++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/++++++++++++++++++++++++++++/inv        

        $dataf = array(
        'tipo2'     => 'C',
        'fechai'=> date('Y-m-d H:i')
        );
        $this->db->where('id', $fol);
        $this->db->update('desarrollo.traspaso_c', $dataf);

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
            $exi=$rd->stra;
            $id_inv_dia=$rd->id;
           $datad = array(
                    'invi'  =>$invi,
            		'fecha' =>$fecc,
                    'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'stra'  =>$can,
                    );
                    $this->db->insert('desarrollo.inv_cedis_dia', $datad);  
            
}else{
                    $datad1 = array(
                    'stra'     => $exi+$can
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
            $exi=$rd->etra;
            $id_inv_dia=$rd->id;
           $datad = array(
                    'invi'  =>$invi,
            		'fecha' =>$fecc,
                    'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'etra'  =>$can,
                    );
                    $this->db->insert('desarrollo.inv_cedis_dia', $datad);  
            
}else{
                    $datad1 = array(
                    'etra'     => $exi+$can
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
        $s = "SELECT a.*,b.nombre as sucx FROM desarrollo.traspaso_c a left join catalogo.sucursal b on b.suc=a.suc where a.tipo2='C' order by a.id";
        $q = $this->db->query($s);
 

        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th colspan=\"5\">TRASPASOS PENDIENTES DE CERRAR</th>
        </tr>
        <tr>
        <th>SUCURSAL</th>
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
       $l1 = anchor('a_traspaso/imprime_traspaso/'.$r->id.'/'.$r->suc.'/'.$r->tipo, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado'));
           
            $tabla.="
            <tr>
            
            <td align=\"left\">".$sucursal."</td>
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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////

   function busca_pedidos($fec)
    {
     $sql = "SELECT  * FROM  pedidos where date_format(fechas,'%Y-%m-%d')= ?";
    $query = $this->db->query($sql,array($fec));
    return $query; 
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function imprime_rem($fol)
    {
     $e='';

       $s = "select *from pedidos where fol=$fol and tipo=1 and sur>0 order by mue, sec";
       $q = $this->db->query($s);
       $e.="<table  border=\"1\" cellpadding=\"4\">
          ";
        $totped=0;
        $totsur=0;
        $totiva=0;
        $totimp=0;
        
        $imp=0;
        $iva=0;
         foreach($q->result() as $r)
         {
         $lin=$r->lin;   
         $imp=$r->vta*$r->sur;    
          $sx = "select *from catalogo.almacen where sec=$r->sec and tsec='G'";
          $qx = $this->db->query($sx);   
          if($qx->num_rows() > 0){
            $rx=$qx->row();
            $des=$rx->susa2;
            }else{
            $des='';    
            }
            if($lin==5 and $imp>0){$iva=$imp-($imp/($r->iva+1));}else{$iva=0;}
       $e.="
            <tr>
            <td width=\"40\" align=\"center\">".$r->mue."</td>
            <td width=\"40\" align=\"left\">".$r->sec."</td>
            <td width=\"150\" align=\"left\">".$r->susa."</td>
            <td width=\"150\" align=\"left\">".$des."</td>
            <td width=\"50\" align=\"right\">".number_format($r->ped,0)."</td>
            <td width=\"50\" align=\"right\">".number_format($r->sur,0)."</td>
            <td width=\"70\" align=\"right\">".number_format($r->vta,2)."</td>
            <td width=\"70\" align=\"right\">".number_format($iva,2)."</td>
            <td width=\"70\" align=\"right\">".number_format($imp,2)."</td>
            </tr>
            ";   
            
        $totped=$totped+$r->ped;
        $totsur=$totsur+$r->sur;
        $totiva=$totiva+$iva;
        $totimp=$totimp+$imp; 
        }
        
       $e.="
        <tr bgcolor=\"#E6E6E6\"><br />
        <td width=\"380\" align=\"right\"><strong>TOTAL</strong></td>
        <td width=\"50\" align=\"right\"><strong>".number_format($totped,0)."</strong></td>
        <td width=\"50\" align=\"right\"><strong>".number_format($totsur,0)."</strong></td>
        <td width=\"140\" align=\"right\"><strong>".number_format($totiva,2)."</strong></td>
        <td width=\"70\" align=\"right\"><strong>".number_format($totimp,2)."</strong></td>
        </tr>
        </table>";
    return $e; 
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function imprime_rem_negados($fol)
    {
$f='';
       $s1 = "select *from pedidos where fol=$fol and tipo=1 and sur=0 and tipo=1 and ped>0 order by mue, sec";
       $q1 = $this->db->query($s1);
       $f.="<table  border=\"1\" cellpadding=\"4\">
                 <tr>
                 <td  width=\"640\" align=\"center\"><strong>PRODUCTOS NEGADOS</strong></td>
                 </tr>
            <tr>
            <th width=\"40\" align=\"center\"><strong>MUE</strong></th>
            <th width=\"40\" align=\"left\"><strong>SEC</strong></th>
            <th width=\"250\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
            <th width=\"250\" align=\"left\"><strong>DESCRIPCION</strong></th>
            <th width=\"60\" align=\"right\"><strong>PIEZAS</strong></th>
            </tr>

          ";
        $totped=0;
         foreach($q1->result() as $r1)
         {
        
          $sx = "select *from catalogo.almacen where sec=$r1->sec and tsec='G'";
          $qx = $this->db->query($sx);   
          if($qx->num_rows() > 0){
            $rx=$qx->row();
            $des=$rx->susa2;
            }else{
            $des='';    
            }
       $f.="
            <tr>
            <td width=\"40\" align=\"center\">".$r1->mue."</td>
            <td width=\"40\" align=\"left\">".$r1->sec."</td>
            <td width=\"250\" align=\"left\">".$r1->susa."</td>
            <td width=\"250\" align=\"left\">".$des."</td>
            <td width=\"60\" align=\"right\">".number_format($r1->ped,0)."</td>
            </tr>
            ";   
            
        $totped=$totped+$r1->ped;
        
        }
        
       $f.="
        <tr bgcolor=\"#E6E6E6\"><br />
        <td width=\"580\" align=\"right\"><strong>TOTAL DE PIEZAS NEGADAS</strong></td>
        <td width=\"60\" align=\"right\"><strong>".number_format($totped,0)."</strong></td>
        </tr>
        </table>";
    return $f; 
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function reporte_diario_encabezado($fecha1, $fecha2)
    {
        $tabla = "
        <table>
        <tr>
        <td>CENTRO DE DISTRIBUCION DE FARMACIAS EL FENIX</td>
        <td>REPORTE DE TRASPASO DEL DIA $fecha1 AL $fecha2</td>
        </tr>
        <tr>
        <td colspan=\"2\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_diario($fecha1, $fecha2)
    {
        $this->db->select('t.sec, a.susa1, a.susa2, t.lote, t.cadu, t.fechai, p.nombre, sum(can) as can, c.tipo, s.nombre as sucursal');
        $this->db->from('desarrollo.traspaso_d t');
        $this->db->join('desarrollo.traspaso_c c', 'c.fechai=t.fechai', 'LEFT');
        $this->db->join('catalogo.almacen a', 'a.sec=t.sec', 'LEFT');
        $this->db->join('desarrollo.usuarios p', 'p.id=c.id_user', 'LEFT');
        $this->db->join('catalogo.sucursal s', 's.suc=c.suc', 'LEFT');
        $this->db->where("date(t.fechai) between '$fecha1' and '$fecha2'", '', false);
        $this->db->group_by('lote');
        $this->db->group_by('sec');
        $this->db->order_by('sec');
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();

        $tabla = "
        <h1>TRASPASO</h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th width=\"5%\">#</th>
        <th width=\"10%\">FECHA</th>
        <th width=\"8%\">SECUENCIA</th>
        <th width=\"30%\">DESCRIPCION</th>
        <th width=\"8%\">LOTE</th>
        <th width=\"8%\">CADUCIDAD</th>
        <th width=\"9%\">USUARIO</th>
        <th width=\"7%\">CANTIDAD</th>
        <th width=\"5%\">TIPO</th>
        <th width=\"10%\">SUCURSAL</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $n = 1;
        $can = 0;
        
        foreach($query->result() as $row)
       
       {
        
            $tabla.="
            <tr>
            <td align=\"left\" width=\"5%\">".$n."</td>
            <td align=\"left\" width=\"10%\">".$row->fechai."</td>
            <td align=\"center\" width=\"8%\">".$row->sec."</td>
            <td align=\"left\" width=\"30%\">".$row->susa1."<br/>".$row->susa2."</td>
            <td align=\"left\" width=\"8%\">".$row->lote."</td>
            <td align=\"left\" width=\"8%\">".$row->cadu."</td>
            <td align=\"left\" width=\"9%\">".$row->nombre."</td>
            <td align=\"right\" width=\"7%\">".number_format($row->can,0)."</td>
            <td align=\"left\" width=\"5%\">".$row->tipo."</td>
            <td align=\"left\" width=\"10%\">".$row->sucursal."</td>
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
}