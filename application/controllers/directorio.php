<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Directorio extends CI_Controller
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

    public function index($id = null)
    {
        $this->load->model('direc');
        $data['contenido'] = "directorio";
        $data['selector'] = "directorio";
        $data['sidebar'] = "sidebar_directorio";
        $data['id'] = $id;
 
        $data_head['es_mapa'] = 1;
        
        $data_head['extraheader'] = "
        <script type=\"text/javascript\" src=\"http://maps.google.com/maps/api/js?v=3&sensor=false&language=es\"></script>
        <script type=\"text/javascript\" src=\"".base_url()."fancybox/jquery.fancybox-1.3.4.pack.js\"></script>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."fancybox/jquery.fancybox-1.3.4.css\" media=\"screen\" />
        ";

        $this->load->view('header', $data_head);
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////    

    
    function detalle_sucursal()
    {
        $this->load->model('direc');
        echo $this->direc->detalle_sucursal();
    }
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////    

    function busca_sucursal()
    {
        $this->load->model('direc');
        echo $this->direc->busca_sucursal();
    }
    
    function editar1($suc)
    {
        $this->load->model('direc');
        $data['query'] = $this->direc->direc_datos1($suc);
        $data['contenido'] = "editar_suc";
        $data['selector'] = "directorio";
        $data['sidebar'] = "sidebar_directorio";
        $data['suc'] = $suc;
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    
    function submit1()
    {
        $extension= $this->input->post('extension');
        $celular= $this->input->post('celular');
        $fijo= $this->input->post('fijo');
        $email= $this->input->post('email');
        $suc= $this->input->post('suc');
        $this->load->model('direc');
        $id=$this->direc->editar_sucursal($suc, $extension, $celular, $fijo, $email);
        //echo '<p class="message-box ok">Sus cambios se guardaron con exito</p>';
        //$this->load->view('contenido/mensaje_exito');
        redirect('directorio/index/'.$id);
    }
    
    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
       function busca_personal($id = null)
    {
        $this->load->model('direc');
        echo $this->direc->busca_personal($id);
    }
    
    
    function editar($id)
    {
        $this->load->model('direc');
        $data['query'] = $this->direc->direc_datos($id);
        $data['contenido'] = "editar";
        $data['selector'] = "equipos";
        $data['sidebar'] = "sidebar_blanco";
        $data['id'] = $id;
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    
    function submit()
    {
        $extension= $this->input->post('extension');
        $celular= $this->input->post('celular');
        $fijo= $this->input->post('fijo');
        $email= $this->input->post('email');
        $id= $this->input->post('id');
        $this->load->model('direc');
        $id=$this->direc->editar_personal($id, $extension, $celular, $fijo, $email);
        //echo '<p class="message-box ok">Sus cambios se guardaron con exito</p>';
        //$this->load->view('contenido/mensaje_exito');
        redirect('directorio/index/'.$id);
    }
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */