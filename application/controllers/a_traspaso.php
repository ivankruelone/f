<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class A_traspaso extends CI_Controller
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
        $data['titulo']= 'TRASPASO DE MERCANCIA';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "a_traspaso";
        $data['selector'] = "a_traspaso";
        $data['sidebar'] = "sidebar_a_traspaso";
                
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
          
        $this->load->model('a_traspaso_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->a_traspaso_model->control();
        $data['tipo']=' ';
        $data['titulo']= 'TRASPASO DE MERCANCIA';
        $data['titulo1'] = "";
        $data['contenido'] = "a_traspaso_form_suc";
        $data['selector'] = "a_traspaso";
        $data['sidebar'] = "sidebar_a_traspaso";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agrega_ctl()
    {
        $suc= $this->input->post('suc');
        $tipo= $this->input->post('tipo');
        $this->load->model('a_traspaso_model');
        $id_cc = $this->a_traspaso_model->agrega_member_ctl($suc,$tipo);
        redirect('a_traspaso/tabla_detalle/'.$id_cc);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_detalle($id_cc)
    {
        $this->load->model('catalogo_model');
        $this->load->model('a_traspaso_model');
        $query =$this->a_traspaso_model->busca_folio($id_cc);
        if($query->num_rows() >0){
		$row=$query->row();
        $tipo=$row->tipo;
        $suc=$row->suc;
        }
        $sucx =$this->catalogo_model->busca_suc_unica($suc);
        if($tipo=='E'){
        $data['titulo1'] = "SALE MERCANCIA DE $sucx Y ENTRA EN ALMACEN CEDIS";
        $data['contenido'] = "a_traspaso_form_captura_en";    
        }elseif($tipo=='S'){
        $data['titulo1'] = "SALE MERCANCIA DE ALMACEN CEDIS  Y ENTRA A $sucx  ";
        $data['contenido'] = "a_traspaso_form_captura";    
        }
        $data['fol'] =$id_cc;
        $data['tipo'] =$tipo;
        $data['tabla'] = $this->a_traspaso_model->detalle_cap($id_cc,$tipo);
        $data['titulo'] = "TRASPASO DE MERCANCIA DEL FOLIO $id_cc";
        
        $data['selector'] = "a_traspaso";
        $data['sidebar'] = "sidebar_a_traspaso";
        
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

    function agrega_detalle()
    {
        $tipo= $this->input->post('tipo');
        $fol= $this->input->post('fol');
        $sec= $this->input->post('sec');
        $can= $this->input->post('can');
        $lote= $this->input->post('lote');
        $cadu= $this->input->post('cadu');
       $this->load->model('a_traspaso_model');
       $this->a_traspaso_model->insert_member_detalle($fol,$sec,$can,$lote,$cadu,$tipo);
        
        redirect('a_traspaso/tabla_detalle/'.$fol);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function borra_detalle($id,$fol)
    {
       $this->load->model('a_traspaso_model');
       $this->a_traspaso_model->delete_member_detalle($id);
       redirect('a_traspaso/tabla_detalle/'.$fol);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function borrar_traspaso_ctl($fol)
    {
    $this->load->model('a_traspaso_model');
    $this->a_traspaso_model->delete_member_ctl($fol);
    redirect('a_traspaso/tabla_control');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function cerrar()
    {
     $fol= $this->input->post('fol');
     $tipo= $this->input->post('tipo');
     $this->load->model('a_traspaso_model');
     $this->a_traspaso_model->cerrar_member_traspaso($fol,$tipo);
     redirect('a_traspaso/tabla_control');
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
          
        $this->load->model('a_traspaso_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->a_traspaso_model->control_his();
        
        $data['titulo'] = "CAPTURA DE SURTIDO";
        $data['titulo1'] = "";
        $data['contenido'] = "a_traspaso";
        $data['selector'] = "a_traspaso";
        $data['sidebar'] = "sidebar_a_traspaso";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function imprime_traspaso($fol,$suc,$tipo)
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
          
          
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $sucx =$this->catalogo_model->busca_suc_unica($suc);
            
          if($tipo=='E'){$mov='ENTRO MERCANCIA AL ALMACEN CEDIS DEL ALMACEN '.$sucx;}
          if($tipo=='S'){$mov='SALIO MERCANCIA AL ALMACEN CEDIS AL ALMACEN '.$sucx;}  
      $data['cabeza'].= "
      <table>
           
    <tr>
    <td colspan=\"5\" align=\"center\"><font size=\"+5\"><strong>TRASPASO DE MERCANCIA</strong></font></td>
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
            $this->load->view('impresiones/a_traspaso_det', $data);
            
		}      
        
/////////////////////////////////////////////////////////////////////////////////////////////
    
    function reporte_diario()
    {
        $data['titulo'] = "Reporte Diario";
        $data['titulo1'] = "";
        $data['contenido'] = "reporte_diario_fecha1";
        $data['selector'] = "a_traspaso";
        $data['sidebar'] = "sidebar_a_traspaso";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_diario_submit()
    {
        $fecha1 = $this->input->post('fecha1');
        $fecha2 = $this->input->post('fecha2');
        
        $this->load->model('a_traspaso_model');

        $data['cabeza'] = $this->a_traspaso_model->reporte_diario_encabezado($fecha1, $fecha2);
        $data['detalle'] = $this->a_traspaso_model->reporte_diario($fecha1, $fecha2);
       
        
        $this->load->view('impresiones/reporte_diario_traspaso', $data);
    }
    
    
    
      }