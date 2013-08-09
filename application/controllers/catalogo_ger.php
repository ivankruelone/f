<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Catalogo_ger extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        $this->load->helper('form');
        
    }
//////////////////////////////////////////////
//////////////////////////////////////////////    
    public function esta_logeado()
    {
        $logeado = $this->session->userdata('is_logged_in');
        if($logeado == null){
            redirect('welcome');
        }
    }

    public function index()
    {
        $data['titulo']= 'CATALOGO';
        $data['tabla']= 'BUENOS DIAS A TODO EL PERSONAL';
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
 public function busqueda_emp()
    {
        $this->load->model('catalogo_model');
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = "";
        $data['titulo'] = "BUSQUEDA DE EMPLEADOS";
        $data['contenido'] = "catalogo_form_usuario_bus";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }   
 /////////////////////////////////////////////
//////////////////////////////////////////////
 public function busqueda_emp_una($id)
    {
        
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->busca_empleado_todo($id);
        $data['titulo'] = "BUSQUEDA DE EMPLEADOS";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }  
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_natur()
    {
        $plaza= $this->session->userdata('plaza');
        $this->load->model('catalogo_model');
        $data['nivel']=14;
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->pro_nat();
        $data['titulo'] = "CATALOGO DE PRODUCTOS NATURISTAS";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_gener()
    {
        $plaza= $this->session->userdata('plaza');
        $this->load->model('catalogo_model');
        $data['nivel']=14;
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->pro_generico();
        $data['titulo'] = "CATALOGO DE PRODUCTOS DE GENERICOS";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

   public function cat_naturistas()
    {
        $plaza= $this->session->userdata('plaza');
        $this->load->model('catalogo_model');
        $data['nivel']=14;
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->naturistas();
        $data['titulo'] = "CATALOGO DE PRODUCTOS NATURISTAS";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
/////////////////////////////////////////////////////////////////////////////// 
   public function tabla_gener_patente()
    {
        $plaza= $this->session->userdata('plaza');
        $this->load->model('catalogo_model');
        $data['nivel']=14;
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->pro_generico_patente();
        $data['titulo'] = "CATALOGO DE PRODUCTOS DE PATENTE ENCONTRADOS EN EL ALMACEN";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 

//////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
   public function tabla_gener_desco()
    {
        $plaza= $this->session->userdata('plaza');
        $this->load->model('catalogo_model');
        $data['nivel']=14;
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->pro_generico_desco();
        $data['titulo'] = "CATALOGO DE PRODUCTOS DESCONTINUADOS";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
 //////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////


public function tabla_farmabodega()
    {
        $plaza= $this->session->userdata('plaza');
        $this->load->model('catalogo_model');
        $data['nivel']=14;
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->cat_farmabodega();
        $data['titulo'] = "CATALOGO DE PRODUCTOS DE FARMABODEGA";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
 //////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
   public function tabla_genericos()
    {
        $plaza= $this->session->userdata('plaza');
        $this->load->model('catalogo_model');
        $data['nivel']=14;
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->cata_gene();
        $data['titulo'] = "CATALOGO DE PRODUCTOS DE GENERICOS";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////


   public function tabla_cambios_precios()
    {
        $plaza= $this->session->userdata('plaza');
        $this->load->model('catalogo_model');
        $data['nivel']=14;
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->pro_generico_cambio();
        $data['titulo'] = "CAMBIO DE PRECIOS";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
   public function tabla_gener_paquete()
    {
        $plaza= $this->session->userdata('plaza');
        $this->load->model('catalogo_model');
        $data['nivel']=14;
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->pro_generico_paquete();
        $data['titulo'] = "CATALOGO DE PRODUCTOS POR PAQUETE";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 

//////////////////////////////////////////////
//////////////////////////////////////////////

   public function tabla_ger()
    {
        $this->load->model('catalogo_model');
        $data['sucx'] = $this->catalogo_model->busca_sucursal_general();
        $data['plax'] = $this->catalogo_model->busca_plaza_ger();
        $data['nivel']=21;
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->gere();
        $data['titulo'] = "CATALOGO DE GERENTES";
        $data['contenido'] = "catalogo_form_usuario_ger_0";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 

//////////////////////////////////////////////
//////////////////////////////////////////////

function agrega_c_usuario()
	{
    $usuario= $this->input->post('usuario');
    $id_empleado= $this->input->post('id_empleado');
    $pla= $this->input->post('pla');
    $email= $this->input->post('correo');
    $pas= $this->input->post('pas');
    $suc= $this->input->post('suc');
    $activo= 1;
    $id= $this->input->post('id');
    $nivel=$this->input->post('nivel');  
    $tipo=1;
	$this->load->model('catalogo_model_ger');
    $this->catalogo_model_ger->agrega_member_usuario($usuario,$id_empleado,$pla,$email,$activo,$pas,$suc,$id,$nivel,$tipo);
    if($nivel==21){
    redirect('catalogo_ger/tabla_ger');    
    }else{
    redirect('catalogo_ger/tabla_sup');    
    }
    
    
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function usuario_supervisor($ger)
    {
        $nivel=21;
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_usuarios_ger_ger($ger);
        $row=$query->row();
        $data['usuario']=$row->username;
        $data['nombre']=$row->nombre;
        $data['puesto']=$row->puesto;
        $data['email']=$row->email;
        $data['plaza']=$row->plaza;
        $data['nivel']=$row->nivel;
        $data['supx'] = $this->catalogo_model->busca_sucursal_supervisor($ger);
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->usuarios_super($ger);
        $data['titulo'] = "CATALOGO DE GERENTES";
        $data['contenido'] = "catalogo_form_usuario_ger1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
function quitar_superv($plaza,$superv)
	{
    
  	$this->load->model('catalogo_model_ger');
    $this->catalogo_model_ger->quitar_member_usuario_superv($plaza,$superv);
    redirect('catalogo_ger/usuario_supervisor/'.$plaza);
    
    }
 //////////////////////////////////////////////
//////////////////////////////////////////////
function agrega_c_usuario_supervisor()
	{
    $sup= $this->input->post('sup');
    $id= $this->input->post('id');
    $plaza= $this->input->post('plaza');
    $nivel= $this->input->post('nivel');
  	$this->load->model('catalogo_model_ger');
    
    if($nivel==21){
    $this->catalogo_model_ger->agrega_member_usuario_superv($plaza,$sup);
    redirect('catalogo_ger/usuario_supervisor/'.$plaza);
    }else{
    $this->catalogo_model_ger->agrega_member_usuario_suc($plaza,$sup);
    redirect('catalogo_ger/usuario_sucur/'.$plaza);
        
    }
    }
////////////////////////////////////////////////
////////////////////////////////////////////////
   public function cambiar_usuario($id)
    {
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_usuarios_gral($id);
        $row=$query->row();
        $data['usuario']=$row->username;
        $data['nombre']=$row->nombre;
        $data['puesto']=$row->puesto;
        $data['correo']=$row->email;
        $data['activo']=$row->activo;
        $data['nivel']=$row->nivel;
        $data['id']=$id;
        $data['titulo'] = "CATALOGO DE GERENTES";
        $data['contenido'] = "catalogo_form_usuario_ger_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
function cambio_c_usuario()
	{
    $usuario= $this->input->post('usuario');
    $nombre= $this->input->post('nombre');
    $puesto= $this->input->post('puesto');
    $email= $this->input->post('correo');
    $activo= $this->input->post('activo');
    $nivel=$this->input->post('nivel');
    $id= $this->input->post('id');
   
	$this->load->model('catalogo_model_ger');
    $this->catalogo_model_ger->update_member_usuario($usuario,$nombre,$puesto,$email,$activo,$id);
    if($nivel==21){
    redirect('catalogo_ger/tabla_ger');    
    }else{
    redirect('catalogo_ger/tabla_sup');    
    }
    
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function cambiar_usuario_pas($id)
    {
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_usuarios_gral($id);
        $row=$query->row();
        $data['usuario']=$row->username;
        $data['nombre']=$row->nombre;
        $data['puesto']=$row->puesto;
        $data['correo']=$row->email;
        $data['activo']=$row->activo;
        $data['nivel']=$row->nivel;
        $data['id']=$id;
        $data['titulo'] = "CATALOGO DE GERENTES";
        $data['contenido'] = "catalogo_form_usuario_ger_2";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
function cambio_c_usuario_pas()
	{
    $pas= $this->input->post('pas');
    $id= $this->input->post('id');
    $nivel=$this->input->post('nivel');
	$this->load->model('catalogo_model_ger');
    $this->catalogo_model_ger->update_member_usuario_pas($pas,$id);
    if($nivel==21){
    redirect('catalogo_ger/tabla_ger');    
    }else{
    redirect('catalogo_ger/tabla_sup');    
    }
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function imprime_ger($ger)
    {
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_usuarios_ger_ger($ger);
        $row=$query->row();
        
        $data['cabeza']="<p align=\"center\"> GERENTE REGIONAL <br />$row->nombre<br />$row->email</p>";
        $this->load->model('catalogo_model_ger');                
            $data['detalle'] = $this->catalogo_model_ger->imprime_ger1($ger);
            $this->load->view('impresiones/gerencia_comercial', $data);
    }


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////__________________________________supervisores_______________________________
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function tabla_sup()
    {
        $this->load->model('catalogo_model');
        $data['sucx'] = $this->catalogo_model->busca_sucursal_general();
        $data['plax'] = $this->catalogo_model->busca_plaza_sup();
        $data['nivel']=14;
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->sup_nacional();
        $data['titulo'] = "CATALOGO DE SUPERVISORES";
        $data['contenido'] = "catalogo_form_usuario_ger_0";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function plantilla_sup()
    {
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->plantilla_sup_1();
        $data['titulo'] = "PLANTILLA DE PERSONAL";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }  
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function usuario_sucur($id)
    {
        $nivel=14;
        
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_usuarios_ger($id,$nivel);
        $row=$query->row();
        $data['usuario']=$row->username;
        $data['nombre']=$row->nombre;
        $data['puesto']=$row->puesto;
        $data['email']=$row->email;
        $data['plaza']=$row->plaza;
        $data['nivel']=$row->nivel;
        $data['supx'] = $this->catalogo_model->busca_sucursal_general();
        $data['id']=$id;
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->usuarios_sucur($id,$nivel);
        $data['titulo'] = "CATALOGO DE SUPERVISORES";
        $data['contenido'] = "catalogo_form_usuario_ger1";
        $data['selector'] = "catalogo_1";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
function quitar_suc($suc,$nivel,$id)
	{
    
  	$this->load->model('catalogo_model_ger');
    $this->catalogo_model_ger->quitar_member_usuario_suc($suc);
    if($nivel==21){
    redirect('catalogo_ger/usuario_supervisor/'.$id);
    }else{
    redirect('catalogo_ger/usuario_sucur/'.$id);    
    }
    }

 //////////////////////////////////////////////
//////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_suc_asignadas()
    {
        $plaza= $this->session->userdata('plaza');
        echo $plaza;
        $this->load->model('catalogo_model');
        $data['nivel']=14;
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->sup_suc($plaza);
        $data['titulo'] = "CATALOGO DE GERENTES";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_sup_asignadas_ger()
    {
        $plaza= $this->session->userdata('plaza');
        $this->load->model('catalogo_model');
        $data['nivel']=14;
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->ger_suc_par($plaza);
        $data['titulo'] = "CATALOGO DE SUPERVISORES";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_sup_asignadas_ger_ger()
    {
        $plaza= $this->session->userdata('plaza');
        $this->load->model('catalogo_model');
        $data['nivel']=21;
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->ger_suc_ger();
        $data['titulo'] = "CATALOGO DE SUPERVISORES";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_sup_asignadas_ger_sup($regional)
    {
        
        $this->load->model('catalogo_model');
        $data['nivel']=14;
        $this->load->model('catalogo_model_ger');
        $data['tabla'] = $this->catalogo_model_ger->ger_suc($regional);
        $data['titulo'] = "CATALOGO DE SUPERVISORES";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function imprime_sup($id,$nivel)
    {
        echo $id;
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_usuarios_ger($id,$nivel);
        $row=$query->row();
        
        $data['cabeza']="<p align=\"center\"> SUPERVISOR <br />$row->nombre<br />$row->email</p>";
        $this->load->model('catalogo_model_ger');                
            $data['detalle'] = $this->catalogo_model_ger->imprime_sup1($row->plaza);
            $this->load->view('impresiones/gerencia_comercial', $data);
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function imprime_sup_rh($plaza,$nivel)
    {
        echo $id;
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_usuarios_ger($plaza,$nivel);
        $row=$query->row();
        
        $data['cabeza']="<p align=\"center\"> SUPERVISOR <br />$row->nombre<br />$row->email</p>";
        $this->load->model('catalogo_model_ger');                
            $data['detalle'] = $this->catalogo_model_ger->imprime_sup1($plaza);
            $this->load->view('impresiones/gerencia_comercial', $data);
    }





































}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */