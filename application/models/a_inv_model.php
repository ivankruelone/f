<?php
class A_inv_model extends CI_Model
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
   
    function control()
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
        
        
        
        </tr>

        </thead>
        <tbody>
        ";
   $color='#070707';      
   $totcan=0;
        $s = "SELECT a.*,b.susa1 FROM desarrollo.inv_cedis a
        left join catalogo.sec_generica b on b.sec=a.sec
         where a.inv1<>0 and b.sec<2000 order by a.sec,a.cadu,a.lote";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
        if($r->inv1>0){
        $color='#070707';    
        }else{
        $color='#FC0404';       
        }
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->susa1."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->lote."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->cadu."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->inv1,0)."</font></td>
            </tr>
            ";
        $totcan=$totcan+$r->inv1;
         
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

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
    function control_his($fec1,$fec2)
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        
    $je="insert into inv_cedis_dia (fecha, sec, cadu, lote, ecom, etra, edev, eaju, ssur, stra, sdev, saju, invi)
(select date_format(a.fechasur,'%Y-%m-%d'),a.sec,b.cadu,b.lote,0,0,0,0,sum(b.can),0,0,0,0
            from desarrollo.pedidos a
            left join desarrollo.surtido b on b.fol=a.fol and b.sec=a.sec
            left join catalogo.sucursal c on c.suc=a.suc
            WHERE date_format(a.fechasur,'%Y-%m-%d')>='$fec1' and date_format(a.fechasur,'%Y-%m-%d')<='$fec2' and a.sur>0  and b.can>0
            GROUP BY date_format(a.fechasur,'%Y-%m-%d'),a.SEC,b.LOTE
            order by sec)
on duplicate key update ssur=values(ssur)";
$this->db->query($je);
        $tabla= "
        <table cellpadding=\"4\">
        <thead>
        
        <tr>
        
        <th>SEC.</th>
        <th>SUSANCIA ACTIVA</th>
        <th>LOTE  <BR /> CADU</th>
        <th>INV.I</th>
        <th colspan=\"4\">ENTRADAS</th>
        <th colspan=\"4\">SALIDAS</th>
        </tr>
        
        <tr>
        <th colspan=\"4\"></th>
        <th>COM</th>
        <th>DEV</th>
        <th>TRA</th>
        <th>AJU</th>
        <th>SUR</th>
        <th>DEV</th>
        <th>TRA</th>
        <th>AJU</th>
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
        $s = "SELECT a.sec,lote,cadu,invi,
        sum(ecom)as ecom,sum(edev)as edev,sum(etra)as etra,sum(eaju)as eaju,sum(ssur)as ssur,sum(sdev)as sdev,sum(stra)as stra,sum(saju)as saju, 
        b.susa1,b.susa2 FROM desarrollo.inv_cedis_dia a
        left join catalogo.sec_unica b on b.sec=a.sec
         where a.fecha>='$fec1' and a.fecha<='$fec2' and b.sec<2000
         group by a.sec,a.lote order by a.sec,a.cadu,a.lote";
        
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
        $l2 = anchor('a_inv/tabla_folios_fecha/'.$r->sec."/".$fec1."/".$fec2."/".$r->lote, $r->ssur,  array('title' => 'Haz Click aqui para ver el detalle !', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->susa1."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->lote." <BR />".$r->cadu."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->invi,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->ecom,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->edev,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->etra,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->eaju,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".$l2."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->sdev,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->stra,0)."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->saju,0)."</font></td>
            </tr>
            ";
        $totecom=$totecom+$r->ecom;
        $totedev=$totedev+$r->edev;
        $totetra=$totetra+$r->etra;
        $toteaju=$toteaju+$r->eaju;
        $totssur=$totssur+$r->ssur;
        $totsdev=$totsdev+$r->sdev;
        $totstra=$totstra+$r->stra;
        $totsaju=$totsaju+$r->saju;
        
         
        }
              $tabla.="
        </tbody>
        </tr>
        <td align=\"right\"  colspan=\"4\"><font size=\"+1\" color=\"$color\">TOTAL</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totecom,0)."</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totedev,0)."</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totetra,0)."</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($toteaju,0)."</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totssur,0)."</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totsdev,0)."</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totstra,0)."</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totsaju,0)."</font></td>
        
        <tr>  	
         </table>";
          return $tabla;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
    function control_mod()
    {
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
        $tipo= $this->session->userdata('tipo');
        

        $tabla= "
        <table cellpadding=\"4\">
        <thead>
        
        <tr>
        
        <th>SEC.</th>
        <th>SUSANCIA ACTIVA</th>
        <th  align=\"center\">CADU <br />LOTE</th>
        <th>PIEZAS</th>
        </tr>

        </thead>
        <tbody>
        ";
        $color='#070707';      
        $totcan=0;
        $s = "SELECT a.*,b.susa1 FROM desarrollo.inv_cedis a
        left join catalogo.sec_generica b on b.sec=a.sec
         where a.inv1<>0 and b.sec<2000 order by a.sec,a.cadu,a.lote";
        $q = $this->db->query($s);
        foreach($q->result() as $r)
        {
        //= anchor('a_inv/borrar_inv/'.$r->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar !', 'class' => 'encabezado'));
        $l1 = anchor('a_inv/tabla_control_cadu/'.$r->id,'<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para cambiar caducidad !', 'class' => 'encabezado'));
        $l2 = anchor('a_inv/tabla_control_lote/'.$r->id,$r->lote, array('title' => 'Haz Click aqui para cambiar lote !', 'class' => 'encabezado'));
        if($nivel==12 and $tipo==1){
        $l3 = anchor('a_inv/tabla_control_editar_cantidad/'.$r->id.'/'.$r->inv1, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para cambiar !', 'class' => 'encabezado'));    
        }else{$l3='';}
        
        
        if($r->inv1>0){
        $color='#070707';    
        }else{
        $color='#FC0404';       
        }
         $colorx='#3609FC'; 
            $tabla.="
            <tr>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".$r->sec."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->susa1."</font></td>
            <td align=\"left\"><font size=\"-1\" color=\"$color\">".$r->cadu.$l1."</font> <br /><font size=\"2\" color=\"$colorx\">".$l2."</font></td>
            <td align=\"right\"><font size=\"-1\" color=\"$color\">".number_format($r->inv1,0)."$l3</font></td>
            

            </tr>
            ";
        $totcan=$totcan+$r->inv1;
         
        }
              $tabla.="
        </tbody>
        </tr>
        <td align=\"right\"  colspan=\"3\"><font size=\"+1\" color=\"$color\">TOTAL</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totcan,0)."</font></td>
        <tr>  	
         </table>";
          return $tabla;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     function delete_member_inv($id)
     {
         $id_user= $this->session->userdata('id');

$sx = "SELECT * FROM desarrollo.inv_cedis a where id=$id";
$qx = $this->db->query($sx);    
if($qx->num_rows() > 0){ 
$rx= $qx->row();
$invi=$rx->inv1;
$sec=$rx->sec;
$lote=$rx->lote;
$cadu=$rx->cadu;
$id=$rx->id;
if($invi < 0){
///////////////////////////////////////////////////////////////movimiento por entrada
$this->__inv_ent($sec,$invi,$lote,$cadu,$id);
}else{
/////////////////////////////////////////////////////**********movimiento por salidaa
$this->__inv_sal ($sec,$invi,$lote,$cadu,$id);
}
}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function __inv_ent($sec,$invi,$lote,$cadu,$id)
{
    $id_user= $this->session->userdata('id');
  $bb=$invi*(-1);   
$fecc=date('Y-m-d');    
$sd = "SELECT * FROM desarrollo.inv_cedis_dia a where fecha='$fecc' and sec=$sec and lote='$lote'";
        $qd = $this->db->query($sd);    
if($qd->num_rows() > 0){ 
            $rd= $qd->row();
            $exi=$rd->eaju;
            $id_inv_dia=$rd->id;            
                     $datad1 = array(
                    'eaju'     => $exi+$bb
                    );
                    $this->db->where('id', $id_inv_dia);
                    $this->db->update('desarrollo.inv_cedis_dia', $datad1);
           

}else{
           $datad = array(
                    'invi'=>$invi,
            		'fecha' =>$fecc,
                    'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'eaju'  =>$bb,
                    );
                    $this->db->insert('desarrollo.inv_cedis_dia', $datad);  
    
}
$new_member_insert_data = array(
            'tipo'   =>'BORRAR',
            'sec'   =>$sec,
            'id_user'=>$id_user,
   			'cadu'   =>$cadu,
       		'lote'   =>$lote,
            'salida' =>0,
            'entrada'=>$bb,
            'fecha'  =>date('Y-m-d H:s')
		);
		$insert = $this->db->insert('desarrollo.a_ajustes', $new_member_insert_data);
        
        $soloo = array('inv1'=>0);$this->db->where('id', $id);$this->db->update('desarrollo.inv_cedis', $soloo);
    
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function __inv_sal($sec,$invi,$lote,$cadu,$id)
{
    $id_user= $this->session->userdata('id');
$fecc=date('Y-m-d');    
$sd = "SELECT * FROM desarrollo.inv_cedis_dia a where fecha='$fecc' and sec=$sec and lote='$lote'";
        $qd = $this->db->query($sd);    
if($qd->num_rows() > 0){ 
            $rd= $qd->row();
            $exi=$rd->saju;
            $id_inv_dia=$rd->id;            
                     $datad1 = array(
                    'saju'     => $exi+$invi
                    );
                    $this->db->where('id', $id_inv_dia);
                    $this->db->update('desarrollo.inv_cedis_dia', $datad1);
           

}else{
           $datad = array(
                    'invi'=>$invi,
            		'fecha' =>$fecc,
                    'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'saju'  =>$invi,
                    );
                    $this->db->insert('desarrollo.inv_cedis_dia', $datad);  
    
}
$new_member_insert_data = array(
            'tipo'   =>'BORRAR',
            'sec'   =>$sec,
            'id_user'=>$id_user,
   			'cadu'   =>$cadu,
       		'lote'   =>$lote,
            'salida' =>$invi,
            'entrada'=>0,
            'fecha'  =>date('Y-m-d H:s')
		);
		$insert = $this->db->insert('desarrollo.a_ajustes', $new_member_insert_data);
        $soloo = array('inv1'=>0);$this->db->where('id', $id);$this->db->update('desarrollo.inv_cedis', $soloo);

}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function busca_folio($id)
    {
        $id_user= $this->session->userdata('id');
        $sql = "SELECT a.*,b.susa1 
        FROM desarrollo.inv_cedis a 
        left join catalogo.sec_unica b on b.sec=a.sec 
        where a.id= ?";
        $query = $this->db->query($sql,array($id));
         return $query;  
    }
    /////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////
        function busca_folio_fechas($sec, $fec1, $fec2, $lote)
    {
        
        $lote = str_replace("%20", " ", $lote);
        
     $totcan=0;  
     $sql = "select a.suc,c.nombre,fechasur,a.fol,b.can
            from desarrollo.pedidos a
            left join desarrollo.surtido b on b.fol=a.fol and b.sec=a.sec
            left join catalogo.sucursal c on c.suc=a.suc
            where a.fechasur>='$fec1' and date_format(a.fechasur,'%Y-%m-%d')<='$fec2' and a.sec=$sec and lote='$lote'
            order by fechasur";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Suc</th>
        <th>Nombre</th>
        <th>Fecha Surtido</th>
        <th>Folio</th>
        <th>Cantidad</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $color='black';
        foreach($query->result() as $row)
        {
            
            $tabla.="
            <tr>
            <td align=\"right\"><font color=\"$color\">".$row->suc."</font></td>
            <td align=\"lefth\"><font color=\"$color\">".$row->nombre."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->fechasur."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->fol."</font></td>
            <td align=\"right\"><font color=\"$color\">".$row->can."</font></td>
            </tr>
            ";
        $totcan=$totcan+$row->can;    
            
        }
        
        $tabla.="
        </tbody>
        <tr>
        <td align=\"right\"  colspan=\"4\"><font size=\"+1\" color=\"$color\">TOTAL</font></td>
        <td align=\"right\"><font size=\"+1\" color=\"$color\">".number_format($totcan,0)."</font></td>
        </tr>
        </table>";
        
        return $tabla; 
    
    }
////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 function update_cadu($id,$cadu,$cadua,$sec,$lote)
    {
    $id_user= $this->session->userdata('id');
    $tipo='Caducidad '.$cadua.'por '.$cadu;
    if($cadu<>$cadua){   
    $datad1 = array('cadu'=> $cadu);
                    $this->db->where('id', $id);
                    $this->db->update('desarrollo.inv_cedis', $datad1);       
    $datad_aju = array(//tipo, sec, cadu, lote, salida, entrada, fecha, id_user, id, folio, suc
                    'tipo'  =>$tipo,
                    'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'entrada'=>0,
                    'salida' =>0,
                    'id_user'=>$id_user,
                    'fecha'  =>date('Y-m-d H:i:s')
                    );
                    $this->db->insert('desarrollo.a_ajustes', $datad_aju);        
   }
   }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function update_lote($id,$sec,$lote1,$lote,$inv1,$cadu)
    {
        
        if($lote1<>$lote){
        $tipo='CAMBIO DE LOTE';    
        $this->__entra_mercancia($tipo,$sec,$lote,$cadu,$inv1);
        $this->__sale_mercancia($tipo,$sec,$lote1,$cadu,$inv1);
        }
   }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function __entra_mercancia($tipo,$sec,$lote,$cadu,$inv1)
 {
 $id_user= $this->session->userdata('id');
 /////////////////////////////////////////////////***************************************************************
        $sql = "SELECT * FROM desarrollo.inv_cedis where sec=$sec and lote='$lote'";
        $query = $this->db->query($sql); 
      if($query->num_rows() > 0){ 
        $row= $query->row(); 
        $exi=$row->inv1;
        $datad1 = array('inv1'=> $exi+$inv1);
                    $this->db->where('sec', $sec);
                    $this->db->where('lote', $lote);
                    $this->db->update('desarrollo.inv_cedis', $datad1);
        }else{$exi=0;
        $datad2 = array(
                    'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'inv1'  =>$inv1,
                    'inv2'  =>$exi,
                    'fechai'  =>date('Y-m-d H:i:s')
                    );
                    $this->db->insert('desarrollo.inv_cedis', $datad2);     
        }
 /////////////////////////////////////////////////***************************************************************
        $fecha=date('Y-m-d');
        $sql_dia = "SELECT * FROM desarrollo.inv_cedis_dia where sec=$sec and lote='$lote' and fecha='$fecha'";
        $query_dia = $this->db->query($sql_dia); 
        if($query_dia->num_rows() > 0){ 
          $row_dia= $query_dia->row(); 
          $exi_dia=$row_dia->eaju;
          $datad_dia1 = array('eaju'=> $exi_dia+$inv1);
                    $this->db->where('sec', $sec);
                    $this->db->where('lote', $lote);
                    $this->db->where('fecha', $fecha);
                    $this->db->update('desarrollo.inv_cedis_dia', $datad_dia1);
        }else{$exi_dia=0;
            $datad_dia2 = array(//fecha, sec, cadu, lote, ecom, etra, edev, eaju, ssur, stra, sdev, saju, id, invi
                    'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'invi'  =>$exi,
                    'eaju'  =>$inv1,
                    'fecha'  =>$fecha
                    );
                    $this->db->insert('desarrollo.inv_cedis_dia', $datad_dia2);     
        }   
/////////////////////////////////////////////////***************************************************************
/////////////////////////////////////////////////*************************************************************** 
            $datad_aju = array(//tipo, sec, cadu, lote, salida, entrada, fecha, id_user, id, folio, suc
                    'tipo'  =>$tipo,
                    'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'entrada'=>$inv1,
                    'salida' =>0,
                    'id_user'=>$id_user,
                    'fecha'  =>date('Y-m-d H:i:s')
                    );
                    $this->db->insert('desarrollo.a_ajustes', $datad_aju);     
}   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function __sale_mercancia($tipo,$sec,$lote1,$cadu,$inv1)
 {
$id_user= $this->session->userdata('id');
 /////////////////////////////////////////////////***************************************************************
        $sql = "SELECT * FROM desarrollo.inv_cedis where sec=$sec and lote='$lote1'";
      $query = $this->db->query($sql); 
      if($query->num_rows() > 0){ 
        $row= $query->row(); 
        $exi=$row->inv1;
        $datad1 = array('inv1'=> $exi-$inv1);
                    $this->db->where('sec', $sec);
                    $this->db->where('lote', $lote1);
                    $this->db->update('desarrollo.inv_cedis', $datad1);
        }else{$exi=0;
        $datad2 = array(
                    'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'inv1'  =>0-$inv1,
                    'inv2'  =>$exi,
                    'fechai'  =>date('Y-m-d H:i:s')
                    );
                    $this->db->insert('desarrollo.inv_cedis', $datad2);     
        }
 /////////////////////////////////////////////////***************************************************************
        $fecha=date('Y-m-d');
        $sql_dia = "SELECT * FROM desarrollo.inv_cedis_dia where sec=$sec and lote='$lote1' and fecha='$fecha'";
        $query_dia = $this->db->query($sql_dia); 
       if($query_dia->num_rows() > 0){ 
          $row_dia= $query_dia->row(); 
         $exi_dia=$row_dia->eaju;
         $datad_dia1 = array('saju'=> $exi_dia-$inv1);
                    $this->db->where('sec', $sec);
                    $this->db->where('lote', $lote1);
                    $this->db->where('fecha', $fecha);
                    $this->db->update('desarrollo.inv_cedis_dia', $datad_dia1);
        }else{$exi_dia=0;
            $datad_dia2 = array(//fecha, sec, cadu, lote, ecom, etra, edev, eaju, ssur, stra, sdev, saju, id, invi
                    'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote1,
            		'invi'  =>$exi,
                    'saju'  =>$inv1,
                    'fecha'  =>$fecha
                    );
                    $this->db->insert('desarrollo.inv_cedis_dia', $datad_dia2);     
        }   
/////////////////////////////////////////////////***************************************************************
/////////////////////////////////////////////////*************************************************************** 
            $datad_aju = array(//tipo, sec, cadu, lote, salida, entrada, fecha, id_user, id, folio, suc
                    'tipo'  =>$tipo,
                    'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote1,
            		'salida'  =>$inv1,
                    'entrada' =>0,
                    'id_user'=>$id_user,
                    'fecha'  =>date('Y-m-d H:i:s')
                    );
                    $this->db->insert('desarrollo.a_ajustes', $datad_aju);     
}   
 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function update_member_inv_solo_can($id,$sec,$lote,$cadu,$inv1,$can)
    {
$id_user= $this->session->userdata('id');$entrada=0;$salida=0;
$sx = "SELECT * FROM desarrollo.inv_cedis where id=$id";
        $qx= $this->db->query($sx);    
if($qx->num_rows() > 0){ 
            $rx= $qx->row();
            
if($inv1 >0 and $inv1>$can){$entrada=$inv1-$can;}
if($inv1>=0 and $inv1<$can){$salida=$can-$inv1;}
if($inv1<0 and $can=0){$entrada=$inv1*(-1);}
if($inv1<0 and $can>0){$entrada=($inv1*(-1))+$can;}
if($entrada>0){
$s1="insert into a_ajustes(tipo, sec, cadu, lote, salida, entrada, fecha, id_user)values
('CAMBIO DE CANT',$sec,'$cadu','$lote',0,$entrada,date(now()),$id_user)";
$s0="select *from inv_cedis_dia where fecha=date(now())";
$this->db->query($s1);
$q0=$this->db->query($s0);
if($q0->num_rows()==0){
$s2="insert into a_ajustes(fecha, sec, cadu, lote, ecom, etra, edev, eaju, ssur, stra, sdev, saju,  invi)values
(date(now()),$sec,'$cadu','$lote',0,0,0,$entrada,0,0,0,0,$inv1)";
$this->db->query($s2);    
}else{
$r0=$q0->row();
$data = array('eaju'=> ($$r0->aju)+$entrada);$this->db->where('id',$r0->id);$this->db->update('desarrollo.inv_cedis_dia', $data);
}}
if($salida>0){
$s1="insert into a_ajustes(tipo, sec, cadu, lote, salida, entrada, fecha, id_user)values
('CAMBIO DE CANT',$sec,'$cadu','$lote',$salida,0,date(now()),$id_user)";
$this->db->query($s1);
$s0="select *from inv_cedis_dia where fecha=date(now()) and sec=$sec and lote='$lote'";
$q0=$this->db->query($s0);
if($q0->num_rows()==0){
$s2="insert into a_ajustes(fecha, sec, cadu, lote, ecom, etra, edev, eaju, ssur, stra, sdev, saju, invi)values
(date(now()),$sec,'$cadu','$lote',0,0,0,0,0,0,0,$salida,$inv1)";    
$this->db->query($s2);
}else{
$r0=$q0->row();
$data = array('eaju'=> ($$r0->aju)+$salida);$this->db->where('id',$r0->id);$this->db->update('desarrollo.inv_cedis_dia', $data);
}}

    
 $dataf = array('inv1'=> $can);$this->db->where('id', $id);$this->db->update('desarrollo.inv_cedis', $dataf);    
}


}
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
function update_member_inv($id,$sec,$lote,$cadu,$inv1,$can)
    {
$id_user= $this->session->userdata('id');
$sx = "SELECT * FROM desarrollo.inv_cedis where id=$id";
        $qx= $this->db->query($sx);    
if($qx->num_rows() > 0){ 
            $rx= $qx->row();
            $loteo=$rx->lote;        
            $caduo=$rx->cadu;
            $i_inicial=$rx->inv1;
            
        
///////////////////////////////////////////cuando el lote es diferente
if($lote<>$loteo){

if($inv1 < 0){
$positivo=$inv1*(-1); 
    
$this->__inv_entrada($sec,$i_inicial,$loteo,$cadu,$positivo,$id);
$this->__inv_salida($sec,$i_inicial,$lote,$cadu,$positivo,$id);

}elseif($inv1 > 0 and $i_inicial < 0){
$nuevo=($i_inicial*(-1))+$inv1;
$this->__inv_entrada($sec,$i_inicial,$loteo,$cadu,$nuevo,$id);
$this->__inv_salida($sec,$i_inicial,$lote,$cadu,$nuevo,$id);

}elseif($inv1 > 0 and $i_inicial > 0 and $i_inicial > $inv1){
$nuevo=$i_inicial-$inv1;    
$this->__inv_salida($sec,$i_inicial,$loteo,$cadu,$nuevo,$id);
$this->__inv_entrada($sec,$i_inicial,$lote,$cadu,$inv1,$id);

}elseif($inv1 > 0 and $i_inicial > 0 and $i_inicial < $inv1){
$nuevo=$inv1-$i_inicial;
$this->__inv_salida($sec,$i_inicial,$loteo,$cadu,$nuevo,$id);
$this->__inv_entrada($sec,$i_inicial,$lote,$cadu,$inv1,$id);
}
///////////////////////////////////////////////////////////////////////////deja el otro lote en ceros
$sdll = "SELECT * FROM desarrollo.inv_cedis a where id=$id";
$qdll = $this->db->query($sdll);    
if($qdll->num_rows() > 0){
            $datad1 = array(
           'inv1'     =>0
            );
               $this->db->where('id', $id_nuevo);
            $this->db->update('desarrollo.inv_cedis', $datad1);    
}   
///////////////////////////////////////////lote es igual  cantidades diferentes
}

if($lote == $loteo and $inv1 <> $i_inicial){

if($inv1 >= 0 and $i_inicial < 0){
$nuevo=($i_inicial*(-1))+$inv1;
$this->__inv_entrada($sec,$i_inicial,$lote,$cadu,$nuevo,$id);

}elseif($inv1 >= 0 and $i_inicial >= 0 and $i_inicial > $inv1){
$nuevo=$i_inicial-$inv1;    
$this->__inv_salida($sec,$i_inicial,$lote,$cadu,$nuevo,$id);

}elseif($inv1 >= 0 and $i_inicial >= 0 and $i_inicial < $inv1){
$nuevo=$inv1-$i_inicial;
$this->__inv_entrada($sec,$i_inicial,$lote,$cadu,$nuevo,$id);
}
}


//**********************************************************************************inventario cedis
$sd = "SELECT * FROM desarrollo.inv_cedis a where sec=$sec and lote='$lote'";
$qd = $this->db->query($sd);    
if($qd->num_rows() > 0){
$rd= $qd->row();
            $inv_actual=$rd->inv;
            $id_nuevo=$id;
            
            $datad1 = array(
           'inv1'     =>$inv_actual-$positivo
            );
               $this->db->where('id', $id_nuevo);
            $this->db->update('desarrollo.inv_cedis', $datad1);    
}else{
$inv_actual=0;
$datadx3 = array(///sec, lote, cadu, inv1, inv2, fechai, id
                    'tipo'=>'CAMBIO DE LOTE',
            		'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'inv1'  =>0-$positivo,
                    'inv2'  =>0,
                    'fechai'  =>date('Y-m-d H:s')
                    );
                    $this->db->insert('desarrollo.inv_cedis', $datadx3);       
}

//--------------------------------------------------------------------------------------

}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function __inv_entrada($sec,$i_inicial,$lote,$cadu,$positivo,$id)
{
$id_user= $this->session->userdata('id');
$fecc=date('Y-m-d');    
//**********************************************************************************inventario cedis por dia
$sd = "SELECT * FROM desarrollo.inv_cedis_dia a where fecha='$fecc' and sec=$sec and lote='$lote'";
$qd = $this->db->query($sd);    
if($qd->num_rows() > 0){
$rd= $qd->row();
            $exi=$rd->eaju;
            $id_inv_dia=$rd->id;
            $datad1 = array(
           'eaju'     =>$exi+$positivo
            );
               $this->db->where('id', $id_inv_dia);
            $this->db->update('desarrollo.inv_cedis_dia', $datad1);    
}else{
 //**********************************************************************************inventario cedis
$sd = "SELECT * FROM desarrollo.inv_cedis  where sec=$sec and lote='$lote'";
$qd = $this->db->query($sd);    
if($qd->num_rows() > 0){
    $rd= $qd->row();
    $inn=$rd->inv1;}else{$inn=0;}   
 $datadxx = array(
                    'invi'=>$inn,
            		'fecha' =>$fecc,
                    'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'eaju'  =>$positivo
                    );
                    $this->db->insert('desarrollo.inv_cedis_dia', $datadxx);    
}
//**********************************************************************************ajustes
$datadxy = array(///tipo, sec, cadu, lote, salida, entrada, fecha, id_user, id, folio, suc
                    'tipo'=>'CAMBIO DE LOTE',
            		'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'entrada'=>$positivo,
                    'salida' =>0,
                    'fecha'  =>date('Y-m-d H:s'),
                    'id_user'=>$id_user
                    );
                    $this->db->insert('desarrollo.a_ajustes', $datadxy);    



}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function __inv_salida($sec,$i_inicial,$lote,$cadu,$positivo,$id)
{
$id_user= $this->session->userdata('id');
$fecc=date('Y-m-d');    

 //**********************************************************************************inventario cedis
$sd = "SELECT * FROM desarrollo.inv_cedis  where sec=$sec and lote='$lote'";$qd = $this->db->query($sd);    
if($qd->num_rows() > 0){$rd= $qd->row();$inn=$rd->inv1;}else{$inn=0;}
//**********************************************************************************inventario cedis por dia
$sd = "SELECT * FROM desarrollo.inv_cedis_dia a where fecha='$fecc' and sec=$sec and lote='$lote'";
$qd = $this->db->query($sd);    
if($qd->num_rows() > 0){
$rd= $qd->row();
            $exi=$rd->eaju;
            $id_inv_dia=$rd->id;
            $datad1 = array(
           'saju'     =>$exi-$positivo
            );
               $this->db->where('id', $id_inv_dia);
            $this->db->update('desarrollo.inv_cedis_dia', $datad1);    
}else{
 $datadxx = array(
                    'invi'=> $inn,
            		'fecha' =>$fecc,
                    'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'saju'  =>$positivo
                    );
                    $this->db->insert('desarrollo.inv_cedis_dia', $datadxx);    
}
   
//**********************************************************************************ajustes
$datadxy = array(///tipo, sec, cadu, lote, salida, entrada, fecha, id_user, id, folio, suc
                    'tipo'=>'CAMBIO DE LOTE',
            		'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'salida'=>$positivo,
                    'entrada' =>0,
                    'fecha'  =>date('Y-m-d H:s'),
                    'id_user'=>$id_user
                    );
                    $this->db->insert('desarrollo.a_ajustes', $datadxy);    



}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




































function __inv_ent_sal($sec,$invi,$lote,$loteo,$cadu,$sale,$entra,$id)
{
    $id_user= $this->session->userdata('id');
$fecc=date('Y-m-d');    
$sd = "SELECT * FROM desarrollo.inv_cedis_dia a where fecha='$fecc' and sec=$sec and lote='$loteo'";
echo "SELECT * FROM desarrollo.inv_cedis_dia a where fecha='$fecc' and sec=$sec and lote='$loteo'";
//die();
        $qd = $this->db->query($sd);    
if($qd->num_rows() > 0){ 
            $rd= $qd->row();
            $exi=$rd->eaju;
            $id_inv_dia=$rd->id;
           // if($sale < 0){$sale=$sale*(-1);}            
                     $datad1 = array(
                    'saju'     =>$exi+$sale,
                    );
                    $this->db->where('id', $id_inv_dia);
                    $this->db->update('desarrollo.inv_cedis_dia', $datad1);
           

}

$sdxx = "SELECT * FROM desarrollo.inv_cedis_dia a where fecha='$fecc' and sec=$sec and lote='$lote'";
$qdxx = $this->db->query($sdxx);
//if($entra < 0){$entra=$entra*(-1);}     
if($qdxx->num_rows() == 0){ 

           $datadxx = array(
                    'invi'=>$invi,
            		'fecha' =>$fecc,
                    'sec'   =>$sec,
           			'cadu'  =>$cadu,
            		'lote'  =>$lote,
            		'eaju'  =>$entra,
                    );
                    $this->db->insert('desarrollo.inv_cedis_dia', $datadxx);  
    
}else{
            $rdxx= $qd->row();
            $exi=$rdxx->eaju;
            $id_inv_diaxx=$rdxx->id;            
                     $datad1xx = array(
                    'eaju'     => $exi+$entra
                    );
                    $this->db->where('id', $id_inv_diaxx);
                    $this->db->update('desarrollo.inv_cedis_dia', $datad1xx);   
}

$new_member_insert_datae = array(
            'tipo'   =>'CAMBIO LOTE',
            'sec'   =>$sec,
            'id_user'=>$id_user,
   			'cadu'   =>$cadu,
       		'lote'   =>$lote,
            'salida' =>0,
            'entrada'=>$entra,
            'fecha'  =>date('Y-m-d H:s')
		);
		$insert = $this->db->insert('desarrollo.a_ajustes', $new_member_insert_datae);
        $new_member_insert_datase = array(
            'tipo'   =>'CAMBIO LOTE',
            'sec'   =>$sec,
            'id_user'=>$id_user,
   			'cadu'   =>$cadu,
       		'lote'   =>$loteo,
            'salida' =>$sale,
            'entrada'=>0,
            'fecha'  =>date('Y-m-d H:s')
		);
		$insert = $this->db->insert('desarrollo.a_ajustes', $new_member_insert_datase);
        $soloo = array('inv1'=>0);$this->db->where('id', $id);$this->db->update('desarrollo.inv_cedis', $soloo);
        
        $nuevo="SELECT * FROM desarrollo.inv_cedis a where sec=$sec and lote='$lote'";
        $nuevoq=$this->db->query($nuevo);
if($nuevoq->num_rows() == 0){ 
        $new_member = array(
            'sec'   =>$sec,
            'cadu'   =>$cadu,
       		'lote'   =>$lote,
            'inv2' =>0,
            'inv1'=>$entra,
            'fechai'  =>date('Y-m-d H:s')
		);
        $insert = $this->db->insert('desarrollo.inv_cedis', $new_member);  
}else{
 $nuevor= $nuevoq->row();
 $exi=$nuevor->inv1;    
        $act = array('inv1'=>$exi+$entra);$this->db->where('sec', $sec);$this->db->where('lote', $lote);$this->db->update('desarrollo.inv_cedis', $act);
}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function busca_lotess($sec)
	{

		$sql = "SELECT sec,lote, cadu,inv1 FROM inv_cedis where sec= $sec and inv1>0";
         
        $query = $this->db->query($sql);
        
         if($query->num_rows() == 0){
            $tabla = 0;
        }else{
        
        $tabla = "<option value=\"-\">Selecciona un Lote</option>";
        
        foreach($query->result() as $row)
        {

            $tabla.="
            <option value =\"".$row->lote."\">".$row->lote." - $row->inv1 Pzas</option>
            ";
        }
        }
        
        return $tabla;
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function busca_lotess_cod($cod)
	{

		$sql = "SELECT a.sec,b.lote, b.cadu,b.inv1
FROM catalogo.almacen a
left join desarrollo.inv_cedis b on b.sec=a.sec
 where a.codigo=$cod and b.inv1>0
 order by b.cadu,b.lote";
         
        $query = $this->db->query($sql);
        
         if($query->num_rows() == 0){
            $tabla = 0;
        }else{
        
        $tabla = "<option value=\"-\">Selecciona un Lote</option>";
        
        foreach($query->result() as $row)
        {

            $tabla.="
            <option value =\"".$row->lote."\">".$row->lote." - $row->inv1 Pzas".$row->cadu."</option>
            ";
        }
        }
        
        return $tabla;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function busca_clave()
    {
        $devo1= null;
        $tras1= null;
        $ent1= null;
        $sal1= null;
        $compra1= null;
        $surtido1= null;
        $inventario1= null;
        
        $clave=$this->input->post('clave');
        $lote=$this->input->post('lote');
        $fecha1=$this->input->post('fecha1');
        $fecha2=$this->input->post('fecha2');
        
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->db->select('a.*,b.susa1,b.susa2, sum(a.inv1)as inv');
        $this->db->from('desarrollo.inv_cedis a');
        $this->db->join('catalogo.sec_unica b', 'b.sec=a.sec', 'LEFT');
        $this->db->where('a.sec', $clave);
        $this->db->like('a.lote', $lote);
        $this->db->group_by('a.lote');
        $query = $this->db->get();
        
        if($query->num_rows() > 0){
        $r = $query->row();
        $susa=$r->susa1;        
       
        
        
        
        $tabla1 = "
        <table>
        <thead>
        <tr>
        <th align=\"center\" colspan=\"11\"><font color=\"white\" size=\"+2\">".$susa."</font></th>
        </tr>
        <tr>
        <th>CLAVE</th>
        <th>LOTE</th>
        <th>CADUCIDAD</th>
        <th>DEVO</th>
        <th>TRAS</th>
        <th>A_ENT</th>
        <th>A_SAL</th>
        <th>COMPRA</th>
        <th>SUR</th>
        <th>INV</th>
        <th>FECHA</th>
        </tr>
        </thead>";
        foreach($query->result() as $row)
        {
        
        $this->db->select('d.*, z.tipo2, z.mov, b.susa1,b.susa2,sum(d.can)as can ');
        $this->db->from('desarrollo.devolucion_d d');
        $this->db->join('catalogo.sec_unica b', 'b.sec=d.sec', 'LEFT');
        $this->db->join('desarrollo.devolucion_c z', 'd.id_cc=z.id', 'LEFT');        
        $this->db->where("date(d.fechai) between '$fecha1' and '$fecha2'", '', false);
        $this->db->where('d.sec', $clave);
        $this->db->where('d.lote', $row->lote);
        $this->db->where('z.tipo2', 'c');
        $this->db->where('z.mov<3', '', false);        
        $this->db->group_by('d.lote');
        $query1 = $this->db->get();
                   
        
        if($query1->num_rows()>0){
        $row1 = $query1->row();
        $devo=$row1->can;
        }else{$devo=0;}
        
        $this->db->select('t.*, p.tipo2, b.susa1,b.susa2,sum(t.can)as can ');
        $this->db->from('desarrollo.traspaso_d t');
        $this->db->join('catalogo.sec_unica b', 'b.sec=t.sec', 'LEFT');
        $this->db->join('desarrollo.traspaso_c p', 't.id_cc=p.id', 'LEFT');
        $this->db->where("date(t.fechai) between '$fecha1' and '$fecha2'", '', false);
        $this->db->where('t.sec', $clave);
        $this->db->where('t.lote', $row->lote);
        $this->db->where('p.tipo2', 'c');
        $this->db->group_by('t.lote');
        $query2 = $this->db->get();
        
        if($query2->num_rows()>0){
        $row2 = $query2->row();
        $tras=$row2->can;
        }else{$tras=0;}
        
        $this->db->select('c.*,b.susa1,b.susa2,sum(c.salida)as salida ,sum(c.entrada)as entrada ');
        $this->db->from('desarrollo.a_ajustes c');
        $this->db->join('catalogo.sec_unica b', 'b.sec=c.sec', 'LEFT');
        $this->db->where("date(c.fecha) between '$fecha1' and '$fecha2'", '', false);
        $this->db->where('c.sec', $clave);
        $this->db->where('c.lote', $row->lote);
        $this->db->group_by('c.lote');
        $query3 = $this->db->get();
        
        if($query3->num_rows()>0){
        $row3 = $query3->row();
        $sal=$row3->salida;
        }else{$sal=0;}
        
        if($query3->num_rows()>0){
        $row3 = $query3->row();
        $ent=$row3->entrada;
        }else{$ent=0;}
        
        $this->db->select('a.*,b.susa1,b.susa2, sum(a.can)as can, c.suc, d.suc, c.tid, d.tid');
        $this->db->from('desarrollo.surtido a');
        $this->db->join('catalogo.sec_unica b', 'b.sec=a.sec', 'LEFT');
        $this->db->join('catalogo.folio_pedidos_cedis c', 'a.fol=c.id', 'LEFT');
        $this->db->join('catalogo.folio_pedidos_cedis_especial d', 'a.fol=d.id', 'LEFT');
        $this->db->where("date(a.fecha) between '$fecha1' and '$fecha2'", '', false);
        $this->db->where('a.sec', $clave);
        $this->db->where('a.lote', $row->lote);
        $this->db->where('c.tid', 'C');
        $this->db->or_where('a.sec', $clave, '', false);
        $this->db->where('a.lote', $row->lote);
        $this->db->where('d.tid', 'C');
        $this->db->group_by('a.lote');
        $query4 = $this->db->get();
        
        //echo $this->db->last_query();
        //die();
        
        if($query4->num_rows()>0){
        $row4 = $query4->row();
        $surtido=$row4->can;
        }else{$surtido=0;}
        
        $this->db->select('g.*,h.tipo, b.susa1,b.susa2,sum(g.can)as can');
        $this->db->from('desarrollo.compra_d g');
        $this->db->join('catalogo.sec_unica b', 'b.sec=g.sec', 'LEFT');
        $this->db->join('desarrollo.compra_c h', 'g.id_cc=h.id', 'LEFT');
        $this->db->where("date(g.fechai) between '$fecha1' and '$fecha2'", '', false);
        $this->db->where('g.sec', $clave);
        $this->db->where('g.lote', $row->lote);
        $this->db->where('h.tipo', 'c');
        $this->db->group_by('g.lote');
        $query4 = $this->db->get();
        
        if($query4->num_rows()>0){
        $row4 = $query4->row();
        $compra=$row4->can;
        }else{$compra=0;}
        
        
        if($devo > 0){
            $l1 = anchor('a_inv/devo/'.$row->lote.'/'.$row->sec.'/'.$fecha1.'/'.$fecha2, $devo, array('target'=>'_blank'));
        }else{
            $l1 = $devo;
        }
        
        if($tras > 0){
            $l2 = anchor('a_inv/tras/'.$row->lote.'/'.$row->sec.'/'.$fecha1.'/'.$fecha2, $tras, array('target'=>'_blank'));
        }else{
            $l2 = $tras;
        }
        
        if($ent <> 0){
            $l3 = anchor('a_inv/ajuste/'.$row->lote.'/'.$row->sec.'/'.$fecha1.'/'.$fecha2, $ent, array('target'=>'_blank'));
        }else{
            $l3 = $ent;
        }
        
        if($sal <> 0){
            $l4 = anchor('a_inv/ajuste/'.$row->lote.'/'.$row->sec.'/'.$fecha1.'/'.$fecha2, $sal, array('target'=>'_blank'));
        }else{
            $l4 = $sal;
        }
        
        if($compra > 0){
            $l5 = anchor('a_inv/compra/'.$row->lote.'/'.$row->sec.'/'.$fecha1.'/'.$fecha2, $compra, array('target'=>'_blank'));
        }else{
            $l5 = $compra;
        }
        
        if($surtido > 0){
            $l6 = anchor('a_inv/surtido/'.$row->lote.'/'.$row->sec.'/'.$fecha1.'/'.$fecha2, $surtido, array('target'=>'_blank'));
        }else{
            $l6 = $surtido;
        }
        
            $tabla1.= "
            
            <tr>
            <td align=\"left\">".$row->sec."</td>
            <td align=\"right\">".$row->lote."</td>
            <td align=\"left\">".$row->cadu."</td>
            <td align=\"left\">".$l1."</td>
            <td align=\"left\">".$l2."</td>
            <td align=\"left\">".$l3."</td>
            <td align=\"left\">".$l4."</td>
            <td align=\"left\">".$l5."</td>
            <td align=\"left\">".$l6."</td>
            <td align=\"left\">".$row->inv1."</td>
            <td align=\"left\">".$row->fechai."</td>
            </tr>
            ";
        
        $devo1 = $devo1 + $devo;
        $tras1 = $tras1 + $tras;
        $ent1 = $ent1 + $ent;
        $sal1 = $sal1 + $sal;
        $compra1 = $compra1 + $compra;
        $surtido1 = $surtido1 + $surtido;
        $inventario1 = $inventario1 + $row->inv1;
      
        
        }
        
        
        $tabla1.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"3\">TOTALES</td>
        <td align=\"right\">".number_format($devo1,0)."</td>
        <td align=\"right\">".number_format($tras1,0)."</td>
        <td align=\"right\">".number_format($ent1,0)."</td>
        <td align=\"right\">".number_format($sal1,0)."</td>
        <td align=\"right\">".number_format($compra1,0)."</td>
        <td align=\"right\">".number_format($surtido1,0)."</td>
        <td align=\"right\">".number_format($inventario1,0)."</td>
        </tr>
        </tfoot>
        </table> 
        ";
        return $tabla1;
        
        }else{
            echo "No hay Resultados que mostrar.";
        }
    }
    
    function devolucion($lote, $sec, $fecha1, $fecha2)
    {
        $can1 = null;
        
        
        $this->db->select('p.*, t.*, u.nombre, a.nom, b.susa1, w.nombre as sucursal');
        $this->db->from('desarrollo.devolucion_d p');
        $this->db->join('desarrollo.devolucion_c t', 'p.id_cc=t.id', 'LEFT');
        $this->db->join('catalogo.sucursal w', 'w.suc=t.suc', 'LEFT');
        $this->db->join('desarrollo.usuarios u', 'u.id=t.id_user', 'LEFT');
        $this->db->join('catalogo.devolucion a', 'a.num=t.mov', 'LEFT');
        $this->db->join('catalogo.sec_unica b', 'b.sec=p.sec', 'LEFT');
        $this->db->where('p.sec', $sec);
        $this->db->where('p.lote', $lote);
        $this->db->where('t.tipo2', 'c');
        $this->db->where('t.mov<3', '', false);
        $this->db->where("date(p.fechai) between '$fecha1' and '$fecha2'", '', false);
        $query = $this->db->get();
        
        $r = $query->row();
        $susa=$r->susa1;   
        
        //echo $this->db->last_query();
        //die();
        
        $tabla = "
        <table>
        <thead>
        <tr>
        <th align=\"center\" colspan=\"11\"><font color=\"white\" size=\"+2\">".$susa."</font></th>
        </tr>
        <tr>
        <th>CLAVE</th>
        <th>LOTE</th>
        <th>CAD</th>
        <th>RRM</th>
        <th>PIEZAS</th>
        <th>FECHA</th>
        <th>SUC</th>
        <th>TIPO</th>
        <th>NOMBRE</th>
        </tr>
        </thead>
        <tbody>";
        
        foreach($query->result() as $row)
        {
            $tabla.= "
            
            <tr>
            <td align=\"left\">".$row->sec."</td>
            <td align=\"right\">".$row->lote."</td>
            <td align=\"left\">".$row->cadu."</td>
            <td align=\"left\">".$row->rrm."</td>
            <td align=\"right\">".$row->can."</td>
            <td align=\"left\">".$row->fechai."</td>
            <td align=\"left\">".$row->suc.' '.$row->sucursal."</td>
            <td align=\"left\">".$row->nom."</td>
            <td align=\"left\">".$row->nombre."</td>
            </tr>
            ";
            
            $can1 = $can1 + $row->can;
    }
    
    $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTAL</td>
        <td align=\"right\">".number_format($can1,0)."</td>
        </tr>
        </tfoot>
        </table> 
        ";
        return $tabla;
    
    }
    
    function tabla_tras($lote, $sec, $fecha1, $fecha2)
    {
        $can1 = null;
        
        $this->db->select('p.*, t.*, u.nombre, b.susa1, w.nombre as sucursal');
        $this->db->from('desarrollo.traspaso_d p');
        $this->db->join('desarrollo.traspaso_c t', 'p.id_cc=t.id', 'LEFT');
        $this->db->join('catalogo.sucursal w', 'w.suc=t.suc', 'LEFT');
        $this->db->join('desarrollo.usuarios u', 'u.id=t.id_user', 'LEFT');
        $this->db->join('catalogo.sec_unica b', 'b.sec=p.sec', 'LEFT');
        $this->db->where('p.sec', $sec);
        $this->db->where('p.lote', $lote);
        $this->db->where('t.tipo2', 'c');
        $this->db->where("date(p.fechai) between '$fecha1' and '$fecha2'", '', false);
        $query = $this->db->get();
        
        $r = $query->row();
        $susa=$r->susa1;   
        
        //echo $this->db->last_query();
        //die();
        
        $tabla = "
        <table>
        <thead>
        <tr>
        <th align=\"center\" colspan=\"11\"><font color=\"white\" size=\"+2\">".$susa."</font></th>
        </tr>
        <tr>
        <th>CLAVE</th>
        <th>LOTE</th>
        <th>CAD</th>
        <th>PIEZAS</th>
        <th>FECHA</th>
        <th>SUC</th>
        <th>NOMBRE</th>
        </tr>
        </thead>
        <tbody>";
        
        foreach($query->result() as $row)
        {
            $tabla.= "
            
            <tr>
            <td align=\"left\">".$row->sec."</td>
            <td align=\"right\">".$row->lote."</td>
            <td align=\"left\">".$row->cadu."</td>
            <td align=\"right\">".$row->can."</td>
            <td align=\"left\">".$row->fechai."</td>
            <td align=\"left\">".$row->suc.' '.$row->sucursal."</td>
            <td align=\"left\">".$row->nombre."</td>
            </tr>
            ";
            
    $can1 = $can1 + $row->can;
    }
    
    $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"3\">TOTAL</td>
        <td align=\"right\">".number_format($can1,0)."</td>
        </tr>
        </tfoot>
        </table> 
        ";
        return $tabla;
    
    }
    
    function tabla_ajuste($lote, $sec, $fecha1, $fecha2)
    {
        $entrada1 = null;
        $salida1 = null;
        
        $this->db->select('p.*, u.nombre, b.susa1, w.nombre as sucursal');
        $this->db->from('desarrollo.a_ajustes p');
        $this->db->join('catalogo.sucursal w', 'w.suc=p.suc', 'LEFT');
        $this->db->join('desarrollo.usuarios u', 'u.id=p.id_user', 'LEFT');
        $this->db->join('catalogo.sec_unica b', 'b.sec=p.sec', 'LEFT');
        $this->db->where('p.sec', $sec);
        $this->db->where('p.lote', $lote);
        $this->db->where("date(p.fecha) between '$fecha1' and '$fecha2'", '', false);
        $query = $this->db->get();
        
        $r = $query->row();
        $susa=$r->susa1;   
        
        //echo $this->db->last_query();
        //die();
        
        $tabla = "
        <table>
        <thead>
        <tr>
        <th align=\"center\" colspan=\"11\"><font color=\"white\" size=\"+2\">".$susa."</font></th>
        </tr>
        <tr>
        <th>CLAVE</th>
        <th>LOTE</th>
        <th>CAD</th>
        <th>PIEZAS ENTRADA</th>
        <th>PIEZAS SALIDA</th>
        <th>FECHA</th>
        <th>FOLIO</th>
        <th>SUC</th>
        <th>TIPO</th>
        <th>NOMBRE</th>
        </tr>
        </thead>
        <tbody>";
        
        foreach($query->result() as $row)
        {
            $tabla.= "
            
            <tr>
            <td align=\"left\">".$row->sec."</td>
            <td align=\"right\">".$row->lote."</td>
            <td align=\"left\">".$row->cadu."</td>
            <td align=\"right\">".$row->entrada."</td>
            <td align=\"right\">".$row->salida."</td>
            <td align=\"left\">".$row->fecha."</td>
            <td align=\"left\">".$row->folio."</td>
            <td align=\"left\">".$row->suc.' '.$row->sucursal."</td>
            <td align=\"left\">".$row->tipo."</td>
            <td align=\"left\">".$row->nombre."</td>
            </tr>
            ";
            
    $entrada1 = $entrada1 + $row->entrada;
    $salida1 = $salida1 + $row->salida;
    }
    
    $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"3\">TOTAL</td>
        <td align=\"right\">".number_format($entrada1,0)."</td>
        <td align=\"right\">".number_format($salida1,0)."</td>
        </tr>
        </tfoot>
        </table> 
        ";
        return $tabla;
    
    }
    

    function tabla_compra($lote, $sec, $fecha1, $fecha2)
    {
        $can1 = null;
        
        $this->db->select('p.*, t.*, u.nombre, b.susa1, a.razo');
        $this->db->from('desarrollo.compra_d p');
        $this->db->join('desarrollo.compra_c t', 'p.id_cc=t.id', 'LEFT');
        $this->db->join('desarrollo.usuarios u', 'u.id=t.id_user', 'LEFT');
        $this->db->join('catalogo.sec_unica b', 'b.sec=p.sec', 'LEFT');
        $this->db->join('catalogo.provedor a', 'a.prov=t.prv', 'LEFT');
        $this->db->where('p.sec', $sec);
        $this->db->where('p.lote', $lote);
        $this->db->where('t.tipo', 'c');
        $this->db->where("date(p.fechai) between '$fecha1' and '$fecha2'", '', false);
        $query = $this->db->get();
        
        $r = $query->row();
        $susa=$r->susa1;   
        
        //echo $this->db->last_query();
        //die();
        
        $tabla = "
        <table>
        <thead>
        <tr>
        <th align=\"center\" colspan=\"11\"><font color=\"white\" size=\"+2\">".$susa."</font></th>
        </tr>
        <tr>
        <th>CLAVE</th>
        <th>LOTE</th>
        <th>CAD</th>
        <th>PIEZAS</th>
        <th>FECHA</th>
        <th>ORDEN</th>
        <th>FACTURA</th>
        <th>PROVEDOR</th>
        <th>NOMBRE</th>
        </tr>
        </thead>
        <tbody>";
        
        foreach($query->result() as $row)
        {
            $tabla.= "
            
            <tr>
            <td align=\"left\">".$row->sec."</td>
            <td align=\"right\">".$row->lote."</td>
            <td align=\"left\">".$row->cadu."</td>
            <td align=\"right\">".$row->can."</td>
            <td align=\"left\">".$row->fechai."</td>
            <td align=\"left\">".$row->orden."</td>
            <td align=\"left\">".$row->fac."</td>
            <td align=\"left\">".$row->razo."</td>
            <td align=\"left\">".$row->nombre."</td>
            </tr>
            ";
            
    $can1 = $can1 + $row->can;
    }
    
    $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"3\">TOTAL</td>
        <td align=\"right\">".number_format($can1,0)."</td>
        </tr>
        </tfoot>
        </table> 
        ";
        return $tabla;
    
    }
    
    function tabla_surtido($lote, $sec, $fecha1, $fecha2)
    {
        $can1 = null;
        
        $this->db->select('a.*, b.susa1, c.suc as sucursal, d.suc as sucursal1, c.tid, d.tid, w.nombre, x.nombre as nombre1');
        $this->db->from('desarrollo.surtido a');
        $this->db->join('catalogo.sec_unica b', 'b.sec=a.sec', 'LEFT');
        $this->db->join('catalogo.folio_pedidos_cedis c', 'a.fol=c.id', 'LEFT');
        $this->db->join('catalogo.folio_pedidos_cedis_especial d', 'a.fol=d.id', 'LEFT');
        $this->db->join('catalogo.sucursal w', 'w.suc=c.suc', 'LEFT');
        $this->db->join('catalogo.sucursal x', 'x.suc=d.suc', 'LEFT');
        $this->db->where("date(a.fecha) between '$fecha1' and '$fecha2'", '', false);
        $this->db->where('a.sec', $sec);
        $this->db->where('a.lote', $lote);
        $this->db->where('c.tid', 'C');
        $this->db->or_where('a.sec', $sec, '', false);
        $this->db->where('a.lote', $lote);
        $this->db->where('d.tid', 'C');
        $this->db->order_by('fol');
        $query = $this->db->get();
        
        $r = $query->row();
        $susa=$r->susa1;   
        
        //echo $this->db->last_query();
        //die();
        
        $tabla = "
        <table>
        <thead>
        <tr>
        <th align=\"center\" colspan=\"11\"><font color=\"white\" size=\"+2\">".$susa."</font></th>
        </tr>
        <tr>
        <th>FOLIO</th>
        <th>CLAVE</th>
        <th>CAD</th>
        <th>LOTE</th>
        <th>CANTIDAD</th>
        <th>FECHA</th>
        <th>SUCURSAL</th>
        </tr>
        </thead>
        <tbody>";
        
        foreach($query->result() as $row)
        {
            $tabla.= "
            
            <tr>
            <td align=\"left\">".$row->fol."</td>
            <td align=\"right\">".$row->sec."</td>
            <td align=\"left\">".$row->cadu."</td>
            <td align=\"left\">".$row->lote."</td>
            <td align=\"right\">".$row->can."</td>
            <td align=\"left\">".$row->fecha."</td>
            <td align=\"left\">".$row->sucursal.' '.$row->sucursal1.' '.$row->nombre.' '.$row->nombre1."</td>
            </tr>
            ";
            
    $can1 = $can1 + $row->can;
    }
    
    $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTAL</td>
        <td align=\"right\">".number_format($can1,0)."</td>
        </tr>
        </tfoot>
        </table> 
        ";
        return $tabla;
    
    }


//**************************************************************
//**************************************************************
}