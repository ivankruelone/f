<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Callcenter extends CI_Controller
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

    public function index()
    {
    $data['contenido'] = "pedidos_callcenter";
    $data['selector'] = "welcome";
    $data['sidebar'] = "sidebar";
    
    $this->load->view('header');
    $this->load->view('main', $data);
    $this->load->view('extrafooter');
    }
    
    public function detalle($id)
    {
    $data['contenido'] = "pedidos_callcenter_detalle";
    $data['selector'] = "welcome";
    $data['sidebar'] = "sidebar";
    $data['id'] = $id;
    
    $this->load->view('header');
    $this->load->view('main', $data);
    $this->load->view('extrafooter');
    }
    

    

}