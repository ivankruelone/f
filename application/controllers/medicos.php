<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medicos extends CI_Controller
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

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
       
    public function index()
    {
        $data['titulo'] = "";
        $data['tabla']='BUENOS DIAS A TODO EL PERSONAL<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
        
        $data['contenido'] = "blanco";
        $data['selector'] = "blanco";
        $data['sidebar'] = "sidebar_medicos";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_medicos_cat()
    {
        $this->load->model('medicos_model');
        $data['tabla'] = $this->medicos_model->cat_medicos();
        
        $data['titulo']= 'CATALOGO DE MEDICOS';
         $this->load->view('contenidos/viu_7', $data);    
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function edita_medicos($nomina)
{       
        $this->load->model('catalogo_model');
        $this->load->model('medicos_model');
        $data['titulo'] = "ASIGNAR TURNO";
        $data['mat'] = $this->catalogo_model->busca_sucursal_general_nom();
        $data['ves'] = $this->catalogo_model->busca_sucursal_general_nom();
        $data['tabla'] = $this->medicos_model->medico($nomina);
        $data['nomina'] = $nomina;
        $data['contenido'] = "medicos_form_suc";
        $data['selector'] = "blanco"; 
        $data['sidebar'] = "sidebar_medicos";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');   
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function edita_turno($nomina)
    {
   
        $this->load->model('medicos_model');
        $this->medicos_model->update_member($this->input->post('nomina'),$this->input->post('mat'),$this->input->post('ves'));
        redirect('medicos/tabla_medicos_cat');
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function tabla_medicos_nat()
{       
        $this->load->model('catalogo_model');
        $this->load->model('ventas_model');
       	$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['titulo'] = "VENTA NATURISTAS DE MEDICOS";
        $data['tabla'] = '';
        $data['contenido'] = "medicos_form_fec";
        $data['selector'] = "blanco"; 
        $data['sidebar'] = "sidebar_medicos";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');   
}  
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function tabla_medicos_nat_d()
{
 $this->load->model('medicos_model');
 $fec=$this->input->post('aaa').'-'.str_pad($this->input->post('mes'),2,"0",STR_PAD_LEFT);
 $data['tabla'] = $this->medicos_model->medicos_naturistas($fec);
 $data['titulo'] = "VENTA NATURISTAS DE MEDICOS";
 $this->load->view('contenidos/viu_7_num', $data);     
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////












    
      }