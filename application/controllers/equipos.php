<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Equipos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        
        
    }

    public function esta_logeado()
    {
        $logeado = $this->session->userdata('is_logged_in');
        if($logeado == null){
            redirect('welcome');
        }
    }
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
    public function index($id =null)
    {
        
        
        $this->load->model('equipos_model');
       
        $data['tabla']= $this->equipos_model->equipos_validar();;
        $data['contenido'] = "equipos1";
        $data['selector'] = "equipos";
        $data['sidebar'] = "sidebar_equipos";
        $data['id'] = $id;
        
        
        $data_head['extraheader'] = "
        <script type=\"text/javascript\" src=\"".base_url()."fancybox/jquery.fancybox-1.3.4.pack.js\"></script>
    	<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."fancybox/jquery.fancybox-1.3.4.css\" media=\"screen\" />
        ";
              
        $this->load->view('header', $data_head); 
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
    public function tabla_activos($id = null)
    {
        $data['titulo']= 'RELACION DE EQUIPOS ENTREGADOS';
        $this->load->model('catalogo_model');
        $this->load->model('equipos_model');
        $data['tabla']= $this->equipos_model->equipos_activos();
        $data['contenido'] = "equipos";
        $data['selector'] = "equipos";
        $data['sidebar'] = "sidebar_equipos";
        $data['id'] = $id;
        
        $data_head['extraheader'] = "
        <script type=\"text/javascript\" src=\"".base_url()."fancybox/jquery.fancybox-1.3.4.pack.js\"></script>
    	<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."fancybox/jquery.fancybox-1.3.4.css\" media=\"screen\" />
        ";
              
        $this->load->view('header', $data_head);
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
    public function tabla_bajas()
    {
        $data['titulo']= 'DEBERA CANCELAR EL SERVICIO Y SOLICITAR EL EQUIPO';
        $this->load->model('catalogo_model');
        $this->load->model('equipos_model');
        $data['tabla']= $this->equipos_model->equipos_bajas();
        $data['contenido'] = "equipos";
        $data['selector'] = "equipos";
        $data['sidebar'] = "sidebar_equipos";
              
        $this->load->view('header'); 
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
  public function movimiento_observa($id)
    {
        $data['id']=$id;
        $data['mensaje']= '';
        $data['titulo']= 'EQUIPO PARA DAR DE BAJA';
        $data['titulo1']= '';
        $this->load->model('equipos_model');
        $data['obserx']=$this->equipos_model->busca_observa();
        $this->load->model('equipos_model');
        $data['tabla']= $this->equipos_model->datos_equipo($id);
        $data['contenido'] = "form_equipo";
        $data['selector'] = "equipos";
        $data['sidebar'] = "sidebar_equipos";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
public function validar_equipo()
    {
     $id=$this->input->post('id');
     $obser=$this->input->post('obser');
     $this->load->model('equipos_model');
     $this->equipos_model->valida_equipo_obser($id,$obser);
     redirect('equipos/tabla_bajas/');
    }

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

    
    public function nuevo_equipo()
    {
        $this->load->model('equipos_model');
        $data['contenido'] = "equipos2";
        $data['selector'] = "equipos";
        $data['sidebar'] = "sidebar_blanco";
        $data['equipo'] = $this->equipos_model->busca_tipo();
        $data['empleado'] = $this->equipos_model->busca_empleado();
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function submit_nuevo_equipo()
    {
        
        $this->load->model('equipos_model');
        $id = $this->equipos_model->guardar_equipo();
        redirect('equipos/index/'.$id);
    }


////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
   
    function editar1($id)
    {
        $this->load->model('equipos_model');
        $data['empleado'] = $this->equipos_model->busca_empleado();
        $data['contenido'] = "editar1";
        $data['selector'] = "equipos";
        $data['sidebar'] = "sidebar_blanco";
        $data['id'] = $id;
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function submit()
    {
        $id_user= $this->input->post('empleado');
        $id= $this->input->post('id');
        $this->load->model('equipos_model');
        $id=$this->equipos_model->editar_equipo($id, $id_user);
        //echo '<p class="message-box ok">Sus cambios se guardaron con exito</p>';
        redirect('equipos/tabla_activos/'.$id);
        //$this->load->view('contenido/mensaje_exito');
       
    }
    
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
    function validar()
    {
        
        $this->load->model('equipos_model');
        $id=$this->equipos_model->validar_equipo($id);
        redirect('equipos/tabla_activos/'.$id);
        
       
    }
    
    public function eliminar($id)
    {
        $this->load->model('equipos_model');
        $this->equipos_model->personal_eliminar($id);
        redirect('equipos/index/');
    }

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

function imprimir($id)
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
          
          
          $data['cabeza']='';
          
            
            $data['cabeza'].= "
            
           <img src=\"'.base_url().'../../imagenes/logo1.png\" /><br /><br />
           <h1 align=\"center\"><strong>RESPONSIVA</strong></h1>
           <hr><br />
           
           
           
            ";
            $data['id']=$id;
            $this->load->view('impresiones/responsiva', $data);
            
		}

///////////////////////////////////////////////////////////////////////
    
        public function nuevo_vehiculo()
        {
        $this->load->model('equipos_model');
        $data['contenido'] = "vehiculo";
        $data['selector'] = "vehiculo";
        $data['sidebar'] = "sidebar_vehiculo";
        $data['empleado'] = $this->equipos_model->busca_empleado1();
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        }
    
       function submit_nuevo_vehiculo()
         {
        
        $this->load->model('equipos_model');
        $id = $this->equipos_model->captura_vehiculo();
        redirect('equipos/muestra_vehiculo/'.$id);
          }   
          
        public function muestra_vehiculo($id =null)
    {
        
        
        $this->load->model('equipos_model');
       
        $data['tabla']= $this->equipos_model->vehiculo_validar();
        $data['contenido'] = "vehiculo1";
        $data['selector'] = "equipos";
        $data['sidebar'] = "sidebar_vehiculo";
        $data['id'] = $id;
        
        
        $data_head['extraheader'] = "
        <script type=\"text/javascript\" src=\"".base_url()."fancybox/jquery.fancybox-1.3.4.pack.js\"></script>
    	<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."fancybox/jquery.fancybox-1.3.4.css\" media=\"screen\" />
        ";
              
        $this->load->view('header', $data_head); 
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }    
    
    public function eliminar_vehiculo($id)
    {
        $this->load->model('equipos_model');
        $this->equipos_model->vehiculo_eliminar($id);
        redirect('equipos/muestra_vehiculo/');
    }
    
   public function validar_vehiculo($id)
    {
        $this->load->model('equipos_model');
        $this->equipos_model->validar_vehiculo($id);
        redirect('equipos/muestra_vehiculo/');
    }
    
    public function vehiculos_activos($id =null)
    {
        
        
        $this->load->model('equipos_model');
       
        $data['tabla']= $this->equipos_model->activos_vehiculos();
        $data['contenido'] = "vehiculo1";
        $data['selector'] = "equipos";
        $data['sidebar'] = "sidebar_vehiculo";
        $data['id'] = $id;
        
        
        $data_head['extraheader'] = "
        <script type=\"text/javascript\" src=\"".base_url()."fancybox/jquery.fancybox-1.3.4.pack.js\"></script>
    	<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."fancybox/jquery.fancybox-1.3.4.css\" media=\"screen\" />
        ";
              
        $this->load->view('header', $data_head); 
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }   
    
    public function vehiculos_baja($id =null)
    {
        
        
        $this->load->model('equipos_model');
       
        $data['tabla']= $this->equipos_model->baja_vehiculos();
        $data['contenido'] = "vehiculo1";
        $data['selector'] = "equipos";
        $data['sidebar'] = "sidebar_vehiculo";
        $data['id'] = $id;
        
        
        $data_head['extraheader'] = "
        <script type=\"text/javascript\" src=\"".base_url()."fancybox/jquery.fancybox-1.3.4.pack.js\"></script>
    	<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."fancybox/jquery.fancybox-1.3.4.css\" media=\"screen\" />
        ";
              
        $this->load->view('header', $data_head); 
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }     
    
    function acuse_vehiculo($id)
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
          
          
          $data['cabeza']='';
          
            
            $data['cabeza'].= "
            
           <img src=\"'.base_url().'../../imagenes/logo1.png\" />
           <h6 align=\"left\">Lago Trasimeno 36 </h6>
           <h6 align=\"left\">Col. Anahuac, M&eacute;xico, D.F.</h6>
           <h6 align=\"left\">C.P. 11320 TEL.:91 400 700</h6>
           
           
           
            ";
            $data['id']=$id;
            $this->load->view('impresiones/responsiva_vehiculo', $data);
            
		}
        
        function relacion_vehiculos(){
            $data['cabeza']='';
          
            
            $data['cabeza'].= "
            
           <img src=\"'.base_url().'../../imagenes/logo1.png\" />
           ";
            
            $this->load->view('impresiones/relacion_vehiculos', $data);
            
        }
    
}