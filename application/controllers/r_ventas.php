<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class R_ventas extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->helper('download');
        $this->load->helper('form');
        
    }

    public function esta_logeado()
    {
        $logeado = $this->session->userdata('is_logged_in');
        if($logeado == null){
            redirect('welcome');
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
       
    public function index()
    {
     
        $data['contenido'] = "blanco";
        $data['selector'] = "r_ventas";
        $data['sidebar'] = "sidebar_r_ventas";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_diario()
    {
        $data['titulo'] = "Reporte Diario";
        $data['titulo1'] = "";
        $data['contenido'] = "reporte_ventas";
        $data['selector'] = "r_ventas";
        $data['sidebar'] = "sidebar_r_ventas";
        $this->load->model('captura_pedidomodel1');
        $data['sucursal'] = $this->captura_pedidomodel1->sucursal();
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_diario_submit()
    {
        $sucursal = $this->input->post('suc');
        $fecha1 = $this->input->post('fecha1');
        $fecha2 = $this->input->post('fecha2');
        
        $this->load->model('r_ventas_model');
        
        $data['cabeza'] = $this->r_ventas_model->reporte_diario_encabezado($fecha1, $fecha2, $sucursal);
        $data['detalle'] = $this->r_ventas_model->reporte_diario($fecha1, $fecha2, $sucursal);
        
        $this->load->view('impresiones/reporte_diario_ventas', $data);
    }
    
    function reporte_semanal()
    {
        $data['titulo'] = "Reporte Semanal";
        $data['titulo1'] = "";
        $data['contenido'] = "reporte_ventas";
        $data['selector'] = "r_ventas";
        $data['sidebar'] = "sidebar_r_ventas";
        $this->load->model('captura_pedidomodel1');
        $data['sucursal'] = $this->captura_pedidomodel1->sucursal();
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_semanal_submit()
    {
        $sucursal = $this->input->post('suc');
        $semana = $this->input->post('semana');
        $anio = $this->input->post('anio');
        
        $this->load->model('r_ventas_model');

        $data['cabeza'] = $this->r_ventas_model->reporte_semanal_encabezado($semana, $anio, $sucursal);
        $data['detalle_total'] = $this->r_ventas_model->reporte_semanal_total($semana, $anio, $sucursal);
        //echo $data['cabeza'];
        //echo $data['detalle_total'];
        $this->load->view('impresiones/reporte_semanal_ventas', $data);
    }
    
    function reporte_mensual()
    {
        $data['titulo'] = "Reporte Mensual";
        $data['titulo1'] = "";
        $data['contenido'] = "reporte_ventas";
        $data['selector'] = "r_ventas";
        $data['sidebar'] = "sidebar_r_ventas";
        $this->load->model('captura_pedidomodel1');
        $data['sucursal'] = $this->captura_pedidomodel1->sucursal();
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_mensual_submit()
    {
        $sucursal = $this->input->post('suc');
        $mes = $this->input->post('mes');
        $anio = $this->input->post('anio');
        
        $this->load->model('r_ventas_model');

        $data['cabeza'] = $this->r_ventas_model->reporte_mensual_encabezado($mes, $anio, $sucursal);
        $data['detalle_total'] = $this->r_ventas_model->reporte_mensual_total($mes, $anio, $sucursal);
        //echo $data['cabeza'];
        //echo $data['detalle_total'];
        $this->load->view('impresiones/reporte_mensual_ventas', $data);
    }
    
    
}