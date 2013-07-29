<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empresa2 extends CI_Controller
{
    
     public function __construct()
    {
        parent::__construct();
        
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
        

        $data['contenido'] = "empresa";
        $data['selector'] = "empresa";
        $data_header['extraheader'] = "<link rel=\"stylesheet\" href=\"".base_url()."css/scripts/prettyPhoto.css\" type=\"text/css\" media=\"screen\">
        <script type=\"text/javascript\" src=\"".base_url()."scripts/js/jquery.prettyPhoto.js\"></script>
        ";
        $this->load->model('paginas2');

        
        
        $data['empresa'] = $this->paginas2->trae_detalles();


        $this->load->view('header', $data_header);
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }


}