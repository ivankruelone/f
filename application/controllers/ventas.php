<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ventas extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
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
        $data['titulo']= 'REPORTE DE VENTAS';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
 /////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function calculo_comision()
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes();
        $this->load->model('ventas_model');
       	$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        
        $data['titulo'] = "PREVIO DE COMISIONES";
        $data['titulo1'] = "";
        $data['tabla'] = '';
        $data['tabla'] = $this->ventas_model->ver_comision_pendiente();
        $data['contenido'] = "ventas_form_premio";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///////////////////////////////////////////////////////////paso1

   public function calcula_premio()
    {
        $contra=$this->input->post('contra');
        
     if($contra=='losiento'){ 
        $fec=$this->input->post('aaa').'-'.str_pad($this->input->post('mes'),2,"0",STR_PAD_LEFT);
        $this->load->model('ventas_model');
        $this->ventas_model->control_ventas_premios_genera($fec);
        redirect('ventas/calculo_comision');
        }else{
        redirect('ventas/calculo_comision');    
        }    
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function premio_ctl($fec)
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes();
        $this->load->model('ventas_model');
       	$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        
        $data['titulo'] = "PREVIO DE PREMIOS";
        $data['titulo1'] = "";
        $data['tabla'] = $this->ventas_model->control_premio_ctl($fec);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function premio_ctl_suc($fec,$suc)
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes();
        $this->load->model('ventas_model');
       	$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        
        $data['titulo'] = "PREVIO DE PREMIOS";
        $data['titulo1'] = "";
        $data['tabla'] = $this->ventas_model->control_premio_ctl_suc($fec,$suc);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function borrar_pre($fec,$suc,$id)
    {
        
    $this->load->model('ventas_model');
    $this->ventas_model->borrar_premio($id);
    redirect('ventas/premio_ctl_suc/'.$fec.'/'.$suc);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////paso1

   public function premio_ctl_val($fec)
    {
        $this->load->model('ventas_model');
        $this->ventas_model->control_ventas_premios_val($fec);
        redirect('ventas/calculo_comision');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////paso1

   public function premio_ctl_imp($fec)
    {
      $aaa=substr($fec,0,4);
      $mes=substr($fec,5,2);
      $fecc=date('Y-m-d H:i:s');
      $this->load->model('catalogo_model');
      $mesx = $this->catalogo_model->busca_mes_unico($mes); 
      $data['cabeza']='';          
      $data['cabeza'].= "
      <table>
           
    <tr>
    <td colspan=\"2\" align=\"center\"><font size=\"+3\"><strong>PREMIOS GENERADOS DEL MES DE $mesx  DEL $aaa</strong></font></td>
    </tr>
    <tr>
    <td colspan=\"2\" align=\"rigrt\"><font size=\"-1\"><strong>Fecha de Impresion: $fecc</strong></font></td>
    </tr>
   </table> 
            ";
            $data['fec']=$fec;
            $this->load->view('impresiones/ventas_premio', $data);
 

    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////paso1
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function premio_ctl_his($fec)
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes();
        $this->load->model('ventas_model');
       	$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        
        $data['titulo'] = "PREVIO DE PREMIOS";
        $data['titulo1'] = "";
        $data['tabla'] = $this->ventas_model->control_premio_ctl_his($fec);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function premio_ctl_suc_his($fec,$suc)
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes();
        $this->load->model('ventas_model');
       	$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        
        $data['titulo'] = "PREVIO DE PREMIOS";
        $data['titulo1'] = "";
        $data['tabla'] = $this->ventas_model->control_premio_ctl_suc_his($fec,$suc);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function calcula_ventas_naturistas()
    {
        $data['mensaje']= '';
        $data['titulo']= 'COMISION VENTAS NATURISTAS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('ventas_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['tabla'] = $this->ventas_model->ctl_ventas_naturistas();
        $data['contenido'] = "ventas_form_ventas_naturistas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////    
   public function graba_control_ventas_naturistas()
    {
     $contra=$this->input->post('contra');
     if($contra=='losiento'){   
        $fec=$this->input->post('aaa').'-'.str_pad($this->input->post('mes'),2,"0",STR_PAD_LEFT);
        $this->load->model('ventas_model');
        $this->ventas_model->calcula_control_ventas_naturistas($fec);
        redirect('ventas/calcula_ventas_naturistas');
     }else{
        redirect('ventas/calcula_ventas_naturistas');
     }
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function calcula_ventas_naturistas_una()
    {
        $data['mensaje']= '';
        $data['titulo']= 'COMISION VENTAS NATURISTAS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('ventas_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['tabla'] = $this->ventas_model->ctl_ventas_naturistas();
        $data['contenido'] = "ventas_form_ventas_naturistas_una";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////    
   public function graba_control_ventas_naturistas_una()
    {
     $contra=$this->input->post('contra');
     if($contra=='losiento'){   
        $fec=$this->input->post('aaa').'-'.str_pad($this->input->post('mes'),2,"0",STR_PAD_LEFT);
        $this->load->model('ventas_model');
        $this->ventas_model->calcula_control_ventas_naturistas_una($fec,$this->input->post('suc'));
        redirect('ventas/calcula_ventas_naturistas_una');
     }else{
        redirect('ventas/calcula_ventas_naturistas_una');
     }
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_ventas_naturistas($fec)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        $this->load->model('ventas_model');
        
        $data['tabla'] = $this->ventas_model->control_ventas_naturistas($fec);
        
        $data['titulo'] = "REPORTE DE COMISIONES DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = " $mesx";
        $data['titulo2'] = " ";
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
   }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function venta_producto_naturistas($suc,$fec)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('ventas_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->ventas_model->control_ventas_producto_naturistas($fec,$suc);
                
        $data['titulo'] = "REPORTE DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = "";
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function actualiza_enc()
    {
        
        $data = array('i_enc' => $this->input->post('valor'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('comision_det', $data);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function actualiza_jef()
    {
        
        $data = array('i_jef' => $this->input->post('valor'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('comision_det', $data);
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function borrar_com($fec,$suc,$id)
    {
        
    $this->load->model('ventas_model');
    $this->ventas_model->borrar_premio($id);
    redirect('ventas//venta_producto_naturistas/'.$fec.'/'.$suc);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////paso1

   public function comision_ctl_val($fec)
    {
        $this->load->model('ventas_model');
        $this->ventas_model->control_ventas_comision_val($fec);
        redirect('ventas/calculo_comision');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////paso1

   public function comision_ctl_imp($fec)
    {
      $aaa=substr($fec,0,4);
      $mes=substr($fec,5,2);
      $fecc=date('Y-m-d H:i:s');
      $this->load->model('catalogo_model');
      $mesx = $this->catalogo_model->busca_mes_unico($mes); 
      $data['cabeza']='';          
      $data['cabeza'].= "
      <table>
           
    <tr>
    <td colspan=\"2\" align=\"center\"><font size=\"+3\"><strong>COMISIONES GENERADAS DEL MES DE $mesx  DEL $aaa</strong></font></td>
    </tr>
    <tr>
    <td colspan=\"2\" align=\"rigrt\"><font size=\"-1\"><strong>Fecha de Impresion: $fecc</strong></font></td>
    </tr>
   </table> 
            ";
            $data['fec']=$fec;
            $this->load->view('impresiones/ventas_comision_naturista', $data);
 

    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////paso1
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function comision_ctl_his($fec)
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes();
        $this->load->model('ventas_model');
       	$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        
        $data['titulo'] = "PREVIO DE PREMIOS";
        $data['titulo1'] = "";
        $data['tabla'] = $this->ventas_model->control_comision_ctl_his($fec);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function comision_ctl_suc_his($fec,$suc)
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes();
        $this->load->model('ventas_model');
       	$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        
        $data['titulo'] = "PREVIO DE COMISION";
        $data['titulo1'] = "";
        $data['tabla'] = $this->ventas_model->control_comision_ctl_suc_his($fec,$suc);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//public function venta_producto_naturistas_empleado($suc,$fec,$nomina,$meta)
//    {
//        $aaa=substr($fec,0,4);
//        $mes=substr($fec,5,2); 
//		$this->load->model('cat/alogo_model');
//      $mesx = $this->catalogo_model->busca_mes_unico($mes);
//        $sucx =$this->catalogo_model->busca_suc_unica($suc); 
//        $this->load->model('supervisor_model');
//        $data['fechac']= date('Y-m-d');
//        $data['tabla'] = $this->supervisor_model->control_ventas_producto_nat_empleado($fec,$suc,$nomina,$meta);
//        $data['titulo'] = "REPORTE DEL MES DE $mesx DEL $aaa ";
//        $data['titulo1'] = " $suc - $sucx";
//        $data['contenido'] = "ventas";
//        $data['selector'] = "ventas";
//        $data['sidebar'] = "sidebar_ventas";
//        $this->load->view('header');
//        $this->load->view('main', $data);
//        $this->load->view('extrafooter');
//    }
/////////////////////////////////////////////////////////////////////////////////////////
   public function venta_medico()
    {
        $data['mensaje']= '';
        $data['titulo']= 'COMISION VENTAS NATURISTAS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "ventas_form_medico_naturistas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
  
    }

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function venta_medico_naturistas()
    {
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         
        $this->load->model('ventas_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->ventas_model->control_ventas_medico_naturistas($fec);
        
        $data['titulo'] = "REPORTE DE COMISIONES DEL MES DE $mesx DEL $aaa ";
        
        $data['titulo2'] = " ";
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////
public function venta_medico_naturistas_empleado($suc,$fec,$nomina)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
        $meta=13;
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_ventas_producto_nat_empleado($fec,$suc,$nomina,$meta);
        
        $data['titulo'] = "REPORTE DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = " $suc - $sucx";
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////











































































































































       
    public function fecha()
    {
        $data['mensaje']= '';
        $data['titulo']= 'REPORTE DE VENTAS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "ventas_form_0";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control()
    {
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('ventas_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->ventas_model->control($fec);
        
        $data['titulo'] = "REPORTES DE VENTAS DEl MES DE $mesx DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function control_dia($suc,$fec)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('ventas_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->ventas_model->control_dia($fec,$suc);
        
        $data['titulo'] = "REPORTES DE VENTAS DEl MES DE $mesx DEL $aaa DE LA SUCURSAL.: $sucx";
        $data['titulo1'] = "";
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function detalle($suc,$fec)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('ventas_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->ventas_model->detalle_codigo($fec,$suc);
        
        $data['titulo'] = "REPORTES DE VENTAS DEl MES DE $mesx DEL $aaa DE LA SUCURSAL.: $sucx";
        $data['titulo1'] = "";
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////7    
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////7    
/////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////7    
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////7    
/////////////////////////////////////////////////////////////////////////////////////////////TARJETAS DE CLIENTE PREFERENTE
/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_tar()
    {
        $aaa= date('Y');
        $mes= date('m');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('ventas_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->ventas_model->control_tar($fec);
        
        $data['titulo'] = "TARJETAS DE CLIENTE PREFERENTE DE $mesx DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function detalle_tar($suc,$fol1,$fol2)
    {
        $this->load->model('catalogo_model');
        $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('ventas_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->ventas_model->detalle_codigo_tar($suc,$fol1,$fol2);
        
        $data['titulo'] = "REPORTES DE TARJETAS DE LA SUCURSAL.: $sucx";
        $data['titulo1'] = "";
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function detalle_tar_otras($suc)
    {
        $this->load->model('catalogo_model');
        $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('ventas_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->ventas_model->detalle_codigo_tar_otras($suc);
        
        $data['titulo'] = "REPORTES DE TARJETAS DE LA SUCURSAL.: $sucx";
        $data['titulo1'] = "";
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////7    
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
       
    public function fecha_tar()
    {
        $data['mensaje']= '';
        $data['titulo']= 'REPORTE DE VENTAS DE PRODUCTOS CON TARJETA';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "ventas_form_tar";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_pro()
    {
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('ventas_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->ventas_model->detalle_pro($fec);
        
        $data['titulo'] = "REPORTES DE VENTAS DEL MES DE $mesx DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function detalle_tar_pro_g($fec,$cod,$descri)
    {
         $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);       
        $this->load->model('ventas_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->ventas_model->detalle_tar_pro($fec,$cod,$descri);
        
		$data['titulo'] = "PRODUCTOS MARCADOS CON DESCUENTOS $aaa DEL MES DE $mesx";
        $data['titulo1'] = "";
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////7    
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////7    
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////7
/////////////////////////////////////////////////////////////////////////////////////////////lidia
       
    public function fecha_cli()
    {
        $data['mensaje']= '';
        $data['titulo']= 'REPORTE DE VENTAS POR CLIENTE';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "ventas_form_cli";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_cli()
    {
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('ventas_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->ventas_model->control_cli($fec);
        
        $data['titulo'] = "REPORTES DE VENTAS POR CLIENTE DEL MES DE $mesx DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function detalle_cli($codigo,$fec)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        $this->load->model('ventas_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->ventas_model->detalle_codigo_cli($codigo,$fec);
        
        $data['titulo'] = "REPORTES DE VENTAS DEL MES DE $mesx DEL $aaa DE TARJETA $codigo";
        $data['titulo1'] = "";
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
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

public function busca_ventas_naturistas()
    {
        $data['mensaje']= '';
        $data['titulo']= 'BUSCA COMISION VENTAS NATURISTAS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['tabla'] = '';
        $data['contenido'] = "ventas_form_busca_naturistas_una";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   
    }
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function busca_ventas_naturistas_suc()
    {
        $aaa=$this->input->post('aaa');
        $fec=$this->input->post('aaa').'-'.str_pad($this->input->post('mes'),2,"0",STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($this->input->post('mes'));
        $this->load->model('ventas_model');
        
        $data['tabla'] = $this->ventas_model->busca_control_ventas_naturistas($fec);
        
        $data['titulo'] = "REPORTE DE COMISIONES DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = " $mesx";
        $data['titulo2'] = " ";
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
   
    }       

































































































































   public function calculo_comision_detalle($fecha)
    {
       $this->load->model('ventas_model');
        $this->ventas_model->comision_empleado($fecha);
        
        redirect('ventas/calculo_comision');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function comision_det($fecha)
    {
        $this->load->model('ventas_model');
       	
        $data['titulo'] = "PREVIO DE COMISIONES $fecha";
        $data['titulo1'] = "";
        $data['tabla'] = $this->ventas_model->comision_det($fecha);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function comision_det_nat($fecha)
    {
        $this->load->model('ventas_model');
       	
        $data['titulo'] = "PREVIO DE COMISIONES $fecha";
        $data['titulo1'] = "";
        $data['tabla'] = $this->ventas_model->comision_det_nat($fecha);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function comision_det_sin($fecha)
    {
        $this->load->model('ventas_model');
       	
        $data['titulo'] = "CONCENTRADO DE VENTAS DE SUCURSALES QUE NO GENERARON COMISION $fecha";
        $data['titulo1'] = "";
        $data['tabla'] = $this->ventas_model->comision_det_sin($fecha);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function calculo_comision_val($fecha)
    {
       $this->load->model('ventas_model');
        $this->ventas_model->comision_empleado_val($fecha);
        
        redirect('ventas/calculo_comision');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function calculo_comision_bor($fecha)
    {
       $this->load->model('ventas_model');
        $this->ventas_model->comision_empleado_bor($fecha);
        
        redirect('ventas/calculo_comision');
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function imprimir_det1($fecha,$suc)
    {
        $data['cabeza']='';
          $this->load->model('catalogo_model');
          $aaa=substr($fecha,0,4);
          $mes=substr($fecha,5,2);
          
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $sucx =$this->catalogo_model->busca_suc_unica($suc);  
            $data['cabeza'].= " ";
$data['fecha']=$fecha;
$data['suc']=$suc;
$data['mesx']=$mesx;
$data['sucx']=$sucx;
$data['mes']=$aaa;
$data['aaa']=$aaa;
            $this->load->view('impresiones/comision_una1', $data);
    }   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function imprimir_det2($fecha,$suc)
    {
        $data['cabeza']='';
          $this->load->model('catalogo_model');
          $aaa=substr($fecha,0,4);
          $mes=substr($fecha,5,2);
          
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $sucx =$this->catalogo_model->busca_suc_unica($suc);  
            $data['cabeza'].= " ";
$data['fecha']=$fecha;
$data['suc']=$suc;
$data['mesx']=$mesx;
$data['sucx']=$sucx;
$data['mes']=$aaa;
$data['aaa']=$aaa;
            $this->load->view('impresiones/comision_una2', $data);
    }   

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function imprimir_det_ger1($fecha)
    {
        ini_set('memory_limit','2000M');
    set_time_limit(0);
        $data['cabeza']='';
          $this->load->model('catalogo_model');
          $aaa=substr($fecha,0,4);
          $mes=substr($fecha,5,2);
          
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
$data['cabeza'].= " ";
$data['fecha']=$fecha;
$data['mesx']=$mesx;
$data['mes']=$aaa;
$data['aaa']=$aaa;
            $this->load->view('impresiones/comision_ger1', $data);
    }   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function imprimir_det_sup1($fecha)
    {
        ini_set('memory_limit','2000M');
    set_time_limit(0);
        $data['cabeza']='';
          $this->load->model('catalogo_model');
          $aaa=substr($fecha,0,4);
          $mes=substr($fecha,5,2);
          
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
$data['cabeza'].= " ";
$data['fecha']=$fecha;
$data['mesx']=$mesx;
$data['mes']=$aaa;
$data['aaa']=$aaa;
            $this->load->view('impresiones/comision_sup1', $data);
    }   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function imprimir_det_ger2($fecha)
    {
        ini_set('memory_limit','2000M');
    set_time_limit(0);
        $data['cabeza']='';
          $this->load->model('catalogo_model');
          $aaa=substr($fecha,0,4);
          $mes=substr($fecha,5,2);
          
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
$data['cabeza'].= " ";
$data['fecha']=$fecha;
$data['mesx']=$mesx;
$data['mes']=$aaa;
$data['aaa']=$aaa;
            $this->load->view('impresiones/comision_ger2', $data);
    }   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function imprimir_det_sup2($fecha)
    {
        ini_set('memory_limit','2000M');
    set_time_limit(0);
        $data['cabeza']='';
          $this->load->model('catalogo_model');
          $aaa=substr($fecha,0,4);
          $mes=substr($fecha,5,2);
          
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
$data['cabeza'].= " ";
$data['fecha']=$fecha;
$data['mesx']=$mesx;
$data['mes']=$aaa;
$data['aaa']=$aaa;
            $this->load->view('impresiones/comision_sup2', $data);
    }   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////































   public function pru()
    {
    ini_set('memory_limit','2000M');
    set_time_limit(0);
     $this->load->model('genera_pdv_model');
     $mensaje = $this->genera_pdv_model->gernera();  
     echo $mensaje;
    }    
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////7    
/////////////////////////////////////////////////////////////////////////////////////////////
public function agrega_targ()
    {
        $this->load->model('catalogo_model');
        $data['tabla']= $this->catalogo_model->targetas_validar();
        $data['contenido'] = "targetas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_ventas";
        $data['sucursal'] = $this->catalogo_model->busca_sucursal_tar();
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function submit_nueva_tarjeta()
    {
        
        $this->load->model('catalogo_model');
        $id = $this->catalogo_model->guardar_tarjeta();
        redirect('ventas/agrega_targ/'.$id);
    }
    
    function validar($id)
    {
        
        $this->load->model('catalogo_model');
        $id=$this->catalogo_model->validar_targeta($id);
        redirect('ventas/agrega_targ/'.$id);
        
       
    }
    
    public function eliminar($id)
    {
        $this->load->model('catalogo_model');
        $this->catalogo_model->eliminar_targeta($id);
        redirect('ventas/agrega_targ/');
    }
    
    
      }