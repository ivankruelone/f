<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tuto extends CI_Controller
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
        
        $data['contenido'] = "tuto";
        $data['sidebar'] = "sidebar_tuto";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

    
    function descarga_tuto()
    {
       	$data = file_get_contents("./documentos/facturacion electronica punto de venta yucif.doc");
        $name = 'facturacion electronica punto de venta yucif.doc';
        echo force_download($name, $data);
        //$data = 'Here is some text!';
//$name = 'mytext.txt';

//force_download($name, $data);
    }
    
    function descarga_tuto1()
    {
       	$data = file_get_contents("./documentos/tiempo aire.doc");
        $name = 'tiempo aire.doc';
        echo force_download($name, $data);
        //$data = 'Here is some text!';
//$name = 'mytext.txt';

//force_download($name, $data);
    }
    
    function descarga_tuto2()
    {
       	$data = file_get_contents("./documentos/facturacion electronica punto de venta backoffice.doc");
        $name = 'facturacion electronica punto de venta backoffice.doc';
        echo force_download($name, $data);
        //$data = 'Here is some text!';
//$name = 'mytext.txt';

//force_download($name, $data);
    }
    
    function descarga_tuto3()
    {
       	$data = file_get_contents("./documentos/tiempo aire1.doc");
        $name = 'tiempo aire1.doc';
        echo force_download($name, $data);
        //$data = 'Here is some text!';
//$name = 'mytext.txt';

//force_download($name, $data);
    }
}
