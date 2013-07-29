<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Prenomina extends CI_Controller
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
        $dia=date('d');
        $aaa=date('Y');
        $data['mensaje']= '';
        if($dia>0 and $dia<=7){$m=date('m');$num=1;}
        if($dia>7 and $dia<=21){$m=date('m');$num=16;}
        if($dia>21){$m=date('m')+1;$num=1;}
       
       $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_mes_calendario($m,$num);
        $row=$query->row();
        $mesx=$row->mesx;
        $quincena=$row->quincena;
       
        $data['titulo']='PRENOMINA PARA APLICAR EL '.$quincena.' DE '.$mesx.' DE '.$aaa;
        
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "prenomina";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

    public function tabla_captura()
    {
        $id_user= $this->session->userdata('id');
        $dia=date('d');
        $data['mensaje']= '';
        $aaa=date('Y');
        
		
        if($dia>0 and $dia<=7){$m=date('m');$num=1;}
        if($dia>7 and $dia<=21){$m=date('m');$num=16;}
        if($dia>21){$m=date('m')+1;$num=1;}
       
       $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_mes_calendario($m,$num);
        $row=$query->row();
        $mesx=$row->mesx;
        $quincena=$row->quincena;
        
        
        
        $data['clax']=$this->catalogo_model->busca_clave();
        $data['titulo']='PRENOMINA PARA APLICAR EL '.$quincena.' DE '.$mesx.' DE '.$aaa;
        $this->load->model('prenomina_model');
        $data['contenido'] = "prenomina_form_1";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";
        $data['tabla'] = '';
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_captura_1()
    {
        $id_plaza= $this->session->userdata('id_plaza');
        $dia=date('d');
        $data['mensaje']= '';
        $aaa=date('Y');
        
        if($dia>0 and $dia<=7){$m=date('m');$num=1;}
        if($dia>7 and $dia<=21){$m=date('m');$num=16;}
        if($dia>21){$m=date('m')+1;$num=1;}
       
       $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_mes_calendario($m,$num);
        $row=$query->row();
        $mesx=$row->mesx;
        $quincena=$row->quincena;
        
   
        
        $cla=$this->input->post('cla');
        $data['cla']=$cla;
        $data['fec']=$aaa.'-'.str_pad($m,2,0,STR_PAD_LEFT).'-'.$quincena;
        $fec=$aaa.'-'.str_pad($m,2,0,STR_PAD_LEFT).'-'.$quincena;
        $data['claxx']=$this->catalogo_model->busca_clave_una($cla);
       
        if($cla==331 || $cla==333){
        $data['id_empx']=$this->catalogo_model->busca_usuario_nomina_bloque_sin($cla,$m,$quincena);    
        }else{
        $data['id_empx']=$this->catalogo_model->busca_usuario_nomina_bloque();
        }
        
        $data['titulo']='PRENOMINA PARA APLICAR EL '.$quincena.' DE '.$mesx.' DE '.$aaa;
        $this->load->model('prenomina_model');
        $data['contenido'] = "prenomina_form_2";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";
         $data['tabla'] = $this->prenomina_model->muestra_clave($cla,$fec);;
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_captura_2($cla)
    {
        $dia=date('d');
        $data['mensaje']= '';
        $aaa=date('Y');
        
        if($dia>0 and $dia<=7){$m=date('m');$num=1;}
        if($dia>7 and $dia<=21){$m=date('m');$num=16;}
        if($dia>21){$m=date('m')+1;$num=1;}
       
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_mes_calendario($m,$num);
        $row=$query->row();
        $mesx=$row->mesx;
        $quincena=$row->quincena;
        $data['cla']=$cla;
        $data['fec']=$aaa.'-'.str_pad($m,2,0,STR_PAD_LEFT).'-'.$quincena;
        $fec=$aaa.'-'.str_pad($m,2,0,STR_PAD_LEFT).'-'.$quincena;
        
        
        $data['claxx']=$this->catalogo_model->busca_clave_una($cla);
        if($cla==331 || $cla==333){
        $data['id_empx']=$this->catalogo_model->busca_usuario_nomina_bloque_sin($cla,$m,$quincena);    
        }else{
        $data['id_empx']=$this->catalogo_model->busca_usuario_nomina_bloque();
        }
        $data['titulo']='PRENOMINA PARA APLICAR EL '.$quincena.' DE '.$mesx.' DE '.$aaa;
        $data['contenido'] = "prenomina_form_2";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";
         $this->load->model('prenomina_model');
        $data['tabla'] = $this->prenomina_model->muestra_clave($cla,$fec);
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_captura_graba()
    {
        $cla=$this->input->post('cla');
        $id_emp=$this->input->post('id_emp');
        $importe=$this->input->post('importe');
        $fechai=$this->input->post('fechai');
        $folioi=$this->input->post('folioi');
        $fec=$this->input->post('fec');
        
        
        $this->load->model('prenomina_model');
        $this->prenomina_model->agrega_member($importe,$id_emp,$cla,$fec,$folioi,$fechai);
    redirect('prenomina/tabla_captura_2/'.$cla);
    }
//////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function borrar_clave($id,$cla)
    {
        $this->load->model('prenomina_model');
        $this->prenomina_model->delete_member($id);
    redirect('prenomina/tabla_captura_2/'.$cla);
    }
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
    public function valida_fal($id)
    {
        $this->load->model('prenomina_model');
        $this->prenomina_model->valida_member_fal($id);
    redirect('prenomina/tabla_fal');
    }
//////////////////////////////////////////////////////////////////////////////////////////////

    public function tabla_fal()
    {
        $dia=date('d');
        $data['mensaje']= '';
        $aaa=date('Y');
        
             if($dia>0 and $dia<=7){$m=date('m');$num=1;}
        if($dia>7 and $dia<=21){$m=date('m');$num=16;}
        if($dia>21){$m=date('m')+1;$num=1;}
       
       $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_mes_calendario($m,$num);
        $row=$query->row();
        $mesx=$row->mesx;
        $quincena=$row->quincena;
        
   
       
        
        $this->load->model('prenomina_model');
        
        
        
        $data['titulo']='PRENOMINA PARA APLICAR EL '.$quincena.' DE '.$mesx.' DE '.$aaa;
        $data['tabla'] = $this->prenomina_model->fal_no();
        
        $data['contenido'] = "prenomina";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

    public function tabla_valida()
    {
        $dia=date('d');
        $data['mensaje']= '';
        $aaa=date('Y');
        
        if($dia>0 and $dia<=7){$m=date('m');$num=1;}
        if($dia>7 and $dia<=21){$m=date('m');$num=16;}
        if($dia>21){$m=date('m')+1;$num=1;}
       
       $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_mes_calendario($m,$num);
        $row=$query->row();
        $mesx=$row->mesx;
        $quincena=$row->quincena;
        
   
        
        
        $data['clax']=$this->catalogo_model->busca_clave();
        $fechavalida=$aaa."-".str_pad($m,2,"0",STR_PAD_LEFT)."-".str_pad($quincena,2,"0",STR_PAD_LEFT);
        echo $fechavalida;
        $data['titulo']='PRENOMINA PARA APLICAR EL '.$quincena.' DE '.$mesx.' DE '.$aaa;
        $this->load->model('prenomina_model');
        $data['contenido'] = "prenomina";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";
        $data['tabla']= $this->prenomina_model->faltante_sin_val_conta();
        $data['tabla'].= $this->prenomina_model->fal_valida($quincena,$mesx,$aaa,$dia,$m,$fechavalida);
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
    public function valida_clave($id,$aaa,$mes,$dia,$fechavalida)
    {
        
        $this->load->model('prenomina_model');
        $this->prenomina_model->valida_member_clave($id,$aaa,$mes,$dia,$fechavalida);
    redirect('prenomina/tabla_valida');
    }
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

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
        $data['contenido'] = "prenomina_form_3";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";
        $data['tabla'] = '';
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    public function tabla_poliza1()
    {
        $data['mensaje']= '';
        $this->load->model('catalogo_model');
        $data['plaza1'] = $this->catalogo_model->busca_plaza1();
        $data['mesx'] = $this->catalogo_model->busca_mes();
        $data['aaax'] = $this->catalogo_model->busca_anio();
        $data['quin'] = 0;
        $data['clax']=$this->catalogo_model->busca_clave();
        
        $data['titulo']='PRENOMINA ';
        $this->load->model('prenomina_model');
        $data['contenido'] = "prenomina_form_total";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";
        $data['tabla'] = '';
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_poliza_bloque()
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
        
          
        $this->load->model('prenomina_model');
        $data['tabla'] = $this->prenomina_model->control_poliza_bloque($fec);
        $data['titulo'] = "POLIZA DE PRENOMINA";
        
        $data['titulo'] = "PRENOMINA DE ".$mesx." DEL ".$aaa;
        $data['contenido'] = "prenomina";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    
    }
    
    
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_poliza_bloque1()
    {
         
        $plaza1= $this->input->post('plaza1');
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
        
          
        $this->load->model('prenomina_model');
        $data['tabla'] = $this->prenomina_model->control_poliza_bloque1($fec, $plaza1);
        $data['titulo'] = "POLIZA DE PRENOMINA";
        
        $data['titulo'] = "PRENOMINA DE ".$mesx." DEL ".$aaa;
        $data['contenido'] = "prenomina";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
    
    }
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
  function imprimir_poliza_bloque($fec,$cianom,$user_con)
	{
	      $data['cabeza']='';
          $this->load->model('catalogo_model');
          $aaa=substr($fec,0,4);
          $mes=substr($fec,5,2);
          
          
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $ciax =$this->catalogo_model->busca_cia_nom($cianom);
          $query = $this->catalogo_model->busca_usuarios($user_con);
        $row=$query->row();
        $nombre=$row->nombre;
        $puesto=$row->puesto;
        
        
            
            $data['cabeza'].= "
           <table>
           
           <tr>
           <td colspan=\"12\" align=\"center\"><strong>CONTROL DE POLIZA DE PRENOMINA</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"12\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')."<br /></td>
           </tr>
           <tr>
           <td colspan=\"12\" align=\"center\">FECHA DE POLIZA..:<strong>".$mesx." DEL ".$aaa."</strong> <br /></td>
           </tr>
           <tr>
           <td colspan=\"12\" align=\"center\">COMPA&Ntilde;IA..:<strong>".$cianom." - ".$ciax."</strong> <br /></td>
           </tr>
           <tr>
           <td colspan=\"12\" align=\"center\">CONTADOR..:<strong>".$nombre."</strong>  PLAZA..:<strong>".$puesto."</strong> <br /></td>
           </tr>
           </table> 
            ";
            $this->load->model('prenomina_model');
            $data['detalle'] = $this->prenomina_model->imprime_poliza_detalle_bloque($fec,$cianom);
            $data['detalle'].= $this->prenomina_model->imprime_poliza_detalle_bloque_ctl($fec,$cianom);
            
            $this->load->view('impresiones/poliza_nomina', $data);
            
		}
        
        //////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
  function imprimir_poliza_bloque1($fec,$cianom,$user_con,$plaza1)
	{
          
	      $data['cabeza']='';
          $this->load->model('catalogo_model');
          $aaa=substr($fec,0,4);
          $mes=substr($fec,5,2);
          
          $mesx = $this->catalogo_model->busca_mes_unico($mes);
          $ciax =$this->catalogo_model->busca_cia_nom($cianom);
          $query = $this->catalogo_model->busca_usuarios($user_con);
        $row=$query->row();
        $nombre=$row->nombre;
        $puesto=$row->puesto;
        
        
            
            $data['cabeza'].= "
           <table>
           
           <tr>
           <td colspan=\"12\" align=\"center\"><strong>CONTROL DE POLIZA DE PRENOMINA</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"12\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')."<br /></td>
           </tr>
           <tr>
           <td colspan=\"12\" align=\"center\">FECHA DE POLIZA..:<strong>".$mesx." DEL ".$aaa."</strong> <br /></td>
           </tr>
           <tr>
           <td colspan=\"12\" align=\"center\">COMPA&Ntilde;IA..:<strong>".$cianom." - ".$ciax."</strong> <br /></td>
           </tr>
           <tr>
           <td colspan=\"12\" align=\"center\">CONTADOR..:<strong>".$nombre."</strong>  PLAZA..:<strong>".$puesto."</strong> <br /></td>
           </tr>
           </table> 
            ";
            $this->load->model('prenomina_model');
            $data['detalle'] = $this->prenomina_model->imprime_poliza_detalle_bloque1($fec,$cianom,$plaza1);
            $data['detalle'].= $this->prenomina_model->imprime_poliza_detalle_bloque_ctl1($fec,$cianom,$plaza1);
            
            $this->load->view('impresiones/poliza_nomina', $data);
            
            
		}
        
        

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

}