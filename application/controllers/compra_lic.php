<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Compra_lic extends CI_Controller
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
        $data['sidebar'] = "sidebar_compra_lic";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////genera campaña
     public function tabla_nueva()
    {
        
       $data['titulo']= 'Generar Licitacion';
        $this->load->model('compra_lic_model');
        $data['tabla'] =$this->compra_lic_model->compra_lic1();
        $data['contenido'] = "compra_lic_form_nuevo";
        $data['selector'] = "nacional";
        $data['sidebar'] = "sidebar_compra_lic";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
              
    
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
    public function agrega_nuevo()
    {
     $this->load->model('compra_lic_model');
     $this->compra_lic_model->nuevo($this->input->post('nombre'));
     
    redirect('compra_lic/tabla_nueva');
  }   
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////genera campaña
     public function seleccion_pro($id)
    {
        
       $tit= 'LICITACION';
        $this->load->model('compra_lic_model');
        $data['tabla'] =$this->compra_lic_model->general_seleccion($id,$tit);
        $data['contenido'] = "compra_lic_form_nuevo";
        $data['selector'] = "nacional";
        $data['sidebar'] = "sidebar_compra_lic";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
              
    
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////


















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