<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tuto_tiempo extends CI_Controller
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
        
        $data['contenido'] = "tuto_tiempo";
        $data['sidebar'] = "sidebar_tuto";
        $data_header['extraheader'] = "<link rel=\"stylesheet\" href=\"".base_url()."css/scripts/prettyPhoto.css\" type=\"text/css\" media=\"screen\">
        <script type=\"text/javascript\" src=\"".base_url()."scripts/js/jquery.prettyPhoto.js\"></script>
        ";


        $this->load->view('header', $data_header);
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    
    function descarga_mozilla()
    {
       	$data = file_get_contents("./programas/mozilla-firefox-2.0.0.20.exe");
        $name = 'firefox2.exe';
        echo force_download($name, $data);
        //$data = 'Here is some text!';
//$name = 'mytext.txt';

//force_download($name, $data);
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
    
    function descarga_teamviewer()
    {
       	$data = file_get_contents("./programas/TeamViewerQS_win98.exe");
        $name = 'TeamViewerQS_win98.exe';
        echo force_download($name, $data);
        //$data = 'Here is some text!';
//$name = 'mytext.txt';

//force_download($name, $data);
    }
    
    
}
