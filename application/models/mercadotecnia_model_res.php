<?php
class Mercadotecnia_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
    }

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function catalogo_ofertas()
    {
    $id_user= $this->session->userdata('id');
    $sql="SELECT *from catalogo.cat_mirey order by labor,fec1";
	  	$query = $this->db->query($sql);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"6\" align=\"center\"><strong>CATALOGO DE OFERTAS</strong></th>
        </tr>
        <tr>
        <th><strong>FECHA</strong></th>
        <th><strong>MAYORISTA</strong></th>
        <th><strong>CODIGO<br />DESCRIPCION</strong></th>
        <th><strong>LABORATORIO</strong></th>
        <th><strong>DESCUENTO</strong></th>
        <th><strong>DESCUENTO EN VTA</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
if($row->vta>0){$color='blue';}else{$color='black';} 

           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td align=\"left\">".$row->fec1." ".$row->fec2."</td>
            <td align=\"left\">".$row->prv."</td>
            <td align=\"left\">".$row->codigo."<br /> ".$row->descri."</td>
            <td align=\"left\">".$row->labor."</td>
            <td align=\"left\">% ".$row->descu."</td>
            <td align=\"right\"><font color=\"$color\">% ".$row->vta."</font></td>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            </tr>
            ";
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"6\"><strong>TOTAL DE PRODUCTOS:".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function desplazamiento()
    {
    	$aaa=date('Y');
    $id_user= $this->session->userdata('id');
    $s="SELECT *from catalogo.cat_mirey  group by codigo
	order by labor,fec1";
	  	$q = $this->db->query($s);
    	
	    
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"14\" align=\"center\"><strong>CATALOGO DE OFERTAS</strong></th>
        </tr>
        <tr>
        <th><strong>AAA</strong></th>
        <th><strong>Ene</strong></th>
        <th><strong>Feb</strong></th>
        <th><strong>Mar</strong></th>
        <th><strong>Abr</strong></th>
        <th><strong>May</strong></th>
        <th><strong>Jun</strong></th>
        <th><strong>Jul</strong></th>
        <th><strong>Ago</strong></th>
        <th><strong>Sep</strong></th>
        <th><strong>Oct</strong></th>
        <th><strong>Nov</strong></th>
        <th><strong>Dic</strong></th>
        <th><strong>Inv</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        foreach($q->result() as $r)
        {
 $sql="SELECT *	from vtadc.codigo_prox where codigo=$r->codigo and aaa=$aaa";
	  	$query = $this->db->query($sql);
        
        
     //$l1 = anchor('recursos_humanos/tabla_empleados_validar_rh/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));    
         


           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td></td>
            <td colspan=\"14\">Producto ".$r->codigo." ".$r->descri."</td>
            </tr>
            ";
if($query->num_rows()> 0){
$row= $query->row();
        $tabla.="
            <tr>
            <td><font color=\"blue\">(75) ".$aaa."</font><br />(T_) ".($aaa)."<br />
            <font color=\"blue\">(75) ".($aaa-1)."</font> <br />(T_) ".($aaa-1)."</td>
			<td align='right'><font color=\"blue\">
			".number_format($row->venta_act_1,0)." <br /></font>
			".number_format($row->venta_actt_1,0)."<br />
			<font color=\"blue\">".number_format($row->venta_ant_1,0)." <br /></font>
			".number_format($row->venta_antt_1,0)."</td>
            
			<td align='right'><font color=\"blue\">
			".number_format($row->venta_act_2,0)." <br /></font>
			".number_format($row->venta_actt_2,0)."<br />
			<font color=\"blue\">".number_format($row->venta_ant_2,0)." <br /></font>
			".number_format($row->venta_antt_2,0)."</td>
            
			<td align='right'><font color=\"blue\">
			".number_format($row->venta_act_3,0)." <br /></font>
			".number_format($row->venta_actt_3,0)."<br />
			<font color=\"blue\">".number_format($row->venta_ant_3,0)." <br /></font>
			".number_format($row->venta_antt_3,0)."</td>
            
			<td align='right'><font color=\"blue\">
			".number_format($row->venta_act_4,0)." <br /></font>
			".number_format($row->venta_actt_4,0)."<br />
			<font color=\"blue\">".number_format($row->venta_ant_4,0)." <br /></font>
			".number_format($row->venta_antt_4,0)."</td>
            
			<td align='right'><font color=\"blue\">
			".number_format($row->venta_act_5,0)." <br /></font>
			".number_format($row->venta_actt_5,0)."<br />
			<font color=\"blue\">".number_format($row->venta_ant_5,0)." <br /></font>
			".number_format($row->venta_antt_5,0)."</td>
            
			<td align='right'><font color=\"blue\">
			".number_format($row->venta_act_6,0)." <br /></font>
			".number_format($row->venta_actt_6,0)."<br />
			<font color=\"blue\">".number_format($row->venta_ant_6,0)." <br /></font>
			".number_format($row->venta_antt_6,0)."</td>
            
			<td align='right'><font color=\"blue\">
			".number_format($row->venta_act_7,0)." <br /></font>
			".number_format($row->venta_actt_7,0)."<br />
			<font color=\"blue\">".number_format($row->venta_ant_7,0)." <br /></font>
			".number_format($row->venta_antt_7,0)."</td>
            
			<td align='right'><font color=\"blue\">
			".number_format($row->venta_act_8,0)." <br /></font>
			".number_format($row->venta_actt_8,0)."<br />
			<font color=\"blue\">".number_format($row->venta_ant_8,0)." <br /></font>
			".number_format($row->venta_antt_8,0)."</td>
            
			<td align='right'><font color=\"blue\">
			".number_format($row->venta_act_9,0)." <br /></font>
			".number_format($row->venta_actt_9,0)."<br />
			<font color=\"blue\">".number_format($row->venta_ant_9,0)." <br /></font>
			".number_format($row->venta_antt_9,0)."</td>
            
			<td align='right'><font color=\"blue\">
			".number_format($row->venta_act_10,0)." <br /></font>
			".number_format($row->venta_actt_10,0)."<br />
			<font color=\"blue\">".number_format($row->venta_ant_10,0)." <br /></font>
			".number_format($row->venta_antt_10,0)."</td>
            
			<td align='right'><font color=\"blue\">
			".number_format($row->venta_act_11,0)." <br /></font>
			".number_format($row->venta_actt_11,0)."<br />
			<font color=\"blue\">".number_format($row->venta_ant_11,0)." <br /></font>
			".number_format($row->venta_antt_11,0)."</td>
            
			<td align='right'><font color=\"blue\">
			".number_format($row->venta_act_12,0)." <br /></font>
			".number_format($row->venta_actt_12,0)."<br />
			<font color=\"blue\">".number_format($row->venta_ant_12,0)." <br /></font>
			".number_format($row->venta_antt_12,0)."</td>
            
            <td align='right'>".$row->inv."</td>           
";}
$tabla.="			           
			<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            </tr>
            ";

$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"6\"><strong>TOTAL DE PRODUCTOS:".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////




















































































function supervisor_motivo_uno($id,$motivo)
    {
    $id_user= $this->session->userdata('id');
    $id_plaza=$this->session->userdata('id_plaza');
    $nivel = $this->session->userdata('nivel');

$sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,bb.nombre as motivox 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      where  a.id = $id";
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
            <td>RECURSOS o CONTADOR.:".$row->id_rh."</td>
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
/////////////////////////////////////////////////////////////////////////////////
function supervisor_motivo_his($motivo)
    {
    $id_user= $this->session->userdata('id');
    $id_plaza=$this->session->userdata('id_plaza');
    
if($motivo==2){
$sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,bb.nombre as motivox,e.nombre as id_rhx,e.puesto as rhpuesto 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join usuarios e on e.id=a.id_rh
      where  a.id_plaza=$id_plaza and a.tipo>2 and motivo=$motivo order by fecha_rh  and borrar='A'";
      	$query = $this->db->query($sql);
    	
}elseif($motivo==3){
$sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,bb.nombre as motivox,e.nombre as id_rhx,e.puesto as rhpuesto 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join usuarios e on e.id=a.id_rh
      where  a.tipo>2 and motivo= $motivo order by fecha_rh  and borrar='A'";
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
        </tr>
        </thead>
        ";
        $num=0;
        foreach($query->result() as $row)
        {
            
        $l1 = anchor('recursos_humanos/tabla_empleados_validar_recursos/'.$row->id.'/'.$motivo, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para capturar observacion!', 'class' => 'encabezado'));

           $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">Empleado :".$row->nomina." ".$row->pat." ".$row->mat." ".$row->nom."<br /><font color=\"blue\">".$row->causa."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong>".$row->fecha_mov."<br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivox."</font></td>
            <td>RECURSOS o CONTADOR.:".$row->id_rh." ".$row->id_rhx."<br />".$row->rhpuesto."</td>
            </tr>
            <tr>
            <td colspan=\"4\"><font color=\"green\">".$row->fecha_obser2."<br />".$row->obser2."</font></td>
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


/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
//**************************************************************
function captura_de_mov_rh()
    {
    $id_user= $this->session->userdata('id');
    
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,bb.nombre as motivox 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      where a.id_user=$id_user and a.tipo=1  and borrar='A'";
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
            $l3 = anchor('recursos_humanos/tabla_empleados_borrar_rh/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            $l4 = anchor('recursos_humanos/tabla_empleados_validar_rh_alta/'.$row->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
            
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">Empleado :".$row->nomina." ".$row->pat." ".$row->mat." ".$row->nom."<br />".$row->nombre."<br /><font color=\"blue\">".$row->causa."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong>".$row->fecha_mov."<br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivox."<br />".$row->sucx."</font></td>
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

///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
function agrega_member_movimiento_alta($nom,$id_mov,$fecha,$cia,$suc,$nomina)
    {
       //
        $id_user= $this->session->userdata('id');
        $s="select *from catalogo.sucursal where suc=$suc";
        $q = $this->db->query($s);
        if($q->num_rows() == 1){
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
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
    function agrega_member_movimiento_obser_rh($id,$obser)
    {
     $data = array('obser2'=>$obser, 'fecha_obser2'=>date('Y-m-d H:i:s'));
 	 $this->db->where('id', $id);
     $this->db->update('mov_supervisor', $data);
    }
///////////////////////////////////////////////////////////////////////////////
    function delete_member_empleados($id)
    {
     $data = array('borrar'=>'X', 'fecha_c'=>date('Y-m-d H:i:s'));
 	 $this->db->where('id', $id);
     $this->db->update('mov_supervisor', $data);
    }
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
   function valida_member_empleados($id)
    {
     $nivel= $this->session->userdata('nivel');
     $id_user= $this->session->userdata('id');


     $data = array('tipo'=>2, 'fecha_c'=>date('Y-m-d H:i:s'));
 	 $this->db->where('id', $id);
     $this->db->update('mov_supervisor', $data);
     return $this->db->affected_rows();
        	 
     }
     
 //////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
function mov_rh_llegaron()
    {
    $id_user= $this->session->userdata('id');
    $id_plaza= $this->session->userdata('id_plaza');
    
    $sql="SELECT a.*,b.nombre as sucx, d.nombre as id_userx,d.puesto as contador,c.ciax, aa.nom,aa.pat,aa.mat,bb.nombre as motivox 
      FROM mov_supervisor a
      left join catalogo.cat_empleado aa on aa.cia=a.cia and aa.nomina=a.nomina
      left join catalogo.cat_mov_super bb on bb.id=a.motivo
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      where a.id_plaza=$id_plaza and a.motivo=4  and borrar='A'";
      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"4\" align=\"center\"><strong>EMPLEADOS ENVIADOS A LA SUCURSAL</strong></th>
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
 if($row->tipo==2){$mensaje="NO HA DADO RESPUESTA EL SUPERVISOR";$color="red";}else{$mensaje="";$color="black";}           
            
            $tabla.="
            <tr bgcolor=\"#F4ECEC\">
            <td colspan=\"2\">Empleado :".$row->nomina." ".$row->pat." ".$row->mat." ".$row->nom."<br />".$row->nombre."<br /><font color=\"blue\">".$row->causa."</font></td>
            <td colspan=\"1\"><strong> Fecha mov.:</strong>".$row->fecha_mov."<br /><strong>MOVIMIENTO.:</strong><font color=\"blue\">".$row->motivox."<br />".$row->sucx."</font></td>
            <td></td>
            </tr>
            <tr>
            <td align=\"left\">".$row->cia." ".$row->ciax."</td>
            <td align=\"left\">".$row->contador."</td>
            <td align=\"left\">".$row->id_userx."<br /> ".$row->fecha_c."</td>
            <td><font size=\"$color\">".$mensaje."</font></td>
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

///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
function pendiente_cambio()
    {
    $id_user= $this->session->userdata('id');
    $id_plaza= $this->session->userdata('id_plaza');
    
    $sql="SELECT a.motivo,a.fecha_c,fecha_mov,a.nomina,a.cia,a.suc2,a.suc_as400,fecha_rh,a.id_user,a.id_rh,
 b.nombre as suc2x, c.nombre as suc_as400x,d.nombre as id_userx,e.nombre as id_rhx,
 concat(trim(f.pat),' ',trim(f.mat),' ',trim(f.nom))as nominax,g.ciax,f.afiliacion,f.registro_pat,f.puestox,
 f.rfc,f.curp,f.succ
FROM mov_supervisor a
left join catalogo.sucursal b on b.suc=a.suc2
left join catalogo.sucursal c on c.suc=a.suc_as400
left join usuarios d on d.id=a.id_user
left join usuarios e on e.id=a.id_rh
left join catalogo.cat_empleado f on f.cia=a.cia and f.nomina=a.nomina
left join catalogo.cat_compa_nomina g on g.cia=a.cia 
where a.suc2<>a.suc_as400 and a.motivo=3 and a.tipo>1";
      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"5\" align=\"center\"><strong>CAMBIO DE SUCURSALES QUE NO SE HAN HECHO EN AS400</strong></th>
        </tr>
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>EMPLEADO</strong></th>
        <th><strong>SUCURSAL</strong></th>
        <th><strong>CAPTURA</strong></th>
        <th><strong>VALIDA</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        $color1='red';
        $color2='blue';
        $color3='green';
        foreach($query->result() as $row)
        {
        if($row->motivo=='1'){    
            $tabla.="
            <tr>
            <td align=\"center\"><font color=\"$color1\">".$row->fecha_mov."</font><br />
            ".$row->cia."-".$row->ciax."<br />REG.PAT:".$row->registro_pat."<br />AFILIA:".$row->registro_pat."</td>
            <td align=\"left\">".$row->nomina." <br />".$row->nominax."<br />".$row->puestox."<br />RFC:".$row->rfc."<br />CURP:".$row->curp."</td>
            <td align=\"left\">DE:".$row->suc_as400."-".$row->suc_as400x."<br /><br />A:".$row->suc2."-".$row->suc2x."</td>
            <td align=\"left\">".$row->id_userx."<br /><font color=\"$color2\">".$row->fecha_c."</font></td>
            <td align=\"left\">".$row->id_rhx."<br /><font color=\"$color3\">".$row->fecha_rh."</font></td>
            </tr>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            ";
            }
            if($row->motivo==3){    
            $tabla.="
            <tr>
            <td align=\"center\"><font color=\"$color1\">".$row->fecha_mov."</font><br />
            ".$row->cia."-".$row->ciax."</td>
            <td align=\"left\">".$row->nomina." <br />".$row->nominax."<br />".$row->puestox."</td>
            <td align=\"left\">DE:".$row->suc_as400."-".$row->suc_as400x."<br /><br />A:".$row->suc2."-".$row->suc2x."</td>
            <td align=\"left\">".$row->id_userx."<br /><font color=\"$color2\">".$row->fecha_c."</font></td>
            <td align=\"left\">".$row->id_rhx."<br /><font color=\"$color3\">".$row->fecha_rh."</font></td>
            </tr>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            ";
            }
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE EMPLEADOS :".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
function pendiente_disposicion()
    {
    $id_user= $this->session->userdata('id');
    $id_plaza= $this->session->userdata('id_plaza');
    
    $sql="SELECT a.causa, a.motivo,a.fecha_c,fecha_mov,a.nomina,a.cia,a.suc2,a.suc_as400,a.fecha_rh,a.id_user,a.id_rh,
 b.nombre as suc2x, c.nombre as suc_as400x,d.nombre as id_userx,e.nombre as id_rhx,f.id_plaza,
 concat(trim(f.pat),' ',trim(f.mat),' ',trim(f.nom))as nominax,g.ciax,f.afiliacion,f.registro_pat,f.puestox,
 f.rfc,f.curp,f.succ,i.nombre as contador,i.puesto as conpuesto,j.puesto as asignado
FROM mov_supervisor a
left join catalogo.sucursal b on b.suc=a.suc2
left join catalogo.sucursal c on c.suc=a.suc_as400
left join usuarios d on d.id=a.id_user
left join usuarios e on e.id=a.id_rh
left join catalogo.cat_empleado f on f.cia=a.cia and f.nomina=a.nomina
left join catalogo.cat_compa_nomina g on g.cia=a.cia
left join catalogo.cat_alta_empleado h on h.cia=a.cia and a.nomina=h.empleado and h.motivo='BAJA'
left join usuarios i on i.id=h.id_user  
left join usuarios j on j.id_plaza=f.id_plaza 
where a.suc2<>a.suc_as400 and a.motivo=2 and a.activo=1and borrar='A'
group by a.cia,a.nomina

order by fecha_mov";
      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"5\" align=\"center\"><strong>EMPLEADOS QUE NO SE HAN DADO DE BAJA EN EL AS400</strong></th>
        </tr>
        <tr>
        <th><strong>COMPA&Ntilde;IA</strong></th>
        <th><strong>EMPLEADO</strong></th>
        <th><strong>SUCURSAL</strong></th>
        <th><strong>CAPTURA</strong></th>
        <th><strong>VALIDA</strong></th>
        </tr>
        </thead>
        ";
        $num=0;
        $color1='purple';
        $color2='blue';
        $color3='green';
        foreach($query->result() as $row)
        {
            if($row->contador==0){$mott='EL CONTADOR NO HAN HECHO EL TRAMITE DE BAJA';$color4='red';
            }else{$mott='EL CONTADOR HIZO EL TRAMITE DE BAJA PERO RECURSOS HUMANOS NO LO HA CAPTURADO';$color4='black';}
        if($row->motivo=='2'){    
            $tabla.="
            <tr>
            <td align=\"center\"><font color=\"$color1\">".$row->fecha_mov."</font><br />
            ".$row->cia."-".$row->ciax."<br />REG.PAT:".$row->registro_pat."<br />AFILIA:".$row->registro_pat."</td>
            <td align=\"left\">".$row->nomina." <br />".$row->nominax."<br />".$row->puestox."<br />RFC:".$row->rfc."<br />CURP:".$row->curp."</td>
            <td align=\"left\">".$row->suc2."-".$row->suc2x."<br />".$row->asignado."</td>
            <td align=\"left\">".$row->id_userx."<br /><font color=\"$color2\">".$row->fecha_c."</font></td>
            <td align=\"left\">".$row->id_rhx."<br /><font color=\"$color3\">".$row->fecha_rh."</font></td>
            </tr>
            <tr><td align=\"left\" colspan=\"6\"><font color=\"$color2\">OBSERVACION..:".$row->causa."</font></td>
            </tr>
            <tr>
            <td align=\"left\" colspan=\"6\">".$row->contador."<br />".$row->conpuesto."<br /><font color=\"$color4\">".$mott."</font></td>
            </tr>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            ";
            }
               
           
            
$num=$num+1;
        }
$tabla.="
<tr>
<td colspan=\"4\"><strong>TOTAL DE EMPLEADOS :".number_format($num,0)."</strong></td>
</tr> 
</table>";
        
        
        return $tabla;
    
    }
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
function pendiente_alta()
    {
    $id_user= $this->session->userdata('id');
    $id_plaza= $this->session->userdata('id_plaza');
    
    $sql="select a.fecha_i, a.fecha_rh,a.id_rh,f.nombre as id_rhx, a.cia,d.ciax,
concat(a.pat,' ',a.mat,' ',a.nom) as contax, 
a.empleado,concat(c.pat,' ',c.mat,' ',c.nom) as empleadox,
a.nomina,concat(b.pat,' ',b.mat,' ',b.nom)as nominax,b.cia as ciaa,e.ciax as ciaax
from catalogo.cat_alta_empleado a
left join catalogo.cat_empleado b on a.nomina=b.nomina
left join catalogo.cat_empleado c on a.empleado=c.nomina and a.cia=b.cia
left join catalogo.cat_compa_nomina d on d.cia=a.cia
left join catalogo.cat_compa_nomina e on e.cia=b.cia
left join usuarios f on f.id=a.id_rh 
 where  a.nomina<>a.empleado and a.activo=1 and a.motivo='ALTA' and a.empleado>0 and a.nomina>0
 group by a.cia,a.nomina order by fecha";
      	$query = $this->db->query($sql);
        
$tabla= "
        <table border=\"1\">
        <thead>
        <tr>
        <th colspan=\"5\" align=\"center\"><strong>EMPLEADOS QUE SE LES ASIGN&Oacute; MAL EL NUMERO DE NOMINA</strong></th>
        </tr>
        <tr>
        <th><strong>EMPLEADO</strong></th>
        <th><strong>ASIGNO</strong></th>
        <th><strong>CORRECTO</strong></th>
                
        </tr>
        </thead>
        ";
        $num=0;
        $color1='purple';
        $color2='blue';
        $color3='green';
        foreach($query->result() as $row)
        {
            
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color1\">EL CONTADO CAPTURO ESTA ALTA.: <br /><br />".$row->contax." ".$row->fecha_i."</font><br /><br />
            ".$row->cia."-".$row->ciax."<br />
            <td align=\"left\">".$row->id_rhx." DE RECURSOS HUMANOS LE ASIGNO <br /><font color=\"red\">".$row->empleado."</font><br /> <br /> PERO EL NUMERO ASIGNADO PERTENECE A <br><font color=\"'#264B3E'\">".$row->empleadox."</font> </td>
            <td align=\"left\">No. DE NOMINA CORRECTO ES :<font color=\"'blue'\"><br /> ".$row->nomina." ".$row->nominax."</font></td>
            </tr>
            
            
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
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
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function empleados_pendientes_ab()
    {
     $id_user= $this->session->userdata('id');
     $nivel= $this->session->userdata('nivel'); 
     $tipo= $this->session->userdata('tipo');
	 $id_plaza= $this->session->userdata('id_plaza'); 
     if($tipo==1){
     $sql = "SELECT a.*,b.nombre,b.dire,c.nivel as nivelx,c.nombre as captura, c.puesto
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join usuarios c on c.id=a.id_user
      where a.tipo=1 and b.id_plaza=$id_plaza
      or a.motivo='CAMBIOS' and a.tipo=1
      ";
        
     }else{  
     $sql = "SELECT a.*,b.nombre,b.dire,c.nivel as nivelx,b.id_plaza,c.nombre as captura, c.puesto
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join usuarios c on c.id=a.id_user
      where a.id_user=$id_user and a.tipo=1
	  or a.motivo='RETENCION' and b.id_plaza=$id_plaza and a.tipo=1
      ";
      
      }
        $query = $this->db->query($sql);
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Motivo  </th>
        <th>Nomina<br />Nombre</th>
        <th>Sucursal</th>
        <th>RFC <br />CURP  </th>
        <th>Afiliacion <br />Registro patronal</th>
        <th>Salario Diario <br />Integrado</th>
        <th>Fecha de captura</th>
        <th>Recibo</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
        
            
           
            $l2 = anchor('recursos_humanos/tabla_empleados_vista/'.$row->id, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver formato!', 'class' => 'encabezado','target'=>'blank'));
            $l3 = anchor('recursos_humanos/tabla_empleados_borrar_c/'.$row->id.'/'.$row->motivo, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
            $l4 = anchor('recursos_humanos/tabla_empleados_validar/'.$row->id.'/'.$row->motivo, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
if($row->nivelx==14){$l3='';}            
            $tabla.="
            <tr>
            <td align=\"center\">".$row->motivo." ".$l4."</td>
            <td align=\"center\">".$row->empleado."<br />  ".$row->nom." ".$row->pat." ".$row->mat."</td>
            <td align=\"center\">".$row->suc." ".$row->nombre."</td>
            <td align=\"left\">".$row->rfc." <BR />".$row->cur."</td>
            <td align=\"left\">".$row->afilia."<br /> ".$row->registro_pat."</td>
            <td align=\"right\">".number_format($row->salario,2)."<br /> ".number_format($row->integrado,2)."</td>
            <td align=\"right\">".$row->fecha."</td>
             <td align=\"right\">".$l3." ".$l2."</td>
            </tr>
            <td align=\"left\" colspan=\"8\"><font color=\"blue\">CAPTURA.:".$row->captura." <b>".$row->puesto."</b><br />".$row->causa."</font></td>
            <tr>
			</tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }



/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
function empleados_mov_ab($fec1,$fec2,$mot)
    {
     $id_user=$this->session->userdata('id');
     $nivel=$this->session->userdata('nivel');
     $id_plaza=$this->session->userdata('id_plaza');
     $tipo=$this->session->userdata('tipo'); 
     
      
     $sql = "SELECT a.*,b.nombre, d.nombre as id_userx,d.puesto as contador,c.ciax,e.puesto as puestox,f.nombre as id_rhx,f.puesto as puesto_val
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      left join usuarios d on d.id=a.id_user
      left join catalogo.cat_puesto e on e.id=a.puesto
      left join usuarios f on f.id=a.id_rh
      where 
      a.id_user=$id_user and date_format(fecha_rh,'%Y-%m-%d')>='$fec1' 
      and date_format(fecha_rh,'%Y-%m-%d')<='$fec2' and motivo='$mot' and a.tipo>1 order by fecha desc";
      $query = $this->db->query($sql);
        $detalle= "
        <table border=\"1\">
        ";
        
        foreach($query->result() as $row)
        {
        if($row->activo==0 and $row->motivo=='ALTA'){$color='red';$var='NO ESTA EN EL AS400';}
        if($row->activo==1 and $row->motivo=='ALTA'){$color='blue';$var='ESTA ACTIVO EN EL AS400';}
        if($row->activo==2 and $row->motivo=='ALTA'){$color='green';$var='ESTA DADO DE BAJA EN EL AS400';}
        if($row->activo==0 and $row->motivo=='BAJA'){$color='red';$var='NO ESTA EN EL AS400';}
        if($row->activo==1 and $row->motivo=='BAJA'){$color='red';$var='ESTA ACTIVO EN EL AS400';}
        if($row->activo==2 and $row->motivo=='BAJA'){$color='green';$var='ESTA DADO DE BAJA EN EL AS400';}
        if($row->activo==0 and $row->motivo=='RETENCION'){$color='red';$var='NO ESTA EN EL AS400';}
        if($row->activo==1 and $row->motivo=='RETENCION'){$color='red';$var='ESTA ACTIVO EN EL AS400';}
        if($row->activo==2 and $row->motivo=='RETENCION'){$color='green';$var='ESTA DADO DE BAJA EN EL AS400';}
            
            $detalle.="
            <tr>
            <td align=\"left\"><font color=\"black\">".$row->empleado."<br />".$row->nom." ".$row->pat." ".$row->mat."</font></td>
            <td align=\"left\"><font color=\"black\">".$row->dire." # ".$row->num." <br />
            <strong>COLONIA </strong>".$row->col."<br /><strong>ENTIDADA </strong>".$row->entidad."</font></td>
            <td align=\"left\"><font color=\"black\">".$row->puestox."SALARIO.......: $ ".$row->salario."<br />INTEGREDO.: $ ".$row->integrado."</font></td>
            <td align=\"left\"><font color=\"black\">".$row->suc." ".$row->nombre."</font></td>
            <td align=\"left\"><font color=\"black\">".$row->id_userx." ".$row->contador."</font></td>
            <td align=\"left\"><font color=\"black\">".$row->rfc." <BR />".$row->cur."</font></td>
            <td align=\"left\"><font color=\"black\">".$row->afilia."<BR />".$row->registro_pat."</font></td>
            <td align=\"left\"><font color=\"black\">".$row->fecha."<BR />".$row->fecha_rh."</font></td>
            </tr>
            <tr>
            <td align=\"left\" colspan=\"8\"><font color=\"$color\"><strong>CAUSA..:</strong>".$row->causa."<BR />CIA..:".$row->ciax."<BR />AS400..:".$var."</font></td>
            </tr>
            <tr bgcolor=\"#D8D1D1\">
            <td align=\"left\" colspan=\"8\"></td>
            </tr>
            ";
            
        }
        
        $detalle.="
        </table>";
        
       
        return $detalle;
    }
    
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////ROCIO,LUIS Y OSCAR
    function empleados_pendientes_his()
    {
     $id_user= $this->session->userdata('id');
     $nivel= $this->session->userdata('nivel');   
     $tipo= $this->session->userdata('tipo');   
     if($nivel==3){
     $sql = "SELECT a.*,b.nombre,b.dire,d.ciax
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina d on d.cia=a.cia
      where a.id_user=$id_user and tipo=2
      order by fecha desc 
      ";
      
      $query = $this->db->query($sql);
      }
      if($nivel==7){
     $sql = "SELECT a.*,b.nombre,b.dire,d.ciax
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina d on d.cia=a.cia
      where  tipo=2 and  motivo='RETENCION' or tipo=2 and  motivo='REACTIVACION'
      order by fecha desc 
      ";
      $query = $this->db->query($sql);
      }
      if($nivel==33){
     if($tipo < 2){
     $sql = "SELECT a.*,b.nombre,b.dire,d.ciax
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina d on d.cia=a.cia
      where tipo=2 
      order by fecha desc
      ";
      $query = $this->db->query($sql);
      $s = "SELECT a.*,b.nombre,b.dire,c.pat,c.mat,c.nom,d.ciax,e.nombre as mo
      FROM mov_supervisor a
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_empleado c on c.cia=a.cia and c.nomina=a.nomina
      left join catalogo.cat_compa_nomina d on d.cia=a.cia
      left join catalogo.cat_mov_super e on e.id=a.motivo
      where 
      a.tipo=2  and motivo=3 
      ";
      $q = $this->db->query($s);
     }
     
    
     if($tipo==3){
     $sql = "SELECT a.*,b.nombre,b.dire,d.ciax
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina d on d.cia=a.cia
      where 
      tipo=2 and a.cia=2 and motivo<>'RETENCION' 
      or 
      tipo=2 and a.cia=3 and motivo<>'RETENCION'
      or 
      tipo=2 and a.cia=9 and motivo<>'RETENCION'
      or 
      tipo=2 and a.cia=11 and motivo<>'RETENCION'
      or 
      tipo=2 and a.cia=12 and motivo<>'RETENCION'
      or 
      tipo=2 and a.cia=14 and motivo<>'RETENCION'
      or 
      tipo=2 and a.cia=21 and motivo<>'RETENCION'
      order by motivo,fecha desc 
      ";
      $query = $this->db->query($sql);
      $query = $this->db->query($sql);
       $s = "SELECT a.*,b.nombre,b.dire,c.pat,c.mat,c.nom,d.ciax,e.nombre as mo
      FROM mov_supervisor a
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_empleado c on c.cia=a.cia and c.nomina=a.nomina
      left join catalogo.cat_compa_nomina d on d.cia=a.cia
      left join catalogo.cat_mov_super e on e.id=a.motivo
      where 
      a.tipo=2 and a.cia=2 and motivo=3 
      or 
      a.tipo=2 and a.cia=3 and motivo=3 
      or 
      a.tipo=2 and a.cia=9 and motivo=3 
      or 
      a.tipo=2 and a.cia=11 and motivo=3
      or 
      a.tipo=2 and a.cia=12 and motivo=3
      or 
      a.tipo=2 and a.cia=14 and motivo=3
      or 
      a.tipo=2 and a.cia=21 and motivo=3
      order by motivo,fecha_mov desc 
      ";
      $q = $this->db->query($s);
     }
     
 if($tipo==5){
     $sql = "SELECT a.*,b.nombre,b.dire,c.ciax
      FROM catalogo.cat_alta_empleado a
      left join catalogo.sucursal b on b.suc=a.suc
      left join catalogo.cat_compa_nomina c on c.cia=a.cia
      where 
      tipo=2 and a.cia=1 and motivo<>'RETENCION'
      or 
      tipo=2 and a.cia=4 and motivo<>'RETENCION'
      or 
      tipo=2 and a.cia=5 and motivo<>'RETENCION'
      or 
      tipo=2 and a.cia=6 and motivo<>'RETENCION'
      or 
      tipo=2 and a.cia=8 and motivo<>'RETENCION'
      or 
      tipo=2 and a.cia=13 and motivo<>'RETENCION'
      or 
      tipo=2 and a.cia=20 and motivo<>'RETENCION'
      order by fecha desc
      ";
      $query = $this->db->query($sql);
       $s = "SELECT a.*,b.nombre,b.dire,c.pat,c.mat,c.nom,d.ciax,e.nombre as mo
       FROM mov_supervisor a
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_empleado c on c.cia=a.cia and c.nomina=a.nomina
      left join catalogo.cat_compa_nomina d on d.cia=a.cia
      left join catalogo.cat_mov_super e on e.id=a.motivo
      where 
      a.tipo=2 and a.cia=1 and motivo=3
      or 
      a.tipo=2 and a.cia=4 and motivo=3
      or 
      a.tipo=2 and a.cia=5 and motivo=3
      or 
      a.tipo=2 and a.cia=6 and motivo=3
      or 
      a.tipo=2 and a.cia=8 and motivo=3
      or 
      a.tipo=2 and a.cia=13 and motivo=3
      or 
      a.tipo=2 and a.cia=20 and motivo=3
      order by motivo,fecha_mov desc 
      ";
      $q = $this->db->query($s);
     }
      if($tipo==6){
     
       $s = "SELECT a.*,b.nombre,b.dire,c.pat,c.mat,c.nom,d.ciax,e.nombre as mo
      FROM mov_supervisor a
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_empleado c on c.cia=a.cia and c.nomina=a.nomina
      left join catalogo.cat_compa_nomina d on d.cia=a.cia
      left join catalogo.cat_mov_super e on e.id=a.motivo
      where 
      a.tipo=2 and motivo=5 and a.id_rh=0
      order by motivo,fecha_mov desc 
      ";
      $q = $this->db->query($s);
     }

      }
      
        $tabla1= "";
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Movimiento</th>
        <th>Nomina</th>
        <th>Nombre</th>
        <th>Sucursal</th>
        <th>RFC <br />CURP  </th>
        <th>Afiliacion</th>
        <th>Registro patronal</th>
        <th>Fecha de captura</th>
        <th>Recibo</th>
        </tr>
        </thead>
        <tbody>
        ";
        if($tipo<>6){
        foreach($query->result() as $row)
        {
        
            
           if($nivel==33 || $nivel==7){
           $l3 = anchor('recursos_humanos/tabla_empleados_cambia_rh/'.$row->id.'/'.$row->motivo, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver formato!', 'class' => 'encabezado')); 
           }else{
           $l3 = ''; 
           }
            $l2 = anchor('catalogo/tabla_empleados_vista/'.$row->id, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver formato!', 'class' => 'encabezado', 'target' => 'blank'));
           if($nivel==33 and $tipo==0 || $nivel==33 and $tipo==1 and $row->motivo<>'RETENCION'){$l3='';} 
            $l4 = '';
            $tabla.="
            <tr>
            <td align=\"center\">".$row->motivo."</td>
            <td align=\"center\">".$row->empleado."</td>
            <td align=\"center\">".$row->nom." ".$row->pat." ".$row->mat."</td>
            <td align=\"center\">".$row->suc." ".$row->nombre."</td>
            <td align=\"left\">".$row->rfc." <BR />".$row->cur."</td>
            <td align=\"left\">".$row->afilia."</td>
            <td align=\"left\">".$row->registro_pat."</td>
            <td align=\"right\">".$row->fecha."</td>
            <td align=\"right\">".$l3." ".$l2."___</td>
            </tr>
            <tr>
            <td align=\"left\" colspan=\"9\">".$row->ciax."</td>
            </tr>
            <tr></tr><tr></tr><tr></tr>
            ";
        }}
        
  if($nivel<>7){      
        foreach($q->result() as $r)
        {
            
            $l1 = anchor('recursos_humanos/tabla_empleados_cambia_rh/'.$r->id.'/'.$r->motivo, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver formato!', 'class' => 'encabezado'));
             if($nivel==33 and $tipo==0 || $nivel==33 and $tipo==1){$l1='';}
            $tabla1.="
            <tr>
            <td align=\"center\">".$r->mo."</td>
            <td align=\"center\">".$r->nomina."</td>
            <td align=\"center\">".$r->nom." ".$r->pat." ".$r->mat."</td>
            <td align=\"left\" colspan=\"4\">".$r->causa."<br /><font color=\"blue\">Fecha mov.:".$r->fecha_mov."</font></td>
            <td align=\"right\"><font color=\"blue\">".$r->fecha_c."</font></td>
            <td align=\"right\">".$l1."___</td>
            </tr>
            <tr>
            <td align=\"left\" colspan=\"9\">".$r->ciax."</td>
            </tr>
            <tr></tr><tr></tr><tr></tr>";
 }       
        }
        $tabla1.="
        </tbody>
        </table>";
        $tablaf=$tabla.$tabla1;
        return $tablaf;
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
 function empleados_succ_cambio($id)
    {
     $id_user= $this->session->userdata('id');
     $nivel= $this->session->userdata('nivel');   
     $tipo= $this->session->userdata('tipo');   
       $s = "SELECT a.*,b.nombre,b.dire,c.pat,c.mat,c.nom,d.ciax
      FROM mov_supervisor a
      left join catalogo.sucursal b on b.suc=a.suc2
      left join catalogo.cat_empleado c on c.cia=a.cia and c.nomina=a.nomina
      left join catalogo.cat_compa_nomina d on d.cia=a.cia
      where a.id=$id
       ";
      $q = $this->db->query($s);
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Movimiento</th>
        <th>Nomina</th>
        <th>Nombre</th>
        <th>Sucursal</th>
        <th>RFC <br />CURP  </th>
        <th>Afiliacion</th>
        <th>Registro patronal</th>
        <th>Fecha de captura</th>
        <th>Recibo</th>
        </tr>
        </thead>
        <tbody>
        ";
        
       
        foreach($q->result() as $r)
        {
            $tabla.="
            <tr>
            <td align=\"center\">CAMBIOS</td>
            <td align=\"center\">".$r->nomina."</td>
            <td align=\"center\">".$r->nom." ".$r->pat." ".$r->mat."</td>
            <td align=\"center\" colspan=\"3\">".$r->causa."</td>
            <td align=\"right\">".$r->fecha_mov."</td>
            <td align=\"right\"></td>
            </tr>
            <tr>
            <td align=\"left\" colspan=\"8\">".$r->ciax."</td>
            </tr>
            <tr></tr><tr></tr><tr></tr>";
        }
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function empleados_pendientes_incapacidad($clave)
    {
     
	 $id_user= $this->session->userdata('id');
     $nivel= $this->session->userdata('nivel');   
     $tipo= $this->session->userdata('tipo');   
if($clave==644){    
       $s = "SELECT a.*,b.nombre as sucx,b.dire,c.pat,c.mat,c.nom,d.ciax,e.nombre as mo,
       f.nombre as id_userx
      FROM faltante a
      left join catalogo.sucursal b on b.suc=a.succ
      left join catalogo.cat_empleado c on c.cia=a.cianom and c.nomina=a.nomina
      left join catalogo.cat_compa_nomina d on d.cia=a.cianom
      left join catalogo.cat_nom_claves e on e.clave=a.clave
      left join usuarios f on f.id=a.id_user
      where  a.clave=$clave and a.id_plaza=999 and documento='  '
      ";
      $q = $this->db->query($s);
}else{
$s = "SELECT a.*,b.nombre as sucx,b.dire,c.pat,c.mat,c.nom,d.ciax,e.nombre as mo,
       f.nombre as id_userx
      FROM faltante a
      left join catalogo.sucursal b on b.suc=a.succ
      left join catalogo.cat_empleado c on c.cia=a.cianom and c.nomina=a.nomina
      left join catalogo.cat_compa_nomina d on d.cia=a.cianom
      left join catalogo.cat_nom_claves e on e.clave=a.clave
      left join usuarios f on f.id=a.id_user
      where  a.clave=$clave and a.id_plaza=999 and fecpre>='2012-10-01' and documento='  '
      ";
      $q = $this->db->query($s);    
}    
      
        $tabla1= "";
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Movimiento</th>
        <th>Captura</th>
        <th>Empleado</th>
        <th>Fecha</th>
        <th>folio</th>
        <th>dias</th>
        <th>Descontar en</th>
        <th></th>
        </tr>
        </thead>
        <tbody>
        ";
    
        foreach($q->result() as $r)
        {
            
            $l1 = anchor('recursos_humanos/entrega_recibo/'.$r->id.'/'.$r->clave, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver formato!', 'class' => 'encabezado'));
            $tabla1.="
            <tr>
            <td align=\"center\">".$r->mo."--".$r->observacion."</td>
            <td align=\"center\">".$r->id_userx."<br />".$r->fecha."</td>
            <td align=\"left\">".$r->nomina." ".$r->nom." ".$r->pat." ".$r->mat."<br /><font color=\"'blue'\">".$r->sucx."</font></td>
            <td align=\"left\"><font color=\"blue\">".$r->fecha."</font></td>
            <td align=\"center\">".$r->folioi."</td>
			<td align=\"right\"><font color=\"blue\">".$r->fal."</font></td>
            <td align=\"center\">".$r->fecpre."</td>
			<td align=\"right\">".$l1."___</td>
            </tr>
            <tr>
            <td align=\"left\" colspan=\"9\">".$r->ciax."</td>
            </tr>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>";
        
        }
        $tabla1.="
        </tbody>
        </table>";
        $tablaf=$tabla.$tabla1;
        return $tablaf;
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function empleados_pendientes_uno($id)
    {
     
	 $id_user= $this->session->userdata('id');
     $nivel= $this->session->userdata('nivel');   
     $tipo= $this->session->userdata('tipo');   
       $s = "SELECT a.*,b.nombre as sucx,b.dire,c.pat,c.mat,c.nom,d.ciax,e.nombre as mo,
       f.nombre as id_userx
      FROM faltante a
      left join catalogo.sucursal b on b.suc=a.succ
      left join catalogo.cat_empleado c on c.cia=a.cianom and c.nomina=a.nomina
      left join catalogo.cat_compa_nomina d on d.cia=a.cianom
      left join catalogo.cat_nom_claves e on e.clave=a.clave
      left join usuarios f on f.id=a.id_user
      where a.id=$id and documento='  '
      ";
      $q = $this->db->query($s);
      
        $tabla1= "";
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Movimiento</th>
        <th>Captura</th>
        <th>Empleado</th>
        <th>Fecha</th>
        <th>folio</th>
        <th>dias</th>
        <th>Descontar en</th>
        </tr>
        </thead>
        <tbody>
        ";
    
        foreach($q->result() as $r)
        {
            
            $tabla1.="
            <tr>
            <td align=\"center\">".$r->mo."--".$r->observacion."</td>
            <td align=\"center\">".$r->id_userx."<br />".$r->fecha."</td>
            <td align=\"left\">".$r->nomina." ".$r->nom." ".$r->pat." ".$r->mat."<br /><font color=\"'blue'\">".$r->sucx."</font></td>
            <td align=\"left\"><font color=\"blue\">".$r->fecha."</font></td>
            <td align=\"center\">".$r->folioi."</td>
			<td align=\"right\"><font color=\"blue\">".$r->fal."</font></td>
            <td align=\"center\">".$r->fecpre."</td>
			</tr>
            <tr>
            <td align=\"left\" colspan=\"9\">".$r->ciax."</td>
            </tr>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>";
        
        }
        $tabla1.="
        </tbody>
        </table>";
        $tablaf=$tabla.$tabla1;
        return $tablaf;
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
       function cambia_member_recibo_fal_in($id,$clave,$obser)
    {
     $id_nombre= $this->session->userdata('nombre'); 
     $data = array(
     'documento'=>'FECHA.:'.date('Y-m-d H:i:s').' VALIDO.: '.$id_nombre.' OBSERVACION.: '.strtoupper($obser)
     );
 	 $this->db->where('id', $id);
     $this->db->update('faltante', $data);
     return $this->db->affected_rows();
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function entrega_recibo_his($clave,$fec1,$fec2)
    {
     
	 $id_user= $this->session->userdata('id');
     $nivel= $this->session->userdata('nivel');   
     $tipo= $this->session->userdata('tipo');   
if($clave==644){    
       $s = "SELECT a.*,b.nombre as sucx,b.dire,c.pat,c.mat,c.nom,d.ciax,e.nombre as mo,
       f.nombre as id_userx
      FROM faltante a
      left join catalogo.sucursal b on b.suc=a.succ
      left join catalogo.cat_empleado c on c.cia=a.cianom and c.nomina=a.nomina
      left join catalogo.cat_compa_nomina d on d.cia=a.cianom
      left join catalogo.cat_nom_claves e on e.clave=a.clave
      left join usuarios f on f.id=a.id_user
      where  a.clave=$clave and a.id_plaza=999 and documento>'  '
      ";
      $q = $this->db->query($s);
}else{
$s = "SELECT a.*,b.nombre as sucx,b.dire,c.pat,c.mat,c.nom,d.ciax,e.nombre as mo,
       f.nombre as id_userx
      FROM faltante a
      left join catalogo.cat_empleado c on c.cia=a.cianom and c.nomina=a.nomina
      left join catalogo.sucursal b on b.suc=c.succ
      left join catalogo.cat_compa_nomina d on d.cia=a.cianom
      left join catalogo.cat_nom_claves e on e.clave=a.clave
      left join usuarios f on f.id=a.id_user
      where  a.clave=$clave and a.id_plaza=999 and fecpre>='2012-10-01' and documento>'  '
      ";
      $q = $this->db->query($s);    
}    
      
        $tabla1= "";
        $tabla= "
        <table>
        <thead>
        <tr>
        <th>Movimiento</th>
        <th>Captura</th>
        <th>Empleado</th>
        <th>Fecha</th>
        <th>folio</th>
        <th>dias</th>
        <th>Descontar en</th>
        </tr>
        </thead>
        <tbody>
        ";
    
        foreach($q->result() as $r)
        {
            $tabla1.="
            <tr>
            <td align=\"center\">".$r->mo."--".$r->observacion."</td>
            <td align=\"center\">".$r->id_userx."<br />".$r->fecha."</td>
            <td align=\"left\">".$r->nomina." ".$r->nom." ".$r->pat." ".$r->mat."<br /><font color=\"blue\">".$r->sucx."</font></td>
            <td align=\"left\"><font color=\"blue\">".$r->fecha."</font></td>
            <td align=\"center\">".$r->folioi."</td>
			<td align=\"right\"><font color=\"blue\">".$r->fal."</font></td>
            <td align=\"center\">".$r->fecpre."</td>
			</tr>
            <tr>
            <td align=\"left\" colspan=\"9\">".$r->ciax."</td>
            </tr>
            <tr>
            <td align=\"left\" colspan=\"9\">".$r->documento."</td>
            </tr>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>";
        
        }
        $tabla1.="
        </tbody>
        </table>";
        $tablaf=$tabla.$tabla1;
        return $tablaf;
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////











































































}

