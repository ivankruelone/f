<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Seguropop extends CI_Controller
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

    function index()
    {

        $data['contenido'] = "procesos_blanco";
        $data['selector'] = "seguropop";
        $data['sidebar'] = "sidebar_seguropop";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
 /////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
     
    function tabla_seguropop()
    {
        $data['titulo'] = "";
        $data['titulo1'] = "SEGURO POPULAR";
        $this->load->model('seguropop_model');
        $data['tabla'] = $this->seguropop_model->compra_clave_prv();
        $data['contenido'] = "supervisor";
        $data['selector'] = "seguropop";
        $data['sidebar'] = "sidebar_seguropop";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
 /////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
   
  public function imprimir_detalle_clave($claves,$aaa)
    {
          $this->load->model('seguropop_model');  
          $query=$this->seguropop_model->busco_descri($claves);
          $row=$query->row();
          if($row->l2012>0){$mas=$row->l2012*1.10;}else{$mas=0;}
          
          $data['cabeza']='<p align="center"><strong>REPORTE DE COMPRA DEL SEGURO POPULAR A&Ntilde;O '.$aaa.'</strong></p>
          <p align="left">Impresion :'.date('Y-m-d H:i:s').'</p>
          <p color="blue"><strong>Producto..:'.$claves.' '.$row->susa1.'</strong>
          <br />Precio 2009..:'.$row->m2009.'
          <br />Precio 2010..:'.$row->m2010.'
          <br />Precio 2011..:'.$row->m2011.'
          <br />Precio 2012..:'.$row->m2012.'</p>
          <p color="green"><br />Precio Licitado 2012..: <strong>'.$row->l2012.'</strong> Con el 10% mas..:  <strong>'.$mas.'</strong></p>';
          $data['detalle'] = $this->seguropop_model->clave_detalle_compra($claves,$aaa);
         $this->load->view('impresiones/clave_segpop', $data);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
     
 /////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
     
    function tabla_seguropop_prv()
    {
        $data['titulo'] = "";
        $data['titulo1'] = "SEGURO POPULAR";
        $this->load->model('seguropop_model');
        $data['tabla'] = $this->seguropop_model->compra_clave_prv_prv();
        $data['contenido'] = "supervisor";
        $data['selector'] = "seguropop";
        $data['sidebar'] = "sidebar_seguropop";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
 /////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
     
    function tabla_seguropop_prv_det($prv)
    {
        $data['titulo'] = "";
        $data['titulo1'] = "SEGURO POPULAR";
        $this->load->model('seguropop_model');
        $data['tabla'] = $this->seguropop_model->compra_clave_prv_prv_det($prv);
        $data['contenido'] = "supervisor";
        $data['selector'] = "seguropop";
        $data['sidebar'] = "sidebar_seguropop";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

 /////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
     
    function tabla_seguropop_prv_det_mal($prv)
    {
        $data['titulo'] = "";
        $data['titulo1'] = "SEGURO POPULAR";
        $this->load->model('seguropop_model');
        $data['tabla'] = $this->seguropop_model->compra_clave_prv_prv_det_mal($prv);
        $data['contenido'] = "supervisor";
        $data['selector'] = "seguropop";
        $data['sidebar'] = "sidebar_seguropop";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
 
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

 

  
    
   
      }