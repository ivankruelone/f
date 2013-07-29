<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Calendario extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->esta_logeado();
        
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

        $data['titulo'] = "CALENDARIO DE NOMINAS";
        $data['contenido'] = "calendario";
        $data['selector'] = "calendario";
        $data['sidebar'] = "sidebar_blanco";

        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('extrafooter');
    }
    
    function fechas()
    {
        //dia1 al dia3 altas #32CD32
        //dia1 al dia2 cambios y bajas #DC143C
        //dia1 al dia4 retenciones #FFD700
        
        //1 + 6 prenomina #1E90FF
        //16 + 6 prenomina
         
       	$year = date('Y');
    	$month = date('m');
        
        $a = array();
        
        $anio_inicial = date('Y');
        $anio_final = date('Y') + 1;
        $mes_actual = date('m');
        
        //$this->db->where('mes > 7');
        $query = $this->db->get('catalogo.cat_calendario_nom');
        
        foreach($query->result() as $row)
        {
            
            array_push($a, array(
            			'title' => "Altas de Personal",
            			'start' => $anio_inicial."-".str_pad($row->mes, 2, "0", STR_PAD_LEFT)."-".str_pad($row->inicio, 2, "0", STR_PAD_LEFT)."",
            			'end' => $anio_inicial."-".str_pad($row->mes, 2, "0", STR_PAD_LEFT)."-".str_pad($row->alta, 2, "0", STR_PAD_LEFT)."",
                        'color' => '#32CD32'
      		));
            
            array_push($a, array(
            			'title' => "Cambios y Bajas de Personal",
            			'start' => $anio_inicial."-".str_pad($row->mes, 2, "0", STR_PAD_LEFT)."-".str_pad($row->inicio, 2, "0", STR_PAD_LEFT)."",
            			'end' => $anio_inicial."-".str_pad($row->mes, 2, "0", STR_PAD_LEFT)."-".str_pad($row->cambaj, 2, "0", STR_PAD_LEFT)."",
                        'color' => '#DC143C'
      		));
            
            array_push($a, array(
            			'title' => "Retenciones de Personal",
            			'start' => $anio_inicial."-".str_pad($row->mes, 2, "0", STR_PAD_LEFT)."-".str_pad($row->inicio, 2, "0", STR_PAD_LEFT)."",
            			'end' => $anio_inicial."-".str_pad($row->mes, 2, "0", STR_PAD_LEFT)."-".str_pad($row->retencion, 2, "0", STR_PAD_LEFT)."",
                        'color' => '#FFD700',
                        'textColor' => '#006400'
      		));
            array_push($a, array(
            			'title' => "Prenomina",
            			'start' => $anio_inicial."-".str_pad($row->mes, 2, "0", STR_PAD_LEFT)."-".str_pad($row->inicio, 2, "0", STR_PAD_LEFT)."",
            			'end' => $anio_inicial."-".str_pad($row->mes, 2, "0", STR_PAD_LEFT)."-".str_pad($row->prenomina, 2, "0", STR_PAD_LEFT)."",
                        'color' => '#1E90FF'
      		));
            
    }     
  
       
        echo json_encode($a);
    }

            

    
    
}
