<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Audita extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->helper('form');
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function esta_logeado()
    {
        $logeado = $this->session->userdata('is_logged_in');
        if($logeado == null){
            redirect('welcome');
        }
    }

    public function cortes()
    {
        $data['mensaje']= '';
        $data['titulo']= 'RECEPCION DE CORTES';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "audita";
        $data['selector'] = "audita";
        $data['sidebar'] = "sidebar_audita";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_control_cortes()
    {
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        $this->load->model('cortes_model');
        $data['titulo'] = "SUCURSALES ASIGNADAS";
        $data['contenido'] = "audita_form_0";
        $data['selector'] = "audita";
        $data['sidebar'] = "sidebar_audita";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_control_cortes_bloque()
    {
        $aaa=date('Y');
        $mes= $this->input->post('mes');
        $fec=$aaa."-".str_pad($mes,2,"0",STR_PAD_LEFT); 
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes); 
	    $this->load->model('audita_model');   
        
        $data['tabla'] = $this->audita_model->control_cortes($fec);
        $data['titulo1'] = "SUCURSALES QUE YA TRANSMITIERON DEL MES DE $mesx";
        $data['titulo'] = "SUCURSALES ASIGNADAS";
        $data['contenido'] = "audita";
        $data['selector'] = "audita";
        $data['sidebar'] = "sidebar_audita";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_control_cortes_bloque_det($suc,$fec)
    {
        $mes=substr($fec,5,2);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        $sucx = $this->catalogo_model->busca_suc_unica($suc);  
	    
        $this->load->model('audita_model');   
        $data['tabla'] = $this->audita_model->control_cortes_det($suc,$fec);
        $data['titulo1'] = "MES DE $mesx DE LA SUCURSAL $suc - $sucx";
        $data['titulo'] = "SUCURSALES ASIGNADAS";
        $data['contenido'] = "audita";
        $data['selector'] = "audita";
        $data['sidebar'] = "sidebar_audita";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_control_decena()
    {
        $aaa=$this->input->post('aaa');
        $mes= $this->input->post('mes');
        echo $mes;
        $decena= $this->input->post('decena');
        
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_mes_t($mes);
        $row=$query->row();
        $dia=$row->dos;
        $mesx=$row->mes;
        
        if($decena==1){$fec1=$aaa."-".str_pad($mes,2,"0",STR_PAD_LEFT)."-".str_pad('01',2,"0",STR_PAD_LEFT);$fec2=$aaa."-".str_pad($mes,2,"0",STR_PAD_LEFT)."-".str_pad('10',2,"0",STR_PAD_LEFT);}
        if($decena==2){$fec1=$aaa."-".str_pad($mes,2,"0",STR_PAD_LEFT)."-".str_pad('01',2,"0",STR_PAD_LEFT);$fec2=$aaa."-".str_pad($mes,2,"0",STR_PAD_LEFT)."-".str_pad('20',2,"0",STR_PAD_LEFT);}
        if($decena==3){$fec1=$aaa."-".str_pad($mes,2,"0",STR_PAD_LEFT)."-".str_pad('01',2,"0",STR_PAD_LEFT);$fec2=$aaa."-".str_pad($dia,2,"0",STR_PAD_LEFT)."-".str_pad('10',2,"0",STR_PAD_LEFT);}
         
	    $this->load->model('audita_model');   
        
        $data['tabla'] = $this->audita_model->control_decena($decena,$fec1,$fec2);
        $data['titulo1'] = "VENTAS DEL MES DE $mesx DE LA DECENA $decena";
        $data['titulo'] = "SUCURSALES ASIGNADAS";
        $data['contenido'] = "audita";
        $data['selector'] = "audita";
        $data['sidebar'] = "sidebar_audita";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function calculo_comision()
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes();
        $this->load->model('audita_model');
       	$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        
        $data['titulo'] = "REPORTE MENSUAL DE CORTES<br /><font size=\"3\" color=\"red\">ESTA INFORMACION SERA UTILIZADA PARA EVALUAR COMISIONES</font>";
        $data['titulo1'] = "";
        $data['tabla'] = $this->audita_model->comision();
        $data['contenido'] = "audita_form_comision";
        $data['selector'] = "audita";
        $data['sidebar'] = "sidebar_audita";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function calculo_comision_detalle()
    {
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $this->load->model('audita_model');
        $this->audita_model->pre_comision_cortes($aaa,$mes);
        
        redirect('audita/calculo_comision');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function comision_det($fecha)
    {
        $this->load->model('audita_model');
       	
        $data['titulo'] = "CORTES MENSUALES $fecha";
        $data['titulo1'] = "";
        $data['tabla'] = $this->audita_model->comision_det($fecha);
        $data['contenido'] = "audita";
        $data['selector'] = "audita";
        $data['sidebar'] = "sidebar_audita";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function valida_comision_detalle($fec)
    {
          $this->load->model('audita_model');
        $this->audita_model->valida_comision_cortes($fec);
        
        redirect('audita/calculo_comision');
    }
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function borra_comision_detalle($fec)
    {
          $this->load->model('audita_model');
        $this->audita_model->borra_comision_cortes($fec);
        
        redirect('audita/calculo_comision');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_depositos()
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes();
        $this->load->model('audita_model');
       	$data['titulo'] = "DEPOSITOS GENERADOS POR MES";
        $data['titulo1'] = "";
        $data['tabla'] = '';
        $data['tabla'] = $this->audita_model->ver_depositos();
        $data['contenido'] = "ventas";
        $data['selector'] = "contabilidad";
        $data['sidebar'] = "sidebar_audita";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

  public function tabla_depositos_cia($mes)
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        $this->load->model('audita_model');
        $data['titulo'] = "DEPOSITOS DEL MES DE $mesx";
        $data['titulo1'] = "";
        $data['tabla'] = $this->audita_model->ver_depositos_cia($mes);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_audita";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
   public function tabla_depositos_cia_suc($mes,$cia)
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        $this->load->model('audita_model');
        $data['titulo'] = "DEPOSITOS DEL MES DE $mesx";
        $data['titulo1'] = "";
        $data['tabla'] = $this->audita_model->ver_depositos_cia_suc($mes,$cia);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_audita";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
      public function tabla_depositos_cia_suc_dia($mes,$cia,$suc)
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        $this->load->model('audita_model');
        $data['titulo'] = "DEPOSITOS DEL MES DE $mesx";
        $data['titulo1'] = "";
        $data['tabla'] = $this->audita_model->ver_depositos_cia_suc_dia($mes,$cia,$suc);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_audita";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




}    