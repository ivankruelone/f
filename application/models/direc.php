<?php
class Direc extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function guardar_empleado()
    {
        $data = array(
           'depto' => $this->input->post('depto'),
           'nombre' => $this->input->post('nombre'),
           'ext' => $this->input->post('ext'),
           'movil' => $this->input->post('movil'),
           'correo' => $this->input->post('correo'),
        );
      
     $this->db->insert('directorio_fenix', $data);
     return $this->db->insert_id();
    }
    
    function busca_sucursal()
    {
        $nivel = $this->session->userdata('nivel');
        $busqueda = $this->input->post('busqueda');
        $is_logged_in = $this->session->userdata('is_logged_in');
        
        
        $ip_address = $this->session->userdata('ip_address');
        
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){
            $where = " and tipo = 'F'";
        }else{
            $where = null;
        }
        $sql = "select * from sucursales where (suc = ? OR nom_suc like '%$busqueda%') $where;";
        
        $query = $this->db->query($sql, $busqueda);
        
        $tabla = "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>Sucursal</th>
        <th>Telefono</th>
        <th>Extension</th>
        <th>Tel. Act</th>
        <th>Correo</th>
        <th>Accion</th>
        ";
        
        if($nivel == 25){
            
        $tabla.= "
        <th>Editar</th>
        ";
            }
        
        $tabla.= "
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
        $l= anchor('directorio/editar1/'.$row->suc, '<img src="'.base_url().'img/Edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar', 'class' => 'encabezado'));
            $tabla.= "
        <tr>
        <td>$row->suc</td>
        <td>$row->nom_suc</td>
        <td>$row->tel</td>
        <td>$row->tel1</td>
        <td>$row->tel_actual</td>
        <td>$row->correo</td>
        <td><a href=\"#\" onClick=\"busca($row->lat, $row->lon, '$row->nom_suc', $row->suc); return false;\">Ver en Mapa</a></td>
             ";

        if($nivel == 25){
            
        $tabla.= "
        <td align=\"right\">".$l."</td> 
        ";
            }
        
        $tabla.= "</tr>
        ";
        }
   
    $tabla.="</table>";
        return $tabla;
    }
    

    function busca_personal($id)
    {
        
        $busqueda = $this->input->post('busqueda');
        $is_logged_in = $this->session->userdata('is_logged_in');
            $ip_address = $this->session->userdata('ip_address');
            $nivel = $this->session->userdata('nivel');
            
            if($nivel == 2 || $nivel == 3 || $nivel == null || $nivel == 1 || $nivel == 10 || $nivel == 11 || $nivel == 15 || $nivel == 20 || $nivel == 25){
        
        $busqueda = $this->input->post('busqueda');
        $sql = "SELECT a.id, a.cel, a.extension, a.fijo, a.correo, a.id_user, b.completo, b.succ, c.nombre
                FROM desarrollo.equipos_comunicaciones a
                left join catalogo.cat_empleado b on a.id_user=b.id
                left join catalogo.sucursal c on c.suc=b.succ
                where a.tipo<>2 and a.activo=1 and b.completo like '%$busqueda%' OR c.nombre like '%$busqueda%'
                order by b.completo;";
        
        
        $query = $this->db->query($sql);
       
        
        $tabla = "
        <table>
        <thead>
        <tr>
        <th>Nombre</th>
        <th>Departamento o Zona</th>
        <th>Ext.</th>
        <th>Tel. Fijo</th>
        <th>Movil</th>
        <th>Correo</th>
        ";
        
        if($nivel == 25){
            
        $tabla.= "
        <th>Editar</th>
        ";
            }
        
        $tabla.= "
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
        $l= anchor('directorio/editar/'.$row->id, '<img src="'.base_url().'img/Edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar', 'class' => 'encabezado'));
            $tabla.= "
        <tbody>
        <tr>
        <td>".$row->completo."</td>
        <td>".$row->nombre."</td>
        <td>".$row->extension."</td>
        <td>".$row->fijo."</td>
        <td>".$row->cel."</td>
        <td>".$row->correo."</td>
        ";

        if($nivel == 25){
            
        $tabla.= "
        <td align=\"right\">".$l."</td> 
        ";
            }
        
        $tabla.= "</tr>
        ";
        }
   
    $tabla.="</table>";
        return $tabla;
    }
    }


    function detalle_sucursal()
    {
        $this->db->select('*');
        $this->db->from('sucursales');
        $this->db->where('suc', $this->input->post('suc'));
        $query = $this->db->get();
        
        $row = $query->row();
        
        $a = "
        <a id=\"fotota\" href=\"".base_url()."imagenes/suc/".$row->suc.".jpg\"><img alt=\"Sucursal\" src=\"".base_url()."imagenes/suc/".$row->suc.".jpg\" border=\"0\" width=\"100%\"/></a>
        <h4>$row->nom_suc</h4>
        $row->dom $row->num_ext $row->num_int<br />
        $row->col, $row->del_mun, $row->edo<br />
        $row->refen<br />
        Codigo postal $row->cp<br />
        Tel. $row->tel<br />
        Ext. $row->tel1<br /> 
        Iusacell: $row->tel_iu<br />
        <script language=\"javascript\" type=\"text/javascript\">
              $(\"a#fotota\").fancybox({
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});
            </script>
";
        
        return $a;
    }
    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    
    function direc_datos($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('equipos_comunicaciones');
    }

    function editar_personal($id, $extension, $celular, $fijo, $email)
    {
        $data = array(
           
           'extension' => $this->input->post('extension'),
           'fijo' => $this->input->post('fijo'),
           'cel' => $this->input->post('celular'),
           'correo' => $this->input->post('email'),
        );
        $this->db->where('id', $id);
        $this->db->update('equipos_comunicaciones', $data);
        return $this->db->affected_rows();
    }
    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    function direc_datos1($suc)
    {
        $this->db->where('suc', $suc);
        return $this->db->get('sucursales');
    }

    function editar_sucursal($suc, $extension, $celular, $fijo, $email)
    {
        $data = array(
           'tel1' => $this->input->post('extension'),
           'tel' => $this->input->post('fijo'),
           'tel_iu' => $this->input->post('celular'),
           'correo' => $this->input->post('email'),
           
        );
        
        $this->db->where('suc', $suc);
        $this->db->update('sucursales', $data);
        return $this->db->affected_rows(); 
    }
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    
}