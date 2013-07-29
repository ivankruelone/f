<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Vacaciones extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        
    }

    public function esta_logeado()
    {
        $logeado = $this->session->userdata('is_logged_in');
        if($logeado == null){
            redirect('welcome');
        }
    }
    
    public function index()
    {
        $data['selector'] = "vacaciones";
        $data['sidebar'] = "sidebar_vacaciones";
        $data['contenido'] = "blanco";
 
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    public function captura_vacaciones()
    {
        $data['titulo'] = "AGREGAR VACACIONES";
        $data['selector'] = "vacaciones";
        $data['sidebar'] = "sidebar_vacaciones";
        $data['contenido'] = "recursos_humanos_form_vacaciones";
        $this->load->model('vacaciones_model');
        $data['empleadox'] = $this->vacaciones_model->busca_empleado();
        
 
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function busca_ciclos()
    {
        $nomina = $this->input->post('nomina');
        $this->db->select('id, aaa1, aaa2, dias');
        $this->db->where('nomina', $nomina);
        $this->db->where('dias > 0', '', false);
        $query = $this->db->get('periodo_vacas_detaller');
        
        if($query->num_rows() > 0)
        {
            $a = null;
            foreach($query->result() as $row){
                $a.= '<option value="'.$row->aaa1.' - '.$row->aaa2.'">'.$row->aaa1.' - '.$row->aaa2.'</option>
                ';
            }
            
            echo $a;
        }else{
            
        }
    }
    
      
    public function vacaciones_submit()
    {
        
        $this->load->model('vacaciones_model');
        $this->vacaciones_model->guardar_vacaciones();
        redirect('vacaciones/captura_vacaciones/');
 
       
    }
    
    
    public function historico_vacaciones()
    {   
        $this->load->library('pagination');
        $this->load->model('vacaciones_model');
        $config['base_url'] = site_url()."/vacaciones/historico_vacaciones";
        $config['total_rows'] = $this->vacaciones_model->cuenta_vacaciones();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '5'; 

        $this->pagination->initialize($config); 
      

        $data['contenido'] = "recursos_humanos_vacaciones_his";
        $data['sidebar'] = "sidebar_vacaciones";
        $data['tabla'] = $this->vacaciones_model->historico_vacaciones($config['per_page'], $this->uri->segment(3));
        $data['tabla1']= 'RESULTADO DE LA BUSQUEDA';
   

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    
    function imprime($id, $succ)
    {
          
          
          $this->load->model('vacaciones_model');

            
            $data['detalle'] = $this->vacaciones_model->reporte_vacas($id, $succ);
          
          
            $data['id']=$id;
            $data['succ']=$succ;
            $this->load->view('impresiones/vacaciones', $data);
            
		}
        
        
    function busca_vacaciones()
    {
        $this->load->model('vacaciones_model');
        echo $this->vacaciones_model->busca_vacaciones();
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function salidas_de_personal()
    {
        $data['titulo'] = "FORMATO DE SALIDAS DEL PERSONAL";
        $data['selector'] = "vacaciones";
        $data['sidebar'] = "sidebar_vacaciones";
        $data['contenido'] = "form_salidas";
        $this->load->model('vacaciones_model');
        $data['empleadox'] = $this->vacaciones_model->busca_empleado1();
        $data['empleadox1'] = $this->vacaciones_model->busca_empleado2();
        $data['empleadox2'] = $this->vacaciones_model->busca_empleado3();
        $data['empleadox3'] = $this->vacaciones_model->busca_empleado4();
        $data['empleadox4'] = $this->vacaciones_model->busca_empleado5();
        $data['asuntox'] = $this->vacaciones_model->selec_asunto();
        $data['regresox'] = $this->vacaciones_model->regreso();
        
 
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    public function salidas_submit()
    {
        
        $empleadox = $this->input->post('nombre');
        $empleadox1 = $this->input->post('nombre1');
        $empleadox2 = $this->input->post('nombre2');
        $empleadox3 = $this->input->post('nombre3');
        $empleadox4 = $this->input->post('nombre4');
        $asuntox = $this->input->post('asunto');
        $regresox = $this->input->post('regreso');
        
        $this->load->model('vacaciones_model');
        
        $this->vacaciones_model->guardar_salidas();

        $data['cabeza'] = $this->vacaciones_model->reporte_salida_encabezado();
        $data['detalle'] = $this->vacaciones_model->reporte_salida($empleadox, $empleadox1, $empleadox2, $empleadox3, $empleadox4, $asuntox, $regresox);
        
        $this->load->view('impresiones/reporte_salida_de_personal', $data);
    }
    
     public function historico_salidas()
    {   
        $this->load->library('pagination');
        $this->load->model('vacaciones_model');
        $config['base_url'] = site_url()."/vacaciones/historico_salidas";
        $config['total_rows'] = $this->vacaciones_model->cuenta_salidas();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '5'; 

        $this->pagination->initialize($config); 
      

        $data['contenido'] = "salidas_his";
        $data['sidebar'] = "sidebar_vacaciones";
        $data['tabla'] = $this->vacaciones_model->historico_salidas($config['per_page'], $this->uri->segment(3));
        $data['tabla1']= 'RESULTADO DE LA BUSQUEDA';
   

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    
    function imprime1($id_reg)
    {
          
          
          $this->load->model('vacaciones_model');

            
            $data['cabeza'] = $this->vacaciones_model->reporte_salida_encabezado();
            $data['detalle'] = $this->vacaciones_model->reporte_salida1($id_reg);
          
          
            $data['id_reg']=$id_reg;
            $this->load->view('impresiones/reporte_salida_de_personal', $data);
            
		}
        
        
    function busca_salidas()
    {
        $this->load->model('vacaciones_model');
        echo $this->vacaciones_model->busca_salidas();
    }
}