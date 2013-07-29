<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mercadotecnia extends CI_Controller
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
    public function index_lab()
    {
       
        $data['titulo']= '';
       
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecnial";
        $data['sidebar'] = "sidebar_mercadotecnia_lab";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
    public function index_tar()
    {
       
        $data['titulo']= '';
       
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniat";
        $data['sidebar'] = "sidebar_mercadotecnia_tar";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

     public function tabla_tarjetas()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'PEDIDOS FORMULADOS';
        $data['tabla'] = '';
        $data['contenido'] = "mercadotecnia_form_tar";
        $data['selector'] = "mercadotecniat";
        $data['sidebar'] = "sidebar_mercadotecnia_tar";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_tarjetas_nacional()
    {
        $fec=$this->input->post('fec1');
        $this->load->model('compras_model');
        $data['titulo'] = 'PEDIDOS FORMULADOS';
        $data['tabla'] = $this->compras_model->tarjetas($fec);
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniat";
        $data['sidebar'] = "sidebar_mercadotecnia_tar";

       
    }/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
       
    public function indexc()
    {
       
        $data['titulo']= '';
       
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniac";
        $data['sidebar'] = "sidebar_mercadotecnia_cat";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      
    public function tabla_catalogo()
    {
        $data['mensaje']= '';
        $data['titulo']= 'CATALOGO DE OFERTAS';
        $data['titulo1']= '';
        $this->load->model('mercadotecnia_model');
        $data['tabla']= $this->mercadotecnia_model->catalogo_ofertas();
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniac";
        $data['sidebar'] = "sidebar_mercadotecnia_cat";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      
    public function tabla_catalogo_lab()
    {
        $data['mensaje']= '';
        $data['titulo']= 'CATALOGO DE LABORATORIOS';
        $data['titulo1']= '';
        $this->load->model('mercadotecnia_model');
        $data['tabla']= $this->mercadotecnia_model->catalogo_labor();
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniac";
        $data['sidebar'] = "sidebar_mercadotecnia_cat";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      
    public function tabla_catalogo_lab_det($lab)
    {
        
        $data['titulo']= 'CATALOGO DE LABORATORIOS';
        $this->load->model('mercadotecnia_model');
        $data['tabla']= $this->mercadotecnia_model->catalogo_labor_det($lab);
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniac";
        $data['sidebar'] = "sidebar_mercadotecnia_cat";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
       
    public function indexd()
    {
       
        $data['titulo']= '';
       
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniad";
        $data['sidebar'] = "sidebar_mercadotecnia_des";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_desplazamientos_ofertas()
    {
        $data['titulo']= 'CATALOGO DE OFERTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->desplazamiento_ofertas();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniad";
        $data['sidebar'] = "sidebar_mercadotecnia_des";
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_desplazamientos_lab()
    {
        $data['titulo']= 'CATALOGO DE OFERTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->desplazamiento_lab();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniad";
        $data['sidebar'] = "sidebar_mercadotecnia_des";
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_desplazamientos_lab_ctl($lab,$labx)
    {
        $data['titulo']= '';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->desplazamiento_lab_ctl($lab,$labx);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniad";
        $data['sidebar'] = "sidebar_mercadotecnia_des";
        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_desplazamientos_lab_det($lab,$labx)
    {
        $data['titulo']= '';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->desplazamiento_lab_det($lab,$labx);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniad";
        $data['sidebar'] = "sidebar_mercadotecnia_des";
        
    }
//////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
       
    public function indexn()
    {
       
        $data['titulo']= '';
       
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniacon";
        $data['sidebar'] = "sidebar_mercadotecnia_not";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_notas_ofertas()
    {
        $data['titulo']= 'NOTAS DE OFERTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->notas_ofertas();
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecnian";
        $data['sidebar'] = "sidebar_mercadotecnia_not";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_notas_ofertas_det($id)
    {
       
        $this->load->model('mercadotecnia_model');
        $query= $this->mercadotecnia_model->busco_nota($id);
        $row= $query->row();
        $data['titulo']= 'AAA.: '.$row->aaa.' MES.:'.$row->mes.' LABORATORIO.:'.$row->labor;
        $data['tabla'] = $this->mercadotecnia_model->notas_ofertas_det($id,$row->aaa,$row->mes,$row->prv,$row->labor,$row->tipo_nota);
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniacom";
        $data['sidebar'] = "sidebar_mercadotecnia_not";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_notas_ofertas_det_cod($id,$cod)
    {
        
        $this->load->model('mercadotecnia_model');
        $query= $this->mercadotecnia_model->busco_nota($id);
        $row= $query->row();
        $data['titulo']= 'AAA.: '.$row->aaa.' MES.:'.$row->mes.' LABORATORIO.:'.$row->labor;
        $data['tabla'] = $this->mercadotecnia_model->notas_ofertas_det_cod($row->aaa,$row->mes,$row->prv,$row->labor,$row->tipo_nota,$cod);
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniacom";
        $data['sidebar'] = "sidebar_mercadotecnia_not";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_notas_ofertas_suc($id)
    {
        
        $this->load->model('mercadotecnia_model');
        $query= $this->mercadotecnia_model->busco_nota($id);
        $row= $query->row();
        $data['titulo']= 'AAA.: '.$row->aaa.' MES.:'.$row->mes.' LABORATORIO.:'.$row->labor;
        $data['tabla'] = $this->mercadotecnia_model->notas_ofertas_suc($id,$row->aaa,$row->mes,$row->prv,$row->labor,$row->tipo_nota);
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniacom";
        $data['sidebar'] = "sidebar_mercadotecnia_not";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_notas_suc()
    {
        $data['titulo']= 'CATALOGO DE OFERTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->notas_suc();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniad";
        $data['sidebar'] = "sidebar_mercadotecnia_des";
        
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_notas_ofertas_det_suc($id,$suc)
    {
        
        $this->load->model('mercadotecnia_model');
        $query= $this->mercadotecnia_model->busco_nota($id);
        $row= $query->row();
        $data['titulo']= 'AAA.: '.$row->aaa.' MES.:'.$row->mes.' LABORATORIO.:'.$row->labor;
        $data['tabla'] = $this->mercadotecnia_model->notas_ofertas_det_suc($row->aaa,$row->mes,$row->prv,$row->labor,$row->tipo_nota,$suc);
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniacom";
        $data['sidebar'] = "sidebar_mercadotecnia_not";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_nota_oferta_cod()
    {
        $data['titulo']= 'COMPRA DE OFERTAS EN NOTA';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->notas_oferta_cod();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniacom";
        $data['sidebar'] = "sidebar_mercadotecnia_not";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_notas_oferta_cod_mes($cod)
    {
        $data['titulo']= '';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->notas_oferta_cod_mes($cod);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniad";
        $data['sidebar'] = "sidebar_mercadotecnia_des";
        
    }

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
       
    public function indexv()
    {
       
        $data['titulo']= '';
       
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniav";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_ventas()
    {
        $data['titulo']= 'COMPRA DE OFERTAS EN NOTA';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_solof();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
        
        
        
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////DIRECCION
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function tabla_ventas_cia()
    {
        $data['titulo']= 'REPORTE DE VENTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_ciaf();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_ventas_total_cia()
    {
        $data['titulo']= 'REPORTE DE VENTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_total_ciaf();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_ventas_total_cia_suc($cia,$razon)
    {
        $data['titulo']= 'REPORTE DE VENTAS'.$razon;
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_total_ciaf_suc($cia);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function tabla_ventas_cadena()
    {
        $data['titulo']= 'REPORTE DE VENTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_cadena();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_ventas_total_cadena()
    {
        $data['titulo']= 'REPORTE DE VENTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_total_cadena();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_ventas_total_cadena_suc($tipo,$tipox)
    {
        $data['titulo']= 'REPORTE DE VENTAS'.$tipox;
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_total_cadena_suc($tipo);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_ventas_total_lin()
    {
        $data['titulo']= 'REPORTE DE VENTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_total_lin();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_ventas_total_lin_suc($lin,$linx)
    {
        
        $data['titulo']= 'REPORTE DE VENTAS'.utf8_decode($linx);
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->ventas_total_lin_suc($lin);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////UTILIDAD POR FARMACIA

///////////////////////////////////////////////////////////////////////////////////////////////////////////////DIRECCION
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_utilidad_total_cia()
    {
        $data['titulo']= 'REPORTE DE VENTAS';
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->utilidad_total_ciaf();
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
        //$this->load->view('header');
        //$this->load->view('main', $data);
        //$this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_utilidad_total_cia_suc($cia,$razon)
    {
        $data['titulo']= 'REPORTE DE VENTAS'.$razon;
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->utilidad_total_ciaf_suc($cia);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_utilidad_total_cia_suc_det($suc,$sucx)
    {
        $data['titulo']= 'REPORTE DE VENTAS'.utf8_decode($sucx);
        $this->load->model('mercadotecnia_model');
        $data['tabla'] = $this->mercadotecnia_model->utilidad_total_ciaf_suc_det($suc,$sucx);
          
        $data['contenido'] = "mercadotecnia";
        $data['selector'] = "mercadotecniaven";
        $data['sidebar'] = "sidebar_mercadotecnia_ven";
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////


















    
      }