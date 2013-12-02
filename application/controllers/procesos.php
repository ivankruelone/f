<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Procesos extends CI_Controller
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
        //if($logeado == null){
        //    redirect('welcome');
    //}
    }

    function index()
    {

        $data['contenido'] = "procesos_blanco";
        $data['selector'] = "procesos";
        $data['sidebar'] = "sidebar_procesos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
      
    function formulario_completo()
    {
      
        $data['contenido'] = "procesos_contenido";
        $data['selector'] = "procesos";
        $data['sidebar'] = "sidebar_procesos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
  public function submit_poliza_inv()
  {
    ini_set('memory_limit','2000M');
    set_time_limit(0);
     $aaa = $this->input->post('anio');
     $mes = $this->input->post('mes');
     $sem = $this->input->post('semana');
     $dia = $this->input->post('dia');
     
     $this->load->model('proceso_model');
     $this->proceso_model->llena_member_inv($aaa,$mes,$sem,$dia);
    redirect('procesos/index');
  }
   function formulario_completo2()
    {
      
        $data['contenido'] = "procesos_contenido2";
        $data['selector'] = "procesos";
        $data['sidebar'] = "sidebar_procesos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }  
 public function submit_una()
  {
     $aaa = $this->input->post('anio');
     $sem = $this->input->post('semana');
     
     $this->load->model('proceso_model');
     $this->proceso_model->envia_una_inv($aaa,$sem);
    redirect('procesos/index');
  }    
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    function formulario_nilsen()
    {
      
        $data['contenido'] = "procesos_nilsen";
        $data['selector'] = "procesos";
        $data['sidebar'] = "sidebar_procesos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
        
  public function submit_nilsen()
  {
     ini_set('memory_limit','2000M');
     set_time_limit(0);
     $fec1 = $this->input->post('anio1')."-".str_pad($this->input->post('mes1'),2,"0",STR_PAD_LEFT)."-".str_pad($this->input->post('dia1'),2,"0",STR_PAD_LEFT);
     $fec2 = $this->input->post('anio2')."-".str_pad($this->input->post('mes2'),2,"0",STR_PAD_LEFT)."-".str_pad($this->input->post('dia2'),2,"0",STR_PAD_LEFT);
     
     $sem = $this->input->post('semana');
     $this->load->model('envio_model_for');
     $this->envio_model_for->nilsen($fec1,$fec2,$sem);
    redirect('procesos/index');
  }    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    function formulario_noblock()
    {
      
        $data['contenido'] = "procesos_noblock";
        $data['selector'] = "procesos";
        $data['sidebar'] = "sidebar_procesos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
        
  public function submit_noblock()
  {
     ini_set('memory_limit','2000M');
     set_time_limit(0);
     $fec = $this->input->post('aaa')."-".str_pad($this->input->post('mes'),2,"0",STR_PAD_LEFT)."-".str_pad($this->input->post('dia'),2,"0",STR_PAD_LEFT);
     
     
     $sem = $this->input->post('semana');
     $this->load->model('envio_model_for');
     $this->envio_model_for->noblock($fec);
    redirect('procesos/index');
  }    

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////      
   function formulario_almacen()
    {
      
        $data['contenido'] = "procesos_almacen";
        $data['selector'] = "procesos";
        $data['sidebar'] = "sidebar_procesos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
        
  public function submit_almacen()
  {
     ini_set('memory_limit','2000M');
     set_time_limit(0);
     $fecha = $this->input->post('anio')."-".str_pad($this->input->post('mes'),2,"0",STR_PAD_LEFT);
     $this->load->model('envio_model_as400');
     $this->envio_model_as400->poliza_almacen($fecha);
     $this->envio_model_as400->poliza_almacen_exel($fecha);
    redirect('procesos/index');
  }    
    
 ///////////***********************************************/////////////   
   public function tabla_catalogo()
  {
     ini_set('memory_limit','2000M');
     set_time_limit(0);
     $this->load->model('proceso_model');
     $this->proceso_model->catalogo_cat();
    redirect('procesos/index');
  }  
 ///////////***********************************************///////////// 
 function index_rh()
    {

        $data['contenido'] = "recursos_humanos";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }  
   public function tabla_catalogo_rh()
  {
     ini_set('memory_limit','2000M');
     set_time_limit(0);
     $this->load->model('proceso_model');
     $this->proceso_model->catalogo_cat_rh();
    redirect('procesos/index');
  }  
 ///////////***********************************************/////////////
 ///////////***********************************************/////////////
   public function tabla_catalogo_pdv()
  {
     ini_set('memory_limit','2000M');
     set_time_limit(0);
     $this->load->model('proceso_model');
     $this->proceso_model->catalogo_cat_pdv();
    redirect('procesos/index');
  }
 ///////////***********************************************/////////////
   function formulario_vtas_direccion()
    {
      
        $data['contenido'] = "procesos_form_vta_direccion";
        $data['selector'] = "procesos";
        $data['sidebar'] = "sidebar_procesos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
 ///////////***********************************************/////////////
   public function tabla_vta_direccion()
  {
     ini_set('memory_limit','20000M');
     set_time_limit(0);
     $aaa = $this->input->post('anio');
     $mes = $this->input->post('mes');
     $this->load->model('proceso_model');
     $this->proceso_model->proceso_vta_direccion($aaa,$mes);
    redirect('procesos/index');
  }   
 ///////////***********************************************/////////////   
 ///////////***********************************************/////////////
   function formulario_vtas_diarias()
    {
      
        $data['contenido'] = "procesos_form_vta_diarias";
        $data['selector'] = "procesos";
        $data['sidebar'] = "sidebar_procesos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
 ///////////***********************************************/////////////
   public function tabla_vtas_diarias()
  {
     ini_set('memory_limit','2000M');
     set_time_limit(0);
     $aaa = $this->input->post('anio');
     $mes = $this->input->post('mes');
     $this->load->model('proceso_model');
     $this->proceso_model->proceso_vtas_diarias($aaa,$mes);
    redirect('procesos/index');
  }   
 ///////////***********************************************///////////// 
 ///////////***********************************************///////////// 
  function tabla_pedidos_formulados()
    {
       
        ini_set('memory_limit','5000M');
        set_time_limit(0);
        $this->load->model('catalogo_model');
        $this->load->model('proceso_model_pedido');
		$data['por1'] = $this->catalogo_model->busca_ord_dias();
        $data['por2'] = $this->catalogo_model->busca_ord_dias();
        $data['por3'] = $this->catalogo_model->busca_ord_dias();
        $data['por4'] = $this->catalogo_model->busca_ord_dias();
        $data['por5'] = $this->catalogo_model->busca_ord_dias();
        $data['tabla'] = $this->proceso_model_pedido->invd();
        $data['tabla1'] = $this->proceso_model_pedido->invd1();
        $data['contenido'] = "procesos_pedidos_formulados";
        $data['selector'] = "procesos";
        $data['sidebar'] = "sidebar_procesos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
  ///////////***********************************************/////////////   
   public function sumit_pedidos_formulados()
  {
    
     ini_set('memory_limit','5000M');
     set_time_limit(0);
     $this->load->model('proceso_model_pedido');
     $this->proceso_model_pedido->inserta_pedido_for(
     $this->input->post('por1'),
     $this->input->post('por2'),
     $this->input->post('por3'),
     $this->input->post('por4'),
     $this->input->post('por5'));
  die();
    redirect('procesos/index');
  }   
///////////***********************************************///////////// 

///////////***********************************************///////////// 

///////////***********************************************///////////// 
  function tabla_pedidos_formulados_una()
    {
         
        $this->load->model('catalogo_model');
		$data['por1'] = $this->catalogo_model->busca_ord_dias();
        $data['por2'] = $this->catalogo_model->busca_ord_dias();
        $data['por3'] = $this->catalogo_model->busca_ord_dias();
        $data['por4'] = $this->catalogo_model->busca_ord_dias();
        $data['por5'] = $this->catalogo_model->busca_ord_dias();
        $data['contenido'] = "procesos_pedidos_formulados_una";
        $data['selector'] = "procesos";
        $data['sidebar'] = "sidebar_procesos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
  ///////////***********************************************/////////////   
   public function sumit_pedidos_formulados_una()
  {
     ini_set('memory_limit','2000M');
     set_time_limit(0);
     $this->load->model('proceso_model_pedido');
     $this->proceso_model_pedido->inserta_pedido_for_una(
     $this->input->post('suc'),
     $this->input->post('por1'),
     $this->input->post('por2'),
     $this->input->post('por3'),
     $this->input->post('por4'),
     $this->input->post('por5'));
    redirect('procesos/index');
  }   
///////////***********************************************///////////// 
 
 
 function index_rev()
    {
        $data['titulo'] = 'REVISA PRENOMINA';
        $data['tabla'] = '';
        $data['contenido'] = "procesos_blanco";
        $data['selector'] = "procesos_rev";
        $data['sidebar'] = "sidebar_procesos_revisa";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }  
  
 ///////////***********************************************/////////////
 ///////////***********************************************///////////// 
    
  function tabla_prenomina_revisa()
    {
        $this->load->model('catalogo_model');
        $data['motivox'] = $this->catalogo_model->busca_clave();
        $data['titulo'] = 'REVISA PRENOMINA';
        $data['tabla'] = '';
        $data['contenido'] = "procesos_nomina_revisa";
        $data['selector'] = "procesos_rev";
        $data['sidebar'] = "sidebar_procesos_revisa";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///////////***********************************************/////////////   
///////////***********************************************/////////////   
             
 ///////////***********************************************/////////////   
   public function sumit_tabla_prenomina_revisa()
  {
        $fecha = $this->input->post('fecha');
        $motivo = $this->input->post('motivo');
        $this->load->model('revisa_model');
        $data['titulo'] = 'REVISA PRENOMINA';
        $data['tabla'] =$this->revisa_model->prenomina_revisa($fecha,$motivo);
        $data['contenido'] = "procesos";
        $data['selector'] = "procesos_rev";
        $data['sidebar'] = "sidebar_procesos_revisa";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
  }      
    
    
  ///////////***********************************************/////////////
 ///////////***********************************************///////////// 
    
  function tabla_plantilla_revisa()
    {
        $this->load->model('revisa_model');
        $data['titulo'] = 'REVISA PRENOMINA';
        $data['tabla'] =$this->revisa_model->plantilla_revisa();
        $data['contenido'] = "procesos";
        $data['selector'] = "procesos_rev";
        $data['sidebar'] = "sidebar_procesos_revisa";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///////////***********************************************/////////////   
///////////***********************************************/////////////   
             
 ///////////***********************************************/////////////   
   public function sumit_tabla_plantilla_revisa($suc,$sucx)
  {
        
        
        
          $this->load->model('catalogo_model');
		$sucx = $this->catalogo_model->busca_sucursal_todass($suc);
            $data['cabeza']= "
           <table>
           
           <tr>
           <td colspan=\"12\" align=\"center\"><strong>CIRCULAR</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"12\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')."<br /></td>
           </tr>
           
           
           </table> 
            ";
            $data['cabeza1']= "
           <table>
           
           <tr>
           <td colspan=\"12\" align=\"left\">Por medio del presente entrego relacion de plantilla de personal; solicitando mencione si tiene horario de entrada especial,
            es necesario registrar su huella digital si labora dentro del edificio.</td>
           </tr>
           <tr>
           <td colspan=\"12\" align=\"left\">Si alguna persona falta en la relacion; favor de agregarla.</td>
           </tr>
           
           
           
           </table> 
            ";
             $data['fin']= "
           <table>
           
           <tr>
           <td colspan=\"6\" align=\"CENTER\"><br /><br />ATENTAMENTE<br /><br /><br /><br /><br /></td>
           <td colspan=\"6\" align=\"CENTER\"><br /><br />GERENTE O JEFE DE AREA<br /><br /><br /><br /><br /></td>
           
           </tr>
           <tr>
           <td colspan=\"6\" align=\"CENTER\">Lic. Ignacio Soria Martinez</td>
           <td colspan=\"6\" align=\"CENTER\">_________________________________________</td>
           
           </tr>
           <tr>
           <td colspan=\"6\" align=\"CENTER\">Gerente de Recursos Humanos<br /><br /><br /><br /><br /></td>
           <td colspan=\"6\" align=\"CENTER\"><strong>".$sucx."</strong></td>
           
           </tr>
          
           
           </table> 
            ";
            $this->load->model('revisa_model');
            $data['detalle'] = $this->revisa_model->plantilla_revisa_detalle($suc);
             
            $this->load->view('impresiones/plantilla_memo', $data);
  }   
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
  public function concentrado_ped_sur()
    {
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['titulo']= 'GENERAR PROCESO DE PEDIDOS MENSUALES';
        $data['titulo1']= '';
        $data['tabla']= '';
        $data['contenido'] = "proceso_form_pedido_surtido";
        $data['selector'] = "procesos";
        $data['sidebar'] = "sidebar_procesos";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////    
  public function sutmit_genera_ped_sur()
  {
     ini_set('memory_limit','2000M');
     set_time_limit(0);
     $fec = $this->input->post('aaa')."-".str_pad($this->input->post('mes'),2,"0",STR_PAD_LEFT);
     $this->load->model('proceso_model');
     $this->proceso_model->almacen_ped_sur($fec);
    redirect('procesos/index');
  }   
///////////***********************************************/////////////   
    
    
 /////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_orden_cedis()
    {
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['diax'] = $this->catalogo_model->busca_anio();
        $data['titulo']= 'GENERAR PROCESO DE ORDEN DE COMPRA';
        $data['titulo1']= '';
        $data['tabla']= '';
        $data['contenido'] = "proceso_form_orden_cedis";
        $data['selector'] = "procesos";
        $data['sidebar'] = "sidebar_procesos";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///////////***********************************************///////////// 
///////////***********************************************///////////// 
///////////***********************************************/////////////     
  public function sutmit_orden_cedis()
  {
     ini_set('memory_limit','2000M');
     set_time_limit(0);
     if($this->input->post('pass') == 'unicoo'){
     $this->load->model('proceso_model_pedido');
     $this->proceso_model_pedido->previo_orden_cedis($this->input->post('aaa1'),$this->input->post('mes1'),$this->input->post('dia1'));
     }
    redirect('procesos/index');
  }   
///////////***********************************************/////////////  
///////////***********************************************///////////// 
///////////***********************************************///////////// 
///////////***********************************************/////////////   
 public function factura_nadro_e()
  {
    ini_set('memory_limit','2000M');
    set_time_limit(0);
     $this->load->model('envio_model_as400');
     $this->envio_model_as400->factura_nadro();
    redirect('procesos/index');
  }   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    function reporte_diario_submit()
    {
        $fecha1 = $this->input->post('fecha1');
        $fecha2 = $this->input->post('fecha2');
        
        $this->load->model('a_surtido_model');

        $data['cabeza'] = $this->a_surtido_model->reporte_diario_encabezado($fecha1, $fecha2);
        $data['detalle'] = $this->a_surtido_model->reporte_diario($fecha1, $fecha2);
        $data['detalle1'] = $this->a_surtido_model->reporte_diario_rutas($fecha1, $fecha2);
        $data['detalle_esp'] = $this->a_surtido_model->reporte_diario_esp($fecha1, $fecha2);
        $data['detalle_esp1'] = $this->a_surtido_model->reporte_diario_rutas_esp($fecha1, $fecha2);
        $data['detalle_total'] = $this->a_surtido_model->reporte_diario_total($fecha1, $fecha2);
        
        $this->load->view('impresiones/reporte_diario_captura', $data);
    }
    
    function formulario_completo1()
    {
      
        $data['contenido'] = "procesos_contenido1";
        $data['selector'] = "procesos";
        $data['sidebar'] = "sidebar_procesos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
 
 
 
 ////////////////////////////////////////////////////////////este procesos se correra anualmente
  function calculo_periodo_vacaciones()
    {
      $this->load->model('catalogo_model_ger');  
      $this->catalogo_model_ger->calculo_vacacion();
     }
 
 ////////////////////////////////////////////////////////////este procesos se correra anualmente

function editar_dia($suc)
    {
        $this->load->model('proceso_model_pedido');

        $data['contenido'] = 'editar_dia_suc';
        $data['selector'] = "procesos";
        $data['query'] = $this->proceso_model_pedido->editar_dia_suc($suc);
        $data['suc'] = $suc;
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
  
 function submit_p()
    {
        $suc = $this->input->post('suc');
        $dia = $this->input->post('dia');

        $this->load->model('proceso_model_pedido');
        $id = $this->proceso_model_pedido->editar_dia($dia, $suc);

        redirect('procesos/tabla_pedidos_formulados/' . $id);
    }   
   
      }