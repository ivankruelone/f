<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tuto_nominas extends CI_Controller
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
        
        $data['contenido'] = "tuto_nominas";
        $data['sidebar'] = "sidebar";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

    
    function descarga_tuto()
    {
       	$data = file_get_contents("./documentos/TUTORIAL PARA LA CAPTURA DE SUS CORTES.doc");
        $name = 'TUTORIAL PARA LA CAPTURA DE SUS CORTES.doc';
        echo force_download($name, $data);
        //$data = 'Here is some text!';
//$name = 'mytext.txt';

//force_download($name, $data);
    }
    
    function descarga_tuto1()
    {
       	$data = file_get_contents("./documentos/TUTORIAL PRENOMINA.doc");
        $name = 'TUTORIAL PRENOMINA.doc';
        echo force_download($name, $data);
        //$data = 'Here is some text!';
//$name = 'mytext.txt';

//force_download($name, $data);
    }
    
}
