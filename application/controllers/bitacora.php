<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bitacora extends CI_Controller
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
        $this->load->model('bitacora_model');
    }

    public function index()
    {
        $data['titulo'] = "BITACORA";
        $data['contenido'] = "bitacora";
        $data['selector'] = "bitacora";
        $data['sidebar'] = "sidebar_blanco";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    public function gerente_supervisor()
    {
        $data['titulo'] = "BITACORA";
        $data['contenido'] = "bitacora_gerente_supervisor";
        $data['selector'] = "bitacora";
        $data['sidebar'] = "sidebar_blanco";
        $supervisor = $this->input->post('supervisor');
        $data['supervisor'] = $supervisor;

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

    public function agregar_evento($fecha)
    {
        $data['titulo'] = "AGREGAR EVENTO A BITACORA";
        $data['contenido'] = "bitacora_agregar";
        $data['selector'] = "bitacora";
        $data['sidebar'] = "sidebar_blanco";
        
        $fecha1 = explode('GMT', $fecha);
        $data['fecha'] = trim($fecha1[0]);
        $data['suc'] = $this->bitacora_model->sucursales();
        $data['asuntos'] = $this->bitacora_model->asuntos();
 
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    public function modificar_evento($id)
    {
        $data['titulo'] = "AGREGAR EVENTO A BITACORA";
        $data['contenido'] = "bitacora_modificar";
        $data['selector'] = "bitacora";
        $data['sidebar'] = "sidebar_blanco";
        
        $data['row'] = $this->bitacora_model->ver_evento($id);
        $data['suc'] = $this->bitacora_model->sucursales();
        $data['asuntos'] = $this->bitacora_model->asuntos();
 
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

    function submit_agregar(){
        echo $this->bitacora_model->agregar_evento();
    }
    
    function submit_modificar(){
        echo $this->bitacora_model->modificar_evento();
    }

    function eventos()
    {
        echo $this->bitacora_model->eventos();
    }
    
    function eventos_gerente_supervisor($supervisor)
    {
        echo $this->bitacora_model->eventos_gerente_supervisor($supervisor);
    }

    function evento($id)
    {
        $data['titulo'] = "AGREGAR EVENTO A BITACORA";
        $data['contenido'] = "bitacora_ver_evento";
        $data['selector'] = "bitacora";
        $data['sidebar'] = "sidebar_blanco";
        
        $data['row'] = $this->bitacora_model->ver_evento($id);
 
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function evento_dialogo($id)
    {
        $data['row'] = $this->bitacora_model->ver_evento($id);
        $this->load->view('contenidos/bitacora_ver_evento', $data);
 
    }
    
    
    function recarga()
    {
        $this->load->model('cortes_model');
        echo $this->cortes_model->taprueba('133', '2012-07-07');
    }

    
    
}
