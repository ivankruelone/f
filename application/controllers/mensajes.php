<?php
class Mensajes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->model('mensajes_model');
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
        $data['vista'] = 'sitio2/mensajes/indice';
        $data['menu'] = 'home';
        $this->load->view('site2', $data);
    }

}
