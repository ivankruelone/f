<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class A_devolucion extends CI_Controller
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
        $data['mensaje']= '';
        $data['titulo']= 'DEVOLUCION DE MERCANCIA';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "a_devolucion";
        $data['selector'] = "a_devolucion";
        $data['sidebar'] = "sidebar_a_devolucion";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
 /////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia

/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control()
    {
        $this->load->model('catalogo_model');
        $data['sucx'] = $this->catalogo_model->busca_sucursal_almacen();
        $data['movx'] = $this->catalogo_model->busca_mov_devolucion();
          
        $this->load->model('a_devolucion_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->a_devolucion_model->control();
        $data['tipo']=' ';
        $data['titulo']= 'DEVOLUCION DE MERCANCIA';
        $data['titulo1'] = "";
        $data['contenido'] = "a_devolucion_form_suc";
        $data['selector'] = "a_devolucion";
        $data['sidebar'] = "sidebar_a_devolucion";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agrega_ctl()
    {
        $suc= $this->input->post('suc');
        $tipo= $this->input->post('tipo');
        $rrm= $this->input->post('rrm');
        $mov= $this->input->post('mov');
        $this->load->model('a_devolucion_model');
        $id_cc = $this->a_devolucion_model->agrega_member_ctl($suc,$tipo,$mov,$rrm);
        redirect('a_devolucion/tabla_detalle/'.$id_cc);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function modificar_ctl($id_cc)
    {
        $this->load->model('catalogo_model');
        $this->load->model('a_devolucion_model');
        $query =$this->a_devolucion_model->busca_folio($id_cc);
        if($query->num_rows() >0){
		$row=$query->row();
        $tipo=$row->tipo;
        $mov=$row->mov;
        $suc=$row->suc;
        $rrm=$row->rrm;
        
        }
        $sucx =$this->catalogo_model->busca_suc_unica($suc);
        $movx =$this->catalogo_model->busca_mov_devolucion_una($mov);
        if($tipo=='E'){
        $data['titulo1'] = "ENTRA A CEDIS Y SALE DE $sucx <br /> $movx";
        }elseif($tipo=='S'){
        $data['titulo1'] = "SALE CEDIS y ENTRA a $sucx  <br /> $movx";    
        }
        $data['contenido'] = "a_devolucion_form_suc_mod";
        $data['fol'] =$id_cc;
        $data['tipo'] =$tipo;
        $data['mov'] =$mov;
        $data['rrm'] =$rrm;
        $data['tabla'] = '';
        $data['titulo'] = "DEVOLUCION DE MERCANCIA DEL FOLIO $id_cc";
        
        
        $data['selector'] = "a_devolucion";
        $data['sidebar'] = "sidebar_a_devolucion";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_detalle($id_cc)
    {
        $this->load->model('catalogo_model');
        $this->load->model('a_devolucion_model');
        $query =$this->a_devolucion_model->busca_folio($id_cc);
        if($query->num_rows() >0){
		$row=$query->row();
        $tipo=$row->tipo;
        $mov=$row->mov;
        $suc=$row->suc;
               
        }
        $sucx =$this->catalogo_model->busca_suc_unica($suc);
        $movx =$this->catalogo_model->busca_mov_devolucion_una($mov);
        if($tipo=='E'){
        $data['titulo1'] = "ENTRA A CEDIS Y SALE DE $sucx <br /> $movx";
        $data['contenido'] = "a_devolucion_form_captura_en";    
        }elseif($tipo=='S'){
        $data['titulo1'] = "SALE CEDIS y ENTRA a $sucx  <br /> $movx";    
        $data['contenido'] = "a_devolucion_form_captura";
        }
        $data['fol'] =$id_cc;
        $data['tipo'] =$tipo;
        $data['mov'] =$mov;
        $data['tabla'] = $this->a_devolucion_model->detalle_cap($id_cc);
        $data['titulo'] = "DEVOLUCION DE MERCANCIA DEL FOLIO $id_cc";
        
        
        $data['selector'] = "a_devolucion";
        $data['sidebar'] = "sidebar_a_devolucion";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function busca_pro()
	{
	$this->load->model('a_devolucion_model');
    //echo $this->a_inv_model->busca_lotess($sec);
    echo $this->a_devolucion_model->busca_cod($this->input->post('cod'));
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function cambia_ctl()
    {
         $fol= $this->input->post('fol');
         $rrm= $this->input->post('rrm');
         
       $this->load->model('a_devolucion_model');
       $this->a_devolucion_model->cambia_member_ctl($fol,$rrm);
        
        redirect('a_devolucion/tabla_control');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agrega_detalle()
    {
        $tipo= $this->input->post('tipo');
        $fol= $this->input->post('fol');
        $cod= $this->input->post('cod');
        $can= $this->input->post('can');
        $lote= $this->input->post('lote');
        $cadu= $this->input->post('cadu');
       $this->load->model('a_devolucion_model');
       $this->a_devolucion_model->insert_member_detalle($fol,$cod,$can,$lote,$cadu,$tipo);
        
        redirect('a_devolucion/tabla_detalle/'.$fol);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function borra_detalle($id,$fol)
    {
       $this->load->model('a_devolucion_model');
       $this->a_devolucion_model->delete_member_detalle($id);
       redirect('a_devolucion/tabla_detalle/'.$fol);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function borrar_devolucion_ctl($fol)
    {
    $this->load->model('a_devolucion_model');
    $this->a_devolucion_model->delete_member_ctl($fol);
    redirect('a_devolucion/tabla_control');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function cerrar()
    {
     $fol= $this->input->post('fol');
     $tipo= $this->input->post('tipo');
     $mov= $this->input->post('mov');
     
     $this->load->model('a_devolucion_model');
     $this->a_devolucion_model->cerrar_member_devolucion($fol,$tipo,$mov);
     redirect('a_devolucion/tabla_control');
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
          
        $this->load->model('a_devolucion_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->a_devolucion_model->control_his();
        
        $data['titulo'] = "CAPTURA DE SURTIDO";
        $data['titulo1'] = "";
        $data['contenido'] = "a_devolucion";
        $data['selector'] = "a_devolucion";
        $data['sidebar'] = "sidebar_a_devolucion";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function imprime_devolucion($fol,$suc,$tipo,$mov)
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
          
          
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $sucx =$this->catalogo_model->busca_suc_unica($suc);
          $movx =$this->catalogo_model->busca_mov_devolucion_una($mov);
            
          if($tipo=='E'){$mov='ENTRO MERCANCIA AL ALMACEN CEDIS DE '.$sucx;}
          if($tipo=='S'){$mov='SALIO MERCANCIA AL ALMACEN CEDIS A '.$sucx;}  
      $data['cabeza'].= "
      <table>
           
    <tr>
    <td colspan=\"5\" align=\"center\"><font size=\"+5\"><strong>DEVOLUCION DE MERCANCIA <BR />$movx</strong></font></td>
    </tr>
           
    <tr>
    <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
    </tr>
    
    <tr>
   <td colspan=\"2\" align=\"left\"><strong>$mov</strong> <br /></td>
    <td colspan=\"3\" align=\"ribht\"><strong>FOLIO..:$fol </strong> <br /></td>
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
            $data['fol']=$fol;
            $this->load->view('impresiones/a_devolucion_det', $data);
            
		}      
        
/////////////////////////////////////////////////////////////////////////////////////////////
    
    function reporte_diario()
    {
        $data['titulo'] = "Reporte Diario";
        $data['titulo1'] = "";
        $data['contenido'] = "reporte_diario_fecha2";
        $data['selector'] = "a_devolucion";
        $data['sidebar'] = "sidebar_a_devolucion";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_diario_submit()
    {
        ini_set('memory_limit','2000M');
        set_time_limit(0);
        $fecha1 = $this->input->post('fecha1');
        $fecha2 = $this->input->post('fecha2');
        
        $this->load->model('a_devolucion_model');

        $data['cabeza'] = $this->a_devolucion_model->reporte_diario_encabezado($fecha1, $fecha2);
        $data['detalle'] = $this->a_devolucion_model->reporte_diario($fecha1, $fecha2);
       
        
        $this->load->view('impresiones/reporte_diario_devo', $data);
    }
    
////////////////////////////////////////////////////////////////////////////////////////////////////

function reporte_excedente()
    {
        $data['titulo'] = "Reporte Diario";
        $data['titulo1'] = "";
        $data['contenido'] = "reporte_excedente";
        $data['selector'] = "a_devolucion";
        $data['sidebar'] = "sidebar_a_devolucion";
        $this->load->model('catalogo_model');
       $data['motivox'] = $this->catalogo_model->busca_motivo();
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_excedente_submit()
    {
        ini_set('memory_limit','2000M');
        set_time_limit(0);
        $fecha1 = $this->input->post('fec1');
        $fecha2 = $this->input->post('fec2');
        $motivox = $this->input->post('motivo');
        
        $this->load->model('a_devolucion_model');

        $data['cabeza'] = $this->a_devolucion_model->reporte_excedente_encabezado($fecha1, $fecha2, $motivox);
        $data['detalle'] = $this->a_devolucion_model->reporte_excedente($fecha1, $fecha2, $motivox);
       
        
        $this->load->view('impresiones/reporte_excedente_devo', $data);
    }    
    
      }