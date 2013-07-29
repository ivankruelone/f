<?php
class Sucursal extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
    }
    
    function busca_cp()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->db->select('*');
        $this->db->from('sucursales');
        $this->db->where('cp >=', $this->input->post('codigo'));
        $ip_address = $this->session->userdata('ip_address');
        
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){
            $this->db->where('tipo', 'F');
        }
        $this->db->order_by('cp', 'ASC');
        $this->db->limit(5);
        
        $query = $this->db->get();
        

        $this->db->select('*');
        $this->db->from('sucursales');
        $this->db->where('cp <', $this->input->post('codigo'));
        $ip_address = $this->session->userdata('ip_address');
        
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){
            $this->db->where('tipo', 'F');
        }
        $this->db->order_by('cp', 'ASC');
        $this->db->limit(5);
        
        $query2 = $this->db->get();


        $tabla = "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>Sucursal</th>
        <th>Direccion</th>
        <th>localidad</th>
        <th>Accion</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
            $tabla.= "
        <tr>
        <td>$row->suc</td>
        <td>$row->nom_suc</td>
        <td>$row->dom $row->num_ext $row->num_int</td>
        <td>$row->col $row->del_mun $row->edo</td>
        <td><a href=\"#\" onClick=\"busca($row->lat, $row->lon, '$row->nom_suc', $row->suc); return false;\">Ver en Mapa</a></td>
        </tr>
            ";
        }
        
        foreach($query2->result() as $row)
        {
            $tabla.= "
        <tr>
        <td>$row->suc</td>
        <td>$row->nom_suc</td>
        <td>$row->dom $row->num_ext $row->num_int</td>
        <td>$row->col $row->del_mun $row->edo</td>
        <td><a href=\"#\" onClick=\"busca($row->lat, $row->lon, '$row->nom_suc', $row->suc); return false;\">Ver en Mapa</a></td>
        </tr>
            ";
        }
        
        $tabla.= "</table>
        ";
        
        return $tabla;
    }
    
    function estados()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');

        $this->db->select('edo');
        $this->db->from('sucursales');
        $ip_address = $this->session->userdata('ip_address');
        
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){
            $this->db->where('tipo', 'F');
        }
        $this->db->group_by('edo');
        $this->db->order_by('edo');
        $query = $this->db->get();
        
        $a = array();
        
        $a[0] = "Selecciona un Estado";
        
        foreach($query->result() as $row)
        {
            $a[$row->edo] = $row->edo;
        }
        
        return $a;
    }
    
    function busca_municipios()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->db->select('del_mun');
        $this->db->from('sucursales');
        $this->db->where('edo', $this->input->post('edo'));
        $ip_address = $this->session->userdata('ip_address');
        
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){
            $this->db->where('tipo', 'F');
        }
        $this->db->group_by('del_mun');
        $this->db->order_by('del_mun');
        
        $query = $this->db->get();
        
        $a = "
        <option value=\"0\">Selecciona un Estado</option>";
        
        foreach($query->result() as $row)
        {
            $a.= "
            <option value=\"$row->del_mun\">$row->del_mun</option>";
            
        }
        
        return $a;
        
    }

    function busca_edo_municipio()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->db->select('*');
        $this->db->from('sucursales');
        $this->db->where('edo', $this->input->post('edo'));
        $this->db->where('del_mun', $this->input->post('municipio'));
        $ip_address = $this->session->userdata('ip_address');
        
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){
            $this->db->where('tipo', 'F');
        }
        $this->db->order_by('suc');
        
        $query = $this->db->get();
        
        $tabla = "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>Sucursal</th>
        <th>Direccion</th>
        <th>localidad</th>
        <th>Accion</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
            $tabla.= "
        <tr>
        <td>$row->suc</td>
        <td>$row->nom_suc</td>
        <td>$row->dom $row->num_ext $row->num_int</td>
        <td>$row->col $row->del_mun $row->edo</td>
        <td><a href=\"#\" onClick=\"busca($row->lat, $row->lon, '$row->nom_suc', $row->suc); return false;\">Ver en Mapa</a></td>
        </tr>
            ";
        }

        $tabla.= "</table>
        ";
        
        return $tabla;
    }
    
    function busca_sucursal()
    {
        $busqueda = $this->input->post('busqueda');
        $is_logged_in = $this->session->userdata('is_logged_in');
        
        
        $ip_address = $this->session->userdata('ip_address');
        
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){
            $where = " and tipo = 'F'";
        }else{
            $where = null;
        }
        
        $sql = "select * from catalogo.sucursal where (suc = ? OR nombre like '%$busqueda%') $where;";
        
        $query = $this->db->query($sql, $busqueda);
        
        $tabla = "
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>Sucursal</th>
        <th>Direccion</th>
        <th>C.P.</th>
        <th>localidad</th>
        <th>Accion</th>
        ";
        
        
        $tabla.= "
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
            $tabla.= "
        <tr>
        <td>$row->suc</td>
        <td>$row->nombre</td>
        <td>$row->dire</td>
        <td>$row->cp</td>
        <td>$row->col $row->pobla</td>
        <td><a href=\"#\" onClick=\"busca($row->lat, $row->lon, '$row->nombre', $row->suc); return false;\">Ver en Mapa</a></td>
        ";

        
        $tabla.="
        </tr>
            ";
        }

        $tabla.= "</table> 
        ";
        
        return $tabla;
    }
    
    function reporte_sucur_encabezado1()
    {
        $tabla = "
        <table>        
        <tr>
        <td align=\"center\"> <img style=\"position:relative; width:60px;\", src=\"'.base_url().'../../imagenes/logo.png\" />  FARMACIAS EL FENIX DEL CENTRO S.A. DE C.V.</td>
        </tr>
        
        <tr>
       <td align=\"center\">SOPORTE T&Eacute;CNICO</td>
       </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_sucur($suc, $atencion)
    {
        
        $s="
        SELECT * FROM catalogo.sucursal
        where suc=$suc";
        
        $q = $this->db->query($s);
       
        
        //echo $this->db->last_query();
        //die ();
          
        foreach($q->result() as $row)
         {
    
         $s1 = "SELECT a.completo, b.nombre FROM catalogo.cat_empleado a
                left join catalogo.sucursal b on a.succ=b.suc 
                where a.nomina=?
        ";
       
       $q1 = $this->db->query($s1, $this->session->userdata('nomina'));
       
       //echo $this->db->last_query();
       //die ();
       
       $r1 = $q1->row();  
         
       }
       
       $tabla = "
        
       <table border=\"0\" >
       
       <tbody>
       
       
       <tr>
       <td colspan=\"2\" align=\"center\" style=\"font-size:+35;\">Sucursal:  <b>".$row->nombre."(".$row->suc.")</b></td>
       </tr>
       
       <tr>
       <td colspan=\"2\" align=\"center\" style=\"font-size:+20;\">Direcci&oacute;n: <b>".$row->dire."</b><br /><br /></td>
       </tr>
       
       <tr>
       <td align=\"center\" style=\"font-size:+20;\">Colonia: <b>".$row->col."</b><br /><br /></td>
       <td align=\"center\" style=\"font-size:+20;\">Codigo Postal: <b>".$row->cp."</b></td>
       </tr>
       
       <tr>
       <td colspan=\"2\" align=\"center\" style=\"font-size:+20;\"> <b>".$row->pobla."</b><br /></td>
       </tr>
       
       <tr>
       <td colspan=\"2\" align=\"center\" style=\"font-size:+20;\">Tecnico: <b>".$r1->completo."</b></td>
       </tr>
       
       <tr>
       <td colspan=\"2\" align=\"center\" style=\"font-size:+20;\">Departamento de: <b>".$r1->nombre."</b><br /></td>
       </tr>
       
       <tr>
       <td colspan=\"2\" align=\"center\" style=\"font-size:+20;\">Con atenci&oacute;n para el: <b>".$atencion."</b><br /></td>
       </tr>
       
       <tr>
        <td colspan=\"2\" align=\"center\"> <img style=\"position:relative; width:200px;\", src=\"'.base_url().'../../imagenes/fragil.png\" /></td>
        </tr>
        
       <tr>
       <td colspan=\"2\" align=\"center\" style=\"font-size:+30;\"><b>CUIDADO FR&Aacute;GIL</b> <br /></td>
       </tr>
       
       <tr>
       <td colspan=\"2\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:i:s')."</td>
       </tr>
      
        </tbody>
       
        </table>";
        
        return $tabla;
        
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
        Tel. $row->tel, $row->tel1, $row->tel_iu<br />
        $row->correo<br />
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
    
    function sucursal_datos($suc)
    {
        $this->db->where('suc', $suc);
        return $this->db->get('sucursales');
    }

    function con_atencion()
    {
        
        $sql = "SELECT * FROM con_atencion";
        $query = $this->db->query($sql);
        
        $atencion = array();
        $atencion[0] = "Seleccionar para quien";
        
        foreach($query->result() as $row){
            $atencion[$row->atencion] = $row->atencion;
        }
        
        return $atencion;  

    }
    
    function sel_sucursal()
    {
        
        $sql = "SELECT * FROM catalogo.sucursal where tlid<>4 and suc>100 and suc<1605";
        $query = $this->db->query($sql);
        
        $sucursal = array();
        $sucursal[0] = "Selecciona una sucursal";
        
        foreach($query->result() as $row){
            $sucursal[$row->suc] = $row->suc." - ".$row->nombre;
        }
        
        return $sucursal;  

    }
}
