<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Juridico extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->helper('form');
        
    }
    public function esta_logeado()
    {
        $logeado = $this->session->userdata('is_logged_in');
        if($logeado == null){
            redirect('welcome');
        }
    }

//////////////////////////////////////////////
//////////////////////////////////////////////    

   public function tabla_rentas()
    {
        $this->load->model('juridico_model');
        
        $data['tabla'] = '';
        $data['titulo'] = "CATALOGO DE ARRENDADORES";
        $data['contenido'] = "juridico";
        $data['selector'] = "juridico";
        $data['sidebar'] = "sidebar_juridico";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function tabla_rentas_agrega()
    {
        $this->load->model('catalogo_model');
        $data['sucx'] = $this->catalogo_model->busca_sucursal_juridico();
        $data['auxi'] = 0;
        $data['pago'] = '';
        $data['redon'] = 0;
        $data['tabla'] = '';
        $data['titulo'] = "CATALOGO DE ARRENDADORES";
        $data['contenido'] = "juridico_form_rentas";
        $data['selector'] = "juridico";
        $data['sidebar'] = "sidebar_juridico";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 

//////////////////////////////////////////////
//////////////////////////////////////////////

 public function tabla_rentas_busca()
    {
        $this->load->model('catalogo_model');
        $data['sucx'] = $this->catalogo_model->busca_sucursal_juridico();
        $data['arrx'] = $this->catalogo_model->busca_rentas_arrendador();
        $data['auxi'] = 0;
       
        $data['tabla'] = '';
        $data['titulo'] = "CATALOGO DE ARRENDATARIOS";
        $data['contenido'] = "juridico_form_rentas_buscar";
        $data['selector'] = "juridico";
        $data['sidebar'] = "sidebar_juridico";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function buscar_rentas()
    {
        $suc= $this->input->post('suc');
        $arr= $this->input->post('arr');
        $this->load->model('juridico_model');
        $data['titulo'] = "CATALOGO DE ARRENDADORES";
        
        $data['tabla'] = $this->juridico_model->rentas_busca($suc,$arr);
        $data['contenido'] = "juridico";
        $data['selector'] = "juridico";
        $data['sidebar'] = "sidebar_juridico";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function agrega_rentas()
    {
        $suc= $this->input->post('suc');
        $rfc= $this->input->post('rfc');
        $nom= $this->input->post('nom');
        $imp= $this->input->post('imp');
        $auxi=$this->input->post('auxi');
        $icedular= $this->input->post('icedular');
        $pago= $this->input->post('pago');
        $redon= $this->input->post('redon');
        $contrato= $this->input->post('contrato');
        $incremento= $this->input->post('incremento');
        
        
	    $this->load->model('catalogo_model');
        $query =$this->catalogo_model->busca_sucursal_unica($suc);
        if($query->num_rows() >0){
		$row=$query->row();
        $tsuc=$row->tipo2;
        $iva=$row->iva;
        }
        if($iva==0){$iva=.16;}
        if($auxi==7003 and $iva==.16){$isr=10;$ivar=10.666666;}
        if($auxi==7003 and $iva==.11){$isr=10;$ivar=7.3333332;}
        if($auxi==7004){$isr=0;$ivar=0;}
        $cero=0;
        $this->load->model('juridico_model');
        $id_cc=$this->juridico_model->agrega_member_renta($suc,$rfc,$nom,$imp,$isr,$ivar,$icedular,$pago,$tsuc,$iva,$auxi,$redon,$contrato,$incremento);
 
    redirect('juridico/buscar_rentas_par/'.$cero.'/'.$id_cc);
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function buscar_rentas_par($suc,$arr)
    {
        
        $this->load->model('juridico_model');
        $data['titulo'] = "CATALOGO DE ARRENDADORES";
        $data['tabla'] = $this->juridico_model->rentas_busca($suc,$arr);
        $data['contenido'] = "juridico";
        $data['selector'] = "juridico";
        $data['sidebar'] = "sidebar_juridico";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function tabla_rentas_his()
    {
        $this->load->model('juridico_model');
        
        $data['tabla'] = $this->juridico_model->rentas_his();
        $data['titulo'] = "CATALOGO DE ARRENDADORES";
        $data['contenido'] = "juridico";
        $data['selector'] = "juridico";
        $data['sidebar'] = "sidebar_juridico";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////

   public function tabla_rentas_cambia($id)
    {
        $this->load->model('catalogo_model');
        $query =$this->catalogo_model->busca_rentas_unica($id);
        if($query->num_rows() >0){
		$row=$query->row();
        $data['tsuc'] = $row->tipo;
        $data['suc_a'] = $row->suc;
        $data['nombre'] = $row->nombre;
        $data['nom'] = $row->nom;
        $data['rfc'] = $row->rfc;
        $data['icedular'] = $row->imp_cedular;
        $data['imp'] = $row->imp;
        $data['auxi'] = $row->auxi;
        $data['redon'] = $row->redondeo;
        $data['contrato'] = $row->contrato;
        $data['pago'] = $row->pago;
        $data['incremento'] = $row->incremento;
        
        $data['fecha_termino'] = $row->fecha_termino;
        $data['tipo_pago'] = $row->tipo_pago;
        $data['diferencia'] = $row->diferencia;
        $data['cierre'] = $row->cierre;
        $data['entrega_local'] = $row->entrega_local;
        $data['expediente'] = $row->expediente;
        $data['motivo_cierre'] = $row->motivo_cierre;
        $data['observacion'] = $row->observacion;
        $data['redondeo'] = $row->redondeo;
        
        
        $data['sucx'] = $this->catalogo_model->busca_sucursal_juridico();
        }
        
        $data['id'] = $id;
        $data['tabla'] = '';
        $data['titulo'] = "CATALOGO DE ARRENDADORES";
        $data['contenido'] = "juridico_form_rentas_cambia";
        $data['selector'] = "juridico";
        $data['sidebar'] = "sidebar_juridico";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 

//////////////////////////////////////////////
//////////////////////////////////////////////
   public function cambia_rentas()
    {
        $id= $this->input->post('id');
        $suc= $this->input->post('suc');
        $suc_a= $this->input->post('suc_a');
        $rfc= $this->input->post('rfc');
        $nom= $this->input->post('nom');
        $imp= $this->input->post('imp');
        $auxi=$this->input->post('auxi');
        $icedular= $this->input->post('icedular');
        $pago= $this->input->post('pago');
        $redon= $this->input->post('redon');
        
        $contrato= $this->input->post('contrato');
        $incremento= $this->input->post('incremento');
        
        $fecha_termino =$this->input->post('fecha_termino');
        $tipo_pago =$this->input->post('tipo_pago');
        $diferencia =$this->input->post('diferencia');
        $cierre =$this->input->post('cierre');
        $entrega_local =$this->input->post('entrega_local');
        $expediente =$this->input->post('expediente');
        $motivo_cierre =$this->input->post('motivo_cierre');
        $observacion =$this->input->post('observacion');
        
        if($suc==null || $suc==0){$suc=$suc_a;}
        
	    $this->load->model('catalogo_model');
        $query =$this->catalogo_model->busca_sucursal_unica($suc);
        if($query->num_rows() >0){
		$row=$query->row();
        $tsuc=$row->tipo2;
        $iva=$row->iva;
        }
        if($iva==0){$iva=.16;}
        if($auxi==7003 and $iva==.16){$isr=10;$ivar=10.666666;}
        if($auxi==7003 and $iva==.11){$isr=10;$ivar=7.3333332;}
        if($auxi==7004){$isr=0;$ivar=0;}
        
        $this->catalogo_model->cambia_member_renta($suc,$rfc,$nom,$imp,$isr,$ivar,$icedular,$pago,$tsuc,$iva,$auxi,$suc_a,$id,$redon,$contrato,$incremento
        ,$fecha_termino,$tipo_pago,$diferencia,$cierre,$entrega_local,$expediente,$motivo_cierre,$observacion);
    redirect('juridico/buscar_rentas_par/'.$suc_a.'/'.$id);
    } 

//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function tabla_rentas_borrar($id)
    {
     $this->load->model('catalogo_model');   
    $this->catalogo_model->delete_member_renta($id);
    redirect('juridico/tabla_rentas_his');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function tabla_rentas_vista($id)
    {
        $this->load->model('catalogo_model');
        
          $data['cabeza']='<p align="center"><strong>RECIBO DE ARRENDAMIENTO</strong></p>';
          $this->load->model('catalogo_model');
          $data['detalle'] = $this->catalogo_model->rentas_vista($id);
          $this->load->view('impresiones/nomina_renta', $data);
    }
/////////////////////////////////////////////////
   public function tabla_rentas_vista_general()
    {
        $data['cabeza']='
         <h1>REPORTE DE ARRENDADORES</h1>
          ';
          
          $this->load->model('catalogo_model');
         // $data['detalle']= $this->catalogo_model->rentas_vista_general();
          $this->load->view('impresiones/nomina_renta_contrato', $data);
    }

//////////////////////////////////////////////
//////////////////////////////////////////////
    public function index()
    {
        $data['titulo']= 'CATALOGO DE ARRENDADORES';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "juridico";
        $data['selector'] = "juridico";
        $data['sidebar'] = "sidebar_juridico_renta";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
    public function index_r()
    {
        $data['titulo']= 'CATALOGO DE ARRENDADORES';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "juridico";
        $data['selector'] = "juridico_r";
        $data['sidebar'] = "sidebar_juridico_renta";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
   public function tabla_rentas_genera()
    {
        $this->load->model('catalogo_model');
        $data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['tabla'] = '';
        $data['titulo'] = "RENTAS MENSUALES";
        $data['contenido'] = "juridico_form_rentas_genera";
        $data['selector'] = "juridico_r";
        $data['sidebar'] = "sidebar_juridico_renta";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 

//////////////////////////////////////////////
//////////////////////////////////////////////
   public function agrega_renta_mensual()
    {
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $cam= $this->input->post('cam');
        $this->load->model('juridico_model');
        $id_cc=$this->juridico_model->agrega_member_renta_mes($aaa,$mes,$cam);
 
    redirect('juridico/tabla_rentas_mensual');  
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
  public function tabla_rentas_mensual()
    {
        $suc= $this->input->post('suc');
        $arr= $this->input->post('arr');
        $this->load->model('juridico_model');
        $data['titulo'] = "RENTAS";
        
        $data['tabla'] = $this->juridico_model->rentas_generadas();
        $data['contenido'] = "juridico";
        $data['selector'] = "juridico_r";
        $data['sidebar'] = "sidebar_juridico_renta";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
  public function tabla_rentas_bor($aaa,$mes)
    {
        
        $this->load->model('juridico_model');
        $id_cc=$this->juridico_model->delete_member_renta_mes($aaa,$mes);
        redirect('juridico/tabla_rentas_mensual');  
    }
 //////////////////////////////////////////////
//////////////////////////////////////////////
  public function tabla_rentas_act($aaa,$mes)
    {
        
        $this->load->model('juridico_model');
        $id_cc=$this->juridico_model->act_member_renta_mes($aaa,$mes);
        redirect('juridico/tabla_rentas_mensual');  
    }  
//////////////////////////////////////////////
//////////////////////////////////////////////
  public function tabla_rentas_mensual_mes($aaa,$mes)
    {
        $suc= $this->input->post('suc');
        $arr= $this->input->post('arr');
        $this->load->model('juridico_model');
        $data['titulo'] = "RENTAS";
        
        $data['tabla'] = $this->juridico_model->rentas_generadas_mes($aaa,$mes);
        $data['contenido'] = "juridico";
        $data['selector'] = "juridico";
        $data['sidebar'] = "sidebar_juridico_renta";
        
        
        //$this->load->view('header');
        //$this->load->view('main', $data);
        //$this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
/////////////////////////////////////////////////
   public function tabla_rentas_imp($id)
    {
        $data['cabeza']='
        <th1>REPORTE DE ARRENDADORES</th1>';
          $this->load->model('juridico_model');
          $data['detalle'] = $this->juridico_model->rentas_una($id);
          $this->load->view('impresiones/juridico_renta', $data);
    }

//////////////////////////////////////////////
//////////////////////////////////////////////
/////////////////////////////////////////////////
   public function tabla_rentas_imp_isr($id)
    {
        $data['cabeza']='
        <th1></th1>';
          $this->load->model('juridico_model');
          $data['detalle'] = $this->juridico_model->rentas_una_isr($id);
          $this->load->view('impresiones/juridico_renta_isr', $data);
    }

//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
  public function tabla_rentas_mensual_historico()
    {
        $suc= $this->input->post('suc');
        $arr= $this->input->post('arr');
        $this->load->model('juridico_model');
        $data['titulo'] = "RENTAS";
        
        $data['tabla'] = $this->juridico_model->rentas_generadas_historico();
        $data['contenido'] = "juridico";
        $data['selector'] = "juridico_r";
        $data['sidebar'] = "sidebar_juridico_renta";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function tabla_rentas_imp_isr_todo($aaa,$mes)
    {
        $data['cabeza']='
        <th1></th1>';
          $this->load->model('juridico_model');
          $data['aaa'] = $aaa;
          $data['mes'] = $mes;
          $this->load->view('impresiones/juridico_renta_isr_todo', $data);
    }

//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////





















    



 /////////////////////////______________________________________________________________///////////////alta de empleados
 /////////////////////////______________________________________________________________///////////////alta de empleados
 /////////////////////////______________________________________________________________///////////////alta de empleados
 /////////////////////////______________________________________________________________///////////////alta de empleados
 /////////////////////////______________________________________________________________///////////////alta de empleados
 /////////////////////////______________________________________________________________///////////////alta de empleados
 /////////////////////////______________________________________________________________///////////////alta de empleados
 /////////////////////////______________________________________________________________///////////////alta de empleados
  

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */