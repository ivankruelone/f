<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class A_gerente extends CI_Controller
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
        $data['mensaje']= '';
        $data['titulo']= '';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
        $data['contenido'] = "a_compra";
        $data['selector'] = "a_compra";
        $data['sidebar'] = "sidebar_a_gerente";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_orden()
    {
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();$data['tabla'] = '';
        $data['titulo']= 'ORDEN DE  COMPRA';
        $data['titulo1'] = "";
        $data['contenido'] = "a_gerente_form_orden";
        $data['selector'] = "a_compra";
        $data['sidebar'] = "sidebar_a_gerente";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_order1()
    {
        $this->load->model('a_gerente_model');
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($this->input->post('mes'));
		$tit= 'ORDENES DE COMPRA DE '.$mesx.' DEL '.$this->input->post('aaa');
        $data['tabla'] = $this->a_gerente_model->control_orden($this->input->post('aaa'),$this->input->post('mes'),$tit);
        $this->load->view('contenidos/a_gerente_orden_v', $data);   
    }
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_order_prv($aaa,$mes,$fol)
    {
        $this->load->model('a_gerente_model');
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
		$tit= 'ORDENES DE COMPRA DE '.$mesx.' DEL '.$aaa;
        $data['tabla'] = $this->a_gerente_model->control_orden_prv($aaa,$mes,$tit,$fol);
        $this->load->view('contenidos/a_gerente_orden_prv_v', $data);   
    }
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

     public function tabla_compraped_cedis_entrega()
    {
        $this->load->model('catalogo_model');
        $data['tipo']=$this->catalogo_model->busca_almacenes();
        $data['titulo'] = 'MERCANCIA ENTREGADA EN ALMACENES';
        $data['tabla'] = '';
        $data['contenido'] = "compras_form_fec_entrega";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_a_gerente";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
       
    public function index_inv()
    {
        $data['mensaje']= '';
        $data['titulo']= '';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
        $data['contenido'] = "a_compra";
        $data['selector'] = "a_compra";
        $data['sidebar'] = "sidebar_a_gerente_inv";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


     public function tabla_inventario()
    {
        $this->load->model('catalogo_model');
        $data['tipo']=$this->catalogo_model->busca_almacenes_locales();
        $data['titulo'] = 'MERCANCIA ENTREGADA EN ALMACENES';
        $data['tabla'] = '';
        $data['contenido'] = "a_inv_form_fecha";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_a_gerente_inv";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_inv_almacen()
    {
        $this->load->model('a_gerente_model');
        $fec1=$this->input->post('fec1');
        $fec2=$this->input->post('fec2');
        $tipo=$this->input->post('tipo');
        $tit = 'ENTREGA DE MERCANCIA DE PROVEEDORES';
        $data['tabla'] = $this->a_gerente_model->inv_almacen_cedis($tipo,$fec1,$fec2,$tit); 
        $this->load->view('contenidos/viu_12', $data);    
        
       
       
    }
////////////////////////////////////////////////////////////////////////////////////////////////////

function reporte_excedente()
    {
        $data['titulo'] = "Reporte Diario";
        $data['titulo1'] = "";
        $data['contenido'] = "reporte_excedente";
        $data['selector'] = "a_devolucion";
        $data['sidebar'] = "sidebar_a_gerente_inv";
        $this->load->model('catalogo_model');
       $data['motivox'] = $this->catalogo_model->busca_motivo();
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
////////////////////////////////////////////////////////////////////////////////////////////////////

function reporte_excedente_suc()
    {
        $data['titulo'] = "Reporte Diario";
        $data['titulo1'] = "";
        $data['contenido'] = "reporte_excedente_suc";
        $data['selector'] = "a_devolucion";
        $data['sidebar'] = "sidebar_a_gerente_inv";
        $this->load->model('catalogo_model');
       $data['motivox'] = $this->catalogo_model->busca_motivo();
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     public function reporte_excedente_submit()
    {
        $this->load->model('a_gerente_model');
        
        $tit = ' DEVOLUCIONES GENERADAS DEL '.$this->input->post('fec1').' A '.$this->input->post('fec2');
        $data['tabla'] = $this->a_gerente_model->reporte_devolucion_suc(
        $tit,
        $this->input->post('fec1'),
        $this->input->post('fec2'),
        $this->input->post('motivo')); 
        $this->load->view('contenidos/viu_6', $data);
     }
     public function a_detalle($fec1,$fec2,$mot,$suc)
    {
        $this->load->model('a_gerente_model');
        
        $tit = ' DEVOLUCIONES GENERADAS DEL '.$fec1.' A '.$fec2;
        $data['tabla'] = $this->a_gerente_model->reporte_devolucion_suc_det($tit,$fec1,$fec2,$mot,$suc); 
        $this->load->view('contenidos/viu_6', $data);
     }    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_inv_farma()
    {
        $this->load->model('a_gerente_model');
        $tit = 'INVENTARIO DE FARMABODEGA';
        $data['tabla'] = $this->a_gerente_model->inv_almacen_farmabodega($tit); 
        $this->load->view('contenidos/viu_5', $data);    
        
       
       
    }    




















function busca_orden()
	{
	$this->load->model('a_compra_model');
    $validacion1 = $this->a_compra_model->busca_orden_compra($this->input->post('orden'));
    
    $query = $this->a_compra_model->busca_orden_claves($this->input->post('orden'));
    
    if($validacion1 > 0)
    {
        if($query->num_rows() > 0){
            
            $data['query'] = $query->result();
            $data['orden'] = $this->input->post('orden');
            $data['fac'] = $this->input->post('fac');
            $this->load->view('contenidos/a_compra_res_busca_orden', $data);
            
        }else{
            echo '<h2>Esta orden de compra ya fue cerrada en su totalidad.</h2>';
        }
        
    }else{
        
        echo '<h2>Esta orden de compra no existe.</h2>';
    }
    
    
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agrega_ctl($orden,$fac)
    {
   
        $this->load->model('a_compra_model');
        $id_cc = $this->a_compra_model->agrega_member_ctl($orden,$fac);
        redirect('a_compra/tabla_detalle/'.$id_cc);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_detalle($id_cc)
    {
      
        $this->load->model('catalogo_model');
        $this->load->model('a_compra_model');
        $query =$this->a_compra_model->busca_folio($id_cc);
        if($query->num_rows() >0){
		$row=$query->row();
       
        }
        $data['titulo1'] = "";    
       
        $data['id_cc'] =$id_cc;
        $data['orden'] =$row->orden;
        $data['tabla'] = $this->a_compra_model->detalle_cap($id_cc);
        $data['titulo'] = "MERCANCIA DE LA FACTUA $row->fac ORDEN $row->orden";
        
        $data['contenido'] = "a_compra_form_captura";
        $data['selector'] = "a_compra";
        $data['sidebar'] = "sidebar_a_compra";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agrega_detalle()
    {
       
        $orden= $this->input->post('orden');
        $id_cc= $this->input->post('id_cc');
        $cod= $this->input->post('cod');
        $can= $this->input->post('can');
        $canr= $this->input->post('canr');
        $lote= $this->input->post('lote');
        $cadu= $this->input->post('cadu');
        $pub=0;
       $this->load->model('a_compra_model');
       $this->a_compra_model->insert_member_detalle($orden,$cod,$can,$canr,$lote,$cadu,$id_cc,$pub);
        
        redirect('a_compra/tabla_detalle/'.$id_cc);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function borra_detalle($id,$id_cc)
    {
       $this->load->model('a_compra_model');
       $this->a_compra_model->delete_member_detalle($id);
       redirect('a_compra/tabla_detalle/'.$id_cc);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function borrar_compra_ctl($id_cc)
    {
    $this->load->model('a_compra_model');
    $this->a_compra_model->delete_member_ctl($id_cc);
    redirect('a_compra/tabla_control');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function cerrar()
    {
     $id_cc= $this->input->post('id_cc');
      $this->load->model('a_compra_model');
     $this->a_compra_model->cerrar_member_compra($id_cc);
     redirect('a_compra/tabla_control');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_his()
    {
        $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('a_compra_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->a_compra_model->control_his();
        
        $data['titulo'] = "FACTURAS RECIBIDAS";
        $data['titulo1'] = "";
        $data['contenido'] = "a_compra";
        $data['selector'] = "a_compra";
        $data['sidebar'] = "sidebar_a_compra";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
    function imprime_compra($id_cc)
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
          
          
          $data['cabeza']='';
          $this->load->model('a_compra_model');
          $query =$this->a_compra_model->busca_folio($id_cc);
          if($query->num_rows() >0){
	      $row=$query->row();
          }
            
         
      $data['cabeza'].= "
      <table>
           
    <tr>
    <td colspan=\"5\" align=\"center\"><font size=\"+5\"><strong>RECIBA DE MERCANCIA<BR /></strong></font></td>
    </tr>
    <tr>
    <td colspan=\"5\" align=\"center\"><font size=\"+5\"><strong>ORDEN $row->orden    FACTURA $row->fac   FOLIO DE CXP $row->cxp<BR /></strong></font></td>
    </tr>
    <tr>
    <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
    </tr>
    
            <tr>
           <th width=\"40\" align=\"center\"><strong>SEC</strong></th>
           <th width=\"430\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
           <th width=\"70\" align=\"right\"><strong>LOTE</strong></th>
           <th width=\"70\" align=\"center\"><strong>CADUCIDAD</strong></th>
           <th width=\"70\" align=\"center\"><strong>PIEZAS</strong></th>
          </tr>
   </table> 
            ";
            $data['id_cc']=$id_cc;
            $this->load->view('impresiones/a_compra_det', $data);
            
		}      
        

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function imprime_compra_producto()
    {
        $this->load->model('a_compra_model');
        $data['tabla'] = '';
        $data['fec'] = date('Y-m-d');
        $data['titulo']= 'REPORTE DE PRODUCTOS CAPTURADOS EN FACTURAS';
        $data['titulo1'] = "";
        $data['contenido'] = "a_compra_form_fecha_pro";
        $data['selector'] = "a_compra";
        $data['sidebar'] = "sidebar_a_compra";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function imprime_compra_producto_ya()
    {
	     $fec= $this->input->post('fec');
        
           $data['cabeza']='';
          $this->load->model('a_compra_model');
          
      $data['cabeza'].= "
      <table>
           
    <tr>
    <td colspan=\"5\" align=\"center\"><font size=\"+5\"><strong>RECIBA DE MERCANCIA<BR /></strong></font></td>
    </tr>
    
    <tr>
    <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
    </tr>
    
            <tr>
           <th width=\"40\" align=\"center\"><strong>SEC</strong></th>
           <th width=\"300\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
           <th width=\"80\" align=\"right\"><strong>LOTE</strong></th>
           <th width=\"70\" align=\"center\"><strong>CADUCIDAD</strong></th>
           <th width=\"70\" align=\"center\"><strong>PIEZAS</strong></th>
            <th width=\"70\" align=\"center\"><strong>REGALADAS</strong></th>
          </tr>
   </table> 
            ";
            $data['fec']=$fec;
            $this->load->view('impresiones/a_compra_det_pro', $data);
            
		}      
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function imprime_compra_factura()
    {
        $this->load->model('a_compra_model');
        $data['tabla'] = '';
        $data['fec'] = date('Y-m-d');
        $data['titulo']= 'REPORTE DE FACTURAS';
        $data['titulo1'] = "";
        $data['contenido'] = "a_compra_form_fecha_ctl";
        $data['selector'] = "a_compra";
        $data['sidebar'] = "sidebar_a_compra";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
       
/////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function imprime_compra_factura_ya()
    {
   	     $fec= $this->input->post('fec'); 
          
          $data['cabeza']='';
          $this->load->model('a_compra_model');
          
      $data['cabeza'].= "
      <table>
           
    <tr>
    <td colspan=\"5\" align=\"center\"><font size=\"+5\"><strong>RECIBA DE MERCANCIA<BR /></strong></font></td>
    </tr>
    
    <tr>
    <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
    </tr>
    
            <tr>
           <th width=\"40\" align=\"center\"><strong>#</strong></th>
           <th width=\"300\" align=\"left\"><strong>PROVEEDOR</strong></th>
           <th width=\"80\" align=\"right\"><strong>FACTURA</strong></th>
           <th width=\"80\" align=\"center\"><strong>ORDEN</strong></th>
           <th width=\"80\" align=\"center\"><strong>CXP</strong></th>
           <th width=\"100\" align=\"center\"><strong>USUARIO</strong></th>
           
          </tr>
   </table> 
            ";
            $data['fec']=$fec;
            $this->load->view('impresiones/a_compra_det_fac', $data);
            
		}      
        

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_patente()
    {
        $this->load->model('a_compra_model');
        $data['tabla'] = $this->a_compra_model->control_patente();
        $data['titulo']= 'RECIBA DE MERCANCIA DE MEDICAMENTO DE PATENTE';
        $data['titulo1'] = "";
        $data['contenido'] = "a_compra_form_suc_patente";
        $data['selector'] = "a_compra";
        $data['sidebar'] = "sidebar_a_compra";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agrega_ctl_patente()
    {
        $prv = $this->input->post('prv');
        $fac = $this->input->post('fac');
        
        $this->load->model('a_compra_model');
        $id_cc = $this->a_compra_model->agrega_member_ctl_patente($fac,$prv);
        redirect('a_compra/tabla_detalle_patente/'.$id_cc);
    }


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_detalle_patente($id_cc)
    {
      
        $this->load->model('catalogo_model');
        $this->load->model('a_compra_model');
        $query =$this->a_compra_model->busca_folio($id_cc);
        if($query->num_rows() >0){
		$row=$query->row();
       
        }
        $data['titulo1'] = "";    
       
        $data['id_cc'] =$id_cc;
        $data['orden'] =$row->orden;
        $data['tabla'] = $this->a_compra_model->detalle_cap_patente($id_cc);
        $data['titulo'] = "MERCANCIA DE LA FACTURA $row->fac ORDEN $row->orden";
        
        $data['contenido'] = "a_compra_form_captura_patente";
        $data['selector'] = "a_compra";
        $data['sidebar'] = "sidebar_a_compra";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agrega_detalle_patente()
    {
        $id_cc= $this->input->post('id_cc');
        $sec= $this->input->post('sec');
        $cod= 0;
        $pub= 0;
        $can= $this->input->post('can');
        $canr= $this->input->post('canr');
        $lote= 'ZZZ';
        $cadu= '9999-12-31';
       $this->load->model('a_compra_model');
       //if($sec>=8000 and $sec<=8999){
       $this->a_compra_model->insert_member_detalle_patente($sec,$can,$canr,$lote,$cadu,$id_cc,$cod,$pub);
       //} 
        redirect('a_compra/tabla_detalle_patente/'.$id_cc);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function borra_detalle_patente($id,$id_cc)
    {
       $this->load->model('a_compra_model');
       $this->a_compra_model->delete_member_detalle($id);
       redirect('a_compra/tabla_detalle_patente/'.$id_cc);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function borrar_compra_ctl_patente($id_cc)
    {
    $this->load->model('a_compra_model');
    $this->a_compra_model->delete_member_ctl($id_cc);
    redirect('a_compra/tabla_control_patente');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function cerrar_patente()
    {
     $id_cc= $this->input->post('id_cc');
      $this->load->model('a_compra_model');
     $this->a_compra_model->cerrar_member_compra_patente($id_cc);
     redirect('a_compra/tabla_control');
    }    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function reporte_puntualidad()
    {
        $this->load->model('checador_model');
        $data['contenido'] = "formulario_quince1";
        $data['selector'] = "reportes";
        $data['sidebar'] = "sidebar_rep_moronatti";
        $data['quincenas'] = $this->checador_model->get_quincenas();

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }










    
      }