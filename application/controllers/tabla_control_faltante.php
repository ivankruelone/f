<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Cortes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->helper('form');
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
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
        $data['titulo']= 'CAPTURA DE CORTES';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "cortes";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function portada($mensaje)
    {
       
       if($mensaje==1){$mensajex='<font size="+1" color="#042AFE">EL ARCHIVO FUE ENVIADO CORRECTAMENTE</font>';}
       if($mensaje==2){$mensajex='<font size="+1" color="#FA0404">EL ARCHIVO NO SE ENVIO</font>';}
       if($mensaje==3){$mensajex='<font size="+1" color="#FA0404">TU CORTE NO CUADRo, VERIFICA TUS IMPORTES</font>';}
        $data['mensaje']= $mensajex;
        $data['titulo']= 'CAPTURA DE CORTES';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "cortes_1";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control()
    {
        
        $this->load->model('catalogo_model');
		$data['sucx'] = $this->catalogo_model->busca_suc_con_cor_2012();
        $this->load->model('cortes_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = ' ';
        
        $data['titulo'] = "CAPTURA DE CORTES";
        $data['contenido'] = "cortes_form_0";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function insert_c()
    {
        
        
        $suc=$this->input->post('suc');
        $fechac=$this->input->post('fechac');
        $vta=$this->input->post('vta');

        
        $this->load->model('cortes_model');
       
      
     if($suc>0 and $fechac>0 and $vta>0 and $fechac<date('Y-m-d'))
     {
        $recarga =$this->cortes_model->ta($suc,$fechac);
		$this->cortes_model->create_member_c($suc,$fechac,$recarga,$vta);
    }else{
       redirect('cortes/tabla_control');
    }
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 public function delete_c($id_cc)
    {
     
$this->load->model('cortes_model');
$this->cortes_model->delete_member_c($id_cc);
redirect('cortes/tabla_control_editar');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 public function delete_c_his($id_cc,$suc,$fec)
    {
     
$this->load->model('cortes_model');
$this->cortes_model->delete_member_c($id_cc);
redirect('cortes/tabla_control_validado_d/'.$suc.'/'.$fec);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_detalle($id_cc)
    {
         $this->load->model('catalogo_model');
		
        $this->load->model('cortes_model');
        $data['tabla'] =$this->cortes_model->busca_control($id_cc);
        $query =$this->cortes_model->busca_iva($id_cc);
        $row=$query->row();
        $iva=$row->iva;
        $vta=$row->vta_tot;
        
 
        $suc=$row->suc;
        $sucx=$row->nombre;
        $fechac=$row->fechacorte;
        $data['recarga'] =$this->cortes_model->ta($suc,$fechac);
  
        $data['sucursal'] =$suc." - ".$sucx;
        $data['fechac'] =$fechac;
        $data['iva'] =$iva;
        $data['vta'] =$vta;
        $data['id_cc'] =$id_cc;
        
        $data['cl'] =' ';
        $data['titulo'] = "CAPTURA DE CORTES";
        $data['contenido'] = "cortes_form_1";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function insert_d()
    {
        $dif=$this->input->post('dif');
        $id_cc=$this->input->post('id_cc');
        $valor_iva=$this->input->post('iva');
        $recarga=$this->input->post('recarga');
        $vta=$this->input->post('vta');

        $l1=$this->input->post('l1_fin');
        $l2=$this->input->post('l2_fin');
        $l4=$this->input->post('l4_fin');
        $l5=$this->input->post('l5_fin');
        $l8=$this->input->post('l8_fin');
        $l9=$this->input->post('l9_fin');
        $l10=$this->input->post('l10_fin');
        $l11=$this->input->post('l11_fin');
        $l12=$this->input->post('l12_fin');
        $l13=$this->input->post('l13_fin');
        $l16=$this->input->post('l16_fin');
        $l19=$this->input->post('l19_fin');
        $l20=$this->input->post('l20_fin');
        $l21=$this->input->post('l21_fin');
        $l22=$this->input->post('l22_fin');
        $l23=$this->input->post('l23_fin');
        $l24=$this->input->post('l24_fin');
        $l30=$this->input->post('l30_fin');
        $l40=$this->input->post('l40_fin');
        
        $l1c=$this->input->post('l1_c');
        $l2c=$this->input->post('l2_c');
        $l4c=$this->input->post('l4_c');
        $l5c=$this->input->post('l5_c');
        $l8c=$this->input->post('l8_c');
        $l9c=$this->input->post('l9_c');
        $l10c=$this->input->post('l10_c');
        $l11c=$this->input->post('l11_c');
        $l12c=$this->input->post('l12_c');
        $l13c=$this->input->post('l13_c');
        $l16c=$this->input->post('l16_c');
        $l19c=$this->input->post('l19_c');
        $l20c=$this->input->post('l20_c');
        $l21c=$this->input->post('l21_c');
        $l22c=$this->input->post('l22_c');
        $l23c=$this->input->post('l23_c');
        $l24c=$this->input->post('l24_c');
        $l30c=$this->input->post('l30_c');
        $l40c=$this->input->post('l40_c');
        
        $l1a=$this->input->post('l1_a');
        $l2a=$this->input->post('l2_a');
        $l4a=$this->input->post('l4_a');
        $l5a=$this->input->post('l5_a');
        $l8a=$this->input->post('l8_a');
        $l9a=$this->input->post('l9_a');
        $l10a=$this->input->post('l10_a');
        $l11a=$this->input->post('l11_a');
        $l12a=$this->input->post('l12_a');
        $l13a=$this->input->post('l13_a');
        $l16a=$this->input->post('l16_a');
        $l19a=$this->input->post('l19_a');
        $l20a=$this->input->post('l20_a');
        $l21a=$this->input->post('l21_a');
        $l22a=$this->input->post('l22_a');
        $l23a=$this->input->post('l23_a');
        $l24a=$this->input->post('l24_a');
        $l30a=$this->input->post('l30_a');
        $l40a=$this->input->post('l40_a');
        
        
        $turno1_pesos  =$this->input->post('turno1_pesos');
        $turno1_dolar  =$this->input->post('turno1_dolar');
        $turno1_cambio =$this->input->post('turno1_cambio');
        $turno1_bbv    =$this->input->post('turno1_bbv');
        $turno1_san    =$this->input->post('turno1_san');
        $turno1_exp    =$this->input->post('turno1_exp');
        $turno1_asalto =$this->input->post('turno1_asalto');
        $turno1_vale   =$this->input->post('turno1_vale');
        $turno1_cajera =$this->input->post('turno1_cajera');
        $turno1_corte  =$this->input->post('turno1_corte_fin');
        
        $turno2_pesos  =$this->input->post('turno2_pesos');
        $turno2_dolar  =$this->input->post('turno2_dolar');
        $turno2_cambio =$this->input->post('turno2_cambio');
        $turno2_bbv    =$this->input->post('turno2_bbv');
        $turno2_san    =$this->input->post('turno2_san');
        $turno2_exp    =$this->input->post('turno2_exp');
        $turno2_asalto =$this->input->post('turno2_asalto');
        $turno2_vale   =$this->input->post('turno2_vale');
        $turno2_cajera =$this->input->post('turno2_cajera');
        $turno2_corte  =$this->input->post('turno2_corte_fin');
        
        $turno3_pesos  =$this->input->post('turno3_pesos');
        $turno3_dolar  =$this->input->post('turno3_dolar');
        $turno3_cambio =$this->input->post('turno3_cambio');
        $turno3_bbv    =$this->input->post('turno3_bbv');
        $turno3_san    =$this->input->post('turno3_san');
        $turno3_exp    =$this->input->post('turno3_exp');
        $turno3_asalto =$this->input->post('turno3_asalto');
        $turno3_vale   =$this->input->post('turno3_vale');
        $turno3_cajera =$this->input->post('turno3_cajera');
        $turno3_corte  =$this->input->post('turno3_corte_fin');
        
        $turno4_pesos  =$this->input->post('turno4_pesos');
        $turno4_dolar  =$this->input->post('turno4_dolar');
        $turno4_cambio =$this->input->post('turno4_cambio');
        $turno4_bbv    =$this->input->post('turno4_bbv');
        $turno4_san    =$this->input->post('turno4_san');
        $turno4_exp    =$this->input->post('turno4_exp');
        $turno4_asalto =$this->input->post('turno4_asalto');
        $turno4_vale   =$this->input->post('turno4_vale');
        $turno4_cajera =$this->input->post('turno4_cajera');
        $turno4_corte  =$this->input->post('turno4_corte_fin');

$arqueo1=$turno1_pesos+$turno1_bbv+$turno1_san+$turno1_exp+$turno1_asalto+$turno1_vale+($turno1_dolar*$turno1_cambio);
$arqueo2=$turno2_pesos+$turno2_bbv+$turno2_san+$turno2_exp+$turno2_asalto+$turno2_vale+($turno2_dolar*$turno2_cambio);
$arqueo3=$turno3_pesos+$turno3_bbv+$turno3_san+$turno3_exp+$turno3_asalto+$turno3_vale+($turno3_dolar*$turno3_cambio);
$arqueo4=$turno4_pesos+$turno4_bbv+$turno4_san+$turno4_exp+$turno4_asalto+$turno4_vale+($turno4_dolar*$turno4_cambio);

if($arqueo1>$turno1_corte){$sob1=$arqueo1-$turno1_corte; $fal1=0;}else{$fal1=$turno1_corte-$arqueo1; $sob1=0;}
if($arqueo2>$turno2_corte){$sob2=$arqueo2-$turno2_corte; $fal2=0;}else{$fal2=$turno2_corte-$arqueo2; $sob2=0;}
if($arqueo3>$turno3_corte){$sob3=$arqueo3-$turno3_corte; $fal3=0;}else{$fal3=$turno3_corte-$arqueo3; $sob3=0;}
if($arqueo4>$turno4_corte){$sob4=$arqueo4-$turno4_corte; $fal4=0;}else{$fal4=$turno4_corte-$arqueo4; $sob4=0;}
$arqueo1x=$arqueo1-$sob1+$fal1;
$arqueo2x=$arqueo2-$sob2+$fal2;
$arqueo3x=$arqueo3-$sob3+$fal3;
$arqueo4x=$arqueo4-$sob4+$fal4;
if($recarga==null){$recarga=0;}
echo $arqueo1x."-".$turno1_corte."__".$arqueo2x."-".$turno2_corte."__".$l20."-".$recarga;
if($arqueo1x==$turno1_corte && $arqueo2x==$turno2_corte && $arqueo3x==$turno3_corte && $arqueo4x==$turno4_corte && 
$l20>=$recarga){        


$this->load->model('cortes_model');
$this->cortes_model->create_member_d($id_cc,$l1,$l2,$l4,$l5,$l8,$l9,$l10,$l11,$l12,$l13,$l16,$l19,$l20,$l21,$l22,$l23,$l24,$l30,$l40,
        $l1a,$l2a,$l4a,$l5a,$l8a,$l9a,$l10a,$l11a,$l12a,$l13a,$l16a,$l19a,$l20a,$l21a,$l22a,$l23a,$l24a,$l30a,$l40a,
        $l1c,$l2c,$l4c,$l5c,$l8c,$l9c,$l10c,$l11c,$l12c,$l13c,$l16c,$l19c,$l20c,$l21c,$l22c,$l23c,$l24c,$l30c,$l40c,
        $turno1_pesos,$turno1_dolar,$turno1_cambio,$turno1_bbv,$turno1_san,$turno1_exp,$turno1_asalto,$turno1_vale,$turno1_cajera,$turno1_corte,
        $turno2_pesos,$turno2_dolar,$turno2_cambio,$turno2_bbv,$turno2_san,$turno2_exp,$turno2_asalto,$turno2_vale,$turno2_cajera,$turno2_corte,  
        $turno3_pesos,$turno3_dolar,$turno3_cambio,$turno3_bbv,$turno3_san,$turno3_exp,$turno3_asalto,$turno3_vale,$turno3_cajera,$turno3_corte,
        $turno4_pesos,$turno4_dolar,$turno4_cambio,$turno4_bbv,$turno4_san,$turno4_exp,$turno4_asalto,$turno4_vale,$turno4_cajera,$turno4_corte);
redirect('cortes/tabla_control');
}else{
$mensaje=3;    
redirect('cortes/portada/'.$mensaje);   
}
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_editar()
    {
        
        $this->load->model('catalogo_model');
		$data['sucx'] = $this->catalogo_model->busca_sucursal();
        $this->load->model('cortes_model');
        $data['tabla'] = $this->cortes_model->control();
        $data['titulo'] = "EDITAR CORTES";
        $data['titulo1']= '';
        $data['contenido'] = "cortes";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_control_validado()
    {
        
        $this->load->model('catalogo_model');
		$data['sucx'] = $this->catalogo_model->busca_sucursal();
        $this->load->model('cortes_model');
                
        $data['tabla'] = $this->cortes_model->control_validado_ctl();
        $data['titulo'] = "CORTES";
        $data['titulo1']= '';
        $data['contenido'] = "cortes";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_control_validado_d($suc,$fec)
    {
        
        $this->load->model('catalogo_model');
		$data['sucx'] = $this->catalogo_model->busca_sucursal();
        $this->load->model('cortes_model');
                
        $data['tabla'] = $this->cortes_model->control_validado($suc,$fec);
        $data['titulo'] = "CORTES";
        $data['titulo1']= '';
        $data['contenido'] = "cortes";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_detalle_his($id_cc,$suc,$fec)
    {
        $this->load->model('cortes_model');
		$query =$this->cortes_model->busca_iva($id_cc);
        $row=$query->row();
        $iva=$row->iva;
        $suc=$row->suc;
        $sucx=$row->nombre;
        $vta=$row->vta_tot;
        
         $data['vta']=$vta;
         $data['suc']=$suc;
         $data['fec']=$fec;
         
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
         
        $fechac=$row->fechacorte;
        $data['recarga'] =$this->cortes_model->ta($suc,$fechac);
        $data['sucursal'] =$suc." - ".$sucx;
        $data['fechac'] =$fechac;
        $data['iva'] =$iva;
        
        
        $data['tabla'] =$this->cortes_model->busca_control($id_cc);
        $data['id_cc'] =$id_cc;
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
        $data['cl'] =' ';
        $data['titulo'] = "CAPTURA DE CORTES";
        $data['contenido'] = "cortes_form_1_his";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function actualiza_d()
    {
        $id_cc=$this->input->post('id_cc');
        $this->load->model('cortes_model');
		$query =$this->cortes_model->busca_iva($id_cc);
        $row=$query->row();
        $ivaa=$row->iva;
        $suc=$row->suc;
        $fechac=$row->fechacorte;
        $recarga =$this->cortes_model->ta($suc,$fechac);
        $suc=$this->input->post('suc');
        $fec=$this->input->post('fec');
        
        $l1=$this->input->post('l1');
        $l2=$this->input->post('l2');
        $l4=$this->input->post('l4');
        $l5=$this->input->post('l5');
        $l8=$this->input->post('l8');
        $l9=$this->input->post('l9');
        $l10=$this->input->post('l10');
        $l11=$this->input->post('l11');
        $l12=$this->input->post('l12');
        $l13=$this->input->post('l13');
        $l16=$this->input->post('l16');
        $l19=$this->input->post('l19');
        $l20=$this->input->post('l20');
        $l21=$this->input->post('l21');
        $l22=$this->input->post('l22');
        $l23=$this->input->post('l23');
        $l24=$this->input->post('l24');
        $l30=$this->input->post('l30');
        $l40=$this->input->post('l40');
        
        $lc1=$this->input->post('lc1');
        $lc2=$this->input->post('lc2');
        $lc4=$this->input->post('lc4');
        $lc5=$this->input->post('lc5');
        $lc8=$this->input->post('lc8');
        $lc9=$this->input->post('lc9');
        $lc10=$this->input->post('lc10');
        $lc11=$this->input->post('lc11');
        $lc12=$this->input->post('lc12');
        $lc13=$this->input->post('lc13');
        $lc16=$this->input->post('lc16');
        $lc19=$this->input->post('lc19');
        $lc20=$this->input->post('lc20');
        $lc21=$this->input->post('lc21');
        $lc22=$this->input->post('lc22');
        $lc23=$this->input->post('lc23');
        $lc24=$this->input->post('lc24');
        $lc30=$this->input->post('lc30');
        $lc40=$this->input->post('lc40');
        
        $la1=$this->input->post('la1');
        $la2=$this->input->post('la2');
        $la4=$this->input->post('la4');
        $la5=$this->input->post('la5');
        $la8=$this->input->post('la8');
        $la9=$this->input->post('la9');
        $la10=$this->input->post('la10');
        $la11=$this->input->post('la11');
        $la12=$this->input->post('la12');
        $la13=$this->input->post('la13');
        $la16=$this->input->post('la16');
        $la19=$this->input->post('la19');
        $la20=$this->input->post('la20');
        $la21=$this->input->post('la21');
        $la22=$this->input->post('la22');
        $la23=$this->input->post('la23');
        $la24=$this->input->post('la24');
        $la30=$this->input->post('la30');
        $la40=$this->input->post('la40');
        
         $turno1_pesos  =$this->input->post('turno1_pesos');
        $turno1_dolar  =$this->input->post('turno1_dolar');
        $turno1_cambio =$this->input->post('turno1_cambio');
        $turno1_bbv    =$this->input->post('turno1_bbv');
        $turno1_san    =$this->input->post('turno1_san');
        $turno1_exp    =$this->input->post('turno1_exp');
        $turno1_asalto =$this->input->post('turno1_asalto');
        $turno1_vale   =$this->input->post('turno1_vale');
        $turno1_cajera =$this->input->post('turno1_cajera');
        $turno1_corte  =$this->input->post('turno1_corte');
        
        $turno2_pesos  =$this->input->post('turno2_pesos');
        $turno2_dolar  =$this->input->post('turno2_dolar');
        $turno2_cambio =$this->input->post('turno2_cambio');
        $turno2_bbv    =$this->input->post('turno2_bbv');
        $turno2_san    =$this->input->post('turno2_san');
        $turno2_exp    =$this->input->post('turno2_exp');
        $turno2_asalto =$this->input->post('turno2_asalto');
        $turno2_vale   =$this->input->post('turno2_vale');
        $turno2_cajera =$this->input->post('turno2_cajera');
        $turno2_corte  =$this->input->post('turno2_corte');
        
        $turno3_pesos  =$this->input->post('turno3_pesos');
        $turno3_dolar  =$this->input->post('turno3_dolar');
        $turno3_cambio =$this->input->post('turno3_cambio');
        $turno3_bbv    =$this->input->post('turno3_bbv');
        $turno3_san    =$this->input->post('turno3_san');
        $turno3_exp    =$this->input->post('turno3_exp');
        $turno3_asalto =$this->input->post('turno3_asalto');
        $turno3_vale   =$this->input->post('turno3_vale');
        $turno3_cajera =$this->input->post('turno3_cajera');
        $turno3_corte  =$this->input->post('turno3_corte');
        
        $turno4_pesos  =$this->input->post('turno4_pesos');
        $turno4_dolar  =$this->input->post('turno4_dolar');
        $turno4_cambio =$this->input->post('turno4_cambio');
        $turno4_bbv    =$this->input->post('turno4_bbv');
        $turno4_san    =$this->input->post('turno4_san');
        $turno4_exp    =$this->input->post('turno4_exp');
        $turno4_asalto =$this->input->post('turno4_asalto');
        $turno4_vale   =$this->input->post('turno4_vale');
        $turno4_cajera =$this->input->post('turno4_cajera');
        $turno4_corte  =$this->input->post('turno4_corte');
$vta=$this->input->post('vta');

$this->load->model('cortes_model');
$this->cortes_model->update_member_d($id_cc,$l1,$l2,$l4,$l5,$l8,$l9,$l10,$l11,$l12,$l13,$l16,$l19,$l20,$l21,$l22,$l23,$l24,$l30,$l40,
$la1,$la2,$la4,$la5,$la8,$la9,$la10,$la11,$la12,$la13,$la16,$la19,$la20,$la21,$la22,$la23,$la24,$la30,$la40,
$lc1,$lc2,$lc4,$lc5,$lc8,$lc9,$lc10,$lc11,$lc12,$lc13,$lc16,$lc19,$lc20,$lc21,$lc22,$lc23,$lc24,$lc30,$lc40,
        $turno1_pesos,$turno1_dolar,$turno1_cambio,$turno1_bbv,$turno1_san,$turno1_exp,$turno1_asalto,$turno1_vale,$turno1_cajera,$turno1_corte,
        $turno2_pesos,$turno2_dolar,$turno2_cambio,$turno2_bbv,$turno2_san,$turno2_exp,$turno2_asalto,$turno2_vale,$turno2_cajera,$turno2_corte,  
        $turno3_pesos,$turno3_dolar,$turno3_cambio,$turno3_bbv,$turno3_san,$turno3_exp,$turno3_asalto,$turno3_vale,$turno3_cajera,$turno3_corte,
        $turno4_pesos,$turno4_dolar,$turno4_cambio,$turno4_bbv,$turno4_san,$turno4_exp,$turno4_asalto,$turno4_vale,$turno4_cajera,$turno4_corte,$ivaa,$recarga);
redirect('cortes/tabla_control_validado_d/'.$suc.'/'.$fec);
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function subir_cortes()
    {
        $data['titulo'] = "CORTES";
        $data['contenido'] = "subir_cortes";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        $data_c['extraheader'] = "
        <script type=\"text/javascript\" src=\"".base_url()."scripts/AjaxUpload.2.0.min.js\"></script>
        ";
        
        $this->load->view('header', $data_c);
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    function upload()
    {
        $this->load->helper('file');
        $this->load->library('unzip');
        $uploaddir = './cortes/';
        $file = basename($_FILES['userfile']['name']);
        $uploadfile = $uploaddir . $file;
        
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            
                $var = get_file_info('./cortes/'.$file);
                $string = read_file('./cortes/'.$file);
                
                if($var['size'] == 0){
            
            $a = "
            <p class=\"message-box error\">Error: $file - Archivo Vacio.</p>
            ";
            
            echo $a;
                    
                    
                }else{
            
        $this->load->model('cortes_model');
        echo $this->cortes_model->inserta_archivos($file, $var['size'], $string);
        
        }
        
        } else {
          echo "error";
        }

    }


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function valida_corte_c($id_cc)
    {
        $this->load->model('cortes_model');
		$this->cortes_model->valida_member($id_cc);
     redirect('cortes/tabla_control_validado');   
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_poliza()
    {
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['quin'] = 0;
        $this->load->model('cortes_model');
        $data['titulo'] = "POLIZA DE CORTES";
        $data['contenido'] = "cortes_form_2";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_poliza1()
    {
        $this->load->model('catalogo_model');
        $data['plaza1'] = $this->catalogo_model->busca_plaza1();
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['quin'] = 0;
        $this->load->model('cortes_model');
        $data['titulo'] = "POLIZA DE CORTES";
        $data['contenido'] = "cortes_form_2_rep";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_poliza_filtro()
    {
        
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $quin= $this->input->post('quin');
        $fec=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('cortes_model');
        $data['tabla'] = $this->cortes_model->control_poliza($fec,$quin);
        
        
        $data['titulo'] = "POLIZA DE CORTES DE ".$mesx." DEL ".date('Y');
        $data['titulo1'] = "SI NO MUESTRA EL ICONO DE LA IMPRESORA ES POR QUE NO HA VALIDADO LOS FALTANTES O LOS CREDITOS EMPLEADOS";
        $data['contenido'] = "cortes";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_poliza_filtro1()
    {
        $plaza1= $this->input->post('plaza1');
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $quin= $this->input->post('quin');
        $fec=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('cortes_model');
        $data['tabla'] = $this->cortes_model->control_poliza1($fec,$quin, $plaza1);
        
        
        $data['titulo'] = "POLIZA DE CORTES DE ".$mesx." DEL ".date('Y');
        $data['titulo1'] = "SI NO MUESTRA EL ICONO DE LA IMPRESORA ES POR QUE NO HA VALIDADO LOS FALTANTES O LOS CREDITOS EMPLEADOS";
        $data['contenido'] = "cortes";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function imprimir_poliza($fec)
	{
	      $aaa=substr($fec,0,4);
          $mes=substr($fec,5,2);
          
          
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        
            
            $data['cabeza'].= "
           <table>
           
           <tr>
           <td colspan=\"12\" align=\"center\"><strong>CONTROL DE POLIZA DE CORTES</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"12\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')."<br /></td>
           </tr>
           <tr>
           <td colspan=\"12\" align=\"center\">FECHA DE POLIZA..:<strong>".$mesx." DEL ".$aaa."</strong> <br /></td>
           </tr>
           </table> 
            ";
            $this->load->model('cortes_model');
            $data['detalle'] = $this->cortes_model->imprime_poliza_detalle($fec);
            
            
            $this->load->view('impresiones/poliza', $data);
            
		}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function imprimir_poliza_una($fec,$suc,$quin)
	{
	      $aaa=substr($fec,0,4);
          $mes=substr($fec,5,2);
          
          
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $sucx =$this->catalogo_model->busca_suc_unica($suc);
        
        
            
            $data['cabeza'].= "
           <table>
           
           <tr>
           <td colspan=\"12\" align=\"center\"><strong>CONTROL DE POLIZA DE CORTES</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"12\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')."<br /></td>
           </tr>
           <tr>
           <td colspan=\"12\" align=\"center\">FECHA DE POLIZA..:<strong>".$mesx." DEL ".$aaa."</strong> <br /></td>
           </tr>
           <tr>
           <td colspan=\"12\" align=\"center\">SUCURSAL..:<strong>".$suc." - ".$sucx."</strong> <br /></td>
           </tr>
           </table> 
            ";
            $this->load->model('cortes_model');
            $data['detalle'] = $this->cortes_model->imprime_poliza_detalle_una($fec,$suc,$quin,$mes);
            
            
            $this->load->view('impresiones/poliza', $data);
            
		}
        
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function imprimir_poliza_una1($fec,$suc,$quin,$plaza1)
	{
	      $aaa=substr($fec,0,4);
          $mes=substr($fec,5,2);
          
          
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $sucx =$this->catalogo_model->busca_suc_unica($suc);
        
        
            
            $data['cabeza'].= "
           <table>
           
           <tr>
           <td colspan=\"12\" align=\"center\"><strong>CONTROL DE POLIZA DE CORTES</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"12\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')."<br /></td>
           </tr>
           <tr>
           <td colspan=\"12\" align=\"center\">FECHA DE POLIZA..:<strong>".$mesx." DEL ".$aaa."</strong> <br /></td>
           </tr>
           <tr>
           <td colspan=\"12\" align=\"center\">SUCURSAL..:<strong>".$suc." - ".$sucx."</strong> <br /></td>
           </tr>
           </table> 
            ";
            $this->load->model('cortes_model');
            $data['detalle'] = $this->cortes_model->imprime_poliza_detalle_una1($fec,$suc,$quin,$mes,$plaza1);
            
            
            $this->load->view('impresiones/poliza', $data);
            
		}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function desmarcar_fal($id)
    {
        $this->load->model('cortes_model');
		$this->cortes_model->valida_member_fal_des($id);
redirect('cortes/tabla_control_faltante');   
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////
public function cambia_fal_nom($id)
    {
        $this->load->model('catalogo_model');
        $this->load->model('cortes_model');
		$query = $this->cortes_model->busca_faltante($id);
        $row=$query->row();
        $nomina=$row->nomina;
		$data['tabla'] = $this->cortes_model->control_fal_t($id);        
       
	    $data['completo'] = $this->catalogo_model->busca_usuario_nomina_tod($nomina);
        $data['nuevo'] = $this->catalogo_model->busca_usuario_nomina_gral();
        
        $data['id_fal'] = $id;
        $data['fecha'] = $row->fecha;
        $data['suc'] = $row->suc;
        $data['sucx'] = $row->sucx;
        $data['nom'] = $nomina;
        $this->load->model('cortes_model');
        $data['titulo'] = "FALTANTES";
        $data['contenido'] = "faltante_form_2";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function borrar_fal_det($id,$id_falc)
    {
         $this->load->model('cortes_model');
		$this->cortes_model->delete_member_faltante_det($id);
redirect('cortes/cambia_fal_nom/'.$id_falc);   
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function borrar_fal_det_con($id,$id_falc)
    {
         $this->load->model('cortes_model');
		$this->cortes_model->delete_member_faltante_det($id);
redirect('cortes/cambia_fal/'.$id_falc);   
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function edita_faltante()
    {
        $id_fal= $this->input->post('id_fal');
        $id_emp= $this->input->post('id_emp');
        $importe= $this->input->post('importe');
        $motivo= $this->input->post('motivo');
        $this->load->model('cortes_model');
        $this->cortes_model->update_member_c_fal($id_fal,$id_emp,$importe,$motivo);
        redirect('cortes/cambia_fal_nom/'.$id_fal);
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_control_validado_corte()
    {
        
       $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $this->load->model('cortes_model');
        $data['titulo'] = "EDITAR DE CORTES";
        $data['contenido'] = "cortes_form_corte_1";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_control_corte_edita()
    {
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $fec=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('cortes_model');
        $data['tabla'] = $this->cortes_model->control_corte_edita($fec);
        $data['titulo'] = "POLIZA DE CORTES CERRADOS";
        
        $data['titulo'] = "POLIZA DE CORTES DE ".$mesx." DEL ".date('Y');
        $data['titulo1']= '';
        
        $data['contenido'] = "cortes";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_control_corte_edita_succ($fec)
    {
        
        $this->load->model('catalogo_model');
          
          
        $this->load->model('cortes_model');
        $data['tabla'] = $this->cortes_model->control_corte_edita($fec);
        $data['titulo'] = "POLIZA DE CORTES CERRADOS";
        
        $data['titulo'] = "";
        $data['titulo1']= '';
        $data['contenido'] = "cortes";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar_poliza_una($fec,$suc)
    {
        
        $this->load->model('catalogo_model');
        $this->load->model('cortes_model');
        $data['tabla'] = $this->cortes_model->control_corte_edita_suc($fec,$suc);
        $data['titulo'] = "POLIZA DE CORTES CERRADOS";
        
        $data['titulo1'] = "";
        $data['contenido'] = "cortes";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_detalle_his_regresar($fec,$suc,$id_cc)
    {
     
$this->load->model('cortes_model');
$this->cortes_model->update_member_c_regresar($id_cc);
redirect('cortes/editar_poliza_una/'.$fec.'/'.$suc);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_detalle_his_borrar($fec,$suc,$id_cc)
    {
     
$this->load->model('cortes_model');
$this->cortes_model->delete_member_c_borrar($id_cc);
redirect('cortes/editar_poliza_una/'.$fec.'/'.$suc);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  public function tabla_detalle_his_corte($fec,$suc,$id_cc)
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
         
        $fechac=$row->fechacorte;
        $data['recarga'] =$this->cortes_model->ta($suc,$fechac);
        $data['sucursal'] =$suc." - ".$sucx;
        $data['fechac'] =$fechac;
        $data['iva'] =$iva;
        
        
        $data['tabla'] =$this->cortes_model->busca_control($id_cc);
        $data['id_cc'] =$id_cc;
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
        $data['cl'] =' ';
        $data['fec'] =$fec;
        $data['suc'] =$suc;
        $data['titulo'] = "CAPTURA DE CORTES";
        $data['contenido'] = "cortes_form_2_his";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
///////////////////////////////////////////////////+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
///////////////////////////////////////////////+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 public function actualiza_d_corte()
    {
        $id_cc=$this->input->post('id_cc');
        $this->load->model('cortes_model');
		$query =$this->cortes_model->busca_iva($id_cc);
        $row=$query->row();
        $ivaa=$row->iva;
        $suc=$this->input->post('suc');
        $fec=$this->input->post('fec');
        
        $l1=$this->input->post('l1');
        $l2=$this->input->post('l2');
        $l4=$this->input->post('l4');
        $l5=$this->input->post('l5');
        $l8=$this->input->post('l8');
        $l9=$this->input->post('l9');
        $l10=$this->input->post('l10');
        $l11=$this->input->post('l11');
        $l12=$this->input->post('l12');
        $l13=$this->input->post('l13');
        $l16=$this->input->post('l16');
        $l19=$this->input->post('l19');
        $l20=$this->input->post('l20');
        $l21=$this->input->post('l21');
        $l22=$this->input->post('l22');
        $l23=$this->input->post('l23');
        $l24=$this->input->post('l24');
        $l30=$this->input->post('l30');
        $l40=$this->input->post('l40');
        
        $lc1=$this->input->post('lc1');
        $lc2=$this->input->post('lc2');
        $lc4=$this->input->post('lc4');
        $lc5=$this->input->post('lc5');
        $lc8=$this->input->post('lc8');
        $lc9=$this->input->post('lc9');
        $lc10=$this->input->post('lc10');
        $lc11=$this->input->post('lc11');
        $lc12=$this->input->post('lc12');
        $lc13=$this->input->post('lc13');
        $lc16=$this->input->post('lc16');
        $lc19=$this->input->post('lc19');
        $lc20=$this->input->post('lc20');
        $lc21=$this->input->post('lc21');
        $lc22=$this->input->post('lc22');
        $lc23=$this->input->post('lc23');
        $lc24=$this->input->post('lc24');
        $lc30=$this->input->post('lc30');
        $lc40=$this->input->post('lc40');
        
        $la1=$this->input->post('la1');
        $la2=$this->input->post('la2');
        $la4=$this->input->post('la4');
        $la5=$this->input->post('la5');
        $la8=$this->input->post('la8');
        $la9=$this->input->post('la9');
        $la10=$this->input->post('la10');
        $la11=$this->input->post('la11');
        $la12=$this->input->post('la12');
        $la13=$this->input->post('la13');
        $la16=$this->input->post('la16');
        $la19=$this->input->post('la19');
        $la20=$this->input->post('la20');
        $la21=$this->input->post('la21');
        $la22=$this->input->post('la22');
        $la23=$this->input->post('la23');
        $la24=$this->input->post('la24');
        $la30=$this->input->post('la30');
        $la40=$this->input->post('la40');
        
         $turno1_pesos  =$this->input->post('turno1_pesos');
        $turno1_dolar  =$this->input->post('turno1_dolar');
        $turno1_cambio =$this->input->post('turno1_cambio');
        $turno1_bbv    =$this->input->post('turno1_bbv');
        $turno1_san    =$this->input->post('turno1_san');
        $turno1_exp    =$this->input->post('turno1_exp');
        $turno1_asalto =$this->input->post('turno1_asalto');
        $turno1_vale   =$this->input->post('turno1_vale');
        $turno1_cajera =$this->input->post('turno1_cajera');
        $turno1_corte  =$this->input->post('turno1_corte');
        
        $turno2_pesos  =$this->input->post('turno2_pesos');
        $turno2_dolar  =$this->input->post('turno2_dolar');
        $turno2_cambio =$this->input->post('turno2_cambio');
        $turno2_bbv    =$this->input->post('turno2_bbv');
        $turno2_san    =$this->input->post('turno2_san');
        $turno2_exp    =$this->input->post('turno2_exp');
        $turno2_asalto =$this->input->post('turno2_asalto');
        $turno2_vale   =$this->input->post('turno2_vale');
        $turno2_cajera =$this->input->post('turno2_cajera');
        $turno2_corte  =$this->input->post('turno2_corte');
        
        $turno3_pesos  =$this->input->post('turno3_pesos');
        $turno3_dolar  =$this->input->post('turno3_dolar');
        $turno3_cambio =$this->input->post('turno3_cambio');
        $turno3_bbv    =$this->input->post('turno3_bbv');
        $turno3_san    =$this->input->post('turno3_san');
        $turno3_exp    =$this->input->post('turno3_exp');
        $turno3_asalto =$this->input->post('turno3_asalto');
        $turno3_vale   =$this->input->post('turno3_vale');
        $turno3_cajera =$this->input->post('turno3_cajera');
        $turno3_corte  =$this->input->post('turno3_corte');
        
        $turno4_pesos  =$this->input->post('turno4_pesos');
        $turno4_dolar  =$this->input->post('turno4_dolar');
        $turno4_cambio =$this->input->post('turno4_cambio');
        $turno4_bbv    =$this->input->post('turno4_bbv');
        $turno4_san    =$this->input->post('turno4_san');
        $turno4_exp    =$this->input->post('turno4_exp');
        $turno4_asalto =$this->input->post('turno4_asalto');
        $turno4_vale   =$this->input->post('turno4_vale');
        $turno4_cajera =$this->input->post('turno4_cajera');
        $turno4_corte  =$this->input->post('turno4_corte');

     
$this->load->model('cortes_model');
$this->cortes_model->update_member_d_corte($id_cc,$l1,$l2,$l4,$l5,$l8,$l9,$l10,$l11,$l12,$l13,$l16,$l19,$l20,$l21,$l22,$l23,$l24,$l30,$l40,
$la1,$la2,$la4,$la5,$la8,$la9,$la10,$la11,$la12,$la13,$la16,$la19,$la20,$la21,$la22,$la23,$la24,$la30,$la40,
$lc1,$lc2,$lc4,$lc5,$lc8,$lc9,$lc10,$lc11,$lc12,$lc13,$lc16,$lc19,$lc20,$lc21,$lc22,$lc23,$lc24,$lc30,$lc40,
        $turno1_pesos,$turno1_dolar,$turno1_cambio,$turno1_bbv,$turno1_san,$turno1_exp,$turno1_asalto,$turno1_vale,$turno1_cajera,$turno1_corte,
        $turno2_pesos,$turno2_dolar,$turno2_cambio,$turno2_bbv,$turno2_san,$turno2_exp,$turno2_asalto,$turno2_vale,$turno2_cajera,$turno2_corte,  
        $turno3_pesos,$turno3_dolar,$turno3_cambio,$turno3_bbv,$turno3_san,$turno3_exp,$turno3_asalto,$turno3_vale,$turno3_cajera,$turno3_corte,
        $turno4_pesos,$turno4_dolar,$turno4_cambio,$turno4_bbv,$turno4_san,$turno4_exp,$turno4_asalto,$turno4_vale,$turno4_cajera,$turno4_corte,$ivaa);
redirect('cortes/editar_poliza_una/'.$fec.'/'.$suc);
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function marcar($fec,$suc)
    {
        $this->load->model('cortes_model');
		$this->cortes_model->valida_member_corte($fec,$suc);
redirect('cortes/tabla_control_corte_edita_succ/'.$fec);   
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function desmarcar($fec,$suc)
    {
        $this->load->model('cortes_model');
		$this->cortes_model->valida_member_corte_des($fec,$suc);
redirect('cortes/tabla_control_corte_edita_succ/'.$fec);   
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////  
///////////////////////////////////////////////////////////
     
	public function tabla_envio_cortes()
	{
       $this->load->model('catalogo_model');
       $data['mesx'] = $this->catalogo_model->busca_mes();
       $data['aaax'] = $this->catalogo_model->busca_anio();
       
       $this->load->model('envio_model');
       $aaa= $this->input->post('aaa');
       $mes= $this->input->post('mes');
       $fec=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT);
       
       $data['titulo'] = "ENVIO CORTES A AS/400";
       $data['contenido'] = "envio_form_1";
       $data['selector'] = "envio";
       $data['sidebar'] = "sidebar_cortes";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
       //$mensaje = $this->envio_model->cortes($fec);
       
       //redirect('cortes/portada/'.$mensaje);
       		
		}
 
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
     
	public function tabla_envio_cortes_fin()
	{
	   ini_set('memory_limit','2000M');
       set_time_limit(0);
       $this->load->model('envio_model');
       $aaa= $this->input->post('aaa');
       $mes= $this->input->post('mes');
       $fec=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT);
       
       $mensaje = $this->envio_model->cortes($fec);
       
       redirect('cortes/portada/'.$mensaje);
       		
		}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_cre()
    {
          
        $this->load->model('cortes_model');
        $data['tabla'] = $this->cortes_model->control_cre();
        
        $data['titulo'] = "CREDITO EMPLEADOS NO VALIDADOS";
        $data['titulo1']= '';
        $data['contenido'] = "cortes";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_cre1()
    {
        
        $data['tabla'] = " ";
        $data['titulo'] = "POLIZA DE CORTES";
        $this->load->model('catalogo_model');
        $data['plaza1'] = $this->catalogo_model->busca_plaza1();  
        
        $data['titulo'] = "CREDITO EMPLEADOS";
        $data['titulo1']= '';
        $data['contenido'] = "cortes2";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
  
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_cre2()
    {
        $plaza1= $this->input->post('plaza1');
        $fec1= $this->input->post('fec1');
        $fec2= $this->input->post('fec2');  
        $this->load->model('cortes_model');
        $data['tabla'] = $this->cortes_model->control_cre1($plaza1, $fec1, $fec2);
        $this->load->model('catalogo_model');
        $data['plaza1'] = $this->catalogo_model->busca_plaza1();
        
        $data['titulo'] = "CREDITO EMPLEADOS NO VALIDADOS";
        $data['titulo1']= '';
        $data['contenido'] = "cortes2tabla";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function agrega_cre($id_cre)
    {
        
        $this->load->model('cortes_model');
        $data['tabla'] = $this->cortes_model->control_cre_t($id_cre);
        
        $this->load->model('catalogo_model');
        $data['id_empx']=$this->catalogo_model->busca_usuario_nomina_bloque();
        
        $data['titulo'] = "CANCELAR FALTANTE DE CAJA";
        $data['titulo'] = "CREDITO EMPLEADOS NO APLICADOS";
        $data['id_cre'] = $id_cre;
        $data['contenido'] = "credito_form_1";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 


 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function agrega_cre_cor($id_cre)
    {
        
        $this->load->model('cortes_model');
        $data['tabla'] = $this->cortes_model->control_cre_t($id_cre);
        
        $this->load->model('catalogo_model');
        $data['id_empx']=$this->catalogo_model->busca_usuario_nomina_bloque_corte();
        
        $data['titulo'] = "CANCELAR FALTANTE DE CAJA";
        $data['titulo'] = "CREDITO EMPLEADOS NO APLICADOS";
        $data['id_cre'] = $id_cre;
        $data['contenido'] = "credito_form_2";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function agrega_credito()
    {
        $id_cre= $this->input->post('id_cre');
        $id_emp= $this->input->post('id_emp');
        $importe= $this->input->post('importe');
        $clave=519;
        $this->load->model('cortes_model');
		$this->cortes_model->add_member_credito($id_cre,$id_emp,$importe,$clave);
redirect('cortes/agrega_cre/'.$id_cre);   
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function agrega_credito_cor()
    {
        $id_cre= $this->input->post('id_cre');
        $id_emp= $this->input->post('id_emp');
        $importe= $this->input->post('importe');
        
        $this->load->model('cortes_model');
		$this->cortes_model->add_member_credito_cortes($id_cre,$id_emp,$importe);
redirect('cortes/agrega_cre_cor/'.$id_cre);   
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function borrar_cre($id,$id_cre)
    {
         $this->load->model('cortes_model');
		$this->cortes_model->delete_member_credito($id);
redirect('cortes/agrega_cre/'.$id_cre);   
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function val_cre($id_cc)
    {
        $this->load->model('cortes_model');
		$this->cortes_model->valida_member_cre($id_cc);
redirect('cortes/tabla_control_cre');   
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_faltante_recarga()
    {
        $this->load->model('catalogo_model');
		$data['sucx'] = $this->catalogo_model->busca_sucursal();
         $data['id_empx']=$this->catalogo_model->busca_usuario_nomina_bloque_corte();
          
        $this->load->model('cortes_model');
        $data['tabla'] = $this->cortes_model->control_varios();
        
        $data['titulo'] = "CAPTURA DE FALTANTE DIVERSOS";
        $data['titulo1']= '';
        $data['contenido'] = "faltante_form_4";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function agrega_varios_faltantes()
    {
        $suc= $this->input->post('suc');
        $id_emp= $this->input->post('id_emp');
        $importe= $this->input->post('importe');
        $motivo= $this->input->post('motivo');
        $fechacorte= $this->input->post('fechacorte');
        
        $this->load->model('cortes_model');
		$this->cortes_model->add_member_credito_varios_cortes($id_emp,$suc,$fechacorte,$importe,$motivo);
redirect('cortes/tabla_control_faltante_recarga');   
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
public function val_varios_fal($id)
    {
        $this->load->model('cortes_model');
		$this->cortes_model->valida_member_varios($id);
redirect('cortes/tabla_control_faltante_recarga');   
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function del_varios_fal($id)
    {
        $this->load->model('cortes_model');
		$this->cortes_model->delete_member_varios($id);
redirect('cortes/tabla_control_faltante_recarga');   
    }




















/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function prueba()
  {
    $suc=906;
    $fecha='2011-12-05';
    $this->load->model('cortes_model');
    $monto=$this->cortes_model->pru();
    echo $monto;
    
  }  
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_faltante()
    {
          
        $this->load->model('cortes_model');
        $data['tabla'] = $this->cortes_model->control_faltante();
        $data['titulo'] = "POLIZA DE CORTES";
        
        $data['titulo'] = "FALTANTES DE CAJA NO VALIDADOS";
        $data['titulo1']= '';
        $data['contenido'] = "cortes";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_faltante1()
    {
        
        $data['tabla'] = " ";
        $data['titulo'] = "POLIZA DE CORTES";
        $this->load->model('catalogo_model');
        $data['plaza1'] = $this->catalogo_model->busca_plaza1();
        
        $data['titulo'] = "FALTANTES DE CAJA NO VALIDADOS";
        $data['titulo1']= '';
        $data['contenido'] = "cortes1";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_control_faltante2()
    {

        $plaza1= $this->input->post('plaza1');
        $fec1= $this->input->post('fec1');
        $fec2= $this->input->post('fec2');
        $this->load->model('cortes_model');
        $data['tabla'] = $this->cortes_model->control_faltante1($plaza1, $fec1, $fec2);
        $data['titulo'] = "POLIZA DE CORTES";
        $this->load->model('catalogo_model');
        $data['plaza1'] = $this->catalogo_model->busca_plaza1();
        
        $data['titulo'] = "FALTANTES DE CAJA NO VALIDADOS";
        $data['titulo1']= '';
        $data['contenido'] = "cortes1tabla";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////  
///////////////////////////////////////////////////////////
public function cambia_fal($id)
    {
        $this->load->model('catalogo_model');
        $this->load->model('cortes_model');
		$query = $this->cortes_model->busca_faltante($id);
        $row=$query->row();
        $nomina=$row->nomina;
        $fal=$row->fal;
        $clave=$row->clave;
        $turno=$row->turno;
        
        $data['completo'] = $this->catalogo_model->busca_usuario_nomina($nomina);
        $data['nuevo'] = $this->catalogo_model->busca_usuario_nomina_bloque();
        
        $data['tabla'] = $this->cortes_model->control_fal_t_con($id,$clave,$turno);
        $data['id_fal'] = $id;
        
        $this->load->model('cortes_model');
        $data['titulo'] = "FALTANTES NO APLCADOS";
        $data['contenido'] = "faltante_form_1";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////  
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function borrar_fal($id_fal)
    {
        
        $this->load->model('cortes_model');
        $data['tabla'] = $this->cortes_model->control_faltante_t($id_fal);
        $data['titulo'] = "CANCELAR FALTANTE DE CAJA";
        $data['titulo'] = "FALTANTES DE CAJA NO APLICADOS";
        $data['id_fal'] = $id_fal;
        $data['contenido'] = "faltante_form_3";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function delete_fal()
    {
        $id_fal= $this->input->post('id_fal');
        $motivo= $this->input->post('motivo');
        $this->load->model('cortes_model');
		$this->cortes_model->delete_member_fal($id_fal,$motivo);
redirect('cortes/tabla_control_faltante');   
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function marcar_fal($id,$corte)
    {
        $this->load->model('cortes_model');
		$this->cortes_model->valida_member_fal($id,$corte);
redirect('cortes/tabla_control_faltante');   
    }

 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function edita_faltante_con()
    {
        $id_fal= $this->input->post('id_fal');
        $id_emp= $this->input->post('id_emp');
        $importe= $this->input->post('importe');
        $motivo= $this->input->post('motivo');
        $clave= 520;
        
        $this->load->model('cortes_model');
        $this->cortes_model->update_member_c_fal($id_fal,$id_emp,$importe,$motivo,$clave);
        redirect('cortes/cambia_fal/'.$id_fal);
        
    }

 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_control_sucursal()
    {
        $this->load->model('catalogo_model');
		$data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        
        $this->load->model('cortes_model');
        $data['titulo'] = "SUCURSALES ASIGNADAS";
        $data['contenido'] = "cortes_form_3";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_control_sucursal_bloque()
    {
        $aaa=date('Y');
        $mes= $this->input->post('mes');
        $fec=$aaa."-".str_pad($mes,2,"0",STR_PAD_LEFT); 
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes); 
	    $this->load->model('cortes_model');   
        
        $data['tabla'] = $this->cortes_model->control_sucursal($fec);
        $data['titulo1'] = "SUCURSALES QUE YA TRANSMITIERON DEL MES DE $mesx";
        $data['titulo'] = "SUCURSALES ASIGNADAS";
        $data['contenido'] = "cortes";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_control_sucursal_bloque_det($suc,$fec)
    {
        $mes=substr($fec,5,2);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        $sucx = $this->catalogo_model->busca_suc_unica($suc);  
	    
        $this->load->model('cortes_model');   
        $data['tabla'] = $this->cortes_model->control_sucursal_det($suc,$fec);
        $data['titulo1'] = "MES DE $mesx DE LA SUCURSAL $suc - $sucx";
        $data['titulo'] = "SUCURSALES ASIGNADAS";
        $data['contenido'] = "cortes";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_control_sucursal_bloque_det_corte($id_cc,$fec,$suc)
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
        $data['titulo'] = "CAPTURA DE CORTES";
        $data['contenido'] = "cortes_form_3_his";
        $data['selector'] = "cortes";
        $data['sidebar'] = "sidebar_cortes";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




}    