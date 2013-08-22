<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Sistemas extends CI_Controller
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
        $this->load->model('catalogo_model');
        $data['sucx'] = $this->catalogo_model->busca_sucursal_toda();
        $this->load->model('sistemas_model');
        $tit= 'Reporte de sistemas';
        $data['titulo']= 'Reporte de sistemas';
        $data['tabla']= $this->sistemas_model->tabla_reporte($tit);
        $data['contenido']= "sistemas_form_reporte1";
        $data['selector'] = "reporte";
        $data['sidebar'] = "sidebar_sistemas";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
   public function tabla_reporte_detalle($id)
    {
        
        $tit= 'Reporte de sistemas';
        $this->load->model('sistemas_model');
        $data['tabla0'] = $this->sistemas_model->busca_reporte($id,$tit);
        //$data['per'] = $this->sistemas_model->busca_sis();
        $data['titulo']= 'SOLUCION';
        $data['tabla']= $this->sistemas_model->tabla_reporte($tit);
        $data['contenido']= "sistemas_form_reporte2";
        $data['selector'] = "reporte";
        $data['sidebar'] = "sidebar_sistemas";
                
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
function busca_nomina()
	{
	$this->load->model('sistemas_model');
    echo $this->sistemas_model->busca_nominaa($this->input->post('suc'));
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function agrega_reporte()
	{
	$this->load->model('sistemas_model');
    echo $this->sistemas_model->agrega_member_reporte($this->input->post('suc'),$this->input->post('nom'),
    $this->input->post('problema'));
     redirect('sistemas/index/');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function reporte_borrar($id)
	{
	$this->load->model('sistemas_model');
    echo $this->sistemas_model->borrar_member_reporte($id);
     redirect('sistemas/index');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function reporte_act($id)
	{
	$this->load->model('sistemas_model');
    echo $this->sistemas_model->update_member_reporte($this->input->post('id'),$this->input->post('solucion')
    ,$this->input->post('antes'),$this->input->post('ahora'));
     redirect('sistemas/index');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    



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