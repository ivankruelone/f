<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Envio extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
    }

	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			redirect('login');
		}		
	}	

///////////////////////////////////////////////////////////  
///////////////////////////////////////////////////////////
    
    public function index()
    {
       
        $data['mensaje']= '';
        $data['titulo']= 'USUARIO DE NOMINAS';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "envio";
        $data['selector'] = "envio";
        $data['sidebar'] = "sidebar_envio";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
///////////////////////////////////////////////////////////  
///////////////////////////////////////////////////////////
    
    public function index1($mensaje)
    {
       if($mensaje==1){$mensajex='<font size="+1" color="#042AFE">EL ARCHIVO FUE ENVIADO CORRECTAMENTE</font>';}
       if($mensaje==2){$mensajex='<font size="+1" color="#FA0404">EL ARCHIVO NO SE ENVIO</font>';}
       
  
        $data['mensaje']= $mensajex;
        $data['titulo']= 'USUARIO DE NOMINAS';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "envio";
        $data['selector'] = "envio";
        $data['sidebar'] = "sidebar_envio";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
     
	public function tabla_envio_faltantes()
	{
       $this->load->model('catalogo_model');
       $mes=date('m');
       $data['mesx'] = $this->catalogo_model->busca_mes_unico($mes);
       $data['aaa'] = date('Y');
       $data['mes'] = date('m');
       $this->load->model('envio_model_prenomina');
       $fec=date('Y').'-'.str_pad($mes,2,0,STR_PAD_LEFT);

if(date('d')>=8 && date('d')<=15){
$data['quin'] =1;    
}elseif(date('d')>=22 && date('d')<=31){
$data['quin'] =2;    
}

       $data['fec'] = $fec;
       $data['titulo'] = "ENVIO CORTES A AS/400";
       $data['contenido'] = "envio_form_2";
       $data['selector'] = "envio";
       $data['sidebar'] = "sidebar_envio";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
       //$mensaje = $this->envio_model->cortes($fec);
       
       //redirect('cortes/portada/'.$mensaje);
       		
		}
 

//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
 	public function tabla_faltante_nom()
	{
       $aaa= $this->input->post('aaa');
       $mes= $this->input->post('mes');
       $fec=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT);
       $quin=$this->input->post('quin');
      
    $data['titulo'] = "ENVIO CORTES A AS/400";
    $this->load->model('envio_model_prenomina');
   $mensaje = $this->envio_model_prenomina->faltante_nom($fec,$quin,$mes,$aaa);
       
       redirect('envio/index1/'.$mensaje);
    }
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////

    public function tabla_poliza()
    {
        $data['mensaje']= '';
        $this->load->model('catalogo_model');
        $data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['quin'] = 0;
        $data['clax']=$this->catalogo_model->busca_clave();
        
        $data['titulo']='PRENOMINA ';
        $this->load->model('prenomina_model');
        $data['contenido'] = "envio_form_3";
        $data['selector'] = "envio";
        $data['sidebar'] = "sidebar_envio";
        $data['tabla'] = '';
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_poliza_todo()
    {
         
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $quin= $this->input->post('quin');
        
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_mes_t($mes);
        $row=$query->row();
        $mesx=$row->mes;
        if($quin==1){$quincena=$row->una;}
        if($quin==2){$quincena=$row->dos;}
        $fec=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT).'-'.str_pad($quincena,2,0,STR_PAD_LEFT);
        
        if($quin==3){$fec=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT);}
        
        
        
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        
          
        $this->load->model('envio_model');
        $data['tabla'] = $this->envio_model->control_poliza_todo($fec);
        $data['titulo'] = "POLIZA DE PRENOMINA";
        
        $data['titulo'] = "PRENOMINA DE ".$mesx." DEL ".$aaa;
        $data['mensaje'] = "";
        $data['contenido'] = "envio";
        $data['selector'] = "envio";
        $data['sidebar'] = "sidebar_envio";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    
    }
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
  function imprimir_poliza_todo($fec,$user_con)
	{
	      $data['cabeza']='';
          
          $this->load->model('catalogo_model');
          $this->load->model('prenomina_model');
          $data['aaa']=substr($fec,0,4);
          $data['mes']=substr($fec,5,2);
          $data['fec']=$fec;
          $data['user_con']=$user_con;
          $mes=substr($fec,5,2);
          $data['mesx']=$this->catalogo_model->busca_mes_unico($mes);
         
           
            $this->load->view('impresiones/poliza_nomina_toda', $data);
            
		}
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////

    public function tabla_poliza_con()
    {
        $data['mensaje']= '';
        $this->load->model('catalogo_model');
        $data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['quin'] = 0;
        $data['clax']=$this->catalogo_model->busca_clave();
        
        $data['titulo']='PRENOMINA POR CONCEPTO';
        $this->load->model('prenomina_model');
        $data['contenido'] = "envio_form_4";
        $data['selector'] = "envio";
        $data['sidebar'] = "sidebar_envio";
        $data['tabla'] = '';
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_poliza_todo_con()
    {
         
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $quin= $this->input->post('quin');
        
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_mes_t($mes);
        $row=$query->row();
        $mesx=$row->mes;
        if($quin==1){$quincena=$row->una;}
        if($quin==2){$quincena=$row->dos;}
        $fec=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT).'-'.str_pad($quincena,2,0,STR_PAD_LEFT);
        
        if($quin==3){$fec=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT);}
        
        
        
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        
          
        $this->load->model('envio_model');
        $data['tabla'] = $this->envio_model->control_poliza_todo_con($fec);
        $data['titulo'] = "POLIZA DE PRENOMINA";
        
        $data['titulo'] = "PRENOMINA DE ".$mesx." DEL ".$aaa;
        $data['mensaje'] = "";
        $data['contenido'] = "envio";
        $data['selector'] = "envio";
        $data['sidebar'] = "sidebar_envio";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    
    }
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
  function imprimir_poliza_todo_con($fec,$clave)
	{
	      $data['cabeza']='';
          
          $this->load->model('catalogo_model');
          $this->load->model('prenomina_model');
          
          $mes=substr($fec,5,2);
          $data['mesx']=$this->catalogo_model->busca_mes_unico($mes);
          $data['tabla'] = $this->prenomina_model->imprime_poliza_concepto($fec,$clave);
          $data['contenido'] = "envio";
          $data['selector'] = "envio";
          $data['sidebar'] = "sidebar_envio"; 

            
		}
  
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////

    public function tabla_poliza_cia()
    {
        $data['mensaje']= '';
        $this->load->model('catalogo_model');
        $data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['quin'] = 0;
        $data['clax']=$this->catalogo_model->busca_clave();
        
        $data['titulo']='PRENOMINA POR CONCEPTO';
        $this->load->model('prenomina_model');
        $data['contenido'] = "envio_form_cia";
        $data['selector'] = "envio";
        $data['sidebar'] = "sidebar_envio";
        $data['tabla'] = '';
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////
  public function tabla_poliza_todo_cia()
    {
         
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $quin= $this->input->post('quin');
        
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_mes_t($mes);
        $row=$query->row();
        $mesx=$row->mes;
        if($quin==1){$quincena=$row->una;}
        if($quin==2){$quincena=$row->dos;}
        $fec=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT).'-'.str_pad($quincena,2,0,STR_PAD_LEFT);
        
        if($quin==3){$fec=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT);}
        
        
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        
          
        $this->load->model('envio_model');
        $data['tabla'] = $this->envio_model->control_poliza_todo_con_cia_cia($fec);
        $data['titulo'] = "POLIZA DE PRENOMINA";
        
        $data['titulo'] = "PRENOMINA DE ".$mesx." DEL ".$aaa;
        $data['mensaje'] = "";
        $data['contenido'] = "envio";
        $data['selector'] = "envio";
        $data['sidebar'] = "sidebar_envio";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    
    }
//////////////////////////////////////////////////////

//////////////////////////////////////////////////////
  function imprimir_poliza_cia($fec,$cianom)
	{
	      $data['cabeza']='';
          
          $this->load->model('catalogo_model');
          $this->load->model('prenomina_model');
          $data['aaa']=substr($fec,0,4);
          $data['mes']=substr($fec,5,2);
          $data['fec']=$fec;
          $data['cianom']=$cianom;
          $mes=substr($fec,5,2);
          $data['mesx']=$this->catalogo_model->busca_mes_unico($mes);
         
           
            $this->load->view('impresiones/poliza_nomina_toda_cia', $data);
            
		}
//////////////////////////////////////////////////////  
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////

    public function tabla_envio_incapacidad()
    {
        $data['mensaje']= '';
        $this->load->model('catalogo_model');
        $data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['quin'] = 0;
        $data['clax']=$this->catalogo_model->busca_clave();
        
        $data['titulo']='INCAPACIDADES MAYORES A 15 DIAS';
        $this->load->model('prenomina_model');
        $data['contenido'] = "envio_form_incapacidad";
        $data['selector'] = "envio";
        $data['sidebar'] = "sidebar_envio";
        $data['tabla'] = '';
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///////////////////////////////////////////////////////////////////////////// 
//////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
  public function tabla_poliza_incapacidad()
    {
         
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $quin= $this->input->post('quin');
        
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_mes_t(date('m'));
        $row=$query->row();
        $mesx=$row->mes;
        if($quin==1){$quincena=$row->una;}
        if($quin==2){$quincena=$row->dos;}
        $fec=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT).'-'.str_pad($quincena,2,0,STR_PAD_LEFT);
        
        if($quin==3){$fec=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT);}
        
        
        
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
        
          
        $this->load->model('envio_model');
        $data['tabla'] = $this->envio_model->control_poliza_incapacidad($fec);
        $data['titulo'] = "POLIZA DE PRENOMINA";
        
        $data['titulo'] = "PRENOMINA DE ".$mesx." DEL ".$aaa;
        $data['mensaje'] = "";
        $data['contenido'] = "envio";
        $data['selector'] = "envio";
        $data['sidebar'] = "sidebar_envio";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    
    }
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////   
//////////////////////////////////////////////////////
   
}