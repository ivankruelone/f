<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Recursos_humanos extends CI_Controller
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
        $data['titulo']= 'MOVIMIENTOS CAPTURADOS POR EL SUPERVISOR';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "supervisor";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_recursos_humanos";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_mov_supervisor()
    {
        $plaza= $this->session->userdata('plaza');
        $data['mensaje']= '';
        $data['titulo']= 'MOVIMENTOS CAPTURADOS POR EL SUPERVISOR';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('recursos_humanos_model');
        $data['tabla']= "";
        $data['motivox'] = $this->catalogo_model->busca_mov_super_rh();
        $data['contenido'] = "recursos_humanos_form";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
              
        $this->load->view('header'); 
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_mov_supervisor_motivo()
    {
        $motivo= $this->input->post('motivo');
        $data['mensaje']= '';
        $data['titulo']= 'MOVIMENTOS CAPTURADOS POR EL SUPERVISOR';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('recursos_humanos_model');
        $data['tabla']= $this->recursos_humanos_model->supervisor_motivo($motivo);
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_recursos_humanos";
              
        $this->load->view('header'); 
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_mov_supervisor_motivo_s($motivo)
    {
        $data['mensaje']= '';
        $data['titulo']= 'MOVIMENTOS CAPTURADOS POR EL SUPERVISOR';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('recursos_humanos_model');
        $data['tabla']= $this->recursos_humanos_model->supervisor_motivo($motivo);
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_recursos_humanos";
              
        $this->load->view('header'); 
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
   
/////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_mov_supervisor_his()
    {
        $plaza= $this->session->userdata('plaza');
        $data['mensaje']= '';
        $data['titulo']= 'MOVIMENTOS CAPTURADOS POR EL SUPERVISOR';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('recursos_humanos_model');
        $data['tabla']= "";
        $data['motivox'] = $this->catalogo_model->busca_mov_super_rh();
        $data['contenido'] = "recursos_humanos_form_his";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
              
        $this->load->view('header'); 
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_mov_supervisor_motivo_his()
    {
        $motivo= $this->input->post('motivo');
        $data['mensaje']= '';
        $data['titulo']= 'MOVIMENTOS CAPTURADOS POR EL SUPERVISOR';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('recursos_humanos_model');
        $data['tabla']= $this->recursos_humanos_model->supervisor_motivo_his($motivo);
        $data['contenido'] = "recursos_humanos";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
              
        $this->load->view('header'); 
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_mov_supervisor_motivo_his_s($motivo)
    {
        $data['mensaje']= '';
        $data['titulo']= 'MOVIMENTOS CAPTURADOS POR EL SUPERVISOR';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('recursos_humanos_model');
        $data['tabla']= $this->recursos_humanos_model->supervisor_motivo_his($motivo);
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_recursos_humanos";
              
        $this->load->view('header'); 
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_empleados_validar_recursos($id,$motivo)
    {
        $data['mensaje']= '';
        $data['titulo']= 'MOVIMENTOS CAPTURADOS POR EL SUPERVISOR';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('recursos_humanos_model');
        $data['id']= $id;
        $data['motivo']= $motivo;
        
        $data['tabla']= $this->recursos_humanos_model->supervisor_motivo_uno($id,$motivo);
        $data['contenido'] = "recursos_humanos_form_obser";
        $data['selector'] = "supervisor";
        $data['sidebar'] = "sidebar_recursos_humanos";
              
        $this->load->view('header'); 
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function movimiento_reporta_valida_recursos()
	{
    $motivo= $this->input->post('motivo');
    $id= $this->input->post('id');
    $obser= $this->input->post('obser');
    $this->load->model('recursos_humanos_model');
   
 
    $this->recursos_humanos_model->agrega_member_movimiento_obser_rh($id,$obser);
    redirect('recursos_humanos/tabla_mov_supervisor_motivo_his_s/'.$motivo);
    
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_mov_alta()
    {
     
        $this->load->model('catalogo_model');
        $data['sucx'] = $this->catalogo_model->busca_sucursal();
        $data['ciax'] = $this->catalogo_model->busca_cia_nomina();
        
        $this->load->model('recursos_humanos_model');
        $data['tabla']= $this->recursos_humanos_model->captura_de_mov_rh();
        $data['titulo'] = "ENVIAR EMPLEADO A FARMACIA";
        $data['contenido'] = "recursos_humanos_form_alta";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
        
        
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
    $this->load->model('recursos_humanos_model');
   
    $this->recursos_humanos_model->agrega_member_movimiento_alta($nom,$id_mov,$fecha,$cia,$suc,$nomina);
    redirect('recursos_humanos/tabla_mov_alta');
    
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_empleados_borrar_rh($id)
    {
     
     $this->load->model('recursos_humanos_model');
     $this->recursos_humanos_model->delete_member_empleados($id);
     redirect('recursos_humanos/tabla_mov_alta');
    }

/////////////////////////////////////////////////////////////////////////////////////////
public function tabla_empleados_validar_rh($id,$motivo)
    {
     $this->load->model('supervisor_model');
     $this->supervisor_model->valida_member_empleados_rh($id);
     redirect('recursos_humanos/tabla_mov_supervisor_motivo_s/'.$motivo);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function tabla_empleados_validar_rh_alta($id)
    {
     
     $this->load->model('recursos_humanos_model');
     $this->recursos_humanos_model->valida_member_empleados($id);
     redirect('recursos_humanos/tabla_mov_alta');
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_mov_alta_llegaron()
    {
     
        $this->load->model('catalogo_model');
        $data['sucx'] = $this->catalogo_model->busca_sucursal();
        $data['ciax'] = $this->catalogo_model->busca_cia_nomina();
        
        $this->load->model('recursos_humanos_model');
        $data['tabla']= $this->recursos_humanos_model->mov_rh_llegaron();
        $data['titulo'] = "ENVIAR EMPLEADO A FARMACIA";
        $data['contenido'] = "recursos_humanos";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
 //////////////////////////////////////////////
//////////////////////////////////////////////
 public function busqueda_empleado_gral()
    {
        $this->load->model('catalogo_model');
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = "";
        $data['titulo'] = "BUSQUEDA DE EMPLEADOS";
        $data['contenido'] = "catalogo_form_usuario_bus_rh";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
  function busca_empleado_nombre_rh()
	{
    $nom=$this->input->post('nom');
    $pat=$this->input->post('pat');
    $mat=$this->input->post('mat');
    $this->load->model('catalogo_model');
    echo $this->catalogo_model->busca_empleados_nom_rh($nom,$pat,$mat);
    }
/////////////////////////////////////////////
//////////////////////////////////////////////
 public function busqueda_emp_una_rh($id)
    {
        
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->busca_empleado_todo_rh($id);
        $data['titulo'] = "BUSQUEDA DE EMPLEADOS";
        $data['contenido'] = "recursos_humanos";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
////////////////////////////////////////////
//////////////////////////////////////////////
 public function plantilla_sup()
    {
        
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->plantilla_sup_rh();
        $data['titulo'] = "BUSQUEDA DE EMPLEADOS";
        $data['contenido'] = "recursos_humanos";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
   
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_pendiente_cambio()
    {
     
         $this->load->model('recursos_humanos_model');
        $data['tabla']= $this->recursos_humanos_model->pendiente_cambio();
        $data['titulo'] = "EMPLEADOS QUE NO HAN HECHO EL CAMBIO DE SUCURSAL EN AS400";
        $data['contenido'] = "recursos_humanos";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos_pen";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////

 /////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_pendiente_disposicion()
    {
     
         $this->load->model('recursos_humanos_model');
        $data['tabla']= $this->recursos_humanos_model->pendiente_disposicion();
        $data['titulo'] = "EMPLEADOS QUE HAN REPORTADO DISPOSICION DE PERSONAL Y NO ESTAN DADOS DE BAJA EN AS400";
        $data['contenido'] = "recursos_humanos";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos_pen";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_pendiente_alta()
    {
     
         $this->load->model('recursos_humanos_model');
        $data['tabla']= $this->recursos_humanos_model->pendiente_alta();
        $data['titulo'] = "EMPLEADOS QUE SE LES ASIGN&Oacute; MAL EL NUMERO DE NOMINA";
        $data['contenido'] = "recursos_humanos";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos_pen";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////SOLO ALTAS DE RECURSOS HUMANOS COMO CONTADOR
       
    public function indexab()
    {
        $data['mensaje']= '';
        $data['titulo']= 'ALTA DE EMPLEADO ';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "recursos_humanos";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos_alta";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
  public function tabla_empleados_captura_ab()
    {
        $this->load->model('catalogo_model');
        $this->load->model('recursos_humanos_model');
        $data['motx'] = $this->catalogo_model->busca_motivo_rh_dias();
        $data['tabla'] = $this->recursos_humanos_model->empleados_pendientes_ab();
        $data['titulo'] = "ALTA DE EMPLEADOS";
        $data['contenido'] = "recursos_humanos_form_empleados_captura";
        $data['selector'] = "recursos_humanos3";
        $data['sidebar'] = "sidebar_recursos_humanos_alta";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
/////////////////////////////////////////////

  public function tabla_empleados_agrega_ab()
    {
        $id_user= $this->session->userdata('id');
        $motivo= $this->input->post('motivo');
        if($motivo=='ALTA'){
        $this->load->model('catalogo_model');
        $data['titulo'] = "CONTROL  DE ".$motivo." DE NOMINAS";
        $data['motivo'] =$motivo;    
        $data['sucx'] = $this->catalogo_model->busca_sucursal_bloque_id_2012();
        $data['ciax'] = $this->catalogo_model->busca_cia_nomina();
        $data['puex'] = $this->catalogo_model->busca_puesto();
        $data['causa']  ='';
        $data['nomina']  =0;
        $data['tabla'] ='';    
        $data['contenido'] = "recursos_humanos_form_empleados_al";
        $data['selector'] = "recursos_humanos3";
        $data['sidebar'] = "sidebar_recursos_humanos_alta";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        }
        if($motivo=='BAJA'){
        $this->load->model('catalogo_model');
        $data['titulo'] = "CONTROL  DE ".$motivo." DE NOMINAS";
        $data['motivo'] =$motivo;    
        $data['id_nomx'] = $this->catalogo_model->busca_usuario_nomina_bloque_2012();
        $data['nomina'] =0;
        $data['tabla'] = '';
        $data['contenido'] = "recursos_humanos_form_empleados_als";
        $data['selector'] = "recursos_humanos3";
        $data['sidebar'] = "sidebar_recursos_humanos_alta";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        }
        
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////

   public function agrega_empleados()
    {//cia, rfc, cur, afilia, pat, mat, nom, puesto, suc, fecha_i, salario, integrado, registro_pat, id_user, motivo, causa, id, dire, num, col, cp, mun, entidad
        
        $cia= $this->input->post('cia');
        $rfc= $this->input->post('rfc');
        $cur= $this->input->post('curp');
        $afilia= $this->input->post('afilia');
        $pat= $this->input->post('pat');
        $mat= $this->input->post('mat');
        $nom= $this->input->post('nom');
        $puesto= $this->input->post('puesto');
        $suc= $this->input->post('suc');
        $fecha_i= $this->input->post('fecha_i');
        $salario= $this->input->post('salario');
        $integrado= $this->input->post('integrado');
        $registro_pat= $this->input->post('registro_pat');
        $motivo= $this->input->post('motivo');
        $causa= $this->input->post('causa');
        $dire= $this->input->post('dire');
        $num= $this->input->post('num');
        $col= $this->input->post('col');
        $cp=$this->input->post('cp');
        $mun= $this->input->post('mun');
        $entidad= $this->input->post('enti');
        $autoriza= $this->input->post('autoriza');
        $nomina= $this->input->post('nomina');
        
        if($cia>0 and $puesto>0 and $suc>0){
	    $this->load->model('catalogo_model');
        $this->catalogo_model->agrega_member_empleado($cia,$rfc,$cur,$afilia,$pat,$mat,$nom,$puesto,$suc,$fecha_i,$salario,
        $integrado,$registro_pat,$motivo,$causa,$dire,$num,$col,$cp,$mun,$entidad,$autoriza,$nomina,$suc);
        }
    redirect('recursos_humanos/tabla_empleados_captura_ab');
    } 
    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function agrega_empleados_bajas_ab()
    {//cia, rfc, cur, afilia, pat, mat, nom, puesto, suc, fecha_i, salario, integrado, registro_pat, id_user, motivo, causa, id, dire, num, col, cp, mun, entidad
        $id_nom= $this->input->post('id_nom');
       
        $this->load->model('catalogo_model');
        $query =$this->catalogo_model->busca_usuario_id($id_nom);
        if($query->num_rows() >0){
		$row=$query->row();
        $cia= $row->cia;
        $rfc= $row->rfc;
        $cur= $row->curp;
        $afilia= $row->afiliacion;
        $pat= $row->pat;
        $mat= $row->mat;
        $nom= $row->nom;
        $puesto= $row->puesto;
        $suc= $row->suc;
        $succ= $row->succ;
        $registro_pat= $row->registro_pat;
        $nomina= $row->nomina;
        
        $salario= 0;
        $integrado= 0;
        
        $fecha_i= $this->input->post('fecha_i');
        $motivo= $this->input->post('motivo');
        $causa= $this->input->post('causa');
        $autoriza= $this->input->post('autoriza');
        $dire= '';
        $num= '';
        $col= '';
        $cp='';
        $mun= '';
        $entidad= '';
        
        }
	  
      
        $this->catalogo_model->agrega_member_empleado($cia,$rfc,$cur,$afilia,$pat,$mat,$nom,$puesto,$suc,$fecha_i,$salario,
        $integrado,$registro_pat,$motivo,$causa,$dire,$num,$col,$cp,$mun,$entidad,$autoriza,$nomina,$succ);
    redirect('recursos_humanos/tabla_empleados_captura_ab');
    } 
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_empleados_borrar_c($id,$motivo)
    {
     $this->load->model('catalogo_model');
     $this->catalogo_model->delete_member_empleados($id);
     redirect('recursos_humanos/tabla_empleados_captura_ab');
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_empleados_validar($id,$motivo)
    {
    $this->load->model('catalogo_model');
     $this->catalogo_model->valida_member_empleados($id);
    redirect('recursos_humanos/tabla_empleados_captura_ab');
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function tabla_empleados_captura_ab_his()
    {
        $this->load->model('catalogo_model');
        $this->load->model('recursos_humanos_model');
        $data['motx'] = $this->catalogo_model->busca_motivo_rh_dias();
        $data['tabla'] = '';
        $data['titulo'] = "HISTORICO DE ALTAS";
        $data['contenido'] = "recursos_humanos_form_empleados_ab_his";
        $data['selector'] = "recursos_humanos3";
        $data['sidebar'] = "sidebar_recursos_humanos_alta";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_empleados_captura_ab_his_imp()
    {
    $fec1= $this->input->post('fec1');
    $fec2= $this->input->post('fec2');
    $mot= $this->input->post('mot');
          $data['cabeza']='<p align="center"><strong>REPORTE DE MOVIMIENTOS '.$mot.'</strong><br /></p><p align="left">Impresion :'.date('Y-m-d H:i:s').'</p>';
          $data['cabeza'].='<table border="1" bgcolor="#E6DCFD">
        <tr>
        <th>EMPLEADO</th>
        <th>DIRECCION</th>
        <th>PUESTO<br />SALARIO</th>
        <th>SUCURSAL</th>
        <th>CAPTURO</th>
        <th>RFC <br />CURP  </th>
        <th>AFILIACION <br />REGISTRO PATRONAL</th>
        <th>Fec.Valida</th>
        </tr>
        </table>
        ';
          
          $this->load->model('recursos_humanos_model');
            $data['detalle'] = $this->recursos_humanos_model->empleados_mov_ab($fec1,$fec2,$mot);
            $this->load->view('impresiones/nomina_mov', $data);
    }

//////////////////////////////////////////////
//////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////ROCIO,LUIS Y OSCAR
    public function indexc()
    {
        $data['mensaje']= '';
        $data['titulo']= 'MOVIMIENTOS ';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
        $data['contenido'] = "recursos_humanos";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////    
   public function tabla_empleados_pendientes_his()
    {
        $this->load->model('recursos_humanos_model');
        
        $data['tabla'] = $this->recursos_humanos_model->empleados_pendientes_his();
        $data['titulo'] = "MOVIMIENTOS DE EMPLEADOS PENDIENTES EN RH";
        $data['contenido'] = "recursos_humanos";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function movimiento_ab_his_cla()
    {
        $this->load->model('catalogo_model');
        $this->load->model('recursos_humanos_model');
        $data['motx'] = $this->catalogo_model->busca_motivo_rh_dias();
        $data['tabla'] = '';
        $data['titulo'] = "HISTORICO DE ALTAS";
        $data['contenido'] = "recursos_humanos_form_empleados_ab_his";
        $data['selector'] = "recursos_humanos3";
        $data['sidebar'] = "sidebar_recursos_humanos_alta";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_empleados_cambia_rh($id,$motivo)
    {
        $id_user= $this->session->userdata('id');
        $tipo= $this->session->userdata('tipo');
        $nivel= $this->session->userdata('nivel');
        $this->load->model('catalogo_model');
        $this->load->model('recursos_humanos_model');
             
        if($motivo==3){
        $data['id']= $id;
        $data['motivo']= $motivo;
        $data['titulo'] = "CONTROL  DE ".$motivo." DE EMPLEADOS";
        $data['tabla'] = $this->recursos_humanos_model->empleados_succ_cambio($id);
        $data['contenido'] = "catalogo_form_empleados_cambios_rh2";
        
         }
        
        if($motivo=='ALTA' || $motivo=='BAJA' || $motivo=='RETENCION'){
        $query =$this->catalogo_model->busca_usuario_id_val($id);
        if($query->num_rows() >0){
		$row=$query->row();
        $data['puesto']= $row->puesto;
        $data['suc']= $row->suc;
        $data['sucursal']= $row->sucursal;
        $data['id']= $id;
        $data['puestox']= $row->puestox;
        $data['cia']= $row->ciax;
        $data['id_nomx']= $row->nom." ".$row->pat." ".$row->mat;
        $data['rfc']= $row->rfc;
        $data['afilia']= $row->afilia;
        $data['curp']= $row->cur;
        $data['registro_pat']= $row->registro_pat;
        $data['nomina']= $row->empleado;
        $data['motivo']= $row->motivo;
        $data['causa']= $row->causa;
        $data['autoriza']= $row->autoriza;
        $data['cla']= substr($row->suc,0,2).substr($row->rfc,0,8).substr($row->empleado,2,1).date('HYimsd').substr($row->suc,0,4);
        $motivot= $row->motivo;
        $data['id']= $id;
        $data['motivo']= $motivot;
        $data['titulo'] = "CONTROL  DE ".$motivot." DE EMPLEADOS";
        $data['tabla'] = $this->catalogo_model->empleados_pendientes($motivo);
        $data['contenido'] = "catalogo_form_empleados_cambios_rh";
        }}
       
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
     }
/////////////////////////////////////////////////////////////////////////////////////// 
  public function cambia_empleados_rh($id)
    {
        $clave_rh= $this->input->post('clave_rh');
        $empleado= $this->input->post('empleado');
        $nomina= $this->input->post('nomina');
        $id= $this->input->post('id');
        if($empleado==0){$emp=$nomina;}else{$emp=$empleado;}
     $this->load->model('catalogo_model');
     $this->catalogo_model->cambia_member_empleados_rh($id,$clave_rh,$emp);
    redirect('recursos_humanos/tabla_empleados_pendientes_his');
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 
  public function cambia_empleados_rh2($id)
    {
        $clave_rh= $this->input->post('clave_rh');
        $id= $this->input->post('id');
        $motivo= $this->input->post('motivo');
        
     $this->load->model('catalogo_model');
     $this->catalogo_model->cambia_member_empleados_rh2($id,$clave_rh,$motivo);
    redirect('recursos_humanos/tabla_empleados_pendientes_his');
    }
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////// 
   
   public function tabla_empleados_pendientes_incapa()
    {
  		$clave=644;
        $this->load->model('recursos_humanos_model');
        $data['tabla'] = $this->recursos_humanos_model->empleados_pendientes_incapacidad($clave);
        $data['titulo'] = "INCAPACIDADES PENDIENTES EN RH";
        $data['contenido'] = "recursos_humanos";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////


    public function tabla_empleados_pendientes_incapa_xsup()
    {
  		$clave=644;
        $this->load->model('recursos_humanos_model');
        $data['titulo'] = "INCAPACIDADES PENDIENTES EN RH POR SUPERVISOR";
        $data['contenido'] = "recursos_humanos_incapacidad_xsup";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
        $data['supervisorx'] = $this->recursos_humanos_model->busca_supervisor();
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    
    public function tabla_incapacidad_supervisor()
    {
        $clave=644;
        $this->load->model('recursos_humanos_model');
        $data['titulo'] = "INCAPACIDADES PENDIENTES EN RH POR SUPERVISOR";
        $data['selector'] = "recursos_humanos";
        $data['contenido'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
        $data['tabla'] = $this->recursos_humanos_model->empleados_pendientes_incapacidad_xsup($clave);
       
   
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }    
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function tabla_empleados_pendientes_falta()
    {
  		$clave=613;
        $this->load->model('recursos_humanos_model');
        $data['tabla'] = $this->recursos_humanos_model->empleados_pendientes_incapacidad($clave);
        $data['titulo'] = "FALTAS PENDIENTES EN RH";
        $data['contenido'] = "recursos_humanos";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos_faltas";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    //////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function tabla_empleados_pendientes_falta_xsup()
    {
  		$clave=613;
        $this->load->model('recursos_humanos_model');
        $data['titulo'] = "FALTAS PENDIENTES EN RH POR SUPERVISOR";
        $data['contenido'] = "recursos_humanos_falta_xsup";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
        $data['supervisorx'] = $this->recursos_humanos_model->busca_supervisor();
       
 
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    public function tabla_falta_supervisor()
    {
        $clave=613;
        $this->load->model('recursos_humanos_model');
        $data['titulo'] = "FALTAS PENDIENTES EN RH POR SUPERVISOR";
        $data['selector'] = "recursos_humanos";
        $data['contenido'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
        $data['tabla'] = $this->recursos_humanos_model->empleados_pendientes_incapacidad_xsup($clave);
       
   
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }    
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function tabla_empleados_pendientes_alguno($clave)
    {
  		$this->load->model('recursos_humanos_model');
        $data['tabla'] = $this->recursos_humanos_model->empleados_pendientes_incapacidad($clave);
        $data['titulo'] = "FALTAS PENDIENTES EN RH";
        $data['contenido'] = "recursos_humanos";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
//$data['contenido'] = "catalogo_form_empleados_cambios_rh2";
  public function entrega_recibo($id,$clave)
    {
  		
        $this->load->model('recursos_humanos_model');
        $data['clave'] = $clave;
        $data['id'] = $id;
        $data['tabla'] = $this->recursos_humanos_model->empleados_pendientes_uno($id);
        $data['titulo'] = "FALTAS PENDIENTES EN RH";
        $data['contenido'] = "catalogo_form_empleados_recibo_rh";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
 public function recibe_comprobante_firmado()
    {
        $clave= $this->input->post('clave');
        $id= $this->input->post('id');
        $obser= $this->input->post('obser');
        
     $this->load->model('recursos_humanos_model');
     $this->recursos_humanos_model->cambia_member_recibo_fal_in($id,$clave,$obser);
    redirect('recursos_humanos/tabla_empleados_pendientes_alguno/'.$clave);
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
  public function tabla_entrega_recibo_his()
    {
  		
        $this->load->model('catalogo_model');
        $data['clax'] = $this->catalogo_model->busca_falta_inca();
        $data['tabla'] = '';
        $data['titulo'] = "FALTAS PENDIENTES EN RH";
        $data['contenido'] = "rh_form_documento_entregado";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
  public function entrega_recibo_his()
    {
  		 $clave= $this->input->post('clave');
         $fec1= $this->input->post('fec1');
         $fec2= $this->input->post('fec2');
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          
            $data['cabeza'].= "
           <table>
           
           <tr>
           <td colspan=\"12\" align=\"center\"><strong>CONTROL DE MOVIMIENTOS</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"12\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')."<br /></td>
           </tr>
           <tr>
           <td colspan=\"12\" align=\"center\">FECHA..:<strong>".$fec1." - ".$fec2."</strong> <br /></td>
           </tr>
           
           </table> 
            ";
            $this->load->model('recursos_humanos_model');
            $data['detalle'] =  $this->recursos_humanos_model->entrega_recibo_his_nuevorh($clave,$fec1,$fec2);
            
            //echo $data['detalle'];
            //die();
            $this->load->view('impresiones/poliza_nomina', $data);
        
        
        
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function movimiento_inca()
    {
        $plaza= $this->session->userdata('plaza');
        $cau='INCAPACIDAD';
        $data['mensaje']= '';
        $data['titulo']= 'CAPTURA DE INCAPACIDADES<BR /><P>';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('supervisor_model');
        $data['motx'] = $this->catalogo_model->busca_mov_super();
        $data['tabla']= $this->supervisor_model->captura_de_mov();
        $data['contenido'] = "rh_form_repo";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
   public function movimiento_mot()
    {
        $plaza= $this->session->userdata('plaza');
        $id_mov= $this->input->post('mot');
        $data['mensaje']= '';
        $data['titulo']= 'CAPTURA DE MOVIMIENTOS<BR /><P><font size="2">PORFAVOR CUANDO CAPTUREN FALTAS IMPRIMAN LA PAPELETA Y EN ENTREGUENLA A CONTADORES O RH</P>';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('supervisor_model');
        $data['nomx'] = $this->catalogo_model->empleado_sup_rh();
		$data['id_mov'] = $id_mov;
        $data['tabla']= $this->supervisor_model->captura_de_mov();
        
       if($id_mov==5){
 	
       $data['suc']=0;
       $data['obser']=' ';
       $data['causax'] = $this->catalogo_model->busca_causa($id_mov);
       $data['contenido'] = "rh_form_reporta_incapacidad"; 
       }
        
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
function movimiento_reporta_rh()
	{
    $id_emp= $this->input->post('nom');
    $id_mov= $this->input->post('id_mov');
    $fecha_i= $this->input->post('fecha_i');
    $obser= $this->input->post('obser');
    $suc= $this->input->post('suc');
    $folio_inca= $this->input->post('folio_inca');
    $causa= $this->input->post('causa');
    $dias= $this->input->post('dias');
    
    $this->load->model('supervisor_model');
    $this->supervisor_model->agrega_member_movimiento($id_emp,$id_mov,$fecha_i,$obser,$suc,$folio_inca,$causa,$dias);
    redirect('recursos_humanos/movimiento_inca');
    
    }
 /////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_empleados_borrar($id)
    {
     
     $this->load->model('supervisor_model');
     $this->supervisor_model->delete_member_empleados($id);
     redirect('recursos_humanos/movimiento_inca');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
public function tabla_empleados_validar_incapacidad($id)
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
        
        $fechaf=date('Y').str_pad($m,2,"0",STR_PAD_LEFT).str_pad($quincena,2,"0",STR_PAD_LEFT);
     $this->load->model('supervisor_model');
     $this->supervisor_model->valida_member_empleados($id,$fechaf);
     redirect('recursos_humanos/movimiento_inca');
    }   
 /////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   

    public function indexf()
    {
        $data['mensaje']= '';
        $data['titulo']= 'FALTAS';
        $data['titulo1']= '';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
        $data['contenido'] = "recursos_humanos";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos_faltas";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function movimiento_fal()
    {
        $plaza= $this->session->userdata('plaza');
        $id_mov= 1;
        //**
        $dia=date('d');
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
    
        //**
        
        $data['mensaje']= '';
        $data['titulo']= 'CAPTURA DE MOVIMIENTOS<BR /><P><font size="2">PORFAVOR CUANDO CAPTUREN FALTAS IMPRIMAN LA PAPELETA Y EN ENTREGUENLA A CONTADORES O RH</P>';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('recursos_humanos_model');
        $data['nomx'] = $this->catalogo_model->empleado_sup_rh($id_mov,$quincena,$m);
		$data['id_mov'] = $id_mov;
        $data['tabla']= $this->recursos_humanos_model->captura_de_mov_fal($id_mov);
        
      
       $data['suc']=0;
       $data['folio_inca']='';
       $data['causa']='';
       $data['dias']=1;   
       $data['contenido'] = "recursos_humanos_form_reporta"; 
        
        $data['selector'] = "ventas";
        $data['sidebar'] = "sidebar_recursos_humanos_faltas";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
   
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
   public function movimiento_mot_fal()
    {
        $plaza= $this->session->userdata('plaza');
        $id_mov= $this->input->post('mot');
        $data['mensaje']= '';
        $data['sucx']=0;
        $data['obser']=' ';
        $data['folio_inca']=' ';
        $data['causa']=' ';
        $data['dias']=1;
        $data['titulo']= 'CAPTURA DE MOVIMIENTOS<BR /><P><font size="2">PORFAVOR CUANDO CAPTUREN FALTAS IMPRIMAN LA PAPELETA Y EN ENTREGUENLA A CONTADORES O RH</P>';
        $data['titulo1']= '';
        $this->load->model('catalogo_model');
        $this->load->model('recursos_humanos_model');
        $data['nomx'] = $this->catalogo_model->empleado_sup_rh();
		$data['id_mov'] = $id_mov;
        $data['tabla']= $this->recursos_humanos_model->captura_de_mov_fal();
       $data['causax'] = $this->catalogo_model->busca_causa($id_mov);
       $data['contenido'] = "rh_form_reporta_falta_e"; 
         $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos_faltas";
              
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
function movimiento_reporta_rh_f()
	{
    $id_emp= $this->input->post('nom');
    $id_mov= $this->input->post('id_mov');
    $fecha_i= $this->input->post('fecha_i');
    $obser= $this->input->post('obser');
    $suc= $this->input->post('suc');
    $folio_inca= $this->input->post('folio_inca');
    $causa= $this->input->post('causa');
    $dias= $this->input->post('dias');
    
    $this->load->model('supervisor_model');
    $this->supervisor_model->agrega_member_movimiento($id_emp,$id_mov,$fecha_i,$obser,$suc,$folio_inca,$causa,$dias);
    redirect('recursos_humanos/movimiento_fal');
    
    }


 /////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_empleados_borrar_fal($id)
    {
     
     $this->load->model('supervisor_model');
     $this->supervisor_model->delete_member_empleados($id);
     redirect('recursos_humanos/movimiento_fal');
    }


/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
public function tabla_empleados_validar_falta($id)
    {
     $dia=date('d');
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
    
        
        $fechaf=date('Y').str_pad($m,2,"0",STR_PAD_LEFT).str_pad($quincena,2,"0",STR_PAD_LEFT);
     $this->load->model('supervisor_model');
     $this->supervisor_model->valida_member_empleados($id,$fechaf);
     redirect('recursos_humanos/movimiento_fal');
    }
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
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
    public function index_nom()
    {
        $data['mensaje']= '';
        $data['titulo']= 'ENTREGA DE NOMINAS';
        $data['titulo1']= '';
        $this->load->model('recursos_humanos_model');
        $data['tabla']= $this->recursos_humanos_model->quincena();
        $data['contenido'] = "rh_form_nomina_fecha";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos_nomina";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
public function inserta_detalle_nomina()
    {
    
     $this->load->model('recursos_humanos_model');
     $this->recursos_humanos_model->inserta_detalle($this->input->post('quincena'));
     redirect('recursos_humanos/index_nom');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function tabla_nomina($fec)
    {
        
        $data['mensaje']= '';
        $data['titulo']= 'ENTREGA DE NOMINAS '.$fec;
        $data['fec']= $fec;
        $this->load->model('catalogo_model');
		$data['sucx'] = $this->catalogo_model->busca_sucursal_general_nom();
        
        $this->load->model('recursos_humanos_model');
        $data['tabla']= $this->recursos_humanos_model->nomina($fec);
        $data['contenido'] = "rh_form_nomina_suc";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos_nomina";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
public function inserta_control_nomina()
    {
    $fec= $this->input->post('fec');
     $this->load->model('recursos_humanos_model');
     $this->recursos_humanos_model->inserta_control_nom($this->input->post('fec'),$this->input->post('suc'),$this->input->post('id_emp'));
     redirect('recursos_humanos/tabla_nomina/'.$fec);
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function tabla_nomina_suc($fec,$suc)
    {
        
        $this->load->model('catalogo_model');
		$sucx = $this->catalogo_model->busca_sucursal_una($suc);
        $data['titulo']= $sucx.'<br />ENTREGA DE NOMINAS '.$fec;
        $data['suc']= $suc;
        $data['fec']= $fec;
        $this->load->model('recursos_humanos_model');
        $data['tabla']= $this->recursos_humanos_model->nomina_suc($fec,$suc);
       $data['contenido'] = "rh_form_nomina_suc_emp";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos_nomina";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
public function borra_nomina($fec,$suc,$id)
    {
    $data = array('suc_act' => 0);
    $this->db->where('id', $id);
    $this->db->update('desarrollo.entrega_nomina_d', $data); 
    redirect('recursos_humanos/tabla_nomina_suc/'.$fec.'/'.$suc);        
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
public function agrega_nomina()
    {
    $data = array('suc_act' => $this->input->post('suc'));
    $this->db->where('id', $this->input->post('id_emp'));
    $this->db->where('aplicado',' ');
    $this->db->update('desarrollo.entrega_nomina_d', $data); 
    redirect('recursos_humanos/tabla_nomina_suc/'.$this->input->post('fec').'/'.$this->input->post('suc'));        
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
public function cerrar_nomina()
    {
    $data = array('aplicado' => 'S');
    $this->db->where('suc_act', $this->input->post('suc'));
    $this->db->where('quincena',$this->input->post('fec'));
    $this->db->update('desarrollo.entrega_nomina_d', $data);
    
    $data1 = array('tipo' => 'E','entrega'=>date('Y-m-d H:i:s'));
    $this->db->where('suc', $this->input->post('suc'));
    $this->db->where('fecha',$this->input->post('fec'));
    $this->db->update('desarrollo.entrega_nomina_c', $data1); 
    redirect('recursos_humanos/tabla_nomina_suc/'.$this->input->post('fec').'/'.$this->input->post('suc'));        
    }

//////////////////////////////////////////////
//////////////////////////////////////////////
    public function tabla_nomina_entrega()
    {
        $data['mensaje']= '';
        $data['titulo']= 'ENTREGA DE NOMINAS';
        $data['titulo1']= '';
        $this->load->model('recursos_humanos_model');
        $data['tabla']= '';
        $data['contenido'] = "rh_form_nomina_fecha_ent";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos_nomina";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
    public function tabla_nomina_entrega_final()
    {
        $data['mensaje']= '';
        
        $data['titulo']= 'ENTREGA DE NOMINAS '.$this->input->post('quincena');
        $data['titulo1']= '';
        $this->load->model('recursos_humanos_model');
        $data['tabla']= $data['tabla']= $this->recursos_humanos_model->quincena_final($this->input->post('quincena'));        $data['contenido'] = "recursos_humanos";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos_nomina";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
    public function impresion_final($fec,$suc)
    {
        $this->load->model('catalogo_model');
        $sucx = $this->catalogo_model->busca_sucursal_una($suc);
        $data['cabeza']= 
        
        "<table>
        <tr>
        <th colspan=\"6\" align=\"center\"><strong>ENTREGA DE NOMINAS ".$fec." ".$sucx."</strong></th>
        </tr>
        </table>";
        
        $data['linea']= 
        
        "<table>
        <tr>
        <th colspan=\"6\" align=\"center\"><strong>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
        - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
         - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</strong></th>
        </tr>
        </table>";
        
        $this->load->model('recursos_humanos_model');
        $data['detalle']= $this->recursos_humanos_model->nomina_imprime($fec,$suc);        
        $this->load->view('impresiones/nomina_suc', $data);
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
    public function index_vac()
    {
        $data['titulo']= 'Vacaciones';
        $data['tabla']= '';
        $data['contenido'] = "rh_form_vac";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos_nomina";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
    public function tabla_vacacion()
    {
         $data['titulo']= 'VACACIONES';
        $this->load->model('recursos_humanos_model');
        $data['tabla']= $data['tabla']= $this->recursos_humanos_model->vacacion($this->input->post('id_emp'));
        $data['contenido'] = "recursos_humanos";
        $data['selector'] = "recursos_humanos";
        $data['sidebar'] = "sidebar_recursos_humanos_nomina";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
public function actualiza_canvac()
    {
    $data = array('dias' => $this->input->post('valor'));
    $this->db->where('id', $this->input->post('id'));
     $this->db->update('desarrollo.periodo_vacas_detaller', $data);
     }
//////////////////////////////////////////////
////////////////////////////////////////////// cordinador de recursos reportes generales
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
   public function reportes_depto()
    {
         $tit= 'Reporte de sistemas';
        $data['titulo']= 'Reporte de sistemas';
        $data['tabla']= '';
        $this->load->model('catalogo_model');
        $data['quin']=$this->catalogo_model->busca_quin(); 
        
        
        $data['contenido']= "rh_form_reporte_quincena";
        $data['selector'] = "reporte";
        $data['sidebar'] = "sidebar_sistemas";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
   public function reportes_checador()
    {
      	$fec1=substr($this->input->post('quin'),0,10);
        $fec2=substr($this->input->post('quin'),10,10);
        $this->load->model('sistemas_model');
        $checan=$this->sistemas_model->personal_oficinas($fec1,$fec2);
       
      $data['cabeza']= "
      <table>
           
    <tr>
    <td colspan=\"5\" align=\"center\"><font size=\"+2\"><strong>RECURSOS HUMANOS<BR /></strong></font></td>
    </tr>
    
   </table> 
            ";
      echo $data['cabeza'];
            //$data['detalle']=$this->sistemas_model->rh_medicos();
            //$data['retencion']=$this->sistemas_model->rh_retencion();  
            
            
            $data['detalle1']=$this->sistemas_model->personal_oficinas($fec1,$fec2);
            $data['detalle2']=$this->sistemas_model->personal_oficinas_faltas($fec1,$fec2);
            $this->load->view('impresiones/sistemas_rh_horizontal', $data);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////
////////////////////////////////////////////// cordinador de recursos reportes generales






























    
      }