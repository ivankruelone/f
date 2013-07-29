<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Credencial extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
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
        $data['selector'] = "credencial";
        $data['sidebar'] = "sidebar_credencial";
        $data['contenido'] = "blanco";
        
 
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter'); 
    
    }
    public function captura_datos_credencial()
    {
        $data['titulo'] = "Impresion de credenciales de empleados que ya estan dados de alta en el 400";
        $data['selector'] = "credencial";
        $data['sidebar'] = "sidebar_credencial";
        $data['contenido'] = "form_credencial";
        $this->load->model('credencial_model');
        $data['empleadox'] = $this->credencial_model->busca_empleado();
        
 
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function formato_credencial()
    {
        $empleadox = $this->input->post('nombre');
        
        $this->load->model('credencial_model');
        $data['detalle'] = $this->credencial_model->formato_credencial($empleadox);
        //echo $data['detalle'];
        
        $this->load->view('impresiones/credencial', $data);
    }


    public function captura_datos_credencial1()
    {
        $data['titulo'] = "Impresion de credenciales de empleados que no estan dados de alta en el 400";
        $data['selector'] = "credencial";
        $data['sidebar'] = "sidebar_credencial";
        $data['contenido'] = "form_credencial1";
        $this->load->model('credencial_model');
        $data['empleadox'] = $this->credencial_model->busca_empleado1();
        
 
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function formato_credencial1()
    {
        $empleadox = $this->input->post('nombre');
        
        $this->load->model('credencial_model');
        $data['detalle'] = $this->credencial_model->formato_credencial1($empleadox);
        //echo $data['detalle'];
        
        $this->load->view('impresiones/credencial', $data);
    }    
}