<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pdv extends CI_Controller
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
        
        $data['contenido'] = "pdv1";
        $data['sidebar'] = "sidebar_tuto";
        $data_header['extraheader'] = "<link rel=\"stylesheet\" href=\"".base_url()."css/scripts/prettyPhoto.css\" type=\"text/css\" media=\"screen\">
        <script type=\"text/javascript\" src=\"".base_url()."scripts/js/jquery.prettyPhoto.js\"></script>
        ";


        $this->load->view('header', $data_header);
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    
    function descarga_pdv()
    {
       	$data = file_get_contents("./programas/pdv.zip");
        $name = 'pdv.zip';
        echo force_download($name, $data);
        //$data = 'Here is some text!';
//$name = 'mytext.txt';

//force_download($name, $data);
    }
    
    function descarga_tuto()
    {
       	$data = file_get_contents("./documentos/tutorial manejo de tarjetas de cliente preferente.doc");
        $name = 'tutorial manejo de tarjetas de cliente preferente.doc';
        echo force_download($name, $data);
        //$data = 'Here is some text!';
//$name = 'mytext.txt';

//force_download($name, $data);
    }
}