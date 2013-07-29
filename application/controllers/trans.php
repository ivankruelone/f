<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->helper('download');
        
    }

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
       
    public function esta_logeado()
    {
        $logeado = $this->session->userdata('is_logged_in');
        if($logeado == null){
            redirect('welcome');
        }
    }

    public function index()
    {
        $this->load->model('trans_model');
        $data['contenido'] = "tabla_trans";
        $data['selector'] = "trans";
        $data['sidebar'] = "sidebar_blanco";
        $data['tabla'] = $this->trans_model->tipo_tabla();
        
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    public function form_trans()
    {
        $this->load->model('trans_model');
        $data['titulo']= 'CAPTURA DE GASTOS DE TRANSPORTE O PERSONAL';
        $data['contenido'] = "formulario_trans";
        $data['selector'] = "trans";
        $data['sidebar'] = "sidebar_blanco";
        $data['tipo'] = $this->trans_model->tipo();
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
//////////////////////////////////////////////
//////////////////////////////////////////////
function agrega_datos()
	{

    $tipo= $this->input->post('tipo');
    $fec1= $this->input->post('fec1');
    $obser= $this->input->post('obser');
    
   
	$this->load->model('trans_model');
    $this->trans_model->agrega_tipo_gasto($obser,$fec1,$tipo);
    redirect('trans/index');
    
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia

    
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      
      }