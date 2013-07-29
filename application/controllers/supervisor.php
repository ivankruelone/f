<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supervisor extends CI_Controller
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
        $data['titulo']= 'MOVIMIENTOS DE SUCURSALES';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
 /////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////lidia
       
    public function cortes()
    {
        $data['mensaje']= '';
        $data['titulo']= 'CORTES DE CAJA';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "supervisor_form_cortes";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_cortes()
    {
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_cortes($fec);
        
        $data['titulo'] = "CORTES DE CAJA DEL MES DE $mesx DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function corte_dia($suc,$fec)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_corte_dia($fec,$suc);
        
        $data['titulo'] = "CORTES DE CAJA DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = " $suc - $sucx";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function corte_detalle($id_cc,$fec,$suc)
    {
        $this->load->model('cortes_model');
		$query =$this->cortes_model->busca_iva($id_cc);
        $row=$query->row();
        $iva=$row->iva;
        $suc=$row->suc;
        $sucx=$row->nombre;
       
         $data['turno1_cajera']=$row->turno1_cajera;
         $data['turno1_pesos'] =$row->turno1_pesos;
         $data['turno1_dolar'] =$row->turno1_dolar;
         $data['turno1_cambio']=$row->turno1_cambio;
         $data['turno1_bbv']   =$row->turno1_bbv;
         $data['turno1_san']   =$row->turno1_san;
         $data['turno1_exp']   =$row->turno1_exp;
         $data['turno1_vale']  =$row->turno1_vale;
         $data['turno1_asalto']=$row->turno1_asalto;
         $data['turno1_corte'] =$row->turno1_corte;
         $dif1x =
         $row->turno1_pesos+
         $row->turno1_bbv+
         $row->turno1_san+
         $row->turno1_vale+
         $row->turno1_asalto+
         ($row->turno1_dolar*$row->turno1_cambio)-
         $row->turno1_corte;
         
         $data['turno2_cajera']=$row->turno2_cajera;
         $data['turno2_pesos'] =$row->turno2_pesos;
         $data['turno2_dolar'] =$row->turno2_dolar;
         $data['turno2_cambio']=$row->turno2_cambio;
         $data['turno2_bbv']   =$row->turno2_bbv;
         $data['turno2_san']   =$row->turno2_san;
         $data['turno2_exp']   =$row->turno2_exp;
         $data['turno2_vale']  =$row->turno2_vale;
         $data['turno2_asalto']=$row->turno2_asalto;
         $data['turno2_corte'] =$row->turno2_corte;
         $dif2x =
         $row->turno2_pesos+
         $row->turno2_bbv+
         $row->turno2_san+
         $row->turno2_vale+
         $row->turno2_asalto+
         ($row->turno2_dolar*$row->turno2_cambio)-
         $row->turno2_corte;
         
         $data['turno3_cajera']=$row->turno3_cajera;
         $data['turno3_pesos'] =$row->turno3_pesos;
         $data['turno3_dolar'] =$row->turno3_dolar;
         $data['turno3_cambio']=$row->turno3_cambio;
         $data['turno3_bbv']   =$row->turno3_bbv;
         $data['turno3_san']   =$row->turno3_san;
         $data['turno3_exp']   =$row->turno3_exp;
         $data['turno3_vale']  =$row->turno3_vale;
         $data['turno3_asalto']=$row->turno3_asalto;
         $data['turno3_corte'] =$row->turno3_corte;
         $dif3x =
         $row->turno3_pesos+
         $row->turno3_bbv+
         $row->turno3_san+
         $row->turno3_vale+
         $row->turno3_asalto+
         ($row->turno3_dolar*$row->turno3_cambio)-
         $row->turno3_corte;
         
         $data['turno4_cajera']=$row->turno4_cajera;
         $data['turno4_pesos'] =$row->turno4_pesos;
         $data['turno4_dolar'] =$row->turno4_dolar;
         $data['turno4_cambio']=$row->turno4_cambio;
         $data['turno4_bbv']   =$row->turno4_bbv;
         $data['turno4_san']   =$row->turno4_san;
         $data['turno4_exp']   =$row->turno4_exp;
         $data['turno4_vale']  =$row->turno4_vale;
         $data['turno4_asalto']=$row->turno4_asalto;
         $data['turno4_corte'] =$row->turno4_corte;
         $dif4x =
         $row->turno4_pesos+
         $row->turno4_bbv+
         $row->turno4_san+
         $row->turno4_vale+
         $row->turno4_asalto+
         ($row->turno4_dolar*$row->turno4_cambio)-
         $row->turno4_corte;
         
        $fechac=$row->fechacorte;
        $data['recarga'] =$this->cortes_model->ta($suc,$fechac);
        $data['sucursal'] =$suc." - ".$sucx;
        $data['fechac'] =$fechac;
        $data['iva'] =$iva;
        
          ///****
        $clave=1;
        $query = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row=$query->row();
        if($query->num_rows() > 0){
        $data['venta1']   =$row->venta;
        $data['cancel1']  =$row->cancel;
        $data['aumento1'] =$row->aumento;
        }else{
        $data['venta1']=0;$data['cancel1']=0;$data['aumento1']=0;}
        ///****
      ///****
        $clave=2;
        $query2 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row2=$query2->row();
        if($query2->num_rows() > 0){
        $data['venta2']   =$row2->venta;
        $data['cancel2']  =$row2->cancel;
        $data['aumento2'] =$row2->aumento;
        }else{
        $data['venta2']=0;$data['cancel2']=0;$data['aumento2']=0;}
        ///****
        $clave=4;
        $query4 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row4=$query4->row();
        if($query4->num_rows() > 0){
        $data['venta4']   =$row4->venta;
        $data['cancel4']  =$row4->cancel;
        $data['aumento4'] =$row4->aumento;
        }else{
        $data['venta4']=0;$data['cancel4']=0;$data['aumento4']=0; }
        
        ///****
        ///****
        $clave=5;
        $query5 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row5=$query5->row();
        if($query5->num_rows() > 0){
        $data['venta5']   =$row5->venta;
        $data['cancel5']  =$row5->cancel;
        $data['aumento5'] =$row5->aumento;
        }else{
        $data['venta5']=0;$data['cancel5']=0;$data['aumento5']=0;}
        ///****
        
        ///****
        $clave=8;
        $query8 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row8=$query8->row();
        if($query8->num_rows() > 0){
        $data['venta8']   =$row8->venta;
        $data['cancel8']  =$row8->cancel;
        $data['aumento8'] =$row8->aumento;
        }else{
        $data['venta8']=0;$data['cancel8']=0;$data['aumento8']=0;}
        ///****
        ///****
        $clave=9;
        $query9 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row9=$query9->row();
        if($query9->num_rows()> 0){
        $data['venta9']   =$row9->venta;
        $data['cancel9']  =$row9->cancel;
        $data['aumento9'] =$row9->aumento;
        }else{
        $data['venta9']=0;$data['cancel9']=0;$data['aumento9']=0;}
        ///****
        ///****
        $clave=10;
        $query10 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row10=$query10->row();
        if($query10->num_rows() > 0){
        $data['venta10']   =$row10->venta;
        $data['cancel10']  =$row10->cancel;
        $data['aumento10'] =$row10->aumento;
        }else{
        $data['venta10']=0;$data['cancel10']=0;$data['aumento10']=0;}
        ///****
        ///****
        $clave=11;
        $query11 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row11=$query11->row();
        if($query11->num_rows() > 0){
        $data['venta11']   =$row11->venta;
        $data['cancel11']  =$row11->cancel;
        $data['aumento11'] =$row11->aumento;
        }else{
        $data['venta11']=0;$data['cancel11']=0;$data['aumento11']=0;}
        ///****
        ///****
        $clave=12;
        $query12 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row12=$query12->row();
        if($query12->num_rows() > 0){
        $data['venta12']   =$row12->venta;
        $data['cancel12']  =$row12->cancel;
        $data['aumento12'] =$row12->aumento;
        }else{
        $data['venta12']=0;$data['cancel12']=0;$data['aumento12']=0;}
        ///****
        $clave=13;
        $query13 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row13=$query13->row();
        if($query13->num_rows() > 0){
        $data['venta13']   =$row13->venta;
        $data['cancel13']  =$row13->cancel;
        $data['aumento13'] =$row13->aumento;
        }else{
        $data['venta13']=0;$data['cancel13']=0;$data['aumento13']=0;}
        ///****
        ///****
        $clave=16;
        $query16 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row16=$query16->row();
        if($query16->num_rows() > 0){
        $data['venta16']   =$row16->venta;
        $data['cancel16']  =$row16->cancel;
        $data['aumento16'] =$row16->aumento;
        }else{
        $data['venta16']=0;$data['cancel16']=0;$data['aumento16']=0;}
        ///****
        ///****
        $clave=19;
        $query19 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row19=$query19->row();
        if($query19->num_rows() > 0){
        $data['venta19']   =$row16->venta;
        $data['cancel19']  =$row16->cancel;
        $data['aumento19'] =$row16->aumento;
        }else{
        $data['venta19']=0;$data['cancel19']=0;$data['aumento19']=0;}
        ///****
         ///****
        $clave=20;
        $query20 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row20=$query20->row();
        if($query20->num_rows() > 0){
        $data['venta20']   =$row20->venta;
        $data['cancel20']  =$row20->cancel;
        $data['aumento20'] =$row20->aumento;
        }else{
        $data['venta20']=0;$data['cancel20']=0;$data['aumento20']=0;}
        ///****
           ///****
        $clave=21;
        $query21 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row21=$query21->row();
        if($query21->num_rows() > 0){
        $data['venta21']   =$row21->venta;
        $data['cancel21']  =$row21->cancel;
        $data['aumento21'] =$row21->aumento;
        }else{
        $data['venta21']=0;$data['cancel21']=0;$data['aumento21']=0;}
        ///****
           ///****
        $clave=22;
        $query22 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row22=$query22->row();
        if($query22->num_rows() > 0){
        $data['venta22']   =$row22->venta;
        $data['cancel22']  =$row22->cancel;
        $data['aumento22'] =$row22->aumento;
        }else{
        $data['venta22']=0;$data['cancel22']=0;$data['aumento22']=0;}
        ///****
    
        ///****
        $clave=23;
        $query23 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row23=$query23->row();
        if($query23->num_rows() > 0){
        $data['venta23']   =$row23->venta;
        $data['cancel23']  =$row23->cancel;
        $data['aumento23'] =$row23->aumento;
        }else{
        $data['venta23']=0;$data['cancel23']=0;$data['aumento23']=0;}
        ///****
        ///****
        $clave=24;
        $query24 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row24=$query24->row();
        if($query24->num_rows() > 0){
        $data['venta24']   =$row24->venta;
        $data['cancel24']  =$row24->cancel;
        $data['aumento24'] =$row24->aumento;
        }else{
        $data['venta24']=0;$data['cancel24']=0;$data['aumento24']=0;}
        ///****
                ///****
                ///****
        $clave=30;
        $query30 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row30=$query30->row();
        if($query30->num_rows() > 0){
        $data['venta30']   =$row30->venta;
        $data['cancel30']  =$row30->cancel;
        $data['aumento30'] =$row30->aumento;
        }else{
        $data['venta30']=0;$data['cancel30']=0;$data['aumento30']=0;}
        ///****
        
        $clave=40;
        $query40 = $this->cortes_model->busca_detalle($id_cc,$clave);
        $row40=$query40->row();
        if($query40->num_rows() > 0){
        $data['venta40']   =$row40->venta;
        $data['cancel40']  =$row40->cancel;
        $data['aumento40'] =$row40->aumento;
        }else{
        $data['venta40']=0;$data['cancel40']=0;$data['aumento40']=0;}
        ///****  
        if($dif1x>=0){$data['sob1']=round($dif1x*100)/100;$data['fal1']=0;}else{$data['fal1']=round($dif1x*100)/100;$data['sob1']=0;}
        if($dif2x>=0){$data['sob2']=round($dif2x*100)/100;$data['fal2']=0;}else{$data['fal2']=round($dif2x*100)/100;$data['sob2']=0;}
        if($dif3x>=0){$data['sob3']=round($dif3x*100)/100;$data['fal3']=0;}else{$data['fal3']=round($dif3x*100)/100;$data['sob3']=0;}
        if($dif4x>=0){$data['sob4']=round($dif4x*100)/100;$data['fal4']=0;}else{$data['fal4']=round($dif4x*100)/100;$data['sob4']=0;}
        ///****  
        
        
        $data['cl'] =' ';
        $data['fec'] =$fec;
        $data['suc'] =$suc;
        $data['titulo'] = "VER CORTES";
        $data['contenido'] = "supervisor_form_corte_det";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////recarga telefonica
     
    public function cortes_comanche()
    {
        $data['mensaje']= '';
        $data['titulo']= 'RECARGA TELEFONICA';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "supervisor_form_recarga";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
 public function corte_dia_comanche($suc,$fec)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_corte_dia_comanche($fec,$suc);
        
        $data['titulo'] = "RECARGAS TELEFONICAS DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = " $suc - $sucx";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_recarga()
    {
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_cortes_recarga($fec);
        
        $data['titulo'] = "RECARGA TELEFONICA DEL MES DE $mesx DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    ////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////
   public function pedidos()
    {
        $data['mensaje']= '';
        $data['titulo']= 'PEDIDOS SOLICITADOS AL ALMACEN';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "supervisor_form_pedidos";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ped";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_desplaza()
    {
        
        $data['mensaje']= '';
        $data['titulo']= 'Maximo generado por producto';
        $data['var']='0';
        $this->load->model('nacional_model');
		$data['tabla'] = '';
        $data['contenido'] = "sup_form_pedidos_ger_for";
        $data['selector'] = "nacional";
        $data['sidebar'] = "sidebar_supervisor_ped";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
              
    
    }
/////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_desplaza_t()
    {
        $var= $this->input->post('var');
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
        
		$gerente = $this->session->userdata('nombre');
        $data['mensaje']= '';
        $data['titulo']= 'Maximo generado por producto '.$varx;
        $this->load->model('nacional_model');
		$data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['tabla'] = $this->nacional_model->control_desplaza_ab_ger($var,$this->session->userdata('plaza'),$gerente);
        $data['contenido'] = "nacional";
        $data['selector'] = "nacional";
        $data['sidebar'] = "sidebar_supervisor_ped";
    
    }

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

     public function tabla_desplaza_nid()
    {
        
        $data['mensaje']= '';
        $data['titulo']= 'Maximo generado por producto';
        $data['var']='0';
        $data['tabla'] = '';
        $data['contenido'] = "sup_form_pedidos_ger_for_nid";
        $data['selector'] = "nacional";
        $data['sidebar'] = "sidebar_supervisor_ped";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
              
    
    }  
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_desplaza_t_nid()
    {
        $var= $this->input->post('var');
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
        $this->load->model('catalogo_model');
        $gerente = $this->session->userdata('nombre');
        
        $data['mensaje']= '';
        $data['titulo']= 'Maximo generado por producto '.$varx;
        $this->load->model('nacional_model');
		$data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['tabla'] = $this->nacional_model->control_desplaza_ab_ger_nid($var,$this->session->userdata('plaza'),$gerente);
        $data['contenido'] = "nacional";
        $data['selector'] = "nacional";
        $data['sidebar'] = "sidebar_supervisor_ped";
    }    
    
   
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_pedidos()
    {
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_pedidos($fec);
        
        $data['titulo'] = "PEDIDOS DEL MES DE $mesx DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ped";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

   public function pedido_folio($suc,$fec)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_pedido_folio($fec,$suc);
        
        $data['titulo'] = "PEDIDOS DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = " $suc - $sucx";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ped";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function pedido_detalle($suc,$fec,$fol)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_pedido_detalle($fec,$suc,$fol);
        
        $data['titulo'] = "PEDIDOS DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = " $suc - $sucx";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ped";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////
    public function ventas()
    {
        $data['mensaje']= '';
        $data['titulo']= 'VENTAS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "supervisor_form_ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_supervisor_ven";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
public function ventas_naturistas()
    {
        $data['mensaje']= '';
        $data['titulo']= 'COMISION VENTAS NATURISTAS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "supervisor_form_ventas_naturistas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_supervisor_ven";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

////////////////////////////////////////////////////////////////////////////////////////    
    public function muestra_tabla_naturistas()
    {
     $this->load->model('supervisor_model');
     $this->supervisor_model->control_ventas_naturistas();
     redirect('supervisor/muestra_tabla_naturistas');
    }

    
    /////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_ventas()
    {
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_ventas($fec);
        
        $data['titulo'] = "REPORTE DE VENTAS DEL MES DE $mesx DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_ventas_naturistas()
    {
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_ventas_naturistas($fec);
        
        $data['titulo'] = "REPORTE DE COMISIONES DEL MES DE $mesx DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        //$this->load->view('header');
        //$this->load->view('main', $data);
        //$this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
   public function venta_producto($suc,$fec)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_ventas_producto($fec,$suc);
        
        $data['titulo'] = "REPORTE DE VENTAS DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = " $suc - $sucx";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////
   public function venta_producto_naturistas($suc,$fec,$meta)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_ventas_producto_naturistas($fec,$suc,$meta);
        
        $data['titulo'] = "REPORTE DE COMISIONES DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = " $suc - $sucx";
        $data['titulo2'] = " ";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
  public function venta_producto_naturistas_premio($fec)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_ventas_naturistas_premios($fec);
        
        $data['titulo'] = "REPORTE DE COMISIONES DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = " ";
        $data['titulo2'] = " ";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
    
    }

/////////////////////////////////////////////////////////////////////////////////////////
public function venta_producto_naturistas_empleado($suc,$fec,$nomina,$meta)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_ventas_producto_nat_empleado($fec,$suc,$nomina,$meta);
        
        $data['titulo'] = "REPORTE DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = " $suc - $sucx";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////
   public function venta_dia($suc,$fec)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_ventas_dia($fec,$suc);
        
        $data['titulo'] = "REPORTE DE VENTAS DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = " $suc - $sucx";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////
   public function venta_dia_naturistas($suc,$fec)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_ventas_dia_naturistas($fec,$suc);
        
        $data['titulo'] = "REPORTE DE COMISION DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = " $suc - $sucx";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////
   public function venta_detalle($suc,$fec,$fecha)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_ventas_det($suc,$fecha);
        
        $data['titulo'] = "REPORTE DE VENTA DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = " $suc - $sucx  $fecha";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////
   public function venta_detalle_naturistas($suc,$fec,$fecha)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_ventas_det_nat($suc,$fecha);
        
        $data['titulo'] = "REPORTE DE COMISIONES DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = " $suc - $sucx  $fecha";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
    public function tarjetas()
    {
        $aaa= date('Y');
        $mes= date('m');
        
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_tar();
        
        $data['titulo'] = "EXISTENCIA DE TARJETAS AL MES DE $mesx DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_tarjetas_fol($suc)
    {
        $aaa= date('Y');
        $mes= date('m');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc);  
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_tar_folio($suc);
        
        $data['titulo'] = "REPORTE DE VENTAS AL MES DE $mesx DEL $aaa";
        $data['titulo1'] = "$suc - $sucx";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_tarjetas_fol_pro($suc,$tar)
    {
        $aaa= date('Y');
        $mes= date('m');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_tar_folio_pro($suc,$tar);
        
        $data['titulo'] = "TARJETAS DE CLIENTE PREFERENTE DEL MES DE $mesx DEL $aaa";
        $data['titulo1'] = "TARJETA..: $tar ";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_tarjetas_pro($suc)
    {
        $aaa= date('Y');
        $mes= date('m');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc);  
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_tar_pro($suc);
        
        $data['titulo'] = "TARJETA DE CLIENTE PREFERENTE DEL MES DE $mesx DEL $aaa";
        $data['titulo1'] = " $suc - $sucx";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_tarjetas_pro_det($suc,$cod)
    {
        $aaa= date('Y');
        $mes= date('m');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_tar_pro_det($suc,$cod);
        
        $data['titulo'] = "REPORTE DE VENTAS DE LOS PRODUCTOS CON TARJETAS DE CLIENTE PREFERENTE DEL MES DE $mesx DEL $aaa";
        $data['titulo1'] = "CODIGO $cod ";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_tarjetas_fol_otras($suc)
    {
        $aaa= date('Y');
        $mes= date('m');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc);  
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_tar_folio_otras($suc);
        
        $data['titulo'] = "REPORTE DE VENTAS DEL OTRAS TARJETAS";
        $data['titulo1'] = "$suc - $sucx";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_tarjetas_fol_pro_otras($suc,$tar)
    {
        $aaa= date('Y');
        $mes= date('m');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_tar_folio_pro_otras($suc,$tar);
        
        $data['titulo'] = "REPORTE DE VENTAS DE OTRAS TARJETAS";
        $data['titulo1'] = "TARJETA..: $tar DE LA SUCURSAL $sucx ";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_tarjetas_pro_otras($suc)
    {
        $aaa= date('Y');
        $mes= date('m');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc);  
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_tar_pro_otras($suc);
        
        $data['titulo'] = "REPORTE DE VENTAS DE OTRAS TARJETAS";
        $data['titulo1'] = " $suc - $sucx";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_tarjetas_pro_det_otras($suc,$cod)
    {
        $aaa= date('Y');
        $mes= date('m');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_tar_pro_det_otras($suc,$cod);
        
        $data['titulo'] = "REPORTE DE VENTAS DE LOS PRODUCTOS CON TARJETAS DEL MES DE $mesx DEL $aaa";
        $data['titulo1'] = "CODIGO $cod ";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
    public function natur()
    {
        $data['mensaje']= '';
        $data['titulo']= 'VENTAS PROD.NATURISTAS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "supervisor_form_ventas_nat";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_supervisor_ven";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_ventas_nat()
    {
        $aaa= $this->input->post('aaa');
        
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_ventas_nat($aaa);
        
        $data['titulo'] = "REPORTE DE VENTAS NATURISTAS  DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
   public function venta_producto_nat($suc,$aaa)
    {
         $this->load->model('catalogo_model');
        $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('supervisor_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->supervisor_model->control_ventas_producto_nat($aaa,$suc);
        
        $data['titulo'] = "VENTA DE PRODUCTOS NATURISTAS DEL $aaa ";
        $data['titulo1'] = " $suc - $sucx";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function indexm()
    {
        $data['mensaje']= '';
        $data['titulo']= 'MOVIMIENTOS DE SUCURSALES';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_mov";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function movimiento()
    {
        $plaza= $this->session->userdata('plaza');
        $cau='INCAPACIDAD';
        $data['mensaje']= '';
        $data['titulo']= 'CAPTURA DE MOVIMIENTOS<BR /><P><font size="2">PORFAVOR CUANDO CAPTUREN FALTAS IMPRIMAN LA PAPELETA Y EN ENTREGUENLA A CONTADORES O RH</P>';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('supervisor_model');
        $data['motx'] = $this->catalogo_model->busca_mov_super();
        $data['tabla']= $this->supervisor_model->captura_de_mov();
        $data['contenido'] = "supervisor_form_repo";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_supervisor_mov";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function movimiento_mot()
    {
        $plaza= $this->session->userdata('plaza');
        $id_mov= $this->input->post('mot');
        //**
        $dia=date('d');
      if($dia>0 and $dia<=7){$m=date('m');$num=1;}
        if($dia>7 and $dia<=21){$m=date('m');$num=16;}
        if($dia>21){$m=date('m')+1;$num=1;}
        
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_mes_calendario($m,$num);
        $row=$query->row();
        $mesx=$row->mesx;
        $quincena=$row->quincena;
        //**
        
        $data['mensaje']= '';
        $data['titulo']= 'CAPTURA DE MOVIMIENTOS<BR /><P><font size="2">PORFAVOR CUANDO CAPTUREN FALTAS IMPRIMAN LA PAPELETA Y EN ENTREGUENLA A CONTADORES O RH</P>';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('supervisor_model');
        $data['nomx'] = $this->catalogo_model->empleado_sup_dia_festivo($id_mov,$quincena,$m);
		$data['id_mov'] = $id_mov;
        $data['tabla']= $this->supervisor_model->captura_de_mov();
        
       if($id_mov==5){
 	
       $data['suc']=0;
       $data['obser']=' ';
       $data['causax'] = $this->catalogo_model->busca_causa($id_mov);
       $data['contenido'] = "supervisor_form_reporta_incapacidad"; 
       }elseif($id_mov==3){
       $data['folio_inca']='';
       $data['causa']='';
       $data['dias']=0;        
       $data['sucx'] = $this->catalogo_model->busca_sucursal_supervisor_suc($plaza);
       $data['contenido'] = "supervisor_form_reporta_cambio";
       }else{
       $data['suc']=0;
       $data['folio_inca']='';
       $data['causa']='';
       $data['dias']=1;   
       $data['contenido'] = "supervisor_form_reporta"; 
       }
        
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_supervisor_mov";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
function movimiento_reporta()
	{
    $id_emp= $this->input->post('nom');
    $id_mov= $this->input->post('id_mov');
    $fecha_i= $this->input->post('fecha_i');
    $obser= $this->input->post('obser');
    $suc= $this->input->post('suc');
    $folio_inca= $this->input->post('folio_inca');
    $causa= $this->input->post('causa');
    $dias= $this->input->post('dias');
    $clave=0;
    $this->load->model('supervisor_model');
    $this->supervisor_model->agrega_member_movimiento($id_emp,$id_mov,$fecha_i,$obser,$suc,$folio_inca,$causa,$dias,$clave);
    redirect('supervisor/movimiento');
    
    }

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_empleados_borrar($id)
    {
     
     $this->load->model('supervisor_model');
     $this->supervisor_model->delete_member_empleados($id);
     redirect('supervisor/movimiento');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
public function tabla_empleados_validar($id)
    {
     $dia=date('d');
        if($dia>0 and $dia<=7){$m=date('m');$num=1;}
        if($dia>7 and $dia<=21){$m=date('m');$num=16;}
        if($dia>21){$m=date('m')+1;$num=1;}
       
       $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_mes_calendario($m,$num);
        $row=$query->row();
        $mesx=$row->mesx;
        $quincena=$row->quincena;

        
        $fechaf=date('Y').str_pad($m,2,"0",STR_PAD_LEFT).str_pad($quincena,2,"0",STR_PAD_LEFT);
     $this->load->model('supervisor_model');
     $this->supervisor_model->valida_member_empleados($id,$fechaf);
     redirect('supervisor/movimiento');
    }

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function movimiento_his()
    {
        $plaza= $this->session->userdata('plaza');
        $data['mensaje']= '';
        $data['titulo']= 'EMPLEADOS CON MOVIMIENTOS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $data['motivox'] = $this->catalogo_model->busca_mov_super_cap();
        $this->load->model('supervisor_model');
        $data['tabla']= ' ';
        $data['contenido'] = "supervisor_mov_form_his";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_mov";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function movimiento_his_1()
    {
        $plaza= $this->session->userdata('plaza');
        $motivo= $this->input->post('motivo');
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $data['mensaje']= '';
        $data['titulo']= 'EMPLEADOS CON MOVIMIENTOS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('supervisor_model');
        $data['tabla']= $this->supervisor_model->captura_de_mov_his($motivo,$aaa,$mes);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_supervisor_mov";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_comision()
    {
        
        $this->load->model('supervisor_model');
       	$data['titulo'] = $this->session->userdata('nombre');
        $data['titulo1'] = "";
        $data['tabla'] = $this->supervisor_model->comision();
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_supervisor_ven";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }


/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function comision_det($fecha)
    {
        $aaa=substr($fecha,0,4);
        $mes=substr($fecha,5,2);
        $plaza= $this->session->userdata('plaza');
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        $data['mensaje']= '';
        $data['titulo']= 'REPORTE DE VENTAS PARA COMISIONES DE '.$mesx.' DEL '.$aaa;
        $data['titulo1']= '';
        
        $this->load->model('supervisor_model');
        $data['tabla']= $this->supervisor_model->comision_det($fecha);
        $data['contenido'] = "ventas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_supervisor_ven";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }



/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_mov_pendiente_contador()
    {
        $plaza= $this->session->userdata('plaza');
        $data['mensaje']= '';
        $data['titulo']= 'EMPLEADOS CON MOVIMIENTOS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('supervisor_model');
        $data['tabla']= $this->supervisor_model->mov_pendiente_contador();
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_mov";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_mov_pendiente_contador_his()
    {
        $plaza= $this->session->userdata('plaza');
        $data['mensaje']= '';
        $data['titulo']= 'EMPLEADOS CON MOVIMIENTOS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('supervisor_model');
        $data['tabla']= $this->supervisor_model->mov_pendiente_contador_his();
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_mov";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_mov_pendiente()
    {
        $plaza= $this->session->userdata('plaza');
        $data['mensaje']= '';
        $data['titulo']= 'EMPLEADOS CON MOVIMIENTOS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('supervisor_model');
        $data['tabla']= $this->supervisor_model->mov_pendiente();
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_mov";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }


/////////////////////////////////////////////////////////////////////////////////////////
public function tabla_empleados_validar_contador($id)
    {
     $this->load->model('supervisor_model');
     $this->supervisor_model->valida_member_empleados_rh($id);
     redirect('supervisor/tabla_mov_pendiente_contador');
    }


/////////////////////////////////////////////////////////////////////////////////////////
public function tabla_empleados_validar_rh($id)
    {
     $this->load->model('supervisor_model');
     $this->supervisor_model->valida_member_empleados_rh($id);
     redirect('supervisor/tabla_mov_pendiente');
    }

/////////////////////////////////////////////////////////////////////////////////////////checar solo contador
  public function tabla_mov_val_de_sup()
    {
        $plaza= $this->session->userdata('plaza');
        $data['mensaje']= '';
        $data['titulo']= 'EMPLEADOS CON MOVIMIENTOS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('supervisor_model');
        $data['tabla']= $this->supervisor_model->mov_val_de_sup();
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_mov";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_mov_val_de_rh()
    {
        $plaza= $this->session->userdata('plaza');
        $data['mensaje']= '';
        $data['titulo']= 'EMPLEADOS CON MOVIMIENTOS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('supervisor_model');
        $data['tabla']= $this->supervisor_model->mov_val_de_rh();
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_mov";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }




/////////////////////////////////////////////////////////////////////////////////////////
function movimiento_reporta_alta()
	{
    $nom= $this->input->post('nom');
    $nomina= $this->input->post('nomina');
    $cia= $this->input->post('cia');
    $id_mov= 4;
    $fecha= $this->input->post('fecha');
    $suc= $this->input->post('suc');
    $this->load->model('supervisor_model');
   
    $this->supervisor_model->agrega_member_movimiento_alta($nom,$id_mov,$fecha,$cia,$suc,$nomina);
    redirect('supervisor/tabla_mov_alta');
    
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_empleados_borrar_rh($id)
    {
     
     $this->load->model('supervisor_model');
     $this->supervisor_model->delete_member_empleados($id);
     redirect('supervisor/tabla_mov_alta');
    }

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
public function tabla_empleados_validar_rh_alta($id)
    {
    $dia=date('d');
    if($dia>0 and $dia<=7){$m=date('m');$num=1;}
        if($dia>7 and $dia<=21){$m=date('m');$num=16;}
        if($dia>21){$m=date('m')+1;$num=1;}
       
       $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_mes_calendario($m,$num);
        $row=$query->row();
        $mesx=$row->mesx;
        $quincena=$row->quincena;

        
        $fechaf=date('Y').str_pad($m,2,"0",STR_PAD_LEFT).str_pad($quincena,2,"0",STR_PAD_LEFT);
     $this->load->model('supervisor_model');
     $this->supervisor_model->valida_member_empleados($id,$fechaf);
     redirect('supervisor/tabla_mov_alta');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////ajustado por cat_alta_empleado
   public function movimiento_his_alta()
    {
        $plaza= $this->session->userdata('plaza');
        $data['mensaje']= '';
        $data['titulo']= 'AVISOS DE LLEGADA Y BAJA DE EMPLEADOS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('supervisor_model');
        $data['tabla']= $this->supervisor_model->captura_de_mov_his_alta();
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_mov";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////ajustado por cat_alta_empleado
  public function movimiento_his_alta_observa($id)
    {
        $data['id']=$id;
        $plaza= $this->session->userdata('plaza');
        $data['mensaje']= '';
        $data['titulo']= 'EMPLEADOS CON MOVIMIENTOS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $data['obserx']=$this->catalogo_model->busca_observa();
        $this->load->model('supervisor_model');
        $data['tabla']= $this->supervisor_model->captura_de_mov_his_envio_suc($id);
        $data['contenido'] = "supervisor_mov_form_envio_suc";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_mov";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////ajustado por cat_alta_empleado
public function tabla_empleados_validar_super_alta()
    {
     $id=$this->input->post('id');
     $obser=$this->input->post('obser');
     $this->load->model('supervisor_model');
     $this->supervisor_model->valida_member_empleados_envio_suc($id,$obser);
     redirect('supervisor/movimiento_his_alta');
    }
/////////////////////////////////////////////////////////////////////////////////////////ajustado por cat_alta_empleado
  public function movimiento_his_alta_historico()
    {
        $plaza= $this->session->userdata('plaza');
        $data['mensaje']= '';
        $data['titulo']= 'EMPLEADOS REPORTADOS COMO ALTA';
        $data['titulo1']= '';
        $data['tabla']= '';
        $data['contenido'] = "supervisor_form_reporta_3";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_mov";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////ajustado por cat_alta_empleado
  public function movimiento_his_alta_historico_fecha()
    {
        $fec1=$this->input->post('fec1');
        $fec2=$this->input->post('fec2');
        $plaza= $this->session->userdata('plaza');
        $data['mensaje']= '';
        $data['titulo']= 'EMPLEADOS CON MOVIMIENTOS';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('supervisor_model');
        $data['tabla']= $this->supervisor_model->captura_de_mov_his_alta_historico($fec1,$fec2);
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_supervisor_mov";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
function imprimir_fal($id)
	{
	      
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          
           
            $data['cabeza'].= "
           <table>
           
           <tr>
           <td colspan=\"12\" align=\"center\"><strong>REPORTE DE FALTA</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"12\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')."<br /></td>
           </tr>
           
           </table> 
            ";
            $this->load->model('supervisor_model');
            $data['detalle'] = $this->supervisor_model->imp_falta($id);
            
            
            $this->load->view('impresiones/poliza', $data);
            
		}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////








































 
   public function pru()
    {
     $this->load->model('genera_pdv_model');
     $this->genera_pdv_model->gernera();   
    }    
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////7    
/////////////////////////////////////////////////////////////////////////////////////////////

    
    
      }