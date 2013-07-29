<?php
class Prenomina_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        
    }
    
    function quincena()
    {
       
        $this->db->select('quincena');
        $this->db->from('quincena');
        $query = $this->db->get();
       
        $a = null;
        
        $a[0] = "Quincena";
        
        foreach($query->result() as $row)
        {
            $a[$row->quincena] = $row->quincena;
        }
        
        return $a;
    }
    

    function ano()
    {
       
        $this->db->select('ano');
        $this->db->from('ano');
        $this->db->where('activo', '1');
        $this->db->group_by('ano');
        $this->db->order_by('id');
        $query = $this->db->get();
       
        $a = null;
        
        $a[0] = "Selecciona un a&ntilde;o";
        
        foreach($query->result() as $row)
        {
            $a[$row->ano] = $row->ano;
        }
        
        return $a;
    }

    function empleados()
    {
        $this->db->select('*');
        $this->db->from('empleados e');
        $this->db->where('cia', $this->session->userdata('cia'));
        $this->db->where('plaza', $this->session->userdata('plaza'));
        $query = $this->db->get();
        
        $enlaces = "<div align=\"right\">";
        $enlaces.= anchor('prenomina/nuevo_empleado', 'Agrega Nuevo Empleado');
        $enlaces.= " | ";
        $enlaces.= anchor('prenomina/busca_empleado', 'Busca Empleado');
        $enlaces.= "</div>";
        
        $tabla = "
        <table>
        <thead>
        <tr>
        <th>Clave Empleado</th>
        <th>Nombre</th>
        <th>A. Paterno</th>
        <th>A. Materno</th>
        <th>NSS</th>
        <th>RFC</th>
        <th>Salario</th>
        <th>Ingreso</th>
        <th>Editar</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
            $tabla.= "
        <tr>
        <td>$row->clave_empleado</td>
        <td>$row->nombre</td>
        <td>$row->apellido_pat</td>
        <td>$row->apellido_mat</td>
        <td>$row->no_ss</td>
        <td>$row->rfc</td>
        <td>$row->salario</td>
        <td>$row->fecha_ingreso</td>
        <td>".anchor('prenomina/editar/'.$row->id, 'Editar', 'rel="prettyPopin"')."</td>
        </tr>
            ";
        }
        
        $tabla.= "</table>
        <script type=\"text/javascript\" charset=\"utf-8\"> 
			$(\"a[rel^='prettyPopin']\").prettyPopin({
				callback : function(){	
				}
			});
		</script> 
        ";
        
        return $enlaces.$tabla;
        
    }
    
    function guardar_empleado()
    {
        $data = array(
           'apellido_pat' => $this->input->post('a_paterno'),
           'apellido_mat' => $this->input->post('a_materno'),
           'nombre' => $this->input->post('nombre'),
           'clave_empleado' => $this->input->post('clave'),
           'no_ss' => $this->input->post('nss'),
           'rfc' => $this->input->post('rfc'),
           'salario' => $this->input->post('salario'),
           'fecha_ingreso' => $this->input->post('fecha'),
           'cia'    => $this->session->userdata('cia'),
           'plaza'  => $this->session->userdata('plaza')
           
        );
      
     $this->db->insert('empleados', $data);
     return $this->db->insert_id();
     
     
    }
    
    function busca_personal()
    {

        $busqueda = $this->input->post('busqueda');
        $sql = "select * from empleados where nombre like '%$busqueda%' OR apellido_pat like '%$busqueda%' OR apellido_mat like '%$busqueda%' OR clave_empleado like '%$busqueda%' OR no_ss like '%$busqueda%';";
        $query = $this->db->query($sql);
      
        
        
        $tabla = "
        <table>
        <thead>
        <tr>
        <th>Clave Empleado</th>
        <th>Nombre</th>
        <th>A. Paterno</th>
        <th>A. Materno</th>
        <th>NSS</th>
        <th>RFC</th>
        <th>Salario</th>
        <th>Ingreso</th>
        <th>Editar</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
            $tabla.= "
        <tr>
        <td>$row->clave_empleado</td>
        <td>$row->nombre</td>
        <td>$row->apellido_pat</td>
        <td>$row->apellido_mat</td>
        <td>$row->no_ss</td>
        <td>$row->rfc</td>
        <td>$row->salario</td>
        <td>$row->fecha_ingreso</td>
         <td>".anchor('prenomina/editar/'.$row->id, 'Editar', 'rel="prettyPopin"')."</td>
        </tr>
            ";
        }

        
        $tabla.= "</table>
        <script type=\"text/javascript\" charset=\"utf-8\"> 
			$(\"a[rel^='prettyPopin']\").prettyPopin({
				callback : function(){	
				}
			});
		</script> 
        ";
        
        return $tabla;
        
    }
    
    function empleado_datos($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('empleados');
    }
    
    function editar_empleados($id)
    {
        $data = array(
           'apellido_pat' => $this->input->post('paterno'),
           'apellido_mat' => $this->input->post('materno'),
           'nombre' => $this->input->post('nombre'),
           'clave_empleado' => $this->input->post('clave'),
           'no_ss' => $this->input->post('nss'),
           'rfc' => $this->input->post('rfc'),
           'salario' => $this->input->post('salario'),
           'fecha_ingreso' => $this->input->post('fecha'),
        );
        
        $this->db->where('id', $id);
        $this->db->update('empleados', $data);
          
    }
    
    function guardar_periodo()
    {
        $data = array(
           'quincena' => $this->input->post('quincena'),
           'mes' => $this->input->post('mes'),
           'ano' => $this->input->post('ano'),
           'cia'    => $this->session->userdata('cia'),
           'plaza'  => $this->session->userdata('plaza')
           
        );
      
     $this->db->insert('prenomina_c', $data);
     return $this->db->insert_id();
     
     
    }
    
    function mostrar_periodo()
    {
        
        $this->db->select('*');
        $this->db->from('prenomina_c');
        $this->db->order_by('creado', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get();
        
        $tabla ="<table>
        <thead>
        <tr>
        <th>ID</th>
        <th>Cia</th>
        <th>Plaza</th>
        <th>Quincena</th>
        <th>Mes</th>
        <th>A&ntilde;o</th>
        <th>Editar</th>
        <th>Agregar Datos</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
            $tabla.= "
        <tr>
        <td>$row->id</td>
        <td>$row->cia</td>
        <td>$row->plaza</td>
        <td>$row->quincena</td>
        <td>$row->mes</td>
        <td>$row->ano</td>
        <td>".anchor('prenomina/editar1/'.$row->id, 'Editar', 'rel="prettyPopin"')."</td>
        <td align=\"center\">".anchor('prenomina/captura/'.$row->id, 'Captura')."</td>
        </tr>
            ";
        }

        
        $tabla.= "</table>
        <script type=\"text/javascript\" charset=\"utf-8\"> 
			$(\"a[rel^='prettyPopin']\").prettyPopin({
				callback : function(){	
				}
			});
		</script> 
        ";
        
        return $tabla;
    }
    
    function datos_periodo($id)
    {
        $this->db->select('p.*, m.mes as mes_nombre');
        $this->db->join('mes m', 'm.id = p.mes', 'LEFT');
        $this->db->where('p.id', $id);
        return $this->db->get('prenomina_c p');
    }
    
    function tabla_datos_periodo($id)
    {
        $query = $this->datos_periodo($id);
        
        $tabla = "
        <table>
        <thead>
        <tr>
        <th>Id.</th>
        <th>Quincena</th>
        <th>Mes</th>
        <th>A&ntilde;o</th>
        <th>Creada</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $row = $query->row();
        
            $tabla.= "
            <tr>
            <td>$row->id</td>
            <td>$row->quincena</td>
            <td>$row->mes_nombre</td>
            <td>$row->ano</td>
            <td>$row->creado</td>
            </tr>
            ";
            
            $tabla.= "
            </tbody>
            </table>
            ";
            
            return $tabla;
        
    }
    
        
    function editar_periodo($id)
    {
        $data = array(
           'quincena' => $this->input->post('quincena'),
           'mes' => $this->input->post('mes'),
           'ano' => $this->input->post('ano'),
        );
        
        $this->db->where('id', $id);
        $this->db->update('prenomina_c', $data);
          
    }
    
    function nomina($q)
    {
        $sql = "SELECT id, apellido_pat, apellido_mat, nombre, clave_empleado FROM empleados a where clave_empleado like '%$q%' or nombre like '%$q%';";
        
        $a = null;
        
        
        $q = $this->db->query($sql);
        
        foreach($q->result() as $row)
        {
            $a.= "$row->clave_empleado|$row->clave_empleado - $row->nombre $row->apellido_pat $row->apellido_mat\n";
        }
        
        return $a;
    }
    
    function cuenta()
    {
       
        $this->db->select('no_cuenta, des_cuenta');
        $this->db->from('cuenta');
        $query = $this->db->get();
       
        $a = null;
        
        $a[0] = "Selecciona una opci&oacute;n";
        
        foreach($query->result() as $row)
        {
            $a[$row->no_cuenta] = $row->des_cuenta;
        }
        
        return $a;
    }
    
    function guardar_prenomina()
    {
        //id, c_id, empleado, cuenta, dato, total, fecha
        $data = array(
            'c_id' => $this->input->post('id'),
            'empleado' => $this->input->post('nomina'),
            'cuenta' => $this->input->post('cuenta'),
            'dato' => $this->input->post('dato'),
            'total' => $this->input->post('total')
        );
        
        $this->db->insert('prenomina_d', $data);
        
        return $this->input->post('id');
    }
    
    function mostrar_prenomina($id)
    {
        
        $this->db->select('d.*, e.nombre, e.apellido_pat, e.apellido_mat, c.des_cuenta');
        $this->db->from('prenomina_d d');
        $this->db->join('empleados e', 'd.empleado = e.clave_empleado', 'LEFT');
        $this->db->join('cuenta c', 'd.cuenta = c.no_cuenta', 'LEFT');
        $this->db->order_by('fecha', 'DESC');
        $query = $this->db->get();
        
        $tabla ="<table>
        <thead>
        <tr>
        <th>ID</th>
        <th># Emp.</th>
        <th>Empleado</th>
        <th># Cta.</th>
        <th>Cuenta</th>
        <th>Subtotal</th>
        <th>Total</th>
        <th>Editar</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
            $tabla.= "
        <tr>
        <td>$row->id</td>
        <td>$row->empleado</td>
        <td>$row->nombre $row->apellido_pat $row->apellido_mat</td>
        <td>$row->cuenta</td>
        <td>$row->des_cuenta</td>
        <td>$row->dato</td>
        <td>$row->total</td>
        <td>".anchor('prenomina/prenomina_eliminar/'.$row->id, 'Eliminar')."</td>
        </tr>
            ";
        }

        
        $tabla.= "</table>
        ";
        
        return $tabla;
    }
    
    function prenomina_eliminar($id)
    {
        $this->db->delete('prenomina_d',  array('id' => $id));
    }

    
}

