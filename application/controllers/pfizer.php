<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pfizer extends CI_Controller
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
    $data['contenido'] = "pfizer";
    $data['selector'] = "welcome";
    $data['sidebar'] = "sidebar";
    $this->load->library('cart');
    $this->cart->destroy();
    
    
        $data_header['extraheader'] = "
<link type=\"text/css\" href=\"".base_url()."css/jquery.autocomplete.css\" rel=\"stylesheet\" />
<script type=\"text/javascript\" src=\"".base_url()."scripts/jquery.autocomplete.pack.js\"></script>
";
    //$this->load->model('pfizer_model');
    //$data['historial'] = $this->sms_model->historial();
    $this->load->view('header', $data_header);
    $this->load->view('main', $data);
    $this->load->view('extrafooter');
    }

	function clave()
	{
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		$q =  $this->input->get_post('q', TRUE);
		$this->load->model('sms_model');
		echo $this->sms_model->meds($q);
	}

	function checar_celular()
	{
	   $celular = $this->input->post('celular');

		$this->load->model('sms_model');
		echo $this->sms_model->celular($celular);
	}

	function agregar_clave()
	{
	   $clave = $this->input->post('clave');
	   $cantidad = $this->input->post('cantidad');

		$this->load->model('sms_model');
		echo $this->sms_model->agrega_med($clave, $cantidad);
	}
    
    function submit()
    {
        $this->load->model('sms_model');
        $control = $this->sms_model->inserta_control();
        $this->sms_model->inserta_detalle($control);
        redirect('sms');
    }
    
    function help()
    {
        $this->load->view('help/help_sms');
    }
    

}