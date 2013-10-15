<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Direccion extends CI_Controller
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

       public function index_gcomercial()
    {
        $data['titulo'] = '';
        $data['tabla'] = 'BUENOS DIAS A TODO EL PERSONAL<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_direccion_gcomercial";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }
/////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

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
        $data['sidebar'] = "sidebar_direccion_gcomercial";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
              
    
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_desplaza_gral_nid()
    {
        
        $data['mensaje']= '';
        $data['titulo']= 'Maximo generado por sucursal';
        $data['var']='0';
        $this->load->model('nacional_model');
		$data['tabla'] = '';
        $data['contenido'] = "nacional_form_pedidos_ger_for_gral_nid";
        $data['selector'] = "nacional";
        $data['sidebar'] = "sidebar_direccion_gcomercial";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
              
    
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_desplaza_campa()
    {
        
        $data['mensaje']= '';
        $data['titulo']= 'Maximo generado por campa&ntilde;a';
        $data['var']='0';
        $this->load->model('nacional_model');
		$data['tabla'] = '';
        $data['contenido'] = "nacional_form_pedidos_campa";
        $data['selector'] = "nacional";
        $data['sidebar'] = "sidebar_direccion_gcomercial";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
              
    
    }

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_desplaza_modulos()
    {
        
        $data['mensaje']= '';
        $this->load->model('catalogo_model');
        $tit= 'Desplazamiento de modulos';
        $numero=$this->catalogo_model->busca_suc_generica();
        $this->load->model('nacional_model');
        $data['tabla'] = $this->nacional_model->control_desplaza_modulos($tit);
        $this->load->view('contenidos/viu_15', $data);     
    }
         public function tabla_desplaza_modulos_suc($suc)
    {
        
        $data['mensaje']= '';
        $this->load->model('catalogo_model');
        $tit= 'Desplazamiento de modulos';
        $numero=$this->catalogo_model->busca_suc_generica();
        $this->load->model('nacional_model');
        $data['tabla'] = $this->nacional_model->control_desplaza_modulos_suc($tit,$suc);
        $this->load->view('contenidos/viu_16', $data);     
    }
//******************************************************************************************
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function premios_dias()
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes();
        $this->load->model('direccion_model');
       	$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        
        $data['titulo'] = "PREMIOS EN DIAS";
        $data['titulo1'] = "";
        $data['tabla'] = '';
        $data['tabla'] = $this->direccion_model->ver_premios_dias();
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_direccion_gcomercial";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///////////////////////////////////////////////////////////paso1
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function premio_ctl_his($fec)
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes();
        $this->load->model('direccion_model');
       	$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        
        $data['titulo'] = "PREVIO DE PREMIOS";
        $data['titulo1'] = "";
        $data['tabla'] = $this->direccion_model->control_premio_ctl_his($fec);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_direccion_gcomercial";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function premio_ctl_suc_his($fec,$suc)
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes();
        $this->load->model('direccion_model');
       	$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        
        $data['titulo'] = "PREVIO DE PREMIOS";
        $data['titulo1'] = "";
        $data['tabla'] = $this->direccion_model->control_premio_ctl_suc_his($fec,$suc);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_direccion_gcomercial";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
//******************************************************************************************
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function comision_()
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes();
        $this->load->model('direccion_model');
       	$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        
        $data['titulo'] = "COMISIONES NATURISTAS DE SUCURSALES Y MEDICOS";
        $data['titulo1'] = "";
        $data['tabla'] = '';
        $data['tabla'] = $this->direccion_model->ver_comision();
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_direccion_gcomercial";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///////////////////////////////////////////////////////////paso1
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function comision_ctl_his($fec)
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes();
        $this->load->model('direccion_model');
       	$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        
        $data['titulo'] = "COMISIONES NATURISTAS DE SUCURSALES Y MEDICOS";
        $data['titulo1'] = "";
        $data['tabla'] = $this->direccion_model->control_premio_ctl_his($fec);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_direccion_gcomercial";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function comision_ctl_suc_his($fec,$suc)
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes();
        $this->load->model('direccion_model');
       	$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        
        $data['titulo'] = "PREVIO DE PREMIOS";
        $data['titulo1'] = "";
        $data['tabla'] = $this->direccion_model->control_premio_ctl_suc_his($fec,$suc);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_direccion_gcomercial";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//******************************************************************************************
//******************************************************************************************
//******************************************************************************************
//******************************************************************************************compras
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

     public function tabla_ped_fec_todo()
    {
        $data['titulo'] = 'PEDIDOS FORMULADOS';
        $data['tabla'] = '';
        $data['contenido'] = "compras_form_fec_todo";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_direccion_gcomercial";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    

    public function index_compras()
    {
        $data['titulo'] = '';
        $data['tabla'] = 'BUENOS DIAS A TODO EL PERSONAL<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_direccion_compras";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }

  public function tabla_compara()
    {
        $archivo='SEDENA';
        $this->load->model('compara_model');
        $data['tabla'] = $this->compara_model->control_c($archivo);
        $data['titulo']= 'COMPARA ARCHIVO  EN CATALOGO';
        $data['titulo1'] = "";
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_direccion_compras";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');

}       
   public function tabla_compara_detalle($archivo,$fec)
    {
        $this->load->model('compara_model');
        $data['tabla'] = $this->compara_model->control_detalle($archivo);
        $data['titulo']= 'COMPARA ARCHIVO  EN CATALOGO';
        $data['titulo1'] = "";
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_direccion_compras";
}      
public function tabla_segpop()
    {
        $archivo='SEDENA';
        $this->load->model('compara_model');
        $data['tabla'] = $this->compara_model->control_segpop();
        $data['titulo']= 'COMPARA ARCHIVO  EN CATALOGO';
        $data['titulo1'] = "";
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_direccion_compras";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
}
public function tabla_cedis()
    {
        $archivo='SEDENA';
        $this->load->model('compara_model');
        $data['tabla'] = $this->compara_model->control_cedis();
        $data['titulo']= 'COMPARA ARCHIVO  EN CATALOGO';
        $data['titulo1'] = "";
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_direccion_compras";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//******************************************************************************************
//******************************************************************************************
//******************************************************************************************
//******************************************************************************************compras
    public function index_rh()
    {
        $data['titulo'] = '';
        $data['tabla'] = 'BUENOS DIAS A TODO EL PERSONAL<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_direccion_rh";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }
////////////////////////////////////////////////////////////////
public function tabla_bajas()
    {
        $this->load->model('direccion_model');
        $tit= "INCIDENDIAS DE BAJAS";
        $data['tabla'] = $this->direccion_model->rh_bajas($tit);
        $this->load->view('contenidos/rh_incidencias_bajas', $data);     
}
////////////////////////////////////////////////////////////////
public function tabla_cambios()
    {
        $this->load->model('direccion_model');
        $tit= "Cambio de empleados";
        $data['tabla'] = $this->direccion_model->rh_cambios($tit);
        $this->load->view('contenidos/rh_cambios', $data);     
}
public function reporte_jus()
    {
        $this->load->model('checador_model');
        $data['contenido'] = "formulario_quince";
        $data['selector'] = "rh";
        $data['sidebar'] = "sidebar_direccion_rh";
        $data['quincenas'] = $this->checador_model->get_quincenas();

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }
   
public function reporte_horas()
    {
        $this->load->model('checador_model');
        $data['contenido'] = "formulario_horas";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_direccion_rh";
        $data['quincenas'] = $this->checador_model->get_quincenas();

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//******************************************************************************************
//******************************************************************************************
//******************************************************************************************
    public function index_con()
    {
        $data['titulo'] = '';
        $data['tabla'] = 'BUENOS DIAS A TODO EL PERSONAL<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
        $data['contenido'] = "compras";
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_direccion_contabilidad";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   }

   public function elige_fechas_recargas()
    {
        $this->load->model('catalogo_model');
        $this->load->model('direccion_model');
        
        
        $data['titulo'] = "ELIGE UNA FECHA PARA GENERAR EL REPORTE";
        $data['titulo1'] = "";
        $data['contenido'] = "direccion_contabilidad_elige_fecha";
        $data['selector'] = "contabilidad";
        $data['sidebar'] = "sidebar_direccion_contabilidad";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

   public function recargas()
    {
        $fecha_inicial = $this->input->post('fecha_inicial');
        $fecha_final = $this->input->post('fecha_final');

        $this->load->model('catalogo_model');
        $this->load->model('direccion_model');
        $data['datos'] = $this->direccion_model->venta_tiempo_aire($fecha_inicial, $fecha_final);
        $data['comisiones'] = $this->direccion_model->venta_tiempo_aire_comisiones();
        $data['datos2'] = $this->direccion_model->venta_tiempo_aire_producto($fecha_inicial, $fecha_final);
        $data['datos3'] = $this->direccion_model->venta_tiempo_aire_cia($fecha_inicial, $fecha_final);
        
        
        $data['titulo'] = "Recargas en el periodo del ".$fecha_inicial. " al ".$fecha_final;
        $data['titulo1'] = "";
        $data['contenido'] = "direccion_contabilidad_recargas";
        $data['selector'] = "contabilidad";
        $data['sidebar'] = "sidebar_direccion_contabilidad";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

///////////////////////////////////////////////////////////paso1
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//******************************************************************************************
//******************************************************************************************
//******************************************************************************************

    public function tabla_depositos()
    {
        $this->load->model('catalogo_model');
        $this->load->model('direccion_model');
       	$tit = "DEPOSITOS GENERADOS POR MES";
        
        $data['tabla'] = $this->direccion_model->ver_depositos($tit);
        $this->load->view('contenidos/viu_10', $data);
    }

  public function tabla_depositos_tipo($mes)
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        $this->load->model('direccion_model');
        $tit = "DEPOSITOS DEL MES DE $mesx";
        
        $data['tabla'] = $this->direccion_model->ver_depositos_tipo($mes,$tit);
        $this->load->view('contenidos/viu_10', $data);
    }
   public function tabla_depositos_cia_suc($mes,$tipo)
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        $this->load->model('direccion_model');
        $tit = "DEPOSITOS DEL MES DE $mesx";
        $data['tabla'] = $this->direccion_model->ver_depositos_cia_suc($mes,$tipo,$tit);
        $this->load->view('contenidos/viu_10', $data);
    }
      public function tabla_depositos_cia_suc_dia($mes,$tipo,$suc)
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        $this->load->model('direccion_model');
        $tit = "DEPOSITOS DEL MES DE $mesx";
        $data['tabla'] = $this->direccion_model->ver_depositos_cia_suc_dia($mes,$suc,$tit);
        $this->load->view('contenidos/viu_10', $data);
    }

    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      public function tabla_ventas()
    {
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['far'] = $this->catalogo_model->busca_farmacia();
        $data['titulo'] = 'UTILIDAD DE FARMACIAS';
        $data['contenido'] = "direccion_form_ventas";
        
        $data['selector'] = "compras";
        $data['sidebar'] = "sidebar_direccion_contabilidad";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');   
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      public function tabla_control_ventas()
    {
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($this->input->post('mes'));
        $this->load->model('direccion_model');
        $tit = "VENTAS Y UTILIDADES DEL MES DE $mesx SIN IVA";
        $data['tabla'] = $this->direccion_model->ver_ventas($this->input->post('aaa'),$this->input->post('mes'),$this->input->post('far'),$tit);
        $this->load->view('contenidos/viu_21', $data);
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      public function tabla_cont_venta()
    {
        $this->load->model('direccion_model');
        $tit = "CONCENTRADO DE VENTAS POR MES";
        $data['tabla'] = $this->direccion_model->cons_ventas($tit);
        $this->load->view('contenidos/viu_21', $data);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      public function tabla_diagnostico()
    {
        $this->load->model('direccion_model');
        $tit = "DIAGNOSTICO POR DEPARTAMENTOS";
        $data['tabla'] = $this->direccion_model->diagnostico($tit);
        $this->load->view('contenidos/viu_3', $data);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        function imprime_diagnostico($id_captura)
    {
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          $deptox = $this->catalogo_model->busca_depto($id_captura);  
      $data['cabeza'].= "
      <table>
    <tr>
    <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
    </tr>
    <tr>
    <td colspan=\"5\" align=\"center\">DIAGNOSTICO DE ".$deptox." </td>
     </tr>
   </table> 
            ";
            $data['id_captura']=$id_captura;
            $this->load->view('impresiones/diagnostico_final', $data);
            
		}      
        
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//******************************************************************************************
//******************************************************************************************
//******************************************************************************************
//******************************************************************************************
















































       


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