<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Encargado extends CI_Controller
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

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function indexm()
    {
        $data['mensaje']= '';
        $data['titulo']= 'MOVIMIENTOS DE SUCURSALES';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS';
        $data['contenido'] = "encargado";
        $data['selector'] = "encargado";
        $data['sidebar'] = "sidebar_encargado_mov";
                
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
        $data['titulo']= 'CAPTURA  DE MOVIMIENTOS';
        $data['titulo1']= 'FAVOR DE SELECCIONAR LA FECHA EN QUE TRABAJO';
        $this->load->model('catalogo_model');
        $this->load->model('encargado_model');
        $data['motx'] = $this->catalogo_model->busca_mov_encargado_cap();
        $data['tabla']='BUENOS DIAS';
        $data['contenido'] = "encargado_form_repo";
        $data['selector'] = "encargado";
        $data['sidebar'] = "sidebar_encargado_mov";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function movimiento_mot()
    {
        $plaza= $this->session->userdata('plaza');
        $todo= $this->input->post('mot');
        $id_mov=substr($todo,0,1);
        $fecha_i= substr($todo,1,10);
        $hora= substr($this->input->post('clave'),0,2);
        $clave= substr($this->input->post('clave'),2,10);
        $horaactual=date('H');
        
        //**
         $fecha_actual=date('Y-m-d');
         $fecha_minima='2012-12-23';
        $dia=date('d');
        if($dia>0 and $dia<=7){$m=date('m');$num=1;}
        if($dia>7 and $dia<=21){$m=date('m');$num=16;}
        if($dia>21){$m=date('m')+1;$num=1;}

        $this->load->model('catalogo_model');
        $nomx= $this->catalogo_model->busca_empleado_clave($clave);
        $query = $this->catalogo_model->busca_mes_calendario($m,$num);
        $row=$query->row();
        $mesx=$row->mesx;
        $quincena=$row->quincena;

        
        //**
        $q = $this->catalogo_model->busca_dia($fecha_i,$id_mov);
        $r = $q->row();
        $si= $r->numero;
        if($id_mov<>6){$si=1;}
        
        //if($fecha_i >= $fecha_minima){$si=0;}
        
        $data['mensaje']= '';
        $data['titulo']= 'CAPTURA DE MOVIMIENTOS<BR /><P><font size="2">'.$r->motivox.' DEL '.$r->dia.' DE '.$r->mes.' DEL '.$r->aaa.'</P>';
        $data['titulo1']= '';
        
        $this->load->model('catalogo_model');
        $this->load->model('encargado_model');
        $data['nomx'] = $this->catalogo_model->empleado_encargado($id_mov,$quincena,$m);
		$data['id_mov'] = $id_mov;
        $data['tabla']= $this->encargado_model->captura_de_mov($nomx);
        
      
        if($nomx>0 and $hora==$horaactual){
       $data['suc']=0;
       $data['folio_inca']='';
       $data['fecha_i']=$fecha_i;
       $data['causa']='';
       $data['dias']=1;
       $data['clave']=$nomx;
       $data['id']=null;   
       $data['contenido'] = "encargado_form_reporta"; 
        
        $data['selector'] = "encargado";
        $data['sidebar'] = "sidebar_encargado_mov";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        }else{
        redirect('encargado/movimiento');    
        }
      }
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

  public function movimiento_mot_par($id_mov,$fecha_i,$clave,$id)
    {
        $plaza= $this->session->userdata('plaza');
        //**
        
        $dia=date('d');
     if($dia<22){
        $m=date('m');
        }else{
        $m=date('m')+1;    
        } 
        if(date('m')==12){$m=01;} 
        
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_mes_t($m);
        $row=$query->row();
        $mes=$row->mes;   
        
        if($dia>=1 and $dia<=7 or $dia>21){
        $quincena=$row->una;
        }
        if($dia>=8 and $dia<=21){
        $quincena=$row->dos;
        }
        //**
        $q = $this->catalogo_model->busca_dia($fecha_i,$id_mov);
        $r = $q->row();
        $si= $r->numero;
        if($id_mov<>6){$si=1;}
        
        $data['mensaje']= '';
        $data['titulo']= $this->session->userdata('nombre').'CAPTURA DE MOVIMIENTOS<BR /><P><font size="2">'.$r->motivox.' DEL '.$r->dia.' DE '.$r->mes.' DEL '.$r->aaa.'</P>';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('encargado_model');
        $data['nomx'] = $this->catalogo_model->empleado_encargado($id_mov,$quincena,$m);
		$data['id_mov'] = $id_mov;
        $data['tabla']= $this->encargado_model->captura_de_mov($clave);
       
        if($si > 0){
       $data['suc']=0;
       $data['folio_inca']='';
       $data['fecha_i']=$fecha_i;
       $data['causa']='';
       $data['clave']=$clave;
       $data['dias']=1; 
       $data['id'] = $id;  
       $data['contenido'] = "encargado_form_reporta"; 
        
        $data['selector'] = "encargado";
        $data['sidebar'] = "sidebar_encargado_mov";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        }else{
        redirect('encargado/movimiento');    
        }
        
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
    $clave= $this->input->post('clave');
    
    $this->load->model('supervisor_model');
    $id=$this->supervisor_model->agrega_member_movimiento($id_emp,$id_mov,$fecha_i,$obser,$suc,$folio_inca,$causa,$dias,$clave);
    if ($id==null){$id='nn';}
    redirect('encargado/movimiento_mot_par/'.$id_mov.'/'.$fecha_i.'/'.$clave.'/'.$id );
    
    }

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_empleados_borrar($id,$id_mov,$fecha_i,$clave)
    {
     
     $this->load->model('supervisor_model');
     $this->supervisor_model->delete_member_empleados($id);
     redirect('encargado/movimiento_mot_par/'.$id_mov.'/'.$fecha_i.'/'.$clave.'/'.$id);
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
public function tabla_empleados_validar($id,$id_mov,$fecha_i,$clave)
    {
     $dia=date('d');
     if($dia<22){
        $m=date('m');
        }else{
        $m=date('m')+1;    
        }
       if(date('m')==12){$m=01;} 
       
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_mes_t($m);
        $row=$query->row();
        $mes=$row->mes;   
        
        if($dia>=1 and $dia<=7 or $dia>22){
        $quincena=$row->una;
        }
        if($dia>=8 and $dia<=22){
        $quincena=$row->dos;
        }
        
        $fechaf=(date('Y')).str_pad($m,2,"0",STR_PAD_LEFT).str_pad($quincena,2,"0",STR_PAD_LEFT);
     $this->load->model('supervisor_model');
     $this->supervisor_model->valida_member_empleados($id,$fechaf);
     redirect('encargado/movimiento_mot_par/'.$id_mov.'/'.$fecha_i.'/'.$clave.'/'.$id);
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
        $data['motivox'] = $this->catalogo_model->busca_mov_encargado_cap_his();
        $this->load->model('encargado_model');
        $data['tabla']='BUENOS DIAS';
        $data['contenido'] = "encargado_mov_form_his";
        $data['selector'] = "encargado";
        $data['sidebar'] = "sidebar_encargado_mov";
              
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
        $fecha_i=$this->input->post('fecha_i');
        
        
        $this->load->model('catalogo_model');
        $q = $this->catalogo_model->busca_dia($fecha_i,$motivo);
        $r = $q->row();
        $data['mensaje']= '';
        $titulo= $this->session->userdata('nombre').'<br />EMPLEADOS CON MOVIMIENTOS <BR /><P><font size="2">'.$r->motivox.'  PARA APLICAR NOMINA  DEL '.$r->dia.' DE '.$r->mes.' DEL '.$r->aaa.'</P>';
        $data['titulo1']= '';
        $this->load->model('encargado_model');
        $data['tabla']= $this->encargado_model->captura_de_mov_his($motivo,$fecha_i,$titulo);
        $data['contenido'] = "encargado";
        $data['selector'] = "encargado";
        $data['sidebar'] = "sidebar_encargado_mov";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function imprimir_concentrado($motivo,$fecha_i)
    {
        $plaza= $this->session->userdata('plaza');
        
        $this->load->model('catalogo_model');
        $q = $this->catalogo_model->busca_dia($fecha_i,$motivo);
        $r = $q->row();
        $data['mensaje']= '';
        $titulo= $this->session->userdata('nombre').'<br />EMPLEADOS CON MOVIMIENTOS <BR /><P><font size="2">'.$r->motivox.'  PARA APLICAR NOMINA  DEL '.$r->dia.' DE '.$r->mes.' DEL '.$r->aaa.'</P>';
        $data['titulo1']= '';
        $this->load->model('encargado_model');
        $data['tabla']= $this->encargado_model->imprimir_concentrado_modelo($motivo,$fecha_i,$titulo);
        $data['contenido'] = "encargado";
        $data['selector'] = "encargado";
        $data['sidebar'] = "sidebar_encargado_mov";
    } 
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////    
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
        $data['contenido'] = "encargado_form_ventas_naturistas";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_encargado_mov";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

//////////
   public function tabla_control_ventas()
    {
        $aaa= $this->input->post('aaa');
        $mes= $this->input->post('mes');
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('encargado_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->encargado_model->control_ventas_naturistas($fec);
        
        $data['titulo'] = "REPORTE DE VENTAS DEL MES DE $mesx DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_encargado_mov";
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    /////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////
     public function tabla_control_concurso($fec,$suc,$nomina)
    {
        $aaa= substr($fec,0,4);
        $mes=substr($fec,5,2);
        $fec=$aaa."-".str_pad($mes,2,0,STR_PAD_LEFT);
        $this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
          
        $this->load->model('encargado_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->encargado_model->concurso_venta_empl($fec,$suc,$nomina);
        
        $data['titulo'] = "REPORTE DE VENTAS DE PRODUCTOS DE CONCURSO DEL MES DE $mesx DEL $aaa";
        $data['titulo1'] = "";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_encargado_mov";
        
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
        $this->load->model('encargado_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->encargado_model->control_ventas_producto_naturistas($fec,$suc,$meta);
        
        $data['titulo'] = "REPORTE DE COMISIONES DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = " $suc - $sucx";
        $data['titulo2'] = " ";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_encargado_mov";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
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
        $data['sidebar'] = "sidebar_encargado_mov";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function venta_dia_naturistas($suc,$fec)
    {
        $aaa=substr($fec,0,4);
        $mes=substr($fec,5,2);
		$this->load->model('catalogo_model');
        $mesx = $this->catalogo_model->busca_mes_unico($mes);
         $sucx =$this->catalogo_model->busca_suc_unica($suc); 
        $this->load->model('encargado_model');
        $data['fechac']= date('Y-m-d');
        $data['tabla'] = $this->encargado_model->control_ventas_dia_naturistas($fec,$suc);
        
        $data['titulo'] = "REPORTE DE COMISION DEL MES DE $mesx DEL $aaa ";
        $data['titulo1'] = " $suc - $sucx";
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_encargado_mov";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////
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
        $data['sidebar'] = "sidebar_encargado_mov";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////

public function recetas_spt()
    {
        $data['mensaje']= '';
        $data['titulo']= 'CAPTURA DE RECETAS DE SALUD PARA TODOS';
        $data['titulo1']= '';
        $this->load->model('encargado_model');
        $data['nombre']= $this->encargado_model->busca_medico();
        $data['tabla'] = $this->encargado_model->tickets_med();

		$data['contenido'] = "encargado_form_ventas_spt";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_encargado_mov";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    
    //////////////////////////////////////////////
    //////////////////////////////////////////////
//////////////////////////////////////////////
 
    
    function agrega_spt()
         {
        
        $this->load->model('encargado_model');
        $id = $this->encargado_model->agrega_ticket_medicos();
        redirect('encargado/recetas_spt');
          }   

        
//////////////////////////////////////////////
//////////////////////////////////////////////

   public function tabla_recetas_spt()
    {
        $this->load->model('catalogo_model');
        $data['tabla'] = $this->encargado_model->tickets_med();
        $data['titulo'] = "Captura de Tickets";
        $data['contenido'] = "encargado_form_ventas_spt";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_encargado_mov";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 

//////////////////////////////////////////////

public function captura_ticket($id)
    {
        $data['mensaje']= '';
        $data['titulo']= 'INGRESA NUMERO DE TICKET';
        $data['titulo1']= '';
        $this->load->model('encargado_model');  

		$data['contenido'] = "encargado_form_ventas_ticket";
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_encargado_mov";
        $data['id'] = $id;
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    
    public function actualiza_ticket()
    {
     $id=$this->input->post('id');
     $ticket=$this->input->post('ticket');
     $this->load->model('encargado_model');
     $this->encargado_model->actualiza_ticket_model($id, $ticket);
     redirect('encargado/recetas_spt');
    }   
    
    public function actualiza_ticket_pedido()
    {
        $data = array('tiket' => $this->input->post('ticket'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('catalogo.folio_pedidos_cedis_especial', $data); 
     redirect('a_surtido/historico_pedidos_sucursal_especial');
    }














































    
    
      }