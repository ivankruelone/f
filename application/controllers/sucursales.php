<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Sucursales extends CI_Controller
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
        $this->load->model('sucursal');
        $data['contenido'] = "sucursales";
        $data['selector'] = "sucursales";
        $data['sidebar'] = "sidebar_sucursales";
        $data['estados'] = $this->sucursal->estados();
        
        $data_head['es_mapa'] = 1;
        
        $data_head['extraheader'] = "
        <script type=\"text/javascript\" src=\"http://maps.google.com/maps/api/js?v=3&sensor=false&language=es\"></script>
        <script type=\"text/javascript\" src=\"".base_url()."fancybox/jquery.fancybox-1.3.4.pack.js\"></script>
    	<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."fancybox/jquery.fancybox-1.3.4.css\" media=\"screen\" />
        <script type=\"text/javascript\" src=\"".base_url()."scripts/jquery.prettyPopin.js\"></script>
    	<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."css/prettyPopin.css\" media=\"screen\" />

        ";

        $this->load->view('header', $data_head);
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    public function formato_sucur()
    {
        $this->load->model('sucursal');
        $data['contenido'] = "formato_sucursales";
        $data['selector'] = "formato";
        $data['sidebar'] = "sidebar_blanco";
        $data['atencion'] = $this->sucursal->con_atencion();
        $data['sucursal'] = $this->sucursal->sel_sucursal();

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function busca_cp()
    {
        $this->load->model('sucursal');
        echo $this->sucursal->busca_cp();
    }
    
    function busca_municipios()
    {
        $this->load->model('sucursal');
        echo $this->sucursal->busca_municipios();
    }
    
    function busca_edo_municipio()
    {
        $this->load->model('sucursal');
        echo $this->sucursal->busca_edo_municipio();
    }

    function detalle_sucursal()
    {
        $this->load->model('sucursal');
        echo $this->sucursal->detalle_sucursal();
    }

    function busca_sucursal()
    {
        $this->load->model('sucursal');
        echo $this->sucursal->busca_sucursal();
    }
    
    
    function imprime2($suc, $atencion)
    {
        $atencion = $this->input->post('atencion');
        $suc = $this->input->post('sucursal');

        $this->load->model('sucursal');


        $data['cabeza'] = $this->sucursal->reporte_sucur_encabezado1();
        $data['detalle'] = $this->sucursal->reporte_sucur($suc, $atencion);


        
        $this->load->view('impresiones/reporte_sucursal', $data);

    }
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */