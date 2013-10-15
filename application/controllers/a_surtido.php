<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class A_surtido extends CI_Controller
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
        $data['titulo']= 'CAPTURA DE  PEDIDOS';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "a_surtido1";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
 /////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia

/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control()
    {
        $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('a_surtido_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->a_surtido_model->control();
        
        
        $data['titulo'] = "CAPTURA DE SURTIDO";
        $data['titulo1'] = "";
        $data['contenido'] = "a_surtido_form_folio";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_control_fol()
    {
        $fol= $this->input->post('fol');
        $this->load->model('catalogo_model');
        $valor=0;  
        $this->load->model('a_surtido_model');
        $query =$this->a_surtido_model->busca_folio($fol);
        if($query->num_rows() >0){
		$row=$query->row();
        $tid=$row->tid;
        $sucx=$row->nombre;
        $suc=$row->suc;
        $valor=1;
        }else{
        $query =$this->a_surtido_model->busca_folio_1($fol);    
        if($query->num_rows() >0){
		$row=$query->row();
        $tid=$row->tid;
        $sucx=$row->nombre;
        $suc=$row->suc;
        $valor=1;
        }
        }
        if($valor==1){
        if($tid=='A'){
		$data['fechac']= date('Y-m-d');
        $data['fol']= $fol;
        
        $data['tabla'] = $this->a_surtido_model->detalle_cap($fol);
        $data['titulo'] = "PEDIDOS SIN CAPTURAR LO SURTIDO ";
        $data['titulo1'] = " $fol..: $suc - $sucx";
        $data['contenido'] = "a_surtido_form_captura";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        }
        }else{
        redirect('a_surtido/tabla_control');	
        }
        
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function captura_sob_fal()
    {   $data['mensaje']= '';
        $data['titulo']= 'CAPTURA DE SOBRANTES Y/O FALTANTES FORMULADOS';
        $data['titulo1']= '';
        $this->load->model('a_surtido_model');
        $data['tabla'] = $this->a_surtido_model->folios_sob_fal();

		$data['contenido'] = "a_folio_sob_fal";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
  public function actualiza_faltante()
    {
        $data = array('faltante' => $this->input->post('valor'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('catalogo.folio_pedidos_cedis', $data); 
     
    }
    public function actualiza_sobrante()
    {
        $data = array('sobrante' => $this->input->post('valor'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('catalogo.folio_pedidos_cedis', $data); 
     
    }   
    
    public function validar_falsob($id)
    {
        $this->load->model('a_surtido_model');
        $this->a_surtido_model->validar_falsob_model($id);
        redirect('a_surtido/captura_sob_fal');
        
        
     }   
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     
    
    public function captura_sob_fal_esp()
    {   $data['mensaje']= '';
        $data['titulo']= 'CAPTURA DE SOBRANTES Y/O FALTANTES ESPECIALES';
        $data['titulo1']= '';
        $this->load->model('a_surtido_model');
        $data['tabla'] = $this->a_surtido_model->folios_sob_fal_esp();

		$data['contenido'] = "a_folio_sob_fal_esp";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        }  
    
        public function actualiza_faltante_esp()
        {
        $data = array('faltante' => $this->input->post('valor'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('catalogo.folio_pedidos_cedis_especial', $data); 
        }       
    
        public function actualiza_sobrante_esp()
        {
        $data = array('sobrante' => $this->input->post('valor'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('catalogo.folio_pedidos_cedis_especial', $data); 
        }
        
        
        public function validar_falsob_esp($id)
        {
        $this->load->model('a_surtido_model');
        $this->a_surtido_model->validar_falsob_model_esp($id);
        redirect('a_surtido/captura_sob_fal_esp');
    
        }    
 //////////////////////////////////////////////////////////////////////////////////////////            
    
    

    public function tabla_sob_fal()
    {   $data['mensaje']= '';
        $data['titulo']= 'SOBRANTES Y/O FALTANTES FORMULADOS';
        $data['titulo1']= '';
        $this->load->model('a_surtido_model');
       

		$data['contenido'] = "reporte_folios";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }  
    
    function reporte_folios_submit()
    {
        ini_set('memory_limit','2000M');
        set_time_limit(0);
        $fecha1 = $this->input->post('fec1');
        $fecha2 = $this->input->post('fec2');
        
        
        $this->load->model('a_surtido_model');
        
        $faltante = $this->a_surtido_model->reporte_folio_faltante($fecha1, $fecha2);
        $falysob  = $this->a_surtido_model->reporte_folio($fecha1, $fecha2);
        $sobrante = $this->a_surtido_model->reporte_folio_sobrante($fecha1, $fecha2);
        $sinincidencias = $this->a_surtido_model->reporte_folio_sin_incidencias($fecha1, $fecha2);
        //echo "<pre>";
        //print_r($sobrante);
        //echo "</pre>";
        //die();
        $data['cabeza'] = $this->a_surtido_model->reporte_folio_encabezado($fecha1, $fecha2);
        $data['detalle'] = $faltante['tabla'];
        $data['detalle1'] = $falysob ['tabla'];
        $data['detalle2'] = $sobrante ['tabla'];
        $data['detalle3'] = $sinincidencias ['tabla'];
       
       $data['detalle4'] = $this->a_surtido_model->reporte_porcentajes($faltante['folios'],
       $falysob['folios'], $sobrante['folios'], $sinincidencias['folios'],$fecha1,$fecha2);
        
        $this->load->view('impresiones/reporte_folio', $data);
    }
    
    public function tabla_sob_fal_esp()
    {   $data['mensaje']= '';
        $data['titulo']= 'SOBRANTES Y/O FALTANTES ESPECIAL';
        $data['titulo1']= '';
        $this->load->model('a_surtido_model');
       

		$data['contenido'] = "reporte_folios_esp";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }  
    
    function reporte_folios_esp_submit()
    {
        ini_set('memory_limit','2000M');
        set_time_limit(0);
        $fecha1 = $this->input->post('fec1');
        $fecha2 = $this->input->post('fec2');
        
        $this->load->model('a_surtido_model');
        
        $faltante = $this->a_surtido_model->reporte_folio_faltante_esp($fecha1, $fecha2);
        $falysob  = $this->a_surtido_model->reporte_folio_esp($fecha1, $fecha2);
        $sobrante = $this->a_surtido_model->reporte_folio_sobrante_esp($fecha1, $fecha2);
        $sinincidencias = $this->a_surtido_model->reporte_folio_sin_incidencias_esp($fecha1, $fecha2);

        $data['cabeza'] = $this->a_surtido_model->reporte_folio_esp_encabezado($fecha1, $fecha2);
        $data['detalle'] = $faltante['tabla'];
        $data['detalle1'] = $falysob ['tabla'];
        $data['detalle2'] = $sobrante ['tabla'];
        $data['detalle3'] = $sinincidencias ['tabla'];
       
       $data['detalle4'] = $this->a_surtido_model->reporte_porcentajes_esp($faltante['folios'],
       $falysob['folios'], $sobrante['folios'], $sinincidencias['folios'],$fecha1,$fecha2);
        
        $this->load->view('impresiones/reporte_folio_esp', $data);
    }    
    
    
    public function folios_totales()
    {   
        $data['mensaje']= '';
        $data['titulo']= 'FORMULADOS ENVIADOS';
        $data['titulo1']= '';
        $this->load->model('a_surtido_model');
       

		$data['contenido'] = "reporte_folios_totales";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }  
    
    public function reporte_folios_tot_submit ()
    {
        ini_set('memory_limit','2000M');
        set_time_limit(0);
        $fecha1 = $this->input->post('fec1');
        $fecha2 = $this->input->post('fec2');
        
        $this->load->model('a_surtido_model');
        
        $data['cabeza'] = $this->a_surtido_model->reporte_folio_tot_encabezado($fecha1, $fecha2);
        $data['detalle'] = $this->a_surtido_model->reporte_folio_tot_detalle($fecha1, $fecha2);
        
        
        $this->load->view('impresiones/reporte_folio_tot', $data);  
        
    }
    
    public function folios_totales_esp()
    {   
        $data['mensaje']= '';
        $data['titulo']= 'ESPECIALES ENVIADOS';
        $data['titulo1']= '';
        $this->load->model('a_surtido_model');
       

		$data['contenido'] = "reporte_folios_totales_esp";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }  
    
    
    public function reporte_folios_tot_esp_submit ()
    {
        ini_set('memory_limit','2000M');
        set_time_limit(0);
        $fecha1 = $this->input->post('fec1');
        $fecha2 = $this->input->post('fec2');
        
        $this->load->model('a_surtido_model');
        
        $data['cabeza'] = $this->a_surtido_model->reporte_folio_tot_esp_encabezado($fecha1, $fecha2);
        $data['detalle'] = $this->a_surtido_model->reporte_folio_tot_esp_detalle($fecha1, $fecha2);
        
        
        $this->load->view('impresiones/reporte_folio_tot_esp', $data);  
        
    }
    
    public function folios_pendientes()
    {   
        $data['mensaje']= '';
        $data['titulo']= 'FORMULADOS POR DEVOLVER';
        $data['titulo1']= '';
        $this->load->model('a_surtido_model');
       

		$data['contenido'] = "reporte_folios_pendientes";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }  
    
    public function reporte_folios_pendientes_submit ()
    {
        ini_set('memory_limit','2000M');
        set_time_limit(0);
        $fecha1 = $this->input->post('fec1');
        $fecha2 = $this->input->post('fec2');
        
        $this->load->model('a_surtido_model');
        
        $data['cabeza'] = $this->a_surtido_model->reporte_folio_pendientes_encabezado($fecha1, $fecha2);
        $data['detalle'] = $this->a_surtido_model->reporte_folio_pendientes_detalle($fecha1, $fecha2);
        
        
        $this->load->view('impresiones/reporte_folio_pendientes', $data);  
        
    }
    
    public function folios_pendientes_esp()
    {   
        $data['mensaje']= '';
        $data['titulo']= 'ESPECIALES POR DEVOLVER';
        $data['titulo1']= '';
        $this->load->model('a_surtido_model');
       

		$data['contenido'] = "reporte_folios_pendientes_esp";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }  
    
    public function reporte_folios_pendientes_esp_submit ()
    {
        ini_set('memory_limit','2000M');
        set_time_limit(0);
        $fecha1 = $this->input->post('fec1');
        $fecha2 = $this->input->post('fec2');
        
        $this->load->model('a_surtido_model');
        
        $data['cabeza'] = $this->a_surtido_model->reporte_folio_pendientes_esp_encabezado($fecha1, $fecha2);
        $data['detalle'] = $this->a_surtido_model->reporte_folio_pendientes_esp_detalle($fecha1, $fecha2);
        
        
        $this->load->view('impresiones/reporte_folio_pendientes', $data);  
        
    }
    
        public function regresa_folio()
    {   
        $data['mensaje']= '';
        $data['titulo']= 'REGRESAR FOLIO PARA CAPTURA';
        $data['titulo1']= '';
        $this->load->model('a_surtido_model');
       

		$data['contenido'] = "regresa_folio";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }  
    
    public function regresa_folio_submit ()
    {
        
        $fecha1 = $this->input->post('fec1');
        $fecha2 = $this->input->post('fec2');
        
        $this->load->model('a_surtido_model');
         $data['mensaje']= '';
        $data['titulo']= 'REGRESAR A CAPTURA FORMULADOS';
        $data['titulo1']= '';
        $this->load->model('a_surtido_model');
        $data['tabla'] = $this->a_surtido_model->regresa_folio($fecha1, $fecha2);

		$data['contenido'] = "a_folio_sob_fal";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
    
    public function regresa_falsob($id)
    {
        $this->load->model('a_surtido_model');
        $this->a_surtido_model->regresa_falsob_model($id);
        redirect('a_surtido/regresa_folio_submit');
        
        
     }   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_control_fol_var($fol)
    {
        $this->load->model('catalogo_model');
          
        $this->load->model('a_surtido_model');
        $data['fechac']= date('Y-m-d');
         $data['fol']= $fol;
         $data['tabla'] = $this->a_surtido_model->detalle_cap($fol);
        
        $data['titulo'] = "PEDIDOS SIN CAPTURAR LO SURTIDO";
        $data['titulo1'] = "FOLIO $fol";
        $data['contenido'] = "a_surtido_form_captura";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function cambia_sur()
    {
        $fol= $this->input->post('fol');
        $sec= $this->input->post('sec');
        $can= $this->input->post('can');
       //$this->load->model('a_surtido_model');
       //$this->a_surtido_model->update_member_surtido($fol,$sec,$can);
       
      $data = array(
        'sur' => $can,
        'fechasur'=> date('Y-m-d H:i')
        );
        $this->db->where('fol', $fol);
        $this->db->where('sec', $sec);
        $this->db->where('tipo', '1');
        $this->db->update('pedidos', $data);
        
        redirect('a_surtido/tabla_control_fol_var/'.$fol);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

   public function captura_surtido($fol,$suc)
    {
        $this->load->model('catalogo_model');
        $sucx =$this->catalogo_model->busca_suc_unica($suc);
        $data['sucx'] = $sucx;
          
        $this->load->model('a_surtido_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->a_surtido_model->detalle($fol);
        
         $data['fol'] = $fol;
         $data['suc'] = $suc;
         
        $data['titulo'] = "PEDIDO CON EL FOLIO $fol DE LA SUCURSAL $sucx";
        $data['titulo1'] = "";
        $data['contenido'] = "a_surtido";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function actualiza_cansur()
    {
        $data = array('sur' => $this->input->post('valor'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('pedidos', $data);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////
  public function seleccion()
    {
        $id_user= $this->session->userdata('id');
        if($id_user>0){
            
        $fol= $this->input->post('fol');
		$this->load->model('catalogo_model');
        $data['surx'] = $this->catalogo_model->busca_surtidor();
		$data['empx'] = $this->catalogo_model->busca_empacador();
		$valor=0;  
        $this->load->model('a_surtido_model');
        $query =$this->a_surtido_model->busca_folio($fol);
        if($query->num_rows() >0){
		$row=$query->row();
        $tid=$row->tid;
        $sucx=$row->nombre;
        $suc=$row->suc;
        $valor=1;
        }else{
        $query =$this->a_surtido_model->busca_folio_1($fol);    
        if($query->num_rows() >0){
		$row=$query->row();
        $tid=$row->tid;
        $sucx=$row->nombre;
        $suc=$row->suc;
        $valor=1;
        }
        }
        if($valor==1){
        if($tid=='A'){
		  
        $data['fechac']= date('Y-m-d');
        $data['fol']= $fol;
        $data['tabla'] = '';
        
        $data['titulo'] = "PEDIDOS SIN CAPTURAR LO SURTIDO";
        $data['titulo1'] = " $fol..: $suc - $sucx";
        $data['contenido'] = "a_surtido_form_seleccion";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }}
	
    }else{
	 redirect('a_surtido/tabla_control');  
	}
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function cerrar()
    {
     $fol= $this->input->post('fol');
     $sur= $this->input->post('sur');
     $emp= $this->input->post('emp');
     $this->load->model('a_surtido_model');
     $this->a_surtido_model->cerrar_member_surtido($fol,$sur,$emp);
     redirect('a_surtido/tabla_control');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
    function imprime_pedidos($fol,$suc)
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
          
          
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $sucx = $this->catalogo_model->busca_suc_unica($suc);
          $rutax = $this->catalogo_model->busca_sucursal_ruta_gral($suc);  
            
      $data['cabeza'].= "
      <table>
           
    <tr>
    <td colspan=\"5\" align=\"center\"><font size=\"+5\"><strong>PREVIO DE PEDIDOS NO VALIDA PARA SUCURSAL</strong></font></td>
    </tr>
           
    <tr>
    <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
    </tr>
    <tr>
    <td colspan=\"3\" align=\"right\">RUTA.:".$rutax." </td>
    <td colspan=\"2\" align=\"right\">Fecha .:".date('Y-m-d')." </td>
    </tr>
    <tr>
   <td colspan=\"2\" align=\"left\"><strong>SUCURSAL..:$suc - $sucx </strong> <br /></td>
    <td colspan=\"3\" align=\"ribht\"><strong>FOLIO..:$fol </strong> <br /></td>
   </tr>
            <tr>
           <th width=\"50\" align=\"center\"><strong>UBIC</strong></th>
           <th width=\"40\" align=\"left\"><strong>CVE</strong></th>
           <th width=\"450\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
           <th width=\"70\" align=\"right\"><strong>CANTIDAD</strong></th>
           <th width=\"70\" align=\"center\"><strong>C.SUR.</strong></th>
          </tr><br/><br/><br/>
          
   </table> 
            ";
            $data['fol']=$fol;
            $this->load->view('impresiones/a_previo_depedidos_gral', $data);
            
		}      
        
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
    function imprime_pedidos_pre($fol,$suc)
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
          
          
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $sucx = $this->catalogo_model->busca_suc_unica($suc);
          $rutax = $this->catalogo_model->busca_sucursal_ruta_gral($suc);  
            
      $data['cabeza'].= "
      <table>
           
    <tr>
    <td colspan=\"5\" align=\"center\"><font size=\"+6\"><strong>PREVIO DE PEDIDOS NO VALIDA PARA SUCURSAL</strong></font></td>
    </tr>
           
    <tr>
    <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
    </tr>
    <tr>
    <td colspan=\"3\" align=\"right\">RUTA.:".$rutax." </td>
    <td colspan=\"2\" align=\"right\">Fecha .:".date('Y-m-d')." </td>
    </tr>
    <tr>
   <td colspan=\"2\" align=\"left\"><strong>SUCURSAL..:$suc - $sucx </strong> <br /></td>
    <td colspan=\"3\" align=\"ribht\"><strong>FOLIO..:$fol </strong> <br /></td>
   </tr>
            <tr>
           <th width=\"50\" align=\"center\"><strong>UBIC</strong></th>
           <th width=\"40\" align=\"left\"><strong>CVE</strong></th>
           <th width=\"450\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
           <th width=\"70\" align=\"right\"><strong>CANTIDAD</strong></th>
           <th width=\"70\" align=\"center\"><strong>C.SUR.</strong></th>
          </tr>
   </table> 
            ";
            $data['fol']=$fol;
            $this->load->view('impresiones/previo_gral', $data);
            
		}      
        

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////

function imprime_pedidos_pre1($fol,$suc)
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
          
          
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $sucx = $this->catalogo_model->busca_suc_unica($suc);
          $rutax = $this->catalogo_model->busca_sucursal_ruta_gral($suc);  
            
      $data['cabeza'].= "
      <table>
           
    <tr>
    <td colspan=\"5\" align=\"center\"><font size=\"+6\"><strong>PREVIO DE PEDIDOS NO VALIDA PARA SUCURSAL</strong></font></td>
    </tr>
           
    <tr>
    <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
    </tr>
    <tr>
    <td colspan=\"3\" align=\"right\">RUTA.:".$rutax." </td>
    <td colspan=\"2\" align=\"right\">Fecha .:".date('Y-m-d')." </td>
    </tr>
    <tr>
   <td colspan=\"2\" align=\"left\"><strong>SUCURSAL..:$suc - $sucx </strong> <br /></td>
    <td colspan=\"3\" align=\"ribht\"><strong>FOLIO..:$fol </strong> <br /></td>
   </tr>
            <tr>
           <th width=\"50\" align=\"center\"><strong>UBIC</strong></th>
           <th width=\"40\" align=\"left\"><strong>CVE</strong></th>
           <th width=\"450\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
           <th width=\"70\" align=\"right\"><strong>CANTIDAD</strong></th>
           <th width=\"70\" align=\"center\"><strong>C.SUR.</strong></th>
          </tr>
   </table> 
            ";
            $data['fol']=$fol;
            $this->load->view('impresiones/previo_gral_esp', $data);
            
		}      
        

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_his_busqueda()
   {
        
        
        $this->load->model('a_surtido_model');
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "a_surtido1";
        $data['selector'] = "a_surtido1";
        $data['sidebar'] = "sidebar_a_surtido";
        //$data['tabla1'] = $this->a_surtido_model->busca_folio_cerrado();
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
   
   
   public function tabla_control_his()
    {
        $this->load->library('pagination');
        $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         
          
        $this->load->model('a_surtido_model');
        $config['base_url'] = site_url()."/a_surtido/tabla_control_his";
        $config['total_rows'] = $this->a_surtido_model->cuenta_historico_pedidos();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '100'; 

        $this->pagination->initialize($config);
        
        
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->a_surtido_model->control_his($config['per_page'], $this->uri->segment(3));
        
        $data['titulo'] = "CAPTURA DE SURTIDO";
        $data['titulo1'] = "";
        $data['contenido'] = "a_surtido";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function folios_abiertos()
    {
        $this->load->model('a_surtido_model');
        
        $data['cabeza'] = $this->a_surtido_model->reporte_diario_encabezado1();
        $data['detalle'] = $this->a_surtido_model->reporte_folios_abiertos();
        $data['detalle1'] = $this->a_surtido_model->reporte_folios_abiertos_esp();
        
        //echo $data['cabeza'];
        //echo $data['detalle'];
        //print_r($data);
        $this->load->view('impresiones/reporte_diario_folios', $data);
    }
    
    function reporte_diario()
    {
        $data['titulo'] = "Reporte Diario";
        $data['titulo1'] = "";
        $data['contenido'] = "reporte_diario_fecha";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
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
    
    function reporte_semanal()
    {
        $data['titulo'] = "Reporte Semanal";
        $data['titulo1'] = "";
        $data['contenido'] = "reporte_diario_fecha";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_semanal_submit()
    {
        $semana = $this->input->post('semana');
        $anio = $this->input->post('anio');
        
        $this->load->model('a_surtido_model');

        $data['cabeza'] = $this->a_surtido_model->reporte_semanal_encabezado($semana, $anio);
        $data['detalle_total'] = $this->a_surtido_model->reporte_semanal_total($semana, $anio);
        //echo $data['cabeza'];
        //echo $data['detalle_total'];
        $this->load->view('impresiones/reporte_semanal_captura', $data);
    }
    
    function reporte_mensual()
    {
        $data['titulo'] = "Reporte Mensual";
        $data['titulo1'] = "";
        $data['contenido'] = "reporte_diario_fecha";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_mensual_submit()
    {
        $mes = $this->input->post('mes');
        $anio = $this->input->post('anio');
        
        $this->load->model('a_surtido_model');

        $data['cabeza'] = $this->a_surtido_model->reporte_mensual_encabezado($mes, $anio);
        $data['detalle_total'] = $this->a_surtido_model->reporte_mensual_total($mes, $anio);
        //echo $data['cabeza'];
        //echo $data['detalle_total'];
        $this->load->view('impresiones/reporte_mensual_captura', $data);
    }

    public function tabla_control_his1()
    {
        $this->load->library('pagination');
        $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         
          
        $this->load->model('a_surtido_model');
        $config['base_url'] = site_url()."/a_surtido/tabla_control_his1";
        $config['total_rows'] = $this->a_surtido_model->cuenta_historico_pedidos1();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '25'; 

        $this->pagination->initialize($config);
        
        
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->a_surtido_model->control_his1($config['per_page'], $this->uri->segment(3));
        
        $data['titulo'] = "CAPTURA DE SURTIDO";
        $data['titulo1'] = "";
        $data['contenido'] = "a_surtido";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
    function imprime_pedidos_rem($fol,$suc)
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $empx='';
        $surx='';
        $capx='';
          $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $sucx = $this->catalogo_model->busca_suc_unica($suc);
          $rutax = $this->catalogo_model->busca_sucursal_ruta_gral($suc);
          $ciax = $this->catalogo_model->busca_cia_pedido($suc);
		  $this->load->model('a_surtido_model'); 
          
          
		  $query = $this->a_surtido_model->busca_folio_1($fol);

        if($query->num_rows() > 0){
    		$row=$query->row();
            $surx=$row->surx;
            $empx=$row->empx;
            $capx=$row->capx;
//            echo 'perro';
        }else{
            $query2 = $this->a_surtido_model->busca_folio($fol);
    		$row2=$query2->row();
            $surx=$row2->surx;
            $empx=$row2->empx;
            $capx=$row2->capx;
//            echo 'gato';
        }
//        echo $capx;
//        die();
		    
           
$data['cabeza']= "<table width=\"690\">
    <tr>
    <td colspan=\"8\" align=\"center\"><font size=\"+5\"><strong>REMISION PARA SUCURSAL</strong></font></td>
    </tr>
    <tr>
    <td colspan=\"8\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
    </tr>
    <tr>
    <td colspan=\"8\" align=\"left\"><b>Capturista</b>..: ".$capx." --- <b>Surtidor</b>..: ".$surx." --- <b>Empacador</b>..: ".$empx." </td>
    </tr>
    <tr>
    <td colspan=\"6\" align=\"right\">RUTA.:".$rutax." <br/> ".$ciax." </td>
    <td colspan=\"2\" align=\"right\">Fecha .:".date('Y-m-d')." </td>
    </tr>
    <tr>
   <td colspan=\"6\" align=\"left\"><strong>Consignado..:$suc - $sucx </strong></td>
    <td colspan=\"2\" align=\"right\"><strong>FOLIO..:$fol </strong></td>
  </tr>
        
   </table>";

           
            $data['detalle']= $this->a_surtido_model->imprime_rem($fol);
            $data['total']= $this->a_surtido_model->imprime_rem_negados($fol);
			//$data['detalle1'].= $this->a_surtido_model->imprime_rem_descontinuados($fol);
            $data['total']= $this->a_surtido_model->imprime_rem_negados($fol);  
            $this->load->view('impresiones/a_pedidos_rem', $data);
            
		}      
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////

   public function tabla_control_his_mod()
    {
        $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('a_surtido_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->a_surtido_model->control_his_mod();
        
        $data['titulo'] = "CAPTURA DE SURTIDO";
        $data['titulo1'] = "";
        $data['contenido'] = "a_surtido_form_folio_cerrado";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
        
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_control_his_detalle()
    {
        $this->load->model('a_surtido_model');
        
        $fol= $this->input->post('fol');
        $con= $this->input->post('con');
        
        if($con=='f'.date('Y-m-d')){
        
        $data['fechac']= date('Y-m-d');
        $data['fol']= $fol;
        $data['tabla'] = $this->a_surtido_model->detalle_cap_cerrado($fol);
        $data['titulo'] = "FOLIO CERRADO $fol";
        $data['titulo1'] = "FOLIO $fol";
        $data['contenido'] ="a_surtido";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        }else{
        redirect('a_surtido/index'); 
        }
}
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
                                                                //////************************
    function actualiza_cansur_cerrada()
    {
        $id_user= $this->session->userdata('id');
        $valor = $this->input->post('valor');
        $id_ped = $this->input->post('id');
         $l1="select *from desarrollo.pedidos where id=$id_ped";        
        $l2 = $this->db->query($l1);   
          if($l2->num_rows() > 0){
            $l3=$l2->row();
            $sec=$l3->sec;
            $folio=$l3->fol;
            $suc=$l3->suc;
            $cero=$l3->sur;
//-----------------------------------------------------------------------------------ENTRADA- 
        if($valor == 0 and $cero > 0){        
        $l4="select *from desarrollo.surtido where sec=$sec and fol=$folio";        
        $l5 = $this->db->query($l4);   
         foreach($l5->result() as $l6)
         {  
        $can=$l6->can;   
$sx = "SELECT * FROM desarrollo.inv_cedis a where sec=$sec and lote='$l6->lote'";
$qx = $this->db->query($sx);    
if($qx->num_rows() > 0){ 
$rx= $qx->row();
$invi=$rx->inv1;
$datain = array('inv1' =>$invi+$can);$this->db->where('id',$rx->id);$this->db->update('inv_cedis', $datain);//inventario ctl

        
        $new_member_insert_data = array(
            'tipo'   =>'FOLIO YA CERRADO',
            'sec'   =>$sec,
            'id_user'=>$id_user,
   			'cadu'   =>$l6->cadu,
       		'lote'   =>$l6->lote,
            'salida' =>0,
            'entrada'=>$can,
            'folio'  =>$folio,
            'suc'    =>$suc,
            'fecha'  =>date('Y-m-d H:s')
		);
		$insert = $this->db->insert('desarrollo.a_ajustes', $new_member_insert_data);//ajuste

$fecc=date('Y-m-d');    
$sd = "SELECT * FROM desarrollo.inv_cedis_dia a where fecha='$fecc' and sec=$sec and lote='$l6->lote'";
        $qd = $this->db->query($sd);    
if($qd->num_rows() > 0){ 
            $rd= $qd->row();
            $exi=$rd->saju;
            $id_inv_dia=$rd->id;            
                     $datad1 = array(
                    'eaju'     => $exi+$can
                    );
                    $this->db->where('id', $id_inv_dia);
                    $this->db->update('desarrollo.inv_cedis_dia', $datad1);
           

}else{
           $datad = array(
                    'invi'=>$invi,
            		'fecha' =>$fecc,
                    'sec'   =>$sec,
           			'cadu'  =>$l6->cadu,
            		'lote'  =>$l6->lote,
            		'eaju'  =>$can,
                    );
                    $this->db->insert('desarrollo.inv_cedis_dia', $datad);  
    
}        
        
        
 $this->db->delete('desarrollo.surtido', array('id' => $l6->id));
 }
        }
        if($valor ==0 and $cero > 0 ){
        $data = array('sur' => $this->input->post('valor'));
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('pedidos', $data); 
        }
 }      
//-----------------------------------------------------------------------------------ENTRADA-
//----------------------------------------------------------------------------------- SALIDA 
        if($valor > 0 and $cero == 0){        
$sx = "SELECT * FROM desarrollo.inv_cedis a where sec=$sec  and inv1>0 order by cadu,lote ";
$qx = $this->db->query($sx);    
if($qx->num_rows() > 0){ 
$rx= $qx->row();
$invi=$rx->inv1;
$datain = array('inv1' =>$invi-$valor);$this->db->where('id',$rx->id);$this->db->update('inv_cedis', $datain);//inventario ctl

        
        $new_member_insert_data = array(
            'tipo'   =>'FOLIO YA CERRADO',
            'sec'   =>$sec,
            'id_user'=>$id_user,
   			'cadu'   =>$rx->cadu,
       		'lote'   =>$rx->lote,
            'salida' =>$valor,
            'entrada'=>0,
            'folio'  =>$folio,
            'suc'    =>$suc,
            'fecha'  =>date('Y-m-d H:s')
		);
		$insert = $this->db->insert('desarrollo.a_ajustes', $new_member_insert_data);//ajuste

$fecc=date('Y-m-d');    
$sd = "SELECT * FROM desarrollo.inv_cedis_dia a where fecha='$fecc' and sec=$sec and lote='$rx->lote'";
        $qd = $this->db->query($sd);    
if($qd->num_rows() > 0){ 
            $rd= $qd->row();
            $exi=$rd->saju;
            $id_inv_dia=$rd->id;            
                     $datad1 = array(
                    'saju'     => $exi+$valor
                    );
                    $this->db->where('id', $id_inv_dia);
                    $this->db->update('desarrollo.inv_cedis_dia', $datad1);
           

}else{
           $datad = array(
                    'invi'=>$invi,
            		'fecha' =>$fecc,
                    'sec'   =>$sec,
           			'cadu'  =>$rx->cadu,
            		'lote'  =>$rx->lote,
            		'saju'  =>$valor
                    );
                    $this->db->insert('desarrollo.inv_cedis_dia', $datad);  
    
}        
        
$datas = array(
                    'fol'=>$folio,
            		'fecha' =>$fecc,
                    'sec'   =>$sec,
           			'cadu'  =>$rx->cadu,
            		'lote'  =>$rx->lote,
                    'can'   =>$valor
                    );
                    $this->db->insert('desarrollo.surtido', $datas);        
if($valor ==0 and $can > 0 or $valor > 0 and $can == 0){
        $data = array('sur' => $this->input->post('valor'));
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('pedidos', $data);       
}
        
///////////////////////////cuando no existe en inventario
}else{
$invi=0;
$s0 = "SELECT * FROM desarrollo.inv_cedis_dia a where fecha='$fecc' and sec=$sec and lote='$rx->lote'";
        $q0 = $this->db->query($s0);    
if($q0->num_rows() > 0){
    
$datain = array('inv1' =>$invi-$valor);$this->db->where('sec',$sec);$this->db->where('lote','0');$this->db->update('inv_cedis', $datain);//inventario ctl
}else{
        $datain = array(//sec, lote, cadu, inv1, inv2, fechai, id
            'sec'   =>$sec,
            'cadu'   =>'0000-00-00',
       		'lote'   =>0,
            'inv1'   =>0-$valor,
            'inv2'   =>0,
            'fechai'  =>date('Y-m-d H:s')
		);
		$insert = $this->db->insert('desarrollo.inv_cedis', $datain);
}        
        $new_member_insert_data = array(
            'tipo'   =>'FOLIO YA CERRADO',
            'sec'   =>$sec,
            'id_user'=>$id_user,
   			'cadu'   =>'0000-00-00',
       		'lote'   =>0,
            'salida' =>$valor,
            'entrada'=>0,
            'folio'  =>$folio,
            'suc'    =>$suc,
            'fecha'  =>date('Y-m-d H:s')
		);
		$insert = $this->db->insert('desarrollo.a_ajustes', $new_member_insert_data);//ajuste

$fecc=date('Y-m-d');    
$sd = "SELECT * FROM desarrollo.inv_cedis_dia a where fecha='$fecc' and sec=$sec and lote='0'";
        $qd = $this->db->query($sd);    
if($qd->num_rows() > 0){ 
            $rd= $qd->row();
            $exi=$rd->saju;
            $id_inv_dia=$rd->id;            
                     $datad1 = array(
                    'saju'     => $exi+$valor
                    );
                    $this->db->where('id', $id_inv_dia);
                    $this->db->update('desarrollo.inv_cedis_dia', $datad1);
           

}else{
           $datad = array(
                    'invi'=>$invi,
            		'fecha' =>$fecc,
                    'sec'   =>$sec,
           			'cadu'  =>'0000-00-00',
            		'lote'  =>0,
            		'saju'  =>$valor
                    );
                    $this->db->insert('desarrollo.inv_cedis_dia', $datad);  
    
}        
        
$datas = array(
                    'fol'=>$folio,
            		'fecha' =>$fecc,
                    'sec'   =>$sec,
           			'cadu'  =>'0000-00-00',
            		'lote'  =>0,
                    'can'   =>$valor
                    );
                    $this->db->insert('desarrollo.surtido', $datas);        
if($valor > 0 and $cero == 0){
        $data = array('sur' => $this->input->post('valor'));
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('pedidos', $data);       
}    
    
    
}
/////////////////////////////////////////////////////////
}        
//----------------------------------------------------------------------------------- SALIDA        



}
}
                                                                //////************************
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
    function busca_folio()
    {
        $this->load->model('a_surtido_model');
        echo $this->a_surtido_model->busca_folio_cerrado();
    }
    
    public function pedidos_sucursal()
    {
        $data['mensaje']= '';
        $data['titulo']= 'PEDIDOS RECIBIDOS';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "pedidos";
        $data['selector'] = "pedidos";
        $data['sidebar'] = "sidebar1";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    public function historico_pedidos_sucursal()
    {
        $this->load->library('pagination');
        
        $this->load->model('a_surtido_model');
        $config['base_url'] = site_url()."/a_surtido/historico_pedidos_sucursal";
        $config['total_rows'] = $this->a_surtido_model->cuenta_historico_pedidos_sucursal();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '12'; 

        $this->pagination->initialize($config);
        $data['tabla'] = $this->a_surtido_model->control_his_sucursal($config['per_page'], $this->uri->segment(3));
        $data['contenido'] = "a_surtido";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar1";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
    
    public function historico_pedidos_sucursal_especial()
    {
        $this->load->library('pagination');
        
        $this->load->model('a_surtido_model');
        $config['base_url'] = site_url()."/a_surtido/historico_pedidos_sucursal_especial";
        $config['total_rows'] = $this->a_surtido_model->cuenta_historico_pedidos_sucursal_esp();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '12'; 
        
        $this->pagination->initialize($config);
        $data['tabla'] = $this->a_surtido_model->control_his_sucursal_especial($config['per_page'], $this->uri->segment(3)); 
        $data['contenido'] = "a_surtido";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar1";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    }
public function tiket_captura($id)
{
        $data['mensaje']= '';
        $data['titulo']= 'INGRESA NUMERO DE TICKET';
        $data['titulo1']= '';
        $this->load->model('encargado_model');  

		$data['contenido'] = "encargado_form_ventas_ticket_p";
        $data['selector'] = "pedidos";
        $data['sidebar'] = "sidebar1";
        $data['id'] = $id;
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');    
}    
    public function tabla_control1()
    {
        $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('a_surtido_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->a_surtido_model->pedido_sucur();
        
        $data['titulo'] = "EL $dia DE $mesx DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "pedidos";
        $data['selector'] = "pedidos";
        $data['sidebar'] = "sidebar1";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
    
    public function surtidores($id = null)
    {

          
        $this->load->model('a_surtido_model');
        $data['tabla'] = $this->a_surtido_model->surtidores();
        
        
        
        $data['titulo'] = "PERSONAL DE SURTIDO";
        $data['titulo1'] = "";
        $data['contenido'] = "surtidores";
        $data['selector'] = "surtidores";
        $data['sidebar'] = "sidebar_surtido";
        $data['id'] = $id;
        
        $data_head['extraheader'] = "
        <script type=\"text/javascript\" src=\"".base_url()."fancybox/jquery.fancybox-1.3.4.pack.js\"></script>
    	<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."fancybox/jquery.fancybox-1.3.4.css\" media=\"screen\" />
        ";
        
        $this->load->view('header', $data_head);
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    public function nuevo_empleado()
    {
        $this->load->model('a_surtido_model');
        $data['contenido'] = "nuevo_empleado2";
        $data['selector'] = "surtidores";
        $data['sidebar'] = "sidebar_blanco";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function submit1_nuevo_empleado()
    {
        
        $this->load->model('a_surtido_model');
        $id = $this->a_surtido_model->guardar_empleado();
        redirect('a_surtido/surtidores/'.$id);
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
/**
 * REPORTE SURTIDO X CLAVE
 */
    
    function reporte_diario_xclave()
    {
        $data['titulo1'] = "";
        $data['contenido'] = "reporte_diario_fecha3";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_diario_submit_xclave()
    {
        $fecha1 = $this->input->post('fecha1');
        $fecha2 = $this->input->post('fecha2');
        
        $this->load->model('a_surtido_model');

        $data['cabeza'] = $this->a_surtido_model->reporte_diario_encabezado_xclave($fecha1, $fecha2);
        $data['detalle'] = $this->a_surtido_model->reporte_diario_xclave($fecha1, $fecha2);
        $data['detalle_esp'] = $this->a_surtido_model->reporte_diario_espacial_xclave($fecha1, $fecha2);
        $data['detalle_total'] = $this->a_surtido_model->reporte_diario_total_xclave($fecha1, $fecha2);
        
        $this->load->view('impresiones/reporte_diario_xclave', $data);
    }
    
    function reporte_semanal_xclave()
    {
        $data['titulo'] = "Reporte de Surtido Semanal x Clave";
        $data['titulo1'] = "";
        $data['contenido'] = "reporte_diario_fecha3";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_semanal_submit_xclave()
    {
        $semana = $this->input->post('semana');
        $anio = $this->input->post('anio');
        
        $this->load->model('a_surtido_model');

        $data['cabeza'] = $this->a_surtido_model->reporte_semanal_encabezado($semana, $anio);
        $data['detalle_total'] = $this->a_surtido_model->reporte_semanal_total($semana, $anio);
        //echo $data['cabeza'];
        //echo $data['detalle_total'];
        $this->load->view('impresiones/reporte_semanal_captura', $data);
    }
    
    function reporte_mensual_xclave()
    {
        $data['titulo'] = "Reporte de Surtido Mensual x Clave";
        $data['titulo1'] = "";
        $data['contenido'] = "reporte_diario_fecha3";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_mensual_submit_xclave()
    {
        $mes = $this->input->post('mes');
        $anio = $this->input->post('anio');
        
        $this->load->model('a_surtido_model');

        $data['cabeza'] = $this->a_surtido_model->reporte_mensual_encabezado($mes, $anio);
        $data['detalle_total'] = $this->a_surtido_model->reporte_mensual_total($mes, $anio);
        //echo $data['cabeza'];
        //echo $data['detalle_total'];
        $this->load->view('impresiones/reporte_mensual_captura', $data);
    }
    
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
/**
 * REPORTE SURTIDO ERIKA
 */
    
    public function reporte_surtido_diario()
    {
  
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['titulo'] = "Reporte de Surtido";
        $data['contenido'] = "reporte_surtidores";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_surtido";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_surtido_diario_submit()
    {
        $fecha1 = $this->input->post('fecha1');
        $fecha2 = $this->input->post('fecha2');
        
        $this->load->model('a_surtido_model');
        echo $this->a_surtido_model->reporte_surtidores($fecha1, $fecha2);
        echo $this->a_surtido_model->reporte_surtidores1($fecha1, $fecha2);
    }
    
    public function reporte_surtido_mensual1()
    {
  
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['titulo'] = "Reporte de Surtido Mensual";
        $data['contenido'] = "reporte_surtidores_mes";
        $data['selector'] = "a_surtido/surtidores";
        $data['sidebar'] = "sidebar_surtido";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function reporte_surtido_mensual_submit1()
    {
        $fecha1 = $this->input->post('fecha1');
        $fecha2 = $this->input->post('fecha2');
        
        $this->load->model('a_surtido_model');
        echo $this->a_surtido_model->reporte_surtidores2($fecha1, $fecha2);
        
    }
    
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_mue()
    {
        $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('a_surtido_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = '';
        
        
        $data['titulo'] = "CAMBIAR MUEBLE DE UBICACION";
        $data['titulo1'] = "";
        $data['contenido'] = "a_surtido_form_mue";
        $data['selector'] = "a_surtido_mue";
        $data['sidebar'] = "sidebar_a_surtido_mue";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }      
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_control_mue_det()
    {
        $con= $this->input->post('con');
        $this->load->model('catalogo_model');
        $valor=0;  
        $this->load->model('a_surtido_model');
        
        if($con=='verificar'){
        $data['tabla'] = $this->a_surtido_model->mueble();
        $data['titulo'] = "CAMBIAR MUEBLE DE UBICACION ";
        $data['titulo1'] = "";
        $data['con'] = $con;
        $data['contenido'] = "a_surtido_form_mueble_cambiar";
        $data['selector'] = "a_surtido_mue";
        $data['sidebar'] = "sidebar_a_surtido_mue";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        }else{
        redirect('a_surtido/tabla_control_mue');	
        }
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_control_mue_det_var($con)
    {
        $this->load->model('catalogo_model');
        $valor=0;  
        $this->load->model('a_surtido_model');
        
        if($con=='verificar'){
        $data['tabla'] = $this->a_surtido_model->mueble();
        $data['titulo'] = "CAMBIAR MUEBLE DE UBICACION ";
        $data['titulo1'] = "";
        $data['con'] = $con;
        $data['contenido'] = "a_surtido_form_mueble_cambiar";
        $data['selector'] = "a_surtido_mue";
        $data['sidebar'] = "sidebar_a_surtido_mue";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        }else{
        redirect('a_surtido/tabla_control_mue');	
        }
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function cambia_mu()
    {
        $sec= $this->input->post('sec');
        $con= $this->input->post('con');
        $mue= $this->input->post('mue');
       $this->load->model('a_surtido_model');
       $this->a_surtido_model->update_member_mueble($sec,$mue);
        
        redirect('a_surtido/tabla_control_mue_det_var/'.$con);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   function actualiza_mue()
    {
        $data = array('mueble' => $this->input->post('valor'));
        $this->db->where('sec', $this->input->post('id'));
        $this->db->update('catalogo.almacen_mue', $data);
    }
    
    public function salida_codigo()
    {
        $data['mensaje']= '';
        $data['titulo']= 'CAPTURA DE  PEDIDOS';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "a_surtido_salida";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_a_surtido";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      }