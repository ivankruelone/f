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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function rep_rutas()
    {
        $data['mensaje']= '';
        $data['titulo']='REPORTE DE SUCURSALES POR RUTA';
        $this->load->model('reportes_model');
        $data['contenido'] = "r_x_d";
        $data['selector'] = "reportes";
        $data['sidebar'] = "sidebar_reportes";
        $data['tabla'] = '';
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_submit1()
    {
        $fecha1 = $this->input->post('fecha1');
        $fecha2 = $this->input->post('fecha2');
        
        $this->load->model('reportes_model');

        $data['cabeza'] = $this->reportes_model->reporte_ruta_encabezado($fecha1, $fecha2);
        $data['detalle'] = $this->reportes_model->reporte_ruta($fecha1, $fecha2);
        //print_r($data);
        $this->load->view('impresiones/reporte_x_ruta', $data);
    }
    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function rep_esp()
    {
        $data['mensaje']= '';
        $data['titulo']='REPORTE DE PEDIDOS ESPECIALES Y METRO';
        $this->load->model('reportes_model');
        $data['contenido'] = "reporte_ped_metro_y _esp";
        $data['selector'] = "reportes";
        $data['sidebar'] = "sidebar_reportes";
        $data['tabla'] = '';
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_submit2()
    {
        $fecha1 = $this->input->post('fecha1');
        $fecha2 = $this->input->post('fecha2');
        
        $this->load->model('reportes_model');

        $data['cabeza'] = $this->reportes_model->reporte_esp_metro_encabezado($fecha1, $fecha2);
        $data['detalle'] = $this->reportes_model->reporte_esp_metro($fecha1, $fecha2);
        //print_r($data);
        $this->load->view('impresiones/reporte_esp_metro', $data);
    }
    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function rep_pza()
    {
        $data['mensaje']= '';
        $data['titulo']='REPORTE DE PRODUCTOS X CLAVE ESPECIALES Y METRO';
        $this->load->model('reportes_model');
        $data['contenido'] = "reporte_piezas";
        $data['selector'] = "reportes";
        $data['sidebar'] = "sidebar_reportes";
        $data['tabla'] = '';
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_submit3()
    {
        $fecha1 = $this->input->post('fecha1');
        $fecha2 = $this->input->post('fecha2');
        
        $this->load->model('reportes_model');

        $data['cabeza'] = $this->reportes_model->reporte_esp_metro_encabezado1($fecha1, $fecha2);
        $data['detalle'] = $this->reportes_model->reporte_esp_metro1($fecha1, $fecha2);
        //print_r($data);
        $this->load->view('impresiones/reporte_esp_metro', $data);
    }


      }