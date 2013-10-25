<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Facturas_juridico extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->helper('download');
        
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
    $data['contenido'] = "facturas_juridico";
    $data['selector'] = "facturas_jur";
    $data['sidebar'] = "sidebar_juridico";
    $data_c['extraheader'] = "
        <script type=\"text/javascript\" src=\"".base_url()."scripts/jquery.dataTables.min.js\"></script>
        <link type=\"text/css\" href=\"".base_url()."css/demo_table.css\" rel=\"stylesheet\" />
    ";
    
    $this->load->view('header', $data_c);
    $this->load->view('main', $data);
    $this->load->view('extrafooter');
    }
    
    public function nueva()
    {
        $this->load->model('fac_juridico');
        $data['contenido'] = "nueva_factura";
        $data['selector'] = "facturas_jur";
        $data['sidebar'] = "sidebar_juridico";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function submit_nueva()
    {
        
        $this->load->model('fac_juridico');
        $id = $this->fac_juridico->guardar_nueva();
        redirect('facturas_juridico/index/'.$id);
    }
    
    public function depositos($id)
    {
        $this->load->model('fac_juridico');
        $data['contenido'] = "depositos";
        $data['selector'] = "facturas_jur";
        $data['sidebar'] = "sidebar_juridico";
        $data['id'] = $id;
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function submit_depositos()
    {
        
        $this->load->model('fac_juridico');
        $id = $this->fac_juridico->guardar_deposito();
        redirect('facturas_juridico/index/'.$id);
    }
    
    public function modificar($id)
    {
        $this->load->model('fac_juridico');
        $data['contenido'] = "modificar_juridico";
        $data['selector'] = "facturas_jur";
        $data['sidebar'] = "sidebar_juridico";
        $data['id']=$id;
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function submit_modificar()
    {
        
        $this->load->model('fac_juridico');
        $id = $this->fac_juridico->guardar_modifica();
        redirect('facturas_juridico/');
    }
    
    function imp_fact()
    {
        
        $this->load->model('fac_juridico');
        $data['cabeza'] = "cabeza";
        $data['detalle'] = "detalle";
        $this->load->view('impresiones/juridico', $data);
    }
    
      }