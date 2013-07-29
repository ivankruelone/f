<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reportes extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->helper('download');
        
    }

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
       
    public function esta_logeado()
    {
        $logeado = $this->session->userdata('is_logged_in');
        if($logeado == null){
            redirect('welcome');
        }
    }

    public function index()
    {
        $data['contenido'] = "reportes";
        $data['selector'] = "reportes";
        $data['sidebar'] = "sidebar_reportes";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function sucur_cia()
    {
        $data['mensaje']= '';
        $this->load->model('catalogo_model');
        $data['sucursal'] = $this->catalogo_model->busca_sucursal3();
        
        
        $data['titulo']='REPORTE DE SUCURSAL PARA DAR DE ALTA';
        $this->load->model('reportes_model');
        $data['contenido'] = "r_suc_cia";
        $data['selector'] = "reportes";
        $data['sidebar'] = "sidebar_reportes";
        $data['tabla'] = '';
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_submit()
    {
        $sucursal = $this->input->post('suc');
        
        $this->load->model('reportes_model');

        $data['cabeza'] = $this->reportes_model->reporte_diario_encabezado($sucursal);
        $data['detalle'] = $this->reportes_model->reporte_diario($sucursal);
        //print_r($data);
        $this->load->view('impresiones/reporte_suc_cia', $data);
    }

      }