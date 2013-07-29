<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Cat_generico extends CI_Controller
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
        $data['sidebar'] = "sidebar_catalogo_generico";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function tabla_catalogo_segpop()
    {
        $this->load->model('cat_generico_model');
        $tit ="Catalogo de Seguro Popular"; 
        $data['tabla'] = $this->cat_generico_model->segpop($tit);
        $this->load->view('contenidos/cat_generico_sp', $data);   
        
        
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function tabla_catalogo_gen_sec()
    {
        $this->load->model('cat_generico_model');
        $data['tabla'] = $this->cat_generico_model->sec_generico();
        $data['titulo'] = "CATALOGO DE PRODUCTOS";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo_generico";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function tabla_catalogo_gen($sec1,$sec2)
    {
        $this->load->model('cat_generico_model');
        $data['tabla'] = $this->cat_generico_model->cedis_generico($sec1,$sec2);
        $data['titulo'] = "CATALOGO DE PRODUCTOS";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo_generico";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function copiar_producto($id,$sec,$sec1,$sec2)
    {
        $this->load->model('cat_generico_model');
        $this->load->model('catalogo_model');
        $data['tabla'] = '';
        $data['prvv'] = $this->catalogo_model->busca_prv();
        $data['perr'] = $this->catalogo_model->busca_persona();
		$query= $this->cat_generico_model->busca_sec($id,$sec);
        
        if($query->num_rows() >0){
		$row=$query->row();
       $data['susa'] = $row->susa1;
       $data['cod'] = $row->codigo;
       $data['costo'] = $row->costo;
       $data['tsec'] = $row->tsec;
       $data['personax'] = $row->personax;
       $data['prv'] = $row->prv;
       $data['prvx'] = $row->prvx;
       $data['descri'] = $row->susa2;
       $data['id'] = $id;
       $data['sec'] = $sec;
       $data['sec1'] = $sec1;
       $data['sec2'] = $sec2;
        }
       $data['titulo'] = "COPIAR PRODUCTOS";
       $data['contenido'] = "cat_generico_form_copia";
       $data['selector'] = "catalogo";
       $data['sidebar'] = "sidebar_catalogo_generico";
        
        
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////

//////////////////////////////////////////////
function agrega_copia()
	{
    $cod= $this->input->post('cod');
    $per= $this->input->post('per');
    $descri= $this->input->post('descri');
    $costo= $this->input->post('costo');
    $prov= $this->input->post('prov');
    $id= $this->input->post('id');
    $sec= $this->input->post('sec');
    $sec1= $this->input->post('sec1');
    $sec2= $this->input->post('sec2');
    $tsec= $this->input->post('tsec');
	$this->load->model('cat_generico_model');
    $this->cat_generico_model->agrega_member_copia($id,$sec,$cod,$per,$descri,$costo,$prov,$tsec);
    redirect('cat_generico/tabla_catalogo_gen/'.$sec1.'/'.$sec2);
    
    }

//////////////////////////////////////////////
//////////////////////////////////////////////
   public function agrega_producto($sec1,$sec2)
    {
        $this->load->model('cat_generico_model');
        $this->load->model('catalogo_model');
        $data['sec'] = $this->catalogo_model->busca_sec_metro();
        $data['prvv'] = $this->catalogo_model->busca_prv();
        $data['perr'] = $this->catalogo_model->busca_persona();
		$data['titulo'] = "COPIAR PRODUCTOS";
        $data['sec2'] = $sec2;
        $data['sec1'] = $sec1;
       $data['contenido'] = "cat_generico_form_agrega";
       $data['selector'] = "catalogo";
       $data['sidebar'] = "sidebar_catalogo_generico";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////

//////////////////////////////////////////////
function agrega_alta()
	{
    $cod= $this->input->post('cod');
    $per= $this->input->post('per');
    $descri= $this->input->post('descri');
    $costo= $this->input->post('costo');
    $prov= $this->input->post('prov');
    $sec= $this->input->post('sec');
	$susa= $this->input->post('susa');
	$lin= $this->input->post('lin');
	$slin= $this->input->post('slin');
	$claves= $this->input->post('claves');
    $sec1= $this->input->post('sec1');
    $sec2= $this->input->post('sec2');
	$pub=$this->input->post('pub');
	$this->load->model('cat_generico_model');
    $this->cat_generico_model->agrega_member($sec,$cod,$per,$descri,$costo,$prov,$claves,$slin,$lin,$susa,$pub);
    redirect('cat_generico/tabla_catalogo_gen/'.$sec1.'/'.$sec2);
    
    }

//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function editar_producto($id,$sec,$sec1,$sec2)
    {
        $this->load->model('cat_generico_model');
        $this->load->model('catalogo_model');
        $data['tabla'] = '';
        $data['prvv'] = $this->catalogo_model->busca_prv();
        $data['perr'] = $this->catalogo_model->busca_persona();
		$query= $this->cat_generico_model->busca_sec($id,$sec);
        
        if($query->num_rows() >0){
		$row=$query->row();
       $data['susa'] = $row->susa1;
       $data['cod'] = $row->codigo;
       $data['costo'] = $row->costo;
       $data['pub'] = $row->publico;
       $data['personax'] = $row->personax;
       $data['prv'] = $row->prv;
       $data['prvx'] = $row->prvx;
       $data['descri'] = $row->susa2;
       $data['claves'] = $row->claves;
       $data['tsec'] = $row->tsec;
       $data['id'] = $id;
       $data['sec'] = $sec;
       $data['sec1'] = $sec1;
       $data['sec2'] = $sec2;
        }
       
       $data['titulo'] = "EDITAR PRODUCTOS";
       $data['contenido'] = "cat_generico_form_cambia";
       $data['selector'] = "catalogo";
       $data['sidebar'] = "sidebar_catalogo_generico";
        
        
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
function cambio_producto()
	{
	  
    $cod= $this->input->post('cod');
    $per= $this->input->post('per');
    $descri= $this->input->post('descri');
    $costo= $this->input->post('costo');
    $prov= $this->input->post('prov');
    $sec= $this->input->post('sec');
	$susa= $this->input->post('susa');
	$lin= $this->input->post('lin');
	$slin= $this->input->post('slin');
	$claves= $this->input->post('claves');
    $id= $this->input->post('id');
    $sec1= $this->input->post('sec1');
    $sec2= $this->input->post('sec2');
    $pub= $this->input->post('pub');
    $tsec= $this->input->post('tsec');
	$this->load->model('cat_generico_model');
    $this->cat_generico_model->cambia_member($id,$sec,$cod,$per,$descri,$costo,$prov,$claves,$susa,$pub,$tsec);
    redirect('cat_generico/tabla_catalogo_gen/'.$sec1.'/'.$sec2);
    
    }

//////////////////////////////////////////////
//////////////////////////////////////////////
function actualiza_catalogo()
	{
    $this->load->model('cat_generico_model');
    $this->cat_generico_model->catalogo_cat_compras();
    redirect('cat_generico/tabla_catalogo_gen_sec');
    
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function tabla_catalogo_gen_expo()
    {
        $this->load->model('cat_generico_model');
        $data['tabla'] = $this->cat_generico_model->cedis_generico_expor();
        $data['titulo'] = "CATALOGO DE PRODUCTOS";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo_generico";
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
































































   public function cambiar_usuario($id)
    {
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_usuarios($id);
        $row=$query->row();
        $data['usuario']=$row->username;
        $data['nombre']=$row->nombre;
        $data['puesto']=$row->puesto;
        $data['correo']=$row->email;
        $data['activo']=$row->activo;
        $data['id']=$id;
        $data['titulo'] = "CATALOGO DE USUARIOS";
        $data['contenido'] = "catalogo_form_usuario_1";
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
    $id= $this->input->post('id');
   
	$this->load->model('catalogo_model');
    $this->catalogo_model->update_member_usuario($usuario,$nombre,$puesto,$email,$activo,$id);
    redirect('catalogo/catalogo_usuarios');
    
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function cambiar_usuario_pas($id)
    {
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_usuarios($id);
        $row=$query->row();
        $data['usuario']=$row->username;
        $data['nombre']=$row->nombre;
        $data['puesto']=$row->puesto;
        $data['correo']=$row->email;
        $data['activo']=$row->activo;
        $data['id']=$id;
        $data['titulo'] = "CATALOGO DE USUARIOS";
        $data['contenido'] = "catalogo_form_usuario_2";
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
   
	$this->load->model('catalogo_model');
    $this->catalogo_model->update_member_usuario_pas($pas,$id);
    redirect('catalogo/catalogo_usuarios');
    
    }
//////////////////////////////////////////////
//////////////////////////////////////////////

   public function usuario_sucursal($id)
    {
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_usuarios($id);
        $row=$query->row();
        $data['usuario']=$row->username;
        $data['nombre']=$row->nombre;
        $data['puesto']=$row->puesto;
        $data['email']=$row->email;
        $data['sucx'] = $this->catalogo_model->busca_sucursal_general();
        $data['id']=$id;
        $data['tabla'] = $this->catalogo_model->usuarios_sucursal($id);
        $data['titulo'] = "CATALOGO DE USUARIOS";
        $data['contenido'] = "catalogo_form_usuario_3";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 

//////////////////////////////////////////////
//////////////////////////////////////////////
function agrega_c_usuario_sucursal()
	{
    $suc= $this->input->post('suc');
    $id= $this->input->post('id');
  	$this->load->model('catalogo_model');
    $this->catalogo_model->agrega_member_usuario_sucursal($suc,$id);
    redirect('catalogo/usuario_sucursal/'.$id);
    
    }
    //////////////////////////////////////////////
//////////////////////////////////////////////
function quitar_usuario_suc($id,$suc)
	{
    
  	$this->load->model('catalogo_model');
    $this->catalogo_model->quitar_member_usuario_sucursal($suc);
    redirect('catalogo/usuario_sucursal/'.$id);
    
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////ernesto
   public function catalogo_usuarios_cortes()
    {
        $this->load->model('catalogo_model');
        $data['tabla'] = $this->catalogo_model->usuarios_cortes();
        $data['titulo'] = "CATALOGO DE USUARIOS";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "audita";
        $data['sidebar'] = "sidebar_audita";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////

   public function usuario_sucursal_cortes($id)
    {
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_usuarios_cortes($id);
        $row=$query->row();
        $data['usuario']=$row->username;
        $data['nombre']=$row->nombre;
        $data['puesto']=$row->puesto;
        $data['email']=$row->email;
        $data['sucx'] = $this->catalogo_model->busca_sucursal_general();
        $data['id']=$id;
        $data['tabla'] = $this->catalogo_model->usuarios_sucursal_cortes($id);
        $data['titulo'] = "CATALOGO DE USUARIOS";
        $data['contenido'] = "catalogo_form_usuario_cortes";
        $data['selector'] = "audita";
        $data['sidebar'] = "sidebar_audita";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 

//////////////////////////////////////////////
//////////////////////////////////////////////
function agrega_c_usuario_sucursal_cortes()
	{
    $suc= $this->input->post('suc');
    $id= $this->input->post('id');
  	$this->load->model('catalogo_model');
    $this->catalogo_model->agrega_member_usuario_sucursal_cortes($suc,$id);
    redirect('catalogo/usuario_sucursal_cortes/'.$id);
    
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
function quitar_usuario_suc_cortes($id,$suc)
	{
  	$this->load->model('catalogo_model');
    $this->catalogo_model->quitar_member_usuario_sucursal_cortes($suc);
    redirect('catalogo/usuario_sucursal_cortes/'.$id);
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

   public function catalogo_polizas()
    {
        $this->load->model('catalogo_model');
        $data['iva'] = 'N';
        $data['tabla'] = $this->catalogo_model->polizas();
        $data['titulo'] = "CATALOGO DE POLIZAS";
        $data['contenido'] = "catalogo_form_poliza_0";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

//////////////////////////////////////////////
//////////////////////////////////////////////
function agrega_c_poliza()
	{
    $cuenta= $this->input->post('cuenta');
    $auxi= $this->input->post('auxi');
    $descri= $this->input->post('descri');
    $iva= $this->input->post('iva');
    $cuenta_iva= $this->input->post('cuenta_iva');
    $auxi_iva= $this->input->post('auxi_iva');
    $cuenta_ivar= $this->input->post('cuenta_ivar');
    $auxi_ivar= $this->input->post('auxi_ivar');
    $cuenta_isr= $this->input->post('cuenta_isr');
    $auxi_isr= $this->input->post('auxi_isr');
    $cuenta_varios= $this->input->post('cuenta_varios');
    $auxi_varios= $this->input->post('auxi_varios');
   
    
   
	$this->load->model('catalogo_model');
    $this->catalogo_model->agrega_member_poliza($cuenta,$auxi,$descri,$iva,$cuenta_iva,$auxi_iva,$cuenta_ivar,$auxi_ivar,$cuenta_isr,$auxi_isr,$cuenta_varios,$auxi_varios);
    redirect('catalogo/catalogo_polizas');
    
    }

//////////////////////////////////////////////
//////////////////////////////////////////////
   public function cambiar_poliza($id)
    {
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_poliza_unica($id);
        $row=$query->row();
        $data['cuenta']=$row->cuenta;
        $data['auxi']=$row->auxiliar;
        $data['descri']=$row->descri;
        $data['iva']=$row->iva;
        $data['cuenta_iva']=$row->cuenta_iva;
        $data['auxi_iva']=$row->auxi_iva;
        $data['cuenta_ivar']=$row->cuenta_ivar;
        $data['auxi_ivar']=$row->auxi_ivar;
        $data['cuenta_isr']=$row->cuenta_isr;
        $data['auxi_isr']=$row->auxi_isr;
        $data['cuenta_varios']=$row->cuenta_varios;
        $data['auxi_varios']=$row->auxi_varios;
        $data['iva']=$row->iva;
        $data['activo']=$row->activo;
        
        $data['id']=$id;
        $data['titulo'] = "CATALOGO DE USUARIOS";
        $data['contenido'] = "catalogo_form_poliza_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
function cambio_c_poliza()
	{
    $cuenta= $this->input->post('cuenta');
    $auxi= $this->input->post('auxi');
    $descri= $this->input->post('descri');
    $iva= $this->input->post('iva');
    $cuenta_iva= $this->input->post('cuenta_iva');
    $auxi_iva= $this->input->post('auxi_iva');
    $cuenta_ivar= $this->input->post('cuenta_ivar');
    $auxi_ivar= $this->input->post('auxi_ivar');
    $cuenta_isr= $this->input->post('cuenta_isr');
    $auxi_isr= $this->input->post('auxi_isr');
    $cuenta_varios= $this->input->post('cuenta_varios');
    $auxi_varios= $this->input->post('auxi_varios');
    $activo= $this->input->post('activo');
    $id= $this->input->post('id');
   	$this->load->model('catalogo_model');
    $this->catalogo_model->update_member_poliza($cuenta,$auxi,$descri,$iva,$cuenta_iva,$auxi_iva,$cuenta_ivar,$auxi_ivar,$cuenta_isr,$auxi_isr,$cuenta_varios,$auxi_varios,$id,$activo);
    redirect('catalogo/catalogo_polizas');
    
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function catalogo_cuentas()
    {
        $this->load->model('catalogo_model');
        $data['bancox'] = $this->catalogo_model->busca_banco();
        $data['ciax'] = $this->catalogo_model->busca_cia();
        
        $data['tabla'] = $this->catalogo_model->cuentas();
        $data['titulo'] = "CATALOGO DE CUENTAS BANCARIAS";
        $data['contenido'] = "catalogo_form_cuentas_0";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
function busca_pla()
	{
	$cia=$this->input->post('cia');
    $this->load->model('catalogo_model');
    echo $this->catalogo_model->busca_plaza($cia);    
    }
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
function busca_recep()
	{
	$suc=$this->input->post('suc');
	$con=$this->input->post('con');
	$this->load->model('catalogo_model');
    echo $this->catalogo_model->busca_receptor_suc($suc,$con);    
    }

//////////////////////////////////////////////
//////////////////////////////////////////////
function agrega_c_cuentas()
	{
    $cuenta= $this->input->post('cuenta');
    $cia= $this->input->post('cia');
    $plaza= $this->input->post('plazax');
    $banco= $this->input->post('banco');
    
	$this->load->model('catalogo_model');
    $this->catalogo_model->agrega_member_cuenta($cuenta,$cia,$plaza,$banco);
    redirect('catalogo/catalogo_cuentas');
    }

//////////////////////////////////////////////
//////////////////////////////////////////////
   public function cambiar_cuenta($id)
    {
        $this->load->model('catalogo_model');
        $query = $this->catalogo_model->busca_cuenta_unica($id);
        $row=$query->row();
        $data['cuenta']=$row->cuenta;
        $data['activo']=$row->activo;
        
        $data['ciaa']=$row->ciax;
        $data['plazaa']=$row->plazax;
        $data['bancoa']=$row->bancox;
        
        $data['bancox'] = $this->catalogo_model->busca_banco();
        $data['ciax'] = $this->catalogo_model->busca_cia();
        
        
        $data['id']=$id;
        $data['titulo'] = "CATALOGO DE CUENTAS";
        $data['contenido'] = "catalogo_form_cuentas_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
function cambio_c_cuenta()
	{
    $cuenta= $this->input->post('cuenta');
    $activo= $this->input->post('activo');
    $cia= $this->input->post('cia');
    $plaza= $this->input->post('plazax');
    $banco= $this->input->post('banco');
    $id= $this->input->post('id');
   	$this->load->model('catalogo_model');
    $this->catalogo_model->update_member_cuentas($cuenta,$cia,$plaza,$banco,$activo,$id);
    redirect('catalogo/catalogo_cuentas');
    
    }
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
 public function catalogo_plazas()
    {
        $this->load->model('catalogo_model');
        $data['tabla'] = $this->catalogo_model->plazas();
        $data['titulo'] = "CATALOGO DE PLAZAS";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

//////////////////////////////////////////////
//////////////////////////////////////////////
 public function catalogo_beneficiario()
    {
        $this->load->model('catalogo_model');
        $data['plazax'] = $this->catalogo_model->busca_plaza_general();
        
        
        $data['tabla'] = $this->catalogo_model->plazas();
        $data['titulo'] = "CATALOGO DE BENEFICIARIOS";
        $data['contenido'] = "bene_form_0";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

//////////////////////////////////////////////
//////////////////////////////////////////////
 public function bene_d()
    {
        $this->load->model('catalogo_model');
        $plaxx = $this->input->post('pla');
        
        if($plaxx>0){
        $partida=explode("_",$plaxx);
        $pla=$partida[0];
        $cia=$partida[1];
        $data['cia'] =$cia;
        $data['pla'] =$pla;
        $data['clavex'] = $this->catalogo_model->busca_poliza();
        $data['ciax'] = $this->catalogo_model->busca_cia_unico($cia);
        $data['plax'] = $this->catalogo_model->busca_plaza_unica($cia,$pla);
        $data['sucx'] = $this->catalogo_model->busca_sucursal_bloque($cia,$pla);
        
        $data['tabla'] = $this->catalogo_model->beneficiario($cia,$pla);
        $data['titulo'] = "CATALOGO DE BENEFICIARIOS";
        $data['contenido'] = "bene_form_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
}else{
 redirect('catalogo/catalogo_beneficiario');   
}
    }

//////////////////////////////////////////////
//////////////////////////////////////////////
function agrega_c_bene()
	{
    $cla= $this->input->post('cla');
    $cia= $this->input->post('cia');
    $pla= $this->input->post('pla');
    $suc= $this->input->post('suc');
    $rfc= $this->input->post('rfc');
    $nom= $this->input->post('nom');
	$this->load->model('catalogo_model');
    $this->catalogo_model->agrega_member_bene($cia,$pla,$suc,$rfc,$nom,$cla);
    redirect('catalogo/catalogo_cuentas');
    }
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
 public function bene_d_mas($pla,$cia)
    {
       
        $this->load->model('catalogo_model');
        $data['cia'] =$cia;
        $data['pla'] =$pla;
        $data['clavex']=$this->catalogo_model->busca_poliza();
        $data['ciax'] = $this->catalogo_model->busca_cia_unico($cia);
        $data['plax'] = $this->catalogo_model->busca_plaza_unica($cia,$pla);
        $data['sucx'] = $this->catalogo_model->busca_sucursal_bloque($cia,$pla);
        $data['tabla'] = $this->catalogo_model->beneficiario($cia,$pla);
        $data['titulo'] = "CATALOGO DE BENEFICIARIOS";
        $data['contenido'] = "bene_form_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
 
    }

//////////////////////////////////////////////
//////////////////////////////////////////////
function borrar_bene($id,$pla,$cia)
	{
	   
    $this->load->model('catalogo_model');
    $this->catalogo_model->delete_member_bene($id);
    redirect('catalogo/bene_d_mas/'.$pla.'/'.$cia);
    
    }
//////////////////////////////////////////////
function busca_emp()
	{
	
    $nomx=$this->input->post('nomx');
    $this->load->model('catalogo_model');
    echo $this->catalogo_model->busca_emple($nomx); 
       
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
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function tabla_control_arrendatario()
    {
        $this->load->model('catalogo_model');
        
        $data['tabla'] = $this->catalogo_model->catalogo_rentas();
        $data['titulo'] = "CATALOGO DE ARRENDADORES";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_cheques";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function tabla_rentas()
    {
        $this->load->model('catalogo_model');
        
        $data['tabla'] = '';
        $data['titulo'] = "CATALOGO DE ARRENDADORES";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
   public function tabla_rentas_busca()
    {
        $this->load->model('catalogo_model');
        $data['sucx'] = $this->catalogo_model->busca_sucursal_juridico();
        $data['arrx'] = $this->catalogo_model->busca_rentas_arrendador();
        $data['auxi'] = 0;
       
        $data['tabla'] = '';
        $data['titulo'] = "CATALOGO DE ARRENDATARIOS";
        $data['contenido'] = "catalogo_form_rentas_buscar";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
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
        $this->load->model('catalogo_model');
        $data['titulo'] = "CATALOGO DE ARRENDADORES";
        $data['contenido'] = "catalogo_1";
        $data['tabla'] = $this->catalogo_model->rentas_busca($suc,$arr);
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
   public function buscar_rentas_par($suc,$arr)
    {
        
        $this->load->model('catalogo_model');
        $data['titulo'] = "CATALOGO DE ARRENDADORES";
        $data['contenido'] = "catalogo_1";
        $data['tabla'] = $this->catalogo_model->rentas_busca($suc,$arr);
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
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
        $data['contenido'] = "catalogo_form_rentas";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 

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
        if($auxi==7003){$isr=10;$ivar=10.666666;}
        if($auxi==7004){$isr=0;$ivar=0;}
        $cero=0;
        $id_cc=$this->catalogo_model->agrega_member_renta($suc,$rfc,$nom,$imp,$isr,$ivar,$icedular,$pago,$tsuc,$iva,$auxi,$redon,$contrato,$incremento);
 
    redirect('catalogo/buscar_rentas_par/'.$cero.'/'.$id_cc);
    } 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
        
        
        
        $data['sucx'] = $this->catalogo_model->busca_sucursal_juridico();
        }
        
        $data['id'] = $id;
        $data['tabla'] = '';
        $data['titulo'] = "CATALOGO DE ARRENDADORES";
        $data['contenido'] = "catalogo_form_rentas_cambia";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
        if($auxi==7003){$isr=10;$ivar=10.666666;}
        if($auxi==7004){$isr=0;$ivar=0;}
        
        $this->catalogo_model->cambia_member_renta($suc,$rfc,$nom,$imp,$isr,$ivar,$icedular,$pago,$tsuc,$iva,$auxi,$suc_a,$id,$redon,$contrato,$incremento
        ,$fecha_termino,$tipo_pago,$diferencia,$cierre,$entrega_local,$expediente,$motivo_cierre,$observacion);
    redirect('catalogo/buscar_rentas_par/'.$suc_a.'/'.$id);
    } 

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_rentas_his()
    {
        $this->load->model('catalogo_model');
        
        $data['tabla'] = $this->catalogo_model->rentas_his();
        $data['titulo'] = "CATALOGO DE ARRENDADORES";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_catalogo";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_rentas_vista($id)
    {
        $this->load->model('catalogo_model');
        
          $data['cabeza']='<p align="center"><strong>RECIBO DE ARRENDAMIENTO</strong></p>';
          $this->load->model('catalogo_model');
          $data['detalle'] = $this->catalogo_model->rentas_vista($id);
          $this->load->view('impresiones/nomina_renta', $data);
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
   public function tabla_rentas_borrar($id)
    {
     $this->load->model('catalogo_model');   
    $this->catalogo_model->delete_member_renta($id);
    redirect('catalogo/tabla_rentas_his');
    } 


 /////////////////////////______________________________________________________________///////////////alta de empleados
 /////////////////////////______________________________________________________________///////////////alta de empleados
 /////////////////////////______________________________________________________________///////////////alta de empleados
 /////////////////////////______________________________________________________________///////////////alta de empleados
 /////////////////////////______________________________________________________________///////////////alta de empleados
 /////////////////////////______________________________________________________________///////////////alta de empleados
 /////////////////////////______________________________________________________________///////////////alta de empleados
 /////////////////////////______________________________________________________________///////////////alta de empleados
/////////////////////////////////////////////////////////////////////////////////////////////    
   public function tabla_empleados_pendientes_his()
    {
        $this->load->model('recursos_humanos_model');
        
        $data['tabla'] = $this->recursos_humanos_model->empleados_pendientes_his();
        $data['titulo'] = "MOVIMIENTOS DE EMPLEADOS PENDIENTES EN RH";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_prenomina";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

   public function tabla_empleados()
    {
        $this->load->model('catalogo_model');
        
        $data['tabla'] = '';
        $data['titulo'] = "CATALOGO DE EMPLEADOS";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_prenomina";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 

//////////////////////////////////////////////
//////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

   public function tabla_empleados3()
    {
        $this->load->model('catalogo_model');
        $data['empleado'] = $this->catalogo_model->busca_empleado();
        $data['tabla'] = '';
        $data['titulo'] = "CATALOGO DE EMPLEADOS";
        $data['contenido'] = "empleados";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_prenomina";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 

//////////////////////////////////////////////
//////////////////////////////////////////////

function buscar_empleado3()
    {
        $id= $this->input->post('empleado');
        
        $this->load->model('catalogo_model');
        $data['empleado'] = $this->catalogo_model->busca_empleado();
        $data['tabla'] = $this->catalogo_model->datos_empleado($id);
        $data['tabla'] .= $this->catalogo_model->datos_empleado1($id);
        $data['titulo'] = "CATALOGO DE EMPLEADOS";
        $data['contenido'] = "empleados";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_prenomina";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }


/////////////////////////////////////////////
//////////////////////////////////////////////
  public function tabla_empleados_captura()
    {
        
        $this->load->model('catalogo_model');
        $data['motx'] = $this->catalogo_model->busca_motivo_rh();
        $data['tabla'] = $this->catalogo_model->empleados_pendientes();
        $data['titulo'] = "CATALOGO DE EMPLEADOS";
        $data['contenido'] = "catalogo_form_empleados_captura";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_prenomina";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
/////////////////////////////////////////////
/////////////////////////////////////////////

  public function tabla_empleados_agrega()
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
        $data['contenido'] = "catalogo_form_empleados";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_prenomina";
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
        $data['contenido'] = "catalogo_form_empleados_bajas";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_prenomina";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        }
        if($motivo=='RETENCION'){
        $this->load->model('catalogo_model');
        $data['titulo'] = "CONTROL  DE ".$motivo." DE NOMINAS";
        $data['motivo'] =$motivo;    
        $data['id_nomx'] = $this->catalogo_model->busca_usuario_nomina_bloque();
        $data['nomina'] =0;
        $data['tabla'] = '';
        $data['contenido'] = "catalogo_form_empleados_bajas";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_prenomina";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        }
        
        if($motivo=='CAMBIOS' || $motivo=='LIBERACION'){
        $this->load->model('catalogo_model');
        $data['titulo'] = "CONTROL  DE ".$motivo." DE NOMINAS";
        $data['motivo'] =$motivo;    
        $data['id_nomx'] = $this->catalogo_model->busca_usuario_nomina_bloque();
        $data['nomina'] =0;
        $data['tabla'] = '';
        $data['contenido'] = "catalogo_form_empleados_cambios";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_prenomina";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
        
        }
        
        
        
       
    } 
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
  public function tabla_empleados_cambios()
    {
        $id_nom= $this->input->post('id_nom');
        $motivo= $this->input->post('motivo');
        $id_user= $this->session->userdata('id');
        $this->load->model('catalogo_model');
        $query =$this->catalogo_model->busca_usuario_id($id_nom);
        if($query->num_rows() >0){
		$row=$query->row();
        $data['puesto_act']= $row->puesto;
        $data['suc_act']= $row->suc;
        $data['sucursal']= $row->sucursal;
        $data['id_nom']= $id_nom;
        $data['pue_act']= $row->puesto;
        $data['puestox']= $row->puestox;
        $data['cia_act']= $row->ciax;
        $data['id_nomx']= $row->nom." ".$row->pat." ".$row->mat;
        $data['rfc']= $row->rfc;
        $data['afilia']= $row->afiliacion;
        $data['curp']= $row->curp;
        $data['registro_pat']= $row->registro_pat;
        
        $data['nomina']= $row->nomina;
        }
        $data['sucx'] = $this->catalogo_model->busca_sucursal_bloque_id($id_user);
        $data['ciax'] = $this->catalogo_model->busca_cia_nomina();
        $data['puex'] = $this->catalogo_model->busca_puesto();
        $data['titulo'] = "CONTROL  DE ".$motivo." DE NOMINAS";
        $data['motivo'] =$motivo;    
        $data['tabla'] = '';
        
        $data['contenido'] = "catalogo_form_empleados_cambios_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_prenomina";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
        
        
       
    } 
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
        
	    $this->load->model('catalogo_model');
        $this->catalogo_model->agrega_member_empleado($cia,$rfc,$cur,$afilia,$pat,$mat,$nom,$puesto,$suc,$fecha_i,$salario,
        $integrado,$registro_pat,$motivo,$causa,$dire,$num,$col,$cp,$mun,$entidad,$autoriza,$nomina,$suc);
    redirect('catalogo/tabla_empleados_captura');
    } 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function cambia_empleados_archi()
    {//cia, rfc, cur, afilia, pat, mat, nom, puesto, suc, fecha_i, salario, integrado, registro_pat, id_user, motivo, causa, id, dire, num, col, cp, mun, entidad
        $id_nom= $this->input->post('id_nom');
        $cia= $this->input->post('cia');
        $rfc= $this->input->post('rfc');
        $cur= $this->input->post('curp');
        $afilia= $this->input->post('afilia');
        $autoriza= $this->input->post('autoriza');
        $registro_pat= $this->input->post('registro_pat');
        $motivo= $this->input->post('motivo');
        $causa= $this->input->post('causa');
        $puesto= $this->input->post('puesto');
        $suc= $this->input->post('suc');
        $fecha_i= date('Y-m-d');
        $sucf=$suc;
        $this->load->model('catalogo_model');
        $query =$this->catalogo_model->busca_usuario_id($id_nom);
        if($query->num_rows() >0){
		$row=$query->row();
        $cia_act= $row->cia;
        $puesto_act= $row->puesto;
        $suc_act= $row->suc;
        $nomina= $row->nomina;
        $pat= $row->pat;
        $mat= $row->mat;
        $nom= $row->nom;
        $succ= $row->suc;
        $salario= 0;
        $integrado= 0;
        $dire= '';
        $num= '';
        $col= '';
        $cp='';
        $mun= '';
        $entidad= '';
        }
        if($cia<>null and $cia_act<>$cia){$ciaf=$cia;}else{$ciaf=$cia_act;}
	    if($puesto<>null and $puesto_act<>$puesto){$puestof=$puesto;}else{$puestof=$puesto_act;}
        if($suc_act<>$suc){$sucf=$suc;}else{$sucf=$suc;}
      
        $this->catalogo_model->agrega_member_empleado($ciaf,$rfc,$cur,$afilia,$pat,$mat,$nom,$puestof,$sucf,$fecha_i,$salario,
        $integrado,$registro_pat,$motivo,$causa,$dire,$num,$col,$cp,$mun,$entidad,$autoriza,$nomina,$succ);
    redirect('catalogo/tabla_empleados_captura');
    } 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function agrega_empleados_bajas()
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
    redirect('catalogo/tabla_empleados_captura');
    } 
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_empleados_borrar_c($id,$motivo)
    {
     $this->load->model('catalogo_model');
     $this->catalogo_model->delete_member_empleados($id);
     redirect('catalogo/tabla_empleados_captura');
    }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_empleados_borrar($id,$motivo)
    {
     $this->load->model('catalogo_model');
     $this->catalogo_model->delete_member_empleados($id);
     redirect('catalogo/tabla_empleados_captura');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_empleados_validar($id,$motivo)
    {
    $this->load->model('catalogo_model');
     $this->catalogo_model->valida_member_empleados($id,$motivo);
    redirect('catalogo/tabla_empleados_captura');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_empleados_vista($id)
    {
          $data['cabeza']='';
          $this->load->model('catalogo_model');
            $data['detalle'] = $this->catalogo_model->empleados_vista($id);
            $this->load->view('impresiones/nomina_altas_bajas_cambios', $data);
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_empleados_vista_todos($activo)
    {
          $data['cabeza']='';
          $this->load->model('catalogo_model');
          
            $data['detalle'] = $this->catalogo_model->empleados_vista_todos($activo);
            $this->load->view('impresiones/nomina_retencion', $data);
    }
 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_empleados_pendientes_his_val()
    {
        $this->load->model('catalogo_model');
        
        $data['tabla'] = $this->catalogo_model->empleados_pendientes_his_val();
        $data['titulo'] = "MOVIMIENTOS DE EMPLEADOS VALIDADOS";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_prenomina";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_empleados_mov()
    {
        $this->load->model('catalogo_model');
        $data['motx'] = $this->catalogo_model->busca_motivo_rh2012();
        $data['tabla'] = '';
        $data['titulo'] = "MOVIMIENTOS DE EMPLEADOS VALIDADOS";
        $data['contenido'] = "catalogo_form_empleados_mov";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_prenomina";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_empleados_mov1()
    {
        $this->load->model('catalogo_model');
        $data['conta'] = $this->catalogo_model->busca_contador1();
        $data['motx'] = $this->catalogo_model->busca_motivo_rh2012();
        $data['tabla'] = '';
        $data['titulo'] = "MOVIMIENTOS DE EMPLEADOS VALIDADOS";
        $data['contenido'] = "catalogo_form_empleados_mov1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_prenomina";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function tabla_empleados_mov_imp()
    {
    $fec1= $this->input->post('fec1');
    $fec2= $this->input->post('fec2');
    $mot= $this->input->post('mot');
          $data['cabeza']='<p align="center"><strong>REPORTE DE MOVIMIENTOS '.$mot.'</strong><br /></p><p align="left">Impresion :'.date('Y-m-d H:i:s').'</p>';
          $data['cabeza'].='<table border="1" bgcolor="#E6DCFD">
        <tr>
        <th>Movimiento</th>
        <th>AUTORIZA</th>
        <th>Nomina<br />Nombre</th>
        <th>Sucursal</th>
        <th>Contador</th>
        <th>RFC <br />CURP  </th>
        <th>Afiliacion <br />Registro patronal</th>
        <th>Fec. captura <br />Fec.Valida</th>
        </tr>
        </table>
        ';
          
          $this->load->model('catalogo_model');
            $data['detalle'] = $this->catalogo_model->empleados_mov($fec1,$fec2,$mot);
            $this->load->view('impresiones/nomina_mov', $data);
    }
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function tabla_empleados_mov_imp1()
    {
    $fec1= $this->input->post('fec1');
    $fec2= $this->input->post('fec2');
    $mot= $this->input->post('mot');
    $conta= $this->input->post('conta');
          $data['cabeza']='<p align="center"><strong>REPORTE DE MOVIMIENTOS</strong><br /></p><p align="left">Impresion :'.date('Y-m-d H:i:s').'</p>';
          $data['cabeza'].='<table border="1" bgcolor="#E6DCFD">
        <tr>
        <th>Movimiento</th>
        <th>AUTORIZA</th>
        <th>Nomina<br />Nombre</th>
        <th>Sucursal</th>
        <th>Contador</th>
        <th>RFC <br />CURP  </th>
        <th>Afiliacion <br />Registro patronal</th>
        <th>Fec. captura <br />Fec.Valida</th>
        </tr>
        </table>
        ';
          
          $this->load->model('catalogo_model');
            $data['detalle'] = $this->catalogo_model->empleados_mov1($fec1,$fec2,$mot,$conta);
            $this->load->view('impresiones/nomina_mov', $data);
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function tabla_empleados_mov_ret()
    {
        $this->load->model('catalogo_model');
        $data['tabla'] =$this->catalogo_model->solo_retencion();;
        $data['titulo'] = "RETENCION DE SALARIOS";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_prenomina";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function tabla_empleados_cambia_ret($id)
    {
        $id_user= $this->session->userdata('id');
        $this->load->model('catalogo_model');
        
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
        $motivo= $row->motivo;
        }
        $data['retx']=$this->catalogo_model->busca_id_causa();
        $data['id']= $id;
        $data['titulo'] = "CONTROL  DE ".$motivo." DE NOMINAS";
        $data['motivo'] =$motivo;    
        $data['tabla'] = '';
        
        $data['contenido'] = "catalogo_form_empleados_cambios_ret";
        $data['selector'] = "catalogo";
        $data['sidebar'] = "sidebar_prenomina";
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
        
     }
/////////////////////////////////////////////////////////////////////////////////////// 
  public function cambia_empleados_ret($id)
    {
        $ret= $this->input->post('ret');
        $id= $this->input->post('id');
        
     $this->load->model('catalogo_model');
     $this->catalogo_model->cambia_member_empleados_ret($id,$ret);
    redirect('catalogo/tabla_empleados_mov_ret');
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////
//////////////////////////////////////////////
    
function busca_empleado()
	{
	//$nomina=9469;
    $nomina=$this->input->post('nomina');
    $this->load->model('catalogo_model');
    echo $this->catalogo_model->busca_empleados($nomina);
    }

function busca_empleado_nombre()
	{
    $nom=$this->input->post('nom');
    $pat=$this->input->post('pat');
    $mat=$this->input->post('mat');
    $this->load->model('catalogo_model');
    echo $this->catalogo_model->busca_empleados_nom($nom,$pat,$mat);
    }


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 public function tabla_empleados1()
    {
        $this->load->model('catalogo_model');
        $data['tabla'] = $this->catalogo_model->plantilla();
        $data['titulo'] = "CATALOGO DE EMPLEADOS";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    } 
    
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 public function tabla_plantilla()
    {
        $this->load->model('catalogo_model');
        $data['plaza1'] = $this->catalogo_model->busca_plaza1();
        $data['suc'] = $this->catalogo_model->busca_sucursal1(1);
        $data['tabla'] = " ";
        $data['titulo'] = "CATALOGO DE EMPLEADOS";
        $data['contenido'] = "catalogo_2";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";
        
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }

//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
  public function tabla_empleados2()
    {
         
        $plaza1= $this->input->post('plaza1');
        $suc= $this->input->post('suc');
          
        $this->load->model('catalogo_model');
        $data['tabla'] = $this->catalogo_model->plantilla1($plaza1, $suc);
         
        $data['titulo'] = "CATALOGO DE EMPLEADOS";
        $data['contenido'] = "catalogo_1";
        $data['selector'] = "prenomina";
        $data['sidebar'] = "sidebar_prenomina";
        
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    
    }


    function busca_sucursales()
    {
        $this->load->model('catalogo_model');
        echo $this->catalogo_model->busca_sucursal2($this->input->post('plaza'));
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */