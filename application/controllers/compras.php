<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Compras extends CI_Controller
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
        $data['titulo'] = '';
        $data['tabla'] = 'BUENOS DIAS A TODO EL PERSONAL<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_cat";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }
 /////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
      public function index_d()
    {
        $data['titulo'] = '';
        $data['tabla'] = 'BUENOS DIAS A TODO EL PERSONAL<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_des";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////genera campaña
     public function tabla_desplaza_gral()
    {
        
        $data['mensaje']= '';
        $data['titulo']= 'Maximo generado por producto';
        $data['var']='0';
        $this->load->model('direccion_model');
		$data['tabla'] = '';
        $data['contenido'] = "nacional_form_pedidos_ger_for_gral";
        $data['selector'] = "nacional";
        $data['sidebar'] = "sidebar_compra_des";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
              
    
    }
     /////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   

 
     public function tabla_cat_generico()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'CATALOGO DE PRODUCTOS GENERICOS Y DOCTOR DESCUENTO';
        $data['tabla'] = $this->compras_model->cat_generico();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_cat";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
 
     public function tabla_cat_fenix()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'CATALOGO DE PRODUCTOS FENIX';
        $data['tabla'] = $this->compras_model->cat_fenix();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_cat";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
 
     public function tabla_cat_suc()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'CATALOGO DE SUCURSALES';
        $data['tabla'] = $this->compras_model->cat_suc();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_cat";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_cat_nat()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'CATALOGO DE PRODUCTOS NATURISTAS';
        $data['tabla'] = $this->compras_model->cat_nat();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_cat";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function index_ped()
    {
        $data['titulo'] = '';
        $data['tabla'] = 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ped";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

     public function tabla_ped_fec_ceros()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'PEDIDOS FORMULADOS';
        $data['tabla'] = '';
        $data['contenido'] = "compras_form_fec_ceros";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ped";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_ped_formulados_ceros()
    {
        $fec1=$this->input->post('fec1');
        $fec2=$this->input->post('fec2');
        $this->load->model('compras_model');
        $data['titulo'] = 'PEDIDOS FORMULADOS';
        $data['tabla'] = $this->compras_model->ped_formulado_ceros($fec1,$fec2);
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ped";

       
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_ped_formulados_ceros_suc($fec1,$fec2)
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'PEDIDOS FORMULADOS';
        $data['tabla'] = $this->compras_model->ped_formulado_ceros_suc($fec1,$fec2);
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ped";

       
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_ped_formulados_ceros_suc_una($fec1,$fec2,$suc)
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'PEDIDOS FORMULADOS';
        $data['tabla'] = $this->compras_model->ped_formulado_ceros_suc_una($fec1,$fec2,$suc);
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ped";

       
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_ped_formulados_ceros_exporta($fec1,$fec2)
    {
ini_set('memory_limit','2000M');
    set_time_limit(0);
	    $this->load->model('compras_model');
        $data['titulo'] = 'PEDIDOS FORMULADOS';
        $data['tabla'] = $this->compras_model->ped_formulado_ceros_exporta($fec1,$fec2);
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ped";

       
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

     public function tabla_ped_fec_exc()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'PEDIDOS FORMULADOS';
        $data['tabla'] = '';
        $data['contenido'] = "compras_form_fec_exc";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ped";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_ped_formulados_exc()
    {
        $fec=$this->input->post('fec1');
        $this->load->model('compras_model');
        $data['titulo'] = 'PEDIDOS FORMULADOS';
        $data['tabla'] = $this->compras_model->ped_formulado_exc($fec);
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ped";

       
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

     public function tabla_ped_fec_todo()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'PEDIDOS FORMULADOS';
        $data['tabla'] = '';
        $data['contenido'] = "compras_form_fec_todo";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ped";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_ped_formulados_todo()
    {
        $fec=$this->input->post('fec1');
        $this->load->model('compras_model');
        $data['titulo'] = 'PEDIDOS FORMULADOS';
        $data['tabla'] = $this->compras_model->ped_formulado_todo($fec);
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ped";

       
    }
 /////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////genera la orden de compra
    public function index_ord()
    {
        $data['titulo'] = '';
        $data['tabla'] = 'BUENOS DIAS A TODO EL PERSONAL<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ord";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_orden_cedis()
    {
        $this->load->model('catalogo_model');
		$data['mesx1'] = $this->catalogo_model->busca_mes();
        $data['aaax1'] = $this->catalogo_model->busca_anio();
        //$data['mesx2'] = $this->catalogo_model->busca_mes();
        //$data['aaa2'] = (date('Y')-1);
        $data['por1'] = $this->catalogo_model->busca_ord_dias();
        $data['por2'] = $this->catalogo_model->busca_ord_dias();
        $data['por3'] = $this->catalogo_model->busca_ord_dias();
        $data['por4'] = $this->catalogo_model->busca_ord_dias();
        $data['por5'] = $this->catalogo_model->busca_ord_dias();
         $this->load->model('compras_model');
        $data['tabla'] = $this->compras_model->pre_orden_cedis_pediente();
        $data['titulo']= 'GENERAR PROCESO DE ORDEN DE COMPRA';
        $data['titulo1']= '';
       
        $data['contenido'] = "compra_form_orden_cedis";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ord";
              
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
     $this->load->model('compras_model');
     $this->compras_model->previo_orden_cedis(
     $this->input->post('aaa1'),$this->input->post('mes1'),$this->input->post('dia1'),
     $this->input->post('por1'),$this->input->post('por2'),$this->input->post('por3'),
     $this->input->post('por4'),$this->input->post('por5'));
     }
    redirect('compras/tabla_orden_cedis');
  }   
///////////***********************************************/////////////  
///////////***********************************************///////////// 
   public function tabla_orden_cedis_previo()
    {
        $data['titulo'] = 'PRE ORDEN DE COMPRA';
         $this->load->model('compras_model');
        $data['tabla'] = $this->compras_model->pre_orden_cedis();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ord";

       
   }
///////////***********************************************/////////////
///////////***********************************************///////////// 
     
  public function tabla_ord_bor($fecha)
  {
    
     $this->load->model('compras_model');
     $this->compras_model->delete_orr_cedis_pre($fecha);
    
    redirect('compras/tabla_orden_cedis');
  }   
///////////***********************************************/////////////  
///////////***********************************************/////////////
  public function tabla_orden_cedis_previo_g($fecha)
  {
    
     $this->load->model('compras_model');
     $this->compras_model->genera_pre_orden($fecha);
    
    redirect('compras/tabla_orden_cedis');
  }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_compraped_cedis()
    {
        $this->load->model('catalogo_model');
		$this->load->model('compras_model');
        $data['tabla'] = $this->compras_model->compraped_cedis();
        $data['titulo']= 'ORDEN DE COMPRA';
        $data['titulo1']= '';
       
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ord";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///////////***********************************************///////////// 
///////////***********************************************/////////////   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_compraped_det($nped)
    {
        $this->load->model('catalogo_model');
		$this->load->model('compras_model');
        $data['tabla'] = $this->compras_model->compraped_cedis_det($nped);
        $data['titulo']= 'ORDEN DE COMPRA QUE NO HAN <BR />TRABAJADO LOS COMPRADORES';

        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ord";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_compraped_det_prv($nped,$prv)
    {
        $this->load->model('catalogo_model');
		$this->load->model('compras_model');
        $data['tabla'] = $this->compras_model->compraped_cedis_det_prv($nped,$prv);
        $data['titulo']= 'ORDEN DE COMPRA QUE NO HAN <BR />TRABAJADO LOS COMPRADORES';

        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ord";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

     public function tabla_ord_fec()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'PEDIDOS FORMULADOS';
        $data['tabla'] = '';
        $data['contenido'] = "compras_form_fec_ord";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ord";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_ord_formulados()
    {
        $fec=$this->input->post('fec1');
        $this->load->model('compras_model');
        $data['titulo'] = 'PEDIDOS FORMULADOS';
        $data['tabla'] = $this->compras_model->ord_formulado($fec);
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ord";
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
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

     public function tabla_compraped_cedis_entrega()
    {
        $this->load->model('catalogo_model');
        $data['tipo']=$this->catalogo_model->busca_almacenes();
        $data['titulo'] = 'MERCANCIA ENTREGADA EN CEDIS';
        $data['tabla'] = '';
        $data['contenido'] = "compras_form_fec_entrega";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ord";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_compraped_cedis_entrega_ya()
    {
        $fec1=$this->input->post('fec1');
        $fec2=$this->input->post('fec2');
        $tipo=$this->input->post('tipo');
        $this->load->model('compras_model');
        $tit = 'ENTREGA DE MERCANCIA DE PROVEEDORES';
        if($tipo=='alm'){
        $data['tabla'] = $this->compras_model->compraped_entrega($tipo,$fec1,$fec2,$tit);    
        $this->load->view('contenidos/compras_orden', $data);
        }else{
        $data['tabla'] = $this->compras_model->compraped_entrega_segpop($tipo,$fec1,$fec2,$tit);
        $this->load->view('contenidos/compras_orden_segpop', $data);    
        }
         
       
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_compraped_detprv($prv,$fec1,$fec2,$tipo)
    {
        $this->load->model('compras_model');
        
        $tit = 'ENTREGA DE MERCANCIA DE PROVEEDORES';
        if($tipo=='alm'){
        $data['tabla'] = $this->compras_model->compraped_entrega_prv_detalle($prv,$tipo,$fec1,$fec2,$tit); 
        $this->load->view('contenidos/viu_15', $data);    
        }else{
        $data['tabla'] = $this->compras_model->compraped_entrega_segpop_prv($prv,$tipo,$fec1,$fec2,$tit);
        $this->load->view('contenidos/viu_10', $data);     
        }
        
       
       
    }    
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////pagos
    public function tabla_pagos_pendiente()
    {
        $this->load->model('compras_model');
        $data['titulo'] = '';
        $data['tabla'] = $this->compras_model->pagos_pendientes();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ord";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////pagos
    public function tabla_pagos_pendiente_prv($prv)
    {
        $this->load->model('compras_model');
        $this->load->model('catalogo_model');
        $data['titulo'] = $this->catalogo_model->busca_prv_uno($prv);
        $data['tabla'] = $this->compras_model->pagos_pendientes_prv($prv);
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ord";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////pagos
    public function pre_pagos_pendiente_factura($prv,$id)
    {
        $this->load->model('compras_model');
        $this->load->model('catalogo_model');
        $tit = $this->catalogo_model->busca_prv_uno($prv);
        $data['tabla'] = $this->compras_model->pagos_pendientes_prv_factura($prv,$id,$tit);
        $this->load->view('contenidos/viu_6', $data);  
        
   }    
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////pagos
    
  function actualiza_status()
    {
        $data = array('aplica' => $this->input->post('valor'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('pagos_cheque', $data);
    }
 /////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////pagos
   
 public function pre_pagos_pendiente($prv)
    {
        $this->load->model('catalogo_model');
        $data['titulo'] = $this->catalogo_model->busca_prv_uno($prv);
        $data['prv'] = $prv;
        $data['contenido'] = "compras_form_prepago";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ord";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////pagos
     function pre_pagos_pendiente_aplica()
    {
        $this->load->model('compras_model');
        $id_cc = $this->compras_model->agrega_pago($this->input->post('prv'),$this->input->post('fec1'));
        redirect('compras/tabla_pagos_pendiente');   
    }     
    
 
/////////////////////////////////////////////////////////////////////////////////////////////////pagos
    public function tabla_pagos()
    {
        $this->load->model('compras_model');
        $data['titulo'] = '';
        $data['tabla'] = '';
        $data['contenido'] = "compras_form_pago";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_ord";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }
/////////////////////////////////////////////////////////////////////////////////////////////////pagos
    public function tabla_pagos_imp()
    {
        $fec=$this->input->post('fec1');
        
        $data['cabeza']= "
      <table>
           
    <tr>
    <td colspan=\"5\" align=\"center\"><font size=\"+5\"><strong>CHEQUES PARA PAGO $fec <BR /></strong></font></td>
    </tr>
    
    <tr>
    <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
    </tr>
   </table> 
            ";
            $data['fec']=$fec;
            $this->load->view('impresiones/compra_pagos', $data);

        
   }
/////////////////////////////////////////////////////////////////////////////////////////////inventariosSS
/////////////////////////////////////////////////////////////////////////////////////////////////

       
   

       public function index_inv()
    {
        $data['titulo'] = '';
        $data['tabla'] = 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_inv";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
 
     public function tabla_inv_cedis()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'INVENTARIO DE ALMACEN CEDIS';
        $data['tabla'] = $this->compras_model->inv_cedis();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_inv";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
     public function tabla_inv_farmabodega()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'INVENTARIO DE FARMABODEGA';
        $data['tabla'] = $this->compras_model->inv_farmabodega();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_inv";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
 
     public function tabla_inv_segpop()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'INVENTARIO DE SEGUROS POPULARES Y PREVIO DE PEDIDOS';
        $data['tabla'] = $this->compras_model->inv_segpop();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_inv";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
 
     public function tabla_inv_genddr()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'INVENTARIO DE SUCURSALES GENERICAS Y DOCTOR DESCUENTO';
        $data['tabla'] = $this->compras_model->inv_genddr();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_inv";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
 
     public function tabla_inv_segpop_d($tipo,$folio)
    {
        if($tipo=='zac'){$tipox='ZACATECAS';}
         if($tipo=='ver'){$tipox='VERACRUZ';}
         if($tipo=='cht'){$tipox='CHETUMAL';}
         if($tipo=='con'){$tipox='CONTROLADOS';}
         if($tipo=='agu'){$tipox='AGUASCALIENTES';}
        $this->load->model('compras_model');
        $data['titulo'] = 'INVENTARIO DE SEGUROS POPULARES Y PREVIO DE PEDIDOS '.$tipox;
        $data['tabla'] = $this->compras_model->inv_segpop_d($tipo,$folio);
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_inv";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////inventariosSS
       
   

       public function index_des()
    {
        $data['titulo'] = '';
        $data['tabla'] = 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_des";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
 
     public function tabla_des_genddr()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'DESPLAZAMIENTO DE SUCURSALES GEN Y DDR';
        $data['tabla'] = $this->compras_model->des_genddr();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_des";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

 /////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
    
     public function tabla_des_genddr_pesos()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'DESPLAZAMIENTO DE SUCURSALES GEN Y DDR IMPORTE';
        $data['tabla'] = $this->compras_model->des_genddr_pesos();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_des";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
 
     public function tabla_des_fenix()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'DESPLAZAMIENTO DE SUCURSALES FENIX';
        $data['tabla'] = $this->compras_model->des_fenix();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_des";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
 
     public function tabla_des_fenix_pesos()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'DESPLAZAMIENTO DE SUCURSALES FENIX';
        $data['tabla'] = $this->compras_model->des_fenix_pesos();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_des";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
       
   

       public function index_com()
    {
        $data['titulo'] = '';
        $data['tabla'] = 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_com";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
 
     public function tabla_des_genddr_compra()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'DESPLAZAMIENTO DE SUCURSALES GEN Y DDR';
        $data['tabla'] = $this->compras_model->des_genddr_compra_cedis();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_com";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

       public function index_fal()
    {
        $data['titulo'] = '';
        $data['tabla'] = 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_fal";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }


 /////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
 
     public function tabla_fal_sec()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'FALTANTES DE SUCURSALES GEN Y DDR';
        $data['tabla'] = $this->compras_model->fal_sec();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_fal";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');

       
    }
 /////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////genera campaña
    public function index_cam()
    {
        $data['titulo'] = '';
        $data['tabla'] = 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_campana";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////genera campaña
    public function tabla_cat_campa()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'SUCURSALES DE CAMPA&Ntilde;A';
        $data['tabla'] = $this->compras_model->control_suc_cam();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_campana";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////genera campaña
    public function tabla_cat_campa_todo()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'SUCURSALES DE CAMPA&Ntilde;A';
        $data['tabla'] = $this->compras_model->control_suc_cam_tod();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_campana";
   }
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////genera campaña
    public function tabla_cat_campa_una($suc)
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'SUCURSALES DE CAMPA&Ntilde;A';
        $data['tabla'] = $this->compras_model->control_suc_cam_una($suc);
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_campana";
   }

////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////genera campaña
    public function tabla_cat_campa_ab()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'SUCURSALES DE CAMPA&Ntilde;A';
        $data['tabla'] = $this->compras_model->control_suc_cam_ab();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_campana";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////genera campaña
    public function tabla_cat_campa_todo_ab()
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'SUCURSALES DE CAMPA&Ntilde;A';
        $data['tabla'] = $this->compras_model->control_suc_cam_tod_ab();
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_campana";
   }
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////genera campaña
    public function tabla_cat_campa_una_ab($suc)
    {
        $this->load->model('compras_model');
        $data['titulo'] = 'SUCURSALES DE CAMPA&Ntilde;A';
        $data['tabla'] = $this->compras_model->control_suc_cam_una_ab($suc);
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_campana";
   }

////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
      public function index_lote()
    {
        $data['titulo1'] = 'BUSCAR ORDEN';
        $data['titulo'] = '';
        $data['tabla'] = '';
        $data['contenido'] = "compra_form_orden";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_compra_lote";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////genera campaña
    public function orden_lote()
    {
        $orden=$this->input->post('orden');
        $this->load->model('compras_model');
        $titulo = ' ORDEN '. $orden;
        $data['tabla'] = $this->compras_model->orden_lote_detal($orden,$titulo);
         $this->load->view('contenidos/viu_13', $data);  
        
   }
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////genera campaña
    public function orden_lote_suc($sec,$lote,$fecha)
    {
        $orden=$this->input->post('orden');
        $this->load->model('compras_model');
        $titulo = ' ORDEN '. $orden;
        $data['tabla'] = $this->compras_model->orden_lote_detal_suc($sec,$lote,$fecha,$titulo);
         $this->load->view('contenidos/viu_6', $data);  
        
   }
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////genera campaña
////////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_inv_cedis_lote()
    {
        $this->load->model('compras_model');
        $titulo= 'INVENTARIO DE ALMACEN CEDIS';
        $data['tabla'] = $this->compras_model->inv_cedis_lote($titulo);
        $this->load->view('contenidos/viu_7', $data);  
        
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
 

























































       


/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////recarga telefonica
     
  

////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////



























///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////7    
/////////////////////////////////////////////////////////////////////////////////////////////

    
    
      }