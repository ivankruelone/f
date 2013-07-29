<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Prenomina extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->helper('form');
        
    }

    public function esta_logeado()
    {
        $logeado = $this->session->userdata('is_logged_in');
        if($logeado == null){
            redirect('welcome');
        }
    }

    public function index()
    {
        $dia=date('d');
        
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_mes_t(date('m'));
        $row=$query->row();
        $data['mes']=$row->mes;
        if($dia<=15){$data['quincena']=$row->una;}else{$data['quincena']=$row->dos;}
        $data['aaa']=date('Y');
        $this->load->model('prenomina_model');
        $data['contenido'] = "prenomina_form_1";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";
        $data['mostrar_periodo'] = $this->prenomina_model->mostrar_periodo();
        $this->load->helper('string');
        
        $data_head['extraheader'] = "
        <script type=\"text/javascript\" src=\"".base_url()."scripts/jquery.prettyPopin.js\"></script>
    	<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."css/prettyPopin.css\" media=\"screen\" />
        ";
       
        
        $this->load->view('header', $data_head);
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    public function submit_periodo()
    {
        $this->load->model('prenomina_model');
        $this->prenomina_model->guardar_periodo();
        redirect('prenomina');
    }
    
    public function captura($id)
    {
        $this->load->model('prenomina_model');
        $data['contenido'] = "prenomina_captura";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";
        
        $data['datos_periodo'] = $this->prenomina_model->tabla_datos_periodo($id);
        $data['datos_prenomina'] = $this->prenomina_model->mostrar_prenomina($id);
        $data['id'] = $id;
        $data['cuenta'] = $this->prenomina_model->cuenta();
        
        $data_head['extraheader'] = "
<link type=\"text/css\" href=\"".base_url()."css/jquery.autocomplete.css\" rel=\"stylesheet\" />
<script type=\"text/javascript\" src=\"".base_url()."scripts/jquery.autocomplete.pack.js\"></script> 
        ";
        
        $this->load->view('header', $data_head);
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

	function nomina()
	{
	   /**
	    * Autocempletar prenomina en formulario captura
	    */
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		$q =  $this->input->get_post('q', TRUE);
		$this->load->model('prenomina_model');
		echo $this->prenomina_model->nomina($q);
	}
    
    public function submit_prenomina_captura()
    {
        $this->load->model('prenomina_model');
        $id = $this->prenomina_model->guardar_prenomina();
        redirect('prenomina/captura/'.$id);
    }
    
    public function prenomina_eliminar($id)
    {
        $this->load->model('prenomina_model');
        $this->prenomina_model->prenomina_eliminar($id);
        redirect('prenomina/captura/'.$id);
    }

    public function empleados($id = null)
    {
        $this->load->model('prenomina_model');
        $data['contenido'] = "catalogo_empleados";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";
        $data['empleados'] = $this->prenomina_model->empleados();
        $data['id'] = $id;
        
        $data_head['extraheader'] = "
        <script type=\"text/javascript\" src=\"".base_url()."scripts/jquery.prettyPopin.js\"></script>
    	<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."css/prettyPopin.css\" media=\"screen\" />
        ";


        $this->load->view('header', $data_head);
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    public function nuevo_empleado()
    {
        $this->load->model('prenomina_model');
        $data['contenido'] = "nuevo_empleado";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";


        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    public function busca_empleado()
    {
        $this->load->model('prenomina_model');
        $data['contenido'] = "busca_empleado";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";
        
        $data_head['extraheader'] = "
        <script type=\"text/javascript\" src=\"".base_url()."scripts/jquery.prettyPopin.js\"></script>
    	<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."css/prettyPopin.css\" media=\"screen\" />
        ";
        
        $this->load->view('header', $data_head);
        $this->load->view('main', $data);
        $this->load->view('extrafooter');

    }
    
    public function empleado()
    {
        $this->load->model('prenomina_model');
        echo $this->prenomina_model->busca_personal();
    }
    
    
    function submit_nuevo_empleado()
    {
        
        $this->load->model('prenomina_model');
        $id = $this->prenomina_model->guardar_empleado();
        redirect('prenomina/empleados/'.$id);
    }
    
    function editar($id)
    {
        $this->load->model('prenomina_model');
        $data['query'] = $this->prenomina_model->empleado_datos($id);
        $this->load->view('prenom/editar', $data);
    }
    
    function submit()
    {
        $id= $this->input->post('id');
        $this->load->model('prenomina_model');
        $this->prenomina_model->editar_empleados($id);
        echo '
    <link rel="stylesheet" type="text/css" href="'.base_url().'css/style.css" title="style" />

    <p class="message-box ok">Sus cambios se guardaron con exito</p>
    ';

    }

    function editar1($id)
    {
        $this->load->model('prenomina_model');
        $data['query'] = $this->prenomina_model->datos_periodo($id);
        $this->load->view('prenom/editar_periodo', $data);
    }

    function guardar_periodo()
    {
        $id= $this->input->post('id');
        $this->load->model('prenomina_model');
        $this->prenomina_model->editar_periodo($id);
        echo '
    <link rel="stylesheet" type="text/css" href="'.base_url().'css/style.css" title="style" />

    <p class="message-box ok">Sus cambios se guardaron con exito</p>
    ';

    }
    
    

}