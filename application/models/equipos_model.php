<?php
class Equipos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
 ////////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////
 function equipos_validar()
    {
        $nivel = $this->session->userdata('nivel');
        
        
        $s = "SELECT a.*,b.nom,b.pat,b.mat,b.succ,c.nombre as sucx, d.tipo as disp 
        FROM desarrollo.equipos_comunicaciones a 
        left join catalogo.cat_empleado b on b.id=a.id_user
        left join catalogo.sucursal c on c.suc=b.succ
        left join desarrollo.equipos_tipo d on d.id=a.tipo
        where a.activo=0 
        order by succ, id_user
        ";
        $q = $this->db->query($s);
        $tabla="
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>SUCURSAL</th>
        <th>NOMBRE</th>
        <th>TIPO</th>
        <th>NUMERO</th>
        <th>MODELO</th>
        <th>IMEI</th>
        <th>ICCID</th>
        <th>EXT</th>
        
        ";

        if($nivel == 25){
            
        $tabla.= "
        <th>Validar</th>
        <th>Eliminar</th>
        ";
            }
        
        $tabla.= "
        </tr>
        </thead>";
        
  $num=0;
        foreach($q->result() as $r)
        {
	   if($r->activo==2){$color='red';}else{$color='black';}
       if($r->succ<100){$sucx=' ';}else{$sucx=$r->sucx;}
	   $num=$num+1;
       $l= anchor('equipos/validar/'.$r->id, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar', 'class' => 'encabezado'));
       $l1 = anchor('equipos/eliminar/'.$r->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para eliminar', 'class' => 'encabezado'));
       //$l1 = anchor('supervisor/corte_detalle/'.$r->id.'/'.$fec.'/'.$suc,$r->fechacorte.' </a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
           //id, tipo, cel, equipo, nomina, cia, act
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$sucx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->pat." ".$r->mat." ".$r->nom."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->disp."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->cel."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->equipo."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->imei."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->iccid."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->extension."</font></td>
            
            ";
    
    if($nivel == 25){
            
        $tabla.= "
        <td align=\"center\">".$l."</td> 
        <td align=\"center\">".$l1."</td>
        ";
            }
        
        $tabla.= "</tr>";
        }

    $tabla.="</table>";
return $tabla;
}
 
 
 
 ////////////////////////////////////////////////////////////////////////////////////   
    function equipos_activos()
    {
        $nivel = $this->session->userdata('nivel');
        
        
        $s = "SELECT a.*,b.nom,b.pat,b.mat,b.succ,c.nombre as sucx, d.tipo as disp 
        FROM desarrollo.equipos_comunicaciones a 
        left join catalogo.cat_empleado b on b.id=a.id_user
        left join catalogo.sucursal c on c.suc=b.succ
        left join desarrollo.equipos_tipo d on d.id=a.tipo
        where a.activo=1 and a.tipo <>4 and obser=''
        order by succ, a.tipo
        ";
        $q = $this->db->query($s);
        $tabla="
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>SUCURSAL</th>
        <th>NOMBRE</th>
        <th>TIPO</th>
        <th>NUMERO</th>
        <th>MODELO</th>
        ";

        if($nivel == 25){
            
        $tabla.= "
        <th>Editar</th>
        <th>Impresion</th>
        <th>Baja</th>
        ";
            }
        
        $tabla.= "
        </tr>
        </thead>";
        
  $num=0;
        foreach($q->result() as $r)
        {
	   if($r->activo==2){$color='red';}else{$color='black';}
       if($r->succ<100){$sucx=' ';}else{$sucx=$r->sucx;}
	   $num=$num+1;
       $l= anchor('equipos/editar1/'.$r->id, '<img src="'.base_url().'img/Edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar', 'class' => 'encabezado'));
       $l1 = anchor('equipos/imprimir/'.$r->id, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir', 'class' => 'encabezado', 'target' => '_blank'));
       $l2= anchor('equipos/movimiento_observa/'.$r->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para dar de baja', 'class' => 'encabezado'));
       //$l1 = anchor('supervisor/corte_detalle/'.$r->id.'/'.$fec.'/'.$suc,$r->fechacorte.' </a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
           //id, tipo, cel, equipo, nomina, cia, act
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$sucx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->pat." ".$r->mat." ".$r->nom."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->disp."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->cel."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->equipo."</font></td>
            ";
    
    if($nivel == 25){
            
        $tabla.= "
        <td align=\"right\">".$l."</td> 
        <td align=\"right\">".$l1."</td>
        <td align=\"center\">".$l2."</td>
        ";
            }
        
        $tabla.= "</tr>";
        }

    $tabla.="</table>";
return $tabla;
}
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////    
////////////////////////////////////////////////////////////////////////////////////
    function equipos_bajas()
    {
        $nivel = $this->session->userdata('nivel');
        
        $s = "SELECT b.nomina, a.*,b.nom,b.pat,b.mat,b.succ,c.nombre as sucx, d.tipo as disp 
        FROM desarrollo.equipos_comunicaciones a 
        left join catalogo.cat_empleado b on b.id=a.id_user
        left join catalogo.sucursal c on c.suc=b.succ
        left join desarrollo.equipos_tipo d on d.id=a.tipo
        left join catalogo.cat_alta_empleado e on e.empleado=b.nomina and e.cia=b.cia
        where b.tipo=2 and a.tipo <>4 and obser=''
        or
         e.motivo='RETENCION' and e.activo=1 and a.tipo <>4 and obser=''
         group by a.id
        order by succ, id_user
        ";
        $q = $this->db->query($s);
        $tabla="
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>SUCURSAL</th>
        <th>NOMBRE</th>
        <th>TIPO</th>
        <th>NUMERO</th>
        <th>MODELO</th>
        ";

        if($nivel == 25){
            
        $tabla.= "
        <th>Validar</th>
        ";
            }
        
        $tabla.= "
        </tr>
        </thead>";
        
  $num=0;
        foreach($q->result() as $r)
        {
	   if($r->activo==2){$color='red';}else{$color='black';}
       if($r->succ<100){$sucx=' ';}else{$sucx=$r->sucx;}
	   $num=$num+1;
       $l= anchor('equipos/movimiento_observa/'.$r->id, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar', 'class' => 'encabezado'));
       //$l1 = anchor('supervisor/corte_detalle/'.$r->id.'/'.$fec.'/'.$suc,$r->fechacorte.' </a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
           //id, tipo, cel, equipo, nomina, cia, act
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$sucx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->nomina." ".$r->pat." ".$r->mat." ".$r->nom."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->disp."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->cel."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->equipo."</font></td>
            ";
    
        if($nivel == 25){
            
        $tabla.= "
        <td align=\"center\">".$l."</td>
        ";
            }
        
        $tabla.= "</tr>";
        }

    $tabla.="</table>";
return $tabla;
}
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
   
    
    
    function guardar_equipo()
    {
        
        $ext = $this->input->post('extension');
        $cel=$this->input->post('celular');
        $tipo=$this->input->post('equipo');
        if ($cel == null){
        $cel=0;    
        }
        
        if(strlen(trim($ext)) == 0){
            $this->db->set('extension', 'null', false);
        }else{
            $this->db->set('extension', $ext, false);
        }
if($tipo==1 || $tipo==2){
$s = "SELECT * FROM desarrollo.equipos_comunicaciones where cel=$cel and tipo=$tipo and obser=' '";
$q = $this->db->query($s);
$si= $q->num_rows();
}else{
$si=0;    
}
  
        if( $si== 0){
            
        $data = array(
           'tipo' => $this->input->post('equipo'),
           'cel' => $this->input->post('celular'),
           'equipo' => $this->input->post('modelo'),
           'imei' => $this->input->post('imei'),
           'iccid' => $this->input->post('iccid'),
           'fijo' => $this->input->post('fijo'),
           'correo' => $this->input->post('correo'),
           'id_user' => $this->input->post('empleado')
      
        );
    $this->db->set('fecha', 'now()', false);
     $this->db->insert('desarrollo.equipos_comunicaciones', $data);
     return $this->db->insert_id();
    }else{
    $id='_';    
    return $id;
    }
    }
    
    /////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_tipo()
    {
        
        $sql = "SELECT *from equipos_tipo";
        $query = $this->db->query($sql);
        
        $equipo = array();
        $equipo[0] = "Selecciona un tipo de equipo";
        
        foreach($query->result() as $row){
            $equipo[$row->id] = $row->tipo;
        }
        
        return $equipo;  
    }
  
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////  
    function busca_empleado()
    {
        
        $sql = "SELECT * from catalogo.cat_empleado where tipo=1 and nomina > 0 order by pat, mat";
        $query = $this->db->query($sql);
        
        $empleado = array();
        $empleado['0'] = "Selecciona un empleado";
        
        foreach($query->result() as $row){
            $empleado[$row->id] = $row->completo;
        }
        
        return $empleado;  
    }

///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

    function editar_equipo($id, $id_user)
    {
        $data = array(
           
           'id_user' => $id_user,
        );
        $this->db->where('id', $id);
        $this->db->update('equipos_comunicaciones', $data);
        return $this->db->affected_rows();
    }
    
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
    
    function validar_equipo($id)
    {
        $sql="update equipos_comunicaciones set activo=1 where activo=0";
        $query = $this->db->query($sql);
        
    }
    
    function personal_eliminar($id)
    {
        $this->db->delete('equipos_comunicaciones',  array('id' => $id));
    }
    
/////////////////////////////////////////////////////
    function busca_observa()
    {
        
        $sql = "SELECT * FROM catalogo.cat_obser_com";
        $query = $this->db->query($sql);
        
        $mot = array();
        $mot[0] = "Selecciona una Observacion";
        foreach($query->result() as $row){
            $mot[$row->obserx] = $row->obserx;
        }
        
        return $mot; 
     }

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
function datos_equipo($id)
    {
    $id_user= $this->session->userdata('id');
    
    $sql="SELECT a.*,b.nom,b.pat,b.mat,b.succ, b.puestox, c.nombre as sucx, d.tipo as disp 
        FROM desarrollo.equipos_comunicaciones a 
        left join catalogo.cat_empleado b on b.id=a.id_user
        left join catalogo.sucursal c on c.suc=b.succ
        left join desarrollo.equipos_tipo d on d.id=a.tipo
        where a.id=$id";
      
 
      
      	$q = $this->db->query($sql);
        
        $tabla="
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>SUCURSAL</th>
        <th>NOMBRE</th>
        <th>TIPO</th>
        <th>NUMERO</th>
        <th>MODELO</th>
        </tr>
        </thead>";
        
  $num=0;
        foreach($q->result() as $r)
        {
	   if($r->activo==2){$color='red';}else{$color='black';}
       if($r->succ<100){$sucx=' ';}else{$sucx=$r->sucx;}
	   $num=$num+1;
       
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$sucx."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->pat." ".$r->mat." ".$r->nom."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->disp."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->cel."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->equipo."</font></td>
       
    
         </tr>";
        }

    $tabla.="</table>";
return $tabla;
}

//////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function valida_equipo_obser($id,$obser)
    {
     $data = array(
           
           'obser' => $obser,
        );
 	 $this->db->where('id', $id);
     $this->db->update('equipos_comunicaciones', $data);
     return $this->db->affected_rows();   	 
     }
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
   
    
    
    function captura_vehiculo()
    {   
    $s = "select * from desarrollo.vehiculo v";
    $q = $this->db->query($s);
    $si= $q->num_rows();
           
        $data = array(
           'marca' => $this->input->post('marca'),
           'modelo' => $this->input->post('modelo'),
           'anio' => $this->input->post('anio'),
           'numser' => $this->input->post('numser'),
           'placas' => $this->input->post('placas'),
           'recibe' => $this->input->post('empleado'),
           'entrega' => $this->input->post('entrega'),
           'color' => $this->input->post('color'),
      
        );
     $this->db->set('fecha', 'now()', false);
     $this->db->insert('desarrollo.vehiculo', $data);
    
    
    
    }
    
    function busca_empleado1()
    {
        
        $sql = "SELECT * from catalogo.cat_empleado where tipo=1 and nomina > 0 order by pat, mat";
        $query = $this->db->query($sql);
        
        $empleado = array();
        $empleado['0'] = "Selecciona un empleado";
        
        foreach($query->result() as $row){
            $empleado[$row->nomina] = $row->completo;
        }
        
        return $empleado;  
    }   
    
        function vehiculo_validar()
        {
           
        $s = "select v.id, marca, modelo, placas, completo from desarrollo.vehiculo v left join catalogo.cat_empleado c on recibe=nomina where activo=1
        ";
        $q = $this->db->query($s);
        $tabla="
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Placas</th>
        <th>Nombre</th>
        
        
        ";

      
            
        $tabla.= "
        <th>Validar</th>
        <th>Eliminar</th>
        ";
           
        
        $tabla.= "
        </tr>
        </thead>";
        
  
        foreach($q->result() as $r)
        {
       $l= anchor('equipos/validar_vehiculo/'.$r->id, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar', 'class' => 'encabezado'));
       $l1 = anchor('equipos/eliminar_vehiculo/'.$r->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para eliminar', 'class' => 'encabezado'));
       
            $tabla.="
            <tr>
            <td align=\"left\"><font>".$r->marca."</font></td>
            <td align=\"left\"><font>".$r->modelo."</font></td>
            <td align=\"left\"><font>".$r->placas."</font></td>
            <td align=\"left\"><font>".$r->completo."</font></td>
         
            
            ";
    
   
            
        $tabla.= "
        <td align=\"center\">".$l."</td> 
        <td align=\"center\">".$l1."</td>
        ";
            
        
        $tabla.= "</tr>";
        }

    $tabla.="</table>";
    return $tabla;
    }

    function vehiculo_eliminar($id)
    {
        $this->db->delete('vehiculo',  array('id' => $id));
    }
    

    function validar_vehiculo($id)
    {
        $sql="update vehiculo set activo=2 where id=$id";
        $query = $this->db->query($sql);
    }
    
    
    function activos_vehiculos()
        {
           
        $s = "select v.id, marca, modelo, placas, completo from desarrollo.vehiculo v left join catalogo.cat_empleado c on recibe=nomina where activo=2
        ";
        $q = $this->db->query($s);
        $tabla="
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Placas</th>
        <th>Nombre</th>
        
        
        ";

      
            
        $tabla.= "
       <th>Imprime</th>
        ";
           
        
        $tabla.= "
        </tr>
        
        </thead>";
        
  
        foreach($q->result() as $r)
        {
      $l1 = anchor('equipos/acuse_vehiculo/'.$r->id, '<img src="'.base_url().'img/reportes2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir', 'class' => 'encabezado', 'target' => '_blank'));
            $tabla.="
            <tr>
            <td align=\"left\"><font>".$r->marca."</font></td>
            <td align=\"left\"><font>".$r->modelo."</font></td>
            <td align=\"left\"><font>".$r->placas."</font></td>
            <td align=\"left\"><font>".$r->completo."</font></td>
         
            
            ";
    
   
            
        $tabla.= "
          <td align=\"center\">".$l1."</td> 
        ";
            
        
        $tabla.= "</tr>";
        }

    $tabla.="</table>";
    return $tabla;
    }
    
    function baja_vehiculos()
        {
           
        $s = "select v.id, marca, modelo, placas, completo from desarrollo.vehiculo v left join catalogo.cat_empleado c on recibe=nomina where activo=4
        ";
        $q = $this->db->query($s);
        $tabla="
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Placas</th>
        <th>Nombre</th>
        
        
        ";

      
            
        $tabla.= "
       
        ";
           
        
        $tabla.= "
        </tr>
        </thead>";
        
  
        foreach($q->result() as $r)
        {
      
            $tabla.="
            <tr>
            <td align=\"left\"><font>".$r->marca."</font></td>
            <td align=\"left\"><font>".$r->modelo."</font></td>
            <td align=\"left\"><font>".$r->placas."</font></td>
            <td align=\"left\"><font>".$r->completo."</font></td>
         
            
            ";
    
   
            
        $tabla.= "
        
        ";
            
        
        $tabla.= "</tr>";
        }

    $tabla.="</table>";
    return $tabla;
    }



}
