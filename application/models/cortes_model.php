<?php
class Cortes_model extends CI_Model
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
    function control_plantilla()
    {
        $num=1;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
         $sql = "SELECT a.*,b.nombre as sucx,b.gere
          FROM catalogo.cat_empleado a
          left join catalogo.sucursal b on b.suc=a.succ
          where b.gere= ? and a.tipo=1 order by succ";
    
        $query = $this->db->query($sql,array($id_user));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th></th>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>Nomina</th>
        <th>Nombre</th>
        <th>Puesto</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
            
            $tabla.="
            <tr>
            
            <td align=\"left\">".$num."</td>
            <td align=\"right\">".$row->succ."</td>
            <td align=\"left\">".$row->sucx."</td>
            <td align=\"left\">".$row->nomina."</td>
            <td align=\"left\">".$row->completo."</td>
            <td align=\"left\">".$row->puestox."</td>
            </tr>
            ";
         $num=$num+1;
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
     
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control()
    {
        $num=1;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
         $sql = "SELECT a.*,d.nombre as sucx
          FROM desarrollo.cortes_c a
          left join catalogo.sucursal d on d.suc=a.suc
          where id_user= ? and tipo=1";
    
        $query = $this->db->query($sql,array($id_user));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>FECHA</th>
        <th>SUCURSAL</th>
        <th colspan=\"2\">TURNO 1</th>
        <th colspan=\"2\">TURNO 2</th>
        <th colspan=\"2\">TURNO 3</th>
        <th></th>
        <th></th>
        </tr>
        <tr>
        <th></th>
        <th></th>
        <th></th>
        <th>CAJA</th>
        <th>ARQUEO</th>
        <th>CAJA</th>
        <th>ARQUEO</th>
        <th>CAJA</th>
        <th>ARQUEO</th>
        <th>RECARGA</th>
        <th>Captura</th>
        <th>Borrar</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
            
            $l1 = anchor('cortes/tabla_detalle/'.$row->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));
            $l2 = anchor('cortes/delete_c/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            
            <td align=\"left\">".$num."</td>
            <td align=\"right\">".$row->fechacorte."</td>
            <td align=\"left\">".$row->sucx."(".$row->suc.")</td>
            <td align=\"left\">".number_format($row->turno1_corte,2)."</td>
            <td align=\"left\">".number_format($row->turno1_pesos+$row->turno1_asalto +$row->turno1_bbv+$row->turno1_san+$row->turno1_exp+$row->turno1_vale+($row->turno1_cambio*$row->turno1_dolar),2)."</td>
            <td align=\"left\">".number_format($row->turno2_corte,2)."</td>
            <td align=\"left\">".number_format($row->turno2_pesos+$row->turno2_asalto +$row->turno2_bbv+$row->turno2_san+$row->turno2_exp+$row->turno2_vale+($row->turno2_cambio*$row->turno2_dolar),2)."</td>
            <td align=\"left\">".number_format($row->turno3_corte,2)."</td>
            <td align=\"left\">".number_format($row->turno3_pesos+$row->turno3_asalto +$row->turno3_bbv+$row->turno3_san+$row->turno3_exp+$row->turno3_vale+($row->turno3_cambio*$row->turno3_dolar),2)."</td>
            <td align=\"left\">".number_format($row->recarga,2)."</td>
            <td align=\"right\">".$l1."</td>
             <td align=\"right\">".$l2."</td>
            
            </tr>
            ";
         $num=$num+1;
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function busca_control($id_cc)
    {
        $id_user= $this->session->userdata('id');
        $id_plaza= $this->session->userdata('id_plaza');
         $sql = "SELECT a.*,d.nombre,d.id_plaza
          FROM desarrollo.cortes_c a
          left join catalogo.sucursal d on d.suc=a.suc
          where a.id= ? and id_user= ? 
          or a.id= ? and id_cor= ? 
          or a.id= ? and d.id_plaza= ?";
        $query = $this->db->query($sql,array($id_cc,$id_user,$id_cc,$id_user,$id_cc,$id_plaza));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th COLSPAN=\"14\">SUCURSAL</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
         $arqueo1= $row->turno1_pesos + $row->turno1_bbv+$row->turno1_san+$row->turno1_exp + $row->turno1_asalto + $row->turno1_vale+ ($row->turno1_dolar*$row->turno1_cambio);  
         $arqueo2= $row->turno2_pesos + $row->turno2_bbv+$row->turno2_san+$row->turno2_exp + $row->turno2_asalto + $row->turno2_vale+ ($row->turno2_dolar*$row->turno2_cambio);
         $arqueo3= $row->turno3_pesos + $row->turno3_bbv+$row->turno3_san+$row->turno3_exp + $row->turno3_asalto + $row->turno3_vale+ ($row->turno3_dolar*$row->turno3_cambio);
            $tabla.="
            <tr>
            <td align=\"left\" colspan=\"14\" >".$row->suc." ".$row->nombre.
            "___<strong> CAJA </strong>".$row->caja.
            "___<strong>  FECHA  : </strong>".$row->fechacorte. 
            "___<strong>  Folio 1: </strong>".$row->turno1_folio1." - ".$row->turno1_folio2.
            "___<strong>  Folio 2: </strong>".$row->turno2_folio1." - ".$row->turno2_folio2.
            "___<strong>  Folio 3: </strong>".$row->turno3_folio1." - ".$row->turno3_folio2."</td>
            </tr>
            <tr>
             <th align=\"center\">Turno</th>
            <th align=\"center\">M.N</th>
            <th align=\"center\">Dolar</th>
            <th align=\"center\">T.Cambio</th>
            <th align=\"center\">Equiv.M.N</th>
            <th align=\"center\">T.BBV</th>
            <th align=\"center\">T.SAN</th>
            <th align=\"center\">T.EXP</th>
            <th align=\"center\">Asalto</th>
            <th align=\"center\">Vales</th>
            <th align=\"center\">Arqueo</th>
            <th align=\"center\">Caja</th>
            <th align=\"center\">Fal.</th>
            <th align=\"center\">Sob.</th>
            </tr>
            <tr>
            <th>1</th>
            <td align=\"right\">".number_format($row->turno1_pesos,2)."</td>
            <td align=\"right\">".$row->turno1_dolar."</td>
            <td align=\"right\">".number_format($row->turno1_cambio,2)."</td>
            <td align=\"right\">".number_format($row->turno1_dolar*$row->turno1_cambio,2)."</td>
            <td align=\"right\">".number_format($row->turno1_bbv,2)."</td>
            <td align=\"right\">".number_format($row->turno1_san,2)."</td>
            <td align=\"right\">".number_format($row->turno1_exp,2)."</td>
            <td align=\"right\">".number_format($row->turno1_asalto,2)."</td>
            <td align=\"right\">".number_format($row->turno1_vale,2)."</td>
            <td align=\"right\">".number_format($arqueo1,2)."</td>
            <td align=\"right\"><div id=\"corte1\">".$row->turno1_corte."</div></td>
            <td align=\"right\">".number_format($row->turno1_fal,2)."</td>
            <td align=\"right\">".number_format($row->turno1_sob,2)."</td>
            
            </tr>
            <tr>
            <th>2</th>
            <td align=\"right\">".number_format($row->turno2_pesos,2)."</td>
            <td align=\"right\">".$row->turno2_dolar."</td>
            <td align=\"right\">".number_format($row->turno2_cambio,2)."</td>
            <td align=\"right\">".number_format($row->turno2_dolar * $row->turno2_cambio,2)."</td>
            <td align=\"right\">".number_format($row->turno2_bbv,2)."</td>
            <td align=\"right\">".number_format($row->turno2_san,2)."</td>
            <td align=\"right\">".number_format($row->turno2_exp,2)."</td>
            <td align=\"right\">".number_format($row->turno2_asalto,2)."</td>
            <td align=\"right\">".number_format($row->turno2_vale,2)."</td>
            <td align=\"right\">".number_format($arqueo2,2)."</td>
            <td align=\"right\"><div id=\"corte2\">".$row->turno2_corte."</div></td>
            <td align=\"right\">".number_format($row->turno2_fal,2)."</td>
            <td align=\"right\">".number_format($row->turno2_sob,2)."</td>
            </tr>
            <tr>
            <th>3</th>
            <td align=\"right\">".number_format($row->turno3_pesos,2)."</td>
            <td align=\"right\">".$row->turno3_dolar."</td>
            <td align=\"right\">".number_format($row->turno3_cambio,2)."</td>
            <td align=\"right\">".number_format($row->turno3_dolar * $row->turno3_cambio,2)."</td>
            <td align=z\"right\">".number_format($row->turno3_bbv,2)."</td>
            <td align=\"right\">".number_format($row->turno3_san,2)."</td>
            <td align=\"right\">".number_format($row->turno3_exp,2)."</td>
            <td align=\"right\">".number_format($row->turno3_asalto,2)."</td>
            <td align=\"right\">".number_format($row->turno3_vale,2)."</td>
            <td align=\"right\">".number_format($arqueo3,2)."</td>
            <td align=\"right\"><div id=\"corte3\">".$row->turno3_corte."</div></td>
            <td align=\"right\">".number_format($row->turno3_fal,2)."</td>
            <td align=\"right\">".number_format($row->turno3_sob,2)."</td>
            </tr>
            ";
        $pesos=$row->turno3_pesos+$row->turno2_pesos+$row->turno1_pesos;
        $dolar=$row->turno3_dolar+$row->turno2_dolar+$row->turno1_dolar;
        $cambio=$row->turno3_cambio+$row->turno2_cambio+$row->turno1_cambio;
        $mn=($row->turno3_dolar * $row->turno3_cambio)+($row->turno2_dolar * $row->turno2_cambio)+($row->turno1_dolar * $row->turno1_cambio);
        $bbv=$row->turno1_bbv+$row->turno2_bbv+$row->turno3_bbv;
        $san=$row->turno1_san+$row->turno2_san+$row->turno3_san;
        $exp=$row->turno1_exp+$row->turno2_exp+$row->turno3_exp;
        
        $vale=$row->turno3_vale+$row->turno2_vale+$row->turno1_vale;
        $asalto=$row->turno3_asalto+$row->turno2_asalto+$row->turno1_asalto;
        $arqueo=$arqueo1+$arqueo2+$arqueo3;
        $cortes=$row->turno3_corte+$row->turno2_corte+$row->turno1_corte;
        $fal=$row->turno1_fal+$row->turno2_fal+$row->turno3_fal;
        $sob=$row->turno1_sob+$row->turno2_sob+$row->turno3_sob;
        }
        $tabla.="
        <tr>
        <td align=\"right\"><strong>TOTAL</strong></td>
        <td align=\"right\"><strong>".number_format($pesos,2)."</strong></td>
        <td align=\"right\"><strong>".number_format($dolar,2)."</strong></td>
        <td align=\"right\"><strong>".number_format($cambio,2)."</strong></td>
        <td align=\"right\"><strong>".number_format($mn,2)."</strong></td>
        <td align=\"right\"><strong>".number_format($bbv,2)."</strong></td>
        <td align=\"right\"><strong>".number_format($san,2)."</strong></td>
        <td align=\"right\"><strong>".number_format($exp,2)."</strong></td>
        <td align=\"right\"><strong>".number_format($asalto,2)."</strong></td>
        <td align=\"right\"><strong>".number_format($vale,2)."</strong></td>
        <td align=\"right\"><strong>".number_format($arqueo,2)."</strong></td>
        <td align=\"right\"><strong>".number_format($cortes,2)."</strong></td>
        <td align=\"right\"><strong>".number_format($fal,2)."</strong></td>
        <td align=\"right\"><strong>".number_format($sob,2)."</strong></td>
        </tr>
        </tbody>
        </table>";
        return $tabla;
    }



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function busca_detalle($id_cc,$clave)
    {
        $id_user= $this->session->userdata('id');
         $sql = "SELECT a.*
          FROM desarrollo.cortes_d a
          where a.id_cc= ? and clave1= ?";
        $query = $this->db->query($sql,array($id_cc,$clave));
        return $query; 
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function busca_iva($id_cc)
    {
        $id_user= $this->session->userdata('id');
         $sql = "SELECT a.*, b.iva+1 as iva, b.nombre
          FROM desarrollo.cortes_c a
          left join catalogo.sucursal b on b.suc=a.suc 
          where a.id= ? ";
        $query = $this->db->query($sql,array($id_cc));
        return $query; 
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function create_member_c($suc,$fechac,$recarga,$vta)
	{
	  $id_user= $this->session->userdata('id');
      $id_plaza= $this->session->userdata('id_plaza');  
if($recarga==null){$recarga=0;}
 $sql = "SELECT * FROM desarrollo.cortes_c where suc = ? and fechacorte = ? ";
 $query = $this->db->query($sql,array($suc,$fechac));
 if($query->num_rows()== 0){
 
 if($suc>0){
    $sql21 = "SELECT * FROM catalogo.sucursal where suc = ? ";
        $query21 = $this->db->query($sql21,array($suc));
        $row21= $query21->row();
        $cia=$row21->cia;
        $plaza=$row21->plaza;
        $succ=$row21->suc_contable;
        $gere=$row21->gere;
        $caja=1;
	    $new_member_insert_data = array(
        	'fechacorte' => $fechac,
            'suc' => $suc,
            'vta_tot' => $vta,
            'tipo' => 1,
            'id_user' => $this->session->userdata('id'),
            'cia'=>$cia,
            'plaza'=>$plaza,
            'succ'=>$succ,
            'recarga'=>$recarga,
            'id_cor'=>$gere,
            'fecha'=>  date('Y-m-d'),
            'tsuc'=>$row21->tipo2,
            'id_plaza'=>$id_plaza
 		);
		
		$insert = $this->db->insert('desarrollo.cortes_c', $new_member_insert_data);
        $id_cc= $this->db->insert_id();
   redirect('cortes/tabla_detalle/'.$id_cc);
}
}else{
redirect('cortes/tabla_control');    
}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//*****************************************************//*****************************************************
//*****************************************************//*****************************************************
function create_member_d($id_cc,$l1,$l2,$l4,$l5,$l8,$l9,$l10,$l11,$l12,$l13,$l16,$l19,$l20,$l21,$l22,$l23,$l24,$l30,$l40,
        $l1a,$l2a,$l4a,$l5a,$l8a,$l9a,$l10a,$l11a,$l12a,$l13a,$l16a,$l19a,$l20a,$l21a,$l22a,$l23a,$l24a,$l30a,$l40a,
        $l1c,$l2c,$l4c,$l5c,$l8c,$l9c,$l10c,$l11c,$l12c,$l13c,$l16c,$l19c,$l20c,$l21c,$l22c,$l23c,$l24c,$l30c,$l40c,
        $turno1_pesos,$turno1_dolar,$turno1_cambio,$turno1_bbv,$turno1_san,$turno1_exp,$turno1_asalto,$turno1_vale,$turno1_cajera,$turno1_corte,
        $turno2_pesos,$turno2_dolar,$turno2_cambio,$turno2_bbv,$turno2_san,$turno2_exp,$turno2_asalto,$turno2_vale,$turno2_cajera,$turno2_corte,  
        $turno3_pesos,$turno3_dolar,$turno3_cambio,$turno3_bbv,$turno3_san,$turno3_exp,$turno3_asalto,$turno3_vale,$turno3_cajera,$turno3_corte,
        $turno4_pesos,$turno4_dolar,$turno4_cambio,$turno4_bbv,$turno4_san,$turno4_exp,$turno4_asalto,$turno4_vale,$turno4_cajera,$turno4_corte)
	{

$id_user= $this->session->userdata('id');
$id_plaza= $this->session->userdata('id_plaza');
$subtotal=$l2+$l5+$l9+$l11+$l19+$l20+$l21;
if($subtotal>0){
 $sql = "SELECT a.*,b.iva ,b.id_plaza
 FROM desarrollo.cortes_c a
 left join catalogo.sucursal b on b.suc=a.suc 
 where a.id = ? and a.tipo=1";
 $query = $this->db->query($sql,array($id_cc));   
if($query->num_rows()== 1){
$row= $query->row();
$ivaa=$row->iva+1;
$id_plaza=$row->id_plaza;
$iva=$subtotal-($subtotal/($row->iva+1));
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>49,'venta'=>$iva,'corregido' =>$iva,'fecha'=> date('Y-m-d'),'tipo'=>3
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}
}
	   
if($l1>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>1, 'corregido'=>$l1,'venta' =>$l1-$l1a+$l1c,'fecha'=> date('Y-m-d'),'aumento' =>$l1a,'cancel' =>$l1c,'tipo'=>3,'siniva'=>$l1
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}

if($l2>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>2, 'corregido'=>$l2,'venta' =>$l2-$l2a+$l2c,'fecha'=>date('Y-m-d'),'aumento' =>$l2a,'cancel' =>$l2c,'tipo'=>3,'siniva'=>($l2)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}

if($l4>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>4, 'corregido'=>$l4,'venta' =>$l4-$l4a+$l4c,'fecha'=>date('Y-m-d'),'aumento' =>$l4a,'cancel' =>$l4c,'tipo'=>3,'siniva'=>$l4
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}
    
if($l5>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>5, 'corregido'=>$l5,'venta' =>$l5-$l5a+$l5c,'fecha'=>date('Y-m-d'),'aumento' =>$l5a,'cancel' =>$l5c,'tipo'=>3,'siniva'=>($l5)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}
    
if($l8>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>8, 'corregido'=>$l8,'venta' =>$l8-$l8a+$l8c,'fecha'=>date('Y-m-d'),'aumento' =>$l8a,'cancel' =>$l8c,'tipo'=>3,'siniva'=>$l8
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}
    
if($l9>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>9, 'corregido'=>$l9,'venta' =>$l9-$l9a+$l9c,'fecha'=>date('Y-m-d'),'aumento' =>$l9a,'cancel' =>$l9c,'tipo'=>3,'siniva'=>($l9)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}

if($l10>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>10, 'corregido'=>$l10,'venta' =>$l10-$l10a+$l10c,'fecha'=>date('Y-m-d'),'aumento' =>$l10a,'cancel' =>$l10c,'tipo'=>3,'siniva'=>$l10
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}

if($l11>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>11, 'corregido'=>$l11,'venta' =>$l11-$l11a+$l11c,'fecha'=>date('Y-m-d'),'aumento' =>$l11a,'cancel' =>$l11c,'tipo'=>3,'siniva'=>($l11)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}

if($l12>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>12, 'corregido'=>$l12,'venta' =>$l12-$l12a+$l12c,'fecha'=>date('Y-m-d'),'aumento' =>$l12a,'cancel' =>$l12c,'tipo'=>3,'siniva'=>$l12
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}

if($l13>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>13, 'corregido'=>$l13,'venta' =>$l13-$l13a+$l13c,'fecha'=>date('Y-m-d'),'aumento' =>$l13a,'cancel' =>$l13c,'tipo'=>3,'siniva'=>$l13
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}

if($l16>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>16, 'corregido'=>$l16,'venta' =>$l16-$l16a+$l16c,'fecha'=>date('Y-m-d'),'aumento' =>$l16a,'cancel' =>$l16c,'tipo'=>3,'siniva'=>$l16
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}

if($l19>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>19, 'corregido'=>$l19,'venta' =>$l19-$l19a+$l19c,'fecha'=>date('Y-m-d'),'aumento' =>$l19a,'cancel' =>$l19c,'tipo'=>3,'siniva'=>($l19)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}

if($l20>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>20, 'corregido'=>$l20,'venta' =>$l20-$l20a+$l20c,'fecha'=>date('Y-m-d'),'aumento' =>$l20a,'cancel' =>$l20c,'tipo'=>3,'siniva'=>($l20)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}

if($l21>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>21, 'corregido'=>$l21,'venta' =>$l21-$l21a+$l21c,'fecha'=>date('Y-m-d'),'aumento' =>$l21a,'cancel' =>$l21c,'tipo'=>3,'siniva'=>($l21)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}

if($l22>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>22, 'corregido'=>$l22,'venta' =>$l22-$l22a+$l22c,'fecha'=>date('Y-m-d'),'aumento' =>$l22a,'cancel' =>$l22c,'tipo'=>3,'siniva'=>$l22
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}

if($l23>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>23, 'corregido'=>$l23,'venta' =>$l23-$l23a+$l23c,'fecha'=>date('Y-m-d'),'aumento' =>$l23a,'cancel' =>$l23c,'tipo'=>3,'siniva'=>$l23
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}

if($l24>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>24, 'corregido'=>$l24,'venta' =>$l24-$l24a+$l24c,'fecha'=>date('Y-m-d'),'aumento' =>$l24a,'cancel' =>$l24c,'tipo'=>3,'siniva'=>$l24
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}


if($l30>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>30, 'corregido'=>$l30,'venta' =>$l30-$l30a+$l30c,'fecha'=>date('Y-m-d'),'aumento' =>$l30a,'cancel' =>$l30c,'tipo'=>3,'siniva'=>$l30
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}

if($l40>0){$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>40, 'corregido'=>$l40,'venta' =>$l40-$l40a+$l40c,'fecha'=>date('Y-m-d'),'aumento' =>$l40a,'cancel' =>$l40c,'tipo'=>3,'siniva'=>$l40
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);}

$mn1=round(($turno1_dolar*$turno1_cambio),2);
$mn2=round(($turno2_dolar*$turno2_cambio),2);
$mn3=round(($turno3_dolar*$turno3_cambio),2);
$mn4=round(($turno4_dolar*$turno4_cambio),2);
$arqueo1=$turno1_pesos+$turno1_bbv+$turno1_san+$turno1_exp+$turno1_asalto+$turno1_vale+$mn1;
$arqueo2=$turno2_pesos+$turno2_bbv+$turno2_san+$turno2_exp+$turno2_asalto+$turno2_vale+$mn2;
$arqueo3=$turno3_pesos+$turno3_bbv+$turno3_san+$turno3_exp+$turno3_asalto+$turno3_vale+$mn3;
$arqueo4=$turno4_pesos+$turno4_bbv+$turno4_san+$turno4_exp+$turno4_asalto+$turno4_vale+$mn4;

if($arqueo1>$turno1_corte){$sob1=$arqueo1-$turno1_corte; $fal1=0;}else{$fal1=$turno1_corte-$arqueo1; $sob1=0;}
if($arqueo2>$turno2_corte){$sob2=$arqueo2-$turno2_corte; $fal2=0;}else{$fal2=$turno2_corte-$arqueo2; $sob2=0;}
if($arqueo3>$turno3_corte){$sob3=$arqueo3-$turno3_corte; $fal3=0;}else{$fal3=$turno3_corte-$arqueo3; $sob3=0;}
if($arqueo4>$turno4_corte){$sob4=$arqueo4-$turno4_corte; $fal4=0;}else{$fal4=$turno4_corte-$arqueo4; $sob4=0;}


$data = array(
            'turno1_pesos'   =>$turno1_pesos,  
            'turno1_dolar'   =>$turno1_dolar,  
            'turno1_cambio'  =>$turno1_cambio,
            'turno1_bbv'     =>$turno1_bbv,
            'turno1_san'     =>$turno1_san,
            'turno1_exp'     =>$turno1_exp,
            'turno1_asalto'  =>$turno1_asalto,
            'turno1_vale'    =>$turno1_vale,
            'turno1_cajera'  =>$turno1_cajera,
            'turno1_corte'   =>$turno1_corte,
            'turno1_sob'     =>$sob1,
            'turno1_fal'     =>$fal1,
            'turno1_mn'      =>$mn1,
            
            'turno2_pesos'   =>$turno2_pesos,
            'turno2_dolar'   =>$turno2_dolar,
            'turno2_cambio'  =>$turno2_cambio,
            'turno2_bbv'     =>$turno2_bbv,
            'turno2_san'     =>$turno2_san,
            'turno2_exp'     =>$turno2_exp,
            'turno2_asalto'  =>$turno2_asalto,
            'turno2_vale'    =>$turno2_vale,
            'turno2_cajera'  =>$turno2_cajera,
            'turno2_corte'   =>$turno2_corte,
            'turno2_sob'     =>$sob2,
            'turno2_fal'     =>$fal2,
            'turno2_mn'      =>$mn2,
            
            'turno3_pesos'   =>$turno3_pesos,
            'turno3_dolar'   =>$turno3_dolar,
            'turno3_cambio'  =>$turno3_cambio,
            'turno3_bbv'     =>$turno3_bbv,
            'turno3_san'     =>$turno3_san,
            'turno3_exp'     =>$turno3_exp,
            'turno3_asalto'  =>$turno3_asalto,
            'turno3_vale'    =>$turno3_vale,
            'turno3_cajera'  =>$turno3_cajera,
            'turno3_corte'   =>$turno3_corte,
            'turno3_sob'     =>$sob3,
            'turno3_fal'     =>$fal3,
            'turno3_mn'      =>$mn3,
            
            'turno4_pesos'   =>$turno4_pesos,
            'turno4_dolar'   =>$turno4_dolar,
            'turno4_cambio'  =>$turno4_cambio,
            'turno4_bbv'     =>$turno4_bbv,
            'turno4_san'     =>$turno4_san,
            'turno4_exp'     =>$turno4_exp,
            'turno4_asalto'  =>$turno4_asalto,
            'turno4_vale'    =>$turno4_vale,
            'turno4_cajera'  =>$turno4_cajera,
            'turno4_corte'   =>$turno4_corte,
            'turno4_sob'     =>$sob4,
            'turno4_fal'     =>$fal4,
            'turno4_mn'      =>$mn4,
            'id_plaza'      =>$id_plaza,
            'tipo' => 3,
            
			'fecha'=> date('Y-m-d H:s:i')
		);
		
		$this->db->where('id', $id_cc);
        $this->db->update('cortes_c', $data);
        //*******************************************************************************faltante
        //*******************************************************************************faltante
        //*******************************************************************************faltante
       //*******************************************************************************faltante
        //*******************************************************************************faltante
        //*******************************************************************************faltante

 $sqlz1 = "SELECT a.* FROM desarrollo.cortes_c a where a.id =$id_cc and a.tipo>2";
 $queryz1 = $this->db->query($sqlz1);
 if($queryz1->num_rows()> 0){
 $rowz1= $queryz1->row();
  
 $tsuc=$rowz1->tsuc;
 $id_plazaa=$rowz1->id_plaza;

//fecha, corte, nomina, turno, fal, id_cor, id_user, suc, plaza, cia, cianom, plazanom
 
        //*******************************************************************************faltante
if($fal1>2.99){
 $sqlz2 = "SELECT a.* FROM catalogo.cat_empleado a where  nomina=$rowz1->turno1_cajera and id_user=$id_user;";
 $queryz2 = $this->db->query($sqlz2);
 if($queryz2->num_rows()> 0){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 $succ=$rowz2->succ;
 }else{$plazanom=0;$cianom=0;}   
$dataz= array(
            'fecha'   =>$rowz1->fechacorte,  
            'corte'   =>$id_cc,  
            'nomina'  =>$rowz1->turno1_cajera,
            'turno'   =>1,
            'fal'     =>$fal1,
            'id_cor'  =>$rowz1->id_cor,
            'id_user' =>$rowz1->id_user,
            'suc'    =>$rowz1->suc,
            'plaza'  =>$rowz1->plaza,
            'cia' =>$rowz1->cia,
            'plazanom'  =>$plazanom,
            'clave'  =>520,
            'id_plaza'=>$id_plazaa,
            'cianom' =>$cianom
            );
$insert = $this->db->insert('desarrollo.fal_c', $dataz);
}
if($fal2>2.99){
 $sqlz2 = "SELECT a.* FROM catalogo.cat_empleado a where  nomina=$rowz1->turno2_cajera and id_user=$id_user";
 $queryz2 = $this->db->query($sqlz2);
 if($queryz2->num_rows()> 0){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 }else{$cianom=0;$plazanom=0;}  
$dataz= array(
            'fecha'   =>$rowz1->fechacorte,  
            'corte'   =>$id_cc,  
            'nomina'  =>$rowz1->turno2_cajera,
            'turno'   =>2,
            'fal'     =>$fal2,
            'id_cor'  =>$rowz1->id_cor,
            'id_user' =>$rowz1->id_user,
            'suc'    =>$rowz1->suc,
            'plaza'  =>$rowz1->plaza,
            'cia' =>$rowz1->cia,
            'plazanom'  =>$plazanom,
            'clave'  =>520,
            'id_plaza'=>$id_plazaa,
            'cianom' =>$cianom
            );
$insert = $this->db->insert('desarrollo.fal_c', $dataz);
}
if($fal3>2.99){
 $sqlz2 = "SELECT a.* FROM catalogo.cat_empleado a where  nomina=$rowz1->turno3_cajera and id_user=$id_user";
 $queryz2 = $this->db->query($sqlz2);
 if($queryz2->num_rows()> 0){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 }else{$cianom=0;$plazanom=0;}  
$dataz= array(
            'fecha'   =>$rowz1->fechacorte,  
            'corte'   =>$id_cc,  
            'nomina'  =>$rowz1->turno3_cajera,
            'turno'   =>3,
            'fal'     =>$fal3,
            'id_cor'  =>$rowz1->id_cor,
            'id_user' =>$rowz1->id_user,
            'suc'    =>$rowz1->suc,
            'plaza'  =>$rowz1->plaza,
            'cia' =>$rowz1->cia,
            'plazanom'  =>$plazanom,
            'clave'  =>520,
            'id_plaza'=>$id_plazaa,
            'cianom' =>$cianom
            );
$insert = $this->db->insert('desarrollo.fal_c', $dataz);
}
if($fal4>2.99){
 $sqlz2 = "SELECT a.* FROM catalogo.cat_empleado a where  nomina=$rowz1->turno4_cajera and id_user=$id_user";
 $queryz2 = $this->db->query($sqlz2);
 if($queryz2->num_rows()> 0){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 }else{$cianom=0;$plazanom=0;}  
$dataz= array(
            'fecha'   =>$rowz1->fechacorte,  
            'corte'   =>$id_cc,  
            'nomina'  =>$rowz1->turno4_cajera,
            'turno'   =>4,
            'fal'     =>$fal4,
            'id_cor'  =>$rowz1->id_cor,
            'id_user' =>$rowz1->id_user,
            'suc'    =>$rowz1->suc,
            'plaza'  =>$rowz1->plaza,
            'cia' =>$rowz1->cia,
            'plazanom'  =>$plazanom,
            'clave'  =>520,
            'id_plaza'=>$id_plazaa,
            'cianom' =>$cianom
            );
$insert = $this->db->insert('desarrollo.fal_c', $dataz);
}
        //*******************************************************************************faltante
}       
        //*******************************************************************************faltante
        //*******************************************************************************faltante
        //*******************************************************************************faltante

}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function update_member_d($id_cc,$l1,$l2,$l4,$l5,$l8,$l9,$l10,$l11,$l12,$l13,$l16,$l19,$l20,$l21,$l22,$l23,$l24,$l30,$l40,
$la1,$la2,$la4,$la5,$la8,$la9,$la10,$la11,$la12,$la13,$la16,$la19,$la20,$la21,$la22,$la23,$la24,$la30,$la40,
$lc1,$lc2,$lc4,$lc5,$lc8,$lc9,$lc10,$lc11,$lc12,$lc13,$lc16,$lc19,$lc20,$lc21,$lc22,$lc23,$lc24,$lc30,$lc40,
        $turno1_pesos,$turno1_dolar,$turno1_cambio,$turno1_bbv,$turno1_san,$turno1_exp,$turno1_asalto,$turno1_vale,$turno1_cajera,$turno1_corte,
        $turno2_pesos,$turno2_dolar,$turno2_cambio,$turno2_bbv,$turno2_san,$turno2_exp,$turno2_asalto,$turno2_vale,$turno2_cajera,$turno2_corte,  
        $turno3_pesos,$turno3_dolar,$turno3_cambio,$turno3_bbv,$turno3_san,$turno3_exp,$turno3_asalto,$turno3_vale,$turno3_cajera,$turno3_corte,
        $turno4_pesos,$turno4_dolar,$turno4_cambio,$turno4_bbv,$turno4_san,$turno4_exp,$turno4_asalto,$turno4_vale,$turno4_cajera,$turno4_corte,$ivaa,$recarga)
	{
 $id_user= $this->session->userdata('id');
 $id_plaza= $this->session->userdata('id_plaza');
///////////////////////////////////////////////////*****************
if($l1>0 || $la1>0 || $lc1>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=1 and  a.tipo=2";
 $queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>1,'venta'=>$l1,'corregido' =>$l1+$la1-$lc1,'fecha'=> date('Y-m-d'),'cancel'=>$lc1,'aumento'=>$la1,'tipo'=>3,'siniva'=>($l1+$la1-$lc1)
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l1,'aumento' => $la1,'cancel' => $lc1,'corregido' => $l1+$la1-$lc1,'tipo'=>3,'siniva'=>($l1+$la1-$lc1));
		$this->db->where('clave1', 1);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 1);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

if($l2>0 || $la2>0 || $lc2>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=2 and  a.tipo=2";
 $queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
    $new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>2, 'venta'=>$l2,'corregido' =>$l2+$la2-$lc2,'fecha'=>date('Y-m-d'),'cancel'=>$lc2,'aumento'=>$la2,'tipo'=>3,'siniva'=>($l2+$la2-$lc2)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l2,'aumento' => $la2,'cancel' => $lc2,'corregido' => $l2+$la2-$lc2,'tipo'=>3,'siniva'=>($l2+$la2-$lc2)/$ivaa);
		$this->db->where('clave1', 2);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 2);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

if($l4>0 || $la4>0 || $lc4>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=4 and  a.tipo=2";
 $queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>4, 'venta'=>$l4,'corregido' =>$l4+$la4-$lc4,'fecha'=>date('Y-m-d'),'cancel'=>$lc4,'aumento'=>$la4,'tipo'=>3,'siniva'=>($l4+$la4-$lc4)
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l4,'aumento' => $la4,'cancel' => $lc4,'corregido' => $l4+$la4-$lc4,'tipo'=>3,'siniva'=>($l4+$la4-$lc4));
		$this->db->where('clave1', 4);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 4);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
    
if($l5>0 || $la5>0 || $lc5>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=5 and  a.tipo=2";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
    $new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>5, 'venta'=>$l5,'corregido' =>$l5+$la5-$lc5,'fecha'=>date('Y-m-d'),'cancel'=>$lc5,'aumento'=>$la5,'tipo'=>3,'siniva'=>($l5+$la5-$lc5)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l5,'aumento' => $la5,'cancel' => $lc5,'corregido' => $l5+$la5-$lc5,'tipo'=>3,'siniva'=>($l5+$la5-$lc5)/$ivaa);
		$this->db->where('clave1', 5);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 5);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
    
if($l8>0 || $la8>0 || $lc8>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=8 and  a.tipo=2";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>8, 'venta'=>$l8,'corregido' =>$l8+$la8-$lc8,'fecha'=>date('Y-m-d'),'cancel'=>$lc8,'aumento'=>$la8,'tipo'=>3,'siniva'=>($l8+$la8-$lc8)
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l8,'aumento' => $la8,'cancel' => $lc8,'corregido' => $l8+$la8-$lc8,'tipo'=>3,'siniva'=>($l8+$la8-$lc8));
		$this->db->where('clave1', 8);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 8);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
    
if($l9>0 || $la9>0 || $lc9>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=9 and  a.tipo=2";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>9, 'venta'=>$l9,'corregido' =>$l9+$la9-$lc9,'fecha'=>date('Y-m-d'),'cancel'=>$lc9,'aumento'=>$la9,'tipo'=>3,'siniva'=>($l9+$la9-$lc9)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l9,'aumento' => $la9,'cancel' => $lc9,'corregido' => $l9+$la9-$lc9,'tipo'=>3,'siniva'=>($l9+$la9-$lc9)/$ivaa);
		$this->db->where('clave1', 9);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 9);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

if($l10>0 || $la10>0 || $lc10>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=10 and  a.tipo=2";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>10, 'venta'=>$l10,'corregido' =>$l10+$la10-$lc10,'fecha'=>date('Y-m-d'),'cancel'=>$lc10,'aumento'=>$la10,'tipo'=>3,'siniva'=>($l10+$la10-$lc10)
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l10,'aumento' => $la10,'cancel' => $lc10,'corregido' => $l10+$la10-$lc10,'tipo'=>3,'siniva'=>($l10+$la10-$lc10));
		$this->db->where('clave1', 10);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 10);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

if($l11>0 || $la11>0 || $lc11>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=11 and  a.tipo=2";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>11, 'venta'=>$l11,'corregido' =>$l11+$la11-$lc11,'fecha'=>date('Y-m-d'),'cancel'=>$lc11,'aumento'=>$la11,'tipo'=>3,'siniva'=>($l11+$la11-$lc11)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l11,'aumento' => $la11,'cancel' => $lc11,'corregido' => $l11+$la11-$lc11,'tipo'=>3,'siniva'=>($l11+$la11-$lc11)/$ivaa);
		$this->db->where('clave1', 11);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 11);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

if($l12>0 || $la12>0 || $lc12>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=12 and  a.tipo=2";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>12, 'venta'=>$l12,'corregido' =>$l12+$la12-$lc12,'fecha'=>date('Y-m-d'),'cancel'=>$lc12,'aumento'=>$la12,'tipo'=>3,'siniva'=>($l12+$la12-$lc12)
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l12,'aumento' => $la12,'cancel' => $lc12,'corregido' => $l12+$la12-$lc12,'tipo'=>3,'siniva'=>($l12+$la12-$lc12));
		$this->db->where('clave1', 12);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 12);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

if($l13>0 || $la13>0 || $lc13>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=13 and  a.tipo=2";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>13, 'venta'=>$l13,'corregido' =>$l13+$la13-$lc13,'fecha'=>date('Y-m-d'),'cancel'=>$lc13,'aumento'=>$la13,'tipo'=>3,'siniva'=>($l13+$la13-$lc13)
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
 $dataa = array('venta' => $l13,'aumento' => $la13,'cancel' => $lc13,'corregido' => $l13+$la13-$lc13,'tipo'=>3,'siniva'=>($l13+$la13-$lc13));
		$this->db->where('clave1', 13);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 13);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

if($l16>0 || $la16>0 || $lc16>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=16 and  a.tipo=2";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>16, 'venta'=>$l16,'corregido' =>$l16+$la16-$lc16,'fecha'=>date('Y-m-d'),'cancel'=>$lc16,'aumento'=>$la16,'tipo'=>3,'siniva'=>($l16+$la16-$lc16)
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l16,'aumento' => $la16,'cancel' => $lc16,'corregido' => $l16+$la16-$lc16,'tipo'=>3,'siniva'=>($l16+$la16-$lc16));
		$this->db->where('clave1', 16);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 16);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

if($l19>0 || $la19>0 || $lc19>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=19 and  a.tipo=2";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>19, 'venta'=>$l19,'corregido' =>$l19+$la19-$lc19,'fecha'=>date('Y-m-d'),'cancel'=>$lc19,'aumento'=>$la19,'tipo'=>3,'siniva'=>($l19+$la19-$lc19)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
 $dataa = array('venta' => $l19,'aumento' => $la19,'cancel' => $lc19,'corregido' => $l19+$la19-$lc19,'tipo'=>3,'siniva'=>($l19+$la19-$lc19)/$ivaa);
		$this->db->where('clave1', 19);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 19);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

if($l20>0 || $lc20>0 || $la20>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=20 and  a.tipo=2";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=> 20, 'venta'=>$l20,'corregido' =>$l20+$la20-$lc20,'fecha'=>date('Y-m-d'),'cancel'=>$lc20,'aumento'=>$la20,'tipo'=>3,'siniva'=>($l20+$la20-$lc20)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
 $dataa = array('venta' => $l20,'aumento' => $la20,'cancel' => $lc20,'corregido' => $l20+$la20-$lc20,'tipo'=>3,'siniva'=>($l20+$la20-$lc20)/$ivaa);
		$this->db->where('clave1', 20);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 20);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

if($l21>0 || $la21>0 || $lc21>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=21 and  a.tipo=2";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>21, 'venta'=>$l21,'corregido' =>$l21+$la21-$lc21,'fecha'=>date('Y-m-d'),'cancel'=>$lc21,'aumento'=>$la21,'tipo'=>3,'siniva'=>($l21+$la21-$lc21)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l21,'aumento' => $la21,'cancel' => $lc21,'corregido' => $l21+$la21-$lc21,'tipo'=>3,'siniva'=>($l21+$la21-$lc21)/$ivaa);
		$this->db->where('clave1', 21);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 21);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

if($l22>0 || $la22>0 || $lc22>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=22 and  a.tipo=2";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>22, 'venta'=>$l22,'corregido' =>$l22+$la22-$lc22,'fecha'=>date('Y-m-d'),'cancel'=>$lc22,'aumento'=>$la22,'tipo'=>3,'siniva'=>($l22+$la22-$lc22)
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l22,'aumento' => $la22,'cancel' => $lc22,'corregido' => $l22+$la22-$lc22,'tipo'=>3,'siniva'=>($l22+$la22-$lc22));
		$this->db->where('clave1', 22);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 22);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

if($l23>0 || $la23>0 || $lc23>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=23 and  a.tipo=2";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>23, 'venta'=>$l23,'corregido' =>$l23+$la23-$lc23,'fecha'=>date('Y-m-d'),'cancel'=>$lc23,'aumento'=>$la23,'tipo'=>3,'siniva'=>($l23+$la23-$lc23)
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l23,'aumento' => $la23,'cancel' => $lc23,'corregido' => $l23+$la23-$lc23,'tipo'=>3,'siniva'=>($l23+$la23-$lc23));
		$this->db->where('clave1', 23);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 23);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

if($l24>0 || $la24>0 || $lc24>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=24 and  a.tipo=2";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>24, 'venta'=>$l24,'corregido' =>$l24+$la24-$lc24,'fecha'=>date('Y-m-d'),'cancel'=>$lc24,'aumento'=>$la24,'tipo'=>3,'siniva'=>($l24+$la24-$lc24)
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l24,'aumento' => $la24,'cancel' => $lc24,'corregido' => $l24+$la24-$lc24,'tipo'=>3,'siniva'=>($l24+$la24-$lc24));
		$this->db->where('clave1', 24);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 24);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

if($l30>0 || $la30>0 || $lc30>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=30 and  a.tipo=2";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>30, 'venta'=>$l30,'corregido' =>$l30+$la30-$lc30,'fecha'=>date('Y-m-d'),'cancel'=>$lc30,'aumento'=>$la30,'tipo'=>3,'siniva'=>($l30+$la30-$lc30)
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l30,'aumento' => $la30,'cancel' => $lc30,'corregido' => $l30+$la30-$lc30,'tipo'=>3,'siniva'=>($l30+$la30-$lc30));
		$this->db->where('clave1', 30);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' =>0,'tipo'=>3);
		$this->db->where('clave1', 30);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

if($l40>0 || $la40>0 || $lc40>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=40 and  a.tipo=2";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>40, 'venta'=>$l40,'corregido' =>$l40+$la40-$lc40,'fecha'=>date('Y-m-d'),'cancel'=>$lc40,'aumento'=>$la40,'tipo'=>3,'siniva'=>($l40+$la40-$lc40)
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l40,'aumento' => $la40,'cancel' => $lc40,'corregido' => $l40+$la40-$lc40,'tipo'=>3,'siniva'=>($l40+$la40-$lc40));
		$this->db->where('clave1', 40);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3);
		$this->db->where('clave1', 40);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
$subtotal=$l2+$l5+$l9+$l11+$l19+$l20+$l21+
           $la2+$la5+$la11+$la19+$la9+$la20+$la21-
           $lc2-$lc5-$lc11-$lc19-$lc9-$lc20-$lc21;
$cancel=$lc2+$lc5+$lc11+$lc19+$lc9+$lc20+$lc21;
$cancelx=$cancel-($cancel/$ivaa);
if($cancel==null){$cancel=0;$cancelx=0;}
$aumen=$la2+$la5+$la11+$la19+$la9+$la20+$la21;
$aumenx=$aumen-($aumen/$ivaa);
if($aumen==null){$aumen=0;$aumenx=0;}
///////////////////////////////////////////////////*****************

if($subtotal>0){$iva=$subtotal-($subtotal/$ivaa);}else{$subtotal=0;} 
if($subtotal>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=49 and  a.tipo=2";

 $queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){

$new_member_insert_data = array(
'id_cc'=>$id_cc,
'clave1'=>49,
'venta'=>$iva-$cancelx+$aumenx,
'cancel'=>0,
'tipo'=>3,
'aumento'=>0,
'corregido' =>$iva-$cancelx+$aumenx,
'fecha'=> date('Y-m-d'));
$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);

}else{
$dataaa = array(
'venta' => $iva-$cancelx+$aumenx,
'aumento' => 0,
'cancel' => 0,
'tipo'=>3,
'corregido' => $iva-$cancelx+$aumenx);
$this->db->where('clave1', 49);
$this->db->where('id_cc', $id_cc);
$this->db->update('cortes_d', $dataaa);
//echo $this->db->last_query();
}

}

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

$mn1=round(($turno1_dolar*$turno1_cambio),2);
$mn2=round(($turno2_dolar*$turno2_cambio),2);
$mn3=round(($turno3_dolar*$turno3_cambio),2);
$mn4=round(($turno4_dolar*$turno4_cambio),2);
$arqueo1=$turno1_pesos+$turno1_bbv+$turno1_san+$turno1_exp+$turno1_asalto+$turno1_vale+$mn1;
$arqueo2=$turno2_pesos+$turno2_bbv+$turno2_san+$turno2_exp+$turno2_asalto+$turno2_vale+$mn2;
$arqueo3=$turno3_pesos+$turno3_bbv+$turno3_san+$turno3_exp+$turno3_asalto+$turno3_vale+$mn3;
$arqueo4=$turno4_pesos+$turno4_bbv+$turno4_san+$turno4_exp+$turno4_asalto+$turno4_vale+$mn4;

if($arqueo1>$turno1_corte){$sob1=$arqueo1-$turno1_corte; $fal1=0;}else{$fal1=$turno1_corte-$arqueo1; $sob1=0;}
if($arqueo2>$turno2_corte){$sob2=$arqueo2-$turno2_corte; $fal2=0;}else{$fal2=$turno2_corte-$arqueo2; $sob2=0;}
if($arqueo3>$turno3_corte){$sob3=$arqueo3-$turno3_corte; $fal3=0;}else{$fal3=$turno3_corte-$arqueo3; $sob3=0;}
if($arqueo4>$turno4_corte){$sob4=$arqueo4-$turno4_corte; $fal4=0;}else{$fal4=$turno4_corte-$arqueo4; $sob4=0;}


$data = array(
            'turno1_pesos'   =>$turno1_pesos,  
            'turno1_dolar'   =>$turno1_dolar,  
            'turno1_cambio'  =>$turno1_cambio,
            'turno1_bbv'     =>$turno1_bbv,
            'turno1_san'     =>$turno1_san,
            'turno1_exp'     =>$turno1_exp,
            'turno1_asalto'  =>$turno1_asalto,
            'turno1_vale'    =>$turno1_vale,
            'turno1_cajera'  =>$turno1_cajera,
            'turno1_corte'   =>$turno1_corte,
            'turno1_sob'     =>$sob1,
            'turno1_fal'     =>$fal1,
            'turno1_mn'      =>$mn1,
            
            'turno2_pesos'   =>$turno2_pesos,
            'turno2_dolar'   =>$turno2_dolar,
            'turno2_cambio'  =>$turno2_cambio,
            'turno2_bbv'     =>$turno2_bbv,
            'turno2_san'     =>$turno2_san,
            'turno2_exp'     =>$turno2_exp,
            'turno2_asalto'  =>$turno2_asalto,
            'turno2_vale'    =>$turno2_vale,
            'turno2_cajera'  =>$turno2_cajera,
            'turno2_corte'   =>$turno2_corte,
            'turno2_sob'     =>$sob2,
            'turno2_fal'     =>$fal2,
            'turno2_mn'      =>$mn2,
            
            'turno3_pesos'   =>$turno3_pesos,
            'turno3_dolar'   =>$turno3_dolar,
            'turno3_cambio'  =>$turno3_cambio,
            'turno3_bbv'     =>$turno3_bbv,
            'turno3_san'     =>$turno3_san,
            'turno3_exp'     =>$turno3_exp,
            'turno3_asalto'  =>$turno3_asalto,
            'turno3_vale'    =>$turno3_vale,
            'turno3_cajera'  =>$turno3_cajera,
            'turno3_corte'   =>$turno3_corte,
            'turno3_sob'     =>$sob3,
            'turno3_fal'     =>$fal3,
            'turno3_mn'      =>$mn3,
            
            'turno4_pesos'   =>$turno4_pesos,
            'turno4_dolar'   =>$turno4_dolar,
            'turno4_cambio'  =>$turno4_cambio,
            'turno4_bbv'     =>$turno4_bbv,
            'turno4_san'     =>$turno4_san,
            'turno4_exp'     =>$turno4_exp,
            'turno4_asalto'  =>$turno4_asalto,
            'turno4_vale'    =>$turno4_vale,
            'turno4_cajera'  =>$turno4_cajera,
            'turno4_corte'   =>$turno4_corte,
            'turno4_sob'     =>$sob4,
            'turno4_fal'     =>$fal4,
            'turno4_mn'      =>$mn4,			
            'id_plaza'=>$id_plaza,
            'tipo' => 3,
            
			'fecha'=> date('Y-m-d H:s:i')
		);
		
		$this->db->where('id', $id_cc);
        $this->db->update('cortes_c', $data);

       //*******************************************************************************faltante
        //*******************************************************************************faltante
        //*******************************************************************************faltante
 $sqlz1 = "SELECT a.* FROM desarrollo.cortes_c a where a.id =$id_cc and a.tipo>=2";
 $queryz1 = $this->db->query($sqlz1);
 if($queryz1->num_rows()> 0){
 $rowz1= $queryz1->row();
 $tsuc=$rowz1->tsuc;
 $id_plazaa=$rowz1->id_plaza;

 //fecha, corte, nomina, turno, fal, id_cor, id_user, suc, plaza, cia, cianom, plazanom
///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////valida los faltantes de la prenomina que no sean tomados
if($id_cc>0){
	  $this->db->delete('fal_c',array('fecha' => $rowz1->fechacorte,'suc' => $rowz1->suc, 'turno' => 1, 'tipo' => 1));
      $this->db->delete('faltante',array('fecha' => $rowz1->fechacorte,'suc' => $rowz1->suc, 'turno' => 1, 'tipo' => 1));
      $this->db->delete('fal_c',array('fecha' => $rowz1->fechacorte,'suc' => $rowz1->suc, 'turno' => 2, 'tipo' => 1));
      $this->db->delete('faltante',array('fecha' => $rowz1->fechacorte,'suc' => $rowz1->suc, 'turno' =>2, 'tipo' => 1));
      $this->db->delete('fal_c',array('fecha' => $rowz1->fechacorte,'suc' => $rowz1->suc, 'turno' => 3, 'tipo' => 1));
      $this->db->delete('faltante',array('fecha' => $rowz1->fechacorte,'suc' => $rowz1->suc, 'turno' => 3, 'tipo' => 1));
      $this->db->delete('fal_c',array('fecha' => $rowz1->fechacorte,'suc' => $rowz1->suc, 'turno' => 4, 'tipo' => 1));
      $this->db->delete('faltante',array('fecha' => $rowz1->fechacorte,'suc' => $rowz1->suc, 'turno' => 4, 'tipo' => 1));
///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////faltantes
echo $fal1;
if($fal1>2.99){
//SELECT ifnull(b.fal,'NO')as parametro,b.turno,b.fal, b.fecha,a.* FROM catalogo.cat_empleado a
//left join fal_c b on a.nomina=b.nomina and clave=520 and fecha='2013-07-15' and turno=2
//where  a.nomina=75853
 $sqlz2 = "SELECT ifnull(b.fal,'NO')as parametro,b.turno,b.fal, b.fecha,a.* 
 FROM catalogo.cat_empleado a
left join fal_c b on a.nomina=b.nomina and b.clave=520 and b.fecha='$rowz1->fechacorte' and b.turno=1
where  a.nomina=$rowz1->turno1_cajera";

 $queryz2 = $this->db->query($sqlz2);
 if($queryz2->num_rows()> 0){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 $succ=$rowz2->succ;
 $id_plaza=$rowz2->id_plaza;
 }else{$plazanom=0;$cianom=0;$id_plaza=0;}
 if($rowz2->parametro=='NO'){   

$dataz= array(
            'fecha'   =>$rowz1->fechacorte,  
            'corte'   =>$id_cc,  
            'nomina'  =>$rowz1->turno1_cajera,
            'turno'   =>1,
            'fal'     =>$fal1,
            'id_cor'  =>$rowz1->id_cor,
            'id_user' =>$rowz1->id_user,
            'suc'    =>$rowz1->suc,
            'plaza'  =>$rowz1->plaza,
            'cia' =>$rowz1->cia,
            'plazanom'  =>$plazanom,
            'id_plaza'=>$id_plazaa,
            'clave'  =>520,
            
            'cianom' =>$cianom
            );
$insert = $this->db->insert('desarrollo.fal_c', $dataz);
}}
if($fal2>2.99){
 $sqlz2 = "SELECT ifnull(b.fal,'NO')as parametro,b.turno,b.fal, b.fecha,a.* 
 FROM catalogo.cat_empleado a
left join fal_c b on a.nomina=b.nomina and b.clave=520 and b.fecha='$rowz1->fechacorte' and b.turno=2
where  a.nomina=$rowz1->turno2_cajera";
 $queryz2 = $this->db->query($sqlz2);
 if($queryz2->num_rows()> 0){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 $id_plaza=$rowz2->id_plaza;
 }else{$cianom=0;$plazanom=0;$id_plaza=0;}
 if($rowz2->parametro=='NO'){     
$dataz= array(
            'fecha'   =>$rowz1->fechacorte,  
            'corte'   =>$id_cc,  
            'nomina'  =>$rowz1->turno2_cajera,
            'turno'   =>2,
            'fal'     =>$fal2,
            'id_cor'  =>$rowz1->id_cor,
            'id_user' =>$rowz1->id_user,
            'suc'    =>$rowz1->suc,
            'plaza'  =>$rowz1->plaza,
            'cia' =>$rowz1->cia,
            'plazanom'  =>$plazanom,
            'clave'  =>520,
            'id_plaza'=>$id_plazaa,
            'cianom' =>$cianom
            );
$insert = $this->db->insert('desarrollo.fal_c', $dataz);
}}
if($fal3>2.99){
 $sqlz2 = "SELECT ifnull(b.fal,'NO')as parametro,b.turno,b.fal, b.fecha,a.* 
 FROM catalogo.cat_empleado a
left join fal_c b on a.nomina=b.nomina and b.clave=520 and b.fecha='$rowz1->fechacorte' and b.turno=3
where  a.nomina=$rowz1->turno3_cajera";
 $queryz2 = $this->db->query($sqlz2);
 if($queryz2->num_rows()> 0){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 $id_plaza=$rowz2->id_plaza;
 }else{$cianom=0;$plazanom=0;$id_plaza=0;}
 if($rowz2->parametro=='NO'){     
$dataz= array(
            'fecha'   =>$rowz1->fechacorte,  
            'corte'   =>$id_cc,  
            'nomina'  =>$rowz1->turno3_cajera,
            'turno'   =>3,
            'fal'     =>$fal3,
            'id_cor'  =>$rowz1->id_cor,
            'id_user' =>$rowz1->id_user,
            'suc'    =>$rowz1->suc,
            'plaza'  =>$id_plaza,
            'cia' =>$rowz1->cia,
            'plazanom'  =>$plazanom,
            'clave'  =>520,
            'id_plaza'=>$id_plazaa,
            'cianom' =>$cianom
            );
$insert = $this->db->insert('desarrollo.fal_c', $dataz);
}}
if($fal4>2.99){
 $sqlz2 = "SELECT ifnull(b.fal,'NO')as parametro,b.turno,b.fal, b.fecha,a.* 
 FROM catalogo.cat_empleado a
left join fal_c b on a.nomina=b.nomina and b.clave=520 and b.fecha='$rowz1->fechacorte' and b.turno=4
where  a.nomina=$rowz1->turno4_cajera";
 $queryz2 = $this->db->query($sqlz2);
 if($queryz2->num_rows()> 0){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 $id_plaza=$rowz2->id_plaza;
 }else{$cianom=0;$plazanom=0;$id_plaza=0;}
 if($rowz2->parametro=='NO'){     
$dataz= array(
            'fecha'   =>$rowz1->fechacorte,  
            'corte'   =>$id_cc,  
            'nomina'  =>$rowz1->turno4_cajera,
            'turno'   =>4,
            'fal'     =>$fal4,
            'id_cor'  =>$rowz1->id_cor,
            'id_user' =>$rowz1->id_user,
            'suc'    =>$rowz1->suc,
            'plaza'  =>$id_plaza,
            'cia' =>$rowz1->cia,
            'plazanom'  =>$plazanom,
            'id_plaza'=>$id_plazaa,
            'clave'  =>520,
            'cianom' =>$cianom
            );
$insert = $this->db->insert('desarrollo.fal_c', $dataz);
}}
////
}
//////////////////////////////////////////////////////////////////////faltantes
//////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////// 
        //*******************************************************************************faltante
}       
        //*******************************************************************************faltante
        //*******************************************************************************faltante
        //*******************************************************************************faltante


}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function delete_member_c($id_cc)
{
 $sql = "SELECT * FROM desarrollo.cortes_c where id = ? and tipo<3";
 $query = $this->db->query($sql,array($id_cc));
 $sqld = "SELECT * FROM desarrollo.cortes_d where id_cc = ? ";
 $queryd = $this->db->query($sqld,array($id_cc));
 
 if($query->num_rows()== 1 and $queryd->num_rows()>= 0){
$row=$query->row();
$fechacorte=$row->fechacorte;
 
        $this->db->delete('desarrollo.cortes_c', array('id' => $id_cc));
        $this->db->delete('desarrollo.cortes_d', array('id_cc' => $id_cc));

$diac=substr($fechacorte,8,2);
$mesc=substr($fechacorte,5,2);
$aaac=substr($fechacorte,0,4);
$dia=date('d');
$mes=date('m');
$aaa=date('Y'); 
/////////////////////////////////////////////////////
if($aaac==$aaa and $mesc==$mes and $diac<=15 and $dia<=25 or
$aaac==$aaa and $mesc==$mes and $diac>15 or
$aaac==$aaa and $mesc<>$mes and $mes==($mesc+1) and $diac>15 and $dia<=10){       
        $this->db->delete('desarrollo.fal_c', array('corte' => $id_cc,'tipo'=>1));
        $this->db->delete('desarrollo.faltante', array('corte' => $id_cc,'tipo'=>1));
}
/////////////////////////////////////////////////////
}
} 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_validado_ctl()
    {
        $num=1;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
        $id_plaza= $this->session->userdata('id_plaza');
        $nivel= $this->session->userdata('nivel');
        if($nivel==5){
        $sql = "SELECT  a.*,d.nombre as sucx,date_format(a.fechacorte, '%Y-%m')as mes, count(a.suc)as dias,date_format(a.fechacorte, '%m')as m
          FROM desarrollo.cortes_c a
          left join catalogo.sucursal d on d.suc=a.suc
          where 
          id_user= $id_user and tipo=2 
         group by date_format(a.fechacorte, '%Y-%m'),suc ";
        }else{
         $sql = "SELECT  a.*,d.nombre as sucx,date_format(a.fechacorte, '%Y-%m')as mes, count(a.suc)as dias,date_format(a.fechacorte, '%m')as m
          FROM desarrollo.cortes_c a
          left join catalogo.sucursal d on d.suc=a.suc
          where 
          a.id_plaza= ? and tipo=2 
         group by date_format(a.fechacorte, '%Y-%m'),suc ";
        
         }
        $query = $this->db->query($sql,array($id_plaza));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>AAAA-MES</th>
        <th>SUCURSAL</th>
        <th>DIAS MES</th>
        <th>DIAS POR TRABAJAR</th>
        <th>DIAS TRABAJADOS</th>
        <th>DIAS FALTANTES</th>
        <th>B</th>
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
      $s = "SELECT count(suc)as diastra FROM desarrollo.cortes_c a
          where 
          id_user= ? and tipo>2 and suc=$row->suc and date_format(a.fechacorte, '%Y-%m')='$row->mes' 
          or
          id_plaza= ? and tipo>2 and suc=$row->suc and date_format(a.fechacorte, '%Y-%m')='$row->mes' 
          group by date_format(a.fechacorte, '%Y-%m'),suc ";
      $q = $this->db->query($s,array($id_user,$id_plaza));
      if($q->num_rows()>0){
      $r=$q->row();
      $diastra=$r->diastra;             
      }else{$diastra=0;}
            

      $s1 = "SELECT * FROM catalogo.mes where num=$row->m"; 
      $q1 = $this->db->query($s1);
      if($q1->num_rows()>0){
      $r1=$q1->row();
      $dtot=$r1->dos;             
      }else{$dtot=0;}
      
      $dif=$dtot-$row->dias-$diastra;

            $l1 = anchor('cortes/tabla_control_validado_d/'.$row->suc.'/'.$row->mes, '<img src="'.base_url().'img/btnNext.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            
            
            <td align=\"left\">".$num."</td>
            <td align=\"center\">".$row->mes."</td>
            <td align=\"left\">".$row->sucx."(".$row->suc.")</td>
            <td align=\"center\">".$dtot."</td>
            <td align=\"center\">".$row->dias."</td>
            <td align=\"center\">".$diastra."</td>
            <td align=\"center\">".$dif."</td>
            <td align=\"center\">".$l1."</td>
            
            
             
            
            </tr>
            ";
         $num=$num+1;
         $arqueo=0;
         $fal=0;
         $sob=0;
         $corte=0;
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_validado($suc,$fec)
    {
        $num=1;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
        $id_plaza= $this->session->userdata('id_plaza');
         $sql = "SELECT a.*,d.nombre as sucx,
         (select corregido from cortes_d where id_cc=a.id and clave1=20)as recarga_pdv
          FROM desarrollo.cortes_c a
          left join catalogo.sucursal d on d.suc=a.suc
          where 
          id_user= ? and a.suc= ?  and date_format(a.fechacorte, '%Y-%m')= ? and a.tipo=2
          or
          a.id_plaza= ? and a.suc= ?  and date_format(a.fechacorte, '%Y-%m')= ? and a.tipo=2
          ";
       
        $query = $this->db->query($sql,array($id_user,$suc,$fec,$id_plaza,$suc,$fec));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>FECHA</th>
        <th>SUCURSAL</th>
        <th>VTA.CORTE</th>
        <th>ARQUEO</th>
        <th>FALTANTE</th>
        <th>SOBRANTE</th>
        <th>T.AIRE PDV</th>
        <th>RECARGAS</th>
        <th>D</th>
        <th>B</th>
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
            
            $arqueo=$row->turno1_corte+$row->turno2_corte+$row->turno3_corte+$row->turno4_corte;
            $fal=$row->turno1_fal+$row->turno2_fal+$row->turno3_fal+$row->turno4_fal;
            $sob=$row->turno1_sob+$row->turno2_sob+$row->turno3_sob+$row->turno4_sob;
            $corte=$row->turno1_pesos+$row->turno1_bbv +$row->turno1_san+$row->turno1_exp +$row->turno1_asalto+$row->turno1_vale+($row->turno1_cambio*$row->turno1_dolar)+
                   $row->turno2_pesos+$row->turno2_bbv +$row->turno2_san+$row->turno2_exp +$row->turno2_asalto+$row->turno2_vale+($row->turno2_cambio*$row->turno2_dolar)+
                   $row->turno3_pesos+$row->turno3_bbv +$row->turno3_san+$row->turno3_exp +$row->turno3_asalto+$row->turno3_vale+($row->turno3_cambio*$row->turno3_dolar)+
                   $row->turno4_pesos+$row->turno4_bbv +$row->turno4_san+$row->turno4_exp +$row->turno4_asalto+$row->turno4_vale+($row->turno4_cambio*$row->turno4_dolar);
            
            $l1 = anchor('cortes/tabla_detalle_his/'.$row->id.'/'.$suc.'/'.$fec, '<img src="'.base_url().'img/btnNext.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));
            $l2 = anchor('cortes/delete_c_his/'.$row->id.'/'.$suc.'/'.$fec, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));
            
            $tabla.="
            <tr>
            
            
            <td align=\"left\">".$num."</td>
            <td align=\"right\">".$row->fechacorte."</td>
            <td align=\"left\">".$row->sucx."(".$row->suc.")</td>
            <td align=\"right\">".number_format($arqueo,2)."</td>
            <td align=\"right\">".number_format($corte,2)."</td>
            <td align=\"right\">".number_format($fal,2)."</td>
            <td align=\"right\">".number_format($sob,2)."</td>
            <td align=\"right\"><font size=\"1\" color=\"red\">".number_format($row->recarga_pdv,2)."</font></td>
            <td align=\"right\">".number_format($row->recarga,2)."</td>
            <td align=\"center\">".$l1."</td>
            <td align=\"center\">".$l2."</td>
            
             
            
            </tr>
            ";
         $num=$num+1;
         $arqueo=0;
         $fal=0;
         $sob=0;
         $corte=0;
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

    function inserta_archivos($archivo, $size, $string)
    {
        
        
        $validacion = explode('.', $archivo);
        $this->load->library('unzip');
        $this->load->helper('directory');
        $this->load->helper('file');

        $data = array(
                'suc' => $this->session->userdata('suc'),
                'archivo' => $archivo,
                'fecha' => date('Y-m-d H:s:i'),
                'size' => $size
                );
                
        $this->db->insert('cortes_archivo', $data);
        $id = $this->db->insert_id();
        
        if($id > 0)
        {

            if(!is_dir('./cortes/'.$validacion[0].'/'))
            {
                mkdir('./cortes/'.$validacion[0].'/');
            }
            
            $this->unzip->extract('./cortes/'.$archivo, './cortes/'.$validacion[0].'/');
            $map = directory_map('./cortes/'.$validacion[0].'/');
            $string = null;
            foreach($map as $row){
                
                
                    $string = file('./cortes/'.$validacion[0].'/'.$row, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    $linea = array_map('rtrim', $string);
                    $id_cc=0;
                    $turno1_pesos=0;  
                    $turno1_dolar=0;  
                    $turno1_cambio=0;
                    $turno1_ta60=0;
                    $turno1_ta61=0;
                    $turno1_ta62=0;
                    $turno1_ta63=0;
                    $turno1_ta64=0;
                    $turno1_ta65=0;
                    $turno1_ta66=0;
                    $turno1_v70=0;
                    $turno1_v71=0;
                    $turno1_v72=0;
                    $turno1_v73=0;
                    $turno1_v74=0;
                    $turno1_v75=0;
                    $turno1_v76=0;
                    $turno1_mn=0;
                    $turno1_asalto=0;
                    $turno1_cajera=0;
                    $turno1_folio1=0;
                    $turno1_folio2=0;
                    $turno1_corte=0;
                    $turno1_sobrante=0;
                    $turno1_faltante=0;
                    
                    $turno2_pesos=0;  
                    $turno2_dolar=0;  
                    $turno2_cambio=0;
                    $turno2_ta60=0;
                    $turno2_ta61=0;
                    $turno2_ta62=0;
                    $turno2_ta63=0;
                    $turno2_ta64=0;
                    $turno2_ta65=0;
                    $turno2_ta66=0;
                    $turno2_v70=0;
                    $turno2_v71=0;
                    $turno2_v72=0;
                    $turno2_v73=0;
                    $turno2_v74=0;
                    $turno2_v75=0;
                    $turno2_v76=0;
                    $turno2_mn=0;
                    $turno2_asalto=0;
                    $turno2_cajera=0;
                    $turno2_folio1=0;
                    $turno2_folio2=0;
                    $turno2_corte=0;
                    $turno2_sobrante=0;
                    $turno2_faltante=0;
                    
                    $turno3_pesos=0;  
                    $turno3_dolar=0;  
                    $turno3_cambio=0;
                    $turno3_ta60=0;
                    $turno3_ta61=0;
                    $turno3_ta62=0;
                    $turno3_ta63=0;
                    $turno3_ta64=0;
                    $turno3_ta65=0;
                    $turno3_ta66=0;
                    $turno3_v70=0;
                    $turno3_v71=0;
                    $turno3_v72=0;
                    $turno3_v73=0;
                    $turno3_v74=0;
                    $turno3_v75=0;
                    $turno3_v76=0;
                    $turno3_mn=0;
                    $turno3_asalto=0;
                    $turno3_cajera=0;
                    $turno3_folio1=0;
                    $turno3_folio2=0;
                    $turno3_corte=0;
                    $turno3_sobrante=0;
                    $turno3_faltante=0;
                    $venta1=0;
                    $venta2=0;
                    $venta3=0;
                    $venta4=0;
                    $venta5=0;
                    $venta6=0;
                    $venta7=0;
                    $venta8=0;
                    $venta9=0;
                    $venta10=0;
                    $venta11=0;
                    $venta12=0;
                    $venta13=0;
                    $venta14=0;
                    $venta15=0;
                    $venta16=0;
                    $venta17=0;
                    $venta18=0;
                    $venta19=0;
                    $venta20=0;
                    $venta21=0;
                    $venta22=0;
                    $venta23=0;
                    $venta24=0;
                    $venta25=0;
                    $venta26=0;
                    $venta28=0;
                    $venta29=0;
                    $venta30=0;
                    $venta40=0;
                    $venta49=0;
                    $cance1=0;
                    $clave1=0;
                    $cance2=0;
                    $clave2=0;
                    $cance3=0;
                    $clave3=0;
                    $cance4=0;
                    $clave4=0;
                    $cance5=0;
                    $clave5=0;
                    $cance6=0;
                    $clave6=0;
                    $cance7=0;
                    $clave7=0;
                    $cance8=0;
                    $clave8=0;
                    $cance9=0;
                    $clave9=0;
                    $cance10=0;
                    $clave10=0;
                    $cance11=0;
                    $clave11=0;
                    $cance12=0;
                    $clave12=0;
                    $cance13=0;
                    $clave13=0;
                    $cance14=0;
                    $clave14=0;
                    $cance15=0;
                    $clave15=0;
                    $cance16=0;
                    $clave16=0;
                    $cance17=0;
                    $clave17=0;
                    $cance18=0;
                    $clave18=0;
                    $cance19=0;
                    $clave19=0;
                    $cance20=0;
                    $clave20=0;
                    $cance21=0;
                    $clave21=0;
                    $cance22=0;
                    $clave22=0;
                    $cance23=0;
                    $clave23=0;
                    $cance24=0;
                    $clave24=0;
                    $cance25=0;
                    $clave25=0;
                    $cance26=0;
                    $clave26=0;
                    $cance28=0;
                    $clave28=0;
                    $cance29=0;
                    $clave29=0;
                    $cance30=0;
                    $clave30=0;
                    $cance40=0;
                    $clave40=0;
                    $cance48=0;
                    $clave48=0;
                    $cance49=0;
                    $clave49=0;
                    //$linea = explode('\r\n', $string);
                    $cl= null;
                    $turnox= null;
                    $ver= null;
                    $tsuc= null;
                    $b = null;
                    $x = null;
                    $xx = null;
                    $suc = null;
                    $dia = null;
                    $mes = null;
                    $aaa = null;
                    $turno = null;
                    $turno1_folio1 = null;
                    $turno1_folio2 = null;
                    $turno1_cajera = null;
                    $cia = null;
                    $plaza = null;
                    $succ = null;
                    $id_user = null;
                    $fechac = null;
                    foreach($linea as $lin)
                    {
                        $b= $lin."<br />";
                         
                        $x=substr($lin,0,2);
                        $xx=substr($lin,3,1);
                        $clave=substr($lin,4,2);
                        
                         
                        if($x=='SU'){$suc=substr($lin,3,4);
                        $sql = "SELECT  * FROM  catalogo.sucursal where suc=?";
                        $query = $this->db->query($sql,array($suc));
                        $row= $query->row();
                        $cia=$row->cia;
                        $plaza=$row->plaza;
                        $succ=$row->suc_contable;
                        $id_user_cor=$row->gere;
                        $id_user=$row->user_id;
                        $tsuc=$row->tipo2;
                        $iva=$row->iva+1;
                        $id_plaza=$row->id_plaza;
                        
                       
                        }
                        if($x=='FE'){$dia=substr($lin,3,2);$mes=substr($lin,5,2);$aaa=substr($lin,7,2)+2000; $fechac=$aaa."-".$mes."-".$dia;}
                        if($x=='CA'){$turno=substr($lin,4,1);}
                        if($x=='CA'){$turnox=substr($lin,3,2);}
                       
                        
                        if($x=='RI' && $turno==0 || $x=='RI' && $turnox==01 || $x=='RI' && $turnox==92){$turno1_folio1=substr($lin,3,12);}
                        if($x=='RF' && $turno==0 || $x=='RF' && $turnox==01 || $x=='RF' && $turnox==92){$turno1_folio2=substr($lin,3,12);}
                        if($x=='CL' && $turno==0 || $x=='CL' && $turnox==01 || $x=='CL' && $turnox==92){$cl=substr($lin,3,1);}
                        if($x=='EM' && $turno==0 || $x=='EM' && $turnox==01 || $x=='EM' && $turnox==92){$turno1_cajera=substr($lin,3,7);}
                        
                        if($x=='CL' && $turno==0 && $clave==1 || $x=='CL' && $turnox==01 && $clave==1 || $x=='CL' && $turnox==92 && $clave==1){
                            if($cl==1){$venta1=substr($lin,9,8);$clave1=$clave;}
                            if($cl==2){$cance1=substr($lin,9,8);$clave1=$clave;}
                         }
                        if($x=='CL' && $turno==0 && $clave==2 || $x=='CL' && $turnox==01 && $clave==2 || $x=='CL' && $turnox==92 && $clave==2){
                            if($cl==1){$venta2=substr($lin,9,8);$clave2=$clave;}
                            if($cl==2){$cance2=substr($lin,9,8);$clave2=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==3 || $x=='CL' && $turnox==01 && $clave==3 || $x=='CL' && $turnox==92 && $clave==3){
                            if($cl==1){$venta3=substr($lin,9,8);$clave3=$clave;}
                            if($cl==2){$cance3=substr($lin,9,8);$clave3=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==4 || $x=='CL' && $turnox==01 && $clave==4 || $x=='CL' && $turnox==92 && $clave==4){
                            if($cl==1){$venta4=substr($lin,9,8);$clave4=$clave;}
                            if($cl==2){$cance4=substr($lin,9,8);$clave4=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==5 || $x=='CL' && $turnox==01 && $clave==5 || $x=='CL' && $turnox==92 && $clave==5){
                            if($cl==1){$venta5=substr($lin,9,8);$clave5=$clave;}
                            if($cl==2){$cance5=substr($lin,9,8);$clave5=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==6 || $x=='CL' && $turnox==01 && $clave==6 || $x=='CL' && $turnox==92 && $clave==6){
                            if($cl==1){$venta6=substr($lin,9,8);$clave6=$clave;}
                            if($cl==2){$cance6=substr($lin,9,8);$clave6=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==7 || $x=='CL' && $turnox==01 && $clave==7 || $x=='CL' && $turnox==92 && $clave==7){
                            if($cl==1){$venta7=substr($lin,9,8);$clave7=$clave;}
                            if($cl==2){$cance7=substr($lin,9,8);$clave7=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==8 || $x=='CL' && $turnox==01 && $clave==8 || $x=='CL' && $turnox==92 && $clave==8){
                            if($cl==1){$venta8=substr($lin,9,8);$clave8=$clave;}
                            if($cl==2){$cance8=substr($lin,9,8);$clave8=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==9 || $x=='CL' && $turnox==01 && $clave==9 || $x=='CL' && $turnox==92 && $clave==9){
                            if($cl==1){$venta9=substr($lin,9,8);$clave9=$clave;}
                            if($cl==2){$cance9=substr($lin,9,8);$clave9=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==10 || $x=='CL' && $turnox==01 && $clave==10 || $x=='CL' && $turnox==92 && $clave==10){
                            if($cl==1){$venta10=substr($lin,9,8);$clave10=$clave;}
                            if($cl==2){$cance10=substr($lin,9,8);$clave10=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==11 || $x=='CL' && $turnox==01 && $clave==11 || $x=='CL' && $turnox==92 && $clave==11){
                            if($cl==1){$venta11=substr($lin,9,8);$clave11=$clave;}
                            if($cl==2){$cance11=substr($lin,9,8);$clave11=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==12 || $x=='CL' && $turnox==01 && $clave==12 || $x=='CL' && $turnox==92 && $clave==12){
                            if($cl==1){$venta12=substr($lin,9,8);$clave12=$clave;}
                            if($cl==2){$cance12=substr($lin,9,8);$clave12=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==13 || $x=='CL' && $turnox==01 && $clave==13 || $x=='CL' && $turnox==92 && $clave==13){
                            if($cl==1){$venta13=substr($lin,9,8);$clave13=$clave;}
                            if($cl==2){$cance13=substr($lin,9,8);$clave13=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==14 || $x=='CL' && $turnox==01 && $clave==14 || $x=='CL' && $turnox==92 && $clave==14){
                            if($cl==1){$venta14=substr($lin,9,8);$clave14=$clave;}
                            if($cl==2){$cance14=substr($lin,9,8);$clave14=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==15 || $x=='CL' && $turnox==01 && $clave==15 || $x=='CL' && $turnox==92 && $clave==15){
                            if($cl==1){$venta15=substr($lin,9,8);$clave15=$clave;}
                            if($cl==2){$cance15=substr($lin,9,8);$clave15=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==16 || $x=='CL' && $turnox==01 && $clave==16 || $x=='CL' && $turnox==92 && $clave==16){
                            if($cl==1){$venta16=substr($lin,9,8);$clave16=$clave;}
                            if($cl==2){$cance16=substr($lin,9,8);$clave16=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==17 || $x=='CL' && $turnox==01 && $clave==17 || $x=='CL' && $turnox==92 && $clave==17){
                            if($cl==1){$venta17=substr($lin,9,8);$clave17=$clave;}
                            if($cl==2){$cance17=substr($lin,9,8);$clave17=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==18 || $x=='CL' && $turnox==01 && $clave==18 || $x=='CL' && $turnox==92 && $clave==18){
                            if($cl==1){$venta18=substr($lin,9,8);$clave18=$clave;}
                            if($cl==2){$cance18=substr($lin,9,8);$clave18=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==19 || $x=='CL' && $turnox==01 && $clave==19 || $x=='CL' && $turnox==92 && $clave==19){
                            if($cl==1){$venta19=substr($lin,9,8);$clave19=$clave;}
                            if($cl==2){$cance19=substr($lin,9,8);$clave19=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==20 || $x=='CL' && $turnox==01 && $clave==20 || $x=='CL' && $turnox==92 && $clave==20){
                            if($cl==1){$venta20=substr($lin,9,8);$clave20=$clave;}
                            if($cl==2){$cance20=substr($lin,9,8);$clave20=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==21 || $x=='CL' && $turnox==01 && $clave==21 || $x=='CL' && $turnox==92 && $clave==21){
                            if($cl==1){$venta21=substr($lin,9,8);$clave21=$clave;}
                            if($cl==2){$cance21=substr($lin,9,8);$clave21=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==22 || $x=='CL' && $turnox==01 && $clave==22 || $x=='CL' && $turnox==92 && $clave==22){
                            if($cl==1){$venta22=substr($lin,9,8);$clave22=$clave;}
                            if($cl==2){$cance22=substr($lin,9,8);$clave22=$clave;}
                             }
                        
                        if($x=='CL' && $turno==0 && $clave==23 || $x=='CL' && $turnox==01 && $clave==23 || $x=='CL' && $turnox==92 && $clave==23){
                            if($cl==1){$venta23=substr($lin,9,8);$clave23=$clave;}
                            if($cl==2){$cance23=substr($lin,9,8);$clave23=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==24 || $x=='CL' && $turnox==01 && $clave==24 || $x=='CL' && $turnox==92 && $clave==24){
                            if($cl==1){$venta24=substr($lin,9,8);$clave24=$clave;}
                            if($cl==2){$cance24=substr($lin,9,8);$clave24=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==25 || $x=='CL' && $turnox==01 && $clave==25 || $x=='CL' && $turnox==92 && $clave==25){
                            if($cl==1){$venta25=substr($lin,9,8);$clave25=$clave;}
                            if($cl==2){$cance25=substr($lin,9,8);$clave25=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==26 || $x=='CL' && $turnox==01 && $clave==26 || $x=='CL' && $turnox==92 && $clave==26){
                            if($cl==1){$venta26=substr($lin,9,8);$clave26=$clave;}
                            if($cl==2){$cance26=substr($lin,9,8);$clave26=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==28 || $x=='CL' && $turnox==01 && $clave==28 || $x=='CL' && $turnox==92 && $clave==28){
                            if($cl==1){$venta28=substr($lin,9,8);$clave28=$clave;}
                            if($cl==2){$cance28=substr($lin,9,8);$clave28=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==29 || $x=='CL' && $turnox==01 && $clave==29 || $x=='CL' && $turnox==92 && $clave==29){
                            if($cl==1){$venta29=substr($lin,9,8);$clave29=$clave;}
                            if($cl==2){$cance29=substr($lin,9,8);$clave29=$clave;}
                             }
                             
                        if($x=='CL' && $turno==0 && $clave==30 || $x=='CL' && $turnox==01 && $clave==30 || $x=='CL' && $turnox==92 && $clave==30){
                            if($cl==1){$venta30=substr($lin,9,8);$clave30=$clave;}
                            if($cl==2){$cance30=substr($lin,9,8);$clave30=$clave;}
                             }
                             
                        if($x=='CL' && $turno==0 && $clave==40 || $x=='CL' && $turnox==01 && $clave==40 || $x=='CL' && $turnox==92 && $clave==40){
                            if($cl==1){$venta40=substr($lin,9,8);$clave40=$clave;}
                            if($cl==2){$cance40=substr($lin,9,8);$clave40=$clave;}
                             }
                             
                        if($x=='CL' && $turno==0 && $clave==48 || $x=='CL' && $turnox==01 && $clave==48 || $x=='CL' && $turnox==92 && $clave==48){
                            if($cl==1){$venta48=substr($lin,9,8);$clave48=$clave;}
                            if($cl==2){$cance48=substr($lin,9,8);$clave48=$clave;}
                             }
                         
                       if($x=='CL' && $turno==0 && $clave==49 || $x=='CL' && $turnox==01 && $clave==49 || $x=='CL' && $turnox==92 && $clave==49){
                            if($cl==1){$venta49=substr($lin,9,8);$clave49=$clave;}
                            if($cl==2){$cance49=substr($lin,9,8);$clave49=$clave;}
                             }      
                        
                        if($x=='CL' && $turno==1 && $clave==50 || $x=='CL' && $turnox==11 && $clave==50 || $x=='CL' && $turnox==21 && $clave==50){$turno1_pesos=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==60 || $x=='CL' && $turnox==11 && $clave==60 || $x=='CL' && $turnox==21 && $clave==60){$turno1_ta60=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==61 || $x=='CL' && $turnox==11 && $clave==61 || $x=='CL' && $turnox==21 && $clave==61){$turno1_ta61=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==62 || $x=='CL' && $turnox==11 && $clave==62 || $x=='CL' && $turnox==21 && $clave==62){$turno1_ta62=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==63 || $x=='CL' && $turnox==11 && $clave==63 || $x=='CL' && $turnox==21 && $clave==63){$turno1_ta63=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==64 || $x=='CL' && $turnox==11 && $clave==64 || $x=='CL' && $turnox==21 && $clave==64){$turno1_ta64=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==65 || $x=='CL' && $turnox==11 && $clave==65 || $x=='CL' && $turnox==21 && $clave==65){$turno1_ta65=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==66 || $x=='CL' && $turnox==11 && $clave==66 || $x=='CL' && $turnox==21 && $clave==66){$turno1_ta66=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==70 || $x=='CL' && $turnox==11 && $clave==70 || $x=='CL' && $turnox==21 && $clave==70){$turno1_v70=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==71 || $x=='CL' && $turnox==11 && $clave==71 || $x=='CL' && $turnox==21 && $clave==71){$turno1_v71=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==72 || $x=='CL' && $turnox==11 && $clave==72 || $x=='CL' && $turnox==21 && $clave==72){$turno1_v72=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==73 || $x=='CL' && $turnox==11 && $clave==73 || $x=='CL' && $turnox==21 && $clave==73){$turno1_v73=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==74 || $x=='CL' && $turnox==11 && $clave==74 || $x=='CL' && $turnox==21 && $clave==74){$turno1_v74=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==75 || $x=='CL' && $turnox==11 && $clave==75 || $x=='CL' && $turnox==21 && $clave==75){$turno1_v75=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==76 || $x=='CL' && $turnox==11 && $clave==76 || $x=='CL' && $turnox==21 && $clave==76){$turno1_v76=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==80 || $x=='CL' && $turnox==11 && $clave==80 || $x=='CL' && $turnox==21 && $clave==80){$turno1_dolar=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==81 || $x=='CL' && $turnox==11 && $clave==81 || $x=='CL' && $turnox==21 && $clave==81){$turno1_cambio=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==82 || $x=='CL' && $turnox==11 && $clave==82 || $x=='CL' && $turnox==21 && $clave==82){$turno1_mn=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==91 || $x=='CL' && $turnox==11 && $clave==91 || $x=='CL' && $turnox==21 && $clave==91){$turno1_corte=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==92 || $x=='CL' && $turnox==11 && $clave==92 || $x=='CL' && $turnox==21 && $clave==92){$turno1_sobrante=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==93 || $x=='CL' && $turnox==11 && $clave==93 || $x=='CL' && $turnox==21 && $clave==93){$turno1_faltante=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==94 || $x=='CL' && $turnox==11 && $clave==94 || $x=='CL' && $turnox==21 && $clave==94){$turno1_asalto=substr($lin,9,8);}
                        
                        if($x=='CL' && $turno==2 && $clave==50){$turno2_pesos=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==60){$turno2_ta60=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==61){$turno2_ta61=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==62){$turno2_ta62=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==63){$turno2_ta63=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==64){$turno2_ta64=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==65){$turno2_ta65=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==66){$turno2_ta66=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==70){$turno2_v70=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==71){$turno2_v71=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==72){$turno2_v72=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==73){$turno2_v73=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==74){$turno2_v74=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==75){$turno2_v75=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==76){$turno2_v76=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==80){$turno2_dolar=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==81){$turno2_cambio=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==82){$turno2_mn=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==91){$turno2_corte=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==92){$turno2_sobrante=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==93){$turno2_faltante=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==94){$turno2_asalto=substr($lin,9,8);}
                        //if($x=='CL' && $turno==2 && $clave==48){$cance48=substr($lin,9,8);}
                        
                        if($x=='RI' && $turno==2){$turno2_folio1=substr($lin,3,12);}
                        if($x=='RF' && $turno==2){$turno2_folio2=substr($lin,3,12);}
                        if($x=='EM' && $turno==2){$turno2_cajera=substr($lin,3,7);}

                        if($x=='CL' && $turno==3 && $clave==50){$turno3_pesos=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==60){$turno3_ta60=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==61){$turno3_ta61=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==62){$turno3_ta62=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==63){$turno3_ta63=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==64){$turno3_ta64=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==65){$turno3_ta65=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==66){$turno3_ta66=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==70){$turno3_v70=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==71){$turno3_v71=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==72){$turno3_v72=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==73){$turno3_v73=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==74){$turno3_v74=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==75){$turno3_v75=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==76){$turno3_v76=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==80){$turno3_dolar=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==81){$turno3_cambio=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==82){$turno3_mn=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==91){$turno3_corte=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==92){$turno3_sobrante=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==93){$turno3_faltante=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==94){$turno3_asalto=substr($lin,9,8);}
                        
                        if($x=='RI' && $turno==3){$turno3_folio1=substr($lin,3,12);}
                        if($x=='RF' && $turno==3){$turno3_folio2=substr($lin,3,12);}
                        if($x=='EM' && $turno==3){$turno3_cajera=substr($lin,3,7);}

                        
////////////////////graba concentrado////////////////////////////////////////////////////////
$caja=1;
// echo $fechac;
$sqlz = "SELECT * FROM cortes_c where suc=? and fechacorte =?";
                        $queryz = $this->db->query($sqlz,array($suc,$fechac));
/////////////////////////////////////////**********+++++++++++++++++++++++++++++++++++++++++++++++++
/////////////////////////////////////////**********+++++++++++++++++++++++++++++++++++++++++++++++++
$recarga=0;
if($x=='TM' &&  $queryz->num_rows()== 0){
                                
                                $new_member_insert_data = array(
        	                    'fechacorte' => $fechac,
                                'suc' => $suc,
                                'tipo' => 2,
                                'id_user' => $id_user,
                                'id_cor' => $id_user_cor,
                                'caja'=>$caja,
                                'cia'=>$cia,
                                'plaza'=>$plaza,
                                'succ'=>$succ,
                                'recarga'=>$recarga,
                                'vta_tot'=>$venta48-$cance48,
 		    'turno1_pesos'   =>$turno1_pesos,  
            'turno1_dolar'   =>$turno1_dolar,  
            'turno1_cambio'  =>$turno1_cambio,
            'turno1_bbv'     =>$turno1_ta64+$turno1_ta65,
            'turno1_exp'     =>$turno1_ta62+$turno1_ta63,
            'turno1_san'     =>$turno1_ta66+$turno1_ta60+$turno1_ta61,
            'turno1_vale'    =>$turno1_v70+$turno1_v71+$turno1_v72+$turno1_v73+$turno1_v74+$turno1_v75+$turno1_v76,
            'turno1_cajera'  =>$turno1_cajera,
            'turno1_folio1'  =>$turno1_folio1,
            'turno1_folio2'  =>$turno1_folio2,
            'turno1_corte'   =>$turno1_corte,
            'turno1_sob'     =>$turno1_sobrante,
            'turno1_fal'     =>$turno1_faltante,
            'turno1_asalto'  =>$turno1_asalto,
            
            'turno2_pesos'   =>$turno2_pesos,
            'turno2_dolar'   =>$turno2_dolar,
            'turno2_cambio'  =>$turno2_cambio,
            'turno2_bbv'     =>$turno2_ta64+$turno2_ta65,
            'turno2_exp'     =>$turno2_ta62+$turno2_ta63,
            'turno2_san'     =>$turno2_ta66+$turno2_ta60+$turno2_ta61,
            'turno2_vale'    =>$turno2_v70+$turno2_v71+$turno2_v72+$turno2_v73+$turno2_v74+$turno2_v75+$turno2_v76,
            'turno2_cajera'  =>$turno2_cajera,
            'turno2_folio1'  =>$turno2_folio1,
            'turno2_folio2'  =>$turno2_folio2,
            'turno2_corte'   =>$turno2_corte,
            'turno2_sob'     =>$turno2_sobrante,
            'turno2_fal'     =>$turno2_faltante,
            'turno2_asalto'  =>$turno2_asalto,
            
            'turno3_pesos'   =>$turno3_pesos,
            'turno3_dolar'   =>$turno3_dolar,
            'turno3_cambio'  =>$turno3_cambio,
            'turno3_bbv'     =>$turno3_ta64+$turno3_ta65,
            'turno3_exp'     =>$turno3_ta62+$turno3_ta63,
            'turno3_san'     =>$turno3_ta66+$turno3_ta60+$turno3_ta61,
            'turno3_vale'    =>$turno3_v70+$turno3_v71+$turno3_v72+$turno3_v73+$turno3_v74+$turno3_v75+$turno3_v76,
            'turno3_cajera'  =>$turno3_cajera,
            'turno3_folio1'  =>$turno3_folio1,
            'turno3_folio2'  =>$turno3_folio2,
            'turno3_corte'   =>$turno3_corte,
            'turno3_sob'     =>$turno3_sobrante,
            'turno3_fal'     =>$turno3_faltante,
            'turno3_asalto'  =>$turno3_asalto,
            'id_plaza'      =>$id_plaza, 
            'tsuc'     =>$tsuc
                                  
                                  
                                  );
		            $insert = $this->db->insert('desarrollo.cortes_c', $new_member_insert_data);
                    $id_cc= $this->db->insert_id();

///////////////////////////////////////////////////////////////////////////////////                    
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////fenix
                  if($venta1>0 || $venta25>0 || $venta28>0 || $venta29>0 ){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave1,
                            'venta'=>$venta1+$venta25+$venta28+$venta29,
                            'cancel'=>$cance1+$cance25+$cance28+$cance29,
                            'corregido' =>$venta1+$venta25+$venta28+$venta29-$cance1-$cance25-$cance28-$cance29,
                            'siniva' =>$venta1+$venta25+$venta28+$venta29-$cance1-$cance25-$cance28-$cance29,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                            
                    if($venta2>0  || $venta3>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave2,
                            'venta'=>$venta2+$venta3,
                            'cancel'=>$cance2+$cance3,
                            'corregido' =>$venta2+$venta3-$cance2-$cance3,
                            'siniva' =>($venta2+$venta3-$cance2-$cance3)/$iva,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    
                    if($venta4>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave4,
                            'venta'=>$venta4,
                            'cancel'=>$cance4,
                            'corregido'=>$venta4-$cance4,
                            'siniva'=>$venta4-$cance4,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta5>0 || $venta6>0 || $venta17>0 || $venta18>0 || $venta26>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave5,
                            'venta'=>$venta5+$venta6+$venta17+$venta18+$venta26,
                            'cancel'=>$cance5+$cance6+$cance17+$cance18+$cance26,
                            'corregido'=>$venta5+$venta6+$venta17+$venta18+$venta26-$cance5-$cance6-$cance17-$cance18-$cance26,
                            'siniva'=>($venta5+$venta6+$venta17+$venta18+$venta26-$cance5-$cance6-$cance17-$cance18-$cance26)/$iva,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                      if($venta7>0 || $venta8>0){
                            
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>8,
                            'venta'=>$venta8+$venta7,
                            'cancel'=>$cance8+$cance7,
                            'corregido'=>$venta8+$venta7-$cance8-$cance7,
                            'siniva'=>$venta8+$venta7-$cance8-$cance7,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta9>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave9,
                            'venta'=>$venta9,
                            'cancel'=>$cance9,
                            'corregido'=>$venta9-$cance9,
                            'siniva'=>($venta9-$cance9)/$iva,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta10>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave10,
                            'venta'=>$venta10,
                            'cancel'=>$cance10,
                            'corregido'=>$venta10-$cance10,
                            'siniva'=>$venta10-$cance10,
                            'lin_g'=>3,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta11>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave11,
                            'venta'=>$venta11,
                            'cancel'=>$cance11,
                            'corregido'=>$venta11-$cance11,
                            'siniva'=>($venta11-$cance11)/$iva,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta12>0 || $venta14>0 || $venta15>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave12,
                            'venta'=>$venta12+$venta14+$venta15,
                            'cancel'=>$cance12+$cance14+$cance15,
                            'corregido'=>$venta12+$venta14+$venta15-$cance12-$cance14-$cance15,
                            'siniva'=>$venta12+$venta14+$venta15-$cance12-$cance14-$cance15,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta13>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave13,
                            'venta'=>$venta13,
                            'cancel'=>$cance13,
                            'corregido'=>$venta13-$cance13,
                            'siniva'=>$venta13-$cance13,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta16>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave16,
                            'venta'=>$venta16,
                            'cancel'=>$cance16,
                            'corregido'=>$venta16-$cance16,
                            'siniva'=>$venta16-$cance16,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta19>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave19,
                            'venta'=>$venta19,
                            'cancel'=>$cance19,
                            'corregido'=>$venta19-$cance19,
                            'siniva'=>($venta19-$cance19)/$iva,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }

                    if($venta20>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave20,
                            'venta'=>$venta20,
                            'cancel'=>$cance20,
                            'corregido'=>$venta20-$cance20,
                            'siniva'=>($venta20-$cance20)/$iva,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    
                    if($venta21>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave21,
                            'venta'=>$venta21,
                            'cancel'=>$cance21,
                            'corregido'=>$venta21-$cance21,
                            'siniva'=>($venta21-$cance21)/$iva,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta22>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave22,
                            'venta'=>$venta22,
                            'cancel'=>$cance22,
                            'corregido'=>$venta22-$cance22,
                            'siniva'=>$venta22-$cance22,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta23>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave23,
                            'venta'=>$venta23,
                            'cancel'=>$cance23,
                            'corregido'=>$venta23-$cance23,
                            'siniva'=>$venta23-$cance23,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                 if($venta24>0 ){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave1,
                            'venta'=>$venta24,
                            'cancel'=>$cance24,
                            'corregido' =>$venta24-$cance24,
                            'siniva' =>$venta24-$cance24,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }

                    if($venta30>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave30,
                            'venta'=>$venta30,
                            'cancel'=>$cance30,
                            'corregido'=>$venta30-$cance30,
                            'siniva'=>$venta30-$cance30,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta40>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave40,
                            'venta'=>$venta40,
                            'cancel'=>$cance40,
                            'corregido'=>$venta40-$cance40,
                            'siniva'=>$venta40-$cance40,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta49>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave49,
                            'venta'=>$venta49-$cance49,
                            'cancel'=>0,
                            'corregido'=>$venta49-$cance49,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
///////////////////////////////////////////////////////////////////////////////////                    
///////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////////////////// 
///////////////////////////////////////////////////////////////////////////////////                    
}
                    }
                
                
            }
            
            
            
            
            
            
        }
        
        
        
        $query = $this->db->get_where('cortes_archivo', array('id' => $id));
        
        $row = $query->row();
        
            $a = "
            <p class=\"message-box alert\">$row->archivo - Subido ".$row->fecha.", Tama&ntilde;o ".number_format($row->size, 0)." Bytes.<br />Recibido Satisfactoriamente.</p>
            ";
            
            if($validacion[1] == 'pge' || $validacion[1] == 'inv' || $validacion[1] == 'txt'){
                
            $a.="
            <pre>$string<pre>
            
            
            ";

            }else{
                foreach($map as $row){
                $a.= "Archivo: $row<br />";
                }
                
               
                
            }
            
            
        
        return $a;


    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function busca_corte_pol($fec)
    {
     $id_user= $this->session->userdata('id');  
     $sql = "SELECT a.*,date_format(a.fechacorte, '%Y-%m-%d')as fec,
     d.nombre as sucx,
     e.mes as mesx,
     h.username,h.nombre as nomx
          FROM desarrollo.cortes_c a
          left join catalogo.sucursal d on d.suc=a.suc
          left join catalogo.mes e on e.num=extract(month from a.fecha)
          left join usuarios h on h.id=a.id_user
          where date_format(a.fechacorte, '%Y-%m')= ? and id_user= ?  or date_format(a.fechacorte, '%Y-%m')= ? and id_cor= ? 
          group by date_format(a.fechacorte, '%Y-%m'), a.suc 
          order by a.suc";
     $query = $this->db->query($sql,array($fec,$id_user,$fec,$id_user));
     return $query; 
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function imprime_poliza_detalle($fec)
    {
  $id_plaza= $this->session->userdata('id_plaza');
  $id_user= $this->session->userdata('id');
  $sqlaa="select a.*, b.nombre as sucx  from cortes_c a
  left join catalogo.sucursal b on b.suc=a.suc
  where  
  date_format(a.fechacorte, '%Y-%m')= ? and id_user= ? and tipo>2 
  or 
  date_format(a.fechacorte, '%Y-%m')= ? and id_cor= ? and tipo=2
  or
  date_format(a.fechacorte, '%Y-%m')= ? and a.id_plaza= ? and tipo=2
  group by a.suc
  order by  a.suc";
         $queryaa = $this->db->query($sqlaa,array($fec,$id_user,$fec,$id_user,$fec,$id_plaza));
         $detalle="<table border =\"1\"> ";
         
          foreach($queryaa->result() as $rowaa)
         {
         
         $suc=$rowaa->suc;
         $detalle.="
        
          <tr  bgcolor=\"#F6F5C2\">
          <td width=\"905\" align=\"center\"><font size=\"-1\"><strong>SUCURSAL ".$rowaa->suc."-".$rowaa->sucx."</strong></font></td>
          </tr>
         ";
         $gencan=0;
         $genval=0;
         $gencanche=0;
         $genche=0;
         
         $num=1;
         $tipo=0;
         $checan=0;
         $che=0;
         
         $subtotal_che=0;
         $varios_che=0;
         $iva_che=0;
         $isr_che=0;
         $ivar_che=0;
         $imp_che=0;
         
         $subtotal_che_can=0;
         $varios_che_can=0;
         $iva_che_can=0;
         $isr_che_can=0;
         $ivar_che_can=0;
         $imp_che_can=0;
         $tpesos=0;
        $tdolar=0;
        $tmn   =0;
        $tsan  =0;
        $tbbv  =0;
        $texp  =0;
        $tvale =0;
        $taire =0;
        $tcredito=0;
        $tiva  =0;
        $tasalto=0;
   
         $sql="select date_format(a.fechacorte, '%d') as dia, a.suc, a.id_user, a.cia,
         
sum((a.turno1_cambio+a.turno2_cambio+a.turno3_cambio)/3)as cambio,
sum(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos)as pesos,
sum(a.turno1_dolar+a.turno2_dolar+a.turno3_dolar)as dolar,
sum(a.turno1_mn+a.turno2_mn+a.turno3_mn)as mn,
sum(a.turno1_exp+a.turno2_exp+a.turno3_exp)as exp,
sum(a.turno1_bbv+a.turno2_bbv+a.turno3_bbv)as bbv,
sum(a.turno1_san+a.turno2_san+a.turno3_san)as san,
sum(a.turno1_vale+a.turno2_vale+a.turno3_vale)as vale,
sum(a.turno1_asalto+a.turno2_asalto+a.turno3_asalto)as asalto,
sum(b.corregido)as iva,
sum(c.corregido)as credito,
sum(d.corregido) as aire,
e.nombre as sucx
FROM cortes_c a
left join cortes_d b on b.id_cc=a.id and b.clave1=49
left join cortes_d c on c.id_cc=a.id and c.clave1=30
left join cortes_d d on d.id_cc=a.id and d.clave1=20
left join catalogo.sucursal e on e.suc=a.suc 
         where 
         date_format(a.fechacorte, '%Y-%m')=? and a.id_user= ? and a.suc= ? and a.tipo>2 
         or 
         date_format(a.fechacorte, '%Y-%m')= ? and a.id_cor= ?  and a.suc= ? and a.tipo>2
         or
         date_format(a.fechacorte, '%Y-%m')= ? and a.id_plaza= ?  and a.suc= ? and a.tipo>2
         group by a.suc, a.fechacorte";
         $query = $this->db->query($sql,array($fec,$id_user,$suc,$fec,$id_user,$suc,$fec,$id_plaza,$suc));
        $detalle.=" 
        
        
           
           <tr bgcolor=\"gray\">
           <td width=\"40\" align=\"center\"><font size=\"-1\"><strong>DIA</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>EFECTIVO</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>DOLAR</strong></font></td>
           <td width=\"40\" align=\"center\"><font size=\"-1\"><strong>TIPO/CAM</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>CONVERSION</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>T.SANTANDER</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>T.BBV</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>T.EXP</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>VALES</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>TIEMPO AIRE</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>IVA DESGLOSADO</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>CREDITO CLIENTES</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>ASALTO</strong></font></td>
           </tr>
        ";
        
        
         foreach($query->result() as $row)
         {
         $detalle.="
            <tr>
            <td width=\"40\" align=\"center\">".$row->dia."</td>
            <td width=\"75\" align=\"right\">".number_format($row->pesos,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->dolar,2)."</td>
            <td width=\"40\" align=\"right\">".number_format($row->cambio,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->mn,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->san,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->bbv,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->exp,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->vale,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->aire,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->iva,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->credito,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->asalto,2)."</td>
            </tr>";
        $tpesos=$tpesos+$row->pesos;
        $tdolar=$tdolar+$row->dolar;
        $tmn   =$tmn+$row->mn;
        $tsan  =$tsan+$row->san;
        $tbbv  =$tbbv+$row->bbv;
        $texp  =$texp+$row->exp;
        $tvale =$tvale+$row->vale;
        $taire =$taire+$row->aire;
        $tcredito=$tcredito+$row->credito;
        $tiva  =$tiva+$row->iva;
        $tasalto=$tasalto+$row->asalto;
        }
        $detalle.="
        <tr bgcolor=\"#BDBBBB\">
        <td width=\"40\" align=\"right\"><strong>TOTAL</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tpesos,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tdolar,2)."</strong></td>
        <td width=\"40\" align=\"right\"></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tmn,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tsan,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tbbv,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($texp,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tvale,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($taire,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tiva,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tcredito,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tasalto,2)."</strong></td>
        </tr>"; 
        $tpesos=0;
        $tdolar=0;
        $tmn   =0;
        $tsan  =0;
        $tbbv  =0;
        $texp  =0;
        $tvale =0;
        $taire =0;
        $tcredito=0;
        $tiva  =0;
        $tasalto=0;
      }
       $detalle.="</table>"; 
      return $detalle;
  
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function imprime_poliza_detalle_una($fec,$suc,$quin,$mes)
    {
  $id_user= $this->session->userdata('id');
  $id_plaza= $this->session->userdata('id_plaza');
    $s="select *from catalogo.mes where num= ?";
        $q= $this->db->query($s,array($mes));
        $r=$q->row();
        $dia2=$r->dos;
    
         $gencan=0;
         $genval=0;
         $gencanche=0;
         $genche=0;
         
         $num=1;
         $tipo=0;
         $checan=0;
         $che=0;
         
         $subtotal_che=0;
         $varios_che=0;
         $iva_che=0;
         $isr_che=0;
         $ivar_che=0;
         $imp_che=0;
         
         $subtotal_che_can=0;
         $varios_che_can=0;
         $iva_che_can=0;
         $isr_che_can=0;
         $ivar_che_can=0;
         $imp_che_can=0;
         $tpesos=0;
        $tdolar=0;
        $tmn   =0;
        $tsan  =0;
        $tbbv  =0;
        $texp  =0;
        $tvale =0;
        $taire =0;
        $tcredito=0;
        $tiva  =0;
        $tasalto=0;

if($quin==1){
        $dia1=01;
        $dia2=15;
        $fec1=$fec.'-'.str_pad($dia1,2,0,STR_PAD_LEFT);
        $fec2=$fec.'-'.str_pad($dia2,2,0,STR_PAD_LEFT);
         $sql="select date_format(a.fechacorte, '%d') as dia, a.suc, a.id_user, a.cia,
sum((a.turno1_cambio+a.turno2_cambio+a.turno3_cambio+a.turno4_cambio)/4)as cambio,
sum(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos)as pesos,
sum(a.turno1_dolar+a.turno2_dolar+a.turno3_dolar+a.turno4_dolar)as dolar,
sum(a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn)as mn,
sum(a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as exp,
sum(a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv)as bbv,
sum(a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san)as san,
sum(a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale)as vale,
sum(a.turno1_asalto+a.turno2_asalto+a.turno3_asalto+a.turno4_asalto)as asalto,
sum(b.corregido)as iva,
sum(c.corregido)as credito,
sum(d.corregido) as aire,
e.nombre as sucx
FROM cortes_c a
left join cortes_d b on b.id_cc=a.id and b.clave1=49
left join cortes_d c on c.id_cc=a.id and c.clave1=30
left join cortes_d d on d.id_cc=a.id and d.clave1=20
left join catalogo.sucursal e on e.suc=a.suc 
         where a.fechacorte>= ? and a.fechacorte<= ? and a.id_user= ? and a.suc= ? and a.tipo>2 
            or a.fechacorte>= ? and a.fechacorte<= ? and a.id_cor= ?  and a.suc= ? and a.tipo>2
            or a.fechacorte>= ? and a.fechacorte<= ? and a.id_plaza= ?  and a.suc= ? and a.tipo>2
         group by a.suc, a.fechacorte";
         $query = $this->db->query($sql,array($fec1,$fec2,$id_user,$suc,$fec1,$fec2,$id_user,$suc,$fec1,$fec2,$id_plaza,$suc));
}         
if($quin==2){
        $dia1=16;
        $fec1=$fec.'-'.str_pad($dia1,2,0,STR_PAD_LEFT);
        $fec2=$fec.'-'.str_pad($dia2,2,0,STR_PAD_LEFT);
         $sql="select date_format(a.fechacorte, '%d') as dia, a.suc, a.id_user, a.cia,
sum((a.turno1_cambio+a.turno2_cambio+a.turno3_cambio+a.turno4_cambio)/4)as cambio,
sum(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos)as pesos,
sum(a.turno1_dolar+a.turno2_dolar+a.turno3_dolar+a.turno4_dolar)as dolar,
sum(a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn)as mn,
sum(a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as exp,
sum(a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv)as bbv,
sum(a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san)as san,
sum(a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale)as vale,
sum(a.turno1_asalto+a.turno2_asalto+a.turno3_asalto+a.turno4_asalto)as asalto,
sum(b.corregido)as iva,
sum(c.corregido)as credito,
sum(d.corregido) as aire,
e.nombre as sucx
FROM cortes_c a
left join cortes_d b on b.id_cc=a.id and b.clave1=49
left join cortes_d c on c.id_cc=a.id and c.clave1=30
left join cortes_d d on d.id_cc=a.id and d.clave1=20
left join catalogo.sucursal e on e.suc=a.suc 
         where a.fechacorte>= ? and a.fechacorte<= ? and a.id_user= ? and a.suc= ? and a.tipo>2 
         or a.fechacorte>= ? and a.fechacorte<= ? and a.id_cor= ?  and a.suc= ? and a.tipo>2
         or a.fechacorte>= ? and a.fechacorte<= ? and a.id_plaza= ?  and a.suc= ? and a.tipo>2
         group by a.suc, a.fechacorte";
         $query = $this->db->query($sql,array($fec1,$fec2,$id_user,$suc,$fec1,$fec2,$id_user,$suc,$fec1,$fec2,$id_plaza,$suc));
}         
if($quin==3){
        
         $sql="select date_format(a.fechacorte, '%d') as dia, a.suc, a.id_user, a.cia,
sum((a.turno1_cambio+a.turno2_cambio+a.turno3_cambio+a.turno4_cambio)/4)as cambio,
sum(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos)as pesos,
sum(a.turno1_dolar+a.turno2_dolar+a.turno3_dolar+a.turno4_dolar)as dolar,
sum(a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn)as mn,
sum(a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as exp,
sum(a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv)as bbv,
sum(a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san)as san,
sum(a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale)as vale,
sum(a.turno1_asalto+a.turno2_asalto+a.turno3_asalto+a.turno4_asalto)as asalto,

sum(b.corregido)as iva,
sum(c.corregido)as credito,
sum(d.corregido) as aire,
e.nombre as sucx
FROM cortes_c a
left join cortes_d b on b.id_cc=a.id and b.clave1=49
left join cortes_d c on c.id_cc=a.id and c.clave1=30
left join cortes_d d on d.id_cc=a.id and d.clave1=20
left join catalogo.sucursal e on e.suc=a.suc 
         where date_format(a.fechacorte, '%Y-%m')= ? and a.id_user= ? and a.suc= ? and a.tipo>2 
         or  date_format(a.fechacorte, '%Y-%m')= ? and a.id_cor= ?  and a.suc= ? and a.tipo>2
         or  date_format(a.fechacorte, '%Y-%m')= ? and a.id_plaza= ?  and a.suc= ? and a.tipo>2
         group by a.suc, a.fechacorte";
         $query = $this->db->query($sql,array($fec,$id_user,$suc,$fec,$id_user,$suc,$fec,$id_plaza,$suc));
}            
         
         
          $detalle="<table border =\"1\"> 
 
        
        
           
           <tr bgcolor=\"gray\">
           <td width=\"40\" align=\"center\"><font size=\"-1\"><strong>DIA</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>EFECTIVO</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>DOLAR</strong></font></td>
           <td width=\"40\" align=\"center\"><font size=\"-1\"><strong>TIPO/CAM</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>CONVERSION</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>T.SANTANDER</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>T.BBV</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>T.EXP</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>VALES</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>TIEMPO AIRE</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>IVA DESGLOSADO</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>CREDITO CLIENTES</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>ASALTO</strong></font></td>
           </tr>
        ";
        
        
         foreach($query->result() as $row)
         {
         $detalle.="
            <tr>
            <td width=\"40\" align=\"center\">".$row->dia."</td>
            <td width=\"75\" align=\"right\">".number_format($row->pesos,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->dolar,2)."</td>
            <td width=\"40\" align=\"right\">".number_format($row->cambio,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->mn,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->san,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->bbv,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->exp,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->vale,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->aire,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->iva,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->credito,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->asalto,2)."</td>
            </tr>";
        $tpesos=$tpesos+$row->pesos;
        $tdolar=$tdolar+$row->dolar;
        $tmn   =$tmn+$row->mn;
        $tsan  =$tsan+$row->san;
        $tbbv  =$tbbv+$row->bbv;
        $texp  =$texp+$row->exp;
        $tvale =$tvale+$row->vale;
        $taire =$taire+$row->aire;
        $tcredito=$tcredito+$row->credito;
        $tiva  =$tiva+$row->iva;
        $tasalto=$tasalto+$row->asalto;
        }
        $detalle.="
        <tr bgcolor=\"#BDBBBB\">
        <td width=\"40\" align=\"right\"><strong>TOTAL</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tpesos,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tdolar,2)."</strong></td>
        <td width=\"40\" align=\"right\"></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tmn,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tsan,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tbbv,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($texp,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tvale,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($taire,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tiva,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tcredito,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tasalto,2)."</strong></td>
        </tr>"; 
        $tpesos=0;
        $tdolar=0;
        $tmn   =0;
        $tsan  =0;
        $tbbv  =0;
        $texp  =0;
        $tvale =0;
        $taire =0;
        $tcredito=0;
        $tiva  =0;
        $tasalto=0;
      
       $detalle.="</table>"; 
        ///////////////////////////////////////////////////////////////////****************************
       ///////////////////////////////////////////////////////////////////****************************faltantes de caja
  if($quin==1){
        $dia1=01;
        $dia2=15;
        $fec1=$fec.'-'.str_pad($dia1,2,0,STR_PAD_LEFT);
        $fec2=$fec.'-'.str_pad($dia2,2,0,STR_PAD_LEFT);
        $fecx=$fec.'-'.str_pad($dia2,2,0,STR_PAD_LEFT);
        $s="SELECT a.*,b.completo as nombre,c.nombre as clavexx
FROM faltante a
left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom
left join catalogo.cat_nom_claves c on c.clave=a.clave
where a.fecha>= ? and a.fecha<= ? and a.id_user= ? and a.suc= ? and a.tipo>1  and a.clave>518 and a.clave<521 
or a.fecha>= ? and a.fecha<= ? and a.id_cor= ? and a.suc= ? and a.tipo>1 and a.clave>518 and a.clave<521
or a.fecha>= ? and a.fecha<= ? and a.id_plaza= ? and a.suc= ? and a.tipo>1 and a.clave>518 and a.clave<521"
;
         $q = $this->db->query($s,array($fec1,$fec2,$id_user,$suc,$fec1,$fec2,$id_user,$suc,$fec1,$fec2,$id_plaza,$suc));
} 
  if($quin==2){
        $dia1=16;
        $fec1=$fec.'-'.str_pad($dia1,2,0,STR_PAD_LEFT);
        $fec2=$fec.'-'.str_pad($dia2,2,0,STR_PAD_LEFT);
         $s="SELECT a.*,b.completo as nombre,c.nombre as clavexx
FROM faltante a
left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom
left join catalogo.cat_nom_claves c on c.clave=a.clave
where a.fecha>= ? and a.fecha<= ? and a.id_user= ? and a.suc= ? and a.tipo>1  and a.clave>518 and a.clave<521 
or a.fecha>= ? and a.fecha<= ? and a.id_cor= ? and a.suc= ? and a.tipo>1 and a.clave>518 and a.clave<521
or a.fecha>= ? and a.fecha<= ? and a.id_plaza= ? and a.suc= ? and a.tipo>1 and a.clave>518 and a.clave<521";
         $q = $this->db->query($s,array($fec1,$fec2,$id_user,$suc,$fec1,$fec2,$id_user,$suc,$fec1,$fec2,$id_plaza,$suc));
}
  if($quin==3){
         $s="SELECT a.*,b.completo as nombre,c.nombre as clavexx
FROM faltante a
left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom
left join catalogo.cat_nom_claves c on c.clave=a.clave
where  date_format(a.fecha, '%Y-%m')= ? and a.id_user= ? and a.suc= ? and a.tipo>1  and a.clave>518 and a.clave<521 
or  date_format(a.fecha, '%Y-%m')= ? and a.id_cor= ? and a.suc= ? and a.tipo>1 and a.clave>518 and a.clave<521
or  date_format(a.fecha, '%Y-%m')= ? and a.id_plaza= ? and a.suc= ? and a.tipo>1 and a.clave>518 and a.clave<521";
         $q = $this->db->query($s,array($fec,$id_user,$suc,$fec,$id_user,$suc,$fec,$id_plaza,$suc));
}        

$detalle.="<br /><table border =\"1\"> 
 
        
           <tr> 
           <td width=\"790\" align=\"center\"><font size=\"-1\"><strong>DESCUENTOS DE CORTES</strong></font></td>
           </tr>
           <tr bgcolor=\"#DDFEC5\">
           <td width=\"100\" align=\"center\"><font size=\"-1\"><strong>FECHA</strong></font></td>
           <td width=\"100\" align=\"center\"><font size=\"-1\"><strong>NOMINA</strong></font></td>
           <td width=\"200\" align=\"center\"><font size=\"-1\"><strong>EMPLEADO</strong></font></td>
           <td width=\"40\" align=\"center\"><font size=\"-1\"><strong>TURNO</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>MONTO</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>APLICA NOMINAS</strong></font></td>
           <td width=\"200\" align=\"center\"><font size=\"-1\"><strong>CONCEPTO</strong></font></td>
           </tr>
        ";
        
        $totfal=0;
         foreach($q->result() as $r)
         {
          
         $detalle.="
            <tr>
            <td width=\"100\" align=\"center\">".$r->fecha."</td>
            <td width=\"100\" align=\"center\">".$r->nomina."</td>
            <td width=\"200\" align=\"left\">".$r->nombre."</td>
            <td width=\"40\" align=\"center\">".number_format($r->turno,0)."</td>
            <td width=\"75\" align=\"right\">".number_format($r->fal,2)."</td>
            <td width=\"75\" align=\"right\">".$r->fecpre."</td>
            <td width=\"200\" align=\"left\">".$r->clavexx."</td>
            </tr>";
        $totfal=$totfal+$r->fal;
        }
        $detalle.="
        
         <tr>
            <td width=\"440\" align=\"right\">TOTAL</td>
            <td width=\"75\" align=\"right\">".number_format($totfal,2)."</td>
            <td width=\"75\" align=\"right\"></td>
        </tr>
         </table>
        <br /><br /><table>
         <tr>
            <td width=\"400\" align=\"center\">CAPTURA</td>
            <td width=\"20\" align=\"right\"></td>
            <td width=\"400\" align=\"center\">AUDITA</td>
         </tr>
          <br /><br /><br /><br /><tr>
            <td width=\"400\" align=\"center\">___________________________________________________</td>
            <td width=\"20\" align=\"right\"></td>
            <td width=\"400\" align=\"center\">___________________________________________________</td>
         </tr>
        
         </table>
        "; 
       ///////////////////////////////////////////////////////////////////****************************
       ///////////////////////////////////////////////////////////////////****************************

        return $detalle;
  
    }
    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function imprime_poliza_detalle_una1($fec,$suc,$quin,$mes,$plaza1)
    {
  $id_user= $this->session->userdata('id');
    $s="select *from catalogo.mes where num= ?";
        $q= $this->db->query($s,array($mes));
        $r=$q->row();
        $dia2=$r->dos;
    
         $gencan=0;
         $genval=0;
         $gencanche=0;
         $genche=0;
         
         $num=1;
         $tipo=0;
         $checan=0;
         $che=0;
         
         $subtotal_che=0;
         $varios_che=0;
         $iva_che=0;
         $isr_che=0;
         $ivar_che=0;
         $imp_che=0;
         
         $subtotal_che_can=0;
         $varios_che_can=0;
         $iva_che_can=0;
         $isr_che_can=0;
         $ivar_che_can=0;
         $imp_che_can=0;
         $tpesos=0;
        $tdolar=0;
        $tmn   =0;
        $tsan  =0;
        $tbbv  =0;
        $texp  =0;
        $tvale =0;
        $taire =0;
        $tcredito=0;
        $tiva  =0;
        $tasalto=0;

if($quin==1){
        $dia1=01;
        $dia2=15;
        $fec1=$fec.'-'.str_pad($dia1,2,0,STR_PAD_LEFT);
        $fec2=$fec.'-'.str_pad($dia2,2,0,STR_PAD_LEFT);
         $sql="select date_format(a.fechacorte, '%d') as dia, a.suc, a.id_user, a.cia,
sum((a.turno1_cambio+a.turno2_cambio+a.turno3_cambio+a.turno4_cambio)/4)as cambio,
sum(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos)as pesos,
sum(a.turno1_dolar+a.turno2_dolar+a.turno3_dolar+a.turno4_dolar)as dolar,
sum(a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn)as mn,
sum(a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as exp,
sum(a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv)as bbv,
sum(a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san)as san,
sum(a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale)as vale,
sum(a.turno1_asalto+a.turno2_asalto+a.turno3_asalto+a.turno4_asalto)as asalto,
sum(b.corregido)as iva,
sum(c.corregido)as credito,
sum(d.corregido) as aire,
e.nombre as sucx
FROM cortes_c a
left join cortes_d b on b.id_cc=a.id and b.clave1=49
left join cortes_d c on c.id_cc=a.id and c.clave1=30
left join cortes_d d on d.id_cc=a.id and d.clave1=20
left join catalogo.sucursal e on e.suc=a.suc 
         where a.fechacorte>= ? and a.fechacorte<= ? and a.id_user= ? and a.suc= ? and a.tipo>2 
            or a.fechacorte>= ? and a.fechacorte<= ? and a.id_cor= ?  and a.suc= ? and a.tipo>2
            or a.fechacorte>= ? and a.fechacorte<= ? and a.id_plaza= ?  and a.suc= ? and a.tipo>2
         group by a.suc, a.fechacorte";
         $query = $this->db->query($sql,array($fec1,$fec2,$id_user,$suc,$fec1,$fec2,$id_user,$suc,$fec1,$fec2,$plaza1,$suc));
}         
if($quin==2){
        $dia1=16;
        $fec1=$fec.'-'.str_pad($dia1,2,0,STR_PAD_LEFT);
        $fec2=$fec.'-'.str_pad($dia2,2,0,STR_PAD_LEFT);
         $sql="select date_format(a.fechacorte, '%d') as dia, a.suc, a.id_user, a.cia,
sum((a.turno1_cambio+a.turno2_cambio+a.turno3_cambio+a.turno4_cambio)/4)as cambio,
sum(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos)as pesos,
sum(a.turno1_dolar+a.turno2_dolar+a.turno3_dolar+a.turno4_dolar)as dolar,
sum(a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn)as mn,
sum(a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as exp,
sum(a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv)as bbv,
sum(a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san)as san,
sum(a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale)as vale,
sum(a.turno1_asalto+a.turno2_asalto+a.turno3_asalto+a.turno4_asalto)as asalto,
sum(b.corregido)as iva,
sum(c.corregido)as credito,
sum(d.corregido) as aire,
e.nombre as sucx
FROM cortes_c a
left join cortes_d b on b.id_cc=a.id and b.clave1=49
left join cortes_d c on c.id_cc=a.id and c.clave1=30
left join cortes_d d on d.id_cc=a.id and d.clave1=20
left join catalogo.sucursal e on e.suc=a.suc 
         where a.fechacorte>= ? and a.fechacorte<= ? and a.id_user= ? and a.suc= ? and a.tipo>2 
         or a.fechacorte>= ? and a.fechacorte<= ? and a.id_cor= ?  and a.suc= ? and a.tipo>2
         or a.fechacorte>= ? and a.fechacorte<= ? and a.id_plaza= ?  and a.suc= ? and a.tipo>2
         group by a.suc, a.fechacorte";
         $query = $this->db->query($sql,array($fec1,$fec2,$id_user,$suc,$fec1,$fec2,$id_user,$suc,$fec1,$fec2,$plaza1,$suc));
}         
if($quin==3){
        
         $sql="select date_format(a.fechacorte, '%d') as dia, a.suc, a.id_user, a.cia,
sum((a.turno1_cambio+a.turno2_cambio+a.turno3_cambio+a.turno4_cambio)/4)as cambio,
sum(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos)as pesos,
sum(a.turno1_dolar+a.turno2_dolar+a.turno3_dolar+a.turno4_dolar)as dolar,
sum(a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn)as mn,
sum(a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as exp,
sum(a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv)as bbv,
sum(a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san)as san,
sum(a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale)as vale,
sum(a.turno1_asalto+a.turno2_asalto+a.turno3_asalto+a.turno4_asalto)as asalto,

sum(b.corregido)as iva,
sum(c.corregido)as credito,
sum(d.corregido) as aire,
e.nombre as sucx
FROM cortes_c a
left join cortes_d b on b.id_cc=a.id and b.clave1=49
left join cortes_d c on c.id_cc=a.id and c.clave1=30
left join cortes_d d on d.id_cc=a.id and d.clave1=20
left join catalogo.sucursal e on e.suc=a.suc 
         where date_format(a.fechacorte, '%Y-%m')= ? and a.id_user= ? and a.suc= ? and a.tipo>2 
         or  date_format(a.fechacorte, '%Y-%m')= ? and a.id_cor= ?  and a.suc= ? and a.tipo>2
         or  date_format(a.fechacorte, '%Y-%m')= ? and a.id_plaza= ?  and a.suc= ? and a.tipo>2
         group by a.suc, a.fechacorte";
         $query = $this->db->query($sql,array($fec,$id_user,$suc,$fec,$id_user,$suc,$fec,$plaza1,$suc));
}            
         
         
          $detalle="<table border =\"1\"> 
 
        
        
           
           <tr bgcolor=\"gray\">
           <td width=\"40\" align=\"center\"><font size=\"-1\"><strong>DIA</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>EFECTIVO</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>DOLAR</strong></font></td>
           <td width=\"40\" align=\"center\"><font size=\"-1\"><strong>TIPO/CAM</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>CONVERSION</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>T.SANTANDER</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>T.BBV</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>T.EXP</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>VALES</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>TIEMPO AIRE</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>IVA DESGLOSADO</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>CREDITO CLIENTES</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>ASALTO</strong></font></td>
           </tr>
        ";
        
        
         foreach($query->result() as $row)
         {
         $detalle.="
            <tr>
            <td width=\"40\" align=\"center\">".$row->dia."</td>
            <td width=\"75\" align=\"right\">".number_format($row->pesos,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->dolar,2)."</td>
            <td width=\"40\" align=\"right\">".number_format($row->cambio,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->mn,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->san,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->bbv,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->exp,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->vale,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->aire,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->iva,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->credito,2)."</td>
            <td width=\"75\" align=\"right\">".number_format($row->asalto,2)."</td>
            </tr>";
        $tpesos=$tpesos+$row->pesos;
        $tdolar=$tdolar+$row->dolar;
        $tmn   =$tmn+$row->mn;
        $tsan  =$tsan+$row->san;
        $tbbv  =$tbbv+$row->bbv;
        $texp  =$texp+$row->exp;
        $tvale =$tvale+$row->vale;
        $taire =$taire+$row->aire;
        $tcredito=$tcredito+$row->credito;
        $tiva  =$tiva+$row->iva;
        $tasalto=$tasalto+$row->asalto;
        }
        $detalle.="
        <tr bgcolor=\"#BDBBBB\">
        <td width=\"40\" align=\"right\"><strong>TOTAL</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tpesos,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tdolar,2)."</strong></td>
        <td width=\"40\" align=\"right\"></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tmn,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tsan,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tbbv,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($texp,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tvale,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($taire,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tiva,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tcredito,2)."</strong></td>
        <td width=\"75\" align=\"right\"><strong>".number_format($tasalto,2)."</strong></td>
        </tr>"; 
        $tpesos=0;
        $tdolar=0;
        $tmn   =0;
        $tsan  =0;
        $tbbv  =0;
        $texp  =0;
        $tvale =0;
        $taire =0;
        $tcredito=0;
        $tiva  =0;
        $tasalto=0;
      
       $detalle.="</table>"; 
        ///////////////////////////////////////////////////////////////////****************************
       ///////////////////////////////////////////////////////////////////****************************faltantes de caja
  if($quin==1){
        $dia1=01;
        $dia2=15;
        $fec1=$fec.'-'.str_pad($dia1,2,0,STR_PAD_LEFT);
        $fec2=$fec.'-'.str_pad($dia2,2,0,STR_PAD_LEFT);
        $fecx=$fec.'-'.str_pad($dia2,2,0,STR_PAD_LEFT);
        $s="SELECT a.*,b.completo as nombre,c.nombre as clavexx
FROM faltante a
left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom
left join catalogo.cat_nom_claves c on c.clave=a.clave
where a.fecha>= ? and a.fecha<= ? and a.id_user= ? and a.suc= ? and a.tipo>1  and a.clave>518 and a.clave<521 
or a.fecha>= ? and a.fecha<= ? and a.id_cor= ? and a.suc= ? and a.tipo>1 and a.clave>518 and a.clave<521
or a.fecha>= ? and a.fecha<= ? and a.id_plaza= ? and a.suc= ? and a.tipo>1 and a.clave>518 and a.clave<521"
;
         $q = $this->db->query($s,array($fec1,$fec2,$id_user,$suc,$fec1,$fec2,$id_user,$suc,$fec1,$fec2,$plaza1,$suc));
} 
  if($quin==2){
        $dia1=16;
        $fec1=$fec.'-'.str_pad($dia1,2,0,STR_PAD_LEFT);
        $fec2=$fec.'-'.str_pad($dia2,2,0,STR_PAD_LEFT);
         $s="SELECT a.*,b.completo as nombre,c.nombre as clavexx
FROM faltante a
left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom
left join catalogo.cat_nom_claves c on c.clave=a.clave
where a.fecha>= ? and a.fecha<= ? and a.id_user= ? and a.suc= ? and a.tipo>1  and a.clave>518 and a.clave<521 
or a.fecha>= ? and a.fecha<= ? and a.id_cor= ? and a.suc= ? and a.tipo>1 and a.clave>518 and a.clave<521
or a.fecha>= ? and a.fecha<= ? and a.id_plaza= ? and a.suc= ? and a.tipo>1 and a.clave>518 and a.clave<521";
         $q = $this->db->query($s,array($fec1,$fec2,$id_user,$suc,$fec1,$fec2,$id_user,$suc,$fec1,$fec2,$plaza1,$suc));
}
  if($quin==3){
         $s="SELECT a.*,b.completo as nombre,c.nombre as clavexx
FROM faltante a
left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom
left join catalogo.cat_nom_claves c on c.clave=a.clave
where  date_format(a.fecha, '%Y-%m')= ? and a.id_user= ? and a.suc= ? and a.tipo>1  and a.clave>518 and a.clave<521 
or  date_format(a.fecha, '%Y-%m')= ? and a.id_cor= ? and a.suc= ? and a.tipo>1 and a.clave>518 and a.clave<521
or  date_format(a.fecha, '%Y-%m')= ? and a.id_plaza= ? and a.suc= ? and a.tipo>1 and a.clave>518 and a.clave<521";
         $q = $this->db->query($s,array($fec,$id_user,$suc,$fec,$id_user,$suc,$fec,$plaza1,$suc));
}        

$detalle.="<br /><table border =\"1\"> 
 
        
           <tr> 
           <td width=\"790\" align=\"center\"><font size=\"-1\"><strong>DESCUENTOS DE CORTES</strong></font></td>
           </tr>
           <tr bgcolor=\"#DDFEC5\">
           <td width=\"100\" align=\"center\"><font size=\"-1\"><strong>FECHA</strong></font></td>
           <td width=\"100\" align=\"center\"><font size=\"-1\"><strong>NOMINA</strong></font></td>
           <td width=\"200\" align=\"center\"><font size=\"-1\"><strong>EMPLEADO</strong></font></td>
           <td width=\"40\" align=\"center\"><font size=\"-1\"><strong>TURNO</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>MONTO</strong></font></td>
           <td width=\"75\" align=\"center\"><font size=\"-1\"><strong>APLICA NOMINAS</strong></font></td>
           <td width=\"200\" align=\"center\"><font size=\"-1\"><strong>CONCEPTO</strong></font></td>
           </tr>
        ";
        
        $totfal=0;
         foreach($q->result() as $r)
         {
          
         $detalle.="
            <tr>
            <td width=\"100\" align=\"center\">".$r->fecha."</td>
            <td width=\"100\" align=\"center\">".$r->nomina."</td>
            <td width=\"200\" align=\"left\">".$r->nombre."</td>
            <td width=\"40\" align=\"center\">".number_format($r->turno,0)."</td>
            <td width=\"75\" align=\"right\">".number_format($r->fal,2)."</td>
            <td width=\"75\" align=\"right\">".$r->fecpre."</td>
            <td width=\"200\" align=\"left\">".$r->clavexx."</td>
            </tr>";
        $totfal=$totfal+$r->fal;
        }
        $detalle.="
        
         <tr>
            <td width=\"440\" align=\"right\">TOTAL</td>
            <td width=\"75\" align=\"right\">".number_format($totfal,2)."</td>
            <td width=\"75\" align=\"right\"></td>
        </tr>
         </table>
        <br /><br /><table>
         <tr>
            <td width=\"400\" align=\"center\">CAPTURA</td>
            <td width=\"20\" align=\"right\"></td>
            <td width=\"400\" align=\"center\">AUDITA</td>
         </tr>
          <br /><br /><br /><br /><tr>
            <td width=\"400\" align=\"center\">___________________________________________________</td>
            <td width=\"20\" align=\"right\"></td>
            <td width=\"400\" align=\"center\">___________________________________________________</td>
         </tr>
        
         </table>
        "; 
       ///////////////////////////////////////////////////////////////////****************************
       ///////////////////////////////////////////////////////////////////****************************

        return $detalle;
  
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function busca_faltante($id)
    {
     $sql = "SELECT  a.*,b.nombre as sucx 
     FROM  fal_c a 
     left join catalogo.sucursal b on b.suc=a.suc
     where a.id= ?";
    $query = $this->db->query($sql,array($id));
    return $query; 
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
  function valida_member($id_cc)
    {
$id_user= $this->session->userdata('id');
$id_plaza= $this->session->userdata('id_plaza');
$aire=0;
$recarga=0;

 $sql = "SELECT a.recarga,b.corregido 
 from cortes_c a
 left join cortes_d b on b.id_cc=$id_cc and b.clave1=20 
 where 
 a.id= ? and a.id_user=? and recarga=corregido
 or
 a.id= ? and a.id_plaza=? and recarga=corregido
 "; 
 $query = $this->db->query($sql,array($id_cc,$id_user,$id_plaza));
$row= $query->row();
$aire=$row->recarga;
$recarga=$row->corregido;

if($recarga==$aire ){    
    
$data = array(
			'tipo' => 3,
			'fecha'=> date('Y-m-d H:s:i')
		);
		
		$this->db->where('id', $id_cc);
        $this->db->update('cortes_c', $data);
$datax = array(
			'tipo' => 3,
			'fecha'=> date('Y-m-d H:s:i')
		);
		
		$this->db->where('id_cc', $id_cc);
        $this->db->update('cortes_d', $datax);
}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_poliza($fec,$quin)
    {
        $mes=substr($fec,5,2);
        $num=1;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
        $id_plaza= $this->session->userdata('id_plaza');
        if($quin==1){
        $dia1=01;
        $dia2=15;
        $fec1=$fec.'-'.str_pad($dia1,2,0,STR_PAD_LEFT);
        $fec2=$fec.'-'.str_pad($dia2,2,0,STR_PAD_LEFT);
         $sql = "SELECT count(a.SUC)as dias,a.suc, d.nombre as sucx,
         sum(turno1_corte+turno2_corte+turno3_corte)as corte,
         sum(turno1_fal + turno2_fal + turno3_fal)as faltante,
         sum(turno1_sob + turno2_sob + turno3_sob)as sobrante,
         sum(turno1_asalto + turno2_asalto + turno3_asalto)as asalto,
         sum(turno1_pesos+ turno1_bbv + turno1_san+turno1_exp +turno1_asalto+turno1_vale+(turno1_cambio*turno1_dolar)+
                   turno2_pesos+turno2_bbv +turno2_san+turno2_exp +turno2_asalto+turno2_vale+(turno2_cambio*turno2_dolar)+
                   turno3_pesos+turno3_bbv +turno3_san+turno3_exp +turno3_asalto+turno3_vale+(turno3_cambio*turno3_dolar)
            )as arqueo
          FROM desarrollo.cortes_c a
          left join catalogo.sucursal d on d.suc=a.suc
          where a.id_plaza= ? and a.fechacorte>= ? and a.fechacorte<= ? and a.tipo>2 
          or id_cor= ? and a.fechacorte>= ? and a.fechacorte<= ? and a.tipo>2
          group by  a.suc";
        $query = $this->db->query($sql,array($id_plaza,$fec1,$fec2,$id_user,$fec1,$fec2,$id_plaza,$fec1,$fec2));
      
       }
        if($quin==2){
        $dia1=16;
        $s="select *from catalogo.mes where num= ?";
        $q= $this->db->query($s,array($mes));
        $r=$q->row();
        $dia2=$r->dos;
        $fec1=$fec.'-'.str_pad($dia1,2,0,STR_PAD_LEFT);
        $fec2=$fec.'-'.str_pad($dia2,2,0,STR_PAD_LEFT);
         $sql = "SELECT count(a.SUC)as dias,a.suc, d.nombre as sucx,
         sum(turno1_corte+turno2_corte+turno3_corte)as corte,
         sum(turno1_fal + turno2_fal + turno3_fal)as faltante,
         sum(turno1_sob + turno2_sob + turno3_sob)as sobrante,
         sum(turno1_asalto + turno2_asalto + turno3_asalto)as asalto,
         sum(turno1_pesos+ turno1_bbv + turno1_san+turno1_exp +turno1_asalto+turno1_vale+(turno1_cambio*turno1_dolar)+
                   turno2_pesos+turno2_bbv +turno2_san+turno2_exp +turno2_asalto+turno2_vale+(turno2_cambio*turno2_dolar)+
                   turno3_pesos+turno3_bbv +turno3_san+turno3_exp +turno3_asalto+turno3_vale+(turno3_cambio*turno3_dolar)
            )as arqueo
          FROM desarrollo.cortes_c a
          left join catalogo.sucursal d on d.suc=a.suc
          where id_user= ? and a.fechacorte>= ? and a.fechacorte<= ? and a.tipo>2 
          or id_cor= ? and a.fechacorte>= ? and a.fechacorte<= ? and a.tipo>2
          or a.id_plaza= ? and a.fechacorte>= ? and a.fechacorte<= ? and a.tipo>2
          group by  a.suc";
        $query = $this->db->query($sql,array($id_user,$fec1,$fec2,$id_user,$fec1,$fec2,$id_plaza,$fec1,$fec2));
       
       }
       if($quin==3){
        $dia1=01;
        $s="select *from catalogo.mes where num= ?";
        $q= $this->db->query($s,array($mes));
        $r=$q->row();
        $dia2=$r->dos;
        $fec1=$fec.'-'.str_pad($dia1,2,0,STR_PAD_LEFT);
        $fec2=$fec.'-'.str_pad($dia2,2,0,STR_PAD_LEFT);
         $sql = "SELECT count(a.SUC)as dias,a.suc, d.nombre as sucx,
         sum(turno1_corte+turno2_corte+turno3_corte)as corte,
         sum(turno1_fal + turno2_fal + turno3_fal)as faltante,
         sum(turno1_sob + turno2_sob + turno3_sob)as sobrante,
         sum(turno1_asalto + turno2_asalto + turno3_asalto)as asalto,
         sum(turno1_pesos+ turno1_bbv + turno1_san+turno1_exp +turno1_asalto+turno1_vale+(turno1_cambio*turno1_dolar)+
                   turno2_pesos+turno2_bbv +turno2_san+turno2_exp +turno2_asalto+turno2_vale+(turno2_cambio*turno2_dolar)+
                   turno3_pesos+turno3_bbv +turno3_san+turno3_exp +turno3_asalto+turno3_vale+(turno3_cambio*turno3_dolar)
            )as arqueo
          FROM desarrollo.cortes_c a
          left join catalogo.sucursal d on d.suc=a.suc
          where a.id_plaza= ? and a.fechacorte>= ? and a.fechacorte<= ? and a.tipo>2 
          or id_cor= ? and a.fechacorte>= ? and a.fechacorte<= ? and a.tipo>2
          or a.id_plaza= ? and a.fechacorte>= ? and a.fechacorte<= ? and a.tipo>2
          group by  a.suc";
        $query = $this->db->query($sql,array($id_plaza,$fec1,$fec2,$id_user,$fec1,$fec2,$id_plaza,$fec1,$fec2));
       
       }

        $tabla= "
        <table>
        <thead>
        
        <tr>
        <th>#</th>
        <th>SUCURSAL</th>
        <th>VTA.CORTE</th>
        <th>ARQUEO</th>
        <th>FALTANTE</th>
         <th>NO.VAL</th>
        <th>FAL.NOMINAS</th>
        <th>SOBRANTE</th>
        <th>ASALTO</th>
        <th>DIAS</th>
        <th>REPORTE</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
 ////<td align=\"right\">".number_format($row->fal,2)."</td>
        $fal_nulx=0;
        $cre=0;           
        $suc=$row->suc;
          $sql0 = "SELECT suc,sum(fal)as fal  from faltante  
         where  fecha>= ? and  fecha<= ? and suc= ? and clave=520 and tipo<>4 group by suc";
       $query0 = $this->db->query($sql0,array($fec1,$fec2,$suc));
        if($query0->num_rows() == 1){ 
        $row0= $query0->row();
        $fal_des=$row0->fal; 
        }else{$fal_des=0;} 
        $sql00 = "SELECT suc,sum(fal)as fal  from faltante  
         where  fecha>= '$fec1' and  fecha<= '$fec2' and suc= $suc and  tipo=1  and clave=520 group by suc";
       $query00 = $this->db->query($sql00);
        if($query00->num_rows() >0){ 
        $row00= $query00->row();
        $fal_nulx=$row00->fal; 
        }else{$fal_nulx=0;}
 
       $s = "SELECT a.*,b.fechacorte,b.id_user,b.suc,sum(a.corregido)as corregido
          FROM desarrollo.cortes_d a
          left join desarrollo.cortes_c b on b.id=a.id_cc 
          where b.id_user= $id_user and b.fechacorte>= '$fec1' and b.fechacorte<= '$fec2' and a.val_cre=1 and b.suc=$suc and clave1=40
          group by  b.suc";
       $q = $this->db->query($s);
      
        if($q->num_rows() >0){ 
        $r= $q->row();
        $cre=$r->corregido; 
        }else{$cre=0;}
               
    
          
        
 if($fal_nulx==0 && $cre==0 ){           
$l1 =anchor('cortes/imprimir_poliza_una/'.$fec.'/'.$row->suc.'/'.$quin, ' IMPRIME<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
}else{
$l1 ="<strong>VALIDAR FALTANTES o CREDITOS</strong>";    
}

            $tabla.="
            <tr>
            
            
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$row->sucx."(".$row->suc.")</td>
            <td align=\"right\">".number_format($row->arqueo,2)."</td>
            <td align=\"right\">".number_format($row->corte,2)."</td>
            <td align=\"right\">".number_format($row->faltante,2)."</td>
            <td align=\"right\"><font size=\"1\" color=\"red\"><strong>".number_format($fal_nulx,2)."</strong></font></td>
            <td align=\"right\">".number_format($fal_des,2)."</td>
            <td align=\"right\">".number_format($row->sobrante,2)."</td>
            <td align=\"right\">".number_format($row->asalto,2)."</td>
            <td align=\"right\">".number_format($row->dias,0)."</td>
            <td align=\"center\">".$l1."</td>
            
             
            
            </tr>
            ";
         $num=$num+1;
         $arqueo=0;
         $fal=0;
         $sob=0;
         $corte=0;
        
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_poliza1($fec,$quin,$plaza1)
    {
        $mes=substr($fec,5,2);
        $num=1;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
        if($quin==1){
        $dia1=01;
        $dia2=15;
        $fec1=$fec.'-'.str_pad($dia1,2,0,STR_PAD_LEFT);
        $fec2=$fec.'-'.str_pad($dia2,2,0,STR_PAD_LEFT);
         $sql = "SELECT count(a.SUC)as dias,a.suc, d.nombre as sucx,
         sum(turno1_corte+turno2_corte+turno3_corte)as corte,
         sum(turno1_fal + turno2_fal + turno3_fal)as faltante,
         sum(turno1_sob + turno2_sob + turno3_sob)as sobrante,
         sum(turno1_asalto + turno2_asalto + turno3_asalto)as asalto,
         sum(turno1_pesos+ turno1_bbv + turno1_san+turno1_exp +turno1_asalto+turno1_vale+(turno1_cambio*turno1_dolar)+
                   turno2_pesos+turno2_bbv +turno2_san+turno2_exp +turno2_asalto+turno2_vale+(turno2_cambio*turno2_dolar)+
                   turno3_pesos+turno3_bbv +turno3_san+turno3_exp +turno3_asalto+turno3_vale+(turno3_cambio*turno3_dolar)
            )as arqueo
          FROM desarrollo.cortes_c a
          left join catalogo.sucursal d on d.suc=a.suc
          where id_user= ? and a.fechacorte>= ? and a.fechacorte<= ? and a.tipo>2 
          or id_cor= ? and a.fechacorte>= ? and a.fechacorte<= ? and a.tipo>2
          or a.id_plaza= ? and a.fechacorte>= ? and a.fechacorte<= ? and a.tipo>2
          group by  a.suc";
        $query = $this->db->query($sql,array($id_user,$fec1,$fec2,$id_user,$fec1,$fec2,$plaza1,$fec1,$fec2));
      //echo $this->db->last_query();
      //echo die;
       }
        if($quin==2){
        $dia1=16;
        $s="select *from catalogo.mes where num= ?";
        $q= $this->db->query($s,array($mes));
        $r=$q->row();
        $dia2=$r->dos;
        $fec1=$fec.'-'.str_pad($dia1,2,0,STR_PAD_LEFT);
        $fec2=$fec.'-'.str_pad($dia2,2,0,STR_PAD_LEFT);
         $sql = "SELECT count(a.SUC)as dias,a.suc, d.nombre as sucx,
         sum(turno1_corte+turno2_corte+turno3_corte)as corte,
         sum(turno1_fal + turno2_fal + turno3_fal)as faltante,
         sum(turno1_sob + turno2_sob + turno3_sob)as sobrante,
         sum(turno1_asalto + turno2_asalto + turno3_asalto)as asalto,
         sum(turno1_pesos+ turno1_bbv + turno1_san+turno1_exp +turno1_asalto+turno1_vale+(turno1_cambio*turno1_dolar)+
                   turno2_pesos+turno2_bbv +turno2_san+turno2_exp +turno2_asalto+turno2_vale+(turno2_cambio*turno2_dolar)+
                   turno3_pesos+turno3_bbv +turno3_san+turno3_exp +turno3_asalto+turno3_vale+(turno3_cambio*turno3_dolar)
            )as arqueo
          FROM desarrollo.cortes_c a
          left join catalogo.sucursal d on d.suc=a.suc
          where id_user= ? and a.fechacorte>= ? and a.fechacorte<= ? and a.tipo>2 
          or id_cor= ? and a.fechacorte>= ? and a.fechacorte<= ? and a.tipo>2
          or a.id_plaza= ? and a.fechacorte>= ? and a.fechacorte<= ? and a.tipo>2
          group by  a.suc";
        $query = $this->db->query($sql,array($id_user,$fec1,$fec2,$id_user,$fec1,$fec2,$plaza1,$fec1,$fec2));
       
       }
       if($quin==3){
        $dia1=01;
        $s="select *from catalogo.mes where num= ?";
        $q= $this->db->query($s,array($mes));
        $r=$q->row();
        $dia2=$r->dos;
        $fec1=$fec.'-'.str_pad($dia1,2,0,STR_PAD_LEFT);
        $fec2=$fec.'-'.str_pad($dia2,2,0,STR_PAD_LEFT);
         $sql = "SELECT count(a.SUC)as dias,a.suc, d.nombre as sucx,
         sum(turno1_corte+turno2_corte+turno3_corte)as corte,
         sum(turno1_fal + turno2_fal + turno3_fal)as faltante,
         sum(turno1_sob + turno2_sob + turno3_sob)as sobrante,
         sum(turno1_asalto + turno2_asalto + turno3_asalto)as asalto,
         sum(turno1_pesos+ turno1_bbv + turno1_san+turno1_exp +turno1_asalto+turno1_vale+(turno1_cambio*turno1_dolar)+
                   turno2_pesos+turno2_bbv +turno2_san+turno2_exp +turno2_asalto+turno2_vale+(turno2_cambio*turno2_dolar)+
                   turno3_pesos+turno3_bbv +turno3_san+turno3_exp +turno3_asalto+turno3_vale+(turno3_cambio*turno3_dolar)
            )as arqueo
          FROM desarrollo.cortes_c a
          left join catalogo.sucursal d on d.suc=a.suc
          where id_user= ? and a.fechacorte>= ? and a.fechacorte<= ? and a.tipo>2 
          or id_cor= ? and a.fechacorte>= ? and a.fechacorte<= ? and a.tipo>2
          or a.id_plaza= ? and a.fechacorte>= ? and a.fechacorte<= ? and a.tipo>2
          group by  a.suc";
        $query = $this->db->query($sql,array($id_user,$fec1,$fec2,$id_user,$fec1,$fec2,$plaza1,$fec1,$fec2));
       
       }

        $tabla= "
        <table>
        <thead>
        
        <tr>
        <th>#</th>
        <th>SUCURSAL</th>
        <th>VTA.CORTE</th>
        <th>ARQUEO</th>
        <th>FALTANTE</th>
         <th>NO.VAL</th>
        <th>FAL.NOMINAS</th>
        <th>SOBRANTE</th>
        <th>ASALTO</th>
        <th>DIAS</th>
        <th>REPORTE</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
 ////<td align=\"right\">".number_format($row->fal,2)."</td>
        $fal_nulx=0;
        $cre=0;           
        $suc=$row->suc;
          $sql0 = "SELECT suc,sum(fal)as fal  from faltante  
         where  fecha>= ? and  fecha<= ? and suc= ? and clave=520 group by suc";
       $query0 = $this->db->query($sql0,array($fec1,$fec2,$suc));
        if($query0->num_rows() == 1){ 
        $row0= $query0->row();
        $fal_des=$row0->fal; 
        }else{$fal_des=0;} 
        $sql00 = "SELECT suc,sum(fal)as fal  from faltante  
         where  fecha>= '$fec1' and  fecha<= '$fec2' and suc= $suc and  tipo=1  and clave=520 group by suc";
       $query00 = $this->db->query($sql00);
        if($query00->num_rows() >0){ 
        $row00= $query00->row();
        $fal_nulx=$row00->fal; 
        }else{$fal_nulx=0;}
 
       $s = "SELECT a.*,b.fechacorte,b.id_user,b.suc,sum(a.corregido)as corregido
          FROM desarrollo.cortes_d a
          left join desarrollo.cortes_c b on b.id=a.id_cc 
          where b.id_plaza= '$plaza1' and b.fechacorte>= '$fec1' and b.fechacorte<= '$fec2' and a.val_cre=1 and b.suc=$suc and clave1=40
          group by  b.suc";
       $q = $this->db->query($s);
      
        if($q->num_rows() >0){ 
        $r= $q->row();
        $cre=$r->corregido; 
        }else{$cre=0;}
               
        
          
        
 if($fal_nulx==0 && $cre==0){           
$l1 =anchor('cortes/imprimir_poliza_una1/'.$fec.'/'.$row->suc.'/'.$quin.'/'.$plaza1, ' IMPRIME<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));
}else{
$l1 ="<strong>VALIDAR FALTANTES o CREDITOS</strong>";    
}

            $tabla.="
            <tr>
            
            
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$row->sucx."(".$row->suc.")</td>
            <td align=\"right\">".number_format($row->arqueo,2)."</td>
            <td align=\"right\">".number_format($row->corte,2)."</td>
            <td align=\"right\">".number_format($row->faltante,2)."</td>
            <td align=\"right\"><font size=\"1\" color=\"red\"><strong>".number_format($fal_nulx,2)."</strong></font></td>
            <td align=\"right\">".number_format($fal_des,2)."</td>
            <td align=\"right\">".number_format($row->sobrante,2)."</td>
            <td align=\"right\">".number_format($row->asalto,2)."</td>
            <td align=\"right\">".number_format($row->dias,0)."</td>
            <td align=\"center\">".$l1."</td>
            
             
            
            </tr>
            ";
         $num=$num+1;
         $arqueo=0;
         $fal=0;
         $sob=0;
         $corte=0;
        
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_corte_edita($fec)
    {
        $num=1;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
        $id_plaza = $this->session->userdata('id_plaza');
         $sql = "SELECT a.tipo,count(a.SUC)as dias,a.suc, d.nombre as sucx,
         sum(turno1_corte+turno2_corte+turno3_corte)as corte,
         sum(turno1_fal + turno2_fal + turno3_fal)as faltante,
         sum(turno1_sob + turno2_sob + turno3_sob)as sobrante,
         sum(turno1_asalto + turno2_asalto + turno3_asalto)as asalto,
         sum(turno1_pesos+ turno1_bbv + turno1_san+turno1_exp +turno1_asalto+turno1_vale+(turno1_cambio*turno1_dolar)+
                   turno2_pesos+turno2_bbv +turno2_san+turno2_exp +turno2_asalto+turno2_vale+(turno2_cambio*turno2_dolar)+
                   turno3_pesos+turno3_bbv +turno3_san+turno3_exp +turno3_asalto+turno3_vale+(turno3_cambio*turno3_dolar)
            )as arqueo
        
          FROM desarrollo.cortes_c a
          left join catalogo.sucursal d on d.suc=a.suc
          where id_cor= ? and date_format(a.fechacorte, '%Y-%m')= ? and a.tipo>2
          group by  a.suc, a.tipo order by suc";
      
        $query = $this->db->query($sql,array($id_user,$fec));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>SUCURSAL</th>
        <th>VTA.CORTE</th>
        <th>ARQUEO</th>
        <th>FALTANTE</th>
        <th>SOBRANTE</th>
        <th>ASALTO</th>
        <th>DIAS</th>
        <th>REPORTE</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
            
            
if($row->tipo==3){
            $l1 =anchor('cortes/editar_poliza_una/'.$fec.'/'.$row->suc, ' EDITAR<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado'));   
            $l2 =anchor('cortes/marcar/'.$fec.'/'.$row->suc, ' <img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para marcar!', 'class' => 'encabezado'));
}else{
            $l1 ='';   
            $l2 =anchor('cortes/desmarcar/'.$fec.'/'.$row->suc, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para quitar!', 'class' => 'encabezado'));
    
}           
            $tabla.="
            <tr>
            
            
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$row->suc." - ".$row->sucx."</td>
            <td align=\"right\">".number_format($row->arqueo,2)."</td>
            <td align=\"right\">".number_format($row->corte,2)."</td>
            <td align=\"right\">".number_format($row->faltante,2)."</td>
            <td align=\"right\">".number_format($row->sobrante,2)."</td>
            <td align=\"right\">".number_format($row->asalto,2)."</td>
            <td align=\"right\">".number_format($row->dias,0)."</td>
            <td align=\"center\">".$l1."</td>
            <td align=\"center\">".$l2."</td>
            
             
            
            </tr>
            ";
         $num=$num+1;
         $arqueo=0;
         $fal=0;
         $sob=0;
         $corte=0;
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function control_corte_edita_suc($fec,$suc)
    {
        $num=1;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
         $sql = "SELECT a.fechacorte,a.id, a.suc, d.nombre as sucx,
         (turno1_corte+turno2_corte+turno3_corte)as corte,
         (turno1_fal + turno2_fal + turno3_fal)as faltante,
         (turno1_sob + turno2_sob + turno3_sob)as sobrante,
         (turno1_asalto + turno2_asalto + turno3_asalto)as asalto,
         (turno1_pesos+ turno1_bbv + turno1_san+turno1_exp +turno1_asalto+turno1_vale+(turno1_cambio*turno1_dolar)+
                   turno2_pesos+turno2_bbv +turno2_san+turno2_exp +turno2_asalto+turno2_vale+(turno2_cambio*turno2_dolar)+
                   turno3_pesos+turno3_bbv +turno3_san+turno3_exp +turno3_asalto+turno3_vale+(turno3_cambio*turno3_dolar)
            )as arqueo,recarga,b.corregido as iva
        
          FROM desarrollo.cortes_c a
          left join catalogo.sucursal d on d.suc=a.suc
          left join cortes_d b on b.id_cc=a.id and b.clave1=49
          where id_cor= ? and date_format(a.fechacorte, '%Y-%m')= ? and a.suc= ? and a.tipo=3 order by suc,fechacorte ";
      
        $query = $this->db->query($sql,array($id_user,$fec,$suc));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>SUCURSAL</th>
        <th>FECHA</th>
        <th>VTA.CORTE</th>
        <th>ARQUEO</th>
         <th>RECARGA</th>
         <th>IVA</th>
        <th>FALTANTE</th>
        <th>SOBRANTE</th>
        <th>ASALTO</th>
        <th>EDIT.</th>
        <th>REGR.</th>
        <th>BOR.</th>
        
        
        </tr>

        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
            
            $l1 =anchor('cortes/tabla_detalle_his_corte/'.$fec.'/'.$row->suc.'/'.$row->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));
            $l2 =anchor('cortes/tabla_detalle_his_regresar/'.$fec.'/'.$row->suc.'/'.$row->id, '<img src="'.base_url().'img/icon_nav_settings.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para regresar a editar cortes por linea!', 'class' => 'encabezado'));
            $l3 =anchor('cortes/tabla_detalle_his_borrar/'.$fec.'/'.$row->suc.'/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar corte!', 'class' => 'encabezado'));
            $tabla.="
            <tr>
             <td align=\"left\">".$row->suc." - ".$row->sucx."</td>
             <td align=\"left\">".$row->fechacorte."</td>
            <td align=\"right\">".number_format($row->arqueo,2)."</td>
            <td align=\"right\">".number_format($row->corte,2)."</td>
            <td align=\"right\">".number_format($row->recarga,2)."</td>
            <td align=\"right\">".number_format($row->iva,2)."</td>
            <td align=\"right\">".number_format($row->faltante,2)."</td>
            <td align=\"right\">".number_format($row->sobrante,2)."</td>
            <td align=\"right\">".number_format($row->asalto,2)."</td>
            <td align=\"center\">".$l1."</td>
            <td align=\"center\">".$l2."</td>
            <td align=\"center\">".$l3."</td>
          </tr>
            ";
         $num=$num+1;
         $arqueo=0;
         $fal=0;
         $sob=0;
         $corte=0;
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function update_member_c_regresar($id_cc)
{
$dataa = array('tipo'=>2);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
$dataa = array('tipo'=>2);$this->db->where('id', $id_cc);$this->db->update('cortes_c', $dataa);    
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function delete_member_c_borrar($id_cc)
{
        $this->db->delete('desarrollo.cortes_c', array('id' => $id_cc ));
        $this->db->delete('desarrollo.cortes_d', array('id_cc' => $id_cc));
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function update_member_d_corte($id_cc,$l1,$l2,$l4,$l5,$l8,$l9,$l10,$l11,$l12,$l13,$l16,$l19,$l20,$l21,$l22,$l23,$l24,$l30,$l40,
$la1,$la2,$la4,$la5,$la8,$la9,$la10,$la11,$la12,$la13,$la16,$la19,$la20,$la21,$la22,$la23,$la24,$la30,$la40,
$lc1,$lc2,$lc4,$lc5,$lc8,$lc9,$lc10,$lc11,$lc12,$lc13,$lc16,$lc19,$lc20,$lc21,$lc22,$lc23,$lc24,$lc30,$lc40,
        $turno1_pesos,$turno1_dolar,$turno1_cambio,$turno1_bbv,$turno1_san,$turno1_exp,$turno1_asalto,$turno1_vale,$turno1_cajera,$turno1_corte,
        $turno2_pesos,$turno2_dolar,$turno2_cambio,$turno2_bbv,$turno2_san,$turno2_exp,$turno2_asalto,$turno2_vale,$turno2_cajera,$turno2_corte,  
        $turno3_pesos,$turno3_dolar,$turno3_cambio,$turno3_bbv,$turno3_san,$turno3_exp,$turno3_asalto,$turno3_vale,$turno3_cajera,$turno3_corte,
        $turno4_pesos,$turno4_dolar,$turno4_cambio,$turno4_bbv,$turno4_san,$turno4_exp,$turno4_asalto,$turno4_vale,$turno4_cajera,$turno4_corte,$ivaa)
	{
 $id_user= $this->session->userdata('id');
///////////////////////////////////////////////////*****************


if($l1>0 || $la1>0 || $lc1>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=1 and  a.tipo=3";
 $queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>1,'venta'=>$l1,'corregido' =>$l1+$la1-$lc1,'fecha'=> date('Y-m-d'),'cancel'=>$lc1,'aumento'=>$la1,'tipo'=>3, 'siniva' =>$l1+$la1-$lc1
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l1,'aumento' => $la1,'cancel' => $lc1,'corregido' => $l1+$la1-$lc1,'tipo'=>3, 'siniva' =>$l1+$la1-$lc1);
		$this->db->where('clave1', 1);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 1);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}


if($l2>0 or $la2>0 or $lc2>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=2 and  a.tipo=3";
 $queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
    $new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>2, 'venta'=>$l2,'corregido' =>$l2+$la2-$lc2,'fecha'=>date('Y-m-d'),'cancel'=>$lc2,'aumento'=>$la2,'tipo'=>3, 'siniva' =>($l2+$la2-$lc2)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l2,'aumento' => $la2,'cancel' => $lc2,'corregido' => $l2+$la2-$lc2,'tipo'=>3, 'siniva' =>($l2+$la2-$lc2)/$ivaa);
		$this->db->where('clave1', 2);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 2);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

if($l4>0 || $la4>0 || $lc4>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=4 and  a.tipo=3";
 $queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>4, 'venta'=>$l4,'corregido' =>$l4+$la4-$lc4,'fecha'=>date('Y-m-d'),'cancel'=>$lc4,'aumento'=>$la4,'tipo'=>3, 'siniva' =>$l4+$la4-$lc4
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l4,'aumento' => $la4,'cancel' => $lc4,'corregido' => $l4+$la4-$lc4,'tipo'=>3, 'siniva' =>$l4+$la4-$lc4);
		$this->db->where('clave1', 4);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 4);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}


if($l5>0 || $la5>0 || $lc5>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=5 and  a.tipo=3";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
    $new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>5, 'venta'=>$l5,'corregido' =>$l5+$la5-$lc5,'fecha'=>date('Y-m-d'),'cancel'=>$lc5,'aumento'=>$la5,'tipo'=>3, 'siniva' =>($l5+$la5-$lc5)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l5,'aumento' => $la5,'cancel' => $lc5,'corregido' => $l5+$la5-$lc5,'tipo'=>3, 'siniva' =>($l5+$la5-$lc5)/$ivaa);
		$this->db->where('clave1', 5);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 5);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
    
if($l8>0 || $la8>0 || $lc8>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=8 and  a.tipo=3";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>8, 'venta'=>$l8,'corregido' =>$l8+$la8-$lc8,'fecha'=>date('Y-m-d'),'cancel'=>$lc8,'aumento'=>$la8,'tipo'=>3, 'siniva' =>$l8+$la8-$lc8
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l8,'aumento' => $la8,'cancel' => $lc8,'corregido' => $l8+$la8-$lc8,'tipo'=>3, 'siniva' =>$l8+$la8-$lc8);
		$this->db->where('clave1', 8);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 8);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

    
if($l9>0 || $la9>0 || $lc9>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=9 and  a.tipo=3";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>9, 'venta'=>$l9,'corregido' =>$l9+$la9-$lc9,'fecha'=>date('Y-m-d'),'cancel'=>$lc9,'aumento'=>$la9,'tipo'=>3, 'siniva' =>($l9+$la9-$lc9)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l9,'aumento' => $la9,'cancel' => $lc9,'corregido' => $l9+$la9-$lc9,'tipo'=>3, 'siniva' =>($l9+$la9-$lc9)/$ivaa);
		$this->db->where('clave1', 9);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 9);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}


if($l10>0 || $la10>0 || $lc10>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=10 and  a.tipo=3";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>10, 'venta'=>$l10,'corregido' =>$l10+$la10-$lc10,'fecha'=>date('Y-m-d'),'cancel'=>$lc10,'aumento'=>$la10,'tipo'=>3, 'siniva' =>$l10+$la10-$lc10
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l10,'aumento' => $la10,'cancel' => $lc10,'corregido' => $l10+$la10-$lc10,'tipo'=>3, 'siniva' =>$l10+$la10-$lc10);
		$this->db->where('clave1', 10);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 10);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}


if($l11>0 || $la11>0 || $lc11>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=11 and  a.tipo=3";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>11, 'venta'=>$l11,'corregido' =>$l11+$la11-$lc11,'fecha'=>date('Y-m-d'),'cancel'=>$lc11,'aumento'=>$la11,'tipo'=>3, 'siniva' =>($l11+$la11-$lc11)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l11,'aumento' => $la11,'cancel' => $lc11,'corregido' => $l11+$la11-$lc11,'tipo'=>3, 'siniva' =>($l11+$la11-$lc11)/$ivaa);
		$this->db->where('clave1', 11);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 11);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}


if($l12>0 || $la12>0 || $lc12>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=12 and  a.tipo=3";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>12, 'venta'=>$l12,'corregido' =>$l12+$la12-$lc12,'fecha'=>date('Y-m-d'),'cancel'=>$lc12,'aumento'=>$la12,'tipo'=>3, 'siniva' =>$l12+$la12-$lc12
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l12,'aumento' => $la12,'cancel' => $lc12,'corregido' => $l12+$la12-$lc12,'tipo'=>3, 'siniva' =>$l12+$la12-$lc12);
		$this->db->where('clave1', 12);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 12);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}


if($l13>0 || $la13>0 || $lc13>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=13 and  a.tipo=3";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>13, 'venta'=>$l13,'corregido' =>$l13+$la13-$lc13,'fecha'=>date('Y-m-d'),'cancel'=>$lc13,'aumento'=>$la13,'tipo'=>3, 'siniva' =>$l13+$la13-$lc13
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
 $dataa = array('venta' => $l13,'aumento' => $la13,'cancel' => $lc13,'corregido' => $l13+$la13-$lc13,'tipo'=>3, 'siniva' =>$l13+$la13-$lc13);
		$this->db->where('clave1', 13);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 13);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}


if($l16>0 || $la16>0 || $lc16>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=16 and  a.tipo=3";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>16, 'venta'=>$l16,'corregido' =>$l16+$la16-$lc16,'fecha'=>date('Y-m-d'),'cancel'=>$lc16,'aumento'=>$la16,'tipo'=>3, 'siniva' =>$l16+$la16-$lc16
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l16,'aumento' => $la16,'cancel' => $lc16,'corregido' => $l16+$la16-$lc16,'tipo'=>3, 'siniva' =>$l16+$la16-$lc16);
		$this->db->where('clave1', 16);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 16);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}


if($l19>0 || $la19>0 || $lc19>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=19 and  a.tipo=3";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>19, 'venta'=>$l19,'corregido' =>$l19+$la19-$lc19,'fecha'=>date('Y-m-d'),'cancel'=>$lc19,'aumento'=>$la19,'tipo'=>3, 'siniva' =>($l19+$la19-$lc19)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
 $dataa = array('venta' => $l19,'aumento' => $la19,'cancel' => $lc19,'corregido' => $l19+$la19-$lc19,'tipo'=>3, 'siniva' =>($l19+$la19-$lc19)/$ivaa);
		$this->db->where('clave1', 19);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 19);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}


if($l20>0 || $lc20>0 || $la20>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=20 and  a.tipo=3";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=> 20, 'venta'=>$l20,'corregido' =>$l20+$la20-$lc20,'fecha'=>date('Y-m-d'),'cancel'=>$lc20,'aumento'=>$la20,'tipo'=>3, 'siniva' =>($l20+$la20-$lc20)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
 $dataa = array('venta' => $l20,'aumento' => $la20,'cancel' => $lc20,'corregido' => $l20+$la20-$lc20,'tipo'=>3, 'siniva' =>($l20+$la20-$lc20)/$ivaa);
		$this->db->where('clave1', 20);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);

}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 20);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}


if($l21>0 || $la21>0 || $lc21>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=21 and  a.tipo=3";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>21, 'venta'=>$l21,'corregido' =>$l21+$la21-$lc21,'fecha'=>date('Y-m-d'),'cancel'=>$lc21,'aumento'=>$la21,'tipo'=>3, 'siniva' =>($l21+$la21-$lc21)/$ivaa
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l21,'aumento' => $la21,'cancel' => $lc21,'corregido' => $l21+$la21-$lc21,'tipo'=>3, 'siniva' =>($l21+$la21-$lc21)/$ivaa);
		$this->db->where('clave1', 21);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 21);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}


if($l22>0 || $la22>0 || $lc22>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=22 and  a.tipo=3";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>22, 'venta'=>$l22,'corregido' =>$l22+$la22-$lc22,'fecha'=>date('Y-m-d'),'cancel'=>$lc22,'aumento'=>$la22,'tipo'=>3, 'siniva' =>$l22+$la22-$lc22
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l22,'aumento' => $la22,'cancel' => $lc22,'corregido' => $l22+$la22-$lc22,'tipo'=>3, 'siniva' =>$l22+$la22-$lc22);
		$this->db->where('clave1', 22);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 22);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}


if($l23>0 || $la23>0 || $lc23>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=23 and  a.tipo=3";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>23, 'venta'=>$l23,'corregido' =>$l23+$la23-$lc23,'fecha'=>date('Y-m-d'),'cancel'=>$lc23,'aumento'=>$la23,'tipo'=>3, 'siniva' =>$l23+$la23-$lc23
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l23,'aumento' => $la23,'cancel' => $lc23,'corregido' => $l23+$la23-$lc23,'tipo'=>3, 'siniva' =>$l23+$la23-$lc23);
		$this->db->where('clave1', 23);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 23);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}


if($l24>0 || $la24>0 || $lc24>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=24 and  a.tipo=3";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>24, 'venta'=>$l24,'corregido' =>$l24+$la24-$lc24,'fecha'=>date('Y-m-d'),'cancel'=>$lc24,'aumento'=>$la24,'tipo'=>3, 'siniva' =>$l24+$la24-$lc24
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l24,'aumento' => $la24,'cancel' => $lc24,'corregido' => $l24+$la24-$lc24,'tipo'=>3, 'siniva' =>$l24+$la24-$lc24);
		$this->db->where('clave1', 24);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 24);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}


if($l30>0 || $la30>0 || $lc30>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=30 and  a.tipo=3";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>30, 'venta'=>$l30,'corregido' =>$l30+$la30-$lc30,'fecha'=>date('Y-m-d'),'cancel'=>$lc30,'aumento'=>$la30,'tipo'=>3, 'siniva' =>$l30+$la30-$lc30
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l30,'aumento' => $la30,'cancel' => $lc30,'corregido' => $l30+$la30-$lc30,'tipo'=>3, 'siniva' =>$l30+$la30-$lc30);
		$this->db->where('clave1', 30);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 30);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

if($l40>0 || $la40>0 || $lc40>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=40 and  a.tipo=3";
$queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array('id_cc'=>$id_cc,'clave1'=>40, 'venta'=>$l40,'corregido' =>$l40+$la40-$lc40,'fecha'=>date('Y-m-d'),'cancel'=>$lc40,'aumento'=>$la40,'tipo'=>3, 'siniva' =>$l40+$la40-$lc40
);$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);
}else{
$dataa = array('venta' => $l40,'aumento' => $la40,'cancel' => $lc40,'corregido' => $l40+$la40-$lc40,'tipo'=>3, 'siniva' =>$l40+$la40-$lc40);
		$this->db->where('clave1', 40);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}
}else{
$dataa = array('venta' => 0,'aumento' => 0,'cancel' => 0,'corregido' => 0,'tipo'=>3, 'siniva' =>0);
		$this->db->where('clave1', 40);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dataa);
}

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
$subtotal=$l2+$l5+$l9+$l11+$l19+$l20+$l21+
           $la2+$la5+$la11+$la19+$la9+$la20+$la21-
           $lc2-$lc5-$lc11-$lc19-$lc9-$lc20-$lc21;
$cancel=$lc2+$lc5+$lc11+$lc19+$lc9+$lc20+$lc21;
$cancelx=$cancel-($cancel/$ivaa);
if($cancel==null){$cancel=0;$cancelx=0;}
$aumen=$la2+$la5+$la11+$la19+$la9+$la20+$la21;
$aumenx=$aumen-($aumen/$ivaa);
if($aumen==null){$aumen=0;$aumenx=0;}
///////////////////////////////////////////////////*****************

if($subtotal>0){$iva=$subtotal-($subtotal/$ivaa);}else{$subtotal=0;} 
if($subtotal>0){
$sqlx = "SELECT a.* FROM desarrollo.cortes_d a where a.id_cc = ? and clave1=49 and  a.tipo=3";

 $queryx = $this->db->query($sqlx,array($id_cc));
if($queryx->num_rows()== 0){
$new_member_insert_data = array(
'id_cc'=>$id_cc,
'clave1'=>49,
'venta'=>$iva-$cancelx+$aumenx,
'cancel'=>0,
'aumento'=>0,
'tipo'=>3,
'corregido' =>$iva-$cancelx+$aumenx,
'fecha'=> date('Y-m-d'));
$insert = $this->db->insert('desarrollo.cortes_d', $new_member_insert_data);

}else{
$dataaa = array(
'venta' => $iva-$cancelx+$aumenx,
'aumento' => 0,
'cancel' => 0,
'tipo'=>3,
'corregido' => $iva-$cancelx+$aumenx);
$this->db->where('clave1', 49);
$this->db->where('id_cc', $id_cc);
$this->db->update('cortes_d', $dataaa);
//echo $this->db->last_query();
}
}

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

$mn1=round(($turno1_dolar*$turno1_cambio),2);
$mn2=round(($turno2_dolar*$turno2_cambio),2);
$mn3=round(($turno3_dolar*$turno3_cambio),2);
$mn4=round(($turno4_dolar*$turno4_cambio),2);
$arqueo1=$turno1_pesos+$turno1_bbv+$turno1_san+$turno1_exp+$turno1_asalto+$turno1_vale+$mn1;
$arqueo2=$turno2_pesos+$turno2_bbv+$turno2_san+$turno2_exp+$turno2_asalto+$turno2_vale+$mn2;
$arqueo3=$turno3_pesos+$turno3_bbv+$turno3_san+$turno3_exp+$turno3_asalto+$turno3_vale+$mn3;
$arqueo4=$turno4_pesos+$turno4_bbv+$turno4_san+$turno4_exp+$turno4_asalto+$turno4_vale+$mn4;

if($arqueo1>$turno1_corte){$sob1=$arqueo1-$turno1_corte; $fal1=0;}else{$fal1=$turno1_corte-$arqueo1; $sob1=0;}
if($arqueo2>$turno2_corte){$sob2=$arqueo2-$turno2_corte; $fal2=0;}else{$fal2=$turno2_corte-$arqueo2; $sob2=0;}
if($arqueo3>$turno3_corte){$sob3=$arqueo3-$turno3_corte; $fal3=0;}else{$fal3=$turno3_corte-$arqueo3; $sob3=0;}
if($arqueo4>$turno4_corte){$sob4=$arqueo4-$turno4_corte; $fal4=0;}else{$fal4=$turno4_corte-$arqueo4; $sob4=0;}


$data = array(
            'turno1_pesos'   =>$turno1_pesos,  
            'turno1_dolar'   =>$turno1_dolar,  
            'turno1_cambio'  =>$turno1_cambio,
            'turno1_bbv'     =>$turno1_bbv,
            'turno1_san'     =>$turno1_san,
            'turno1_exp'     =>$turno1_exp,
            'turno1_asalto'  =>$turno1_asalto,
            'turno1_vale'    =>$turno1_vale,
            'turno1_cajera'  =>$turno1_cajera,
            'turno1_corte'   =>$turno1_corte,
            'turno1_sob'     =>$sob1,
            'turno1_fal'     =>$fal1,
            'turno1_mn'      =>$mn1,
            
            'turno2_pesos'   =>$turno2_pesos,
            'turno2_dolar'   =>$turno2_dolar,
            'turno2_cambio'  =>$turno2_cambio,
            'turno2_bbv'     =>$turno2_bbv,
            'turno2_san'     =>$turno2_san,
            'turno2_exp'     =>$turno2_exp,
            'turno2_asalto'  =>$turno2_asalto,
            'turno2_vale'    =>$turno2_vale,
            'turno2_cajera'  =>$turno2_cajera,
            'turno2_corte'   =>$turno2_corte,
            'turno2_sob'     =>$sob2,
            'turno2_fal'     =>$fal2,
            'turno2_mn'      =>$mn2,
            
            'turno3_pesos'   =>$turno3_pesos,
            'turno3_dolar'   =>$turno3_dolar,
            'turno3_cambio'  =>$turno3_cambio,
            'turno3_bbv'     =>$turno3_bbv,
            'turno3_san'     =>$turno3_san,
            'turno3_exp'     =>$turno3_exp,
            'turno3_asalto'  =>$turno3_asalto,
            'turno3_vale'    =>$turno3_vale,
            'turno3_cajera'  =>$turno3_cajera,
            'turno3_corte'   =>$turno3_corte,
            'turno3_sob'     =>$sob3,
            'turno3_fal'     =>$fal3,
            'turno3_mn'      =>$mn3,
            
            'turno4_pesos'   =>$turno4_pesos,
            'turno4_dolar'   =>$turno4_dolar,
            'turno4_cambio'  =>$turno4_cambio,
            'turno4_bbv'     =>$turno4_bbv,
            'turno4_san'     =>$turno4_san,
            'turno4_exp'     =>$turno4_exp,
            'turno4_asalto'  =>$turno4_asalto,
            'turno4_vale'    =>$turno4_vale,
            'turno4_cajera'  =>$turno4_cajera,
            'turno4_corte'   =>$turno4_corte,
            'turno4_sob'     =>$sob4,
            'turno4_fal'     =>$fal4,
            'turno4_mn'      =>$mn4,
			
            'tipo' => 3,
            
			'fecha'=> date('Y-m-d H:s:i')
		);
		
		$this->db->where('id', $id_cc);
        $this->db->update('cortes_c', $data);
//////////////////////////////////////////////////////////////////////
 $sqlz1 = "SELECT a.* FROM desarrollo.cortes_c a where a.id =$id_cc";
 $queryz1 = $this->db->query($sqlz1);
 if($queryz1->num_rows()> 0){
$rowz1=$queryz1->row(); 
 $tsuc=$rowz1->tsuc;
 $id_plazaa=$rowz1->id_plaza;
if($tsuc=='F'){
$dat = array('lin_g' =>3);$this->db->where('clave1', 10);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dat);
$dat = array('lin_g' =>6);$this->db->where('clave1', 16);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dat);
}else{
$dat = array('lin_g' =>4);$this->db->where('clave1', 10);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dat);
$dat = array('lin_g' =>5);$this->db->where('clave1', 16);$this->db->where('id_cc', $id_cc);$this->db->update('cortes_d', $dat);
}
 
 $sqq = "SELECT a.* FROM desarrollo.cortes_d a 
 left join catalogo.lineas_cortes b on b.lin=a.clave1
 where a.id_cc =$id_cc  and a.lin_g=0 and b.lin_g>0";
 
 $qqq = $this->db->query($sqq);
 $lin=0;
 $idd=0;
 foreach($qqq->result() as $rqq){
    $lin=$rqq->ling;
    $idd= $rqq->id;
    $datq = array('lin_g' =>$lin);$this->db->where('id',$idd);$this->db->update('cortes_d', $dat);}






$fechacorte=$rowz1->fechacorte;
$diac=substr($fechacorte,8,2);
$mesc=substr($fechacorte,5,2);
$aaac=substr($fechacorte,0,4);
$dia=date('d');
$mes=date('m');
$aaa=date('Y');
///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////valida los faltantes de la prenomina que no sean tomados
if($aaac==$aaa and $mesc==$mes and $diac<=15 and $dia<=25 or
$aaac==$aaa and $mesc==$mes and $diac>15 or
$aaac==$aaa and $mesc<>$mes and $mes==($mesc+1) and $diac>15 and $dia<=10){
	  $this->db->delete('fal_c',array('fecha' => $rowz1->fechacorte,'suc' => $rowz1->suc,'tipo'=>1));
      $this->db->delete('faltante',array('fecha' => $rowz1->fechacorte,'suc' => $rowz1->suc,'tipo'=>1));
      
///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////faltantes
if($fal1>2.99){
$aa="SELECT a.* FROM fal_c a where  corte=$id_cc  and turno=1";

$bb = $this->db->query($aa);
 $sqlz2 = "SELECT a.* FROM catalogo.cat_empleado a where  nomina=$rowz1->turno1_cajera";
 $queryz2 = $this->db->query($sqlz2);
 echo $bb->num_rows();

 if($queryz2->num_rows()> 0){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 $succ=$rowz2->succ;
 $id_plaza=$rowz2->id_plaza;
 }else{$plazanom=0;$cianom=0;$id_plaza=0;}
if($bb->num_rows()== 0){   
$dataz= array(
            'fecha'   =>$rowz1->fechacorte,  
            'corte'   =>$id_cc,  
            'nomina'  =>$rowz1->turno1_cajera,
            'turno'   =>1,
            'fal'     =>$fal1,
            'id_cor'  =>$rowz1->id_cor,
            'id_user' =>$rowz1->id_user,
            'suc'    =>$rowz1->suc,
            'plaza'  =>$rowz1->plaza,
            'cia' =>$rowz1->cia,
            'plazanom'  =>$plazanom,
            'clave'  =>520,
            'id_plaza'=>$id_plazaa,
            'cianom' =>$cianom
            );
$insert = $this->db->insert('desarrollo.fal_c', $dataz);
}}
if($fal2>2.99){
$aa="SELECT a.* FROM fal_c a where corte=$id_cc  and turno=2";
$bb = $this->db->query($aa);
 $sqlz2 = "SELECT a.* FROM catalogo.cat_empleado a where  nomina=$rowz1->turno2_cajera";
 $queryz2 = $this->db->query($sqlz2);
 if($queryz2->num_rows()> 0 and $bb->num_rows()== 0){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 $id_plaza=$rowz2->id_plaza;
 }else{$cianom=0;$plazanom=0;$id_plaza=0;}
if($bb->num_rows()== 0){  
$dataz= array(
            'fecha'   =>$rowz1->fechacorte,  
            'corte'   =>$id_cc,  
            'nomina'  =>$rowz1->turno2_cajera,
            'turno'   =>2,
            'fal'     =>$fal2,
            'id_cor'  =>$rowz1->id_cor,
            'id_user' =>$rowz1->id_user,
            'suc'    =>$rowz1->suc,
            'plaza'  =>$rowz1->plaza,
            'cia' =>$rowz1->cia,
            'plazanom'  =>$plazanom,
            'clave'  =>520,
            'id_plaza'=>$id_plazaa,
            'cianom' =>$cianom
            );
$insert = $this->db->insert('desarrollo.fal_c', $dataz);
}}
if($fal3>2.99){
$aa="SELECT a.* FROM fal_c a where corte=$id_cc  and turno=3";
$bb = $this->db->query($aa);
 $sqlz2 = "SELECT a.* FROM catalogo.cat_empleado a where  nomina=$rowz1->turno3_cajera";
 $queryz2 = $this->db->query($sqlz2);
 if($queryz2->num_rows()> 0 and $bb->num_rows()== 0){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 $id_plaza=$rowz2->id_plaza;
 }else{$cianom=0;$plazanom=0;$id_plaza=0;}
if($bb->num_rows()== 0){  
$dataz= array(
            'fecha'   =>$rowz1->fechacorte,  
            'corte'   =>$id_cc,  
            'nomina'  =>$rowz1->turno3_cajera,
            'turno'   =>3,
            'fal'     =>$fal3,
            'id_cor'  =>$rowz1->id_cor,
            'id_user' =>$rowz1->id_user,
            'suc'    =>$rowz1->suc,
            'plaza'  =>$rowz1->plaza,
            'cia' =>$rowz1->cia,
            'plazanom'  =>$plazanom,
            'clave'  =>520,
            'id_plaza'=>$id_plazaa,
            'cianom' =>$cianom
            );
$insert = $this->db->insert('desarrollo.fal_c', $dataz);
}}
if($fal4>2.99){
$aa="SELECT a.* FROM fal_c a where  corte=$id_cc and turno=4";
$bb = $this->db->query($aa);
 
 $sqlz2 = "SELECT a.* FROM catalogo.cat_empleado a where  nomina=$rowz1->turno4_cajera";
 $queryz2 = $this->db->query($sqlz2);
 if($queryz2->num_rows()> 0 and $bb->num_rows()== 0){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 $id_plaza=$rowz2->id_plaza;
 }else{$cianom=0;$plazanom=0;$id_plaza=0;}
if($bb->num_rows()== 0){  
$dataz= array(
            'fecha'   =>$rowz1->fechacorte,  
            'corte'   =>$id_cc,  
            'nomina'  =>$rowz1->turno4_cajera,
            'turno'   =>4,
            'fal'     =>$fal4,
            'id_cor'  =>$rowz1->id_cor,
            'id_user' =>$rowz1->id_user,
            'suc'    =>$rowz1->suc,
            'plaza'  =>$rowz1->plaza,
            'cia' =>$rowz1->cia,
            'plazanom'  =>$plazanom,
            'clave'  =>520,
            'id_plaza'=>$id_plazaa,
            'cianom' =>$cianom
            );
$insert = $this->db->insert('desarrollo.fal_c', $dataz);
}}
////
}
//////////////////////////////////////////////////////////////////////faltantes
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
}

////*************************************************************************
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function valida_member_corte($fec,$suc)
    {
$id_user= $this->session->userdata('id');
$aire=0;
$recarga=0;

 $sql = "SELECT a.id,a.recarga
 from cortes_c a
 where a.suc= ? and a.id_cor=? and date_format(a.fechacorte, '%Y-%m')= ? and tipo=3"; 
 $query = $this->db->query($sql,array($suc,$id_user,$fec));
foreach($query->result() as $row)
        {
$id_cc=$row->id;
    
$data = array(
			'tipo' => 4,
			'fecha'=> date('Y-m-d H:s:i')
		);
		
		$this->db->where('id', $id_cc);
        $this->db->update('cortes_c', $data);
$datax = array(
			'tipo' => 4,
			'fecha'=> date('Y-m-d H:s:i')
		);
		
		$this->db->where('id_cc', $id_cc);
        $this->db->update('cortes_d', $datax);

}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function valida_member_corte_des($fec,$suc)
    {
$id_user= $this->session->userdata('id');
$aire=0;
$recarga=0;

 $sql = "SELECT a.id,a.recarga
 from cortes_c a
 where a.suc= ? and a.id_cor=? and date_format(a.fechacorte, '%Y-%m')= ? and tipo=4"; 
 $query = $this->db->query($sql,array($suc,$id_user,$fec));
foreach($query->result() as $row)
        {
$id_cc=$row->id;
    
$data = array(
			'tipo' => 3,
            'envio' => 'N',
			'fecha'=> date('Y-m-d H:s:i')
		);
		
		$this->db->where('id', $id_cc);
        $this->db->update('cortes_c', $data);
$datax = array(
			'tipo' => 3,
			'fecha'=> date('Y-m-d H:s:i')
		);
		
		$this->db->where('id_cc', $id_cc);
        $this->db->update('cortes_d', $datax);

}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function valida_member_fal_des($id)
    {
$id_user= $this->session->userdata('id');
$data = array(
			'tipo' => 1
		);
		$this->db->where('id', $id);
        $this->db->where('tipo', '2');
        $this->db->update('faltante', $data);

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function control_fal_t($id,$clave)
    {
        $num=1;
        $totdet=0;
        $totcre=0;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
$sql = "SELECT a.*,d.nombre as sucx
FROM fal_c a
         left join catalogo.sucursal d on d.suc=a.suc
         where a.id_user= ? and a.id=? and clave=$clave";
       $query = $this->db->query($sql,array($id_user,$id));
       
        $tabla= "
        <table>
        <tr>
        <th>NOMINA</th>
        <th>EMPLEADO</th>
        <th>IMPORTE</th>
        <th>BORRAR</th>
        </tr>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        $s="select a.*,b.pat,b.mat,b.nom 
        from faltante a 
        left join catalogo.cat_empleado b on b.nomina=a.nomina and  b.cia=a.cianom
        where a.corte= $row->corte and a.clave=$clave";
        if($nivel==5){
        $l2 =anchor('cortes/varias_quincenas_cor/'.$id, '<img src="'.base_url().'img/p.jpg" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para dividir faltante en quincenas!', 'class' => 'encabezado'));    
        }else{
        $l2 =anchor('cortes/varias_quincenas/'.$id, '<img src="'.base_url().'img/p.jpg" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para dividir faltante en quincenas!', 'class' => 'encabezado'));    
        }  
        
        
        $q= $this->db->query($s);
        $totcre=$row->fal;
  foreach($q->result() as $r)
        {
        $l1 =anchor('cortes/borrar_fal_det/'.$r->id.'/'.$id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));    
$tabla.=
"
        <tr>
            <td align=\"left\">".$r->nomina."</td>
            <td align=\"left\">".$r->pat."".$r->mat."".$r->nom."</td>
            <td align=\"right\">".number_format($r->fal,2)."</td>
            <td align=\"right\">".$l1."</td>
       </tr>";            
        $totdet=$totdet+$r->fal;
        }

  $tabla.="
        <tr>
        <th>NID</th>
        <th>SUCURSAL</th>
        <th>F.CORTE</th>
        <th>FALTANTE</th>
        <th>APLICADO</th>
        </tr>
    
        <tr>
            <td align=\"left\">".$row->suc."</td>
            <td align=\"left\">".$row->sucx."</td>
            <td align=\"left\">".$row->fecha."</td>
            <td align=\"right\">".number_format($row->fal,2)."</td>
            <td align=\"right\">".number_format($totdet,2)."</td>
            <td align=\"right\">$l2</td>
       </tr>";
      
         $num=$num+1;
       }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function control_fal_t_con($id,$clave,$turno)
    {
        $num=1;
        $totdet=0;
        $totcre=0;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
        $id_plaza= $this->session->userdata('id_plaza');
$sql = "SELECT a.*,d.nombre as sucx
FROM fal_c a
         left join catalogo.sucursal d on d.suc=a.suc
         where a.id_user= ? and a.id=? or a.id_plaza=$id_plaza and a.id=$id";
       $query = $this->db->query($sql,array($id_user,$id));
       
        $tabla= "
        <table>
        <tr>
        <th>NOMINA</th>
        <th>EMPLEADO</th>
        <th>IMPORTE</th>
        <th>BORRAR</th>
        </tr>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
         $l2 =anchor('cortes/varias_quincenas/'.$id, '<img src="'.base_url().'img/p.jpg" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para dividir faltante en quincenas!', 'class' => 'encabezado'));   
        $s="select a.*,b.pat,b.mat,b.nom 
        from faltante a 
        left join catalogo.cat_empleado b on b.nomina=a.nomina and  b.cia=a.cianom
        where a.corte= $row->corte and a.clave=$clave and turno=$turno "; 
        $q= $this->db->query($s);
        $totcre=$row->fal;
  foreach($q->result() as $r)
        {
        $l1 =anchor('cortes/borrar_fal_det_con/'.$r->id.'/'.$id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            
$tabla.=
"
        <tr>
            <td align=\"left\">".$r->nomina."</td>
            <td align=\"left\">".$r->pat."".$r->mat."".$r->nom."</td>
            <td align=\"right\">".number_format($r->fal,2)."</td>
            <td align=\"right\">".$l1."</td>
       </tr>";            
        $totdet=$totdet+$r->fal;
        }

  $tabla.="
        <tr>
        <th>NID</th>
        <th>SUCURSAL</th>
        <th>F.CORTE</th>
        <th>FALTANTE</th>
        <th>APLICADO</th>
        </tr>
    
        <tr>
            <td align=\"left\">".$row->suc." <br />".$l2."</td>
            <td align=\"left\">".$row->sucx."</td>
            <td align=\"left\">".$row->fecha."</td>
            <td align=\"right\">".number_format($row->fal,2)."</td>
            <td align=\"right\">".number_format($totdet,2)."</td>
       </tr>";
      
         $num=$num+1;
       }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
   function control_fal_t_con_var_qui($id,$clave,$turno)
    {
        $num=1;
        $totdet=0;
        $totcre=0;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
        $id_plaza= $this->session->userdata('id_plaza');
$sql = "SELECT a.*,d.nombre as sucx
FROM fal_c a
         left join catalogo.sucursal d on d.suc=a.suc
         where a.id_user= ? and a.id=? or a.id_plaza=$id_plaza and a.id=$id";
       $query = $this->db->query($sql,array($id_user,$id));
       
        $tabla= "
        <table>
        <tr>
        <th>NOMINA</th>
        <th>EMPLEADO</th>
        <th>IMPORTE</th>
        <th>PARA APLICAR</th>
        <th>BORRAR</th>
        </tr>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
         $l2 =anchor('cortes/varias_quincenas/'.$id, '<img src="'.base_url().'img/p.jpeg" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));   
        $s="select a.*,b.pat,b.mat,b.nom 
        from faltante a 
        left join catalogo.cat_empleado b on b.nomina=a.nomina and  b.cia=a.cianom
        where a.corte= $row->corte and a.clave=$clave and turno=$turno "; 
        $q= $this->db->query($s);
        $totcre=$row->fal;
  foreach($q->result() as $r)
        {
        $l1 =anchor('cortes/borrar_fal_det_con_varias_quin/'.$r->id.'/'.$id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            
$tabla.=
"
        <tr>
            <td align=\"left\"><font color=\"blue\">".$r->nomina."</font></td>
            <td align=\"left\"><font color=\"blue\">".$r->pat."".$r->mat."".$r->nom."</font></td>
            <td align=\"right\"><font color=\"blue\">".number_format($r->fal,2)."</font></td>
            <td align=\"right\"><font color=\"blue\">".$r->fecpre."</font></td>
            <td align=\"right\">".$l1."</td>
       </tr>";            
        $totdet=$totdet+$r->fal;
        }

  $tabla.="
        <tr>
        <th>NID</th>
        <th>SUCURSAL</th>
        <th>F.CORTE</th>
        <th>FALTANTE</th>
        <th>APLICADO</th>
        </tr>
    
        <tr>
            <td align=\"left\">".$row->suc." <br />".$l2."</td>
            <td align=\"left\">".$row->sucx."</td>
            <td align=\"left\">".$row->fecha."</td>
            <td align=\"right\">".number_format($row->fal,2)."</td>
            <td align=\"right\">".number_format($totdet,2)."</td>
       </tr>";
      
         $num=$num+1;
       }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function ta($sucursal, $fecha)
    {
        $this->load->library('nuSoap_lib');
        
        
        $client = new nusoap_client("http://201.156.18.162/comanche/index.php/wsta/MontoSucursalDia_/wsdl", false, '', '', '', '', 5);
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
        		//echo '<h2>Error</h2><pre>' . $err . '</pre>';
                
                return "FES";
                
        	} else {
        		//echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
                return $result['monto'];
                
        	}
        }

    }

    public function taprueba($sucursal, $fecha)
    {
        $this->load->library('nuSoap_lib');
        
        
        $client = new nusoap_client("http://192.168.1.80/comanche/index.php/wsta/MontoSucursalDia_/wsdl", false, '', '', '', '', 5);
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
        		//echo '<h2>Error</h2><pre>' . $err . '</pre>';
                
                return "FES";
                
        	} else {
        		//echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
                return $result['monto'];
                
        	}
        }

    }
    
    public function tam($sucursal, $fecha)
    {
        $this->load->library('nuSoap_lib');
        
        
        $client = new nusoap_client("http://201.156.18.162/comanche/index.php/wsta/MontoSucursalMes_/wsdl", false);
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
        
        
        $result = $client->call('MontoSucursalMes', $params, 'http://ResultadoWSDL', 'ResultadoWSDL#MontoSucursalMes');
        
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_cre()
    {
        $num=1;
        
        $id_user= $this->session->userdata('id');
        $id_plaza= $this->session->userdata('id_plaza');
        $nivel= $this->session->userdata('nivel');
if($nivel==5){
$sql = "SELECT a.*,b.suc,b.fechacorte,b.id_user,d.nombre as sucx
         FROM cortes_d a
         left join  cortes_c b on b.id=a.id_cc
         left join catalogo.sucursal d on d.suc=b.suc
         where b.id_user= ? and clave1=40 and val_cre=1
         ";
       $query = $this->db->query($sql,array($id_user,$id_plaza));
          
}else{
$sql = "SELECT a.*,b.suc,b.fechacorte,b.id_user,d.nombre as sucx
         FROM cortes_d a
         left join  cortes_c b on b.id=a.id_cc
         left join catalogo.sucursal d on d.suc=b.suc
         where b.id_user= ? and clave1=40 and val_cre=1
         or b.id_plaza= ? and clave1=40 and val_cre=1";
       $query = $this->db->query($sql,array($id_user,$id_plaza));
}       
           $tabla= "
        <table>
        <thead>
        <tr>
        <th>NID</th>
        <th>SUCURSAL</th>
        <th>F.CORTE</th>
        <th>CREDITO EMPLEADO</th>
        <th>APLICADOS</th>
        <th>EDIT</th>
        <th>VAL</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        $s="select a.*, sum(fal)as credito
        from faltante a 
        left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom
        where a.corte= $row->id_cc and a.clave=519 group by a.corte";  
        $q = $this->db->query($s);
        if($q->num_rows() > 0){
        $r=$q->row();
        $det=$r->credito;}else{$det=0;}


if($nivel==5){
$l1 =anchor('cortes/agrega_cre_cor/'.$row->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));    
}else{
$l1 =anchor('cortes/agrega_cre/'.$row->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));
}



if($det==$row->corregido){
$l2 =anchor('cortes/val_cre/'.$row->id_cc, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));    
}else{
$l2='DEBES CAPTURAR CREDITO EMPLEADO';
}
  $tabla.="
        <tr>
            <td align=\"left\">".$row->suc."</td>
            <td align=\"left\">".$row->sucx."</td>
            <td align=\"left\">".$row->fechacorte."</td>
            <td align=\"right\">".number_format($row->corregido,2)."</td>
            <td align=\"right\">".number_format($det,2)."</td>
            <td align=\"right\">".$l1."</td>
            <td align=\"center\">".$l2."</td>
            </tr> ";
      
         $num=$num+1;
         $arqueo=0;
         $fal=0;
         $sob=0;
         $corte=0;
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
function control_cre1($plaza1, $fec1, $fec2)
    {
        $num=1;
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
       
         $sql = "SELECT a.*,b.suc, d.nombre as sucx, b.fechacorte,b.id_user, e.nombre, f.valor
                FROM cortes_d a
                left join  cortes_c b on b.id=a.id_cc
                left join catalogo.sucursal d on d.suc=b.suc
                left join desarrollo.usuarios e on e.id=b.id_user
                left join catalogo.cat_mov_faltante f on f.tipo=a.val_cre
                where  a.fecha between '$fec1' and '$fec2' and  b.id_plaza='$plaza1' and clave1=40
                order by a.fecha";
       $query = $this->db->query($sql);
       //echo $this->db->last_query();
       //echo die;
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>FECHA</th>
        <th>SUCURSAL</th>
        <th>CREDITO A EMPLEADO</th>
        <th>APLICADO</th>
        <th>ESTATUS</th>
         <th>CONTADOR</th>       
        </tr>

        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
            $s="select a.*, sum(fal)as credito
        from faltante a 
        left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom
        where a.corte= $row->id_cc and a.clave=519 group by a.corte";  
        $q = $this->db->query($s);
        if($q->num_rows() > 0){
        $r=$q->row();
        $det=$r->credito;}else{$det=0;}

  $tabla.="
        <tr>
            <td align=\"left\">".$row->fechacorte."</td>
            <td align=\"left\">".$row->suc." - ".$row->sucx."</td>
            <td align=\"right\">".number_format($row->corregido,2)."</td>
            <td align=\"right\">".number_format($det,2)."</td>
            <td align=\"right\">".$row->valor."</td>
            <td align=\"right\">".$row->nombre."</td>
        </tr> ";
      
       
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function control_cre_t($id_cre)
    {
        $num=1;
        $totdet=0;
        $totcre=0;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
$sql = "SELECT a.*,b.suc,b.fechacorte,b.id_user,d.nombre as sucx
FROM cortes_d a
left join  cortes_c b on b.id=a.id_cc
         left join catalogo.sucursal d on d.suc=b.suc
         where b.id_user= ? and a.id= ? and clave1=40 and val_cre=1";
       $query = $this->db->query($sql,array($id_user,$id_cre));
       
        $tabla= "
        <table>
        <tr>
        <th>NOMINA</th>
        <th>EMPLEADO</th>
        <th>IMPORTE</th>
        <th>NOTAS</th>
        <th>BORRAR</th>
        </tr>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        $s="select a.*,b.pat,b.mat,b.nom 
        from faltante a 
        left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom
        where a.corte= $row->id_cc and a.clave=519";  
        
        
        $q= $this->db->query($s);
        $totcre=$row->corregido;
  foreach($q->result() as $r)
        {
        $l1 =anchor('cortes/borrar_cre/'.$r->id.'/'.$id_cre, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));    
$tabla.=
"
        <tr>
            <td align=\"left\">".$r->nomina."</td>
            <td align=\"left\">".$r->pat."".$r->mat."".$r->nom."</td>
            <td align=\"right\">".number_format($r->fal,2)."</td>
            <td align=\"left\">".$r->observacion."</td>
            <td align=\"right\">".$l1."</td>
       </tr>
       <tr>
            <td align=\"left\" colspan=\"4\"></td>
       </tr>";            
        $totdet=$totdet+$r->fal;
        }

  $tabla.="
        <tr>
        <th>NID</th>
        <th>SUCURSAL</th>
        <th>F.CORTE</th>
        <th>CREDITO EMPLEADO</th>
        <th>APLICADO</th>
        </tr>
    
        <tr>
            <td align=\"left\">".$row->suc."</td>
            <td align=\"left\">".$row->sucx."</td>
            <td align=\"left\">".$row->fechacorte."</td>
            <td align=\"right\">".number_format($row->corregido,2)."</td>
            <td align=\"right\">".number_format($totdet,2)."</td>
       </tr>";
      
         $num=$num+1;
       }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add_member_credito($id_cre,$id_emp,$importe,$clave,$obser)
{
 $id_user= $this->session->userdata('id');
 $sqlz1 = "SELECT a.*,b.suc,b.fechacorte,b.id_user,b.id_cor,b.id_user,b.plaza,b.cia
FROM cortes_d a
left join  cortes_c b on b.id=a.id_cc
where clave1=40 and val_cre=1 and a.id=$id_cre";
 $queryz1 = $this->db->query($sqlz1);
 if($queryz1->num_rows()> 0){
 $rowz1= $queryz1->row();
 $credito=$rowz1->corregido+.01;
 $sqlz2 = "SELECT a.* FROM catalogo.cat_empleado a where  id=$id_emp and id_user=$id_user";

 $queryz2 = $this->db->query($sqlz2);
 if($queryz2->num_rows()> 0){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 $nomina=$rowz2->nomina;
 $succ=$rowz2->succ;
 }else{$cianom=0;$plazanom=0;}


$s="select a.*, sum(fal)as credito
        from faltante a 
        left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom
        where a.corte= $rowz1->id_cc and a.clave=$clave group by a.corte";  
        $q = $this->db->query($s);
$s1="select a.*, sum(fal)as credito
        from faltante a 
        left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom
        where a.corte= $rowz1->id_cc and a.clave=$clave and a.nomina=$nomina group by a.corte";  
        $q1 = $this->db->query($s1);
        
        if($q->num_rows() > 0 && $q1->num_rows() == 0){
        $r=$q->row();
        $det=$r->credito+$importe;}else{$det=0+$importe;}
        
if($credito >= $det){
$dataz= array(
            'fecha'   =>$rowz1->fechacorte,  
            'corte'   =>$rowz1->id_cc,  
            'nomina'  =>$nomina,
            'turno'   =>0,
            'fal'     =>$importe,
            'id_cor'  =>$rowz1->id_cor,
            'id_user' =>$rowz1->id_user,
            'suc'    =>$rowz1->suc,
            'plaza'  =>$rowz1->plaza,
            'cia' =>$rowz1->cia,
            'plazanom'  =>$plazanom,
            'clave'  =>$clave,
            'succ'  =>$succ,
            'cianom' =>$cianom,
            'observacion' =>$obser
            );
$insert = $this->db->insert('desarrollo.faltante', $dataz);
}

}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add_member_credito_cortes($id_cre,$id_emp,$importe,$obser)
{
 $id_user= $this->session->userdata('id');
  $nivel= $this->session->userdata('nivel');
 $sqlz1 = "SELECT a.*,b.suc,b.fechacorte,b.id_user,b.id_cor,b.id_user,b.plaza,b.cia
FROM cortes_d a
left join  cortes_c b on b.id=a.id_cc
where clave1=40 and val_cre=1 and a.id=$id_cre";
 $queryz1 = $this->db->query($sqlz1);
 if($queryz1->num_rows()> 0){
 $rowz1= $queryz1->row();
 $credito=round($rowz1->corregido,2)+.01;
if($nivel==5){
$sqlz2 = "SELECT a.* FROM catalogo.cat_empleado a where  id=$id_emp ";
 $queryz2 = $this->db->query($sqlz2);
 if($queryz2->num_rows()> 0){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 $nomina=$rowz2->nomina;
 $succ=$rowz2->succ;
 }else{$cianom=0;$plazanom=0;}
    
}else{
$sqlz2 = "SELECT a.* FROM catalogo.cat_empleado a where  id=$id_emp and id_user=$id_user";
 $queryz2 = $this->db->query($sqlz2);
 if($queryz2->num_rows()> 0){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 $nomina=$rowz2->nomina;
 $succ=$rowz2->succ;
 }else{$cianom=0;$plazanom=0;}
    
}
 

$s="select a.*, sum(fal)as credito
        from faltante a 
        left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom
        where a.corte= $rowz1->id_cc and a.clave=519 group by a.corte";  
        $q = $this->db->query($s);
$s1="select a.*, sum(fal)as credito
        from faltante a 
        left join catalogo.cat_empleado b on b.nomina=a.nomina  and b.cia=a.cianom
        where a.corte= $rowz1->id_cc and a.clave=519 and a.nomina=$nomina group by a.corte";  
        $q1 = $this->db->query($s1);
        
        if($q->num_rows() > 0 && $q1->num_rows() == 0){
        $r=$q->row();
        $det=$r->credito+$importe;}else{$det=0+$importe;}


if($credito>=$det){
$dataz= array(
            'fecha'   =>$rowz1->fechacorte,  
            'corte'   =>$rowz1->id_cc,  
            'nomina'  =>$nomina,
            'turno'   =>0,
            'fal'     =>$importe,
            'id_cor'  =>$rowz1->id_cor,
            'id_user' =>$rowz1->id_user,
            'suc'    =>$rowz1->suc,
            'plaza'  =>$rowz1->plaza,
            'cia' =>$rowz1->cia,
            'plazanom'  =>$plazanom,
            'clave'  =>519,
            'succ'  =>$succ,
            'cianom' =>$cianom,
            'observacion' =>$obser
            );
$insert = $this->db->insert('desarrollo.faltante', $dataz);

}

}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function delete_member_credito($id)
    {
   $id_user= $this->session->userdata('id');
$this->db->delete('desarrollo.faltante', array('id' => $id, 'id_user'=>$id_user ,'tipo'=>1));
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function valida_member_cre($id_cc)
    {
  
$fechaval= $this-> _fecha1();
if($fechaval=='0000-00-00'){$fechaval= $this-> _fecha2();}

$id_user= $this->session->userdata('id');
$data = array(
			'tipo' => 2,
            'fecpre' => $fechaval
		);
		
		$this->db->where('corte', $id_cc);
        $this->db->where('tipo', '1');
        $this->db->where('clave', '519');
        $this->db->where('id_user', $id_user);
        $this->db->update('faltante', $data);

  $datax = array(
			'val_cre' => 2
            
		);
		
		$this->db->where('id_cc', $id_cc);
        $this->db->where('val_cre', '1');
        $this->db->where('clave1', '40');
        $this->db->update('cortes_d', $datax);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_varios()
    {
        $num=1;
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
       
         $sql = "SELECT a.*,d.nombre as sucx,b.completo
FROM fal_c a
         left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom    
         left join catalogo.sucursal d on d.suc=a.suc
         where a.id_user= ? and a.clave=544 and a.tipo2='COR'and a.tipo=1";
       $query = $this->db->query($sql,array($id_user));
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>NID</th>
        <th>SUCURSAL</th>
        <th>F.CORTE</th>
        <th>NOMINA</th>
        <th>EMPLEADO</th>
        <th>IMPORTE</th>
        <th>APLICA</th>
        <th>Borrar</th>
        <th>VAL</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        

    

$l1 =anchor('cortes/del_varios_fal/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
$l2 =anchor('cortes/val_varios_fal/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));    
  $tabla.="
        <tr>
            <td align=\"left\">".$row->suc."</td>
            <td align=\"left\">".$row->sucx."</td>
            <td align=\"left\">".$row->fecha."</td>
            <td align=\"center\">".$row->nomina."</td>
            <td align=\"center\">".$row->completo."</td>
            <td align=\"right\">".number_format($row->fal,2)."</td>
            <td align=\"center\">".$row->fecpre."</td>
            <td align=\"right\">".$l1."</td>
            <td align=\"center\">".$l2."</td>
            </tr> ";
      
         $num=$num+1;
         $arqueo=0;
         $fal=0;
         $sob=0;
         $corte=0;
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add_member_credito_varios_cortes($id_emp,$suc,$fechacorte,$importe,$motivo)
{
 $nivel= $this->session->userdata('nivel');
 $id_user= $this->session->userdata('id');
 if($nivel==5){
 $sqlz2 = "SELECT a.* FROM catalogo.cat_empleado a where  id=$id_emp and id_plaza=999";
 $queryz2 = $this->db->query($sqlz2);
 }else{
 $sqlz2 = "SELECT a.* FROM catalogo.cat_empleado a where  id=$id_emp  and id_user=$id_user";
 $queryz2 = $this->db->query($sqlz2);
 }
 if($queryz2->num_rows()> 0){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 $nomina=$rowz2->nomina;
 $succ=$rowz2->succ;
 $id_plaza=$rowz2->id_plaza;
 }else{$cianom=0;$plazanom=0;}

$sqlz1 = "SELECT a.* FROM catalogo.sucursal a where  suc=$suc ";
$queryz1 = $this->db->query($sqlz1);
$rowz1= $queryz1->row();

$s1="select a.* from fal_c a where nomina=$nomina and suc=$suc and fecha='$fechacorte'";  
$q1 = $this->db->query($s1);
        
        if($q1->num_rows() == 0){
$dataz= array(
            'fecha'   =>$fechacorte,  
            'corte'   =>0,  
            'nomina'  =>$nomina,
            'turno'   =>0,
            'fal'     =>$importe,
            'id_cor'  =>$rowz1->gere,
            'id_user' =>$id_user,
            'suc'    =>$rowz1->suc,
            'plaza'  =>$rowz1->plaza,
            'cia' =>$rowz1->cia,
            'plazanom'  =>$plazanom,
            'clave'  =>544,
            'succ'   =>$succ,
            'observacion' =>$motivo,
            'tipo2'  =>'COR',
            'cianom' =>$cianom,
            'id_plaza' =>$id_plaza,
            );
$insert = $this->db->insert('desarrollo.fal_c', $dataz);
}
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function _fecha1()
    {
 $s="select * from catalogo.cat_calendario_nom where mes=month(now('%m')) and day(now('%d')) between inicio and prenomina ";
 $q = $this->db->query($s); 
 if($q->num_rows() > 0 ){
 $r= $q->row();
 if($r->quincena > 15){$m=date('m')+1;}else{$m=date('m');}
 
 $ff=date('Y').'-'.str_pad($m,2,0,STR_PAD_LEFT).'-'.str_pad($r->quincena2,2,0,STR_PAD_LEFT);
 if($r->quincena == 15){
 $ff=date('Y').'-'.str_pad($m,2,0,STR_PAD_LEFT).'-'.str_pad($r->quincena,2,0,STR_PAD_LEFT);
 }   
 }else{
 $ff='0000-00-00';   
 }
 
 return $ff;
 }   
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function _fecha2()
    {
 $s="select * from catalogo.cat_calendario_nom where mes=month(now('%m')) and day(now('%d')) between libre and libre2 ";
 $q = $this->db->query($s); 
 if($q->num_rows() > 0 ){
 $r= $q->row();
 if($r->quincena2 == 15){$m=date('m')+1;}else{$m=date('m');}
 $ff=date('Y').'-'.str_pad($m,2,0,STR_PAD_LEFT).'-'.str_pad($r->quincena2,2,0,STR_PAD_LEFT);
 }else{
 $ff='0000-00-00';   
 }
 return $ff;
 }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function valida_member_varios($id)
    {
$fechaval= $this-> _fecha1();
if($fechaval=='0000-00-00'){$fechaval= $this-> _fecha2();}

$id_user= $this->session->userdata('id');
$s="select *from fal_c where id=$id";
$q = $this->db->query($s);
if($q->num_rows() == 1 ){
$r=$q->row();
$s1="select *from faltante where  nomina=$r->nomina and suc=$r->suc and fecha='$r->fecha'";
$q1 = $this->db->query($s1);
if($q1->num_rows() == 0 ){
$dataz= array(
            'fecha'   =>$r->fecha,  
            'corte'   =>0,  
            'nomina'  =>$r->nomina,
            'turno'   =>$r->turno,
            'fal'     =>$r->fal,
            'id_cor'  =>$r->id_cor,
            'id_user' =>$r->id_user,
            'suc'    =>$r->suc,
            'plaza'  =>$r->plaza,
            'cia'    =>$r->cia,
            'plazanom'  =>$r->plazanom,
            'clave'  =>544,
            'tipo'   => 2,
            'fecpre' => $fechaval,
            'cianom' =>$r->cianom,
            'observacion' =>$r->observacion,
            'tipo2' =>$r->tipo2
            );
 $insert = $this->db->insert('desarrollo.faltante', $dataz);           
}
$data = array(
			'tipo' => 2,
            'fecpre' => $fechaval
		);
		
		$this->db->where('id', $id);
        $this->db->where('tipo', '1');
        $this->db->update('fal_c', $data);
}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function delete_member_varios($id)
    {
   $id_user= $this->session->userdata('id');
$this->db->delete('desarrollo.fal_c', array('id' => $id, 'id_user'=>$id_user,'tipo'=>1));
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function c_reporte_faltantes_cortes($clave,$fec,$clavex)
    {
        $num=1;
        $dd=substr($fec,8,2);
        if($dd==15){$fec1=substr($fec,0,8).'01';}
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
    
$s="select a.suc, b.nombre as sucx,
sum(
if(turno1_fal>2.99, turno1_fal,0) +
if(turno2_fal>2.99, turno2_fal,0) +
if(turno3_fal>2.99, turno3_fal,0) +
if(turno4_fal>2.99, turno4_fal,0)
) as faltante
from cortes_c a
left join catalogo.sucursal b on b.suc=a.suc
where a.fechacorte between '$fec1' and '$fec' and a.tipo>2 
and b.gere=b.user_id  
group by a.suc";


$q = $this->db->query($s);

         
        $tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th COLSPAN=\"8\">REPORTE DE MOVIMIENTOS $clavex </th>
        </tr>
        </thead>
        <tbody>
        ";
        foreach($q->result() as $r)
        {
$tabla.= "
        <tr>
        <th align=\"left\" COLSPAN=\"8\"><font color=\"blue\"> $r->suc $r->sucx</font></th>
        </tr>
        <tr>
        <th>F.CORTE</th>
        <th>COMPA&Ntilde;IA</th>
        <th>NOMINA</th>
        <th>EMPLEADO</th>
        <th>IMPORTE</th>
        <th>APLICA</th>
        <th>OBSERVACION</th>
        <th>VALIDO</th>
        </tr>";
        $tot=0;
$sql = "SELECT f.ciax, e.nombre as aplicax,a.*,d.nombre as sucx,b.completo
FROM faltante a
         left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom    
         left join catalogo.sucursal d on d.suc=a.suc
         left join usuarios e on e.id=a.id_user
         left join catalogo.cat_compa_nomina f on f.cia=a.cianom
         where a.clave=$clave and a.tipo=2 and fecha between '$fec1' and '$fec' and a.suc=$r->suc and e.nivel=5
         order by suc,fecha";
       $query = $this->db->query($sql,array($id_user));
        foreach($query->result() as $row)
        {
        
  $tabla.="
        <tr>
            <td align=\"left\">".$row->fecha."</td>
            <td align=\"center\">".$row->ciax."</td>
            <td align=\"center\">".$row->nomina."</td>
            <td align=\"left\">".$row->completo."</td>
            <td align=\"right\">".number_format($row->fal,2)."</td>
            <td align=\"center\">".$row->fecpre."</td>
            <td align=\"center\">".$row->observacion."</td>
             <td align=\"left\">".$row->aplicax."</td>
            </tr> ";
      
         $num=$num+1;
         $tot=$tot+$row->fal;
       }
      $final= round(($r->faltante-$tot),2);
 if($final==0){$color='green';}else{$color='red';}       
        $tabla.="
         <tr>
            <td align=\"right\" colspan=\"4\">TOTAL</td>
            <td align=\"right\">".number_format($tot,2)."</td>
            <td align=\"center\" colspan=\"3\"></td>
         </tr>
         <tr>
            <td align=\"right\" colspan=\"4\">".$r->sucx." Faltante en corte $</td>
            <td align=\"right\" colspan=\"1\">".number_format($r->faltante,2)."</td>
            <td align=\"center\" colspan=\"3\"></td>
         </tr>
         <tr>
            <td align=\"right\" colspan=\"4\"><font color=\"$color\">Diferencia</font></td>
            <td align=\"right\" colspan=\"1\"><font color=\"$color\">".number_format($final,2)."</font></td>
            <td align=\"center\" colspan=\"3\"></td>
         </tr>  
        ";
     }
     $tabla.="
      <tr>
            <td align=\"right\" colspan=\"5\">TOTAL</td>
            <td align=\"right\">".number_format($tot,2)."</td>
            <td align=\"center\" colspan=\"3\"></td>
            </tr> 
        </tbody>
        </table>";  
        echo $tabla;
    
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
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_faltante()
    {
        $num=1;
        
        $id_user= $this->session->userdata('id');
        $id_plaza= $this->session->userdata('id_plaza');
        $nivel= $this->session->userdata('nivel');
if($nivel==5){
$sql = "SELECT a.id_plaza,a.cianom, a.clave,a.id_cor,a.id_user,a.id,a.fecha,a.suc,d.nombre as sucx,b.cia,c.ciax,a.tipo,b.cia,a.nomina,corte,a.id_user,turno,fal,concat(trim(b.pat),' ',trim(mat),' ',trim(nom))as completo  
         from fal_c a 
         left join catalogo.cat_empleado b on a.nomina=b.nomina and b.cia=a.cianom
         left join catalogo.cat_compa_nomina c on c.cia=a.cianom
         left join catalogo.sucursal d on d.suc=a.suc
         where a.id_user=?  and clave=520  and  a.tipo=1 
         ";
         $query = $this->db->query($sql,array($id_user,$id_plaza));    
}else{
$sql = "SELECT a.id_plaza,a.cianom, a.clave,a.id_cor,a.id_user,a.id,a.fecha,a.suc,d.nombre as sucx,b.cia,c.ciax,a.tipo,b.cia,a.nomina,corte,a.id_user,turno,fal,concat(trim(b.pat),' ',trim(mat),' ',trim(nom))as completo  
         from fal_c a 
         left join catalogo.cat_empleado b on a.nomina=b.nomina and b.cia=a.cianom
         left join catalogo.cat_compa_nomina c on c.cia=a.cianom
         left join catalogo.sucursal d on d.suc=a.suc
         where a.id_user=?  and clave=520  and  a.tipo=1  
         or
         a.id_plaza=?  and clave=520  and  a.tipo=1  
         order by fecha,suc,turno";
         
         
         $query = $this->db->query($sql,array($id_user,$id_plaza));    
}       
         
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>CIA</th>
        <th>FECHA</th>
        <th>SUCURSAL</th>
        <th>NOMINA</th>
        <th>EMPLEADO</th>
        <th>TURNO</th>
        <th>FALTANTE</th>
        <th>APLICA</th>
         <th>EDIT</th>       
        <th>VAL</th>

        <th>BORRAR</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
$l1='';
$l2='';
$l3='';
$s1="select a.*, sum(fal)as faltante,b.pat,b.mat,b.nom,c.ciax
        from faltante a 
        left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom
        left join catalogo.cat_compa_nomina c on c.cia=a.cianom
        where a.corte= $row->corte and a.turno=$row->turno and a.clave=$row->clave group by a.corte ";  
$q1 = $this->db->query($s1);
        if($q1->num_rows() > 0){
        $r1= $q1->row();
			$val=$r1->faltante;
            $empleado=$r1->pat.' '.$r1->mat.' '.$r1->nom;
            $nomina=$r1->nomina;
            $ciax=$r1->ciax;
			}else{
			$empleado=$row->completo;
            $nomina=$row->nomina;
            $ciax=$row->ciax;
        	$val=$row->fal;
	      	}
        
$l3 =anchor('cortes/borrar_fal/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
$id_cor= $row->id_cor;
////////////////////////////////////SI ES PERSONAL DE CORTES    
if($nivel==5){

if($row->fal<=$val || $val==0){
$l1 =anchor('cortes/cambia_fal_nom/'.$row->id, ' <img src="'.base_url().'img/no.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));
$l2 =anchor('cortes/marcar_fal/'.$row->id.'/'.$row->corte, ' <img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para marcar!', 'class' => 'encabezado'));
}else{
$l1 =anchor('cortes/cambia_fal_nom/'.$row->id, ' <img src="'.base_url().'img/no.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));
$l2 ='';
}    


if($row->cianom==0){
            $l1 =anchor('cortes/cambia_fal_nom/'.$row->id, ' <img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));
            $l2 =anchor('cortes/borrar_fal/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            }
}elseif($nivel==3){
////////////////////////////////////SI ES PERSONAL DE CORTES
////////////////////////////////////CONTADORES FORANEOS.
if($row->cianom==0 || $row->fal<>$val){
            $l1 =anchor('cortes/cambia_fal/'.$row->id, ' <img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));
            $l2='';
            //$l2 =anchor('cortes/borrar_fal/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
}
if($row->fal==$val and $row->cianom > 0){
$l1 =anchor('cortes/cambia_fal/'.$row->id, ' <img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar!', 'class' => 'encabezado'));
$l2 =anchor('cortes/marcar_fal/'.$row->id.'/'.$row->corte, ' <img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para marcar!', 'class' => 'encabezado'));
}
}


$l3='';
  $tabla.="
        <tr>
            <td align=\"left\">".$ciax."</td>
            <td align=\"left\">".$row->fecha."</td>
            <td align=\"left\">".$row->suc." - ".$row->sucx."</td>
            <td align=\"left\">".$nomina."</td>
            <td align=\"left\">".$empleado."</td>
            <td align=\"right\">".$row->turno."</td>
            <td align=\"right\">".number_format($row->fal,2)."</td>
            <td align=\"right\">".number_format($val,2)."</td>
            <td align=\"right\">".$l1."</td>
            <td align=\"right\">".$l2."</td>
            <td align=\"right\">".$l3."</td>
            
            </tr> ";
      
         $num=$num+1;
         $arqueo=0;
         $fal=0;
         $sob=0;
         $corte=0;
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function control_faltante1($plaza1, $fec1, $fec2)
    {
        $num=1;
        
        $id_user= $this->session->userdata('id');
        $nivel= $this->session->userdata('nivel');
       
         $sql = "select a.id,a.fecha,a.turno, a.suc, d.nombre as sucursal ,a.nomina, c.completo, a.fal, a.tipo, f.valor, a.id_user, e.nombre, b.nomina,sum(b.fal)as fal_aplicado,b.observacion
                from  fal_c a
                left join faltante b on b.corte=a.corte and a.turno=b.turno
                left join catalogo.cat_empleado c on c.nomina=a.nomina
                left join catalogo.sucursal d on d.suc=a.suc
                left join desarrollo.usuarios e on e.id=a.id_user
                left join catalogo.cat_mov_faltante f on f.tipo=a.tipo
                where  a.fecha between '$fec1' and '$fec2' and  a.id_plaza='$plaza1' and a.tipo=1
                group by a.corte,a.turno
                order by a.fecha";
       $query = $this->db->query($sql);
       //echo $this->db->last_query();
       //echo die;
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>FECHA</th>
        <th>SUCURSAL</th>
        <th>NOMINA</th>
        <th>EMPLEADO</th>
        <th>TURNO</th>
        <th>FALTANTE</th>
        <th>APLICADO</th>
        <th>ESTATUS</th>
         <th>CONTADOR</th>       
        <th>OBSERV.</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
 $l2 = anchor('cortes/delete_fal_gercon/'.$row->id.'/'.$plaza1.'/'.$fec1.'/'.$fec2, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir !', 'class' => 'encabezado'));
     
  $tabla.="
        <tr>
            <td align=\"left\">".$row->fecha."</td>
            <td align=\"left\">".$row->suc." - ".$row->sucursal."</td>
            <td align=\"left\">".$row->nomina."</td>
            <td align=\"left\">".$row->completo."</td>
            <td align=\"right\">".$row->turno."</td>
            <td align=\"right\">".$row->fal."</td>
            <td align=\"right\">".$row->fal_aplicado."</td>
            <td align=\"right\">".$row->valor."</td>
            <td align=\"right\">".$row->nombre."</td>
            <td align=\"right\">".$row->observacion."</td>
            <td align=\"right\">".$l2."</td>
        </tr> ";
      
       
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_faltante_t($id_fal)
    {
        $num=1;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
         $sql = "SELECT a.suc,d.nombre as sucx,b.cia,c.ciax,a.tipo,b.cia,a.nomina,a.id_user,a.fal,b.completo  
         from fal_c a 
         left join catalogo.cat_empleado b on a.nomina=b.nomina and b.cia=a.cianom
         left join catalogo.cat_compa_nomina c on c.cia=b.cia
         left join catalogo.sucursal d on d.suc=a.suc
         where a.id_user=? and  a.id= ? and a.tipo=1 ";
      
        $query = $this->db->query($sql,array($id_user,$id_fal));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>CIA</th>
        <th>SUCURSAL</th>
        <th>NOMINA</th>
        <th>EMPLEADO</th>
        <th>FALTANTE</th>
        
        </tr>

        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
            
 
            $tabla.="
        <tr>
            <td align=\"left\">".$row->ciax."</td>
            <td align=\"left\">".$row->sucx."</td>
            <td align=\"left\">".$row->nomina."</td>
            <td align=\"left\">".$row->completo."</td>
            <td align=\"right\">".number_format($row->fal,2)."</td>
           </tr> ";
      
         $num=$num+1;
         $arqueo=0;
         $fal=0;
         $sob=0;
         $corte=0;
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }



///
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function delete_member_fal_gercon($id_fal,$motivo)
    {
       
$id_user= $this->session->userdata('id');
$data = array(
			'tipo' => 4,
            'fecpre' => date('Y-m-d'),
            'observacion' =>strtoupper(trim($motivo)) 
		);
		$this->db->where('id', $id_fal);
        $this->db->where('tipo', '1');
        $this->db->update('fal_c', $data);

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function delete_member_fal($id_fal,$motivo)
    {
        
    
$id_user= $this->session->userdata('id');
$data = array(
			'tipo' => 4,
            'fecpre' => date('Y-m-d'),
            'observacion' =>strtoupper(trim($motivo)) 
		);
		$this->db->where('id', $id_fal);
        $this->db->where('tipo', '1');
        $this->db->update('fal_c', $data);
$s="select *from fal_c where id=$id_fal";
$q = $this->db->query($s); 
if($q->num_rows()==1 ){
    $r=$q->row();

        
        $dataf = array(
			'tipo' => 4,
            'fecpre' => date('Y-m-d'),
            'observacion' =>strtoupper(trim($motivo)) 
		);
		$this->db->where('nomina', $r->nomina);
        $this->db->where('cianom', $r->cianom);
         $this->db->where('turno', $r->turno);
        $this->db->where('tipo', '1');
        $this->db->update('faltante', $dataf);
}
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function valida_member_fal($id,$corte)
    {
$fechaval= $this-> _fecha1();
if($fechaval=='0000-00-00'){$fechaval= $this-> _fecha2();}
      
$id_user= $this->session->userdata('id');

////////////////////////////////////////////////////////cuando proviene el faltante de un corte
////////////////////////////////////////////////////////cuando proviene el faltante de un corte
////////////////////////////////////////////////////////cuando proviene el faltante de un corte
$s0="select *from fal_c where id=$id and corte=$corte and corte>0";
$q0 = $this->db->query($s0);
if($q0->num_rows()==1 ){
$r0=$q0->row();
$fechacorte=$r0->fecha;
$turno=$r0->turno;
}
////////////////////////////////////////////////////////cuando proviene el faltante de un corte////////////////////////////////////////////////////////cuando proviene el faltante de un corte
////////////////////////////////////////////////////////cuando proviene el faltante de un corte
////////////////////////////////////////////////////////cuando proviene el faltante de un corte
////////////////////////////////////////////////////////cuando proviene el faltante de un corte
$s="select *from fal_c where id=$id";
$q = $this->db->query($s);
$s1="select *from faltante where corte=$corte  and turno=$turno group by corte, turno";
$q1 = $this->db->query($s1);

if($q->num_rows() == 1 && $q1->num_rows()== 0 ){
$r=$q->row();
$dataz= array(
            'fecha'   =>$r->fecha,  
            'corte'   =>$corte,  
            'nomina'  =>$r->nomina,
            'turno'   =>$turno,
            'fal'     =>$r->fal,
            'id_cor'  =>$r->id_cor,
            'id_user' =>$r->id_user,
            'suc'    =>$r->suc,
            'plaza'  =>$r->plaza,
            'cia'    =>$r->cia,
            'plazanom'  =>$r->plazanom,
            'clave'  =>520,
            'tipo'   => 2,
            'fecpre' => $fechaval,
            'fechacaptura' => date('Y-m-d H:i:s'),
            'cianom' =>$r->cianom
            );
 $insert = $this->db->insert('desarrollo.faltante', $dataz);           
}else{
$data0 = array(
			'tipo' => 2,
            'fecpre' => $fechaval,
            'fechacaptura' => date('Y-m-d H:i:s')
		);
		
		$this->db->where('corte', $corte);
        $this->db->where('tipo', '1');
        $this->db->where('fecpre', '0000-00-00');
        $this->db->update('faltante', $data0);

}

$data = array(
			'tipo' => 2,
            'fecpre' => $fechaval
		);
		
		$this->db->where('id', $id);
        $this->db->where('tipo', '1');
        $this->db->where('fecpre', '0000-00-00');
        $this->db->update('fal_c', $data);

$s="update desarrollo.faltante set tipo=2,fechacaptura=date(now()) where corte=$corte and tipo=1 and fecpre>'0000-00-00' ";
$this->db->query($s);
$ss="update desarrollo.fal_c set tipo=2  where id=$id and tipo=1";
$this->db->query($ss);
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function update_member_c_fal($id_fal,$id_emp,$importe,$motivo,$clave)
    {
$id_user= $this->session->userdata('id');
$nivel= $this->session->userdata('nivel');
$id_plaza= $this->session->userdata('id_plaza');
if($nivel==5){$id_plaza=999;}else{$id_plaza=$this->session->userdata('id_plaza');};
 $sqlz1 = "SELECT *
FROM fal_c a
where  tipo=1 and a.id=$id_fal";
 $queryz1 = $this->db->query($sqlz1);
 if($queryz1->num_rows()> 0){
 $rowz1= $queryz1->row();
 $faltante=$rowz1->fal;
 $sqlz2 = "SELECT a.* FROM catalogo.cat_empleado a where  
 id=$id_emp  and id_user=$id_user
 or
 id=$id_emp  and a.id_plaza=$id_plaza
 
  ";
 
 $queryz2 = $this->db->query($sqlz2);
 if($queryz2->num_rows()==1){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 $nomina=$rowz2->nomina;
 $succ=$rowz2->succ;

 

 }else{$cianom=0;$plazanom=0;$id_plaza=0;}

     if($id_emp==72443){$nomina=99999999;$cianom=99;$succ=0;$id_plaza=$this->session->userdata('id_plaza');}
 elseif($id_emp==72601){$nomina=99999998;$cianom=99;$succ=0;$id_plaza=$this->session->userdata('id_plaza');}
 elseif($id_emp==72442){$nomina=99999997;$cianom=99;$succ=0;$id_plaza=$this->session->userdata('id_plaza');}
$s="select a.*, sum(fal)as faltante
        from faltante a 
        left join catalogo.cat_empleado b on b.nomina=a.nomina and b.id=$id_emp
        where a.corte= $rowz1->corte and a.clave=$clave and a.turno=$rowz1->turno group by a.corte";  
        $q = $this->db->query($s);
$s1="select a.*, sum(fal)as faltante
        from faltante a 
        left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom
        where a.corte= $rowz1->corte and a.clave=$clave  and a.turno=$rowz1->turno group by a.corte";  
            $q1 = $this->db->query($s1);
           
        if($q->num_rows() > 0 && $q1->num_rows() == 0){
        $r=$q->row();
        $det=$r->faltante+$importe;}else{$det=0+$importe;}

if($faltante>=$det){
  
$dataz= array(
            'fecha'   =>$rowz1->fecha,  
            'corte'   =>$rowz1->corte,  
            'nomina'  =>$nomina,
            'turno'   =>$rowz1->turno,
            'fal'     =>$importe,
            'id_cor'  =>$rowz1->id_cor,
            'id_user' =>$rowz1->id_user,
            'suc'    =>$rowz1->suc,
            'plaza'  =>$rowz1->plaza,
            'cia' =>$rowz1->cia,
            'plazanom'  =>$plazanom,
            'clave'  =>$clave,
            'succ'  =>$succ,
            'observacion' =>$motivo,
            'id_plaza'=> $id_plaza,
            'cianom' =>$cianom
            );
$insert = $this->db->insert('desarrollo.faltante', $dataz);
}

$data = array(
			'plazanom'  =>$plazanom,
            'nomina'  =>$nomina,
            'id_plaza'  =>$id_plaza,
            'cianom' =>$cianom
		);
		
		$this->db->where('id', $id_fal);
        $this->db->where('tipo', '1');
        $this->db->update('fal_c', $data);

}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function delete_member_faltante_det($id)
    {
$id_user= $this->session->userdata('id');
$this->db->delete('desarrollo.faltante', array('id' => $id, 'tipo' =>1));
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function agrega_member_fa_dividido($id_fal,$id_emp,$importe,$motivo,$clave,$fecpre)
    {
$id_user= $this->session->userdata('id');
$nivel= $this->session->userdata('nivel');
$id_plaza= $this->session->userdata('id_plaza');
if($nivel==5){$id_plaza=999;};
 $sqlz1 = "SELECT *
FROM fal_c a
where  tipo=1 and a.id=$id_fal";
 $queryz1 = $this->db->query($sqlz1);
 if($queryz1->num_rows()> 0){
 $rowz1= $queryz1->row();
 $faltante=$rowz1->fal;
 $sqlz2 = "SELECT a.* FROM catalogo.cat_empleado a where  
 id=$id_emp  and id_user=$id_user
 or
 id=$id_emp  and a.id_plaza=$id_plaza
 ";
 $queryz2 = $this->db->query($sqlz2);
 if($queryz2->num_rows()==1){
 $rowz2= $queryz2->row();
 $cianom=$rowz2->cia;
 $plazanom=$rowz2->plaza;
 $nomina=$rowz2->nomina;
 $succ=$rowz2->succ;

 

 }else{$cianom=0;$plazanom=0;$id_plaza=0;}

$varios=1;
$s="select a.*, sum(fal)as faltante,(count(varios)+1)as varios
        from faltante a 
        left join catalogo.cat_empleado b on b.nomina=a.nomina and b.id=$id_emp
        where a.corte= $rowz1->corte and a.clave=$clave and a.turno=$rowz1->turno group by a.corte";

        $q = $this->db->query($s);
$s1="select a.*, sum(fal)as faltante
        from faltante a 
        left join catalogo.cat_empleado b on b.nomina=a.nomina and b.cia=a.cianom
        where a.corte= $rowz1->corte and a.clave=$clave and a.nomina=$nomina  and a.turno=$rowz1->turno and varios=99 group by a.corte";  
            $q1 = $this->db->query($s1);
        if($q->num_rows() > 0 && $q1->num_rows() == 0){
        $r=$q->row();
        $varios=$r->varios;
        $det=$r->faltante+$importe;}else{$det=0+$importe;}
 
if($faltante>=$det){
$dataz= array(
            'fecha'   =>$rowz1->fecha,  
            'corte'   =>$rowz1->corte,  
            'nomina'  =>$nomina,
            'turno'   =>$rowz1->turno,
            'fal'     =>$importe,
            'id_cor'  =>$rowz1->id_cor,
            'id_user' =>$rowz1->id_user,
            'suc'    =>$rowz1->suc,
            'plaza'  =>$rowz1->plaza,
            'cia' =>$rowz1->cia,
            'plazanom'  =>$plazanom,
            'clave'  =>$clave,
            'fecpre'  =>$fecpre,
            'succ'  =>$succ,
            'varios'  =>$varios,
            'observacion' =>$motivo,
            'id_plaza'=> $id_plaza,
            'cianom' =>$cianom
            );
$insert = $this->db->insert('desarrollo.faltante', $dataz);
}

$data = array(
			'plazanom'  =>$plazanom,
            'nomina'  =>$nomina,
            'id_plaza'  =>$id_plaza,
            'cianom' =>$cianom
		);
		
		$this->db->where('id', $id_fal);
        $this->db->where('tipo', '1');
        $this->db->update('fal_c', $data);

}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function control_sucursal($fec)
    {
        $num=1;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
        $id_plaza= $this->session->userdata('id_plaza');
        $nivel= $this->session->userdata('nivel');
        
        if($nivel==5){
        $sql = "select a.suc,a.nombre as sucx, b.nombre as usua from catalogo.sucursal a left join 
        usuarios b on b.id=a.user_id where gere= $id_user order by suc";
        }else{
        $sql = "select a.suc,a.nombre as sucx, b.nombre as usua 
        from catalogo.sucursal a left join usuarios b on b.id_plaza=a.id_plaza and b.responsable='R'
         where a.id_plaza= $id_plaza  order by suc"; ;
        }
         
        $query = $this->db->query($sql);
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>SUCURSAL</th>
        <th>DIAS TRANSMITIDOS</th>
        <th>CONTADOR</th>
        <th>DETALLE</th>
       
        

        </thead>
        <tbody>
        ";
          foreach($query->result() as $row)
        {
         if($nivel==5){
        $s = "select count(fechacorte)as dias from cortes_c a where id_cor= ? and date_format(a.fechacorte, '%Y-%m')=? and a.suc= $row->suc group by suc";
        }else{
        $s = "select count(fechacorte)as dias 
        from cortes_c a 
        where id_user= ? and date_format(a.fechacorte, '%Y-%m')=? and a.suc= $row->suc  
        or id_plaza= $id_plaza and date_format(a.fechacorte, '%Y-%m')='$fec' and a.suc= $row->suc
        group by suc";    
        }
        $q = $this->db->query($s,array($id_user,$fec));
        if($q->num_rows() > 0){$r=$q->row();$dias=$r->dias;}else{$dias=0;}
          

            $l1 = anchor('cortes/tabla_control_sucursal_bloque_det/'.$row->suc.'/'.$fec, '<img src="'.base_url().'img/btnNext.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para detalle de dias!', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            
            <td align=\"left\">".$num."</td>
            
            <td align=\"left\">".$row->suc." - ".$row->sucx."</td>
            <td align=\"center\">".$dias."</td>
            <td align=\"left\">".$row->usua."</td>
             <td align=\"right\">".$l1."</td>
            
            </tr>
            ";
            
         $num=$num+1;
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function control_sucursal_det($suc,$fec)
    {
        $num=1;
        $fecha= date('Y-m-d');
        $id_user= $this->session->userdata('id');
        $id_plaza= $this->session->userdata('id_plaza');
        $nivel= $this->session->userdata('nivel');
        
        if($nivel==5){
        $sql = "select a.*,b.nombre,b.puesto 
        from cortes_c a 
        left join usuarios b on b.id=a.id_user 
        where id_cor= ? and a.suc=? and date_format(a.fechacorte, '%Y-%m')=?";
        }else{
        $sql = "select a.*,b.nombre,b.puesto  
        from cortes_c a 
        left join usuarios b on b.id=a.id_user
        where 
        id_user= ? and a.suc=? and date_format(a.fechacorte, '%Y-%m')=?
        or b.id_plaza= ? and a.suc=? and date_format(a.fechacorte, '%Y-%m')=?
        ";    
        }
        $query = $this->db->query($sql,array($id_user,$suc,$fec,$id_plaza,$suc,$fec));
       
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>FECHA DEL CORTE</th>
        <th>STATUS</th>
        <th>RESPONSABLE DEL CORTE</th>
        <th>CONTABILIDAD</th>

        </thead>
        <tbody>
        ";
        // date_format(a.fechacorte, '%Y-%m')
        foreach($query->result() as $row)
        {
        if($row->tipo==1){$tipox='NO HAY DETALLE DE LINEAS';}
        if($row->tipo==2){$tipox='RECIBIDO SIN TRABAJAR';}
        if($row->tipo>2){$tipox='TRABAJADO Y REVISADO';}
        $l1 = anchor('cortes/tabla_control_sucursal_bloque_det_corte/'.$row->id.'/'.$fec.'/'.$row->suc, '<img src="'.base_url().'img/btnNext.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver!', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            <td align=\"left\">".$num."</td>
            <td align=\"left\">".$row->fechacorte."</td>
            <td align=\"left\">".$tipox."</td>
            <td align=\"left\">".$row->nombre."</td>
            <td align=\"left\">".$row->puesto."</td>
             <td align=\"left\">".$l1."</td>
            </tr>
            ";
         $num=$num+1;
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
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//**************************************************************
//**************************************************************
function pru()
{
    $dia=date('%W');
    
    echo $dia;
    return $this->ta(906,'2011-12-05');
    
}
//**************************************************************
//**************************************************************
//**************************************************************
//**************************************************************
}