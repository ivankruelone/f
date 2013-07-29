<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mobile extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        //$this->esta_logeado();
        
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
        $this->load->view('mobile/login');
    }
    
    function login_submit()
    {
        $this->load->view('mobile/hola');
    }
    
}