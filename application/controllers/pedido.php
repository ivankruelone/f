<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pedido extends CI_Controller
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
        $data['titulo']= 'PEDIDOS RECIBIDOS';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "pedidos";
        $data['selector'] = "pedidos";
        $data['sidebar'] = "sidebar_pedidos";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
       
    public function indexa()
    {
        $data['mensaje']= '';
        $data['titulo']= 'PEDIDOS ESPECIALES';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "pedidos";
        $data['selector'] = "pedidos";
        $data['sidebar'] = "sidebar_pedidos1";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
 /////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
       
    public function indexm($mensaje)
    {
        echo $mensaje;
       if($mensaje==1){$mensajex='<font size="+1" color="#042AFE">EL ARCHIVO FUE ENVIADO CORRECTAMENTE</font>';}
       if($mensaje==2){$mensajex='<font size="+1" color="#FA0404">EL ARCHIVO NO SE ENVIO</font>';}
       if($mensaje==3){$mensajex='<font size="+1" color="#FA0404">VERIFICA TU FECHA</font>';}
        $data['mensaje']= $mensajex;
      
        
        
        $data['titulo']= 'PEDIDOS RECIBIDOS';
        $data['titulo1']= $mensajex;
        $data['tabla']= '';
        $data['contenido'] = "pedidos";
        $data['selector'] = "pedidos";
        $data['sidebar'] = "sidebar_pedidos";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
   
 
/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control()
    {
        $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('pedidos_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->pedidos_model->control();
        
        $data['titulo'] = "PEDIDOS RECIBIDOS DEL $dia DE $mesx DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "pedidos";
        $data['selector'] = "pedidos";
        $data['sidebar'] = "sidebar_pedidos";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
  
/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_12()
    {
        
        $data['contenido'] = "pedidos_12";
        $data['selector'] = "pedidos";
        $data['sidebar'] = "sidebar_pedidos";
        $data['tabla'] = " ";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function tabla_contol_12_00()
    {
    $hora= $this->input->post('hora');    
    $fec1= $this->input->post('fec1');
    
    
    
   
    $data['contenido'] = "pedidos_12";
    $data['selector'] = "pedidos";
    $data['sidebar'] = "sidebar_pedidos";
    $this->load->model('pedidos_model');
    $data['tabla'] = $this->pedidos_model->sucursales($hora,$fec1);
        
            $this->load->view('header');
            $this->load->view('main', $data);
            $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
  
  
  function borrar_pedidos($fol)
    {
    $this->load->model('pedidos_model');
    $this->pedidos_model->delete_member($fol);
    redirect('pedido/tabla_control');
    }
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
          $rutax = $this->catalogo_model->busca_sucursal_ruta($suc,$fol);  
            
            $data['cabeza'].= "
           <table width=\"680\">
           
           <tr>
           <td colspan=\"5\" align=\"center\"><strong>PREVIO DE PEDIDOS</strong></td>
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
           <th width=\"40\" align=\"center\"><strong>UBIC</strong></th>
           <th width=\"40\" align=\"left\"><strong>CVE</strong></th>
           <th width=\"310\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
           <th width=\"220\" align=\"left\"><strong>DESCRIPCION</strong></th>
           <th width=\"70\" align=\"right\"><strong>CANTIDAD</strong></th>
          </tr>
          <br/><br/><br/>
           </table> 
            ";
            $data['fol']=$fol;
            $this->load->view('impresiones/previo_de_pedidos', $data);
            
		}      
        
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
    function imprime_pedidos_pagina($fol,$suc)
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
          
          
          $cabe='';
          $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $sucx = $this->catalogo_model->busca_suc_unica($suc);
          $rutax = $this->catalogo_model->busca_sucursal_ruta($suc,$fol);  
            
            $cabe.= "
           <table width=\"680\">
           
           <tr>
           <td colspan=\"5\" align=\"center\"><strong>PREVIO DE PEDIDOS</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
           </tr>
           <tr>
           <td colspan=\"3\" align=\"right\">RUTA.:".$rutax." </td>
           <td colspan=\"2\" align=\"right\">Fecha .:".date('Y-m-d')." </td>
           </tr>
           <tr>
           <td colspan=\"3\" align=\"left\"><strong>SUCURSAL..:$suc - $sucx </strong> <br /></td>
            <td colspan=\"2\" align=\"ribht\"><strong>FOLIO..:$fol </strong> <br /></td>
           </tr>
            
          <br/><br/><br/>
           </table> 
            ";
     $this->load->model('pedidos_model');
     $data['tabla'] = $this->pedidos_model->imprime_en_pagina($fol,$cabe);
            
		}      
        
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////

    function imprime_pedidos_06($fol,$suc)
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
          
          
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $sucx = $this->catalogo_model->busca_suc_unica($suc);
          $rutax = $this->catalogo_model->busca_sucursal_ruta($suc,$fol);
       
            
            $data['cabeza'].= "
           <table>
           
           <tr>
           <td colspan=\"5\" align=\"center\"><strong>PREVIO DE PEDIDOS MUEBLE 6 </strong></td>
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
           <th width=\"40\" align=\"center\"><strong>UBIC</strong></th>
           <th width=\"40\" align=\"left\"><strong>CVE</strong></th>
           <th width=\"310\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
           <th width=\"220\" align=\"left\"><strong>DESCRIPCION</strong></th>
           <th width=\"70\" align=\"right\"><strong>CANTIDAD</strong></th>
           
          </tr>
           </table> 
            ";
            $data['fol']=$fol;
            $this->load->view('impresiones/previo_de_pedidos_06', $data);
            
		}      
        
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
   function imprime_pedidos_ctl_fol()
        {
        $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $data['fechax']=date('Y-m-d');
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);

//        $aaa=2012;
//        $mes=12;
//        $dia=26;
//        $data['fechax']='2012-12-26';
//        $this->load->model('catalogo_model');
//        $mesx = $this->catalogo_model->busca_mes_unico($mes);

        
        $this->load->model('pedidos_model');
        $data['fechac']= $data['fechax'];
        $data['tabla'] = '';        
        $data['titulo'] = "PEDIDOS QUE SE ENVARAN DEL $dia DE $mesx DEL $aaa AL AS/400";
        $data['titulo1'] = "";
        $data['contenido'] = "pedido_form_1";
        $data['selector'] = "pedidos";
        $data['sidebar'] = "sidebar_pedidos";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
    function imprime_pedidos_ctl($salida = 'I')
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $fecha=date('Y-m-d');
        

//	    $aaa=2012;
//        $mes=12;
//        $dia=26;
//        $fecha='2012-12-26';
		$fecha_archivo = date('Y_m_d');

		$fol1 = $this->input->post('fol1'); 
         $fol2 = $this->input->post('fol2');
        
        if(isset($fol1) && $fol1 != null && isset($fol2) && $fol2 != null){
            
        }else{
            
            $sql_folios = "SELECT min(fol) as fol1, max(fol) as fol2 FROM pedidos p where date(fechas) = date(now());";
            
            $q_folios = $this->db->query($sql_folios);
            $r_folios = $q_folios->row();
            
            $fol1 = $r_folios->fol1;
            $fol2 = $r_folios->fol2;
            
        }
          
          $nomarchivo = 'resp/'.$fecha_archivo.'/pdf/rf_folios.pdf';
          
          $data['cabeza']='';
          $data['nomarchivo'] = $nomarchivo;
          $data['salida'] = $salida;
          
          $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
       
            
            $data['cabeza'].= "
           <table>
           
           <tr>
           <td colspan=\"7\" align=\"center\"><strong>REPORTE DE SUCURSALES QUE TRANSMITIERON PEDIDOS</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"7\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
           </tr>
           <tr>
           <td colspan=\"7\" align=\"right\">Fecha .:".date('Y-m-d')." </td>
           </tr>
           <tr>
           <td colspan=\"7\" align=\"left\"><strong>ENCARGADO DE PEDIDOS: LAURA GARCIA PEREZ </strong> <br /></td>
           
           </tr>
           <tr>
           <th width=\"30\" align=\"center\"><strong>#</strong></th>
           <th width=\"150\" align=\"center\"><strong>RUTA</strong></th>
           <th width=\"70\" align=\"center\"><strong>FOLIO</strong></th>
           <th width=\"30\" align=\"center\"><strong>TIPO</strong></th>
           <th width=\"160\" align=\"left\"><strong>SUCURSAL</strong></th>
           <th width=\"55\" align=\"right\"><strong>MUE. 0-5 </strong></th>
           <th width=\"50\" align=\"right\"><strong>MUE. 6</strong></th>
           <th width=\"55\" align=\"right\"><strong>C.PED</strong></th>
            <th width=\"80\" align=\"right\"><strong>$ IMP</strong></th>
          </tr>
           </table> 
            ";
            $data['fecha']=$fecha;
            $data['fol1']=$fol1;
            $data['fol2']=$fol2;
            $this->load->view('impresiones/previo_de_pedidos_ctl', $data);
            
		}      
        

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
    function imprime_pedidos_ctl_fal($salida = 'I')
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $fecha=date('Y-m-d');
          
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $data['salida'] = $salida;
          $nomarchivo = 'resp/'.date('Y_m_d').'/pdf/rf_fal.pdf';
          $data['nomarchivo'] = $nomarchivo;
       
            
            $data['cabeza'].= "
           <table>
           
           <tr>
           <td colspan=\"6\" align=\"center\"><strong>REPORTE DE SUCURSALES QUE NO TRANSMITIERON PEDIDOS<BR /><BR /></strong></td>
           </tr>
           
           <tr>
           <td colspan=\"6\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
           </tr>
           <tr>
           <td colspan=\"6\" align=\"right\">Fecha .:".date('Y-m-d')." </td>
           </tr>
           <tr>
           <td colspan=\"6\" align=\"left\"><strong>ENCARGADO DE PEDIDOS: LAURA GARCIA PEREZ</strong> <br /></td>
           </tr>
           <tr>

           <td colspan=\"6\" align=\"left\">POR MEDIO DEL PRESENTE ENTREGO LISTADO DE SUCURSALES QUE NO TRANSMITIERON PEDIDOS<br />
           DEL $dia DE $mesx DEL $aaa<br /></td>
           </tr>
           
           <tr>
            <th width=\"30\" align=\"center\"><strong>#</strong></th>
           <th width=\"40\" align=\"center\"><strong>TIPO</strong></th>
           <th width=\"200\" align=\"left\"><strong>SUCURSAL</strong></th>
           </tr>
           
           </table> 
            ";
            $data['fecha']=$fecha;
            $this->load->view('impresiones/previo_de_pedidos_ctl_fal', $data);
            
		}      
        

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
    function imprime_pedidos_ctl_sec($salida = 'I')
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $fecha=date('Y-m-d');
          
          
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $nomarchivo = 'resp/'.date('Y_m_d').'/pdf/rf_sec.pdf';
          $data['salida'] = $salida;
          $data['nomarchivo'] = $nomarchivo;
       
            
            $data['cabeza'].= "
           <table>
           
           <tr>
           <td colspan=\"4\" align=\"center\"><strong>REPORTE DE PRODUCTOS POR CLAVE</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"4\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
           </tr>
           <tr>
           <td colspan=\"4\" align=\"right\">Fecha .:".date('Y-m-d')." </td>
           </tr>
           <tr>
           <td colspan=\"4\" align=\"left\"><strong>ENCARGADO DE PEDIDOS: LAURA GARCIA PEREZ</strong> <br /></td>
           
           </tr>
           <tr>
           <th width=\"50\" align=\"center\"><strong>UBIC</strong></th>
           <th width=\"70\" align=\"center\"><strong>SEC</strong></th>
           <th width=\"300\" align=\"center\"><strong>SUSTANCIA ACTIVA</strong></th>
           <th width=\"70\" align=\"right\"><strong>CANT.PED</strong></th>
          </tr>
           </table> 
            ";
            $data['fecha']=$fecha;
            $this->load->view('impresiones/previo_de_pedidos_ctl_sec', $data);
            
		}      
        

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_envio()
    {
        $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $data['fechax']=date('Y-m-d');
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        
        $this->load->model('pedidos_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = '';        
        $data['titulo'] = "PEDIDOS QUE SE ENVARAN DEL $dia DE $mesx DEL $aaa AL AS/400";
        $data['titulo1'] = "";
        $data['contenido'] = "pedido_form_0";
        $data['selector'] = "pedidos";
        $data['sidebar'] = "sidebar_pedidos";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_envio_fin()
    {
        $fechax=$this->input->post('fechax');
        $this->load->model('pedidos_model');
		$mensaje=$this->pedidos_model->envio_member($fechax);
redirect('pedido/indexm/'.$mensaje);
  
}
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////historico de pedidos para verificar lo que captura la sucursal
   public function tabla_control_his()
    {
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        $data['titulo'] = "PEDIDOS GENERADOS POR LA WEB";
        $data['titulo1'] = "";
        $data['contenido'] = "pedidos_form_his";
        $data['selector'] = "pedidos";
        $data['sidebar'] = "sidebar_pedidos";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_ctl()
    {
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('pedidos_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->pedidos_model->control_ped_his($fec);
        
        $data['titulo'] = "PEDIDOS GENERADOS POR LA WEB DEL MES DEL $mesx DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "pedidos";
        $data['selector'] = "pedidos";
        $data['sidebar'] = "sidebar_pedidos";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_fol($suc,$fec)
    {
        $aaa= substr($fec,0,4);
        $mes= substr($fec,6,2);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('pedidos_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->pedidos_model->control_ped_suc($suc,$fec);
        
        $data['titulo'] = "PEDIDOS GENERADOS POR LA WEB DEL MES DEL $mesx DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "pedidos";
        $data['selector'] = "pedidos";
        $data['sidebar'] = "sidebar_pedidos";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_compara($fol,$fec)
    {
        $aaa= substr($fec,0,4);
        $mes= substr($fec,6,2);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('pedidos_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->pedidos_model->control_ped_compara($fol,$fec);
        
        $data['titulo'] = "PEDIDOS GENERADOS POR LA WEB DEL MES DEL $mesx DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "pedidos";
        $data['selector'] = "pedidos";
        $data['sidebar'] = "sidebar_pedidos";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_control_pendientes()
    {
        $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('a_surtido_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->a_surtido_model->control();
        
        
        $data['titulo'] = "PEDIDOS PENDIENTES DE CERRAR";
        $data['titulo1'] = "";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_pedidos";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
  
  
  function tabla_pedidos_dia()
    {
        $data['titulo'] = "Reporte de Sucursales Transmitidas";
        $data['titulo1'] = "";
        $data['contenido'] = "reporte_suc_dia";
        $data['selector'] = "a_surtido";
        $data['sidebar'] = "sidebar_pedidos";
        $this->load->model('catalogo_model');
        $data['diax'] = $this->catalogo_model->busca_dia_surtido();
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }   
    
    
   public function muestra_pedidos()
    {   
        $this->load->model('catalogo_model');
        $data['contenido'] = "tabla_reporte_suc_dia";
        $data['sidebar'] = "sidebar_pedidos";
      
   

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }     
    
      }