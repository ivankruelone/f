<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Respaldo extends CI_Controller
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
        //if($logeado == null){
        //    redirect('welcome');
        //}
    }
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    

    function controlados()
    {
     $this->load->model('respaldo_model');
     $this->respaldo_model->controlados();
    //redirect('procesos/index');
  }    
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    

      }